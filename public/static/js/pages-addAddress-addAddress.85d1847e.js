(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-addAddress-addAddress"],{"086f":function(t,e,i){var n=i("6608");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var s=i("4f06").default;s("5dcbc808",n,!0,{sourceMap:!1,shadowMode:!1})},"1ed1":function(t,e,i){"use strict";i.r(e);var n=i("6f91"),s=i.n(n);for(var r in n)["default"].indexOf(r)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(r);e["default"]=s.a},"261d":function(t,e,i){var n=i("81e6");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var s=i("4f06").default;s("ccc8391a",n,!0,{sourceMap:!1,shadowMode:!1})},"3e89":function(t,e,i){"use strict";i.r(e);var n=i("ea63"),s=i.n(n);for(var r in n)["default"].indexOf(r)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(r);e["default"]=s.a},"438f":function(t,e,i){"use strict";var n=i("086f"),s=i.n(n);s.a},"544c":function(t,e,i){"use strict";i.r(e);var n=i("92cd"),s=i("3e89");for(var r in s)["default"].indexOf(r)<0&&function(t){i.d(e,t,(function(){return s[t]}))}(r);i("438f");var a=i("f0c5"),o=Object(a["a"])(s["default"],n["b"],n["c"],!1,null,"0e14ddaf",null,!1,n["a"],void 0);e["default"]=o.exports},6608:function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.bor-b[data-v-0e14ddaf]{border-bottom:%?2?% solid rgba(136,134,131,.1)}',""]),t.exports=e},"6e40":function(t,e,i){"use strict";var n=i("261d"),s=i.n(n);s.a},"6f91":function(t,e,i){"use strict";i("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("a9e3"),i("e25e");var n={props:{height:{type:[String,Number],default:44},iconType:{type:String,default:"ri-arrow-left-s-line"},iconSize:{type:[String,Number],default:50},iconColor:{type:String,default:"#ddba82"},fontSize:{type:[String,Number],default:32},fontColor:{type:[String],default:"#ddba82"},title:{type:String,default:""},rightText:{type:String,default:""},bgColor:{type:String,default:"#1e1e1e"},placeholder:{type:Boolean,default:!0},fixed:{type:Boolean,default:!0},border:{type:Boolean,default:!1},borderColor:{type:String,default:"#000000"},autoBack:{type:Boolean,default:!0},Color:{type:Boolean,default:!1},scrollTop:{type:Number,default:0},isGradualChange:{type:Boolean,default:!1}},name:"navigationBar",data:function(){return{opacity:0}},created:function(){},computed:{rgba:function(){var t=[],e=this.$tool.rgba(this.bgColor);return t[0]=parseInt(e[1],16),t[1]=parseInt(e[2],16),t[2]=parseInt(e[3],16),t}},watch:{scrollTop:{immediate:!0,handler:function(){this.fixed&&this.isGradualChange&&(0==this.scrollTop?this.opacity=0:this.scrollTop>this.height?this.opacity=1:this.opacity=this.scrollTop/this.height)}},isGradualChange:{immediate:!0,handler:function(){this.isGradualChange&&(this.opacity=0),this.isGradualChange||(this.opacity=1)}}},methods:{leftClick:function(){this.autoBack?this.$Router.back():this.$emit("leftClick")},rightClick:function(){this.$emit("rightClick")}}};e.default=n},"81e6":function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.navbar--fixed[data-v-f655fec0]{position:fixed;top:0;left:0;z-index:11}.navbar--fixed--center[data-v-f655fec0]{flex:1;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;text-align:center}',""]),t.exports=e},"89a3":function(t,e,i){"use strict";i.r(e);var n=i("e333"),s=i("1ed1");for(var r in s)["default"].indexOf(r)<0&&function(t){i.d(e,t,(function(){return s[t]}))}(r);i("6e40");var a=i("f0c5"),o=Object(a["a"])(s["default"],n["b"],n["c"],!1,null,"f655fec0",null,!1,n["a"],void 0);e["default"]=o.exports},"92cd":function(t,e,i){"use strict";i.d(e,"b",(function(){return s})),i.d(e,"c",(function(){return r})),i.d(e,"a",(function(){return n}));var n={navigationBar:i("89a3").default,uPopup:i("b80f").default},s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",[i("navigationBar",{attrs:{title:t.title}}),i("v-uni-view",{staticClass:"mlr-32"},[i("v-uni-view",{staticClass:"c_888683"},[t._v("币种")]),i("v-uni-view",{staticClass:"flex flex-y-center bor-b-2 pb-20 mt-20",class:[t.isEdit||t.isHome?"c_888683":"c_ddba82"],on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.open()}}},[i("v-uni-view",{staticClass:"ri-exchange-dollar-line mr-10"}),i("v-uni-view",{staticClass:"flex-1"},[t._v(t._s(t.list[t.currency]))]),i("v-uni-view",{staticClass:"ri-arrow-right-line"})],1),i("v-uni-view",{staticClass:"c_888683 mt-20"},[t._v("地址")]),i("v-uni-view",{staticClass:"flex mt-30 pb-20 flex-y-center c_ddba82 bor-b-2"},[i("v-uni-textarea",{staticClass:"flex-1",attrs:{"auto-height":"true",placeholder:"请输入收款地址"},model:{value:t.address,callback:function(e){t.address=e},expression:"address"}}),i("v-uni-view",{staticClass:"ri-qr-scan-2-line font-35 ml-10",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.scanCode.apply(void 0,arguments)}}})],1),i("v-uni-view",{staticClass:"c_888683 mt-20"},[t._v("备注")]),i("v-uni-textarea",{staticClass:"bor-b-2 pb-20 wid-100 c_ddba82 mt-20",attrs:{"auto-height":"true",placeholder:"请输入备注"},model:{value:t.beizhu,callback:function(e){t.beizhu=e},expression:"beizhu"}}),i("v-uni-view",{staticClass:"flex flex-x-center ptb-20 mt-30 b_ddba82 borRadius-12 c_000000",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.submit()}}},[t._v("确定")])],1),i("u-popup",{attrs:{round:"12",show:t.show},on:{close:function(e){arguments[0]=e=t.$handleEvent(e),t.close.apply(void 0,arguments)}}},[i("v-uni-view",{staticClass:"b_2d2c2b c_ddba82",staticStyle:{"border-radius":"12rpx 12rpx 0 0"}},[t._l(t.list,(function(e,n){return i("v-uni-view",{key:n,staticClass:"flex mlr-32 ptb-20 bor-b",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.changeCurrency(n)}}},[i("v-uni-view",[t._v(t._s(e))])],1)})),i("v-uni-view",{staticClass:"mlr-32 ptb-20 b_2d2c2b c_888683",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.close.apply(void 0,arguments)}}},[t._v("取消")])],2)],1)],1)},r=[]},e333:function(t,e,i){"use strict";i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return s})),i.d(e,"a",(function(){}));var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"navbar"},[t.fixed&&t.placeholder?i("v-uni-view",{style:[{height:Number(t.$statusBarHeight+t.height)+"px"}]}):t._e(),i("v-uni-view",{class:[t.fixed&&"navbar--fixed","wid-100"],style:[{background:"rgba("+t.rgba[0]+","+t.rgba[1]+","+t.rgba[2]+","+t.opacity+")"}]},[i("v-uni-view",{style:[{height:t.$statusBarHeight+"px"}]}),i("v-uni-view",{staticClass:"flex flex-y-center flex-x-between plr-32",style:[{height:t.height+"px","border-bottom":t.border?"2rpx solid"+t.borderColor:"","font-size":t.fontSize+"rpx",color:t.fontColor}]},[i("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.leftClick.apply(void 0,arguments)}}},[t._t("left",[i("v-uni-view",{class:[t.iconType],style:[{"font-size":t.iconSize+"rpx",color:t.iconColor}]})])],2),i("v-uni-view",{staticClass:"navbar--fixed--center fontWei-600"},[t._t("center",[t._v(t._s(t.title))])],2),i("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.rightClick.apply(void 0,arguments)}}},[t._t("right",[t._v(t._s(t.rightText))])],2)],1)],1)],1)},s=[]},ea63:function(t,e,i){"use strict";(function(t){i("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("e9c4"),i("fb6a");var n={data:function(){return{title:"添加地址",currency:0,list:["USDT-TRC20","USDT-ERC20"],address:"",beizhu:"",show:!1,isEdit:!1,isHome:!1}},onBackPress:function(t){return!!this.show&&(this.show=!1,!0)},onShow:function(){if("{}"!==JSON.stringify(this.$Route.query))if(this.$Route.query.isHome)this.isHome=this.$Route.query.isHome,this.address=this.$Route.query.address,this.currency=this.$Route.query.type;else if(this.$Route.query.isSelect)this.currency=this.$Route.query.type,this.isHome=!0;else{this.isEdit=!0;var t=this.$Route.query;this.currency=t.currency-1,this.address=t.address,this.beizhu=t.beizhu,this.title="编辑地址"}},methods:{scanCode:function(){var e=this;uni.scanCode({success:function(t){e.address=t.result,"0X"!=e.address.slice(0,2)&&"0x"!=e.address.slice(0,2)||(e.currency=1)},fail:function(e){t("log",e," at pages/addAddress/addAddress.vue:81")}})},submit:function(){this.isEdit?this.bookEdit():this.bookAdd()},bookEdit:function(){var e=this;this.$api.bookEdit({id:this.$Route.query.id,uid:this.uid,address:this.address,beizhu:this.beizhu,currency:this.currency+1}).then((function(t){uni.showToast({title:t.data.message,icon:"none",success:function(){1==t.data.status&&setTimeout((function(){e.$Router.back()}),500)}})})).catch((function(e){t("log",e," at pages/addAddress/addAddress.vue:114")}))},bookAdd:function(){var e=this;this.$api.bookAdd({uid:this.uid,address:this.address,beizhu:this.beizhu,currency:this.currency+1}).then((function(t){uni.showToast({title:t.data.message,icon:"none",success:function(){1==t.data.status&&setTimeout((function(){e.$Router.back()}),500)}})})).catch((function(e){t("log",e," at pages/addAddress/addAddress.vue:138")}))},changeCurrency:function(t){this.currency=t,this.close()},open:function(){this.isEdit||this.isHome||(this.show=!0)},close:function(){this.show=!1}}};e.default=n}).call(this,i("0de9")["log"])}}]);