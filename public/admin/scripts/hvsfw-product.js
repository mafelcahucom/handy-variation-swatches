/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/admin/scripts/modules/colorPicker.js":
/*!********************************************************!*\
  !*** ./resources/admin/scripts/modules/colorPicker.js ***!
  \********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../helpers */ "./resources/helpers/index.js");
/**
 * Internal Dependencies.
 */


/**
 * Color Picker Module.
 *
 * @since 1.0.0
 *
 * @type   {Object}
 * @author Mafel John Cahucom
 */
var colorPicker = {
  /**
   * Initialize.
   *
   * @since 1.0.0
   */
  init: function init() {
    this.setColorPicker();
    this.addNewField();
    this.deleteField();
  },
  /**
   * Set the color picker.
   *
   * @since 1.0.0
   *
   * @param {string} action Contains the type of action.
   * @param {Object} parent Contains the parent element.
   */
  setColorPicker: function setColorPicker() {
    var action = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'set';
    var parent = arguments.length > 1 ? arguments[1] : undefined;
    var selector = '.hvsfw-color-picker__input';
    var inputElems = document.querySelectorAll(selector);
    if (parent) {
      inputElems = parent.querySelectorAll(selector);
    }
    if (0 < inputElems.length) {
      inputElems.forEach(function (inputElem) {
        jQuery(inputElem).wpColorPicker();
        if ('reset' === action) {
          jQuery(inputElem).iris('color', '#ffffff');
        }
      });
    }
  },
  /**
   * Set the count of items.
   *
   * @since 1.0.0
   *
   * @param {Object} parent Contains the parent element.
   */
  setCount: function setCount(parent) {
    if (parent) {
      var listElem = parent.querySelector('.hvsfw-color-picker__list');
      if (listElem) {
        parent.setAttribute('data-count', listElem.childElementCount);
      }
    }
  },
  /**
   * Set to default or reset color swatch picker.
   *
   * @since 1.0.0
   *
   * @param {Object} parent Contains the color picker parent element.
   */
  setToDefault: function setToDefault(parent) {
    var colorPickerElems = Array.from(document.querySelectorAll('.hvsfw-color-picker'));
    colorPickerElems = parent ? [parent] : colorPickerElems;
    if (0 < colorPickerElems.length) {
      colorPickerElems.forEach(function (colorPickerElem) {
        var itemElems = colorPickerElem.querySelectorAll('.hvsfw-color-picker__item');
        if (1 < itemElems.length) {
          itemElems.forEach(function (itemElem, index) {
            if (0 !== index) {
              itemElem.remove();
            }
          });
        }
        colorPicker.setCount(colorPickerElem);
        colorPicker.setColorPicker('reset', colorPickerElem);
      });
    }
  },
  /**
   * Return the new created color picker component element.
   *
   * @since 1.0.0
   *
   * @param {string} name Contains the input name.
   * @return {string|void} Contains the new color picker field.
   */
  field: function field(name) {
    if (!name) {
      return;
    }
    var element = document.createElement('div');
    element.className = 'hvsfw-color-picker__item';
    element.innerHTML = "\n            <div class=\"hvsfw-col__left\">\n                <input type=\"hidden\" name=\"".concat(name, "\" class=\"hvsfw-color-picker__input\" value=\"#ffffff\">\n            </div>\n            <div class=\"hvsfw-col__right\">\n                <button type=\"button\" class=\"hvsfw-js-color-picker-delete-btn hvsfw-color-picker__delete-btn button\">Delete</button>\n            </div>\n        ");
    return element;
  },
  /**
   * Add new color picker field.
   *
   * @since 1.0.0
   */
  addNewField: function addNewField() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('click', '.hvsfw-js-color-picker-add-btn', function (e) {
      e.preventDefault();
      var target = e.target;
      var parentElem = target.closest('.hvsfw-color-picker');
      if (!parentElem) {
        return;
      }
      var listElem = parentElem.querySelector('.hvsfw-color-picker__list');
      if (!listElem) {
        return;
      }
      var firstInputElem = listElem.querySelector('.hvsfw-color-picker__input');
      if (!firstInputElem) {
        return;
      }
      var inputName = firstInputElem.getAttribute('name');
      if (!inputName) {
        return;
      }
      var newColorPickerField = colorPicker.field(inputName);
      if (newColorPickerField) {
        listElem.appendChild(newColorPickerField);
        colorPicker.setColorPicker('set', parentElem);
        colorPicker.setCount(parentElem);
      }
    });
  },
  /**
   * Delete a center color picker field.
   *
   * @since 1.0.0
   */
  deleteField: function deleteField() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('click', '.hvsfw-js-color-picker-delete-btn', function (e) {
      e.preventDefault();
      var target = e.target;
      var parentElem = target.closest('.hvsfw-color-picker');
      var itemElem = target.closest('.hvsfw-color-picker__item');
      if (parentElem && itemElem) {
        itemElem.remove();
        colorPicker.setCount(parentElem);
      }
    });
  }
};
/* harmony default export */ __webpack_exports__["default"] = (colorPicker);

/***/ }),

/***/ "./resources/admin/scripts/modules/imagePicker.js":
/*!********************************************************!*\
  !*** ./resources/admin/scripts/modules/imagePicker.js ***!
  \********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../helpers */ "./resources/helpers/index.js");
/**
 * Internal Dependencies.
 */


/**
 * Image Picker Module.
 *
 * @since 1.0.0
 *
 * @type   {Object}
 * @author Mafel John Cahucom
 */
var imagePicker = {
  /**
   * Initialize.
   *
   * @since 1.0.0
   */
  init: function init() {
    this.uploadImage();
    this.removeImage();
  },
  /**
   * Set to default or reset image picker.
   *
   * @since 1.0.0
   *
   * @param {Object} parent Contains the image picker parent element.
   */
  setToDefault: function setToDefault(parent) {
    var imagePickerElems = Array.from(document.querySelectorAll('.hvsfw-image-picker'));
    imagePickerElems = parent ? [parent] : imagePickerElems;
    if (0 < imagePickerElems.length) {
      imagePickerElems.forEach(function (imagePickerElem) {
        var inputElem = imagePickerElem.querySelector('.hvsfw-image-picker-input');
        var imageElem = imagePickerElem.querySelector('.hvsfw-image-picker__img');
        var removeBtnElem = imagePickerElem.querySelector('.hvsfw-js-image-picker-remove-btn');
        if (inputElem && imageElem && removeBtnElem) {
          var imagePlaceholder = imageElem.getAttribute('data-default');
          inputElem.value = 0;
          imageElem.setAttribute('src', imagePlaceholder);
          imageElem.setAttribute('alt', 'WooCommerce Placeholder');
          imageElem.setAttribute('title', 'WooCommerce Placeholder');
          removeBtnElem.setAttribute('data-state', 'disabled');
        }
      });
    }
  },
  /**
   * Upload or select image from media library.
   *
   * @since 1.0.0
   */
  uploadImage: function uploadImage() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('click', '.hvsfw-js-image-picker-select-btn', function (e) {
      e.preventDefault();
      var target = e.target;
      var state = target.getAttribute('data-state');
      if ('default' !== state) {
        return;
      }
      var parentElem = target.closest('.hvsfw-image-picker');
      if (!parentElem) {
        return;
      }
      var inputElem = parentElem.querySelector('.hvsfw-image-picker-input');
      var imageElem = parentElem.querySelector('.hvsfw-image-picker__img');
      var removeBtnElem = parentElem.querySelector('.hvsfw-js-image-picker-remove-btn');
      if (!inputElem || !imageElem || !removeBtnElem) {
        return;
      }
      var uploader = wp.media({
        title: 'Select Image',
        library: {
          type: 'image'
        },
        button: {
          text: 'Use Image'
        },
        multiple: false
      });
      uploader.open();
      uploader.on('select', function () {
        var attachment = uploader.state().get('selection').toJSON();
        inputElem.value = attachment[0].id;
        imageElem.setAttribute('src', attachment[0].url);
        imageElem.setAttribute('alt', attachment[0].alt);
        imageElem.setAttribute('title', attachment[0].title);
        removeBtnElem.setAttribute('data-state', 'default');
      });
    });
  },
  /**
   * Remove or delete the current image selected.
   *
   * @since 1.0.0
   */
  removeImage: function removeImage() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('click', '.hvsfw-js-image-picker-remove-btn', function (e) {
      e.preventDefault();
      var target = e.target;
      var state = target.getAttribute('data-state');
      if ('default' === state) {
        var parentElem = target.closest('.hvsfw-image-picker');
        if (parentElem) {
          imagePicker.setToDefault(parentElem);
        }
      }
    });
  }
};
/* harmony default export */ __webpack_exports__["default"] = (imagePicker);

