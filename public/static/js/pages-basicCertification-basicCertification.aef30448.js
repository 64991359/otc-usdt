(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-basicCertification-basicCertification"],{"1ed1":function(t,e,i){"use strict";i.r(e);var n=i("6f91"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(o);e["default"]=a.a},"261d":function(t,e,i){var n=i("81e6");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=i("4f06").default;a("ccc8391a",n,!0,{sourceMap:!1,shadowMode:!1})},"356d":function(t,e,i){"use strict";i.r(e);var n=i("b34e"),a=i("a91d");for(var o in a)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(o);var r=i("f0c5"),s=Object(r["a"])(a["default"],n["b"],n["c"],!1,null,"564f0916",null,!1,n["a"],void 0);e["default"]=s.exports},"6e40":function(t,e,i){"use strict";var n=i("261d"),a=i.n(n);a.a},"6f91":function(t,e,i){"use strict";i("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("a9e3"),i("e25e");var n={props:{height:{type:[String,Number],default:44},iconType:{type:String,default:"ri-arrow-left-s-line"},iconSize:{type:[String,Number],default:50},iconColor:{type:String,default:"#ddba82"},fontSize:{type:[String,Number],default:32},fontColor:{type:[String],default:"#ddba82"},title:{type:String,default:""},rightText:{type:String,default:""},bgColor:{type:String,default:"#1e1e1e"},placeholder:{type:Boolean,default:!0},fixed:{type:Boolean,default:!0},border:{type:Boolean,default:!1},borderColor:{type:String,default:"#000000"},autoBack:{type:Boolean,default:!0},Color:{type:Boolean,default:!1},scrollTop:{type:Number,default:0},isGradualChange:{type:Boolean,default:!1}},name:"navigationBar",data:function(){return{opacity:0}},created:function(){},computed:{rgba:function(){var t=[],e=this.$tool.rgba(this.bgColor);return t[0]=parseInt(e[1],16),t[1]=parseInt(e[2],16),t[2]=parseInt(e[3],16),t}},watch:{scrollTop:{immediate:!0,handler:function(){this.fixed&&this.isGradualChange&&(0==this.scrollTop?this.opacity=0:this.scrollTop>this.height?this.opacity=1:this.opacity=this.scrollTop/this.height)}},isGradualChange:{immediate:!0,handler:function(){this.isGradualChange&&(this.opacity=0),this.isGradualChange||(this.opacity=1)}}},methods:{leftClick:function(){this.autoBack?this.$Router.back():this.$emit("leftClick")},rightClick:function(){this.$emit("rightClick")}}};e.default=n},"81e6":function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.navbar--fixed[data-v-f655fec0]{position:fixed;top:0;left:0;z-index:11}.navbar--fixed--center[data-v-f655fec0]{flex:1;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;text-align:center}',""]),t.exports=e},"89a3":function(t,e,i){"use strict";i.r(e);var n=i("e333"),a=i("1ed1");for(var o in a)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(o);i("6e40");var r=i("f0c5"),s=Object(r["a"])(a["default"],n["b"],n["c"],!1,null,"f655fec0",null,!1,n["a"],void 0);e["default"]=s.exports},a91d:function(t,e,i){"use strict";i.r(e);var n=i("d97c"),a=i.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(o);e["default"]=a.a},b34e:function(t,e,i){"use strict";i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return n}));var n={navigationBar:i("89a3").default},a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",[i("navigationBar",{attrs:{title:t.title}}),i("v-uni-view",{staticClass:"mlr-32 font-28 c_ddba82"},[i("v-uni-view",{staticClass:"mt-30 c_888683"},[t._v("地区")]),i("v-uni-view",{staticClass:"flex flex-x-between flex-y-center mt-30 pb-15",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toAreaCode.apply(void 0,arguments)}}},[i("v-uni-view",[t._v(t._s(t.city))]),i("v-uni-view",{staticClass:"ri-arrow-right-line"})],1),i("v-uni-view",{staticClass:"mt-30 c_888683"},[t._v("姓名")]),i("v-uni-textarea",{staticClass:"font-28 mt-20 bor-b-2 pb-20 wid-100",attrs:{"auto-height":"true",placeholder:"请输入您的真实姓名"},model:{value:t.name,callback:function(e){t.name=e},expression:"name"}}),i("v-uni-view",{staticClass:"mt-30 c_888683"},[t._v("姓名只允许输入汉字和空格，姓名中有特殊字符请用空格代替")]),i("v-uni-view",{staticClass:"mt-30 c_888683"},[t._v("身份证号码")]),i("v-uni-textarea",{staticClass:"font-28 mt-20 bor-b-2 pb-20 wid-100",attrs:{"auto-height":"true",placeholder:"请输入您的身份证号码"},model:{value:t.haoma,callback:function(e){t.haoma=e},expression:"haoma"}}),i("v-uni-view",{staticClass:"flex flex-x-center ptb-20 mt-30 b_ddba82 c_000000 borRadius-12",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.submit.apply(void 0,arguments)}}},[t._v("提交")])],1)],1)},o=[]},d97c:function(t,e,i){"use strict";(function(t){i("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("e9c4");i("c882");var n={data:function(){return{title:"基础认证",disabled:!0,city:"选择地区",name:"",haoma:"",isEdit:!1}},onShow:function(){"{}"!==JSON.stringify(this.$Route.query)&&(this.isEdit=!0,this.disabled=!1,this.city=this.$Route.query.country,this.name=this.$Route.query.true_name,this.haoma=this.$Route.query.id_no,this.title="更改身份信息")},onLoad:function(){var t=this;uni.$on("cityCode",(function(e){t.city=e.city}))},onUnload:function(){uni.$off("cityCode")},methods:{submit:function(){this.isEdit?this.renzheng3():this.renzheng1()},toAreaCode:function(){this.disabled&&this.$Router.push({name:"areaCode"})},renzheng1:function(){var e=this;this.$api.renzheng1({uid:this.uid,guojia:this.city,name:this.name,haoma:this.haoma}).then((function(t){uni.showToast({title:t.data.message,icon:"none",success:function(){1==t.data.status&&(e.userinfo.renzheng1=t.data.result.renzheng1,setTimeout((function(){e.$Router.back()}),1e3))}})})).catch((function(e){t("log",e," at pages/basicCertification/basicCertification.vue:90")}))},renzheng3:function(){var e=this;this.$api.renzheng3({id:this.$Route.query.id,uid:this.uid,guojia:this.city,name:this.name,haoma:this.haoma}).then((function(t){uni.showToast({title:t.data.message,icon:"none",success:function(){1==t.data.status&&(e.userinfo.renzheng1=t.data.result.renzheng1,setTimeout((function(){e.$Router.back()}),1e3))}})})).catch((function(e){t("log",e," at pages/basicCertification/basicCertification.vue:115")}))}}};e.default=n}).call(this,i("0de9")["log"])},e333:function(t,e,i){"use strict";i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return a})),i.d(e,"a",(function(){}));var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"navbar"},[t.fixed&&t.placeholder?i("v-uni-view",{style:[{height:Number(t.$statusBarHeight+t.height)+"px"}]}):t._e(),i("v-uni-view",{class:[t.fixed&&"navbar--fixed","wid-100"],style:[{background:"rgba("+t.rgba[0]+","+t.rgba[1]+","+t.rgba[2]+","+t.opacity+")"}]},[i("v-uni-view",{style:[{height:t.$statusBarHeight+"px"}]}),i("v-uni-view",{staticClass:"flex flex-y-center flex-x-between plr-32",style:[{height:t.height+"px","border-bottom":t.border?"2rpx solid"+t.borderColor:"","font-size":t.fontSize+"rpx",color:t.fontColor}]},[i("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.leftClick.apply(void 0,arguments)}}},[t._t("left",[i("v-uni-view",{class:[t.iconType],style:[{"font-size":t.iconSize+"rpx",color:t.iconColor}]})])],2),i("v-uni-view",{staticClass:"navbar--fixed--center fontWei-600"},[t._t("center",[t._v(t._s(t.title))])],2),i("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.rightClick.apply(void 0,arguments)}}},[t._t("right",[t._v(t._s(t.rightText))])],2)],1)],1)],1)},a=[]}}]);