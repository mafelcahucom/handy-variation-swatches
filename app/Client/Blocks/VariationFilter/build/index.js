/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/components/Field/Field.js":
/*!***************************************!*\
  !*** ./src/components/Field/Field.js ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _field_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./field.scss */ "./src/components/Field/field.scss");

/**
 * Internal dependencies
 */


/**
 * Field Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object}  children The children component 
 * @param {boolean} isShow   The component show state.
 */
var Field = function Field(_ref) {
  var children = _ref.children,
    _ref$isShow = _ref.isShow,
    isShow = _ref$isShow === void 0 ? true : _ref$isShow;
  var display = isShow ? 'block' : 'none';
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "hvsfw-vf-field",
    style: {
      display: display
    }
  }, children);
};
/* harmony default export */ __webpack_exports__["default"] = (Field);

/***/ }),

/***/ "./src/components/Field/index.js":
/*!***************************************!*\
  !*** ./src/components/Field/index.js ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Field__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Field */ "./src/components/Field/Field.js");

/* harmony default export */ __webpack_exports__["default"] = (_Field__WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./src/components/SearchList/SearchList.js":
/*!*************************************************!*\
  !*** ./src/components/SearchList/SearchList.js ***!
  \*************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/defineProperty */ "./node_modules/@babel/runtime/helpers/esm/defineProperty.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/esm/slicedToArray.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _data_attributeData__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../data/attributeData */ "./src/data/attributeData.js");
/* harmony import */ var _searchlist_scss__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./searchlist.scss */ "./src/components/SearchList/searchlist.scss");



function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { (0,_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__["default"])(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
/**
 * External dependencies
 */



/**
 * Internal dependencies
 */



/**
 * Search List Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object}   attributes    Contains the block attributes. 
 * @param {Function} setAttributes The block attributes setter.
 */
var SearchList = function SearchList(_ref) {
  var attributes = _ref.attributes,
    setAttributes = _ref.setAttributes,
    label = _ref.label;
  var blockId = attributes.blockId,
    settings = attributes.settings,
    searchList = attributes.searchList;
  var _useState = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.useState)(''),
    _useState2 = (0,_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1__["default"])(_useState, 2),
    keyword = _useState2[0],
    setKeyword = _useState2[1];
  var _useState3 = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.useState)([]),
    _useState4 = (0,_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1__["default"])(_useState3, 2),
    matchedOptions = _useState4[0],
    setMatchedOptions = _useState4[1];

  /**
   * Handle the search input onChange event and also
   * perform a simple search filter.
   * 
   * @since 1.0.0
   * 
   * @param {Object} e The target element event.
   */
  var handleKeyword = function handleKeyword(e) {
    setKeyword(e.target.value);
    var attributeOptions = _data_attributeData__WEBPACK_IMPORTED_MODULE_4__.attributeData.getSelectOptions();
    var matches = attributeOptions.filter(function (attributeOption) {
      var regex = new RegExp("^".concat(keyword), 'gi');
      return attributeOption.label.match(regex);
    });
    setMatchedOptions(matches);
  };

  /**
   * Handle the attribute radio button onChange event.
   * 
   * @since 1.0.0
   * 
   * @param {Object} e The target element event.
   */
  var handleAttributeRadio = function handleAttributeRadio(e) {
    setAttributes({
      settings: _objectSpread(_objectSpread({}, settings), {}, {
        attribute: e.target.value
      })
    });
  };

  /**
   * Returns the product attributes label and value for select options.
   * 
   * @since 1.0.0
   * 
   * @return {Array} The label and value of product attributes.
   */
  var getAttributeOptions = function getAttributeOptions() {
    return keyword ? matchedOptions : _data_attributeData__WEBPACK_IMPORTED_MODULE_4__.attributeData.getSelectOptions();
  };

  /**
   * Check if a certain radio button is checked.
   * 
   * @since 1.0.0
   * 
   * @param {string} value The value of the radio button. 
   * @return {boolean} If radio is checked.
   */
  var isRadioChecked = function isRadioChecked(value) {
    return settings.attribute === value;
  };

  /**
   * Return the current item state active or default.
   * 
   * @since 1.0.0
   * 
   * @param {string} value The value of the current item. 
   * @return {string} The new item state.
   */
  var getItemState = function getItemState(value) {
    return settings.attribute === value ? 'active' : 'default';
  };

  /**
   * Return the attribute list empty message placeholder.
   * 
   * @since 1.0.0
   * 
   * @return {string} The placeholder message.
   */
  var getPlaceholderMessage = function getPlaceholderMessage() {
    if (searchList.state === 'loading') {
      return 'Fetching Product Attributes.';
    }
    if (keyword) {
      return "No results for ".concat(keyword, ".");
    }
    return 'No Product Attributes Found.';
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("div", {
    className: "hvsfw-vf-search-list"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("div", {
    className: "hvsfw-vf-srl__mb-15"
  }, label && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("label", {
    className: "hvsfw-vf-srl__label"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)(label, 'variation-filter')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("input", {
    type: "text",
    className: "hvsfw-vf-srl__search-input",
    disabled: _data_attributeData__WEBPACK_IMPORTED_MODULE_4__.attributeData.isEmpty() ? 'disabled' : '',
    onChange: handleKeyword
  })), getAttributeOptions().length > 0 ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("ul", {
    className: "hvsfw-vf-srl__list"
  }, getAttributeOptions().map(function (option, index) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("li", {
      className: "hvsfw-vf-srl__list__item",
      state: getItemState(option.value),
      key: index
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("label", {
      htmlFor: "hvsfw-vf-attribute-".concat(blockId, "-").concat(index)
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("input", {
      type: "radio",
      id: "hvsfw-vf-attribute-".concat(blockId, "-").concat(index),
      name: "hvsfw-vf-attribute-".concat(blockId),
      value: option.value,
      checked: isRadioChecked(option.value),
      onChange: handleAttributeRadio
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("span", null, option.label)));
  })) : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("p", {
    className: "hvsfw-vf-srl__placeholder"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)(getPlaceholderMessage(), 'variation-filter')));
};
/* harmony default export */ __webpack_exports__["default"] = (SearchList);

/***/ }),

/***/ "./src/components/SearchList/index.js":
/*!********************************************!*\
  !*** ./src/components/SearchList/index.js ***!
  \********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SearchList__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SearchList */ "./src/components/SearchList/SearchList.js");

/* harmony default export */ __webpack_exports__["default"] = (_SearchList__WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./src/components/Section/Section.js":
/*!*******************************************!*\
  !*** ./src/components/Section/Section.js ***!
  \*******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _section_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./section.scss */ "./src/components/Section/section.scss");

/**
 * Internal dependencies
 */


/**
 * Section Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object}  children The children component 
 * @param {boolean} isShow   The component show state.
 */
var Section = function Section(_ref) {
  var children = _ref.children,
    _ref$isShow = _ref.isShow,
    isShow = _ref$isShow === void 0 ? true : _ref$isShow;
  var display = isShow ? 'block' : 'none';
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "hvsfw-vf-section",
    style: {
      display: display
    }
  }, children);
};
/* harmony default export */ __webpack_exports__["default"] = (Section);

/***/ }),

/***/ "./src/components/Section/index.js":
/*!*****************************************!*\
  !*** ./src/components/Section/index.js ***!
  \*****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Section__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Section */ "./src/components/Section/Section.js");

/* harmony default export */ __webpack_exports__["default"] = (_Section__WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./src/components/SwatchButton/SwatchButton.js":
/*!*****************************************************!*\
  !*** ./src/components/SwatchButton/SwatchButton.js ***!
  \*****************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/defineProperty */ "./node_modules/@babel/runtime/helpers/esm/defineProperty.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _utils_Helper__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/Helper */ "./src/utils/Helper.js");
/* harmony import */ var _data_attributeData__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../data/attributeData */ "./src/data/attributeData.js");
/* harmony import */ var _swatchbutton_scss__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./swatchbutton.scss */ "./src/components/SwatchButton/swatchbutton.scss");