/***/ }),

/***/ "./resources/admin/scripts/modules/settingField.js":
/*!*********************************************************!*\
  !*** ./resources/admin/scripts/modules/settingField.js ***!
  \*********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../helpers */ "./resources/helpers/index.js");
/**
 * Internal Dependencies.
 */


/**
 * Setting Field Module.
 *
 * @since 1.0.0
 *
 * @type   {Object}
 * @author Mafel John Cahucom
 */
var settingField = {
  /**
   * Holds the type field selector.
   *
   * @since 1.0.0
   *
   * @type {string}
   */
  type: '',
  /**
   * Holds the style field selector.
   *
   * @since 1.0.0
   *
   * @type {string}
   */
  style: '',
  /**
   * Holds the shape filed selector.
   *
   * @since 1.0.0
   *
   * @type {string}
   */
  shape: '',
  /**
   * Holds the selector prefix.
   *
   * @since 1.0.0
   *
   * @type {string}
   */
  prefix: '',
  /**
   * Initialize
   *
   * @since 1.0.0
   *
   * @param {Object} params       Contains the necessary parameters.
   * @param {string} params.page  Contains the page of this module will be used [ attribute, product ].
   * @param {string} params.type  Contains the class or selector of select type field.
   * @param {string} params.style Contains the class or selector of select style field.
   * @param {string} params.shape Contains the class or selector of select shape field.
   */
  init: function init(params) {
    if (!params.page || !params.type || !params.style || !params.shape) {
      return;
    }

    // Set properties.
    this.page = params.page;
    this.type = params.type;
    this.style = params.style;
    this.shape = params.shape;

    // Load events.
    this.onChangeTypeField();
    this.onChangeStyleField();
    this.onChangeShapeField();
  },
  /**
   * Return the fields schema.
   *
   * @since 1.0.0
   *
   * @return {Object} The fields schema.
   */
  getFieldSchema: function getFieldSchema() {
    return {
      style: [{
        id: 'style',
        type: 'select',
        default: 'default'
      }],
      shape: [{
        id: 'shape',
        type: 'select',
        default: 'square'
      }],
      size: [{
        id: 'size',
        type: 'size',
        default: '40px'
      }],
      dimension: [{
        id: 'width',
        type: 'size',
        default: '40px'
      }, {
        id: 'height',
        type: 'size',
        default: '40px'
      }],
      font: [{
        id: 'font_size',
        type: 'size',
        default: '14px'
      }, {
        id: 'font_weight',
        type: 'select',
        default: '500'
      }],
      text_color: [{
        id: 'font_color',
        type: 'color',
        default: '#000000'
      }, {
        id: 'font_hover_color',
        type: 'color',
        default: '#0071f2'
      }],
      background_color: [{
        id: 'background_color',
        type: 'color',
        default: '#ffffff'
      }, {
        id: 'background_hover_color',
        type: 'color',
        default: '#ffffff'
      }],
      padding: [{
        id: 'padding_top',
        type: 'size',
        default: '5px'
      }, {
        id: 'padding_bottom',
        type: 'size',
        default: '5px'
      }, {
        id: 'padding_left',
        type: 'size',
        default: '5px'
      }, {
        id: 'padding_right',
        type: 'size',
        default: '5px'
      }],
      border: [{
        id: 'border_style',
        type: 'select',
        default: 'solid'
      }, {
        id: 'border_width',
        type: 'size',
        default: '1px'
      }, {
        id: 'border_color',
        type: 'color',
        default: '#000000'
      }, {
        id: 'border_hover_color',
        type: 'color',
        default: '#0071f2'
      }],
      border_radius: [{
        id: 'border_radius',
        type: 'size',
        default: '0px'
      }]
    };
  },
  /**
   * Return the list of group field.
   *
   * @since 1.0.0
   *
   * @return {Array} The list of group field.
   */
  getGroupFields: function getGroupFields() {
    return ['shape', 'size', 'dimension', 'font', 'text_color', 'background_color', 'padding', 'border', 'border_radius'];
  },
  /**
   * Return the list of fields based on the type.
   *
   * @since 1.0.0
   *
   * @param {string} type Contains the type value.
   * @return {Array|void} The list of fields on specific type.
   */
  getFieldsByType: function getFieldsByType(type) {
    if (!type) {
      return;
    }
    var fields = {
      button: ['shape', 'dimension', 'font', 'text_color', 'background_color', 'padding', 'border'],
      color: ['shape', 'size', 'border'],
      image: ['shape', 'size', 'border']
    };
    return fields[type];
  },
  /**
   * Return the type element selector.
   *
   * @since 1.0.0
   *
   * @return {string} The type of selector.
   */
  getTypeSelector: function getTypeSelector() {
    var typeSelector = settingField.type;
    if ('product' === settingField.page) {
      typeSelector = ".hvsfw-setting-field-type[data-prefix=\"".concat(settingField.prefix, "\"]");
    }
    return typeSelector;
  },
  /**
   * Set a certain field's default value.
   *
   * @since 1.0.0
   *
   * @param {Array} field Contains the field schema id, type and default value.
   */
  setFieldDefaultValue: function setFieldDefaultValue(field) {
    if (field) {
      var selector = settingField.prefix + '_' + field.id;
      var fieldElem = document.getElementById(selector);
      if (fieldElem) {
        /* eslint-disable indent */
        switch (field.type) {
          case 'size':
            fieldElem.value = field.default;
            break;
          case 'select':
            fieldElem.value = field.default;
            break;
          case 'color':
            jQuery(fieldElem).iris('color', field.default);
            break;
        }
        /* eslint-enable */
      }
    }
  },
  /**
   * Set all fields default value.
   *
   * @since 1.0.0
   *
   * @param {Array} fields Contains the fields to be set its value to default.
   */
  setAllFieldDefaultValue: function setAllFieldDefaultValue() {
    var fields = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
    Object.entries(this.getFieldSchema()).forEach(function (schema) {
      if (fields) {
        if (fields.includes(schema[0])) {
          schema[1].forEach(function (field) {
            settingField.setFieldDefaultValue(field);
          });
        }
      }
    });
  },
  /**
   * Set each group field visibility.
   *
   * @since 1.0.0
   *
   * @param {Array}  groups     Contains the names of the group field to be modified.
   * @param {string} visibility Contains the updated visibility state.
   */
  setGroupFieldsVisibility: function setGroupFieldsVisibility(groups, visibility) {
    if (groups && visibility) {
      groups.forEach(function (group) {
        _helpers__WEBPACK_IMPORTED_MODULE_0__.setAttribute.elem("[data-group-field=\"".concat(settingField.prefix, "_").concat(group, "\"]"), 'data-visible', visibility);
      });
    }
  },
  /**
   * Update all fields state that are dependent in type field.
   *
   * @since 1.0.0
   */
  onChangeTypeField: function onChangeTypeField() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('change', this.type, function (e) {
      var target = e.target;
      var type = target.value;
      var prefix = target.getAttribute('data-prefix');
      var validTypes = ['default', 'select', 'button', 'color', 'image', 'assorted'];
      if (!prefix || !validTypes.includes(type)) {
        return;
      }

      // Set prefix property.
      settingField.prefix = prefix;
      var styleElem = document.getElementById("".concat(prefix, "_style"));
      if (!styleElem) {
        return;
      }
      var groups = settingField.getGroupFields();
      if (['default', 'select', 'assorted'].includes(type)) {
        groups.push('style');
        settingField.setGroupFieldsVisibility(groups, 'no');
        return;
      }
      settingField.setGroupFieldsVisibility(['style'], 'yes');
      var style = styleElem.value;
      if (!['default', 'custom'].includes(style)) {
        return;
      }
      if ('default' === style) {
        return;
      }
      settingField.setGroupFieldsVisibility(groups, 'no');
      groups.push('style');
      settingField.setAllFieldDefaultValue(groups);
    });
  },
  /**
   * Update all fields state that are dependent in style field.
   *
   * @since 1.0.0
   */
  onChangeStyleField: function onChangeStyleField() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('change', this.style, function (e) {
      var target = e.target;
      var style = target.value;
      var prefix = target.getAttribute('data-prefix');
      if (!prefix || !['default', 'custom'].includes(style)) {
        return;
      }

      // Set prefix property.
      settingField.prefix = prefix;
      var typeElem = document.querySelector(settingField.getTypeSelector());
      if (typeElem) {
        var type = typeElem.value;
        if (['button', 'color', 'image'].includes(type)) {
          var groups = settingField.getGroupFields();
          var fields = settingField.getFieldsByType(type);
          settingField.setGroupFieldsVisibility(groups, 'no');
          settingField.setGroupFieldsVisibility(fields, 'custom' === style ? 'yes' : 'no');
          fields.push('dimension', 'border_radius');
          settingField.setAllFieldDefaultValue(fields);
        }
      }
    });
  },
  /**
   * Update all fields state that are dependent in shape field.
   *
   * @since 1.0.0
   */
  onChangeShapeField: function onChangeShapeField() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('change', this.shape, function (e) {
      var target = e.target;
      var shape = target.value;
      var prefix = target.getAttribute('data-prefix');
      if (!prefix || !['square', 'circle', 'custom'].includes(shape)) {
        return;
      }

      // Set prefix property.
      settingField.prefix = prefix;
      var typeElem = document.querySelector(settingField.getTypeSelector());
      if (typeElem) {
        var type = typeElem.value;
        if (['button', 'color', 'image'].includes(type)) {
          var groups = (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.removeArrayItem)(settingField.getGroupFields(), 'shape');
          var fields = settingField.getFieldsByType(type);
          settingField.setGroupFieldsVisibility(groups, 'no');
          settingField.setGroupFieldsVisibility(fields, 'yes');
          if ('custom' === shape) {
            _helpers__WEBPACK_IMPORTED_MODULE_0__.setAttribute.elem("[data-group-field=\"".concat(prefix, "_border_radius\"]"), 'data-visible', 'yes');
            if (['color', 'image'].includes(type)) {
              _helpers__WEBPACK_IMPORTED_MODULE_0__.setAttribute.elem("[data-group-field=\"".concat(prefix, "_size\"]"), 'data-visible', 'no');
              _helpers__WEBPACK_IMPORTED_MODULE_0__.setAttribute.elem("[data-group-field=\"".concat(prefix, "_dimension\"]"), 'data-visible', 'yes');
            }
          }
        }
      }
    });
  }
};
/* harmony default export */ __webpack_exports__["default"] = (settingField);

