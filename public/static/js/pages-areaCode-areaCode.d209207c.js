(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-areaCode-areaCode"],{"0be4":function(c,t,e){"use strict";e.r(t);var i=e("58cdf"),d=e("7dca");for(var o in d)["default"].indexOf(o)<0&&function(c){e.d(t,c,(function(){return d[c]}))}(o);e("d1f0");var y=e("f0c5"),n=Object(y["a"])(d["default"],i["b"],i["c"],!1,null,"eca1fcfe",null,!1,i["a"],void 0);t["default"]=n.exports},"52ab":function(c,t,e){"use strict";e("7a82");var i=e("4ea4").default;Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var d=i(e("b85c"));e("4e82"),e("b64b");var o=i(e("afdc")),y={data:function(){return{indexList:[],itemArr:[]}},onLoad:function(){this.indexList=Object.keys(o.default).sort();var c,t=(0,d.default)(this.indexList);try{for(t.s();!(c=t.n()).done;){var e=c.value;this.itemArr.push(o.default[e])}}catch(i){t.e(i)}finally{t.f()}},methods:{select:function(c){uni.$emit("cityCode",c),this.$Router.back()}}};t.default=y},"58cdf":function(c,t,e){"use strict";e.d(t,"b",(function(){return d})),e.d(t,"c",(function(){return o})),e.d(t,"a",(function(){return i}));var i={navigationBar:e("89a3").default,uIndexList:e("48eb").default,uIndexItem:e("08b0").default,uIndexAnchor:e("6be0").default},d=function(){var c=this,t=c.$createElement,e=c._self._c||t;return e("v-uni-view",[e("navigationBar",{attrs:{title:"选择国家和地区",bgColor:"#ffffff"}}),e("u-index-list",{attrs:{"index-list":c.indexList}},[c._l(c.itemArr,(function(t,i){return[e("u-index-item",[e("u-index-anchor",{attrs:{text:c.indexList[i]}}),c._l(t,(function(t,i){return e("v-uni-view",{key:i,staticClass:"list-cell",on:{click:function(e){arguments[0]=e=c.$handleEvent(e),c.select(t)}}},[c._v(c._s(t.city)+"("+c._s(t.code)+")")])}))],2)]}))],2)],1)},o=[]},"7dca":function(c,t,e){"use strict";e.r(t);var i=e("52ab"),d=e.n(i);for(var o in i)["default"].indexOf(o)<0&&function(c){e.d(t,c,(function(){return i[c]}))}(o);t["default"]=d.a},8459:function(c,t,e){var i=e("24fb");t=i(!1),t.push([c.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */.list-cell[data-v-eca1fcfe]{display:flex;box-sizing:border-box;width:100%;padding:10px %?24?%;overflow:hidden;color:#323233;font-size:14px;line-height:24px;background-color:#fff}',""]),c.exports=t},afdc:function(c){c.exports=JSON.parse('{"Z":[{"city":"中国大陆","code":"+86"},{"city":"中国香港","code":"+852"},{"city":"中国澳门","code":"+853"},{"city":"中国台湾","code":"+886"},{"city":"中非共和国","code":"+236"},{"city":"乍得","code":"+235"},{"city":"智利","code":"+56"},{"city":"直布罗陀","code":"+350"},{"city":"泽西岛","code":"+44"},{"city":"赞比亚","code":"+260"}],"X":[{"city":"新加坡","code":"+65"},{"city":"希腊","code":"+30"},{"city":"匈牙利","code":"+36"},{"city":"新喀里多尼亚","code":"+687"},{"city":"新西兰","code":"+64"},{"city":"西班牙","code":"+34"},{"city":"叙利亚","code":"+963"}],"A":[{"city":"阿富汗","code":"+93"},{"city":"阿尔巴尼亚","code":"+355"},{"city":"阿尔格拉","code":"+213"},{"city":"安道尔","code":"+376"},{"city":"安哥拉","code":"+244"},{"city":"安圭拉","code":"+1264"},{"city":"阿森松岛","code":"+247"},{"city":"安提瓜和巴布达","code":"+1268"},{"city":"阿根廷","code":"+54"},{"city":"阿鲁巴","code":"+297"},{"city":"澳大利亚","code":"+61"},{"city":"奥地利","code":"+43"},{"city":"阿塞拜疆","code":"+994"},{"city":"埃及","code":"+20"},{"city":"艾萨尔瓦多","code":"+503"},{"city":"爱沙尼亚","code":"+372"},{"city":"埃塞俄比亚","code":"+251"},{"city":"爱尔兰","code":"+353"},{"city":"阿曼","code":"+968"},{"city":"阿拉伯联合酋长国","code":"+971"}],"Y":[{"city":"亚美尼亚","code":"+374"},{"city":"印度","code":"+91"},{"city":"印度尼西亚","code":"+62"},{"city":"伊朗","code":"+98"},{"city":"伊拉克","code":"+964"},{"city":"以色列","code":"+972"},{"city":"意大利","code":"+93"},{"city":"牙买加","code":"+1876"},{"city":"约旦","code":"+962"},{"city":"英国","code":"+44"},{"city":"越南","code":"+84"},{"city":"也门","code":"+967"}],"B":[{"city":"巴哈马","code":"+1242"},{"city":"巴林","code":"+973"},{"city":"巴巴多斯","code":"+1246"},{"city":"白俄罗斯","code":"+375"},{"city":"比利时","code":"+32"},{"city":"伯利兹","code":"+501"},{"city":"贝宁","code":"+229"},{"city":"百慕大","code":"+1441"},{"city":"不丹","code":"+975"},{"city":"玻利维亚","code":"+591"},{"city":"波斯尼亚和黑塞哥维那","code":"+387"},{"city":"博茨瓦纳","code":"+267"},{"city":"巴西","code":"+55"},{"city":"保加利亚","code":"+359"},{"city":"布基纳法索","code":"+226"},{"city":"布隆迪","code":"+257"},{"city":"冰岛","code":"+354"},{"city":"巴基斯坦","code":"+92"},{"city":"巴勒斯坦","code":"+970"},{"city":"巴拿马","code":"+507"},{"city":"巴布亚新几内亚","code":"+675"},{"city":"巴拉圭","code":"+595"},{"city":"波兰","code":"+48"},{"city":"波多黎各","code":"+1"}],"M":[{"city":"孟加拉国","code":"+880"},{"city":"缅甸","code":"+95"},{"city":"马恩岛","code":"+44"},{"city":"马其顿","code":"+389"},{"city":"马达加斯加","code":"+261"},{"city":"马拉维","code":"+265"},{"city":"马来西亚","code":"+60"},{"city":"马尔代夫","code":"+960"},{"city":"马里","code":"+223"},{"city":"马耳他","code":"+356"},{"city":"马提尼克","code":"+596"},{"city":"毛里塔尼亚","code":"+222"},{"city":"毛里求斯","code":"+230"},{"city":"马约特","code":"+262"},{"city":"墨西哥","code":"+52"},{"city":"摩尔多瓦","code":"+373"},{"city":"摩纳哥","code":"+377"},{"city":"蒙古","code":"+976"},{"city":"蒙特塞拉特","code":"+1664"},{"city":"摩洛哥","code":"+212"},{"city":"莫桑比克","code":"+258"},{"city":"秘鲁","code":"+51"},{"city":"美国","code":"+1"}],"W":[{"city":"文莱","code":"+673"},{"city":"危地马拉","code":"+502"},{"city":"乌干达","code":"+256"},{"city":"乌克兰","code":"+380"},{"city":"乌拉圭","code":"+598"},{"city":"乌兹别克斯坦","code":"+998"},{"city":"瓦努阿图","code":"+678"},{"city":"委内瑞拉","code":"+58"},{"city":"维尔京群岛","code":"+1340"}],"J":[{"city":"柬埔寨","code":"+855"},{"city":"加拿大","code":"+1"},{"city":"+捷克共和国","code":"+420"},{"city":"吉布提","code":"+253"},{"city":"加蓬","code":"+241"},{"city":"加纳","code":"+233"},{"city":"几内亚","code":"+240"},{"city":"几内亚","code":"+224"},{"city":"吉尔吉斯斯坦","code":"+996"},{"city":"津巴布韦","code":"+263"}],"K":[{"city":"喀麦隆","code":"+237"},{"city":"开曼群岛","code":"+1345"},{"city":"科摩罗","code":"+269"},{"city":"库克群岛","code":"+682"},{"city":"科特迪沃","code":"+225"},{"city":"克罗地亚","code":"+385"},{"city":"肯尼亚","code":"+254"},{"city":"科索沃","code":"+383"},{"city":"科威特","code":"+965"},{"city":"库塔","code":"+974"}],"F":[{"city":"佛得角","code":"+238"},{"city":"法罗群岛","code":"+298"},{"city":"斐济","code":"+679"},{"city":"芬兰","code":"+358"},{"city":"法国","code":"+33"},{"city":"法属圭亚那","code":"+594"},{"city":"法属波利尼西亚","code":"+689"},{"city":"菲律宾","code":"+63"}],"G":[{"city":"哥伦比亚","code":"+57"},{"city":"刚果共和国","code":"+242"},{"city":"刚果民主共和国","code":"+243"},{"city":"哥斯达黎加","code":"+506"},{"city":"古巴","code":"+53"},{"city":"冈比亚","code":"+220"},{"city":"格鲁吉亚","code":"+995"},{"city":"格陵兰","code":"+299"},{"city":"格林纳达","code":"+1473"},{"city":"瓜德罗普","code":"+590"},{"city":"关岛","code":"+1671"},{"city":"根西","code":"+44"},{"city":"圭亚那","code":"+592"}],"S":[{"city":"塞浦路斯","code":"+357"},{"city":"萨摩亚东部","code":"+684"},{"city":"萨摩亚西部","code":"+685"},{"city":"圣马力诺","code":"+378"},{"city":"圣多美和普林西比","code":"+239"},{"city":"沙特阿拉伯","code":"+966"},{"city":"塞内加尔","code":"+221"},{"city":"塞尔维亚","code":"+381"},{"city":"塞舌尔","code":"+248"},{"city":"塞拉利昂","code":"+232"},{"city":"斯洛伐克","code":"+421"},{"city":"斯洛文尼亚","code":"+386"},{"city":"斯里兰卡","code":"+94"},{"city":"圣基茨和尼维斯","code":"+1869"},{"city":"圣卢西亚","code":"+1758"},{"city":"圣文森特","code":"+1784"},{"city":"苏丹","code":"+249"},{"city":"苏里南","code":"+597"},{"city":"斯威士兰","code":"+268"}],"D":[{"city":"丹麦","code":"+45"},{"city":"多米尼加","code":"+1767"},{"city":"多米尼加共和国","code":"+1809"},{"city":"德国","code":"+94"},{"city":"东帝汶","code":"+670"},{"city":"多哥","code":"+228"}],"E":[{"city":"厄瓜多尔","code":"+593"},{"city":"俄罗斯","code":"+7"}],"H":[{"city":"海地","code":"+509"},{"city":"洪都拉斯","code":"+504"},{"city":"哈萨克斯坦","code":"+7"},{"city":"黑山","code":"+382"},{"city":"荷兰","code":"+31"},{"city":"荷属安的列斯","code":"+599"},{"city":"韩国","code":"+82"}],"R":[{"city":"日本","code":"+81"},{"city":"瑞典","code":"+46"},{"city":"瑞士","code":"+41"}],"L":[{"city":"老挝","code":"+856"},{"city":"拉脱维亚","code":"+371"},{"city":"黎巴嫩","code":"+961"},{"city":"莱索托","code":"+266"},{"city":"利比里亚","code":"+231"},{"city":"利比亚","code":"+218"},{"city":"列支敦士登","code":"+423"},{"city":"立陶宛","code":"+370"},{"city":"卢森堡","code":"+352"},{"city":"留尼汪","code":"+262"},{"city":"罗马尼亚","code":"+40"},{"city":"卢旺达","code":"+250"}],"N":[{"city":"纳米比亚","code":"+264"},{"city":"尼泊尔","code":"+977"},{"city":"尼加拉瓜","code":"+505"},{"city":"尼日尔","code":"+227"},{"city":"尼日利亚","code":"+234"},{"city":"挪威","code":"+47"},{"city":"南非","code":"+27"}],"P":[{"city":"葡萄牙","code":"+351"}],"T":[{"city":"塔吉克斯坦","code":"+992"},{"city":"坦桑尼亚","code":"+255"},{"city":"泰国","code":"+66"},{"city":"汤加","code":"+676"},{"city":"特立尼达和多巴哥","code":"+1868"},{"city":"突尼斯","code":"+216"},{"city":"土耳其","code":"+90"},{"city":"土库曼斯坦","code":"+993"},{"city":"特克斯和凯科斯群岛","code":"+1649"}]}')},d1f0:function(c,t,e){"use strict";var i=e("fd403"),d=e.n(i);d.a},fd403:function(c,t,e){var i=e("8459");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[c.i,i,""]]),i.locals&&(c.exports=i.locals);var d=e("4f06").default;d("6101ce82",i,!0,{sourceMap:!1,shadowMode:!1})}}]);