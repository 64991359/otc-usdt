(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-sharePage-sharePage"],{"7f35":function(t,i,e){"use strict";(function(t){e("7a82");var n=e("4ea4").default;Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0;var a=n(e("ab01")),s={data:function(){return{qr:"../../static/logo.png",qrUrl:""}},methods:{getdownurl:function(){var t=this;this.$api.download({uid:this.uid}).then((function(i){if(1==i.data.status){var e=i.data.result.app_down_url;uni.setStorageSync("qrUrl",e),t.getQr(e)}})).catch((function(i){t.getdownurl()}))},getQr:function(t){this.qrUrl=t,this.qr=a.default.createQrCodeImg(t)},cancel:function(){this.$Router.back()},share:function(){plus.share.sendWithSystem({type:"image",pictures:"https://gimg2.baidu.com/image_search/src=http%3A%2F%2Fimg.jj20.com%2Fup%2Fallimg%2F1114%2F113020142315%2F201130142315-1-1200.jpg&refer=http%3A%2F%2Fimg.jj20.com&app=2002&size=f9999,10000&q=a80&n=0&g=0n&fmt=auto?sec=1657704004&t=7085300a155feff4ab7e074d7a5beb87"},(function(i){t("log","分享成功"," at pages/sharePage/sharePage.vue:114")}))},saveToAlbum:function(){var t=this.qr,i=uni.createCanvasContext("myCanvas");i.setFillStyle("#ddba82"),i.fillRect(0,0,this.$windowWidth,this.$windowHeight),i.setFillStyle("black"),i.drawImage("../../static/logo.png",uni.upx2px(300),uni.upx2px(32),uni.upx2px(150),uni.upx2px(150)),i.setFontSize(uni.upx2px(30)),i.fillText("U汇",uni.upx2px(375-i.measureText("U汇").width),uni.upx2px(220)),i.setFontSize(uni.upx2px(48)),i.fillText("为您从心打造",uni.upx2px(375-i.measureText("为您从心打造").width),uni.upx2px(320)),i.setFontSize(uni.upx2px(30)),i.fillText("安全快捷的数字资产工具",uni.upx2px(375-i.measureText("安全快捷的数字资产工具").width),uni.upx2px(420)),i.fillRect(uni.upx2px(330),uni.upx2px(460),uni.upx2px(90),uni.upx2px(6)),i.setFontSize(uni.upx2px(34)),i.fillText("轻松管理您的多链资产",uni.upx2px(375-i.measureText("轻松管理您的多链资产").width),uni.upx2px(540)),i.setFontSize(uni.upx2px(34)),i.fillText("一键跨法币和数据币兑换币种",uni.upx2px(375-i.measureText("一键跨法币和数据币兑换币种").width),uni.upx2px(580)),i.setFillStyle("white"),i.fillRect(0,this.$windowHeight-uni.upx2px(200),this.$windowWidth,uni.upx2px(200)),i.setFillStyle("black"),i.drawImage("../../static/logo.png",uni.upx2px(32),this.$windowHeight-uni.upx2px(140),uni.upx2px(80),uni.upx2px(80)),i.setFontSize(uni.upx2px(30)),i.fillText("U汇",uni.upx2px(120),this.$windowHeight-uni.upx2px(110)),i.setFontSize(uni.upx2px(30)),i.fillText("安全快捷的数字资产工具",uni.upx2px(120),this.$windowHeight-uni.upx2px(70)),i.drawImage(t,this.$windowWidth-uni.upx2px(232),this.$windowHeight-uni.upx2px(300),uni.upx2px(200),uni.upx2px(200)),i.draw(!1,setTimeout((function(){uni.canvasToTempFilePath({canvasId:"myCanvas",success:function(t){uni.saveImageToPhotosAlbum({filePath:t.tempFilePath,success:function(){uni.showToast({title:"保存成功",icon:"none"})}})}})}),300))}},onLoad:function(){var t=this,i=uni.getStorageSync("qrUrl");""!==i&&this.getQr(i),setTimeout((function(){t.getdownurl()}),10)}};i.default=s}).call(this,e("0de9")["log"])},"843e":function(t,i,e){"use strict";e.r(i);var n=e("f6d7"),a=e("939c");for(var s in a)["default"].indexOf(s)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(s);var u=e("f0c5"),l=Object(u["a"])(a["default"],n["b"],n["c"],!1,null,"2a5800e0",null,!1,n["a"],void 0);i["default"]=l.exports},"939c":function(t,i,e){"use strict";e.r(i);var n=e("7f35"),a=e.n(n);for(var s in n)["default"].indexOf(s)<0&&function(t){e.d(i,t,(function(){return n[t]}))}(s);i["default"]=a.a},f6d7:function(t,i,e){"use strict";e.d(i,"b",(function(){return a})),e.d(i,"c",(function(){return s})),e.d(i,"a",(function(){return n}));var n={viewImage:e("20f3").default},a=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("v-uni-view",[e("v-uni-view",{style:[{height:Number(t.$statusBarHeight)+"px"}]}),e("v-uni-view",{staticClass:"mlr-32 borRadius-12 over-hid"},[e("v-uni-view",{staticClass:"b_ddba82 flex-col flex-y-center pb-200 c_000000"},[e("viewImage",{staticClass:"mt-30",attrs:{width:150,height:150,src:"../../static/logo.png"}}),e("v-uni-view",{staticClass:"mt-10 mb-50"},[t._v("U汇")]),e("v-uni-view",{staticClass:"font-48"},[t._v("为您从心打造")]),e("v-uni-view",{staticClass:"mtb-30"},[t._v("安全快捷的数字资产工具")]),e("v-uni-view",{staticClass:"mb-30",staticStyle:{width:"90rpx",height:"6rpx",background:"#000000"}}),e("v-uni-view",{staticClass:"font-34"},[t._v("轻松管理您的多链资产")]),e("v-uni-view",{staticClass:"font-34"},[t._v("一键跨法币和数据币兑换币种")])],1),e("v-uni-view",{staticClass:"b_ffffff c_000000 rela"},[e("v-uni-view",{staticClass:"flex ptb-30 mlr-32"},[e("viewImage",{attrs:{width:80,height:80,src:"../../static/logo.png"}}),e("v-uni-view",{staticClass:"ml-20"},[e("v-uni-view",[t._v("U汇")]),e("v-uni-view",[t._v("安全快捷的数字资产工具")])],1)],1),e("viewImage",{staticClass:"bottom-60 right-32 abso",attrs:{width:200,height:200,src:t.qr}})],1)],1),e("v-uni-view",{staticClass:"wid-100 b_2d2c2b pt-20 pb-20 zIndex-2",staticStyle:{"border-radius":"12rpx 12rpx 0 0",opacity:"0"}},[e("v-uni-view",{staticClass:"flex flex-x-center c_888683"},[t._v("分享到")]),e("v-uni-view",{staticClass:"c_ddba82 flex borderButtom pb-40 pt-40"},[e("v-uni-view",{staticClass:"flex-1 flex-col flex-x-center flex-y-center",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.saveToAlbum()}}},[e("v-uni-view",{staticClass:"ri-image-line font-50"}),e("v-uni-view",{staticClass:"mt-20"},[t._v("保存图片")])],1),e("v-uni-view",{staticClass:"flex-1 flex-col flex-x-center flex-y-center"},[e("v-uni-view",{staticClass:"ri-file-copy-line font-50"}),e("v-uni-view",{staticClass:"mt-20",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.copy(t.qrUrl+"")}}},[t._v("复制链接")])],1),e("v-uni-view",{staticClass:"flex-1 flex-col flex-x-center flex-y-center",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.share.apply(void 0,arguments)}}},[e("v-uni-view",{staticClass:"ri-indent-decrease font-50"}),e("v-uni-view",{staticClass:"mt-20"},[t._v("更多")])],1)],1),e("v-uni-view",{staticClass:"flex flex-x-center pt-20 c_888683"},[t._v("取消")])],1),e("v-uni-view",{staticClass:"posFixed bottom-0 wid-100 b_2d2c2b pt-20 pb-20 zIndex-2",staticStyle:{"border-radius":"12rpx 12rpx 0 0"}},[e("v-uni-view",{staticClass:"flex flex-x-center c_888683"},[t._v("分享到")]),e("v-uni-view",{staticClass:"c_ddba82 flex borderButtom pb-40 pt-40"},[e("v-uni-view",{staticClass:"flex-1 flex-col flex-x-center flex-y-center",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.saveToAlbum()}}},[e("v-uni-view",{staticClass:"ri-image-line font-50"}),e("v-uni-view",{staticClass:"mt-20"},[t._v("保存图片")])],1),e("v-uni-view",{staticClass:"flex-1 flex-col flex-x-center flex-y-center"},[e("v-uni-view",{staticClass:"ri-file-copy-line font-50"}),e("v-uni-view",{staticClass:"mt-20",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.copy(t.qrUrl+"")}}},[t._v("复制链接")])],1),e("v-uni-view",{staticClass:"flex-1 flex-col flex-x-center flex-y-center",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.share.apply(void 0,arguments)}}},[e("v-uni-view",{staticClass:"ri-indent-decrease font-50"}),e("v-uni-view",{staticClass:"mt-20"},[t._v("更多")])],1)],1),e("v-uni-view",{staticClass:"flex flex-x-center pt-20 c_888683",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.cancel.apply(void 0,arguments)}}},[t._v("取消")])],1),e("v-uni-canvas",{staticStyle:{position:"fixed",top:"-50000rpx"},style:[{width:t.$windowWidth+"px",height:t.$windowHeight+"px"}],attrs:{"canvas-id":"myCanvas"}})],1)},s=[]}}]);