/***/ }),

/***/ "./resources/admin/scripts/modules/tooltipField.js":
/*!*********************************************************!*\
  !*** ./resources/admin/scripts/modules/tooltipField.js ***!
  \*********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helpers_index_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../helpers/index.js */ "./resources/helpers/index.js");
/* harmony import */ var _imagePicker_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./imagePicker.js */ "./resources/admin/scripts/modules/imagePicker.js");
/**
 * Internal Dependencies.
 */


/**
 * Internal Modules.
 */


/**
 * Tooltio Field Module.
 *
 * @since 1.0.0
 *
 * @type   {Object}
 * @author Mafel John Cahucom
 */
var tooltipField = {
  /**
   * Initialize.
   *
   * @since 1.0.0
   */
  init: function init() {
    this.onChangeTypeField();
  },
  /**
   * Set to default or reset tooltip form.
   *
   * @since 1.0.0
   *
   * @param {string} action Contains the type of action.
   * @param {string} prefix Contains the prefix of the field.
   */
  setToDefault: function setToDefault() {
    var action = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'set';
    var prefix = arguments.length > 1 ? arguments[1] : undefined;
    if (action && prefix) {
      var imagePickerElem = document.getElementById("".concat(prefix, "_content_image"));
      if (imagePickerElem) {
        _imagePicker_js__WEBPACK_IMPORTED_MODULE_1__["default"].setToDefault(imagePickerElem);
      }
      _helpers_index_js__WEBPACK_IMPORTED_MODULE_0__.setValue.elem("[id=\"".concat(prefix, "_content_text\"]"), '');
      _helpers_index_js__WEBPACK_IMPORTED_MODULE_0__.setValue.elem("[id=\"".concat(prefix, "_content_html\"]"), '');
      _helpers_index_js__WEBPACK_IMPORTED_MODULE_0__.setAttribute.elem("[data-group-field=\"".concat(prefix, "_content_text\"]"), 'data-visible', 'no');
      _helpers_index_js__WEBPACK_IMPORTED_MODULE_0__.setAttribute.elem("[data-group-field=\"".concat(prefix, "_content_html\"]"), 'data-visible', 'no');
      _helpers_index_js__WEBPACK_IMPORTED_MODULE_0__.setAttribute.elem("[data-group-field=\"".concat(prefix, "_content_image\"]"), 'data-visible', 'no');
      if ('reset' === action) {
        _helpers_index_js__WEBPACK_IMPORTED_MODULE_0__.setValue.elem("[id=\"".concat(prefix, "_type\"]"), 'none');
      }
    }
  },
  /**
   * Update all fields state that are dependent in type field.
   *
   * @since 1.0.0
   */
  onChangeTypeField: function onChangeTypeField() {
    (0,_helpers_index_js__WEBPACK_IMPORTED_MODULE_0__.eventListener)('change', '.hvsfw-tooltip-field-type', function (e) {
      var target = e.target;
      var type = target.value;
      var prefix = target.getAttribute('data-prefix');
      if (prefix && ['none', 'default', 'text', 'image', 'html'].includes(type)) {
        tooltipField.setToDefault('set', prefix);
        _helpers_index_js__WEBPACK_IMPORTED_MODULE_0__.setAttribute.elem("[data-group-field=\"".concat(prefix, "_content_").concat(type, "\"]"), 'data-visible', 'yes');
      }
    });
  }
};
/* harmony default export */ __webpack_exports__["default"] = (tooltipField);

/***/ }),

/***/ "./resources/helpers/createTextFile.js":
/*!*********************************************!*\
  !*** ./resources/helpers/createTextFile.js ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Create a text file from the text of the appended element.
 *
 * @since 1.0.0
 *
 * @param {string} filename Contains the filename that will used as name of .txt file.
 * @param {string} content  Contains the content of the .txt file.
 */
var createTextFile = function createTextFile(filename, content) {
  if (filename && content) {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(content));
    element.setAttribute('download', filename);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
  }
};
/* harmony default export */ __webpack_exports__["default"] = (createTextFile);

/***/ }),

/***/ "./resources/helpers/eventListener.js":
/*!********************************************!*\
  !*** ./resources/helpers/eventListener.js ***!
  \********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator.return && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, catch: function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
/**
 * Global event listener delegation.
 *
 * @since 1.0.0
 *
 * @param {string}   type     Contains the event type can be multiple seperate with space.
 * @param {string}   selector Contains the target element selector.
 * @param {Function} callback Contains the callback function.
 */
var eventListener = /*#__PURE__*/function () {
  var _ref = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee(type, selector, callback) {
    var events;
    return _regeneratorRuntime().wrap(function _callee$(_context) {
      while (1) switch (_context.prev = _context.next) {
        case 0:
          events = type.split(' ');
          events.forEach(function (event) {
            document.addEventListener(event, function (e) {
              if (e.target.matches(selector)) {
                callback(e);
              }
            });
          });
        case 2:
        case "end":
          return _context.stop();
      }
    }, _callee);
  }));
  return function eventListener(_x, _x2, _x3) {
    return _ref.apply(this, arguments);
  };
}();
/* harmony default export */ __webpack_exports__["default"] = (eventListener);

/***/ }),

/***/ "./resources/helpers/getCheckboxValue.js":
/*!***********************************************!*\
  !*** ./resources/helpers/getCheckboxValue.js ***!
  \***********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Return the checkbox value.
 *
 * @since 1.0.0
 *
 * @param {string} selector Contains the target element selector.
 * @return {array} The value of each checked checkbox.
 */
var getCheckboxValue = function getCheckboxValue(selector) {
  var values = [];
  var checkedCheckboxElems = document.querySelectorAll("".concat(selector, ":checked"));
  if (0 < checkedCheckboxElems.length) {
    checkedCheckboxElems.forEach(function (checkedCheckboxElem) {
      var value = checkedCheckboxElem.value;
      if (0 !== value.length) {
        values.push(value);
      }
    });
  }
  return values;
};
/* harmony default export */ __webpack_exports__["default"] = (getCheckboxValue);

/***/ }),

/***/ "./resources/helpers/getExtractedNumbers.js":
/*!**************************************************!*\
  !*** ./resources/helpers/getExtractedNumbers.js ***!
  \**************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Return the entire extracted numerical character from a string.
 *
 * @since 1.0.0
 *
 * @param {string} string Contains the string source to be filtered.
 * @return {numeric} The extracted numbers from string.
 */
var getExtractedNumbers = function getExtractedNumbers(string) {
  if (!string) {
    return 0;
  }
  var number = parseInt(string.replace(/[^0-9]/g, ''));
  return isNaN(number) ? 0 : number;
};
/* harmony default export */ __webpack_exports__["default"] = (getExtractedNumbers);

/***/ }),

/***/ "./resources/helpers/getFetch.js":
/*!***************************************!*\
  !*** ./resources/helpers/getFetch.js ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _isObject__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./isObject */ "./resources/helpers/isObject.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator.return && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, catch: function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
