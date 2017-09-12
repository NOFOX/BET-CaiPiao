package com.mh.web.controller;

import java.text.ParseException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.Comparator;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;
import java.util.TreeMap;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.commons.lang3.StringUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;

import app.xb.cmbase.model.CpCateGory;
import app.xb.cmbase.model.CpConfig;
import app.xb.cmbase.model.CpGame;
import app.xb.cmbase.model.CpType;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONObject;
import com.mh.commons.cache.CpCacheUtil;
import com.mh.commons.conf.CommonConstant;
import com.mh.commons.conf.CpConfigCache;
import com.mh.commons.orm.Page;
import com.mh.commons.utils.CommonUtils;
import com.mh.commons.utils.DateUtil;
import com.mh.commons.utils.MathUtil;
import com.mh.commons.utils.MxnUtil;
import com.mh.commons.utils.ResponsePrintUtils;
import com.mh.commons.utils.SecurityEncode;
import com.mh.commons.utils.ServletUtils;
import com.mh.entity.CpOrder;
import com.mh.entity.CpParameter;
import com.mh.entity.CpTomResults;
import com.mh.service.CpOrderService;
import com.mh.service.GameResultsService;
import com.mh.service.WebUserService;
import com.mh.web.login.UserContext;
import com.mh.web.util.GroupSelectUtils;

/**
 * 
 * 投注记录
 */
@Controller
@RequestMapping("/cpOrder")
public class CpOrderController extends BaseController{
	@Autowired
	private CpOrderService cpOrderService;
	
	@Autowired
	private GameResultsService gameResultsService;
	
	@Autowired
	private WebUserService webUserService;
	
	/**
	 * 组选
	 * 方法描述: TODO</br> 
	 * @param request
	 * @param response  
	 * void
	 */
	@RequestMapping("/getGroupOrderList")
	public void getGroupOrderList(HttpServletRequest request,
			HttpServletResponse response) {
		
		String gameCode = request.getParameter("gameCode");
		String typeCode = request.getParameter("typeCode");
		String cateCode = request.getParameter("cateCode");
		String multilen = request.getParameter("multilen");
		
		int gslen = Integer.valueOf(multilen);
 		
		CpGame cpGame = CpConfigCache.GAME_OBJ_CACHE_MAP.get(gameCode);
//		CpType cpType= CpConfigCache.TYPE_OBJ_CACHE_MAP.get(cpGame.getBigtypeCode()+"_"+typeCode);
		CpCateGory cpCategory =  CpConfigCache.CATE_OBJ_CACHE_MAP.get(cpGame.getGameTypeCode()+"_"+typeCode+"_"+cateCode);
	
		//组合数
		List<String> list=null;
		double betRate=0;
		String numbers = "";
		String content = "";
		String cacheKey = gameCode+"_"+typeCode+"_"+cateCode;
		if(gslen==99){
			String bwNum = request.getParameter("bwNum");
			String swNum = request.getParameter("swNum");
			String gwNum = request.getParameter("gwNum");
			
			List<String> bwList = Arrays.asList(bwNum.split(","));
			List<String> swList = Arrays.asList(swNum.split(","));
			List<String> gwList = Arrays.asList(gwNum.split(","));
			Collections.sort(bwList);
			Collections.sort(swList);
			Collections.sort(gwList);
			
			list =GroupSelectUtils.getGroupSelectMoreRate(bwList, swList, gwList,cacheKey);
			content = list.get(0);
			numbers = list.get(1);
			betRate = Double.valueOf(list.get(2));
		}else if(gslen==88){//一字过关
			String bwNum = request.getParameter("bwNum");
			String swNum = request.getParameter("swNum");
			String gwNum = request.getParameter("gwNum");
			
			StringBuffer numberBuffer = new StringBuffer("");
			StringBuffer contextBuffer = new StringBuffer("");
			int total=0;
			double totalRate = 1;
			if(!StringUtils.isEmpty(bwNum)){
				String uidKey=gameCode+"-"+bwNum;
				CpConfig config = CpConfigCache.UID_CACHE_KEY.get(uidKey);
				totalRate = MathUtil.mul(totalRate, config.getPl());
				total++;
				numberBuffer.append(config.getXzlxName()).append(":").append(config.getNumber());
				contextBuffer.append(config.getXzlxName()).append(":").append(config.getNumber());
				
			}
			if(!StringUtils.isEmpty(swNum)){
				String uidKey=gameCode+"-"+swNum;
				CpConfig config = CpConfigCache.UID_CACHE_KEY.get(uidKey);
				totalRate = MathUtil.mul(totalRate, config.getPl());
				
				if(total>0){
					numberBuffer.append(",").append(config.getXzlxName()).append(":").append(config.getNumber());
					contextBuffer.append("；").append(config.getXzlxName()).append(":").append(config.getNumber());
				}
				
			}
			if(!StringUtils.isEmpty(gwNum)){
				String uidKey=gameCode+"-"+gwNum;
				CpConfig config = CpConfigCache.UID_CACHE_KEY.get(uidKey);
				totalRate = MathUtil.mul(totalRate, config.getPl());
				
				if(total>0){
					numberBuffer.append(",").append(config.getXzlxName()).append(":").append(config.getNumber());
					contextBuffer.append("；").append(config.getXzlxName()).append(":").append(config.getNumber());
				}
			}
			betRate=totalRate;
			numbers = numberBuffer.toString();
			content = contextBuffer.toString();
		}else{
			String bwNum = request.getParameter("num");
			list =  Arrays.asList(bwNum.split(","));
			Collections.sort(list);
			betRate=GroupSelectUtils.choiceRate(list,cacheKey,gslen);
			StringBuffer numberBuffer = new StringBuffer("");
			for(int i=0;i<list.size();i++){
				if(i>0){
					numberBuffer.append(",");
				}
				numberBuffer.append(list.get(i));
			}
			numbers = numberBuffer.toString();
			content =  numberBuffer.toString();
		}
		betRate = MathUtil.round(betRate, 2);
		
		
		JSONArray rateArray = new JSONArray();
		JSONObject jsonObject = new JSONObject();
		jsonObject.put("number", content);
		jsonObject.put("rate", betRate);
		jsonObject.put("cateName", cpCategory.getName());
		rateArray.add(jsonObject);
 
		//拼接赔率
		StringBuffer buffer = new StringBuffer("");
		buffer.append(numbers);
		buffer.append("|").append(betRate);
		
		jsonObject = new JSONObject();
		String _p = SecurityEncode.encoderByDES(buffer.toString(),SecurityEncode.key);
		
		jsonObject.put("orderList", rateArray);
		jsonObject.put("token", _p);
		
		ResponsePrintUtils.outPrintMsg(request, response,JSON.toJSONString(jsonObject));

	}
	
	
	
	
	
