(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-address-address"],{1441:function(t,e,i){"use strict";i.r(e);var n=i("e6fa"),s=i("aa8c");for(var a in s)["default"].indexOf(a)<0&&function(t){i.d(e,t,(function(){return s[t]}))}(a);i("2ff2");var r=i("f0c5"),o=Object(r["a"])(s["default"],n["b"],n["c"],!1,null,"12ea2a2e",null,!1,n["a"],void 0);e["default"]=o.exports},"1ed1":function(t,e,i){"use strict";i.r(e);var n=i("6f91"),s=i.n(n);for(var a in n)["default"].indexOf(a)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(a);e["default"]=s.a},"202b":function(t,e,i){"use strict";(function(t){i("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("e9c4"),i("d81d"),i("a434"),i("d3b7");var n={data:function(){return{isEmpty:!1,administrationStatus:!1,show:!1,addressList:[],isSelect:!1,type:0}},computed:{rightText:function(){return this.administrationStatus?"完成":"管理"}},onLoad:function(){"{}"!==JSON.stringify(this.$Route.query)&&this.$Route.query.isSelect&&(this.isSelect=this.$Route.query.isSelect,this.type=this.$Route.query.type)},onShow:function(){this.getBookList()},methods:{setBookMoren:function(e){var i=this;this.$api.setBookMoren({id:e,uid:this.uid}).then((function(t){uni.showToast({title:t.data.message,icon:"none",success:function(){1==t.data.status&&i.addressList.map((function(t,i){t.is_moren=t.id==e}))}})})).catch((function(e){t("log",e," at pages/address/address.vue:98")}))},select:function(t){this.isSelect&&(uni.$emit("selectAddress",t.address),this.$Router.back())},edit:function(t){this.isSelect&&(t.isSelect=this.isSelect,t.type=this.type),this.$Router.push({name:"addAddress",params:t})},bookDel:function(e){var i=this;this.$api.bookDel({id:e,uid:this.uid}).then((function(t){uni.showToast({title:t.data.message,icon:"none",success:function(){1==t.data.status&&i.addressList.map((function(t,n){t.id==e&&i.addressList.splice(n,1)}))}})})).catch((function(e){t("log",e," at pages/address/address.vue:138")}))},getBookList:function(){var e=this;this.$api.getBookList({uid:this.uid}).then((function(t){1==t.data.status&&(e.isSelect?(e.addressList=[],0==e.type&&t.data.result.map((function(t,i){1==t.currency&&e.addressList.push(t)})),1==e.type&&t.data.result.map((function(t,i){2==t.currency&&e.addressList.push(t)}))):e.addressList=t.data.result)})).catch((function(e){t("log",e," at pages/address/address.vue:170")})).finally((function(){e.isEmpty=!0}))},rightClick:function(){this.addressList.length&&(this.administrationStatus=!this.administrationStatus)}}};e.default=n}).call(this,i("0de9")["log"])},"261d":function(t,e,i){var n=i("81e6");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var s=i("4f06").default;s("ccc8391a",n,!0,{sourceMap:!1,shadowMode:!1})},"2ff2":function(t,e,i){"use strict";var n=i("be38"),s=i.n(n);s.a},"6e40":function(t,e,i){"use strict";var n=i("261d"),s=i.n(n);s.a},"6f91":function(t,e,i){"use strict";i("7a82"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,i("a9e3"),i("e25e");var n={props:{height:{type:[String,Number],default:44},iconType:{type:String,default:"ri-arrow-left-s-line"},iconSize:{type:[String,Number],default:50},iconColor:{type:String,default:"#ddba82"},fontSize:{type:[String,Number],default:32},fontColor:{type:[String],default:"#ddba82"},title:{type:String,default:""},rightText:{type:String,default:""},bgColor:{type:String,default:"#1e1e1e"},placeholder:{type:Boolean,default:!0},fixed:{type:Boolean,default:!0},border:{type:Boolean,default:!1},borderColor:{type:String,default:"#000000"},autoBack:{type:Boolean,default:!0},Color:{type:Boolean,default:!1},scrollTop:{type:Number,default:0},isGradualChange:{type:Boolean,default:!1}},name:"navigationBar",data:function(){return{opacity:0}},created:function(){},computed:{rgba:function(){var t=[],e=this.$tool.rgba(this.bgColor);return t[0]=parseInt(e[1],16),t[1]=parseInt(e[2],16),t[2]=parseInt(e[3],16),t}},watch:{scrollTop:{immediate:!0,handler:function(){this.fixed&&this.isGradualChange&&(0==this.scrollTop?this.opacity=0:this.scrollTop>this.height?this.opacity=1:this.opacity=this.scrollTop/this.height)}},isGradualChange:{immediate:!0,handler:function(){this.isGradualChange&&(this.opacity=0),this.isGradualChange||(this.opacity=1)}}},methods:{leftClick:function(){this.autoBack?this.$Router.back():this.$emit("leftClick")},rightClick:function(){this.$emit("rightClick")}}};e.default=n},"81e6":function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.navbar--fixed[data-v-f655fec0]{position:fixed;top:0;left:0;z-index:11}.navbar--fixed--center[data-v-f655fec0]{flex:1;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;text-align:center}',""]),t.exports=e},"89a3":function(t,e,i){"use strict";i.r(e);var n=i("e333"),s=i("1ed1");for(var a in s)["default"].indexOf(a)<0&&function(t){i.d(e,t,(function(){return s[t]}))}(a);i("6e40");var r=i("f0c5"),o=Object(r["a"])(s["default"],n["b"],n["c"],!1,null,"f655fec0",null,!1,n["a"],void 0);e["default"]=o.exports},a3db:function(t,e,i){var n=i("24fb");e=n(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.bor-b-2[data-v-12ea2a2e]{border-bottom:%?2?% solid rgba(136,134,131,.1)}.bor-t-2[data-v-12ea2a2e]{border-top:%?2?% solid rgba(136,134,131,.1)}',""]),t.exports=e},aa8c:function(t,e,i){"use strict";i.r(e);var n=i("202b"),s=i.n(n);for(var a in n)["default"].indexOf(a)<0&&function(t){i.d(e,t,(function(){return n[t]}))}(a);e["default"]=s.a},be38:function(t,e,i){var n=i("a3db");n.__esModule&&(n=n.default),"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var s=i("4f06").default;s("548c1b6f",n,!0,{sourceMap:!1,shadowMode:!1})},e333:function(t,e,i){"use strict";i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return s})),i.d(e,"a",(function(){}));var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"navbar"},[t.fixed&&t.placeholder?i("v-uni-view",{style:[{height:Number(t.$statusBarHeight+t.height)+"px"}]}):t._e(),i("v-uni-view",{class:[t.fixed&&"navbar--fixed","wid-100"],style:[{background:"rgba("+t.rgba[0]+","+t.rgba[1]+","+t.rgba[2]+","+t.opacity+")"}]},[i("v-uni-view",{style:[{height:t.$statusBarHeight+"px"}]}),i("v-uni-view",{staticClass:"flex flex-y-center flex-x-between plr-32",style:[{height:t.height+"px","border-bottom":t.border?"2rpx solid"+t.borderColor:"","font-size":t.fontSize+"rpx",color:t.fontColor}]},[i("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.leftClick.apply(void 0,arguments)}}},[t._t("left",[i("v-uni-view",{class:[t.iconType],style:[{"font-size":t.iconSize+"rpx",color:t.iconColor}]})])],2),i("v-uni-view",{staticClass:"navbar--fixed--center fontWei-600"},[t._t("center",[t._v(t._s(t.title))])],2),i("v-uni-view",{on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.rightClick.apply(void 0,arguments)}}},[t._t("right",[t._v(t._s(t.rightText))])],2)],1)],1)],1)},s=[]},e6fa:function(t,e,i){"use strict";i.d(e,"b",(function(){return s})),i.d(e,"c",(function(){return a})),i.d(e,"a",(function(){return n}));var n={navigationBar:i("89a3").default},s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"flex-col",staticStyle:{height:"100%"}},[i("navigationBar",{attrs:{title:"地址簿",rightText:t.rightText},on:{rightClick:function(e){arguments[0]=e=t.$handleEvent(e),t.rightClick()}}}),i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.isEmpty,expression:"isEmpty"}],staticClass:"flex-1 flex-col",staticStyle:{overflow:"scroll"}},[i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:!t.addressList.length,expression:"!addressList.length"}],staticClass:"flex-col flex-x-center flex-y-center c_ddba82 flex-1"},[i("v-uni-view",{staticClass:"ri-contacts-book-line font-200"}),i("v-uni-view",[t._v("暂无地址")]),i("v-uni-view",{staticClass:"plr-100 b_ddba82 ptb-10 borRadius-50 mt-20 c_000000 font-36",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.edit({})}}},[t._v("+ 添加地址")])],1),i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.addressList.length,expression:"addressList.length"}],staticClass:"c_888683"},[t._l(t.addressList,(function(e,n){return[i("v-uni-view",{staticClass:"plr-20 ptb-20 borRadius-12 b_2d2c2b mlr-32",class:[{"mt-20":0!=n}],on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.select(e)}}},[i("v-uni-view",{staticClass:"flex flex-y-center"},[i("v-uni-view",{staticClass:"flex-1 break-all"},[i("v-uni-view",{staticClass:"flex flex-y-center"},[i("v-uni-view",{staticClass:"shrink-0 mr-20"},[t._v("币种:")]),i("v-uni-view",[t._v("USDT-"+t._s(1==e.currency?"TRC20":"ERC20"))])],1),i("v-uni-view",{staticClass:"flex mt-10"},[i("v-uni-view",{staticClass:"shrink-0 mr-20"},[t._v("地址:")]),i("v-uni-view",{staticClass:"break-all flex-1"},[t._v(t._s(e.address))])],1),i("v-uni-view",{staticClass:"flex mt-10"},[i("v-uni-view",{staticClass:"shrink-0 mr-20"},[t._v("备注:")]),i("v-uni-view",{staticClass:"break-all"},[t._v(t._s(e.beizhu))])],1)],1),i("v-uni-view",{staticClass:"ri-edit-line ml-10 shrink-0",on:{click:function(i){i.stopPropagation(),arguments[0]=i=t.$handleEvent(i),t.edit(e)}}})],1),i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.administrationStatus,expression:"administrationStatus"}],staticClass:"flex pt-30 flex-x-between mt-20 bor-t-2"},[i("v-uni-view",{staticClass:"flex flex-y-center",on:{click:function(i){i.stopPropagation(),arguments[0]=i=t.$handleEvent(i),t.setBookMoren(e.id)}}},[i("v-uni-label",{staticClass:"mr-10",class:[e.is_moren?"ri-radio-button-line c_ddba82":"ri-checkbox-blank-circle-line"],on:{click:function(i){i.stopPropagation(),arguments[0]=i=t.$handleEvent(i),t.setBookMoren(e.id)}}}),t._v("默认地址")],1),i("v-uni-view",{on:{click:function(i){i.stopPropagation(),arguments[0]=i=t.$handleEvent(i),t.bookDel(e.id)}}},[t._v("删除")])],1)],1)]}))],2)],1),i("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.addressList.length,expression:"addressList.length"}],staticClass:"b_2d2c2b mt-20",staticStyle:{"border-radius":"12rpx 12rpx 0 0"}},[i("v-uni-view",{staticClass:"mlr-32 mtb-30 borRadius-100 flex flex-x-center ptb-10 b_0091ff font-40",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.edit({})}}},[t._v("+ 添加地址")])],1)],1)},a=[]}}]);