/**
 * Internal dependencies
 */


/**
 * A global fetch handler for making HTTP requests and processing responses.
 *
 * @since 1.0.0
 *
 * @param {Object} payloads Contains the data payload of the request, to be specific, the URL query string.
 * @return {Promise} The `Promise` from a fullfilled HTTP request's response.
 */
var getFetch = /*#__PURE__*/function () {
  var _ref = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee(payloads) {
    var result, response;
    return _regeneratorRuntime().wrap(function _callee$(_context) {
      while (1) switch (_context.prev = _context.next) {
        case 0:
          result = {
            success: false,
            data: {
              error: 'NETWORK_ERROR'
            }
          };
          if (!_isObject__WEBPACK_IMPORTED_MODULE_0__["default"].empty(payloads)) {
            _context.next = 4;
            break;
          }
          result.data.error = 'MISSING_DATA_ERROR';
          return _context.abrupt("return", result);
        case 4:
          _context.prev = 4;
          _context.next = 7;
          return fetch(hvsfwLocal.url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(payloads)
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
          console.log('error', _context.t0); // eslint-disable-line no-console
        case 17:
          return _context.abrupt("return", result);
        case 18:
        case "end":
          return _context.stop();
      }
    }, _callee, null, [[4, 14]]);
  }));
  return function getFetch(_x) {
    return _ref.apply(this, arguments);
  };
}();
/* harmony default export */ __webpack_exports__["default"] = (getFetch);

/***/ }),

/***/ "./resources/helpers/getLinearColor.js":
/*!*********************************************!*\
  !*** ./resources/helpers/getLinearColor.js ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Return the linear gradient color or stripe color.
 * 
 * @since 1.0.0
 * 
 * @param  {Array}  colors Contains the list of colors to rendered in background color.
 * @param  {string} degree Contains the total degree or angle of the background color.
 * @return {string} The css gradient background color property.
 */
var getLinearColor = function getLinearColor(colors) {
  var degree = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '-45deg';
  if (colors.length === 0 || !Array.isArray(colors)) {
    return '#ffffff';
  }
  var value = "".concat(degree, ", ");
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
};
/* harmony default export */ __webpack_exports__["default"] = (getLinearColor);

/***/ }),

/***/ "./resources/helpers/getPascalString.js":
/*!**********************************************!*\
  !*** ./resources/helpers/getPascalString.js ***!
  \**********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Return the converted Pascal case format string from a provided string.
 *
 * @since 1.0.0
 *
 * @param {string} separator Contains the regular expression to use for splitting.
 * @param {string} joiner    Contains the regular expression to use for joining.
 * @param {string} string    Contains the string to be formated to pascal case.
 * @return {string} The converted Pascal case format string.
 */
var getPascalString = function getPascalString(separator, joiner, string) {
  if (0 === separator.length || 0 === joiner.length || 0 === string.length) {
    return '';
  }
  var cleanStr = string.replace(/#/g, '');
  var splittedStr = cleanStr.toLowerCase().split(separator);
  for (var i = 0; i < splittedStr.length; i++) {
    splittedStr[i] = splittedStr[i].charAt(0).toUpperCase() + splittedStr[i].substring(1);
  }
  return splittedStr.join(joiner);
};
/* harmony default export */ __webpack_exports__["default"] = (getPascalString);

/***/ }),

/***/ "./resources/helpers/getUCFirst.js":
/*!*****************************************!*\
  !*** ./resources/helpers/getUCFirst.js ***!
  \*****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Return the string with capitalize letter in a word.
 * 
 * @since 1.0.0
 * 
 * @param  {string} string Contains the string to be capitalize.
 * @return {string} The string with capitalize letter.
 */
var getUCFirst = function getUCFirst() {
  var string = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
  return string.charAt(0).toUpperCase() + string.slice(1);
};
/* harmony default export */ __webpack_exports__["default"] = (getUCFirst);

/***/ }),

/***/ "./resources/helpers/hasMissingChild.js":
/*!**********************************************!*\
  !*** ./resources/helpers/hasMissingChild.js ***!
  \**********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Check whether a parent element has a missing children elements.
 * 
 * @since 1.0.0
 * 
 * @param  {Object} parent   Contains the parent element.
 * @param  {Array}  children Contains the selectors of the children element.
 * @return {boolean} The flag whether the parent element has a missing child.
 */
var hasMissingChild = function hasMissingChild(parent, children) {
  if (!parent || !children) {
    return true;
  }
  var output = false;
  children.forEach(function (child) {
    var elems = parent.querySelectorAll(child);
    if (elems.length === 0) {
      output = true;
    }
  });
  return output;
};
/* harmony default export */ __webpack_exports__["default"] = (hasMissingChild);

/***/ }),

/***/ "./resources/helpers/index.js":
/*!************************************!*\
  !*** ./resources/helpers/index.js ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   createTextFile: function() { return /* reexport safe */ _createTextFile__WEBPACK_IMPORTED_MODULE_0__["default"]; },
/* harmony export */   eventListener: function() { return /* reexport safe */ _eventListener__WEBPACK_IMPORTED_MODULE_1__["default"]; },
/* harmony export */   getCheckboxValue: function() { return /* reexport safe */ _getCheckboxValue__WEBPACK_IMPORTED_MODULE_2__["default"]; },
/* harmony export */   getExtractedNumbers: function() { return /* reexport safe */ _getExtractedNumbers__WEBPACK_IMPORTED_MODULE_3__["default"]; },
/* harmony export */   getFetch: function() { return /* reexport safe */ _getFetch__WEBPACK_IMPORTED_MODULE_4__["default"]; },
/* harmony export */   getLinearColor: function() { return /* reexport safe */ _getLinearColor__WEBPACK_IMPORTED_MODULE_5__["default"]; },
/* harmony export */   getPascalString: function() { return /* reexport safe */ _getPascalString__WEBPACK_IMPORTED_MODULE_8__["default"]; },
/* harmony export */   getUCFirst: function() { return /* reexport safe */ _getUCFirst__WEBPACK_IMPORTED_MODULE_6__["default"]; },
/* harmony export */   hasMissingChild: function() { return /* reexport safe */ _hasMissingChild__WEBPACK_IMPORTED_MODULE_7__["default"]; },
/* harmony export */   isAnimationDone: function() { return /* reexport safe */ _isAnimationDone__WEBPACK_IMPORTED_MODULE_9__["default"]; },
/* harmony export */   isNumber: function() { return /* reexport safe */ _isNumber__WEBPACK_IMPORTED_MODULE_10__["default"]; },
/* harmony export */   isObject: function() { return /* reexport safe */ _isObject__WEBPACK_IMPORTED_MODULE_11__["default"]; },
/* harmony export */   isValidHexaColor: function() { return /* reexport safe */ _isValidHexaColor__WEBPACK_IMPORTED_MODULE_12__["default"]; },
/* harmony export */   removeArrayItem: function() { return /* reexport safe */ _removeArrayItem__WEBPACK_IMPORTED_MODULE_13__["default"]; },
/* harmony export */   removeElement: function() { return /* reexport safe */ _removeElement__WEBPACK_IMPORTED_MODULE_14__["default"]; },
/* harmony export */   setAttribute: function() { return /* reexport safe */ _setAttribute__WEBPACK_IMPORTED_MODULE_15__["default"]; },
/* harmony export */   setInlineStyle: function() { return /* reexport safe */ _setInlineStyle__WEBPACK_IMPORTED_MODULE_16__["default"]; },
/* harmony export */   setText: function() { return /* reexport safe */ _setText__WEBPACK_IMPORTED_MODULE_17__["default"]; },
/* harmony export */   setValue: function() { return /* reexport safe */ _setValue__WEBPACK_IMPORTED_MODULE_18__["default"]; },
/* harmony export */   setVisibility: function() { return /* reexport safe */ _setVisibility__WEBPACK_IMPORTED_MODULE_19__["default"]; }
/* harmony export */ });
/* harmony import */ var _createTextFile__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./createTextFile */ "./resources/helpers/createTextFile.js");
/* harmony import */ var _eventListener__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./eventListener */ "./resources/helpers/eventListener.js");
/* harmony import */ var _getCheckboxValue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./getCheckboxValue */ "./resources/helpers/getCheckboxValue.js");
/* harmony import */ var _getExtractedNumbers__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./getExtractedNumbers */ "./resources/helpers/getExtractedNumbers.js");
/* harmony import */ var _getFetch__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./getFetch */ "./resources/helpers/getFetch.js");
/* harmony import */ var _getLinearColor__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./getLinearColor */ "./resources/helpers/getLinearColor.js");
/* harmony import */ var _getUCFirst__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./getUCFirst */ "./resources/helpers/getUCFirst.js");
/* harmony import */ var _hasMissingChild__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./hasMissingChild */ "./resources/helpers/hasMissingChild.js");
/* harmony import */ var _getPascalString__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./getPascalString */ "./resources/helpers/getPascalString.js");
/* harmony import */ var _isAnimationDone__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./isAnimationDone */ "./resources/helpers/isAnimationDone.js");
/* harmony import */ var _isNumber__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./isNumber */ "./resources/helpers/isNumber.js");
/* harmony import */ var _isObject__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./isObject */ "./resources/helpers/isObject.js");
/* harmony import */ var _isValidHexaColor__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./isValidHexaColor */ "./resources/helpers/isValidHexaColor.js");
/* harmony import */ var _removeArrayItem__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./removeArrayItem */ "./resources/helpers/removeArrayItem.js");
/* harmony import */ var _removeElement__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./removeElement */ "./resources/helpers/removeElement.js");
/* harmony import */ var _setAttribute__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./setAttribute */ "./resources/helpers/setAttribute.js");
/* harmony import */ var _setInlineStyle__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./setInlineStyle */ "./resources/helpers/setInlineStyle.js");
/* harmony import */ var _setText__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ./setText */ "./resources/helpers/setText.js");
/* harmony import */ var _setValue__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! ./setValue */ "./resources/helpers/setValue.js");
/* harmony import */ var _setVisibility__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! ./setVisibility */ "./resources/helpers/setVisibility.js");
/**
 * Index Exporter.
 *
 * @since 1.0.0
 */






















