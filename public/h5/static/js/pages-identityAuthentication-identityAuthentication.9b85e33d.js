(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-identityAuthentication-identityAuthentication"],{"1ed1":function(t,e,n){"use strict";n.r(e);var i=n("6f91"),a=n.n(i);for(var r in i)["default"].indexOf(r)<0&&function(t){n.d(e,t,(function(){return i[t]}))}(r);e["default"]=a.a},"23d4":function(t,e,n){"use strict";var i=n("f41a"),a=n.n(i);a.a},"261d":function(t,e,n){var i=n("81e6");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=n("4f06").default;a("ccc8391a",i,!0,{sourceMap:!1,shadowMode:!1})},"3be1":function(t,e,n){"use strict";n.r(e);var i=n("5928"),a=n("8fdf");for(var r in a)["default"].indexOf(r)<0&&function(t){n.d(e,t,(function(){return a[t]}))}(r);n("23d4");var o=n("f0c5"),s=Object(o["a"])(a["default"],i["b"],i["c"],!1,null,"7a4d38d8",null,!1,i["a"],void 0);e["default"]=s.exports},5928:function(t,e,n){"use strict";n.d(e,"b",(function(){return a})),n.d(e,"c",(function(){return r})),n.d(e,"a",(function(){return i}));var i={navigationBar:n("89a3").default},a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",[n("navigationBar",{attrs:{title:"身份认证"}}),n("v-uni-view",{staticClass:"mlr-32"},[n("v-uni-view",{staticClass:"mt-20 borRadius-12 plr-32  ptb-30 b_2d2c2b c_ddba82"},[n("v-uni-view",{staticClass:"flex flex-x-center"},[t._v("基础认证")]),0==t.userinfo.renzheng1?n("v-uni-view",{staticClass:"flex flex-x-center  c_000000 b_ddba82 borRadius-12 ptb-20 mt-50",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toBasicCertification()}}},[t._v("去认证")]):2==t.userinfo.renzheng1?n("v-uni-view",{staticClass:"flex flex-x-center b_ddba82 borRadius-12 c_000000 ptb-20 mt-50"},[t._v("审核中")]):n("v-uni-view",[n("v-uni-view",{staticClass:"flex flex-x-between ptb-20 bor-b-2"},[n("v-uni-view",{staticClass:"c_888683"},[t._v("地区")]),n("v-uni-view",[t._v(t._s(t.identityInformation.country))])],1),n("v-uni-view",{staticClass:"flex flex-x-between ptb-20 bor-b-2"},[n("v-uni-view",{staticClass:"c_888683"},[t._v("姓名")]),n("v-uni-view",[t._v(t._s(t.identityInformation.true_name))])],1),n("v-uni-view",{staticClass:"flex flex-x-between ptb-20 bor-b-2"},[n("v-uni-view",{staticClass:"c_888683"},[t._v("身份证号")]),n("v-uni-view",[t._v(t._s(t.identityInformation.id_no))])],1),n("v-uni-view",{staticClass:"flex flex-x-center pt-30 c_888683"},[t._v("填写有误？"),n("v-uni-label",{staticClass:"c_ddba82",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toBasicCertification(t.identityInformation)}}},[t._v("更改")])],1)],1)],1),n("v-uni-view",{staticClass:"mt-20 borRadius-12 plr-32 ptb-30 b_2d2c2b"},[n("v-uni-view",{staticClass:"flex flex-x-center mb-30 c_ddba82"},[t._v("高级认证")]),1==t.userinfo.renzheng2?n("v-uni-view",{staticClass:"flex flex-x-center b_ddba82 borRadius-12 c_000000 ptb-20 mt-50",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toShootingIDCard.apply(void 0,arguments)}}},[t._v("已认证")]):2==t.userinfo.renzheng2?n("v-uni-view",{staticClass:"flex flex-x-center b_ddba82 borRadius-12 c_000000 ptb-20 mt-50"},[t._v("审核中")]):n("v-uni-view",[n("v-uni-view",{staticClass:"c_ff6060"},[t._v("1.拍摄身份证件照")]),n("v-uni-view",{staticClass:"mt-20 c_888683"},[t._v("2.人脸识别验证")]),n("v-uni-view",{staticClass:"flex flex-x-center c_000000 b_ddba82 borRadius-12 pt-20 pb-20 mt-50",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toShootingIDCard.apply(void 0,arguments)}}},[t._v("拍摄身份证件照")])],1)],1)],1)],1)},r=[]},"5ad2":function(t,e,n){"use strict";(function(t){n("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={data:function(){return{identityInformation:{}}},onShow:function(){this.getIdrzInfo()},methods:{toBasicCertification:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};this.$Router.push({name:"basicCertification",params:t})},getIdrzInfo:function(){var e=this;this.$api.getIdrzInfo({uid:this.uid}).then((function(t){uni.showToast({title:t.data.message,icon:"none",success:function(){1==t.data.status&&(e.identityInformation=t.data.result,e.userinfo.renzheng1=t.data.result.renzheng1,e.userinfo.renzheng2=t.data.result.renzheng2)}})})).catch((function(e){t("log",e," at pages/identityAuthentication/identityAuthentication.vue:75")}))}}};e.default=i}).call(this,n("0de9")["log"])},"6e40":function(t,e,n){"use strict";var i=n("261d"),a=n.n(i);a.a},"6f91":function(t,e,n){"use strict";n("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,n("a9e3"),n("e25e");var i={props:{height:{type:[String,Number],default:44},iconType:{type:String,default:"ri-arrow-left-s-line"},iconSize:{type:[String,Number],default:50},iconColor:{type:String,default:"#ddba82"},fontSize:{type:[String,Number],default:32},fontColor:{type:[String],default:"#ddba82"},title:{type:String,default:""},rightText:{type:String,default:""},bgColor:{type:String,default:"#1e1e1e"},placeholder:{type:Boolean,default:!0},fixed:{type:Boolean,default:!0},border:{type:Boolean,default:!1},borderColor:{type:String,default:"#000000"},autoBack:{type:Boolean,default:!0},Color:{type:Boolean,default:!1},scrollTop:{type:Number,default:0},isGradualChange:{type:Boolean,default:!1}},name:"navigationBar",data:function(){return{opacity:0}},created:function(){},computed:{rgba:function(){var t=[],e=this.$tool.rgba(this.bgColor);return t[0]=parseInt(e[1],16),t[1]=parseInt(e[2],16),t[2]=parseInt(e[3],16),t}},watch:{scrollTop:{immediate:!0,handler:function(){this.fixed&&this.isGradualChange&&(0==this.scrollTop?this.opacity=0:this.scrollTop>this.height?this.opacity=1:this.opacity=this.scrollTop/this.height)}},isGradualChange:{immediate:!0,handler:function(){this.isGradualChange&&(this.opacity=0),this.isGradualChange||(this.opacity=1)}}},methods:{leftClick:function(){this.autoBack?this.$Router.back():this.$emit("leftClick")},rightClick:function(){this.$emit("rightClick")}}};e.default=i},"81e6":function(t,e,n){var i=n("24fb");e=i(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.navbar--fixed[data-v-f655fec0]{position:fixed;top:0;left:0;z-index:11}.navbar--fixed--center[data-v-f655fec0]{flex:1;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;text-align:center}',""]),t.exports=e},"89a3":function(t,e,n){"use strict";n.r(e);var i=n("e333"),a=n("1ed1");for(var r in a)["default"].indexOf(r)<0&&function(t){n.d(e,t,(function(){return a[t]}))}(r);n("6e40");var o=n("f0c5"),s=Object(o["a"])(a["default"],i["b"],i["c"],!1,null,"f655fec0",null,!1,i["a"],void 0);e["default"]=s.exports},"8fdf":function(t,e,n){"use strict";n.r(e);var i=n("5ad2"),a=n.n(i);for(var r in i)["default"].indexOf(r)<0&&function(t){n.d(e,t,(function(){return i[t]}))}(r);e["default"]=a.a},"9f88":function(t,e,n){var i=n("24fb");e=i(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.bor-b-2[data-v-7a4d38d8]{border-bottom:%?2?% solid rgba(136,134,131,.1)}',""]),t.exports=e},e333:function(t,e,n){"use strict";n.d(e,"b",(function(){return i})),n.d(e,"c",(function(){return a})),n.d(e,"a",(function(){}));var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-uni-view",{staticClass:"navbar"},[t.fixed&&t.placeholder?n("v-uni-view",{style:[{height:Number(t.$statusBarHeight+t.height)+"px"}]}):t._e(),n("v-uni-view",{class:[t.fixed&&"navbar--fixed","wid-100"],style:[{background:"rgba("+t.rgba[0]+","+t.rgba[1]+","+t.rgba[2]+","+t.opacity+")"}]},[n("v-uni-view",{style:[{height:t.$statusBarHeight+"px"}]}),n("v-uni-view",{staticClass:"flex flex-y-center flex-x-between plr-32",style:[{height:t.height+"px","border-bottom":t.border?"2rpx solid"+t.borderColor:"","font-size":t.fontSize+"rpx",color:t.fontColor}]},[n("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.leftClick.apply(void 0,arguments)}}},[t._t("left",[n("v-uni-view",{class:[t.iconType],style:[{"font-size":t.iconSize+"rpx",color:t.iconColor}]})])],2),n("v-uni-view",{staticClass:"navbar--fixed--center fontWei-600"},[t._t("center",[t._v(t._s(t.title))])],2),n("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.rightClick.apply(void 0,arguments)}}},[t._t("right",[t._v(t._s(t.rightText))])],2)],1)],1)],1)},a=[]},f41a:function(t,e,n){var i=n("9f88");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=n("4f06").default;a("3b2aacaf",i,!0,{sourceMap:!1,shadowMode:!1})}}]);