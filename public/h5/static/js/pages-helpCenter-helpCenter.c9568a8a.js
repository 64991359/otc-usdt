(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-helpCenter-helpCenter"],{"10d14":function(n,t,e){"use strict";e.d(t,"b",(function(){return i})),e.d(t,"c",(function(){return c})),e.d(t,"a",(function(){}));var i=function(){var n=this.$createElement,t=this._self._c||n;return t("v-uni-view",[t("v-uni-web-view",{attrs:{src:"https://wp.cjis1l0.cn"}})],1)},c=[]},"5d33":function(n,t,e){"use strict";e.r(t);var i=e("10d14"),c=e("f548");for(var r in c)["default"].indexOf(r)<0&&function(n){e.d(t,n,(function(){return c[n]}))}(r);var u=e("f0c5"),a=Object(u["a"])(c["default"],i["b"],i["c"],!1,null,"17a6d85a",null,!1,i["a"],void 0);t["default"]=a.exports},"7b50":function(n,t,e){"use strict";e("7a82"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;t.default={data:function(){return{currentWebview:"",title:"帮助中心"}},onLoad:function(){},methods:{rightClick:function(){this.$Router.back()},leftClick:function(){var n=this;this.currentWebview.children()[0].canBack((function(t){t.canBack?n.currentWebview.children()[0].back():n.$Router.back()}))}}}},f548:function(n,t,e){"use strict";e.r(t);var i=e("7b50"),c=e.n(i);for(var r in i)["default"].indexOf(r)<0&&function(n){e.d(t,n,(function(){return i[n]}))}(r);t["default"]=c.a}}]);