/***/ }),

/***/ "./resources/helpers/isAnimationDone.js":
/*!**********************************************!*\
  !*** ./resources/helpers/isAnimationDone.js ***!
  \**********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Determines whether a certain animation that is executing on a certain element is done.
 *
 * @since 1.0.0
 *
 * @param {Object} element Contains the target element where animation is executing.
 * @type  {boolean} The flag whether the animation is done.
 */
var isAnimationDone = function isAnimationDone(element) {
  return new Promise(function (resolve) {
    if (!element) {
      resolve(false);
    }
    element.addEventListener('animationend', function () {
      resolve(true);
    });
  });
};
/* harmony default export */ __webpack_exports__["default"] = (isAnimationDone);

/***/ }),

/***/ "./resources/helpers/isNumber.js":
/*!***************************************!*\
  !*** ./resources/helpers/isNumber.js ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Checks whether a data is a valid number.
 *
 * @since 1.0.0
 *
 * @param  {*} data Contains the data to be validated.
 * @return {booean} The flag whether the data is a valid number.
 */
var isNumber = function isNumber(data) {
  return !isNaN(data);
};
/* harmony default export */ __webpack_exports__["default"] = (isNumber);

/***/ }),

/***/ "./resources/helpers/isObject.js":
/*!***************************************!*\
  !*** ./resources/helpers/isObject.js ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Provides a useful `Object` data type checker utilities.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
var isObject = {
  /**
   * Checks if the object is empty.
   *
   * @since 1.0.0
   *
   * @param {Object} object Contains the object object to be checked.
   * @return {boolean} The flag whether a certain key is empty.
   */
  empty: function empty(object) {
    return 0 === Object.keys(object).length;
  },
  /**
   * Checks if the object has a missing key, if has found
   * a missing key return true.
   *
   * @since 1.0.0
   *
   * @param {Array}  keys   Contains the list of keys use as referrence.
   * @param {Object} object Contains the object to be checked.
   * @return {boolean|void} The flag whether a certain key is missing.
   */
  hasMissingKey: function hasMissingKey(keys, object) {
    if (0 === keys.length || this.empty(object)) {
      return;
    }
    var hasMissing = false;
    keys.forEach(function (key) {
      if (!object.hasOwnProperty(key)) {
        hasMissing = true;
      }
    });
    return hasMissing;
  }
};
/* harmony default export */ __webpack_exports__["default"] = (isObject);

/***/ }),

/***/ "./resources/helpers/isValidHexaColor.js":
/*!***********************************************!*\
  !*** ./resources/helpers/isValidHexaColor.js ***!
  \***********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Checks whether the color is a valid hexa color.
 *
 * @since 1.0.0
 *
 * @param  {string} color Contains the color to be validated.
 * @return {booean} The flag whether the color is a valid hexa color.
 */
var isValidHexaColor = function isValidHexaColor(color) {
  if (!color) {
    return false;
  }
  return /^#([0-9A-F]{3}){1,2}$/i.test(color);
};
/* harmony default export */ __webpack_exports__["default"] = (isValidHexaColor);

/***/ }),

/***/ "./resources/helpers/removeArrayItem.js":
/*!**********************************************!*\
  !*** ./resources/helpers/removeArrayItem.js ***!
  \**********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Remove a specific item in an array.
 *
 * @since 1.0.0
 *
 * @param  {Array} array Contains the array to be filtered.
 * @param  {Array} item  Contains the item to be removed in the array.
 * @return {Array} The filtered array.
 */
var removeArrayItem = function removeArrayItem(array, item) {
  return array.filter(function (value) {
    return value !== item;
  });
};
/* harmony default export */ __webpack_exports__["default"] = (removeArrayItem);

/***/ }),

/***/ "./resources/helpers/removeElement.js":
/*!********************************************!*\
  !*** ./resources/helpers/removeElement.js ***!
  \********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Removing an element(s) based on the provided selector.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
var removeElement = {
  /**
   * Remove the target element(s).
   *
   * @since 1.0.0
   *
   * @param {string} selector Contains the target element selector.
   */
  elem: function elem(selector) {
    if (selector) {
      var elems = document.querySelectorAll(selector);
      if (0 < elems.length) {
        elems.forEach(function (elem) {
          elem.remove();
        });
      }
    }
  },
  /**
   * Remove a child element from a parent element.
   *
   * @since 1.0.0
   *
   * @param {Object} parent   Contains the target parent element.
   * @param {string} selector Contains the selector of the target child element(s).
   */
  child: function child(parent, selector) {
    if (parent && selector) {
      var elems = parent.querySelectorAll(selector);
      if (0 < elems.length) {
        elems.forEach(function (elem) {
          elem.remove();
        });
      }
    }
  }
};
/* harmony default export */ __webpack_exports__["default"] = (removeElement);

/***/ }),

/***/ "./resources/helpers/setAttribute.js":
/*!*******************************************!*\
  !*** ./resources/helpers/setAttribute.js ***!
  \*******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Set up element's attribute.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
var setAttribute = {
  /**
   * Set the attribute of target element(s).
   *
   * @since 1.0.0
   *
   * @param {string} selector  Contains the selector of the target element(s).
   * @param {string} attribute Contains the attribute to be set.
   * @param {string} value     Contains the value of the attribute.
   */
  elem: function elem(selector, attribute, value) {
    if (selector && attribute) {
      var elems = document.querySelectorAll(selector);
      if (0 < elems.length) {
        elems.forEach(function (elem) {
          elem.setAttribute(attribute, value);
        });
      }
    }
  },
  /**
   * Set the attribute of the target children element(s).
   *
   * @since 1.0.0
   *
   * @param {Object} parent    Contains the target parent element.
   * @param {string} selector  Contains the selector of the target child element(s).
   * @param {string} attribute Contains the attribute to be set.
   * @param {string} value     Contains the value of the attribute.
   */
  child: function child(parent, selector, attribute, value) {
    if (parent && selector && attribute) {
      var elems = parent.querySelectorAll(selector);
      if (0 < elems.length) {
        elems.forEach(function (elem) {
          elem.setAttribute(attribute, value);
        });
      }
    }
  }
};
/* harmony default export */ __webpack_exports__["default"] = (setAttribute);

/***/ }),

/***/ "./resources/helpers/setInlineStyle.js":
/*!*********************************************!*\
  !*** ./resources/helpers/setInlineStyle.js ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Set or implement the inline style on a certain element 
 * based on the given styles.
 *
 * @since 1.0.0
 * 
 * @param {Object} element Contains the target element.
 * @param {Array}  styles  Contains the style attribute and value.
 */
var setInlineStyle = function setInlineStyle(element, styles) {
  if (element && styles) {
    Object.entries(styles).forEach(function (style) {
      element.style[style[0]] = style[1];
    });
  }
};
/* harmony default export */ __webpack_exports__["default"] = (setInlineStyle);

/***/ }),