function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { (0,_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__["default"])(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
/**
 * Internal dependencies
 */




/**
 * Swatch Button Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object} attributes Contains the block attributes.
 */
var SwatchButton = function SwatchButton(_ref) {
  var attributes = _ref.attributes;
  var settings = attributes.settings,
    button = attributes.button;
  var terms = _data_attributeData__WEBPACK_IMPORTED_MODULE_3__.attributeData.get(settings.attribute).terms;

  /**
   * Handle the mouse enter event.
   * 
   * @since 1.0.0
   * 
   * @param {Object} e The target element event.
   */
  var handleMouseEnter = function handleMouseEnter(e) {
    var target = e.target;
    var colorActive = button.colorActive,
      backgroundColorActive = button.backgroundColorActive,
      borderActive = button.borderActive;
    target.style.color = colorActive;
    target.style.backgroundColor = backgroundColorActive;
    _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.setBorder(target, _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.getBorders(borderActive));
  };

  /**
   * Handle the mouse leave event.
   * 
   * @since 1.0.0
   * 
   * @param {Object} e The target element event.
   */
  var handleMouseLeave = function handleMouseLeave(e) {
    var target = e.target;
    var color = button.color,
      backgroundColor = button.backgroundColor,
      border = button.border;
    target.style.color = color;
    target.style.backgroundColor = backgroundColor;
    _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.setBorder(target, _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.getBorders(border));
  };

  /**
   * Return the list inline style.
   * 
   * @since 1.0.0
   * 
   * @return {Object} Contains the styles.
   */
  var getInlineStyle = function getInlineStyle() {
    var shape = button.shape,
      width = button.width,
      height = button.height,
      fontSize = button.fontSize,
      fontWeight = button.fontWeight,
      color = button.color,
      backgroundColor = button.backgroundColor,
      padding = button.padding,
      border = button.border,
      borderRadius = button.borderRadius;
    var style = {
      minWidth: width,
      minHeight: height,
      color: color,
      fontSize: fontSize,
      fontWeight: fontWeight,
      backgroundColor: backgroundColor,
      borderRadius: borderRadius
    };
    if (['square', 'circle'].includes(shape)) {
      style.borderRadius = shape === 'circle' ? '100%' : '0px';
    }
    if (!_utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.isObjectEmpty(padding)) {
      style.padding = _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.getPadding(padding);
    }
    if (!_utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.isObjectEmpty(border)) {
      var borders = _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.getBorders(border);
      style = _objectSpread(_objectSpread({}, style), borders);
    }
    return style;
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "hvsfw-vf-swatch-button",
    style: {
      gap: button.gap
    }
  }, terms.map(function (term, index) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
      className: "hvsfw-vf-swatch-button__box",
      style: getInlineStyle(),
      onMouseEnter: handleMouseEnter,
      onMouseLeave: handleMouseLeave,
      key: index
    }, term.name, " ", settings.showCount && "(".concat(term.count, ")"));
  }));
};
/* harmony default export */ __webpack_exports__["default"] = (SwatchButton);

/***/ }),

/***/ "./src/components/SwatchButton/index.js":
/*!**********************************************!*\
  !*** ./src/components/SwatchButton/index.js ***!
  \**********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SwatchButton__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SwatchButton */ "./src/components/SwatchButton/SwatchButton.js");

/* harmony default export */ __webpack_exports__["default"] = (_SwatchButton__WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./src/components/SwatchColor/SwatchColor.js":
/*!***************************************************!*\
  !*** ./src/components/SwatchColor/SwatchColor.js ***!
  \***************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/defineProperty */ "./node_modules/@babel/runtime/helpers/esm/defineProperty.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _utils_Helper__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/Helper */ "./src/utils/Helper.js");
/* harmony import */ var _data_attributeData__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../data/attributeData */ "./src/data/attributeData.js");
/* harmony import */ var _swatchcolor_scss__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./swatchcolor.scss */ "./src/components/SwatchColor/swatchcolor.scss");


function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { (0,_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__["default"])(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
/**
 * Internal dependencies
 */




/**
 * Swatch Color Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object} attributes Contains the block attributes.
 */
var SwatchColor = function SwatchColor(_ref) {
  var attributes = _ref.attributes;
  var settings = attributes.settings,
    color = attributes.color;
  var terms = _data_attributeData__WEBPACK_IMPORTED_MODULE_3__.attributeData.get(settings.attribute).terms;

  /**
   * Handle the mouse enter event.
   * 
   * @since 1.0.0
   * 
   * @param {Object} e The target element event.
   */
  var handleMouseEnter = function handleMouseEnter(e) {
    _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.setBorder(e.target, _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.getBorders(color.borderActive));
  };

  /**
   * Handle the mouse leave event.
   * 
   * @since 1.0.0
   * 
   * @param {Object} e The target element event.
   */
  var handleMouseLeave = function handleMouseLeave(e) {
    _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.setBorder(e.target, _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.getBorders(color.border));
  };

  /**
   * Return the list inline style.
   * 
   * @since 1.0.0
   * 
   * @return {Object} Contains the styles.
   */
  var getInlineStyle = function getInlineStyle() {
    var shape = color.shape,
      size = color.size,
      width = color.width,
      height = color.height,
      border = color.border,
      borderRadius = color.borderRadius;
    var style = {
      width: size,
      height: size
    };
    if (shape === 'custom') {
      style.width = width;
      style.height = height;
      style.borderRadius = borderRadius;
    } else {
      style.borderRadius = shape === 'circle' ? '100%' : '0px';
    }
    if (!_utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.isObjectEmpty(border)) {
      var borders = _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.getBorders(border);
      style = _objectSpread(_objectSpread({}, style), borders);
    }
    return style;
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "hvsfw-vf-swatch-color",
    style: {
      gap: color.gap
    }
  }, terms.map(function (term, index) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
      className: "hvsfw-vf-swatch-color__box",
      style: getInlineStyle(),
      onMouseEnter: handleMouseEnter,
      onMouseLeave: handleMouseLeave,
      key: index
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
      className: "hvsfw-vf-swatch-color__color",
      style: {
        background: _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.getLinearColor(term.meta)
      }
    }));
  }));
};
/* harmony default export */ __webpack_exports__["default"] = (SwatchColor);

/***/ }),

/***/ "./src/components/SwatchColor/index.js":
/*!*********************************************!*\
  !*** ./src/components/SwatchColor/index.js ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SwatchColor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SwatchColor */ "./src/components/SwatchColor/SwatchColor.js");

/* harmony default export */ __webpack_exports__["default"] = (_SwatchColor__WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./src/components/SwatchImage/SwatchImage.js":
/*!***************************************************!*\
  !*** ./src/components/SwatchImage/SwatchImage.js ***!
  \***************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/defineProperty */ "./node_modules/@babel/runtime/helpers/esm/defineProperty.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _utils_Helper__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/Helper */ "./src/utils/Helper.js");
/* harmony import */ var _data_attributeData__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../data/attributeData */ "./src/data/attributeData.js");
/* harmony import */ var _swatchimage_scss__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./swatchimage.scss */ "./src/components/SwatchImage/swatchimage.scss");


function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { (0,_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__["default"])(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
/**
 * Internal dependencies
 */




/**
 * Swatch Image Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object} attributes Contains the block attributes.
 */
var SwatchImage = function SwatchImage(_ref) {
  var attributes = _ref.attributes;
  var settings = attributes.settings,
    image = attributes.image;
  var terms = _data_attributeData__WEBPACK_IMPORTED_MODULE_3__.attributeData.get(settings.attribute).terms;

  /**
   * Handle the mouse enter event.
   * 
   * @since 1.0.0
   * 
   * @param {Object} e The target element event.
   */
  var handleMouseEnter = function handleMouseEnter(e) {
    _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.setBorder(e.target, _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.getBorders(image.borderActive));
  };

  /**
   * Handle the mouse leave event.
   * 
   * @since 1.0.0
   * 
   * @param {Object} e The target element event.
   */
  var handleMouseLeave = function handleMouseLeave(e) {
    _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.setBorder(e.target, _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.getBorders(image.border));
  };

  /**
   * Return the list inline style.
   * 
   * @since 1.0.0
   * 
   * @return {Object} Contains the styles.
   */
  var getInlineStyle = function getInlineStyle() {
    var shape = image.shape,
      size = image.size,
      width = image.width,
      height = image.height,
      border = image.border,
      borderRadius = image.borderRadius;
    var style = {
      width: size,
      height: size
    };
    if (shape === 'custom') {
      style.width = width;
      style.height = height;
      style.borderRadius = borderRadius;
    } else {
      style.borderRadius = shape === 'circle' ? '100%' : '0px';
    }
    if (!_utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.isObjectEmpty(border)) {
      var borders = _utils_Helper__WEBPACK_IMPORTED_MODULE_2__.helper.getBorders(border);
      style = _objectSpread(_objectSpread({}, style), borders);
    }
    return style;
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "hvsfw-vf-swatch-image",
    style: {
      gap: image.gap
    }
  }, terms.map(function (term, index) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
      className: "hvsfw-vf-swatch-image__box",
      style: getInlineStyle(),
      onMouseEnter: handleMouseEnter,
      onMouseLeave: handleMouseLeave,
      key: index
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
      className: "hvsfw-vf-swatch-image__image",
      style: {
        backgroundImage: "url(".concat(term.meta.src, ")")
      }
    }));
  }));
};
/* harmony default export */ __webpack_exports__["default"] = (SwatchImage);

/***/ }),

/***/ "./src/components/SwatchImage/index.js":
/*!*********************************************!*\
  !*** ./src/components/SwatchImage/index.js ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SwatchImage__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SwatchImage */ "./src/components/SwatchImage/SwatchImage.js");