	/**
	 * 多组随机组合
	 * 方法描述: TODO</br> 
	 * @param request
	 * @param response  
	 * void
	 */
	@RequestMapping("/goMultiGroupOrder")
	public void goMulGroupOrderList(HttpServletRequest request,
			HttpServletResponse response){
		String gameCode = request.getParameter("gameCode");
		String cids = request.getParameter("cids");
		String multilen = request.getParameter("multilen");
		if(StringUtils.isEmpty(gameCode) || StringUtils.isEmpty(cids) || StringUtils.isEmpty(multilen)){
			ResponsePrintUtils.outPrintMsg(request, response, "请求参数为空!");
			return;
		}
		String[] cidArr = cids.split(",");
		
		List<String> list = new ArrayList<String>();
		
		Map<String,CpConfig> configMap = new HashMap<String,CpConfig>();
		for(int i=0;i<cidArr.length;i++){
			String uidKey=gameCode+"-"+cidArr[i];
			CpConfig config = CpConfigCache.UID_CACHE_KEY.get(uidKey);
			list.add(config.getId()+"");
			
			configMap.put(String.valueOf(config.getId()), config);
		}
		
		MxnUtil comb = new MxnUtil();
		comb.mn(list.toArray(), Integer.valueOf(multilen));
		List<String> valList = comb.getCombList();
		double rate = 0;
		
		StringBuffer idsBuff = new StringBuffer("");
		StringBuffer rateBuffer = new StringBuffer("");
		StringBuffer numBuffer = new StringBuffer("");
		
		JSONArray rateArray = new JSONArray();
		for(int i=0;i<valList.size();i++){
			String ids = valList.get(i);
			String[] idArr = ids.split(",");
 
			StringBuffer numberBuffer = new StringBuffer("");
			if(i>0){
				idsBuff.append("/");
				numBuffer.append("/");
				rateBuffer.append("/");
			}
			idsBuff.append(ids);
			
			//取最小的赔率
			Map<Integer,Double> rateSortMap = new TreeMap<Integer,Double>();
			String cateName = "";
			for(int j=0;j<idArr.length;j++){
				CpConfig config= configMap.get(idArr[j]);	
				if(j>0){
					numberBuffer.append(",");
				}
				numberBuffer.append(config.getNumber());
				rateSortMap.put(j, config.getPl());
				cateName = config.getCpCateName();
			}
			//然后通过比较器来实现排序
			List<Map.Entry<Integer,Double>> vallist = new ArrayList<Map.Entry<Integer,Double>>(rateSortMap.entrySet());
	        Collections.sort(vallist,new Comparator<Map.Entry<Integer,Double>>() {
	            //降序排序
	            @Override
				public int compare(Entry<Integer,Double> o1,
	                    Entry<Integer,Double> o2) {
	                return o1.getValue().compareTo(o2.getValue());
	            }
	            
	        });
			for (Map.Entry<Integer,Double> mapping : vallist) {
				rate = mapping.getValue().doubleValue();
				break;
			}
			rateBuffer.append(String.valueOf(rate));
			numBuffer.append(numberBuffer.toString());
			
			JSONObject jsonObject = new JSONObject();
			jsonObject.put("number", CommonUtils.getSortNumbers(numberBuffer.toString()));
			jsonObject.put("rate", rate);
			jsonObject.put("cateName", cateName);
			rateArray.add(jsonObject);
		}
		StringBuffer buffer = new StringBuffer("");
		buffer.append(idsBuff.toString());
		buffer.append("|");
		buffer.append(numBuffer.toString());
		buffer.append("|");
		buffer.append(rateBuffer.toString());
		
		String _p = SecurityEncode.encoderByDES(buffer.toString(),SecurityEncode.key);
		
		JSONObject jsonObject = new JSONObject();
		jsonObject.put("orderList", rateArray);
		jsonObject.put("token", _p);
		
		
		ResponsePrintUtils.outPrintMsg(request, response,JSON.toJSONString(jsonObject));
	}
	
	
	/**
	 * 连码订单列表
	 * 方法描述: TODO</br> 
	 * @param request
	 * @param response
	 * @param code
	 * @param type
	 * @return  
	 * ModelAndView
	 */
	@RequestMapping("/goLmOrder")
	public void goLmOrder(HttpServletRequest request,
			HttpServletResponse response) {
		String nums = request.getParameter("nums");
		String[] numsArr = nums.split(",");
		
		//组合类型  1复式 2 胆拖 3 生肖对碰 4 尾数对碰
		String pabc = request.getParameter("pabc");
 
		//类别  0 三全中 1三中二 2二全中 3二中特 4特串
		String rtype = request.getParameter("rrtype");
		int goup = 3;
		if("2".equals(rtype) ||"3".equals(rtype) || "4".equals(rtype)){
			goup=2;
		}
		
		List<String> numList = Arrays.asList(numsArr);
//		List<String> panList = CommonUtils.getLmParamValList(request,"pan");
		List<String> valList = null;
		String rateid1= "",rateid2="";
		String rate1="",rate2="";
		CpConfig cpConfig1 = null;
		CpConfig cpConfig2 = null;
		
		String cateName = "";
		StringBuffer titleBuffer = new StringBuffer("");
		if(CommonConstant.HK6_LM_LB_3QZ.equals(rtype)){
			rateid1 = "HK6-LM-3QZ-3QZ";
			cpConfig1 =  CpConfigCache.UID_CACHE_KEY.get(rateid1);
			rate1 = cpConfig1.getPl()+"";
			cateName ="三全中" ;
			titleBuffer.append("三全中").append("<font color=\"#ff9900\">"+rate1+"</font>");
		}else if(CommonConstant.HK6_LM_LB_3Q2.equals(rtype)){
			rateid1 ="HK6-LM-3Z2-Z2";
			rateid2 ="HK6-LM-3Z2-Z3";
			
			cpConfig1 = CpConfigCache.UID_CACHE_KEY.get(rateid1);
			rate1 = cpConfig1.getPl()+"";
			cpConfig2 = CpConfigCache.UID_CACHE_KEY.get(rateid2);
			rate2 = cpConfig2.getPl()+"";
			
			cateName ="三中二" ;
			
			titleBuffer.append("三中二").append(" ").append("<font color=\"#ff9900\">"+rate1+"</font>");
			titleBuffer.append("<br>");
			titleBuffer.append("中三").append(" ").append("<font color=\"#ff9900\">"+rate2+"</font>");
			
		}else if(CommonConstant.HK6_LM_LB_2QZ.equals(rtype)){
			rateid1 = "HK6-LM-2QZ-2QZ";
			cpConfig1 = CpConfigCache.UID_CACHE_KEY.get(rateid1);
			rate1 = cpConfig1.getPl()+"";
			
			cateName ="二全中" ;
			titleBuffer.append("二全中").append("<font color=\"#ff9900\">"+rate1+"</font>");
			
		}else if(CommonConstant.HK6_LM_LB_2ZT.equals(rtype)){
			rateid1 = "HK6-LM-2ZT-ZT";
			rateid2 = "HK6-LM-2ZT-TZ2";
			
			cpConfig1 = CpConfigCache.UID_CACHE_KEY.get(rateid1);
			rate1 = cpConfig1.getPl()+"";
			cpConfig2 = CpConfigCache.UID_CACHE_KEY.get(rateid2);
			rate2 = cpConfig2.getPl()+"";
			
			
			cateName ="二中特" ;
			titleBuffer.append("二中特").append(" ").append("<font color=\"#ff9900\">"+rate1+"</font>");
			titleBuffer.append("<br>");
			titleBuffer.append("中二").append(" ").append("<font color=\"#ff9900\">"+rate2+"</font>");
			
		}else if(CommonConstant.HK6_LM_LB_TC.equals(rtype)){
			rateid1 = "HK6-LM-TC-TC";
			cpConfig1 = CpConfigCache.UID_CACHE_KEY.get(rateid1);
			rate1 = cpConfig1.getPl()+"";
			
			titleBuffer.append("特串");
			
			cateName ="特串" ;
			titleBuffer.append("特串").append("<font color=\"#ff9900\">"+rate1+"</font>");
		}
		
		
		if(CommonConstant.HK6_LM_ZHLX_FS.equals(pabc)){//复式
			MxnUtil comb = new MxnUtil();
			comb.mn(numList.toArray(), goup);
			valList = comb.getCombList();
		}else if(CommonConstant.HK6_LM_ZHLX_TD.equals(pabc)){//拖胆
			MxnUtil comb = new MxnUtil();
			//dm1 胆1 dm2 胆2
			String dm1 = request.getParameter("dm1");
			String dm2 = request.getParameter("dm2");
			
			List<String> dmList = new ArrayList<String>();
			if(!StringUtils.isEmpty(dm1)){
				int d1 = Integer.valueOf(dm1);
				if(d1<10){
					dm1 = "0"+d1;
				}
				dmList.add(dm1);
			}
			if(!StringUtils.isEmpty(dm2)){
				int d2 = Integer.valueOf(dm2);
				if(d2<10){
					dm2 = "0"+d2;
				}
				
				dmList.add(dm2);
			}
			String dmStr = StringUtils.join(dmList.toArray(),",");
			
			comb.mn(numList.toArray(), goup-dmList.size());
			List<String> list = comb.getCombList();
	 
			valList = new ArrayList<String>();
			for(int i=0;i<list.size();i++){
				String numbers = dmStr+","+list.get(i);
				numbers = CommonUtils.getSortNumbers(numbers);
				valList.add(numbers);
			}
		}
			
//	    else{//生肖对碰
//			valList = new ArrayList<String>();
//			String pan1 = panList.get(0);
//			String pan2 = panList.get(1);
//			String[] pan1Arr = pan1.split(",");
//			String[] pan2Arr = pan2.split(",");
//			for(int i=0;i<pan1Arr.length;i++){
//				for(int j=0;j<pan2Arr.length;j++){
//					String numbers = pan1Arr[i]+","+pan2Arr[j];
//					numbers = CommonUtils.getSortNumbers(numbers);
//					valList.add(numbers);
//				}
//			}
//			
//		}
		
		String rateid = rateid1;
		if(!"".equals(rateid2)){
			rateid +=","+rateid2;
		}
 
		StringBuffer numberBuffer = new StringBuffer("");
		JSONArray rateArray = new JSONArray();		
		for(int i=0;i<valList.size();i++){
			String number = valList.get(i);
			if(i>0){
				numberBuffer.append("#");
			}
			numberBuffer.append(number);
			
			JSONObject jsonObject = new JSONObject();
			jsonObject.put("number", number);
			jsonObject.put("rate", titleBuffer.toString());
			jsonObject.put("cateName", cateName);
			rateArray.add(jsonObject);
			
		}
		numberBuffer.append("|").append(rateid);
		numberBuffer.append("|");
		numberBuffer.append(cpConfig1.getCpTypeCode());
		
		String _p = SecurityEncode.encoderByDES(numberBuffer.toString(),SecurityEncode.key);
			
		JSONObject jsonObject = new JSONObject();
		jsonObject.put("orderList", rateArray);
		jsonObject.put("token", _p);
		
		ResponsePrintUtils.outPrintMsg(request, response,JSON.toJSONString(jsonObject));

	}
	
	
	
	
	/**
	 * 投注列表
	 * 方法描述: TODO</br> 
	 * @param request
	 * @param response
	 * @param cpParameter  
	 * void
	 */
	@RequestMapping("/getCpOrderList")
	public void getCpOrderList(HttpServletRequest request,HttpServletResponse response){
		try {
			UserContext uc = this.getUserContext(request);
			String gameCode = request.getParameter("gameCode");
			String beginTimeStr = request.getParameter("beginTimeStr");
			String endTimeStr = request.getParameter("endTimeStr");
			
			String orderNo = request.getParameter("orderNo");
			String status = request.getParameter("status");
			String userName = request.getParameter("userName");
			
			CpOrder gameOrder = new CpOrder();
			
			if(StringUtils.isNotBlank(userName)){
				gameOrder.setUserName(userName);
			}else{
				gameOrder.setUserName(uc.getUserName());
			}
			
			
			if(StringUtils.isNotBlank(status)){
				gameOrder.setStatus(status);
			}
			if(StringUtils.isNotBlank(orderNo)){
				gameOrder.setXzdh(orderNo);
			}
			if(StringUtils.isNotBlank(gameCode)){
				gameOrder.setGameTypeCode(gameCode);
			}
			if(StringUtils.isNotBlank(beginTimeStr)){
				gameOrder.setBeginTimeStr(beginTimeStr);
			}
			if(StringUtils.isNotBlank(endTimeStr)){
				gameOrder.setEndTimeStr(endTimeStr);
			}
			
			Page page = this.newPage(request);

			cpOrderService.getOrderList(page,gameOrder);
			 
			ServletUtils.outPrintSuccess(request, response, page);
		} catch (Exception e) {
			e.printStackTrace();
			ServletUtils.outPrintFail(request, response, "查询订单失败！");
		}
	}
	
	
	/**
	 * 订单详情
	 * 方法描述: TODO</br> 
	 * @param request
	 * @param response
	 * @param cpParameter  
	 * void
	 */
	@RequestMapping("/orderDetail/{orderNo}")
	public void orderDetail(@PathVariable(value = "orderNo") String orderNo,HttpServletRequest request,HttpServletResponse response,CpParameter cpParameter){
		try {
			UserContext uc = this.getUserContext(request);
			CpOrder cpOrder = this.cpOrderService.getOrderByOrderNo(uc.getUserName(), orderNo);
			if(cpOrder!=null){
				JSONObject obj = new JSONObject();
				obj.put("userName", uc.getUserName());
				obj.put("orderNo",orderNo);
				obj.put("betTime",DateUtil.formatDate(cpOrder.getXzsj(), DateUtil.YMDHMS_PATTERN));
				obj.put("qs", cpOrder.getQs());
				obj.put("gameName", cpOrder.getGameTypeName());
				obj.put("gameCode", cpOrder.getGameTypeCode());
				obj.put("itemName", cpOrder.getCpCateName());
				obj.put("betNumber", cpOrder.getNumber());
				obj.put("pl", cpOrder.getPl());
				obj.put("xzje", cpOrder.getXzje());
				obj.put("kyje", cpOrder.getKyje());
				obj.put("zgje", cpOrder.getZgje());
				String openStatus = cpOrder.getOrderStatus();
				if("赢".equals(cpOrder.getOrderStatus())){
					openStatus = "已中奖";
				}else if("输".equals(cpOrder.getOrderStatus())){
					openStatus = "未中奖";
				}else if("未结算".equals(cpOrder.getOrderStatus())){
					openStatus = "等待开奖";
				}
				
				obj.put("openStatus",openStatus);
				String openTime = "";
				String openNumber = "";
				if("1".equals(cpOrder.getSfjs())){
					openTime = DateUtil.formatDate(cpOrder.getOpenTime(), DateUtil.YMDHMS_PATTERN);
					openNumber = cpOrder.getKjjg();
				}
				obj.put("openTime", openTime);
				obj.put("openNumber", openNumber);
				obj.put("backWaterMoney", cpOrder.getBackWaterMoney()==null?0:cpOrder.getBackWaterMoney());
				obj.put("winMoney", cpOrder.getWinMoney()==null?0:cpOrder.getWinMoney());
				
				ServletUtils.outPrintSuccess(request, response,obj);
			}else{
				ServletUtils.outPrintFail(request, response, "查询订单失败！");
			}
		} catch (Exception e) {
			e.printStackTrace();
			ServletUtils.outPrintFail(request, response, "查询订单详情失败！");
		}
	}
	
	
	
	
	
