(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/widgets/Form/Markdown.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/widgets/Form/Markdown.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var mavon_editor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! mavon-editor */ "./node_modules/mavon-editor/dist/mavon-editor.js");
/* harmony import */ var mavon_editor__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(mavon_editor__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _mixins_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/mixins.js */ "./resources/js/mixins.js");
/* harmony import */ var mavon_editor_dist_css_index_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! mavon-editor/dist/css/index.css */ "./node_modules/mavon-editor/dist/css/index.css");
/* harmony import */ var mavon_editor_dist_css_index_css__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(mavon_editor_dist_css_index_css__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var wangeditor__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! wangeditor */ "./node_modules/wangeditor/release/wangEditor.js");
/* harmony import */ var wangeditor__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(wangeditor__WEBPACK_IMPORTED_MODULE_3__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    MavonEditor: mavon_editor__WEBPACK_IMPORTED_MODULE_0__["mavonEditor"]
  },
  mixins: [_mixins_js__WEBPACK_IMPORTED_MODULE_1__["BaseComponent"]],
  props: {
    attrs: Object,
    value: null
  },
  data: function data() {
    return {
      content: ''
    };
  },
  mounted: function mounted() {
    var _this = this;

    this.$bus.on("EditDataLoadingCompleted", function () {
      _this.content = _this.value;
    });
  },
  watch: {},
  methods: {
    onChange: function onChange(value, render) {
      console.log('content');
      this.$emit("change", value);
    },
    // 绑定@imgAdd event
    $imgAdd: function $imgAdd(pos, $file) {
      var _this2 = this;

      // 第一步.将图片上传到服务器
      console.log('image url:' + this.attrs.imageUploadUrl);
      var formdata = new FormData();
      formdata.append('file', $file); // this.$http.post('/user?ID=12345')
      // 	.then(function (response) {
      // 		console.log(response);
      // 	})
      // 	.catch(function (error) {
      // 		console.log(error);
      // 	});

      this.axios({
        url: this.attrs.imageUploadUrl,
        method: 'post',
        data: formdata,
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(function (respose) {
        if (respose.code == 200) {
          var data = respose.data;

          _this2.$refs.md.$img2Url(pos, data.url);
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/widgets/Form/Markdown.vue?vue&type=template&id=1e53a83f&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/widgets/Form/Markdown.vue?vue&type=template&id=1e53a83f& ***!
  \************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("mavon-editor", {
    ref: "md",
    class: _vm.attrs.className,
    style: _vm.attrs.style,
    attrs: {
      language: _vm.attrs.language,
      fontSize: _vm.attrs.fontSize,
      scrollStyle: _vm.attrs.scrollStyle,
      boxShadow: _vm.attrs.boxShadow,
      boxShadowStyle: _vm.attrs.boxShadowStyle,
      transition: _vm.attrs.transition,
      toolbarsBackground: _vm.attrs.toolbarsBackground,
      previewBackground: _vm.attrs.previewBackground,
      editable: _vm.attrs.editable,
      subfield: _vm.attrs.subfield,
      defaultOpen: _vm.attrs.defaultOpen,
      toolbarsFlag: _vm.attrs.toolbarsFlag,
      placeholder: _vm.attrs.placeholder,
      codeStyle: _vm.attrs.codeStyle,
      navigation: _vm.attrs.navigation,
      shortCut: _vm.attrs.shortCut,
      ishljs: _vm.attrs.ishljs,
      tabSize: _vm.attrs.tabSize,
      html: _vm.attrs.html,
      toolbars: _vm.attrs.toolbars
    },
    on: { change: _vm.onChange, imgAdd: _vm.$imgAdd },
    model: {
      value: _vm.content,
      callback: function($$v) {
        _vm.content = $$v
      },
      expression: "content"
    }
  })
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/widgets/Form/Markdown.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/widgets/Form/Markdown.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Markdown_vue_vue_type_template_id_1e53a83f___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Markdown.vue?vue&type=template&id=1e53a83f& */ "./resources/js/components/widgets/Form/Markdown.vue?vue&type=template&id=1e53a83f&");
/* harmony import */ var _Markdown_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Markdown.vue?vue&type=script&lang=js& */ "./resources/js/components/widgets/Form/Markdown.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Markdown_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Markdown_vue_vue_type_template_id_1e53a83f___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Markdown_vue_vue_type_template_id_1e53a83f___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/widgets/Form/Markdown.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/widgets/Form/Markdown.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/widgets/Form/Markdown.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Markdown_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Markdown.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/widgets/Form/Markdown.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Markdown_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/widgets/Form/Markdown.vue?vue&type=template&id=1e53a83f&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/widgets/Form/Markdown.vue?vue&type=template&id=1e53a83f& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Markdown_vue_vue_type_template_id_1e53a83f___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Markdown.vue?vue&type=template&id=1e53a83f& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/widgets/Form/Markdown.vue?vue&type=template&id=1e53a83f&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Markdown_vue_vue_type_template_id_1e53a83f___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Markdown_vue_vue_type_template_id_1e53a83f___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);