/* harmony default export */ __webpack_exports__["default"] = (_SwatchImage__WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./src/components/SwatchList/SwatchList.js":
/*!*************************************************!*\
  !*** ./src/components/SwatchList/SwatchList.js ***!
  \*************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_objectWithoutProperties__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/objectWithoutProperties */ "./node_modules/@babel/runtime/helpers/esm/objectWithoutProperties.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _data_attributeData__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../data/attributeData */ "./src/data/attributeData.js");
/* harmony import */ var _swatchlist_scss__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./swatchlist.scss */ "./src/components/SwatchList/swatchlist.scss");

var _excluded = ["colorActive", "marginBottom"];

/**
 * Internal dependencies
 */



/**
 * Swatch List Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object} attributes Contains the block attributes.
 */
var SwatchList = function SwatchList(_ref) {
  var attributes = _ref.attributes;
  var settings = attributes.settings,
    list = attributes.list;
  var terms = _data_attributeData__WEBPACK_IMPORTED_MODULE_2__.attributeData.get(settings.attribute).terms;

  /**
   * Handle the mouse enter event.
   * 
   * @since 1.0.0
   * 
   * @param {Object} e The target element event.
   */
  var handleMouseEnter = function handleMouseEnter(e) {
    e.target.style.color = list.colorActive;
  };

  /**
   * Handle the mouse leave event.
   * 
   * @since 1.0.0
   * 
   * @param {Object} e The target element event.
   */
  var handleMouseLeave = function handleMouseLeave(e) {
    e.target.style.color = list.color;
  };

  /**
   * Return the list inline style.
   * 
   * @since 1.0.0
   * 
   * @return {Object} Contains the style.
   */
  var getInlineStyle = function getInlineStyle() {
    var colorActive = list.colorActive,
      marginBottom = list.marginBottom,
      style = (0,_babel_runtime_helpers_objectWithoutProperties__WEBPACK_IMPORTED_MODULE_0__["default"])(list, _excluded);
    return style;
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("ul", {
    className: "hvsfw-vf-swatch-list"
  }, terms.map(function (term, index) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("li", {
      style: {
        marginBottom: list.marginBottom
      },
      key: index
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", {
      style: getInlineStyle(),
      onMouseEnter: handleMouseEnter,
      onMouseLeave: handleMouseLeave
    }, term.name, " ", settings.showCount && "(".concat(term.count, ")")));
  }));
};
/* harmony default export */ __webpack_exports__["default"] = (SwatchList);

/***/ }),

/***/ "./src/components/SwatchList/index.js":
/*!********************************************!*\
  !*** ./src/components/SwatchList/index.js ***!
  \********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SwatchList__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SwatchList */ "./src/components/SwatchList/SwatchList.js");

/* harmony default export */ __webpack_exports__["default"] = (_SwatchList__WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./src/components/SwatchSelect/SwatchSelect.js":
/*!*****************************************************!*\
  !*** ./src/components/SwatchSelect/SwatchSelect.js ***!
  \*****************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/defineProperty */ "./node_modules/@babel/runtime/helpers/esm/defineProperty.js");
/* harmony import */ var _babel_runtime_helpers_objectWithoutProperties__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/objectWithoutProperties */ "./node_modules/@babel/runtime/helpers/esm/objectWithoutProperties.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _utils_Helper__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../utils/Helper */ "./src/utils/Helper.js");
/* harmony import */ var _data_attributeData__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../data/attributeData */ "./src/data/attributeData.js");
/* harmony import */ var _swatchselect_scss__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./swatchselect.scss */ "./src/components/SwatchSelect/swatchselect.scss");


var _excluded = ["padding", "border"];

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { (0,_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__["default"])(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
/**
 * Internal dependencies
 */




/**
 * Swatch Select Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object} attributes Contains the block attributes.
 */
var SwatchSelect = function SwatchSelect(_ref) {
  var attributes = _ref.attributes;
  var settings = attributes.settings,
    select = attributes.select;
  var attribute = _data_attributeData__WEBPACK_IMPORTED_MODULE_4__.attributeData.get(settings.attribute);
  var terms = attribute.terms;

  /**
   * Return the list inline style.
   * 
   * @since 1.0.0
   * 
   * @return {Object} Contains the style.
   */
  var getInlineStyle = function getInlineStyle() {
    var padding = select.padding,
      border = select.border,
      style = (0,_babel_runtime_helpers_objectWithoutProperties__WEBPACK_IMPORTED_MODULE_1__["default"])(select, _excluded);
    if (!_utils_Helper__WEBPACK_IMPORTED_MODULE_3__.helper.isObjectEmpty(select.padding)) {
      style.padding = _utils_Helper__WEBPACK_IMPORTED_MODULE_3__.helper.getPadding(select.padding);
    }
    if (!_utils_Helper__WEBPACK_IMPORTED_MODULE_3__.helper.isObjectEmpty(select.border)) {
      var borders = _utils_Helper__WEBPACK_IMPORTED_MODULE_3__.helper.getBorders(select.border);
      style = _objectSpread(_objectSpread({}, style), borders);
    }
    return style;
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("select", {
    className: "hvsfw-vf-swatch-select",
    style: getInlineStyle()
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("option", null, "Select ", attribute.attribute_label), terms.map(function (term, index) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_2__.createElement)("option", {
      key: index
    }, term.name, " ", settings.showCount && "(".concat(term.count, ")"));
  }));
};
/* harmony default export */ __webpack_exports__["default"] = (SwatchSelect);

/***/ }),

/***/ "./src/components/SwatchSelect/index.js":
/*!**********************************************!*\
  !*** ./src/components/SwatchSelect/index.js ***!
  \**********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SwatchSelect__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SwatchSelect */ "./src/components/SwatchSelect/SwatchSelect.js");

/* harmony default export */ __webpack_exports__["default"] = (_SwatchSelect__WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./src/components/index.js":
/*!*********************************!*\
  !*** ./src/components/index.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Field": function() { return /* reexport safe */ _Field__WEBPACK_IMPORTED_MODULE_1__["default"]; },
/* harmony export */   "SearchList": function() { return /* reexport safe */ _SearchList__WEBPACK_IMPORTED_MODULE_2__["default"]; },
/* harmony export */   "Section": function() { return /* reexport safe */ _Section__WEBPACK_IMPORTED_MODULE_0__["default"]; },
/* harmony export */   "SwatchButton": function() { return /* reexport safe */ _SwatchButton__WEBPACK_IMPORTED_MODULE_5__["default"]; },
/* harmony export */   "SwatchColor": function() { return /* reexport safe */ _SwatchColor__WEBPACK_IMPORTED_MODULE_6__["default"]; },
/* harmony export */   "SwatchImage": function() { return /* reexport safe */ _SwatchImage__WEBPACK_IMPORTED_MODULE_7__["default"]; },
/* harmony export */   "SwatchList": function() { return /* reexport safe */ _SwatchList__WEBPACK_IMPORTED_MODULE_3__["default"]; },
/* harmony export */   "SwatchSelect": function() { return /* reexport safe */ _SwatchSelect__WEBPACK_IMPORTED_MODULE_4__["default"]; }
/* harmony export */ });
/* harmony import */ var _Section__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Section */ "./src/components/Section/index.js");
/* harmony import */ var _Field__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Field */ "./src/components/Field/index.js");
/* harmony import */ var _SearchList__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./SearchList */ "./src/components/SearchList/index.js");
/* harmony import */ var _SwatchList__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./SwatchList */ "./src/components/SwatchList/index.js");
/* harmony import */ var _SwatchSelect__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./SwatchSelect */ "./src/components/SwatchSelect/index.js");
/* harmony import */ var _SwatchButton__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./SwatchButton */ "./src/components/SwatchButton/index.js");
/* harmony import */ var _SwatchColor__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./SwatchColor */ "./src/components/SwatchColor/index.js");
/* harmony import */ var _SwatchImage__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./SwatchImage */ "./src/components/SwatchImage/index.js");










/***/ }),

/***/ "./src/data/attributeData.js":
/*!***********************************!*\
  !*** ./src/data/attributeData.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "attributeData": function() { return /* binding */ data; }
/* harmony export */ });
/**
 * Product Attributes Data.
 * 
 * @since 1.0.0
 * 
 * @type {Object}
 * @author Mafel John Cahucom
 */