	@RequestMapping("/getCpGameCodeList")
	public void getCpGameCodeList(HttpServletRequest request,HttpServletResponse response,CpParameter cpParameter){
		try {
			ServletUtils.outPrintSuccess(request, response, cpOrderService.getCpGameCodeList());
		} catch (Exception e) {
			e.printStackTrace();
			ServletUtils.outPrintFail(request, response, "查询游戏类型失败！");
		}
	}
	
	
	/**
	 * 
	 * 方法描述: TODO</br> 
	 * @param request
	 * @param response  
	 * void
	 */
	@RequestMapping("/saveOrder")
	public void saveOrder(HttpServletRequest request,HttpServletResponse response) throws Exception{
		try{
			String gameCode = request.getParameter("gameCode");
			String jsonData = request.getParameter("jsons");
			String orderFlag = request.getParameter("orderFlag");
			
			String qs = request.getParameter("qs");
			UserContext uc = this.getUserContext(request);
			if(uc==null){
				ResponsePrintUtils.outPrintFail(request, response, "请登录后在下单!");
				return;
			}
			
			
			if(StringUtils.isEmpty(qs) || StringUtils.isEmpty(gameCode) || StringUtils.isEmpty(jsonData) || StringUtils.isEmpty(orderFlag)){
				ResponsePrintUtils.outPrintFail(request, response, "请求参数为空!");
				return;
			}
			if(!this.validateCpOpenTime(gameCode,qs)){
				ResponsePrintUtils.outPrintFail(request, response, "该期已关盘!");
				return;
			}
			
			boolean vaFlag = this.validateBetEdu(request, response);
			if(!vaFlag){
				return;
			}
			
			this.cpOrderService.updateOrder(request, gameCode, jsonData, orderFlag);
			ResponsePrintUtils.outPrintSuccess(request, response,"成功提交注单！");
		}catch(RuntimeException e){
			e.printStackTrace();
			logger.error("提交注单失败!",e);
			ResponsePrintUtils.outPrintFail(request, response, "提交注单失败！");
		}
		 
	}
	
