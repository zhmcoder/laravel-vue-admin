(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{BdhI:function(t,o,e){"use strict";e.r(o);var i=e("GguQ"),a=e.n(i),s={mixins:[e("b3nO").b],props:["defaultPropValues"],data:function(){return{editor:null,initHtml:!1,defaultValue:""}},mounted:function(){var t=this;this.defaultValue=this._.cloneDeep(this.attrs.componentValue),this.editor=new a.a(this.$refs.toolbar,this.$refs.editor),this.editor.customConfig.menus=this.attrs.menus,this.editor.customConfig.zIndex=this.attrs.zIndex,this.editor.customConfig.uploadImgShowBase64=this.attrs.uploadImgShowBase64,this.attrs.uploadImgServer&&(this.editor.customConfig.uploadImgServer=this.attrs.uploadImgServer,this.editor.customConfig.uploadImgParams={_token:Admin.token}),this.attrs.uploadFileName&&(this.editor.customConfig.uploadFileName=this.attrs.uploadFileName),this.attrs.uploadImgHeaders&&(this.editor.customConfig.uploadImgHeaders=this.attrs.uploadImgHeaders),this.editor.customConfig.onchange=function(o){t.onChange(o)},this.$nextTick((function(){t.editor.create(),t.editor.txt.html(t.defaultValue),t.value&&t.editor&&t.editor.txt.html(t.value)})),this.$bus.on("EditDataLoadingCompleted",(function(){t.editor&&t.editor.txt.html(t.value)}))},watch:{defaultPropValues:function(t){t!==this.editor.txt.html()&&t&&this.editor.txt.html(JSON.parse(JSON.stringify(String(t))))}},destroyed:function(){try{this.$bus.off("EditDataLoadingCompleted")}catch(t){}}},n=(e("CxPf"),e("KHd+")),r=Object(n.a)(s,(function(){var t=this,o=t.$createElement,e=t._self._c||o;return e("div",{staticClass:"wangeditor-main flex-sub"},[e("div",{ref:"toolbar",staticClass:"toolbar"}),t._v(" "),t.attrs.component?e("div",[e(t.attrs.component.componentName,{tag:"component",attrs:{attrs:t.attrs.component,editor:t.editor},on:{"update:editor":function(o){t.editor=o}}})],1):t._e(),t._v(" "),e("div",{ref:"editor",class:t.attrs.className,style:t.attrs.style})])}),[],!1,null,null,null);o.default=r.exports},CxPf:function(t,o,e){"use strict";e("sH8k")},ZOpH:function(t,o,e){(t.exports=e("I1BE")(!1)).push([t.i,".wangeditor-main{border:1px solid #dcdcdc}.wangeditor-main .toolbar{background:#f7f7f7}.wangeditor-main .w-e-text-container{position:relative}.wangeditor-main .w-e-text-container .w-e-text{position:absolute;left:0px;top:0px;right:0px;bottom:0px}",""])},sH8k:function(t,o,e){var i=e("ZOpH");"string"==typeof i&&(i=[[t.i,i,""]]);var a={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(i,a);i.locals&&(t.exports=i.locals)}}]);