var data = {
  /**
  * Checks if there's an available variation attributes.
  * 
  * @since 1.0.0
  * 
  * @return {boolean} Check if not empty attributes.
  */
  isEmpty: function isEmpty() {
    return data.getAll().length === 0;
  },
  /**
   * Checks if the attribute name is found in product attributes.
   * 
   * @since 1.0.0
   * 
   * @param {string} name The name of the product attribute.
   * @return {boolean} If the attribute name is found.
   */
  isFound: function isFound(name) {
    if (!name) {
      return false;
    }
    return Object.keys(data.get(name)).length > 0;
  },
  /**
  * Returns all the product attributes into an array.
  * 
  * @since 1.0.0
  * 
  * @return {Array} Converted array attributes.
  */
  getAll: function getAll() {
    var attributes = window.hvsfwVfData.productAttributes;
    if (attributes === null || attributes === undefined) {
      return [];
    }
    return Object.entries(attributes).map(function (attribute) {
      return attribute[1];
    });
  },
  /**
   * Returns certain product attribute based on attribute name.
   * 
   * @since 1.0.0
   * 
   * @param {string} name The name of the product attribute.
   */
  get: function get(name) {
    if (!name || data.getAll().length === 0) {
      return {};
    }
    var found = data.getAll().filter(function (attribute) {
      return attribute.attribute_name === name;
    });
    return found.length > 0 ? found[0] : {};
  },
  /**
  * Returns the product attribute value and label.
  * 
  * @since 1.0.0
  * 
  * @return {Array} Contains the SelectControl options.
  */
  getSelectOptions: function getSelectOptions() {
    var options = [];
    if (!data.isEmpty()) {
      data.getAll().forEach(function (attribute) {
        options.push({
          value: attribute.attribute_name,
          label: attribute.attribute_label
        });
      });
    }
    return options;
  }
};


/***/ }),

/***/ "./src/data/generalData.js":
/*!*********************************!*\
  !*** ./src/data/generalData.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "generalData": function() { return /* binding */ data; }
/* harmony export */ });
/**
 * General Data.
 * 
 * @since 1.0.0
 * 
 * @type {Object}
 * @author Mafel John Cahucom
 */
var data = {
  /**
   * Holds the list of font weight and its label
   * 
   * @since 1.0.0
   * 
   * @returns {Array} The font weight value and label.
   */
  fontWeightChoices: [{
    value: '100',
    label: '100'
  }, {
    value: '200',
    label: '200'
  }, {
    value: '300',
    label: '300'
  }, {
    value: '400',
    label: '400'
  }, {
    value: '500',
    label: '500'
  }, {
    value: '600',
    label: '600'
  }, {
    value: '700',
    label: '700'
  }, {
    value: '800',
    label: '800'
  }, {
    value: '900',
    label: '900'
  }]
};


/***/ }),

/***/ "./src/edit.js":
/*!*********************!*\
  !*** ./src/edit.js ***!
  \*********************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Edit; }
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_helpers_objectWithoutProperties__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/objectWithoutProperties */ "./node_modules/@babel/runtime/helpers/esm/objectWithoutProperties.js");
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/defineProperty */ "./node_modules/@babel/runtime/helpers/esm/defineProperty.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/regenerator */ "@babel/runtime/regenerator");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _icon__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./icon */ "./src/icon.js");
/* harmony import */ var _utils_Helper__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./utils/Helper */ "./src/utils/Helper.js");
/* harmony import */ var _lib_getFetch__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./lib/getFetch */ "./src/lib/getFetch.js");
/* harmony import */ var _data_generalData__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./data/generalData */ "./src/data/generalData.js");
/* harmony import */ var _data_attributeData__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./data/attributeData */ "./src/data/attributeData.js");
/* harmony import */ var _components__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./components */ "./src/components/index.js");
/* harmony import */ var _editor_scss__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./editor.scss */ "./src/editor.scss");



var _excluded = ["text"];