/***/ "./resources/helpers/setText.js":
/*!**************************************!*\
  !*** ./resources/helpers/setText.js ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Set up the text of an element.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
var setText = {
  /**
   * Set the text of the target element(s).
   *
   * @since 1.0.0
   *
   * @param {string} selector Contains the selector of the target element(s).
   * @param {string} text     Contains the text to be inserted in the element.
   */
  elem: function elem(selector, text) {
    if (selector && text) {
      var elems = document.querySelectorAll(selector);
      if (0 < elems.length) {
        elems.forEach(function (elem) {
          elem.textContent = text;
        });
      }
    }
  },
  /**
   * Set the text of the target children element(s).
   *
   * @since 1.0.0
   *
   * @param {Object} parent   Contains the target parent element.
   * @param {string} selector Contains the selector of the target child element(s).
   * @param {string} text     Contains the text to be inserted in the element.
   */
  child: function child(parent, selector, text) {
    if (parent && selector && text) {
      var elems = parent.querySelectorAll(selector);
      if (0 < elems.length) {
        elems.forEach(function (elem) {
          elem.textContent = text;
        });
      }
    }
  }
};
/* harmony default export */ __webpack_exports__["default"] = (setText);

/***/ }),

/***/ "./resources/helpers/setValue.js":
/*!***************************************!*\
  !*** ./resources/helpers/setValue.js ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/**
 * Set the element's value.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
var setValue = {
  /**
   * Set the value of an element.
   *
   * @since 1.0.0
   *
   * @param {string} selector Contains the target element selector.
   * @param {mixed}  value    Contains the value of the element.
   */
  elem: function elem(selector, value) {
    if (selector) {
      var elems = document.querySelectorAll(selector);
      if (elems.length > 0) {
        elems.forEach(function (elem) {
          elem.value = value;
        });
      }
    }
  },
  /**
   * Set the children value of target elements.
   *
   * @since 1.0.0
   *
   * @param {Object} parent   Contains the parent of the target element.
   * @param {string} selector Contains the selector of target child element.
   * @param {mixed}  value    Contains the value of the element.
   */
  child: function child(parent, selector, value) {
    if (parent && selector) {
      var elems = parent.querySelectorAll(selector);
      if (elems.length > 0) {
        elems.forEach(function (elem) {
          elem.value = value;
        });
      }
    }
  }
};
/* harmony default export */ __webpack_exports__["default"] = (setValue);

/***/ }),

/***/ "./resources/helpers/setVisibility.js":
/*!********************************************!*\
  !*** ./resources/helpers/setVisibility.js ***!
  \********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _setAttribute__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./setAttribute */ "./resources/helpers/setAttribute.js");
/**
 * Internal Dependencies.
 */


/**
 * Set the element's attribute data-visible.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
var setVisibility = {
  /**
   * Set the attribute data-visible of an element.
   *
   * @since 1.0.0
   *
   * @param {string} selector   Contains the target element selector.
   * @param {string} visibility Contains the visibility value yes|no.
   */
  elem: function elem(selector, visibility) {
    if (selector && visibility) {
      _setAttribute__WEBPACK_IMPORTED_MODULE_0__["default"].elem(selector, 'data-visible', visibility);
    }
  },
  /**
   * Set the children attribute of target elements.
   *
   * @since 1.0.0
   *
   * @param {Object} parent     Contains the parent of the target element.
   * @param {string} selector   Contains the selector of target child element.
   * @param {string} visibility Contains the visibility value yes|no.
   */
  child: function child(parent, selector, visibility) {
    if (parent && selector && visibility) {
      _setAttribute__WEBPACK_IMPORTED_MODULE_0__["default"].child(parent, selector, 'data-visible', visibility);
    }
  }
};
/* harmony default export */ __webpack_exports__["default"] = (setVisibility);

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
/************************************************************************/
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
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
!function() {
/*!**************************************************!*\
  !*** ./resources/admin/scripts/hvsfw-product.js ***!
  \**************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../helpers */ "./resources/helpers/index.js");
/* harmony import */ var _modules_colorPicker_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/colorPicker.js */ "./resources/admin/scripts/modules/colorPicker.js");
/* harmony import */ var _modules_imagePicker_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/imagePicker.js */ "./resources/admin/scripts/modules/imagePicker.js");
/* harmony import */ var _modules_settingField_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/settingField.js */ "./resources/admin/scripts/modules/settingField.js");
/* harmony import */ var _modules_tooltipField_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modules/tooltipField.js */ "./resources/admin/scripts/modules/tooltipField.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator.return && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, catch: function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
/**
 * Internal Dependencies.
 */


/**
 * Internal Modules.
 */





/**
 * Strict mode.
 *
 * @since 1.0.0
 *
 * @author Mafel John Cahucom
 */
'use strict'; // eslint-disable-line no-unused-expressions

/**
 * Namespace.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
var hvsfw = hvsfw || {};

/**
 * Holds the color picker events.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.colorPicker = _modules_colorPicker_js__WEBPACK_IMPORTED_MODULE_1__["default"];

/**
 * Holds the image picker events.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.imagePicker = _modules_imagePicker_js__WEBPACK_IMPORTED_MODULE_2__["default"];

/**
 * Holds the accordion component events.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.accordion = {
  /**
   * Initialize.
   *
   * @since 1.0.0
   */
  init: function init() {
    this.toggle();
  },
  /**
   * Close all the accordion children based on parent accordion attribute.
   *
   * @since 1.0.0
   *
   * @param {Object} parent Contains the accordion parent body element.
   */
  closeAllOpenedChild: function closeAllOpenedChild(parent) {
    if (!parent) {
      return;
    }

    // Update accordion toggle button state to close.
    var toggleBtnElems = parent.querySelectorAll('.hvsfw-accordion__toggle-btn[data-state="open"]');
    if (0 < toggleBtnElems.length) {
      toggleBtnElems.forEach(function (toggleBtnElem) {
        toggleBtnElem.setAttribute('title', 'open');
        toggleBtnElem.setAttribute('aria-label', 'open');
        toggleBtnElem.setAttribute('data-state', 'close');
      });
    }

    // Update accordion body state to close.
    var bodyElems = parent.querySelectorAll('.hvsfw-accordion__body[data-state="open"]');
    if (0 < bodyElems.length) {
      bodyElems.forEach(function (bodyElem) {
        setTimeout(function () {
          bodyElem.style.maxHeight = null;
        }, 300);
        bodyElem.setAttribute('data-state', 'close');
      });
    }
  },
  /**
   * Collapse card up and down.
   *
   * @since 1.0.0
   */
  toggle: function toggle() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('click', '.hvsfw-accordion__toggle-btn', function (e) {
      e.preventDefault();
      var target = e.target;
      var state = target.getAttribute('data-state');
      var bodyElem = target.closest('.hvsfw-accordion__head').nextElementSibling;
      if (bodyElem && ['open', 'close'].includes(state)) {
        var updatedTitle = 'open' === state ? 'open' : 'close';
        var updatedState = 'open' === state ? 'close' : 'open';
        bodyElem.style.maxHeight = bodyElem.scrollHeight + 'px';
        if ('open' === state) {
          setTimeout(function () {
            bodyElem.style.maxHeight = null;
          }, 300);
        } else {
          setTimeout(function () {
            bodyElem.style.maxHeight = 'max-content';
          }, 500);
        }
        target.setAttribute('title', updatedTitle);
        target.setAttribute('aria-label', updatedTitle);
        target.setAttribute('data-state', updatedState);
        bodyElem.setAttribute('data-state', updatedState);
      }
    });
  }
};

