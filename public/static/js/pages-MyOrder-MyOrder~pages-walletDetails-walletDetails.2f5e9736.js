(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-MyOrder-MyOrder~pages-walletDetails-walletDetails"],{"0b94":function(t,e,o){"use strict";(function(t){o("7a82");var n=o("4ea4").default;Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,o("a9e3"),o("d401"),o("d3b7"),o("25f0"),o("c975"),o("ac1f"),o("5319"),o("e9c4"),o("498a"),o("1276");var i=n(o("0609")),r=n(o("c06f")),a=n(o("ce50")),l=n(o("6b3f")),s=n(o("0d3a")),c={name:"mescroll-uni",mixins:[s.default],components:{MescrollTop:l.default},props:{down:Object,up:Object,i18n:Object,top:[String,Number],topbar:[Boolean,String],bottom:[String,Number],safearea:Boolean,fixed:{type:Boolean,default:!0},height:[String,Number],bottombar:{type:Boolean,default:!0},disableScroll:Boolean},data:function(){return{mescroll:{optDown:{},optUp:{}},viewId:"id_"+Math.random().toString(36).substr(2,16),downHight:0,downRate:0,downLoadType:0,upLoadType:0,isShowEmpty:!1,isShowToTop:!1,scrollTop:0,scrollAnim:!1,windowTop:0,windowBottom:0,windowHeight:0,statusBarHeight:0}},computed:{isFixed:function(){return!this.height&&this.fixed},scrollHeight:function(){return this.isFixed?"auto":this.height?this.toPx(this.height)+"px":"100%"},numTop:function(){return this.toPx(this.top)},fixedTop:function(){return this.isFixed?this.numTop+this.windowTop+"px":0},padTop:function(){return this.isFixed?0:this.numTop+"px"},numBottom:function(){return this.toPx(this.bottom)},fixedBottom:function(){return this.isFixed?this.numBottom+this.windowBottom+"px":0},padBottom:function(){return this.isFixed?0:this.numBottom+"px"},isDownReset:function(){return 3===this.downLoadType||4===this.downLoadType},transition:function(){return this.isDownReset?"transform 300ms":""},translateY:function(){return this.downHight>0?"translateY("+this.downHight+"px)":""},scrollable:function(){return!this.disableScroll&&(0===this.downLoadType||this.isDownReset)},isDownLoading:function(){return 3===this.downLoadType},downRotate:function(){return"rotate("+360*this.downRate+"deg)"},downText:function(){if(!this.mescroll)return"";switch(this.downLoadType){case 1:return this.mescroll.optDown.textInOffset;case 2:return this.mescroll.optDown.textOutOffset;case 3:return this.mescroll.optDown.textLoading;case 4:return this.mescroll.isDownEndSuccess?this.mescroll.optDown.textSuccess:0==this.mescroll.isDownEndSuccess?this.mescroll.optDown.textErr:this.mescroll.optDown.textInOffset;default:return this.mescroll.optDown.textInOffset}}},methods:{toPx:function(t){if("string"===typeof t)if(-1!==t.indexOf("px"))if(-1!==t.indexOf("rpx"))t=t.replace("rpx","");else{if(-1===t.indexOf("upx"))return Number(t.replace("px",""));t=t.replace("upx","")}else if(-1!==t.indexOf("%")){var e=Number(t.replace("%",""))/100;return this.windowHeight*e}return t?uni.upx2px(Number(t)):0},scroll:function(t){var e=this;this.mescroll.scroll(t.detail,(function(){e.$emit("scroll",e.mescroll)}))},emptyClick:function(){this.$emit("emptyclick",this.mescroll)},toTopClick:function(){this.mescroll.scrollTo(0,this.mescroll.optUp.toTop.duration),this.$emit("topclick",this.mescroll)},setClientHeight:function(){var t=this;0!==this.mescroll.getClientHeight(!0)||this.isExec||(this.isExec=!0,this.$nextTick((function(){t.getClientInfo((function(e){t.isExec=!1,e?t.mescroll.setClientHeight(e.height):3!=t.clientNum&&(t.clientNum=null==t.clientNum?1:t.clientNum+1,setTimeout((function(){t.setClientHeight()}),100*t.clientNum))}))})))},getClientInfo:function(t){var e=uni.createSelectorQuery();e=e.in(this);var o=e.select("#"+this.viewId);o.boundingClientRect((function(e){t(e)})).exec()}},created:function(){var e=this,o={down:{inOffset:function(){e.downLoadType=1},outOffset:function(){e.downLoadType=2},onMoving:function(t,o,n){e.downHight=n,e.downRate=o},showLoading:function(t,o){e.downLoadType=3,e.downHight=o},beforeEndDownScroll:function(t){return e.downLoadType=4,t.optDown.beforeEndDelay},endDownScroll:function(){e.downLoadType=4,e.downHight=0,e.downResetTimer&&clearTimeout(e.downResetTimer),e.downResetTimer=setTimeout((function(){4===e.downLoadType&&(e.downLoadType=0)}),300)},callback:function(t){e.$emit("down",t)}},up:{showLoading:function(){e.upLoadType=1},showNoMore:function(){e.upLoadType=2},hideUpScroll:function(t){e.upLoadType=t.optUp.hasNext?0:3},empty:{onShow:function(t){e.isShowEmpty=t}},toTop:{onShow:function(t){e.isShowToTop=t}},callback:function(t){e.$emit("up",t),e.setClientHeight()}}},n=a.default.getType(),l={type:n};i.default.extend(l,e.i18n),i.default.extend(l,r.default.i18n),i.default.extend(o,l[n]),i.default.extend(o,{down:r.default.down,up:r.default.up});var s=JSON.parse(JSON.stringify({down:e.down,up:e.up}));i.default.extend(s,o),e.mescroll=new i.default(s),e.mescroll.viewId=e.viewId,e.mescroll.i18n=l,e.$emit("init",e.mescroll);var c=uni.getSystemInfoSync();c.windowTop&&(e.windowTop=c.windowTop),c.windowBottom&&(e.windowBottom=c.windowBottom),c.windowHeight&&(e.windowHeight=c.windowHeight),c.statusBarHeight&&(e.statusBarHeight=c.statusBarHeight),e.mescroll.setBodyHeight(c.windowHeight),e.mescroll.resetScrollTo((function(o,n){if(e.scrollAnim=0!==n,"string"!==typeof o){var i=e.mescroll.getScrollTop();0===n||300===n?(e.scrollTop=i,e.$nextTick((function(){e.scrollTop=o}))):e.mescroll.getStep(i,o,(function(t){e.scrollTop=t}),n)}else e.getClientInfo((function(n){var i,r=n.top;-1==o.indexOf("#")&&-1==o.indexOf(".")?i="#"+o:(i=o,-1!=o.indexOf(">>>")&&(i=o.split(">>>")[1].trim())),uni.createSelectorQuery().select(i).boundingClientRect((function(o){if(o){var n=e.mescroll.getScrollTop(),a=o.top-r;a+=n,e.isFixed||(a-=e.numTop),e.scrollTop=n,e.$nextTick((function(){e.scrollTop=a}))}else t("error",i+" does not exist"," at uni_modules/mescroll-uni/components/mescroll-uni/mescroll-uni.vue:419")})).exec()}))})),e.up&&e.up.toTop&&null!=e.up.toTop.safearea||(e.mescroll.optUp.toTop.safearea=e.safearea),uni.$on("setMescrollGlobalOption",(function(t){if(t){var o=t.i18n?t.i18n.type:null;if(o&&e.mescroll.i18n.type!=o&&(e.mescroll.i18n.type=o,a.default.setType(o),i.default.extend(t,e.mescroll.i18n[o])),t.down){var n=i.default.extend({},t.down);e.mescroll.optDown=i.default.extend(n,e.mescroll.optDown)}if(t.up){var r=i.default.extend({},t.up);e.mescroll.optUp=i.default.extend(r,e.mescroll.optUp)}}}))},mounted:function(){this.setClientHeight()},destroyed:function(){uni.$off("setMescrollGlobalOption")}};e.default=c}).call(this,o("0de9")["log"])},"1ed1":function(t,e,o){"use strict";o.r(e);var n=o("6f91"),i=o.n(n);for(var r in n)["default"].indexOf(r)<0&&function(t){o.d(e,t,(function(){return n[t]}))}(r);e["default"]=i.a},"261d":function(t,e,o){var n=o("81e6");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var i=o("4f06").default;i("ccc8391a",n,!0,{sourceMap:!1,shadowMode:!1})},"2c76":function(t,e,o){"use strict";o.r(e);var n=o("baa8"),i=o.n(n);for(var r in n)["default"].indexOf(r)<0&&function(t){o.d(e,t,(function(){return n[t]}))}(r);e["default"]=i.a},"4f37":function(t,e,o){"use strict";o.r(e);var n=o("acfc"),i=o("2c76");for(var r in i)["default"].indexOf(r)<0&&function(t){o.d(e,t,(function(){return i[t]}))}(r);var a=o("6454");for(var r in a)["default"].indexOf(r)<0&&function(t){o.d(e,t,(function(){return a[t]}))}(r);o("db3e");var l=o("f0c5"),s=o("c1f4");i["default"].__module="renderBiz";var c=Object(l["a"])(a["default"],n["b"],n["c"],!1,null,"bf10df54",null,!1,n["a"],i["default"]);"function"===typeof s["a"]&&Object(s["a"])(c),e["default"]=c.exports},6454:function(t,e,o){"use strict";o.r(e);var n=o("0b94"),i=o.n(n);for(var r in n)["default"].indexOf(r)<0&&function(t){o.d(e,t,(function(){return n[t]}))}(r);e["default"]=i.a},"6e40":function(t,e,o){"use strict";var n=o("261d"),i=o.n(n);i.a},"6f91":function(t,e,o){"use strict";o("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,o("a9e3"),o("e25e");var n={props:{height:{type:[String,Number],default:44},iconType:{type:String,default:"ri-arrow-left-s-line"},iconSize:{type:[String,Number],default:50},iconColor:{type:String,default:"#ddba82"},fontSize:{type:[String,Number],default:32},fontColor:{type:[String],default:"#ddba82"},title:{type:String,default:""},rightText:{type:String,default:""},bgColor:{type:String,default:"#1e1e1e"},placeholder:{type:Boolean,default:!0},fixed:{type:Boolean,default:!0},border:{type:Boolean,default:!1},borderColor:{type:String,default:"#000000"},autoBack:{type:Boolean,default:!0},Color:{type:Boolean,default:!1},scrollTop:{type:Number,default:0},isGradualChange:{type:Boolean,default:!1}},name:"navigationBar",data:function(){return{opacity:0}},created:function(){},computed:{rgba:function(){var t=[],e=this.$tool.rgba(this.bgColor);return t[0]=parseInt(e[1],16),t[1]=parseInt(e[2],16),t[2]=parseInt(e[3],16),t}},watch:{scrollTop:{immediate:!0,handler:function(){this.fixed&&this.isGradualChange&&(0==this.scrollTop?this.opacity=0:this.scrollTop>this.height?this.opacity=1:this.opacity=this.scrollTop/this.height)}},isGradualChange:{immediate:!0,handler:function(){this.isGradualChange&&(this.opacity=0),this.isGradualChange||(this.opacity=1)}}},methods:{leftClick:function(){this.autoBack?this.$Router.back():this.$emit("leftClick")},rightClick:function(){this.$emit("rightClick")}}};e.default=n},"81e6":function(t,e,o){var n=o("24fb");e=n(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.navbar--fixed[data-v-f655fec0]{position:fixed;top:0;left:0;z-index:11}.navbar--fixed--center[data-v-f655fec0]{flex:1;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;text-align:center}',""]),t.exports=e},"89a3":function(t,e,o){"use strict";o.r(e);var n=o("e333"),i=o("1ed1");for(var r in i)["default"].indexOf(r)<0&&function(t){o.d(e,t,(function(){return i[t]}))}(r);o("6e40");var a=o("f0c5"),l=Object(a["a"])(i["default"],n["b"],n["c"],!1,null,"f655fec0",null,!1,n["a"],void 0);e["default"]=l.exports},"8f64":function(t,e,o){var n=o("24fb");e=n(!1),e.push([t.i,".mescroll-uni-warp[data-v-bf10df54]{height:100%}.mescroll-uni-content[data-v-bf10df54]{height:100%}.mescroll-uni[data-v-bf10df54]{position:relative;width:100%;height:100%;min-height:%?200?%;overflow-y:auto;box-sizing:border-box /* 避免设置padding出现双滚动条的问题 */}\r\n\r\n/* 定位的方式固定高度 */.mescroll-uni-fixed[data-v-bf10df54]{z-index:1;position:fixed;top:0;left:0;right:0;bottom:0;width:auto; /* 使right生效 */height:auto /* 使bottom生效 */}\r\n\r\n/* 适配 iPhoneX */@supports (bottom:constant(safe-area-inset-bottom)) or (bottom:env(safe-area-inset-bottom)){.mescroll-safearea[data-v-bf10df54]{padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}}\r\n\r\n/* 下拉刷新区域 */.mescroll-downwarp[data-v-bf10df54]{position:absolute;top:-100%;left:0;width:100%;height:100%;text-align:center}\r\n\r\n/* 下拉刷新--内容区,定位于区域底部 */.mescroll-downwarp .downwarp-content[data-v-bf10df54]{position:absolute;left:0;bottom:0;width:100%;min-height:%?60?%;padding:%?20?% 0;text-align:center}\r\n\r\n/* 下拉刷新--提示文本 */.mescroll-downwarp .downwarp-tip[data-v-bf10df54]{display:inline-block;font-size:%?28?%;vertical-align:middle;margin-left:%?16?%\r\n\t/* color: gray; 已在style设置color,此处删去*/}\r\n\r\n/* 下拉刷新--旋转进度条 */.mescroll-downwarp .downwarp-progress[data-v-bf10df54]{display:inline-block;width:%?32?%;height:%?32?%;border-radius:50%;border:%?2?% solid grey;border-bottom-color:transparent!important; /*已在style设置border-color,此处需加 !important*/vertical-align:middle}\r\n\r\n/* 旋转动画 */.mescroll-downwarp .mescroll-rotate[data-v-bf10df54]{-webkit-animation:mescrollDownRotate-data-v-bf10df54 .6s linear infinite;animation:mescrollDownRotate-data-v-bf10df54 .6s linear infinite}@-webkit-keyframes mescrollDownRotate-data-v-bf10df54{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(1turn);transform:rotate(1turn)}}@keyframes mescrollDownRotate-data-v-bf10df54{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(1turn);transform:rotate(1turn)}}\r\n\r\n/* 上拉加载区域 */.mescroll-upwarp[data-v-bf10df54]{box-sizing:border-box;min-height:%?110?%;padding:%?30?% 0;text-align:center;clear:both}\r\n\r\n/*提示文本 */.mescroll-upwarp .upwarp-tip[data-v-bf10df54],\r\n.mescroll-upwarp .upwarp-nodata[data-v-bf10df54]{display:inline-block;font-size:%?28?%;vertical-align:middle\r\n\t/* color: gray; 已在style设置color,此处删去*/}.mescroll-upwarp .upwarp-tip[data-v-bf10df54]{margin-left:%?16?%}\r\n\r\n/*旋转进度条 */.mescroll-upwarp .upwarp-progress[data-v-bf10df54]{display:inline-block;width:%?32?%;height:%?32?%;border-radius:50%;border:%?2?% solid grey;border-bottom-color:transparent!important; /*已在style设置border-color,此处需加 !important*/vertical-align:middle}\r\n\r\n/* 旋转动画 */.mescroll-upwarp .mescroll-rotate[data-v-bf10df54]{-webkit-animation:mescrollUpRotate-data-v-bf10df54 .6s linear infinite;animation:mescrollUpRotate-data-v-bf10df54 .6s linear infinite}@-webkit-keyframes mescrollUpRotate-data-v-bf10df54{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(1turn);transform:rotate(1turn)}}@keyframes mescrollUpRotate-data-v-bf10df54{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(1turn);transform:rotate(1turn)}}",""]),t.exports=e},acfc:function(t,e,o){"use strict";o.d(e,"b",(function(){return i})),o.d(e,"c",(function(){return r})),o.d(e,"a",(function(){return n}));var n={mescrollEmpty:o("18aa").default},i=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("v-uni-view",{staticClass:"mescroll-uni-warp"},[o("v-uni-scroll-view",{staticClass:"mescroll-uni",class:{"mescroll-uni-fixed":t.isFixed},style:{height:t.scrollHeight,"padding-top":t.padTop,"padding-bottom":t.padBottom,top:t.fixedTop,bottom:t.fixedBottom},attrs:{id:t.viewId,"scroll-top":t.scrollTop,"scroll-with-animation":t.scrollAnim,"scroll-y":t.scrollable,"enable-back-to-top":!0,throttle:!1},on:{scroll:function(e){arguments[0]=e=t.$handleEvent(e),t.scroll.apply(void 0,arguments)}}},[o("v-uni-view",{wxsProps:{"change:prop":"wxsProp"},staticClass:"mescroll-uni-content mescroll-render-touch",attrs:{"change:prop":t.wxsBiz.propObserver,prop:t.wxsProp},on:{touchstart:function(e){e=t.$handleWxsEvent(e),t.wxsBiz.touchstartEvent(e,t.$getComponentDescriptor())},touchmove:function(e){e=t.$handleWxsEvent(e),t.wxsBiz.touchmoveEvent(e,t.$getComponentDescriptor())},touchend:function(e){e=t.$handleWxsEvent(e),t.wxsBiz.touchendEvent(e,t.$getComponentDescriptor())},touchcancel:function(e){e=t.$handleWxsEvent(e),t.wxsBiz.touchendEvent(e,t.$getComponentDescriptor())}}},[t.topbar&&t.statusBarHeight?o("v-uni-view",{staticClass:"mescroll-topbar",style:{height:t.statusBarHeight+"px",background:t.topbar}}):t._e(),o("v-uni-view",{wxsProps:{"change:prop":"callProp"},staticClass:"mescroll-wxs-content",style:{transform:t.translateY,transition:t.transition},attrs:{"change:prop":t.wxsBiz.callObserver,prop:t.callProp}},[t.mescroll.optDown.use?o("v-uni-view",{staticClass:"mescroll-downwarp",style:{background:t.mescroll.optDown.bgColor,color:t.mescroll.optDown.textColor}},[o("v-uni-view",{staticClass:"downwarp-content"},[o("v-uni-view",{staticClass:"downwarp-progress mescroll-wxs-progress",class:{"mescroll-rotate":t.isDownLoading},style:{"border-color":t.mescroll.optDown.textColor,transform:t.downRotate}}),o("v-uni-view",{staticClass:"downwarp-tip"},[t._v(t._s(t.downText))])],1)],1):t._e(),t._t("default"),t.isShowEmpty?o("mescroll-empty",{attrs:{option:t.mescroll.optUp.empty},on:{emptyclick:function(e){arguments[0]=e=t.$handleEvent(e),t.emptyClick.apply(void 0,arguments)}}}):t._e(),t.mescroll.optUp.use&&!t.isDownLoading&&3!==t.upLoadType?o("v-uni-view",{staticClass:"mescroll-upwarp",style:{background:t.mescroll.optUp.bgColor,color:t.mescroll.optUp.textColor}},[o("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:1===t.upLoadType,expression:"upLoadType===1"}]},[o("v-uni-view",{staticClass:"upwarp-progress mescroll-rotate",style:{"border-color":t.mescroll.optUp.textColor}}),o("v-uni-view",{staticClass:"upwarp-tip"},[t._v(t._s(t.mescroll.optUp.textLoading))])],1),2===t.upLoadType?o("v-uni-view",{staticClass:"upwarp-nodata"},[t._v(t._s(t.mescroll.optUp.textNoMore))]):t._e()],1):t._e()],2),t.bottombar&&t.windowBottom>0?o("v-uni-view",{staticClass:"mescroll-bottombar",style:{height:t.windowBottom+"px"}}):t._e(),t.safearea?o("v-uni-view",{staticClass:"mescroll-safearea"}):t._e()],1)],1),o("mescroll-top",{attrs:{option:t.mescroll.optUp.toTop},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toTopClick.apply(void 0,arguments)}},model:{value:t.isShowToTop,callback:function(e){t.isShowToTop=e},expression:"isShowToTop"}}),o("v-uni-view",{wxsProps:{"change:prop":"wxsProp"},attrs:{"change:prop":t.renderBiz.propObserver,prop:t.wxsProp}})],1)},r=[]},baa8:function(t,e,o){"use strict";o("7a82");var n=o("4ea4").default;Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i=n(o("2b4b")),r={mixins:[i.default]};e.default=r},c1f4:function(t,e,o){"use strict";e["a"]=function(t){(t.options.wxs||(t.options.wxs={}))["wxsBiz"]=function(t){var e={};function o(t,o){if(e.isMoveDown)e.downHight>=e.optDown.offset?(e.downHight=e.optDown.offset,e.callMethod(o,{type:"triggerDownScroll"})):(e.downHight=0,e.callMethod(o,{type:"endDownScroll"})),e.movetype=0,e.isMoveDown=!1;else if(!e.isScrollBody&&e.getScrollTop()===e.startTop){var n=e.getPoint(t).y-e.startPoint.y<0;if(n){var i=e.getAngle(e.getPoint(t),e.startPoint);i>80&&e.callMethod(o,{type:"triggerUpScroll"})}}e.callMethod(o,{type:"setWxsProp"})}return e.onMoving=function(t,e,o){t.requestAnimationFrame((function(){t.selectComponent(".mescroll-wxs-content").setStyle({"will-change":"transform",transform:"translateY("+o+"px)",transition:""});var n=t.selectComponent(".mescroll-wxs-progress");n&&n.setStyle({transform:"rotate("+360*e+"deg)"})}))},e.showLoading=function(t){e.downHight=e.optDown.offset,t.requestAnimationFrame((function(){t.selectComponent(".mescroll-wxs-content").setStyle({"will-change":"auto",transform:"translateY("+e.downHight+"px)",transition:"transform 300ms"})}))},e.endDownScroll=function(t){e.downHight=0,e.isDownScrolling=!1,t.requestAnimationFrame((function(){t.selectComponent(".mescroll-wxs-content").setStyle({"will-change":"auto",transform:"translateY(0)",transition:"transform 300ms"})}))},e.clearTransform=function(t){t.requestAnimationFrame((function(){t.selectComponent(".mescroll-wxs-content").setStyle({"will-change":"",transform:"",transition:""})}))},e.disabled=function(){return!e.optDown||!e.optDown.use||e.optDown.native},e.getPoint=function(t){return t?t.touches&&t.touches[0]?{x:t.touches[0].pageX,y:t.touches[0].pageY}:t.changedTouches&&t.changedTouches[0]?{x:t.changedTouches[0].pageX,y:t.changedTouches[0].pageY}:{x:t.clientX,y:t.clientY}:{x:0,y:0}},e.getAngle=function(t,e){var o=Math.abs(t.x-e.x),n=Math.abs(t.y-e.y),i=Math.sqrt(o*o+n*n),r=0;return 0!==i&&(r=Math.asin(n/i)/Math.PI*180),r},e.getScrollTop=function(){return e.scrollTop||0},e.getBodyHeight=function(){return e.bodyHeight||0},e.callMethod=function(t,e){t&&t.callMethod("wxsCall",e)},t.exports={propObserver:function(t){e.optDown=t.optDown,e.scrollTop=t.scrollTop,e.bodyHeight=t.bodyHeight,e.isDownScrolling=t.isDownScrolling,e.isUpScrolling=t.isUpScrolling,e.isUpBoth=t.isUpBoth,e.isScrollBody=t.isScrollBody,e.startTop=t.scrollTop},callObserver:function(t,o,n){e.disabled()||t.callType&&("showLoading"===t.callType?e.showLoading(n):"endDownScroll"===t.callType?e.endDownScroll(n):"clearTransform"===t.callType&&e.clearTransform(n))},touchstartEvent:function(t,o){e.downHight=0,e.startPoint=e.getPoint(t),e.startTop=e.getScrollTop(),e.startAngle=0,e.lastPoint=e.startPoint,e.maxTouchmoveY=e.getBodyHeight()-e.optDown.bottomOffset,e.inTouchend=!1,e.callMethod(o,{type:"setWxsProp"})},touchmoveEvent:function(t,n){var i=!0;if(e.disabled())return i;var r=e.getScrollTop(),a=e.getPoint(t),l=a.y-e.startPoint.y;if(l>0&&(e.isScrollBody&&r<=0||!e.isScrollBody&&(r<=0||r<=e.optDown.startTop&&r===e.startTop))&&!e.inTouchend&&!e.isDownScrolling&&!e.optDown.isLock&&(!e.isUpScrolling||e.isUpScrolling&&e.isUpBoth)){if(e.startAngle||(e.startAngle=e.getAngle(e.lastPoint,a)),e.startAngle<e.optDown.minAngle)return i;if(e.maxTouchmoveY>0&&a.y>=e.maxTouchmoveY)return e.inTouchend=!0,o(t,n),i;i=!1;var s=a.y-e.lastPoint.y;e.downHight<e.optDown.offset?(1!==e.movetype&&(e.movetype=1,e.callMethod(n,{type:"setLoadType",downLoadType:1}),e.isMoveDown=!0),e.downHight+=s*e.optDown.inOffsetRate):(2!==e.movetype&&(e.movetype=2,e.callMethod(n,{type:"setLoadType",downLoadType:2}),e.isMoveDown=!0),e.downHight+=s>0?s*e.optDown.outOffsetRate:s),e.downHight=Math.round(e.downHight);var c=e.downHight/e.optDown.offset;e.onMoving(n,c,e.downHight)}return e.lastPoint=a,i},touchendEvent:o},t.exports}({exports:{}})}},db3e:function(t,e,o){"use strict";var n=o("edd1"),i=o.n(n);i.a},e333:function(t,e,o){"use strict";o.d(e,"b",(function(){return n})),o.d(e,"c",(function(){return i})),o.d(e,"a",(function(){}));var n=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("v-uni-view",{staticClass:"navbar"},[t.fixed&&t.placeholder?o("v-uni-view",{style:[{height:Number(t.$statusBarHeight+t.height)+"px"}]}):t._e(),o("v-uni-view",{class:[t.fixed&&"navbar--fixed","wid-100"],style:[{background:"rgba("+t.rgba[0]+","+t.rgba[1]+","+t.rgba[2]+","+t.opacity+")"}]},[o("v-uni-view",{style:[{height:t.$statusBarHeight+"px"}]}),o("v-uni-view",{staticClass:"flex flex-y-center flex-x-between plr-32",style:[{height:t.height+"px","border-bottom":t.border?"2rpx solid"+t.borderColor:"","font-size":t.fontSize+"rpx",color:t.fontColor}]},[o("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.leftClick.apply(void 0,arguments)}}},[t._t("left",[o("v-uni-view",{class:[t.iconType],style:[{"font-size":t.iconSize+"rpx",color:t.iconColor}]})])],2),o("v-uni-view",{staticClass:"navbar--fixed--center fontWei-600"},[t._t("center",[t._v(t._s(t.title))])],2),o("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.rightClick.apply(void 0,arguments)}}},[t._t("right",[t._v(t._s(t.rightText))])],2)],1)],1)],1)},i=[]},edd1:function(t,e,o){var n=o("8f64");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var i=o("4f06").default;i("4f0c1f87",n,!0,{sourceMap:!1,shadowMode:!1})}}]);