function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { (0,_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_2__["default"])(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
/**
 * External dependencies
 */





/**
 * Internal dependencies
 */








/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @return {WPElement} Element to render.
 */
function Edit(_ref) {
  var attributes = _ref.attributes,
    setAttributes = _ref.setAttributes,
    clientId = _ref.clientId;
  var blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.useBlockProps)();
  var blockId = attributes.blockId,
    productAttributes = attributes.productAttributes,
    settings = attributes.settings,
    searchList = attributes.searchList,
    title = attributes.title,
    list = attributes.list,
    select = attributes.select,
    button = attributes.button,
    color = attributes.color,
    image = attributes.image;
  var hasAttribute = _data_attributeData__WEBPACK_IMPORTED_MODULE_12__.attributeData.isFound(settings.attribute);

  /**
   * Handle multiple input value.
   * 
   * @since 1.0.0
   * 
   * @param {string} objectName 	The target object name in setAttributes.
   * @param {string} propertyName The target property key of object.
   * @param {string} newValue		The new value from input. 
   */
  var handleValue = function handleValue(objectName, propertyName, newValue) {
    var object = attributes[objectName];
    setAttributes((0,_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_2__["default"])({}, objectName, _objectSpread(_objectSpread({}, object), {}, (0,_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_2__["default"])({}, propertyName, newValue))));
  };

  /**
   * Return the final display type based on block displayType and
   * product attribute_type.
   * 
   * @since 1.0.0
   * 
   * @return {string} The final display type.
   */
  var getDisplayType = function getDisplayType() {
    var attribute = settings.attribute,
      displayType = settings.displayType;
    if (displayType === 'swatch') {
      var currentAttribute = _data_attributeData__WEBPACK_IMPORTED_MODULE_12__.attributeData.get(attribute);
      if (!_utils_Helper__WEBPACK_IMPORTED_MODULE_9__.helper.isObjectEmpty(currentAttribute)) {
        var types = ['button', 'color', 'image', 'select'];
        if (types.includes(currentAttribute.attribute_type)) {
          return currentAttribute.attribute_type;
        }
      }
    }
    return displayType !== 'swatch' ? displayType : '';
  };

  /**
   * Return the title text and set when first added in editor.
   * 
   * @since 1.0.0
   * 
   * @return {string} The title text.
   */
  var getTitleText = function getTitleText() {
    if (title.text !== null) {
      return title.text;
    }
    var attribute = _data_attributeData__WEBPACK_IMPORTED_MODULE_12__.attributeData.get(settings.attribute);
    var newText = "Filter By ".concat(attribute.attribute_label);
    setAttributes({
      title: _objectSpread(_objectSpread({}, title), {}, {
        text: newText
      })
    });
    return newText;
  };

  /**
   * Returns the title inline style.
   * 
   * @since 1.0.0
   * 
   * @return {Object} The title style.
   */
  var getTitleStyle = function getTitleStyle() {
    var text = title.text,
      rest = (0,_babel_runtime_helpers_objectWithoutProperties__WEBPACK_IMPORTED_MODULE_1__["default"])(title, _excluded);
    rest.display = 'block';
    return rest;
  };

  /**
   * Use Effect Hoock.
   * 
   * @since 1.0.0
   */
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useEffect)(function () {
    /**
     * Set the block attribute blockId.
     * 
     * @since 1.0.0
     */
    var setBlockId = function setBlockId() {
      if (!blockId) {
        setAttributes({
          blockId: clientId
        });
      }
    };
    setBlockId();

    /**
     * Set the block attribute productAttributes and
     * localize it also in window.
     * 
     * @since 1.0.0
     */
    var setProductAttributes = /*#__PURE__*/function () {
      var _ref2 = (0,_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default().mark(function _callee() {
        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              if (!(window.hvsfwVfData.productAttributes === undefined)) {
                _context.next = 7;
                break;
              }
              _context.next = 3;
              return (0,_lib_getFetch__WEBPACK_IMPORTED_MODULE_10__.getFetch)({
                nonce: hvsfwVfData.nonce.getProductAttributes,
                action: 'hvsfw_vf_get_product_attributes'
              });
            case 3:
              res = _context.sent;
              if (res.success === true && res.data.response === 'SUCCESS') {
                setAttributes({
                  productAttributes: res.data.attributes
                });
                window.hvsfwVfData.productAttributes = res.data.attributes;
              }
              _context.next = 8;
              break;
            case 7:
              setAttributes({
                productAttributes: window.hvsfwVfData.productAttributes
              });
            case 8:
              // Update searchList component state.
              setAttributes({
                searchList: _objectSpread(_objectSpread({}, searchList), {}, {
                  state: 'default'
                })
              });
            case 9:
            case "end":
              return _context.stop();
          }
        }, _callee);
      }));
      return function setProductAttributes() {
        return _ref2.apply(this, arguments);
      };
    }();
    setProductAttributes();
  }, [productAttributes]);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.Panel, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Section, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.PanelBody, {
    title: "Product Attribute",
    initialOpen: false
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.SearchList, {
    attributes: attributes,
    setAttributes: setAttributes,
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Search For A Product Attribute', 'variation-filter')
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Section, {
    isShow: hasAttribute
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.PanelBody, {
    title: "General",
    initialOpen: false
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, {
    isShow: ['list', 'select', 'button'].includes(getDisplayType())
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.ToggleControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Show Product Count', 'variation-filter'),
    help: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Shows the total product count on each term.', 'variation-filter'),
    checked: settings.showCount,
    onChange: function onChange(value) {
      return handleValue('settings', 'showCount', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Display Type', 'variation-filter'),
    help: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Choose the display type representation.'),
    value: settings.displayType,
    onChange: function onChange(value) {
      return handleValue('settings', 'displayType', value);
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "swatch",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Swatch', 'variation-filter')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "select",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Select', 'variation-filter')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "list",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('List', 'variation-filter')
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Query Type', 'variation-filter'),
    help: settings.queryType === 'and' ? (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Choose to return filter results for any of the attributes selected.', 'variation-filter') : (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Choose to return filter results for all of the attributes selected.', 'variation-filter'),
    value: settings.queryType,
    onChange: function onChange(value) {
      return handleValue('settings', 'queryType', value);
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "or",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Or', 'variation-filter')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "and",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('And', 'variation-filter')
  }))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Section, {
    isShow: hasAttribute
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.PanelBody, {
    title: "Title",
    initialOpen: false
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.TextControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Text', 'variation-filter'),
    value: title.text,
    onChange: function onChange(value) {
      return handleValue('title', 'text', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Font Size', 'variation-filter'),
    value: title.fontSize,
    onChange: function onChange(value) {
      return handleValue('title', 'fontSize', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.SelectControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Font Weight', 'variation-filter'),
    value: title.fontWeight,
    options: _data_generalData__WEBPACK_IMPORTED_MODULE_11__.generalData.fontWeightChoices,
    onChange: function onChange(value) {
      return handleValue('title', 'fontWeight', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Line Height', 'variation-filter'),
    value: title.lineHeight,
    onChange: function onChange(value) {
      return handleValue('title', 'lineHeight', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Margin Bottom', 'variation-filter'),
    value: title.marginBottom,
    onChange: function onChange(value) {
      return handleValue('title', 'marginBottom', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.BaseControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Color', 'variation-filter')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.ColorPalette, {
    value: title.color,
    clearable: false,
    onChange: function onChange(value) {
      return handleValue('title', 'color', value);
    }
  }))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Section, {
    isShow: getDisplayType() === 'list'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.PanelBody, {
    title: "List Style",
    initialOpen: false
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Font Size', 'variation-filter'),
    value: list.fontSize,
    onChange: function onChange(value) {
      return handleValue('list', 'fontSize', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.SelectControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Font Weight', 'variation-filter'),
    value: list.fontWeight,
    options: _data_generalData__WEBPACK_IMPORTED_MODULE_11__.generalData.fontWeightChoices,
    onChange: function onChange(value) {
      return handleValue('list', 'fontWeight', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Line Height', 'variation-filter'),
    value: list.lineHeight,
    onChange: function onChange(value) {
      return handleValue('list', 'lineHeight', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Margin Bottom', 'variation-filter'),
    value: list.marginBottom,
    onChange: function onChange(value) {
      return handleValue('list', 'marginBottom', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.Flex, {
    gap: "12px"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.FlexItem, {
    isBlock: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.BaseControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Text Color', 'variation-filter')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.ColorPalette, {
    value: list.color,
    clearable: false,
    onChange: function onChange(value) {
      return handleValue('list', 'color', value);
    }
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.FlexItem, {
    isBlock: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.BaseControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Text Color Active', 'variation-filter')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.ColorPalette, {
    value: list.colorActive,
    clearable: false,
    onChange: function onChange(value) {
      return handleValue('list', 'colorActive', value);
    }
  })))))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Section, {
    isShow: getDisplayType() === 'select'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.PanelBody, {
    title: "Select Style",
    initialOpen: false
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalGrid, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Width', 'variation-filter'),
    value: select.width,
    onChange: function onChange(value) {
      return handleValue('select', 'width', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Height', 'variation-filter'),
    value: select.height,
    onChange: function onChange(value) {
      return handleValue('select', 'height', value);
    }
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalGrid, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Font Size', 'variation-filter'),
    value: select.fontSize,
    onChange: function onChange(value) {
      return handleValue('select', 'fontSize', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.SelectControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Font Weight', 'variation-filter'),
    value: select.fontWeight,
    options: _data_generalData__WEBPACK_IMPORTED_MODULE_11__.generalData.fontWeightChoices,
    onChange: function onChange(value) {
      return handleValue('select', 'fontWeight', value);
    }
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalBoxControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Padding', 'variation-filter'),
    values: select.padding,
    onChange: function onChange(value) {
      return handleValue('select', 'padding', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalBorderBoxControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Border', 'variation-filter'),
    value: select.border,
    onChange: function onChange(value) {
      return handleValue('select', 'border', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.Flex, {
    gap: "12px"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.FlexItem, {
    isBlock: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.BaseControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Text Color', 'variation-filter')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.ColorPalette, {
    value: select.color,
    clearable: false,
    onChange: function onChange(value) {
      return handleValue('select', 'color', value);
    }
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.FlexItem, {
    isBlock: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.BaseControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Background Color', 'variation-filter')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.ColorPalette, {
    value: select.backgroundColor,
    clearable: false,
    onChange: function onChange(value) {
      return handleValue('select', 'backgroundColor', value);
    }
  })))))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Section, {
    isShow: getDisplayType() === 'button'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.PanelBody, {
    title: "Button Style",
    initialOpen: false
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Shape', 'variation-filter'),
    value: button.shape,
    onChange: function onChange(value) {
      return handleValue('button', 'shape', value);
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "square",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Square', 'variation-filter')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "circle",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Circle', 'variation-filter')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "custom",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Custom', 'variation-filter')
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalGrid, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Width', 'variation-filter'),
    value: button.width,
    onChange: function onChange(value) {
      return handleValue('button', 'width', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Height', 'variation-filter'),
    value: button.height,
    onChange: function onChange(value) {
      return handleValue('button', 'height', value);
    }
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalGrid, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Font Size', 'variation-filter'),
    value: button.fontSize,
    onChange: function onChange(value) {
      return handleValue('button', 'fontSize', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.SelectControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Font Weight', 'variation-filter'),
    value: button.fontWeight,
    options: _data_generalData__WEBPACK_IMPORTED_MODULE_11__.generalData.fontWeightChoices,
    onChange: function onChange(value) {
      return handleValue('button', 'fontWeight', value);
    }
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalBoxControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Padding', 'variation-filter'),
    values: button.padding,
    onChange: function onChange(value) {
      return handleValue('button', 'padding', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalBorderBoxControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Border', 'variation-filter'),
    value: button.border,
    onChange: function onChange(value) {
      return handleValue('button', 'border', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalBorderBoxControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Active Border', 'variation-filter'),
    value: button.borderActive,
    onChange: function onChange(value) {
      return handleValue('button', 'borderActive', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, {
    isShow: button.shape === 'custom'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Border Radius', 'variation-filter'),
    value: button.borderRadius,
    onChange: function onChange(value) {
      return handleValue('button', 'borderRadius', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Gap', 'variation-filter'),
    value: button.gap,
    onChange: function onChange(value) {
      return handleValue('button', 'gap', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.Flex, {
    gap: "12px"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.FlexItem, {
    isBlock: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.BaseControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Text Color', 'variation-filter')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.ColorPalette, {
    value: button.color,
    clearable: false,
    onChange: function onChange(value) {
      return handleValue('button', 'color', value);
    }
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.FlexItem, {
    isBlock: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.BaseControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Text Active Color', 'variation-filter')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.ColorPalette, {
    value: button.colorActive,
    clearable: false,
    onChange: function onChange(value) {
      return handleValue('button', 'colorActive', value);
    }
  })))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.Flex, {
    gap: "12px"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.FlexItem, {
    isBlock: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.BaseControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Background Color', 'variation-filter')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.ColorPalette, {
    value: button.backgroundColor,
    clearable: false,
    onChange: function onChange(value) {
      return handleValue('button', 'backgroundColor', value);
    }
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.FlexItem, {
    isBlock: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.BaseControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Background Active Color', 'variation-filter')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.ColorPalette, {
    value: button.backgroundColorActive,
    clearable: false,
    onChange: function onChange(value) {
      return handleValue('button', 'backgroundColorActive', value);
    }
  })))))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Section, {
    isShow: getDisplayType() === 'color'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.PanelBody, {
    title: "Color Style",
    initialOpen: false
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Shape', 'variation-filter'),
    value: color.shape,
    onChange: function onChange(value) {
      return handleValue('color', 'shape', value);
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "square",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Square', 'variation-filter')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "circle",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Circle', 'variation-filter')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "custom",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Custom', 'variation-filter')
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, {
    isShow: color.shape !== 'custom'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Size', 'variation-filter'),
    value: color.size,
    onChange: function onChange(value) {
      return handleValue('color', 'size', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, {
    isShow: color.shape === 'custom'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalGrid, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Width', 'variation-filter'),
    value: color.width,
    onChange: function onChange(value) {
      return handleValue('color', 'width', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Height', 'variation-filter'),
    value: color.height,
    onChange: function onChange(value) {
      return handleValue('color', 'height', value);
    }
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalBorderBoxControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Border', 'variation-filter'),
    value: color.border,
    onChange: function onChange(value) {
      return handleValue('color', 'border', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalBorderBoxControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Active Border', 'variation-filter'),
    value: color.borderActive,
    onChange: function onChange(value) {
      return handleValue('color', 'borderActive', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, {
    isShow: color.shape === 'custom'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Border Radius', 'variation-filter'),
    value: color.borderRadius,
    onChange: function onChange(value) {
      return handleValue('color', 'borderRadius', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Gap', 'variation-filter'),
    value: color.gap,
    onChange: function onChange(value) {
      return handleValue('color', 'gap', value);
    }
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Section, {
    isShow: getDisplayType() === 'image'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.PanelBody, {
    title: "Image Style",
    initialOpen: false
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Shape', 'variation-filter'),
    value: image.shape,
    onChange: function onChange(value) {
      return handleValue('image', 'shape', value);
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "square",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Square', 'variation-filter')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "circle",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Circle', 'variation-filter')
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalToggleGroupControlOption, {
    value: "custom",
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Custom', 'variation-filter')
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, {
    isShow: image.shape !== 'custom'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Size', 'variation-filter'),
    value: image.size,
    onChange: function onChange(value) {
      return handleValue('image', 'size', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, {
    isShow: image.shape === 'custom'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalGrid, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Width', 'variation-filter'),
    value: image.width,
    onChange: function onChange(value) {
      return handleValue('image', 'width', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Height', 'variation-filter'),
    value: image.height,
    onChange: function onChange(value) {
      return handleValue('image', 'height', value);
    }
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalBorderBoxControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Border', 'variation-filter'),
    value: image.border,
    onChange: function onChange(value) {
      return handleValue('image', 'border', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalBorderBoxControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Active Border', 'variation-filter'),
    value: image.borderActive,
    onChange: function onChange(value) {
      return handleValue('image', 'borderActive', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, {
    isShow: image.shape === 'custom'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Border Radius', 'variation-filter'),
    value: image.borderRadius,
    onChange: function onChange(value) {
      return handleValue('image', 'borderRadius', value);
    }
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.Field, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.__experimentalUnitControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Gap', 'variation-filter'),
    value: image.gap,
    onChange: function onChange(value) {
      return handleValue('image', 'gap', value);
    }
  })))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)("div", blockProps, hasAttribute ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)("div", {
    className: "hvsfw-vf"
  }, getTitleText() && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)("label", {
    className: "hvsfw-vf-title",
    style: getTitleStyle()
  }, getTitleText()), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)("div", {
    className: "hvsfw-vf-swatch"
  }, function () {
    switch (getDisplayType()) {
      case 'list':
        return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.SwatchList, {
          attributes: attributes
        });
      case 'select':
        return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.SwatchSelect, {
          attributes: attributes
        });
      case 'button':
        return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.SwatchButton, {
          attributes: attributes
        });
      case 'color':
        return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.SwatchColor, {
          attributes: attributes
        });
      case 'image':
        return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.SwatchImage, {
          attributes: attributes
        });
    }
  }())) : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_7__.Placeholder, {
    icon: _icon__WEBPACK_IMPORTED_MODULE_8__["default"],
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Handy Variation Filter', 'variation-filter'),
    instructions: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Display product variation filter based on chosen variation attribute.', 'variation-filter'),
    isColumnLayout: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.createElement)(_components__WEBPACK_IMPORTED_MODULE_13__.SearchList, {
    attributes: attributes,
    setAttributes: setAttributes,
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Search For A Product Attribute', 'variation-filter')
  }))));
}

/***/ }),

/***/ "./src/icon.js":
/*!*********************!*\
  !*** ./src/icon.js ***!
  \*********************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

/**
 * Icon.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 */
var Icon = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
  viewBox: "0 0 24 24",
  fill: "none",
  xmlns: "http://www.w3.org/2000/svg"
}, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("g", {
  id: "SVGRepo_bgCarrier",
  "stroke-width": "0"
}), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("g", {
  id: "SVGRepo_tracerCarrier",
  "stroke-linecap": "round",
  "stroke-linejoin": "round"
}), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("g", {
  id: "SVGRepo_iconCarrier"
}, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
  d: "M22.0009 16.5V19.5C22.0009 20.88 20.8809 22 19.5009 22H12.3609C11.4709 22 11.0309 20.93 11.6509 20.3L17.5209 14.3C17.7109 14.11 17.9709 14 18.2309 14H19.5009C20.8809 14 22.0009 15.12 22.0009 16.5Z",
  fill: "#1e1e1e"
}), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
  d: "M18.3702 11.2895L15.6602 13.9995L13.2002 16.4495C12.5702 17.0795 11.4902 16.6395 11.4902 15.7495C11.4902 12.5395 11.4902 7.25953 11.4902 7.25953C11.4902 6.98953 11.6002 6.73953 11.7802 6.54953L12.7002 5.62953C13.6802 4.64953 15.2602 4.64953 16.2402 5.62953L18.3602 7.74953C19.3502 8.72953 19.3502 10.3095 18.3702 11.2895Z",
  fill: "#1e1e1e"
}), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
  d: "M7.5 2H4.5C3 2 2 3 2 4.5V18C2 18.27 2.03 18.54 2.08 18.8C2.11 18.93 2.14 19.06 2.18 19.19C2.23 19.34 2.28 19.49 2.34 19.63C2.35 19.64 2.35 19.65 2.35 19.65C2.36 19.65 2.36 19.65 2.35 19.66C2.49 19.94 2.65 20.21 2.84 20.46C2.95 20.59 3.06 20.71 3.17 20.83C3.28 20.95 3.4 21.05 3.53 21.15L3.54 21.16C3.79 21.35 4.06 21.51 4.34 21.65C4.35 21.64 4.35 21.64 4.35 21.65C4.5 21.72 4.65 21.77 4.81 21.82C4.94 21.86 5.07 21.89 5.2 21.92C5.46 21.97 5.73 22 6 22C6.41 22 6.83 21.94 7.22 21.81C7.33 21.77 7.44 21.73 7.55 21.68C7.9 21.54 8.24 21.34 8.54 21.08C8.63 21.01 8.73 20.92 8.82 20.83L8.86 20.79C9.56 20.07 10 19.08 10 18V4.5C10 3 9 2 7.5 2ZM6 19.5C5.17 19.5 4.5 18.83 4.5 18C4.5 17.17 5.17 16.5 6 16.5C6.83 16.5 7.5 17.17 7.5 18C7.5 18.83 6.83 19.5 6 19.5Z",
  fill: "#1e1e1e"
})));
/* harmony default export */ __webpack_exports__["default"] = (Icon);

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./src/style.scss");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/edit.js");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./block.json */ "./src/block.json");
/* harmony import */ var _icon__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./icon */ "./src/icon.js");
/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */


/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */


/**
 * Internal dependencies
 */




/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)(_block_json__WEBPACK_IMPORTED_MODULE_3__.name, {
  /**
   * @see ./edit.js
   */
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"],
  /**
   * @see ./icon.js
   */
  icon: _icon__WEBPACK_IMPORTED_MODULE_4__["default"]
});

/***/ }),

/***/ "./src/lib/getFetch.js":
/*!*****************************!*\
  !*** ./src/lib/getFetch.js ***!
  \*****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getFetch": function() { return /* binding */ data; }
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/regenerator */ "@babel/runtime/regenerator");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1__);


/**
 * Get Fetch Handler.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @async
 * @param {Object} params Containing the parameters.
 * @return {Promise} Fetch response
 */
var data = /*#__PURE__*/function () {
  var _ref = (0,_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default().mark(function _callee(params) {
    var result, response;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default().wrap(function _callee$(_context) {
      while (1) switch (_context.prev = _context.next) {
        case 0:
          result = {
            success: false,
            data: {
              error: 'NETWORK_ERROR'
            }
          };
          if (!(Object.keys(params).length === 0)) {
            _context.next = 4;
            break;
          }
          result.data.error = 'MISSING_DATA_ERROR';
          return _context.abrupt("return", result);
        case 4:
          _context.prev = 4;
          _context.next = 7;
          return fetch(hvsfwVfData.url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(params)
          });
        case 7:
          response = _context.sent;
          if (!response.ok) {
            _context.next = 12;
            break;
          }
          _context.next = 11;
          return response.json();
        case 11:
          result = _context.sent;
        case 12:
          _context.next = 17;
          break;
        case 14:
          _context.prev = 14;
          _context.t0 = _context["catch"](4);
          console.log('error', _context.t0);
        case 17:
          return _context.abrupt("return", result);
        case 18:
        case "end":
          return _context.stop();
      }
    }, _callee, null, [[4, 14]]);
  }));
  return function data(_x) {
    return _ref.apply(this, arguments);
  };
}();


/***/ }),

/***/ "./src/utils/Helper.js":
/*!*****************************!*\
  !*** ./src/utils/Helper.js ***!
  \*****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "helper": function() { return /* binding */ data; }
/* harmony export */ });
/**
 * Helper Functions.
 * 
 * @since 1.0.0
 * 
 * @type {Object}
 * @author Mafel John Cahucom
 */
var data = {
  /**
  * Checks if the object is empty.
  *
  * @since 1.0.0
  *
  * @param {Object} object The object to be checked.
  * @return {boolean} Whether has empty key.
  */
  isObjectEmpty: function isObjectEmpty(object) {
    return object === null || object === undefined || Object.keys(object).length === 0;
  },
  /**
   * Returns the validate size unit.
   * 
   * @since 1.0.0
   * @param {string} string The string to be validate. 
   * @return {string} Validated size.
   */
  getValidateUnitSize: function getValidateUnitSize(string) {
    var size = '0px';
    if (string !== '') {
      var number = string.match(/\d+/g);
      var unit = string.match(/[a-zA-Z]+/g);
      if (number !== null) {
        var validUnits = ['cm', 'mm', 'in', 'px', 'pt', 'pc', 'em', 'ex', 'ch', 'rem', 'vw', 'vh', 'vmin', 'vmax', '%'];
        size = number[0];
        if (unit !== null && validUnits.includes(unit[0])) {
          size = number[0] + unit[0];
        }
      }
    }
    return size;
  },
  /**
   * Return the capitalize the first character of string.
   * 
   * @since 1.0.0
   * 
   * @param {string} string Contains the string to be modified.
   * @return {string} Capitalize first character. 
   */
  getUcFirst: function getUcFirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  },
  /**
   * Return a single line css padding value.
   * 
   * @since 1.0.0
   * 
   * @param {Object} padding Contains the top, right, bottom and left value.
   * @return {string} Single line padding value.
   */
  getPadding: function getPadding(padding) {
    if (data.isObjectEmpty(padding)) {
      return '0px 0px 0px 0px';
    }
    var _padding$top = padding.top,
      top = _padding$top === void 0 ? top !== undefined ? top : '0px' : _padding$top,
      _padding$right = padding.right,
      right = _padding$right === void 0 ? right !== undefined ? right : '0px' : _padding$right,
      _padding$bottom = padding.bottom,
      bottom = _padding$bottom === void 0 ? bottom !== undefined ? bottom : '0px' : _padding$bottom,
      _padding$left = padding.left,
      left = _padding$left === void 0 ? left !== undefined ? left : '0px' : _padding$left;
    return "".concat(top, " ").concat(right, " ").concat(bottom, " ").concat(left);
  },
  /**
   * Return a single line css border value.
   * 
   * @since 1.0.0
   * 
   * @param {Object} border Contains the width, style and color value.
   * @return {string} Single line border value.
   */
  getBorder: function getBorder(border) {
    if (data.isObjectEmpty(border)) {
      return '0px none #000000';
    }
    var _border$width = border.width,
      width = _border$width === void 0 ? width !== undefined ? width : '0px' : _border$width,
      _border$style = border.style,
      style = _border$style === void 0 ? style !== undefined ? style : 'none' : _border$style,
      _border$color = border.color,
      color = _border$color === void 0 ? color !== undefined ? color : '#000000' : _border$color;
    return "".concat(width, " ").concat(style, " ").concat(color);
  },
  /**
   * Returns border top, right, bottom, left and its value in single line.
   * 
   * @since 1.0.0
   * 
   * @param {Object} borders Contains the border top, right, bottom and left.
   * @return {Object} Contains all borders and its value.
   */
  getBorders: function getBorders(borders) {
    if (data.isObjectEmpty(borders)) {
      return {
        border: '0px none #000000'
      };
    }
    var value = {};
    if (Object.keys(borders).length === 4) {
      Object.entries(borders).forEach(function (border) {
        var key = "border".concat(data.getUcFirst(border[0]));
        value[key] = data.getBorder(border[1]);
      });
    } else {
      value.border = data.getBorder(borders);
    }
    return value;
  },
  /**
   * Set the border property on an element.
   * 
   * @since 1.0.0
   * 
   * @param {Object} element Contains the element to be modified. 
   * @param {Object} borders Contains the border top, right, bottom and left.
   */
  setBorder: function setBorder(element, borders) {
    if (!element || data.isObjectEmpty(borders)) {
      return;
    }
    if (Object.keys(borders).length === 4) {
      Object.entries(borders).forEach(function (border) {
        element.style[border[0]] = border[1];
      });
    } else {
      element.style.border = borders.border;
    }
  },
  /**
   * Return the linear gradient color or stripe color.
   *
   * @since 1.0.0
   *
   * @param {Array} colors Containing the list of colors.
   * @return {string} The gradient background color.
   */
  getLinearColor: function getLinearColor(colors) {
    if (colors.length === 0 || !Array.isArray(colors)) {
      return '#ffffff';
    }
    var value = '-45deg, ';
    var count = colors.length;
    var length = 100 / count;
    colors.forEach(function (color, index) {
      index = index + 1;
      var end = length * index;
      var start = end - length;
      value += "".concat(color, " ").concat(start, "%, ").concat(color, " ").concat(end, "% ");
      value += index < count ? ',' : '';
    });
    return "repeating-linear-gradient( ".concat(value, " )");
  }
};


/***/ }),

/***/ "./src/components/Field/field.scss":
/*!*****************************************!*\
  !*** ./src/components/Field/field.scss ***!
  \*****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/components/SearchList/searchlist.scss":
/*!***************************************************!*\
  !*** ./src/components/SearchList/searchlist.scss ***!
  \***************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/components/Section/section.scss":
/*!*********************************************!*\
  !*** ./src/components/Section/section.scss ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/components/SwatchButton/swatchbutton.scss":
/*!*******************************************************!*\
  !*** ./src/components/SwatchButton/swatchbutton.scss ***!
  \*******************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/components/SwatchColor/swatchcolor.scss":
/*!*****************************************************!*\
  !*** ./src/components/SwatchColor/swatchcolor.scss ***!
  \*****************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/components/SwatchImage/swatchimage.scss":
/*!*****************************************************!*\
  !*** ./src/components/SwatchImage/swatchimage.scss ***!
  \*****************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/components/SwatchList/swatchlist.scss":
/*!***************************************************!*\
  !*** ./src/components/SwatchList/swatchlist.scss ***!
  \***************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/components/SwatchSelect/swatchselect.scss":
/*!*******************************************************!*\
  !*** ./src/components/SwatchSelect/swatchselect.scss ***!
  \*******************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/editor.scss":
/*!*************************!*\
  !*** ./src/editor.scss ***!
  \*************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/style.scss":
/*!************************!*\
  !*** ./src/style.scss ***!
  \************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "@babel/runtime/regenerator":
/*!*************************************!*\
  !*** external "regeneratorRuntime" ***!
  \*************************************/
/***/ (function(module) {

module.exports = window["regeneratorRuntime"];

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ (function(module) {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ (function(module) {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ (function(module) {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ (function(module) {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ (function(module) {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/arrayLikeToArray.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/arrayLikeToArray.js ***!
  \*********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _arrayLikeToArray; }
/* harmony export */ });
function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;
  for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i];
  return arr2;
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/arrayWithHoles.js":
/*!*******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/arrayWithHoles.js ***!
  \*******************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _arrayWithHoles; }
/* harmony export */ });
function _arrayWithHoles(arr) {
  if (Array.isArray(arr)) return arr;
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js ***!
  \*********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _asyncToGenerator; }
/* harmony export */ });
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
  try {
    var info = gen[key](arg);
    var value = info.value;
  } catch (error) {
    reject(error);
    return;
  }
  if (info.done) {
    resolve(value);
  } else {
    Promise.resolve(value).then(_next, _throw);
  }
}
function _asyncToGenerator(fn) {
  return function () {
    var self = this,
      args = arguments;
    return new Promise(function (resolve, reject) {
      var gen = fn.apply(self, args);
      function _next(value) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);
      }
      function _throw(err) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);
      }
      _next(undefined);
    });
  };
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/defineProperty.js":
/*!*******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/defineProperty.js ***!
  \*******************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _defineProperty; }
/* harmony export */ });
/* harmony import */ var _toPropertyKey_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./toPropertyKey.js */ "./node_modules/@babel/runtime/helpers/esm/toPropertyKey.js");

function _defineProperty(obj, key, value) {
  key = (0,_toPropertyKey_js__WEBPACK_IMPORTED_MODULE_0__["default"])(key);
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

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/iterableToArrayLimit.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/iterableToArrayLimit.js ***!
  \*************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _iterableToArrayLimit; }
/* harmony export */ });
function _iterableToArrayLimit(arr, i) {
  var _i = null == arr ? null : "undefined" != typeof Symbol && arr[Symbol.iterator] || arr["@@iterator"];
  if (null != _i) {
    var _s,
      _e,
      _x,
      _r,
      _arr = [],
      _n = !0,
      _d = !1;
    try {
      if (_x = (_i = _i.call(arr)).next, 0 === i) {
        if (Object(_i) !== _i) return;
        _n = !1;
      } else for (; !(_n = (_s = _x.call(_i)).done) && (_arr.push(_s.value), _arr.length !== i); _n = !0);
    } catch (err) {
      _d = !0, _e = err;
    } finally {
      try {
        if (!_n && null != _i["return"] && (_r = _i["return"](), Object(_r) !== _r)) return;
      } finally {
        if (_d) throw _e;
      }
    }
    return _arr;
  }
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/nonIterableRest.js":
/*!********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/nonIterableRest.js ***!
  \********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _nonIterableRest; }
/* harmony export */ });
function _nonIterableRest() {
  throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/objectWithoutProperties.js":
/*!****************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/objectWithoutProperties.js ***!
  \****************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _objectWithoutProperties; }
/* harmony export */ });
/* harmony import */ var _objectWithoutPropertiesLoose_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./objectWithoutPropertiesLoose.js */ "./node_modules/@babel/runtime/helpers/esm/objectWithoutPropertiesLoose.js");

function _objectWithoutProperties(source, excluded) {
  if (source == null) return {};
  var target = (0,_objectWithoutPropertiesLoose_js__WEBPACK_IMPORTED_MODULE_0__["default"])(source, excluded);
  var key, i;
  if (Object.getOwnPropertySymbols) {
    var sourceSymbolKeys = Object.getOwnPropertySymbols(source);
    for (i = 0; i < sourceSymbolKeys.length; i++) {
      key = sourceSymbolKeys[i];
      if (excluded.indexOf(key) >= 0) continue;
      if (!Object.prototype.propertyIsEnumerable.call(source, key)) continue;
      target[key] = source[key];
    }
  }
  return target;
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/objectWithoutPropertiesLoose.js":
/*!*********************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/objectWithoutPropertiesLoose.js ***!
  \*********************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _objectWithoutPropertiesLoose; }
/* harmony export */ });
function _objectWithoutPropertiesLoose(source, excluded) {
  if (source == null) return {};
  var target = {};
  var sourceKeys = Object.keys(source);
  var key, i;
  for (i = 0; i < sourceKeys.length; i++) {
    key = sourceKeys[i];
    if (excluded.indexOf(key) >= 0) continue;
    target[key] = source[key];
  }
  return target;
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/slicedToArray.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/slicedToArray.js ***!
  \******************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _slicedToArray; }
/* harmony export */ });
/* harmony import */ var _arrayWithHoles_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./arrayWithHoles.js */ "./node_modules/@babel/runtime/helpers/esm/arrayWithHoles.js");
/* harmony import */ var _iterableToArrayLimit_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./iterableToArrayLimit.js */ "./node_modules/@babel/runtime/helpers/esm/iterableToArrayLimit.js");
/* harmony import */ var _unsupportedIterableToArray_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./unsupportedIterableToArray.js */ "./node_modules/@babel/runtime/helpers/esm/unsupportedIterableToArray.js");
/* harmony import */ var _nonIterableRest_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./nonIterableRest.js */ "./node_modules/@babel/runtime/helpers/esm/nonIterableRest.js");




function _slicedToArray(arr, i) {
  return (0,_arrayWithHoles_js__WEBPACK_IMPORTED_MODULE_0__["default"])(arr) || (0,_iterableToArrayLimit_js__WEBPACK_IMPORTED_MODULE_1__["default"])(arr, i) || (0,_unsupportedIterableToArray_js__WEBPACK_IMPORTED_MODULE_2__["default"])(arr, i) || (0,_nonIterableRest_js__WEBPACK_IMPORTED_MODULE_3__["default"])();
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/toPrimitive.js":
/*!****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/toPrimitive.js ***!
  \****************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _toPrimitive; }
/* harmony export */ });
/* harmony import */ var _typeof_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./typeof.js */ "./node_modules/@babel/runtime/helpers/esm/typeof.js");

function _toPrimitive(input, hint) {
  if ((0,_typeof_js__WEBPACK_IMPORTED_MODULE_0__["default"])(input) !== "object" || input === null) return input;
  var prim = input[Symbol.toPrimitive];
  if (prim !== undefined) {
    var res = prim.call(input, hint || "default");
    if ((0,_typeof_js__WEBPACK_IMPORTED_MODULE_0__["default"])(res) !== "object") return res;
    throw new TypeError("@@toPrimitive must return a primitive value.");
  }
  return (hint === "string" ? String : Number)(input);
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/toPropertyKey.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/toPropertyKey.js ***!
  \******************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _toPropertyKey; }
/* harmony export */ });
/* harmony import */ var _typeof_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./typeof.js */ "./node_modules/@babel/runtime/helpers/esm/typeof.js");
/* harmony import */ var _toPrimitive_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./toPrimitive.js */ "./node_modules/@babel/runtime/helpers/esm/toPrimitive.js");


function _toPropertyKey(arg) {
  var key = (0,_toPrimitive_js__WEBPACK_IMPORTED_MODULE_1__["default"])(arg, "string");
  return (0,_typeof_js__WEBPACK_IMPORTED_MODULE_0__["default"])(key) === "symbol" ? key : String(key);
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/typeof.js":
/*!***********************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/typeof.js ***!
  \***********************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _typeof; }
/* harmony export */ });
function _typeof(obj) {
  "@babel/helpers - typeof";

  return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) {
    return typeof obj;
  } : function (obj) {
    return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
  }, _typeof(obj);
}

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/unsupportedIterableToArray.js":
/*!*******************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/unsupportedIterableToArray.js ***!
  \*******************************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _unsupportedIterableToArray; }
/* harmony export */ });
/* harmony import */ var _arrayLikeToArray_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./arrayLikeToArray.js */ "./node_modules/@babel/runtime/helpers/esm/arrayLikeToArray.js");