/**
 * Holds the swatch setting form events.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.form = {
  /**
   * Initialize.
   *
   * @since 1.0.0
   */
  init: function init() {
    this.colorPicker();
    this.settingFieldEvents();
    this.tooltipFieldEvents();
    this.onChangeAttributeType();
    this.onChangeTermType();
    this.saveSwatchSettings();
    this.updateSwatchSettings();
    this.resetSwatchSettings();
  },
  /**
   * Color Picker Field.
   *
   * @since 1.0.0
   */
  colorPicker: function colorPicker() {
    var colorPickerElems = document.querySelectorAll('.hvsfw-color-picker');
    if (0 < colorPickerElems.length) {
      jQuery('.hvsfw-color-picker-style').wpColorPicker();
    }
  },
  /**
   * Set to default or reset the color swatch picker.
   *
   * @since 1.0.0
   *
   * @param {Object} parent Contains the accordion parent element.
   */
  setColorPickerToDefault: function setColorPickerToDefault(parent) {
    if (parent) {
      var colorPickerElems = parent.querySelectorAll('.hvsfw-color-picker');
      if (0 < colorPickerElems.length) {
        colorPickerElems.forEach(function (colorPickerElem) {
          _modules_colorPicker_js__WEBPACK_IMPORTED_MODULE_1__["default"].setToDefault(colorPickerElem);
        });
      }
    }
  },
  /**
   * Set to default or reset the image picker.
   *
   * @since 1.0.0
   *
   * @param {Object} parent Contains the accordion parent element.
   */
  setImagePickerToDefault: function setImagePickerToDefault(parent) {
    if (parent) {
      var imagePickerElems = parent.querySelectorAll('.hvsfw-image-picker');
      if (0 < imagePickerElems.length) {
        imagePickerElems.forEach(function (imagePickerElem) {
          _modules_imagePicker_js__WEBPACK_IMPORTED_MODULE_2__["default"].setToDefault(imagePickerElem);
        });
      }
    }
  },
  /**
   * Set to default or reset the image size.
   *
   * @since 1.0.0
   *
   * @param {Object} parent Contains the accordion parent element.
   */
  setImageSizeToDefault: function setImageSizeToDefault(parent) {
    if (parent) {
      _helpers__WEBPACK_IMPORTED_MODULE_0__.setValue.child(parent, '.hvsfw-image-size-selector > select', 'thumbnail');
    }
  },
  /**
   * Set to default or reset the button label input.
   *
   * @since 1.0.0
   *
   * @param {Object} parent Contains the accordion parent element.
   */
  setButtonLabelToDefault: function setButtonLabelToDefault(parent) {
    if (parent) {
      var buttonLabelElems = parent.querySelectorAll('.hvsfw-field-value-button-label');
      if (0 < buttonLabelElems.length) {
        buttonLabelElems.forEach(function (buttonLabelElem) {
          buttonLabelElem.value = buttonLabelElem.getAttribute('data-default');
        });
      }
    }
  },
  /**
   * Set to default or reset the tooltip forms.
   *
   * @since 1.0.0
   *
   * @param {Object} parent Contains the accordion parent element.
   */
  setTooltipToDefault: function setTooltipToDefault(parent) {
    if (parent) {
      var termTypeElems = parent.querySelectorAll('.hvsfw-field-term-type');
      if (0 < termTypeElems.length) {
        termTypeElems.forEach(function (termTypeElem) {
          var prefix = termTypeElem.getAttribute('data-prefix');
          prefix = prefix.replace('[style]', '[tooltip]');
          if (prefix) {
            _modules_tooltipField_js__WEBPACK_IMPORTED_MODULE_4__["default"].setToDefault('reset', prefix);
          }
        });
      }
    }
  },
  /**
   * Set the visibilty of BlockUI loader spinner visibility.
   *
   * @since 1.0.0
   *
   * @param {string} state Contains the visibility state of the loader spinner.
   */
  blockLoader: function blockLoader(state) {
    if (state && ['show', 'hide'].includes(state)) {
      var swatchPanelElem = jQuery('#hvsfw_swatch_panel');
      if (swatchPanelElem) {
        if ('show' === state) {
          swatchPanelElem.block({
            message: null,
            overlayCSS: {
              background: '#f3f3f3',
              opacity: 0.5
            }
          });
        } else {
          swatchPanelElem.unblock();
        }
      }
    }
  },
  /**
   * Prompt the swatch form message box.
   *
   * @since 1.0.0
   *
   * @param {Object} params         Contains the parameters needed to render notice.
   * @param {string} params.state   Contains the state or status of the notice.
   * @param {string} params.message Contains the message or content of the notice.
   */
  promptNotice: function promptNotice(params) {
    if (params.state && params.message) {
      var noticeElem = document.getElementById('hvsfw-notice');
      var noticeTextElem = document.getElementById('hvsfw-notice-text');
      if (noticeElem && noticeTextElem) {
        noticeElem.setAttribute('data-state', params.state);
        noticeElem.setAttribute('data-visibility', 'visible');
        noticeTextElem.textContent = params.message;
        setTimeout(function () {
          noticeElem.setAttribute('data-visibility', 'hidden');
        }, 5000);
      }
    }
  },
  /**
   * Prompt the swatch form error message box.
   *
   * @since 1.0.0
   *
   * @param {string} error Contains the error name.
   */
  errorNotice: function errorNotice(error) {
    if (!error) {
      return;
    }
    var errors = [{
      error: 'NETWORK_ERROR',
      title: 'Network Error',
      content: 'The network connection is lost, there might be a problem with your network.'
    }, {
      error: 'SECURITY_ERROR',
      title: 'Security Error',
      content: 'A security error occur. Please try again later or contact the website administrator for help.'
    }, {
      error: 'MISSING_DATA_ERROR',
      title: 'Missing Data',
      content: 'There is a missing data that are required. Please check and try again.'
    }, {
      error: 'INVALID_PRODUCT_ID',
      title: 'Invalid Product ID',
      content: 'The product ID that you are trying to save is invalid product ID.'
    }, {
      error: 'NOT_VARIABLE_PRODUCT',
      title: 'Not Variable Product',
      content: 'The product that you are trying to save is not a variable product.'
    }, {
      error: 'FAILED_TO_SAVE',
      title: 'Failed To Save',
      content: 'Failed to save the swatch settings.'
    }, {
      error: 'FAILED_TO_RESET',
      title: 'Failed To Reset',
      content: 'Failed to reset the swatch settings.'
    }];
    var errorDetail = errors.find(function (value) {
      return value.error === error;
    });
    if (errorDetail) {
      this.promptNotice({
        state: 'error',
        message: errorDetail.content
      });
    }
  },
  /**
   * Load the setting field events from settingFieldModule.
   *
   * @since 1.0.0
   */
  settingFieldEvents: function settingFieldEvents() {
    _modules_settingField_js__WEBPACK_IMPORTED_MODULE_3__["default"].init({
      page: 'product',
      type: '.hvsfw-setting-field-type',
      style: '.hvsfw-setting-field-style',
      shape: '.hvsfw-setting-field-shape'
    });
  },
  /**
   * Load the tooltip field events from tooltipFieldModule.
   *
   * @since 1.0.0
   */
  tooltipFieldEvents: function tooltipFieldEvents() {
    _modules_tooltipField_js__WEBPACK_IMPORTED_MODULE_4__["default"].init();
  },
  /**
   * Update all fields state that are dependent in attribute type field.
   *
   * @since 1.0.0
   */
  onChangeAttributeType: function onChangeAttributeType() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('change', '.hvsfw-field-attribute-type', function (e) {
      var target = e.target;
      var type = target.value;
      var validValues = ['default', 'select', 'button', 'color', 'image', 'assorted'];
      if (!validValues.includes(type)) {
        return;
      }
      var parentElem = target.closest('[data-accordion="attribute"]');
      if (!parentElem) {
        return;
      }
      var hasMissing = (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.hasMissingChild)(parentElem, ['.hvsfw-term-control', '.hvsfw-term-select-type', '.hvsfw-field-term-type', '[data-accordion="global-style"]']);
      if (true === hasMissing) {
        return;
      }

      // Update the visibility of global style accordion.
      var isVisibleGlobalStyleAccordion = ['button', 'color', 'image'].includes(type) ? 'yes' : 'no';
      _helpers__WEBPACK_IMPORTED_MODULE_0__.setVisibility.child(parentElem, '[data-accordion="global-style"]', isVisibleGlobalStyleAccordion);

      // Update the visibility of term controls and accordion.
      var isTypeAssorted = 'assorted' === type ? 'yes' : 'no';
      var isVisibleTermControl = ['default', 'select'].includes(type) ? 'no' : 'yes';
      _helpers__WEBPACK_IMPORTED_MODULE_0__.setValue.child(parentElem, '.hvsfw-field-term-type', type);
      _helpers__WEBPACK_IMPORTED_MODULE_0__.setVisibility.child(parentElem, '.hvsfw-term-control', isVisibleTermControl);
      _helpers__WEBPACK_IMPORTED_MODULE_0__.setVisibility.child(parentElem, '.hvsfw-term-select-type', isTypeAssorted);
      _helpers__WEBPACK_IMPORTED_MODULE_0__.setVisibility.child(parentElem, '[data-accordion="style"]', isTypeAssorted);

      // Dispatch on change event in select term type.
      if (['button', 'color', 'image', 'assorted'].includes(type)) {
        var termTypeValue = 'assorted' === type ? 'button' : type;
        _helpers__WEBPACK_IMPORTED_MODULE_0__.setValue.child(parentElem, '.hvsfw-field-term-type', termTypeValue);
        var termTypeElems = parentElem.querySelectorAll('.hvsfw-field-term-type');
        if (0 < termTypeElems.length) {
          termTypeElems.forEach(function (termTypeElem) {
            termTypeElem.dispatchEvent(new Event('change', {
              bubbles: true
            }));
          });
        }
      }

      // Close all opened child accordion.
      var bodyElem = parentElem.querySelector('.hvsfw-accordion__body');
      if (bodyElem) {
        hvsfw.accordion.closeAllOpenedChild(bodyElem);
      }
    });
  },
  /**
   * Update all the fields state that are dependent in term type field.
   *
   * @since 1.0.0
   */
  onChangeTermType: function onChangeTermType() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('change', '.hvsfw-field-term-type', function (e) {
      var target = e.target;
      var type = target.value;
      var validValues = ['button', 'color', 'image'];
      if (!validValues.includes(type)) {
        return;
      }
      var parentElem = target.closest('[data-accordion="term"]');
      if (!parentElem) {
        return;
      }
      var hasMissing = (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.hasMissingChild)(parentElem, ['.hvsfw-accordion__title[data-type="value"]', '[data-group-field="value_button"]', '[data-group-field="value_color"]', '[data-group-field="value_image"]']);
      if (true === hasMissing) {
        return;
      }

      // Update term value accordion title.
      _helpers__WEBPACK_IMPORTED_MODULE_0__.setText.child(parentElem, '.hvsfw-accordion__title[data-type="value"]', (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.getUCFirst)(type));

      // Update group field visibility.
      _helpers__WEBPACK_IMPORTED_MODULE_0__.setVisibility.child(parentElem, '[data-group-field="value_button"]', 'button' === type ? 'yes' : 'no');
      _helpers__WEBPACK_IMPORTED_MODULE_0__.setVisibility.child(parentElem, '[data-group-field="value_color"]', 'color' === type ? 'yes' : 'no');
      _helpers__WEBPACK_IMPORTED_MODULE_0__.setVisibility.child(parentElem, '[data-group-field="value_image"]', 'image' === type ? 'yes' : 'no');

      // Set button label, color, image, image size picker to default.
      hvsfw.form.setButtonLabelToDefault(parentElem);
      hvsfw.form.setColorPickerToDefault(parentElem);
      hvsfw.form.setImagePickerToDefault(parentElem);
      hvsfw.form.setImageSizeToDefault(parentElem);

      // Set tooltip form to default.
      hvsfw.form.setTooltipToDefault(parentElem);

      // Close all opened child accordion.
      var bodyElem = parentElem.querySelector('.hvsfw-accordion__body');
      if (bodyElem) {
        hvsfw.accordion.closeAllOpenedChild(bodyElem);
      }
    });
  },
  /**
   * Save swatch settings via AJAX.
   *
   * @since 1.0.0
   */
  saveSwatchSettings: function saveSwatchSettings() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('click', '#hvsfw-js-save-setting-btn', /*#__PURE__*/function () {
      var _ref = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee(e) {
        var formElem, formData, res;
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              e.preventDefault();
              formElem = document.getElementById('post');
              if (formElem) {
                _context.next = 4;
                break;
              }
              return _context.abrupt("return");
            case 4:
              hvsfw.form.blockLoader('show');
              formData = new FormData(formElem);
              _context.next = 8;
              return (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.getFetch)({
                // eslint-disable-next-line no-undef
                nonce: hvsfwLocal.variation.product.nonce.saveSwatchSettings,
                action: 'hvsfw_save_swatch_settings',
                formData: new URLSearchParams(formData).toString()
              });
            case 8:
              res = _context.sent;
              hvsfw.form.blockLoader('hide');
              if (true === res.success) {
                hvsfw.form.promptNotice({
                  state: 'success',
                  message: 'Swatch settings has been successfully saved.'
                });
              } else {
                hvsfw.form.errorNotice(res.data.error);
              }
            case 11:
            case "end":
              return _context.stop();
          }
        }, _callee);
      }));
      return function (_x) {
        return _ref.apply(this, arguments);
      };
    }());
  },
  /**
   * Update swatch settings via AJAX.
   *
   * @since 1.0.0
   */
  updateSwatchSettings: function updateSwatchSettings() {
    jQuery('body').on('reload', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
      var postIdElem, swatchAttributeElem, postId, res;
      return _regeneratorRuntime().wrap(function _callee2$(_context2) {
        while (1) switch (_context2.prev = _context2.next) {
          case 0:
            postIdElem = document.getElementById('post_ID');
            swatchAttributeElem = document.getElementById('hvsfw-swatch-attributes');
            if (!(!postIdElem || !swatchAttributeElem)) {
              _context2.next = 4;
              break;
            }
            return _context2.abrupt("return");
          case 4:
            postId = parseInt(postIdElem.value);
            if (!(postId === NaN || 0 === postId)) {
              _context2.next = 7;
              break;
            }
            return _context2.abrupt("return");
          case 7:
            hvsfw.form.blockLoader('show');
            _context2.next = 10;
            return (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.getFetch)({
              // eslint-disable-next-line no-undef
              nonce: hvsfwLocal.variation.product.nonce.updateSwatchSettings,
              action: 'hvsfw_update_swatch_settings',
              postId: postId
            });
          case 10:
            res = _context2.sent;
            hvsfw.form.blockLoader('hide');
            if (true === res.success) {
              swatchAttributeElem.innerHTML = res.data.content;

              // Re-init wpColorPicker.
              hvsfw.form.colorPicker();
              jQuery('.hvsfw-color-picker__input').wpColorPicker();
            } else {
              hvsfw.form.errorNotice(res.data.error);
            }
          case 13:
          case "end":
            return _context2.stop();
        }
      }, _callee2);
    })));
  },
  /**
   * Reset swatch settings AJAX.
   *
   * @since 1.0.0
   */
  resetSwatchSettings: function resetSwatchSettings() {
    (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.eventListener)('click', '#hvsfw-js-reset-setting-btn', /*#__PURE__*/function () {
      var _ref3 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee3(e) {
        var postIdElem, postId, isContinue, res, swatchPanelElem, attributeTypeElems;
        return _regeneratorRuntime().wrap(function _callee3$(_context3) {
          while (1) switch (_context3.prev = _context3.next) {
            case 0:
              e.preventDefault();
              postIdElem = document.getElementById('post_ID');
              if (postIdElem) {
                _context3.next = 4;
                break;
              }
              return _context3.abrupt("return");
            case 4:
              postId = parseInt(postIdElem.value);
              if (!(postId === NaN || 0 === postId)) {
                _context3.next = 7;
                break;
              }
              return _context3.abrupt("return");
            case 7:
              // eslint-disable-next-line no-alert
              isContinue = confirm('Do you really want to reset the swatch settings?');
              if (isContinue) {
                _context3.next = 10;
                break;
              }
              return _context3.abrupt("return");
            case 10:
              hvsfw.form.blockLoader('show');
              _context3.next = 13;
              return (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.getFetch)({
                // eslint-disable-next-line no-undef
                nonce: hvsfwLocal.variation.product.nonce.resetSwatchSettings,
                action: 'hvsfw_reset_swatch_settings',
                postId: postId
              });
            case 13:
              res = _context3.sent;
              hvsfw.form.blockLoader('hide');
              if (true === res.success) {
                hvsfw.form.promptNotice({
                  state: 'success',
                  message: 'Swatch settings has been successfully reset.'
                });

                // Close all accordion.
                swatchPanelElem = document.getElementById('hvsfw_swatch_panel');
                if (swatchPanelElem) {
                  hvsfw.accordion.closeAllOpenedChild(swatchPanelElem);
                }

                // Set all input to default.
                attributeTypeElems = document.querySelectorAll('.hvsfw-field-attribute-type');
                if (0 < attributeTypeElems.length) {
                  attributeTypeElems.forEach(function (attributeTypeElem) {
                    attributeTypeElem.value = 'default';
                    attributeTypeElem.dispatchEvent(new Event('change', {
                      bubbles: true
                    }));
                  });
                }
              } else {
                hvsfw.form.errorNotice(res.data.error);
              }
            case 16:
            case "end":
              return _context3.stop();
          }
        }, _callee3);
      }));
      return function (_x2) {
        return _ref3.apply(this, arguments);
      };
    }());
  }
};

/**
 * Is Dom Ready.
 *
 * @since 1.0.0
 */
hvsfw.domReady = {
  /**
   * Execute the code when dom is ready.
   *
   * @param {Function} func Contains the callback function.
   * @return {Function|void} The callback function.
   */
  execute: function execute(func) {
    if ('function' !== typeof func) {
      return;
    }
    if ('interactive' === document.readyState || 'complete' === document.readyState) {
      return func();
    }
    document.addEventListener('DOMContentLoaded', func, false);
  }
};

/**
 * Initialize App.
 *
 * @since 1.0.0
 */
hvsfw.domReady.execute(function () {
  Object.entries(hvsfw).forEach(function (fragment) {
    if ('init' in fragment[1]) {
      fragment[1].init();
    }
  });
});
}();
/******/ })()
;
//# sourceMappingURL=hvsfw-product.js.map