/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./blocks/src/section/section.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./blocks/src/components/container.js":
/*!********************************************!*\
  !*** ./blocks/src/components/container.js ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return SE2_container; });
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ "./node_modules/@babel/runtime/helpers/classCallCheck.js");
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js");
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_helpers_assertThisInitialized__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/assertThisInitialized */ "./node_modules/@babel/runtime/helpers/assertThisInitialized.js");
/* harmony import */ var _babel_runtime_helpers_assertThisInitialized__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_assertThisInitialized__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/helpers/inherits */ "./node_modules/@babel/runtime/helpers/inherits.js");
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/helpers/possibleConstructorReturn */ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js");
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @babel/runtime/helpers/getPrototypeOf */ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js");
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_8__);








function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_5___default()(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_5___default()(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_4___default()(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }



var _wp$blockEditor = wp.blockEditor,
    RichText = _wp$blockEditor.RichText,
    InspectorControls = _wp$blockEditor.InspectorControls,
    ColorPalette = _wp$blockEditor.ColorPalette,
    MediaUpload = _wp$blockEditor.MediaUpload,
    MediaUploadCheck = _wp$blockEditor.MediaUploadCheck;
var _wp$components = wp.components,
    PanelBody = _wp$components.PanelBody,
    ColorPicker = _wp$components.ColorPicker,
    SelectControl = _wp$components.SelectControl,
    Button = _wp$components.Button;

var SE2_container = /*#__PURE__*/function (_Component) {
  _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_3___default()(SE2_container, _Component);

  var _super = _createSuper(SE2_container);

  function SE2_container(props) {
    var _this;

    _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default()(this, SE2_container);

    _this = _super.call(this, props);
    var defaultStyle = {
      style: {},
      margin: {},
      padding: {},
      backgroundColor: 'none',
      borderWidth: {},
      borderStyle: 'solid',
      borderColor: '#ffffff',
      borderRadius: {},
      backgroundImage: 'none',
      backgroundSize: 'cover',
      backgroundRepeat: 'no-repeat',
      backgroundAttachment: 'scroll',
      backgroundPosition: 'center',
      video: 'none',
      videoURL: 'none'
    };

    if (Object.values(_this.props.styleProps).length > 0) {
      _this.state = _this.props.styleProps;
    } else {
      _this.state = defaultStyle;
    }

    if (_this.changeSettings) {
      _this.changeSettings = _this.changeSettings.bind(_babel_runtime_helpers_assertThisInitialized__WEBPACK_IMPORTED_MODULE_2___default()(_this));
    }

    _this.props.SE2containerStyle = {};
    return _this;
  }

  _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default()(SE2_container, [{
    key: "changeSettings",
    value: function changeSettings(v, k) {
      var _this2 = this;

      this.setState(function (prevState) {
        var newState = Object.assign({}, prevState);
        newState[k] = v;
        return newState;
      }, function () {
        _this2.props.styleHandler(_this2.state, _this2.props.SE2containerStyle);
      });
    }
  }, {
    key: "componentDidMount",
    value: function componentDidMount() {
      this.changeSettings(this.props.SE2containerStyle, 'style');
    }
  }, {
    key: "render",
    value: function render() {
      var _this3 = this;

      var margin = '0px';

      if (this.state.margin.top) {
        margin = this.state.margin.top + ' ' + this.state.margin.right + ' ' + this.state.margin.bottom + ' ' + this.state.margin.left;
      }

      var padding = '0px';

      if (this.state.padding.top) {
        padding = this.state.padding.top + ' ' + this.state.padding.right + ' ' + this.state.padding.bottom + ' ' + this.state.padding.left;
      }

      var borderWidth = '0px';

      if (this.state.borderWidth.top) {
        borderWidth = this.state.borderWidth.top + ' ' + this.state.borderWidth.right + ' ' + this.state.borderWidth.bottom + ' ' + this.state.borderWidth.left;
      }

      var borderRadius = '0px';

      if (this.state.borderRadius.top) {
        borderRadius = this.state.borderRadius.top + ' ' + this.state.borderRadius.right + ' ' + this.state.borderRadius.bottom + ' ' + this.state.borderRadius.left;
      }

      var backgroundImage = 'none';

      if (this.state.backgroundImage !== 'none') {
        backgroundImage = "url(".concat(this.state.backgroundImage.sizes.full.url, ")");
      }

      this.props.SE2containerStyle = {
        backgroundColor: this.state.backgroundColor,
        margin: margin,
        padding: padding,
        borderWidth: borderWidth,
        borderStyle: this.state.borderStyle,
        borderColor: this.state.borderColor,
        borderRadius: borderRadius,
        backgroundImage: backgroundImage,
        backgroundSize: this.state.backgroundSize,
        backgroundRepeat: this.state.backgroundRepeat,
        backgroundAttachment: this.state.backgroundAttachment,
        backgroundPosition: this.state.backgroundPosition
      };
      /* var videoURL = 'none'
      if (this.state.videoURL !== 'none') {
           videoURL = `${this.state.videoURL}`
      }
      if (this.state.videoURL !== 'none') {
           console.log('VIDEO:', this.state.videoURL)
           //this.props.video = `<video width="320" height="240" controls><source src="${videoURL.url}" type="${videoURL.mime}"></video>`
           this.props.video = ''
      } else {
           this.props.video = ''
      } */

      return [Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(InspectorControls, {
        style: {
          marginBottom: '40px'
        }
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(PanelBody, {
        title: 'Background',
        initialOpen: false
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(ColorPalette, {
        value: this.state.backgroundColor,
        onChange: function onChange(value) {
          return _this3.changeSettings(value, 'backgroundColor');
        }
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("p", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("strong", null, "Background Image")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(MediaUploadCheck, {
        style: {
          margin: '40px 0'
        }
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(MediaUpload, {
        onSelect: function onSelect(media) {
          return _this3.changeSettings(media, 'backgroundImage');
        },
        value: this.state.backgroundImage,
        render: function render(_ref) {
          var open = _ref.open;
          return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("div", null, _this3.state.backgroundImage !== 'none' ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("div", {
            style: {
              margin: '20px 0',
              backgroundImage: "url(".concat(_this3.state.backgroundImage.sizes.full.url, ")"),
              height: '100px',
              width: '100%',
              backgroundSize: 'cover'
            }
          }) : Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("div", {
            style: {
              margin: '20px 0',
              color: 'grey',
              backgroundColor: 'lightgrey',
              width: '100%',
              textAlign: 'center',
              padding: '10px'
            }
          }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("strong", null, "No Image")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(Button, {
            isPrimary: true,
            onClick: open
          }, "Select Background Image"));
        }
      })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(SelectControl, {
        label: 'Background Size',
        value: this.state.backgroundSize // e.g: value = [ 'a', 'c' ]
        ,
        onChange: function onChange(value) {
          _this3.changeSettings(value, 'backgroundSize');
        },
        options: [{
          value: 'cover',
          label: 'Cover'
        }, {
          value: 'auto',
          label: 'Auto'
        }, {
          value: 'contain',
          label: 'contain'
        }, {
          value: '100%',
          label: '100%'
        }]
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(SelectControl, {
        label: 'Background Attechment',
        value: this.state.backgroundAttachment // e.g: value = [ 'a', 'c' ]
        ,
        onChange: function onChange(value) {
          _this3.changeSettings(value, 'backgroundAttachment');
        },
        options: [{
          value: 'scroll',
          label: 'Scroll'
        }, {
          value: 'fixed',
          label: 'Fixed'
        }, {
          value: 'local',
          label: 'Local'
        }]
      })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(PanelBody, {
        title: 'Video',
        initialOpen: false
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("p", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("strong", null, "Video")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(MediaUploadCheck, {
        style: {
          margin: '40px 0'
        }
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(MediaUpload, {
        onSelect: function onSelect(media) {
          return _this3.changeSettings(media, 'videoURL');
        },
        value: this.state.backgroundImage,
        render: function render(_ref2) {
          var open = _ref2.open;
          return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("div", null, _this3.state.backgroundImage !== 'none' ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("video", {
            style: {
              margin: '20px 0'
            },
            width: "320",
            height: "240"
          }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("source", {
            src: _this3.props.videoURL,
            type: "video/mp4"
          })) : Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("div", {
            style: {
              margin: '20px 0',
              color: 'grey',
              backgroundColor: 'lightgrey',
              width: '100%',
              textAlign: 'center',
              padding: '10px'
            }
          }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("strong", null, "No Image")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(Button, {
            isPrimary: true,
            onClick: open
          }, "Select Video"));
        }
      }))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(PanelBody, {
        title: 'Spacing',
        initialOpen: false
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_8__["__experimentalBoxControl"], {
        label: "Margin",
        values: this.state.margin,
        onChange: function onChange(value) {
          _this3.changeSettings(value, 'margin');
        }
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_8__["__experimentalBoxControl"], {
        label: "Padding",
        values: this.state.padding,
        onChange: function onChange(value) {
          _this3.changeSettings(value, 'padding');
        }
      })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(PanelBody, {
        title: 'Border',
        initialOpen: false
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_8__["__experimentalBoxControl"], {
        label: "Width",
        values: this.state.borderWidth,
        onChange: function onChange(value) {
          _this3.changeSettings(value, 'borderWidth');
        }
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(SelectControl, {
        label: 'Border Style',
        value: this.state.borderStyle // e.g: value = [ 'a', 'c' ]
        ,
        onChange: function onChange(value) {
          _this3.changeSettings(value, 'borderStyle');
        },
        options: [{
          value: 'solid',
          label: 'Solid'
        }, {
          value: 'dotted',
          label: 'Dotted'
        }, {
          value: 'dashed',
          label: 'Dashed'
        }, {
          value: 'double',
          label: 'Double'
        }, {
          value: 'groove',
          label: 'Groove'
        }, {
          value: 'ridge',
          label: 'Ridge'
        }, {
          value: 'inset',
          label: 'Inset'
        }, {
          value: 'outset',
          label: 'Outset'
        }]
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(ColorPalette, {
        value: this.state.borderColor,
        onChange: function onChange(value) {
          return _this3.changeSettings(value, 'borderColor');
        }
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_8__["__experimentalBoxControl"], {
        label: "Corner Radius",
        values: this.state.borderRadius,
        onChange: function onChange(value) {
          _this3.changeSettings(value, 'borderRadius');
        }
      }))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__["createElement"])("div", {
        className: "se2-container",
        style: this.props.SE2containerStyle
      }, this.props.children)];
    }
  }]);

  return SE2_container;
}(react__WEBPACK_IMPORTED_MODULE_7__["Component"]);



/***/ }),

/***/ "./blocks/src/section/section.js":
/*!***************************************!*\
  !*** ./blocks/src/section/section.js ***!
  \***************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/extends.js");
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/defineProperty */ "./node_modules/@babel/runtime/helpers/defineProperty.js");
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _shapes_slope_up_svg__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./shapes/slope-up.svg */ "./blocks/src/section/shapes/slope-up.svg");
/* harmony import */ var uuid__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! uuid */ "./node_modules/uuid/index.js");
/* harmony import */ var uuid__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(uuid__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _components_container__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../components/container */ "./blocks/src/components/container.js");




function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_1___default()(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }




var registerBlockType = wp.blocks.registerBlockType;
var _wp$blockEditor = wp.blockEditor,
    useBlockProps = _wp$blockEditor.useBlockProps,
    InnerBlocks = _wp$blockEditor.InnerBlocks,
    InspectorControls = _wp$blockEditor.InspectorControls,
    ColorPalette = _wp$blockEditor.ColorPalette;
var _wp$components = wp.components,
    PanelBody = _wp$components.PanelBody,
    Dropdown = _wp$components.Dropdown,
    MenuItem = _wp$components.MenuItem,
    MenuGroup = _wp$components.MenuGroup,
    Button = _wp$components.Button,
    RangeControl = _wp$components.RangeControl;

registerBlockType('se2block/section', {
  "apiVersion": 2,
  title: 'Section',
  description: 'Create and design your custom container',
  icon: 'star-filled',
  category: 'se2',
  //attributes
  attributes: {
    containerstyle: {
      type: 'object'
    },
    style: {
      type: 'object',
      default: {}
    },
    shapetop: {
      type: 'string',
      default: 'none'
    },
    shapetopcolor: {
      type: 'string',
      default: '#ffffff'
    },
    shapetopdimensions: {
      type: 'object',
      default: {
        width: 100,
        height: 100
      }
    },
    shapebottom: {
      type: 'string',
      default: 'none'
    },
    shapebottomcolor: {
      type: 'string',
      default: '#ffffff'
    },
    shapebottomdimensions: {
      type: 'object',
      default: {
        width: 100,
        height: 100
      }
    }
  },
  //built-in functions
  edit: function edit(_ref) {
    var attributes = _ref.attributes,
        setAttributes = _ref.setAttributes;
    var styleProps;

    if (attributes.containerstyle) {
      styleProps = attributes.containerstyle;
    } else {
      styleProps = {};
    }

    var uuid = Object(uuid__WEBPACK_IMPORTED_MODULE_5__["v4"])();

    function containerStyle(e, style) {
      setAttributes({
        containerstyle: e,
        style: style
      });
    }

    var shapes = [{
      name: 'Slope Up',
      slug: 'slopeUp',
      svg: Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("polygon", {
        className: "shape-".concat(uuid),
        points: "0,100 0,0 500,0"
      })
    }, {
      name: 'Slope Down',
      slug: 'slopeDown',
      svg: Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("polygon", {
        className: "shape-".concat(uuid),
        points: "0,0 500,0 500,100"
      })
    }];

    function handleShapeChange(e, position) {
      if (position === 'top') {
        setAttributes({
          shapetop: e.target.getAttribute('shape')
        });
      }

      if (position === 'bottom') {
        setAttributes({
          shapebottom: e.target.getAttribute('shape')
        });
      }

      var _iterator = _createForOfIteratorHelper(e.target.parentNode.childNodes),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var li = _step.value;
          li.style.backgroundColor = 'white';
        } //.map(li => { })

      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }

      e.target.style.backgroundColor = 'lightgrey';
      console.log(attributes);
    }

    function handleShapeColor(e, position) {
      console.log(attributes);

      if (position === 'top') {
        setAttributes({
          shapetopcolor: e
        });
      }

      if (position === 'bottom') {
        setAttributes({
          shapebottomcolor: e
        });
      }
    }

    function handleShapeDimenstion(e, position, dir) {
      console.log(attributes);

      if (position === 'top') {
        var dimension = _objectSpread({}, attributes.shapetopdimensions);

        dimension[dir] = e;
        setAttributes({
          shapetopdimensions: dimension
        });
      }

      if (position === 'bottom') {
        var _dimension = _objectSpread({}, attributes.shapebottomdimensions);

        _dimension[dir] = e;
        setAttributes({
          shapebottomdimensions: _dimension
        });
      }
    }

    var blockProps = useBlockProps();
    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["Fragment"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(InspectorControls, {
      style: {
        marginBottom: '40px'
      }
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(PanelBody, {
      title: 'Block Shape',
      initialOpen: false
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("p", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("strong", null, "Top Shape")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(MenuGroup, {
      style: {
        width: '50%'
      }
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("ul", null, shapes.map(function (shape) {
      var isActive = shape.slug === attributes.shapetop ? 'lightgrey' : 'white';
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("li", {
        shape: shape.slug,
        onClick: function onClick(e) {
          handleShapeChange(e, 'top');
        },
        style: {
          backgroundColor: isActive
        }
      }, shape.name, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
        style: {
          width: '50px'
        }
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("svg", {
        width: "100%",
        xmlns: "http://www.w3.org/2000/svg",
        viewBox: "0 0 500 100"
      }, shape.svg)));
    }))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(ColorPalette, {
      value: attributes.shapetopcolor,
      onChange: function onChange(value) {
        return handleShapeColor(value, 'top');
      }
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(RangeControl, {
      label: "Width in %",
      value: attributes.shapetopdimensions.width,
      onChange: function onChange(width) {
        return handleShapeDimenstion(width, 'top', 'width');
      },
      min: 100,
      max: 1000
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(RangeControl, {
      label: "Height in %",
      value: attributes.shapetopdimensions.height,
      onChange: function onChange(height) {
        return handleShapeDimenstion(height, 'top', 'height');
      },
      min: 5,
      max: 500
    }))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", blockProps, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(_components_container__WEBPACK_IMPORTED_MODULE_6__["default"], _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default()({}, blockProps, {
      key: 'edit',
      styleHandler: containerStyle,
      styleProps: styleProps
    }), attributes.shapetop !== 'none' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
      style: {
        overflow: 'hidden',
        position: 'absolute',
        top: '0',
        height: 'fit-content',
        width: '100%',
        left: '0',
        right: '0',
        margin: 'auto',
        display: 'flex'
      }
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("svg", {
      width: "100%",
      xmlns: "http://www.w3.org/2000/svg",
      viewBox: "0 0 500 100",
      style: {
        transform: "scale(".concat(attributes.shapetopdimensions.width, "%, ").concat(attributes.shapetopdimensions.height, "%)"),
        webkitTransform: "scale(".concat(attributes.shapetopdimensions.width, "%, ").concat(attributes.shapetopdimensions.height, "%)"),
        transformOrigin: 'top center'
      }
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("style", {
      dangerouslySetInnerHTML: {
        __html: "\n                                                  .shape-".concat(uuid, " {fill: ").concat(attributes.shapetopcolor, " !important}\n                                             ")
      }
    }), shapes.find(function (thisShape) {
      return thisShape.slug === attributes.shapetop;
    })['svg'])), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(InnerBlocks, {
      allowedBlocks: true,
      renderAppender: InnerBlocks.ButtonBlockAppender
    }))));
  },
  save: function save(_ref2) {
    var attributes = _ref2.attributes,
        setAttributes = _ref2.setAttributes;
    var blockProps = useBlockProps.save();
    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", blockProps, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
      style: attributes.style
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(InnerBlocks.Content, {
      style: {
        maxWidth: '100%'
      }
    })));
  },
  deprecated: [{
    attributes: {},
    save: function save(_ref3) {
      var attributes = _ref3.attributes,
          setAttributes = _ref3.setAttributes;
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
        style: attributes.style
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(InnerBlocks.Content, {
        style: {
          maxWidth: '100%'
        }
      })));
    }
  }]
});

/***/ }),

/***/ "./blocks/src/section/shapes/slope-up.svg":
/*!************************************************!*\
  !*** ./blocks/src/section/shapes/slope-up.svg ***!
  \************************************************/
/*! exports provided: default, ReactComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ReactComponent", function() { return SvgSlopeUp; });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
var _path;

function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }



function SvgSlopeUp(props) {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__["createElement"]("svg", _extends({
    xmlns: "http://www.w3.org/2000/svg",
    viewBox: "0 0 1920 98"
  }, props), _path || (_path = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0__["createElement"]("path", {
    fill: "#1d1d1b",
    d: "M0 98V0h1920z"
  })));
}

/* harmony default export */ __webpack_exports__["default"] = ("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyNS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iRWJlbmVfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAxOTIwIDk4IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAxOTIwIDk4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8c3R5bGUgdHlwZT0idGV4dC9jc3MiPg0KCS5zdDB7ZmlsbDojMUQxRDFCO30NCjwvc3R5bGU+DQo8cG9seWdvbiBjbGFzcz0ic3QwIiBwb2ludHM9IjAsOTggMCwwIDE5MjAsMCAiLz4NCjwvc3ZnPg0K");


/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/assertThisInitialized.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/assertThisInitialized.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _assertThisInitialized(self) {
  if (self === void 0) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return self;
}

module.exports = _assertThisInitialized;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/classCallCheck.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/classCallCheck.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

module.exports = _classCallCheck;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/createClass.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/createClass.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  return Constructor;
}

module.exports = _createClass;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/defineProperty.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/defineProperty.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }

  return obj;
}

module.exports = _defineProperty;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/extends.js":
/*!********************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/extends.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _extends() {
  module.exports = _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };

  module.exports["default"] = module.exports, module.exports.__esModule = true;
  return _extends.apply(this, arguments);
}

module.exports = _extends;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/getPrototypeOf.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _getPrototypeOf(o) {
  module.exports = _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {
    return o.__proto__ || Object.getPrototypeOf(o);
  };
  module.exports["default"] = module.exports, module.exports.__esModule = true;
  return _getPrototypeOf(o);
}

module.exports = _getPrototypeOf;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/inherits.js":
/*!*********************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/inherits.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var setPrototypeOf = __webpack_require__(/*! ./setPrototypeOf.js */ "./node_modules/@babel/runtime/helpers/setPrototypeOf.js");

function _inherits(subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function");
  }

  subClass.prototype = Object.create(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      writable: true,
      configurable: true
    }
  });
  if (superClass) setPrototypeOf(subClass, superClass);
}

module.exports = _inherits;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var _typeof = __webpack_require__(/*! @babel/runtime/helpers/typeof */ "./node_modules/@babel/runtime/helpers/typeof.js")["default"];

var assertThisInitialized = __webpack_require__(/*! ./assertThisInitialized.js */ "./node_modules/@babel/runtime/helpers/assertThisInitialized.js");

function _possibleConstructorReturn(self, call) {
  if (call && (_typeof(call) === "object" || typeof call === "function")) {
    return call;
  }

  return assertThisInitialized(self);
}

module.exports = _possibleConstructorReturn;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/setPrototypeOf.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/setPrototypeOf.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _setPrototypeOf(o, p) {
  module.exports = _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
    o.__proto__ = p;
    return o;
  };

  module.exports["default"] = module.exports, module.exports.__esModule = true;
  return _setPrototypeOf(o, p);
}

module.exports = _setPrototypeOf;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/typeof.js":
/*!*******************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/typeof.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _typeof(obj) {
  "@babel/helpers - typeof";

  if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
    module.exports = _typeof = function _typeof(obj) {
      return typeof obj;
    };

    module.exports["default"] = module.exports, module.exports.__esModule = true;
  } else {
    module.exports = _typeof = function _typeof(obj) {
      return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
    };

    module.exports["default"] = module.exports, module.exports.__esModule = true;
  }

  return _typeof(obj);
}

module.exports = _typeof;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/uuid/index.js":
/*!************************************!*\
  !*** ./node_modules/uuid/index.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var v1 = __webpack_require__(/*! ./v1 */ "./node_modules/uuid/v1.js");
var v4 = __webpack_require__(/*! ./v4 */ "./node_modules/uuid/v4.js");

var uuid = v4;
uuid.v1 = v1;
uuid.v4 = v4;

module.exports = uuid;


/***/ }),

/***/ "./node_modules/uuid/lib/bytesToUuid.js":
/*!**********************************************!*\
  !*** ./node_modules/uuid/lib/bytesToUuid.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Convert array of 16 byte values to UUID string format of the form:
 * XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
 */
var byteToHex = [];
for (var i = 0; i < 256; ++i) {
  byteToHex[i] = (i + 0x100).toString(16).substr(1);
}

function bytesToUuid(buf, offset) {
  var i = offset || 0;
  var bth = byteToHex;
  // join used to fix memory issue caused by concatenation: https://bugs.chromium.org/p/v8/issues/detail?id=3175#c4
  return ([
    bth[buf[i++]], bth[buf[i++]],
    bth[buf[i++]], bth[buf[i++]], '-',
    bth[buf[i++]], bth[buf[i++]], '-',
    bth[buf[i++]], bth[buf[i++]], '-',
    bth[buf[i++]], bth[buf[i++]], '-',
    bth[buf[i++]], bth[buf[i++]],
    bth[buf[i++]], bth[buf[i++]],
    bth[buf[i++]], bth[buf[i++]]
  ]).join('');
}

module.exports = bytesToUuid;


/***/ }),

/***/ "./node_modules/uuid/lib/rng-browser.js":
/*!**********************************************!*\
  !*** ./node_modules/uuid/lib/rng-browser.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Unique ID creation requires a high quality random # generator.  In the
// browser this is a little complicated due to unknown quality of Math.random()
// and inconsistent support for the `crypto` API.  We do the best we can via
// feature-detection

// getRandomValues needs to be invoked in a context where "this" is a Crypto
// implementation. Also, find the complete implementation of crypto on IE11.
var getRandomValues = (typeof(crypto) != 'undefined' && crypto.getRandomValues && crypto.getRandomValues.bind(crypto)) ||
                      (typeof(msCrypto) != 'undefined' && typeof window.msCrypto.getRandomValues == 'function' && msCrypto.getRandomValues.bind(msCrypto));

if (getRandomValues) {
  // WHATWG crypto RNG - http://wiki.whatwg.org/wiki/Crypto
  var rnds8 = new Uint8Array(16); // eslint-disable-line no-undef

  module.exports = function whatwgRNG() {
    getRandomValues(rnds8);
    return rnds8;
  };
} else {
  // Math.random()-based (RNG)
  //
  // If all else fails, use Math.random().  It's fast, but is of unspecified
  // quality.
  var rnds = new Array(16);

  module.exports = function mathRNG() {
    for (var i = 0, r; i < 16; i++) {
      if ((i & 0x03) === 0) r = Math.random() * 0x100000000;
      rnds[i] = r >>> ((i & 0x03) << 3) & 0xff;
    }

    return rnds;
  };
}


/***/ }),

/***/ "./node_modules/uuid/v1.js":
/*!*********************************!*\
  !*** ./node_modules/uuid/v1.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var rng = __webpack_require__(/*! ./lib/rng */ "./node_modules/uuid/lib/rng-browser.js");
var bytesToUuid = __webpack_require__(/*! ./lib/bytesToUuid */ "./node_modules/uuid/lib/bytesToUuid.js");

// **`v1()` - Generate time-based UUID**
//
// Inspired by https://github.com/LiosK/UUID.js
// and http://docs.python.org/library/uuid.html

var _nodeId;
var _clockseq;

// Previous uuid creation time
var _lastMSecs = 0;
var _lastNSecs = 0;

// See https://github.com/uuidjs/uuid for API details
function v1(options, buf, offset) {
  var i = buf && offset || 0;
  var b = buf || [];

  options = options || {};
  var node = options.node || _nodeId;
  var clockseq = options.clockseq !== undefined ? options.clockseq : _clockseq;

  // node and clockseq need to be initialized to random values if they're not
  // specified.  We do this lazily to minimize issues related to insufficient
  // system entropy.  See #189
  if (node == null || clockseq == null) {
    var seedBytes = rng();
    if (node == null) {
      // Per 4.5, create and 48-bit node id, (47 random bits + multicast bit = 1)
      node = _nodeId = [
        seedBytes[0] | 0x01,
        seedBytes[1], seedBytes[2], seedBytes[3], seedBytes[4], seedBytes[5]
      ];
    }
    if (clockseq == null) {
      // Per 4.2.2, randomize (14 bit) clockseq
      clockseq = _clockseq = (seedBytes[6] << 8 | seedBytes[7]) & 0x3fff;
    }
  }

  // UUID timestamps are 100 nano-second units since the Gregorian epoch,
  // (1582-10-15 00:00).  JSNumbers aren't precise enough for this, so
  // time is handled internally as 'msecs' (integer milliseconds) and 'nsecs'
  // (100-nanoseconds offset from msecs) since unix epoch, 1970-01-01 00:00.
  var msecs = options.msecs !== undefined ? options.msecs : new Date().getTime();

  // Per 4.2.1.2, use count of uuid's generated during the current clock
  // cycle to simulate higher resolution clock
  var nsecs = options.nsecs !== undefined ? options.nsecs : _lastNSecs + 1;

  // Time since last uuid creation (in msecs)
  var dt = (msecs - _lastMSecs) + (nsecs - _lastNSecs)/10000;

  // Per 4.2.1.2, Bump clockseq on clock regression
  if (dt < 0 && options.clockseq === undefined) {
    clockseq = clockseq + 1 & 0x3fff;
  }

  // Reset nsecs if clock regresses (new clockseq) or we've moved onto a new
  // time interval
  if ((dt < 0 || msecs > _lastMSecs) && options.nsecs === undefined) {
    nsecs = 0;
  }

  // Per 4.2.1.2 Throw error if too many uuids are requested
  if (nsecs >= 10000) {
    throw new Error('uuid.v1(): Can\'t create more than 10M uuids/sec');
  }

  _lastMSecs = msecs;
  _lastNSecs = nsecs;
  _clockseq = clockseq;

  // Per 4.1.4 - Convert from unix epoch to Gregorian epoch
  msecs += 12219292800000;

  // `time_low`
  var tl = ((msecs & 0xfffffff) * 10000 + nsecs) % 0x100000000;
  b[i++] = tl >>> 24 & 0xff;
  b[i++] = tl >>> 16 & 0xff;
  b[i++] = tl >>> 8 & 0xff;
  b[i++] = tl & 0xff;

  // `time_mid`
  var tmh = (msecs / 0x100000000 * 10000) & 0xfffffff;
  b[i++] = tmh >>> 8 & 0xff;
  b[i++] = tmh & 0xff;

  // `time_high_and_version`
  b[i++] = tmh >>> 24 & 0xf | 0x10; // include version
  b[i++] = tmh >>> 16 & 0xff;

  // `clock_seq_hi_and_reserved` (Per 4.2.2 - include variant)
  b[i++] = clockseq >>> 8 | 0x80;

  // `clock_seq_low`
  b[i++] = clockseq & 0xff;

  // `node`
  for (var n = 0; n < 6; ++n) {
    b[i + n] = node[n];
  }

  return buf ? buf : bytesToUuid(b);
}

module.exports = v1;


/***/ }),

/***/ "./node_modules/uuid/v4.js":
/*!*********************************!*\
  !*** ./node_modules/uuid/v4.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var rng = __webpack_require__(/*! ./lib/rng */ "./node_modules/uuid/lib/rng-browser.js");
var bytesToUuid = __webpack_require__(/*! ./lib/bytesToUuid */ "./node_modules/uuid/lib/bytesToUuid.js");

function v4(options, buf, offset) {
  var i = buf && offset || 0;

  if (typeof(options) == 'string') {
    buf = options === 'binary' ? new Array(16) : null;
    options = null;
  }
  options = options || {};

  var rnds = options.random || (options.rng || rng)();

  // Per 4.4, set bits for version and `clock_seq_hi_and_reserved`
  rnds[6] = (rnds[6] & 0x0f) | 0x40;
  rnds[8] = (rnds[8] & 0x3f) | 0x80;

  // Copy bytes to buffer, if provided
  if (buf) {
    for (var ii = 0; ii < 16; ++ii) {
      buf[i + ii] = rnds[ii];
    }
  }

  return buf || bytesToUuid(rnds);
}

module.exports = v4;


/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["components"]; }());

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["element"]; }());

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["React"]; }());

/***/ })

/******/ });
//# sourceMappingURL=section.js.map