function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return (0,_arrayLikeToArray_js__WEBPACK_IMPORTED_MODULE_0__["default"])(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return (0,_arrayLikeToArray_js__WEBPACK_IMPORTED_MODULE_0__["default"])(o, minLen);
}

/***/ }),

/***/ "./src/block.json":
/*!************************!*\
  !*** ./src/block.json ***!
  \************************/
/***/ (function(module) {

module.exports = JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"create-block/variation-filter","version":"0.1.0","title":"Handy Variation Filter","category":"widgets","icon":"","description":"Show a list of variation swatches on the shop page to filter the products.","supports":{"html":false},"textdomain":"variation-filter","attributes":{"blockId":{"type":"string"},"productAttributes":{"type":"array","default":[]},"settings":{"type":"object","default":{"attribute":"","displayType":"swatch","queryType":"or","showCount":true}},"searchList":{"type":"object","default":{"state":"loading"}},"title":{"type":"object","default":{"text":null,"fontSize":"22px","fontWeight":"500","lineHeight":"26px","color":"#000000","marginBottom":"20px"}},"list":{"type":"object","default":{"fontSize":"16px","fontWeight":"400","lineHeight":"20px","color":"#000000","colorActive":"#0071f2","marginBottom":"5px"}},"select":{"type":"object","default":{"width":"100%","height":"30px","fontSize":"14px","fontWeight":"400","color":"#000000","backgroundColor":"#ffffff","padding":{"top":"0px","right":"24px","bottom":"0px","left":"8px"},"border":{"width":"1px","style":"solid","color":"#000000"}}},"button":{"type":"object","default":{"shape":"square","width":"40px","height":"40px","fontSize":"14px","fontWeight":"400","color":"#000000","colorActive":"#0071f2","backgroundColor":"#ffffff","backgroundColorActive":"#ffffff","padding":{"top":"5px","right":"5px","bottom":"5px","left":"5px"},"border":{"width":"1px","style":"solid","color":"#000000"},"borderActive":{"width":"1px","style":"solid","color":"#0071f2"},"borderRadius":"0px","gap":"10px"}},"color":{"type":"object","default":{"shape":"square","size":"40px","width":"40px","height":"40px","border":{"width":"1px","style":"solid","color":"#000000"},"borderActive":{"width":"1px","style":"solid","color":"#0071f2"},"borderRadius":"0px","gap":"10px"}},"image":{"type":"object","default":{"shape":"square","size":"40px","width":"40px","height":"40px","border":{"width":"1px","style":"solid","color":"#000000"},"borderActive":{"width":"1px","style":"solid","color":"#0071f2"},"borderRadius":"0px","gap":"10px"}}},"editorScript":"file:./index.js","editorStyle":"file:./index.css","style":"file:./style-index.css","render":"file:./render.php"}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	!function() {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = function(result, chunkIds, fn, priority) {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var chunkIds = deferred[i][0];
/******/ 				var fn = deferred[i][1];
/******/ 				var priority = deferred[i][2];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every(function(key) { return __webpack_require__.O[key](chunkIds[j]); })) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	!function() {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"index": 0,
/******/ 			"./style-index": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = function(chunkId) { return installedChunks[chunkId] === 0; };
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = function(parentChunkLoadingFunction, data) {
/******/ 			var chunkIds = data[0];
/******/ 			var moreModules = data[1];
/******/ 			var runtime = data[2];
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some(function(id) { return installedChunks[id] !== 0; })) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkvariation_filter"] = self["webpackChunkvariation_filter"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	}();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["./style-index"], function() { return __webpack_require__("./src/index.js"); })
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=index.js.map