	/**
	 * 验证期数和开奖时间
	 * 方法描述: TODO</br> 
	 * @param code
	 * @param valcode
	 * @return  
	 * boolean
	 */
	public boolean validateCpOpenTime(String gameCode,String qs){
		CpTomResults nextResults = this.gameResultsService.getTomQsCache(gameCode, qs);
		Date currDate = new Date();
		Date kjsjDate = null;
		try {
			kjsjDate = DateUtil.parse(nextResults.getKjsj(), "yyyy-MM-dd HH:mm:ss");
		} catch (ParseException e) {
			e.printStackTrace();
		}
 
		int closeSec = CpConfigCache.gameCloseMap.get(gameCode);
		
		kjsjDate = DateUtil.addSecond(kjsjDate, -closeSec);
		if(currDate.getTime()>kjsjDate.getTime()){
			return false;
		}
		boolean eFlag = CpCacheUtil.isExistsOpenResults(gameCode, nextResults.getFormatQs());
		if(eFlag){
			return false;
		}
		
		return true;
	}
	
	

	/**
	 * 验证下注额度
	 * 方法描述: TODO</br> 
	 * @param request
	 * @param response
	 * @return  
	 * boolean
	 */
	public boolean validateBetEdu(HttpServletRequest request,HttpServletResponse response){
		UserContext uc = this.getUserContext(request);
		
		String gameCode = request.getParameter("gameCode");
		String jsonData = request.getParameter("jsons");
		String orderFlag = request.getParameter("orderFlag");
		JSONArray jsonArray=JSON.parseArray(jsonData);
		
		CpTomResults nextResults = this.gameResultsService.getTomResults(gameCode);
		int minSingle=0;
		int maxSingle=0;
		int singleCredit = 0;//当期限额
		double moneyTotal=0;		
		CpOrder order = new CpOrder();
		order.setUserName(uc.getUserName());
		order.setQs(nextResults.getQs());
		CpGame cpGame = null;
		CpType cpType = null;
		double xzje = 0.0;
		
		String normalMsg = "";
		boolean flag = true;//常规注单标示位
		//验证PC蛋蛋逆向下注
		if(CommonConstant.BJKL8_CODE_PARAM.equals(gameCode) || CommonConstant.CAKENO_CODE_PARAM.equals(gameCode)){
			boolean reFlag = false;
			List<String> reverseList = new ArrayList<String>();
			for(int i=0;i<jsonArray.size();i++){
				JSONObject json=jsonArray.getJSONObject(i);
				String number = json.getString("number");
				if(CommonConstant.dxdsList.contains(number)){
					List<String> list = CommonConstant.reverseMap.get(number);
					reverseList.addAll(list);
				}
			}
	
			//验证注单
			CpOrder records = new CpOrder();
			records.setUserName(uc.getUserName());
			records.setQs(nextResults.getQs());
			records.setOrderStatus("0");
			List<CpOrder> orderList = this.cpOrderService.getOrderList(records);
			if(orderList!=null&& orderList.size()>0){
				CpOrder cpOrder = null;
				for(int i=0;i<orderList.size();i++){
					cpOrder = orderList.get(i);		
					if(CommonConstant.dxdsList.contains(cpOrder.getNumber())){
						List<String> list = CommonConstant.reverseMap.get(cpOrder.getNumber());
						reverseList.addAll(list);
					}
				}
			}
			for(int i=0;i<jsonArray.size();i++){
				JSONObject json=jsonArray.getJSONObject(i);
				String number = json.getString("number");
				if(reverseList.contains(number)){
					reFlag = true;
					break;
				}
			}
			if(reFlag){
				ResponsePrintUtils.outPrintFail(request, response, "禁止逆向下注");
				return false;
			}
			
		}
		
		
		for(int i=0;i<jsonArray.size();i++){
			JSONObject json=jsonArray.getJSONObject(i);
			String uidKey=gameCode+"-"+json.getString("uid");
			xzje = json.getDoubleValue("xzje");
			moneyTotal = MathUtil.add(moneyTotal, xzje);
			//  左边的特码快捷下注
			if ("normal".equals(orderFlag)) {//常规订单
				CpConfig config = CpConfigCache.UID_CACHE_KEY.get(uidKey);
				minSingle = config.getGminSingle();//最低下注金额
				maxSingle = config.getGmaxSingle();//最高下注金额
				cpGame = CpConfigCache.GAME_OBJ_CACHE_MAP.get(gameCode);
				cpType =CpConfigCache.TYPE_OBJ_CACHE_MAP.get(cpGame.getBigtypeCode()+"_"+config.getCpTypeCode());
				singleCredit = config.getSingleCredit();
				if(xzje > singleCredit){
					normalMsg = "号码"+config.getNumber()+"当期限额:" + singleCredit + "元";
					flag = false;
					break;
				}
 
				order.setGameTypeCode(config.getGameTypeCode());
				order.setCpTypeCode(config.getCpTypeCode());
				order.setCpCateCode(config.getCpCateCode());
				order.setXzlxCode(config.getXzlxCode());
				order.setXzzuCode(config.getXzzuCode());
				order.setNumber(config.getNumber());
				double totalXzje = this.cpOrderService.getUserSingleCreditForNumber(order);
				if((totalXzje + xzje) > singleCredit){
					normalMsg = "号码"+config.getNumber()+"当期限额:" + singleCredit + "元！您下注累积金额为:" + (totalXzje + xzje) + "元";
					flag = false;
					break;
				}
			}else if("lm".equals(orderFlag)){//连码订单
				String _p = json.getString("token");
				_p = SecurityEncode.decoderByDES(_p, SecurityEncode.key);
				String[] dataArr = _p.split("\\|");
				String cpTypeCode = dataArr[2];
				cpGame = CpConfigCache.GAME_OBJ_CACHE_MAP.get(gameCode);
				cpType =CpConfigCache.TYPE_OBJ_CACHE_MAP.get(cpGame.getBigtypeCode()+"_"+cpTypeCode);
				minSingle = cpType.getGminSingle();
				maxSingle = cpType.getGmaxSingle();
			}else if("cl".equals(orderFlag)){//过关
				CpConfig config = CpConfigCache.UID_CACHE_KEY.get(uidKey);
				cpGame = CpConfigCache.GAME_OBJ_CACHE_MAP.get(gameCode);
				cpType =CpConfigCache.TYPE_OBJ_CACHE_MAP.get(cpGame.getBigtypeCode()+"_"+config.getCpTypeCode());
				minSingle = cpType.getGminSingle();
				maxSingle = cpType.getGmaxSingle();
			}else{//组合订单
				String _p = json.getString("token");
				_p = SecurityEncode.decoderByDES(_p, SecurityEncode.key);
				String cpTypeCode = json.getString("typeCode");
				cpGame = CpConfigCache.GAME_OBJ_CACHE_MAP.get(gameCode);
				cpType =CpConfigCache.TYPE_OBJ_CACHE_MAP.get(cpGame.getBigtypeCode()+"_"+cpTypeCode);
				minSingle = cpType.getGminSingle();
				maxSingle = cpType.getGmaxSingle();
			}
			
			if(minSingle > xzje || maxSingle < xzje){
				ResponsePrintUtils.outPrintFail(request, response, "下注金额最低:" + minSingle + "元,最高:" + maxSingle + "元");
				return false;
			}
		}
		
		if(cpGame.getIsEnable().intValue() ==CommonConstant.IS_ENABLE){//大盘口启用状态
			ResponsePrintUtils.outPrintFail(request, response, cpGame.getGameTypeName() + "已进入暂时维护状态,抱歉!");
			return false;
		}else{//小盘口启用状态
			if(cpType.getIsEnable().intValue() == CommonConstant.IS_ENABLE){
				ResponsePrintUtils.outPrintFail(request, response, cpType.getCpTypeName() + "已进入暂时维护状态,抱歉!");
				return false;
			}
		}
		
		if(!flag){//常规注单
			ResponsePrintUtils.outPrintFail(request, response, normalMsg);
			return false;
		}
		
		if(!StringUtils.equalsIgnoreCase(orderFlag, "normal")){//非 常规订单 验证盘口限额
			singleCredit = cpType.getSingleCredit();
			if(xzje > singleCredit){
				ResponsePrintUtils.outPrintFail(request, response, "当期最大限额:" + singleCredit + "元");
				return false;
			}
			order.setGameTypeCode(cpGame.getGameTypeCode());
			order.setCpTypeCode(cpType.getCpTypeCode());
			double userSingleCredit = this.cpOrderService.getUserSingleCredit(order);//已经下注的金额
			if((xzje + userSingleCredit) > singleCredit){
				ResponsePrintUtils.outPrintFail(request, response, "当期最大限额:" + singleCredit + "元！您下注累积金额为:" + (xzje + userSingleCredit) + "元");
				return false;
			}
		}
		
		double userMoney = this.webUserService.getWebUserMoney(uc.getUserName());
		if(moneyTotal>userMoney){
			ResponsePrintUtils.outPrintFail(request, response, "余额不足!");
			return false;
		}
		
		return true;
 
	}
	
	
	/**
	 * 中奖名单列表
	 * 方法描述: TODO</br> 
	 * @param request
	 * @param response
	 * @param cpParameter  
	 * void
	 */
	@RequestMapping("/getWinningList")
	public void getWinningList(HttpServletRequest request,HttpServletResponse response,CpParameter cpParameter){
		try {
			List<Map<String,Object>> list = this.cpOrderService.getWinningList();
			
			ServletUtils.outPrintSuccess(request, response, list);
		} catch (Exception e) {
			e.printStackTrace();
			ServletUtils.outPrintFail(request, response, "查询订单失败！");
		}
	
		
	}
	/**
	 * 获取 彩票类型
	 * 方法描述: TODO</br> 
	 * @param request
	 * @param response
	 * @param cpParameter  
	 * void
	 */
	@RequestMapping("/getCpTypeList")
	public void getCpType(HttpServletRequest request,HttpServletResponse response){
		try {
			String code = request.getParameter("gameCode");
			List<CpType> list = CpConfigCache.TYPE_LIST_MAP.get(code);
			ServletUtils.outPrintSuccess(request, response, list);
		} catch (Exception e) {
			e.printStackTrace();
			ServletUtils.outPrintFail(request, response, "获取彩票类型失败！");
		}
	}
	/**
	 * 获取彩票配置 如:赔率  号码等
	 * 方法描述: TODO</br> 
	 * @param request
	 * @param response
	 * @param cpParameter  
	 * void
	 */
	@RequestMapping("/getCpConfigList")
	public void getCpConfig(HttpServletRequest request,HttpServletResponse response){
		try {
			String code = request.getParameter("gameCode");
			String cpType = request.getParameter("cpType");
			List<CpConfig> list = CpConfigCache.RATE_CACHE_KEY.get(code+"-"+cpType);
			ServletUtils.outPrintSuccess(request, response, list);
		} catch (Exception e) {
			e.printStackTrace();
			ServletUtils.outPrintFail(request, response, "获取彩票配置失败！");
		}
	}
}
