var mybookingJsEngine =
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
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

module.exports = jQuery;

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0),__webpack_require__(2),__webpack_require__(9),__webpack_require__(4),__webpack_require__(29),__webpack_require__(3)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, commonServices, commonLoader, commonTranslations, formatter,i18next) {

  const DEFAULT_TIME_START = '10:00';
  const DEFAULT_TIME_END = '20:00';      

  var mybookingSettings = {
    data: {
      // Server
      serverDate: null,
      serverTime: null,
      // Company
      timezone  : null,
      currency: null,
      currencyDecimals: null,
      currencyDecimalsMark: null,
      currencySymbol: null,
      currencySymbolPosition: null,
      currencyThousandsSeparator: null,
      dateTimeFormat: null,
      dateFormat: null,
      dateShortFormat: null,
      promotionCode: true,      
      engineCustomerAccess: false,
      // Renting MODULE
      selectFamily: false,
      multipleDestinations: false,
      selectDestination: false,      
      // - Renting dates
      minDays   : 1,
      timeToFrom: true,
      cycleOf24Hours: true,
      defaultTimeStart: null,
      defaultTimeEnd: null,
      // - Renting pickup/return place
      pickupReturnPlace: true,
      pickupReturnPlacesSameRentalLocation: false,
      customPickupReturnPlaces: false,
      customPickupReturnPlacePrice: 0,
      // - Products
      multipleProductsSelection: false,
      multipleProductsReplicateBooking: false,
      multipleProductsReplicateBookingMax: 1,
      // - Fill data
      rentingFormFillDataAddress: false,
      rentingFormFillDataDriverDetail: false,
      rentingFromFillDataFlight: false,
      rentingFormFillDataNamedResources: false,
      rentingFormFillDataNamedResourcesHeight: false,
      rentingFormFillDataNamedResourcesWeight: false,
      // - Product Calendar
      datesSelector: 'start_end_date',
      singleDateTimeSelector: 'start_end_time',
      singleDateSlotDurationUnits: 'hours',
      singleDateSlotDurationTime: 1,
      calendarShowDailyPrices: false,
      samePickupReturnTime: false,
      // Activities/Appointments MODULE
      activityReservationMultipleItems: true,
      selectActivityCategory: false,
      selectActivityDestination: false,
      formatExtraAmount: function(i18next, oneUnitPrice, priceCalculation, days, hours, amount, currencySymbol, decimals) {

        var unitAmountFormatted = this.formatCurrency(oneUnitPrice, currencySymbol, decimals);
        var amountFormatted = this.formatCurrency(amount, currencySymbol, decimals);

        var formattedAmount = null;
        if (priceCalculation == 'calculated_by_days') {
          if (days > 0) {
             formattedAmount = '<span class="extra-unitary">'+i18next.t('extra.daily_amount',{oneUnitPrice: unitAmountFormatted})+'</span>';
          }
          else if (hours > 0) {
             formattedAmount = '<span class="extra-unitary">'+i18next.t('extra.hourly_amount',{oneUnitPrice: unitAmountFormatted})+'</span>';
          }
          formattedAmount += '<br>';
          formattedAmount += '<span class="extra-total">'+i18next.t('extra.total', {total: amountFormatted})+'</span>';
        }
        else {
          formattedAmount = amountFormatted;
        }

        return formattedAmount;

      },
      formatCurrency: function(amount, currencySymbol, decimals) {
        return formatter.formatCurrency(amount, 
                                 (currencySymbol == null ? mybookingSettings.data.currencySymbol : currencySymbol), 
                                 (decimals == 0 ? 0 : (decimals || mybookingSettings.data.currencyDecimals)),
                                 mybookingSettings.data.currencyThousandsSeparator, 
                                 mybookingSettings.data.currencyDecimalsMark,
                                 mybookingSettings.data.currencySymbolPosition);
      },
      formatDateTime: function(dateTime) {
        return formatter.formatDate(date, 
                             mybookingSettings.data.dateTimeFormat, 
                             mybookingSettings.data.timezone);
      },
      formatDate: function(date) {
        return formatter.formatDate(date, 
                             mybookingSettings.data.dateFormat);
      },
      formatShortDate: function(date) {
        return formatter.formatDate(date, 
                             mybookingSettings.data.dateShortFormat);
      },

      entityMap: {
          "&": "&amp;",
          "<": "&lt;",
          ">": "&gt;",
          '"': '&quot;',
          "'": '&#39;',
          "/": '&#x2F;'
      },

      escapeHtml: function(string) {
          var self = this;
          return String(string).replace(/[&<>"'\/]/g, function (s) {
              return self.entityMap[s];
          });
      },

      encodeData: function(str) {

          return encodeURIComponent(str).replace(/%20/g, '+')

      }

    },
    loadSettings: function(callback) {
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/settings';
      if (commonServices.apiKey && commonServices.apiKey != '') {
        url += '?api_key='+commonServices.apiKey;
      }       
      $.ajax({
           type: 'GET',
           url : url,
           contentType : 'application/json; charset=utf-8',
           crossDomain: true,
           success: function(data, textStatus, jqXHR) {
             // Server information
             mybookingSettings.data.serverDate = data.server_date;
             mybookingSettings.data.serverTime = data.server_time;
             // Company information
             mybookingSettings.data.timezone = data.timezone;
             mybookingSettings.data.currency = data.currency;
             mybookingSettings.data.currencyDecimals = data.currency_decimals;
             mybookingSettings.data.currencyDecimalsMark = data.currency_decimal_mark;
             mybookingSettings.data.currencySymbol = data.currency_symbol;
             mybookingSettings.data.currencySymbolPosition = data.currency_symbol_position;
             mybookingSettings.data.currencyThousandsSeparator = data.currency_thousands_separator;
             mybookingSettings.data.dateTimeFormat = data.frontend_datetime_format;
             mybookingSettings.data.dateFormat = data.frontend_date_format;
             mybookingSettings.data.dateShortFormat = data.frontend_short_date_format;
             mybookingSettings.data.promotionCode = data.promotion_code || false;
             // Renting
             mybookingSettings.data.selectFamily = data.select_family;
             mybookingSettings.data.selectDestination = data.select_destination;
             // - Renting dates
             mybookingSettings.data.minDays = data.min_days;
             mybookingSettings.data.timeToFrom = data.time_to_from;
             mybookingSettings.data.cycleOf24Hours = data.cycle_of_24_hours;
             mybookingSettings.data.defaultTimeStart = data.default_time_start;
             if (typeof mybookingSettings.data.defaultTimeStart === 'undefined' ||
                 mybookingSettings.data.defaultTimeStart === null || 
                 mybookingSettings.data.defaultTimeStart === '') {
               mybookingSettings.data.defaultTimeStart = DEFAULT_TIME_START;
             }
             mybookingSettings.data.defaultTimeEnd = data.default_time_end;
             if (typeof mybookingSettings.data.defaultTimeEnd === 'undefined' ||
                 mybookingSettings.data.defaultTimeStart === null || 
                 mybookingSettings.data.defaultTimeStart === '') {
               if (mybookingSettings.data.cycleOf24Hours) {
                 mybookingSettings.data.defaultTimeEnd = DEFAULT_TIME_START;
               }
               else {
                 mybookingSettings.data.defaultTimeEnd = DEFAULT_TIME_END;
               }
             }             
             // - Renting places
             mybookingSettings.data.multipleDestinations = data.multiple_destinations;
             mybookingSettings.data.pickupReturnPlace = data.pickup_return_place;
             mybookingSettings.data.pickupReturnPlacesSameRentalLocation = data.pickup_return_places_same_rental_location;
             mybookingSettings.data.customPickupReturnPlaces = data.custom_pickup_return_places;
             mybookingSettings.data.customPickupReturnPlacePrice = data.custom_pickup_return_place_price;
             // - Renting products
             mybookingSettings.data.multipleProductsSelection = data.multiple_products_selection || false;
             mybookingSettings.data.multipleProductsReplicateBooking = data.multiple_products_replicate_booking || false;
             mybookingSettings.data.multipleProductsReplicateBookingMax = data.multiple_products_replicate_booking_max || 1;
             // - Renting fill data
             mybookingSettings.data.rentingFormFillDataAddress = data.renting_form_fill_data_address || false;
             mybookingSettings.data.rentingFormFillDataDriverDetail = data.renting_form_fill_data_driver_detail || false;
             mybookingSettings.data.rentingFromFillDataFlight = data.renting_form_fill_data_flight || false;
             mybookingSettings.data.rentingFormFillDataNamedResources = data.renting_form_fill_data_named_resources || false;
             mybookingSettings.data.rentingFormFillDataNamedResourcesHeight = data.renting_form_fill_data_named_resources_height || false;
             mybookingSettings.data.rentingFormFillDataNamedResourcesWeight = data.renting_form_fill_data_named_resources_weight || false;
             // - Renting calendar
             mybookingSettings.data.datesSelector = data.dates_selector;
             mybookingSettings.data.singleDateTimeSelector = data.single_date_time_selector;
             mybookingSettings.data.singleDateSlotDurationUnits = data.single_date_slot_duration_units;
             mybookingSettings.data.singleDateSlotDurationTime = data.single_date_slot_duration_time;
             mybookingSettings.data.calendarShowDailyPrices = data.calendar_show_daily_prices;
             mybookingSettings.data.samePickupReturnTime = data.same_pickup_return_time;
             // Activities / Appointments
             mybookingSettings.data.activityReservationMultipleItems = data.activity_reservation_multiple_items;
             mybookingSettings.data.selectActivityCategory = data.select_activity_category;
             mybookingSettings.data.selectActivityDestination = data.select_activity_destination;
             // Customer access
             if (typeof data.engine_customer_access !== 'undefined') {
               mybookingSettings.data.engineCustomerAccess = true;
             }
             if (callback) {
                callback(mybookingSettings.data);
             }
           },
           error: function(data, textStatus, jqXHR) {
             // Hide the loader if error
             commonLoader.hide();
             alert('Error obteniendo la información');
           }
      });
    },
    language: function(language) {
      if (typeof language != 'undefined' && language != null) {
        if (language.length && language.length > 2) {
          return language.substring(0,2);
        }
        else {
          return language;
        }
      }
    },
    getUrlVars: function() {
          var vars = [], hash;
          var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
          for(var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
          }
          return vars;
    }
  };

  return mybookingSettings;
}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function(){

      var siteURL = mybookingEngine && mybookingEngine.siteURL ? mybookingEngine.siteURL() : '';
      if (siteURL != '') {
        siteURL += '/';
      }

      var formatURL = function(theUrl, siteURL) {

          try {
            var url = new URL(theUrl);
            if (url.protocol == '') {
              return siteURL + theUrl;
            }
            return theUrl;
          }
          catch (exception) {
            return siteURL + theUrl;
          }

        }


      var commonServices = {

        // Site url
        siteURL: siteURL,
        // Engine Connection
        URL_PREFIX: mybookingEngine && mybookingEngine.baseURL ? mybookingEngine.baseURL() : '',
        apiKey: mybookingEngine && mybookingEngine.apiKey ? mybookingEngine.apiKey() : '',
        // Loader
        customLoader: mybookingEngine && mybookingEngine.customLoader ? mybookingEngine.customLoader() : false,
        // Use select2
        jsUseSelect2: mybookingEngine && mybookingEngine.jsUseSelect2 ? mybookingEngine.jsUseSelect2() : false,
        // Bootstrap Modal compatibility (create $.fn.bootstrapModal to hold noConflict version)
        jsBsModalNoConflict: mybookingEngine && mybookingEngine.jsBsModalNoConflict ? mybookingEngine.jsBsModalNoConflict() : false,
        jsBsModalBackdropCompatibility: mybookingEngine && mybookingEngine.jsBsModalBackdropCompatibility ? mybookingEngine.jsBsModalBackdropCompatibility() : false,
        jsBSModalShowOptions: function() {
          var opts = {show: true};
          if (this.jsBsModalBackdropCompatibility) {
            opts.backdrop = false;
          }
          return opts;
        },
        // Google Maps
        useGoogleMaps: mybookingEngine && mybookingEngine.useGoogleMaps ? mybookingEngine.useGoogleMaps() : false,
        googleMapsSettings: mybookingEngine && mybookingEngine.googleMapsSettings ? mybookingEngine.googleMapsSettings() : null,
        // Renting
        chooseProductUrl: mybookingEngine && mybookingEngine.chooseProductUrl ? formatURL(mybookingEngine.chooseProductUrl(), siteURL) : '',
        extrasStep: mybookingEngine && mybookingEngine.extrasStep ? mybookingEngine.extrasStep() : false,
        chooseExtrasUrl: mybookingEngine && mybookingEngine.chooseExtrasUrl ? formatURL(mybookingEngine.chooseExtrasUrl(), siteURL) : '',
        completeUrl: mybookingEngine && mybookingEngine.completeUrl ? formatURL(mybookingEngine.completeUrl(), siteURL) : '', 
        summaryUrl: mybookingEngine && mybookingEngine.summaryUrl ? formatURL(mybookingEngine.summaryUrl(), siteURL) : '',
        termsUrl: mybookingEngine && mybookingEngine.termsUrl ? formatURL(mybookingEngine.termsUrl(), siteURL) : '',
        selectorInProcess: mybookingEngine && mybookingEngine.selectorInProcess ? mybookingEngine.selectorInProcess() : 'form',
        // Activities
        shoppingCartUrl: mybookingEngine && mybookingEngine.shoppingCartUrl ? formatURL(mybookingEngine.shoppingCartUrl(), siteURL) : '',
        orderUrl: mybookingEngine && mybookingEngine.orderUrl ? formatURL(mybookingEngine.orderUrl(), siteURL) : '',
        activitiesTermsUrl: mybookingEngine && mybookingEngine.activitiesTermsUrl ? formatURL(mybookingEngine.activitiesTermsUrl(), siteURL) : ''

      };


      return commonServices;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

(function (global, factory) {
   true ? module.exports = factory() :
  undefined;
}(this, function () { 'use strict';

  function _typeof2(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof2 = function _typeof2(obj) { return typeof obj; }; } else { _typeof2 = function _typeof2(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof2(obj); }

  function _typeof(obj) {
    if (typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol") {
      _typeof = function _typeof(obj) {
        return _typeof2(obj);
      };
    } else {
      _typeof = function _typeof(obj) {
        return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : _typeof2(obj);
      };
    }

    return _typeof(obj);
  }

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

  function _objectSpread(target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i] != null ? arguments[i] : {};
      var ownKeys = Object.keys(source);

      if (typeof Object.getOwnPropertySymbols === 'function') {
        ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function (sym) {
          return Object.getOwnPropertyDescriptor(source, sym).enumerable;
        }));
      }

      ownKeys.forEach(function (key) {
        _defineProperty(target, key, source[key]);
      });
    }

    return target;
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

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

  function _assertThisInitialized(self) {
    if (self === void 0) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }

    return self;
  }

  function _possibleConstructorReturn(self, call) {
    if (call && (_typeof(call) === "object" || typeof call === "function")) {
      return call;
    }

    return _assertThisInitialized(self);
  }

  function _getPrototypeOf(o) {
    _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {
      return o.__proto__ || Object.getPrototypeOf(o);
    };
    return _getPrototypeOf(o);
  }

  function _setPrototypeOf(o, p) {
    _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
      o.__proto__ = p;
      return o;
    };

    return _setPrototypeOf(o, p);
  }

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
    if (superClass) _setPrototypeOf(subClass, superClass);
  }

  function _arrayWithoutHoles(arr) {
    if (Array.isArray(arr)) {
      for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) {
        arr2[i] = arr[i];
      }

      return arr2;
    }
  }

  function _iterableToArray(iter) {
    if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter);
  }

  function _nonIterableSpread() {
    throw new TypeError("Invalid attempt to spread non-iterable instance");
  }

  function _toConsumableArray(arr) {
    return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread();
  }

  var consoleLogger = {
    type: 'logger',
    log: function log(args) {
      this.output('log', args);
    },
    warn: function warn(args) {
      this.output('warn', args);
    },
    error: function error(args) {
      this.output('error', args);
    },
    output: function output(type, args) {
      var _console;

      /* eslint no-console: 0 */
      if (console && console[type]) (_console = console)[type].apply(_console, _toConsumableArray(args));
    }
  };

  var Logger =
  /*#__PURE__*/
  function () {
    function Logger(concreteLogger) {
      var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

      _classCallCheck(this, Logger);

      this.init(concreteLogger, options);
    }

    _createClass(Logger, [{
      key: "init",
      value: function init(concreteLogger) {
        var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
        this.prefix = options.prefix || 'i18next:';
        this.logger = concreteLogger || consoleLogger;
        this.options = options;
        this.debug = options.debug;
      }
    }, {
      key: "setDebug",
      value: function setDebug(bool) {
        this.debug = bool;
      }
    }, {
      key: "log",
      value: function log() {
        for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
          args[_key] = arguments[_key];
        }

        return this.forward(args, 'log', '', true);
      }
    }, {
      key: "warn",
      value: function warn() {
        for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
          args[_key2] = arguments[_key2];
        }

        return this.forward(args, 'warn', '', true);
      }
    }, {
      key: "error",
      value: function error() {
        for (var _len3 = arguments.length, args = new Array(_len3), _key3 = 0; _key3 < _len3; _key3++) {
          args[_key3] = arguments[_key3];
        }

        return this.forward(args, 'error', '');
      }
    }, {
      key: "deprecate",
      value: function deprecate() {
        for (var _len4 = arguments.length, args = new Array(_len4), _key4 = 0; _key4 < _len4; _key4++) {
          args[_key4] = arguments[_key4];
        }

        return this.forward(args, 'warn', 'WARNING DEPRECATED: ', true);
      }
    }, {
      key: "forward",
      value: function forward(args, lvl, prefix, debugOnly) {
        if (debugOnly && !this.debug) return null;
        if (typeof args[0] === 'string') args[0] = "".concat(prefix).concat(this.prefix, " ").concat(args[0]);
        return this.logger[lvl](args);
      }
    }, {
      key: "create",
      value: function create(moduleName) {
        return new Logger(this.logger, _objectSpread({}, {
          prefix: "".concat(this.prefix, ":").concat(moduleName, ":")
        }, this.options));
      }
    }]);

    return Logger;
  }();

  var baseLogger = new Logger();

  var EventEmitter =
  /*#__PURE__*/
  function () {
    function EventEmitter() {
      _classCallCheck(this, EventEmitter);

      this.observers = {};
    }

    _createClass(EventEmitter, [{
      key: "on",
      value: function on(events, listener) {
        var _this = this;

        events.split(' ').forEach(function (event) {
          _this.observers[event] = _this.observers[event] || [];

          _this.observers[event].push(listener);
        });
        return this;
      }
    }, {
      key: "off",
      value: function off(event, listener) {
        var _this2 = this;

        if (!this.observers[event]) {
          return;
        }

        this.observers[event].forEach(function () {
          if (!listener) {
            delete _this2.observers[event];
          } else {
            var index = _this2.observers[event].indexOf(listener);

            if (index > -1) {
              _this2.observers[event].splice(index, 1);
            }
          }
        });
      }
    }, {
      key: "emit",
      value: function emit(event) {
        for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
          args[_key - 1] = arguments[_key];
        }

        if (this.observers[event]) {
          var cloned = [].concat(this.observers[event]);
          cloned.forEach(function (observer) {
            observer.apply(void 0, args);
          });
        }

        if (this.observers['*']) {
          var _cloned = [].concat(this.observers['*']);

          _cloned.forEach(function (observer) {
            observer.apply(observer, [event].concat(args));
          });
        }
      }
    }]);

    return EventEmitter;
  }();

  // http://lea.verou.me/2016/12/resolve-promises-externally-with-this-one-weird-trick/
  function defer() {
    var res;
    var rej;
    var promise = new Promise(function (resolve, reject) {
      res = resolve;
      rej = reject;
    });
    promise.resolve = res;
    promise.reject = rej;
    return promise;
  }
  function makeString(object) {
    if (object == null) return '';
    /* eslint prefer-template: 0 */

    return '' + object;
  }
  function copy(a, s, t) {
    a.forEach(function (m) {
      if (s[m]) t[m] = s[m];
    });
  }

  function getLastOfPath(object, path, Empty) {
    function cleanKey(key) {
      return key && key.indexOf('###') > -1 ? key.replace(/###/g, '.') : key;
    }

    function canNotTraverseDeeper() {
      return !object || typeof object === 'string';
    }

    var stack = typeof path !== 'string' ? [].concat(path) : path.split('.');

    while (stack.length > 1) {
      if (canNotTraverseDeeper()) return {};
      var key = cleanKey(stack.shift());
      if (!object[key] && Empty) object[key] = new Empty();
      object = object[key];
    }

    if (canNotTraverseDeeper()) return {};
    return {
      obj: object,
      k: cleanKey(stack.shift())
    };
  }

  function setPath(object, path, newValue) {
    var _getLastOfPath = getLastOfPath(object, path, Object),
        obj = _getLastOfPath.obj,
        k = _getLastOfPath.k;

    obj[k] = newValue;
  }
  function pushPath(object, path, newValue, concat) {
    var _getLastOfPath2 = getLastOfPath(object, path, Object),
        obj = _getLastOfPath2.obj,
        k = _getLastOfPath2.k;

    obj[k] = obj[k] || [];
    if (concat) obj[k] = obj[k].concat(newValue);
    if (!concat) obj[k].push(newValue);
  }
  function getPath(object, path) {
    var _getLastOfPath3 = getLastOfPath(object, path),
        obj = _getLastOfPath3.obj,
        k = _getLastOfPath3.k;

    if (!obj) return undefined;
    return obj[k];
  }
  function deepExtend(target, source, overwrite) {
    /* eslint no-restricted-syntax: 0 */
    for (var prop in source) {
      if (prop in target) {
        // If we reached a leaf string in target or source then replace with source or skip depending on the 'overwrite' switch
        if (typeof target[prop] === 'string' || target[prop] instanceof String || typeof source[prop] === 'string' || source[prop] instanceof String) {
          if (overwrite) target[prop] = source[prop];
        } else {
          deepExtend(target[prop], source[prop], overwrite);
        }
      } else {
        target[prop] = source[prop];
      }
    }

    return target;
  }
  function regexEscape(str) {
    /* eslint no-useless-escape: 0 */
    return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, '\\$&');
  }
  /* eslint-disable */

  var _entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#39;',
    '/': '&#x2F;'
  };
  /* eslint-enable */

  function escape(data) {
    if (typeof data === 'string') {
      return data.replace(/[&<>"'\/]/g, function (s) {
        return _entityMap[s];
      });
    }

    return data;
  }

  var ResourceStore =
  /*#__PURE__*/
  function (_EventEmitter) {
    _inherits(ResourceStore, _EventEmitter);

    function ResourceStore(data) {
      var _this;

      var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {
        ns: ['translation'],
        defaultNS: 'translation'
      };

      _classCallCheck(this, ResourceStore);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(ResourceStore).call(this));
      EventEmitter.call(_assertThisInitialized(_this)); // <=IE10 fix (unable to call parent constructor)

      _this.data = data || {};
      _this.options = options;

      if (_this.options.keySeparator === undefined) {
        _this.options.keySeparator = '.';
      }

      return _this;
    }

    _createClass(ResourceStore, [{
      key: "addNamespaces",
      value: function addNamespaces(ns) {
        if (this.options.ns.indexOf(ns) < 0) {
          this.options.ns.push(ns);
        }
      }
    }, {
      key: "removeNamespaces",
      value: function removeNamespaces(ns) {
        var index = this.options.ns.indexOf(ns);

        if (index > -1) {
          this.options.ns.splice(index, 1);
        }
      }
    }, {
      key: "getResource",
      value: function getResource(lng, ns, key) {
        var options = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};
        var keySeparator = options.keySeparator !== undefined ? options.keySeparator : this.options.keySeparator;
        var path = [lng, ns];
        if (key && typeof key !== 'string') path = path.concat(key);
        if (key && typeof key === 'string') path = path.concat(keySeparator ? key.split(keySeparator) : key);

        if (lng.indexOf('.') > -1) {
          path = lng.split('.');
        }

        return getPath(this.data, path);
      }
    }, {
      key: "addResource",
      value: function addResource(lng, ns, key, value) {
        var options = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : {
          silent: false
        };
        var keySeparator = this.options.keySeparator;
        if (keySeparator === undefined) keySeparator = '.';
        var path = [lng, ns];
        if (key) path = path.concat(keySeparator ? key.split(keySeparator) : key);

        if (lng.indexOf('.') > -1) {
          path = lng.split('.');
          value = ns;
          ns = path[1];
        }

        this.addNamespaces(ns);
        setPath(this.data, path, value);
        if (!options.silent) this.emit('added', lng, ns, key, value);
      }
    }, {
      key: "addResources",
      value: function addResources(lng, ns, resources) {
        var options = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {
          silent: false
        };

        /* eslint no-restricted-syntax: 0 */
        for (var m in resources) {
          if (typeof resources[m] === 'string' || Object.prototype.toString.apply(resources[m]) === '[object Array]') this.addResource(lng, ns, m, resources[m], {
            silent: true
          });
        }

        if (!options.silent) this.emit('added', lng, ns, resources);
      }
    }, {
      key: "addResourceBundle",
      value: function addResourceBundle(lng, ns, resources, deep, overwrite) {
        var options = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : {
          silent: false
        };
        var path = [lng, ns];

        if (lng.indexOf('.') > -1) {
          path = lng.split('.');
          deep = resources;
          resources = ns;
          ns = path[1];
        }

        this.addNamespaces(ns);
        var pack = getPath(this.data, path) || {};

        if (deep) {
          deepExtend(pack, resources, overwrite);
        } else {
          pack = _objectSpread({}, pack, resources);
        }

        setPath(this.data, path, pack);
        if (!options.silent) this.emit('added', lng, ns, resources);
      }
    }, {
      key: "removeResourceBundle",
      value: function removeResourceBundle(lng, ns) {
        if (this.hasResourceBundle(lng, ns)) {
          delete this.data[lng][ns];
        }

        this.removeNamespaces(ns);
        this.emit('removed', lng, ns);
      }
    }, {
      key: "hasResourceBundle",
      value: function hasResourceBundle(lng, ns) {
        return this.getResource(lng, ns) !== undefined;
      }
    }, {
      key: "getResourceBundle",
      value: function getResourceBundle(lng, ns) {
        if (!ns) ns = this.options.defaultNS; // COMPATIBILITY: remove extend in v2.1.0

        if (this.options.compatibilityAPI === 'v1') return _objectSpread({}, {}, this.getResource(lng, ns));
        return this.getResource(lng, ns);
      }
    }, {
      key: "getDataByLanguage",
      value: function getDataByLanguage(lng) {
        return this.data[lng];
      }
    }, {
      key: "toJSON",
      value: function toJSON() {
        return this.data;
      }
    }]);

    return ResourceStore;
  }(EventEmitter);

  var postProcessor = {
    processors: {},
    addPostProcessor: function addPostProcessor(module) {
      this.processors[module.name] = module;
    },
    handle: function handle(processors, value, key, options, translator) {
      var _this = this;

      processors.forEach(function (processor) {
        if (_this.processors[processor]) value = _this.processors[processor].process(value, key, options, translator);
      });
      return value;
    }
  };

  var Translator =
  /*#__PURE__*/
  function (_EventEmitter) {
    _inherits(Translator, _EventEmitter);

    function Translator(services) {
      var _this;

      var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

      _classCallCheck(this, Translator);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(Translator).call(this));
      EventEmitter.call(_assertThisInitialized(_this)); // <=IE10 fix (unable to call parent constructor)

      copy(['resourceStore', 'languageUtils', 'pluralResolver', 'interpolator', 'backendConnector', 'i18nFormat'], services, _assertThisInitialized(_this));
      _this.options = options;

      if (_this.options.keySeparator === undefined) {
        _this.options.keySeparator = '.';
      }

      _this.logger = baseLogger.create('translator');
      return _this;
    }

    _createClass(Translator, [{
      key: "changeLanguage",
      value: function changeLanguage(lng) {
        if (lng) this.language = lng;
      }
    }, {
      key: "exists",
      value: function exists(key) {
        var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {
          interpolation: {}
        };
        var resolved = this.resolve(key, options);
        return resolved && resolved.res !== undefined;
      }
    }, {
      key: "extractFromKey",
      value: function extractFromKey(key, options) {
        var nsSeparator = options.nsSeparator || this.options.nsSeparator;
        if (nsSeparator === undefined) nsSeparator = ':';
        var keySeparator = options.keySeparator !== undefined ? options.keySeparator : this.options.keySeparator;
        var namespaces = options.ns || this.options.defaultNS;

        if (nsSeparator && key.indexOf(nsSeparator) > -1) {
          var parts = key.split(nsSeparator);
          if (nsSeparator !== keySeparator || nsSeparator === keySeparator && this.options.ns.indexOf(parts[0]) > -1) namespaces = parts.shift();
          key = parts.join(keySeparator);
        }

        if (typeof namespaces === 'string') namespaces = [namespaces];
        return {
          key: key,
          namespaces: namespaces
        };
      }
    }, {
      key: "translate",
      value: function translate(keys, options) {
        var _this2 = this;

        if (_typeof(options) !== 'object' && this.options.overloadTranslationOptionHandler) {
          /* eslint prefer-rest-params: 0 */
          options = this.options.overloadTranslationOptionHandler(arguments);
        }

        if (!options) options = {}; // non valid keys handling

        if (keys === undefined || keys === null) return '';
        if (!Array.isArray(keys)) keys = [String(keys)]; // separators

        var keySeparator = options.keySeparator !== undefined ? options.keySeparator : this.options.keySeparator; // get namespace(s)

        var _this$extractFromKey = this.extractFromKey(keys[keys.length - 1], options),
            key = _this$extractFromKey.key,
            namespaces = _this$extractFromKey.namespaces;

        var namespace = namespaces[namespaces.length - 1]; // return key on CIMode

        var lng = options.lng || this.language;
        var appendNamespaceToCIMode = options.appendNamespaceToCIMode || this.options.appendNamespaceToCIMode;

        if (lng && lng.toLowerCase() === 'cimode') {
          if (appendNamespaceToCIMode) {
            var nsSeparator = options.nsSeparator || this.options.nsSeparator;
            return namespace + nsSeparator + key;
          }

          return key;
        } // resolve from store


        var resolved = this.resolve(keys, options);
        var res = resolved && resolved.res;
        var resUsedKey = resolved && resolved.usedKey || key;
        var resExactUsedKey = resolved && resolved.exactUsedKey || key;
        var resType = Object.prototype.toString.apply(res);
        var noObject = ['[object Number]', '[object Function]', '[object RegExp]'];
        var joinArrays = options.joinArrays !== undefined ? options.joinArrays : this.options.joinArrays; // object

        var handleAsObjectInI18nFormat = !this.i18nFormat || this.i18nFormat.handleAsObject;
        var handleAsObject = typeof res !== 'string' && typeof res !== 'boolean' && typeof res !== 'number';

        if (handleAsObjectInI18nFormat && res && handleAsObject && noObject.indexOf(resType) < 0 && !(typeof joinArrays === 'string' && resType === '[object Array]')) {
          if (!options.returnObjects && !this.options.returnObjects) {
            this.logger.warn('accessing an object - but returnObjects options is not enabled!');
            return this.options.returnedObjectHandler ? this.options.returnedObjectHandler(resUsedKey, res, options) : "key '".concat(key, " (").concat(this.language, ")' returned an object instead of string.");
          } // if we got a separator we loop over children - else we just return object as is
          // as having it set to false means no hierarchy so no lookup for nested values


          if (keySeparator) {
            var resTypeIsArray = resType === '[object Array]';
            var copy$$1 = resTypeIsArray ? [] : {}; // apply child translation on a copy

            /* eslint no-restricted-syntax: 0 */

            var newKeyToUse = resTypeIsArray ? resExactUsedKey : resUsedKey;

            for (var m in res) {
              if (Object.prototype.hasOwnProperty.call(res, m)) {
                var deepKey = "".concat(newKeyToUse).concat(keySeparator).concat(m);
                copy$$1[m] = this.translate(deepKey, _objectSpread({}, options, {
                  joinArrays: false,
                  ns: namespaces
                }));
                if (copy$$1[m] === deepKey) copy$$1[m] = res[m]; // if nothing found use orginal value as fallback
              }
            }

            res = copy$$1;
          }
        } else if (handleAsObjectInI18nFormat && typeof joinArrays === 'string' && resType === '[object Array]') {
          // array special treatment
          res = res.join(joinArrays);
          if (res) res = this.extendTranslation(res, keys, options);
        } else {
          // string, empty or null
          var usedDefault = false;
          var usedKey = false; // fallback value

          if (!this.isValidLookup(res) && options.defaultValue !== undefined) {
            usedDefault = true;

            if (options.count !== undefined) {
              var suffix = this.pluralResolver.getSuffix(lng, options.count);
              res = options["defaultValue".concat(suffix)];
            }

            if (!res) res = options.defaultValue;
          }

          if (!this.isValidLookup(res)) {
            usedKey = true;
            res = key;
          } // save missing


          var updateMissing = options.defaultValue && options.defaultValue !== res && this.options.updateMissing;

          if (usedKey || usedDefault || updateMissing) {
            this.logger.log(updateMissing ? 'updateKey' : 'missingKey', lng, namespace, key, updateMissing ? options.defaultValue : res);
            var lngs = [];
            var fallbackLngs = this.languageUtils.getFallbackCodes(this.options.fallbackLng, options.lng || this.language);

            if (this.options.saveMissingTo === 'fallback' && fallbackLngs && fallbackLngs[0]) {
              for (var i = 0; i < fallbackLngs.length; i++) {
                lngs.push(fallbackLngs[i]);
              }
            } else if (this.options.saveMissingTo === 'all') {
              lngs = this.languageUtils.toResolveHierarchy(options.lng || this.language);
            } else {
              lngs.push(options.lng || this.language);
            }

            var send = function send(l, k) {
              if (_this2.options.missingKeyHandler) {
                _this2.options.missingKeyHandler(l, namespace, k, updateMissing ? options.defaultValue : res, updateMissing, options);
              } else if (_this2.backendConnector && _this2.backendConnector.saveMissing) {
                _this2.backendConnector.saveMissing(l, namespace, k, updateMissing ? options.defaultValue : res, updateMissing, options);
              }

              _this2.emit('missingKey', l, namespace, k, res);
            };

            if (this.options.saveMissing) {
              var needsPluralHandling = options.count !== undefined && typeof options.count !== 'string';

              if (this.options.saveMissingPlurals && needsPluralHandling) {
                lngs.forEach(function (l) {
                  var plurals = _this2.pluralResolver.getPluralFormsOfKey(l, key);

                  plurals.forEach(function (p) {
                    return send([l], p);
                  });
                });
              } else {
                send(lngs, key);
              }
            }
          } // extend


          res = this.extendTranslation(res, keys, options, resolved); // append namespace if still key

          if (usedKey && res === key && this.options.appendNamespaceToMissingKey) res = "".concat(namespace, ":").concat(key); // parseMissingKeyHandler

          if (usedKey && this.options.parseMissingKeyHandler) res = this.options.parseMissingKeyHandler(res);
        } // return


        return res;
      }
    }, {
      key: "extendTranslation",
      value: function extendTranslation(res, key, options, resolved) {
        var _this3 = this;

        if (this.i18nFormat && this.i18nFormat.parse) {
          res = this.i18nFormat.parse(res, options, resolved.usedLng, resolved.usedNS, resolved.usedKey, {
            resolved: resolved
          });
        } else if (!options.skipInterpolation) {
          // i18next.parsing
          if (options.interpolation) this.interpolator.init(_objectSpread({}, options, {
            interpolation: _objectSpread({}, this.options.interpolation, options.interpolation)
          })); // interpolate

          var data = options.replace && typeof options.replace !== 'string' ? options.replace : options;
          if (this.options.interpolation.defaultVariables) data = _objectSpread({}, this.options.interpolation.defaultVariables, data);
          res = this.interpolator.interpolate(res, data, options.lng || this.language, options); // nesting

          if (options.nest !== false) res = this.interpolator.nest(res, function () {
            return _this3.translate.apply(_this3, arguments);
          }, options);
          if (options.interpolation) this.interpolator.reset();
        } // post process


        var postProcess = options.postProcess || this.options.postProcess;
        var postProcessorNames = typeof postProcess === 'string' ? [postProcess] : postProcess;

        if (res !== undefined && res !== null && postProcessorNames && postProcessorNames.length && options.applyPostProcessor !== false) {
          res = postProcessor.handle(postProcessorNames, res, key, options, this);
        }

        return res;
      }
    }, {
      key: "resolve",
      value: function resolve(keys) {
        var _this4 = this;

        var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
        var found;
        var usedKey; // plain key

        var exactUsedKey; // key with context / plural

        var usedLng;
        var usedNS;
        if (typeof keys === 'string') keys = [keys]; // forEach possible key

        keys.forEach(function (k) {
          if (_this4.isValidLookup(found)) return;

          var extracted = _this4.extractFromKey(k, options);

          var key = extracted.key;
          usedKey = key;
          var namespaces = extracted.namespaces;
          if (_this4.options.fallbackNS) namespaces = namespaces.concat(_this4.options.fallbackNS);
          var needsPluralHandling = options.count !== undefined && typeof options.count !== 'string';
          var needsContextHandling = options.context !== undefined && typeof options.context === 'string' && options.context !== '';
          var codes = options.lngs ? options.lngs : _this4.languageUtils.toResolveHierarchy(options.lng || _this4.language, options.fallbackLng);
          namespaces.forEach(function (ns) {
            if (_this4.isValidLookup(found)) return;
            usedNS = ns;
            codes.forEach(function (code) {
              if (_this4.isValidLookup(found)) return;
              usedLng = code;
              var finalKey = key;
              var finalKeys = [finalKey];

              if (_this4.i18nFormat && _this4.i18nFormat.addLookupKeys) {
                _this4.i18nFormat.addLookupKeys(finalKeys, key, code, ns, options);
              } else {
                var pluralSuffix;
                if (needsPluralHandling) pluralSuffix = _this4.pluralResolver.getSuffix(code, options.count); // fallback for plural if context not found

                if (needsPluralHandling && needsContextHandling) finalKeys.push(finalKey + pluralSuffix); // get key for context if needed

                if (needsContextHandling) finalKeys.push(finalKey += "".concat(_this4.options.contextSeparator).concat(options.context)); // get key for plural if needed

                if (needsPluralHandling) finalKeys.push(finalKey += pluralSuffix);
              } // iterate over finalKeys starting with most specific pluralkey (-> contextkey only) -> singularkey only


              var possibleKey;
              /* eslint no-cond-assign: 0 */

              while (possibleKey = finalKeys.pop()) {
                if (!_this4.isValidLookup(found)) {
                  exactUsedKey = possibleKey;
                  found = _this4.getResource(code, ns, possibleKey, options);
                }
              }
            });
          });
        });
        return {
          res: found,
          usedKey: usedKey,
          exactUsedKey: exactUsedKey,
          usedLng: usedLng,
          usedNS: usedNS
        };
      }
    }, {
      key: "isValidLookup",
      value: function isValidLookup(res) {
        return res !== undefined && !(!this.options.returnNull && res === null) && !(!this.options.returnEmptyString && res === '');
      }
    }, {
      key: "getResource",
      value: function getResource(code, ns, key) {
        var options = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};
        if (this.i18nFormat && this.i18nFormat.getResource) return this.i18nFormat.getResource(code, ns, key, options);
        return this.resourceStore.getResource(code, ns, key, options);
      }
    }]);

    return Translator;
  }(EventEmitter);

  function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  var LanguageUtil =
  /*#__PURE__*/
  function () {
    function LanguageUtil(options) {
      _classCallCheck(this, LanguageUtil);

      this.options = options;
      this.whitelist = this.options.whitelist || false;
      this.logger = baseLogger.create('languageUtils');
    }

    _createClass(LanguageUtil, [{
      key: "getScriptPartFromCode",
      value: function getScriptPartFromCode(code) {
        if (!code || code.indexOf('-') < 0) return null;
        var p = code.split('-');
        if (p.length === 2) return null;
        p.pop();
        return this.formatLanguageCode(p.join('-'));
      }
    }, {
      key: "getLanguagePartFromCode",
      value: function getLanguagePartFromCode(code) {
        if (!code || code.indexOf('-') < 0) return code;
        var p = code.split('-');
        return this.formatLanguageCode(p[0]);
      }
    }, {
      key: "formatLanguageCode",
      value: function formatLanguageCode(code) {
        // http://www.iana.org/assignments/language-tags/language-tags.xhtml
        if (typeof code === 'string' && code.indexOf('-') > -1) {
          var specialCases = ['hans', 'hant', 'latn', 'cyrl', 'cans', 'mong', 'arab'];
          var p = code.split('-');

          if (this.options.lowerCaseLng) {
            p = p.map(function (part) {
              return part.toLowerCase();
            });
          } else if (p.length === 2) {
            p[0] = p[0].toLowerCase();
            p[1] = p[1].toUpperCase();
            if (specialCases.indexOf(p[1].toLowerCase()) > -1) p[1] = capitalize(p[1].toLowerCase());
          } else if (p.length === 3) {
            p[0] = p[0].toLowerCase(); // if lenght 2 guess it's a country

            if (p[1].length === 2) p[1] = p[1].toUpperCase();
            if (p[0] !== 'sgn' && p[2].length === 2) p[2] = p[2].toUpperCase();
            if (specialCases.indexOf(p[1].toLowerCase()) > -1) p[1] = capitalize(p[1].toLowerCase());
            if (specialCases.indexOf(p[2].toLowerCase()) > -1) p[2] = capitalize(p[2].toLowerCase());
          }

          return p.join('-');
        }

        return this.options.cleanCode || this.options.lowerCaseLng ? code.toLowerCase() : code;
      }
    }, {
      key: "isWhitelisted",
      value: function isWhitelisted(code) {
        if (this.options.load === 'languageOnly' || this.options.nonExplicitWhitelist) {
          code = this.getLanguagePartFromCode(code);
        }

        return !this.whitelist || !this.whitelist.length || this.whitelist.indexOf(code) > -1;
      }
    }, {
      key: "getFallbackCodes",
      value: function getFallbackCodes(fallbacks, code) {
        if (!fallbacks) return [];
        if (typeof fallbacks === 'string') fallbacks = [fallbacks];
        if (Object.prototype.toString.apply(fallbacks) === '[object Array]') return fallbacks;
        if (!code) return fallbacks["default"] || []; // asume we have an object defining fallbacks

        var found = fallbacks[code];
        if (!found) found = fallbacks[this.getScriptPartFromCode(code)];
        if (!found) found = fallbacks[this.formatLanguageCode(code)];
        if (!found) found = fallbacks["default"];
        return found || [];
      }
    }, {
      key: "toResolveHierarchy",
      value: function toResolveHierarchy(code, fallbackCode) {
        var _this = this;

        var fallbackCodes = this.getFallbackCodes(fallbackCode || this.options.fallbackLng || [], code);
        var codes = [];

        var addCode = function addCode(c) {
          if (!c) return;

          if (_this.isWhitelisted(c)) {
            codes.push(c);
          } else {
            _this.logger.warn("rejecting non-whitelisted language code: ".concat(c));
          }
        };

        if (typeof code === 'string' && code.indexOf('-') > -1) {
          if (this.options.load !== 'languageOnly') addCode(this.formatLanguageCode(code));
          if (this.options.load !== 'languageOnly' && this.options.load !== 'currentOnly') addCode(this.getScriptPartFromCode(code));
          if (this.options.load !== 'currentOnly') addCode(this.getLanguagePartFromCode(code));
        } else if (typeof code === 'string') {
          addCode(this.formatLanguageCode(code));
        }

        fallbackCodes.forEach(function (fc) {
          if (codes.indexOf(fc) < 0) addCode(_this.formatLanguageCode(fc));
        });
        return codes;
      }
    }]);

    return LanguageUtil;
  }();

  /* eslint-disable */

  var sets = [{
    lngs: ['ach', 'ak', 'am', 'arn', 'br', 'fil', 'gun', 'ln', 'mfe', 'mg', 'mi', 'oc', 'pt', 'pt-BR', 'tg', 'ti', 'tr', 'uz', 'wa'],
    nr: [1, 2],
    fc: 1
  }, {
    lngs: ['af', 'an', 'ast', 'az', 'bg', 'bn', 'ca', 'da', 'de', 'dev', 'el', 'en', 'eo', 'es', 'et', 'eu', 'fi', 'fo', 'fur', 'fy', 'gl', 'gu', 'ha', 'hi', 'hu', 'hy', 'ia', 'it', 'kn', 'ku', 'lb', 'mai', 'ml', 'mn', 'mr', 'nah', 'nap', 'nb', 'ne', 'nl', 'nn', 'no', 'nso', 'pa', 'pap', 'pms', 'ps', 'pt-PT', 'rm', 'sco', 'se', 'si', 'so', 'son', 'sq', 'sv', 'sw', 'ta', 'te', 'tk', 'ur', 'yo'],
    nr: [1, 2],
    fc: 2
  }, {
    lngs: ['ay', 'bo', 'cgg', 'fa', 'id', 'ja', 'jbo', 'ka', 'kk', 'km', 'ko', 'ky', 'lo', 'ms', 'sah', 'su', 'th', 'tt', 'ug', 'vi', 'wo', 'zh'],
    nr: [1],
    fc: 3
  }, {
    lngs: ['be', 'bs', 'cnr', 'dz', 'hr', 'ru', 'sr', 'uk'],
    nr: [1, 2, 5],
    fc: 4
  }, {
    lngs: ['ar'],
    nr: [0, 1, 2, 3, 11, 100],
    fc: 5
  }, {
    lngs: ['cs', 'sk'],
    nr: [1, 2, 5],
    fc: 6
  }, {
    lngs: ['csb', 'pl'],
    nr: [1, 2, 5],
    fc: 7
  }, {
    lngs: ['cy'],
    nr: [1, 2, 3, 8],
    fc: 8
  }, {
    lngs: ['fr'],
    nr: [1, 2],
    fc: 9
  }, {
    lngs: ['ga'],
    nr: [1, 2, 3, 7, 11],
    fc: 10
  }, {
    lngs: ['gd'],
    nr: [1, 2, 3, 20],
    fc: 11
  }, {
    lngs: ['is'],
    nr: [1, 2],
    fc: 12
  }, {
    lngs: ['jv'],
    nr: [0, 1],
    fc: 13
  }, {
    lngs: ['kw'],
    nr: [1, 2, 3, 4],
    fc: 14
  }, {
    lngs: ['lt'],
    nr: [1, 2, 10],
    fc: 15
  }, {
    lngs: ['lv'],
    nr: [1, 2, 0],
    fc: 16
  }, {
    lngs: ['mk'],
    nr: [1, 2],
    fc: 17
  }, {
    lngs: ['mnk'],
    nr: [0, 1, 2],
    fc: 18
  }, {
    lngs: ['mt'],
    nr: [1, 2, 11, 20],
    fc: 19
  }, {
    lngs: ['or'],
    nr: [2, 1],
    fc: 2
  }, {
    lngs: ['ro'],
    nr: [1, 2, 20],
    fc: 20
  }, {
    lngs: ['sl'],
    nr: [5, 1, 2, 3],
    fc: 21
  }, {
    lngs: ['he'],
    nr: [1, 2, 20, 21],
    fc: 22
  }];
  var _rulesPluralsTypes = {
    1: function _(n) {
      return Number(n > 1);
    },
    2: function _(n) {
      return Number(n != 1);
    },
    3: function _(n) {
      return 0;
    },
    4: function _(n) {
      return Number(n % 10 == 1 && n % 100 != 11 ? 0 : n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2);
    },
    5: function _(n) {
      return Number(n === 0 ? 0 : n == 1 ? 1 : n == 2 ? 2 : n % 100 >= 3 && n % 100 <= 10 ? 3 : n % 100 >= 11 ? 4 : 5);
    },
    6: function _(n) {
      return Number(n == 1 ? 0 : n >= 2 && n <= 4 ? 1 : 2);
    },
    7: function _(n) {
      return Number(n == 1 ? 0 : n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2);
    },
    8: function _(n) {
      return Number(n == 1 ? 0 : n == 2 ? 1 : n != 8 && n != 11 ? 2 : 3);
    },
    9: function _(n) {
      return Number(n >= 2);
    },
    10: function _(n) {
      return Number(n == 1 ? 0 : n == 2 ? 1 : n < 7 ? 2 : n < 11 ? 3 : 4);
    },
    11: function _(n) {
      return Number(n == 1 || n == 11 ? 0 : n == 2 || n == 12 ? 1 : n > 2 && n < 20 ? 2 : 3);
    },
    12: function _(n) {
      return Number(n % 10 != 1 || n % 100 == 11);
    },
    13: function _(n) {
      return Number(n !== 0);
    },
    14: function _(n) {
      return Number(n == 1 ? 0 : n == 2 ? 1 : n == 3 ? 2 : 3);
    },
    15: function _(n) {
      return Number(n % 10 == 1 && n % 100 != 11 ? 0 : n % 10 >= 2 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2);
    },
    16: function _(n) {
      return Number(n % 10 == 1 && n % 100 != 11 ? 0 : n !== 0 ? 1 : 2);
    },
    17: function _(n) {
      return Number(n == 1 || n % 10 == 1 ? 0 : 1);
    },
    18: function _(n) {
      return Number(n == 0 ? 0 : n == 1 ? 1 : 2);
    },
    19: function _(n) {
      return Number(n == 1 ? 0 : n === 0 || n % 100 > 1 && n % 100 < 11 ? 1 : n % 100 > 10 && n % 100 < 20 ? 2 : 3);
    },
    20: function _(n) {
      return Number(n == 1 ? 0 : n === 0 || n % 100 > 0 && n % 100 < 20 ? 1 : 2);
    },
    21: function _(n) {
      return Number(n % 100 == 1 ? 1 : n % 100 == 2 ? 2 : n % 100 == 3 || n % 100 == 4 ? 3 : 0);
    },
    22: function _(n) {
      return Number(n === 1 ? 0 : n === 2 ? 1 : (n < 0 || n > 10) && n % 10 == 0 ? 2 : 3);
    }
  };
  /* eslint-enable */

  function createRules() {
    var rules = {};
    sets.forEach(function (set) {
      set.lngs.forEach(function (l) {
        rules[l] = {
          numbers: set.nr,
          plurals: _rulesPluralsTypes[set.fc]
        };
      });
    });
    return rules;
  }

  var PluralResolver =
  /*#__PURE__*/
  function () {
    function PluralResolver(languageUtils) {
      var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

      _classCallCheck(this, PluralResolver);

      this.languageUtils = languageUtils;
      this.options = options;
      this.logger = baseLogger.create('pluralResolver');
      this.rules = createRules();
    }

    _createClass(PluralResolver, [{
      key: "addRule",
      value: function addRule(lng, obj) {
        this.rules[lng] = obj;
      }
    }, {
      key: "getRule",
      value: function getRule(code) {
        return this.rules[code] || this.rules[this.languageUtils.getLanguagePartFromCode(code)];
      }
    }, {
      key: "needsPlural",
      value: function needsPlural(code) {
        var rule = this.getRule(code);
        return rule && rule.numbers.length > 1;
      }
    }, {
      key: "getPluralFormsOfKey",
      value: function getPluralFormsOfKey(code, key) {
        var _this = this;

        var ret = [];
        var rule = this.getRule(code);
        if (!rule) return ret;
        rule.numbers.forEach(function (n) {
          var suffix = _this.getSuffix(code, n);

          ret.push("".concat(key).concat(suffix));
        });
        return ret;
      }
    }, {
      key: "getSuffix",
      value: function getSuffix(code, count) {
        var _this2 = this;

        var rule = this.getRule(code);

        if (rule) {
          // if (rule.numbers.length === 1) return ''; // only singular
          var idx = rule.noAbs ? rule.plurals(count) : rule.plurals(Math.abs(count));
          var suffix = rule.numbers[idx]; // special treatment for lngs only having singular and plural

          if (this.options.simplifyPluralSuffix && rule.numbers.length === 2 && rule.numbers[0] === 1) {
            if (suffix === 2) {
              suffix = 'plural';
            } else if (suffix === 1) {
              suffix = '';
            }
          }

          var returnSuffix = function returnSuffix() {
            return _this2.options.prepend && suffix.toString() ? _this2.options.prepend + suffix.toString() : suffix.toString();
          }; // COMPATIBILITY JSON
          // v1


          if (this.options.compatibilityJSON === 'v1') {
            if (suffix === 1) return '';
            if (typeof suffix === 'number') return "_plural_".concat(suffix.toString());
            return returnSuffix();
          } else if (
          /* v2 */
          this.options.compatibilityJSON === 'v2') {
            return returnSuffix();
          } else if (
          /* v3 - gettext index */
          this.options.simplifyPluralSuffix && rule.numbers.length === 2 && rule.numbers[0] === 1) {
            return returnSuffix();
          }

          return this.options.prepend && idx.toString() ? this.options.prepend + idx.toString() : idx.toString();
        }

        this.logger.warn("no plural rule found for: ".concat(code));
        return '';
      }
    }]);

    return PluralResolver;
  }();

  var Interpolator =
  /*#__PURE__*/
  function () {
    function Interpolator() {
      var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      _classCallCheck(this, Interpolator);

      this.logger = baseLogger.create('interpolator');
      this.options = options;

      this.format = options.interpolation && options.interpolation.format || function (value) {
        return value;
      };

      this.init(options);
    }
    /* eslint no-param-reassign: 0 */


    _createClass(Interpolator, [{
      key: "init",
      value: function init() {
        var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
        if (!options.interpolation) options.interpolation = {
          escapeValue: true
        };
        var iOpts = options.interpolation;
        this.escape = iOpts.escape !== undefined ? iOpts.escape : escape;
        this.escapeValue = iOpts.escapeValue !== undefined ? iOpts.escapeValue : true;
        this.useRawValueToEscape = iOpts.useRawValueToEscape !== undefined ? iOpts.useRawValueToEscape : false;
        this.prefix = iOpts.prefix ? regexEscape(iOpts.prefix) : iOpts.prefixEscaped || '{{';
        this.suffix = iOpts.suffix ? regexEscape(iOpts.suffix) : iOpts.suffixEscaped || '}}';
        this.formatSeparator = iOpts.formatSeparator ? iOpts.formatSeparator : iOpts.formatSeparator || ',';
        this.unescapePrefix = iOpts.unescapeSuffix ? '' : iOpts.unescapePrefix || '-';
        this.unescapeSuffix = this.unescapePrefix ? '' : iOpts.unescapeSuffix || '';
        this.nestingPrefix = iOpts.nestingPrefix ? regexEscape(iOpts.nestingPrefix) : iOpts.nestingPrefixEscaped || regexEscape('$t(');
        this.nestingSuffix = iOpts.nestingSuffix ? regexEscape(iOpts.nestingSuffix) : iOpts.nestingSuffixEscaped || regexEscape(')');
        this.maxReplaces = iOpts.maxReplaces ? iOpts.maxReplaces : 1000; // the regexp

        this.resetRegExp();
      }
    }, {
      key: "reset",
      value: function reset() {
        if (this.options) this.init(this.options);
      }
    }, {
      key: "resetRegExp",
      value: function resetRegExp() {
        // the regexp
        var regexpStr = "".concat(this.prefix, "(.+?)").concat(this.suffix);
        this.regexp = new RegExp(regexpStr, 'g');
        var regexpUnescapeStr = "".concat(this.prefix).concat(this.unescapePrefix, "(.+?)").concat(this.unescapeSuffix).concat(this.suffix);
        this.regexpUnescape = new RegExp(regexpUnescapeStr, 'g');
        var nestingRegexpStr = "".concat(this.nestingPrefix, "(.+?)").concat(this.nestingSuffix);
        this.nestingRegexp = new RegExp(nestingRegexpStr, 'g');
      }
    }, {
      key: "interpolate",
      value: function interpolate(str, data, lng, options) {
        var _this = this;

        var match;
        var value;
        var replaces;
        var defaultData = this.options && this.options.interpolation && this.options.interpolation.defaultVariables || {};

        var combindedData = _objectSpread({}, defaultData, data);

        function regexSafe(val) {
          return val.replace(/\$/g, '$$$$');
        }

        var handleFormat = function handleFormat(key) {
          if (key.indexOf(_this.formatSeparator) < 0) return getPath(combindedData, key);
          var p = key.split(_this.formatSeparator);
          var k = p.shift().trim();
          var f = p.join(_this.formatSeparator).trim();
          return _this.format(getPath(combindedData, k), f, lng);
        };

        this.resetRegExp();
        var missingInterpolationHandler = options && options.missingInterpolationHandler || this.options.missingInterpolationHandler;
        replaces = 0; // unescape if has unescapePrefix/Suffix

        /* eslint no-cond-assign: 0 */

        while (match = this.regexpUnescape.exec(str)) {
          value = handleFormat(match[1].trim());

          if (value === undefined) {
            if (typeof missingInterpolationHandler === 'function') {
              var temp = missingInterpolationHandler(str, match, options);
              value = typeof temp === 'string' ? temp : '';
            } else {
              this.logger.warn("missed to pass in variable ".concat(match[1], " for interpolating ").concat(str));
              value = '';
            }
          } else if (typeof value !== 'string' && !this.useRawValueToEscape) {
            value = makeString(value);
          }

          str = str.replace(match[0], regexSafe(value));
          this.regexpUnescape.lastIndex = 0;
          replaces++;

          if (replaces >= this.maxReplaces) {
            break;
          }
        }

        replaces = 0; // regular escape on demand

        while (match = this.regexp.exec(str)) {
          value = handleFormat(match[1].trim());

          if (value === undefined) {
            if (typeof missingInterpolationHandler === 'function') {
              var _temp = missingInterpolationHandler(str, match, options);

              value = typeof _temp === 'string' ? _temp : '';
            } else {
              this.logger.warn("missed to pass in variable ".concat(match[1], " for interpolating ").concat(str));
              value = '';
            }
          } else if (typeof value !== 'string' && !this.useRawValueToEscape) {
            value = makeString(value);
          }

          value = this.escapeValue ? regexSafe(this.escape(value)) : regexSafe(value);
          str = str.replace(match[0], value);
          this.regexp.lastIndex = 0;
          replaces++;

          if (replaces >= this.maxReplaces) {
            break;
          }
        }

        return str;
      }
    }, {
      key: "nest",
      value: function nest(str, fc) {
        var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
        var match;
        var value;

        var clonedOptions = _objectSpread({}, options);

        clonedOptions.applyPostProcessor = false; // avoid post processing on nested lookup
        // if value is something like "myKey": "lorem $(anotherKey, { "count": {{aValueInOptions}} })"

        function handleHasOptions(key, inheritedOptions) {
          if (key.indexOf(',') < 0) return key;
          var p = key.split(',');
          key = p.shift();
          var optionsString = p.join(',');
          optionsString = this.interpolate(optionsString, clonedOptions);
          optionsString = optionsString.replace(/'/g, '"');

          try {
            clonedOptions = JSON.parse(optionsString);
            if (inheritedOptions) clonedOptions = _objectSpread({}, inheritedOptions, clonedOptions);
          } catch (e) {
            this.logger.error("failed parsing options string in nesting for key ".concat(key), e);
          }

          return key;
        } // regular escape on demand


        while (match = this.nestingRegexp.exec(str)) {
          value = fc(handleHasOptions.call(this, match[1].trim(), clonedOptions), clonedOptions); // is only the nesting key (key1 = '$(key2)') return the value without stringify

          if (value && match[0] === str && typeof value !== 'string') return value; // no string to include or empty

          if (typeof value !== 'string') value = makeString(value);

          if (!value) {
            this.logger.warn("missed to resolve ".concat(match[1], " for nesting ").concat(str));
            value = '';
          } // Nested keys should not be escaped by default #854
          // value = this.escapeValue ? regexSafe(utils.escape(value)) : regexSafe(value);


          str = str.replace(match[0], value);
          this.regexp.lastIndex = 0;
        }

        return str;
      }
    }]);

    return Interpolator;
  }();

  function _arrayWithHoles(arr) {
    if (Array.isArray(arr)) return arr;
  }

  function _iterableToArrayLimit(arr, i) {
    var _arr = [];
    var _n = true;
    var _d = false;
    var _e = undefined;

    try {
      for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) {
        _arr.push(_s.value);

        if (i && _arr.length === i) break;
      }
    } catch (err) {
      _d = true;
      _e = err;
    } finally {
      try {
        if (!_n && _i["return"] != null) _i["return"]();
      } finally {
        if (_d) throw _e;
      }
    }

    return _arr;
  }

  function _nonIterableRest() {
    throw new TypeError("Invalid attempt to destructure non-iterable instance");
  }

  function _slicedToArray(arr, i) {
    return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest();
  }

  function remove(arr, what) {
    var found = arr.indexOf(what);

    while (found !== -1) {
      arr.splice(found, 1);
      found = arr.indexOf(what);
    }
  }

  var Connector =
  /*#__PURE__*/
  function (_EventEmitter) {
    _inherits(Connector, _EventEmitter);

    function Connector(backend, store, services) {
      var _this;

      var options = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};

      _classCallCheck(this, Connector);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(Connector).call(this));
      EventEmitter.call(_assertThisInitialized(_this)); // <=IE10 fix (unable to call parent constructor)

      _this.backend = backend;
      _this.store = store;
      _this.languageUtils = services.languageUtils;
      _this.options = options;
      _this.logger = baseLogger.create('backendConnector');
      _this.state = {};
      _this.queue = [];

      if (_this.backend && _this.backend.init) {
        _this.backend.init(services, options.backend, options);
      }

      return _this;
    }

    _createClass(Connector, [{
      key: "queueLoad",
      value: function queueLoad(languages, namespaces, options, callback) {
        var _this2 = this;

        // find what needs to be loaded
        var toLoad = [];
        var pending = [];
        var toLoadLanguages = [];
        var toLoadNamespaces = [];
        languages.forEach(function (lng) {
          var hasAllNamespaces = true;
          namespaces.forEach(function (ns) {
            var name = "".concat(lng, "|").concat(ns);

            if (!options.reload && _this2.store.hasResourceBundle(lng, ns)) {
              _this2.state[name] = 2; // loaded
            } else if (_this2.state[name] < 0) ; else if (_this2.state[name] === 1) {
              if (pending.indexOf(name) < 0) pending.push(name);
            } else {
              _this2.state[name] = 1; // pending

              hasAllNamespaces = false;
              if (pending.indexOf(name) < 0) pending.push(name);
              if (toLoad.indexOf(name) < 0) toLoad.push(name);
              if (toLoadNamespaces.indexOf(ns) < 0) toLoadNamespaces.push(ns);
            }
          });
          if (!hasAllNamespaces) toLoadLanguages.push(lng);
        });

        if (toLoad.length || pending.length) {
          this.queue.push({
            pending: pending,
            loaded: {},
            errors: [],
            callback: callback
          });
        }

        return {
          toLoad: toLoad,
          pending: pending,
          toLoadLanguages: toLoadLanguages,
          toLoadNamespaces: toLoadNamespaces
        };
      }
    }, {
      key: "loaded",
      value: function loaded(name, err, data) {
        var _name$split = name.split('|'),
            _name$split2 = _slicedToArray(_name$split, 2),
            lng = _name$split2[0],
            ns = _name$split2[1];

        if (err) this.emit('failedLoading', lng, ns, err);

        if (data) {
          this.store.addResourceBundle(lng, ns, data);
        } // set loaded


        this.state[name] = err ? -1 : 2; // consolidated loading done in this run - only emit once for a loaded namespace

        var loaded = {}; // callback if ready

        this.queue.forEach(function (q) {
          pushPath(q.loaded, [lng], ns);
          remove(q.pending, name);
          if (err) q.errors.push(err);

          if (q.pending.length === 0 && !q.done) {
            // only do once per loaded -> this.emit('loaded', q.loaded);
            Object.keys(q.loaded).forEach(function (l) {
              if (!loaded[l]) loaded[l] = [];

              if (q.loaded[l].length) {
                q.loaded[l].forEach(function (ns) {
                  if (loaded[l].indexOf(ns) < 0) loaded[l].push(ns);
                });
              }
            });
            /* eslint no-param-reassign: 0 */

            q.done = true;

            if (q.errors.length) {
              q.callback(q.errors);
            } else {
              q.callback();
            }
          }
        }); // emit consolidated loaded event

        this.emit('loaded', loaded); // remove done load requests

        this.queue = this.queue.filter(function (q) {
          return !q.done;
        });
      }
    }, {
      key: "read",
      value: function read(lng, ns, fcName) {
        var _this3 = this;

        var tried = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 0;
        var wait = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : 250;
        var callback = arguments.length > 5 ? arguments[5] : undefined;
        if (!lng.length) return callback(null, {}); // noting to load

        return this.backend[fcName](lng, ns, function (err, data) {
          if (err && data
          /* = retryFlag */
          && tried < 5) {
            setTimeout(function () {
              _this3.read.call(_this3, lng, ns, fcName, tried + 1, wait * 2, callback);
            }, wait);
            return;
          }

          callback(err, data);
        });
      }
      /* eslint consistent-return: 0 */

    }, {
      key: "prepareLoading",
      value: function prepareLoading(languages, namespaces) {
        var _this4 = this;

        var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
        var callback = arguments.length > 3 ? arguments[3] : undefined;

        if (!this.backend) {
          this.logger.warn('No backend was added via i18next.use. Will not load resources.');
          return callback && callback();
        }

        if (typeof languages === 'string') languages = this.languageUtils.toResolveHierarchy(languages);
        if (typeof namespaces === 'string') namespaces = [namespaces];
        var toLoad = this.queueLoad(languages, namespaces, options, callback);

        if (!toLoad.toLoad.length) {
          if (!toLoad.pending.length) callback(); // nothing to load and no pendings...callback now

          return null; // pendings will trigger callback
        }

        toLoad.toLoad.forEach(function (name) {
          _this4.loadOne(name);
        });
      }
    }, {
      key: "load",
      value: function load(languages, namespaces, callback) {
        this.prepareLoading(languages, namespaces, {}, callback);
      }
    }, {
      key: "reload",
      value: function reload(languages, namespaces, callback) {
        this.prepareLoading(languages, namespaces, {
          reload: true
        }, callback);
      }
    }, {
      key: "loadOne",
      value: function loadOne(name) {
        var _this5 = this;

        var prefix = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';

        var _name$split3 = name.split('|'),
            _name$split4 = _slicedToArray(_name$split3, 2),
            lng = _name$split4[0],
            ns = _name$split4[1];

        this.read(lng, ns, 'read', null, null, function (err, data) {
          if (err) _this5.logger.warn("".concat(prefix, "loading namespace ").concat(ns, " for language ").concat(lng, " failed"), err);
          if (!err && data) _this5.logger.log("".concat(prefix, "loaded namespace ").concat(ns, " for language ").concat(lng), data);

          _this5.loaded(name, err, data);
        });
      }
    }, {
      key: "saveMissing",
      value: function saveMissing(languages, namespace, key, fallbackValue, isUpdate) {
        var options = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : {};

        if (this.backend && this.backend.create) {
          this.backend.create(languages, namespace, key, fallbackValue, null
          /* unused callback */
          , _objectSpread({}, options, {
            isUpdate: isUpdate
          }));
        } // write to store to avoid resending


        if (!languages || !languages[0]) return;
        this.store.addResource(languages[0], namespace, key, fallbackValue);
      }
    }]);

    return Connector;
  }(EventEmitter);

  function get() {
    return {
      debug: false,
      initImmediate: true,
      ns: ['translation'],
      defaultNS: ['translation'],
      fallbackLng: ['dev'],
      fallbackNS: false,
      // string or array of namespaces
      whitelist: false,
      // array with whitelisted languages
      nonExplicitWhitelist: false,
      load: 'all',
      // | currentOnly | languageOnly
      preload: false,
      // array with preload languages
      simplifyPluralSuffix: true,
      keySeparator: '.',
      nsSeparator: ':',
      pluralSeparator: '_',
      contextSeparator: '_',
      partialBundledLanguages: false,
      // allow bundling certain languages that are not remotely fetched
      saveMissing: false,
      // enable to send missing values
      updateMissing: false,
      // enable to update default values if different from translated value (only useful on initial development, or when keeping code as source of truth)
      saveMissingTo: 'fallback',
      // 'current' || 'all'
      saveMissingPlurals: true,
      // will save all forms not only singular key
      missingKeyHandler: false,
      // function(lng, ns, key, fallbackValue) -> override if prefer on handling
      missingInterpolationHandler: false,
      // function(str, match)
      postProcess: false,
      // string or array of postProcessor names
      returnNull: true,
      // allows null value as valid translation
      returnEmptyString: true,
      // allows empty string value as valid translation
      returnObjects: false,
      joinArrays: false,
      // or string to join array
      returnedObjectHandler: false,
      // function(key, value, options) triggered if key returns object but returnObjects is set to false
      parseMissingKeyHandler: false,
      // function(key) parsed a key that was not found in t() before returning
      appendNamespaceToMissingKey: false,
      appendNamespaceToCIMode: false,
      overloadTranslationOptionHandler: function handle(args) {
        var ret = {};
        if (_typeof(args[1]) === 'object') ret = args[1];
        if (typeof args[1] === 'string') ret.defaultValue = args[1];
        if (typeof args[2] === 'string') ret.tDescription = args[2];

        if (_typeof(args[2]) === 'object' || _typeof(args[3]) === 'object') {
          var options = args[3] || args[2];
          Object.keys(options).forEach(function (key) {
            ret[key] = options[key];
          });
        }

        return ret;
      },
      interpolation: {
        escapeValue: true,
        format: function format(value, _format, lng) {
          return value;
        },
        prefix: '{{',
        suffix: '}}',
        formatSeparator: ',',
        // prefixEscaped: '{{',
        // suffixEscaped: '}}',
        // unescapeSuffix: '',
        unescapePrefix: '-',
        nestingPrefix: '$t(',
        nestingSuffix: ')',
        // nestingPrefixEscaped: '$t(',
        // nestingSuffixEscaped: ')',
        // defaultVariables: undefined // object that can have values to interpolate on - extends passed in interpolation data
        maxReplaces: 1000 // max replaces to prevent endless loop

      }
    };
  }
  /* eslint no-param-reassign: 0 */

  function transformOptions(options) {
    // create namespace object if namespace is passed in as string
    if (typeof options.ns === 'string') options.ns = [options.ns];
    if (typeof options.fallbackLng === 'string') options.fallbackLng = [options.fallbackLng];
    if (typeof options.fallbackNS === 'string') options.fallbackNS = [options.fallbackNS]; // extend whitelist with cimode

    if (options.whitelist && options.whitelist.indexOf('cimode') < 0) {
      options.whitelist = options.whitelist.concat(['cimode']);
    }

    return options;
  }

  function noop() {}

  var I18n =
  /*#__PURE__*/
  function (_EventEmitter) {
    _inherits(I18n, _EventEmitter);

    function I18n() {
      var _this;

      var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      var callback = arguments.length > 1 ? arguments[1] : undefined;

      _classCallCheck(this, I18n);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(I18n).call(this));
      EventEmitter.call(_assertThisInitialized(_this)); // <=IE10 fix (unable to call parent constructor)

      _this.options = transformOptions(options);
      _this.services = {};
      _this.logger = baseLogger;
      _this.modules = {
        external: []
      };

      if (callback && !_this.isInitialized && !options.isClone) {
        // https://github.com/i18next/i18next/issues/879
        if (!_this.options.initImmediate) {
          _this.init(options, callback);

          return _possibleConstructorReturn(_this, _assertThisInitialized(_this));
        }

        setTimeout(function () {
          _this.init(options, callback);
        }, 0);
      }

      return _this;
    }

    _createClass(I18n, [{
      key: "init",
      value: function init() {
        var _this2 = this;

        var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
        var callback = arguments.length > 1 ? arguments[1] : undefined;

        if (typeof options === 'function') {
          callback = options;
          options = {};
        }

        this.options = _objectSpread({}, get(), this.options, transformOptions(options));
        this.format = this.options.interpolation.format;
        if (!callback) callback = noop;

        function createClassOnDemand(ClassOrObject) {
          if (!ClassOrObject) return null;
          if (typeof ClassOrObject === 'function') return new ClassOrObject();
          return ClassOrObject;
        } // init services


        if (!this.options.isClone) {
          if (this.modules.logger) {
            baseLogger.init(createClassOnDemand(this.modules.logger), this.options);
          } else {
            baseLogger.init(null, this.options);
          }

          var lu = new LanguageUtil(this.options);
          this.store = new ResourceStore(this.options.resources, this.options);
          var s = this.services;
          s.logger = baseLogger;
          s.resourceStore = this.store;
          s.languageUtils = lu;
          s.pluralResolver = new PluralResolver(lu, {
            prepend: this.options.pluralSeparator,
            compatibilityJSON: this.options.compatibilityJSON,
            simplifyPluralSuffix: this.options.simplifyPluralSuffix
          });
          s.interpolator = new Interpolator(this.options);
          s.backendConnector = new Connector(createClassOnDemand(this.modules.backend), s.resourceStore, s, this.options); // pipe events from backendConnector

          s.backendConnector.on('*', function (event) {
            for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
              args[_key - 1] = arguments[_key];
            }

            _this2.emit.apply(_this2, [event].concat(args));
          });

          if (this.modules.languageDetector) {
            s.languageDetector = createClassOnDemand(this.modules.languageDetector);
            s.languageDetector.init(s, this.options.detection, this.options);
          }

          if (this.modules.i18nFormat) {
            s.i18nFormat = createClassOnDemand(this.modules.i18nFormat);
            if (s.i18nFormat.init) s.i18nFormat.init(this);
          }

          this.translator = new Translator(this.services, this.options); // pipe events from translator

          this.translator.on('*', function (event) {
            for (var _len2 = arguments.length, args = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
              args[_key2 - 1] = arguments[_key2];
            }

            _this2.emit.apply(_this2, [event].concat(args));
          });
          this.modules.external.forEach(function (m) {
            if (m.init) m.init(_this2);
          });
        } // append api


        var storeApi = ['getResource', 'addResource', 'addResources', 'addResourceBundle', 'removeResourceBundle', 'hasResourceBundle', 'getResourceBundle', 'getDataByLanguage'];
        storeApi.forEach(function (fcName) {
          _this2[fcName] = function () {
            var _this2$store;

            return (_this2$store = _this2.store)[fcName].apply(_this2$store, arguments);
          };
        });
        var deferred = defer();

        var load = function load() {
          _this2.changeLanguage(_this2.options.lng, function (err, t) {
            _this2.isInitialized = true;

            _this2.logger.log('initialized', _this2.options);

            _this2.emit('initialized', _this2.options);

            deferred.resolve(t); // not rejecting on err (as err is only a loading translation failed warning)

            callback(err, t);
          });
        };

        if (this.options.resources || !this.options.initImmediate) {
          load();
        } else {
          setTimeout(load, 0);
        }

        return deferred;
      }
      /* eslint consistent-return: 0 */

    }, {
      key: "loadResources",
      value: function loadResources() {
        var _this3 = this;

        var callback = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : noop;

        if (!this.options.resources || this.options.partialBundledLanguages) {
          if (this.language && this.language.toLowerCase() === 'cimode') return callback(); // avoid loading resources for cimode

          var toLoad = [];

          var append = function append(lng) {
            if (!lng) return;

            var lngs = _this3.services.languageUtils.toResolveHierarchy(lng);

            lngs.forEach(function (l) {
              if (toLoad.indexOf(l) < 0) toLoad.push(l);
            });
          };

          if (!this.language) {
            // at least load fallbacks in this case
            var fallbacks = this.services.languageUtils.getFallbackCodes(this.options.fallbackLng);
            fallbacks.forEach(function (l) {
              return append(l);
            });
          } else {
            append(this.language);
          }

          if (this.options.preload) {
            this.options.preload.forEach(function (l) {
              return append(l);
            });
          }

          this.services.backendConnector.load(toLoad, this.options.ns, callback);
        } else {
          callback(null);
        }
      }
    }, {
      key: "reloadResources",
      value: function reloadResources(lngs, ns, callback) {
        var deferred = defer();
        if (!lngs) lngs = this.languages;
        if (!ns) ns = this.options.ns;
        if (!callback) callback = noop;
        this.services.backendConnector.reload(lngs, ns, function (err) {
          deferred.resolve(); // not rejecting on err (as err is only a loading translation failed warning)

          callback(err);
        });
        return deferred;
      }
    }, {
      key: "use",
      value: function use(module) {
        if (module.type === 'backend') {
          this.modules.backend = module;
        }

        if (module.type === 'logger' || module.log && module.warn && module.error) {
          this.modules.logger = module;
        }

        if (module.type === 'languageDetector') {
          this.modules.languageDetector = module;
        }

        if (module.type === 'i18nFormat') {
          this.modules.i18nFormat = module;
        }

        if (module.type === 'postProcessor') {
          postProcessor.addPostProcessor(module);
        }

        if (module.type === '3rdParty') {
          this.modules.external.push(module);
        }

        return this;
      }
    }, {
      key: "changeLanguage",
      value: function changeLanguage(lng, callback) {
        var _this4 = this;

        var deferred = defer();
        this.emit('languageChanging', lng);

        var done = function done(err, l) {
          _this4.translator.changeLanguage(l);

          if (l) {
            _this4.emit('languageChanged', l);

            _this4.logger.log('languageChanged', l);
          }

          deferred.resolve(function () {
            return _this4.t.apply(_this4, arguments);
          });
          if (callback) callback(err, function () {
            return _this4.t.apply(_this4, arguments);
          });
        };

        var setLng = function setLng(l) {
          if (l) {
            _this4.language = l;
            _this4.languages = _this4.services.languageUtils.toResolveHierarchy(l);
            if (!_this4.translator.language) _this4.translator.changeLanguage(l);
            if (_this4.services.languageDetector) _this4.services.languageDetector.cacheUserLanguage(l);
          }

          _this4.loadResources(function (err) {
            done(err, l);
          });
        };

        if (!lng && this.services.languageDetector && !this.services.languageDetector.async) {
          setLng(this.services.languageDetector.detect());
        } else if (!lng && this.services.languageDetector && this.services.languageDetector.async) {
          this.services.languageDetector.detect(setLng);
        } else {
          setLng(lng);
        }

        return deferred;
      }
    }, {
      key: "getFixedT",
      value: function getFixedT(lng, ns) {
        var _this5 = this;

        var fixedT = function fixedT(key, opts) {
          var options;

          if (_typeof(opts) !== 'object') {
            for (var _len3 = arguments.length, rest = new Array(_len3 > 2 ? _len3 - 2 : 0), _key3 = 2; _key3 < _len3; _key3++) {
              rest[_key3 - 2] = arguments[_key3];
            }

            options = _this5.options.overloadTranslationOptionHandler([key, opts].concat(rest));
          } else {
            options = _objectSpread({}, opts);
          }

          options.lng = options.lng || fixedT.lng;
          options.lngs = options.lngs || fixedT.lngs;
          options.ns = options.ns || fixedT.ns;
          return _this5.t(key, options);
        };

        if (typeof lng === 'string') {
          fixedT.lng = lng;
        } else {
          fixedT.lngs = lng;
        }

        fixedT.ns = ns;
        return fixedT;
      }
    }, {
      key: "t",
      value: function t() {
        var _this$translator;

        return this.translator && (_this$translator = this.translator).translate.apply(_this$translator, arguments);
      }
    }, {
      key: "exists",
      value: function exists() {
        var _this$translator2;

        return this.translator && (_this$translator2 = this.translator).exists.apply(_this$translator2, arguments);
      }
    }, {
      key: "setDefaultNamespace",
      value: function setDefaultNamespace(ns) {
        this.options.defaultNS = ns;
      }
    }, {
      key: "loadNamespaces",
      value: function loadNamespaces(ns, callback) {
        var _this6 = this;

        var deferred = defer();

        if (!this.options.ns) {
          callback && callback();
          return Promise.resolve();
        }

        if (typeof ns === 'string') ns = [ns];
        ns.forEach(function (n) {
          if (_this6.options.ns.indexOf(n) < 0) _this6.options.ns.push(n);
        });
        this.loadResources(function (err) {
          deferred.resolve();
          if (callback) callback(err);
        });
        return deferred;
      }
    }, {
      key: "loadLanguages",
      value: function loadLanguages(lngs, callback) {
        var deferred = defer();
        if (typeof lngs === 'string') lngs = [lngs];
        var preloaded = this.options.preload || [];
        var newLngs = lngs.filter(function (lng) {
          return preloaded.indexOf(lng) < 0;
        }); // Exit early if all given languages are already preloaded

        if (!newLngs.length) {
          if (callback) callback();
          return Promise.resolve();
        }

        this.options.preload = preloaded.concat(newLngs);
        this.loadResources(function (err) {
          deferred.resolve();
          if (callback) callback(err);
        });
        return deferred;
      }
    }, {
      key: "dir",
      value: function dir(lng) {
        if (!lng) lng = this.languages && this.languages.length > 0 ? this.languages[0] : this.language;
        if (!lng) return 'rtl';
        var rtlLngs = ['ar', 'shu', 'sqr', 'ssh', 'xaa', 'yhd', 'yud', 'aao', 'abh', 'abv', 'acm', 'acq', 'acw', 'acx', 'acy', 'adf', 'ads', 'aeb', 'aec', 'afb', 'ajp', 'apc', 'apd', 'arb', 'arq', 'ars', 'ary', 'arz', 'auz', 'avl', 'ayh', 'ayl', 'ayn', 'ayp', 'bbz', 'pga', 'he', 'iw', 'ps', 'pbt', 'pbu', 'pst', 'prp', 'prd', 'ur', 'ydd', 'yds', 'yih', 'ji', 'yi', 'hbo', 'men', 'xmn', 'fa', 'jpr', 'peo', 'pes', 'prs', 'dv', 'sam'];
        return rtlLngs.indexOf(this.services.languageUtils.getLanguagePartFromCode(lng)) >= 0 ? 'rtl' : 'ltr';
      }
      /* eslint class-methods-use-this: 0 */

    }, {
      key: "createInstance",
      value: function createInstance() {
        var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
        var callback = arguments.length > 1 ? arguments[1] : undefined;
        return new I18n(options, callback);
      }
    }, {
      key: "cloneInstance",
      value: function cloneInstance() {
        var _this7 = this;

        var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
        var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : noop;

        var mergedOptions = _objectSpread({}, this.options, options, {
          isClone: true
        });

        var clone = new I18n(mergedOptions);
        var membersToCopy = ['store', 'services', 'language'];
        membersToCopy.forEach(function (m) {
          clone[m] = _this7[m];
        });
        clone.translator = new Translator(clone.services, clone.options);
        clone.translator.on('*', function (event) {
          for (var _len4 = arguments.length, args = new Array(_len4 > 1 ? _len4 - 1 : 0), _key4 = 1; _key4 < _len4; _key4++) {
            args[_key4 - 1] = arguments[_key4];
          }

          clone.emit.apply(clone, [event].concat(args));
        });
        clone.init(mergedOptions, callback);
        clone.translator.options = clone.options; // sync options

        return clone;
      }
    }]);

    return I18n;
  }(EventEmitter);

  var i18next = new I18n();

  return i18next;

}));

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function() {

  var engineTranslations = {

  	en: {
  		translation: {
            common: {
              'countries': {
                 "AF":"Afghanistan",
                 "AX":"\u00c5land Islands",
                 "AL":"Albania",
                 "DZ":"Algeria",
                 "AS":"American Samoa",
                 "AD":"Andorra",
                 "AO":"Angola",
                 "AI":"Anguilla",
                 "AQ":"Antarctica",
                 "AG":"Antigua & Barbuda",
                 "AR":"Argentina",
                 "AM":"Armenia",
                 "AW":"Aruba",
                 "AC":"Ascension Island",
                 "AU":"Australia",
                 "AT":"Austria",
                 "AZ":"Azerbaijan",
                 "BS":"Bahamas",
                 "BH":"Bahrain",
                 "BD":"Bangladesh",
                 "BB":"Barbados",
                 "BY":"Belarus",
                 "BE":"Belgium",
                 "BZ":"Belize",
                 "BJ":"Benin",
                 "BM":"Bermuda",
                 "BT":"Bhutan",
                 "BO":"Bolivia",
                 "BA":"Bosnia & Herzegovina",
                 "BW":"Botswana",
                 "BR":"Brazil",
                 "IO":"British Indian Ocean Territory",
                 "VG":"British Virgin Islands",
                 "BN":"Brunei",
                 "BG":"Bulgaria",
                 "BF":"Burkina Faso",
                 "BI":"Burundi",
                 "KH":"Cambodia",
                 "CM":"Cameroon",
                 "CA":"Canada",
                 "IC":"Canary Islands",
                 "CV":"Cape Verde",
                 "BQ":"Caribbean Netherlands",
                 "KY":"Cayman Islands",
                 "CF":"Central African Republic",
                 "EA":"Ceuta & Melilla",
                 "TD":"Chad",
                 "CL":"Chile",
                 "CN":"China",
                 "CX":"Christmas Island",
                 "CC":"Cocos (Keeling) Islands",
                 "CO":"Colombia",
                 "KM":"Comoros",
                 "CG":"Congo - Brazzaville",
                 "CD":"Congo - Kinshasa",
                 "CK":"Cook Islands",
                 "CR":"Costa Rica",
                 "CI":"C\u00f4te d\u2019Ivoire",
                 "HR":"Croatia",
                 "CU":"Cuba",
                 "CW":"Cura\u00e7ao",
                 "CY":"Cyprus",
                 "CZ":"Czechia",
                 "DK":"Denmark",
                 "DG":"Diego Garcia",
                 "DJ":"Djibouti",
                 "DM":"Dominica",
                 "DO":"Dominican Republic",
                 "EC":"Ecuador",
                 "EG":"Egypt",
                 "SV":"El Salvador",
                 "GQ":"Equatorial Guinea",
                 "ER":"Eritrea",
                 "EE":"Estonia",
                 "SZ":"Eswatini",
                 "ET":"Ethiopia",
                 "FK":"Falkland Islands",
                 "FO":"Faroe Islands",
                 "FJ":"Fiji",
                 "FI":"Finland",
                 "FR":"France",
                 "GF":"French Guiana",
                 "PF":"French Polynesia",
                 "TF":"French Southern Territories",
                 "GA":"Gabon",
                 "GM":"Gambia",
                 "GE":"Georgia",
                 "DE":"Germany",
                 "GH":"Ghana",
                 "GI":"Gibraltar",
                 "GR":"Greece",
                 "GL":"Greenland",
                 "GD":"Grenada",
                 "GP":"Guadeloupe",
                 "GU":"Guam",
                 "GT":"Guatemala",
                 "GG":"Guernsey",
                 "GN":"Guinea",
                 "GW":"Guinea-Bissau",
                 "GY":"Guyana",
                 "HT":"Haiti",
                 "HN":"Honduras",
                 "HK":"Hong Kong SAR China",
                 "HU":"Hungary",
                 "IS":"Iceland",
                 "IN":"India",
                 "ID":"Indonesia",
                 "IR":"Iran",
                 "IQ":"Iraq",
                 "IE":"Ireland",
                 "IM":"Isle of Man",
                 "IL":"Israel",
                 "IT":"Italy",
                 "JM":"Jamaica",
                 "JP":"Japan",
                 "JE":"Jersey",
                 "JO":"Jordan",
                 "KZ":"Kazakhstan",
                 "KE":"Kenya",
                 "KI":"Kiribati",
                 "XK":"Kosovo",
                 "KW":"Kuwait",
                 "KG":"Kyrgyzstan",
                 "LA":"Laos",
                 "LV":"Latvia",
                 "LB":"Lebanon",
                 "LS":"Lesotho",
                 "LR":"Liberia",
                 "LY":"Libya",
                 "LI":"Liechtenstein",
                 "LT":"Lithuania",
                 "LU":"Luxembourg",
                 "MO":"Macao SAR China",
                 "MG":"Madagascar",
                 "MW":"Malawi",
                 "MY":"Malaysia",
                 "MV":"Maldives",
                 "ML":"Mali",
                 "MT":"Malta",
                 "MH":"Marshall Islands",
                 "MQ":"Martinique",
                 "MR":"Mauritania",
                 "MU":"Mauritius",
                 "YT":"Mayotte",
                 "MX":"Mexico",
                 "FM":"Micronesia",
                 "MD":"Moldova",
                 "MC":"Monaco",
                 "MN":"Mongolia",
                 "ME":"Montenegro",
                 "MS":"Montserrat",
                 "MA":"Morocco",
                 "MZ":"Mozambique",
                 "MM":"Myanmar (Burma)",
                 "NA":"Namibia",
                 "NR":"Nauru",
                 "NP":"Nepal",
                 "NL":"Netherlands",
                 "NC":"New Caledonia",
                 "NZ":"New Zealand",
                 "NI":"Nicaragua",
                 "NE":"Niger",
                 "NG":"Nigeria",
                 "NU":"Niue",
                 "NF":"Norfolk Island",
                 "KP":"North Korea",
                 "MK":"North Macedonia",
                 "MP":"Northern Mariana Islands",
                 "NO":"Norway",
                 "OM":"Oman",
                 "PK":"Pakistan",
                 "PW":"Palau",
                 "PS":"Palestinian Territories",
                 "PA":"Panama",
                 "PG":"Papua New Guinea",
                 "PY":"Paraguay",
                 "PE":"Peru",
                 "PH":"Philippines",
                 "PN":"Pitcairn Islands",
                 "PL":"Poland",
                 "PT":"Portugal",
                 "XA":"Pseudo-Accents",
                 "XB":"Pseudo-Bidi",
                 "PR":"Puerto Rico",
                 "QA":"Qatar",
                 "RE":"R\u00e9union",
                 "RO":"Romania",
                 "RU":"Russia",
                 "RW":"Rwanda",
                 "WS":"Samoa",
                 "SM":"San Marino",
                 "ST":"S\u00e3o Tom\u00e9 & Pr\u00edncipe",
                 "SA":"Saudi Arabia",
                 "SN":"Senegal",
                 "RS":"Serbia",
                 "SC":"Seychelles",
                 "SL":"Sierra Leone",
                 "SG":"Singapore",
                 "SX":"Sint Maarten",
                 "SK":"Slovakia",
                 "SI":"Slovenia",
                 "SB":"Solomon Islands",
                 "SO":"Somalia",
                 "ZA":"South Africa",
                 "GS":"South Georgia & South Sandwich Islands",
                 "KR":"South Korea",
                 "SS":"South Sudan",
                 "ES":"Spain",
                 "LK":"Sri Lanka",
                 "BL":"St. Barth\u00e9lemy",
                 "SH":"St. Helena",
                 "KN":"St. Kitts & Nevis",
                 "LC":"St. Lucia",
                 "MF":"St. Martin",
                 "PM":"St. Pierre & Miquelon",
                 "VC":"St. Vincent & Grenadines",
                 "SD":"Sudan",
                 "SR":"Suriname",
                 "SJ":"Svalbard & Jan Mayen",
                 "SE":"Sweden",
                 "CH":"Switzerland",
                 "SY":"Syria",
                 "TW":"Taiwan",
                 "TJ":"Tajikistan",
                 "TZ":"Tanzania",
                 "TH":"Thailand",
                 "TL":"Timor-Leste",
                 "TG":"Togo",
                 "TK":"Tokelau",
                 "TO":"Tonga",
                 "TT":"Trinidad & Tobago",
                 "TA":"Tristan da Cunha",
                 "TN":"Tunisia",
                 "TR":"Turkey",
                 "TM":"Turkmenistan",
                 "TC":"Turks & Caicos Islands",
                 "TV":"Tuvalu",
                 "UM":"U.S. Outlying Islands",
                 "VI":"U.S. Virgin Islands",
                 "UG":"Uganda",
                 "UA":"Ukraine",
                 "AE":"United Arab Emirates",
                 "GB":"United Kingdom",
                 "US":"United States",
                 "UY":"Uruguay",
                 "UZ":"Uzbekistan",
                 "VU":"Vanuatu",
                 "VA":"Vatican City",
                 "VE":"Venezuela",
                 "VN":"Vietnam",
                 "WF":"Wallis & Futuna",
                 "EH":"Western Sahara",
                 "YE":"Yemen",
                 "ZM":"Zambia",
                 "ZW":"Zimbabwe"
              },
              'days': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  day',
              'days_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  days',
              'hours': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  hour',
              'hours_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  hours',
              'minutes': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  minute',
              'minutes_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  minutes', 
              'error': 'We are sorry. There was an error in the process',
              'welcomeConnectedUser': 'Welcome <b>{{name}}</b> you can proceed with your reservation',
              'invalid_user_password': 'Invalid user or password'             
            },
            extra: {
              'daily_amount': '{{oneUnitPrice}} per day',
              'hourly_amount': '{{oneUnitPrice}} per hour',
              'unitary_amount': '{{oneUnitPrice}}',
              'total': 'Total {{total}}'
            },
            contact: {
              'form_errors': 'Please, check the errors',
              'validate_captcha': 'Please, validate captcha',
              'validations': {
                 'nameRequired': 'Name is required',
                 'surnameRequired': 'Surname is required',
                 'emailRequired': 'Email is required',
                 'phoneNumberRequired': 'Phone number is required',
                 'commentsRequired': 'Message is required'
              },
              'message_sent_successfully': 'Message sent successfully',
              'error_sending_message': 'Error sending message'
            },
            calendar_selector: {
              'min_time': 'The collection of the previous reservation is at {{time}}',
              'max_time': 'The delivery of the next reservation is at {{time}}'
            },
        		selector: {
                'select_pickup_place': 'Select pickup place',
                'select_return_place': 'Select return place',
                'another_place': 'Exact address',
                'error_loading_data': 'We are sorry. There was an error loading data',
        				'validations': {
                  'pickupPlaceRequired': 'Pickup place required',
                  'dateFromRequired': 'Date required',
                  'timeFromRequired': 'Time required',
                  'returnPlaceRequired': 'Return place required',
                  'dateToRequired': 'Date required',
                  'timeToRequired': 'Time required',
      	  				'sameDayTimeToGreaterTimeFrom': 'Must be later than delivery time',
      	  				'acceptAge': 'You must confirm that you are older than {{years}} years',
      	  				'promotionCodeInvalid': 'Promotion code is not valid'
      	  			}
        		},
        		chooseProduct: {
        				'loadShoppingCart': {
        					'error': 'We are sorry. There was an error performing the search'
        				},
        				'selectProduct': {
        					'productNotSelected': 'Please, select the vehicle.',
        					'error': 'We are sorry. There was an error selecting the vehicle'
        				},
                'selectUnits': 'Select units',
                'units': '{{count}} unit',
                'units_plural': '{{count}} units',
                'max_duration': 'The maximum duration is {{duration}}',
                'min_duration': 'The minimum duration is {{duration}}'
        		},
        		chooseExtras: {
        				'loadShoppingCart': {
        					'error': 'We are sorry. There was an error loading data.'
        				},
        				'selectExtra': {
        					'error': 'We are sorry. There was an error updating the extra.'
        				},
        				'deleteExtra': {
        					'error': 'We are sorry. There was an error removing the extra.'
        				}  	  				  				
        		},
        		complete: {
                'loadShoppingCart': {
                  'error': 'We are sorry. There was an error loading data.'
                },
                'selectExtra': {
                  'error': 'We are sorry. There was an error updating the extra.'
                },
                'deleteExtra': {
                  'error': 'We are sorry. There was an error removing the extra.'
                },
                'promotionCode': {
                  'error': 'We are sorry. There was an error checking the promotion code',
                },
                'reservationForm': {
                  'errors': 'Please check the errors in the reservation form.',
                  'total_payment': 'Pay {{amount}}',
                  'payment_button': 'Pay {{amount}}',
                  'booking_amount': 'To confirm your reservation a <strong>{{amount}}</strong> payment is required',
                  'select_country': 'Select country',  
                  'validations': {
                    'fieldRequired': 'This field is required',
                    'passwordCheck': 'Password must contain upper case letter, lower case letter, digit and symbol',
                    'minLength': 'Minimum {{minlength}} characters',
                    'customerNameRequired': 'Customer name is required',
                    'customerSurnameRequired': 'Customer surname is required',
                    'customerEmailRequired': 'Customer email is required',
                    'customerEmailInvalidFormat': 'Invalid email address',
                    'customerEmailConfirmationRequired': 'Customer email confirmation is required',
                    'customerEmailConfirmationEqualsEmail': 'Customer email confirmation must be equal to customer email',
                    'customerPhoneNumberRequired': 'Customer phone number is required',
                    'customerPhoneNumberMinLength': 'Customer phone number min length',
                    'driverDateOfBirthRequired': 'Driver date of birth is required',
                    'numberOfAdultsRequired': 'Number in party required',
                    'conditionsReadRequired': 'Please, check that you have read the terms and conditions',
                    'privacyPolicyRequired': 'Please, check that you have read the privacy policy',
                    'selectPaymentMethod': 'Please, select the payment method'
                  }
                },
                'createReservation': {
                  'error': 'We are sorry. There was an error creating the reservation.'
                }  
        		},
      			summary: {
              'loadReservation': {
                'error': 'We are sorry. There was an error loading the reservation.'
              }
      			},
            myReservation: {
              'select_country': 'Select country',  
              'loadReservation': {
                'error': 'We are sorry. There was an error loading the reservation.'
              },
              'pay': {
                'total_payment': 'Pay {{amount}}',
                'payment_button': 'Pay {{amount}}',
                'paymentMethodRequired': 'Please, select the payment method.',
                'booking_amount': 'To confirm your reservation a <strong>{{amount}}</strong> payment is required',
                'pending_amount': 'Payment of the pending amount <strong>{{amount}}</strong> is an option'
              },
              'updateReservation': {
                'success': 'Reservation updated successfully',
                'error': 'We are sorry. There was an error updating the reservation'
              }          
            },
            selectorWizard: {
               'pickupPlace': 'Collection Point',
               'dateFrom': 'Collection date',
               'timeFrom': 'Collection time',
               'returnPlace': 'Return Point',
               'dateTo': 'Return date',
               'timeTo': 'Return time'              
            },
            activities: {
              common: {
                'errorLoadingData': 'We are sorry. There was an error loading information',
                'errorUpdatingData': 'We are sorry. There was an error updating data',
                'dataUpdateOk': 'Data updated successfully'
              },
              calendarWidget: {
                 'selectTickets': 'You have not selected any tickets',
                 'fullPlaces': 'Full capacity',
                 'fewPlacesWarning': 'Last places',
                 'fewNoPlacesWarning': 'Last turns'
              },
              multipleDates: {
                 'selectDate': 'Please select the date'
              },
              checkout: {
                 'errorCreatingOrder': 'We are sorry. There was an error creating the reservation',
                 'errors': 'Please check the errors in the reservation form.',      
                 'validations': {
                   'customerNameRequired': 'Customer name is required',
                   'customerSurnameRequired': 'Customer surname is required',
                   'customerEmailRequired': 'Customer email is required',
                   'customerEmailInvalidFormat': 'Invalid email address',
                   'customerEmailConfirmationRequired': 'Customer email confirmation is required',
                   'customerEmailConfirmationEqualsEmail': 'Customer email confirmation must be equal to customer email',
                   'customerPhoneNumberRequired': 'Customer phone number is required',
                   'customerPhoneNumberMinLength': 'Customer phone number min length',
                   'conditionsReadRequired': 'Please check that you have read the terms and conditions',
                   'privacyPolicyRequired': 'Please, check that you have read the privacy policy',                   
                   'selectPaymentMethod': 'Please, select the payment method'
                 }
              },
              payment: {
                 'total_payment': 'Pay {{amount}}',
                 'payment_button': 'Pay {{amount}}',
                 'deposit_amount': 'To confirm your reservation a <strong>{{amount}}</strong> payment is required',   
                 'pending_amount': 'Payment of the pending amount <strong>{{amount}}</strong> is allowed',             
                 'errors': 'Please check the errors.',
                 'paymentMethodNotSelected': 'Please, select the payment method.'
              },
              myReservation: {
                 'cancelReservationConfirm': 'Do you want to cancel the reservation?',
              }
            }
  		}
  	},
  	es: {
  		translation: {
            common: {
              'countries': {
                 "AF":"Afganist\u00e1n",
                 "AL":"Albania",
                 "DE":"Alemania",
                 "AD":"Andorra",
                 "AO":"Angola",
                 "AI":"Anguila",
                 "AQ":"Ant\u00e1rtida",
                 "AG":"Antigua y Barbuda",
                 "SA":"Arabia Saud\u00ed",
                 "DZ":"Argelia",
                 "AR":"Argentina",
                 "AM":"Armenia",
                 "AW":"Aruba",
                 "AU":"Australia",
                 "AT":"Austria",
                 "AZ":"Azerbaiy\u00e1n",
                 "BS":"Bahamas",
                 "BD":"Banglad\u00e9s",
                 "BB":"Barbados",
                 "BH":"Bar\u00e9in",
                 "BE":"B\u00e9lgica",
                 "BZ":"Belice",
                 "BJ":"Ben\u00edn",
                 "BM":"Bermudas",
                 "BY":"Bielorrusia",
                 "BO":"Bolivia",
                 "BA":"Bosnia y Herzegovina",
                 "BW":"Botsuana",
                 "BR":"Brasil",
                 "BN":"Brun\u00e9i",
                 "BG":"Bulgaria",
                 "BF":"Burkina Faso",
                 "BI":"Burundi",
                 "BT":"But\u00e1n",
                 "CV":"Cabo Verde",
                 "KH":"Camboya",
                 "CM":"Camer\u00fan",
                 "CA":"Canad\u00e1",
                 "IC":"Canarias",
                 "BQ":"Caribe neerland\u00e9s",
                 "QA":"Catar",
                 "EA":"Ceuta y Melilla",
                 "TD":"Chad",
                 "CZ":"Chequia",
                 "CL":"Chile",
                 "CN":"China",
                 "CY":"Chipre",
                 "VA":"Ciudad del Vaticano",
                 "CO":"Colombia",
                 "KM":"Comoras",
                 "CG":"Congo",
                 "KP":"Corea del Norte",
                 "KR":"Corea del Sur",
                 "CR":"Costa Rica",
                 "CI":"C\u00f4te d\u2019Ivoire",
                 "HR":"Croacia",
                 "CU":"Cuba",
                 "CW":"Curazao",
                 "DG":"Diego Garc\u00eda",
                 "DK":"Dinamarca",
                 "DM":"Dominica",
                 "EC":"Ecuador",
                 "EG":"Egipto",
                 "SV":"El Salvador",
                 "AE":"Emiratos \u00c1rabes Unidos",
                 "ER":"Eritrea",
                 "SK":"Eslovaquia",
                 "SI":"Eslovenia",
                 "ES":"Espa\u00f1a",
                 "US":"Estados Unidos",
                 "EE":"Estonia",
                 "SZ":"Esuatini",
                 "ET":"Etiop\u00eda",
                 "PH":"Filipinas",
                 "FI":"Finlandia",
                 "FJ":"Fiyi",
                 "FR":"Francia",
                 "GA":"Gab\u00f3n",
                 "GM":"Gambia",
                 "GE":"Georgia",
                 "GH":"Ghana",
                 "GI":"Gibraltar",
                 "GD":"Granada",
                 "GR":"Grecia",
                 "GL":"Groenlandia",
                 "GP":"Guadalupe",
                 "GU":"Guam",
                 "GT":"Guatemala",
                 "GF":"Guayana Francesa",
                 "GG":"Guernsey",
                 "GN":"Guinea",
                 "GQ":"Guinea Ecuatorial",
                 "GW":"Guinea-Bis\u00e1u",
                 "GY":"Guyana",
                 "HT":"Hait\u00ed",
                 "HN":"Honduras",
                 "HU":"Hungr\u00eda",
                 "IN":"India",
                 "ID":"Indonesia",
                 "IQ":"Irak",
                 "IR":"Ir\u00e1n",
                 "IE":"Irlanda",
                 "AC":"Isla de la Ascensi\u00f3n",
                 "IM":"Isla de Man",
                 "CX":"Isla de Navidad",
                 "NF":"Isla Norfolk",
                 "IS":"Islandia",
                 "AX":"Islas \u00c5land",
                 "KY":"Islas Caim\u00e1n",
                 "CC":"Islas Cocos",
                 "CK":"Islas Cook",
                 "FO":"Islas Feroe",
                 "GS":"Islas Georgia del Sur y Sandwich del Sur",
                 "FK":"Islas Malvinas",
                 "MP":"Islas Marianas del Norte",
                 "MH":"Islas Marshall",
                 "UM":"Islas menores alejadas de EE. UU.",
                 "PN":"Islas Pitcairn",
                 "SB":"Islas Salom\u00f3n",
                 "TC":"Islas Turcas y Caicos",
                 "VG":"Islas V\u00edrgenes Brit\u00e1nicas",
                 "VI":"Islas V\u00edrgenes de EE. UU.",
                 "IL":"Israel",
                 "IT":"Italia",
                 "JM":"Jamaica",
                 "JP":"Jap\u00f3n",
                 "JE":"Jersey",
                 "JO":"Jordania",
                 "KZ":"Kazajist\u00e1n",
                 "KE":"Kenia",
                 "KG":"Kirguist\u00e1n",
                 "KI":"Kiribati",
                 "XK":"Kosovo",
                 "KW":"Kuwait",
                 "LA":"Laos",
                 "LS":"Lesoto",
                 "LV":"Letonia",
                 "LB":"L\u00edbano",
                 "LR":"Liberia",
                 "LY":"Libia",
                 "LI":"Liechtenstein",
                 "LT":"Lituania",
                 "LU":"Luxemburgo",
                 "MK":"Macedonia",
                 "MG":"Madagascar",
                 "MY":"Malasia",
                 "MW":"Malaui",
                 "MV":"Maldivas",
                 "ML":"Mali",
                 "MT":"Malta",
                 "MA":"Marruecos",
                 "MQ":"Martinica",
                 "MU":"Mauricio",
                 "MR":"Mauritania",
                 "YT":"Mayotte",
                 "MX":"M\u00e9xico",
                 "FM":"Micronesia",
                 "MD":"Moldavia",
                 "MC":"M\u00f3naco",
                 "MN":"Mongolia",
                 "ME":"Montenegro",
                 "MS":"Montserrat",
                 "MZ":"Mozambique",
                 "MM":"Myanmar (Birmania)",
                 "NA":"Namibia",
                 "NR":"Nauru",
                 "NP":"Nepal",
                 "NI":"Nicaragua",
                 "NE":"N\u00edger",
                 "NG":"Nigeria",
                 "NU":"Niue",
                 "NO":"Noruega",
                 "NC":"Nueva Caledonia",
                 "NZ":"Nueva Zelanda",
                 "OM":"Om\u00e1n",
                 "NL":"Pa\u00edses Bajos",
                 "PK":"Pakist\u00e1n",
                 "PW":"Palaos",
                 "PA":"Panam\u00e1",
                 "PG":"Pap\u00faa Nueva Guinea",
                 "PY":"Paraguay",
                 "PE":"Per\u00fa",
                 "PF":"Polinesia Francesa",
                 "PL":"Polonia",
                 "PT":"Portugal",
                 "XA":"Pseudo-Accents",
                 "XB":"Pseudo-Bidi",
                 "PR":"Puerto Rico",
                 "HK":"RAE de Hong Kong (China)",
                 "MO":"RAE de Macao (China)",
                 "GB":"Reino Unido",
                 "CF":"Rep\u00fablica Centroafricana",
                 "CD":"Rep\u00fablica Democr\u00e1tica del Congo",
                 "DO":"Rep\u00fablica Dominicana",
                 "RE":"Reuni\u00f3n",
                 "RW":"Ruanda",
                 "RO":"Ruman\u00eda",
                 "RU":"Rusia",
                 "EH":"S\u00e1hara Occidental",
                 "WS":"Samoa",
                 "AS":"Samoa Americana",
                 "BL":"San Bartolom\u00e9",
                 "KN":"San Crist\u00f3bal y Nieves",
                 "SM":"San Marino",
                 "MF":"San Mart\u00edn",
                 "PM":"San Pedro y Miquel\u00f3n",
                 "VC":"San Vicente y las Granadinas",
                 "SH":"Santa Elena",
                 "LC":"Santa Luc\u00eda",
                 "ST":"Santo Tom\u00e9 y Pr\u00edncipe",
                 "SN":"Senegal",
                 "RS":"Serbia",
                 "SC":"Seychelles",
                 "SL":"Sierra Leona",
                 "SG":"Singapur",
                 "SX":"Sint Maarten",
                 "SY":"Siria",
                 "SO":"Somalia",
                 "LK":"Sri Lanka",
                 "ZA":"Sud\u00e1frica",
                 "SD":"Sud\u00e1n",
                 "SS":"Sud\u00e1n del Sur",
                 "SE":"Suecia",
                 "CH":"Suiza",
                 "SR":"Surinam",
                 "SJ":"Svalbard y Jan Mayen",
                 "TH":"Tailandia",
                 "TW":"Taiw\u00e1n",
                 "TZ":"Tanzania",
                 "TJ":"Tayikist\u00e1n",
                 "IO":"Territorio Brit\u00e1nico del Oc\u00e9ano \u00cdndico",
                 "TF":"Territorios Australes Franceses",
                 "PS":"Territorios Palestinos",
                 "TL":"Timor-Leste",
                 "TG":"Togo",
                 "TK":"Tokelau",
                 "TO":"Tonga",
                 "TT":"Trinidad y Tobago",
                 "TA":"Trist\u00e1n de Acu\u00f1a",
                 "TN":"T\u00fanez",
                 "TM":"Turkmenist\u00e1n",
                 "TR":"Turqu\u00eda",
                 "TV":"Tuvalu",
                 "UA":"Ucrania",
                 "UG":"Uganda",
                 "UY":"Uruguay",
                 "UZ":"Uzbekist\u00e1n",
                 "VU":"Vanuatu",
                 "VE":"Venezuela",
                 "VN":"Vietnam",
                 "WF":"Wallis y Futuna",
                 "YE":"Yemen",
                 "DJ":"Yibuti",
                 "ZM":"Zambia",
                 "ZW":"Zimbabue"
              },
              'days': '&nbsp;<u><b>{{count}}</b></u>&nbsp; día',
              'days_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; días',
              'hours': '&nbsp;<u><b>{{count}}</b></u>&nbsp; hora',
              'hours_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; horas',
              'minutes': '&nbsp;<u><b>{{count}}</b></u>&nbsp; minuto',
              'minutes_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; minutos', 
              'error': 'Lo sentimos. Se ha producido un error en el proceso.',
              'welcomeConnectedUser': 'Bienvenido <b>{{name}}</b>, puede proceder con su reserva',
              'invalid_user_password': 'El usuario o el password no son válidos'                       
            },
            extra: {
              'daily_amount': '{{oneUnitPrice}}/día',
              'hourly_amount': '{{oneUnitPrice}}/hora',
              'unitary_amount': '{{oneUnitPrice}}',
              'total': 'Total {{total}}'
            },
            contact: {
              'form_errors': 'Por favor, revise los errores',   
              'validate_captcha': 'Por favor, valide captcha', 
              'validations': {
                 'nameRequired': 'El nombre es obligatorio',
                 'surnameRequired': 'Los apellidos son obligatorios',
                 'emailRequired': 'El correo electrónico es obligatorio',
                 'phoneNumberRequired': 'El número de teléfono es obligatorio',
                 'commentsRequired': 'El mensaje es obligatorio'
              },                
              'message_sent_successfully': 'Mensaje enviado con éxito',
              'error_sending_message': 'Error enviando mensaje'
            },        
            calendar_selector: {
              'min_time': 'La devolución de la reserva anterior es a las {{time}}',
              'max_time': 'La entrega de la siguiente reserva es a las {{time}}'
            },  		
            selector: {
              'select_pickup_place': 'Seleccionar lugar de entrega',
              'select_return_place': 'Seleccionar lugar de devolución',  
              'another_place': 'Dirección exacta',
              'error_loading_data': 'Lo sentimos. Se ha producido un error cargando los datos',                            
      		    'validations': {
                'pickupPlaceRequired': 'Lugar de entrega obligatorio',
                'dateFromRequired': 'Fecha obligatoria',
                'timeFromRequired': 'Hora obligatoria',
                'returnPlaceRequired': 'Lugar de devolución obligatorio',
                'dateToRequired': 'Fecha obligatoria',
                'timeToRequired': 'Hora obligatoria',            
    	  				'sameDayTimeToGreaterTimeFrom': 'Debe ser mayor que la entrega',
    	  				'acceptAge': 'Debe confirmar que es mayor de {{years}} años',
    	  				'promotionCodeInvalid': 'Código de promoción no es válido'  
  				    }			
      			},
      			chooseProduct: {
      				'loadShoppingCart': {
      					'error': 'Lo sentimos. Se ha producido un error al realizar la búsqueda.'
      				},
      				'selectProduct': {
      					'productNotSelected': 'Por favor, seleccione el vehículo.',
      					'error': 'Lo sentimos. Se ha producido un error seleccionando el vehículo.'
      				},
              'selectUnits': 'Seleccionar unidades',          
              'units': '{{count}} unidad',
              'units_plural': '{{count}} unidades',
              'max_duration': 'La duración máxima es de {{duration}}',
              'min_duration': 'La duración mínima es de {{duration}}'          
      			},
      			chooseExtras: {
      				'loadShoppingCart': {
      					'error': 'Lo sentimos. Se ha producido un error al cargar la información.'
      				},
      				'selectExtra': {
      					'error': 'Lo sentimos. Se ha producido un error al actualizar el extra.'
      				},
      				'deleteExtra': {
      					'error': 'Lo sentimos. Se ha producido un error al eliminar el extra.'
      				}   				 
      			},
      			complete: {
                  'loadShoppingCart': {
                    'error': 'Lo sentimos. Se ha producido un error al cargar la información.'
                  },
                  'selectExtra': {
                    'error': 'Lo sentimos. Se ha producido un error al actualizar el extra.'
                  },
                  'deleteExtra': {
                    'error': 'Lo sentimos. Se ha producido un error al eliminar el extra.'
                  },
                  'promotionCode': {
                    'error': 'Lo sentimos. Se ha producido un error al validar el código de promoción',
                  },                  
                  'reservationForm': {
                    'errors': 'El formulario contiene errores. Por favor, revíselo',
                    'total_payment': 'Pagar {{amount}}',
                    'payment_button': 'Pagar {{amount}}',          
                    'booking_amount': 'Para confirmar su reserva ha de realizarse un pago de <strong>{{amount}}</strong>.',
                    'select_country': 'Seleccionar país',                     
                    'validations': {
                      'fieldRequired': 'Campo obligatorio',  
                      'passwordCheck': 'La contraseña debe contener letras mayúsculas, minúsculas, dígitos y símbolos',
                      'minLength': 'Tamaño mínimo {{minlength}}',                      
                      'customerNameRequired': 'Nombre del cliente obligatorio',
                      'customerSurnameRequired': 'Apellidos del cliente obligatorios',
                      'customerEmailRequired': 'Correo electrónico del cliente obligatorio',
                      'customerEmailInvalidFormat': 'El formato del correo electrónico no es válido',
                      'customerEmailConfirmationRequired': 'Confirmación del correo electrónico del cliente obligatorio',
                      'customerEmailConfirmationEqualsEmail': 'La confirmación debe ser igual al correo electrónico',
                      'customerPhoneNumberRequired': 'Teléfono del cliente obligatorio',
                      'customerPhoneNumberMinLength': 'Longitud mínima del teléfono del cliente',
                      'driverDateOfBirthRequired': 'Fecha de nacimiento del conductor obligatoria',
                      'numberOfAdultsRequired': 'Número de personas obligatorio',              
                      'conditionsReadRequired': 'No ha marcado que ha leído las condiciones',
                      'privacyPolicyRequired': 'No ha marcado que ha leído la política de privacidad',                      
                      'selectPaymentMethod': 'Por favor, seleccione la forma de pago'              
                    }
                  },
                  'createReservation': {
                    'error': 'Lo sentimos. Se ha producido un error registrando la reserva.'
                  }          
        		},
            summary: {
              'loadReservation': {
                'error': 'Lo sentimos. Se ha producido un error al cargar la reserva.'
              }
            },
            myReservation: {
              'select_country': 'Seleccionar país',                 
              'loadReservation': {
                'error': 'Lo sentimos. Se ha producido un error al cargar la reserva.'
              },
              'pay': {
                'total_payment': 'Pagar {{amount}}',
                'payment_button': 'Pagar {{amount}}',   
                'paymentMethodRequired': 'Por favor, seleccione la forma de pago.',
                'booking_amount': 'Para confirmar su reserva ha de realizarse un pago de <strong>{{amount}}</strong>.',
                'pending_amount': 'Puede realizar el pago del importe pendiente de la reserva, <strong>{{amount}}</strong>'
              },
              'updateReservation': {
                'success': 'La reserva se ha actualizado.',
                'error': 'Lo sentimos, se ha producido un error actualizando la reserva'
              }          
            },
            selectorWizard: {
               'pickupPlace': 'Lugar de entrega',
               'dateFrom': 'Fecha de entrega',
               'timeFrom': 'Hora de entrega',
               'returnPlace': 'Lugar de devolución',
               'dateTo': 'Fecha de devolución',
               'timeTo': 'Hora de devolución'              
            },
            activities: {
              common: {
                'errorLoadingData': 'Lo sentimos. Se ha producido un error al obtener la información',
                'errorUpdatingData': 'Lo sentimos. Se ha producido un error al actualizar la información',
                'dataUpdateOk': 'Datos actualizados con éxito'
              },
              calendarWidget: {
                 'selectTickets': 'No ha seleccionado ninguna persona',
                 'fullPlaces': 'Completo',
                 'fewPlacesWarning': 'Últimas plazas',
                 'fewNoPlacesWarning': 'Últimos horarios'                 
              },
              multipleDates: {
                 'selectDate': 'Por favor, seleccione la fecha'
              },
              checkout: {
                 'errorCreatingOrder': 'Lo sentimos. Se ha producido un error creando la reserva',
                 'errors': 'Por favor, revise los errores.',                 
                 'validations': {
                   'customerNameRequired': 'Nombre del cliente obligatorio',
                   'customerSurnameRequired': 'Apellidos del cliente obligatorios',
                   'customerEmailRequired': 'Correo electrónico del cliente obligatorio',
                   'customerEmailInvalidFormat': 'El formato del correo electrónico no es válido',
                   'customerEmailConfirmationRequired': 'Confirmación del correo electrónico del cliente obligatorio',
                   'customerEmailConfirmationEqualsEmail': 'La confirmación debe ser igual al correo electrónico',
                   'customerPhoneNumberRequired': 'Teléfono del cliente obligatorio',
                   'customerPhoneNumberMinLength': 'Longitud mínima del teléfono del cliente',
                   'conditionsReadRequired': 'No ha marcado que ha leído las condiciones',
                   'privacyPolicyRequired': 'No ha marcado que ha leído la política de privacidad',
                   'selectPaymentMethod': 'Por favor, seleccione la forma de pago'
                 }
              },
              payment: {
                 'total_payment': 'Pagar {{amount}}',
                 'payment_button': 'Pagar {{amount}}',
                 'deposit_amount': 'Para confirmar su reserva ha de realizarse un pago de <strong>{{amount}}</strong>.',
                 'pending_amount': 'Puede realizar el pago del importe pendiente de la reserva, <strong>{{amount}}</strong>',               
                 'errors': 'Por favor, revise los errores.',
                 'paymentMethodNotSelected': 'Por favor, seleccione la forma de pago' 
              },
              myReservation: {
                 'cancelReservationConfirm': '¿Está seguro que desea cancelar la reserva?'
              }
            }

  		}
  	},
  	ca: {
      translation: {
        common: {
          'countries': {
             "AF":"Afganistan",
             "AL":"Alb\u00e0nia",
             "DE":"Alemanya",
             "DZ":"Alg\u00e8ria",
             "AD":"Andorra",
             "AO":"Angola",
             "AI":"Anguilla",
             "AQ":"Ant\u00e0rtida",
             "AG":"Antigua i Barbuda",
             "SA":"Ar\u00e0bia Saudita",
             "AR":"Argentina",
             "AM":"Arm\u00e8nia",
             "AW":"Aruba",
             "AU":"Austr\u00e0lia",
             "AT":"\u00c0ustria",
             "AZ":"Azerbaidjan",
             "BS":"Bahames",
             "BH":"Bahrain",
             "BD":"Bangla Desh",
             "BB":"Barbados",
             "BY":"Belar\u00fas",
             "BE":"B\u00e8lgica",
             "BZ":"Belize",
             "BJ":"Ben\u00edn",
             "BM":"Bermudes",
             "BT":"Bhutan",
             "BO":"Bol\u00edvia",
             "BA":"B\u00f2snia i Hercegovina",
             "BW":"Botswana",
             "BR":"Brasil",
             "BN":"Brunei",
             "BG":"Bulg\u00e0ria",
             "BF":"Burkina Faso",
             "BI":"Burundi",
             "KH":"Cambodja",
             "CM":"Camerun",
             "CA":"Canad\u00e0",
             "CV":"Cap Verd",
             "BQ":"Carib Neerland\u00e8s",
             "EA":"Ceuta i Melilla",
             "VA":"Ciutat del Vatic\u00e0",
             "CO":"Col\u00f2mbia",
             "KM":"Comores",
             "CG":"Congo - Brazzaville",
             "CD":"Congo - Kinshasa",
             "KP":"Corea del Nord",
             "KR":"Corea del Sud",
             "CI":"Costa d\u2019Ivori",
             "CR":"Costa Rica",
             "HR":"Cro\u00e0cia",
             "CU":"Cuba",
             "CW":"Cura\u00e7ao",
             "DG":"Diego Garcia",
             "DK":"Dinamarca",
             "DJ":"Djibouti",
             "DM":"Dominica",
             "EG":"Egipte",
             "SV":"El Salvador",
             "AE":"Emirats \u00c0rabs Units",
             "EC":"Equador",
             "ER":"Eritrea",
             "SK":"Eslov\u00e0quia",
             "SI":"Eslov\u00e8nia",
             "ES":"Espanya",
             "US":"Estats Units",
             "EE":"Est\u00f2nia",
             "SZ":"eSwatini",
             "ET":"Eti\u00f2pia",
             "FJ":"Fiji",
             "PH":"Filipines",
             "FI":"Finl\u00e0ndia",
             "FR":"Fran\u00e7a",
             "GA":"Gabon",
             "GM":"G\u00e0mbia",
             "GE":"Ge\u00f2rgia",
             "GH":"Ghana",
             "GI":"Gibraltar",
             "GR":"Gr\u00e8cia",
             "GD":"Grenada",
             "GL":"Grenl\u00e0ndia",
             "GP":"Guadeloupe",
             "GF":"Guaiana Francesa",
             "GU":"Guam",
             "GT":"Guatemala",
             "GG":"Guernsey",
             "GN":"Guinea",
             "GW":"Guinea Bissau",
             "GQ":"Guinea Equatorial",
             "GY":"Guyana",
             "HT":"Hait\u00ed",
             "HN":"Hondures",
             "HK":"Hong Kong (RAE Xina)",
             "HU":"Hongria",
             "YE":"Iemen",
             "CX":"Illa Christmas",
             "AC":"Illa de l\u2019Ascensi\u00f3",
             "RE":"Illa de la Reuni\u00f3",
             "IM":"Illa de Man",
             "AX":"Illes \u00c5land",
             "KY":"Illes Caiman",
             "IC":"Illes Can\u00e0ries",
             "CC":"Illes Cocos",
             "CK":"Illes Cook",
             "FO":"Illes F\u00e8roe",
             "GS":"Illes Ge\u00f2rgia del Sud i Sandwich del Sud",
             "FK":"Illes Malvines",
             "MP":"Illes Mariannes del Nord",
             "MH":"Illes Marshall",
             "UM":"Illes Perif\u00e8riques Menors dels EUA",
             "PN":"Illes Pitcairn",
             "SB":"Illes Salom\u00f3",
             "TC":"Illes Turks i Caicos",
             "VG":"Illes Verges Brit\u00e0niques",
             "VI":"Illes Verges Nord-americanes",
             "IN":"\u00cdndia",
             "ID":"Indon\u00e8sia",
             "IR":"Iran",
             "IQ":"Iraq",
             "IE":"Irlanda",
             "IS":"Isl\u00e0ndia",
             "IL":"Israel",
             "IT":"It\u00e0lia",
             "JM":"Jamaica",
             "JP":"Jap\u00f3",
             "JE":"Jersey",
             "JO":"Jord\u00e0nia",
             "KZ":"Kazakhstan",
             "KE":"Kenya",
             "KG":"Kirguizistan",
             "KI":"Kiribati",
             "XK":"Kosovo",
             "KW":"Kuwait",
             "LA":"Laos",
             "LS":"Lesotho",
             "LV":"Let\u00f2nia",
             "LB":"L\u00edban",
             "LR":"Lib\u00e8ria",
             "LY":"L\u00edbia",
             "LI":"Liechtenstein",
             "LT":"Litu\u00e0nia",
             "LU":"Luxemburg",
             "MO":"Macau (RAE Xina)",
             "MK":"Maced\u00f2nia del Nord",
             "MG":"Madagascar",
             "MY":"Mal\u00e0isia",
             "MW":"Malawi",
             "MV":"Maldives",
             "ML":"Mali",
             "MT":"Malta",
             "MA":"Marroc",
             "MQ":"Martinica",
             "MU":"Maurici",
             "MR":"Maurit\u00e0nia",
             "YT":"Mayotte",
             "MX":"M\u00e8xic",
             "FM":"Micron\u00e8sia",
             "MZ":"Mo\u00e7ambic",
             "MD":"Mold\u00e0via",
             "MC":"M\u00f2naco",
             "MN":"Mong\u00f2lia",
             "ME":"Montenegro",
             "MS":"Montserrat",
             "MM":"Myanmar (Birm\u00e0nia)",
             "NA":"Nam\u00edbia",
             "NR":"Nauru",
             "NP":"Nepal",
             "NI":"Nicaragua",
             "NE":"N\u00edger",
             "NG":"Nig\u00e8ria",
             "NU":"Niue",
             "NF":"Norfolk",
             "NO":"Noruega",
             "NC":"Nova Caled\u00f2nia",
             "NZ":"Nova Zelanda",
             "OM":"Oman",
             "NL":"Pa\u00efsos Baixos",
             "PK":"Pakistan",
             "PW":"Palau",
             "PA":"Panam\u00e0",
             "PG":"Papua Nova Guinea",
             "PY":"Paraguai",
             "PE":"Per\u00fa",
             "PF":"Polin\u00e8sia Francesa",
             "PL":"Pol\u00f2nia",
             "PT":"Portugal",
             "XA":"Pseudo-Accents",
             "XB":"Pseudo-Bidi",
             "PR":"Puerto Rico",
             "QA":"Qatar",
             "GB":"Regne Unit",
             "CF":"Rep\u00fablica Centreafricana",
             "ZA":"Rep\u00fablica de Sud-\u00e0frica",
             "DO":"Rep\u00fablica Dominicana",
             "RO":"Romania",
             "RW":"Ruanda",
             "RU":"R\u00fassia",
             "EH":"S\u00e0hara Occidental",
             "BL":"Saint Barth\u00e9lemy",
             "KN":"Saint Christopher i Nevis",
             "SH":"Saint Helena",
             "LC":"Saint Lucia",
             "MF":"Saint Martin",
             "VC":"Saint Vincent i les Grenadines",
             "PM":"Saint-Pierre-et-Miquelon",
             "WS":"Samoa",
             "AS":"Samoa Nord-americana",
             "SM":"San Marino",
             "ST":"S\u00e3o Tom\u00e9 i Pr\u00edncipe",
             "SN":"Senegal",
             "RS":"S\u00e8rbia",
             "SC":"Seychelles",
             "SL":"Sierra Leone",
             "SG":"Singapur",
             "SX":"Sint Maarten",
             "SY":"S\u00edria",
             "SO":"Som\u00e0lia",
             "LK":"Sri Lanka",
             "SD":"Sudan",
             "SS":"Sudan del Sud",
             "SE":"Su\u00e8cia",
             "CH":"Su\u00efssa",
             "SR":"Surinam",
             "SJ":"Svalbard i Jan Mayen",
             "TJ":"Tadjikistan",
             "TH":"Tail\u00e0ndia",
             "TW":"Taiwan",
             "TZ":"Tanz\u00e0nia",
             "IO":"Territori Brit\u00e0nic de l\u2019Oce\u00e0 \u00cdndic",
             "TF":"Territoris Australs Francesos",
             "PS":"territoris palestins",
             "TL":"Timor Oriental",
             "TG":"Togo",
             "TK":"Tokelau",
             "TO":"Tonga",
             "TT":"Trinitat i Tobago",
             "TA":"Trist\u00e3o da Cunha",
             "TN":"Tun\u00edsia",
             "TM":"Turkmenistan",
             "TR":"Turquia",
             "TV":"Tuvalu",
             "TD":"Txad",
             "CZ":"Tx\u00e8quia",
             "UA":"Ucra\u00efna",
             "UG":"Uganda",
             "UY":"Uruguai",
             "UZ":"Uzbekistan",
             "VU":"Vanuatu",
             "VE":"Vene\u00e7uela",
             "VN":"Vietnam",
             "WF":"Wallis i Futuna",
             "CL":"Xile",
             "CN":"Xina",
             "CY":"Xipre",
             "ZM":"Z\u00e0mbia",
             "ZW":"Zimb\u00e0bue"
          },
          'days': '&nbsp;<u><b>{{count}}</b></u>&nbsp; dia',
          'days_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; dies',
          'hours': '&nbsp;<u><b>{{count}}</b></u>&nbsp; hora',
          'hours_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; hores',
          'minutes': '&nbsp;<u><b>{{count}}</b></u>&nbsp; minut',
          'minutes_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; minuts',
          'error': "Ho sentim. S'ha produit un error al procès",
          'welcomeConnectedUser': 'Benvingut <b>{{name}}</b>, pot procedir amb la seva reserva',
          'invalid_user_password': "L'usuari o la clau no són correctes"                         
        },
        extra: {
          'daily_amount': '{{oneUnitPrice}}/dia',
          'hourly_amount': '{{oneUnitPrice}}/hora',
          'unitary_amount': '{{oneUnitPrice}}',
          'total': 'Total {{total}}'
        },
        contact: {
          'form_errors': 'Si us plau, reviseu els errors',    
          'validate_captcha': 'Si us plau, valideu captcha',
          'validations': {
             'nameRequired': 'El nom és obligatori',
             'surnameRequired': 'Els cognoms són obligatoris',
             'emailRequired': 'El correu electrònic és obligatori',
             'phoneNumberRequired': 'El número de telèfon és obligatori',
             'commentsRequired': 'El missatge és obligatori'
          },                
          'message_sent_successfully': "El missatge s'ha enviat amb èxit",
          'error_sending_message': "S'ha produït un error enviant el missatge"
        },
        calendar_selector: {
          'min_time': 'La recollida de la reserva anterior és a les {{time}}',
          'max_time': "L'entrega de la propera reserva és a les {{time}}"
        },      
        selector: {
          'select_pickup_place': 'Seleccionar el lloc de lliurament',
          'select_return_place': 'Seleccionar el lloc de devolució',  
          'another_place': 'Adreça exacta',
          'error_loading_data': "Ho sentim. S'ha prodit un error carregant les dades",                            
          'validations': {
            'pickupPlaceRequired': 'El lloc de lliurament és obligatori',
            'dateFromRequired': 'La data és obligatòria',
            'timeFromRequired': "L'hora és obligatòria",
            'returnPlaceRequired': 'El lloc de devolució és obligatori',
            'dateToRequired': 'La data és obligatòria',
            'timeToRequired': "L'hora és obligatòria",            
            'sameDayTimeToGreaterTimeFrom': 'Ha de ser posterior que la de lliurament',
            'acceptAge': 'Si us plau, confirmi que és més gran de {{years}} anys',
            'promotionCodeInvalid': 'El codi de promoció no és vàlid',
            'selectPaymentMethod': 'Si us plau, escollir la forma de pagament'                     
          }     
        },
        chooseProduct: {
          'loadShoppingCart': {
            'error': "Ho sentim. S'ha produit un error al realitzar la cerca."
          },
          'selectProduct': {
            'productNotSelected': 'Si us plau, realitzi la selecció del vehicle.',
            'error': "Ho sentim. S'ha produit un error al realitzar la selecció del vehicle."
          },
          'selectUnits': 'Escollir unitats',          
          'units': '{{count}} unitat',
          'units_plural': '{{count}} unitats',
          'max_duration': 'La durada màxima és de {{duration}}',
          'min_duration': 'La durada mínima és de {{duration}}'                     
        },
        chooseExtras: {
          'loadShoppingCart': {
            'error': "Ho sentim. S'ha produït un error al carregar l'informació."
          },
          'selectExtra': {
            'error': "Ho sentim. S'ha produït un error al seleccionar l'extra."
          },
          'deleteExtra': {
            'error': "Ho sentim. S'ha produït un error a l'eliminar l'extra."
          }            
        },
        complete: {
          'loadShoppingCart': {
            'error': "Ho sentim. S'ha produït un error al carregar l'informació."
          },
          'selectExtra': {
            'error': "Ho sentim. S'ha produït un error al seleccionar l'extra."
          },
          'deleteExtra': {
            'error': "Ho sentim. S'ha produït un error a l'eliminar l'extra."
          },
          'promotionCode': {
            'error': "Ho sentim. S'ha produït un error verificant el codi de promoció.",
          },  
          'reservationForm': {
            'errors': 'Si us plau, reviseu els errors',
            'total_payment': 'Pagar {{amount}}',
            'payment_button': 'Pagar {{amount}}',                 
            'booking_amount': "Per confirmar la reserva s'ha de realitzar un pagament de <strong>{{amount}}</strong>.",
            'select_country': 'Escollir país',              
            'validations': {
              'fieldRequired': 'Camp obligatori', 
              'passwordCheck': 'La contrasenya ha de contenir lletres majúscules, minúscules, dígits i símbols',              
              'minLength': 'Mínim {{minlength}} caràcters',               
              'customerNameRequired': 'El nom del client és obligatori',
              'customerSurnameRequired': 'Els cognoms del client són obligatoris',
              'customerEmailRequired': 'El correu electrònic del client és obligatori',
              'customerEmailInvalidFormat': 'El correu electrònic no té un format vàlid',
              'customerEmailConfirmationRequired': 'La confirmació del correu electrònic és obligatòria',
              'customerEmailConfirmationEqualsEmail': 'La confirmació no és igual al correu electrònic',
              'customerPhoneNumberRequired': 'El telèfon del client és obligatori',
              'customerPhoneNumberMinLength': 'El tamany mínim del telèfon és de 9 digits',
              'driverDateOfBirthRequired': 'La data de naixement del conductor és obligatòria',
              'numberOfAdultsRequired': 'El nombre de persones és obligatori',               
              'conditionsReadRequired': 'No ha llegit les condicions',
              'privacyPolicyRequired': 'No ha llegit la política de privacitat',              
            }
          },
          'createReservation': {
            'error': "Ho sentim. S'ha produït un error registrant la reserva o sol.licitud"
          }          
        },
        summary: {
          'loadReservation': {
            'error': "Ho sentim. S'ha produït un error al carregar l'informació."
          }
        },
        myReservation: {
          'select_country': 'Escollir país',             
          'loadReservation': {
            'error': "Ho sentim. S'ha produït un error al carregar l'informació."
          },
          'pay': {
            'total_payment': 'Pagar {{amount}}',
            'payment_button': 'Pagar {{amount}}',
            'paymentMethodRequired': 'Si us plau, escolli el medi de pagament',
            'booking_amount': "Per confirmar la reserva s'ha de realitzar un pagament de <strong>{{amount}}</strong>.",
            'pending_amount': "Pot realitzar el pagament de l'import pendent de la seva reserva, <strong>{{amount}}</strong>",
          },
          'updateReservation': {
            'success': 'Reserva actualitzada',
            'error': "Ho sentim. S'ha produït un error actualitzant la reserva"
          }          
        },
        selectorWizard: {
           'pickupPlace': 'Punt de lliurament',
           'dateFrom': 'Data de lliurament',
           'timeFrom': 'Hora de lliurament',
           'returnPlace': 'Punt de devolució',
           'dateTo': 'Data de devolució',
           'timeTo': 'Hora de devolució'              
        },        
        activities: {
          common: {
            'errorLoadingData':"Ho sentim. S'ha produït un error al carregar l'informació.",
            'errorUpdatingData': "Ho sentim. S'ha produït un error actualitzant l'informació.",
            'dataUpdateOk': "Les dades s'han actualitzat."
          },
          calendarWidget: {
             'selectTickets': 'No ha escollit el número de persones',
             'fullPlaces': 'Complet',
             'fewPlacesWarning': 'Darrares places',
             'fewNoPlacesWarning': 'Darrers horaris'                   
          },
          multipleDates: {
             'selectDate': 'Si us plau, triï una data'
          },
          checkout: {
             'errorCreatingOrder': "Ho sentim. S'ha produït un error al crear la reserva.",
             'errors': 'Si us plau, reviseu els errors',                 
             'validations': {
               'customerNameRequired': 'El nom del client és obligatori',
               'customerSurnameRequired': 'Els cognoms del client són obligatoris',
               'customerEmailRequired': 'El correu electrònic del client és obligatori',
               'customerEmailInvalidFormat': 'El correu electrònic no té un format vàlid',
               'customerEmailConfirmationRequired': 'La confirmació del correu electrònic és obligatòria',
               'customerEmailConfirmationEqualsEmail': 'La confirmació no és igual al correu electrònic',
               'customerPhoneNumberRequired': 'El telèfon del client és obligatori',
               'customerPhoneNumberMinLength': 'El tamany mínim del telèfon és de 9 digits',
               'conditionsReadRequired': 'No ha llegit les condicions',
               'privacyPolicyRequired': 'No ha llegit la política de privacitat',                 
               'selectPaymentMethod': 'Si us plau, escolli el medi de pagament'
             }
          },
          payment: {
             'total_payment': 'Pagar {{amount}}',
             'payment_button': 'Pagar {{amount}}',   
             'deposit_amount': "Per confirmar la reserva s'ha de realitzar un pagament de <strong>{{amount}}</strong>.",
             'pending_amount': "Pot realitzar el pagament de l'import pendent de la seva reserva, <strong>{{amount}}</strong>",
             'errors': 'Si us plau, reviseu els errors',
             'paymentMethodNotSelected': 'Si us plau, escolli el medi de pagament'
          },
          myReservation: {
             'cancelReservationConfirm': 'Vol cancelar la reserva?'
          }          
        }
      }
  	},
  	de: {
      translation: {
        common: {
          'countries': {
             "AF":"Afghanistan",
             "EG":"\u00c4gypten",
             "AX":"\u00c5landinseln",
             "AL":"Albanien",
             "DZ":"Algerien",
             "AS":"Amerikanisch-Samoa",
             "VI":"Amerikanische Jungferninseln",
             "UM":"Amerikanische \u00dcberseeinseln",
             "AD":"Andorra",
             "AO":"Angola",
             "AI":"Anguilla",
             "AQ":"Antarktis",
             "AG":"Antigua und Barbuda",
             "GQ":"\u00c4quatorialguinea",
             "AR":"Argentinien",
             "AM":"Armenien",
             "AW":"Aruba",
             "AC":"Ascension",
             "AZ":"Aserbaidschan",
             "ET":"\u00c4thiopien",
             "AU":"Australien",
             "BS":"Bahamas",
             "BH":"Bahrain",
             "BD":"Bangladesch",
             "BB":"Barbados",
             "BY":"Belarus",
             "BE":"Belgien",
             "BZ":"Belize",
             "BJ":"Benin",
             "BM":"Bermuda",
             "BT":"Bhutan",
             "BO":"Bolivien",
             "BQ":"Bonaire, Sint Eustatius und Saba",
             "BA":"Bosnien und Herzegowina",
             "BW":"Botsuana",
             "BR":"Brasilien",
             "VG":"Britische Jungferninseln",
             "IO":"Britisches Territorium im Indischen Ozean",
             "BN":"Brunei Darussalam",
             "BG":"Bulgarien",
             "BF":"Burkina Faso",
             "BI":"Burundi",
             "CV":"Cabo Verde",
             "EA":"Ceuta und Melilla",
             "CL":"Chile",
             "CN":"China",
             "CK":"Cookinseln",
             "CR":"Costa Rica",
             "CI":"C\u00f4te d\u2019Ivoire",
             "CW":"Cura\u00e7ao",
             "DK":"D\u00e4nemark",
             "DE":"Deutschland",
             "DG":"Diego Garcia",
             "DM":"Dominica",
             "DO":"Dominikanische Republik",
             "DJ":"Dschibuti",
             "EC":"Ecuador",
             "SV":"El Salvador",
             "ER":"Eritrea",
             "EE":"Estland",
             "FK":"Falklandinseln",
             "FO":"F\u00e4r\u00f6er",
             "FJ":"Fidschi",
             "FI":"Finnland",
             "FR":"Frankreich",
             "GF":"Franz\u00f6sisch-Guayana",
             "PF":"Franz\u00f6sisch-Polynesien",
             "TF":"Franz\u00f6sische S\u00fcd- und Antarktisgebiete",
             "GA":"Gabun",
             "GM":"Gambia",
             "GE":"Georgien",
             "GH":"Ghana",
             "GI":"Gibraltar",
             "GD":"Grenada",
             "GR":"Griechenland",
             "GL":"Gr\u00f6nland",
             "GP":"Guadeloupe",
             "GU":"Guam",
             "GT":"Guatemala",
             "GG":"Guernsey",
             "GN":"Guinea",
             "GW":"Guinea-Bissau",
             "GY":"Guyana",
             "HT":"Haiti",
             "HN":"Honduras",
             "IN":"Indien",
             "ID":"Indonesien",
             "IQ":"Irak",
             "IR":"Iran",
             "IE":"Irland",
             "IS":"Island",
             "IM":"Isle of Man",
             "IL":"Israel",
             "IT":"Italien",
             "JM":"Jamaika",
             "JP":"Japan",
             "YE":"Jemen",
             "JE":"Jersey",
             "JO":"Jordanien",
             "KY":"Kaimaninseln",
             "KH":"Kambodscha",
             "CM":"Kamerun",
             "CA":"Kanada",
             "IC":"Kanarische Inseln",
             "KZ":"Kasachstan",
             "QA":"Katar",
             "KE":"Kenia",
             "KG":"Kirgisistan",
             "KI":"Kiribati",
             "CC":"Kokosinseln",
             "CO":"Kolumbien",
             "KM":"Komoren",
             "CG":"Kongo-Brazzaville",
             "CD":"Kongo-Kinshasa",
             "XK":"Kosovo",
             "HR":"Kroatien",
             "CU":"Kuba",
             "KW":"Kuwait",
             "LA":"Laos",
             "LS":"Lesotho",
             "LV":"Lettland",
             "LB":"Libanon",
             "LR":"Liberia",
             "LY":"Libyen",
             "LI":"Liechtenstein",
             "LT":"Litauen",
             "LU":"Luxemburg",
             "MG":"Madagaskar",
             "MW":"Malawi",
             "MY":"Malaysia",
             "MV":"Malediven",
             "ML":"Mali",
             "MT":"Malta",
             "MA":"Marokko",
             "MH":"Marshallinseln",
             "MQ":"Martinique",
             "MR":"Mauretanien",
             "MU":"Mauritius",
             "YT":"Mayotte",
             "MX":"Mexiko",
             "FM":"Mikronesien",
             "MC":"Monaco",
             "MN":"Mongolei",
             "ME":"Montenegro",
             "MS":"Montserrat",
             "MZ":"Mosambik",
             "MM":"Myanmar",
             "NA":"Namibia",
             "NR":"Nauru",
             "NP":"Nepal",
             "NC":"Neukaledonien",
             "NZ":"Neuseeland",
             "NI":"Nicaragua",
             "NL":"Niederlande",
             "NE":"Niger",
             "NG":"Nigeria",
             "NU":"Niue",
             "KP":"Nordkorea",
             "MP":"N\u00f6rdliche Marianen",
             "MK":"Nordmazedonien",
             "NF":"Norfolkinsel",
             "NO":"Norwegen",
             "OM":"Oman",
             "AT":"\u00d6sterreich",
             "PK":"Pakistan",
             "PS":"Pal\u00e4stinensische Autonomiegebiete",
             "PW":"Palau",
             "PA":"Panama",
             "PG":"Papua-Neuguinea",
             "PY":"Paraguay",
             "PE":"Peru",
             "PH":"Philippinen",
             "PN":"Pitcairninseln",
             "PL":"Polen",
             "PT":"Portugal",
             "XA":"Pseudo-Accents",
             "XB":"Pseudo-Bidi",
             "PR":"Puerto Rico",
             "MD":"Republik Moldau",
             "RE":"R\u00e9union",
             "RW":"Ruanda",
             "RO":"Rum\u00e4nien",
             "RU":"Russland",
             "SB":"Salomonen",
             "ZM":"Sambia",
             "WS":"Samoa",
             "SM":"San Marino",
             "ST":"S\u00e3o Tom\u00e9 und Pr\u00edncipe",
             "SA":"Saudi-Arabien",
             "SE":"Schweden",
             "CH":"Schweiz",
             "SN":"Senegal",
             "RS":"Serbien",
             "SC":"Seychellen",
             "SL":"Sierra Leone",
             "ZW":"Simbabwe",
             "SG":"Singapur",
             "SX":"Sint Maarten",
             "SK":"Slowakei",
             "SI":"Slowenien",
             "SO":"Somalia",
             "HK":"Sonderverwaltungsregion Hongkong",
             "MO":"Sonderverwaltungsregion Macau",
             "ES":"Spanien",
             "SJ":"Spitzbergen und Jan Mayen",
             "LK":"Sri Lanka",
             "BL":"St. Barth\u00e9lemy",
             "SH":"St. Helena",
             "KN":"St. Kitts und Nevis",
             "LC":"St. Lucia",
             "MF":"St. Martin",
             "PM":"St. Pierre und Miquelon",
             "VC":"St. Vincent und die Grenadinen",
             "ZA":"S\u00fcdafrika",
             "SD":"Sudan",
             "GS":"S\u00fcdgeorgien und die S\u00fcdlichen Sandwichinseln",
             "KR":"S\u00fcdkorea",
             "SS":"S\u00fcdsudan",
             "SR":"Suriname",
             "SZ":"Swasiland",
             "SY":"Syrien",
             "TJ":"Tadschikistan",
             "TW":"Taiwan",
             "TZ":"Tansania",
             "TH":"Thailand",
             "TL":"Timor-Leste",
             "TG":"Togo",
             "TK":"Tokelau",
             "TO":"Tonga",
             "TT":"Trinidad und Tobago",
             "TA":"Tristan da Cunha",
             "TD":"Tschad",
             "CZ":"Tschechien",
             "TN":"Tunesien",
             "TR":"T\u00fcrkei",
             "TM":"Turkmenistan",
             "TC":"Turks- und Caicosinseln",
             "TV":"Tuvalu",
             "UG":"Uganda",
             "UA":"Ukraine",
             "HU":"Ungarn",
             "UY":"Uruguay",
             "UZ":"Usbekistan",
             "VU":"Vanuatu",
             "VA":"Vatikanstadt",
             "VE":"Venezuela",
             "AE":"Vereinigte Arabische Emirate",
             "US":"Vereinigte Staaten",
             "GB":"Vereinigtes K\u00f6nigreich",
             "VN":"Vietnam",
             "WF":"Wallis und Futuna",
             "CX":"Weihnachtsinsel",
             "EH":"Westsahara",
             "CF":"Zentralafrikanische Republik",
             "CY":"Zypern"
          },
          'days': '&nbsp;<u><b>{{count}}</b></u>&nbsp; tag',
          'days_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; tags',
          'hours': '&nbsp;<u><b>{{count}}</b></u>&nbsp; stunde',
          'hours_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; stunden',
          'minutes': '&nbsp;<u><b>{{count}}</b></u>&nbsp; minute',
          'minutes_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; minuten',
          'error': 'Wir entschuldigen uns. Es ist ein Fehler aufgetreten',
          'welcomeConnectedUser': 'Willkommen <b>{{name}}</b>,Sie können mit Ihrer Reservierung fortfahren',
          'invalid_user_password': 'Ungültiger Benutzer oder Passwort'                                    
        },
        extra: {
          'daily_amount': '{{oneUnitPrice}}/Tag',
          'hourly_amount': '{{oneUnitPrice}}/Stunde',
          'unitary_amount': '{{oneUnitPrice}}',
          'total': 'Gesamt {{total}}'
        },        
        contact: {
          'form_errors': 'Das Formular enthält Fehler. Bitte überprüfen Sie sie',    
          'validate_captcha': 'Bitte validieren Sie Captcha',
          'validations': {
             'nameRequired': 'Name ist erforderlich',
             'surnameRequired': 'Nachname ist erforderlich',
             'emailRequired': 'E-Mail ist erforderlich',
             'phoneNumberRequired': 'Telefonnummer ist erforderlich',
             'commentsRequired': 'Nachricht ist erforderlich'
          },                
          'message_sent_successfully': "Nachricht erfolgreich gesendet",
          'error_sending_message': "Fehler beim Senden der Nachricht"
        },  
        calendar_selector: {
          'min_time': 'Die Abholung der vorherigen Reservierung erfolgt um {{time}} Uhr',
          'max_time': 'Die Lieferung der nächsten Reservierung erfolgt um {{time}} Uhr'
        },
        selector: {
          'select_pickup_place': 'Abholort auswählen',
          'select_return_place': 'Rückgabeort auswählen',
          'another_place': 'Exakte Adresse',
          'error_loading_data': 'Es tut uns leid. Beim Laden der Daten ist ein Fehler aufgetreten',          
          'validations': {
            'pickupPlaceRequired': 'Abholort erforderlich',
            'dateFromRequired': 'Datum erforderlich',
            'timeFromRequired': 'Erforderliche Zeit',
            'returnPlaceRequired': 'Rückgabeort erforderlich',
            'dateToRequired': 'Datum erforderlich',
            'timeToRequired': 'Erforderliche Zeit',            
            'sameDayTimeToGreaterTimeFrom': 'Muss größer als die Lieferung sein',
            'acceptAge': 'Sie müssen bestätigen, dass Sie über {{years}} Jahre alt sind',
            'promotionCodeInvalid': 'Ungültiger Promotion-Code'
          }
        },
        chooseProduct: {
          'loadShoppingCart': {
            'error': 'Entschuldigung Bei der Suche ist ein Fehler aufgetreten.'
          },
          'selectProduct': {
            'productNotSelected': 'Bitte wählen Sie das Fahrzeug aus.',
            'error': 'Entschuldigung Bei der Auswahl des Fahrzeugs ist ein Fehler aufgetreten.'
          },
          'selectUnits': 'Einheiten auswählen',          
          'units': '{{count}} Einheiten',
          'units_plural': '{{count}} Einheit',
          'max_duration': 'Die maximale Dauer beträgt {{duration}}',
          'min_duration': 'Die Mindestdauer beträgt {{duration}}'    
        },
        chooseExtras: {
          'loadShoppingCart': {
            'error': 'Entschuldigung Beim Laden der Informationen ist ein Fehler aufgetreten.'
          },
          'selectExtra': {
            'error': 'Entschuldigung Beim Aktualisieren des Extras ist ein Fehler aufgetreten.'
          },
          'deleteExtra': {
            'error': 'Entschuldigung Beim Löschen des Extra ist ein Fehler aufgetreten.'
          }                      
        },
        complete: {
          'loadShoppingCart': {
            'error': 'Entschuldigung Beim Laden der Informationen ist ein Fehler aufgetreten.'
          },
          'selectExtra': {
            'error': 'Entschuldigung Beim Aktualisieren des Extras ist ein Fehler aufgetreten.'
          },
          'deleteExtra': {
            'error': 'Entschuldigung Beim Löschen des Extra ist ein Fehler aufgetreten.'
          },
          'promotionCode': {
            'error': "Wir entschuldigen uns. Beim Überprüfen des Aktionscodes ist ein Fehler aufgetreten",
          },           
          'reservationForm': {
            'errors': 'Das Formular enthält Fehler. Bitte überprüfen Sie sie',
            'total_payment': 'Zahlen {{amount}}',
            'payment_button': 'Zahlen {{amount}}',  
            'booking_amount': 'Um Ihre Reservierung zu bestätigen, wird Ihre Karte mit <strong>{{amount}}</strong> belastet.',
            'select_country': 'Land auswählen',             
            'validations': {
              'fieldRequired': 'Dieses Feld wird benötigt',
              'passwordCheck': 'Das Passwort muss Großbuchstaben, Kleinbuchstaben, Ziffern und Symbole enthalten',
              'minLength': 'Mindestens {{minlength}} Zeichen',                 
              'customerNameRequired': 'Obligatorischer Kundenname',
              'customerSurnameRequired': 'Nachname des Kunden erforderlich',
              'customerEmailRequired': 'Obligatorische Kunden-E-Mail',
              'customerEmailInvalidFormat': 'Das E-Mail-Format ist ungültig',
              'customerEmailConfirmationRequired': 'Bestätigung der obligatorischen Kunden-E-Mail',
              'customerEmailConfirmationEqualsEmail': 'Bestätigung muss gleich E-Mail sein',
              'customerPhoneNumberRequired': 'Obligatorisches Kundentelefon',
              'customerPhoneNumberMinLength': 'Mindestlänge des Kundentelefons',
              'driverDateOfBirthRequired': 'Geburtsdatum des Pflichtfahrers',
              'numberOfAdultsRequired': 'Anzahl der Personen ist obligatorisch', 
              'conditionsReadRequired': 'Sie haben nicht markiert, dass Sie die Mietbedingungen gelesen haben',
              'privacyPolicyRequired': 'Bitte überprüfen Sie, ob Sie die Datenschutzbestimmungen gelesen haben',       
              'selectPaymentMethod': 'Bitte wählen Sie die Zahlungsart'              
            }
          },
          'createReservation': {
            'error': 'Entschuldigung Beim Registrieren der Reservierung ist ein Fehler aufgetreten.'
          }  
        },
        summary: {
          'loadReservation': {
            'error': 'Entschuldigung Beim Laden der Reservierung ist ein Fehler aufgetreten.'
          }
        },
        myReservation: {
          'select_country': 'Land auswählen',  
          'loadReservation': {
            'error': 'Entschuldigung Beim Laden der Reservierung ist ein Fehler aufgetreten.'
          },
          'pay': {
            'total_payment': 'Zahlen {{amount}}',
            'payment_button': 'Zahlen {{amount}}',  
            'paymentMethodRequired': 'Bitte wählen Sie die Zahlungsart.',
            'booking_amount': 'Um Ihre Reservierung zu bestätigen, wird Ihre Karte mit <strong>{{amount}}</strong> belastet.',
            'pending_amount': 'Die Zahlung des ausstehenden Betrags von <strong>{{amount}}</strong> ist zulässig'
          },
          'updateReservation': {
            'success': 'Reservierung erfolgreich aktualisiert',
            'error': 'Wir entschuldigen uns. Beim Aktualisieren der Reservierung ist ein Fehler aufgetreten'
          }          
        },
        selectorWizard: {
           'pickupPlace': 'Sammelpunkt',
           'dateFrom': 'Abholtermin',
           'timeFrom': 'Sammelzeit',
           'returnPlace': 'Rückgabepunkt',
           'dateTo': 'Rückflugdatum',
           'timeTo': 'Zeit zurück drehen'              
        },    
        activities: {
          common: {
            'errorLoadingData': 'Wir entschuldigen uns. Beim Laden der Informationen ist ein Fehler aufgetreten',
            'errorUpdatingData': 'Wir entschuldigen uns. Beim Aktualisieren der Daten ist ein Fehler aufgetreten',
            'dataUpdateOk': 'Daten erfolgreich aktualisiert'
          },
          calendarWidget: {
             'selectTickets': 'Sie haben keine Tickets ausgewählt',
             'fullPlaces': 'Volle Kapazität',
             'fewPlacesWarning': 'Letzte Plätze',
             'fewNoPlacesWarning': 'Letzte Stunden'                   
          },
          multipleDates: {
             'selectDate': 'Bitte wählen Sie das Datum'
          },
          checkout: {
             'errorCreatingOrder': 'Entschuldigung Beim Registrieren der Reservierung ist ein Fehler aufgetreten.',
             'errors': 'Das Formular enthält Fehler. Bitte überprüfen Sie sie',                 
             'validations': {
               'customerNameRequired': 'Obligatorischer Kundenname',
               'customerSurnameRequired': 'Nachname des Kunden erforderlich',
               'customerEmailRequired': 'Obligatorische Kunden-E-Mail',
               'customerEmailInvalidFormat': 'Das E-Mail-Format ist ungültig',
               'customerEmailConfirmationRequired': 'Bestätigung der obligatorischen Kunden-E-Mail',
               'customerEmailConfirmationEqualsEmail': 'Bestätigung muss gleich E-Mail sein',
               'customerPhoneNumberRequired': 'Obligatorisches Kundentelefon',
               'customerPhoneNumberMinLength': 'Mindestlänge des Kundentelefons',
               'conditionsReadRequired': 'Sie haben nicht markiert, dass Sie die Mietbedingungen gelesen haben',
               'privacyPolicyRequired': 'Bitte überprüfen Sie, ob Sie die Datenschutzbestimmungen gelesen haben',       
               'selectPaymentMethod': 'Bitte wählen Sie die Zahlungsart' 
             }
          },
          payment: {
             'total_payment': 'Zahlen {{amount}}',
             'payment_button': 'Zahlen {{amount}}',
             'deposit_amount': 'Um Ihre Reservierung zu bestätigen, wird Ihre Karte mit <strong>{{amount}}</strong> belastet.',
             'pending_amount': 'Die Zahlung des ausstehenden Betrags von <strong>{{amount}}</strong> ist zulässig',     
             'errors': 'Das Formular enthält Fehler. Bitte überprüfen Sie sie',
             'paymentMethodNotSelected': 'Bitte wählen Sie die Zahlungsart'
          },
          myReservation: {
             'cancelReservationConfirm': 'Möchten Sie die Reservierung stornieren?'
          }

        }
      }
  	},
  	fr: {
      translation: {
        common: {
          'countries': {
             "AF":"Afghanistan",
             "ZA":"Afrique du Sud",
             "AL":"Albanie",
             "DZ":"Alg\u00e9rie",
             "DE":"Allemagne",
             "AD":"Andorre",
             "AO":"Angola",
             "AI":"Anguilla",
             "AQ":"Antarctique",
             "AG":"Antigua-et-Barbuda",
             "SA":"Arabie saoudite",
             "AR":"Argentine",
             "AM":"Arm\u00e9nie",
             "AW":"Aruba",
             "AU":"Australie",
             "AT":"Autriche",
             "AZ":"Azerba\u00efdjan",
             "BS":"Bahamas",
             "BH":"Bahre\u00efn",
             "BD":"Bangladesh",
             "BB":"Barbade",
             "BE":"Belgique",
             "BZ":"Belize",
             "BJ":"B\u00e9nin",
             "BM":"Bermudes",
             "BT":"Bhoutan",
             "BY":"Bi\u00e9lorussie",
             "BO":"Bolivie",
             "BA":"Bosnie-Herz\u00e9govine",
             "BW":"Botswana",
             "BR":"Br\u00e9sil",
             "BN":"Brun\u00e9i Darussalam",
             "BG":"Bulgarie",
             "BF":"Burkina Faso",
             "BI":"Burundi",
             "KH":"Cambodge",
             "CM":"Cameroun",
             "CA":"Canada",
             "CV":"Cap-Vert",
             "EA":"Ceuta et Melilla",
             "CL":"Chili",
             "CN":"Chine",
             "CY":"Chypre",
             "CO":"Colombie",
             "KM":"Comores",
             "CG":"Congo-Brazzaville",
             "CD":"Congo-Kinshasa",
             "KP":"Cor\u00e9e du Nord",
             "KR":"Cor\u00e9e du Sud",
             "CR":"Costa Rica",
             "CI":"C\u00f4te d\u2019Ivoire",
             "HR":"Croatie",
             "CU":"Cuba",
             "CW":"Cura\u00e7ao",
             "DK":"Danemark",
             "DG":"Diego Garcia",
             "DJ":"Djibouti",
             "DM":"Dominique",
             "EG":"\u00c9gypte",
             "AE":"\u00c9mirats arabes unis",
             "EC":"\u00c9quateur",
             "ER":"\u00c9rythr\u00e9e",
             "ES":"Espagne",
             "EE":"Estonie",
             "SZ":"Eswatini",
             "VA":"\u00c9tat de la Cit\u00e9 du Vatican",
             "FM":"\u00c9tats f\u00e9d\u00e9r\u00e9s de Micron\u00e9sie",
             "US":"\u00c9tats-Unis",
             "ET":"\u00c9thiopie",
             "FJ":"Fidji",
             "FI":"Finlande",
             "FR":"France",
             "GA":"Gabon",
             "GM":"Gambie",
             "GE":"G\u00e9orgie",
             "GS":"G\u00e9orgie du Sud et \u00eeles Sandwich du Sud",
             "GH":"Ghana",
             "GI":"Gibraltar",
             "GR":"Gr\u00e8ce",
             "GD":"Grenade",
             "GL":"Groenland",
             "GP":"Guadeloupe",
             "GU":"Guam",
             "GT":"Guatemala",
             "GG":"Guernesey",
             "GN":"Guin\u00e9e",
             "GQ":"Guin\u00e9e \u00e9quatoriale",
             "GW":"Guin\u00e9e-Bissau",
             "GY":"Guyana",
             "GF":"Guyane fran\u00e7aise",
             "HT":"Ha\u00efti",
             "HN":"Honduras",
             "HU":"Hongrie",
             "CX":"\u00cele Christmas",
             "AC":"\u00cele de l\u2019Ascension",
             "IM":"\u00cele de Man",
             "NF":"\u00cele Norfolk",
             "AX":"\u00celes \u00c5land",
             "KY":"\u00celes Ca\u00efmans",
             "IC":"\u00celes Canaries",
             "CC":"\u00celes Cocos",
             "CK":"\u00celes Cook",
             "FO":"\u00celes F\u00e9ro\u00e9",
             "FK":"\u00celes Malouines",
             "MP":"\u00celes Mariannes du Nord",
             "MH":"\u00celes Marshall",
             "UM":"\u00celes mineures \u00e9loign\u00e9es des \u00c9tats-Unis",
             "PN":"\u00celes Pitcairn",
             "SB":"\u00celes Salomon",
             "TC":"\u00celes Turques-et-Ca\u00efques",
             "VG":"\u00celes Vierges britanniques",
             "VI":"\u00celes Vierges des \u00c9tats-Unis",
             "IN":"Inde",
             "ID":"Indon\u00e9sie",
             "IQ":"Irak",
             "IR":"Iran",
             "IE":"Irlande",
             "IS":"Islande",
             "IL":"Isra\u00ebl",
             "IT":"Italie",
             "JM":"Jama\u00efque",
             "JP":"Japon",
             "JE":"Jersey",
             "JO":"Jordanie",
             "KZ":"Kazakhstan",
             "KE":"Kenya",
             "KG":"Kirghizistan",
             "KI":"Kiribati",
             "XK":"Kosovo",
             "KW":"Kowe\u00eft",
             "RE":"La R\u00e9union",
             "LA":"Laos",
             "LS":"Lesotho",
             "LV":"Lettonie",
             "LB":"Liban",
             "LR":"Lib\u00e9ria",
             "LY":"Libye",
             "LI":"Liechtenstein",
             "LT":"Lituanie",
             "LU":"Luxembourg",
             "MK":"Mac\u00e9doine",
             "MG":"Madagascar",
             "MY":"Malaisie",
             "MW":"Malawi",
             "MV":"Maldives",
             "ML":"Mali",
             "MT":"Malte",
             "MA":"Maroc",
             "MQ":"Martinique",
             "MU":"Maurice",
             "MR":"Mauritanie",
             "YT":"Mayotte",
             "MX":"Mexique",
             "MD":"Moldavie",
             "MC":"Monaco",
             "MN":"Mongolie",
             "ME":"Mont\u00e9n\u00e9gro",
             "MS":"Montserrat",
             "MZ":"Mozambique",
             "MM":"Myanmar (Birmanie)",
             "NA":"Namibie",
             "NR":"Nauru",
             "NP":"N\u00e9pal",
             "NI":"Nicaragua",
             "NE":"Niger",
             "NG":"Nig\u00e9ria",
             "NU":"Niue",
             "NO":"Norv\u00e8ge",
             "NC":"Nouvelle-Cal\u00e9donie",
             "NZ":"Nouvelle-Z\u00e9lande",
             "OM":"Oman",
             "UG":"Ouganda",
             "UZ":"Ouzb\u00e9kistan",
             "PK":"Pakistan",
             "PW":"Palaos",
             "PA":"Panama",
             "PG":"Papouasie-Nouvelle-Guin\u00e9e",
             "PY":"Paraguay",
             "NL":"Pays-Bas",
             "BQ":"Pays-Bas carib\u00e9ens",
             "PE":"P\u00e9rou",
             "PH":"Philippines",
             "PL":"Pologne",
             "PF":"Polyn\u00e9sie fran\u00e7aise",
             "PR":"Porto Rico",
             "PT":"Portugal",
             "XA":"pseudo-accents",
             "XB":"pseudo-bidi",
             "QA":"Qatar",
             "HK":"R.A.S. chinoise de Hong Kong",
             "MO":"R.A.S. chinoise de Macao",
             "CF":"R\u00e9publique centrafricaine",
             "DO":"R\u00e9publique dominicaine",
             "RO":"Roumanie",
             "GB":"Royaume-Uni",
             "RU":"Russie",
             "RW":"Rwanda",
             "EH":"Sahara occidental",
             "BL":"Saint-Barth\u00e9lemy",
             "KN":"Saint-Christophe-et-Ni\u00e9v\u00e8s",
             "SM":"Saint-Marin",
             "MF":"Saint-Martin",
             "SX":"Saint-Martin (partie n\u00e9erlandaise)",
             "PM":"Saint-Pierre-et-Miquelon",
             "VC":"Saint-Vincent-et-les-Grenadines",
             "SH":"Sainte-H\u00e9l\u00e8ne",
             "LC":"Sainte-Lucie",
             "SV":"Salvador",
             "WS":"Samoa",
             "AS":"Samoa am\u00e9ricaines",
             "ST":"Sao Tom\u00e9-et-Principe",
             "SN":"S\u00e9n\u00e9gal",
             "RS":"Serbie",
             "SC":"Seychelles",
             "SL":"Sierra Leone",
             "SG":"Singapour",
             "SK":"Slovaquie",
             "SI":"Slov\u00e9nie",
             "SO":"Somalie",
             "SD":"Soudan",
             "SS":"Soudan du Sud",
             "LK":"Sri Lanka",
             "SE":"Su\u00e8de",
             "CH":"Suisse",
             "SR":"Suriname",
             "SJ":"Svalbard et Jan Mayen",
             "SY":"Syrie",
             "TJ":"Tadjikistan",
             "TW":"Ta\u00efwan",
             "TZ":"Tanzanie",
             "TD":"Tchad",
             "CZ":"Tch\u00e9quie",
             "TF":"Terres australes fran\u00e7aises",
             "IO":"Territoire britannique de l\u2019oc\u00e9an Indien",
             "PS":"Territoires palestiniens",
             "TH":"Tha\u00eflande",
             "TL":"Timor oriental",
             "TG":"Togo",
             "TK":"Tokelau",
             "TO":"Tonga",
             "TT":"Trinit\u00e9-et-Tobago",
             "TA":"Tristan da Cunha",
             "TN":"Tunisie",
             "TM":"Turkm\u00e9nistan",
             "TR":"Turquie",
             "TV":"Tuvalu",
             "UA":"Ukraine",
             "UY":"Uruguay",
             "VU":"Vanuatu",
             "VE":"Venezuela",
             "VN":"Vietnam",
             "WF":"Wallis-et-Futuna",
             "YE":"Y\u00e9men",
             "ZM":"Zambie",
             "ZW":"Zimbabwe"
          },
          'days': '&nbsp;<u><b>{{count}}</b></u>&nbsp; jour',
          'days_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; jours',
          'hours': '&nbsp;<u><b>{{count}}</b></u>&nbsp; heure',
          'hours_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; heures',
          'minutes': '&nbsp;<u><b>{{count}}</b></u>&nbsp; minute',
          'minutes_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; minutes',
          'error': "Nous sommes désolés. Il y a eu une erreur dans le processus",
          'welcomeConnectedUser': 'Bienvenue <b>{{name}}</b>, vous pouvez procéder à votre réservation',
          'invalid_user_password': 'Utilisateur ou mot de passe invalide'                                     
        },
        extra: {
          'daily_amount': '{{oneUnitPrice}}/jour',
          'hourly_amount': '{{oneUnitPrice}}/heure',
          'unitary_amount': '{{oneUnitPrice}}',
          'total': 'Total {{total}}'
        },          
        contact: {
          'form_errors': 'Veuillez vérifier les champs marqués en rouge',
          'validate_captcha': 'Veuillez valider le captcha',          
          'validations': {
             'nameRequired': 'Champ obligatoire',
             'surnameRequired': 'Champ obligatoire',
             'emailRequired': 'Champ obligatoire',
             'phoneNumberRequired': 'Champ obligatoire',
             'commentsRequired': 'Champ obligatoire'
          },
          'message_sent_successfully': 'Message envoyé avec succès',
          'error_sending_message': "Erreur lors de l'envoi du message"
        },
        calendar_selector: {
          'min_time': 'La collecte de la réservation précédente est à {{time}}',
          'max_time': 'La livraison de la prochaine réservation est à {{time}}'
        },
        selector: {
          'select_pickup_place': 'Sélectionnez un lieu de prise en charge',
          'select_return_place': 'Sélectionnez le lieu de retour',
          'another_place': 'Adresse exacte',
          'error_loading_data': "Nous sommes désolés. Une erreur s'est produite lors du chargement des données",
          'validations': {
            'pickupPlaceRequired': 'Champ obligatoire',
            'dateFromRequired': 'Champ obligatoire',
            'timeFromRequired': 'Champ obligatoire',
            'returnPlaceRequired': 'Champ obligatoire',
            'dateToRequired': 'Champ obligatoire',
            'timeToRequired': 'Champ obligatoire',
            'sameDayTimeToGreaterTimeFrom': 'Doit être postérieur au heure de livraison',
            'acceptAge': 'Vous devez confirmer que vous avez plus de {{years}} ans',
            'promotionCodeInvalid': "Le code promotionnel n'est pas valide"
          }
        },
        chooseProduct: {
          'loadShoppingCart': {
            'error': "Nous sommes désolés. Une erreur s'est produite lors de la recherche"
          },
          'selectProduct': {
            'productNotSelected': 'Veuillez sélectionner le véhicule.',
            'error': "Nous sommes désolés. Une erreur s'est produite lors de la sélection du véhicule"
          },
          'selectUnits': 'Sélectionnez les unités',          
          'units': '{{count}} unité',
          'units_plural': '{{count}} unités',
          'max_duration': 'La durée maximale est de {{duration}}',
          'min_duration': 'La durée minimale est de {{duration}}'    
        },
        chooseExtras: {
          'loadShoppingCart': {
            'error': "Nous sommes désolés. Une erreur s'est produite lors du chargement des données."
          },
          'selectExtra': {
            'error': "Nous sommes désolés. Une erreur s'est produite lors de la mise à jour du supplément."
          },
          'deleteExtra': {
            'error': "Nous sommes désolés. Une erreur s'est produite lors de la suppression du supplément."
          }                       
        },
        complete: {
          'loadShoppingCart': {
            'error': "Nous sommes désolés. Une erreur s'est produite lors du chargement des données."
          },
          'selectExtra': {
            'error': "Nous sommes désolés. Une erreur s'est produite lors de la mise à jour du supplément."
          },
          'deleteExtra': {
            'error': "Nous sommes désolés. Une erreur s'est produite lors de la suppression du supplément."
          },
          'promotionCode': {
            'error': "Nous sommes désolés. Une erreur s'est produite lors de la vérification du code promotionnel",
          },            
          'reservationForm': {
            'select_country': 'Choisissez le pays',            
            'errors': 'Veuillez vérifier les champs marqués en rouge',
            'total_payment': 'Payer {{amount}}',
            'payment_button': 'Payer {{amount}}', 
            'booking_amount': 'Pour confirmer votre réservation un paiement de <strong>{{amount}}</strong> est demandé',
            'validations': {
              'fieldRequired': 'Champ obligatoire',  
              'passwordCheck': 'Le mot de passe doit contenir une lettre majuscule, une lettre minuscule, un chiffre et un symbole ',
              'minLength': 'Minimum {{minlength}} caractères',                   
              'customerNameRequired': 'Champ obligatoire',
              'customerSurnameRequired': 'Champ obligatoire',
              'customerEmailRequired': 'Champ obligatoire',
              'customerEmailInvalidFormat': 'Saisissez une adresse e-mail valide',
              'customerEmailConfirmationRequired': 'Champ obligatoire',
              'customerEmailConfirmationEqualsEmail': "La confirmation de l'e-mail du client doit être égale à l'e-mail",
              'customerPhoneNumberRequired': 'Champ obligatoire',
              'customerPhoneNumberMinLength': 'Saisissez un numéro de téléphone valide',
              'driverDateOfBirthRequired': 'Champ obligatoire',
              'numberOfAdultsRequired': 'Champ obligatoire',
              'conditionsReadRequired': 'Veuillez vérifier que vous avez lu les termes et conditions',
              'privacyPolicyRequired': 'Veuillez vérifier que vous avez lu la politique de confidentialité',                    
              'selectPaymentMethod': 'Veuillez sélectionner le mode de paiement'                            
            }
          },
          'createReservation': {
            'error': "Nous sommes désolés. Une erreur s'est produite lors de la création de la réservation."
          }  
        },
        summary: {
          'loadReservation': {
            'error': "Nous sommes désolés. Une erreur s'est produite lors du chargement de la réservation."
          }
        },
        myReservation: {
          'select_country': 'Choisissez le pays',              
          'loadReservation': {
            'error': "Nous sommes désolés. Une erreur s'est produite lors du chargement de la réservation."
          },
          'pay': {
            'total_payment': 'Payer {{amount}}',
            'payment_button': 'Payer {{amount}}',             
            'paymentMethodRequired': 'Veuillez sélectionner le mode de paiement.',
            'booking_amount': 'Pour confirmer votre réservation un paiement de <strong>{{amount}}</strong> est demandé',
            'pending_amount': 'Le paiement du montant en attente <strong>{{amount}}</strong> est autorisé'
          },
          'updateReservation': {
            'success': 'Réservation mise à jour avec succès',
            'error': "Nous sommes désolés. Une erreur s'est produite lors de la mise à jour de la réservation"
          }          
        },
        selectorWizard: {
           'pickupPlace': 'Point de collecte',
           'dateFrom': 'Date de collecte',
           'timeFrom': 'Heure de collecte',
           'returnPlace': 'Point de retour',
           'dateTo': 'Date de retour',
           'timeTo': 'Heure de retour'              
        },
        activities: {
          common: {
            'errorLoadingData': "Nous sommes désolés. Une erreur s'est produite lors du chargement des informations",
            'errorUpdatingData': "Nous sommes désolés. Une erreur s'est produite lors de la mise à jour des données",
             'dataUpdateOk': "Les données ont été mises à jour avec succès"
          },
          calendarWidget: {
             'selectTickets': "Vous n'avez sélectionné aucun billet",
             'fullPlaces': 'Pleine capacité',
             'fewPlacesWarning': 'Dernières places',
             'fewNoPlacesWarning': 'Dernières heures'                   
          },
          multipleDates: {
             'selectDate': "Veuillez sélectionner la date"
          },
          checkout: {
             'errorCreatingOrder': "Nous sommes désolés. Une erreur s'est produite lors de la mise à jour de la réservation",
             'errors': "Veuillez vérifier les champs marqués en rouge",                 
             'validations': {
               'customerNameRequired': 'Champ obligatoire',
               'customerSurnameRequired': 'Champ obligatoire',
               'customerEmailRequired': 'Champ obligatoire',
               'customerEmailInvalidFormat': 'Saisissez une adresse e-mail valide',
               'customerEmailConfirmationRequired': 'Champ obligatoire',
               'customerEmailConfirmationEqualsEmail': "La confirmation de l'e-mail du client doit être égale à l'e-mail",
               'customerPhoneNumberRequired': 'Champ obligatoire',
               'customerPhoneNumberMinLength': 'Saisissez un numéro de téléphone valide',
               'conditionsReadRequired': 'Veuillez vérifier que vous avez lu les termes et conditions',
               'privacyPolicyRequired': 'Veuillez vérifier que vous avez lu la politique de confidentialité',                    
               'selectPaymentMethod': 'Veuillez sélectionner le mode de paiement'    
             }
          },
          payment: {
             'total_payment': 'Payer {{amount}}',
             'payment_button': 'Payer {{amount}}',
             'deposit_amount': 'Pour confirmer votre réservation un paiement de <strong>{{amount}}</strong> est demandé',
             'pending_amount': 'Le paiement du montant en attente <strong>{{amount}}</strong> est autorisé',
             'errors': 'Veuillez vérifier les champs marqués en rouge',
             'paymentMethodNotSelected': 'Veuillez sélectionner le mode de paiement'
          },
          myReservation: {
             'cancelReservationConfirm': 'Voulez-vous annuler la réservation?'
          }          
        }
      }
  	},
  	it: {
      translation: {
        common: {
          'countries': {
               "AF":"Afghanistan",
               "AL":"Albania",
               "DZ":"Algeria",
               "UM":"Altre isole americane del Pacifico",
               "AD":"Andorra",
               "AO":"Angola",
               "AI":"Anguilla",
               "AQ":"Antartide",
               "AG":"Antigua e Barbuda",
               "SA":"Arabia Saudita",
               "AR":"Argentina",
               "AM":"Armenia",
               "AW":"Aruba",
               "AU":"Australia",
               "AT":"Austria",
               "AZ":"Azerbaigian",
               "BS":"Bahamas",
               "BH":"Bahrein",
               "BD":"Bangladesh",
               "BB":"Barbados",
               "BE":"Belgio",
               "BZ":"Belize",
               "BJ":"Benin",
               "BM":"Bermuda",
               "BT":"Bhutan",
               "BY":"Bielorussia",
               "BO":"Bolivia",
               "BA":"Bosnia ed Erzegovina",
               "BW":"Botswana",
               "BR":"Brasile",
               "BN":"Brunei",
               "BG":"Bulgaria",
               "BF":"Burkina Faso",
               "BI":"Burundi",
               "KH":"Cambogia",
               "CM":"Camerun",
               "CA":"Canada",
               "CV":"Capo Verde",
               "BQ":"Caraibi olandesi",
               "CZ":"Cechia",
               "EA":"Ceuta e Melilla",
               "TD":"Ciad",
               "CL":"Cile",
               "CN":"Cina",
               "CY":"Cipro",
               "VA":"Citt\u00e0 del Vaticano",
               "CO":"Colombia",
               "KM":"Comore",
               "CD":"Congo - Kinshasa",
               "CG":"Congo-Brazzaville",
               "KP":"Corea del Nord",
               "KR":"Corea del Sud",
               "CI":"Costa d\u2019Avorio",
               "CR":"Costa Rica",
               "HR":"Croazia",
               "CU":"Cuba",
               "CW":"Cura\u00e7ao",
               "DK":"Danimarca",
               "DG":"Diego Garcia",
               "DM":"Dominica",
               "EC":"Ecuador",
               "EG":"Egitto",
               "SV":"El Salvador",
               "AE":"Emirati Arabi Uniti",
               "ER":"Eritrea",
               "EE":"Estonia",
               "ET":"Etiopia",
               "FJ":"Figi",
               "PH":"Filippine",
               "FI":"Finlandia",
               "FR":"Francia",
               "GA":"Gabon",
               "GM":"Gambia",
               "GE":"Georgia",
               "GS":"Georgia del Sud e Sandwich australi",
               "DE":"Germania",
               "GH":"Ghana",
               "JM":"Giamaica",
               "JP":"Giappone",
               "GI":"Gibilterra",
               "DJ":"Gibuti",
               "JO":"Giordania",
               "GR":"Grecia",
               "GD":"Grenada",
               "GL":"Groenlandia",
               "GP":"Guadalupa",
               "GU":"Guam",
               "GT":"Guatemala",
               "GG":"Guernsey",
               "GN":"Guinea",
               "GQ":"Guinea Equatoriale",
               "GW":"Guinea-Bissau",
               "GY":"Guyana",
               "GF":"Guyana francese",
               "HT":"Haiti",
               "HN":"Honduras",
               "IN":"India",
               "ID":"Indonesia",
               "IR":"Iran",
               "IQ":"Iraq",
               "IE":"Irlanda",
               "IS":"Islanda",
               "AC":"Isola Ascensione",
               "CX":"Isola Christmas",
               "IM":"Isola di Man",
               "NF":"Isola Norfolk",
               "AX":"Isole \u00c5land",
               "IC":"Isole Canarie",
               "KY":"Isole Cayman",
               "CC":"Isole Cocos (Keeling)",
               "CK":"Isole Cook",
               "FO":"Isole F\u00e6r \u00d8er",
               "FK":"Isole Falkland",
               "MP":"Isole Marianne settentrionali",
               "MH":"Isole Marshall",
               "PN":"Isole Pitcairn",
               "SB":"Isole Salomone",
               "TC":"Isole Turks e Caicos",
               "VI":"Isole Vergini Americane",
               "VG":"Isole Vergini Britanniche",
               "IL":"Israele",
               "IT":"Italia",
               "JE":"Jersey",
               "KZ":"Kazakistan",
               "KE":"Kenya",
               "KG":"Kirghizistan",
               "KI":"Kiribati",
               "XK":"Kosovo",
               "KW":"Kuwait",
               "LA":"Laos",
               "LS":"Lesotho",
               "LV":"Lettonia",
               "LB":"Libano",
               "LR":"Liberia",
               "LY":"Libia",
               "LI":"Liechtenstein",
               "LT":"Lituania",
               "LU":"Lussemburgo",
               "MK":"Macedonia del Nord",
               "MG":"Madagascar",
               "MW":"Malawi",
               "MY":"Malaysia",
               "MV":"Maldive",
               "ML":"Mali",
               "MT":"Malta",
               "MA":"Marocco",
               "MQ":"Martinica",
               "MR":"Mauritania",
               "MU":"Mauritius",
               "YT":"Mayotte",
               "MX":"Messico",
               "FM":"Micronesia",
               "MD":"Moldavia",
               "MC":"Monaco",
               "MN":"Mongolia",
               "ME":"Montenegro",
               "MS":"Montserrat",
               "MZ":"Mozambico",
               "MM":"Myanmar (Birmania)",
               "NA":"Namibia",
               "NR":"Nauru",
               "NP":"Nepal",
               "NI":"Nicaragua",
               "NE":"Niger",
               "NG":"Nigeria",
               "NU":"Niue",
               "NO":"Norvegia",
               "NC":"Nuova Caledonia",
               "NZ":"Nuova Zelanda",
               "OM":"Oman",
               "NL":"Paesi Bassi",
               "PK":"Pakistan",
               "PW":"Palau",
               "PA":"Panam\u00e1",
               "PG":"Papua Nuova Guinea",
               "PY":"Paraguay",
               "PE":"Per\u00f9",
               "PF":"Polinesia francese",
               "PL":"Polonia",
               "PT":"Portogallo",
               "PR":"Portorico",
               "XA":"pseudo-accenti",
               "XB":"pseudo-bidi",
               "QA":"Qatar",
               "HK":"RAS di Hong Kong",
               "MO":"RAS di Macao",
               "GB":"Regno Unito",
               "CF":"Repubblica Centrafricana",
               "DO":"Repubblica Dominicana",
               "RE":"Riunione",
               "RO":"Romania",
               "RW":"Ruanda",
               "RU":"Russia",
               "EH":"Sahara occidentale",
               "KN":"Saint Kitts e Nevis",
               "LC":"Saint Lucia",
               "MF":"Saint Martin",
               "VC":"Saint Vincent e Grenadine",
               "BL":"Saint-Barth\u00e9lemy",
               "PM":"Saint-Pierre e Miquelon",
               "WS":"Samoa",
               "AS":"Samoa americane",
               "SM":"San Marino",
               "SH":"Sant\u2019Elena",
               "ST":"S\u00e3o Tom\u00e9 e Pr\u00edncipe",
               "SN":"Senegal",
               "RS":"Serbia",
               "SC":"Seychelles",
               "SL":"Sierra Leone",
               "SG":"Singapore",
               "SX":"Sint Maarten",
               "SY":"Siria",
               "SK":"Slovacchia",
               "SI":"Slovenia",
               "SO":"Somalia",
               "ES":"Spagna",
               "LK":"Sri Lanka",
               "US":"Stati Uniti",
               "SS":"Sud Sudan",
               "ZA":"Sudafrica",
               "SD":"Sudan",
               "SR":"Suriname",
               "SJ":"Svalbard e Jan Mayen",
               "SE":"Svezia",
               "CH":"Svizzera",
               "SZ":"Swaziland",
               "TJ":"Tagikistan",
               "TW":"Taiwan",
               "TZ":"Tanzania",
               "TF":"Terre australi francesi",
               "PS":"Territori palestinesi",
               "IO":"Territorio britannico dell\u2019Oceano Indiano",
               "TH":"Thailandia",
               "TL":"Timor Est",
               "TG":"Togo",
               "TK":"Tokelau",
               "TO":"Tonga",
               "TT":"Trinidad e Tobago",
               "TA":"Tristan da Cunha",
               "TN":"Tunisia",
               "TR":"Turchia",
               "TM":"Turkmenistan",
               "TV":"Tuvalu",
               "UA":"Ucraina",
               "UG":"Uganda",
               "HU":"Ungheria",
               "UY":"Uruguay",
               "UZ":"Uzbekistan",
               "VU":"Vanuatu",
               "VE":"Venezuela",
               "VN":"Vietnam",
               "WF":"Wallis e Futuna",
               "YE":"Yemen",
               "ZM":"Zambia",
               "ZW":"Zimbabwe"
          },
          'days': '&nbsp;<u><b>{{count}}</b></u>&nbsp; giorno',
          'days_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; giorni',
          'hours': '&nbsp;<u><b>{{count}}</b></u>&nbsp; ora',
          'hours_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; ore',
          'minutes': '&nbsp;<u><b>{{count}}</b></u>&nbsp; minuto',
          'minutes_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp; minuti',
          'error': "Siamo spiacenti. Si è verificato un errore nel processo",
          'welcomeConnectedUser': 'Benvenuto <b>{{name}}</b>, puoi procedere con la prenotazione',
          'invalid_user_password': 'Utente o password non validi'                                            
        },
        extra: {
          'daily_amount': '{{oneUnitPrice}}/giorno',
          'hourly_amount': '{{oneUnitPrice}}/ora',
          'unitary_amount': '{{oneUnitPrice}}',
          'total': 'Totale {{total}}'
        },     
        contact: {
          'form_errors': 'Per favore, controlla gli errori',
          'validate_captcha': 'Per favore, convalida il captcha',
          'validations': {
             'nameRequired': 'Il nome è obbligatorio',
             'surnameRequired': 'Il cognome è obbligatorio',
             'emailRequired': "L'email è richiesta",
             'phoneNumberRequired': "Il numero di telefono è richiesto",
             'commentsRequired': 'Il messaggio è richiesto'
          },
          'message_sent_successfully': 'Messaggio inviato con successo',
          'error_sending_message': "Errore durante l'invio del messaggio"
        },
        calendar_selector: {
          'min_time': 'La raccolta della prenotazione precedente è alle  {{time}}',
          'max_time': 'La consegna della prossima prenotazione è alle {{time}}'
        },  
        selector: {
          'select_pickup_place': 'Seleziona il luogo di ritiro',
          'select_return_place': 'Seleziona luogo di ritorno',
          'another_place': 'Indirizzo esatto',
          'error_loading_data': 'Ci dispiace. Si è verificato un errore durante il caricamento dei dati',          
          'validations': {
            'pickupPlaceRequired': 'Luogo di ritiro richiesto',
            'dateFromRequired': 'Data richiesta',
            'timeFromRequired': 'Tempo richiesto',
            'returnPlaceRequired': 'Luogo di ritorno richiesto',
            'dateToRequired': 'Data richiesta',
            'timeToRequired': 'Tempo richiesto',            
            'sameDayTimeToGreaterTimeFrom': 'Deve essere maggiore della consegna',
            'acceptAge': 'Devi confermare di avere più di {{years}} anni',
            'promotionCodeInvalid': 'Codice promozione non valido'  
          }
        },
        chooseProduct: {
          'loadShoppingCart': {
            'error': 'Scusi. Si è verificato un errore durante lesecuzione della ricerca.'
          },
          'selectProduct': {
            'productNotSelected': 'Seleziona il veicolo.',
            'error': 'Scusi. Si è verificato un errore durante la selezione del veicolo.'
          },
          'selectUnits': 'Seleziona unità',          
          'units': '{{count}} unità',
          'units_plural': '{{count}} unità',
          'max_duration': 'La durata massima è di {{duration}}',
          'min_duration': 'La durata minima è di {{duration}}'    
        },
        chooseExtras: {
          'loadShoppingCart': {
            'error': 'Scusi. Si è verificato un errore durante il caricamento delle informazioni.'
          },
          'selectExtra': {
            'error': 'Scusi. Si è verificato un errore durante laggiornamento del supplemento.'
          },
          'deleteExtra': {
            'error': 'Scusi. Si è verificato un errore durante leliminazione del supplemento.'
          }                     
        },
        complete: {
          'loadShoppingCart': {
            'error': 'Scusi. Si è verificato un errore durante il caricamento delle informazioni.'
          },
          'selectExtra': {
            'error': 'Scusi. Si è verificato un errore durante laggiornamento del supplemento.'
          },
          'deleteExtra': {
            'error': 'Scusi. Si è verificato un errore durante leliminazione del supplemento.'
          },
          'promotionCode': {
            'invalid': "Scusi. Si è verificato un errore durante il controllo del codice promozione",
          },           
          'reservationForm': {
            'errors': 'Il modulo contiene errori. Per favore, controllali',
            'total_payment': 'Paga {{amount}}',
            'payment_button': 'Paga {{amount}}', 
            'booking_amount': 'Per confermare la prenotazione verrà addebitato un importo di <strong>{{amount}} </strong> sulla tua carta.',
            'select_country': 'Seleziona il paese',  
            'validations': {
              'fieldRequired': 'Questo campo è obbligatorio',  
              'passwordCheck': 'La password deve contenere una lettera maiuscola, una lettera minuscola, una cifra e un simbolo', 
              'minLength': 'Minimo {{minlength}} caratteri',
              'customerNameRequired': 'Nome cliente obbligatorio',
              'customerSurnameRequired': 'Cognome del cliente richiesto',
              'customerEmailRequired': 'Email cliente obbligatoria',
              'customerEmailInvalidFormat': 'Il formato dell email non è valido',
              'customerEmailConfirmationRequired': 'Conferma dell email obbligatoria del cliente',
              'customerEmailConfirmationEqualsEmail': 'La conferma deve essere uguale all email',
              'customerPhoneNumberRequired': 'Telefono cliente obbligatorio',
              'customerPhoneNumberMinLength': 'Lunghezza minima del telefono del cliente',
              'driverDocumentIdRequired': 'ID / Licenza obbligatoria',
              'driverDateOfBirthRequired': 'Data di nascita del conducente obbligatorio',
              'numberOfAdultsRequired': 'Il numero di persone è obbligatorio',
              'streetRequired': 'Via obbligatoria',
              'numberRequired': 'Numero obbligatorio',              
              'cityRequired': 'Città obbligatoria',
              'stateRequired': 'Provincia obbligatoria',
              'countryRequired': 'Paese obbligatorio',
              'zipRequired': 'Codice postale obbligatorio',              
              'conditionsReadRequired': 'Non hai verificato di aver letto le condizioni',
              'privacyPolicyRequired': "Non hai verificato di aver letto l'informativa sulla privacy",                 
              'acceptAgeRequired': 'Non hai indicato di avere più di 21 anni',
              'acceptExperienceRequired': 'Non ha segnato di avere più di 1 anno di esperienza nella guida di motocicli',
              'selectPaymentMethod': 'Per favore, seleziona il metodo di pagamento'                      
            }
          },
          'createReservation': {
            'error': 'Scusi. Si è verificato un errore durante la registrazione della prenotazione.'
          }  
        },
        summary: {
          'loadReservation': {
            'error': 'Scusi. Si è verificato un errore durante il caricamento della prenotazione.'
          }
        },
        myReservation: {
          'select_country': 'Seleziona il paese',             
          'loadReservation': {
            'error': 'Scusi. Si è verificato un errore durante il caricamento della prenotazione.'
          },
          'pay': {
            'total_payment': 'Paga {{amount}}',
            'payment_button': 'Paga {{amount}}',             
            'paymentMethodRequired': 'Seleziona il metodo di pagamento.',
            'booking_amount': 'Per confermare la prenotazione verrà addebitato un importo di <strong>{{amount}} </strong> sulla tua carta.',
            'pending_amount': "Il pagamento dell'importo in sospeso <strong>{{amount}}</strong> è consentito"
          },
          'updateReservation': {
            'success': 'Prenotazione aggiornata correttamente',
            'error': "Siamo spiacenti. Si è verificato un errore durante l'aggiornamento della prenotazione"
          }          
        },
        selectorWizard: {
           'pickupPlace': 'Punto di raccolta',
           'dateFrom': 'Data di raccolta',
           'timeFrom': 'Tempo di raccolta',
           'returnPlace': 'Punto di ritorno',
           'dateTo': 'Data di ritorno',
           'timeTo': 'Tempo di ritorno'              
        },        
        activities: {
          common: {
            'errorLoadingData': "Scusi. Si è verificato un errore durante il caricamento delle informazioni",
            'errorUpdatingData': "Scusi. Si è verificato un errore durante l'aggiornamento dei dati",
            'dataUpdateOk': "Dati aggiornati correttamente"
          },
          calendarWidget: {
             'selectTickets': 'Non hai selezionato alcun biglietto',
             'fullPlaces': 'Piena capacità',
             'fewPlacesWarning': 'Ultimi posti',
             'fewNoPlacesWarning': 'Ultimi ore'    
          },
          multipleDates: {
             'selectDate': "Seleziona la data"
          },
          checkout: {
             'errorCreatingOrder': "Scusi. Si è verificato un errore durante la registrazione della prenotazione.",
             'errors': "Il modulo contiene errori. Per favore, controllali",                 
             'validations': {
               'customerNameRequired': 'Nome cliente obbligatorio',
               'customerSurnameRequired': 'Cognome del cliente richiesto',
               'customerEmailRequired': 'Email cliente obbligatoria',
               'customerEmailInvalidFormat': 'Il formato dell email non è valido',
               'customerEmailConfirmationRequired': 'Conferma dell email obbligatoria del cliente',
               'customerEmailConfirmationEqualsEmail': 'La conferma deve essere uguale all email',
               'customerPhoneNumberRequired': 'Telefono cliente obbligatorio',
               'customerPhoneNumberMinLength': 'Lunghezza minima del telefono del cliente',
               'conditionsReadRequired': 'Non hai verificato di aver letto le condizioni',
               'privacyPolicyRequired': "Non hai verificato di aver letto l'informativa sulla privacy",                
               'selectPaymentMethod': 'Per favore, seleziona il metodo di pagamento'    
             }
          },
          payment: {
             'total_payment': 'Paga {{amount}}',
             'payment_button': 'Paga {{amount}}',
             'deposit_amount': 'Per confermare la prenotazione verrà addebitato un importo di <strong>{{amount}} </strong> sulla tua carta.',
             'pending_amount': "Il pagamento dell'importo in sospeso <strong>{{amount}}</strong> è consentito",
             'errors':  "Il modulo contiene errori. Per favore, controllali",
             'paymentMethodNotSelected': 'Per favore, seleziona il metodo di pagamento'
          },
          myReservation: {
             'cancelReservationConfirm': 'Vuoi cancellare la prenotazione?'
          } 

        }
      }
  	},
    ru: {
        translation: {
          common: {
            'days': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  день',
            'days_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  дней',
            'hours': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  час',
            'hours_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  часы',
            'minutes': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  минута',
            'minutes_plural': '&nbsp;<u><b>{{count}}</b></u>&nbsp;  минут',
            'error': 'Мы сожалеем. Произошла ошибка в процессе',
            'welcomeConnectedUser': 'Добро пожаловать, <b> {{name}} </b>, вы можете продолжить бронирование',
            'invalid_user_password': 'Неверный пользователь или пароль'
          },
          extra: {
            'daily_amount': '{{oneUnitPrice}} в день',
            'hourly_amount': '{{oneUnitPrice}} в час',
            'unitary_amount': '{{oneUnitPrice}}',
            'total': 'Общее {{total}}'
          },
          contact: {
            'form_errors': 'Пожалуйста, проверьте ошибки',
            'validate_captcha': 'Пожалуйста, подтвердите капчу',
            'validations': {
               'nameRequired': 'Имя обязательно',
               'surnameRequired': 'Фамилия обязательна',
               'emailRequired': 'Электронная почта обязательна',
               'phoneNumberRequired': 'Номер телефона обязателен',
               'commentsRequired': 'Сообщение обязательно'
            },
            'message_sent_successfully': 'Сообщение успешно отправлено',
            'error_sending_message': 'Ошибка отправки сообщения'
          },
          calendar_selector: {
            'min_time': 'Сбор предыдущего бронирования находится по адресу {{time}}',
            'max_time': 'Доставка следующей брони по адресу {{time}}'
          },
              selector: {
              'select_pickup_place': 'Выберите место получения',
              'select_return_place': 'Выберите место возврата',
              'another_place': 'Точный адрес',
              'error_loading_data': 'Мы сожалеем. При загрузке данных произошла ошибка',
                      'validations': {
                'pickupPlaceRequired': 'Требуется место получения',
                'dateFromRequired': 'Требуется дата',
                'timeFromRequired': 'Требуется время',
                'returnPlaceRequired': 'Требуется место возврата',
                'dateToRequired': 'Требуется дата',
                'timeToRequired': 'Требуется время',
                          'sameDayTimeToGreaterTimeFrom': 'Должен быть позже срока доставки',
                          'acceptAge': 'Вы должны подтвердить, что вам больше {{years}} лет',
                          'promotionCodeInvalid': 'Промокод недействителен'
                      }
              },
              chooseProduct: {
                      'loadShoppingCart': {
                          'error': 'Мы сожалеем. Произошла ошибка при поиске'
                      },
                      'selectProduct': {
                          'productNotSelected': 'Пожалуйста, выберите автомобиль.',
                          'error': 'Мы сожалеем. При выборе автомобиля произошла ошибка'
                      },
              'selectUnits': 'Выберите единицы',
              'units': '{{count}} Эдиница',
              'units_plural': '{{count}} Эдиницы',
              'max_duration': 'Максимальная продолжительность составляет {{duration}}',
              'min_duration': 'Минимальная продолжительность составляет {{duration}}'
              },
              chooseExtras: {
                      'loadShoppingCart': {
                          'error': 'Мы сожалеем. При загрузке данных произошла ошибка.'
                      },
                      'selectExtra': {
                          'error': 'Мы сожалеем. При обновлении дополнений произошла ошибка.'
                      },
                      'deleteExtra': {
                          'error': 'Мы сожалеем. При удалении дополнений произошла ошибка.'
                      }
              },
              complete: {
              'loadShoppingCart': {
                'error': 'Мы сожалеем. При загрузке данных произошла ошибка.'
              },
              'selectExtra': {
                'error': 'Мы сожалеем. При обновлении дополнений произошла ошибка'
              },
              'deleteExtra': {
                'error': 'Мы сожалеем. При удалении дополнений произошла ошибка.'
              },
              'promotionCode': {
                'error': 'Мы сожалеем. При проверке промокода произошла ошибка.',
              },
              'reservationForm': {
                'errors': 'Пожалуйста, проверьте ошибки в форме бронирования.',
                'total_payment': 'Оплатить {{amount}}',
                'payment_button': 'Оплатить {{amount}}',
                'booking_amount': 'Для подтверждения бронирования требуется оплатить <strong> {{amount}} </strong>.',
                'select_country': 'Выберите страну',
                'validations': {
                  'fieldRequired': 'Это поле обязательно к заполнению',
                  'passwordCheck': 'Пароль должен содержать заглавную букву, строчную букву, цифру и символ.',
                  'minLength': 'Минимум {{minlength}} символов',
                  'customerNameRequired': 'Требуется имя клиента',
                  'customerSurnameRequired': 'Фамилия клиента обязательна',
                  'customerEmailRequired': 'Требуется електронная почта клиента',
                  'customerEmailInvalidFormat': 'Неверный адрес электронной почты',
                  'customerEmailConfirmationRequired': 'Требуется подтверждение электронной почт клиента',
                  'customerEmailConfirmationEqualsEmail': 'Подтверждение электронной почты клиента должно совпадать с адресом электронной почты клиента',
                  'customerPhoneNumberRequired': 'Требуется номер телефона клиента',
                  'customerPhoneNumberMinLength': 'Минимальная длина номера телефона клиента',
                  'driverDateOfBirthRequired': 'Требуется указать дату рождения водителя.',
                  'numberOfAdultsRequired': 'Требуется номер в группе',
                  'conditionsReadRequired': 'Пожалуйста, подтвердите, что вы прочитали условия аренды',
                  'privacyPolicyRequired': 'Пожалуйста, подтвердите, что вы прочитали политику конфиденциальности',
                  'selectPaymentMethod': 'Пожалуйста, выберите способ оплаты'
                }
              },
              'createReservation': {
                'error': 'Мы сожалеем. При создании бронирования произошла ошибка.'
              }
              },
                summary: {
            'loadReservation': {
              'error': 'Мы сожалеем. При загрузке бронирования произошла ошибка.'
            }
                },
          myReservation: {
            'select_country': 'Выберите страну',
            'loadReservation': {
              'error': 'Мы сожалеем. При загрузке бронирования произошла ошибка.'
            },
            'pay': {
              'total_payment': 'Оплатить {{amount}}',
              'payment_button': 'Оплатить {{amount}}',
              'paymentMethodRequired': 'Пожалуйста, выберите способ оплаты.',
              'booking_amount': 'Для подтверждения бронирования требуется оплатить <strong> {{amount}} </strong>.',
              'pending_amount': 'Выплата ожидаемой суммы <strong> {{amount}} </strong> это вариант'
            },
            'updateReservation': {
              'success': 'Бронирование успешно обновлено',
              'error': 'Мы сожалеем. При обновлении бронирования произошла ошибка'
            }
          },
          selectorWizard: {
             'pickupPlace': 'Пункт сбора',
             'dateFrom': 'Дата сбора',
             'timeFrom': 'Время сбора',
             'returnPlace': 'Пункт возврата',
             'dateTo': 'Дата возвращения',
             'timeTo': 'Время возврата'
          },
          activities: {
            common: {
              'errorLoadingData': 'Мы сожалеем. При загрузке информации произошла ошибка',
              'errorUpdatingData': 'Мы сожалеем. При обновлении данных произошла ошибка',
              'dataUpdateOk': 'Данные успешно обновлены'
            },
            calendarWidget: {
               'selectTickets': 'Вы не выбрали ни одного билета',
               'fullPlaces': 'Полная вместимость',
               'fewPlacesWarning': 'Последние места',
               'fewNoPlacesWarning': 'Последние ходы'
            },
            multipleDates: {
               'selectDate': 'Пожалуйста, выберите дату'
            },
            checkout: {
               'errorCreatingOrder': 'Мы сожалеем. При создании бронирования произошла ошибка',
               'errors': 'Пожалуйста, проверьте ошибки в форме бронирования.',
               'validations': {
                 'customerNameRequired': 'Требуется имя клиента',
                 'customerSurnameRequired': 'Требуется фамилия клиента',
                 'customerEmailRequired': 'Требуется електронная почта клиента',
                 'customerEmailInvalidFormat': 'Неверный адрес электронной почты',
                 'customerEmailConfirmationRequired': 'Требуется подтверждение электронной почты клиента',
                 'customerEmailConfirmationEqualsEmail': 'Подтверждение электронной почты клиента должно совпадать с адресом электронной почты клиента',
                 'customerPhoneNumberRequired': 'Требуется номер телефона клиента',
                 'customerPhoneNumberMinLength': 'Минимальная длина номера телефона клиента',
                 'conditionsReadRequired': 'Пожалуйста, подтвердите, что вы прочитали условия аренды',
                 'privacyPolicyRequired': 'Пожалуйста, подтвердите, что вы прочитали политику конфиденциальности',
                 'selectPaymentMethod': 'Пожалуйста, выберите способ оплаты'
               }
            },
            payment: {
               'total_payment': 'Оплатить {{amount}}',
               'payment_button': 'Оплатить {{amount}}',
               'deposit_amount': 'Для подтверждения бронирования требуется оплатить <strong> {{amount}} </strong>.',
               'pending_amount': 'Выплата ожидаемой суммы <strong> {{amount}} </strong> разрешена',
               'errors': 'Пожалуйста, проверьте ошибки.',
               'paymentMethodNotSelected': 'Пожалуйста, выберите способ оплаты.'
            },
            myReservation: {
               'cancelReservationConfirm': 'Вы хотите отменить бронирование?',
            }
          }
        }
    }    

  };

  return engineTranslations;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * jQuery Validation Plugin v1.19.1
 *
 * https://jqueryvalidation.org/
 *
 * Copyright (c) 2019 Jörn Zaefferer
 * Released under the MIT license
 */
(function( factory ) {
	if ( true ) {
		!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0)], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else {}
}(function( $ ) {

$.extend( $.fn, {

	// https://jqueryvalidation.org/validate/
	validate: function( options ) {

		// If nothing is selected, return nothing; can't chain anyway
		if ( !this.length ) {
			if ( options && options.debug && window.console ) {
				console.warn( "Nothing selected, can't validate, returning nothing." );
			}
			return;
		}

		// Check if a validator for this form was already created
		var validator = $.data( this[ 0 ], "validator" );
		if ( validator ) {
			return validator;
		}

		// Add novalidate tag if HTML5.
		this.attr( "novalidate", "novalidate" );

		validator = new $.validator( options, this[ 0 ] );
		$.data( this[ 0 ], "validator", validator );

		if ( validator.settings.onsubmit ) {

			this.on( "click.validate", ":submit", function( event ) {

				// Track the used submit button to properly handle scripted
				// submits later.
				validator.submitButton = event.currentTarget;

				// Allow suppressing validation by adding a cancel class to the submit button
				if ( $( this ).hasClass( "cancel" ) ) {
					validator.cancelSubmit = true;
				}

				// Allow suppressing validation by adding the html5 formnovalidate attribute to the submit button
				if ( $( this ).attr( "formnovalidate" ) !== undefined ) {
					validator.cancelSubmit = true;
				}
			} );

			// Validate the form on submit
			this.on( "submit.validate", function( event ) {
				if ( validator.settings.debug ) {

					// Prevent form submit to be able to see console output
					event.preventDefault();
				}

				function handle() {
					var hidden, result;

					// Insert a hidden input as a replacement for the missing submit button
					// The hidden input is inserted in two cases:
					//   - A user defined a `submitHandler`
					//   - There was a pending request due to `remote` method and `stopRequest()`
					//     was called to submit the form in case it's valid
					if ( validator.submitButton && ( validator.settings.submitHandler || validator.formSubmitted ) ) {
						hidden = $( "<input type='hidden'/>" )
							.attr( "name", validator.submitButton.name )
							.val( $( validator.submitButton ).val() )
							.appendTo( validator.currentForm );
					}

					if ( validator.settings.submitHandler && !validator.settings.debug ) {
						result = validator.settings.submitHandler.call( validator, validator.currentForm, event );
						if ( hidden ) {

							// And clean up afterwards; thanks to no-block-scope, hidden can be referenced
							hidden.remove();
						}
						if ( result !== undefined ) {
							return result;
						}
						return false;
					}
					return true;
				}

				// Prevent submit for invalid forms or custom submit handlers
				if ( validator.cancelSubmit ) {
					validator.cancelSubmit = false;
					return handle();
				}
				if ( validator.form() ) {
					if ( validator.pendingRequest ) {
						validator.formSubmitted = true;
						return false;
					}
					return handle();
				} else {
					validator.focusInvalid();
					return false;
				}
			} );
		}

		return validator;
	},

	// https://jqueryvalidation.org/valid/
	valid: function() {
		var valid, validator, errorList;

		if ( $( this[ 0 ] ).is( "form" ) ) {
			valid = this.validate().form();
		} else {
			errorList = [];
			valid = true;
			validator = $( this[ 0 ].form ).validate();
			this.each( function() {
				valid = validator.element( this ) && valid;
				if ( !valid ) {
					errorList = errorList.concat( validator.errorList );
				}
			} );
			validator.errorList = errorList;
		}
		return valid;
	},

	// https://jqueryvalidation.org/rules/
	rules: function( command, argument ) {
		var element = this[ 0 ],
			isContentEditable = typeof this.attr( "contenteditable" ) !== "undefined" && this.attr( "contenteditable" ) !== "false",
			settings, staticRules, existingRules, data, param, filtered;

		// If nothing is selected, return empty object; can't chain anyway
		if ( element == null ) {
			return;
		}

		if ( !element.form && isContentEditable ) {
			element.form = this.closest( "form" )[ 0 ];
			element.name = this.attr( "name" );
		}

		if ( element.form == null ) {
			return;
		}

		if ( command ) {
			settings = $.data( element.form, "validator" ).settings;
			staticRules = settings.rules;
			existingRules = $.validator.staticRules( element );
			switch ( command ) {
			case "add":
				$.extend( existingRules, $.validator.normalizeRule( argument ) );

				// Remove messages from rules, but allow them to be set separately
				delete existingRules.messages;
				staticRules[ element.name ] = existingRules;
				if ( argument.messages ) {
					settings.messages[ element.name ] = $.extend( settings.messages[ element.name ], argument.messages );
				}
				break;
			case "remove":
				if ( !argument ) {
					delete staticRules[ element.name ];
					return existingRules;
				}
				filtered = {};
				$.each( argument.split( /\s/ ), function( index, method ) {
					filtered[ method ] = existingRules[ method ];
					delete existingRules[ method ];
				} );
				return filtered;
			}
		}

		data = $.validator.normalizeRules(
		$.extend(
			{},
			$.validator.classRules( element ),
			$.validator.attributeRules( element ),
			$.validator.dataRules( element ),
			$.validator.staticRules( element )
		), element );

		// Make sure required is at front
		if ( data.required ) {
			param = data.required;
			delete data.required;
			data = $.extend( { required: param }, data );
		}

		// Make sure remote is at back
		if ( data.remote ) {
			param = data.remote;
			delete data.remote;
			data = $.extend( data, { remote: param } );
		}

		return data;
	}
} );

// Custom selectors
$.extend( $.expr.pseudos || $.expr[ ":" ], {		// '|| $.expr[ ":" ]' here enables backwards compatibility to jQuery 1.7. Can be removed when dropping jQ 1.7.x support

	// https://jqueryvalidation.org/blank-selector/
	blank: function( a ) {
		return !$.trim( "" + $( a ).val() );
	},

	// https://jqueryvalidation.org/filled-selector/
	filled: function( a ) {
		var val = $( a ).val();
		return val !== null && !!$.trim( "" + val );
	},

	// https://jqueryvalidation.org/unchecked-selector/
	unchecked: function( a ) {
		return !$( a ).prop( "checked" );
	}
} );

// Constructor for validator
$.validator = function( options, form ) {
	this.settings = $.extend( true, {}, $.validator.defaults, options );
	this.currentForm = form;
	this.init();
};

// https://jqueryvalidation.org/jQuery.validator.format/
$.validator.format = function( source, params ) {
	if ( arguments.length === 1 ) {
		return function() {
			var args = $.makeArray( arguments );
			args.unshift( source );
			return $.validator.format.apply( this, args );
		};
	}
	if ( params === undefined ) {
		return source;
	}
	if ( arguments.length > 2 && params.constructor !== Array  ) {
		params = $.makeArray( arguments ).slice( 1 );
	}
	if ( params.constructor !== Array ) {
		params = [ params ];
	}
	$.each( params, function( i, n ) {
		source = source.replace( new RegExp( "\\{" + i + "\\}", "g" ), function() {
			return n;
		} );
	} );
	return source;
};

$.extend( $.validator, {

	defaults: {
		messages: {},
		groups: {},
		rules: {},
		errorClass: "error",
		pendingClass: "pending",
		validClass: "valid",
		errorElement: "label",
		focusCleanup: false,
		focusInvalid: true,
		errorContainer: $( [] ),
		errorLabelContainer: $( [] ),
		onsubmit: true,
		ignore: ":hidden",
		ignoreTitle: false,
		onfocusin: function( element ) {
			this.lastActive = element;

			// Hide error label and remove error class on focus if enabled
			if ( this.settings.focusCleanup ) {
				if ( this.settings.unhighlight ) {
					this.settings.unhighlight.call( this, element, this.settings.errorClass, this.settings.validClass );
				}
				this.hideThese( this.errorsFor( element ) );
			}
		},
		onfocusout: function( element ) {
			if ( !this.checkable( element ) && ( element.name in this.submitted || !this.optional( element ) ) ) {
				this.element( element );
			}
		},
		onkeyup: function( element, event ) {

			// Avoid revalidate the field when pressing one of the following keys
			// Shift       => 16
			// Ctrl        => 17
			// Alt         => 18
			// Caps lock   => 20
			// End         => 35
			// Home        => 36
			// Left arrow  => 37
			// Up arrow    => 38
			// Right arrow => 39
			// Down arrow  => 40
			// Insert      => 45
			// Num lock    => 144
			// AltGr key   => 225
			var excludedKeys = [
				16, 17, 18, 20, 35, 36, 37,
				38, 39, 40, 45, 144, 225
			];

			if ( event.which === 9 && this.elementValue( element ) === "" || $.inArray( event.keyCode, excludedKeys ) !== -1 ) {
				return;
			} else if ( element.name in this.submitted || element.name in this.invalid ) {
				this.element( element );
			}
		},
		onclick: function( element ) {

			// Click on selects, radiobuttons and checkboxes
			if ( element.name in this.submitted ) {
				this.element( element );

			// Or option elements, check parent select in that case
			} else if ( element.parentNode.name in this.submitted ) {
				this.element( element.parentNode );
			}
		},
		highlight: function( element, errorClass, validClass ) {
			if ( element.type === "radio" ) {
				this.findByName( element.name ).addClass( errorClass ).removeClass( validClass );
			} else {
				$( element ).addClass( errorClass ).removeClass( validClass );
			}
		},
		unhighlight: function( element, errorClass, validClass ) {
			if ( element.type === "radio" ) {
				this.findByName( element.name ).removeClass( errorClass ).addClass( validClass );
			} else {
				$( element ).removeClass( errorClass ).addClass( validClass );
			}
		}
	},

	// https://jqueryvalidation.org/jQuery.validator.setDefaults/
	setDefaults: function( settings ) {
		$.extend( $.validator.defaults, settings );
	},

	messages: {
		required: "This field is required.",
		remote: "Please fix this field.",
		email: "Please enter a valid email address.",
		url: "Please enter a valid URL.",
		date: "Please enter a valid date.",
		dateISO: "Please enter a valid date (ISO).",
		number: "Please enter a valid number.",
		digits: "Please enter only digits.",
		equalTo: "Please enter the same value again.",
		maxlength: $.validator.format( "Please enter no more than {0} characters." ),
		minlength: $.validator.format( "Please enter at least {0} characters." ),
		rangelength: $.validator.format( "Please enter a value between {0} and {1} characters long." ),
		range: $.validator.format( "Please enter a value between {0} and {1}." ),
		max: $.validator.format( "Please enter a value less than or equal to {0}." ),
		min: $.validator.format( "Please enter a value greater than or equal to {0}." ),
		step: $.validator.format( "Please enter a multiple of {0}." )
	},

	autoCreateRanges: false,

	prototype: {

		init: function() {
			this.labelContainer = $( this.settings.errorLabelContainer );
			this.errorContext = this.labelContainer.length && this.labelContainer || $( this.currentForm );
			this.containers = $( this.settings.errorContainer ).add( this.settings.errorLabelContainer );
			this.submitted = {};
			this.valueCache = {};
			this.pendingRequest = 0;
			this.pending = {};
			this.invalid = {};
			this.reset();

			var currentForm = this.currentForm,
				groups = ( this.groups = {} ),
				rules;
			$.each( this.settings.groups, function( key, value ) {
				if ( typeof value === "string" ) {
					value = value.split( /\s/ );
				}
				$.each( value, function( index, name ) {
					groups[ name ] = key;
				} );
			} );
			rules = this.settings.rules;
			$.each( rules, function( key, value ) {
				rules[ key ] = $.validator.normalizeRule( value );
			} );

			function delegate( event ) {
				var isContentEditable = typeof $( this ).attr( "contenteditable" ) !== "undefined" && $( this ).attr( "contenteditable" ) !== "false";

				// Set form expando on contenteditable
				if ( !this.form && isContentEditable ) {
					this.form = $( this ).closest( "form" )[ 0 ];
					this.name = $( this ).attr( "name" );
				}

				// Ignore the element if it belongs to another form. This will happen mainly
				// when setting the `form` attribute of an input to the id of another form.
				if ( currentForm !== this.form ) {
					return;
				}

				var validator = $.data( this.form, "validator" ),
					eventType = "on" + event.type.replace( /^validate/, "" ),
					settings = validator.settings;
				if ( settings[ eventType ] && !$( this ).is( settings.ignore ) ) {
					settings[ eventType ].call( validator, this, event );
				}
			}

			$( this.currentForm )
				.on( "focusin.validate focusout.validate keyup.validate",
					":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'], " +
					"[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], " +
					"[type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], " +
					"[type='radio'], [type='checkbox'], [contenteditable], [type='button']", delegate )

				// Support: Chrome, oldIE
				// "select" is provided as event.target when clicking a option
				.on( "click.validate", "select, option, [type='radio'], [type='checkbox']", delegate );

			if ( this.settings.invalidHandler ) {
				$( this.currentForm ).on( "invalid-form.validate", this.settings.invalidHandler );
			}
		},

		// https://jqueryvalidation.org/Validator.form/
		form: function() {
			this.checkForm();
			$.extend( this.submitted, this.errorMap );
			this.invalid = $.extend( {}, this.errorMap );
			if ( !this.valid() ) {
				$( this.currentForm ).triggerHandler( "invalid-form", [ this ] );
			}
			this.showErrors();
			return this.valid();
		},

		checkForm: function() {
			this.prepareForm();
			for ( var i = 0, elements = ( this.currentElements = this.elements() ); elements[ i ]; i++ ) {
				this.check( elements[ i ] );
			}
			return this.valid();
		},

		// https://jqueryvalidation.org/Validator.element/
		element: function( element ) {
			var cleanElement = this.clean( element ),
				checkElement = this.validationTargetFor( cleanElement ),
				v = this,
				result = true,
				rs, group;

			if ( checkElement === undefined ) {
				delete this.invalid[ cleanElement.name ];
			} else {
				this.prepareElement( checkElement );
				this.currentElements = $( checkElement );

				// If this element is grouped, then validate all group elements already
				// containing a value
				group = this.groups[ checkElement.name ];
				if ( group ) {
					$.each( this.groups, function( name, testgroup ) {
						if ( testgroup === group && name !== checkElement.name ) {
							cleanElement = v.validationTargetFor( v.clean( v.findByName( name ) ) );
							if ( cleanElement && cleanElement.name in v.invalid ) {
								v.currentElements.push( cleanElement );
								result = v.check( cleanElement ) && result;
							}
						}
					} );
				}

				rs = this.check( checkElement ) !== false;
				result = result && rs;
				if ( rs ) {
					this.invalid[ checkElement.name ] = false;
				} else {
					this.invalid[ checkElement.name ] = true;
				}

				if ( !this.numberOfInvalids() ) {

					// Hide error containers on last error
					this.toHide = this.toHide.add( this.containers );
				}
				this.showErrors();

				// Add aria-invalid status for screen readers
				$( element ).attr( "aria-invalid", !rs );
			}

			return result;
		},

		// https://jqueryvalidation.org/Validator.showErrors/
		showErrors: function( errors ) {
			if ( errors ) {
				var validator = this;

				// Add items to error list and map
				$.extend( this.errorMap, errors );
				this.errorList = $.map( this.errorMap, function( message, name ) {
					return {
						message: message,
						element: validator.findByName( name )[ 0 ]
					};
				} );

				// Remove items from success list
				this.successList = $.grep( this.successList, function( element ) {
					return !( element.name in errors );
				} );
			}
			if ( this.settings.showErrors ) {
				this.settings.showErrors.call( this, this.errorMap, this.errorList );
			} else {
				this.defaultShowErrors();
			}
		},

		// https://jqueryvalidation.org/Validator.resetForm/
		resetForm: function() {
			if ( $.fn.resetForm ) {
				$( this.currentForm ).resetForm();
			}
			this.invalid = {};
			this.submitted = {};
			this.prepareForm();
			this.hideErrors();
			var elements = this.elements()
				.removeData( "previousValue" )
				.removeAttr( "aria-invalid" );

			this.resetElements( elements );
		},

		resetElements: function( elements ) {
			var i;

			if ( this.settings.unhighlight ) {
				for ( i = 0; elements[ i ]; i++ ) {
					this.settings.unhighlight.call( this, elements[ i ],
						this.settings.errorClass, "" );
					this.findByName( elements[ i ].name ).removeClass( this.settings.validClass );
				}
			} else {
				elements
					.removeClass( this.settings.errorClass )
					.removeClass( this.settings.validClass );
			}
		},

		numberOfInvalids: function() {
			return this.objectLength( this.invalid );
		},

		objectLength: function( obj ) {
			/* jshint unused: false */
			var count = 0,
				i;
			for ( i in obj ) {

				// This check allows counting elements with empty error
				// message as invalid elements
				if ( obj[ i ] !== undefined && obj[ i ] !== null && obj[ i ] !== false ) {
					count++;
				}
			}
			return count;
		},

		hideErrors: function() {
			this.hideThese( this.toHide );
		},

		hideThese: function( errors ) {
			errors.not( this.containers ).text( "" );
			this.addWrapper( errors ).hide();
		},

		valid: function() {
			return this.size() === 0;
		},

		size: function() {
			return this.errorList.length;
		},

		focusInvalid: function() {
			if ( this.settings.focusInvalid ) {
				try {
					$( this.findLastActive() || this.errorList.length && this.errorList[ 0 ].element || [] )
					.filter( ":visible" )
					.trigger( "focus" )

					// Manually trigger focusin event; without it, focusin handler isn't called, findLastActive won't have anything to find
					.trigger( "focusin" );
				} catch ( e ) {

					// Ignore IE throwing errors when focusing hidden elements
				}
			}
		},

		findLastActive: function() {
			var lastActive = this.lastActive;
			return lastActive && $.grep( this.errorList, function( n ) {
				return n.element.name === lastActive.name;
			} ).length === 1 && lastActive;
		},

		elements: function() {
			var validator = this,
				rulesCache = {};

			// Select all valid inputs inside the form (no submit or reset buttons)
			return $( this.currentForm )
			.find( "input, select, textarea, [contenteditable]" )
			.not( ":submit, :reset, :image, :disabled" )
			.not( this.settings.ignore )
			.filter( function() {
				var name = this.name || $( this ).attr( "name" ); // For contenteditable
				var isContentEditable = typeof $( this ).attr( "contenteditable" ) !== "undefined" && $( this ).attr( "contenteditable" ) !== "false";

				if ( !name && validator.settings.debug && window.console ) {
					console.error( "%o has no name assigned", this );
				}

				// Set form expando on contenteditable
				if ( isContentEditable ) {
					this.form = $( this ).closest( "form" )[ 0 ];
					this.name = name;
				}

				// Ignore elements that belong to other/nested forms
				if ( this.form !== validator.currentForm ) {
					return false;
				}

				// Select only the first element for each name, and only those with rules specified
				if ( name in rulesCache || !validator.objectLength( $( this ).rules() ) ) {
					return false;
				}

				rulesCache[ name ] = true;
				return true;
			} );
		},

		clean: function( selector ) {
			return $( selector )[ 0 ];
		},

		errors: function() {
			var errorClass = this.settings.errorClass.split( " " ).join( "." );
			return $( this.settings.errorElement + "." + errorClass, this.errorContext );
		},

		resetInternals: function() {
			this.successList = [];
			this.errorList = [];
			this.errorMap = {};
			this.toShow = $( [] );
			this.toHide = $( [] );
		},

		reset: function() {
			this.resetInternals();
			this.currentElements = $( [] );
		},

		prepareForm: function() {
			this.reset();
			this.toHide = this.errors().add( this.containers );
		},

		prepareElement: function( element ) {
			this.reset();
			this.toHide = this.errorsFor( element );
		},

		elementValue: function( element ) {
			var $element = $( element ),
				type = element.type,
				isContentEditable = typeof $element.attr( "contenteditable" ) !== "undefined" && $element.attr( "contenteditable" ) !== "false",
				val, idx;

			if ( type === "radio" || type === "checkbox" ) {
				return this.findByName( element.name ).filter( ":checked" ).val();
			} else if ( type === "number" && typeof element.validity !== "undefined" ) {
				return element.validity.badInput ? "NaN" : $element.val();
			}

			if ( isContentEditable ) {
				val = $element.text();
			} else {
				val = $element.val();
			}

			if ( type === "file" ) {

				// Modern browser (chrome & safari)
				if ( val.substr( 0, 12 ) === "C:\\fakepath\\" ) {
					return val.substr( 12 );
				}

				// Legacy browsers
				// Unix-based path
				idx = val.lastIndexOf( "/" );
				if ( idx >= 0 ) {
					return val.substr( idx + 1 );
				}

				// Windows-based path
				idx = val.lastIndexOf( "\\" );
				if ( idx >= 0 ) {
					return val.substr( idx + 1 );
				}

				// Just the file name
				return val;
			}

			if ( typeof val === "string" ) {
				return val.replace( /\r/g, "" );
			}
			return val;
		},

		check: function( element ) {
			element = this.validationTargetFor( this.clean( element ) );

			var rules = $( element ).rules(),
				rulesCount = $.map( rules, function( n, i ) {
					return i;
				} ).length,
				dependencyMismatch = false,
				val = this.elementValue( element ),
				result, method, rule, normalizer;

			// Prioritize the local normalizer defined for this element over the global one
			// if the former exists, otherwise user the global one in case it exists.
			if ( typeof rules.normalizer === "function" ) {
				normalizer = rules.normalizer;
			} else if (	typeof this.settings.normalizer === "function" ) {
				normalizer = this.settings.normalizer;
			}

			// If normalizer is defined, then call it to retreive the changed value instead
			// of using the real one.
			// Note that `this` in the normalizer is `element`.
			if ( normalizer ) {
				val = normalizer.call( element, val );

				// Delete the normalizer from rules to avoid treating it as a pre-defined method.
				delete rules.normalizer;
			}

			for ( method in rules ) {
				rule = { method: method, parameters: rules[ method ] };
				try {
					result = $.validator.methods[ method ].call( this, val, element, rule.parameters );

					// If a method indicates that the field is optional and therefore valid,
					// don't mark it as valid when there are no other rules
					if ( result === "dependency-mismatch" && rulesCount === 1 ) {
						dependencyMismatch = true;
						continue;
					}
					dependencyMismatch = false;

					if ( result === "pending" ) {
						this.toHide = this.toHide.not( this.errorsFor( element ) );
						return;
					}

					if ( !result ) {
						this.formatAndAdd( element, rule );
						return false;
					}
				} catch ( e ) {
					if ( this.settings.debug && window.console ) {
						console.log( "Exception occurred when checking element " + element.id + ", check the '" + rule.method + "' method.", e );
					}
					if ( e instanceof TypeError ) {
						e.message += ".  Exception occurred when checking element " + element.id + ", check the '" + rule.method + "' method.";
					}

					throw e;
				}
			}
			if ( dependencyMismatch ) {
				return;
			}
			if ( this.objectLength( rules ) ) {
				this.successList.push( element );
			}
			return true;
		},

		// Return the custom message for the given element and validation method
		// specified in the element's HTML5 data attribute
		// return the generic message if present and no method specific message is present
		customDataMessage: function( element, method ) {
			return $( element ).data( "msg" + method.charAt( 0 ).toUpperCase() +
				method.substring( 1 ).toLowerCase() ) || $( element ).data( "msg" );
		},

		// Return the custom message for the given element name and validation method
		customMessage: function( name, method ) {
			var m = this.settings.messages[ name ];
			return m && ( m.constructor === String ? m : m[ method ] );
		},

		// Return the first defined argument, allowing empty strings
		findDefined: function() {
			for ( var i = 0; i < arguments.length; i++ ) {
				if ( arguments[ i ] !== undefined ) {
					return arguments[ i ];
				}
			}
			return undefined;
		},

		// The second parameter 'rule' used to be a string, and extended to an object literal
		// of the following form:
		// rule = {
		//     method: "method name",
		//     parameters: "the given method parameters"
		// }
		//
		// The old behavior still supported, kept to maintain backward compatibility with
		// old code, and will be removed in the next major release.
		defaultMessage: function( element, rule ) {
			if ( typeof rule === "string" ) {
				rule = { method: rule };
			}

			var message = this.findDefined(
					this.customMessage( element.name, rule.method ),
					this.customDataMessage( element, rule.method ),

					// 'title' is never undefined, so handle empty string as undefined
					!this.settings.ignoreTitle && element.title || undefined,
					$.validator.messages[ rule.method ],
					"<strong>Warning: No message defined for " + element.name + "</strong>"
				),
				theregex = /\$?\{(\d+)\}/g;
			if ( typeof message === "function" ) {
				message = message.call( this, rule.parameters, element );
			} else if ( theregex.test( message ) ) {
				message = $.validator.format( message.replace( theregex, "{$1}" ), rule.parameters );
			}

			return message;
		},

		formatAndAdd: function( element, rule ) {
			var message = this.defaultMessage( element, rule );

			this.errorList.push( {
				message: message,
				element: element,
				method: rule.method
			} );

			this.errorMap[ element.name ] = message;
			this.submitted[ element.name ] = message;
		},

		addWrapper: function( toToggle ) {
			if ( this.settings.wrapper ) {
				toToggle = toToggle.add( toToggle.parent( this.settings.wrapper ) );
			}
			return toToggle;
		},

		defaultShowErrors: function() {
			var i, elements, error;
			for ( i = 0; this.errorList[ i ]; i++ ) {
				error = this.errorList[ i ];
				if ( this.settings.highlight ) {
					this.settings.highlight.call( this, error.element, this.settings.errorClass, this.settings.validClass );
				}
				this.showLabel( error.element, error.message );
			}
			if ( this.errorList.length ) {
				this.toShow = this.toShow.add( this.containers );
			}
			if ( this.settings.success ) {
				for ( i = 0; this.successList[ i ]; i++ ) {
					this.showLabel( this.successList[ i ] );
				}
			}
			if ( this.settings.unhighlight ) {
				for ( i = 0, elements = this.validElements(); elements[ i ]; i++ ) {
					this.settings.unhighlight.call( this, elements[ i ], this.settings.errorClass, this.settings.validClass );
				}
			}
			this.toHide = this.toHide.not( this.toShow );
			this.hideErrors();
			this.addWrapper( this.toShow ).show();
		},

		validElements: function() {
			return this.currentElements.not( this.invalidElements() );
		},

		invalidElements: function() {
			return $( this.errorList ).map( function() {
				return this.element;
			} );
		},

		showLabel: function( element, message ) {
			var place, group, errorID, v,
				error = this.errorsFor( element ),
				elementID = this.idOrName( element ),
				describedBy = $( element ).attr( "aria-describedby" );

			if ( error.length ) {

				// Refresh error/success class
				error.removeClass( this.settings.validClass ).addClass( this.settings.errorClass );

				// Replace message on existing label
				error.html( message );
			} else {

				// Create error element
				error = $( "<" + this.settings.errorElement + ">" )
					.attr( "id", elementID + "-error" )
					.addClass( this.settings.errorClass )
					.html( message || "" );

				// Maintain reference to the element to be placed into the DOM
				place = error;
				if ( this.settings.wrapper ) {

					// Make sure the element is visible, even in IE
					// actually showing the wrapped element is handled elsewhere
					place = error.hide().show().wrap( "<" + this.settings.wrapper + "/>" ).parent();
				}
				if ( this.labelContainer.length ) {
					this.labelContainer.append( place );
				} else if ( this.settings.errorPlacement ) {
					this.settings.errorPlacement.call( this, place, $( element ) );
				} else {
					place.insertAfter( element );
				}

				// Link error back to the element
				if ( error.is( "label" ) ) {

					// If the error is a label, then associate using 'for'
					error.attr( "for", elementID );

					// If the element is not a child of an associated label, then it's necessary
					// to explicitly apply aria-describedby
				} else if ( error.parents( "label[for='" + this.escapeCssMeta( elementID ) + "']" ).length === 0 ) {
					errorID = error.attr( "id" );

					// Respect existing non-error aria-describedby
					if ( !describedBy ) {
						describedBy = errorID;
					} else if ( !describedBy.match( new RegExp( "\\b" + this.escapeCssMeta( errorID ) + "\\b" ) ) ) {

						// Add to end of list if not already present
						describedBy += " " + errorID;
					}
					$( element ).attr( "aria-describedby", describedBy );

					// If this element is grouped, then assign to all elements in the same group
					group = this.groups[ element.name ];
					if ( group ) {
						v = this;
						$.each( v.groups, function( name, testgroup ) {
							if ( testgroup === group ) {
								$( "[name='" + v.escapeCssMeta( name ) + "']", v.currentForm )
									.attr( "aria-describedby", error.attr( "id" ) );
							}
						} );
					}
				}
			}
			if ( !message && this.settings.success ) {
				error.text( "" );
				if ( typeof this.settings.success === "string" ) {
					error.addClass( this.settings.success );
				} else {
					this.settings.success( error, element );
				}
			}
			this.toShow = this.toShow.add( error );
		},

		errorsFor: function( element ) {
			var name = this.escapeCssMeta( this.idOrName( element ) ),
				describer = $( element ).attr( "aria-describedby" ),
				selector = "label[for='" + name + "'], label[for='" + name + "'] *";

			// 'aria-describedby' should directly reference the error element
			if ( describer ) {
				selector = selector + ", #" + this.escapeCssMeta( describer )
					.replace( /\s+/g, ", #" );
			}

			return this
				.errors()
				.filter( selector );
		},

		// See https://api.jquery.com/category/selectors/, for CSS
		// meta-characters that should be escaped in order to be used with JQuery
		// as a literal part of a name/id or any selector.
		escapeCssMeta: function( string ) {
			return string.replace( /([\\!"#$%&'()*+,./:;<=>?@\[\]^`{|}~])/g, "\\$1" );
		},

		idOrName: function( element ) {
			return this.groups[ element.name ] || ( this.checkable( element ) ? element.name : element.id || element.name );
		},

		validationTargetFor: function( element ) {

			// If radio/checkbox, validate first element in group instead
			if ( this.checkable( element ) ) {
				element = this.findByName( element.name );
			}

			// Always apply ignore filter
			return $( element ).not( this.settings.ignore )[ 0 ];
		},

		checkable: function( element ) {
			return ( /radio|checkbox/i ).test( element.type );
		},

		findByName: function( name ) {
			return $( this.currentForm ).find( "[name='" + this.escapeCssMeta( name ) + "']" );
		},

		getLength: function( value, element ) {
			switch ( element.nodeName.toLowerCase() ) {
			case "select":
				return $( "option:selected", element ).length;
			case "input":
				if ( this.checkable( element ) ) {
					return this.findByName( element.name ).filter( ":checked" ).length;
				}
			}
			return value.length;
		},

		depend: function( param, element ) {
			return this.dependTypes[ typeof param ] ? this.dependTypes[ typeof param ]( param, element ) : true;
		},

		dependTypes: {
			"boolean": function( param ) {
				return param;
			},
			"string": function( param, element ) {
				return !!$( param, element.form ).length;
			},
			"function": function( param, element ) {
				return param( element );
			}
		},

		optional: function( element ) {
			var val = this.elementValue( element );
			return !$.validator.methods.required.call( this, val, element ) && "dependency-mismatch";
		},

		startRequest: function( element ) {
			if ( !this.pending[ element.name ] ) {
				this.pendingRequest++;
				$( element ).addClass( this.settings.pendingClass );
				this.pending[ element.name ] = true;
			}
		},

		stopRequest: function( element, valid ) {
			this.pendingRequest--;

			// Sometimes synchronization fails, make sure pendingRequest is never < 0
			if ( this.pendingRequest < 0 ) {
				this.pendingRequest = 0;
			}
			delete this.pending[ element.name ];
			$( element ).removeClass( this.settings.pendingClass );
			if ( valid && this.pendingRequest === 0 && this.formSubmitted && this.form() ) {
				$( this.currentForm ).submit();

				// Remove the hidden input that was used as a replacement for the
				// missing submit button. The hidden input is added by `handle()`
				// to ensure that the value of the used submit button is passed on
				// for scripted submits triggered by this method
				if ( this.submitButton ) {
					$( "input:hidden[name='" + this.submitButton.name + "']", this.currentForm ).remove();
				}

				this.formSubmitted = false;
			} else if ( !valid && this.pendingRequest === 0 && this.formSubmitted ) {
				$( this.currentForm ).triggerHandler( "invalid-form", [ this ] );
				this.formSubmitted = false;
			}
		},

		previousValue: function( element, method ) {
			method = typeof method === "string" && method || "remote";

			return $.data( element, "previousValue" ) || $.data( element, "previousValue", {
				old: null,
				valid: true,
				message: this.defaultMessage( element, { method: method } )
			} );
		},

		// Cleans up all forms and elements, removes validator-specific events
		destroy: function() {
			this.resetForm();

			$( this.currentForm )
				.off( ".validate" )
				.removeData( "validator" )
				.find( ".validate-equalTo-blur" )
					.off( ".validate-equalTo" )
					.removeClass( "validate-equalTo-blur" )
				.find( ".validate-lessThan-blur" )
					.off( ".validate-lessThan" )
					.removeClass( "validate-lessThan-blur" )
				.find( ".validate-lessThanEqual-blur" )
					.off( ".validate-lessThanEqual" )
					.removeClass( "validate-lessThanEqual-blur" )
				.find( ".validate-greaterThanEqual-blur" )
					.off( ".validate-greaterThanEqual" )
					.removeClass( "validate-greaterThanEqual-blur" )
				.find( ".validate-greaterThan-blur" )
					.off( ".validate-greaterThan" )
					.removeClass( "validate-greaterThan-blur" );
		}

	},

	classRuleSettings: {
		required: { required: true },
		email: { email: true },
		url: { url: true },
		date: { date: true },
		dateISO: { dateISO: true },
		number: { number: true },
		digits: { digits: true },
		creditcard: { creditcard: true }
	},

	addClassRules: function( className, rules ) {
		if ( className.constructor === String ) {
			this.classRuleSettings[ className ] = rules;
		} else {
			$.extend( this.classRuleSettings, className );
		}
	},

	classRules: function( element ) {
		var rules = {},
			classes = $( element ).attr( "class" );

		if ( classes ) {
			$.each( classes.split( " " ), function() {
				if ( this in $.validator.classRuleSettings ) {
					$.extend( rules, $.validator.classRuleSettings[ this ] );
				}
			} );
		}
		return rules;
	},

	normalizeAttributeRule: function( rules, type, method, value ) {

		// Convert the value to a number for number inputs, and for text for backwards compability
		// allows type="date" and others to be compared as strings
		if ( /min|max|step/.test( method ) && ( type === null || /number|range|text/.test( type ) ) ) {
			value = Number( value );

			// Support Opera Mini, which returns NaN for undefined minlength
			if ( isNaN( value ) ) {
				value = undefined;
			}
		}

		if ( value || value === 0 ) {
			rules[ method ] = value;
		} else if ( type === method && type !== "range" ) {

			// Exception: the jquery validate 'range' method
			// does not test for the html5 'range' type
			rules[ method ] = true;
		}
	},

	attributeRules: function( element ) {
		var rules = {},
			$element = $( element ),
			type = element.getAttribute( "type" ),
			method, value;

		for ( method in $.validator.methods ) {

			// Support for <input required> in both html5 and older browsers
			if ( method === "required" ) {
				value = element.getAttribute( method );

				// Some browsers return an empty string for the required attribute
				// and non-HTML5 browsers might have required="" markup
				if ( value === "" ) {
					value = true;
				}

				// Force non-HTML5 browsers to return bool
				value = !!value;
			} else {
				value = $element.attr( method );
			}

			this.normalizeAttributeRule( rules, type, method, value );
		}

		// 'maxlength' may be returned as -1, 2147483647 ( IE ) and 524288 ( safari ) for text inputs
		if ( rules.maxlength && /-1|2147483647|524288/.test( rules.maxlength ) ) {
			delete rules.maxlength;
		}

		return rules;
	},

	dataRules: function( element ) {
		var rules = {},
			$element = $( element ),
			type = element.getAttribute( "type" ),
			method, value;

		for ( method in $.validator.methods ) {
			value = $element.data( "rule" + method.charAt( 0 ).toUpperCase() + method.substring( 1 ).toLowerCase() );

			// Cast empty attributes like `data-rule-required` to `true`
			if ( value === "" ) {
				value = true;
			}

			this.normalizeAttributeRule( rules, type, method, value );
		}
		return rules;
	},

	staticRules: function( element ) {
		var rules = {},
			validator = $.data( element.form, "validator" );

		if ( validator.settings.rules ) {
			rules = $.validator.normalizeRule( validator.settings.rules[ element.name ] ) || {};
		}
		return rules;
	},

	normalizeRules: function( rules, element ) {

		// Handle dependency check
		$.each( rules, function( prop, val ) {

			// Ignore rule when param is explicitly false, eg. required:false
			if ( val === false ) {
				delete rules[ prop ];
				return;
			}
			if ( val.param || val.depends ) {
				var keepRule = true;
				switch ( typeof val.depends ) {
				case "string":
					keepRule = !!$( val.depends, element.form ).length;
					break;
				case "function":
					keepRule = val.depends.call( element, element );
					break;
				}
				if ( keepRule ) {
					rules[ prop ] = val.param !== undefined ? val.param : true;
				} else {
					$.data( element.form, "validator" ).resetElements( $( element ) );
					delete rules[ prop ];
				}
			}
		} );

		// Evaluate parameters
		$.each( rules, function( rule, parameter ) {
			rules[ rule ] = $.isFunction( parameter ) && rule !== "normalizer" ? parameter( element ) : parameter;
		} );

		// Clean number parameters
		$.each( [ "minlength", "maxlength" ], function() {
			if ( rules[ this ] ) {
				rules[ this ] = Number( rules[ this ] );
			}
		} );
		$.each( [ "rangelength", "range" ], function() {
			var parts;
			if ( rules[ this ] ) {
				if ( $.isArray( rules[ this ] ) ) {
					rules[ this ] = [ Number( rules[ this ][ 0 ] ), Number( rules[ this ][ 1 ] ) ];
				} else if ( typeof rules[ this ] === "string" ) {
					parts = rules[ this ].replace( /[\[\]]/g, "" ).split( /[\s,]+/ );
					rules[ this ] = [ Number( parts[ 0 ] ), Number( parts[ 1 ] ) ];
				}
			}
		} );

		if ( $.validator.autoCreateRanges ) {

			// Auto-create ranges
			if ( rules.min != null && rules.max != null ) {
				rules.range = [ rules.min, rules.max ];
				delete rules.min;
				delete rules.max;
			}
			if ( rules.minlength != null && rules.maxlength != null ) {
				rules.rangelength = [ rules.minlength, rules.maxlength ];
				delete rules.minlength;
				delete rules.maxlength;
			}
		}

		return rules;
	},

	// Converts a simple string to a {string: true} rule, e.g., "required" to {required:true}
	normalizeRule: function( data ) {
		if ( typeof data === "string" ) {
			var transformed = {};
			$.each( data.split( /\s/ ), function() {
				transformed[ this ] = true;
			} );
			data = transformed;
		}
		return data;
	},

	// https://jqueryvalidation.org/jQuery.validator.addMethod/
	addMethod: function( name, method, message ) {
		$.validator.methods[ name ] = method;
		$.validator.messages[ name ] = message !== undefined ? message : $.validator.messages[ name ];
		if ( method.length < 3 ) {
			$.validator.addClassRules( name, $.validator.normalizeRule( name ) );
		}
	},

	// https://jqueryvalidation.org/jQuery.validator.methods/
	methods: {

		// https://jqueryvalidation.org/required-method/
		required: function( value, element, param ) {

			// Check if dependency is met
			if ( !this.depend( param, element ) ) {
				return "dependency-mismatch";
			}
			if ( element.nodeName.toLowerCase() === "select" ) {

				// Could be an array for select-multiple or a string, both are fine this way
				var val = $( element ).val();
				return val && val.length > 0;
			}
			if ( this.checkable( element ) ) {
				return this.getLength( value, element ) > 0;
			}
			return value !== undefined && value !== null && value.length > 0;
		},

		// https://jqueryvalidation.org/email-method/
		email: function( value, element ) {

			// From https://html.spec.whatwg.org/multipage/forms.html#valid-e-mail-address
			// Retrieved 2014-01-14
			// If you have a problem with this implementation, report a bug against the above spec
			// Or use custom methods to implement your own email validation
			return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test( value );
		},

		// https://jqueryvalidation.org/url-method/
		url: function( value, element ) {

			// Copyright (c) 2010-2013 Diego Perini, MIT licensed
			// https://gist.github.com/dperini/729294
			// see also https://mathiasbynens.be/demo/url-regex
			// modified to allow protocol-relative URLs
			return this.optional( element ) || /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/i.test( value );
		},

		// https://jqueryvalidation.org/date-method/
		date: ( function() {
			var called = false;

			return function( value, element ) {
				if ( !called ) {
					called = true;
					if ( this.settings.debug && window.console ) {
						console.warn(
							"The `date` method is deprecated and will be removed in version '2.0.0'.\n" +
							"Please don't use it, since it relies on the Date constructor, which\n" +
							"behaves very differently across browsers and locales. Use `dateISO`\n" +
							"instead or one of the locale specific methods in `localizations/`\n" +
							"and `additional-methods.js`."
						);
					}
				}

				return this.optional( element ) || !/Invalid|NaN/.test( new Date( value ).toString() );
			};
		}() ),

		// https://jqueryvalidation.org/dateISO-method/
		dateISO: function( value, element ) {
			return this.optional( element ) || /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test( value );
		},

		// https://jqueryvalidation.org/number-method/
		number: function( value, element ) {
			return this.optional( element ) || /^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test( value );
		},

		// https://jqueryvalidation.org/digits-method/
		digits: function( value, element ) {
			return this.optional( element ) || /^\d+$/.test( value );
		},

		// https://jqueryvalidation.org/minlength-method/
		minlength: function( value, element, param ) {
			var length = $.isArray( value ) ? value.length : this.getLength( value, element );
			return this.optional( element ) || length >= param;
		},

		// https://jqueryvalidation.org/maxlength-method/
		maxlength: function( value, element, param ) {
			var length = $.isArray( value ) ? value.length : this.getLength( value, element );
			return this.optional( element ) || length <= param;
		},

		// https://jqueryvalidation.org/rangelength-method/
		rangelength: function( value, element, param ) {
			var length = $.isArray( value ) ? value.length : this.getLength( value, element );
			return this.optional( element ) || ( length >= param[ 0 ] && length <= param[ 1 ] );
		},

		// https://jqueryvalidation.org/min-method/
		min: function( value, element, param ) {
			return this.optional( element ) || value >= param;
		},

		// https://jqueryvalidation.org/max-method/
		max: function( value, element, param ) {
			return this.optional( element ) || value <= param;
		},

		// https://jqueryvalidation.org/range-method/
		range: function( value, element, param ) {
			return this.optional( element ) || ( value >= param[ 0 ] && value <= param[ 1 ] );
		},

		// https://jqueryvalidation.org/step-method/
		step: function( value, element, param ) {
			var type = $( element ).attr( "type" ),
				errorMessage = "Step attribute on input type " + type + " is not supported.",
				supportedTypes = [ "text", "number", "range" ],
				re = new RegExp( "\\b" + type + "\\b" ),
				notSupported = type && !re.test( supportedTypes.join() ),
				decimalPlaces = function( num ) {
					var match = ( "" + num ).match( /(?:\.(\d+))?$/ );
					if ( !match ) {
						return 0;
					}

					// Number of digits right of decimal point.
					return match[ 1 ] ? match[ 1 ].length : 0;
				},
				toInt = function( num ) {
					return Math.round( num * Math.pow( 10, decimals ) );
				},
				valid = true,
				decimals;

			// Works only for text, number and range input types
			// TODO find a way to support input types date, datetime, datetime-local, month, time and week
			if ( notSupported ) {
				throw new Error( errorMessage );
			}

			decimals = decimalPlaces( param );

			// Value can't have too many decimals
			if ( decimalPlaces( value ) > decimals || toInt( value ) % toInt( param ) !== 0 ) {
				valid = false;
			}

			return this.optional( element ) || valid;
		},

		// https://jqueryvalidation.org/equalTo-method/
		equalTo: function( value, element, param ) {

			// Bind to the blur event of the target in order to revalidate whenever the target field is updated
			var target = $( param );
			if ( this.settings.onfocusout && target.not( ".validate-equalTo-blur" ).length ) {
				target.addClass( "validate-equalTo-blur" ).on( "blur.validate-equalTo", function() {
					$( element ).valid();
				} );
			}
			return value === target.val();
		},

		// https://jqueryvalidation.org/remote-method/
		remote: function( value, element, param, method ) {
			if ( this.optional( element ) ) {
				return "dependency-mismatch";
			}

			method = typeof method === "string" && method || "remote";

			var previous = this.previousValue( element, method ),
				validator, data, optionDataString;

			if ( !this.settings.messages[ element.name ] ) {
				this.settings.messages[ element.name ] = {};
			}
			previous.originalMessage = previous.originalMessage || this.settings.messages[ element.name ][ method ];
			this.settings.messages[ element.name ][ method ] = previous.message;

			param = typeof param === "string" && { url: param } || param;
			optionDataString = $.param( $.extend( { data: value }, param.data ) );
			if ( previous.old === optionDataString ) {
				return previous.valid;
			}

			previous.old = optionDataString;
			validator = this;
			this.startRequest( element );
			data = {};
			data[ element.name ] = value;
			$.ajax( $.extend( true, {
				mode: "abort",
				port: "validate" + element.name,
				dataType: "json",
				data: data,
				context: validator.currentForm,
				success: function( response ) {
					var valid = response === true || response === "true",
						errors, message, submitted;

					validator.settings.messages[ element.name ][ method ] = previous.originalMessage;
					if ( valid ) {
						submitted = validator.formSubmitted;
						validator.resetInternals();
						validator.toHide = validator.errorsFor( element );
						validator.formSubmitted = submitted;
						validator.successList.push( element );
						validator.invalid[ element.name ] = false;
						validator.showErrors();
					} else {
						errors = {};
						message = response || validator.defaultMessage( element, { method: method, parameters: value } );
						errors[ element.name ] = previous.message = message;
						validator.invalid[ element.name ] = true;
						validator.showErrors( errors );
					}
					previous.valid = valid;
					validator.stopRequest( element, valid );
				}
			}, param ) );
			return "pending";
		}
	}

} );

// Ajax mode: abort
// usage: $.ajax({ mode: "abort"[, port: "uniqueport"]});
// if mode:"abort" is used, the previous request on that port (port can be undefined) is aborted via XMLHttpRequest.abort()

var pendingRequests = {},
	ajax;

// Use a prefilter if available (1.5+)
if ( $.ajaxPrefilter ) {
	$.ajaxPrefilter( function( settings, _, xhr ) {
		var port = settings.port;
		if ( settings.mode === "abort" ) {
			if ( pendingRequests[ port ] ) {
				pendingRequests[ port ].abort();
			}
			pendingRequests[ port ] = xhr;
		}
	} );
} else {

	// Proxy ajax
	ajax = $.ajax;
	$.ajax = function( settings ) {
		var mode = ( "mode" in settings ? settings : $.ajaxSettings ).mode,
			port = ( "port" in settings ? settings : $.ajaxSettings ).port;
		if ( mode === "abort" ) {
			if ( pendingRequests[ port ] ) {
				pendingRequests[ port ].abort();
			}
			pendingRequests[ port ] = ajax.apply( this, arguments );
			return pendingRequests[ port ];
		}
		return ajax.apply( this, arguments );
	};
}
return $;
}));

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_RESULT__ = (function() {

  // Simple JavaScript Templating
  // John Resig - http://ejohn.org/ - MIT Licensed

  var cache = {};
  
  var template = function tmpl(str, data, useCache){

    useCache = useCache || true;    

    // Figure out if we're getting a template, or if we need to
    // load the template - and be sure to cache the result.
    var fn = !/\W/.test(str) ?
      
      ( useCache ?
        (cache[str] = cache[str] || tmpl(document.getElementById(str).innerHTML))
        :
        tmpl(document.getElementById(str).innerHTML)
      )

      :
      
      // Generate a reusable function that will serve as a template
      // generator (and which will be cached).
      new Function("obj",
        "var p=[], print=function(){p.push.apply(p,arguments);};" +
        
        // Introduce the data as local variables using with(){}
        "with(obj){p.push('" +
        
        // Convert the template into pure JavaScript
        str
          .replace(/[\r\t\n]/g, " ")
          .split("<%").join("\t")
          .replace(/((^|%>)[^\t]*)'/g, "$1\r")  // replace code
          .replace(/\t=(.*?)%>/g, "',$1,'")     // replace variable
          .split("\t").join("');")
          .split("%>").join("p.push('")
          .split("\r").join("\\'")
      + "');}return p.join('');");
    
    // Provide some basic currying to the user
    return data ? fn( data ) : fn;
  };
 
  return template;

}).call(exports, __webpack_require__, exports, module),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 7 */
/***/ (function(module, exports) {

module.exports = moment;

/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

(function (global, factory) {
   true ? module.exports = factory() :
  undefined;
}(this, (function () { 'use strict';

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var defaults = {
  tName: 't',
  i18nName: 'i18n',
  handleName: 'localize',
  selectorAttr: 'data-i18n',
  targetAttr: 'i18n-target',
  optionsAttr: 'i18n-options',
  useOptionsAttr: false,
  parseDefaultValueFromContent: true
};

function init(i18next, $) {
  var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};


  options = _extends({}, defaults, options);

  function parse(ele, key, opts) {
    if (key.length === 0) return;

    var attr = 'text';

    if (key.indexOf('[') === 0) {
      var parts = key.split(']');
      key = parts[1];
      attr = parts[0].substr(1, parts[0].length - 1);
    }

    if (key.indexOf(';') === key.length - 1) {
      key = key.substr(0, key.length - 2);
    }

    function extendDefault(o, val) {
      if (!options.parseDefaultValueFromContent) return o;
      return _extends({}, o, { defaultValue: val });
    }

    if (attr === 'html') {
      ele.html(i18next.t(key, extendDefault(opts, ele.html())));
    } else if (attr === 'text') {
      ele.text(i18next.t(key, extendDefault(opts, ele.text())));
    } else if (attr === 'prepend') {
      ele.prepend(i18next.t(key, extendDefault(opts, ele.html())));
    } else if (attr === 'append') {
      ele.append(i18next.t(key, extendDefault(opts, ele.html())));
    } else if (attr.indexOf('data-') === 0) {
      var dataAttr = attr.substr('data-'.length);
      var translated = i18next.t(key, extendDefault(opts, ele.data(dataAttr)));

      // we change into the data cache
      ele.data(dataAttr, translated);
      // we change into the dom
      ele.attr(attr, translated);
    } else {
      ele.attr(attr, i18next.t(key, extendDefault(opts, ele.attr(attr))));
    }
  }

  function localize(ele, opts) {
    var key = ele.attr(options.selectorAttr);
    if (!key && typeof key !== 'undefined' && key !== false) key = ele.text() || ele.val();
    if (!key) return;

    var target = ele,
        targetSelector = ele.data(options.targetAttr);

    if (targetSelector) target = ele.find(targetSelector) || ele;

    if (!opts && options.useOptionsAttr === true) opts = ele.data(options.optionsAttr);

    opts = opts || {};

    if (key.indexOf(';') >= 0) {
      var keys = key.split(';');

      $.each(keys, function (m, k) {
        // .trim(): Trim the comma-separated parameters on the data-i18n attribute.
        if (k !== '') parse(target, k.trim(), opts);
      });
    } else {
      parse(target, key, opts);
    }

    if (options.useOptionsAttr === true) {
      var clone = {};
      clone = _extends({ clone: clone }, opts);

      delete clone.lng;
      ele.data(options.optionsAttr, clone);
    }
  }

  function handle(opts) {
    return this.each(function () {
      // localize element itself
      localize($(this), opts);

      // localize children
      var elements = $(this).find('[' + options.selectorAttr + ']');
      elements.each(function () {
        localize($(this), opts);
      });
    });
  };

  // $.t $.i18n shortcut
  $[options.tName] = i18next.t.bind(i18next);
  $[options.i18nName] = i18next;

  // selector function $(mySelector).localize(opts);
  $.fn[options.handleName] = handle;
}

var index = {
  init: init
};

return index;

})));

/***/ }),
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(2),__webpack_require__(31)], __WEBPACK_AMD_DEFINE_RESULT__ = (function(commonServices, LoaderSpinner){

  var loader = {

  	loaderSpinner: null,
    showing: false,

  	show: function() {

      console.log('show loader');

      if (this.showing) {
        return;
      }

  		if (commonServices.customLoader) {
				$('#full_loader').show();
  		}
  		else {
  			this.getLoader().show();
  		}

      this.showing = true;

  	},

  	hide: function() {

      console.log('hide loader');

  		if (commonServices.customLoader) {
        $('#full_loader').hide();
      }
      else {
				this.getLoader().hide();
      }

      this.showing = false;

  	},

  	getLoader: function() {

  		if (this.loaderSpinner == null) {
  			this.loaderSpinner = new LoaderSpinner();
  		}

  		return this.loaderSpinner;

  	}

  }

  return loader;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {/* Inicialización en español para la extensión 'UI date picker' para jQuery. */
/* Traducido por Vester (xvester@gmail.com). */
(function($){
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {/* Datepicker Validation 1.0.1 for jQuery UI Datepicker 1.8.6.
   Requires J�rn Zaefferer's Validation plugin (http://plugins.jquery.com/project/validate).
   Written by Keith Wood (kbwood{at}iinet.com.au).
   Dual licensed under the GPL (http://dev.jquery.com/browser/trunk/jquery/GPL-LICENSE.txt) and 
   MIT (http://dev.jquery.com/browser/trunk/jquery/MIT-LICENSE.txt) licenses. 
   Please attribute the author if you use it. */

(function($) { // Hide the namespace

/* Add validation methods if validation plugin available. */
if ($.fn.validate) {

	$.datepicker._selectDate2 = $.datepicker._selectDate;
	
	$.extend($.datepicker.regional[''], {
		validateDate: 'Please enter a valid date',
		validateDateMin: 'Please enter a date on or after {0}',
		validateDateMax: 'Please enter a date on or before {0}',
		validateDateMinMax: 'Please enter a date between {0} and {1}',
		validateDateCompare: 'Please enter a date {0} {1}',
		validateDateToday: 'today',
		validateDateOther: 'the other date',
		validateDateEQ: 'equal to',
		validateDateNE: 'not equal to',
		validateDateLT: 'before',
		validateDateGT: 'after',
		validateDateLE: 'not after',
		validateDateGE: 'not before'
	});
	
	$.extend($.datepicker._defaults, $.datepicker.regional['']);

	$.extend($.datepicker, {

		/* Trigger a validation after updating the input field with the selected date.
		   @param  id       (string) the ID of the target field
		   @param  dateStr  (string) the chosen date */
		_selectDate: function(id, dateStr) {
			this._selectDate2(id, dateStr);
			var input = $(id);
			var inst = this._getInst(input[0]);
			if (!inst.inline && $.fn.validate)
				input.parents('form').validate().element(input);
		},

		/* Correct error placement for validation errors - after (before if R-T-L) any trigger.
		   @param  error    (jQuery) the error message
		   @param  element  (jQuery) the field in error */
		errorPlacement: function(error, element) {
			var trigger = element.next('.' + $.datepicker._triggerClass);
			var before = false;
			if (trigger.length == 0) {
				trigger = element.prev('.' + $.datepicker._triggerClass);
				before = (trigger.length > 0);
			}
			error[before ? 'insertBefore' : 'insertAfter'](trigger.length > 0 ? trigger : element);
		},

		/* Format a validation error message involving dates.
		   @param  message  (string) the error message
		   @param  params  (Date[]) the dates
		   @return  (string) the formatted message */
		errorFormat: function(inst, message, params) {
			var format = $.datepicker._get(inst, 'dateFormat');
			$.each(params, function(i, v) {
				message = message.replace(new RegExp('\\{' + i + '\\}', 'g'),
					$.datepicker.formatDate(format, v) || 'nothing');
			});
			return message;
		}
	});

	var lastElement = null;

	/* Validate date field. */
	$.validator.addMethod('dpDate', function(value, element, params) {
			lastElement = element;
			var inst = $.datepicker._getInst(element);
			var dateFormat = $.datepicker._get(inst, 'dateFormat');
			try {
				var date = $.datepicker.parseDate(dateFormat, value, $.datepicker._getFormatConfig(inst));
				var minDate = $.datepicker._determineDate(inst, $.datepicker._get(inst, 'minDate'), null);
				var maxDate = $.datepicker._determineDate(inst, $.datepicker._get(inst, 'maxDate'), null);
				var beforeShowDay = $.datepicker._get(inst, 'beforeShowDay');
				return this.optional(element) || !date || 
					((!minDate || date >= minDate) && (!maxDate || date <= maxDate) &&
					(!beforeShowDay || beforeShowDay.apply(element, [date])[0]));
			}
			catch (e) {
				return false;
			}
		}, function(params) {
			var inst = $.datepicker._getInst(lastElement);
			var minDate = $.datepicker._determineDate(inst, $.datepicker._get(inst, 'minDate'), null);
			var maxDate = $.datepicker._determineDate(inst, $.datepicker._get(inst, 'maxDate'), null);
			var messages = $.datepicker._defaults;
			return (minDate && maxDate ?
				$.datepicker.errorFormat(inst, messages.validateDateMinMax, [minDate, maxDate]) :
				(minDate ? $.datepicker.errorFormat(inst, messages.validateDateMin, [minDate]) :
				(maxDate ? $.datepicker.errorFormat(inst, messages.validateDateMax, [maxDate]) :
				messages.validateDate)));
		});

	/* And allow as a class rule. */
	$.validator.addClassRules('dpDate', {dpDate: true});

	var comparisons = {equal: 'eq', same: 'eq', notEqual: 'ne', notSame: 'ne',
		lessThan: 'lt', before: 'lt', greaterThan: 'gt', after: 'gt',
		notLessThan: 'ge', notBefore: 'ge', notGreaterThan: 'le', notAfter: 'le'};

	/* Cross-validate date fields.
	   params should be an array with [0] comparison type eq/ne/lt/gt/le/ge or synonyms,
	   [1] 'today' or date string or Date or other field selector/element/jQuery OR
	   an object with one attribute with name eq/ne/lt/gt/le/ge or synonyms
	   and value 'today' or date string or Date or other field selector/element/jQuery OR
	   a string with eq/ne/lt/gt/le/ge or synonyms followed by 'today' or date string or jQuery selector */
	$.validator.addMethod('dpCompareDate', function(value, element, params) {
			if (this.optional(element)) {
				return true;
			}
			params = normaliseParams(params);
			var thisDate = $(element).datepicker('getDate');
			var thatDate = extractOtherDate(element, params[1]);
			if (!thisDate || !thatDate) {
				return true;
			}
			lastElement = element;
			var result = true;
			switch (comparisons[params[0]] || params[0]) {
				case 'eq': result = (thisDate.getTime() == thatDate.getTime()); break;
				case 'ne': result = (thisDate.getTime() != thatDate.getTime()); break;
				case 'lt': result = (thisDate.getTime() < thatDate.getTime()); break;
				case 'gt': result = (thisDate.getTime() > thatDate.getTime()); break;
				case 'le': result = (thisDate.getTime() <= thatDate.getTime()); break;
				case 'ge': result = (thisDate.getTime() >= thatDate.getTime()); break;
				default:   result = true;
			}
			return result;
		},
		function(params) {
			var inst = $.datepicker._getInst(lastElement);
			var messages = $.datepicker._defaults;
			params = normaliseParams(params);
			var thatDate = extractOtherDate(lastElement, params[1], true);
			thatDate = (params[1] == 'today' ? messages.validateDateToday : (thatDate ?
				$.datepicker.formatDate($.datepicker._get(inst, 'dateFormat'), thatDate,
				$.datepicker._getFormatConfig(inst)) : messages.validateDateOther));
			return messages.validateDateCompare.replace(/\{0\}/,
				messages['validateDate' + (comparisons[params[0]] || params[0]).toUpperCase()]).
				replace(/\{1\}/, thatDate);
		});

	/* Normalise the comparison parameters to an array.
	   @param  params  (array or object or string) the original parameters
	   @return  (array) the normalised parameters */
	function normaliseParams(params) {
		if (typeof params == 'string') {
			params = params.split(' ');
		}
		else if (!$.isArray(params)) {
			var opts = [];
			for (var name in params) {
				opts[0] = name;
				opts[1] = params[name];
			}
			params = opts;
		}
		return params;
	}

	/* Determine the comparison date.
	   @param  element  (element) the current datepicker element
	   @param  source   (string or Date or jQuery or element) the source of the other date
	   @param  noOther  (boolean) true to not get the date from another field
	   @return  (Date) the date for comparison */
	function extractOtherDate(element, source, noOther) {
		if (source.constructor == Date) {
			return source;
		}
		var inst = $.datepicker._getInst(element);
		var thatDate = null;
		try {
			if (typeof source == 'string' && source != 'today') {
				thatDate = $.datepicker.parseDate($.datepicker._get(inst, 'dateFormat'),
					source, $.datepicker._getFormatConfig(inst));
			}
		}
		catch (e) {
			// Ignore
		}
		thatDate = (thatDate ? thatDate : (source == 'today' ? new Date() :
			(noOther ? null : $(source).datepicker('getDate'))));
		if (thatDate) {
			thatDate.setHours(0, 0, 0, 0);
		}
		return thatDate;
	}
}

})(jQuery);

/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(33),__webpack_require__(34), __webpack_require__(35)], __WEBPACK_AMD_DEFINE_RESULT__ = (function(ListSelectorModel, SelectSelectorController, SelectSelectorView) {

  /* ---------------------------
     SelectSelector
     ---------------------------
     A component to select a element or elements from a list using a html SELECT control

     It uses the ListSelectorModel as a model
  
     == Parameters::

     @params [String] selectorControlId: The selector element id
     @params [YSDAbstractDataSource] dataSource: The datasource 
     @params [Object] value: The current value
     @params [Boolean] nullOption: Accepts null 
     @params [String] nullOptionText: The text to show
     @params [function] callback 

   */
  var YSDSelectSelector = function(selectControlId, dataSource, value, nullOption, nullOptionText, callback) {

    this.model = new ListSelectorModel(dataSource, value);
    this.controller = new SelectSelectorController();
    this.view = new SelectSelectorView(this.model, this.controller, selectControlId, nullOption, nullOptionText, callback);

    this.setValue = function(newValue) {
      this.model.setValue(newValue);
    }

    this.stop = function() {
      this.model.removeEventListener();
    }
    

    this.controller.setView(this.view);
    this.model.setView(this.view);

    this.model.retrieveData(); /* Retrieve model data */

  }

  return YSDSelectSelector;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0), __webpack_require__(20)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, YSDEventTarget) {
 
  /**
   * Rent Engine Mediator
   */
  rentEngineMediator = {

    events: new YSDEventTarget(),

    // -- Delegates

    chooseSingleProductDelegate: null,
    chooseMultipleProductsDelegate: null,
    chooseExtrasDelegate: null,
    checkoutDelegate: null,
    newReservationPaymentDelegate: null,
    existingReservationPaymentDelegate: null,

    // -- Rent engine components

    chooseProduct: null,
    chooseExtras: null,
    complete: null,
    summary: null,
    myReservation: null,
    productCalendar: null,

    
    addListener: function(type, listener) { /* addListener */
       this.events.addEventListener(type, listener);  
    },
      
    removeListener: function(type, listener) { /* removeListener */
       this.events.removeEventListener(type, listener);     
    },

    removeListeners: function(type) { /* remove listeners*/
       this.events.removeEventListeners(type);
    },

    // --------- Configure reservation engine components

    /**
     * Set choose product
     */
    setChooseProduct( chooseProduct ) {
       this.chooseProduct = chooseProduct;
    },

    /**
     * Set choose extras 
     */
    setChooseExtras( chooseExtras ) {
       this.chooseExtras = chooseExtras;
    },

    /**
     * Set complete 
     */
    setComplete( complete ) {
       this.complete = complete;
    },

    /**
     * Set summary
     */
    setSummary( summary ) {
       this.summary = summary;
    },

    /**
     * Set myReservation
     */
    setMyReservation( myReservation ) {
       this.myReservation = myReservation;
    },

    setProductCalendar( productCalendar ) {
       this.productCalendar = productCalendar;
    },       

    // -----------------------------------

    /**
     * Setup
     */
    setupDelegate: function( delegate ) {

      if (typeof delegate.chooseSingleProduct === 'function') {
        this.chooseSingleProductDelegate = delegate.chooseSingleProduct;
      }

      if (typeof delegate.chooseMultipleProducts === 'function') {
        this.chooseMultipleProductsDelegate = delegate.chooseMultipleProducts;
      }

      if (typeof delegate.chooseExtras === 'function') {
        this.chooseExtrasDelegate = delegate.chooseExtras;
      }

      if (typeof delegate.checkout === 'function') {
        this.checkoutDelegate = delegate.checkout;
      }            

      if (typeof delegate.newReservationPayment === 'function') {
        this.newReservationPaymentDelegate = delegate.newReservationPayment;
      }

      if (typeof delegate.existingReservationPayment === 'function') {
        this.existingReservationPaymentDelegate = delegate.existingReservationPayment;
      }

    },

    // ========= Interaction

    // --------- Choose Single Products

    /**
     * Before choose single product => Act to avoid the selection
     *
     * == Parameters::
     *
     * @productCode:: The selected product code
     * @hasCoverage:: If it has a coverage
     * @coverageCode:: The current coverage code
     * @products:: The products detail
     * @shoppingCart:: The current shopping cart
     *
     */
    onChooseSingleProduct: function ( productCode, 
                                      hasCoverage, 
                                      coverageCode, 
                                      products, 
                                      shoppingCart ) {

      console.log('rentEngineMediator_chooseSingleProduct');

      if (typeof this.chooseSingleProductDelegate === 'function') {
        // Prepare data
        var selectedProduct = products.find(function(element) { return element.code === productCode });
        var data = { 
                      productCode: productCode,
                      product: selectedProduct,
                      products: products,
                      shoppingCart: shoppingCart,
                      hasCoverage: hasCoverage
                   };
        // Information about coverage
        if ( hasCoverage ) {
          var coverageInfo = this.coverageDetail(selectedProduct.coverage, coverageCode);
          data.availableCoverage = coverageInfo.availableCoverage;
          data.selectedCoverage = coverageInfo.selectedCoverage;
          data.fullCoverage = coverageInfo.fullCoverage;
          data.coverageCode = coverageCode;
        }
        // Invoke delegate
        this.chooseSingleProductDelegate( data, this );
      }
      else {
        this.continueSelectSingleProduct( productCode, coverageCode );
      }

    },
    
    /**
     * Select the product
     */
    continueSelectSingleProduct: function( productCode, coverageCode ) {

      if (this.chooseProduct != null) {
        this.chooseProduct.model.selectProduct( productCode, 1, coverageCode );
      }

    },

    // --------- Choose Multiple Products

    /**
     * Choose multiple products => Act to avoid pass to the next step
     * 
     * == Parameters::
     *
     * @shoppingCart:: The shopping cart
     *
     */
    onChooseMultipleProducts: function( shoppingCart ) {

      console.log('rentEngineMediator_chooseMultipleProducts');

      if (typeof this.chooseMultipleProductsDelegate === 'function') {
        var data = { 
                      shoppingCart: shoppingCart
                   }
        this.chooseMultipleProductsDelegate( data, this );
      } 
      else {
        this.continueSelectMultipleProducts( );
      }

    },

    /**
     * Continue Select Multiple Products
     */
    continueSelectMultipleProducts: function() {

      if ( this.chooseProduct != null ) {
        this.chooseProduct.view.gotoNextStep();
      }

    },

    // --------- Choose Extras

    /**
     * Choose Extras
     *
     * == Parameters::
     *
     * @shoppingCart:: The shopping cart
     *
     */
    onChooseExtras: function( shoppingCart ) {

      console.log('rentEngineMediator_chooseExtras');

      if (typeof this.chooseExtrasDelegate === 'function') {
        var data = { 
                      shoppingCart: shoppingCart
                   }
        this.chooseExtrasDelegate( data, this );
      }
      else {
        this.continueSelectExtras();
      }

    },

    /**
     * Continue select extras
     */
    continueSelectExtras: function() {

      if (this.chooseExtras != null) {
        this.chooseExtras.view.gotoNextStep();
      }


    },


    // --------- Complete

    /**
     * Before checkout => Act to avoid checkout
     *
     * == Parameters::
     *
     * @coverages:: The coverage options
     * @extras:: The extra options
     * @shoppingCart:: The shopping cart
     *
     */
    onCheckout: function( coverages, 
                          extras, 
                          shoppingCart ) {

      console.log('rentEngineMediator_checkout');
      if (typeof this.checkoutDelegate === 'function') {
        var data = {  
                      coverages: coverages,
                      extras: extras,  
                      shoppingCart: shoppingCart
                   }
        // Find current selected coverage
        if (shoppingCart.extras != null && shoppingCart.extras instanceof Array) {
          var coverageCode = null;
          var selectedCoverage = shoppingCart.extras.find(function(element){
                                    var found = coverages.find(function(coverageElement){
                                      return element.extra_id === coverageElement.code;
                                    });
                                    return found;
                                 });
          if (selectedCoverage != null) {
            coverageCode = selectedCoverage.extra_id;
          }
          var coverageInfo = this.coverageDetail(coverages, coverageCode);
          data.availableCoverage = coverageInfo.availableCoverage;
          data.selectedCoverage = coverageInfo.selectedCoverage;
          data.fullCoverage = coverageInfo.fullCoverage;
        }
        this.checkoutDelegate( data, this );
      }
      else {
        this.continueCheckout();
      }

    },

    /**
     * Continue checkout
     */
    continueCheckout: function() {

      if (this.complete != null) {
        this.complete.model.sendBookingRequest();
      }

    },

    // ----------- New reservation payment
    
    /**
     * on new reservation payment
     */
    onNewReservationPayment: function(url, summaryUrl, paymentData) {

      console.log('rentEngineMediator_checkout');
      if (typeof this.newReservationPaymentDelegate === 'function') {
        var data = { url: url,
                     summaryUrl: summaryUrl,
                     paymentData: paymentData};
        console.log(data);             
        this.newReservationPaymentDelegate(data, this);
      }
      else {
        this.continueNewReservationPayment(url, paymentData, this);
      }      

    },

    /**
     * Continue new reservation payment
     */
    continueNewReservationPayment: function(url, paymentData) {

      if (this.complete != null) {
        this.complete.view.gotoPayment(url, paymentData);
      }

    },

    //
    
    /**
     * onExisting reservation payment
     */
    onExistingReservationPayment: function(url, paymentData) {

      console.log('rentEngineMediator_checkout');
      if (typeof this.existingReservationPaymentDelegate === 'function') {
        var data = { url: url,
                     paymentData: paymentData};
        this.existingReservationPaymentDelegate(data, this);
      }
      else {
        this.continueExistingReservationPayment(url, paymentData);
      }  

    },

    /**
     * continue existing reservation payment
     */
    continueExistingReservationPayment: function(url, paymentData) {

      if (this.myReservation != null) {
        this.myReservation.view.gotoPayment(url, paymentData);
      }

    },

    // ----------- Utilities

    /**
     * Get coverage detailed information
     */
    coverageDetail : function(coverage, coverageCode) {

      var result = {availableCoverage: null,
                    selectedCoverage: null,
                    fullCoverage: null};

      if (coverage != null && coverage instanceof Array) {
        var availableCoverage = coverage.sort(function(x,y){
                                                  if (x.price < y.price) {
                                                    return -1;
                                                  }
                                                  if (x.price > y.price) {
                                                    return 1;
                                                  }
                                                  return 0;
                                                }).reverse();
        result.availableCoverage = availableCoverage;
        if (availableCoverage.length > 0) {
          if (coverageCode != null) {
            result.selectedCoverage = availableCoverage.find(function(element) { return element.code == coverageCode });
          }
          result.fullCoverage = availableCoverage[0];
        }
      }

      return result;

    },

    // ----------- Notifications

    /**
     * NotifyEvent
     */
    notifyEvent: function( event ) {

      console.log('rentEngineMediator_notify');

      this.events.fireEvent( event );

    }


  };

  return rentEngineMediator;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(28),__webpack_require__(0)], __WEBPACK_AMD_DEFINE_RESULT__ = (function(YSDAbstractDataSource, $) {

  /* --------------------------------
     RemoteDataSource
     -------------------------------- */
  YSDRemoteDataSource = function(url, matchingProperties, adapters) {

    YSDAbstractDataSource.apply(this, arguments);

    this.url  = url;
    this.matchingProperties = matchingProperties;
    this.adapters = adapters || [];
    this.data = [];
  
    this.retrieveData = function(query) { /* Retrieve data function */
    
      var self = this;
        
      $.getJSON(this.url,
                query,
                function success_handler(data) {
                  self.data = data;
                  self.events.fireEvent({type:'data_available', data: self.adaptData(self.data, self.matchingProperties, self.adapters)});
                });          
    
    }
  
  }

  YSDRemoteDataSource.prototype = new YSDAbstractDataSource();
  YSDRemoteDataSource.constructor = YSDRemoteDataSource;
 
  return YSDRemoteDataSource;
  
}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 15 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {/* Inicialización en español para la extensión 'UI date picker' para jQuery. */
/* Traducido por Vester (xvester@gmail.com). */
/* https://github.com/jquery/jquery-ui/tree/master/ui/i18n */
(function($){
    $.datepicker.regional['ca'] = {
        closeText: "Tanca",
        prevText: "Anterior",
        nextText: "Següent",
        currentText: "Avui",
        monthNames: [ "Gener","Febrer","Març","Abril","Maig","Juny",
            "Juliol","Agost","Setembre","Octubre","Novembre","Desembre" ],
        monthNamesShort: [ "Gen","Feb","Març","Abr","Maig","Juny",
            "Jul","Ag","Set","Oct","Nov","Des" ],
        dayNames: [ "Diumenge","Dilluns","Dimarts","Dimecres","Dijous","Divendres","Dissabte" ],
        dayNamesShort: [ "Dg","Dl","Dt","Dc","Dj","Dv","Ds" ],
        dayNamesMin: [ "Dg","Dl","Dt","Dc","Dj","Dv","Ds" ],
        weekHeader: "Set",
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ""};
    $.datepicker.setDefaults($.datepicker.regional['ca']);
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {/* Inicialització en català per a l'extensió 'UI date picker' per jQuery. */
/* Writers: (joan.leon@gmail.com). */
/* Inicialización en español para la extensión 'UI date picker' para jQuery. */
/* Traducido por Vester (xvester@gmail.com). */
/* https://github.com/jquery/jquery-ui/tree/master/ui/i18n */
(function($){
    $.datepicker.regional['en'] = {
        closeText: "Done", // Display text for close link
        prevText: "Prev", // Display text for previous month link
        nextText: "Next", // Display text for next month link
        currentText: "Today", // Display text for current month link
        monthNames: [ "January","February","March","April","May","June",
            "July","August","September","October","November","December" ], // Names of months for drop-down and formatting
        monthNamesShort: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ], // For formatting
        dayNames: [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ], // For formatting
        dayNamesShort: [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ], // For formatting
        dayNamesMin: [ "Su","Mo","Tu","We","Th","Fr","Sa" ], // Column headings for days starting at Sunday
        weekHeader: "Wk", // Column header for week of the year
        dateFormat: "mm/dd/yy", // See format options on parseDate
        firstDay: 0, // The first day of the week, Sun = 0, Mon = 1, ...
        isRTL: false, // True if right-to-left language, false if left-to-right
        showMonthAfterYear: false, // True if the year select precedes month, false for month then year
        yearSuffix: "" // Additional text to append to the year in the month headers
    };
    $.datepicker.setDefaults($.datepicker.regional['en']);
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 17 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {/* Inicialización en español para la extensión 'UI date picker' para jQuery. */
/* Traducido por Vester (xvester@gmail.com). */
/* https://github.com/jquery/jquery-ui/tree/master/ui/i18n */
(function($){
	$.datepicker.regional['it'] = {
        closeText: "Chiudi",
        prevText: "&#x3C;Prec",
        nextText: "Succ&#x3E;",
        currentText: "Oggi",
        monthNames: [ "Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno",
            "Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre" ],
        monthNamesShort: [ "Gen","Feb","Mar","Apr","Mag","Giu",
            "Lug","Ago","Set","Ott","Nov","Dic" ],
        dayNames: [ "Domenica","Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato" ],
        dayNamesShort: [ "Dom","Lun","Mar","Mer","Gio","Ven","Sab" ],
        dayNamesMin: [ "Do","Lu","Ma","Me","Gi","Ve","Sa" ],
        weekHeader: "Sm",
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ""};
	$.datepicker.setDefaults($.datepicker.regional['it']);
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 18 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(28)], __WEBPACK_AMD_DEFINE_RESULT__ = (function(YSDAbstractDataSource) {

  /* --------------------------------
     MemoryDataSource
     --------------------------------
     A datasource which holds the data in the memory
  */
  
  YSDMemoryDataSource = function(_data, matchingProperties, adapters) {
	
    YSDAbstractDataSource.apply(this, arguments);
   
    if (_data instanceof Array) {
  
      this.data = [];
    
      for (index in _data) {
        if (_data[index] instanceof Object) {
          this.data.push(_data[index]);	
        }	
        else
        {
          this.data.push({'id':_data[index], 'description':_data[index]});	
        }
      }       
    } 
    else { 
      this.data = _data;
    }
  
    this.matchingProperties = matchingProperties;
    this.adapters = adapters || [];
  
    var self = this;
      
    this.retrieveData = function(query) { /* Retrieve Data function */
      this.events.fireEvent({type:'data_available', data: self.adaptData(self.data, self.matchingProperties, self.adapters)});
    }
  	
  }

  YSDMemoryDataSource.prototype = new YSDAbstractDataSource();
  YSDMemoryDataSource.constructor = YSDMemoryDataSource;

  return YSDMemoryDataSource;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {           jQuery(function($) {
             $.extend({
               form: function(url, data, method) {
                   if (method == null) method = 'POST';
                   if (data == null) data = {};

                   var form = $('<form>').attr({
                       method: method,
                       action: url
                   }).css({
                       display: 'none'
                   });

                   var addData = function(name, data) {
                       if ($.isArray(data)) {
                           for (var i = 0; i < data.length; i++) {
                               var value = data[i];
                               addData(name + '[]', value);
                           }
                       } else if (typeof data === 'object') {
                           for (var key in data) {
                               if (data.hasOwnProperty(key)) {
                                   addData(name + '[' + key + ']', data[key]);
                               }
                           }
                       } else if (data != null) {
                           form.append($('<input>').attr({
                               type: 'hidden',
                               name: String(name),
                               value: String(data)
                           }));
                       }
                   };

                   for (var key in data) {
                       if (data.hasOwnProperty(key)) {
                           addData(key, data[key]);
                       }
                   }

                   return form.appendTo('body');
               }
             });
           });
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {var __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_RESULT__ = (function() {
  
  //  
  // Inspired by Nicholas C. Zakas (http://www.nczonline.net/blog/2010/03/09/custom-events-in-javascript/)
  //
  YSDEventTarget = function() {

    this.listeners = {}; // A hash when we hold all events by type (each event type has a list of listeners)  

    this.addEventListener = function(type, listener) { /* Adds a event listener */
    
      // If the event type is not registered, adds an entry
      if (!this.listeners[type]) {
        this.listeners[type] = [];  
      }
    
      this.listeners[type].push(listener);
    
    };  
  
    this.removeEventListener = function(type, listener) { /* Removes an event listener */
    
      if (this.listeners[type] instanceof Array) {
      
        if (this.listeners[type].indexOf(listener) > -1) {
          //console.log('remove index ' + this.listeners[type].indexOf(listener));
          this.listeners[type].splice(this.listeners[type].indexOf(listener),1);
      
          if (this.listeners[type].length == 0) {
            delete this.listeners[type];  
          } 
        }
      
      }
    
    };

    this.removeEventListeners = function(type) { /* Remove all event listeners */

      if (this.listeners[type] instanceof Array) {
        this.listeners[type] = [];
        delete this.listeners[type];
      }

    };    
  
    this.fireEvent = function(event) { /* Fire an event */
  
      if (typeof event == "string") {
        event = {type:event};
      }     
    
      if (!event.target) {
        event.target = this;  
      }
    
      if (!event.type) {
        throw new Error('The event needs a event type');  
      }
       
      var result = true;

      if (this.listeners[event.type] instanceof Array)
      {
        var the_listeners = this.listeners[event.type]; 
        for (n in the_listeners)
        {
          var result = the_listeners[n].call(this,event);  
          if (typeof result === 'undefined') {
            // No response (take as a true)
            result = true;
          }        
          else {
            if (result == false) { // Do not propagate
              break;
            } 
          }
          
        }  
      }

      return result;
    
    };

  }

  function isPromise(value) {
    if (typeof value === 'object' && typeof value.then !== "function") {
      return false;
    }
    var promiseThenSrc = String($.Deferred().then);
    var valueThenSrc = String(value.then);
    return promiseThenSrc === valueThenSrc;
  }
  
  return YSDEventTarget;
  
}).call(exports, __webpack_require__, exports, module),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function( $ ) {
	var radioCheck = /radio|checkbox/i,
		keyBreaker = /[^\[\]]+/g,
		numberMatcher = /^[\-+]?[0-9]*\.?[0-9]+([eE][\-+]?[0-9]+)?$/;

	var isNumber = function( value ) {
		if ( typeof value == 'number' ) {
			return true;
		}

		if ( typeof value != 'string' ) {
			return false;
		}

		return value.match(numberMatcher);
	};

	$.fn.extend({
		/**
		 * @parent dom
		 * @download http://jmvcsite.heroku.com/pluginify?plugins[]=jquery/dom/form_params/form_params.js
		 * @plugin jquery/dom/form_params
		 * @test jquery/dom/form_params/qunit.html
		 * <p>Returns an object of name-value pairs that represents values in a form.  
		 * It is able to nest values whose element's name has square brackets. </p>
		 * Example html:
		 * @codestart html
		 * &lt;form>
		 *   &lt;input name="foo[bar]" value='2'/>
		 *   &lt;input name="foo[ced]" value='4'/>
		 * &lt;form/>
		 * @codeend
		 * Example code:
		 * @codestart
		 * $('form').formParams() //-> { foo:{bar:2, ced: 4} }
		 * @codeend
		 * 
		 * @demo jquery/dom/form_params/form_params.html
		 * 
		 * @param {Boolean} [convert] True if strings that look like numbers and booleans should be converted.  Defaults to true.
		 * @return {Object} An object of name-value pairs.
		 */
		formParams: function( convert ) {
			if ( this[0].nodeName.toLowerCase() == 'form' && this[0].elements ) {

				return jQuery(jQuery.makeArray(this[0].elements)).getParams(convert);
			}
			return jQuery("input[name], textarea[name], select[name]", this[0]).getParams(convert);
		},
		getParams: function( convert ) {
			var data = {},
				current;

			convert = convert === undefined ? true : convert;

			this.each(function() {
				var el = this,
					type = el.type && el.type.toLowerCase();
				//if we are submit, ignore
				if ((type == 'submit') || !el.name ) {
					return;
				}

				var key = el.name,
					value = $.data(el, "value") || $.fn.val.call([el]),
					isRadioCheck = radioCheck.test(el.type),
					parts = key.match(keyBreaker),
					write = !isRadioCheck || !! el.checked,
					//make an array of values
					lastPart;

				if ( convert ) {
					if ( isNumber(value) ) {
						value = parseFloat(value);
					}
					else if ( value === 'true') {
						value = true;
					} 
					else if (value  === 'false' ) {
						value = false;
					}

				}

				// go through and create nested objects
				current = data;
				for ( var i = 0; i < parts.length - 1; i++ ) {
					if (!current[parts[i]] ) {
						current[parts[i]] = {};
					}
					current = current[parts[i]];
				}
				lastPart = parts[parts.length - 1];

				//now we are on the last part, set the value
				if ( lastPart in current && type === "checkbox" ) {
					if (!$.isArray(current[lastPart]) ) {
						current[lastPart] = current[lastPart] === undefined ? [] : [current[lastPart]];
					}
					if ( write ) {
						current[lastPart].push(value);
					}
				} else if ( write || !current[lastPart] ) {
					current[lastPart] = write ? value : undefined;
				}

			});
			return data;
		}
	});

})(jQuery)
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 22 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/******
 *
 * Renting Module modify reservation selector form
 *
 */
!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0), __webpack_require__(1), __webpack_require__(9), __webpack_require__(25)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, commonSettings, commonLoader, SelectorRent) {

  /***
   * Model
   */
  var selectorModel = {
    requestLanguage: null,
    configuration: null   
  };

  /***
   * Controller
   */
  var selectorController = {

  };

  /***
   * View
   */
  var selectorView = {

    selectorRent: null,

    /**
     * Initialize
     */
    init: function() {

        // Create selector    
        this.selectorRent = new SelectorRent();
        // Setup request language and configuration
        this.selectorRent.model.requestLanguage = selectorModel.requestLanguage;
        this.selectorRent.model.configuration = selectorModel.configuration;

        // Initialize selector
        this.selectorRent.view.init();

    },

    startFromShoppingCart(shopping_cart) {
      if (this.selectorRent != null) {
        this.selectorRent.view.startFromShoppingCart(shopping_cart);
      } 
    }

  };

  var selector = { model: selectorModel,
                   controller: selectorController,
                   view: selectorView};

  return selector;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 23 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;var require;var require;/*!
 * Select2 4.0.1
 * https://select2.github.io
 *
 * Released under the MIT license
 * https://github.com/select2/select2/blob/master/LICENSE.md
 */
(function (factory) {
  if (true) {
    // AMD. Register as an anonymous module.
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0)], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}
}(function (jQuery) {
  // This is needed so we can catch the AMD loader configuration and use it
  // The inner file should be wrapped (by `banner.start.js`) in a function that
  // returns the AMD loader references.
  var S2 =
(function () {
  // Restore the Select2 AMD loader so it can be used
  // Needed mostly in the language files, where the loader is not inserted
  if (jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd) {
    var S2 = jQuery.fn.select2.amd;
  }
var S2;(function () { if (!S2 || !S2.requirejs) {
if (!S2) { S2 = {}; } else { require = S2; }
/**
 * @license almond 0.3.1 Copyright (c) 2011-2014, The Dojo Foundation All Rights Reserved.
 * Available via the MIT or new BSD license.
 * see: http://github.com/jrburke/almond for details
 */
//Going sloppy to avoid 'use strict' string cost, but strict practices should
//be followed.
/*jslint sloppy: true */
/*global setTimeout: false */

var requirejs, require, define;
(function (undef) {
    var main, req, makeMap, handlers,
        defined = {},
        waiting = {},
        config = {},
        defining = {},
        hasOwn = Object.prototype.hasOwnProperty,
        aps = [].slice,
        jsSuffixRegExp = /\.js$/;

    function hasProp(obj, prop) {
        return hasOwn.call(obj, prop);
    }

    /**
     * Given a relative module name, like ./something, normalize it to
     * a real name that can be mapped to a path.
     * @param {String} name the relative name
     * @param {String} baseName a real name that the name arg is relative
     * to.
     * @returns {String} normalized name
     */
    function normalize(name, baseName) {
        var nameParts, nameSegment, mapValue, foundMap, lastIndex,
            foundI, foundStarMap, starI, i, j, part,
            baseParts = baseName && baseName.split("/"),
            map = config.map,
            starMap = (map && map['*']) || {};

        //Adjust any relative paths.
        if (name && name.charAt(0) === ".") {
            //If have a base name, try to normalize against it,
            //otherwise, assume it is a top-level require that will
            //be relative to baseUrl in the end.
            if (baseName) {
                name = name.split('/');
                lastIndex = name.length - 1;

                // Node .js allowance:
                if (config.nodeIdCompat && jsSuffixRegExp.test(name[lastIndex])) {
                    name[lastIndex] = name[lastIndex].replace(jsSuffixRegExp, '');
                }

                //Lop off the last part of baseParts, so that . matches the
                //"directory" and not name of the baseName's module. For instance,
                //baseName of "one/two/three", maps to "one/two/three.js", but we
                //want the directory, "one/two" for this normalization.
                name = baseParts.slice(0, baseParts.length - 1).concat(name);

                //start trimDots
                for (i = 0; i < name.length; i += 1) {
                    part = name[i];
                    if (part === ".") {
                        name.splice(i, 1);
                        i -= 1;
                    } else if (part === "..") {
                        if (i === 1 && (name[2] === '..' || name[0] === '..')) {
                            //End of the line. Keep at least one non-dot
                            //path segment at the front so it can be mapped
                            //correctly to disk. Otherwise, there is likely
                            //no path mapping for a path starting with '..'.
                            //This can still fail, but catches the most reasonable
                            //uses of ..
                            break;
                        } else if (i > 0) {
                            name.splice(i - 1, 2);
                            i -= 2;
                        }
                    }
                }
                //end trimDots

                name = name.join("/");
            } else if (name.indexOf('./') === 0) {
                // No baseName, so this is ID is resolved relative
                // to baseUrl, pull off the leading dot.
                name = name.substring(2);
            }
        }

        //Apply map config if available.
        if ((baseParts || starMap) && map) {
            nameParts = name.split('/');

            for (i = nameParts.length; i > 0; i -= 1) {
                nameSegment = nameParts.slice(0, i).join("/");

                if (baseParts) {
                    //Find the longest baseName segment match in the config.
                    //So, do joins on the biggest to smallest lengths of baseParts.
                    for (j = baseParts.length; j > 0; j -= 1) {
                        mapValue = map[baseParts.slice(0, j).join('/')];

                        //baseName segment has  config, find if it has one for
                        //this name.
                        if (mapValue) {
                            mapValue = mapValue[nameSegment];
                            if (mapValue) {
                                //Match, update name to the new value.
                                foundMap = mapValue;
                                foundI = i;
                                break;
                            }
                        }
                    }
                }

                if (foundMap) {
                    break;
                }

                //Check for a star map match, but just hold on to it,
                //if there is a shorter segment match later in a matching
                //config, then favor over this star map.
                if (!foundStarMap && starMap && starMap[nameSegment]) {
                    foundStarMap = starMap[nameSegment];
                    starI = i;
                }
            }

            if (!foundMap && foundStarMap) {
                foundMap = foundStarMap;
                foundI = starI;
            }

            if (foundMap) {
                nameParts.splice(0, foundI, foundMap);
                name = nameParts.join('/');
            }
        }

        return name;
    }

    function makeRequire(relName, forceSync) {
        return function () {
            //A version of a require function that passes a moduleName
            //value for items that may need to
            //look up paths relative to the moduleName
            var args = aps.call(arguments, 0);

            //If first arg is not require('string'), and there is only
            //one arg, it is the array form without a callback. Insert
            //a null so that the following concat is correct.
            if (typeof args[0] !== 'string' && args.length === 1) {
                args.push(null);
            }
            return req.apply(undef, args.concat([relName, forceSync]));
        };
    }

    function makeNormalize(relName) {
        return function (name) {
            return normalize(name, relName);
        };
    }

    function makeLoad(depName) {
        return function (value) {
            defined[depName] = value;
        };
    }

    function callDep(name) {
        if (hasProp(waiting, name)) {
            var args = waiting[name];
            delete waiting[name];
            defining[name] = true;
            main.apply(undef, args);
        }

        if (!hasProp(defined, name) && !hasProp(defining, name)) {
            throw new Error('No ' + name);
        }
        return defined[name];
    }

    //Turns a plugin!resource to [plugin, resource]
    //with the plugin being undefined if the name
    //did not have a plugin prefix.
    function splitPrefix(name) {
        var prefix,
            index = name ? name.indexOf('!') : -1;
        if (index > -1) {
            prefix = name.substring(0, index);
            name = name.substring(index + 1, name.length);
        }
        return [prefix, name];
    }

    /**
     * Makes a name map, normalizing the name, and using a plugin
     * for normalization if necessary. Grabs a ref to plugin
     * too, as an optimization.
     */
    makeMap = function (name, relName) {
        var plugin,
            parts = splitPrefix(name),
            prefix = parts[0];

        name = parts[1];

        if (prefix) {
            prefix = normalize(prefix, relName);
            plugin = callDep(prefix);
        }

        //Normalize according
        if (prefix) {
            if (plugin && plugin.normalize) {
                name = plugin.normalize(name, makeNormalize(relName));
            } else {
                name = normalize(name, relName);
            }
        } else {
            name = normalize(name, relName);
            parts = splitPrefix(name);
            prefix = parts[0];
            name = parts[1];
            if (prefix) {
                plugin = callDep(prefix);
            }
        }

        //Using ridiculous property names for space reasons
        return {
            f: prefix ? prefix + '!' + name : name, //fullName
            n: name,
            pr: prefix,
            p: plugin
        };
    };

    function makeConfig(name) {
        return function () {
            return (config && config.config && config.config[name]) || {};
        };
    }

    handlers = {
        require: function (name) {
            return makeRequire(name);
        },
        exports: function (name) {
            var e = defined[name];
            if (typeof e !== 'undefined') {
                return e;
            } else {
                return (defined[name] = {});
            }
        },
        module: function (name) {
            return {
                id: name,
                uri: '',
                exports: defined[name],
                config: makeConfig(name)
            };
        }
    };

    main = function (name, deps, callback, relName) {
        var cjsModule, depName, ret, map, i,
            args = [],
            callbackType = typeof callback,
            usingExports;

        //Use name if no relName
        relName = relName || name;

        //Call the callback to define the module, if necessary.
        if (callbackType === 'undefined' || callbackType === 'function') {
            //Pull out the defined dependencies and pass the ordered
            //values to the callback.
            //Default to [require, exports, module] if no deps
            deps = !deps.length && callback.length ? ['require', 'exports', 'module'] : deps;
            for (i = 0; i < deps.length; i += 1) {
                map = makeMap(deps[i], relName);
                depName = map.f;

                //Fast path CommonJS standard dependencies.
                if (depName === "require") {
                    args[i] = handlers.require(name);
                } else if (depName === "exports") {
                    //CommonJS module spec 1.1
                    args[i] = handlers.exports(name);
                    usingExports = true;
                } else if (depName === "module") {
                    //CommonJS module spec 1.1
                    cjsModule = args[i] = handlers.module(name);
                } else if (hasProp(defined, depName) ||
                           hasProp(waiting, depName) ||
                           hasProp(defining, depName)) {
                    args[i] = callDep(depName);
                } else if (map.p) {
                    map.p.load(map.n, makeRequire(relName, true), makeLoad(depName), {});
                    args[i] = defined[depName];
                } else {
                    throw new Error(name + ' missing ' + depName);
                }
            }

            ret = callback ? callback.apply(defined[name], args) : undefined;

            if (name) {
                //If setting exports via "module" is in play,
                //favor that over return value and exports. After that,
                //favor a non-undefined return value over exports use.
                if (cjsModule && cjsModule.exports !== undef &&
                        cjsModule.exports !== defined[name]) {
                    defined[name] = cjsModule.exports;
                } else if (ret !== undef || !usingExports) {
                    //Use the return value from the function.
                    defined[name] = ret;
                }
            }
        } else if (name) {
            //May just be an object definition for the module. Only
            //worry about defining if have a module name.
            defined[name] = callback;
        }
    };

    requirejs = require = req = function (deps, callback, relName, forceSync, alt) {
        if (typeof deps === "string") {
            if (handlers[deps]) {
                //callback in this case is really relName
                return handlers[deps](callback);
            }
            //Just return the module wanted. In this scenario, the
            //deps arg is the module name, and second arg (if passed)
            //is just the relName.
            //Normalize module name, if it contains . or ..
            return callDep(makeMap(deps, callback).f);
        } else if (!deps.splice) {
            //deps is a config object, not an array.
            config = deps;
            if (config.deps) {
                req(config.deps, config.callback);
            }
            if (!callback) {
                return;
            }

            if (callback.splice) {
                //callback is an array, which means it is a dependency list.
                //Adjust args if there are dependencies
                deps = callback;
                callback = relName;
                relName = null;
            } else {
                deps = undef;
            }
        }

        //Support require(['a'])
        callback = callback || function () {};

        //If relName is a function, it is an errback handler,
        //so remove it.
        if (typeof relName === 'function') {
            relName = forceSync;
            forceSync = alt;
        }

        //Simulate async callback;
        if (forceSync) {
            main(undef, deps, callback, relName);
        } else {
            //Using a non-zero value because of concern for what old browsers
            //do, and latest browsers "upgrade" to 4 if lower value is used:
            //http://www.whatwg.org/specs/web-apps/current-work/multipage/timers.html#dom-windowtimers-settimeout:
            //If want a value immediately, use require('id') instead -- something
            //that works in almond on the global level, but not guaranteed and
            //unlikely to work in other AMD implementations.
            setTimeout(function () {
                main(undef, deps, callback, relName);
            }, 4);
        }

        return req;
    };

    /**
     * Just drops the config on the floor, but returns req in case
     * the config return value is used.
     */
    req.config = function (cfg) {
        return req(cfg);
    };

    /**
     * Expose module registry for debugging and tooling
     */
    requirejs._defined = defined;

    define = function (name, deps, callback) {
        if (typeof name !== 'string') {
            throw new Error('See almond README: incorrect module build, no module name');
        }

        //This module may not have dependencies
        if (!deps.splice) {
            //deps is not an array, so probably means
            //an object literal or factory function for
            //the value. Adjust args.
            callback = deps;
            deps = [];
        }

        if (!hasProp(defined, name) && !hasProp(waiting, name)) {
            waiting[name] = [name, deps, callback];
        }
    };

    define.amd = {
        jQuery: true
    };
}());

S2.requirejs = requirejs;S2.require = require;S2.define = define;
}
}());
S2.define("almond", function(){});

/* global jQuery:false, $:false */
S2.define('jquery',[],function () {
  var _$ = jQuery || $;

  if (_$ == null && console && console.error) {
    console.error(
      'Select2: An instance of jQuery or a jQuery-compatible library was not ' +
      'found. Make sure that you are including jQuery before Select2 on your ' +
      'web page.'
    );
  }

  return _$;
});

S2.define('select2/utils',[
  'jquery'
], function ($) {
  var Utils = {};

  Utils.Extend = function (ChildClass, SuperClass) {
    var __hasProp = {}.hasOwnProperty;

    function BaseConstructor () {
      this.constructor = ChildClass;
    }

    for (var key in SuperClass) {
      if (__hasProp.call(SuperClass, key)) {
        ChildClass[key] = SuperClass[key];
      }
    }

    BaseConstructor.prototype = SuperClass.prototype;
    ChildClass.prototype = new BaseConstructor();
    ChildClass.__super__ = SuperClass.prototype;

    return ChildClass;
  };

  function getMethods (theClass) {
    var proto = theClass.prototype;

    var methods = [];

    for (var methodName in proto) {
      var m = proto[methodName];

      if (typeof m !== 'function') {
        continue;
      }

      if (methodName === 'constructor') {
        continue;
      }

      methods.push(methodName);
    }

    return methods;
  }

  Utils.Decorate = function (SuperClass, DecoratorClass) {
    var decoratedMethods = getMethods(DecoratorClass);
    var superMethods = getMethods(SuperClass);

    function DecoratedClass () {
      var unshift = Array.prototype.unshift;

      var argCount = DecoratorClass.prototype.constructor.length;

      var calledConstructor = SuperClass.prototype.constructor;

      if (argCount > 0) {
        unshift.call(arguments, SuperClass.prototype.constructor);

        calledConstructor = DecoratorClass.prototype.constructor;
      }

      calledConstructor.apply(this, arguments);
    }

    DecoratorClass.displayName = SuperClass.displayName;

    function ctr () {
      this.constructor = DecoratedClass;
    }

    DecoratedClass.prototype = new ctr();

    for (var m = 0; m < superMethods.length; m++) {
        var superMethod = superMethods[m];

        DecoratedClass.prototype[superMethod] =
          SuperClass.prototype[superMethod];
    }

    var calledMethod = function (methodName) {
      // Stub out the original method if it's not decorating an actual method
      var originalMethod = function () {};

      if (methodName in DecoratedClass.prototype) {
        originalMethod = DecoratedClass.prototype[methodName];
      }

      var decoratedMethod = DecoratorClass.prototype[methodName];

      return function () {
        var unshift = Array.prototype.unshift;

        unshift.call(arguments, originalMethod);

        return decoratedMethod.apply(this, arguments);
      };
    };

    for (var d = 0; d < decoratedMethods.length; d++) {
      var decoratedMethod = decoratedMethods[d];

      DecoratedClass.prototype[decoratedMethod] = calledMethod(decoratedMethod);
    }

    return DecoratedClass;
  };

  var Observable = function () {
    this.listeners = {};
  };

  Observable.prototype.on = function (event, callback) {
    this.listeners = this.listeners || {};

    if (event in this.listeners) {
      this.listeners[event].push(callback);
    } else {
      this.listeners[event] = [callback];
    }
  };

  Observable.prototype.trigger = function (event) {
    var slice = Array.prototype.slice;

    this.listeners = this.listeners || {};

    if (event in this.listeners) {
      this.invoke(this.listeners[event], slice.call(arguments, 1));
    }

    if ('*' in this.listeners) {
      this.invoke(this.listeners['*'], arguments);
    }
  };

  Observable.prototype.invoke = function (listeners, params) {
    for (var i = 0, len = listeners.length; i < len; i++) {
      listeners[i].apply(this, params);
    }
  };

  Utils.Observable = Observable;

  Utils.generateChars = function (length) {
    var chars = '';

    for (var i = 0; i < length; i++) {
      var randomChar = Math.floor(Math.random() * 36);
      chars += randomChar.toString(36);
    }

    return chars;
  };

  Utils.bind = function (func, context) {
    return function () {
      func.apply(context, arguments);
    };
  };

  Utils._convertData = function (data) {
    for (var originalKey in data) {
      var keys = originalKey.split('-');

      var dataLevel = data;

      if (keys.length === 1) {
        continue;
      }

      for (var k = 0; k < keys.length; k++) {
        var key = keys[k];

        // Lowercase the first letter
        // By default, dash-separated becomes camelCase
        key = key.substring(0, 1).toLowerCase() + key.substring(1);

        if (!(key in dataLevel)) {
          dataLevel[key] = {};
        }

        if (k == keys.length - 1) {
          dataLevel[key] = data[originalKey];
        }

        dataLevel = dataLevel[key];
      }

      delete data[originalKey];
    }

    return data;
  };

  Utils.hasScroll = function (index, el) {
    // Adapted from the function created by @ShadowScripter
    // and adapted by @BillBarry on the Stack Exchange Code Review website.
    // The original code can be found at
    // http://codereview.stackexchange.com/q/13338
    // and was designed to be used with the Sizzle selector engine.

    var $el = $(el);
    var overflowX = el.style.overflowX;
    var overflowY = el.style.overflowY;

    //Check both x and y declarations
    if (overflowX === overflowY &&
        (overflowY === 'hidden' || overflowY === 'visible')) {
      return false;
    }

    if (overflowX === 'scroll' || overflowY === 'scroll') {
      return true;
    }

    return ($el.innerHeight() < el.scrollHeight ||
      $el.innerWidth() < el.scrollWidth);
  };

  Utils.escapeMarkup = function (markup) {
    var replaceMap = {
      '\\': '&#92;',
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      '\'': '&#39;',
      '/': '&#47;'
    };

    // Do not try to escape the markup if it's not a string
    if (typeof markup !== 'string') {
      return markup;
    }

    return String(markup).replace(/[&<>"'\/\\]/g, function (match) {
      return replaceMap[match];
    });
  };

  // Append an array of jQuery nodes to a given element.
  Utils.appendMany = function ($element, $nodes) {
    // jQuery 1.7.x does not support $.fn.append() with an array
    // Fall back to a jQuery object collection using $.fn.add()
    if ($.fn.jquery.substr(0, 3) === '1.7') {
      var $jqNodes = $();

      $.map($nodes, function (node) {
        $jqNodes = $jqNodes.add(node);
      });

      $nodes = $jqNodes;
    }

    $element.append($nodes);
  };

  return Utils;
});

S2.define('select2/results',[
  'jquery',
  './utils'
], function ($, Utils) {
  function Results ($element, options, dataAdapter) {
    this.$element = $element;
    this.data = dataAdapter;
    this.options = options;

    Results.__super__.constructor.call(this);
  }

  Utils.Extend(Results, Utils.Observable);

  Results.prototype.render = function () {
    var $results = $(
      '<ul class="select2-results__options" role="tree"></ul>'
    );

    if (this.options.get('multiple')) {
      $results.attr('aria-multiselectable', 'true');
    }

    this.$results = $results;

    return $results;
  };

  Results.prototype.clear = function () {
    this.$results.empty();
  };

  Results.prototype.displayMessage = function (params) {
    var escapeMarkup = this.options.get('escapeMarkup');

    this.clear();
    this.hideLoading();

    var $message = $(
      '<li role="treeitem" aria-live="assertive"' +
      ' class="select2-results__option"></li>'
    );

    var message = this.options.get('translations').get(params.message);

    $message.append(
      escapeMarkup(
        message(params.args)
      )
    );

    $message[0].className += ' select2-results__message';

    this.$results.append($message);
  };

  Results.prototype.hideMessages = function () {
    this.$results.find('.select2-results__message').remove();
  };

  Results.prototype.append = function (data) {
    this.hideLoading();

    var $options = [];

    if (data.results == null || data.results.length === 0) {
      if (this.$results.children().length === 0) {
        this.trigger('results:message', {
          message: 'noResults'
        });
      }

      return;
    }

    data.results = this.sort(data.results);

    for (var d = 0; d < data.results.length; d++) {
      var item = data.results[d];

      var $option = this.option(item);

      $options.push($option);
    }

    this.$results.append($options);
  };

  Results.prototype.position = function ($results, $dropdown) {
    var $resultsContainer = $dropdown.find('.select2-results');
    $resultsContainer.append($results);
  };

  Results.prototype.sort = function (data) {
    var sorter = this.options.get('sorter');

    return sorter(data);
  };

  Results.prototype.setClasses = function () {
    var self = this;

    this.data.current(function (selected) {
      var selectedIds = $.map(selected, function (s) {
        return s.id.toString();
      });

      var $options = self.$results
        .find('.select2-results__option[aria-selected]');

      $options.each(function () {
        var $option = $(this);

        var item = $.data(this, 'data');

        // id needs to be converted to a string when comparing
        var id = '' + item.id;

        if ((item.element != null && item.element.selected) ||
            (item.element == null && $.inArray(id, selectedIds) > -1)) {
          $option.attr('aria-selected', 'true');
        } else {
          $option.attr('aria-selected', 'false');
        }
      });

      var $selected = $options.filter('[aria-selected=true]');

      // Check if there are any selected options
      if ($selected.length > 0) {
        // If there are selected options, highlight the first
        $selected.first().trigger('mouseenter');
      } else {
        // If there are no selected options, highlight the first option
        // in the dropdown
        $options.first().trigger('mouseenter');
      }
    });
  };

  Results.prototype.showLoading = function (params) {
    this.hideLoading();

    var loadingMore = this.options.get('translations').get('searching');

    var loading = {
      disabled: true,
      loading: true,
      text: loadingMore(params)
    };
    var $loading = this.option(loading);
    $loading.className += ' loading-results';

    this.$results.prepend($loading);
  };

  Results.prototype.hideLoading = function () {
    this.$results.find('.loading-results').remove();
  };

  Results.prototype.option = function (data) {
    var option = document.createElement('li');
    option.className = 'select2-results__option';

    var attrs = {
      'role': 'treeitem',
      'aria-selected': 'false'
    };

    if (data.disabled) {
      delete attrs['aria-selected'];
      attrs['aria-disabled'] = 'true';
    }

    if (data.id == null) {
      delete attrs['aria-selected'];
    }

    if (data._resultId != null) {
      option.id = data._resultId;
    }

    if (data.title) {
      option.title = data.title;
    }

    if (data.children) {
      attrs.role = 'group';
      attrs['aria-label'] = data.text;
      delete attrs['aria-selected'];
    }

    for (var attr in attrs) {
      var val = attrs[attr];

      option.setAttribute(attr, val);
    }

    if (data.children) {
      var $option = $(option);

      var label = document.createElement('strong');
      label.className = 'select2-results__group';

      var $label = $(label);
      this.template(data, label);

      var $children = [];

      for (var c = 0; c < data.children.length; c++) {
        var child = data.children[c];

        var $child = this.option(child);

        $children.push($child);
      }

      var $childrenContainer = $('<ul></ul>', {
        'class': 'select2-results__options select2-results__options--nested'
      });

      $childrenContainer.append($children);

      $option.append(label);
      $option.append($childrenContainer);
    } else {
      this.template(data, option);
    }

    $.data(option, 'data', data);

    return option;
  };

  Results.prototype.bind = function (container, $container) {
    var self = this;

    var id = container.id + '-results';

    this.$results.attr('id', id);

    container.on('results:all', function (params) {
      self.clear();
      self.append(params.data);

      if (container.isOpen()) {
        self.setClasses();
      }
    });

    container.on('results:append', function (params) {
      self.append(params.data);

      if (container.isOpen()) {
        self.setClasses();
      }
    });

    container.on('query', function (params) {
      self.hideMessages();
      self.showLoading(params);
    });

    container.on('select', function () {
      if (!container.isOpen()) {
        return;
      }

      self.setClasses();
    });

    container.on('unselect', function () {
      if (!container.isOpen()) {
        return;
      }

      self.setClasses();
    });

    container.on('open', function () {
      // When the dropdown is open, aria-expended="true"
      self.$results.attr('aria-expanded', 'true');
      self.$results.attr('aria-hidden', 'false');

      self.setClasses();
      self.ensureHighlightVisible();
    });

    container.on('close', function () {
      // When the dropdown is closed, aria-expended="false"
      self.$results.attr('aria-expanded', 'false');
      self.$results.attr('aria-hidden', 'true');
      self.$results.removeAttr('aria-activedescendant');
    });

    container.on('results:toggle', function () {
      var $highlighted = self.getHighlightedResults();

      if ($highlighted.length === 0) {
        return;
      }

      $highlighted.trigger('mouseup');
    });

    container.on('results:select', function () {
      var $highlighted = self.getHighlightedResults();

      if ($highlighted.length === 0) {
        return;
      }

      var data = $highlighted.data('data');

      if ($highlighted.attr('aria-selected') == 'true') {
        self.trigger('close', {});
      } else {
        self.trigger('select', {
          data: data
        });
      }
    });

    container.on('results:previous', function () {
      var $highlighted = self.getHighlightedResults();

      var $options = self.$results.find('[aria-selected]');

      var currentIndex = $options.index($highlighted);

      // If we are already at te top, don't move further
      if (currentIndex === 0) {
        return;
      }

      var nextIndex = currentIndex - 1;

      // If none are highlighted, highlight the first
      if ($highlighted.length === 0) {
        nextIndex = 0;
      }

      var $next = $options.eq(nextIndex);

      $next.trigger('mouseenter');

      var currentOffset = self.$results.offset().top;
      var nextTop = $next.offset().top;
      var nextOffset = self.$results.scrollTop() + (nextTop - currentOffset);

      if (nextIndex === 0) {
        self.$results.scrollTop(0);
      } else if (nextTop - currentOffset < 0) {
        self.$results.scrollTop(nextOffset);
      }
    });

    container.on('results:next', function () {
      var $highlighted = self.getHighlightedResults();

      var $options = self.$results.find('[aria-selected]');

      var currentIndex = $options.index($highlighted);

      var nextIndex = currentIndex + 1;

      // If we are at the last option, stay there
      if (nextIndex >= $options.length) {
        return;
      }

      var $next = $options.eq(nextIndex);

      $next.trigger('mouseenter');

      var currentOffset = self.$results.offset().top +
        self.$results.outerHeight(false);
      var nextBottom = $next.offset().top + $next.outerHeight(false);
      var nextOffset = self.$results.scrollTop() + nextBottom - currentOffset;

      if (nextIndex === 0) {
        self.$results.scrollTop(0);
      } else if (nextBottom > currentOffset) {
        self.$results.scrollTop(nextOffset);
      }
    });

    container.on('results:focus', function (params) {
      params.element.addClass('select2-results__option--highlighted');
    });

    container.on('results:message', function (params) {
      self.displayMessage(params);
    });

    if ($.fn.mousewheel) {
      this.$results.on('mousewheel', function (e) {
        var top = self.$results.scrollTop();

        var bottom = (
          self.$results.get(0).scrollHeight -
          self.$results.scrollTop() +
          e.deltaY
        );

        var isAtTop = e.deltaY > 0 && top - e.deltaY <= 0;
        var isAtBottom = e.deltaY < 0 && bottom <= self.$results.height();

        if (isAtTop) {
          self.$results.scrollTop(0);

          e.preventDefault();
          e.stopPropagation();
        } else if (isAtBottom) {
          self.$results.scrollTop(
            self.$results.get(0).scrollHeight - self.$results.height()
          );

          e.preventDefault();
          e.stopPropagation();
        }
      });
    }

    this.$results.on('mouseup', '.select2-results__option[aria-selected]',
      function (evt) {
      var $this = $(this);

      var data = $this.data('data');

      if ($this.attr('aria-selected') === 'true') {
        if (self.options.get('multiple')) {
          self.trigger('unselect', {
            originalEvent: evt,
            data: data
          });
        } else {
          self.trigger('close', {});
        }

        return;
      }

      self.trigger('select', {
        originalEvent: evt,
        data: data
      });
    });

    this.$results.on('mouseenter', '.select2-results__option[aria-selected]',
      function (evt) {
      var data = $(this).data('data');

      self.getHighlightedResults()
          .removeClass('select2-results__option--highlighted');

      self.trigger('results:focus', {
        data: data,
        element: $(this)
      });
    });
  };

  Results.prototype.getHighlightedResults = function () {
    var $highlighted = this.$results
    .find('.select2-results__option--highlighted');

    return $highlighted;
  };

  Results.prototype.destroy = function () {
    this.$results.remove();
  };

  Results.prototype.ensureHighlightVisible = function () {
    var $highlighted = this.getHighlightedResults();

    if ($highlighted.length === 0) {
      return;
    }

    var $options = this.$results.find('[aria-selected]');

    var currentIndex = $options.index($highlighted);

    var currentOffset = this.$results.offset().top;
    var nextTop = $highlighted.offset().top;
    var nextOffset = this.$results.scrollTop() + (nextTop - currentOffset);

    var offsetDelta = nextTop - currentOffset;
    nextOffset -= $highlighted.outerHeight(false) * 2;

    if (currentIndex <= 2) {
      this.$results.scrollTop(0);
    } else if (offsetDelta > this.$results.outerHeight() || offsetDelta < 0) {
      this.$results.scrollTop(nextOffset);
    }
  };

  Results.prototype.template = function (result, container) {
    var template = this.options.get('templateResult');
    var escapeMarkup = this.options.get('escapeMarkup');

    var content = template(result, container);

    if (content == null) {
      container.style.display = 'none';
    } else if (typeof content === 'string') {
      container.innerHTML = escapeMarkup(content);
    } else {
      $(container).append(content);
    }
  };

  return Results;
});

S2.define('select2/keys',[

], function () {
  var KEYS = {
    BACKSPACE: 8,
    TAB: 9,
    ENTER: 13,
    SHIFT: 16,
    CTRL: 17,
    ALT: 18,
    ESC: 27,
    SPACE: 32,
    PAGE_UP: 33,
    PAGE_DOWN: 34,
    END: 35,
    HOME: 36,
    LEFT: 37,
    UP: 38,
    RIGHT: 39,
    DOWN: 40,
    DELETE: 46
  };

  return KEYS;
});

S2.define('select2/selection/base',[
  'jquery',
  '../utils',
  '../keys'
], function ($, Utils, KEYS) {
  function BaseSelection ($element, options) {
    this.$element = $element;
    this.options = options;

    BaseSelection.__super__.constructor.call(this);
  }

  Utils.Extend(BaseSelection, Utils.Observable);

  BaseSelection.prototype.render = function () {
    var $selection = $(
      '<span class="select2-selection" role="combobox" ' +
      ' aria-haspopup="true" aria-expanded="false">' +
      '</span>'
    );

    this._tabindex = 0;

    if (this.$element.data('old-tabindex') != null) {
      this._tabindex = this.$element.data('old-tabindex');
    } else if (this.$element.attr('tabindex') != null) {
      this._tabindex = this.$element.attr('tabindex');
    }

    $selection.attr('title', this.$element.attr('title'));
    $selection.attr('tabindex', this._tabindex);

    this.$selection = $selection;

    return $selection;
  };

  BaseSelection.prototype.bind = function (container, $container) {
    var self = this;

    var id = container.id + '-container';
    var resultsId = container.id + '-results';

    this.container = container;

    this.$selection.on('focus', function (evt) {
      self.trigger('focus', evt);
    });

    this.$selection.on('blur', function (evt) {
      self._handleBlur(evt);
    });

    this.$selection.on('keydown', function (evt) {
      self.trigger('keypress', evt);

      if (evt.which === KEYS.SPACE) {
        evt.preventDefault();
      }
    });

    container.on('results:focus', function (params) {
      self.$selection.attr('aria-activedescendant', params.data._resultId);
    });

    container.on('selection:update', function (params) {
      self.update(params.data);
    });

    container.on('open', function () {
      // When the dropdown is open, aria-expanded="true"
      self.$selection.attr('aria-expanded', 'true');
      self.$selection.attr('aria-owns', resultsId);

      self._attachCloseHandler(container);
    });

    container.on('close', function () {
      // When the dropdown is closed, aria-expanded="false"
      self.$selection.attr('aria-expanded', 'false');
      self.$selection.removeAttr('aria-activedescendant');
      self.$selection.removeAttr('aria-owns');

      self.$selection.focus();

      self._detachCloseHandler(container);
    });

    container.on('enable', function () {
      self.$selection.attr('tabindex', self._tabindex);
    });

    container.on('disable', function () {
      self.$selection.attr('tabindex', '-1');
    });
  };

  BaseSelection.prototype._handleBlur = function (evt) {
    var self = this;

    // This needs to be delayed as the active element is the body when the tab
    // key is pressed, possibly along with others.
    window.setTimeout(function () {
      // Don't trigger `blur` if the focus is still in the selection
      if (
        (document.activeElement == self.$selection[0]) ||
        ($.contains(self.$selection[0], document.activeElement))
      ) {
        return;
      }

      self.trigger('blur', evt);
    }, 1);
  };

  BaseSelection.prototype._attachCloseHandler = function (container) {
    var self = this;

    $(document.body).on('mousedown.select2.' + container.id, function (e) {
      var $target = $(e.target);

      var $select = $target.closest('.select2');

      var $all = $('.select2.select2-container--open');

      $all.each(function () {
        var $this = $(this);

        if (this == $select[0]) {
          return;
        }

        var $element = $this.data('element');

        $element.select2('close');
      });
    });
  };

  BaseSelection.prototype._detachCloseHandler = function (container) {
    $(document.body).off('mousedown.select2.' + container.id);
  };

  BaseSelection.prototype.position = function ($selection, $container) {
    var $selectionContainer = $container.find('.selection');
    $selectionContainer.append($selection);
  };

  BaseSelection.prototype.destroy = function () {
    this._detachCloseHandler(this.container);
  };

  BaseSelection.prototype.update = function (data) {
    throw new Error('The `update` method must be defined in child classes.');
  };

  return BaseSelection;
});

S2.define('select2/selection/single',[
  'jquery',
  './base',
  '../utils',
  '../keys'
], function ($, BaseSelection, Utils, KEYS) {
  function SingleSelection () {
    SingleSelection.__super__.constructor.apply(this, arguments);
  }

  Utils.Extend(SingleSelection, BaseSelection);

  SingleSelection.prototype.render = function () {
    var $selection = SingleSelection.__super__.render.call(this);

    $selection.addClass('select2-selection--single');

    $selection.html(
      '<span class="select2-selection__rendered"></span>' +
      '<span class="select2-selection__arrow" role="presentation">' +
        '<b role="presentation"></b>' +
      '</span>'
    );

    return $selection;
  };

  SingleSelection.prototype.bind = function (container, $container) {
    var self = this;

    SingleSelection.__super__.bind.apply(this, arguments);

    var id = container.id + '-container';

    this.$selection.find('.select2-selection__rendered').attr('id', id);
    this.$selection.attr('aria-labelledby', id);

    this.$selection.on('mousedown', function (evt) {
      // Only respond to left clicks
      if (evt.which !== 1) {
        return;
      }

      self.trigger('toggle', {
        originalEvent: evt
      });
    });

    this.$selection.on('focus', function (evt) {
      // User focuses on the container
    });

    this.$selection.on('blur', function (evt) {
      // User exits the container
    });

    container.on('selection:update', function (params) {
      self.update(params.data);
    });
  };

  SingleSelection.prototype.clear = function () {
    this.$selection.find('.select2-selection__rendered').empty();
  };

  SingleSelection.prototype.display = function (data, container) {
    var template = this.options.get('templateSelection');
    var escapeMarkup = this.options.get('escapeMarkup');

    return escapeMarkup(template(data, container));
  };

  SingleSelection.prototype.selectionContainer = function () {
    return $('<span></span>');
  };

  SingleSelection.prototype.update = function (data) {
    if (data.length === 0) {
      this.clear();
      return;
    }

    var selection = data[0];

    var $rendered = this.$selection.find('.select2-selection__rendered');
    var formatted = this.display(selection, $rendered);

    $rendered.empty().append(formatted);
    $rendered.prop('title', selection.title || selection.text);
  };

  return SingleSelection;
});

S2.define('select2/selection/multiple',[
  'jquery',
  './base',
  '../utils'
], function ($, BaseSelection, Utils) {
  function MultipleSelection ($element, options) {
    MultipleSelection.__super__.constructor.apply(this, arguments);
  }

  Utils.Extend(MultipleSelection, BaseSelection);

  MultipleSelection.prototype.render = function () {
    var $selection = MultipleSelection.__super__.render.call(this);

    $selection.addClass('select2-selection--multiple');

    $selection.html(
      '<ul class="select2-selection__rendered"></ul>'
    );

    return $selection;
  };

  MultipleSelection.prototype.bind = function (container, $container) {
    var self = this;

    MultipleSelection.__super__.bind.apply(this, arguments);

    this.$selection.on('click', function (evt) {
      self.trigger('toggle', {
        originalEvent: evt
      });
    });

    this.$selection.on(
      'click',
      '.select2-selection__choice__remove',
      function (evt) {
        // Ignore the event if it is disabled
        if (self.options.get('disabled')) {
          return;
        }

        var $remove = $(this);
        var $selection = $remove.parent();

        var data = $selection.data('data');

        self.trigger('unselect', {
          originalEvent: evt,
          data: data
        });
      }
    );
  };

  MultipleSelection.prototype.clear = function () {
    this.$selection.find('.select2-selection__rendered').empty();
  };

  MultipleSelection.prototype.display = function (data, container) {
    var template = this.options.get('templateSelection');
    var escapeMarkup = this.options.get('escapeMarkup');

    return escapeMarkup(template(data, container));
  };

  MultipleSelection.prototype.selectionContainer = function () {
    var $container = $(
      '<li class="select2-selection__choice">' +
        '<span class="select2-selection__choice__remove" role="presentation">' +
          '&times;' +
        '</span>' +
      '</li>'
    );

    return $container;
  };

  MultipleSelection.prototype.update = function (data) {
    this.clear();

    if (data.length === 0) {
      return;
    }

    var $selections = [];

    for (var d = 0; d < data.length; d++) {
      var selection = data[d];

      var $selection = this.selectionContainer();
      var formatted = this.display(selection, $selection);

      $selection.append(formatted);
      $selection.prop('title', selection.title || selection.text);

      $selection.data('data', selection);

      $selections.push($selection);
    }

    var $rendered = this.$selection.find('.select2-selection__rendered');

    Utils.appendMany($rendered, $selections);
  };

  return MultipleSelection;
});

S2.define('select2/selection/placeholder',[
  '../utils'
], function (Utils) {
  function Placeholder (decorated, $element, options) {
    this.placeholder = this.normalizePlaceholder(options.get('placeholder'));

    decorated.call(this, $element, options);
  }

  Placeholder.prototype.normalizePlaceholder = function (_, placeholder) {
    if (typeof placeholder === 'string') {
      placeholder = {
        id: '',
        text: placeholder
      };
    }

    return placeholder;
  };

  Placeholder.prototype.createPlaceholder = function (decorated, placeholder) {
    var $placeholder = this.selectionContainer();

    $placeholder.html(this.display(placeholder));
    $placeholder.addClass('select2-selection__placeholder')
                .removeClass('select2-selection__choice');

    return $placeholder;
  };

  Placeholder.prototype.update = function (decorated, data) {
    var singlePlaceholder = (
      data.length == 1 && data[0].id != this.placeholder.id
    );
    var multipleSelections = data.length > 1;

    if (multipleSelections || singlePlaceholder) {
      return decorated.call(this, data);
    }

    this.clear();

    var $placeholder = this.createPlaceholder(this.placeholder);

    this.$selection.find('.select2-selection__rendered').append($placeholder);
  };

  return Placeholder;
});

S2.define('select2/selection/allowClear',[
  'jquery',
  '../keys'
], function ($, KEYS) {
  function AllowClear () { }

  AllowClear.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    if (this.placeholder == null) {
      if (this.options.get('debug') && window.console && console.error) {
        console.error(
          'Select2: The `allowClear` option should be used in combination ' +
          'with the `placeholder` option.'
        );
      }
    }

    this.$selection.on('mousedown', '.select2-selection__clear',
      function (evt) {
        self._handleClear(evt);
    });

    container.on('keypress', function (evt) {
      self._handleKeyboardClear(evt, container);
    });
  };

  AllowClear.prototype._handleClear = function (_, evt) {
    // Ignore the event if it is disabled
    if (this.options.get('disabled')) {
      return;
    }

    var $clear = this.$selection.find('.select2-selection__clear');

    // Ignore the event if nothing has been selected
    if ($clear.length === 0) {
      return;
    }

    evt.stopPropagation();

    var data = $clear.data('data');

    for (var d = 0; d < data.length; d++) {
      var unselectData = {
        data: data[d]
      };

      // Trigger the `unselect` event, so people can prevent it from being
      // cleared.
      this.trigger('unselect', unselectData);

      // If the event was prevented, don't clear it out.
      if (unselectData.prevented) {
        return;
      }
    }

    this.$element.val(this.placeholder.id).trigger('change');

    this.trigger('toggle', {});
  };

  AllowClear.prototype._handleKeyboardClear = function (_, evt, container) {
    if (container.isOpen()) {
      return;
    }

    if (evt.which == KEYS.DELETE || evt.which == KEYS.BACKSPACE) {
      this._handleClear(evt);
    }
  };

  AllowClear.prototype.update = function (decorated, data) {
    decorated.call(this, data);

    if (this.$selection.find('.select2-selection__placeholder').length > 0 ||
        data.length === 0) {
      return;
    }

    var $remove = $(
      '<span class="select2-selection__clear">' +
        '&times;' +
      '</span>'
    );
    $remove.data('data', data);

    this.$selection.find('.select2-selection__rendered').prepend($remove);
  };

  return AllowClear;
});

S2.define('select2/selection/search',[
  'jquery',
  '../utils',
  '../keys'
], function ($, Utils, KEYS) {
  function Search (decorated, $element, options) {
    decorated.call(this, $element, options);
  }

  Search.prototype.render = function (decorated) {
    var $search = $(
      '<li class="select2-search select2-search--inline">' +
        '<input class="select2-search__field" type="search" tabindex="-1"' +
        ' autocomplete="off" autocorrect="off" autocapitalize="off"' +
        ' spellcheck="false" role="textbox" aria-autocomplete="list" />' +
      '</li>'
    );

    this.$searchContainer = $search;
    this.$search = $search.find('input');

    var $rendered = decorated.call(this);

    this._transferTabIndex();

    return $rendered;
  };

  Search.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    container.on('open', function () {
      self.$search.trigger('focus');
    });

    container.on('close', function () {
      self.$search.val('');
      self.$search.removeAttr('aria-activedescendant');
      self.$search.trigger('focus');
    });

    container.on('enable', function () {
      self.$search.prop('disabled', false);

      self._transferTabIndex();
    });

    container.on('disable', function () {
      self.$search.prop('disabled', true);
    });

    container.on('focus', function (evt) {
      self.$search.trigger('focus');
    });

    container.on('results:focus', function (params) {
      self.$search.attr('aria-activedescendant', params.id);
    });

    this.$selection.on('focusin', '.select2-search--inline', function (evt) {
      self.trigger('focus', evt);
    });

    this.$selection.on('focusout', '.select2-search--inline', function (evt) {
      self._handleBlur(evt);
    });

    this.$selection.on('keydown', '.select2-search--inline', function (evt) {
      evt.stopPropagation();

      self.trigger('keypress', evt);

      self._keyUpPrevented = evt.isDefaultPrevented();

      var key = evt.which;

      if (key === KEYS.BACKSPACE && self.$search.val() === '') {
        var $previousChoice = self.$searchContainer
          .prev('.select2-selection__choice');

        if ($previousChoice.length > 0) {
          var item = $previousChoice.data('data');

          self.searchRemoveChoice(item);

          evt.preventDefault();
        }
      }
    });

    // Try to detect the IE version should the `documentMode` property that
    // is stored on the document. This is only implemented in IE and is
    // slightly cleaner than doing a user agent check.
    // This property is not available in Edge, but Edge also doesn't have
    // this bug.
    var msie = document.documentMode;
    var disableInputEvents = msie && msie <= 11;

    // Workaround for browsers which do not support the `input` event
    // This will prevent double-triggering of events for browsers which support
    // both the `keyup` and `input` events.
    this.$selection.on(
      'input.searchcheck',
      '.select2-search--inline',
      function (evt) {
        // IE will trigger the `input` event when a placeholder is used on a
        // search box. To get around this issue, we are forced to ignore all
        // `input` events in IE and keep using `keyup`.
        if (disableInputEvents) {
          self.$selection.off('input.search input.searchcheck');
          return;
        }

        // Unbind the duplicated `keyup` event
        self.$selection.off('keyup.search');
      }
    );

    this.$selection.on(
      'keyup.search input.search',
      '.select2-search--inline',
      function (evt) {
        // IE will trigger the `input` event when a placeholder is used on a
        // search box. To get around this issue, we are forced to ignore all
        // `input` events in IE and keep using `keyup`.
        if (disableInputEvents && evt.type === 'input') {
          self.$selection.off('input.search input.searchcheck');
          return;
        }

        var key = evt.which;

        // We can freely ignore events from modifier keys
        if (key == KEYS.SHIFT || key == KEYS.CTRL || key == KEYS.ALT) {
          return;
        }

        // Tabbing will be handled during the `keydown` phase
        if (key == KEYS.TAB) {
          return;
        }

        self.handleSearch(evt);
      }
    );
  };

  /**
   * This method will transfer the tabindex attribute from the rendered
   * selection to the search box. This allows for the search box to be used as
   * the primary focus instead of the selection container.
   *
   * @private
   */
  Search.prototype._transferTabIndex = function (decorated) {
    this.$search.attr('tabindex', this.$selection.attr('tabindex'));
    this.$selection.attr('tabindex', '-1');
  };

  Search.prototype.createPlaceholder = function (decorated, placeholder) {
    this.$search.attr('placeholder', placeholder.text);
  };

  Search.prototype.update = function (decorated, data) {
    var searchHadFocus = this.$search[0] == document.activeElement;

    this.$search.attr('placeholder', '');

    decorated.call(this, data);

    this.$selection.find('.select2-selection__rendered')
                   .append(this.$searchContainer);

    this.resizeSearch();
    if (searchHadFocus) {
      this.$search.focus();
    }
  };

  Search.prototype.handleSearch = function () {
    this.resizeSearch();

    if (!this._keyUpPrevented) {
      var input = this.$search.val();

      this.trigger('query', {
        term: input
      });
    }

    this._keyUpPrevented = false;
  };

  Search.prototype.searchRemoveChoice = function (decorated, item) {
    this.trigger('unselect', {
      data: item
    });

    this.$search.val(item.text);
    this.handleSearch();
  };

  Search.prototype.resizeSearch = function () {
    this.$search.css('width', '25px');

    var width = '';

    if (this.$search.attr('placeholder') !== '') {
      width = this.$selection.find('.select2-selection__rendered').innerWidth();
    } else {
      var minimumWidth = this.$search.val().length + 1;

      width = (minimumWidth * 0.75) + 'em';
    }

    this.$search.css('width', width);
  };

  return Search;
});

S2.define('select2/selection/eventRelay',[
  'jquery'
], function ($) {
  function EventRelay () { }

  EventRelay.prototype.bind = function (decorated, container, $container) {
    var self = this;
    var relayEvents = [
      'open', 'opening',
      'close', 'closing',
      'select', 'selecting',
      'unselect', 'unselecting'
    ];

    var preventableEvents = ['opening', 'closing', 'selecting', 'unselecting'];

    decorated.call(this, container, $container);

    container.on('*', function (name, params) {
      // Ignore events that should not be relayed
      if ($.inArray(name, relayEvents) === -1) {
        return;
      }

      // The parameters should always be an object
      params = params || {};

      // Generate the jQuery event for the Select2 event
      var evt = $.Event('select2:' + name, {
        params: params
      });

      self.$element.trigger(evt);

      // Only handle preventable events if it was one
      if ($.inArray(name, preventableEvents) === -1) {
        return;
      }

      params.prevented = evt.isDefaultPrevented();
    });
  };

  return EventRelay;
});

S2.define('select2/translation',[
  'jquery',
  'require'
], function ($, require) {
  function Translation (dict) {
    this.dict = dict || {};
  }

  Translation.prototype.all = function () {
    return this.dict;
  };

  Translation.prototype.get = function (key) {
    return this.dict[key];
  };

  Translation.prototype.extend = function (translation) {
    this.dict = $.extend({}, translation.all(), this.dict);
  };

  // Static functions

  Translation._cache = {};

  Translation.loadPath = function (path) {
    if (!(path in Translation._cache)) {
      var translations = require(path);

      Translation._cache[path] = translations;
    }

    return new Translation(Translation._cache[path]);
  };

  return Translation;
});

S2.define('select2/diacritics',[

], function () {
  var diacritics = {
    '\u24B6': 'A',
    '\uFF21': 'A',
    '\u00C0': 'A',
    '\u00C1': 'A',
    '\u00C2': 'A',
    '\u1EA6': 'A',
    '\u1EA4': 'A',
    '\u1EAA': 'A',
    '\u1EA8': 'A',
    '\u00C3': 'A',
    '\u0100': 'A',
    '\u0102': 'A',
    '\u1EB0': 'A',
    '\u1EAE': 'A',
    '\u1EB4': 'A',
    '\u1EB2': 'A',
    '\u0226': 'A',
    '\u01E0': 'A',
    '\u00C4': 'A',
    '\u01DE': 'A',
    '\u1EA2': 'A',
    '\u00C5': 'A',
    '\u01FA': 'A',
    '\u01CD': 'A',
    '\u0200': 'A',
    '\u0202': 'A',
    '\u1EA0': 'A',
    '\u1EAC': 'A',
    '\u1EB6': 'A',
    '\u1E00': 'A',
    '\u0104': 'A',
    '\u023A': 'A',
    '\u2C6F': 'A',
    '\uA732': 'AA',
    '\u00C6': 'AE',
    '\u01FC': 'AE',
    '\u01E2': 'AE',
    '\uA734': 'AO',
    '\uA736': 'AU',
    '\uA738': 'AV',
    '\uA73A': 'AV',
    '\uA73C': 'AY',
    '\u24B7': 'B',
    '\uFF22': 'B',
    '\u1E02': 'B',
    '\u1E04': 'B',
    '\u1E06': 'B',
    '\u0243': 'B',
    '\u0182': 'B',
    '\u0181': 'B',
    '\u24B8': 'C',
    '\uFF23': 'C',
    '\u0106': 'C',
    '\u0108': 'C',
    '\u010A': 'C',
    '\u010C': 'C',
    '\u00C7': 'C',
    '\u1E08': 'C',
    '\u0187': 'C',
    '\u023B': 'C',
    '\uA73E': 'C',
    '\u24B9': 'D',
    '\uFF24': 'D',
    '\u1E0A': 'D',
    '\u010E': 'D',
    '\u1E0C': 'D',
    '\u1E10': 'D',
    '\u1E12': 'D',
    '\u1E0E': 'D',
    '\u0110': 'D',
    '\u018B': 'D',
    '\u018A': 'D',
    '\u0189': 'D',
    '\uA779': 'D',
    '\u01F1': 'DZ',
    '\u01C4': 'DZ',
    '\u01F2': 'Dz',
    '\u01C5': 'Dz',
    '\u24BA': 'E',
    '\uFF25': 'E',
    '\u00C8': 'E',
    '\u00C9': 'E',
    '\u00CA': 'E',
    '\u1EC0': 'E',
    '\u1EBE': 'E',
    '\u1EC4': 'E',
    '\u1EC2': 'E',
    '\u1EBC': 'E',
    '\u0112': 'E',
    '\u1E14': 'E',
    '\u1E16': 'E',
    '\u0114': 'E',
    '\u0116': 'E',
    '\u00CB': 'E',
    '\u1EBA': 'E',
    '\u011A': 'E',
    '\u0204': 'E',
    '\u0206': 'E',
    '\u1EB8': 'E',
    '\u1EC6': 'E',
    '\u0228': 'E',
    '\u1E1C': 'E',
    '\u0118': 'E',
    '\u1E18': 'E',
    '\u1E1A': 'E',
    '\u0190': 'E',
    '\u018E': 'E',
    '\u24BB': 'F',
    '\uFF26': 'F',
    '\u1E1E': 'F',
    '\u0191': 'F',
    '\uA77B': 'F',
    '\u24BC': 'G',
    '\uFF27': 'G',
    '\u01F4': 'G',
    '\u011C': 'G',
    '\u1E20': 'G',
    '\u011E': 'G',
    '\u0120': 'G',
    '\u01E6': 'G',
    '\u0122': 'G',
    '\u01E4': 'G',
    '\u0193': 'G',
    '\uA7A0': 'G',
    '\uA77D': 'G',
    '\uA77E': 'G',
    '\u24BD': 'H',
    '\uFF28': 'H',
    '\u0124': 'H',
    '\u1E22': 'H',
    '\u1E26': 'H',
    '\u021E': 'H',
    '\u1E24': 'H',
    '\u1E28': 'H',
    '\u1E2A': 'H',
    '\u0126': 'H',
    '\u2C67': 'H',
    '\u2C75': 'H',
    '\uA78D': 'H',
    '\u24BE': 'I',
    '\uFF29': 'I',
    '\u00CC': 'I',
    '\u00CD': 'I',
    '\u00CE': 'I',
    '\u0128': 'I',
    '\u012A': 'I',
    '\u012C': 'I',
    '\u0130': 'I',
    '\u00CF': 'I',
    '\u1E2E': 'I',
    '\u1EC8': 'I',
    '\u01CF': 'I',
    '\u0208': 'I',
    '\u020A': 'I',
    '\u1ECA': 'I',
    '\u012E': 'I',
    '\u1E2C': 'I',
    '\u0197': 'I',
    '\u24BF': 'J',
    '\uFF2A': 'J',
    '\u0134': 'J',
    '\u0248': 'J',
    '\u24C0': 'K',
    '\uFF2B': 'K',
    '\u1E30': 'K',
    '\u01E8': 'K',
    '\u1E32': 'K',
    '\u0136': 'K',
    '\u1E34': 'K',
    '\u0198': 'K',
    '\u2C69': 'K',
    '\uA740': 'K',
    '\uA742': 'K',
    '\uA744': 'K',
    '\uA7A2': 'K',
    '\u24C1': 'L',
    '\uFF2C': 'L',
    '\u013F': 'L',
    '\u0139': 'L',
    '\u013D': 'L',
    '\u1E36': 'L',
    '\u1E38': 'L',
    '\u013B': 'L',
    '\u1E3C': 'L',
    '\u1E3A': 'L',
    '\u0141': 'L',
    '\u023D': 'L',
    '\u2C62': 'L',
    '\u2C60': 'L',
    '\uA748': 'L',
    '\uA746': 'L',
    '\uA780': 'L',
    '\u01C7': 'LJ',
    '\u01C8': 'Lj',
    '\u24C2': 'M',
    '\uFF2D': 'M',
    '\u1E3E': 'M',
    '\u1E40': 'M',
    '\u1E42': 'M',
    '\u2C6E': 'M',
    '\u019C': 'M',
    '\u24C3': 'N',
    '\uFF2E': 'N',
    '\u01F8': 'N',
    '\u0143': 'N',
    '\u00D1': 'N',
    '\u1E44': 'N',
    '\u0147': 'N',
    '\u1E46': 'N',
    '\u0145': 'N',
    '\u1E4A': 'N',
    '\u1E48': 'N',
    '\u0220': 'N',
    '\u019D': 'N',
    '\uA790': 'N',
    '\uA7A4': 'N',
    '\u01CA': 'NJ',
    '\u01CB': 'Nj',
    '\u24C4': 'O',
    '\uFF2F': 'O',
    '\u00D2': 'O',
    '\u00D3': 'O',
    '\u00D4': 'O',
    '\u1ED2': 'O',
    '\u1ED0': 'O',
    '\u1ED6': 'O',
    '\u1ED4': 'O',
    '\u00D5': 'O',
    '\u1E4C': 'O',
    '\u022C': 'O',
    '\u1E4E': 'O',
    '\u014C': 'O',
    '\u1E50': 'O',
    '\u1E52': 'O',
    '\u014E': 'O',
    '\u022E': 'O',
    '\u0230': 'O',
    '\u00D6': 'O',
    '\u022A': 'O',
    '\u1ECE': 'O',
    '\u0150': 'O',
    '\u01D1': 'O',
    '\u020C': 'O',
    '\u020E': 'O',
    '\u01A0': 'O',
    '\u1EDC': 'O',
    '\u1EDA': 'O',
    '\u1EE0': 'O',
    '\u1EDE': 'O',
    '\u1EE2': 'O',
    '\u1ECC': 'O',
    '\u1ED8': 'O',
    '\u01EA': 'O',
    '\u01EC': 'O',
    '\u00D8': 'O',
    '\u01FE': 'O',
    '\u0186': 'O',
    '\u019F': 'O',
    '\uA74A': 'O',
    '\uA74C': 'O',
    '\u01A2': 'OI',
    '\uA74E': 'OO',
    '\u0222': 'OU',
    '\u24C5': 'P',
    '\uFF30': 'P',
    '\u1E54': 'P',
    '\u1E56': 'P',
    '\u01A4': 'P',
    '\u2C63': 'P',
    '\uA750': 'P',
    '\uA752': 'P',
    '\uA754': 'P',
    '\u24C6': 'Q',
    '\uFF31': 'Q',
    '\uA756': 'Q',
    '\uA758': 'Q',
    '\u024A': 'Q',
    '\u24C7': 'R',
    '\uFF32': 'R',
    '\u0154': 'R',
    '\u1E58': 'R',
    '\u0158': 'R',
    '\u0210': 'R',
    '\u0212': 'R',
    '\u1E5A': 'R',
    '\u1E5C': 'R',
    '\u0156': 'R',
    '\u1E5E': 'R',
    '\u024C': 'R',
    '\u2C64': 'R',
    '\uA75A': 'R',
    '\uA7A6': 'R',
    '\uA782': 'R',
    '\u24C8': 'S',
    '\uFF33': 'S',
    '\u1E9E': 'S',
    '\u015A': 'S',
    '\u1E64': 'S',
    '\u015C': 'S',
    '\u1E60': 'S',
    '\u0160': 'S',
    '\u1E66': 'S',
    '\u1E62': 'S',
    '\u1E68': 'S',
    '\u0218': 'S',
    '\u015E': 'S',
    '\u2C7E': 'S',
    '\uA7A8': 'S',
    '\uA784': 'S',
    '\u24C9': 'T',
    '\uFF34': 'T',
    '\u1E6A': 'T',
    '\u0164': 'T',
    '\u1E6C': 'T',
    '\u021A': 'T',
    '\u0162': 'T',
    '\u1E70': 'T',
    '\u1E6E': 'T',
    '\u0166': 'T',
    '\u01AC': 'T',
    '\u01AE': 'T',
    '\u023E': 'T',
    '\uA786': 'T',
    '\uA728': 'TZ',
    '\u24CA': 'U',
    '\uFF35': 'U',
    '\u00D9': 'U',
    '\u00DA': 'U',
    '\u00DB': 'U',
    '\u0168': 'U',
    '\u1E78': 'U',
    '\u016A': 'U',
    '\u1E7A': 'U',
    '\u016C': 'U',
    '\u00DC': 'U',
    '\u01DB': 'U',
    '\u01D7': 'U',
    '\u01D5': 'U',
    '\u01D9': 'U',
    '\u1EE6': 'U',
    '\u016E': 'U',
    '\u0170': 'U',
    '\u01D3': 'U',
    '\u0214': 'U',
    '\u0216': 'U',
    '\u01AF': 'U',
    '\u1EEA': 'U',
    '\u1EE8': 'U',
    '\u1EEE': 'U',
    '\u1EEC': 'U',
    '\u1EF0': 'U',
    '\u1EE4': 'U',
    '\u1E72': 'U',
    '\u0172': 'U',
    '\u1E76': 'U',
    '\u1E74': 'U',
    '\u0244': 'U',
    '\u24CB': 'V',
    '\uFF36': 'V',
    '\u1E7C': 'V',
    '\u1E7E': 'V',
    '\u01B2': 'V',
    '\uA75E': 'V',
    '\u0245': 'V',
    '\uA760': 'VY',
    '\u24CC': 'W',
    '\uFF37': 'W',
    '\u1E80': 'W',
    '\u1E82': 'W',
    '\u0174': 'W',
    '\u1E86': 'W',
    '\u1E84': 'W',
    '\u1E88': 'W',
    '\u2C72': 'W',
    '\u24CD': 'X',
    '\uFF38': 'X',
    '\u1E8A': 'X',
    '\u1E8C': 'X',
    '\u24CE': 'Y',
    '\uFF39': 'Y',
    '\u1EF2': 'Y',
    '\u00DD': 'Y',
    '\u0176': 'Y',
    '\u1EF8': 'Y',
    '\u0232': 'Y',
    '\u1E8E': 'Y',
    '\u0178': 'Y',
    '\u1EF6': 'Y',
    '\u1EF4': 'Y',
    '\u01B3': 'Y',
    '\u024E': 'Y',
    '\u1EFE': 'Y',
    '\u24CF': 'Z',
    '\uFF3A': 'Z',
    '\u0179': 'Z',
    '\u1E90': 'Z',
    '\u017B': 'Z',
    '\u017D': 'Z',
    '\u1E92': 'Z',
    '\u1E94': 'Z',
    '\u01B5': 'Z',
    '\u0224': 'Z',
    '\u2C7F': 'Z',
    '\u2C6B': 'Z',
    '\uA762': 'Z',
    '\u24D0': 'a',
    '\uFF41': 'a',
    '\u1E9A': 'a',
    '\u00E0': 'a',
    '\u00E1': 'a',
    '\u00E2': 'a',
    '\u1EA7': 'a',
    '\u1EA5': 'a',
    '\u1EAB': 'a',
    '\u1EA9': 'a',
    '\u00E3': 'a',
    '\u0101': 'a',
    '\u0103': 'a',
    '\u1EB1': 'a',
    '\u1EAF': 'a',
    '\u1EB5': 'a',
    '\u1EB3': 'a',
    '\u0227': 'a',
    '\u01E1': 'a',
    '\u00E4': 'a',
    '\u01DF': 'a',
    '\u1EA3': 'a',
    '\u00E5': 'a',
    '\u01FB': 'a',
    '\u01CE': 'a',
    '\u0201': 'a',
    '\u0203': 'a',
    '\u1EA1': 'a',
    '\u1EAD': 'a',
    '\u1EB7': 'a',
    '\u1E01': 'a',
    '\u0105': 'a',
    '\u2C65': 'a',
    '\u0250': 'a',
    '\uA733': 'aa',
    '\u00E6': 'ae',
    '\u01FD': 'ae',
    '\u01E3': 'ae',
    '\uA735': 'ao',
    '\uA737': 'au',
    '\uA739': 'av',
    '\uA73B': 'av',
    '\uA73D': 'ay',
    '\u24D1': 'b',
    '\uFF42': 'b',
    '\u1E03': 'b',
    '\u1E05': 'b',
    '\u1E07': 'b',
    '\u0180': 'b',
    '\u0183': 'b',
    '\u0253': 'b',
    '\u24D2': 'c',
    '\uFF43': 'c',
    '\u0107': 'c',
    '\u0109': 'c',
    '\u010B': 'c',
    '\u010D': 'c',
    '\u00E7': 'c',
    '\u1E09': 'c',
    '\u0188': 'c',
    '\u023C': 'c',
    '\uA73F': 'c',
    '\u2184': 'c',
    '\u24D3': 'd',
    '\uFF44': 'd',
    '\u1E0B': 'd',
    '\u010F': 'd',
    '\u1E0D': 'd',
    '\u1E11': 'd',
    '\u1E13': 'd',
    '\u1E0F': 'd',
    '\u0111': 'd',
    '\u018C': 'd',
    '\u0256': 'd',
    '\u0257': 'd',
    '\uA77A': 'd',
    '\u01F3': 'dz',
    '\u01C6': 'dz',
    '\u24D4': 'e',
    '\uFF45': 'e',
    '\u00E8': 'e',
    '\u00E9': 'e',
    '\u00EA': 'e',
    '\u1EC1': 'e',
    '\u1EBF': 'e',
    '\u1EC5': 'e',
    '\u1EC3': 'e',
    '\u1EBD': 'e',
    '\u0113': 'e',
    '\u1E15': 'e',
    '\u1E17': 'e',
    '\u0115': 'e',
    '\u0117': 'e',
    '\u00EB': 'e',
    '\u1EBB': 'e',
    '\u011B': 'e',
    '\u0205': 'e',
    '\u0207': 'e',
    '\u1EB9': 'e',
    '\u1EC7': 'e',
    '\u0229': 'e',
    '\u1E1D': 'e',
    '\u0119': 'e',
    '\u1E19': 'e',
    '\u1E1B': 'e',
    '\u0247': 'e',
    '\u025B': 'e',
    '\u01DD': 'e',
    '\u24D5': 'f',
    '\uFF46': 'f',
    '\u1E1F': 'f',
    '\u0192': 'f',
    '\uA77C': 'f',
    '\u24D6': 'g',
    '\uFF47': 'g',
    '\u01F5': 'g',
    '\u011D': 'g',
    '\u1E21': 'g',
    '\u011F': 'g',
    '\u0121': 'g',
    '\u01E7': 'g',
    '\u0123': 'g',
    '\u01E5': 'g',
    '\u0260': 'g',
    '\uA7A1': 'g',
    '\u1D79': 'g',
    '\uA77F': 'g',
    '\u24D7': 'h',
    '\uFF48': 'h',
    '\u0125': 'h',
    '\u1E23': 'h',
    '\u1E27': 'h',
    '\u021F': 'h',
    '\u1E25': 'h',
    '\u1E29': 'h',
    '\u1E2B': 'h',
    '\u1E96': 'h',
    '\u0127': 'h',
    '\u2C68': 'h',
    '\u2C76': 'h',
    '\u0265': 'h',
    '\u0195': 'hv',
    '\u24D8': 'i',
    '\uFF49': 'i',
    '\u00EC': 'i',
    '\u00ED': 'i',
    '\u00EE': 'i',
    '\u0129': 'i',
    '\u012B': 'i',
    '\u012D': 'i',
    '\u00EF': 'i',
    '\u1E2F': 'i',
    '\u1EC9': 'i',
    '\u01D0': 'i',
    '\u0209': 'i',
    '\u020B': 'i',
    '\u1ECB': 'i',
    '\u012F': 'i',
    '\u1E2D': 'i',
    '\u0268': 'i',
    '\u0131': 'i',
    '\u24D9': 'j',
    '\uFF4A': 'j',
    '\u0135': 'j',
    '\u01F0': 'j',
    '\u0249': 'j',
    '\u24DA': 'k',
    '\uFF4B': 'k',
    '\u1E31': 'k',
    '\u01E9': 'k',
    '\u1E33': 'k',
    '\u0137': 'k',
    '\u1E35': 'k',
    '\u0199': 'k',
    '\u2C6A': 'k',
    '\uA741': 'k',
    '\uA743': 'k',
    '\uA745': 'k',
    '\uA7A3': 'k',
    '\u24DB': 'l',
    '\uFF4C': 'l',
    '\u0140': 'l',
    '\u013A': 'l',
    '\u013E': 'l',
    '\u1E37': 'l',
    '\u1E39': 'l',
    '\u013C': 'l',
    '\u1E3D': 'l',
    '\u1E3B': 'l',
    '\u017F': 'l',
    '\u0142': 'l',
    '\u019A': 'l',
    '\u026B': 'l',
    '\u2C61': 'l',
    '\uA749': 'l',
    '\uA781': 'l',
    '\uA747': 'l',
    '\u01C9': 'lj',
    '\u24DC': 'm',
    '\uFF4D': 'm',
    '\u1E3F': 'm',
    '\u1E41': 'm',
    '\u1E43': 'm',
    '\u0271': 'm',
    '\u026F': 'm',
    '\u24DD': 'n',
    '\uFF4E': 'n',
    '\u01F9': 'n',
    '\u0144': 'n',
    '\u00F1': 'n',
    '\u1E45': 'n',
    '\u0148': 'n',
    '\u1E47': 'n',
    '\u0146': 'n',
    '\u1E4B': 'n',
    '\u1E49': 'n',
    '\u019E': 'n',
    '\u0272': 'n',
    '\u0149': 'n',
    '\uA791': 'n',
    '\uA7A5': 'n',
    '\u01CC': 'nj',
    '\u24DE': 'o',
    '\uFF4F': 'o',
    '\u00F2': 'o',
    '\u00F3': 'o',
    '\u00F4': 'o',
    '\u1ED3': 'o',
    '\u1ED1': 'o',
    '\u1ED7': 'o',
    '\u1ED5': 'o',
    '\u00F5': 'o',
    '\u1E4D': 'o',
    '\u022D': 'o',
    '\u1E4F': 'o',
    '\u014D': 'o',
    '\u1E51': 'o',
    '\u1E53': 'o',
    '\u014F': 'o',
    '\u022F': 'o',
    '\u0231': 'o',
    '\u00F6': 'o',
    '\u022B': 'o',
    '\u1ECF': 'o',
    '\u0151': 'o',
    '\u01D2': 'o',
    '\u020D': 'o',
    '\u020F': 'o',
    '\u01A1': 'o',
    '\u1EDD': 'o',
    '\u1EDB': 'o',
    '\u1EE1': 'o',
    '\u1EDF': 'o',
    '\u1EE3': 'o',
    '\u1ECD': 'o',
    '\u1ED9': 'o',
    '\u01EB': 'o',
    '\u01ED': 'o',
    '\u00F8': 'o',
    '\u01FF': 'o',
    '\u0254': 'o',
    '\uA74B': 'o',
    '\uA74D': 'o',
    '\u0275': 'o',
    '\u01A3': 'oi',
    '\u0223': 'ou',
    '\uA74F': 'oo',
    '\u24DF': 'p',
    '\uFF50': 'p',
    '\u1E55': 'p',
    '\u1E57': 'p',
    '\u01A5': 'p',
    '\u1D7D': 'p',
    '\uA751': 'p',
    '\uA753': 'p',
    '\uA755': 'p',
    '\u24E0': 'q',
    '\uFF51': 'q',
    '\u024B': 'q',
    '\uA757': 'q',
    '\uA759': 'q',
    '\u24E1': 'r',
    '\uFF52': 'r',
    '\u0155': 'r',
    '\u1E59': 'r',
    '\u0159': 'r',
    '\u0211': 'r',
    '\u0213': 'r',
    '\u1E5B': 'r',
    '\u1E5D': 'r',
    '\u0157': 'r',
    '\u1E5F': 'r',
    '\u024D': 'r',
    '\u027D': 'r',
    '\uA75B': 'r',
    '\uA7A7': 'r',
    '\uA783': 'r',
    '\u24E2': 's',
    '\uFF53': 's',
    '\u00DF': 's',
    '\u015B': 's',
    '\u1E65': 's',
    '\u015D': 's',
    '\u1E61': 's',
    '\u0161': 's',
    '\u1E67': 's',
    '\u1E63': 's',
    '\u1E69': 's',
    '\u0219': 's',
    '\u015F': 's',
    '\u023F': 's',
    '\uA7A9': 's',
    '\uA785': 's',
    '\u1E9B': 's',
    '\u24E3': 't',
    '\uFF54': 't',
    '\u1E6B': 't',
    '\u1E97': 't',
    '\u0165': 't',
    '\u1E6D': 't',
    '\u021B': 't',
    '\u0163': 't',
    '\u1E71': 't',
    '\u1E6F': 't',
    '\u0167': 't',
    '\u01AD': 't',
    '\u0288': 't',
    '\u2C66': 't',
    '\uA787': 't',
    '\uA729': 'tz',
    '\u24E4': 'u',
    '\uFF55': 'u',
    '\u00F9': 'u',
    '\u00FA': 'u',
    '\u00FB': 'u',
    '\u0169': 'u',
    '\u1E79': 'u',
    '\u016B': 'u',
    '\u1E7B': 'u',
    '\u016D': 'u',
    '\u00FC': 'u',
    '\u01DC': 'u',
    '\u01D8': 'u',
    '\u01D6': 'u',
    '\u01DA': 'u',
    '\u1EE7': 'u',
    '\u016F': 'u',
    '\u0171': 'u',
    '\u01D4': 'u',
    '\u0215': 'u',
    '\u0217': 'u',
    '\u01B0': 'u',
    '\u1EEB': 'u',
    '\u1EE9': 'u',
    '\u1EEF': 'u',
    '\u1EED': 'u',
    '\u1EF1': 'u',
    '\u1EE5': 'u',
    '\u1E73': 'u',
    '\u0173': 'u',
    '\u1E77': 'u',
    '\u1E75': 'u',
    '\u0289': 'u',
    '\u24E5': 'v',
    '\uFF56': 'v',
    '\u1E7D': 'v',
    '\u1E7F': 'v',
    '\u028B': 'v',
    '\uA75F': 'v',
    '\u028C': 'v',
    '\uA761': 'vy',
    '\u24E6': 'w',
    '\uFF57': 'w',
    '\u1E81': 'w',
    '\u1E83': 'w',
    '\u0175': 'w',
    '\u1E87': 'w',
    '\u1E85': 'w',
    '\u1E98': 'w',
    '\u1E89': 'w',
    '\u2C73': 'w',
    '\u24E7': 'x',
    '\uFF58': 'x',
    '\u1E8B': 'x',
    '\u1E8D': 'x',
    '\u24E8': 'y',
    '\uFF59': 'y',
    '\u1EF3': 'y',
    '\u00FD': 'y',
    '\u0177': 'y',
    '\u1EF9': 'y',
    '\u0233': 'y',
    '\u1E8F': 'y',
    '\u00FF': 'y',
    '\u1EF7': 'y',
    '\u1E99': 'y',
    '\u1EF5': 'y',
    '\u01B4': 'y',
    '\u024F': 'y',
    '\u1EFF': 'y',
    '\u24E9': 'z',
    '\uFF5A': 'z',
    '\u017A': 'z',
    '\u1E91': 'z',
    '\u017C': 'z',
    '\u017E': 'z',
    '\u1E93': 'z',
    '\u1E95': 'z',
    '\u01B6': 'z',
    '\u0225': 'z',
    '\u0240': 'z',
    '\u2C6C': 'z',
    '\uA763': 'z',
    '\u0386': '\u0391',
    '\u0388': '\u0395',
    '\u0389': '\u0397',
    '\u038A': '\u0399',
    '\u03AA': '\u0399',
    '\u038C': '\u039F',
    '\u038E': '\u03A5',
    '\u03AB': '\u03A5',
    '\u038F': '\u03A9',
    '\u03AC': '\u03B1',
    '\u03AD': '\u03B5',
    '\u03AE': '\u03B7',
    '\u03AF': '\u03B9',
    '\u03CA': '\u03B9',
    '\u0390': '\u03B9',
    '\u03CC': '\u03BF',
    '\u03CD': '\u03C5',
    '\u03CB': '\u03C5',
    '\u03B0': '\u03C5',
    '\u03C9': '\u03C9',
    '\u03C2': '\u03C3'
  };

  return diacritics;
});

S2.define('select2/data/base',[
  '../utils'
], function (Utils) {
  function BaseAdapter ($element, options) {
    BaseAdapter.__super__.constructor.call(this);
  }

  Utils.Extend(BaseAdapter, Utils.Observable);

  BaseAdapter.prototype.current = function (callback) {
    throw new Error('The `current` method must be defined in child classes.');
  };

  BaseAdapter.prototype.query = function (params, callback) {
    throw new Error('The `query` method must be defined in child classes.');
  };

  BaseAdapter.prototype.bind = function (container, $container) {
    // Can be implemented in subclasses
  };

  BaseAdapter.prototype.destroy = function () {
    // Can be implemented in subclasses
  };

  BaseAdapter.prototype.generateResultId = function (container, data) {
    var id = container.id + '-result-';

    id += Utils.generateChars(4);

    if (data.id != null) {
      id += '-' + data.id.toString();
    } else {
      id += '-' + Utils.generateChars(4);
    }
    return id;
  };

  return BaseAdapter;
});

S2.define('select2/data/select',[
  './base',
  '../utils',
  'jquery'
], function (BaseAdapter, Utils, $) {
  function SelectAdapter ($element, options) {
    this.$element = $element;
    this.options = options;

    SelectAdapter.__super__.constructor.call(this);
  }

  Utils.Extend(SelectAdapter, BaseAdapter);

  SelectAdapter.prototype.current = function (callback) {
    var data = [];
    var self = this;

    this.$element.find(':selected').each(function () {
      var $option = $(this);

      var option = self.item($option);

      data.push(option);
    });

    callback(data);
  };

  SelectAdapter.prototype.select = function (data) {
    var self = this;

    data.selected = true;

    // If data.element is a DOM node, use it instead
    if ($(data.element).is('option')) {
      data.element.selected = true;

      this.$element.trigger('change');

      return;
    }

    if (this.$element.prop('multiple')) {
      this.current(function (currentData) {
        var val = [];

        data = [data];
        data.push.apply(data, currentData);

        for (var d = 0; d < data.length; d++) {
          var id = data[d].id;

          if ($.inArray(id, val) === -1) {
            val.push(id);
          }
        }

        self.$element.val(val);
        self.$element.trigger('change');
      });
    } else {
      var val = data.id;

      this.$element.val(val);
      this.$element.trigger('change');
    }
  };

  SelectAdapter.prototype.unselect = function (data) {
    var self = this;

    if (!this.$element.prop('multiple')) {
      return;
    }

    data.selected = false;

    if ($(data.element).is('option')) {
      data.element.selected = false;

      this.$element.trigger('change');

      return;
    }

    this.current(function (currentData) {
      var val = [];

      for (var d = 0; d < currentData.length; d++) {
        var id = currentData[d].id;

        if (id !== data.id && $.inArray(id, val) === -1) {
          val.push(id);
        }
      }

      self.$element.val(val);

      self.$element.trigger('change');
    });
  };

  SelectAdapter.prototype.bind = function (container, $container) {
    var self = this;

    this.container = container;

    container.on('select', function (params) {
      self.select(params.data);
    });

    container.on('unselect', function (params) {
      self.unselect(params.data);
    });
  };

  SelectAdapter.prototype.destroy = function () {
    // Remove anything added to child elements
    this.$element.find('*').each(function () {
      // Remove any custom data set by Select2
      $.removeData(this, 'data');
    });
  };

  SelectAdapter.prototype.query = function (params, callback) {
    var data = [];
    var self = this;

    var $options = this.$element.children();

    $options.each(function () {
      var $option = $(this);

      if (!$option.is('option') && !$option.is('optgroup')) {
        return;
      }

      var option = self.item($option);

      var matches = self.matches(params, option);

      if (matches !== null) {
        data.push(matches);
      }
    });

    callback({
      results: data
    });
  };

  SelectAdapter.prototype.addOptions = function ($options) {
    Utils.appendMany(this.$element, $options);
  };

  SelectAdapter.prototype.option = function (data) {
    var option;

    if (data.children) {
      option = document.createElement('optgroup');
      option.label = data.text;
    } else {
      option = document.createElement('option');

      if (option.textContent !== undefined) {
        option.textContent = data.text;
      } else {
        option.innerText = data.text;
      }
    }

    if (data.id) {
      option.value = data.id;
    }

    if (data.disabled) {
      option.disabled = true;
    }

    if (data.selected) {
      option.selected = true;
    }

    if (data.title) {
      option.title = data.title;
    }

    var $option = $(option);

    var normalizedData = this._normalizeItem(data);
    normalizedData.element = option;

    // Override the option's data with the combined data
    $.data(option, 'data', normalizedData);

    return $option;
  };

  SelectAdapter.prototype.item = function ($option) {
    var data = {};

    data = $.data($option[0], 'data');

    if (data != null) {
      return data;
    }

    if ($option.is('option')) {
      data = {
        id: $option.val(),
        text: $option.text(),
        disabled: $option.prop('disabled'),
        selected: $option.prop('selected'),
        title: $option.prop('title')
      };
    } else if ($option.is('optgroup')) {
      data = {
        text: $option.prop('label'),
        children: [],
        title: $option.prop('title')
      };

      var $children = $option.children('option');
      var children = [];

      for (var c = 0; c < $children.length; c++) {
        var $child = $($children[c]);

        var child = this.item($child);

        children.push(child);
      }

      data.children = children;
    }

    data = this._normalizeItem(data);
    data.element = $option[0];

    $.data($option[0], 'data', data);

    return data;
  };

  SelectAdapter.prototype._normalizeItem = function (item) {
    if (!$.isPlainObject(item)) {
      item = {
        id: item,
        text: item
      };
    }

    item = $.extend({}, {
      text: ''
    }, item);

    var defaults = {
      selected: false,
      disabled: false
    };

    if (item.id != null) {
      item.id = item.id.toString();
    }

    if (item.text != null) {
      item.text = item.text.toString();
    }

    if (item._resultId == null && item.id && this.container != null) {
      item._resultId = this.generateResultId(this.container, item);
    }

    return $.extend({}, defaults, item);
  };

  SelectAdapter.prototype.matches = function (params, data) {
    var matcher = this.options.get('matcher');

    return matcher(params, data);
  };

  return SelectAdapter;
});

S2.define('select2/data/array',[
  './select',
  '../utils',
  'jquery'
], function (SelectAdapter, Utils, $) {
  function ArrayAdapter ($element, options) {
    var data = options.get('data') || [];

    ArrayAdapter.__super__.constructor.call(this, $element, options);

    this.addOptions(this.convertToOptions(data));
  }

  Utils.Extend(ArrayAdapter, SelectAdapter);

  ArrayAdapter.prototype.select = function (data) {
    var $option = this.$element.find('option').filter(function (i, elm) {
      return elm.value == data.id.toString();
    });

    if ($option.length === 0) {
      $option = this.option(data);

      this.addOptions($option);
    }

    ArrayAdapter.__super__.select.call(this, data);
  };

  ArrayAdapter.prototype.convertToOptions = function (data) {
    var self = this;

    var $existing = this.$element.find('option');
    var existingIds = $existing.map(function () {
      return self.item($(this)).id;
    }).get();

    var $options = [];

    // Filter out all items except for the one passed in the argument
    function onlyItem (item) {
      return function () {
        return $(this).val() == item.id;
      };
    }

    for (var d = 0; d < data.length; d++) {
      var item = this._normalizeItem(data[d]);

      // Skip items which were pre-loaded, only merge the data
      if ($.inArray(item.id, existingIds) >= 0) {
        var $existingOption = $existing.filter(onlyItem(item));

        var existingData = this.item($existingOption);
        var newData = $.extend(true, {}, existingData, item);

        var $newOption = this.option(newData);

        $existingOption.replaceWith($newOption);

        continue;
      }

      var $option = this.option(item);

      if (item.children) {
        var $children = this.convertToOptions(item.children);

        Utils.appendMany($option, $children);
      }

      $options.push($option);
    }

    return $options;
  };

  return ArrayAdapter;
});

S2.define('select2/data/ajax',[
  './array',
  '../utils',
  'jquery'
], function (ArrayAdapter, Utils, $) {
  function AjaxAdapter ($element, options) {
    this.ajaxOptions = this._applyDefaults(options.get('ajax'));

    if (this.ajaxOptions.processResults != null) {
      this.processResults = this.ajaxOptions.processResults;
    }

    AjaxAdapter.__super__.constructor.call(this, $element, options);
  }

  Utils.Extend(AjaxAdapter, ArrayAdapter);

  AjaxAdapter.prototype._applyDefaults = function (options) {
    var defaults = {
      data: function (params) {
        return $.extend({}, params, {
          q: params.term
        });
      },
      transport: function (params, success, failure) {
        var $request = $.ajax(params);

        $request.then(success);
        $request.fail(failure);

        return $request;
      }
    };

    return $.extend({}, defaults, options, true);
  };

  AjaxAdapter.prototype.processResults = function (results) {
    return results;
  };

  AjaxAdapter.prototype.query = function (params, callback) {
    var matches = [];
    var self = this;

    if (this._request != null) {
      // JSONP requests cannot always be aborted
      if ($.isFunction(this._request.abort)) {
        this._request.abort();
      }

      this._request = null;
    }

    var options = $.extend({
      type: 'GET'
    }, this.ajaxOptions);

    if (typeof options.url === 'function') {
      options.url = options.url.call(this.$element, params);
    }

    if (typeof options.data === 'function') {
      options.data = options.data.call(this.$element, params);
    }

    function request () {
      var $request = options.transport(options, function (data) {
        var results = self.processResults(data, params);

        if (self.options.get('debug') && window.console && console.error) {
          // Check to make sure that the response included a `results` key.
          if (!results || !results.results || !$.isArray(results.results)) {
            console.error(
              'Select2: The AJAX results did not return an array in the ' +
              '`results` key of the response.'
            );
          }
        }

        callback(results);
      }, function () {
        // TODO: Handle AJAX errors
      });

      self._request = $request;
    }

    if (this.ajaxOptions.delay && params.term !== '') {
      if (this._queryTimeout) {
        window.clearTimeout(this._queryTimeout);
      }

      this._queryTimeout = window.setTimeout(request, this.ajaxOptions.delay);
    } else {
      request();
    }
  };

  return AjaxAdapter;
});

S2.define('select2/data/tags',[
  'jquery'
], function ($) {
  function Tags (decorated, $element, options) {
    var tags = options.get('tags');

    var createTag = options.get('createTag');

    if (createTag !== undefined) {
      this.createTag = createTag;
    }

    decorated.call(this, $element, options);

    if ($.isArray(tags)) {
      for (var t = 0; t < tags.length; t++) {
        var tag = tags[t];
        var item = this._normalizeItem(tag);

        var $option = this.option(item);

        this.$element.append($option);
      }
    }
  }

  Tags.prototype.query = function (decorated, params, callback) {
    var self = this;

    this._removeOldTags();

    if (params.term == null || params.page != null) {
      decorated.call(this, params, callback);
      return;
    }

    function wrapper (obj, child) {
      var data = obj.results;

      for (var i = 0; i < data.length; i++) {
        var option = data[i];

        var checkChildren = (
          option.children != null &&
          !wrapper({
            results: option.children
          }, true)
        );

        var checkText = option.text === params.term;

        if (checkText || checkChildren) {
          if (child) {
            return false;
          }

          obj.data = data;
          callback(obj);

          return;
        }
      }

      if (child) {
        return true;
      }

      var tag = self.createTag(params);

      if (tag != null) {
        var $option = self.option(tag);
        $option.attr('data-select2-tag', true);

        self.addOptions([$option]);

        self.insertTag(data, tag);
      }

      obj.results = data;

      callback(obj);
    }

    decorated.call(this, params, wrapper);
  };

  Tags.prototype.createTag = function (decorated, params) {
    var term = $.trim(params.term);

    if (term === '') {
      return null;
    }

    return {
      id: term,
      text: term
    };
  };

  Tags.prototype.insertTag = function (_, data, tag) {
    data.unshift(tag);
  };

  Tags.prototype._removeOldTags = function (_) {
    var tag = this._lastTag;

    var $options = this.$element.find('option[data-select2-tag]');

    $options.each(function () {
      if (this.selected) {
        return;
      }

      $(this).remove();
    });
  };

  return Tags;
});

S2.define('select2/data/tokenizer',[
  'jquery'
], function ($) {
  function Tokenizer (decorated, $element, options) {
    var tokenizer = options.get('tokenizer');

    if (tokenizer !== undefined) {
      this.tokenizer = tokenizer;
    }

    decorated.call(this, $element, options);
  }

  Tokenizer.prototype.bind = function (decorated, container, $container) {
    decorated.call(this, container, $container);

    this.$search =  container.dropdown.$search || container.selection.$search ||
      $container.find('.select2-search__field');
  };

  Tokenizer.prototype.query = function (decorated, params, callback) {
    var self = this;

    function select (data) {
      self.trigger('select', {
        data: data
      });
    }

    params.term = params.term || '';

    var tokenData = this.tokenizer(params, this.options, select);

    if (tokenData.term !== params.term) {
      // Replace the search term if we have the search box
      if (this.$search.length) {
        this.$search.val(tokenData.term);
        this.$search.focus();
      }

      params.term = tokenData.term;
    }

    decorated.call(this, params, callback);
  };

  Tokenizer.prototype.tokenizer = function (_, params, options, callback) {
    var separators = options.get('tokenSeparators') || [];
    var term = params.term;
    var i = 0;

    var createTag = this.createTag || function (params) {
      return {
        id: params.term,
        text: params.term
      };
    };

    while (i < term.length) {
      var termChar = term[i];

      if ($.inArray(termChar, separators) === -1) {
        i++;

        continue;
      }

      var part = term.substr(0, i);
      var partParams = $.extend({}, params, {
        term: part
      });

      var data = createTag(partParams);

      if (data == null) {
        i++;
        continue;
      }

      callback(data);

      // Reset the term to not include the tokenized portion
      term = term.substr(i + 1) || '';
      i = 0;
    }

    return {
      term: term
    };
  };

  return Tokenizer;
});

S2.define('select2/data/minimumInputLength',[

], function () {
  function MinimumInputLength (decorated, $e, options) {
    this.minimumInputLength = options.get('minimumInputLength');

    decorated.call(this, $e, options);
  }

  MinimumInputLength.prototype.query = function (decorated, params, callback) {
    params.term = params.term || '';

    if (params.term.length < this.minimumInputLength) {
      this.trigger('results:message', {
        message: 'inputTooShort',
        args: {
          minimum: this.minimumInputLength,
          input: params.term,
          params: params
        }
      });

      return;
    }

    decorated.call(this, params, callback);
  };

  return MinimumInputLength;
});

S2.define('select2/data/maximumInputLength',[

], function () {
  function MaximumInputLength (decorated, $e, options) {
    this.maximumInputLength = options.get('maximumInputLength');

    decorated.call(this, $e, options);
  }

  MaximumInputLength.prototype.query = function (decorated, params, callback) {
    params.term = params.term || '';

    if (this.maximumInputLength > 0 &&
        params.term.length > this.maximumInputLength) {
      this.trigger('results:message', {
        message: 'inputTooLong',
        args: {
          maximum: this.maximumInputLength,
          input: params.term,
          params: params
        }
      });

      return;
    }

    decorated.call(this, params, callback);
  };

  return MaximumInputLength;
});

S2.define('select2/data/maximumSelectionLength',[

], function (){
  function MaximumSelectionLength (decorated, $e, options) {
    this.maximumSelectionLength = options.get('maximumSelectionLength');

    decorated.call(this, $e, options);
  }

  MaximumSelectionLength.prototype.query =
    function (decorated, params, callback) {
      var self = this;

      this.current(function (currentData) {
        var count = currentData != null ? currentData.length : 0;
        if (self.maximumSelectionLength > 0 &&
          count >= self.maximumSelectionLength) {
          self.trigger('results:message', {
            message: 'maximumSelected',
            args: {
              maximum: self.maximumSelectionLength
            }
          });
          return;
        }
        decorated.call(self, params, callback);
      });
  };

  return MaximumSelectionLength;
});

S2.define('select2/dropdown',[
  'jquery',
  './utils'
], function ($, Utils) {
  function Dropdown ($element, options) {
    this.$element = $element;
    this.options = options;

    Dropdown.__super__.constructor.call(this);
  }

  Utils.Extend(Dropdown, Utils.Observable);

  Dropdown.prototype.render = function () {
    var $dropdown = $(
      '<span class="select2-dropdown">' +
        '<span class="select2-results"></span>' +
      '</span>'
    );

    $dropdown.attr('dir', this.options.get('dir'));

    this.$dropdown = $dropdown;

    return $dropdown;
  };

  Dropdown.prototype.bind = function () {
    // Should be implemented in subclasses
  };

  Dropdown.prototype.position = function ($dropdown, $container) {
    // Should be implmented in subclasses
  };

  Dropdown.prototype.destroy = function () {
    // Remove the dropdown from the DOM
    this.$dropdown.remove();
  };

  return Dropdown;
});

S2.define('select2/dropdown/search',[
  'jquery',
  '../utils'
], function ($, Utils) {
  function Search () { }

  Search.prototype.render = function (decorated) {
    var $rendered = decorated.call(this);

    var $search = $(
      '<span class="select2-search select2-search--dropdown">' +
        '<input class="select2-search__field" type="search" tabindex="-1"' +
        ' autocomplete="off" autocorrect="off" autocapitalize="off"' +
        ' spellcheck="false" role="textbox" />' +
      '</span>'
    );

    this.$searchContainer = $search;
    this.$search = $search.find('input');

    $rendered.prepend($search);

    return $rendered;
  };

  Search.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    this.$search.on('keydown', function (evt) {
      self.trigger('keypress', evt);

      self._keyUpPrevented = evt.isDefaultPrevented();
    });

    // Workaround for browsers which do not support the `input` event
    // This will prevent double-triggering of events for browsers which support
    // both the `keyup` and `input` events.
    this.$search.on('input', function (evt) {
      // Unbind the duplicated `keyup` event
      $(this).off('keyup');
    });

    this.$search.on('keyup input', function (evt) {
      self.handleSearch(evt);
    });

    container.on('open', function () {
      self.$search.attr('tabindex', 0);

      self.$search.focus();

      window.setTimeout(function () {
        self.$search.focus();
      }, 0);
    });

    container.on('close', function () {
      self.$search.attr('tabindex', -1);

      self.$search.val('');
    });

    container.on('results:all', function (params) {
      if (params.query.term == null || params.query.term === '') {
        var showSearch = self.showSearch(params);

        if (showSearch) {
          self.$searchContainer.removeClass('select2-search--hide');
        } else {
          self.$searchContainer.addClass('select2-search--hide');
        }
      }
    });
  };

  Search.prototype.handleSearch = function (evt) {
    if (!this._keyUpPrevented) {
      var input = this.$search.val();

      this.trigger('query', {
        term: input
      });
    }

    this._keyUpPrevented = false;
  };

  Search.prototype.showSearch = function (_, params) {
    return true;
  };

  return Search;
});

S2.define('select2/dropdown/hidePlaceholder',[

], function () {
  function HidePlaceholder (decorated, $element, options, dataAdapter) {
    this.placeholder = this.normalizePlaceholder(options.get('placeholder'));

    decorated.call(this, $element, options, dataAdapter);
  }

  HidePlaceholder.prototype.append = function (decorated, data) {
    data.results = this.removePlaceholder(data.results);

    decorated.call(this, data);
  };

  HidePlaceholder.prototype.normalizePlaceholder = function (_, placeholder) {
    if (typeof placeholder === 'string') {
      placeholder = {
        id: '',
        text: placeholder
      };
    }

    return placeholder;
  };

  HidePlaceholder.prototype.removePlaceholder = function (_, data) {
    var modifiedData = data.slice(0);

    for (var d = data.length - 1; d >= 0; d--) {
      var item = data[d];

      if (this.placeholder.id === item.id) {
        modifiedData.splice(d, 1);
      }
    }

    return modifiedData;
  };

  return HidePlaceholder;
});

S2.define('select2/dropdown/infiniteScroll',[
  'jquery'
], function ($) {
  function InfiniteScroll (decorated, $element, options, dataAdapter) {
    this.lastParams = {};

    decorated.call(this, $element, options, dataAdapter);

    this.$loadingMore = this.createLoadingMore();
    this.loading = false;
  }

  InfiniteScroll.prototype.append = function (decorated, data) {
    this.$loadingMore.remove();
    this.loading = false;

    decorated.call(this, data);

    if (this.showLoadingMore(data)) {
      this.$results.append(this.$loadingMore);
    }
  };

  InfiniteScroll.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    container.on('query', function (params) {
      self.lastParams = params;
      self.loading = true;
    });

    container.on('query:append', function (params) {
      self.lastParams = params;
      self.loading = true;
    });

    this.$results.on('scroll', function () {
      var isLoadMoreVisible = $.contains(
        document.documentElement,
        self.$loadingMore[0]
      );

      if (self.loading || !isLoadMoreVisible) {
        return;
      }

      var currentOffset = self.$results.offset().top +
        self.$results.outerHeight(false);
      var loadingMoreOffset = self.$loadingMore.offset().top +
        self.$loadingMore.outerHeight(false);

      if (currentOffset + 50 >= loadingMoreOffset) {
        self.loadMore();
      }
    });
  };

  InfiniteScroll.prototype.loadMore = function () {
    this.loading = true;

    var params = $.extend({}, {page: 1}, this.lastParams);

    params.page++;

    this.trigger('query:append', params);
  };

  InfiniteScroll.prototype.showLoadingMore = function (_, data) {
    return data.pagination && data.pagination.more;
  };

  InfiniteScroll.prototype.createLoadingMore = function () {
    var $option = $(
      '<li ' +
      'class="select2-results__option select2-results__option--load-more"' +
      'role="treeitem" aria-disabled="true"></li>'
    );

    var message = this.options.get('translations').get('loadingMore');

    $option.html(message(this.lastParams));

    return $option;
  };

  return InfiniteScroll;
});

S2.define('select2/dropdown/attachBody',[
  'jquery',
  '../utils'
], function ($, Utils) {
  function AttachBody (decorated, $element, options) {
    this.$dropdownParent = options.get('dropdownParent') || $(document.body);

    decorated.call(this, $element, options);
  }

  AttachBody.prototype.bind = function (decorated, container, $container) {
    var self = this;

    var setupResultsEvents = false;

    decorated.call(this, container, $container);

    container.on('open', function () {
      self._showDropdown();
      self._attachPositioningHandler(container);

      if (!setupResultsEvents) {
        setupResultsEvents = true;

        container.on('results:all', function () {
          self._positionDropdown();
          self._resizeDropdown();
        });

        container.on('results:append', function () {
          self._positionDropdown();
          self._resizeDropdown();
        });
      }
    });

    container.on('close', function () {
      self._hideDropdown();
      self._detachPositioningHandler(container);
    });

    this.$dropdownContainer.on('mousedown', function (evt) {
      evt.stopPropagation();
    });
  };

  AttachBody.prototype.destroy = function (decorated) {
    decorated.call(this);

    this.$dropdownContainer.remove();
  };

  AttachBody.prototype.position = function (decorated, $dropdown, $container) {
    // Clone all of the container classes
    $dropdown.attr('class', $container.attr('class'));

    $dropdown.removeClass('select2');
    $dropdown.addClass('select2-container--open');

    $dropdown.css({
      position: 'absolute',
      top: -999999
    });

    this.$container = $container;
  };

  AttachBody.prototype.render = function (decorated) {
    var $container = $('<span></span>');

    var $dropdown = decorated.call(this);
    $container.append($dropdown);

    this.$dropdownContainer = $container;

    return $container;
  };

  AttachBody.prototype._hideDropdown = function (decorated) {
    this.$dropdownContainer.detach();
  };

  AttachBody.prototype._attachPositioningHandler =
      function (decorated, container) {
    var self = this;

    var scrollEvent = 'scroll.select2.' + container.id;
    var resizeEvent = 'resize.select2.' + container.id;
    var orientationEvent = 'orientationchange.select2.' + container.id;

    var $watchers = this.$container.parents().filter(Utils.hasScroll);
    $watchers.each(function () {
      $(this).data('select2-scroll-position', {
        x: $(this).scrollLeft(),
        y: $(this).scrollTop()
      });
    });

    $watchers.on(scrollEvent, function (ev) {
      var position = $(this).data('select2-scroll-position');
      $(this).scrollTop(position.y);
    });

    $(window).on(scrollEvent + ' ' + resizeEvent + ' ' + orientationEvent,
      function (e) {
      self._positionDropdown();
      self._resizeDropdown();
    });
  };

  AttachBody.prototype._detachPositioningHandler =
      function (decorated, container) {
    var scrollEvent = 'scroll.select2.' + container.id;
    var resizeEvent = 'resize.select2.' + container.id;
    var orientationEvent = 'orientationchange.select2.' + container.id;

    var $watchers = this.$container.parents().filter(Utils.hasScroll);
    $watchers.off(scrollEvent);

    $(window).off(scrollEvent + ' ' + resizeEvent + ' ' + orientationEvent);
  };

  AttachBody.prototype._positionDropdown = function () {
    var $window = $(window);

    var isCurrentlyAbove = this.$dropdown.hasClass('select2-dropdown--above');
    var isCurrentlyBelow = this.$dropdown.hasClass('select2-dropdown--below');

    var newDirection = null;

    var position = this.$container.position();
    var offset = this.$container.offset();

    offset.bottom = offset.top + this.$container.outerHeight(false);

    var container = {
      height: this.$container.outerHeight(false)
    };

    container.top = offset.top;
    container.bottom = offset.top + container.height;

    var dropdown = {
      height: this.$dropdown.outerHeight(false)
    };

    var viewport = {
      top: $window.scrollTop(),
      bottom: $window.scrollTop() + $window.height()
    };

    var enoughRoomAbove = false; //viewport.top < (offset.top - dropdown.height);
    var enoughRoomBelow = true; //viewport.bottom > (offset.bottom + dropdown.height);

    var css = {
      left: offset.left,
      top: container.bottom
    };

    // Fix positioning with static parents
    if (this.$dropdownParent[0].style.position !== 'static') {
      var parentOffset = this.$dropdownParent.offset();

      css.top -= parentOffset.top;
      css.left -= parentOffset.left;
    }

    if (!isCurrentlyAbove && !isCurrentlyBelow) {
      newDirection = 'below';
    }

    if (!enoughRoomBelow && enoughRoomAbove && !isCurrentlyAbove) {
      newDirection = 'above';
    } else if (!enoughRoomAbove && enoughRoomBelow && isCurrentlyAbove) {
      newDirection = 'below';
    }

    if (newDirection == 'above' ||
      (isCurrentlyAbove && newDirection !== 'below')) {
      css.top = container.top - dropdown.height;
    }

    if (newDirection != null) {
      this.$dropdown
        .removeClass('select2-dropdown--below select2-dropdown--above')
        .addClass('select2-dropdown--' + newDirection);
      this.$container
        .removeClass('select2-container--below select2-container--above')
        .addClass('select2-container--' + newDirection);
    }

    this.$dropdownContainer.css(css);
  };

  AttachBody.prototype._resizeDropdown = function () {
    var css = {
      width: this.$container.outerWidth(false) + 'px'
    };

    if (this.options.get('dropdownAutoWidth')) {
      css.minWidth = css.width;
      css.width = 'auto';
    }

    this.$dropdown.css(css);
  };

  AttachBody.prototype._showDropdown = function (decorated) {
    this.$dropdownContainer.appendTo(this.$dropdownParent);

    this._positionDropdown();
    this._resizeDropdown();
  };

  return AttachBody;
});

S2.define('select2/dropdown/minimumResultsForSearch',[

], function () {
  function countResults (data) {
    var count = 0;

    for (var d = 0; d < data.length; d++) {
      var item = data[d];

      if (item.children) {
        count += countResults(item.children);
      } else {
        count++;
      }
    }

    return count;
  }

  function MinimumResultsForSearch (decorated, $element, options, dataAdapter) {
    this.minimumResultsForSearch = options.get('minimumResultsForSearch');

    if (this.minimumResultsForSearch < 0) {
      this.minimumResultsForSearch = Infinity;
    }

    decorated.call(this, $element, options, dataAdapter);
  }

  MinimumResultsForSearch.prototype.showSearch = function (decorated, params) {
    if (countResults(params.data.results) < this.minimumResultsForSearch) {
      return false;
    }

    return decorated.call(this, params);
  };

  return MinimumResultsForSearch;
});

S2.define('select2/dropdown/selectOnClose',[

], function () {
  function SelectOnClose () { }

  SelectOnClose.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    container.on('close', function () {
      self._handleSelectOnClose();
    });
  };

  SelectOnClose.prototype._handleSelectOnClose = function () {
    var $highlightedResults = this.getHighlightedResults();

    // Only select highlighted results
    if ($highlightedResults.length < 1) {
      return;
    }

    var data = $highlightedResults.data('data');

    // Don't re-select already selected resulte
    if (
      (data.element != null && data.element.selected) ||
      (data.element == null && data.selected)
    ) {
      return;
    }

    this.trigger('select', {
        data: data
    });
  };

  return SelectOnClose;
});

S2.define('select2/dropdown/closeOnSelect',[

], function () {
  function CloseOnSelect () { }

  CloseOnSelect.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    container.on('select', function (evt) {
      self._selectTriggered(evt);
    });

    container.on('unselect', function (evt) {
      self._selectTriggered(evt);
    });
  };

  CloseOnSelect.prototype._selectTriggered = function (_, evt) {
    var originalEvent = evt.originalEvent;

    // Don't close if the control key is being held
    if (originalEvent && originalEvent.ctrlKey) {
      return;
    }

    this.trigger('close', {});
  };

  return CloseOnSelect;
});

S2.define('select2/i18n/en',[],function () {
  // English
  return {
    errorLoading: function () {
      return 'The results could not be loaded.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'Please delete ' + overChars + ' character';

      if (overChars != 1) {
        message += 's';
      }

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Please enter ' + remainingChars + ' or more characters';

      return message;
    },
    loadingMore: function () {
      return 'Loading more results…';
    },
    maximumSelected: function (args) {
      var message = 'You can only select ' + args.maximum + ' item';

      if (args.maximum != 1) {
        message += 's';
      }

      return message;
    },
    noResults: function () {
      return 'No results found';
    },
    searching: function () {
      return 'Searching…';
    }
  };
});

S2.define('select2/defaults',[
  'jquery',
  'require',

  './results',

  './selection/single',
  './selection/multiple',
  './selection/placeholder',
  './selection/allowClear',
  './selection/search',
  './selection/eventRelay',

  './utils',
  './translation',
  './diacritics',

  './data/select',
  './data/array',
  './data/ajax',
  './data/tags',
  './data/tokenizer',
  './data/minimumInputLength',
  './data/maximumInputLength',
  './data/maximumSelectionLength',

  './dropdown',
  './dropdown/search',
  './dropdown/hidePlaceholder',
  './dropdown/infiniteScroll',
  './dropdown/attachBody',
  './dropdown/minimumResultsForSearch',
  './dropdown/selectOnClose',
  './dropdown/closeOnSelect',

  './i18n/en'
], function ($, require,

             ResultsList,

             SingleSelection, MultipleSelection, Placeholder, AllowClear,
             SelectionSearch, EventRelay,

             Utils, Translation, DIACRITICS,

             SelectData, ArrayData, AjaxData, Tags, Tokenizer,
             MinimumInputLength, MaximumInputLength, MaximumSelectionLength,

             Dropdown, DropdownSearch, HidePlaceholder, InfiniteScroll,
             AttachBody, MinimumResultsForSearch, SelectOnClose, CloseOnSelect,

             EnglishTranslation) {
  function Defaults () {
    this.reset();
  }

  Defaults.prototype.apply = function (options) {
    options = $.extend({}, this.defaults, options);

    if (options.dataAdapter == null) {
      if (options.ajax != null) {
        options.dataAdapter = AjaxData;
      } else if (options.data != null) {
        options.dataAdapter = ArrayData;
      } else {
        options.dataAdapter = SelectData;
      }

      if (options.minimumInputLength > 0) {
        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          MinimumInputLength
        );
      }

      if (options.maximumInputLength > 0) {
        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          MaximumInputLength
        );
      }

      if (options.maximumSelectionLength > 0) {
        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          MaximumSelectionLength
        );
      }

      if (options.tags) {
        options.dataAdapter = Utils.Decorate(options.dataAdapter, Tags);
      }

      if (options.tokenSeparators != null || options.tokenizer != null) {
        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          Tokenizer
        );
      }

      if (options.query != null) {
        var Query = require(options.amdBase + 'compat/query');

        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          Query
        );
      }

      if (options.initSelection != null) {
        var InitSelection = require(options.amdBase + 'compat/initSelection');

        options.dataAdapter = Utils.Decorate(
          options.dataAdapter,
          InitSelection
        );
      }
    }

    if (options.resultsAdapter == null) {
      options.resultsAdapter = ResultsList;

      if (options.ajax != null) {
        options.resultsAdapter = Utils.Decorate(
          options.resultsAdapter,
          InfiniteScroll
        );
      }

      if (options.placeholder != null) {
        options.resultsAdapter = Utils.Decorate(
          options.resultsAdapter,
          HidePlaceholder
        );
      }

      if (options.selectOnClose) {
        options.resultsAdapter = Utils.Decorate(
          options.resultsAdapter,
          SelectOnClose
        );
      }
    }

    if (options.dropdownAdapter == null) {
      if (options.multiple) {
        options.dropdownAdapter = Dropdown;
      } else {
        var SearchableDropdown = Utils.Decorate(Dropdown, DropdownSearch);

        options.dropdownAdapter = SearchableDropdown;
      }

      if (options.minimumResultsForSearch !== 0) {
        options.dropdownAdapter = Utils.Decorate(
          options.dropdownAdapter,
          MinimumResultsForSearch
        );
      }

      if (options.closeOnSelect) {
        options.dropdownAdapter = Utils.Decorate(
          options.dropdownAdapter,
          CloseOnSelect
        );
      }

      if (
        options.dropdownCssClass != null ||
        options.dropdownCss != null ||
        options.adaptDropdownCssClass != null
      ) {
        var DropdownCSS = require(options.amdBase + 'compat/dropdownCss');

        options.dropdownAdapter = Utils.Decorate(
          options.dropdownAdapter,
          DropdownCSS
        );
      }

      options.dropdownAdapter = Utils.Decorate(
        options.dropdownAdapter,
        AttachBody
      );
    }

    if (options.selectionAdapter == null) {
      if (options.multiple) {
        options.selectionAdapter = MultipleSelection;
      } else {
        options.selectionAdapter = SingleSelection;
      }

      // Add the placeholder mixin if a placeholder was specified
      if (options.placeholder != null) {
        options.selectionAdapter = Utils.Decorate(
          options.selectionAdapter,
          Placeholder
        );
      }

      if (options.allowClear) {
        options.selectionAdapter = Utils.Decorate(
          options.selectionAdapter,
          AllowClear
        );
      }

      if (options.multiple) {
        options.selectionAdapter = Utils.Decorate(
          options.selectionAdapter,
          SelectionSearch
        );
      }

      if (
        options.containerCssClass != null ||
        options.containerCss != null ||
        options.adaptContainerCssClass != null
      ) {
        var ContainerCSS = require(options.amdBase + 'compat/containerCss');

        options.selectionAdapter = Utils.Decorate(
          options.selectionAdapter,
          ContainerCSS
        );
      }

      options.selectionAdapter = Utils.Decorate(
        options.selectionAdapter,
        EventRelay
      );
    }

    if (typeof options.language === 'string') {
      // Check if the language is specified with a region
      if (options.language.indexOf('-') > 0) {
        // Extract the region information if it is included
        var languageParts = options.language.split('-');
        var baseLanguage = languageParts[0];

        options.language = [options.language, baseLanguage];
      } else {
        options.language = [options.language];
      }
    }

    if ($.isArray(options.language)) {
      var languages = new Translation();
      options.language.push('en');

      var languageNames = options.language;

      for (var l = 0; l < languageNames.length; l++) {
        var name = languageNames[l];
        var language = {};

        try {
          // Try to load it with the original name
          language = Translation.loadPath(name);
        } catch (e) {
          try {
            // If we couldn't load it, check if it wasn't the full path
            name = this.defaults.amdLanguageBase + name;
            language = Translation.loadPath(name);
          } catch (ex) {
            // The translation could not be loaded at all. Sometimes this is
            // because of a configuration problem, other times this can be
            // because of how Select2 helps load all possible translation files.
            if (options.debug && window.console && console.warn) {
              console.warn(
                'Select2: The language file for "' + name + '" could not be ' +
                'automatically loaded. A fallback will be used instead.'
              );
            }

            continue;
          }
        }

        languages.extend(language);
      }

      options.translations = languages;
    } else {
      var baseTranslation = Translation.loadPath(
        this.defaults.amdLanguageBase + 'en'
      );
      var customTranslation = new Translation(options.language);

      customTranslation.extend(baseTranslation);

      options.translations = customTranslation;
    }

    return options;
  };

  Defaults.prototype.reset = function () {
    function stripDiacritics (text) {
      // Used 'uni range + named function' from http://jsperf.com/diacritics/18
      function match(a) {
        return DIACRITICS[a] || a;
      }

      return text.replace(/[^\u0000-\u007E]/g, match);
    }

    function matcher (params, data) {
      // Always return the object if there is nothing to compare
      if ($.trim(params.term) === '') {
        return data;
      }

      // Do a recursive check for options with children
      if (data.children && data.children.length > 0) {
        // Clone the data object if there are children
        // This is required as we modify the object to remove any non-matches
        var match = $.extend(true, {}, data);

        // Check each child of the option
        for (var c = data.children.length - 1; c >= 0; c--) {
          var child = data.children[c];

          var matches = matcher(params, child);

          // If there wasn't a match, remove the object in the array
          if (matches == null) {
            match.children.splice(c, 1);
          }
        }

        // If any children matched, return the new object
        if (match.children.length > 0) {
          return match;
        }

        // If there were no matching children, check just the plain object
        return matcher(params, match);
      }

      var original = stripDiacritics(data.text).toUpperCase();
      var term = stripDiacritics(params.term).toUpperCase();

      // Check if the text contains the term
      if (original.indexOf(term) > -1) {
        return data;
      }

      // If it doesn't contain the term, don't return anything
      return null;
    }

    this.defaults = {
      amdBase: './',
      amdLanguageBase: './i18n/',
      closeOnSelect: true,
      debug: false,
      dropdownAutoWidth: false,
      escapeMarkup: Utils.escapeMarkup,
      language: EnglishTranslation,
      matcher: matcher,
      minimumInputLength: 0,
      maximumInputLength: 0,
      maximumSelectionLength: 0,
      minimumResultsForSearch: 0,
      selectOnClose: false,
      sorter: function (data) {
        return data;
      },
      templateResult: function (result) {
        return result.text;
      },
      templateSelection: function (selection) {
        return selection.text;
      },
      theme: 'default',
      width: 'resolve'
    };
  };

  Defaults.prototype.set = function (key, value) {
    var camelKey = $.camelCase(key);

    var data = {};
    data[camelKey] = value;

    var convertedData = Utils._convertData(data);

    $.extend(this.defaults, convertedData);
  };

  var defaults = new Defaults();

  return defaults;
});

S2.define('select2/options',[
  'require',
  'jquery',
  './defaults',
  './utils'
], function (require, $, Defaults, Utils) {
  function Options (options, $element) {
    this.options = options;

    if ($element != null) {
      this.fromElement($element);
    }

    this.options = Defaults.apply(this.options);

    if ($element && $element.is('input')) {
      var InputCompat = require(this.get('amdBase') + 'compat/inputData');

      this.options.dataAdapter = Utils.Decorate(
        this.options.dataAdapter,
        InputCompat
      );
    }
  }

  Options.prototype.fromElement = function ($e) {
    var excludedData = ['select2'];

    if (this.options.multiple == null) {
      this.options.multiple = $e.prop('multiple');
    }

    if (this.options.disabled == null) {
      this.options.disabled = $e.prop('disabled');
    }

    if (this.options.language == null) {
      if ($e.prop('lang')) {
        this.options.language = $e.prop('lang').toLowerCase();
      } else if ($e.closest('[lang]').prop('lang')) {
        this.options.language = $e.closest('[lang]').prop('lang');
      }
    }

    if (this.options.dir == null) {
      if ($e.prop('dir')) {
        this.options.dir = $e.prop('dir');
      } else if ($e.closest('[dir]').prop('dir')) {
        this.options.dir = $e.closest('[dir]').prop('dir');
      } else {
        this.options.dir = 'ltr';
      }
    }

    $e.prop('disabled', this.options.disabled);
    $e.prop('multiple', this.options.multiple);

    if ($e.data('select2Tags')) {
      if (this.options.debug && window.console && console.warn) {
        console.warn(
          'Select2: The `data-select2-tags` attribute has been changed to ' +
          'use the `data-data` and `data-tags="true"` attributes and will be ' +
          'removed in future versions of Select2.'
        );
      }

      $e.data('data', $e.data('select2Tags'));
      $e.data('tags', true);
    }

    if ($e.data('ajaxUrl')) {
      if (this.options.debug && window.console && console.warn) {
        console.warn(
          'Select2: The `data-ajax-url` attribute has been changed to ' +
          '`data-ajax--url` and support for the old attribute will be removed' +
          ' in future versions of Select2.'
        );
      }

      $e.attr('ajax--url', $e.data('ajaxUrl'));
      $e.data('ajax--url', $e.data('ajaxUrl'));
    }

    var dataset = {};

    // Prefer the element's `dataset` attribute if it exists
    // jQuery 1.x does not correctly handle data attributes with multiple dashes
    if ($.fn.jquery && $.fn.jquery.substr(0, 2) == '1.' && $e[0].dataset) {
      dataset = $.extend(true, {}, $e[0].dataset, $e.data());
    } else {
      dataset = $e.data();
    }

    var data = $.extend(true, {}, dataset);

    data = Utils._convertData(data);

    for (var key in data) {
      if ($.inArray(key, excludedData) > -1) {
        continue;
      }

      if ($.isPlainObject(this.options[key])) {
        $.extend(this.options[key], data[key]);
      } else {
        this.options[key] = data[key];
      }
    }

    return this;
  };

  Options.prototype.get = function (key) {
    return this.options[key];
  };

  Options.prototype.set = function (key, val) {
    this.options[key] = val;
  };

  return Options;
});

S2.define('select2/core',[
  'jquery',
  './options',
  './utils',
  './keys'
], function ($, Options, Utils, KEYS) {
  var Select2 = function ($element, options) {
    if ($element.data('select2') != null) {
      $element.data('select2').destroy();
    }

    this.$element = $element;

    this.id = this._generateId($element);

    options = options || {};

    this.options = new Options(options, $element);

    Select2.__super__.constructor.call(this);

    // Set up the tabindex

    var tabindex = $element.attr('tabindex') || 0;
    $element.data('old-tabindex', tabindex);
    $element.attr('tabindex', '-1');

    // Set up containers and adapters

    var DataAdapter = this.options.get('dataAdapter');
    this.dataAdapter = new DataAdapter($element, this.options);

    var $container = this.render();

    this._placeContainer($container);

    var SelectionAdapter = this.options.get('selectionAdapter');
    this.selection = new SelectionAdapter($element, this.options);
    this.$selection = this.selection.render();

    this.selection.position(this.$selection, $container);

    var DropdownAdapter = this.options.get('dropdownAdapter');
    this.dropdown = new DropdownAdapter($element, this.options);
    this.$dropdown = this.dropdown.render();

    this.dropdown.position(this.$dropdown, $container);

    var ResultsAdapter = this.options.get('resultsAdapter');
    this.results = new ResultsAdapter($element, this.options, this.dataAdapter);
    this.$results = this.results.render();

    this.results.position(this.$results, this.$dropdown);

    // Bind events

    var self = this;

    // Bind the container to all of the adapters
    this._bindAdapters();

    // Register any DOM event handlers
    this._registerDomEvents();

    // Register any internal event handlers
    this._registerDataEvents();
    this._registerSelectionEvents();
    this._registerDropdownEvents();
    this._registerResultsEvents();
    this._registerEvents();

    // Set the initial state
    this.dataAdapter.current(function (initialData) {
      self.trigger('selection:update', {
        data: initialData
      });
    });

    // Hide the original select
    $element.addClass('select2-hidden-accessible');
    $element.attr('aria-hidden', 'true');

    // Synchronize any monitored attributes
    this._syncAttributes();

    $element.data('select2', this);
  };

  Utils.Extend(Select2, Utils.Observable);

  Select2.prototype._generateId = function ($element) {
    var id = '';

    if ($element.attr('id') != null) {
      id = $element.attr('id');
    } else if ($element.attr('name') != null) {
      id = $element.attr('name') + '-' + Utils.generateChars(2);
    } else {
      id = Utils.generateChars(4);
    }

    id = 'select2-' + id;

    return id;
  };

  Select2.prototype._placeContainer = function ($container) {
    $container.insertAfter(this.$element);

    var width = this._resolveWidth(this.$element, this.options.get('width'));

    if (width != null) {
      $container.css('width', width);
    }
  };

  Select2.prototype._resolveWidth = function ($element, method) {
    var WIDTH = /^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i;

    if (method == 'resolve') {
      var styleWidth = this._resolveWidth($element, 'style');

      if (styleWidth != null) {
        return styleWidth;
      }

      return this._resolveWidth($element, 'element');
    }

    if (method == 'element') {
      var elementWidth = $element.outerWidth(false);

      if (elementWidth <= 0) {
        return 'auto';
      }

      return elementWidth + 'px';
    }

    if (method == 'style') {
      var style = $element.attr('style');

      if (typeof(style) !== 'string') {
        return null;
      }

      var attrs = style.split(';');

      for (var i = 0, l = attrs.length; i < l; i = i + 1) {
        var attr = attrs[i].replace(/\s/g, '');
        var matches = attr.match(WIDTH);

        if (matches !== null && matches.length >= 1) {
          return matches[1];
        }
      }

      return null;
    }

    return method;
  };

  Select2.prototype._bindAdapters = function () {
    this.dataAdapter.bind(this, this.$container);
    this.selection.bind(this, this.$container);

    this.dropdown.bind(this, this.$container);
    this.results.bind(this, this.$container);
  };

  Select2.prototype._registerDomEvents = function () {
    var self = this;

    this.$element.on('change.select2', function () {
      self.dataAdapter.current(function (data) {
        self.trigger('selection:update', {
          data: data
        });
      });
    });

    this._sync = Utils.bind(this._syncAttributes, this);

    if (this.$element[0].attachEvent) {
      this.$element[0].attachEvent('onpropertychange', this._sync);
    }

    var observer = window.MutationObserver ||
      window.WebKitMutationObserver ||
      window.MozMutationObserver
    ;

    if (observer != null) {
      this._observer = new observer(function (mutations) {
        $.each(mutations, self._sync);
      });
      this._observer.observe(this.$element[0], {
        attributes: true,
        subtree: false
      });
    } else if (this.$element[0].addEventListener) {
      this.$element[0].addEventListener('DOMAttrModified', self._sync, false);
    }
  };

  Select2.prototype._registerDataEvents = function () {
    var self = this;

    this.dataAdapter.on('*', function (name, params) {
      self.trigger(name, params);
    });
  };

  Select2.prototype._registerSelectionEvents = function () {
    var self = this;
    var nonRelayEvents = ['toggle', 'focus'];

    this.selection.on('toggle', function () {
      self.toggleDropdown();
    });

    this.selection.on('focus', function (params) {
      self.focus(params);
    });

    this.selection.on('*', function (name, params) {
      if ($.inArray(name, nonRelayEvents) !== -1) {
        return;
      }

      self.trigger(name, params);
    });
  };

  Select2.prototype._registerDropdownEvents = function () {
    var self = this;

    this.dropdown.on('*', function (name, params) {
      self.trigger(name, params);
    });
  };

  Select2.prototype._registerResultsEvents = function () {
    var self = this;

    this.results.on('*', function (name, params) {
      self.trigger(name, params);
    });
  };

  Select2.prototype._registerEvents = function () {
    var self = this;

    this.on('open', function () {
      self.$container.addClass('select2-container--open');
    });

    this.on('close', function () {
      self.$container.removeClass('select2-container--open');
    });

    this.on('enable', function () {
      self.$container.removeClass('select2-container--disabled');
    });

    this.on('disable', function () {
      self.$container.addClass('select2-container--disabled');
    });

    this.on('blur', function () {
      self.$container.removeClass('select2-container--focus');
    });

    this.on('query', function (params) {
      if (!self.isOpen()) {
        self.trigger('open', {});
      }

      this.dataAdapter.query(params, function (data) {
        self.trigger('results:all', {
          data: data,
          query: params
        });
      });
    });

    this.on('query:append', function (params) {
      this.dataAdapter.query(params, function (data) {
        self.trigger('results:append', {
          data: data,
          query: params
        });
      });
    });

    this.on('keypress', function (evt) {
      var key = evt.which;

      if (self.isOpen()) {
        if (key === KEYS.ESC || key === KEYS.TAB ||
            (key === KEYS.UP && evt.altKey)) {
          self.close();

          evt.preventDefault();
        } else if (key === KEYS.ENTER) {
          self.trigger('results:select', {});

          evt.preventDefault();
        } else if ((key === KEYS.SPACE && evt.ctrlKey)) {
          self.trigger('results:toggle', {});

          evt.preventDefault();
        } else if (key === KEYS.UP) {
          self.trigger('results:previous', {});

          evt.preventDefault();
        } else if (key === KEYS.DOWN) {
          self.trigger('results:next', {});

          evt.preventDefault();
        }
      } else {
        if (key === KEYS.ENTER || key === KEYS.SPACE ||
            (key === KEYS.DOWN && evt.altKey)) {
          self.open();

          evt.preventDefault();
        }
      }
    });
  };

  Select2.prototype._syncAttributes = function () {
    this.options.set('disabled', this.$element.prop('disabled'));

    if (this.options.get('disabled')) {
      if (this.isOpen()) {
        this.close();
      }

      this.trigger('disable', {});
    } else {
      this.trigger('enable', {});
    }
  };

  /**
   * Override the trigger method to automatically trigger pre-events when
   * there are events that can be prevented.
   */
  Select2.prototype.trigger = function (name, args) {
    var actualTrigger = Select2.__super__.trigger;
    var preTriggerMap = {
      'open': 'opening',
      'close': 'closing',
      'select': 'selecting',
      'unselect': 'unselecting'
    };

    if (args === undefined) {
      args = {};
    }

    if (name in preTriggerMap) {
      var preTriggerName = preTriggerMap[name];
      var preTriggerArgs = {
        prevented: false,
        name: name,
        args: args
      };

      actualTrigger.call(this, preTriggerName, preTriggerArgs);

      if (preTriggerArgs.prevented) {
        args.prevented = true;

        return;
      }
    }

    actualTrigger.call(this, name, args);
  };

  Select2.prototype.toggleDropdown = function () {
    if (this.options.get('disabled')) {
      return;
    }

    if (this.isOpen()) {
      this.close();
    } else {
      this.open();
    }
  };

  Select2.prototype.open = function () {
    if (this.isOpen()) {
      return;
    }

    this.trigger('query', {});
  };

  Select2.prototype.close = function () {
    if (!this.isOpen()) {
      return;
    }

    this.trigger('close', {});
  };

  Select2.prototype.isOpen = function () {
    return this.$container.hasClass('select2-container--open');
  };

  Select2.prototype.hasFocus = function () {
    return this.$container.hasClass('select2-container--focus');
  };

  Select2.prototype.focus = function (data) {
    // No need to re-trigger focus events if we are already focused
    if (this.hasFocus()) {
      return;
    }

    this.$container.addClass('select2-container--focus');
    this.trigger('focus', {});
  };

  Select2.prototype.enable = function (args) {
    if (this.options.get('debug') && window.console && console.warn) {
      console.warn(
        'Select2: The `select2("enable")` method has been deprecated and will' +
        ' be removed in later Select2 versions. Use $element.prop("disabled")' +
        ' instead.'
      );
    }

    if (args == null || args.length === 0) {
      args = [true];
    }

    var disabled = !args[0];

    this.$element.prop('disabled', disabled);
  };

  Select2.prototype.data = function () {
    if (this.options.get('debug') &&
        arguments.length > 0 && window.console && console.warn) {
      console.warn(
        'Select2: Data can no longer be set using `select2("data")`. You ' +
        'should consider setting the value instead using `$element.val()`.'
      );
    }

    var data = [];

    this.dataAdapter.current(function (currentData) {
      data = currentData;
    });

    return data;
  };

  Select2.prototype.val = function (args) {
    if (this.options.get('debug') && window.console && console.warn) {
      console.warn(
        'Select2: The `select2("val")` method has been deprecated and will be' +
        ' removed in later Select2 versions. Use $element.val() instead.'
      );
    }

    if (args == null || args.length === 0) {
      return this.$element.val();
    }

    var newVal = args[0];

    if ($.isArray(newVal)) {
      newVal = $.map(newVal, function (obj) {
        return obj.toString();
      });
    }

    this.$element.val(newVal).trigger('change');
  };

  Select2.prototype.destroy = function () {
    this.$container.remove();

    if (this.$element[0].detachEvent) {
      this.$element[0].detachEvent('onpropertychange', this._sync);
    }

    if (this._observer != null) {
      this._observer.disconnect();
      this._observer = null;
    } else if (this.$element[0].removeEventListener) {
      this.$element[0]
        .removeEventListener('DOMAttrModified', this._sync, false);
    }

    this._sync = null;

    this.$element.off('.select2');
    this.$element.attr('tabindex', this.$element.data('old-tabindex'));

    this.$element.removeClass('select2-hidden-accessible');
    this.$element.attr('aria-hidden', 'false');
    this.$element.removeData('select2');

    this.dataAdapter.destroy();
    this.selection.destroy();
    this.dropdown.destroy();
    this.results.destroy();

    this.dataAdapter = null;
    this.selection = null;
    this.dropdown = null;
    this.results = null;
  };

  Select2.prototype.render = function () {
    var $container = $(
      '<span class="select2 select2-container">' +
        '<span class="selection"></span>' +
        '<span class="dropdown-wrapper" aria-hidden="true"></span>' +
      '</span>'
    );

    $container.attr('dir', this.options.get('dir'));

    this.$container = $container;

    this.$container.addClass('select2-container--' + this.options.get('theme'));

    $container.data('element', this.$element);

    return $container;
  };

  return Select2;
});

S2.define('jquery-mousewheel',[
  'jquery'
], function ($) {
  // Used to shim jQuery.mousewheel for non-full builds.
  return $;
});

S2.define('jquery.select2',[
  'jquery',
  'jquery-mousewheel',

  './select2/core',
  './select2/defaults'
], function ($, _, Select2, Defaults) {
  if ($.fn.select2 == null) {
    // All methods that should return the element
    var thisMethods = ['open', 'close', 'destroy'];

    $.fn.select2 = function (options) {
      options = options || {};

      if (typeof options === 'object') {
        this.each(function () {
          var instanceOptions = $.extend(true, {}, options);

          var instance = new Select2($(this), instanceOptions);
        });

        return this;
      } else if (typeof options === 'string') {
        var ret;

        this.each(function () {
          var instance = $(this).data('select2');

          if (instance == null && window.console && console.error) {
            console.error(
              'The select2(\'' + options + '\') method was called on an ' +
              'element that is not using Select2.'
            );
          }

          var args = Array.prototype.slice.call(arguments, 1);

          ret = instance[options].apply(instance, args);
        });

        // Check if we should be returning `this`
        if ($.inArray(options, thisMethods) > -1) {
          return this;
        }

        return ret;
      } else {
        throw new Error('Invalid arguments for Select2: ' + options);
      }
    };
  }

  if ($.fn.select2.defaults == null) {
    $.fn.select2.defaults = Defaults;
  }

  return Select2;
});

  // Return the AMD loader configuration so it can be used outside of this file
  return {
    define: S2.define,
    require: S2.require
  };
}());

  // Autoload the jQuery bindings
  // We know that all of the modules exist above this, so we're safe
  var select2 = S2.require('jquery.select2');

  // Hold the AMD module references on the jQuery function that was just loaded
  // This allows Select2 to use the internal loader outside of this file, such
  // as in the language files.
  jQuery.fn.select2.amd = S2;

  // Return the Select2 instance for anyone who is importing it.
  return select2;
}));

/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0),__webpack_require__(7)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, moment){
	
  /******************************************************************
   * Constructor for DateControl
   *
   * @param comboDay The combo where days are represented
   * @param comboMonth The combo where months are represented
   * @param comboYear The combo where years are represented
   * @param hiddenDate The input hidden where full date is stored
   * @param locale The locale
   * @param dateFormat the Date Format
   */
  YSDDateControl = function(comboDay, comboMonth, comboYear, hiddenDate, locale, dateFormat) {
  	
    // Creates the model
    var theModel = new YSDDateControlModel(locale, dateFormat);
  
    // Creates the controller
    var theController = new YSDDateControlController(theModel);
  
    // Creates the view
    var theView = new YSDDateControlView(theController, theModel, comboDay, comboMonth, comboYear, hiddenDate);

    // Associates the view with the model and the controller
    theModel.setView(theView);
    theController.setView(theView);
  
    this.setDate = function(dateStr) {
      var momentDate = moment(dateStr, theModel.dateFormat);
      theModel.setYear(momentDate.year());     
      theModel.setMonth(momentDate.month());
      theModel.setDay(momentDate.date());
      theView.data_changed('full_date');
    }
  			
  };

  // ----------------------------------------------------------------------------------------
  // ------- Support classes for implement the DateControl using MVC ------------------------
  // ----------------------------------------------------------------------------------------
	
  YSDDateControlModelData = { /* Common data for all instances of YsdDateControl */
	
	years : 90,  // Number of years
	     
    en : {	
      months   : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      literals : { 'day' : 'Day', 'month' : 'Month', 'year' : 'Year' }		
    },

    es : {
      months : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],    
      literals : { 'day': 'Dia', 'month': 'Mes', 'year': 'Año' }
	  },

    ca : {	
      months : ['Gener','Febrer','Març','Abril','Maig','Juny','Juliol','Agost','Setembre','Octobre','Novembre','Desembre'],
      literals : { 'day':'Dia','month':'Mes','year':'Any'} 	
    },

    fr : {
      months : ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],    
      literals : { 'day': 'Jour', 'month': 'Mois', 'year': 'Année' }
    },

    it : {
      months : ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],    
      literals : { 'day': 'Giorno', 'month': 'Mese', 'year': 'Anno' }

    },

    de: {
      months : ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],    
      literals : { 'day': 'Tag', 'month': 'Monat', 'year': 'Jahr' }

    }

  }

  /* ------------- The Model -------------------- */

  YSDDateControlModel = function (locale, dateFormat) {
	 
    this.locale = locale || 'es'; // Spanish is the default language		
    this.dateFormat = dateFormat || 'YYYY-MM-DD';
    this.day = null;
    this.month = null;
    this.year = null;	
    this.days_of_month = null;
    this.current_year = new Date().getFullYear();
       
    this.setView = function(view) {
   	  this.view = view;
    };
   
    this.setDay = function(day) { /* Assign the day */
   	  this.day = day;
      this.view.data_changed('day');
    }
   
    this.setMonth = function(month) { /* Assign the month */
   	  this.month = month;
   	  this.checkDaysOfMonth();
   	  this.view.data_changed('month');
     }
   
    this.setYear = function(year) { /* Assign the year */
      this.year = year;
   
      if (this.month == 1) {
        this.checkDaysOfMonth();    	
      }
      this.view.data_changed('year');
       
    }
   
    this.setDate = function(date) { /* Assign the date */

   	  this.setYear(date.getFullYear());
   	  this.setMonth(date.getMonth());
   	  this.setDay(date.getDate());

      this.view.data_changed('full_date');
           
    };
      
    this.checkDaysOfMonth = function() {

      if (this.year && this.month) {
        var old_days_of_month = this.days_of_month;
     	
        this.days_of_month = moment({year: this.year, month: this.month}).daysInMonth();

        if (this.days_of_month != old_days_of_month && this.view) 
        {
      	  this.view.data_changed('days_of_month');
     	  }
      }
   	
    };   
         
    this.getMonths = function() { /* Get the months */
   	  return YSDDateControlModelData[this.locale].months;
    };
      
    this.getYears = function() { /* Get the years */
   	  return YSDDateControlModelData.years;
    };
	
  }

  /* ------------ The controller ---------------- */

  YSDDateControlController = function(model) {
	
	this.model = model;
	
	this.setView = function(view) {
   	  this.view = view;
    };
	
	this.day_changed = function(day) { /* The user changes the day */
			 		 			 		
	  this.model.setDay(day);		
			
	};
	
	this.month_changed = function(month) { /* The user changes the month */   

      this.model.setMonth(month);
		
	};
	
	this.year_changed = function(year) { /* The user changes the year */
		
	  this.model.setYear(year);	
		
	};
			
  }

  /* ------------------ The view --------------------- */
  
  YSDDateControlView = function(controller, model, comboDay, comboMonth, comboYear, hiddenDate)
  {
    this.controller = controller;
    this.model = model;
  
    this.comboDay = comboDay;     
    this.comboMonth = comboMonth; 
    this.comboYear = comboYear;    	
    this.hiddenDate = hiddenDate; 
		
    /* The view is notified of changes in the model */
  	
    this.data_changed = function (information) { 

  	  switch (information) {
  	 	
  	    case 'days_of_month' : /* days of month */
  	   
  	      var model_days_of_month = (model.days_of_month || 31 ) + 1; // Add 1 for the literal element or assign 31 if no month
  	   
  	      if (model_days_of_month < comboDay.length)
  	      {
  	      	while (model_days_of_month < comboDay.length)
  	     	{
  	     	  comboDay.remove(comboDay.length - 1);	
  	     	}
  	     	
  	      }
  	      else
  	      {
  	       	for (idxDay = comboDay.length; idxDay < model_days_of_month; idxDay++) {
  	          var optionDay = document.createElement('option');
  	          optionDay.setAttribute('value', idxDay);	
  	          optionDay.text = optionDay.innerText = optionDay.text = idxDay;
  	          comboDay.appendChild(optionDay);  	       		
  	       	} 
  	      }
  	    	   
  	      break;
  	     
  	    case 'full_date' : /* full date */
  	     
  	      comboDay.selectedIndex = model.day;       // Elements begin by 0, but the first is the literal "Day"
  	      comboMonth.selectedIndex = model.month+1; // Add 1 for the literal "Month"
  	      comboYear.selectedIndex = (model.current_year - model.year) + 1; // Add 1 for the literal "Year"  
  	 	
  	    case 'day' : /* day */
  	    case 'month': /* month */
  	    case 'year': /* day */
  	   
  	      if ( typeof model.year == 'number' && typeof model.month == 'number' && typeof model.day == 'number')
  	      {
            hiddenDate.value = moment([model.year, model.month, model.day]).format(this.model.dateFormat);
  	        //hiddenDate.value = new Date(model.year, model.month, model.day).toUTCString();
  	      }
  	      else
  	      {
  	        if (hiddenDate.value != '') { // Make sure the date is reset when year, month day are not complete
  	          hiddenDate.value = '';
  	        }	
  	      }
  	     
  	      break; 	
  	 	
  	   }
  	 
  	
    };
		
    /* Builds the control */	
	
    this.render = function() { 
  	
       // days 
       var comboDayLiteral = document.createElement('option');
       comboDayLiteral.text = comboDayLiteral.innerText = YSDDateControlModelData[model.locale].literals['day'];
       comboDay.appendChild(comboDayLiteral);
  	  
  	   var days = model.days_of_month || 31;
  	   for (var idxDay = 1; idxDay <= days; idxDay++)
  	   {
  	     var optionDay = document.createElement('option');
  	     optionDay.setAttribute('value', idxDay);	
  	     optionDay.text = optionDay.innerText = idxDay;
  	     comboDay.appendChild(optionDay);
  	   }  	
  	
  	   // months
       var comboMonthLiteral = document.createElement('option');
       comboMonthLiteral.text = comboMonthLiteral.innerText = YSDDateControlModelData[model.locale].literals['month'];
       comboMonth.appendChild(comboMonthLiteral);
  	 
  	   var months = model.getMonths(); 
  	   var months_length = months.length;
  	 
  	   for (var idxMonth = 0; idxMonth < months_length; idxMonth++)
  	   {
  	     var optionMonth = document.createElement('option');
  	     optionMonth.setAttribute('value', months[idxMonth]);
  	     optionMonth.text = optionMonth.innerText = months[idxMonth];
  	     comboMonth.appendChild(optionMonth);	
  	   } 
  	 
  	   // years  	 
       var comboYearLiteral = document.createElement('option');
       comboYearLiteral.text = comboYearLiteral.innerText = YSDDateControlModelData[model.locale].literals['year'];
       comboYear.appendChild(comboYearLiteral);

       var start_year = new Date().getFullYear();
  	   var end_year = start_year - model.getYears();
  	
  	   for (var idxYear = start_year; idxYear > end_year; idxYear--)
  	   {
  	     var optionYear = document.createElement('option');
  	     optionYear.setAttribute('value', idxYear);	
  	     optionYear.text = optionYear.innerText = idxYear;
  	     comboYear.appendChild(optionYear);
  	   }
  	   	 
  	   // Configure the events
  	 
  	   $(comboDay).bind('change',
  	     function(event) {	
  	       controller.day_changed(this.selectedIndex==0?null:new Number(this.value).valueOf());	
  	     });
  	 
  	   $(comboMonth).bind('change', 
  	     function(event) {
  	       controller.month_changed(this.selectedIndex==0?null:this.selectedIndex-1);
  	     });
  	    
  	   $(comboYear).bind('change',
  	     function(event) {
  	       controller.year_changed(this.selectedIndex==0?null:new Number(this.value).valueOf());
  	     });
  	    
    }
	
    this.render();	
	
  }

  return YSDDateControl;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));




/***/ }),
/* 25 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0), __webpack_require__(18), __webpack_require__(14),__webpack_require__(12),
         __webpack_require__(2),__webpack_require__(1), __webpack_require__(4), __webpack_require__(9),
         __webpack_require__(3), __webpack_require__(7),__webpack_require__(6), __webpack_require__(27), __webpack_require__(8),
         __webpack_require__(5), __webpack_require__(0), __webpack_require__(10),
         __webpack_require__(16), __webpack_require__(15), __webpack_require__(17),
         __webpack_require__(11)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, MemoryDataSource, RemoteDataSource, SelectSelector,
                  commonServices, commonSettings, commonTranslations, commonLoader, 
                  i18next, moment, tmpl, cookie) {

  /***************************************************************************
   *
   * Selector Rent Model
   *
   ***************************************************************************/
  var SelectorRentModel = function() {

    this.selectorView = null;

    // == Selectors

    // Search form
    this.form_selector = 'form[name=search_form]';
    // Search form template
    this.form_selector_tmpl = 'form_selector_tmpl';

    // Pickup place
    this.pickup_place_id = 'pickup_place';
    this.pickup_place_selector = '#pickup_place';
    this.pickup_place_other_id = 'pickup_place_other';
    this.pickup_place_other_selector = '#pickup_place_other';
    this.another_pickup_place_group_selector = '#another_pickup_place_group';
    this.custom_pickup_place_selector = 'input[name=custom_pickup_place]';
    this.pickup_place_group_selector = '.pickup_place_group';
    this.another_pickup_place_group_close = '.another_pickup_place_group_close';
    
    // Return place
    this.return_place_id = 'return_place';   
    this.return_place_selector = '#return_place';
    this.return_place_other_id = 'return_place_other';
    this.return_place_other_selector = '#return_place_other';
    this.another_return_place_group_selector = '#another_return_place_group';    
    this.custom_return_place_selector = 'input[name=custom_return_place]';
    this.return_place_group_selector = '.return_place_group';
    this.another_return_place_group_close = '.another_return_place_group_close';
    
    // Date From
    this.date_from_selector = '#date_from';
    // Time From
    this.time_from_id = 'time_from';
    this.time_from_selector = '#time_from';
    // Date To
    this.date_to_selector = '#date_to';
    // Time To
    this.time_to_id = 'time_to';        
    this.time_to_selector = '#time_to';  
    
    // Driver age rule
    this.driver_age_rule_selector = '#driver_age_rule';
    // Promotion Code
    this.promotion_code_selector = '#promotion_code';
    // Number of products
    this.number_of_products_selector = '#number_of_products';
    // Family
    this.family_id = 'family_id';
    this.family_id_selector = '#family_id';
    this.family_selector = '.family';   
    // Accept age
    this.accept_age_selector = '#accept_age';

    // == State variables

    this.dataSourcePickupPlaces = null; // Pickup places datasource
    this.dataSourceReturnPlaces = null; // Return places datasource

    this.requestLanguage = null;
    this.configuration = null;
    this.shopping_cart = null;
    this.loadedShoppingCart = false;
    this.pickupDays = []; // Available pickup days
    this.returnDays = []; // Available return days
    this.pickupHours = []; // Available pickup hours
    this.returnHours = []; // Available return hours
    this.families = []; // Families

    this.dateToMinDate = null;

    this.setSelectorView = function(_selectorView) {
      this.selectorView = _selectorView;
    }

    this.loadFamilies = function() { /* Load families */

      console.log('loadFamilies');
      var self = this;
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/families';
      if (commonServices.apiKey && commonServices.apiKey != '') {
        url += '?api_key='+commonServices.apiKey;
      }  
      // Request
      $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(data, textStatus, jqXHR) {
          self.families = data;
          for (var idx=0;idx<self.families.length;idx++){
            self.families[idx]['description'] =  self.families[idx]['name'];
          }          
          self.selectorView.update('families', null);
        },
        error: function(data, textStatus, jqXHR) {
          alert(i18next.t('selector.error_loading_data'));
        }
      });      
    };

    /**
     * Access the API to get the available pickup days in a month
     */
    this.loadPickupDays = function(year, month) { /* Load pickup days */
      console.log('loadPickupDays. year='+year+' month='+month);
      this.startDate = moment([year, month - 1]);
      this.endDate = moment(this.startDate).endOf('month');
      var self = this;
      // Build URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/dates?from='+
                this.startDate.format('YYYY-MM-DD')+
                '&to='+this.endDate.format('YYYY-MM-DD')+
                '&action=deliveries';
      if (this.configuration.pickupReturnPlace && $(this.pickup_place_selector).val() != '') {
        url += '&place='+$(this.pickup_place_selector).val();
      }
      if (commonServices.apiKey && commonServices.apiKey != '') {
        url += '&api_key='+commonServices.apiKey;
      }  
      // Request
      $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(data, textStatus, jqXHR) {
          self.pickupDays = data;
          self.selectorView.update('days', 'date_from');
        },
        error: function(data, textStatus, jqXHR) {
          alert(i18next.t('selector.error_loading_data'));
        }
      });
    };

    /**
     * Access the  API to get the available return days in a month
     */
    this.loadReturnDays = function(year, month) { /* Load return days */
      console.log('loadReturnDays. year='+year+' month='+month);
      this.startDate = moment([year, month - 1]);
      this.endDate = moment(this.startDate).endOf('month');
      var self = this;
      // Build URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/dates?from='+
                this.startDate.format('YYYY-MM-DD')+
                '&to='+this.endDate.format('YYYY-MM-DD')+
                '&action=collections';
      if (this.configuration.pickupReturnPlace && $(this.return_place_selector).val() != '') {
        url += '&place='+$(this.return_place_selector).val();
      }        
      if (commonServices.apiKey && commonServices.apiKey != '') {
        url += '&api_key='+commonServices.apiKey;
      }        
      // Request
      $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(data, textStatus, jqXHR) {
          self.returnDays = data;
          self.selectorView.update('days', 'date_to');
        },
        error: function(data, textStatus, jqXHR) {
          alert(i18next.t('selector.error_loading_data'));
        }
      });
    };

    /**
     * Access the API to get the available pickup hours in a date
     */
    this.loadPickupHours = function(date) { /* Load pickup hours */
      var self=this;
      // Build URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/times?date='+date+'&action=deliveries';
      if (this.configuration.pickupReturnPlace && $(this.pickup_place_selector).val() != '') {
        url += '&place='+$(this.pickup_place_selector).val();
      }         
      if (commonServices.apiKey && commonServices.apiKey != '') {
        url += '&api_key='+commonServices.apiKey;
      }        
      // Request
      $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(data, textStatus, jqXHR) {
          self.pickupHours = data;
          self.selectorView.update('hours', 'time_from', data);
        },
        error: function(data, textStatus, jqXHR) {
          alert(i18next.t('selector.error_loading_data'));
        }
      });
    };

    /**
     * Access the API to get the available return hours in a date
     */
    this.loadReturnHours = function(date) { /* Load return hours */
      var self=this;
      // Build URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/times?date='+date+'&action=collections';
      if (this.configuration.pickupReturnPlace && $(this.return_place_selector).val() != '') {
        url += '&place='+$(this.return_place_selector).val();
      }    
      if (commonServices.apiKey && commonServices.apiKey != '') {
        url += '&api_key='+commonServices.apiKey;
      }       
      // Request        
      $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(data, textStatus, jqXHR) {
          self.returnHours = data;
          self.selectorView.update('hours', 'time_to', data);
        },
        error: function(data, textStatus, jqXHR) {
          alert(i18next.t('selector.error_loading_data'));
        }
      });
    };  
   
  };

  /***************************************************************************
   *
   * Selector Rent Controller
   *
   ***************************************************************************/
  var SelectorRentController = function() {

    this.selectorView = null;
    this.selectorModel = null;

    /**
     * Set the selector view
     */
    this.setSelectorView = function( _selectorView ) {
      this.selectorView = _selectorView;
    }

    /**
     * Set the selector model
     */
    this.setSelectorModel = function( _selectorModel ) {
      this.selectorModel = _selectorModel;
    }

    /**
     * On Window scroll if sticky hide Google API controls
     */
    this.windowOnScroll = function() {

      if ($("#form-selector").hasClass("flex-form-sticky")) {
        if ($('.pac-container').is(':visible')) {
          $('.pac-container').hide();
          if ($(this.selectorModel.pickup_place_other_selector).is(':focus')) {
            $(this.selectorModel.pickup_place_other_selector).val('');
          }
          if ($(this.selectorModel.return_place_other_selector).is(':focus')) {
            $(this.selectorModel.return_place_other_selector).val('');
          }          
        }
      }

    }

    /**
     * Pickup place changed
     */ 
    this.pickupPlaceChanged = function() { 

       console.log('pickup place changed');

       // Clear shopping cart data to avoid to be reloaded
       if (this.selectorModel.shopping_cart) {
         this.selectorModel.shopping_cart.date_from = null;
         this.selectorModel.shopping_cart.time_from = null;
         this.selectorModel.shopping_cart.date_to = null;
         this.selectorModel.shopping_cart.time_to = null;
         this.selectorModel.shopping_cart.pickup_place = null;
         this.selectorModel.shopping_cart.custom_pickup_place = null;
         this.selectorModel.shopping_cart.pickup_place_other = null;
         this.selectorModel.shopping_cart.return_place = null;
         this.selectorModel.shopping_cart.custom_return_place = null;
         this.selectorModel.shopping_cart.return_place_other = null;
       }   

       // -- Disable fields selectors (return place, time from ,date to, time to)

       // Disable return places
       $(this.selectorModel.return_place_selector).attr('disabled', true);
       // Disable time from
       $(this.selectorModel.time_from_selector).attr('disabled', true);
       // Disable date to
       $(this.selectorModel.date_to_selector).attr('disabled', true);
       // Disable time to
       $(this.selectorModel.time_to_selector).attr('disabled', true);

       // Initialize date from, time from, date to and time to
       $(this.selectorModel.date_from_selector).datepicker('setDate', null);
       if (this.selectorModel.configuration.timeToFrom) {
         $(this.selectorModel.time_from_selector).val('');
       }
       $(this.selectorModel.date_to_selector).datepicker('setDate', null);
       if (this.selectorModel.configuration.timeToFrom) {
         $(this.selectorModel.time_to_selector).val('');
       }

       // Custom address allowed
       if (this.selectorModel.configuration.customPickupReturnPlaces) {          
         // User selects custom address
         if ($(this.selectorModel.pickup_place_selector).val() == 'other') {
             $(this.selectorModel.custom_pickup_place_selector).val('true');
             $(this.selectorModel.another_pickup_place_group_selector).show();
             $(this.selectorModel.pickup_place_group_selector).hide();
         }
         else { // User selects pickup place from the list
             $(this.selectorModel.custom_pickup_place_selector).val('false');
             $(this.selectorModel.pickup_place_other_selector).val('');
             $(this.selectorModel.another_pickup_place_group_selector).hide();
             $(this.selectorModel.pickup_place_group_selector).show();
         }
       }

       // Load the return places
       this.selectorView.loadReturnPlaces(true);
    }

    /**
     * Pickup place custom address autocomplete changed
     *
     * - Assigns the custom pickup place to the custom return place
     *
     */
    this.customPickupPlaceValueChanged = function() {

      $(this.selectorModel.return_place_selector).val('other');
      $(this.selectorModel.return_place_other_selector).val($(this.selectorModel.pickup_place_other_selector).val());
      $(this.selectorModel.custom_return_place_selector).val('true');
      $(this.selectorModel.another_return_place_group_selector).show();        

    }

    /**
     * Pickup place custom address close click
     *
     * - The user will select the pickup place from the list
     * 
     */
    this.customPickupPlaceCloseBtnClick = function() {
      $(this.selectorModel.pickup_place_selector).val('');
      $(this.selectorModel.pickup_place_other_selector).val('');
      $(this.selectorModel.custom_pickup_place_selector).val('false');
      $(this.selectorModel.pickup_place_group_selector).show();
      $(this.selectorModel.another_pickup_place_group_selector).hide();
    }

    /**
     * Return place changed
     */ 
    this.returnPlaceChanged = function() { 

        console.log('return place changed');

        // Custom address allowed
        if (this.selectorModel.configuration.customPickupReturnPlaces) {
          // User selects custom address
          if ($(this.selectorModel.return_place_selector).val() == 'other') {
              $(this.selectorModel.custom_return_place_selector).val('true');
              $(this.selectorModel.another_return_place_group_selector).show();
              $(this.selectorModel.return_place_group_selector).hide();
          }
          else { // User selects pickup place from the list
              $(this.selectorModel.custom_return_place_selector).val('false');
              $(this.selectorModel.another_return_place_group_selector).hide();
          }
        }

        // Enable date to
        if ($(this.selectorModel.date_to_selector).attr('disabled')) {  
          $(this.selectorModel.date_to_selector).attr('disabled', false);
        }  

        // Disable time to
        $(this.selectorModel.time_to_selector).attr('disabled', true);

        // Initialize values

        // - Initialize date_to 
        $(this.selectorModel.date_to_selector).datepicker('setDate', null);
        
        // - Initialize time_to
        if (this.selectorModel.configuration.timeToFrom) {
          $(this.selectorModel.time_to_selector).val('');
        }

    }

    /**
     * Return place custom address close click
     */
    this.customReturnPlaceCloseBtnClick = function() {
      $(this.selectorModel.return_place_selector).val('');
      $(this.selectorModel.return_place_other_selector).val('');
      $(this.selectorModel.custom_return_place_selector).val('false');      
      $(this.selectorModel.return_place_group_selector).show();
      $(this.selectorModel.another_return_place_group_selector).hide();
    },
    
    /**
     * Date From changed
     */
    this.dateFromChanged = function() {

        console.log('date from changed');
       
        // Clear time_from / date_to / time_to
        if (this.selectorModel.shopping_cart) {
          this.selectorModel.shopping_cart.date_from = null;
          this.selectorModel.shopping_cart.time_from = null;
          this.selectorModel.shopping_cart.date_to = null;
          this.selectorModel.shopping_cart.time_to = null;
        } 

        // == Date To
        this.selectorView.setupDateToMinValue();
        $(this.selectorModel.date_to_selector).datepicker('setDate', null);
        // Enable the control
        if ($(this.selectorModel.date_to_selector).attr('disabled')) {  
          $(this.selectorModel.date_to_selector).attr('disabled', false);
        }  

        // == Time From
        if (this.selectorModel.configuration.timeToFrom) {
          // Initialize time from
          $(this.selectorModel.time_from_selector).val('');

          // Initialize time to
          $(this.selectorModel.time_to_selector).val('');

          // Load Pickup Hours
          this.selectorView.loadPickupHours();
        }

    }


    /**
     * Date to changed
     */
    this.dateToChanged = function() {

      console.log('date to changed');

      if (this.selectorModel.configuration.timeToFrom) {
        // Enable time to     
        if ($(this.selectorModel.time_to_selector).attr('disabled')) {   
          $(this.selectorModel.time_to_selector).attr('disabled', false);
        }
        // Initialize time to
        $(this.selectorModel.time_to_selector).val('');
        // Load return times
        this.selectorView.loadReturnHours();
      }  

    }

  };


  /***************************************************************************
   *
   * Selector Rent View
   *
   ***************************************************************************/
  var SelectorRentView = function(_selectorModel, _selectorController) {

    this.selectorModel = _selectorModel;
    this.selectorController = _selectorController;

    this.init = function() {

        // Initialize i18next for translations
        i18next.init({  
                        lng: this.selectorModel.requestLanguage,
                        resources: commonTranslations
                     }, 
                     function (error, t) {
                        // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                        //jqueryI18next.init(i18next, $);
                        // Localize UI
                        //$('.nav').localize();
                     });
        // Setup Form
        this.setupSelectorFormTmpl();

        // Setup UI
        $(this.selectorModel.form_selector).attr('action', commonServices.chooseProductUrl);
        
        this.extractAgentId();

        // Setup pickup/return places
        if (this.selectorModel.configuration.pickupReturnPlace) {
          this.setupPickupReturnPlace();
        }
        
        // Setup dates
        this.setupDateControls();
        
        // Setup time from / to
        if (this.selectorModel.configuration.timeToFrom) {
          this.setupTimeToFrom();
        }       

        // Setup validation
        this.setupValidation();

        // Setup on scroll => Google Location API integration
        var self = this;
        $(window).on("scroll", function() {
          self.selectorController.windowOnScroll();
        });


    }

    // ------------------------ Start -----------------------------------------

    /**
     * Start the component empty
     */
    this.startEmpty = function() {

      // Disable selector controls  
      $(this.selectorModel.pickup_place_selector).attr('disabled', true);
      $(this.selectorModel.date_from_selector).attr('disabled', true);
      $(this.selectorModel.time_from_selector).attr('disabled', true);
      $(this.selectorModel.return_place_selector).attr('disabled', true);
      $(this.selectorModel.date_to_selector).attr('disabled', true);  
      $(this.selectorModel.time_to_selector).attr('disabled', true);

      // Start loading first data
      if (this.selectorModel.configuration.pickupReturnPlace) {
        this.loadPickupPlaces();
      }
      else {
        var date = moment();
        this.selectorModel.loadPickupDays(date.year(), date.month()+1);
      }

      if (this.selectorModel.configuration.selectFamily) {
        this.loadFamilies();
      }

    }

    /**
     * Start the component from shopping cart : Load the shopping cart information in the selector fields
     */
    this.startFromShoppingCart = function(shopping_cart) { /* Show the selector with the shopping cart information */

      this.selectorModel.shopping_cart = shopping_cart;

      // Initialize number of products
      $(this.selectorModel.number_of_products_selector).val(shopping_cart.number_of_products);

      // It loads delivery place/hour/time and collection place/hour/time
      if (this.selectorModel.configuration.pickupReturnPlace) { 
        // If custom pickup place
        if (shopping_cart.custom_pickup_place) {
          $(this.selectorModel.another_pickup_place_group_selector).show();
        }        
        // If custom return place
        if (shopping_cart.custom_return_place) {
          $(this.selectorModel.another_return_place_group_selector).show();
        }        
        this.loadPickupPlaces(); // The other fields are automatically assigned after pickup_place assignation
      }
      else {
        // No delivery/collection place => Directly assign date_from and date_to from shopping_cart
        var date_from = moment(shopping_cart.date_from).format(this.selectorModel.configuration.dateFormat); 
        var date_to = moment(shopping_cart.date_to).format(this.selectorModel.configuration.dateFormat); 
        $(this.selectorModel.date_from_selector).datepicker("setDate", date_from); // It causes change month => load the calendar days
        $(this.selectorModel.date_to_selector).datepicker("setDate", date_to); // It causes the month to change => load the calendar days
        if (this.selectorModel.configuration.timeToFrom) {
          this.loadPickupHours();
          this.loadReturnHours();
        }
      }  

      if (this.selectorModel.configuration.selectFamily) {
        this.loadFamilies();
      }

    }

    // ------------------------ Extract Agent Id ------------------------------


    this.extractAgentId = function() {

      var urlVars = commonSettings.getUrlVars();
      var agentId = null;  
      if (typeof urlVars['agentId'] != 'undefined') {
        agentId = decodeURIComponent(urlVars['agentId']);
        cookie.set('__mb_agent_id', agentId, {expires: 14});      
      }
      else {
        agentId = cookie.get('__mb_agent_id');  
      }
      if (agentId != null) {
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "agent_id");
        input.setAttribute("value", agentId);
        $(this.selectorModel.form_selector).append(input);
      }

    }


    // ------------------------ Setup controls --------------------------------

    /**
     * Setup the selector form
     *
     * The selector form can be rendered in two ways:
     *
     * - Directly on the page (recommeded for final projects)
     * - Using a template that choose which fields should be rendered
     *
     * For the first option just create the form with the fields in the page
     * For the second option create an empty form and a template that creates
     * the fields depending on the configuration
     *
     * Note: The two options are hold for compatibility uses
     * 
     */
    this.setupSelectorFormTmpl = function() {

      // The selector form fields are defined in a micro-template
      if (document.getElementById(this.selectorModel.form_selector_tmpl)) {
        // Check if forced hidden family_id
        var not_hidden_family_id = ($(this.selectorModel.form_selector).find('input[type=hidden][name=family_id]').length == 0);
        // Load the template
        var html = tmpl(this.selectorModel.form_selector_tmpl)({configuration: this.selectorModel.configuration,
                                                                not_hidden_family_id: not_hidden_family_id });
        // Assign to the form
        $(this.selectorModel.form_selector).append(html);
      }

    }

    /**
     * Setup the pickup / return places controls
     */
    this.setupPickupReturnPlace = function() {

      var self = this;

      // Bind pickup place changed
      $(this.selectorModel.pickup_place_selector).bind('change', function() {
         self.selectorController.pickupPlaceChanged();
      });

      // Bind return place changed
      $(this.selectorModel.return_place_selector).bind('change', function() {
          self.selectorController.returnPlaceChanged();
      });

      // Custom address in pickup/return place
      if (this.selectorModel.configuration.customPickupReturnPlaces) {
        // Google Maps API integration
        if (commonServices.useGoogleMaps) {
          var self = this;
          const loadGoogleMapsApi = __webpack_require__(48)        
          var opts = {key: commonServices.googleMapsSettings.apiKey, 
                      libraries: ['places']};
          if (commonServices.googleMapsSettings.settings.googleMapsRestrictCountryCode != null) {
            opts['region'] = commonServices.googleMapsSettings.settings.googleMapsRestrictCountryCode;
          } 
          loadGoogleMapsApi(opts).then(function (googleMaps) {
            self.setupAutocomplete(googleMaps);
          }).catch(function (error) {
            console.error(error);
          });
        }
        else {
          $(this.selectorModel.pickup_place_other_selector).bind('blur', function() {
             self.selectorController.customPickupPlaceValueChanged();
          });
        }
        // Close pickup place editor (back to the selector)
        $(this.selectorModel.another_pickup_place_group_close).bind('click', function(){
          self.selectorController.customPickupPlaceCloseBtnClick();
        });
        // Close return place editor (back to the selector)
        $(this.selectorModel.another_return_place_group_close).bind('click', function(){
          self.selectorController.customReturnPlaceCloseBtnClick();
        });
      }

      var returnPlace = new SelectSelector(this.selectorModel.return_place_id, 
                                           new MemoryDataSource([]), 
                                           null, 
                                           true, 
                                           i18next.t('selector.select_return_place'));    

    }

    /**
     * Setup Google Places Autocomplete
     */
    this.setupAutocomplete = function(googleMaps) {

       var self = this;
       var opts = {};
       
       // Restrict country
       if (commonServices.googleMapsSettings.settings.googleMapsRestrictCountryCode != null) {
         opts.componentRestrictions = {country: commonServices.googleMapsSettings.settings.googleMapsRestrictCountryCode};
       }

       // Restrict bounds
       if (commonServices.googleMapsSettings.settings.googlePlacesRetrictBounds) {
          opts.bounds = new google.maps.LatLngBounds({lat: commonServices.googleMapsSettings.settings.googleMapsBoundsSWLat,
                                                      lng: commonServices.googleMapsSettings.settings.googleMapsBoundsSWLng },  // SW
                                                     {lat: commonServices.googleMapsSettings.settings.googleMapsBoundsNELat, 
                                                      lng: commonServices.googleMapsSettings.settings.googleMapsBoundsNELng }); // NE
          opts.strictBounds = true;
       }
       
       // Setup autocomplete - pickup place
       var input = document.getElementById(this.selectorModel.pickup_place_other_id);
       if (input) {
         var autocomplete = new googleMaps.places.Autocomplete(input, opts);      
         autocomplete.addListener('place_changed', function() {
          self.selectorController.customPickupPlaceValueChanged();
         });
       }

       // Setup autocomplete -- return place
       var input = document.getElementById(this.selectorModel.return_place_other_id);
       if (input) {
         var autocomplete = new googleMaps.places.Autocomplete(input, opts);
       }

    }

    /**
     * Setup date controls
     */
    this.setupDateControls = function() {

      var self = this;

      $.datepicker.setDefaults( $.datepicker.regional[this.selectorModel.requestLanguage || 'es'] );
      var locale = $.datepicker.regional[this.selectorModel.requestLanguage || 'es'];
      var maxDate = moment().add(365, 'days').tz(this.selectorModel.configuration.timezone).format(this.selectorModel.configuration.dateFormat);

      // Date From
      $(this.selectorModel.date_from_selector).datepicker({
          numberOfMonths:1,
          maxDate: maxDate,
          dateFormat: 'dd/mm/yy',
          constraintInput: true,
          beforeShow: function(element, instance) {
            console.log('before_show DateFrom');
            if (instance.lastVal) {
              console.log('lastVal:'+instance.lastVal);
              var date = moment(instance.lastVal, self.selectorModel.configuration.dateFormat);
            }
            else {
              var date = moment();
            }
            self.selectorModel.loadPickupDays(date.year(), date.month()+1);
          },
          beforeShowDay: function(date) {
            var idx = self.selectorModel.pickupDays.findIndex(function(element){
                        return element == moment(date).format('YYYY-MM-DD');
                      }); 
            if (idx > -1) {
              return [true];
            }     
            else {
              return [false];
            }              
          },
          onChangeMonthYear: function(year, month, instance) {
             console.log('date_from changed month : ' + month+ ' year: '+year);
             // If pickup/return place are allowed, load the days 
             // if the user has selected a pickup place
             if (self.selectorModel.configuration.pickupReturnPlace) {
               if ($(self.selectorModel.pickup_place_selector).val() != null &&
                   $(self.selectorModel.pickup_place_selector).val() != '') { 
                 self.selectorModel.loadPickupDays(year, month);         
               }         
             }   
             else {
               self.selectorModel.loadPickupDays(year, month);
             }      
          },
          onSelect: function(dateText, inst) {
             self.selectorController.dateFromChanged();       
          }

        }, locale);

      // Date To
      $(this.selectorModel.date_to_selector).datepicker({
          numberOfMonths:1,
          maxDate: maxDate,
          dateFormat: 'dd/mm/yy',
          constraintInput: true,
          beforeShow: function(element, instance) {
            console.log('before_show DateTo');
            if (instance.lastVal) {
              console.log('lastVal:'+instance.lastVal);
              var date = moment(instance.lastVal, self.selectorModel.configuration.dateFormat);
              self.selectorModel.loadReturnDays(date.year(), date.month()+1);
            }
            else if (self.selectorModel.dateToMinDate != null) {
              console.log('dateToMin: '+self.selectorModel.dateToMinDate);
              self.selectorModel.loadReturnDays(self.selectorModel.dateToMinDate.year(), self.selectorModel.dateToMinDate.month()+1);
            }
          },
          beforeShowDay: function(date) {
            var idx = self.selectorModel.returnDays.findIndex(function(element){
                        return element == moment(date).format('YYYY-MM-DD');
                      }); 
            if (idx > -1) {
              return [true];
            }     
            else {
              return [false];
            }              
          },
          onChangeMonthYear: function(year, month, instance) {
            console.log('date_to changed month : ' + month+ ' year: '+year);
             // If pickup/return place are allowed, load the days 
             // if the user has selected a return place
             if (self.selectorModel.configuration.pickupReturnPlace) {
               if ($(self.selectorModel.return_place_selector).val() != null &&
                   $(self.selectorModel.return_place_selector).val() != '') { 
                 self.selectorModel.loadReturnDays(year, month);         
               }         
             }   
             else {
               self.selectorModel.loadReturnDays(year, month);
             }                    
          },
          onSelect: function(dateText, inst) {
             self.selectorController.dateToChanged();
          },
          onClose: function(dateText, inst) {
             console.log('on close date_to');
          }    
        }, locale);

      // Avoid Google Automatic Translation
      $('.ui-datepicker').addClass('notranslate');

      // Configure event change Date From
      $(this.selectorModel.date_from_selector).bind('change', function() {
           self.selectorController.dateFromChanged();
      });

    }

    /**
     * Setup the date_from min value
     * -----------------------------
     *
     * Get the max value between the date_from calendar first day and 
     * the selected date from + min days
     * 
     */ 
    this.setupDateToMinValue = function() {

      // DateFrom
      var dateFrom = $(this.selectorModel.date_from_selector).datepicker('getDate');

      // Calculate dateTo from dateFrom
      var dateTo = null;
      if (this.selectorModel.configuration.cycleOf24Hours) {
        var dateTo = moment(dateFrom).add(this.selectorModel.configuration.minDays, 'days');
      }
      else {
        var dateTo = moment(dateFrom).add(this.selectorModel.configuration.minDays - 1, 'days');
      } 
      
      this.selectorModel.dateToMinDate = dateTo;

      // Configure date_to minDate
      $(this.selectorModel.date_to_selector).datepicker('option', 'minDate', 
              dateTo.tz(this.selectorModel.configuration.timezone).format(this.selectorModel.configuration.dateFormat));

    },

    /**
     * Setup validation
     */
    this.setupValidation = function() {

        var self = this;

        $.validator.addMethod('same_day_time_from', function(value, element) {
          if (self.selectorModel.configuration.timeToFrom) {
            if ($(self.selectorModel.date_from_selector).val() == $(self.selectorModel.date_to_selector).val()) {
              return $(self.selectorModel.time_to_selector).val() > $(self.selectorModel.time_from_selector).val();
            }
            return true;
          }
          return true;
        });

        var promotionCodeUrl = commonServices.URL_PREFIX + '/api/check-promotion-code';
        var urlParams = [];
        if (commonServices.apiKey && commonServices.apiKey != '') {
          urlParams.push('api_key='+commonServices.apiKey);
        }    
        if (urlParams.length > 0) {
          promotionCodeUrl += '?';
          promotionCodeUrl += urlParams.join('&');
        }

        $(this.selectorModel.form_selector).validate({
           invalidHandler: function(form)
           {
             $(self.selectorModel.form_selector + ' label.form-reservation-error').remove();
           },
           rules: {
               pickup_place: {
                   required: self.selectorModel.pickup_place_selector + ':visible'
               },
               pickup_place_other: {
                   required: self.selectorModel.pickup_place_other_selector + ':visible'
               },
               return_place: {
                   required: self.selectorModel.return_place_selector + ':visible'
               },
               return_place_other: {
                   required: self.selectorModel.return_place_other_selector + ':visible'
               },   
               date_from: {
                   required: self.selectorModel.date_from_selector + ':visible'
               },
               time_from: {
                   required: self.selectorModel.configuration.timeToFrom
               },
               date_to: {
                   required: self.selectorModel.date_to_selector + ':visible' 
               },
               time_to: {
                   required: self.selectorModel.configuration.timeToFrom,
                   same_day_time_from: true
               },
               promotion_code: {
                   remote: {
                       url: promotionCodeUrl,
                       type: 'POST',
                       data: {
                           code: function() {
                               return $(self.selectorModel.promotion_code_selector).val();
                           },
                           from: function() {
                               return moment($(self.selectorModel.date_from_selector).datepicker('getDate')).format('YYYY-MM-DD'); 
                           },
                           to: function() {
                               return moment($(self.selectorModel.date_to_selector).datepicker('getDate')).format('YYYY-MM-DD'); 
                           }
                       }
                   }
               },
               accept_age: {
                   required: self.selectorModel.accept_age_selector+':visible'
               }               
           },
           messages: {
               pickup_place: {
                   required: i18next.t('selector.validations.pickupPlaceRequired')
               },
               pickup_place_other: {
                   required: i18next.t('selector.validations.pickupPlaceRequired')
               },
               return_place: {
                   required: i18next.t('selector.validations.returnPlaceRequired')
               }, 
               return_place_other: {
                   required: i18next.t('selector.validations.returnPlaceRequired')
               },  
               date_from: {
                   required: i18next.t('selector.validations.dateFromRequired')
               },
               time_from: {
                   required: i18next.t('selector.validations.timeFromRequired')
               },
               date_to: {
                   required: i18next.t('selector.validations.dateToRequired')
               },  
               time_to: {
                   required:i18next.t('selector.validations.timeToRequired'),
                   same_day_time_from: i18next.t('selector.validations.sameDayTimeToGreaterTimeFrom')
               },               
               promotion_code: {
                   remote: i18next.t('selector.validations.promotionCodeInvalid')
               },
               accept_age: {
                   required: i18next.t('selector.validations.acceptAge', {years: 21})
               }
           },
           errorPlacement: function (error, element) {

            error.insertAfter(element.parent());

           },
           errorClass : 'form-reservation-error'
        });

    }

    /**
     * Setup Time controls
     */
    this.setupTimeToFrom = function() {

        var pickupTime = new SelectSelector(this.selectorModel.time_from_id, 
                                            new MemoryDataSource([]), 
                                            null, 
                                            true, 
                                            'hh:mm');     

        var returnTime = new SelectSelector(this.selectorModel.time_to_id, 
                                            new MemoryDataSource([]), 
                                            null, 
                                            true, 
                                            'hh:mm');  

    }

    // ------------------------ Load data -------------------------------------

    /**
     * Setup the families
     */
    this.loadFamilies = function() {

      this.selectorModel.loadFamilies();

    }

    /*
     * Load pickup hours
     */
    this.loadPickupHours = function() { /** Load return dates **/
      var date = moment($(this.selectorModel.date_from_selector).datepicker('getDate')).format('YYYY-MM-DD');  
      this.selectorModel.loadPickupHours(date);
    }

    /**
     * Load return hours
     */
    this.loadReturnHours = function() {
      var date = moment($(this.selectorModel.date_to_selector).datepicker('getDate')).format('YYYY-MM-DD');  
      this.selectorModel.loadReturnHours(date);
    }

    /**
     * Load pickup places
     */
    this.loadPickupPlaces = function() {

        var self = this;

        // Build URL
        var url = commonServices.URL_PREFIX + '/api/booking/frontend/pickup-places';
        var urlParams = [];
        if (this.selectorModel.requestLanguage != null) {
          urlParams.push('lang='+this.selectorModel.requestLanguage);
        }
        if (commonServices.apiKey && commonServices.apiKey != '') {
          urlParams.push('api_key='+commonServices.apiKey);
        }    
        if (urlParams.length > 0) {
          url += '?';
          url += urlParams.join('&');
        }
        // DataSource
        this.selectorModel.dataSourcePickupPlaces = new RemoteDataSource(url,
                                                          {'id':'id',
                                                           'description':function(data) {
                                                               var value = data.name;
                                                               if (data.price && data.price > 0) {
                                                                   value += ' - ';
                                                                   value += 
                                                                       self.selectorModel.configuration.formatCurrency(data.price,
                                                                                                                       self.selectorModel.configuration.currencySymbol,
                                                                                                                       self.selectorModel.configuration.currencyDecimals,
                                                                                                                       self.selectorModel.configuration.currencyThousandsSeparator,
                                                                                                                       self.selectorModel.configuration.currencyDecimalsMark,
                                                                                                                       self.selectorModel.configuration.currencySymbolPosition);
                                                                   value += '';
                                                               }
                                                               return value;
                                                           }});

        var pickupPlace = new SelectSelector(this.selectorModel.pickup_place_id, 
                                             this.selectorModel.dataSourcePickupPlaces, 
                                             null, 
                                             true, 
                                             i18next.t('selector.select_pickup_place'),
                function() { // Callback that is executed when data is loaded
                  // Custom places -> Add new option
                  if (self.selectorModel.configuration.customPickupReturnPlaces) {
                      if (self.selectorModel.configuration.customPickupReturnPlacePrice && 
                          self.selectorModel.configuration.customPickupReturnPlacePrice != '' && 
                          self.selectorModel.configuration.customPickupReturnPlacePrice > 0) {
                          $(self.selectorModel.pickup_place_selector).append($('<option>', {
                              value: 'other',
                              text: i18next.t('selector.another_place') + ' - ' +
                                    self.selectorModel.configuration.formatCurrency(self.selectorModel.configuration.customPickupReturnPlacePrice,
                                                                                    self.selectorModel.configuration.currencySymbol,
                                                                                    self.selectorModel.configuration.currencyDecimals,
                                                                                    self.selectorModel.configuration.currencyThousandsSeparator,
                                                                                    self.selectorModel.configuration.currencyDecimalsMark,
                                                                                    self.selectorModel.configuration.currencySymbolPosition) + ''
                          }));
                      }
                      else {
                          $(self.selectorModel.pickup_place_selector).append($('<option>', {
                              value: 'other',
                              text: i18next.t('selector.another_place')
                          }));
                      }
                  }
                
                  // Init - Assign the pickup place if selected
                  if (self.selectorModel.shopping_cart) {
                    // Custom pickup place
                    if (self.selectorModel.shopping_cart.custom_pickup_place) { 
                        $(self.selectorModel.pickup_place_selector).val('other');
                        $(self.selectorModel.pickup_place_other_selector).val(self.selectorModel.shopping_cart.pickup_place);
                        $(self.selectorModel.custom_pickup_place_selector).val('true');
                        $(self.selectorModel.another_pickup_place_group_selector).show();
                        $(self.selectorModel.pickup_place_group_selector).hide();
                    }
                    else { // Pickup place from the list
                        var pickup_place = self.selectorModel.shopping_cart.pickup_place ? self.selectorModel.shopping_cart.pickup_place.replace(/\+/g, ' ') : self.selectorModel.shopping_cart.pickup_place;
                        $(self.selectorModel.pickup_place_selector).val(pickup_place);
                    }
                    // Assign the delivery date
                    if (self.selectorModel.shopping_cart.date_from) {
                      var date_from = moment(self.selectorModel.shopping_cart.date_from).format(self.selectorModel.configuration.dateFormat); 
                      $(self.selectorModel.date_from_selector).datepicker("setDate", date_from); // It causes change month => load the calendar days
                      if (self.selectorModel.configuration.timeToFrom) {
                        self.loadPickupHours();
                      }
                    }
                    self.loadReturnPlaces(false); // date_to is assigned after return_place assignation
                  }
                  // End - Assign the pickup place

                  // Update the pickup place
                  self.update('place', 'pickup_place');

                });
        
    }

    /**
     * Load return places
     */  
    this.loadReturnPlaces = function(assignPickupPlace) {

        var self = this;

        console.log('load return places');

        // Do not load the return places while pickup place is not setup
        if (this.selectorModel.shopping_cart == null && 
            ($(this.selectorModel.pickup_place_selector).val() == '')) {
          return;
        }
        // Build URL
        var url = commonServices.URL_PREFIX + '/api/booking/frontend/return-places';
        var urlParams = [];
        urlParams.push('pickup_place='+encodeURIComponent($(this.selectorModel.pickup_place_selector).val()));
        if (this.selectorModel.requestLanguage != null) {
          urlParams.push('lang='+this.selectorModel.requestLanguage);
        }
        if (commonServices.apiKey && commonServices.apiKey != '') {
          urlParams.push('api_key='+commonServices.apiKey);
        }    
        if (urlParams.length > 0) {
          url += '?';
          url += urlParams.join('&');
        }
        // Datasource
        this.selectorModel.dataSourceReturnPlaces = new RemoteDataSource(url,
                                                          {'id':'id',
                                                           'description':function(data) {
                                                               var value = data.name;
                                                               if (data.price && data.price > 0) {
                                                                   value += ' - ';
                                                                   value += 
                                                                       self.selectorModel.configuration.formatCurrency(data.price,
                                                                       self.selectorModel.configuration.currencySymbol,
                                                                       self.selectorModel.configuration.currencyDecimals,
                                                                       self.selectorModel.configuration.currencyThousandsSeparator,
                                                                       self.selectorModel.configuration.currencyDecimalsMark,
                                                                       self.selectorModel.configuration.currencySymbolPosition);
                                                                   value += '';
                                                               }
                                                               return value;
                                                           }});


        var returnPlace = new SelectSelector(this.selectorModel.return_place_id, 
                                             this.selectorModel.dataSourceReturnPlaces, 
                                             null, true, 
                                             i18next.t('selector.select_return_place'),
                function() { // Callback that is executed when data is loaded 
                  // Add other place option to the pickup places if the configuration accept custom places
                  if (self.selectorModel.configuration.customPickupReturnPlaces) {
                      if (self.selectorModel.configuration.customPickupReturnPlacePrice && 
                          self.selectorModel.configuration.customPickupReturnPlacePrice != '' && 
                          self.selectorModel.configuration.customPickupReturnPlacePrice > 0) {
                          $(self.selectorModel.return_place_selector).append($('<option>', {
                              value: 'other',
                              text: i18next.t('selector.another_place') + ' - ' +
                                    self.selectorModel.configuration.formatCurrency(self.selectorModel.configuration.customPickupReturnPlacePrice,
                                                                                    self.selectorModel.configuration.currencySymbol,
                                                                                    self.selectorModel.configuration.currencyDecimals,
                                                                                    self.selectorModel.configuration.currencyThousandsSeparator,
                                                                                    self.selectorModel.configuration.currencyDecimalsMark,
                                                                                    self.selectorModel.configuration.currencySymbolPosition) + ''
                          }));
                      }
                      else {
                          $(self.selectorModel.return_place_selector).append($('<option>', {
                              value: 'other',
                              text: i18next.t('selector.another_place')
                          }));
                      }
                  }

                  // Init - Assign the return place if selected
                  if (self.selectorModel.shopping_cart && 
                      self.selectorModel.shopping_cart.return_place != null) {
                    if (self.selectorModel.shopping_cart.custom_return_place) { // Custom return place
                        $(self.selectorModel.return_place_selector).val('other');
                        $(self.selectorModel.return_place_other_selector).val(self.selectorModel.shopping_cart.return_place);
                        $(self.selectorModel.custom_return_place_selector).val('true');
                        $(self.selectorModel.another_return_place_group_selector).show();
                        $(self.selectorModel.return_place_group_selector).hide();
                    }
                    else { // Return place
                        var return_place = self.selectorModel.shopping_cart.return_place ? self.selectorModel.shopping_cart.return_place.replace(/\+/g, ' ') : self.selectorModel.shopping_cart.return_place;
                        $(self.selectorModel.return_place_selector).val(return_place);
                    }
                    // Assign the collection date
                    if (self.selectorModel.shopping_cart.date_to) {
                      var date_to = moment(self.selectorModel.shopping_cart.date_to).format(self.selectorModel.configuration.dateFormat); 
                      $(self.selectorModel.date_to_selector).datepicker("setDate", date_to); // It causes the month to change => load the calendar days
                      if (self.selectorModel.configuration.timeToFrom) {
                        self.loadReturnHours();
                      } 
                    }
                  }
                  else { // Assign the pickup place to the return place
                    if (assignPickupPlace) {
                      if ($(self.selectorModel.pickup_place_selector).val() == 'other') {
                        self.selectorController.customPickupPlaceValueChanged();
                      }
                      else {
                        $(self.selectorModel.return_place_selector).val($(self.selectorModel.pickup_place_selector).val());
                        $(self.selectorModel.return_place_selector).trigger('change');
                      }
                      // In both cases notify that the return place has changed
                      self.selectorController.returnPlaceChanged();
                    }
                  }
                  // End - Assign the return place if selected   

                  // Update the pickup place
                  self.update('place', 'return_place');

                } );

    }

    // ------------------------ Update GUI ------------------------------------

    /**
     * Update the GUI when selector fields changes
     */
    this.update = function(action, id) {

      var self = this;

      switch (action) {
        case 'families':
          if ($(this.selectorModel.family_id_selector).length > 0 && this.selectorModel.families.length > 0) {
            var dataSource = new MemoryDataSource(this.selectorModel.families);
            var family_id = this.selectorModel.shopping_cart ? this.selectorModel.shopping_cart.family_id : null;
            console.log('family_id');
            console.log(this.selectorModel.shopping_cart);
            console.log(family_id);
            var familyId = new SelectSelector(this.selectorModel.family_id,
                                              dataSource, 
                                              family_id, 
                                              false);
            $(this.selectorModel.family_selector).show();
          }
          break;
        case 'place':
          if (id== 'pickup_place') {
            // Enable return place selector
            if ($(this.selectorModel.pickup_place_selector).attr('disabled')) {
              $(this.selectorModel.pickup_place_selector).attr('disabled', false);
            }    
          }
          else if (id == 'return_place') {
            // Enable return place selector
            if ($(this.selectorModel.return_place_selector).attr('disabled')) {
              $(this.selectorModel.return_place_selector).attr('disabled', false);
            }            
          }
          break;
        case 'days':
          if (id == 'date_from') {
            $(this.selectorModel.date_from_selector).datepicker('refresh');
            // Enable the control
            if ($(this.selectorModel.date_from_selector).attr('disabled')) {  
              $(this.selectorModel.date_from_selector).attr('disabled', false);
            }              
          }
          else if (id == 'date_to') {
            $(this.selectorModel.date_to_selector).datepicker('refresh');
          }
          break;
        case 'hours':
          if (id == 'time_from') {
            var dataSource = new MemoryDataSource(this.selectorModel.pickupHours);
            var timeFrom = this.selectorModel.shopping_cart ? this.selectorModel.shopping_cart.time_from : null;
            if (timeFrom != null && this.selectorModel.pickupHours.indexOf(timeFrom) == -1) {
              timeFrom = null;
            }            
            var pickupTime = new SelectSelector(this.selectorModel.time_from_id,
                                                dataSource, 
                                                timeFrom, 
                                                true, 
                                                'hh:mm',
                                                function() {
                                                    // After load data => Select current value
                                                    if (timeFrom != null) {
                                                      $(self.selectorModel.time_from_selector).val(timeFrom);
                                                    }
                                                } );
            // Enable the control
            if ($(this.selectorModel.time_from_selector).attr('disabled')) {   
              $(this.selectorModel.time_from_selector).attr('disabled', false);
            } 

          }
          else if (id == 'time_to') {
            var dataSource = new MemoryDataSource(this.selectorModel.returnHours);
            var timeTo = this.selectorModel.shopping_cart ? this.selectorModel.shopping_cart.time_to : null;
            if (timeTo != null && this.selectorModel.returnHours.indexOf(timeTo) == -1) {
              timeTo = null;
            }
            var pickupTime = new SelectSelector(this.selectorModel.time_to_id,
                                                dataSource, 
                                                timeTo, 
                                                true, 
                                                'hh:mm',
                                                function() {
                                                    // After load data => Select current value
                                                    if (timeTo != null) {
                                                      $(self.selectorModel.time_to_selector).val(timeTo);
                                                    }
                                                } );
            // Enable the control
            if ($(this.selectorModel.time_to_selector).attr('disabled')) {   
              $(this.selectorModel.time_to_selector).attr('disabled', false);
            }            
          }
          break;
      }

    }


  };

  var SelectorRent = function() {
    this.model = new SelectorRentModel();
    this.controller = new SelectorRentController();
    this.view = new SelectorRentView(this.model, this.controller);

    this.controller.setSelectorView(this.view);
    this.controller.setSelectorModel(this.model);
    this.model.setSelectorView(this.view);

  }

  return SelectorRent;


}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 26 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0), __webpack_require__(18), __webpack_require__(14),__webpack_require__(12),
         __webpack_require__(2),__webpack_require__(1),
         __webpack_require__(4), __webpack_require__(3), __webpack_require__(7), 
         __webpack_require__(37), __webpack_require__(38), __webpack_require__(39),
         __webpack_require__(6), __webpack_require__(27),
         __webpack_require__(8),
         __webpack_require__(5), __webpack_require__(0), __webpack_require__(10),
         __webpack_require__(16), __webpack_require__(15), __webpack_require__(17),
         __webpack_require__(11)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, MemoryDataSource, RemoteDataSource, SelectSelector,commonServices, commonSettings, 
                  commonTranslations, i18next, moment, 
                  selectorWizardSelectPlace, selectorWizardSelectDate, selectorWizardSelectTime,
                  tmpl, cookie) {

  selectorWizardModel = {

    // RequestLanguage
    requestLanguage: null,
    // Configuration
  	configuration: null, 

    minDateFrom: null,
    minDateTo: null,
    maxDateFrom: null,
    maxDateTo: null,
    minTimeTo: null,

    selectionData: {
    	pickupPlace: null,
      pickupPlaceDescription: null,
    	dateFrom: null,
    	timeFrom: null,
    	returnPlace: null,
      returnPlaceDescription: null,
    	dateTo: null,
    	timeTo: null,
      agentId: null,
      salesChannelCode: null,
      familyId: null,
    },

    bodyOverflowY: null,

    // The shopping cart
    shoppingCart: null,

  }

  selectorWizardController = {

  	placeHolderClick: function() {

  		selectorWizardView.update('show_wizard');

  	},

  	fromHolderClick: function() {

  		selectorWizardView.update('show_wizard');

  	},

  	toHolderClick: function() {

  		selectorWizardView.update('show_wizard');

  	},

  	reservationBtnClick: function() {

  		selectorWizardView.update('show_wizard');

  	},

  	closeWizardBtnClick: function() {

  		selectorWizardView.update('hide_wizard');

  	},

   /***
    *
    * The user selects the pickup place 
    *
    */
   	pickupPlaceSelected: function(data) { 
  		selectorWizardModel.selectionData.pickupPlace = data.value;
      selectorWizardModel.selectionData.pickupPlaceDescription = data.description;
      selectorWizardModel.selectionData.returnPlace = data.value;
      selectorWizardModel.selectionData.returnPlaceDescription = data.description;
  		selectorWizardView.update('pickup_place_selected');
  	},

   /***
    *
    * The user selects the date from 
    *
    */
    dateFromSelected: function(value) {
      selectorWizardModel.selectionData.dateFrom = value;
      selectorWizardView.update('date_from_selected');
    },

    /**
     *
     * Time from selected
     *
     */
    timeFromSelected: function(value) {
      selectorWizardModel.selectionData.timeFrom = value;
      selectorWizardView.update('time_from_selected');     
    },


    /***
     *
     * The user selects the return place 
     *
     */
    returnPlaceSelected: function(data) { 
      selectorWizardModel.selectionData.returnPlace = data.value;
      selectorWizardModel.selectionData.returnPlaceDescription = data.description;
      selectorWizardView.update('return_place_selected');
    },

    /**
     *
     * Date to selected
     *
     */
    dateToSelected: function(value) {
      selectorWizardModel.selectionData.dateTo = value;
      selectorWizardView.update('date_to_selected');
    },

    /**
     *
     * Time to selected
     *
     */
    timeToSelected: function(value) {
      selectorWizardModel.selectionData.timeTo = value;
      selectorWizardView.update('time_to_selected');
    }

  }

  selectorWizardView = {

  	init: function() {

      // Setup request language (for API calls)
      selectorWizardModel.requestLanguage = commonSettings.language(document.documentElement.lang);
      // Initialize i18next for translations
      i18next.init({  
                      lng: selectorWizardModel.requestLanguage,
                      resources: commonTranslations
                   }, 
                   function (error, t) {
                      // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                      //jqueryI18next.init(i18next, $);
                      // Localize UI
                      //$('.nav').localize();
                   });
      // Extract the AgentId from the query parameters => Affiliates
      this.extractAgentId();
      // Extract sales_channel_code from the form
      this.extractSalesChannelCode();
      // Extra family_id from the from
      this.extractFamilyId();
      // Setup the events
  		this.setupEvents();

  	},

    // ------------------------ Extract Agent Id ------------------------------

    /**
     * Extract Agent ID (Affiliates)
     */
    extractAgentId: function() {

      var urlVars = commonSettings.getUrlVars();
      var agentId = null;  
      if (typeof urlVars['agentId'] != 'undefined') {
        agentId = decodeURIComponent(urlVars['agentId']);
        cookie.set('__mb_agent_id', agentId, {expires: 14});      
      }
      else {
        agentId = cookie.get('__mb_agent_id');  
      }
      if (agentId != null) {
        selectorWizardModel.selectionData.agentId = agentId;
      }

    },

    /**
     * Extract the sales channel code 
     */
    extractSalesChannelCode: function() {

      console.log('extract sales-channel-code');

      if ($('form[name=wizard_search_form]').length > 0) {
        if ($('form[name=wizard_search_form] input[name=sales_channel_code]').length > 0) {
          var salesChannelCode = $('form[name=wizard_search_form] input[name=sales_channel_code]').val();
          if (salesChannelCode != '') {
            console.log('sales-channel-code: '+salesChannelCode);
            selectorWizardModel.selectionData.salesChannelCode = salesChannelCode;
          }
        }
      }

    },

    /**
     * Extract the family Id
     */
    extractFamilyId: function() {

      if ($('form[name=wizard_search_form]').length > 0) {
        if ($('form[name=wizard_search_form] input[name=family_id]').length > 0) {
          var familyId = $('form[name=widget_search_form] input[name=family_id]').val();
          if (familyId != '') {
            selectorWizardModel.selectionData.familyId = familyId;
          }
        }
      }

    },

  	setupEvents: function() {

  		$('#place_holder').bind('click', function(){
  			selectorWizardController.placeHolderClick();
  		});

  		$('#from_holder').bind('click', function(){
  			selectorWizardController.fromHolderClick();
  		});

  		$('#to_holder').bind('click', function(){
  			selectorWizardController.toHolderClick();
  		});

  		$('#btn_reservation').bind('click', function(){
  			selectorWizardController.reservationBtnClick();
  		});

  	},

  	update: function(action) {

  		switch (action) {
  			case 'show_wizard':
  			  this.showWizard();
  			  break;
  			case 'hide_wizard':
          $('#wizard_container_step_header').empty();
  			  $('#wizard_container_step_body').empty();
  			  this.hideWizard();
  			  break;
  			case 'pickup_place_selected': // Wizard place selected
          selectorWizardSelectPlace.model.removeListeners('place_selected');
  			  this.stepSelectDateFrom();
  			  break;
        case 'date_from_selected': // Wizard date from selected
          selectorWizardSelectDate.model.removeListeners('date_selected');
          this.stepSelectTimeFrom();
          break;
        case 'time_from_selected': // Wizard time from selected
          selectorWizardSelectTime.model.removeListeners('time_selected');
          this.stepSelectReturnPlace();
          break;
        case 'return_place_selected': // Wizard place selected
          selectorWizardSelectPlace.model.removeListeners('place_selected');
          this.stepSelectDateTo();
          break;
        case 'date_to_selected': // Wizard date to selected
          selectorWizardSelectDate.model.removeListeners('date_selected');
          this.stepTimeTo();
          break;
        case 'time_to_selected': // Wizard time to selected
          selectorWizardSelectTime.model.removeListeners('time_selected');
          this.stepFinishWizard();
          break;
  		}

  	},

    startFromShoppingCart: function(shopping_cart) {
      //this.showWizard();
      selectorWizardModel.shoppingCart = shopping_cart;
    },

  	showWizard: function() {

      // Hide the body overflow-y on the wizard
      selectorWizardModel.bodyOverflowY = $('body').css('overflow-y');
      $('body').css('overflow-y', 'hidden');

  		// Close wizard button event
  		$('#close_wizard_btn').unbind('click');
  		$('#close_wizard_btn').bind('click', function(){
  			selectorWizardController.closeWizardBtnClick();
  		});

  		// Show the wizard
  		$('#wizard_container').show();

  		// Show the first step
  		this.stepSelectPickupPlace();

  	},

  	hideWizard: function() {

      // Restore the body overflow-y
      $('body').css('overflow-y', selectorWizardModel.bodyOverflowY);

  		$('#wizard_container').hide();
      // Force remove listeners
      selectorWizardSelectPlace.model.removeListeners('place_selected');
      selectorWizardSelectDate.model.removeListeners('date_selected');
      selectorWizardSelectTime.model.removeListeners('time_selected');

      // Show selected information
      if (selectorWizardModel.selectionData.pickupPlace != null) {
        $('#place_holder').val(selectorWizardModel.selectionData.pickupPlace);
      }
      if (selectorWizardModel.selectionData.dateFrom != null) {
        var from = selectorWizardModel.selectionData.dateFrom;
        if (selectorWizardModel.selectionData.timeFrom != null) {
          from += ' ';
          from += selectorWizardModel.selectionData.timeFrom;
        } 
        $('#from_holder').val(from);
      }
      if (selectorWizardModel.selectionData.dateTo != null) {
        var to = selectorWizardModel.selectionData.dateTo;
        if (selectorWizardModel.selectionData.timeTo != null) {
          to += ' ';
          to += selectorWizardModel.selectionData.timeTo;
        } 
        $('#to_holder').val(to);
      }
  	},

    /**
     * Step 1 : Pickup place
     */
  	stepSelectPickupPlace: function() {

  		// Setup the event pickup place selected
  		selectorWizardSelectPlace.model.addListener('place_selected', function(event){
  			 if (event.type === 'place_selected') {
  			   selectorWizardController.pickupPlaceSelected(event.data);
  			 }
  		});

  		// Show the select place step
  		$('#step_title').html(i18next.t('selectorWizard.pickupPlace'));
  		selectorWizardSelectPlace.model.configuration = selectorWizardModel.configuration;
      selectorWizardSelectPlace.model.mode = 'pickup';      
			selectorWizardSelectPlace.view.init();

  	},

    /**
     * Step 2 : Date From
     */
  	stepSelectDateFrom: function() {

  		// Setup the event date from selected
  		selectorWizardSelectDate.model.addListener('date_selected', function(event){
  			 if (event.type === 'date_selected') {
  			   selectorWizardController.dateFromSelected(event.data);
  			 }
  		});

  		// Show the select date from step
  		$('#step_title').html(i18next.t('selectorWizard.dateFrom'));
      this.showWizardHeader();
      
      // Calculat min/max dates
      this.calculateMinMaxDateFrom();

      // Show the step
			selectorWizardSelectDate.model.configuration = selectorWizardModel.configuration;  
      selectorWizardSelectDate.model.place = selectorWizardModel.selectionData.pickupPlace; 
      selectorWizardSelectDate.model.minDate = selectorWizardModel.minDateFrom.format(selectorWizardModel.configuration.dateFormat);
      selectorWizardSelectDate.model.maxDate = selectorWizardModel.maxDateFrom.format(selectorWizardModel.configuration.dateFormat);
      selectorWizardSelectDate.model.action = 'deliveries';
  		selectorWizardSelectDate.view.init();


  	},

    /**
     * Step 3 : Time From
     */
    stepSelectTimeFrom: function() {

      // Setup the event date from selected
      selectorWizardSelectTime.model.addListener('time_selected', function(event){
         if (event.type === 'time_selected') {
           selectorWizardController.timeFromSelected(event.data);
         }
      });

      // Show the select date from step
      $('#step_title').html(i18next.t('selectorWizard.timeFrom'));
      this.showWizardHeader();

      // Show the step
      selectorWizardSelectTime.model.configuration = selectorWizardModel.configuration; 
      selectorWizardSelectTime.model.place = selectorWizardModel.selectionData.pickupPlace;
      selectorWizardSelectTime.model.date = selectorWizardModel.selectionData.dateFrom;
      selectorWizardSelectTime.model.minTime = null;  
      selectorWizardSelectTime.model.action = 'deliveries';  
      selectorWizardSelectTime.view.init();

    },

    /**
     * Step 4 : Return place
     */
    stepSelectReturnPlace: function() {

      // Setup the event pickup place selected
      selectorWizardSelectPlace.model.addListener('place_selected', function(event){
         if (event.type === 'place_selected') {
           selectorWizardController.returnPlaceSelected(event.data);
         }
      });

      // Show the select place step
      $('#step_title').html(i18next.t('selectorWizard.returnPlace'));
      selectorWizardSelectPlace.model.configuration = selectorWizardModel.configuration;
      selectorWizardSelectPlace.model.mode = 'return';
      selectorWizardSelectPlace.model.pickup_place = selectorWizardModel.selectionData.pickupPlace;
      selectorWizardSelectPlace.view.init();

    },

    /**
     * Step 5 : Date To
     */
    stepSelectDateTo: function() {

      // Setup the event date from selected
      selectorWizardSelectDate.model.addListener('date_selected', function(event){
         if (event.type === 'date_selected') {
           selectorWizardController.dateToSelected(event.data);
         }
      });

      // Show the select date from step
      $('#step_title').html(i18next.t('selectorWizard.dateTo'));
      this.showWizardHeader();

      // Calculat min/max dates
      this.calculateMinMaxDateTo();

      // Show the step
      selectorWizardSelectDate.model.configuration = selectorWizardModel.configuration;  
      selectorWizardSelectDate.model.minDate = selectorWizardModel.minDateTo.format(selectorWizardModel.configuration.dateFormat);
      selectorWizardSelectDate.model.maxDate = selectorWizardModel.maxDateTo.format(selectorWizardModel.configuration.dateFormat);      
      selectorWizardSelectDate.model.place = selectorWizardModel.selectionData.returnPlace; 
      selectorWizardSelectDate.model.action = 'collections';        
      selectorWizardSelectDate.view.init();


    },

    /**
     * Step 6 : Time to
     */
    stepTimeTo: function() {

      // Setup the event date from selected
      selectorWizardSelectTime.model.addListener('time_selected', function(event){
         if (event.type === 'time_selected') {
           selectorWizardController.timeToSelected(event.data);
         }
      });

      // Show the select date from step
      $('#step_title').html(i18next.t('selectorWizard.timeTo'));
      this.showWizardHeader();

      // Calculate min time
      this.calculateMinTimeTo();

      // Show the step
      selectorWizardSelectTime.model.configuration = selectorWizardModel.configuration;     
      selectorWizardSelectTime.model.place = selectorWizardModel.selectionData.returnPlace;
      selectorWizardSelectTime.model.date = selectorWizardModel.selectionData.dateTo;
      selectorWizardSelectTime.model.minTime = selectorWizardModel.minTime;  
      selectorWizardSelectTime.model.action = 'collections';        
      selectorWizardSelectTime.view.init();

    },

    /**
     * Step 7 : Finish wizard
     */
    stepFinishWizard: function() {

      var url = commonServices.chooseProductUrl;

      var params = [];

      params.push('pickup_place='+commonSettings.data.encodeData(selectorWizardModel.selectionData.pickupPlace));
      params.push('date_from='+commonSettings.data.encodeData(selectorWizardModel.selectionData.dateFrom));
      params.push('time_from='+commonSettings.data.encodeData(selectorWizardModel.selectionData.timeFrom));
      params.push('return_place='+commonSettings.data.encodeData(selectorWizardModel.selectionData.returnPlace));
      params.push('date_to='+commonSettings.data.encodeData(selectorWizardModel.selectionData.dateTo));
      params.push('time_to='+commonSettings.data.encodeData(selectorWizardModel.selectionData.timeTo));
      // Appends the agent id
      if (selectorWizardModel.selectionData.agentId != null) {
        params.push('agent_id='+commonSettings.data.encodeData(selectorWizardModel.selectionData.agentId));
      }
      // Appends the family id
      if (selectorWizardModel.selectionData.familyId != null) {
        params.push('family_id='+commonSettings.data.encodeData(selectorWizardModel.selectionData.familyId));
      }
      console.log('sales_channel_code:'+selectorWizardModel.selectionData.salesChannelCode);
      // Append the sales channel code
      if (selectorWizardModel.selectionData.salesChannelCode != null) {
        params.push('sales_channel_code='+commonSettings.data.encodeData(selectorWizardModel.selectionData.salesChannelCode));
      }
      else if (selectorWizardModel.shoppingCart) {
        console.log('sales_channel_code_sc:'+selectorWizardModel.shoppingCart.sales_channel_code);
        if (typeof selectorWizardModel.shoppingCart.sales_channel_code != 'undefined' &&  
            selectorWizardModel.shoppingCart.sales_channel_code != null && selectorWizardModel.shoppingCart.sales_channel_code != '') {
          params.push('sales_channel_code='+selectorWizardModel.shoppingCart.sales_channel_code);
        }
      }

      if (params.length > 0) {
        url += '?';
        url += params.join('&');
      }

      window.location.href = url;

    },

    showWizardHeader: function() {
     // Show the header
      var html = tmpl('wizard_steps_summary')({summary: selectorWizardModel.selectionData});
      $('#wizard_container_step_header').html(html);
      $('#wizard_container_step_header').show();

    },

    /**
     * Calculate min and max values for date from 
     * 
     * min date from : Today
     * max date from : min date from + 365 days
     *
     */
    calculateMinMaxDateFrom: function() {

        // Setup First and last date
        selectorWizardModel.minDateFrom = moment().tz(selectorWizardModel.configuration.timezone);       
        selectorWizardModel.maxDateFrom = moment(selectorWizardModel.minDateFrom).
                                                  add(365, 'days').
                                                  tz(selectorWizardModel.configuration.timezone);

    },

    /**
     * Calculate min and max values for date to
     *
     * min date to: date from + min days
     * max date to: min date to + 365 days
     */
    calculateMinMaxDateTo: function() {

        if (selectorWizardModel.configuration.cycleOf24Hours) {
          selectorWizardModel.minDateTo = moment(selectorWizardModel.selectionData.dateFrom, selectorWizardModel.configuration.dateFormat).
                                            add(selectorWizardModel.configuration.minDays, 'days').
                                            tz(selectorWizardModel.configuration.timezone);
        }
        else {
          selectorWizardModel.minDateTo = moment(selectorWizardModel.selectionData.dateFrom, selectorWizardModel.configuration.dateFormat).
                                            add(selectorWizardModel.configuration.minDays - 1, 'days').
                                            tz(selectorWizardModel.configuration.timezone);
        } 
       
        selectorWizardModel.maxDateTo = moment(selectorWizardModel.minDateTo).
                                          add(365, 'days').
                                          tz(selectorWizardModel.configuration.timezone);
    },

    /**
     *
     */ 
    calculateMinTimeTo: function() {

      if (selectorWizardModel.selectionData.dateFrom === selectorWizardModel.selectionData.dateTo) {
        selectorWizardModel.minTime = selectorWizardModel.selectionData.timeFrom;
      }
      else {
        selectorWizardModel.minTime = null;
      }

    }

  }

  var selectorWizard = {
    model: selectorWizardModel,
    controller: selectorWizardController,
    view: selectorWizardView
  }

  return selectorWizard;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 27 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * JavaScript Cookie v2.2.1
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */
;(function (factory) {
	var registeredInModuleLoader;
	if (true) {
		!(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
				__WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
		registeredInModuleLoader = true;
	}
	if (true) {
		module.exports = factory();
		registeredInModuleLoader = true;
	}
	if (!registeredInModuleLoader) {
		var OldCookies = window.Cookies;
		var api = window.Cookies = factory();
		api.noConflict = function () {
			window.Cookies = OldCookies;
			return api;
		};
	}
}(function () {
	function extend () {
		var i = 0;
		var result = {};
		for (; i < arguments.length; i++) {
			var attributes = arguments[ i ];
			for (var key in attributes) {
				result[key] = attributes[key];
			}
		}
		return result;
	}

	function decode (s) {
		return s.replace(/(%[0-9A-Z]{2})+/g, decodeURIComponent);
	}

	function init (converter) {
		function api() {}

		function set (key, value, attributes) {
			if (typeof document === 'undefined') {
				return;
			}

			attributes = extend({
				path: '/'
			}, api.defaults, attributes);

			if (typeof attributes.expires === 'number') {
				attributes.expires = new Date(new Date() * 1 + attributes.expires * 864e+5);
			}

			// We're using "expires" because "max-age" is not supported by IE
			attributes.expires = attributes.expires ? attributes.expires.toUTCString() : '';

			try {
				var result = JSON.stringify(value);
				if (/^[\{\[]/.test(result)) {
					value = result;
				}
			} catch (e) {}

			value = converter.write ?
				converter.write(value, key) :
				encodeURIComponent(String(value))
					.replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);

			key = encodeURIComponent(String(key))
				.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent)
				.replace(/[\(\)]/g, escape);

			var stringifiedAttributes = '';
			for (var attributeName in attributes) {
				if (!attributes[attributeName]) {
					continue;
				}
				stringifiedAttributes += '; ' + attributeName;
				if (attributes[attributeName] === true) {
					continue;
				}

				// Considers RFC 6265 section 5.2:
				// ...
				// 3.  If the remaining unparsed-attributes contains a %x3B (";")
				//     character:
				// Consume the characters of the unparsed-attributes up to,
				// not including, the first %x3B (";") character.
				// ...
				stringifiedAttributes += '=' + attributes[attributeName].split(';')[0];
			}

			return (document.cookie = key + '=' + value + stringifiedAttributes);
		}

		function get (key, json) {
			if (typeof document === 'undefined') {
				return;
			}

			var jar = {};
			// To prevent the for loop in the first place assign an empty array
			// in case there are no cookies at all.
			var cookies = document.cookie ? document.cookie.split('; ') : [];
			var i = 0;

			for (; i < cookies.length; i++) {
				var parts = cookies[i].split('=');
				var cookie = parts.slice(1).join('=');

				if (!json && cookie.charAt(0) === '"') {
					cookie = cookie.slice(1, -1);
				}

				try {
					var name = decode(parts[0]);
					cookie = (converter.read || converter)(cookie, name) ||
						decode(cookie);

					if (json) {
						try {
							cookie = JSON.parse(cookie);
						} catch (e) {}
					}

					jar[name] = cookie;

					if (key === name) {
						break;
					}
				} catch (e) {}
			}

			return key ? jar[key] : jar;
		}

		api.set = set;
		api.get = function (key) {
			return get(key, false /* read as raw */);
		};
		api.getJSON = function (key) {
			return get(key, true /* read as json */);
		};
		api.remove = function (key, attributes) {
			set(key, '', extend(attributes, {
				expires: -1
			}));
		};

		api.defaults = {};

		api.withConverter = init;

		return api;
	}

	return init(function () {});
}));


/***/ }),
/* 28 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(20),__webpack_require__(32)], __WEBPACK_AMD_DEFINE_RESULT__ = (function(YSDEventTarget, DataAdapter) {
  
 YSDAbstractDataSource = function() {
  
   this.events = new YSDEventTarget();  
    
   this.addListener = function(type, listener) { /* addListener */
     this.events.addEventListener(type, listener);  
   }
    
   this.removeListener = function(type, listener) { /* removeListener */
     this.events.removeEventListener(type, listener);     
   }

   this.removeListeners = function(type) { /* remove listeners*/
     this.events.removeEventListeners(type);
   }
  
   this.adaptData = function(data, matchingProperties, adapters) {
    
     var adapted_data = [];
    
     if (matchingProperties != null) 
     {  
       for (idx in data) {
         adapted_data.push(new DataAdapter(data[idx], matchingProperties));
       }  
     }
     else
     {
       adapted_data = data; 
     }
     
     // Adapt data through extra adapters
     for (idx in adapters) {
       adapted_data = new adapters[idx](adapted_data);  
     } 
        
     return adapted_data;
    
  }
 }
  
 return YSDAbstractDataSource;
  
 }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 29 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(7), __webpack_require__(7)], __WEBPACK_AMD_DEFINE_RESULT__ = (function(moment){

  var formatter = {

    formatDateTime: function(the_date, format, timeZone) {
        if (the_date instanceof Date) {
            return moment(the_date).tz(timeZone).format(format);
        }
        else
        if (!isNaN(new Date(the_date))) {
            return moment(the_date).tz(timeZone).format(format);
        }

        return '';
    },

    /**
     * Format a date 
     */
    formatDate: function(the_date, format) {
        
      if (typeof format == 'undefined') {
        format = 'DD/MM/YYYY';
      }
      else {
        format = format.toUpperCase();
      }
      
      if (the_date instanceof Date) {
        return moment(the_date).format(format);
      }
      else  
        if (!isNaN(new Date(the_date))) { 
          return moment(the_date).format(format);
        }
      return '';

    },
  
  
    /**
     * Format a currency
     */
    formatCurrency: function(amount, currencySymbol, decimalCount, thousandSeparator, decimalSeparator, symbolPosition) {
      var result = '';
      var roundedAmount = new Number(amount).toFixed(decimalCount);
      var parts = roundedAmount.split('.');
      if (decimalCount == 0 && parts.length == 1) {
        var integerPart = parts[0];
        result = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, thousandSeparator);
      }
      else if (decimalCount > 0 && parts.length == 2) {
          var integerPart = parts[0];
          var decimalPart = parts[1];
          result = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, thousandSeparator);
          result += decimalSeparator;
          result += decimalPart;
      }
      if (symbolPosition == 'first') {
        result = currencySymbol + result;
      }
      else if (symbolPosition == 'last') {
        result += ' ';
        result += currencySymbol;
      }
      return result;
    },

    /**
     * Format a pad number
     */
    formatPadNumber: function(num, length) {
      var r = "" + num;
      while (r.length < length) {
        r = "0" + r;
      }
      return r;
    }
  
  };

  return formatter;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 30 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0), 
         __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), __webpack_require__(9),
         __webpack_require__(3),__webpack_require__(6), __webpack_require__(20),
         __webpack_require__(8), __webpack_require__(21),
	       __webpack_require__(5)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, 
                commonServices, commonSettings, commonTranslations, commonLoader, 
                i18next, tmpl, YSDEventTarget) {

  /**
   * The model
   */      
  var LoginModel = function() {

    this.events = new YSDEventTarget();
    this.view = null;
    this.bearer = null;
    this.connectedUser = false;
    this.user = null;

    this.setView = function(_view) {
      this.view = _view;
    }
    
    /**
     * Add listener
     */
    this.addListener = function(type, listener) { /* addListener */
       this.events.addEventListener(type, listener);  
    }
      
    /**
     * Remove listener
     */   
    this.removeListener = function(type, listener) { /* removeListener */
       this.events.removeEventListener(type, listener);     
    }

    /**
     * Remove listener
     */
    this.removeListeners = function(type) { /* remove listeners*/
       this.events.removeEventListeners(type);
    }
    
    /**
     * Login
     */
    this.login = function(username, password) {

      console.log('login');
      var self = this;
      var url = commonServices.URL_PREFIX + '/api/v1/login';
      var urlParams = [];
      urlParams.push('username='+username);
      urlParams.push('password='+password);
      if (urlParams.length > 0) {
        url += '?';
        url += urlParams.join('&');
      }
  
      // Request
      $.ajax({
        type: 'POST',
        url: url,
        contentType: 'application/x-www-form-urlencoded',
        success: function(data, textStatus, jqXHR) {
          if (data && data.connected) {
            var authorization = jqXHR.getResponseHeader('Authorization');
            if (authorization) {
              self.bearer = authorization;
              sessionStorage.setItem('mybooking_authorization', authorization);
              self.connectedUser = true;
              self.user = data.user;
            }
            self.events.fireEvent( {type:'login', data: {success: true, user: self.user}} );
          }
          else {
            self.events.fireEvent( {type:'login', data: {success: false}} );
          }
        },
        error: function(data, textStatus, jqXHR) {
          alert(i18next.t('common.error'));
        }
      });  

    }

  }

  /**
   * The controller
   */
  var LoginController = function() {

    this.model = null;
    this.view = null;

    this.setView = function(_view) {
      this.view = _view;
    }

    this.setModel = function(_model) {
      this.model = _model;
    }

    /**
     * Login Submit Form
     */
    this.loginFormSubmit = function() {
      if ( $('form[name=mybooking_login_form]').valid() ) {
        this.model.login($('form[name=mybooking_login_form] input[name=username]').val(),
                         $('form[name=mybooking_login_form] input[name=password]').val() );
      }
    }

  }

  /**
   * The view
   */
  var LoginView = function(_model, _controller) {
    this.model = _model;
    this.controller = _controller;

    this.init = function() {
      this.setupValidation();
    }

    this.setupValidation = function() {
      var self = this;
      $('form[name=mybooking_login_form]').validate({
        submitHandler: function(form) {
            $('#mybooking_login_form_error').hide();
            $('#mybooking_login_form_error').html('');
            self.controller.loginFormSubmit();
            return false;
        },

        invalidHandler : function (form, validator) {
          $('#mybooking_login_form_error').html(i18next.t('complete.reservationForm.errors'));
          $('#mybooking_login_form_error').show();
        },

        rules: {
          'username' : {
            required: true
          },
          'password' : {
            required: true
          }
        },
        messages: {
          'username': {
            required: i18next.t('complete.reservationForm.validations.fieldRequired')
          },
          'password': {
            required: i18next.t('complete.reservationForm.validations.fieldRequired')
          }
        }

      });

    }

  }

  /**
   * Login component
   */
  var Login = function() {
    this.model = new LoginModel();
    this.controller = new LoginController();
    this.view = new LoginView(this.model, this.controller);

    this.controller.setView(this.view);
    this.controller.setModel(this.model);
    this.model.setView(this.view);

  }

  return Login;

  

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 31 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_RESULT__ = (function() {

	function LoaderSpinner(){
	
		this.container = null;
		this.element = null;
		this.timeOutId = null;
		this.movement = 1;
		this.c=264;
		// Timeout
		this.timeOut=15; 
		// Step moviments
  	this.i=0;
  	this.o=0;
	
		this.show = function() {

			this.getElement().parentElement.style.display='block';
			
			this.movement = 1;
			this.i = 0;
			this.o = 0;
			this.moveStep();

  	},

  	this.moveStep = function() {

			if (this.movement == 1) {
				if (this.i == this.c) {
					this.movement = 2;
					this.i=this.c;
					this.o=this.c*2;
				}
				else {
				  this.i+=4;
				  this.o+=8;
				  this.getElement().setAttribute('stroke-dasharray',this.i+' '+(this.c-this.i));
				  this.getElement().setAttribute('stroke-dashoffset',this.o)  					
				}
			}
			else {
				if (this.i==this.c) {
					this.movement = 1;
					this.i = 0;
					this.o = 0;
				}
				else {
					this.i-=4;
					this.o+=4;
				  this.getElement().setAttribute('stroke-dasharray',this.i+' '+(this.c-i));
				  this.getElement().setAttribute('stroke-dashoffset',this.o)
				}
			}
			var self = this;
			this.timeOutId = setTimeout(function(){
																				self.moveStep();
																	}, this.timeOut);

  	},

		this.hide = function() {

			this.getElement().parentElement.style.display = 'none';
			if (this.timeOutId) {
				console.log('clear Timeout');
				clearTimeout(this.timeOutId);
				this.timeOutId = null;
			}
			this.getElement().setAttribute('stroke-dasharray','0 264');
			this.getElement().setAttribute('stroke-dashoffset','0');

		}

		this.getElement = function() {

			if (this.element == null) {

				this.container = document.createElement('div');
				this.container.style.position = 'fixed';
				this.container.style.height = '100%';
				this.container.style.width = '100%';
				this.container.style.top = '0';
				this.container.style.left = '0';
				this.container.style.display = 'block';
				this.container.style.background = '#fff';
				this.container.style.opacity = '0.7';
				this.container.style.zIndex = 99999;

				// Create SVG
				this.element=document.createElementNS('http://www.w3.org/2000/svg', 'svg');
				
				// Create Circle
				let c=document.createElementNS('http://www.w3.org/2000/svg', 'circle');
				this.element.setAttribute('width','100');
				this.element.setAttribute('height','100');
				c.setAttribute('viewBox','0 0 100 100');
				c.setAttribute('cx','50');
				c.setAttribute('cy','50');
				c.setAttribute('r','42');
				c.setAttribute('stroke-width','16');
				c.setAttribute('stroke','#000000');
				c.setAttribute('fill','transparent');
				this.element.appendChild(c);
				this.element.style.cssText='position:absolute;left:calc(50% - 50px);top:calc(50% - 50px)';
				
				this.container.appendChild(this.element);
				document.body.appendChild(this.container);

				//document.body.appendChild(this.element);
			}

			return this.element;

		}

	}
	
	return LoaderSpinner;
}).call(exports, __webpack_require__, exports, module),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 32 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function() {

  /*
   --------------------
   DataAdapter
   --------------------

   @param adaptee
     The object that will adapt
   @param matchingProperties
     An object with the relationship
     Example :
     adaptee -> {group: 'mygroup', name: 'myname'}
     And we want to adapt to {id: 'mygroup', description : 'myname'}
     matchingProperties will be {id: 'group', description : 'name'}

   */
  var YSDDataAdapter = function(adaptee, matchingProperties) {

	this.adaptee = adaptee;

	var value = null;
  var idx=null;

	for (var idx in matchingProperties) {

    if (matchingProperties[idx] instanceof Function) {
      value = matchingProperties[idx](adaptee);
    }
    else {
      value = adaptee[matchingProperties[idx]];
    }

	  this[idx] = value;

	}

  }

  return YSDDataAdapter;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 33 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_RESULT__ = (function(){

  var YSDListSelectorModel = function(dataSource, value) {

	this.dataSource = dataSource;
	this.data = [];
	this.value = value;

	this.setView = function(view) {
	  this.view = view;
	}

	var self = this;

	this.eventListener = function(event) {
        switch (event.type) {
            case 'data_available' :
                self.data = event.data;
                self.view.notify('data_changed');
                break;
        }
    };

  this.dataSource.addListener('data_available', this.eventListener);

	this.retrieveData = function() {
	  this.dataSource.retrieveData();
	}

	this.setValue = function(value) {
	  this.value = value;
	  this.view.notify('value_changed');
	}

	this.removeEventListener = function() {
		this.dataSource.removeListener('data_available', this.eventListener);
	}

  }

  return YSDListSelectorModel;

}).call(exports, __webpack_require__, exports, module),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 34 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_RESULT__ = (function() {

  /* ------------- The controller -------------- */

  var YSDSelectSelectorController = function() {

	this.setView = function(view) {
	  this.view = view;
	};

  }

  return YSDSelectSelectorController;

}).call(exports, __webpack_require__, exports, module),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 35 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_RESULT__ = (function() {

  /* -------------------------
     SelectSelectorView

     == Parameters::

     @params [YSDListSelectorModel] model
     @params [YSDSelectSelectorController] controller
     @params [String] selectorControlId: The selector element id
     @params [YSDAbstractDataSource] dataSource: The datasource 
     @params [Object] value: The current value
     @params [Boolean] nullOption: Accepts null 
     @params [String] nullOptionText: The text to show
     @params [function] callback 

  */
  var YSDSelectSelectorView = function(model, controller, selectControlId, nullOption, nullOptionText, callback) {

    this.model = model;
    this.controller = controller;
    this.selectControlId = selectControlId;
    this.nullOption = nullOption || false;
    if (nullOptionText) {
      this.nullOptionText = nullOptionText;
    }
    else {
      this.nullOptionText = '- No selection -';
    }
    this.callback = callback;

    this.notify = function(status) {

      switch (status) {

        case 'data_changed' :
          this.createOptions();
          this.selectValues();
          break;

        case 'value_changed' :
          this.selectValues();
          break;
      }

    }

    this.createNullOption = function() {
      var selectControl = document.getElementById(selectControlId);
      var  option = document.createElement('option');
      option.setAttribute('value', '');
      option.text = option.innerText = this.nullOptionText;
      selectControl.appendChild(option);
    }

    this.createOptions = function() { /* Create the options */

      var data_options = this.model.data;
      var option = null;
      var selectControl = document.getElementById(selectControlId);

      if (selectControl != null) {
        // Remove the options
        if (selectControl.options.length > 0)
        {
           while (selectControl.hasChildNodes())
           {
             selectControl.removeChild(selectControl.firstChild);
           }
        }

        if (nullOption) {
          this.createNullOption();
        }

        for (var idx in data_options) {
          option = document.createElement('option');
          option.setAttribute('value', data_options[idx].id);
          option.text = option.innerText = data_options[idx].description;

          selectControl.appendChild(option);

        }
      }

      if (this.callback) {
        this.callback();
      }

    }

    this.selectValues = function() { /* Select the values */

      var the_value = this.model.value;
      var selectControl = document.getElementById(selectControlId);

      if (selectControl != null) {
        var option = selectControl.firstElementChild;
        while (option) {

          if (the_value instanceof Array) {
            for (var idx in the_value) {
              if (the_value[idx] instanceof Object && option.getAttribute('value') == the_value[idx].id) {
                option.selected = true;
              }
              else if (option.getAttribute('value') == the_value[idx]) {
                option.selected = true;
              }
            }
          }
          else
          {
            if (the_value instanceof Object && option.getAttribute('value') == the_value.id) {
              option.selected = true;
              break;
            }
            else if (option.getAttribute('value') == the_value) {
              option.selected = true;
              break;
            }
          }

          option = option.nextElementSibling;
        }
      }
    }


  }

  return YSDSelectSelectorView;

}).call(exports, __webpack_require__, exports, module),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 36 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0), __webpack_require__(1), __webpack_require__(9), __webpack_require__(20), __webpack_require__(25)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, commonSettings, commonLoader, YSDEventTarget, SelectorRent) {

  /***
   * Model
   */
  var customSelectorModel = {

    requestLanguage: null,
    configuration: null,
  
    events: new YSDEventTarget(),
      
    addListener: function(type, listener) { /* addListener */
       this.events.addEventListener(type, listener);  
    },
      
    removeListener: function(type, listener) { /* removeListener */
       this.events.removeEventListener(type, listener);     
    },

    removeListeners: function(type) { /* remove listeners*/
       this.events.removeEventListeners(type);
    },

    /**
     * Load settings
     */
    loadSettings: function( id ) {
      commonSettings.loadSettings(function(data){
        commonLoader.hide();
        customSelectorModel.configuration = data;
        customSelectorView.showForm( id );
      });
    }
   
  };

  /***
   * Controller
   */
  var customSelectorController = {

    bookNowButtonClick: function( id ) {
      commonLoader.show();
      customSelectorModel.loadSettings( id );
    }

  };

  /***
   * View
   */
  var customSelectorView = {

    selector: null,

    /**
     * Initialize
     */
    init: function() {
      $('.mybooking-custom-selector').on('click', function(){
        customSelectorController.bookNowButtonClick( $(this).attr('data-id' ));
      });
    },

    showForm: function( id ) {

        // Setup request language (for API calls)
        customSelectorModel.requestLanguage = commonSettings.language(document.documentElement.lang);

        this.selector = new SelectorRent();

        // Configure selector
        this.selector.model.requestLanguage = customSelectorModel.requestLanguage;
        this.selector.model.configuration = customSelectorModel.configuration;

        // == Selectors

        // Search form
        this.selector.model.form_selector = 'form[name=custom_search_form_'+id+']';
        // Search form template
        this.selector.model.form_selector_tmpl = 'custom_form_selector_tmpl';
        
        // Pickup place
        this.selector.model.pickup_place_id = 'custom_pickup_place';
        this.selector.model.pickup_place_selector = '#custom_pickup_place';
        this.selector.model.pickup_place_other_id = 'custom_pickup_place_other';
        this.selector.model.pickup_place_other_selector = '#custom_pickup_place_other';
        this.selector.model.another_pickup_place_group_selector = '#custom_another_pickup_place_group';
        this.selector.model.custom_pickup_place_selector = 'input[name=custom_custom_pickup_place]';        
        this.selector.model.pickup_place_group_selector = '.custom_pickup_place_group',
        this.selector.model.another_pickup_place_group_close = '.custom_another_pickup_place_group_close',
        
        // Return place
        this.selector.model.return_place_id = 'custom_return_place';
        this.selector.model.return_place_selector = '#custom_return_place';
        this.selector.model.return_place_other_id = 'custom_return_place_other';
        this.selector.model.return_place_other_selector = '#custom_return_place_other';
        this.selector.model.another_return_place_group_selector = '#custom_another_return_place_group';  
        this.selector.model.custom_return_place_selector = 'input[name=custom_custom_return_place]';             
        this.selector.model.return_place_group_selector = '.custom_return_place_group',
        this.selector.model.another_return_place_group_close = '.custom_another_return_place_group_close',
 
        // Date From
        this.selector.model.date_from_selector = '#custom_date_from';
        // Time From
        this.selector.model.time_from_id = 'custom_time_from';
        this.selector.model.time_from_selector = '#custom_time_from';
        // Date To
        this.selector.model.date_to_selector = '#custom_date_to';
        // Time To
        this.selector.model.time_to_id = 'custom_time_to';      
        this.selector.model.time_to_selector = '#custom_time_to';  
        
        // Driver age
        this.selector.model.driver_age_rule_selector = '#custom_driver_age_rule';
        // Number of products
        this.selector.model.number_of_products_selector = '#custom_number_of_products';
        // Family
        this.selector.model.family_id = 'custom_family_id',
        this.selector.model.family_id_selector = '#custom_family_id',   
        this.selector.model.family_selector = '.custom_family',     
        // Accept Age
        this.selector.model.accept_age_selector = '#custom_accept_age';
        // Promotion code
        this.selector.model.promotion_code_selector = '#custom_promotion_code';
        
        // Initialize selector
        this.selector.view.init();
        this.selector.view.startEmpty();  

        // Notify selector ready   
        customSelectorModel.events.fireEvent({ type: 'selector_ready', data: {id: id} });
    }

  };

  var customSelector = { model: customSelectorModel,
                         controller: customSelectorController,
                         view: customSelectorView};

  return customSelector;

}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 37 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0), __webpack_require__(18), __webpack_require__(14),__webpack_require__(12),
         __webpack_require__(2),__webpack_require__(1),
         __webpack_require__(4), __webpack_require__(20),
         __webpack_require__(3), __webpack_require__(7), __webpack_require__(6),
         __webpack_require__(8),
         __webpack_require__(5), __webpack_require__(0), __webpack_require__(10),
         __webpack_require__(16), __webpack_require__(15), __webpack_require__(17),
         __webpack_require__(11)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, MemoryDataSource, RemoteDataSource, SelectSelector,commonServices, commonSettings, 
                  commonTranslations, YSDEventTarget, i18next, moment, tmpl) {


  selectorWizardSelectPlace = {

    model: {

 	    events: new YSDEventTarget(),
      configuration: null,
      requestLanguage: null,

      mode: 'pickup', // Mode pickup/return
      pickup_place: null, // If return mode it holds the pickup_place

      // Available places to select
      places: null,
      // Selected place
      place: null,
      placeDescription: null,

	    addListener: function(type, listener) { /* addListener */
	      this.events.addEventListener(type, listener);  
	    },
	    
	    removeListener: function(type, listener) { /* removeListener */
	      this.events.removeEventListener(type, listener);     
	    },

	    removeListeners: function(type) { /* remove listeners*/
	     this.events.removeEventListeners(type);
	    },

    	loadPlaces: function() {
      	var self = this;
        // Build URL
        var url = commonServices.URL_PREFIX;
        if (this.mode === 'return') {
      	  url += '/api/booking/frontend/return-places';
        }
        else {
          url += '/api/booking/frontend/pickup-places';
        }
        var urlParams = [];
        if (this.mode == 'return' && this.pickup_place) {
          urlParams.push('pickup_place='+encodeURIComponent(this.pickup_place));
        } 
        if (this.configuration.multipleDestinations) {
          urlParams.push('format=destinations-grouped');
        }
        if (this.requestLanguage != null) {
          urlParams.push('lang=' + this.requestLanguage);
        }
        if (commonServices.apiKey && commonServices.apiKey != '') {
          urlParams.push('api_key='+commonServices.apiKey);
        }           
        if (urlParams.length > 0) {
          url += '?';
          url += urlParams.join('&');
        }
        // Request
	      $.ajax({
	        type: 'GET',
	        url: url,
	        dataType: 'json',
	        success: function(data, textStatus, jqXHR) {
	          self.places = data;
	          selectorWizardSelectPlace.view.update('loaded_places');
	        },
	        error: function(data, textStatus, jqXHR) {
	          alert(i18next.t('selector.error_loading_data'));
	        }
	      });

    	},

    },

    controller: {

      destinationSelectorClick: function(value) {
         console.log('select destination');
         if (value == 'all') {
           $('.destination-group').show();
         }
         else {
           $('.destination-group').hide();
           $('.destination-group[data-destination-id='+value+']').show();
         }
      },

    	placeSelected: function(value, description) {
        console.log('select place');
				selectorWizardSelectPlace.model.place = value;
        selectorWizardSelectPlace.model.placeDescription = description;
				selectorWizardSelectPlace.model.events.fireEvent({type: 'place_selected', data: {value: value, description: description}});
    	}

    },

    view: {

    	init: function() {

        // Setup request language (for API calls)
        selectorWizardSelectPlace.model.requestLanguage = commonSettings.language(document.documentElement.lang);
        selectorWizardSelectPlace.model.loadPlaces();

    	},

    	update: function(event) {
    		switch (event) {
    				case 'loaded_places':
    				  this.showPlaces();
    				  break;
    		}
    	},

    	showPlaces: function() {

    		var html;

        if (selectorWizardSelectPlace.model.places['destinations']) {
          html = tmpl('select_place_multiple_destinations_tmpl')({places: selectorWizardSelectPlace.model.places});
        }
        else {
          html = tmpl('select_place_tmpl')({places: selectorWizardSelectPlace.model.places});
        }

    		$('#wizard_container_step_body').html(html);
        
        if (selectorWizardSelectPlace.model.places['destinations']) {
          this.setupDestinationEvents();
        }

    		$('.selector_place').bind('click', function(e) {
    			 //var value = $(this).html();
           var value=$(this).attr('data-place-id');
           var description=$(this).attr('data-place-name');
    			 selectorWizardSelectPlace.controller.placeSelected(value, description);
    		});

    	},

      setupDestinationEvents: function() {
        $('.destination-selector').bind('click', function(){
          selectorWizardSelectPlace.controller.destinationSelectorClick($(this).attr('data-destination-id'));
        });
      }

    }

  }


  return selectorWizardSelectPlace;


}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 38 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0), __webpack_require__(18), __webpack_require__(14),__webpack_require__(12),
         __webpack_require__(2),__webpack_require__(1),
         __webpack_require__(4), __webpack_require__(20), __webpack_require__(6), __webpack_require__(3), __webpack_require__(7),
         __webpack_require__(8), __webpack_require__(5), 
         __webpack_require__(0), __webpack_require__(10),
         __webpack_require__(16), __webpack_require__(15), __webpack_require__(17),
         __webpack_require__(11)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, MemoryDataSource, RemoteDataSource, SelectSelector,commonServices, commonSettings, 
                  commonTranslations, YSDEventTarget, tmpl, i18next, moment) {


  selectorWizardSelectDate = {

    model: {
      events: new YSDEventTarget(),
      configuration: null,      
      requestLanguage: null,
      
      // The min and max date
      minDate: null,
      maxDate: null,

      // Current month start and end date
      startDate: null,
      endDate: null,

      // Related place
      place: null,
      days: null,

      // Action
      action: null, // deliveries / collections / any
      
      addListener: function(type, listener) { /* addListener */
        this.events.addEventListener(type, listener);  
      },
      
      removeListener: function(type, listener) { /* removeListener */
        this.events.removeEventListener(type, listener);     
      },

      removeListeners: function(type) { /* remove listeners*/
       this.events.removeEventListeners(type);
      },

      /**
       * Access the API to get the available pickup days in a month
       */
      loadDays: function(year, month) { 

        this.startDate = moment([year, month - 1]);
        this.endDate = moment(this.startDate).endOf('month');
        var self = this;
        
        var from = this.startDate.format('YYYY-MM-DD');
        var to = this.endDate.format('YYYY-MM-DD');

        // Build the URL
        var url = commonServices.URL_PREFIX + '/api/booking/frontend/dates';
        url += '?from='+from+'&to='+to;
        if (this.place && this.place != '') {
          url += '&place='+ commonSettings.data.encodeData(this.place);
        }
        if (this.action && this.action != '') {
          url += '&action='+this.action;
        }
        if (this.requestLanguage != null) {
          url+='&lang='+this.requestLanguage;
        }
        if (commonServices.apiKey && commonServices.apiKey != '') {
          url += '&api_key='+commonServices.apiKey;
        }   
        // End Point request
        $.ajax({
          type: 'GET',
          url: url,
          dataType: 'json',
          success: function(data, textStatus, jqXHR) {
            self.days = data;
            selectorWizardSelectDate.view.update('loaded_days');
          },
          error: function(data, textStatus, jqXHR) {
            alert(i18next.t('selector.error_loading_data'));
          }
        });
      }


    },

    controller: {

      dateChanged: function() {

        var date = $('#selector_date').datepicker('getDate');
        var dateStr = moment(date).format('DD/MM/YYYY');
        selectorWizardSelectDate.model.events.fireEvent({type: 'date_selected', data: dateStr});

      },

      monthChanged: function(year, month) {
        selectorWizardSelectDate.model.loadDays(year, month);  
      }

    },

    view: {


      init: function() {

        // Setup request language (for API calls)
        selectorWizardSelectDate.model.requestLanguage = commonSettings.language(document.documentElement.lang);
        
        // Load step view
        this.loadStepView();

        // Setup controls
        this.setupControls();

      },

      loadStepView: function() {

        var html = tmpl('select_date_tmpl');
        $('#wizard_container_step_body').html(html);

      },

      setupControls: function() {

        this.setupDateControl();

      },

      setupDateControl: function() {

        // Setup datepicker language
        $.datepicker.setDefaults( $.datepicker.regional[selectorWizardSelectDate.model.requestLanguage || 'es'] );
        var locale = $.datepicker.regional[selectorWizardSelectDate.model.requestLanguage || 'es'];

        // Setup First and last date
        var firstDate = selectorWizardSelectDate.model.minDate;
        var maxDate = selectorWizardSelectDate.model.maxDate;

        // Date
        $('#selector_date').datepicker({
            numberOfMonths:1,
            minDate: firstDate,
            maxDate: maxDate,
            dateFormat: 'dd/mm/yy',
            constraintInput: true,
            beforeShowDay: function(date) {
              if (selectorWizardSelectDate.model.days != null) {
                var idx = selectorWizardSelectDate.model.days.findIndex(function(element){
                            return element == moment(date).format('YYYY-MM-DD');
                          }); 
                if (idx > -1) {
                  return [true];
                }     
                else {
                  return [false];
                }              
              }
              else {
                return [false];
              }
            },
            onChangeMonthYear: function(year, month, instance) {
               selectorWizardSelectDate.controller.monthChanged(year, month);         
            },
            onSelect: function(dateText, inst) {
               selectorWizardSelectDate.controller.dateChanged();
            }
            

          }, locale);
        // Avoid Google Automatic Translation
        $('.ui-datepicker').addClass('notranslate');

        // Load the days
        var now = moment(firstDate, selectorWizardSelectDate.model.configuration.dateFormat).
                   tz(selectorWizardSelectDate.model.configuration.timezone);
        var month = now.format('MM');
        var year = now.format('YYYY');
        selectorWizardSelectDate.model.loadDays(year, month);

      },

      update: function(event) {

        switch (event) {
          case 'loaded_days':
            $('#selector_date').datepicker('refresh');
            setTimeout(function(){
                $('wizard_container_step_header').trigger('click');
            }, 500);
            break;
        }

      }


    }

  }


  return selectorWizardSelectDate;


}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 39 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0), __webpack_require__(18), __webpack_require__(14),__webpack_require__(12),
         __webpack_require__(2),__webpack_require__(1),
         __webpack_require__(4), __webpack_require__(20),
         __webpack_require__(3), __webpack_require__(7), __webpack_require__(6),
         __webpack_require__(8),
         __webpack_require__(5), __webpack_require__(0), __webpack_require__(10),
         __webpack_require__(16), __webpack_require__(15), __webpack_require__(17),
         __webpack_require__(11)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, MemoryDataSource, RemoteDataSource, SelectSelector,commonServices, commonSettings, 
                  commonTranslations, YSDEventTarget, i18next, moment, tmpl) {


  selectorWizardSelectTime = {

    model: {

 	    events: new YSDEventTarget(), // Events 
      configuration: null,   // Engine configuration
      requestLanguage: null, // Request language

      // Times
      times: null, // Possible times (retrieved from Api)
      time: null,  // Selected time

      // Related place and date

      place: null,   // Selected place
      date: null,    // Selected date
      minTime: null, // Min time

      // Action
      action: null, // deliveries / collections / any

	    addListener: function(type, listener) { /* addListener */
	      this.events.addEventListener(type, listener);  
	    },
	    
	    removeListener: function(type, listener) { /* removeListener */
	      this.events.removeEventListener(type, listener);     
	    },

	    removeListeners: function(type) { /* remove listeners*/
	     this.events.removeEventListeners(type);
	    },

      /**
       * Access the API to get the available pickup hours in a date
       */
      loadTimes: function() { 

        var self=this;
        // Build URL
        var url = commonServices.URL_PREFIX + '/api/booking/frontend/times?date='+this.date;
        if (this.place && this.place != '') {
          url += '&place='+commonSettings.data.encodeData(this.place);
        }          
        if (this.action && this.action != '') {
          url += '&action='+this.action;
        }        
        if (this.requestLanguage != null) {
          url+='&lang='+this.requestLanguage;
        }
        if (commonServices.apiKey && commonServices.apiKey != '') {
          url += '&api_key='+commonServices.apiKey;
        }   
        // Request
        $.ajax({
          type: 'GET',
          url: url,
          dataType: 'json',
          success: function(data, textStatus, jqXHR) {
            self.times = data;
            selectorWizardSelectTime.view.update('loaded_times');
          },
          error: function(data, textStatus, jqXHR) {
            alert(i18next.t('selector.error_loading_data'));
          }
        });

      }

    },

    controller: {

    	timeSelected: function(value) {
				selectorWizardSelectTime.model.time = value;
				selectorWizardSelectTime.model.events.fireEvent({type: 'time_selected', data: value});
    	}

    },

    view: {

    	init: function() {

        // Setup request language (for API calls)
        selectorWizardSelectTime.model.requestLanguage = commonSettings.language(document.documentElement.lang);
        selectorWizardSelectTime.model.loadTimes();

    	},

    	update: function(event) {
    		switch (event) {
    				case 'loaded_times':
    				  this.showTimes();
    				  break;
    		}
    	},

    	showTimes: function() {

        // Filter min time
        if (selectorWizardSelectTime.model.minTime) {
          var times = selectorWizardSelectTime.model.times.filter( time => time > selectorWizardSelectTime.model.minTime)
        }
        else {
          var times = selectorWizardSelectTime.model.times;
        }

        // Load the times
    		var html = tmpl('select_time_tmpl')({times: times});
    		$('#wizard_container_step_body').html(html);

    		$('.selector_time').bind('click', function(e) {
    			 var value = $(this).html();
    			 selectorWizardSelectTime.controller.timeSelected(value);
    		});

    	}

    }

  }


  return selectorWizardSelectTime;


}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 40 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0),__webpack_require__(6),
                           __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), 
                           __webpack_require__(7), __webpack_require__(3), __webpack_require__(0), __webpack_require__(5), __webpack_require__(8)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($,  tmpl, commonServices, commonSettings, commonTranslations, moment, i18next) {

        activityOneTimeModel = { // THE activityOneTimeModel

            requestLanguage: null,
            configuration: null,
            id: null,
            activity: null,
            tickets: null,
            buyTickets: null,

            loadActivity: function () { /* Load the activity */
                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/activities/'+activityOneTimeModel.id;
                // == Url params
                var urlParams = null;
                // Language
                if (activityOneTimeModel.requestLanguage != null) {
                   urlParams = '?lang='+activityOneTimeModel.requestLanguage;
                }
                // Api Key
                if (commonServices.apiKey && commonServices.apiKey != '') {
                  if (urlParams == null) {
                    urlParams = '?';
                  }
                  else {
                    urlParams += '&';
                  }
                  urlParams += 'api_key='+commonServices.apiKey;
                } 
                if (urlParams != null) {
                    url += urlParams;
                }
                // == Ajax 
                $.ajax({
                    type: 'GET',
                    url: url,
                    contentType: 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function (data, textStatus, jqXHR) {
                        activityOneTimeModel.activity = data;
                        activityOneTimeView.updateActivity();
                    },
                    error: function (data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorLoadingData'));
                    },
                    complete: function (jqXHR, textStatus) {
                    }

                });
            },

            loadTickets: function() { /* Load the available tickets */

                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/activities/'+this.activity.id+'/tickets';
                // == Url params
                var urlParams = null;
                // Language
                if (activityOneTimeModel.requestLanguage != null) {
                   urlParams = '?lang='+activityOneTimeModel.requestLanguage;
                }
                // Api Key
                if (commonServices.apiKey && commonServices.apiKey != '') {
                  if (urlParams == null) {
                    urlParams = '?';
                  }
                  else {
                    urlParams += '&';
                  }
                  urlParams += 'api_key='+commonServices.apiKey;
                } 
                if (urlParams != null) {
                    url += urlParams;
                }
                // == Ajax 
                $.ajax({
                    type: 'GET',
                    url: url,
                    contentType: 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function (data, textStatus, jqXHR) {
                        activityOneTimeModel.tickets = data;
                        activityOneTimeView.updateTickets();
                    },
                    error: function (data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorLoadingData'));
                    },
                    complete: function (jqXHR, textStatus) {
                    }
                });


            },

            putShoppingCartFreeAccessId: function(value) {
              sessionStorage.setItem('activities_shopping_cart_free_access_id', value);
            },

            getShoppingCartFreeAccessId: function() {
              return sessionStorage.getItem('activities_shopping_cart_free_access_id');
            },

            addToShoppingCart: function() {

                var request =  {
                                  id: this.activity.id,
                                  tickets: this.buyTickets
                               };
                
                var requestJSON = encodeURIComponent(JSON.stringify(request));

                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/add-to-shopping-cart';
                
                var freeAccessId = this.getShoppingCartFreeAccessId();
                if (freeAccessId) {
                  url += '/' + freeAccessId;
                }
                // == Url params
                var urlParams = null;
                // Language
                if (activityOneTimeModel.requestLanguage != null) {
                   urlParams = '?lang='+activityOneTimeModel.requestLanguage;
                }
                // Api Key
                if (commonServices.apiKey && commonServices.apiKey != '') {
                  if (urlParams == null) {
                    urlParams = '?';
                  }
                  else {
                    urlParams += '&';
                  }
                  urlParams += 'api_key='+commonServices.apiKey;
                } 
                if (urlParams != null) {
                    url += urlParams;
                }
                // == Ajax 
                $.ajax({
                    type: 'POST',
                    url : url,
                    data: requestJSON,
                    dataType : 'json',
                    contentType : 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function(data, textStatus, jqXHR) {

                         // Store the shopping cart free access id in the session
                         var free_access_id = activityOneTimeModel.getShoppingCartFreeAccessId();
                         if (free_access_id == null || free_access_id != data.free_access_id) {
                           activityOneTimeModel.putShoppingCartFreeAccessId(data.free_access_id);
                         }

                         window.location.href = commonServices.shoppingCartUrl; 
                    },
                    error: function(data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorUpdatingData'));
                    },
                    complete: function(jqXHR, textStatus) {

                    }

                });

            },

        };

        activityOneTimeController = { // THE activityOneTimeController

            onBtnReservationClick: function() { /* Button reservation click */

              var selectedTickets = false;
              activityOneTimeModel.buyTickets = {};

              if ( $('select[name=selected_tickets_full_mode]').length > 0 ) {
                var rate = $('select[name=selected_tickets_full_mode]').val();;
                var value = (rate == '' ? 0 : 1);
                if (value > 0) {
                  selectedTickets = true;
                  activityOneTimeModel.buyTickets[rate] = value;
                }
              }
              else {
                var quantityRate = $('select.quantity_rate, input[type=hidden].quantity_rate');
                for (idx=0; idx<quantityRate.length; idx++) {
                   var rate = parseInt($(quantityRate[idx]).attr('name').replace('quantity_rate_',''));
                   var value = parseInt($(quantityRate[idx]).val());
                   if (value > 0) {
                       selectedTickets = true;
                       activityOneTimeModel.buyTickets[rate] = value;
                   }
                }
              }

              if (!selectedTickets) {
                  alert(i18next.t('activities.calendarWidget.selectTickets'));
              }
              else {
                  activityOneTimeModel.addToShoppingCart();
              }

            }


        };


        activityOneTimeView = { // THE activityOneTimeView

            init: function() {

                activityOneTimeModel.requestLanguage = commonSettings.language(document.documentElement.lang);
                // Initialize i18next for translations
                i18next.init({  
                                lng: activityOneTimeModel.requestLanguage,
                                resources: commonTranslations
                             }, 
                             function (error, t) {
                                // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                                //jqueryI18next.init(i18next, $);
                                // Localize UI
                                //$('.nav').localize();
                             });
                activityOneTimeView.updateActivity();

            },

            updateActivity: function() { // Update the activity (shows it)

                var result = tmpl('script_one_time_selector')({activity: activityOneTimeModel.activity, i18next: i18next});
                $('#buy_selector').html(result);
                if (activityOneTimeModel.activity && typeof activityOneTimeModel.activity.available !== 'undefined') {
                  if (activityModel.activity.available != 0) {
                    activityOneTimeModel.loadTickets();
                  }
                }

            },

            updateTickets: function() { /* Setup the tickets */

                // Builds the tickets
                if (activityOneTimeModel.activity &&
                    activityOneTimeModel.activity.allow_select_places_for_reservation) {
                  var result = tmpl('script_tickets')({tickets: activityOneTimeModel.tickets});
                }
                else {
                  var result = tmpl('script_fixed_ticket')({tickets: activityOneTimeModel.tickets});
                }
                $('#tickets').html(result);

                $('#btn_reservation').bind('click', function(){
                   activityOneTimeController.onBtnReservationClick();
                });
            }



        };

        ActivityOneTime = function(activity, configuration) {

          this.model = activityOneTimeModel;
          this.controller = activityOneTimeController;
          this.view = activityOneTimeView;

          this.model.activity = activity;
          this.model.configuration = configuration;
          
        };

        return ActivityOneTime;


    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 41 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0),__webpack_require__(6), __webpack_require__(14),__webpack_require__(12),
                                __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), __webpack_require__(3),                       
                                __webpack_require__(0), __webpack_require__(5), __webpack_require__(8)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($,  tmpl, RemoteDataSource, SelectSelector, commonServices, commonSettings, commonTranslations, i18next) {

        activityMultipleDatesModel = { // THE activityMultipleDatesModel

            requestLanguage: null,
            configuration: null,
            activity: null,
            activity_dates: null,
            tickets: null,
            buyTickets: null,
            multipleDatesActivityDateId: null,


            loadActivityDates: function() { /** Load the activity dates **/

                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/activities/'+activityMultipleDatesModel.activity.id+'/dates';
                // == Url params
                var urlParams = [];
                // Language
                if (activityMultipleDatesModel.requestLanguage != null) {
                    urlParams.push('lang='+activityMultipleDatesModel.requestLanguage);
                }
                // Api Key
                if (commonServices.apiKey && commonServices.apiKey != '') {
                  urlParams.push('api_key='+commonServices.apiKey);
                }  
                // Parameters
                if (urlParams.length > 0) {
                  url += '?';
                  url += urlParams.join('&');
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    contentType: 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function (data, textStatus, jqXHR) {
                        activityMultipleDatesModel.activity_dates = data;
                        activityMultipleDatesView.updateActivityDates();
                    },
                    error: function (data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorLoadingData'));
                    },
                    complete: function (jqXHR, textStatus) {
                    }

                });

            },

            loadTickets: function() { /* Load the available tickets */

                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/activities/' + this.activity.id + '/tickets';
                url += '?activity_date_id='+this.multipleDatesActivityDateId;
                // Language
                if (activityMultipleDatesModel.requestLanguage != null) {
                    url += '&lang='+activityMultipleDatesModel.requestLanguage;
                }
                // Api Key
                if (commonServices.apiKey && commonServices.apiKey != '') {
                  url += '&api_key='+commonServices.apiKey;
                }    

                $.ajax({
                    type: 'GET',
                    url: url,
                    contentType: 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function (data, textStatus, jqXHR) {
                        activityMultipleDatesModel.tickets = data;
                        activityMultipleDatesView.updateTickets();
                    },
                    error: function (data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorLoadingData'));
                    },
                    complete: function (jqXHR, textStatus) {
                    }
                });


            },

            putShoppingCartFreeAccessId: function(value) {
              sessionStorage.setItem('activities_shopping_cart_free_access_id', value);
            },

            getShoppingCartFreeAccessId: function() {
              return sessionStorage.getItem('activities_shopping_cart_free_access_id');
            },

            addToShoppingCart: function() {

                var request = {
                        id: this.activity.id,
                        activity_date_id: this.multipleDatesActivityDateId,
                        tickets: this.buyTickets
                    };

                var requestJSON = encodeURIComponent(JSON.stringify(request));

                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/add-to-shopping-cart';               
                var freeAccessId = this.getShoppingCartFreeAccessId();
                if (freeAccessId) {
                  url += '/' + freeAccessId;
                }        
                // == Url params
                var urlParams = null;
                // Language
                if (activityMultipleDatesModel.requestLanguage != null) {
                   urlParams = '?lang='+activityMultipleDatesModel.requestLanguage;
                }
                // Api Key
                if (commonServices.apiKey && commonServices.apiKey != '') {
                  if (urlParams == null) {
                    urlParams = '?';
                  }
                  else {
                    urlParams += '&';
                  }
                  urlParams += 'api_key='+commonServices.apiKey;
                } 
                if (urlParams != null) {
                    url += urlParams;
                }
                // == Ajax 
                $.ajax({
                    type: 'POST',
                    url : url,
                    data: requestJSON,
                    dataType : 'json',
                    contentType : 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function(data, textStatus, jqXHR) {

                         // Store the shopping cart free access id in the session
                         var free_access_id = activityMultipleDatesModel.getShoppingCartFreeAccessId();
                         if (free_access_id == null || free_access_id != data.free_access_id) {
                           activityMultipleDatesModel.putShoppingCartFreeAccessId(data.free_access_id);
                         }

                         window.location.href = commonServices.shoppingCartUrl; 
                    },
                    error: function(data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorUpdatingData'));
                    },
                    complete: function(jqXHR, textStatus) {

                    }

                });

            }
        };

        activityMultipleDatesController = { // THE activityMultipleDatesController

            onMultipleDatesDateSelected: function() { /* Multiple dates select date */
              activityMultipleDatesModel.multipleDatesActivityDateId = $('#activity_date_id').val();
              activityMultipleDatesModel.loadTickets();
            },

            onBtnReservationClick: function() { /* Button reservation click */

              var selectedTickets = false;
              activityMultipleDatesModel.buyTickets = {};

              if ( $('select[name=selected_tickets_full_mode]').length > 0 ) {
                var rate = $('select[name=selected_tickets_full_mode]').val();;
                var value = (rate == '' ? 0 : 1);
                if (value > 0) {
                  selectedTickets = true;
                  activityMultipleDatesModel.buyTickets[rate] = value;
                }
              }
              else {
                var quantityRate = $('select.quantity_rate, input[type=hidden].quantity_rate');
                for (idx=0; idx<quantityRate.length; idx++) {
                   var rate = parseInt($(quantityRate[idx]).attr('name').replace('quantity_rate_',''));
                   var value = parseInt($(quantityRate[idx]).val());
                   if (value > 0) {
                       selectedTickets = true;
                       activityMultipleDatesModel.buyTickets[rate] = value;
                   }
                }
              }

              if (!selectedTickets) {
                  alert(i18next.t('activities.calendarWidget.selectTickets'));
              }
              else {
                  activityMultipleDatesModel.addToShoppingCart();
              }

            }


        };


        activityMultipleDatesView = { // THE activityMultipleDatesView

            init: function() {

                activityMultipleDatesModel.requestLanguage = commonSettings.language(document.documentElement.lang);
                // Initialize i18next for translations
                i18next.init({  
                                lng: activityMultipleDatesModel.requestLanguage,
                                resources: commonTranslations
                             }, 
                             function (error, t) {
                                // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                                //jqueryI18next.init(i18next, $);
                                // Localize UI
                                //$('.nav').localize();
                             });
                activityMultipleDatesView.updateActivity();

            },

            updateActivity: function() { // Update the activity (shows it)

                // Builds the list
                var result = tmpl('script_multiple_dates_selector')({activity: activityMultipleDatesModel.activity});
                $('#buy_selector').html(result);
                // Load the activity dates
                activityMultipleDatesModel.loadActivityDates();

            },

            updateActivityDates: function() { /** Update activity dates **/ 

                console.log('updateActivityDates');

                $('select[name=activity_date_id]').append($('<option>', {
                    value: '',
                    text : i18next.t('activities.multipleDates.selectDate'),
                    class: 'form-control'
                }));

                if (activityMultipleDatesModel.activity_dates != null) {
                  for (date in activityMultipleDatesModel.activity_dates) {  
                    var classOption = 'form-control';
                    var text = activityMultipleDatesModel.activity_dates[date].description
                    var optionData = { value: activityMultipleDatesModel.activity_dates[date].id
                                     };
                    if (activityMultipleDatesModel.activity_dates[date].available == 0) {
                        classOption += ' bg-danger';
                        optionData.disabled = 'disabled';
                        text += ' ( ';
                        text += i18next.t('activities.calendarWidget.fullPlaces'); 
                        text += ' )';
                    } 
                    else if (activityMultipleDatesModel.activity_dates[date].available == 2) {
                        classOption += ' bg-warning';
                        if (activityMultipleDatesModel.activity.allow_select_places_for_reservation) {
                            text += ' ( ';
                            text += i18next.t('activities.calendarWidget.fewPlacesWarning');
                            text += ' )';
                        }
                        else {
                            text += ' ( ';
                            text += i18next.t('activities.calendarWidget.fewNoPlacesWarning');
                            text += ' )';            
                        }
                    }
                    optionData.class = classOption;     
                    optionData.text = text;
                    $('select[name=activity_date_id]').append($('<option>', optionData));                    
                  }
                  $('#activity_date_id').val('');
                }

                $('#activity_date_id').bind('change', function() {
                    if ($(this).val() != '') {
                        activityMultipleDatesController.onMultipleDatesDateSelected();
                    }
                    else {
                        $('#tickets').empty();
                    }
                });

            },

            updateTickets: function() { /* Setup the tickets */

                // Builds the tickets
                if (activityMultipleDatesModel.activity &&
                    activityMultipleDatesModel.activity.allow_select_places_for_reservation) {
                  var result = tmpl('script_tickets')({tickets: activityMultipleDatesModel.tickets});
                }
                else {
                  var result = tmpl('script_fixed_ticket')({tickets: activityMultipleDatesModel.tickets});
                }

                $('#tickets').html(result);
                $('#btn_reservation').bind('click', function(){
                   activityMultipleDatesController.onBtnReservationClick();
                });
            }



        };

        var ActivityMultipleDates = function(activity, configuration) {

          this.model = activityMultipleDatesModel;
          this.controller = activityMultipleDatesController;
          this.view = activityMultipleDatesView;

          this.model.activity = activity;
          this.model.configuration = configuration;
        };

        return ActivityMultipleDates;


    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 42 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0),__webpack_require__(6), __webpack_require__(14),__webpack_require__(12), 
                          __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), __webpack_require__(7),__webpack_require__(3),
                          __webpack_require__(0), 
                          __webpack_require__(10), __webpack_require__(16), __webpack_require__(15), __webpack_require__(17),
                          __webpack_require__(11), __webpack_require__(5), __webpack_require__(8)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($,  tmpl, RemoteDataSource, SelectSelector, commonServices, commonSettings, 
             commonTranslations, moment, i18next) {

        activityCyclicModel = { // THE activityCyclicModel

            requestLanguage: null,
            configuration: null,
            activity: null,
            year: null,
            month: null,
            tickets: null,
            buyTickets: null,
            performances: null,
            calendarBuilt: false,
            cyclicDate: null,
            cyclicTurns: null,
            cyclicTurn: null,

            // ----------- API


            loadPerformances: function() { /* Load the activity performances */
                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/activities/' + activityCyclicModel.activity.id +
                          '/performances';
                url += '?year='+this.year+'&month='+this.month;
                if (activityCyclicModel.requestLanguage != null) {
                  url += '&lang='+activityCyclicModel.requestLanguage;
                }
                if (commonServices.apiKey && commonServices.apiKey != '') {
                  url += '&api_key='+commonServices.apiKey;
                }                 
                $.ajax({
                    type: 'GET',
                    url: url,
                    async: false,
                    contentType: 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function (data, textStatus, jqXHR) {
                        activityCyclicModel.performances = data;
                        if (!activityCyclicModel.calendarBuilt) {
                            activityCyclicView.updateCalendar();
                            activityCyclicModel.calendarBuilt = true;
                        }
                        else {
                            $("#datepicker").datepicker('refresh');
                        }
                    },
                    error: function (data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorLoadingData'));
                    },
                    complete: function (jqXHR, textStatus) {                  
                    }

                });            
            },   

            loadTurns: function() { /* Load the turns*/

                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/activities/'+activityCyclicModel.activity.id+'/turns';
                url += '?date='+this.cyclicDate;
                // Language
                if (activityCyclicModel.requestLanguage != null) {
                    url += '&lang='+activityCyclicModel.requestLanguage;
                }
                // Api Key
                if (commonServices.apiKey && commonServices.apiKey != '') {
                  url += '&api_key='+commonServices.apiKey;
                }                  
                $.ajax({
                    type: 'GET',
                    url: url,
                    async: false,
                    contentType: 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function (data, textStatus, jqXHR) {
                        activityCyclicModel.cyclicTurns = data;
                        activityCyclicView.updateActivityCyclicTurns();
                    },
                    error: function (data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorLoadingData'));
                    },
                    complete: function (jqXHR, textStatus) {                  
                    }

                });                  

            },

            loadTickets: function() { /* Load the available tickets */

                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/activities/' + this.activity.id + '/tickets';
                url += '?date='+this.cyclicDate+'&turn='+this.cyclicTurn;
                // Language
                if (activityCyclicModel.requestLanguage != null) {
                    url += '&lang='+activityCyclicModel.requestLanguage;
                }
                // Api Key
                if (commonServices.apiKey && commonServices.apiKey != '') {
                  url += '&api_key='+commonServices.apiKey;
                }  

                $.ajax({
                    type: 'GET',
                    url: url,
                    contentType: 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function (data, textStatus, jqXHR) {
                        activityCyclicModel.tickets = data;
                        activityCyclicView.updateTickets();
                    },
                    error: function (data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorLoadingData'));
                    },
                    complete: function (jqXHR, textStatus) {
                    }
                });


            },

            putShoppingCartFreeAccessId: function(value) {
              sessionStorage.setItem('activities_shopping_cart_free_access_id', value);
            },

            getShoppingCartFreeAccessId: function() {
              return sessionStorage.getItem('activities_shopping_cart_free_access_id');
            },

            addToShoppingCart: function() {

                var request = {
                        id: this.activity.id,
                        date: this.cyclicDate,
                        turn: this.cyclicTurn,
                        tickets: this.buyTickets
                    };

                var requestJSON = encodeURIComponent(JSON.stringify(request));

                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/add-to-shopping-cart';
                
                var freeAccessId = this.getShoppingCartFreeAccessId();
                if (freeAccessId) {
                  url += '/' + freeAccessId;
                }
                // == Url params
                var urlParams = null;
                // Language
                if (activityCyclicModel.requestLanguage != null) {
                   urlParams = '?lang='+activityCyclicModel.requestLanguage;
                }
                // Api Key
                if (commonServices.apiKey && commonServices.apiKey != '') {
                  if (urlParams == null) {
                    urlParams = '?';
                  }
                  else {
                    urlParams += '&';
                  }
                  urlParams += 'api_key='+commonServices.apiKey;
                } 
                if (urlParams != null) {
                    url += urlParams;
                }
                // == Ajax 
                $.ajax({
                    type: 'POST',
                    url : url,
                    data: requestJSON,
                    dataType : 'json',
                    contentType : 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function(data, textStatus, jqXHR) {

                         // Store the shopping cart free access id in the session
                         var free_access_id = activityCyclicModel.getShoppingCartFreeAccessId();
                         if (free_access_id == null || free_access_id != data.free_access_id) {
                           activityCyclicModel.putShoppingCartFreeAccessId(data.free_access_id);
                         }

                         window.location.href = commonServices.shoppingCartUrl; 
                    },
                    error: function(data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorUpdatingData'));
                    },
                    complete: function(jqXHR, textStatus) {

                    }

                });

            }
            
        };

        activityCyclicController = { // THE activityCyclicController

            onCyclicDateChanged: function() { /* Cyclic activity date changed */
              activityCyclicModel.cyclicDate = $('#datepicker').val(); // String representation of the date (format dd/MM/yyyy)
              activityCyclicModel.loadTurns();
            },

            onCyclicTurnChanged: function() { /* Cyclic activity turn changed */
              activityCyclicModel.cyclicTurn = $('input[name=turn]:checked').val();
              activityCyclicModel.loadTickets();
            },

            onBtnReservationClick: function() { /* Button reservation click */

              var selectedTickets = false;
              activityCyclicModel.buyTickets = {};

              if ( $('select[name=selected_tickets_full_mode]').length > 0 ) {
                var rate = $('select[name=selected_tickets_full_mode]').val();
                var value = (rate == '' ? 0 : 1);
                if (value > 0) {
                  selectedTickets = true;
                  activityCyclicModel.buyTickets[rate] = value;
                }
              }
              else {
                var quantityRate = $('select.quantity_rate, input[type=hidden].quantity_rate');
                for (idx=0; idx<quantityRate.length; idx++) {
                   var rate = parseInt($(quantityRate[idx]).attr('name').replace('quantity_rate_',''));
                   var value = parseInt($(quantityRate[idx]).val());
                   if (value > 0) {
                       selectedTickets = true;
                       activityCyclicModel.buyTickets[rate] = value;
                   }
                }
              }

              if (!selectedTickets) {
                  alert(i18next.t('activities.calendarWidget.selectTickets'));
              }
              else {
                  activityCyclicModel.addToShoppingCart();
              }

            }


        };


        activityCyclicView = { // THE activityCyclicView

            init: function() {

                activityCyclicModel.requestLanguage = commonSettings.language(document.documentElement.lang);
                // Initialize i18next for translations
                i18next.init({  
                                lng: activityCyclicModel.requestLanguage,
                                resources: commonTranslations
                             }, 
                             function (error, t) {
                                // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                                //jqueryI18next.init(i18next, $);
                                // Localize UI
                                //$('.nav').localize();
                             });
                activityCyclicModel.loadPerformances();

            },

            updateCalendar: function() {

                // Builds the calendar
                var result = tmpl('script_cyclic_calendar')({activity_id: activityCyclicModel.activity.id});
                $('#buy_selector').html(result);
                $.datepicker.setDefaults( $.datepicker.regional[activityCyclicModel.requestLanguage] );
                $.datepicker.regional[activityCyclicModel.requestLanguage].dateFormat = 'dd/mm/yy';  
                $("#datepicker").datepicker({
                    minDate: new Date(),
                    dateFormat: 'dd/mm/yy',
                    beforeShowDay: function(date) {
                       var dateStr = moment(date).format('YYYY-MM-DD');
                       if (typeof activityCyclicModel.performances[dateStr] !== 'undefined') {
                         if (activityCyclicModel.performances[dateStr] == 1) {
                            return [true];
                         }
                         else if (activityCyclicModel.performances[dateStr] == 2) {
                            return [true, 'bg-warning text-warning'];
                         }
                         else if (activityCyclicModel.performances[dateStr] == 0) {   
                            return [false, 'bg-danger text-danger'];
                         }
                       }
                       else {
                         return [false];
                       }
                    },
                    onChangeMonthYear: function(year, month, instance) {
                        console.log(year+'-'+month);
                        activityCyclicModel.year = year;
                        activityCyclicModel.month = month;
                        activityCyclicModel.loadPerformances();
                    }                    
                });   
                // Avoid Google Automatic Translation
                $('.ui-datepicker').addClass('notranslate');                
                $('#datepicker').datepicker('option', 'dateFormat', 'dd/mm/yy');
                $('#datepicker').bind('change', function() {
                    activityCyclicController.onCyclicDateChanged();
                }); 

            },

            updateActivityCyclicTurns: function() { /* Setup the turns */
                // Builds the turns
                var result = tmpl('script_cyclic_turns')({turns: activityCyclicModel.cyclicTurns, 
                                                          isEmptyTurns: $.isEmptyObject(activityCyclicModel.cyclicTurns)});
                $('#turns').html(result);

                $('input[name=turn]').bind('change', function() {
                    activityCyclicController.onCyclicTurnChanged();
                });

                $('#tickets').html('');

            },

            updateTickets: function() { /* Setup the tickets */

                // Builds the tickets
                if (activityCyclicModel.activity &&
                    activityCyclicModel.activity.allow_select_places_for_reservation) {
                  var result = tmpl('script_tickets')({tickets: activityCyclicModel.tickets});
                }
                else {
                  var result = tmpl('script_fixed_ticket')({tickets: activityCyclicModel.tickets});
                }

                $('#tickets').html(result);
                $('#btn_reservation').bind('click', function(){
                   activityCyclicController.onBtnReservationClick();
                });
            }



        };

        return function ActivityCyclic(activity, configuration, month, year) {

          this.model = activityCyclicModel;
          this.controller = activityCyclicController;
          this.view = activityCyclicView;

          this.model.activity = activity;
          this.model.configuration = configuration;
          this.model.month = month;
          this.model.year = year;

        };


    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 43 */
/***/ (function(module, exports, __webpack_require__) {

Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0), __webpack_require__(3), __webpack_require__(6), __webpack_require__(23),
        __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), __webpack_require__(9),
        __webpack_require__(5), __webpack_require__(0), __webpack_require__(10),
        __webpack_require__(11),__webpack_require__(19)]; (function($, i18next, tmpl, select2,
             commonServices, commonSettings, commonTranslations, commonLoader) {

        model = { // THE MODEL

            requestLanguage: null,
            configuration: null,
            orderFreeAccessId: null,
            order: null,
            sales_process: null,

            /**
             * Load settings
             */
            loadSettings: function() {
                commonSettings.loadSettings(function(data){
                  model.configuration = data;
                  view.init();
                });
            },  

            // ------------ Product information detail ------------------------

            getUrlVars : function() {
              var vars = [], hash;
              var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
              for(var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
              }
              return vars;
            },

            extractVariables: function() { // Load variables from the request

              var url_vars = this.getUrlVars();
              this.orderFreeAccessId = decodeURIComponent(url_vars['id']);

            },

            // ----------------- Reservation ------------------------------

            getOrderFreeAccessId: function() { /* Get the order id */
              return sessionStorage.getItem('order_free_access_id');
            },

            setOrderFreeAccessId: function(orderFreeAccessId) { /* Set the order id */
              sessionStorage.setItem('order_free_access_id', orderFreeAccessId);
            },

            /**
             * Load the reservation
             */
            loadOrder: function() { 

               var orderId = this.orderFreeAccessId;

               if (orderId == '') {
                 orderId = this.orderFreeAccessId = this.getOrderFreeAccessId();
               }

               // Build the URL
               var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/order/' + orderId;
               var urlParams = [];
               // Language
               if (this.requestLanguage != null) {
                 urlParams.push('lang='+this.requestLanguage);
               }
               // Api Key
               if (commonServices.apiKey && commonServices.apiKey != '') {
                 urlParams.push('api_key='+commonServices.apiKey);
               } 
               if (urlParams.length > 0) {
                  url += '?';
                  url += urlParams.join('&');
               }

               // == Ajax

               // Action to the URL
               $.ajax({
                       type: 'GET',
                       url : url,
                       dataType : 'json',
                       contentType : 'application/json; charset=utf-8',
                       crossDomain: true,
                       success: function(data, textStatus, jqXHR) {

                         if (model.requestLanguage != data.customer_language &&
                             data.customer_language != null &&
                             data.customer_language != '') {
                           window.location.href = data.customer_language + commonServices.orderUrl.startsWith('/') ? '' : '/' +
                                                  commonServices.orderUrl + '?id=' + data.free_access_id;
                         }
                         else {
                           model.order = data;
                           view.updateOrder();
                         }

                       },
                       error: function(data, textStatus, jqXHR) {

                         alert(i18next.t('activities.common.errorLoadingData'));

                       },
                       complete: function(jqXHR, textStatus) {
                         commonLoader.hide();
                         $('#content').show();
                         $('#sidebar').show();
                       }
                  });
            },

            /**
             * Pay order
             */
            pay: function(paymentAmount, paymentMethodId) {
  

                var data = {id: this.orderFreeAccessId,
                            payment: paymentAmount,
                            payment_method_id: paymentMethodId};

                // Commit the form to connect mybooking            
                $.form(commonServices.URL_PREFIX + '/reserva-actividades/pagar', data, 'POST').submit();

            },
            /***
             * Update order
             */
            update: function() {

                var order = $('form[name=order_information_form]').formParams(false);
                var order_item_customers = order['order_item_customers'];
                delete order['order_item_customers'];
                order['order_item_customers'] = [];
                for (item in order_item_customers) {
                    if (typeof order_item_customers[item].customer_allergies != 'undefined') {
                      if (order_item_customers[item].customer_allergies == 'on') {
                        order_item_customers[item].customer_allergies = true;
                      }
                      else {
                        order_item_customers[item].customer_allergies = false;
                      }
                    }
                    if (typeof order_item_customers[item].customer_intolerances != 'undefined') {
                      if (order_item_customers[item].customer_intolerances == 'on') {
                        order_item_customers[item].customer_intolerances = true;
                      }
                      else {
                        order_item_customers[item].customer_intolerances = false;
                      }
                    }
                    if (typeof order_item_customers[item].customer_slight_injuries != 'undefined') {
                      if (order_item_customers[item].customer_slight_injuries == 'on') {
                        order_item_customers[item].customer_slight_injuries = true;
                      }
                      else {
                        order_item_customers[item].customer_slight_injuries = false;
                      }
                    }
                    if (typeof order_item_customers[item].customer_diseases != 'undefined') {
                      if (order_item_customers[item].customer_diseases == 'on') {
                        order_item_customers[item].customer_diseases = true;
                      }
                      else {
                        order_item_customers[item].customer_diseases = false;
                      }
                    }    
                    
                    if (typeof order_item_customers[item].customer_experience_tecnical_course != 'undefined') {
                      if (order_item_customers[item].customer_experience_tecnical_course == 'true') {
                        order_item_customers[item].customer_experience_tecnical_course = true;
                      }
                      else {
                        order_item_customers[item].customer_experience_tecnical_course = false;
                      }
                    }    
                    if (typeof order_item_customers[item].customer_experience_activities != 'undefined') {
                      if (order_item_customers[item].customer_experience_activities == 'true') {
                        order_item_customers[item].customer_experience_activities = true;
                      }
                      else {
                        order_item_customers[item].customer_experience_activities = false;
                      }
                    }                                     
                    order['order_item_customers'].push(order_item_customers[item]);
                }
                var orderJSON = encodeURIComponent(JSON.stringify(order));

                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/order/' + this.orderFreeAccessId;
                
                // Language
                if (model.requestLanguage != null) {
                    url += '?lang='+model.requestLanguage;
                }
                // Api Key
                if (commonServices.apiKey && commonServices.apiKey != '') {
                  url += '&api_key='+commonServices.apiKey;
                } 

                $.ajax({
                    type: 'PUT',
                    url : url,
                    data: orderJSON,
                    dataType : 'json',
                    contentType : 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function(data, textStatus, jqXHR) {
                        model.order = data;
                        view.updateOrder();
                        view.update('order_updated');
                    },
                    error: function(data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorUpdatingData'));
                    }
                });

            },
           /***
            * Cancel reservation
            */
            cancelReservation: function() {

                var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/order/' + this.orderFreeAccessId+'/cancel';
                var urlParams = [];
                // Language
                if (model.requestLanguage != null) {
                   urlParams.push('lang='+model.requestLanguage);
                }
                // Api Key
                if (commonServices.apiKey && commonServices.apiKey != '') {
                   urlParams.push('api_key='+commonServices.apiKey);
                } 
                if (urlParams.length > 0) {
                  url += '?';
                  url += urlParams.join('&');
                }

                $.ajax({
                    type: 'POST',
                    url : url,
                    contentType : 'application/json; charset=utf-8',
                    crossDomain: true,
                    success: function(data, textStatus, jqXHR) {
                        model.order = data;
                        view.update('order_canceled')
                    },
                    error: function(data, textStatus, jqXHR) {
                        alert(i18next.t('activities.common.errorUpdatingData'));
                    }
                });

            }

        };

        controller = { // THE CONTROLLER

            /**
             * Update order button click
             */
            btnUpdateClick: function() {
                model.update();
            },
            btnCancelReservationClick: function(){
                if (confirm(i18next.t('activities.myReservation.cancelReservationConfirm'))) {
                  model.cancelReservation();
                }
            }

        };

        view = { // THE VIEW

            init: function() {
                model.requestLanguage = commonSettings.language(document.documentElement.lang);                
 
                // Initialize i18next for translations
                i18next.init({  
                                lng: model.requestLanguage,
                                resources: commonTranslations
                             }, 
                             function (error, t) {
                             });

                // Setup UI          
                model.extractVariables();
                commonLoader.show();
                model.loadOrder();
            },

            updateOrder: function() {

              // Check if the order can be paid
              var canPay = (model.order.can_pay_deposit || model.order.can_pay_pending || model.order.can_pay_total);
              var paymentAmount = 0;
              var payment = null;
              if (canPay) {
                if (model.order.can_pay_deposit) {
                   paymentAmount = model.order.deposit_payment_amount;
                   payment = 'deposit';
                }
                else if (model.order.can_pay_pending) {
                  paymentAmount = model.order.pending_payment_amount;
                  payment = 'pending';
                }
                else {
                   paymentAmount = model.order.total_payment_amount;
                   payment = 'total';
                }           
              }

              // Build the template
              var reservationInfo = tmpl('script_order')(
                  {canPay: canPay,
                   paymentAmount: paymentAmount, 
                   payment: payment,
                   i18next: i18next,
                   order: model.order, 
                   configuration: model.configuration});
              $('#reservation_detail').html(reservationInfo);
              // Country selector
              $countrySelector = $('form[name=order_information_form] select[name=customer_address\\[country\\]]');
              if ($countrySelector.length > 0 && typeof model.order.address_country !== 'undefined') {
                var countries = i18next.t('common.countries', {returnObjects: true });
                if (countries instanceof Object) {
                  var countryCodes = Object.keys(countries);
                  var countriesArray = countryCodes.map(function(value){ 
                                          return {id: value, text: countries[value]};
                                       });
                } else {
                  var countriesArray = [];
                }
                $countrySelector.select2({
                  width: '100%',
                  theme: 'bootstrap4',                  
                  data: countriesArray
                });
                if (model.order.address_country !== null && model.order.address_country !== '') {
                  $countrySelector.val(model.order.address_country);
                  $countrySelector.trigger('change');
                }
              }

              this.setupEvents();

            },

            setupEvents: function() {
                // Payment
                $('#btn_pay').bind('click', function(){
                    controller.btnPayClick();
                });
                // Upate order
                $('#btn_update_order').bind('click', function(){
                    controller.btnUpdateClick();
                });
                // Payment validation
                this.setupPaymentFormValidation();
                // Cancel reservation
                $('#btn_cancel_reservation').bind('click', function(){
                    controller.btnCancelReservationClick();
                });
            },

            setupPaymentFormValidation: function() {

                $('form[name=payment_form]').validate(
                  {

                      submitHandler: function(form) {
                          $('#reservation_error').hide();
                          $('#reservation_error').html('');
                          
                          // Payment amount
                          var paymentAmount = null;
                          if (model.order.can_pay_total) {
                            paymentAmount = 'total';
                          }
                          else if (model.order.can_pay_pending) {
                            paymentAmount = 'pending';
                          }
                          else if (model.order.can_pay_deposit) {
                             paymentAmount = 'deposit';
                          }                               
                          
                          // Payment method
                          var paymentMethod = null;
                          if ($('input[name=payment_method_value]').length == 1) { // Just 1 payment method
                            paymentMethod = $('input[name=payment_method_value]').val();
                          }
                          else { // Multiple payment methods
                            paymentMethod = $('input[name=payment_method_value]:checked').val();
                          }

                          // Do pay
                          if (paymentMethod && paymentAmount) {
                            model.pay(paymentAmount, paymentMethod);
                          }
                          return false;
                      },

                      invalidHandler : function (form, validator) {
                          $('#payment_error').html(i18next.t('activities.payment.errors'));
                          $('#payment_error').show();
                      },

                      rules : {

                          'payment_method_value': 'required'

                      },

                      messages : {

                          'payment_method_value': i18next.t('activities.payment.paymentMethodNotSelected')

                      },

                      errorPlacement: function (error, element) {
                          error.insertAfter(document.getElementById('payment_method_select_error'));
                      },

                      errorClass : 'form-reservation-error'

                  }
              );

            },

            update: function(action) {
                switch (action) {
                    case 'order_updated':
                        alert(i18next.t('activities.common.dataUpdateOk'));
                        break;
                    case 'order_canceled':
                        this.updateOrder();
                        alert(i18next.t('activities.common.dataUpdateOk'));
                        break;
                }
            }

        };

        model.loadSettings();

    }).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);

/***/ }),
/* 44 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(0);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var moment_timezone__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(7);
/* harmony import */ var moment_timezone__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(moment_timezone__WEBPACK_IMPORTED_MODULE_1__);
/**
 * Bundle that creates mybooking-engine-bundle.js.
 *
 * It is a reduced library created for mybooking WordPress Plugin
 *
 * It requires the following libraries to be loaded:
 *
 * - jquery
 * - jquery-ui
 *
 */



// All modules are exposed if the next line is commented
//require('./lib/require.js');

// Jquery plugins
__webpack_require__(5);
__webpack_require__(10);
__webpack_require__(15);
__webpack_require__(16);
__webpack_require__(17);
__webpack_require__(45);
__webpack_require__(46);
__webpack_require__(11);
__webpack_require__(19);
__webpack_require__(21);
__webpack_require__(8);

// SUPPORT
__webpack_require__(3);
__webpack_require__(31);
__webpack_require__(23);
__webpack_require__(27);

// Yurak Sisa Dream Libraries
__webpack_require__(20);
__webpack_require__(32);
__webpack_require__(28);
__webpack_require__(33);
__webpack_require__(34);
__webpack_require__(35);
__webpack_require__(6);
__webpack_require__(18);
__webpack_require__(14);
__webpack_require__(12);
__webpack_require__(29);
__webpack_require__(24);

// Project common library
__webpack_require__(2);
__webpack_require__(1);
__webpack_require__(4);
__webpack_require__(9);

// == Contact module

jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function() {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('mybooking-contact-widget') &&
        jquery__WEBPACK_IMPORTED_MODULE_0___default()('form[name=widget_contact_form]').length) {
        __webpack_require__(47);
    }
});

// == Renting module

jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function() {
    if ( jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('mybooking-custom-selector') &&
         jquery__WEBPACK_IMPORTED_MODULE_0___default()('form[name=custom_search_form]').length) {
        __webpack_require__(36);        
    }
});

// Page with selector widget JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('mybooking-selector-widget') &&
        jquery__WEBPACK_IMPORTED_MODULE_0___default()('form[name=widget_search_form]').length) {
        __webpack_require__(49);
    }
});

// Page with selector wizard JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('mybooking-selector-wizard') &&
        jquery__WEBPACK_IMPORTED_MODULE_0___default()('form[name=wizard_search_form]').length) {
        __webpack_require__(37);
        __webpack_require__(38);   
        __webpack_require__(39);             
        __webpack_require__(26);
        __webpack_require__(50);
    }
});

// Page choose_product JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('choose_product')) {
        __webpack_require__(22);  
        __webpack_require__(13);
        __webpack_require__(51);
    }
});

// Page choose_extras JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('choose_extras')) {
        __webpack_require__(22);    
        __webpack_require__(13);             
        __webpack_require__(52);
    }
});

// Page complete JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('complete')) {
        __webpack_require__(22);      
        __webpack_require__(13);           
        __webpack_require__(30);   
        __webpack_require__(53);
    }
});

// Page summary JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('summary')) {
        __webpack_require__(13);         
        __webpack_require__(54);
    }
});

// Page reservation JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('reservation')) {
        __webpack_require__(13);         
        __webpack_require__(55);
    }
});

// == Page login
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function() {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('mybooking_login')) {
        __webpack_require__(30);
    }
});

// == Product renting

// Page with product selector widget
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('mybooking-product') &&
        jquery__WEBPACK_IMPORTED_MODULE_0___default()('form[name=search_form]').length) {
        __webpack_require__(56);     
        __webpack_require__(13);            
        __webpack_require__(57);
    }
});

// == Activities module

// Activity Search JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function() {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('mybooking-activity-search')) {
        __webpack_require__(58);
    }
});

// Activity Page  JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('mybooking-activity')) {
        __webpack_require__(40);
        __webpack_require__(41);
        __webpack_require__(42);
        __webpack_require__(59);
    }
});

// Activities Shopping Cart Page  JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('mybooking-activity-shopping-cart')) {
        __webpack_require__(60);
    }
});

// Activities Summary Page  JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('mybooking-activity-summary')) {
        __webpack_require__(43);
    }
});

// Activities Order Page  JS
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(function () {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('mybooking-activity-order')) {
        __webpack_require__(43);
    }
});

// Export modules to be able to be used as a Library
//
var customSelector = __webpack_require__(36);
var SelectorRent = __webpack_require__(25);
var rentEngineMediator = __webpack_require__(13);
var tmpl = __webpack_require__(6);
var formatter = __webpack_require__(29);

/* harmony default export */ __webpack_exports__["default"] = ({
    'rent': {
       'customSelector': customSelector,
       'SelectorRent': SelectorRent,
       'rentEngineMediator': rentEngineMediator
    },
    'utils': {
       'tmpl': tmpl,
       'formatter': formatter,
    }
});



/***/ }),
/* 45 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function($){
    $.datepicker.regional['fr'] = {
        closeText: "Fermer",
				prevText: "Précédent",
				nextText: "Suivant",
				currentText: "Aujourd'hui",
				monthNames: [ "janvier", "février", "mars", "avril", "mai", "juin",
					"juillet", "août", "septembre", "octobre", "novembre", "décembre" ],
				monthNamesShort: [ "janv.", "févr.", "mars", "avr.", "mai", "juin",
					"juil.", "août", "sept.", "oct.", "nov.", "déc." ],
				dayNames: [ "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi" ],
				dayNamesShort: [ "dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam." ],
				dayNamesMin: [ "D","L","M","M","J","V","S" ],
				weekHeader: "Sem.",
				dateFormat: "dd/mm/yy",
				firstDay: 1,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ""};
    $.datepicker.setDefaults($.datepicker.regional['fr']);
})(jQuery);


/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 46 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {(function($){
    $.datepicker.regional['de'] = {
        closeText: "Schließen",
        prevText: "&#x3C;Zurück",
        nextText: "Vor&#x3E;",
        currentText: "Heute",
        monthNames: [ "Januar","Februar","März","April","Mai","Juni",
        "Juli","August","September","Oktober","November","Dezember" ],
        monthNamesShort: [ "Jan","Feb","Mär","Apr","Mai","Jun",
        "Jul","Aug","Sep","Okt","Nov","Dez" ],
        dayNames: [ "Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag" ],
        dayNamesShort: [ "So","Mo","Di","Mi","Do","Fr","Sa" ],
        dayNamesMin: [ "So","Mo","Di","Mi","Do","Fr","Sa" ],
        weekHeader: "KW",
        dateFormat: "dd.mm.yy",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: "" };
    $.datepicker.setDefaults($.datepicker.regional['de']);
})(jQuery);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(0)))

/***/ }),
/* 47 */
/***/ (function(module, exports, __webpack_require__) {

Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0), 
         __webpack_require__(2), __webpack_require__(4), __webpack_require__(3), 
         __webpack_require__(5), __webpack_require__(21)]; (function($, commonServices, commonTranslations, i18next) {

  contactModel = {

    requestLanguage: null,

  	sendMessage: function() {
      var formdata = $('form[name="widget_contact_form"]').formParams(true);
      var json_request = JSON.stringify(formdata);
      // Build URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/contact';
      if (commonServices.apiKey && commonServices.apiKey != '') {
        url += '?api_key='+commonServices.apiKey;
      }    
      // Request
      $.ajax({
         type: 'POST',
         data : json_request,
         url : url,
         success: function(data, textStatus, jqXHR) {      
           alert(i18next.t('contact.message_sent_successfully'));
           $('form[name=widget_contact_form]').trigger('reset');
           // Reset the Google Recaptcha
           if ( $('form[name=widget_contact_form').find('.g-recaptcha').length > 0 && 
                typeof grecaptcha !== 'undefined') {
             if (typeof grecaptcha.reset !== 'undefined') {
               grecaptcha.reset();
             }
           }
         },
         error: function(data, textStatus, jqXHR) {
           alert(i18next.t('contact.error_sending_message'));
         },
         complete: function(jqXHT, textStatus) {
         }
      });     		
  	}

  };

  contactView = {

  	init: function() {

      contactModel.requestLanguage = document.documentElement.lang;
      // Initialize i18next for translations
      i18next.init({  
                      lng: contactModel.requestLanguage,
                      resources: commonTranslations
                   }, 
                   function (error, t) {
                      // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                      //jqueryI18next.init(i18next, $);
                      // Localize UI
                      //$('.nav').localize();
                   });

  		this.setupValidation();

  	},

  	setupValidation: function() {

        $('form[name=widget_contact_form]').validate({

              submitHandler: function(form)
              {
                  $('#contact_form_errors').html('');
                  $('#contact_form_errors').hide();
                  if ( $('form[name=widget_contact_form').find('.g-recaptcha').length > 0 && 
                       typeof grecaptcha !== 'undefined') {
                    if (grecaptcha.getResponse() === '') {
                      alert(i18next.t('contact.validate_captcha'));
                      return false;
                    }
                    else {
                      contactModel.sendMessage();
                    }
                  }
                  else {
                    contactModel.sendMessage();
                  }
                  return false;
              },

              invalidHandler : function (form, validator) {
                  $('#contact_form_errors').html(i18next.t('contact.form_errors'));
                  $('#contact_form_errors').show();
              },

              rules : {
                 'customer_name': {
                      required: true
                  },
                  'customer_surname': {
                      required: true
                  },
                  'customer_phone': {
                      required: '#customer_phone:visible'
                  },
                  'customer_email': {
                      required: '#customer_email:visible'
                  },
                  'comments': {
                  	  required: true
                  }                            
              },

              messages : {
                  'customer_name': {
                      required: i18next.t('contact.validations.nameRequired')
                  },
                  'customer_surname': {
                      required: i18next.t('contact.validations.surnameRequired')
                  },
                  'customer_phone': {
                      required: i18next.t('contact.validations.phoneNumberRequired')
                  },
                  'customer_email': {
                      required: i18next.t('contact.validations.emailRequired')
                  },
                  'comments': {
                  	  required: i18next.t('contact.validations.commentsRequired')
                  }                        
              }
        });

  	}


  };

  contactView.init();

}).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);

/***/ }),
/* 48 */
/***/ (function(module, exports) {

const API_URL = 'https://maps.googleapis.com/maps/api/js'
const CALLBACK_NAME = '__googleMapsApiOnLoadCallback'

const optionsKeys = ['channel', 'client', 'key', 'language', 'region', 'v']

let promise = null

module.exports = function (options = {}) {
  promise =
    promise ||
    new Promise(function (resolve, reject) {
      // Reject the promise after a timeout
      const timeoutId = setTimeout(function () {
        window[CALLBACK_NAME] = function () {} // Set the on load callback to a no-op
        reject(new Error('Could not load the Google Maps API'))
      }, options.timeout || 10000)

      // Hook up the on load callback
      window[CALLBACK_NAME] = function () {
        if (timeoutId !== null) {
          clearTimeout(timeoutId)
        }
        resolve(window.google.maps)
        delete window[CALLBACK_NAME]
      }

      // Prepare the `script` tag to be inserted into the page
      const scriptElement = document.createElement('script')
      const params = [`callback=${CALLBACK_NAME}`]
      optionsKeys.forEach(function (key) {
        if (options[key]) {
          params.push(`${key}=${options[key]}`)
        }
      })
      if (options.libraries && options.libraries.length) {
        params.push(`libraries=${options.libraries.join(',')}`)
      }
      scriptElement.src = `${options.apiUrl || API_URL}?${params.join('&')}`

      // Insert the `script` tag
      document.body.appendChild(scriptElement)
    })
  return promise
}


/***/ }),
/* 49 */
/***/ (function(module, exports, __webpack_require__) {

/******
 *
 * Renting Module selector Widget
 *
 */
Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0), __webpack_require__(1), __webpack_require__(9), __webpack_require__(25)]; (function($, commonSettings, commonLoader, SelectorRent) {

  /***
   * Model
   */
  var widgetSelectorModel = {
    requestLanguage: null,
    configuration: null,
    
    /**
     * Load settings
     */
    loadSettings: function() {
      commonSettings.loadSettings(function(data){
        commonLoader.hide();
        widgetSelectorModel.configuration = data;
        widgetSelectorView.init();
      });
    }
   
  };

  /***
   * Controller
   */
  var widgetSelectorController = {

  };

  /***
   * View
   */
  var widgetSelectorView = {

    /**
     * Initialize
     */
    init: function() {
        // Setup request language (for API calls)
        widgetSelectorModel.requestLanguage = commonSettings.language(document.documentElement.lang);
        
        // Create selector
        this.selector = new SelectorRent();

        // Setup request language and settings
        this.selector.model.requestLanguage = widgetSelectorModel.requestLanguage;
        this.selector.model.configuration = widgetSelectorModel.configuration;

        // == Selectors

        // Search form
        this.selector.model.form_selector = 'form[name=widget_search_form]';
        // Search form template
        this.selector.model.form_selector_tmpl = 'widget_form_selector_tmpl';
        
        // Pickup place
        this.selector.model.pickup_place_id = 'widget_pickup_place';
        this.selector.model.pickup_place_selector = '#widget_pickup_place';
        this.selector.model.pickup_place_other_id = 'widget_pickup_place_other';
        this.selector.model.pickup_place_other_selector = '#widget_pickup_place_other';
        this.selector.model.another_pickup_place_group_selector = '#widget_another_pickup_place_group';
        this.selector.model.custom_pickup_place_selector = '#widget_another_pickup_place_group input[name=custom_pickup_place]';        
        this.selector.model.pickup_place_group_selector = '.widget_pickup_place_group',
        this.selector.model.another_pickup_place_group_close = '.widget_another_pickup_place_group_close',

        // Return place
        this.selector.model.return_place_id = 'widget_return_place';
        this.selector.model.return_place_selector = '#widget_return_place';
        this.selector.model.return_place_other_id = 'widget_return_place_other';
        this.selector.model.return_place_other_selector = '#widget_return_place_other';
        this.selector.model.another_return_place_group_selector = '#widget_another_return_place_group';  
        this.selector.model.custom_return_place_selector = '#widget_another_return_place_group input[name=custom_return_place]';             
        this.selector.model.return_place_group_selector = '.widget_return_place_group',
        this.selector.model.another_return_place_group_close = '.widget_another_return_place_group_close',
    
        // Date From
        this.selector.model.date_from_selector = '#widget_date_from';
        // Time From
        this.selector.model.time_from_id = 'widget_time_from';
        this.selector.model.time_from_selector = '#widget_time_from';
        // Date To
        this.selector.model.date_to_selector = '#widget_date_to';
        // Time To
        this.selector.model.time_to_id = 'widget_time_to';      
        this.selector.model.time_to_selector = '#widget_time_to';  
        // Driver age
        this.selector.model.driver_age_rule_selector = '#widget_driver_age_rule';
        // Number of products
        this.selector.model.number_of_products_selector = '#widget_number_of_products';
        // Family
        this.selector.model.family_id = 'widget_family_id',
        this.selector.model.family_id_selector = '#widget_family_id',   
        this.selector.model.family_selector = '.widget_family',     
        // Accept age
        this.selector.model.accept_age_selector = '#widget_accept_age';
        // Promotion code
        this.selector.model.promotion_code_selector = '#widget_promotion_code';
        
        // Initialize selector
        this.selector.view.init();
        this.selector.view.startEmpty();
    }

  };

  $(document).ready(function(){
      console.log('widget');
      commonLoader.show();
      widgetSelectorModel.loadSettings();
  });


}).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);


/***/ }),
/* 50 */
/***/ (function(module, exports, __webpack_require__) {

/**
 * This is the initiator of the selector Wizard
 */
Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0), __webpack_require__(1), __webpack_require__(26)]; (function($, commonSettings, selectorWizard) {

  /***
   * Model
   */
  var widgetSelectorWizardModel = {
    requestLanguage: null,
    configuration: null,
    
    /**
     * Load settings
     */
    loadSettings: function() {
      commonSettings.loadSettings(function(data){
        widgetSelectorWizardModel.configuration = data;
        widgetSelectorWizardView.init();
      });
    }
   
  };

  /***
   * Controller
   */
  var widgetSelectorWizardController = {

  };

  /***
   * View
   */
  var widgetSelectorWizardView = {

    /**
     * Initialize
     */
    init: function() {
        // Setup request language (for API calls)
        widgetSelectorWizardModel.requestLanguage = commonSettings.language(document.documentElement.lang);
        
        // Configure selector
        selectorWizard.model.requestLanguage = widgetSelectorWizardModel.requestLanguage;
        selectorWizard.model.configuration = widgetSelectorWizardModel.configuration;
        
        // Initialize selector
        selectorWizard.view.init();
    }

  };

  $(document).ready(function(){
    console.log('selector_wizard_widget');
    widgetSelectorWizardModel.loadSettings();
  });

}).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);


/***/ }),
/* 51 */
/***/ (function(module, exports, __webpack_require__) {

Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0), __webpack_require__(14),__webpack_require__(12),
         __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), __webpack_require__(9),
         __webpack_require__(3), __webpack_require__(6), 
         __webpack_require__(22), __webpack_require__(26),
         __webpack_require__(13),
         __webpack_require__(8),         
         __webpack_require__(5), __webpack_require__(0), __webpack_require__(10),
         __webpack_require__(16), __webpack_require__(15), __webpack_require__(17),
         __webpack_require__(11)]; (function($, RemoteDataSource, SelectSelector, 
                commonServices, commonSettings, commonTranslations, commonLoader,
                i18next, tmpl, selector, selectorWizard, rentEngineMediator) {

  var model = {

    requestLanguage: null, // Request language
    configuration: null,   // Settings
    // Search result
    shopping_cart: null,   // Shopping cart
    products: null,        // Search products
    sales_process: null,   // Sales process information
    // Product detail
    productDetail: null,   // product detail instance
    // Selected coverage
    hasCoverage: false,
    // Query parameters
    date_from : null,
    time_from : null,
    date_to : null,
    time_to : null,
    pickup_place: null,
    pickup_place_other: null,
    custom_pickup_place: null,
    return_place: null,
    return_place_other: null,
    custom_return_place: null,
    promotion_code: null,
    sales_channel_code: null,
    family_id: null,
    driver_age_rule_id: null,
    number_of_adults: null,
    number_of_children: null,
    number_of_products: null,
    agent_id: null,
    category_code: null,

    // -------------- Load settings ----------------------------

    /**
     * Load the settings
     */
    loadSettings: function() {
      commonSettings.loadSettings(function(data){
        model.configuration = data;
        view.init();
      });
    },   

    // ------------ Products information detail ------------------------

    /**
     * Get an Object with the quantities of each product in the
     * shopping cart
     */
    getShoppingCartProductQuantities: function() {

      var shoppingCartExtras = {};

      if (this.shopping_cart != null) {
          for (var idx=0;idx<this.shopping_cart.items.length;idx++) {
            shoppingCartExtras[this.shopping_cart.items[idx].item_id] = this.shopping_cart.items[idx].quantity;
          }
      }

      return shoppingCartExtras;

    },

    // -------------- Extract data -----------------------------

    getUrlVars : function() {
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars;
    },

    /**
     * Extract variables from Query String
     * -----------------------------------
     * The choose product page receives the information to query for
     * products and availability from the followin query string parameters:
     *
     * - date_from
     * - time_from
     * - date_to
     * - time_to
     * - pickup_place
     * - return_place
     * - promotion_code
     * - sales_channel_code
     * - family_id
     * - agent_id
     * - driver_age_rule_id
     * - number_of_adults
     * - number_of_children
     * - number_of_products
     * 
     */
    extractVariables: function() { // Load variables from the request

      var url_vars = this.getUrlVars();

      this.date_from = decodeURIComponent(url_vars['date_from']);
      this.time_from = decodeURIComponent(url_vars['time_from']);
      this.date_to = decodeURIComponent(url_vars['date_to']);
      this.time_to = decodeURIComponent(url_vars['time_to']);
      this.pickup_place = decodeURIComponent(url_vars['pickup_place']).replace(/\+/g, " ");
      this.pickup_place_other = decodeURIComponent(url_vars['pickup_place_other']).replace(/\+/g, " ");
      this.custom_pickup_place = decodeURIComponent(url_vars['custom_pickup_place']);
      this.return_place = decodeURIComponent(url_vars['return_place']).replace(/\+/g, " ");
      this.return_place_other = decodeURIComponent(url_vars['return_place_other']).replace(/\+/g, " ");
      this.custom_return_place = decodeURIComponent(url_vars['custom_return_place']);      
      this.promotion_code = decodeURIComponent(url_vars['promotion_code']);
      this.sales_channel_code = decodeURIComponent(url_vars['sales_channel_code']);
      this.family_id = decodeURIComponent(url_vars['family_id']);
      this.driver_age_rule_id = decodeURIComponent(url_vars['driver_age_rule_id']);
      this.number_of_adults = decodeURIComponent(url_vars['number_of_adults']);
      this.number_of_children = decodeURIComponent(url_vars['number_of_children']);
      this.number_of_products = decodeURIComponent(url_vars['number_of_products']);
      this.agent_id = decodeURIComponent(url_vars['agent_id']);
      this.category_code = decodeURIComponent(url_vars['category_code']);

    },

    // -------------- Shopping cart ----------------------------

    putShoppingCartFreeAccessId: function(value) {
      sessionStorage.setItem('shopping_cart_free_access_id', value);
    },

    getShoppingCartFreeAccessId: function() {
      return sessionStorage.getItem('shopping_cart_free_access_id');
    },

    isShoppingCartData: function() {

      return (this.date_from != 'undefined' && this.date_from != '' &&
              this.date_to != 'undefined' && this.date_to != '');

    },

    buildLoadShoppingCartDataParams: function() { /* Build create/update shopping cart data */

      var data = {
        date_from : this.date_from,
        date_to : this.date_to,
        include_products: true
      };

      if (this.time_from != 'undefined' && this.time_to != '') {
        data.time_from = this.time_from;
      }
       
      if (this.time_to != 'undefined' && this.time_to != '') {
        data.time_to = this.time_to;
      }

      if (this.pickup_place != 'undefined' && this.pickup_place != '') {
        data.pickup_place = this.pickup_place;
      }

      if (this.pickup_place_other != 'undefined' && this.pickup_place_other != '') {
        data.pickup_place_other = this.pickup_place_other;
      }

      if (this.custom_pickup_place != 'undefined' && this.custom_pickup_place != '') {
        data.custom_pickup_place = this.custom_pickup_place;
      }
      
      if (this.return_place != 'undefined' && this.return_place != '') {
        data.return_place = this.return_place;
      }

      if (this.return_place_other != 'undefined' && this.return_place_other != '') {
        data.return_place_other = this.return_place_other;
      }

      if (this.custom_return_place != 'undefined' && this.custom_return_place != '') {
        data.custom_return_place = this.custom_return_place;
      }

      if (this.promotion_code != 'undefined' && this.promotion_code != '') {
        data.promotion_code = this.promotion_code;
      }
       
      if (this.sales_channel_code != 'undefined' && this.sales_channel_code != '') {
        data.sales_channel_code = this.sales_channel_code;
      }

      if (this.family_id != 'undefined' && this.family_id != '') {
        data.family_id = this.family_id;
      }
      
      if (this.driver_age_rule_id != 'undefined' && this.driver_age_rule_id != '') {
        data.driver_age_rule_id = this.driver_age_rule_id;
      }

      if (this.number_of_products != 'undefined' && this.number_of_products != '') {
        data.number_of_products = this.number_of_products;
      }   
      
      if (this.number_of_adults != 'undefined' && this.number_of_adults != '') {
        data.number_of_adults = this.number_of_adults;
      }
       
      if (this.number_of_children != 'undefined' && this.number_of_children != '') {
        data.number_of_children = this.number_of_children;
      }

      if (this.agent_id != 'undefined' && this.agent_id != '') {
        data.agent_id = this.agent_id;
      }

      if (this.category_code != 'undefined' && this.category_code != '') {
        data.category_code = this.category_code;
      }

      var jsonData = encodeURIComponent(JSON.stringify(data));

      return jsonData;

    },

    loadShoppingCart: function() {

       // Build the URL
       var url = commonServices.URL_PREFIX + '/api/booking/frontend/shopping-cart';
       var freeAccessId = this.getShoppingCartFreeAccessId();
       if (freeAccessId) {
         url += '/' + freeAccessId;
       }
       url += '?include_products=true';
       if (model.requestLanguage != null) {
         url += '&lang=' + model.requestLanguage;
       }
       if (commonServices.apiKey && commonServices.apiKey != '') {
         url += '&api_key=' + commonServices.apiKey;
       }  
       // Request
       if (this.isShoppingCartData()) { // create or update shopping cart
         $.ajax({
               type: 'POST',
               url : url,
               data: model.buildLoadShoppingCartDataParams(),
               dataType : 'json',
               contentType : 'application/json; charset=utf-8',
               crossDomain: true,
               success: function(data, textStatus, jqXHR) {
                 model.shoppingCartResultProcess(data, textStatus, jqXHR);
                 // Hide the loader (OK)
                 commonLoader.hide();
               },
               error: function(data, textStatus, jqXHR) {
                 // Hide the loader (Error)
                 commonLoader.hide();
                 alert(i18next.t('chooseProduct.loadShoppingCart.error'));
               },
               complete: function(jqXHR, textStatus) {
                 $('#sidebar').show();
               }
          });
       }
       else { // retrieve the shopping cart
         $.ajax({
               type: 'GET',
               url : url,
               dataType : 'json',
               contentType : 'application/json; charset=utf-8',
               crossDomain: true,
               success: function(data, textStatus, jqXHR) {
                 model.shoppingCartResultProcess(data, textStatus, jqXHR);
                 // Hide the loader (OK)
                 commonLoader.hide();                 
               },
               error: function(data, textStatus, jqXHR) {
                 commonLoader.hide();
                 alert(i18next.t('chooseProduct.loadShoppingCart.error'));
               },
               complete: function(jqXHR, textStatus) {
                 $('#sidebar').show();
               }
          });
       }

    },

    shoppingCartResultProcess: function(data, textStatus, jqXHR) {
       model.shopping_cart = data.shopping_cart;
       model.products = data.products;
       model.sales_process = data.sales_process;
       // Store the shopping cart free access id in the session
       var free_access_id = model.getShoppingCartFreeAccessId();
       if (free_access_id == null || free_access_id != model.shopping_cart.free_access_id) {
         model.putShoppingCartFreeAccessId(model.shopping_cart.free_access_id);
       }
       view.showShoppingCart();
    },

    // -------------- Select product ----------------------------

    /**
     * Build select product data
     *
     * @productCode:: The product code
     * @quantity:: The quantity
     * @coverageCode:: The coverageCode (if it uses coverage)
     */
    buildSelectProductDataParams: function(productCode, quantity, coverageCode) {

      var data = {
        product: productCode
      };

      if (typeof quantity != 'undefined') {
        data.quantity = quantity;
      }

      // Apply coverage
      if (this.hasCoverage) {
        if (coverageCode != null) {
          data.coverage = coverageCode;
        }
        else {
          if (typeof $('input[type=radio][name=coverage]:checked').attr('data-value') !== 'undefined') {
            data.coverage = $('input[type=radio][name=coverage]:checked').attr('data-value');
          }
        }
      }

      var jsonData = encodeURIComponent(JSON.stringify(data));

      return jsonData;

    },

    /**
     * Set the product
     */
    selectProduct: function(productCode, quantity, coverageCode) {

       // Build the URL
       var url = commonServices.URL_PREFIX + '/api/booking/frontend/shopping-cart';
       var freeAccessId = this.getShoppingCartFreeAccessId();
       if (freeAccessId) {
         url += '/' + freeAccessId;
       }
       url += '/set-product';
       var urlParams = [];
       if (this.requestLanguage != null) {
         urlParams.push('lang=' + this.requestLanguage);
       }
       if (commonServices.apiKey && commonServices.apiKey != '') {
         urlParams.push('api_key='+commonServices.apiKey);
       }           
       if (urlParams.length > 0) {
         url += '?';
         url += urlParams.join('&');
       }
       // Request
       commonLoader.show();
       $.ajax({
               type: 'POST',
               url : url,
               data: this.buildSelectProductDataParams(productCode, quantity, coverageCode),
               dataType : 'json',
               contentType : 'application/json; charset=utf-8',
               crossDomain: true,
               success: function(data, textStatus, jqXHR) {
                 model.shopping_cart = data.shopping_cart;
                 commonLoader.hide();
                 if (!model.sales_process.multiple_products) {
                    view.gotoNextStep();
                 }
               },
               error: function(data, textStatus, jqXHR) {
                 commonLoader.hide();
                 alert(i18next.t('chooseProduct.selectProduct.error'));
               }
          });

    },

    /** 
     * Load product (product detail Page)
     */
    loadProduct: function(productCode) {

       // Build the URL
       var url = commonServices.URL_PREFIX + '/api/booking/frontend/products/'+productCode;
       var urlParams = [];
       if (this.requestLanguage != null) {
         urlParams.push('lang=' + this.requestLanguage);
       }
       if (commonServices.apiKey && commonServices.apiKey != '') {
         urlParams.push('api_key='+commonServices.apiKey);
       }           
       if (urlParams.length > 0) {
         url += '?';
         url += urlParams.join('&');
       }
       // Request
       commonLoader.show();
       $.ajax({
               type: 'GET',
               url : url,
               contentType : 'application/json; charset=utf-8',
               crossDomain: true,
               success: function(data, textStatus, jqXHR) {
                 model.productDetail = data;
                 view.showProductDetail();
                 commonLoader.hide();
               },
               error: function(data, textStatus, jqXHR) {
                  commonLoader.hide();
                  alert(i18next.t('chooseProduct.loadProduct.error'));
               }
          });

    }


  };

  var controller = {

    /**
     * Load product detail
     */
    productDetailIconClick: function(productCode) {

      model.loadProduct(productCode);

    },

    /**
     * Select producto button click
     */
    selectProductBtnClick: function(productCode) {

      rentEngineMediator.onChooseSingleProduct( productCode, 
                                                model.hasCoverage,
                                                view.getCurrentSelectedCoverage(), 
                                                model.products, 
                                                model.shopping_cart
                                              );
        
    },

    /**
     * Product quantity changed
     */
    productQuantityChanged: function(productCode, newQuantity) {

      model.selectProduct(productCode, newQuantity);

    },

    /**
     * Multiple products next button click
     */
    multipleProductsNextButtonClick: function() {

      if (model.shopping_cart.items.length == 0) {
        alert(i18next.t('chooseProduct.selectProduct.productNotSelected'));
      }
      else {
        rentEngineMediator.onChooseMultipleProducts( model.shopping_cart );
      }

    },

    coverageSelectorClick: function(selector) {

      thisRadio = $(selector);
      // remove the class imChecked from other radios
      $('input[type=radio][name=coverage]').not(thisRadio).removeClass("imChecked");
      // Check the class imChecked
      if (thisRadio.hasClass("imChecked")) {
          thisRadio.removeClass("imChecked");
          thisRadio.prop('checked', false);
      } else { 
          thisRadio.prop('checked', true);
          thisRadio.addClass("imChecked");
      };

    }

  };

  var view = {

    selectorLoaded: false,

    init: function() {
      model.requestLanguage = commonSettings.language(document.documentElement.lang);
      // Initialize i18next for translations
      i18next.init({  
                      lng: model.requestLanguage,
                      resources: commonTranslations
                   }, 
                   function (error, t) {
                      // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                      //jqueryI18next.init(i18next, $);
                      // Localize UI
                      //$('.nav').localize();
                   });

      // Configure selector
      if (commonServices.selectorInProcess == 'wizard') {
        selectorWizard.model.requestLanguage = model.requestLanguage;
        selectorWizard.model.configuration = model.configuration;
      }
      else {
        selector.model.requestLanguage = model.requestLanguage;
        selector.model.configuration = model.configuration;
        selector.view.init();
      }

      // Extract the query parameters from the query string
      model.extractVariables();

      // Load shopping cart
      model.loadShoppingCart();

    },

    showShoppingCart: function() {

        // Show the reservation summary 
        if (document.getElementById('script_reservation_summary')) {
          var reservationDetail = tmpl('script_reservation_summary')({
                shopping_cart: model.shopping_cart,
                configuration: model.configuration});
          $('#reservation_detail').html(reservationDetail);

          if ($('#modify_reservation_button').length) {
            // The user clicks on the modify reservation button
            $('#modify_reservation_button').bind('click', function() {
              // Setup the wizard
              if (!view.selectorLoaded) {
                if (commonServices.selectorInProcess == 'wizard') {
                  selectorWizard.view.startFromShoppingCart(model.shopping_cart);
                }
                else {
                  selector.view.startFromShoppingCart(model.shopping_cart);
                }
                view.selectorLoaded = true;
              }
              // Show the reservation wizard
              if (commonServices.selectorInProcess == 'wizard') {
                selectorWizard.view.showWizard();
              }
              else { // Show the reservation form
                // Compatibility with old version of the theme
                var modifyReservationModalSelector = '#choose_productModal';
                if ($('#modify_reservation_modal').length) {
                  modifyReservationModalSelector = '#modify_reservation_modal'
                }
                // Compatibility with libraries that overrides $.modal
                if (commonServices.jsBsModalNoConflict && typeof $.fn.bootstrapModal !== 'undefined') {
                  $(modifyReservationModalSelector).bootstrapModal(commonServices.jsBSModalShowOptions());
                }
                else {
                  if ($.fn.modal) {
                    $(modifyReservationModalSelector).modal(commonServices.jsBSModalShowOptions());
                  }
                }
              }
            });
          }
        
        }

        // Show the products
        if (document.getElementById('script_detailed_product')) {
          var available = 0;
          for (var idx=0;idx<model.products.length;idx++) {
            if (model.products[idx].availability) {
              available += 1;
            }
          }          
          var result = tmpl('script_detailed_product')({
                              shoppingCartProductQuantities: model.getShoppingCartProductQuantities(),
                              shoppingCart: model.shopping_cart, 
                              products: model.products,
                              configuration: model.configuration,
                              available: available,
                              i18next: i18next});
          $('#product_listing').html(result);

          // Bind the event to choose the product
          $('.btn-choose-product').bind('click', function() {
            controller.selectProductBtnClick($(this).attr('data-product'));
          });
          // Bind the events to manage multiple products
          $('.select-choose-product').bind('change', function() {
              var productCode = $(this).attr('data-value');
              var productQuantity = $(this).val();
              controller.productQuantityChanged(productCode, productQuantity);
          });        
          $('#go_to_complete').bind('click', function() {
            controller.multipleProductsNextButtonClick();
          });
          // Bind the event to show detailed product
          $('.js-product-info-btn').bind('click', function(){
            controller.productDetailIconClick($(this).attr('data-product'));
          });  
          // Setup coverage
          this.setupCoverage();        
        }  

    },

    /***
     * Prepare the product selector to manage coverage
     */
    setupCoverage: function() {

      model.hasCoverage = false;
      for (var idx=0;idx<model.products.length;idx++) {
        if (model.products[idx].coverage && model.products[idx].coverage instanceof Array &&
            model.products[idx].coverage.length > 0) {
          model.hasCoverage = true;
          break;
        }
      }
      if (model.hasCoverage) {
        $('input[type=radio][name=coverage]').click(function(e){
            controller.coverageSelectorClick(this);
        });        
      }

    },

    showProductDetail: function() {

      if (document.getElementById('script_product_modal')) {
        var result = tmpl('script_product_modal')({
                        product: model.productDetail
                      });
        $('#modalProductDetail .modal-product-detail-title').html(model.productDetail.name);
        $('#modalProductDetail .modal-product-detail-content').html(result);
        // Compatibility with libraries that overrides $.modal
        if (commonServices.jsBsModalNoConflict && typeof $.fn.bootstrapModal !== 'undefined') {
          $('#modalProductDetail').bootstrapModal(commonServices.jsBSModalShowOptions());
        }
        else {
          if ($.fn.modal) {
            $('#modalProductDetail').modal(commonServices.jsBSModalShowOptions());
          }
        }                       
      }

    },

    getCurrentSelectedCoverage: function() {
      var coverage = null;
      if (model.hasCoverage) {
        if (typeof $('input[type=radio][name=coverage]:checked').attr('data-value') !== 'undefined') {
          coverage = $('input[type=radio][name=coverage]:checked').attr('data-value');
        }        
      }
      return coverage;
    },

    /**
     * Go to the next step
     */
    gotoNextStep: function() {

      // Notify the event
      var event = {type: 'productChoosen',
                   data: model.shopping_cart};
      rentEngineMediator.notifyEvent(event);

      // Go to next step
      if (commonServices.extrasStep) {
        window.location.href= commonServices.chooseExtrasUrl;
      }
      else {
        window.location.href= commonServices.completeUrl;
      }

    }

  };

  // Configure the delegate
  var rentChooseProduct = {
    model: model,
    controller: controller,
    view: view
  }
  rentEngineMediator.setChooseProduct( rentChooseProduct );

  // The loader is show on start and hidden after the result of
  // the search has been rendered (in model.loadShoppingCart)
  commonLoader.show();
  model.loadSettings();

}).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);


/***/ }),
/* 52 */
/***/ (function(module, exports, __webpack_require__) {

Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0), 
         __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), __webpack_require__(9),
         __webpack_require__(3), __webpack_require__(6), __webpack_require__(22),
         __webpack_require__(13),
         __webpack_require__(8),         
         __webpack_require__(21), __webpack_require__(19),
         __webpack_require__(5), __webpack_require__(0), __webpack_require__(10),
         __webpack_require__(16), __webpack_require__(15), __webpack_require__(17),
         __webpack_require__(11)]; (function($, 
                commonServices, commonSettings, commonTranslations, commonLoader,
                i18next, tmpl, selector, rentEngineMediator) {

  var model = { // THE MODEL
    requestLanguage: null,
    configuration: null,    
    shopping_cart: null,
    products: null,
    extras: null,
    coverages: null,
    sales_process: null,
    
    // -------------- Load settings ----------------------------

    loadSettings: function() {
      commonSettings.loadSettings(function(data){
        model.configuration = data;
        view.init();
      });
    },  

    // ------------ Extras information detail ------------------------

    getShoppingCartExtras: function() { /** Get an object representation of extras **/

      var shoppingCartExtras = {};

      if (this.shopping_cart != null) {
          for (var idx=0;idx<this.shopping_cart.extras.length;idx++) {
            shoppingCartExtras[this.shopping_cart.extras[idx].extra_id] = this.shopping_cart.extras[idx].quantity;
          }
      }

      return shoppingCartExtras;

    },

    // ------------------ Shopping cart -------------------------------

    getShoppingCartFreeAccessId: function() { /* Get the shopping cart id */
      return sessionStorage.getItem('shopping_cart_free_access_id');
    },

    deleteShoppingCartFreeAccessId: function() { /* Get the shopping cart id */
      return sessionStorage.removeItem('shopping_cart_free_access_id');
    },

    loadShoppingCart: function() { /** Load the shopping cart **/

       // Build the URL
       var url = commonServices.URL_PREFIX + '/api/booking/frontend/shopping-cart';
       var freeAccessId = this.getShoppingCartFreeAccessId();
       if (freeAccessId) {
         url += '/' + freeAccessId;
       }
       var urlParams = [];
       urlParams.push('include_extras=true');
       urlParams.push('include_coverage=true');
       if (model.requestLanguage != null) {
        urlParams.push('lang='+model.requestLanguage);
       }
       if (commonServices.apiKey && commonServices.apiKey != '') {
         urlParams.push('api_key='+commonServices.apiKey);
       } 
       if (urlParams.length > 0) {
         url += '?';
         url += urlParams.join('&');
       }
       // Request
       $.ajax({
               type: 'GET',
               url : url,
               dataType : 'json',
               contentType : 'application/json; charset=utf-8',
               crossDomain: true,
               success: function(data, textStatus, jqXHR) {

                 model.shopping_cart = data.shopping_cart;
                 model.products = data.products;
                 model.extras = data.extras;
                 model.coverages = data.coverages;
                 model.sales_process = data.sales_process;

                 view.updateShoppingCart();

               },
               error: function(data, textStatus, jqXHR) {

                 alert(i18next.t('chooseExtras.loadShoppingCart.error'));

               },
               complete: function(jqXHR, textStatus) {
                 commonLoader.hide();
                 $('#content').show();
                 $('#sidebar').show();
               }
          });

    },

    // -------------- Extras management --------------------------

    buildSetExtraDataParams: function(extraCode, quantity) {

      var data = {
        extra: extraCode,
        quantity: quantity
      };

      var jsonData = encodeURIComponent(JSON.stringify(data));

      return jsonData;

    },

    setExtra: function(extraCode, quantity) { /** Add an extra **/

      // Build the URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/shopping-cart';
      var freeAccessId = this.getShoppingCartFreeAccessId();
      if (freeAccessId) {
        url += '/' + freeAccessId;
      }
      url += '/set-extra';
      var urlParams = [];
      if (model.requestLanguage != null) {
       urlParams.push('lang='+model.requestLanguage);
      }
      if (commonServices.apiKey && commonServices.apiKey != '') {
        urlParams.push('api_key='+commonServices.apiKey);
      } 
      if (urlParams.length > 0) {
        url += '?';
        url += urlParams.join('&');
      }
      // Request
      $.ajax({
        type: 'POST',
        url : url,
        data: this.buildSetExtraDataParams(extraCode, quantity),
        dataType : 'json',
        contentType : 'application/json; charset=utf-8',
        crossDomain: true,
        success: function(data, textStatus, jqXHR) {
            model.shopping_cart = data.shopping_cart;
            view.updateShoppingCartSummary();
            view.updateExtra(extraCode, quantity);
        },
        error: function(data, textStatus, jqXHR) {

          alert(i18next.t('chooseExtras.selectExtra.error'));

        },
        beforeSend: function(jqXHR) {
            commonLoader.show();
        },
        complete: function(jqXHR, textStatus) {
            commonLoader.hide();
        }
      });


    },

    buildDeleteExtraDataParams: function(extraCode) {
      var data = {
        extra: extraCode
      };
      var jsonData = encodeURIComponent(JSON.stringify(data));
      return jsonData;
    },

    deleteExtra: function(extraCode) { /** Remove an extra **/
      // Build the URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/shopping-cart';
      var freeAccessId = this.getShoppingCartFreeAccessId();
      if (freeAccessId) {
        url += '/' + freeAccessId;
      }
      url += '/remove-extra';
      var urlParams = [];
      if (model.requestLanguage != null) {
       urlParams.push('lang='+model.requestLanguage);
      }
      if (commonServices.apiKey && commonServices.apiKey != '') {
        urlParams.push('api_key='+commonServices.apiKey);
      } 
      if (urlParams.length > 0) {
        url += '?';
        url += urlParams.join('&');
      }
      // Request
      $.ajax({
        type: 'POST',
        url : url,
        data: this.buildDeleteExtraDataParams(extraCode),
        dataType : 'json',
        contentType : 'application/json; charset=utf-8',
        crossDomain: true,
        success: function(data, textStatus, jqXHR) {
            model.shopping_cart = data.shopping_cart;
            view.updateShoppingCartSummary();
            view.updateExtra(extraCode, 0);
        },
        error: function(data, textStatus, jqXHR) {

            alert(i18next.t('chooseExtras.deleteExtra.error'));

        },
        beforeSend: function(jqXHR) {
            commonLoader.show();
        },
        complete: function(jqXHR, textStatus) {
            commonLoader.hide();
        }
      });

    }

  };

  var controller = { // THE CONTROLLER

      extraChecked: function(extraCode) {
          model.setExtra(extraCode, 1);
      },

      extraUnchecked: function(extraCode) {
          model.deleteExtra(extraCode);
      },

      extraQuantityChanged: function(extraCode, newQuantity) {
          model.setExtra(extraCode, newQuantity);
      },

      btnMinusExtraClicked: function(extraCode, newQuantity) {
          model.setExtra(extraCode, newQuantity);
      },

      btnPlusExtraClicked: function(extraCode, newQuantity) {
          model.setExtra(extraCode, newQuantity);
      },

      goToCompleteButtonClick: function() {

        rentEngineMediator.onChooseExtras( model.shopping_cart );

      }

  };

  var view = { // THE VIEW

    init: function() {
      model.requestLanguage = commonSettings.language(document.documentElement.lang);
      // Initialize i18next for translations
      i18next.init({  
                      lng: model.requestLanguage,
                      resources: commonTranslations
                   }, 
                   function (error, t) {
                      // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                      //jqueryI18next.init(i18next, $);
                      // Localize UI
                      //$('.nav').localize();
                   });
      
      // Configure selector
      selector.model.requestLanguage = model.requestLanguage;
      selector.model.configuration = model.configuration;
      selector.view.init();

      // Load shopping cart
      commonLoader.show();
      model.loadShoppingCart();
    },

    updateShoppingCart: function() { // Updates the shopping cart

      selector.view.startFromShoppingCart(model.shopping_cart);
      this.updateShoppingCartSummary();
      this.updateExtras();

    },

    updateShoppingCartSummary: function() { // Updates the shopping cart summary (total)

       // Show the reservation summary
       if (document.getElementById('script_reservation_summary')) {
         var reservationDetail = tmpl('script_reservation_summary')({
              shopping_cart: model.shopping_cart,
              configuration: model.configuration});
         $('#reservation_detail').html(reservationDetail);
         
         // Setup the events
         
         if ($('#modify_reservation_button').length) {
           // The user clicks on the modify reservation button
           $('#modify_reservation_button').bind('click', function() { 
                // Setup the wizard
                if (!view.selectorLoaded) {
                  if (commonServices.selectorInProcess == 'wizard') {
                    selectorWizard.view.startFromShoppingCart(model.shopping_cart);
                  }
                  else {
                    selector.view.startFromShoppingCart(model.shopping_cart);
                  }
                  view.selectorLoaded = true;
                }
                // Show the reservation wizard
                if (commonServices.selectorInProcess == 'wizard') {
                  selectorWizard.view.showWizard();
                }
                else { // Show the reservation form
                  // Compatibility with old version of the theme
                  var modifyReservationModalSelector = '#choose_productModal';
                  if ($('#modify_reservation_modal').length) {
                    modifyReservationModalSelector = '#modify_reservation_modal'
                  }
                  // Compatibility with libraries that overrides $.modal
                  if (commonServices.jsBsModalNoConflict && typeof $.fn.bootstrapModal !== 'undefined') {
                    $(modifyReservationModalSelector).bootstrapModal(commonServices.jsBSModalShowOptions());
                  }
                  else {
                    if ($.fn.modal) {
                      $(modifyReservationModalSelector).modal(commonServices.jsBSModalShowOptions());
                    }
                  }
                }
           });
         }

       }
       $('#btn_go_to_complete').bind('click', function() {
           controller.goToCompleteButtonClick();
       });

    },

    updateExtra: function(extraCode, quantity) {

      // Button for add and remove
      $('.extra-input[data-extra-code='+extraCode+']').val(quantity);

      // Button extra toggle
      if (quantity == 0) {
        $('.extra-check-button[data-extra-code='+extraCode+']').removeClass('extra-selected');
      }
      else {
        $('.extra-check-button[data-extra-code='+extraCode+']').addClass('extra-selected');
      }

    },

    updateExtras: function() { // Updates the extras (included the selected by the transaction)

        // == Show the extras
        var result = tmpl('script_detailed_extra')({extras: model.extras,
                                                    coverages: model.coverages,  
                                                    extrasInShoppingCart: model.getShoppingCartExtras(),
                                                    configuration: model.configuration,
                                                    i18next: i18next,
                                                    shopping_cart: model.shopping_cart});
        $('#extras_listing').html(result);

        // == Setup events

        // Extra check button [1 unit]
        $('.extra-check-button').bind('click', function() {
            var extraCode = $(this).attr('data-extra-code');
            if ($(this).hasClass('extra-selected')) {
              controller.extraUnchecked(extraCode);
            }
            else {
              controller.extraChecked(extraCode);
            }
        });

        // Extra checkbox [1 unit]
        $('.extra-checkbox').bind('change', function() {
            var extraCode = $(this).attr('data-value');
            var checked = $(this).is(':checked');
            if (checked) {
                controller.extraChecked(extraCode);
            }
            else {
                controller.extraUnchecked(extraCode);
            }
        });

        // Extra select [N units]
        $('.extra-select').bind('change', function() {
            var extraCode = $(this).attr('data-extra-code');
            var extraQuantity = $(this).val();
            controller.extraQuantityChanged(extraCode, extraQuantity);
        });

        // Extra minus button extra clicked [N units]
        $('.btn-minus-extra').bind('click', function() {
            var extraCode = $(this).attr('data-value');
            var extraQuantity = parseInt($('#extra-'+extraCode+'-quantity').val() || '0');
            console.log(extraQuantity);
            if (extraQuantity > 0) {
              extraQuantity--;     
              controller.btnMinusExtraClicked(extraCode, extraQuantity);
            }
        });

        // Extra plus button extra clicked [N units]
        $('.btn-plus-extra').bind('click', function() {
            var extraCode = $(this).attr('data-value');
            var extraQuantity = parseInt($('#extra-'+extraCode+'-quantity').val() || '0');
            var maxQuantity = $(this).attr('data-max-quantity');
            if (extraQuantity < maxQuantity) {
              extraQuantity++;     
              controller.btnPlusExtraClicked(extraCode, extraQuantity);
            }
        });        

    },

    gotoNextStep: function() {
      // Notify the event
      var event = {type: 'extrasChoosen',
                   data: model.shopping_cart};
      rentEngineMediator.notifyEvent(event);
      // Go to Next Step
      window.location.href = commonServices.completeUrl;      
    }
    
  };

  var rentChooseExtras = {
    model: model,
    controller: controller,
    view: view
  }
  rentEngineMediator.setChooseExtras( rentChooseExtras );


  model.loadSettings();

}).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);

/***/ }),
/* 53 */
/***/ (function(module, exports, __webpack_require__) {

Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0), 
         __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), __webpack_require__(9),
         __webpack_require__(3),__webpack_require__(6),__webpack_require__(24), 
         __webpack_require__(22), __webpack_require__(26), __webpack_require__(23), 
         __webpack_require__(18),__webpack_require__(12), __webpack_require__(13), __webpack_require__(30),
         __webpack_require__(8), __webpack_require__(21), __webpack_require__(19),
	       __webpack_require__(5), __webpack_require__(0), __webpack_require__(10),
         __webpack_require__(16), __webpack_require__(15), __webpack_require__(17),
	       __webpack_require__(11)]; (function($, 
                commonServices, commonSettings, commonTranslations, commonLoader, 
                i18next, tmpl, DateControl, selector, selectorWizard, select2,
                MemoryDataSource, SelectSelector, rentEngineMediator, Login) {

  var model = { // THE MODEL
    requestLanguage: null,
    configuration: null,     
    // The shopping cart    
    shopping_cart: null,
    extras: null,         // Extras
    coverages: null,      // The coverages
    sales_process: null,  // Sales process
    // Extra detail
    extraDetail: null,

    // -------------- Load settings ----------------------------

    loadSettings: function() {
      commonSettings.loadSettings(function(data){
        model.configuration = data;
        view.init();
      });
    },      

    // ------------ Extras information detail ------------------------

    /**
     * Get an Object with the quantities of each extra in the
     * shopping cart
     */
    getShoppingCartExtrasQuantities: function() { 

      var shoppingCartExtras = {};

      if (this.shopping_cart != null) {
          for (var idx=0;idx<this.shopping_cart.extras.length;idx++) {
            shoppingCartExtras[this.shopping_cart.extras[idx].extra_id] = this.shopping_cart.extras[idx].quantity;
          }
      }

      return shoppingCartExtras;

    },

    isCoverage: function(extraCode) {
      var found = false;
      if (this.coverages) {
        for (var idx=0;idx<this.coverages.length;idx++) {
          if (this.coverages[idx].code == extraCode) {
            found = true;
            break;
          }
        }
      }
      return found;
    },

    // ------------------ Shopping cart -------------------------------

    getShoppingCartFreeAccessId: function() { /* Get the shopping cart id */
      return sessionStorage.getItem('shopping_cart_free_access_id');
    },

    deleteShoppingCartFreeAccessId: function() { /* Get the shopping cart id */
      return sessionStorage.removeItem('shopping_cart_free_access_id');
    },

    loadShoppingCart: function() { /** Load the shopping cart **/

       // Build the URL
       var url = commonServices.URL_PREFIX + '/api/booking/frontend/shopping-cart';
       var freeAccessId = this.getShoppingCartFreeAccessId();
       if (freeAccessId) {
         url += '/' + freeAccessId;
       }
       var urlParams = [];
       urlParams.push('include_extras=true');
       urlParams.push('include_coverage=true');
       if (model.requestLanguage != null) {
        urlParams.push('lang='+model.requestLanguage);
       }
       if (commonServices.apiKey && commonServices.apiKey != '') {
         urlParams.push('api_key='+commonServices.apiKey);
       }        
       if (urlParams.length > 0) {
         url += '?';
         url += urlParams.join('&');
       }
       // Action to the URL
       $.ajax({
               type: 'GET',
               url : url,
               dataType : 'json',
               contentType : 'application/json; charset=utf-8',
               crossDomain: true,
               success: function(data, textStatus, jqXHR) {
                 model.shopping_cart = data.shopping_cart;
                 model.extras = data.extras;
                 model.coverages = data.coverages;
                 model.sales_process = data.sales_process;
                 view.updateShoppingCart();
                 // Hide the loader
                 commonLoader.hide();
               },
               error: function(data, textStatus, jqXHR) {
                 commonLoader.hide();
                 alert(i18next.t('complete.loadShoppingCart.error'));

               },
               complete: function(jqXHR, textStatus) {
                 $('#content').show();
                 $('#sidebar').show();
               }
          });

    },

    // -------------- Extras management --------------------------

    buildSetExtraDataParams: function(extraCode, quantity) {

      var data = {
        extra: extraCode,
        quantity: quantity
      };

      var jsonData = encodeURIComponent(JSON.stringify(data));

      return jsonData;

    },

    setExtra: function(extraCode, quantity) { /** Add an extra **/

      // Build the URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/shopping-cart';
      var freeAccessId = this.getShoppingCartFreeAccessId();
      if (freeAccessId) {
        url += '/' + freeAccessId;
      }
      url += '/set-extra';
      var urlParams = [];
      if (model.requestLanguage != null) {
       urlParams.push('lang='+model.requestLanguage);
      }
      if (commonServices.apiKey && commonServices.apiKey != '') {
        urlParams.push('api_key='+commonServices.apiKey);
      } 
      if (urlParams.length > 0) {
        url += '?';
        url += urlParams.join('&');
      }
      // Request
      commonLoader.show();
      $.ajax({
        type: 'POST',
        url : url,
        data: this.buildSetExtraDataParams(extraCode, quantity),
        dataType : 'json',
        contentType : 'application/json; charset=utf-8',
        crossDomain: true,
        success: function(data, textStatus, jqXHR) {
            model.shopping_cart = data.shopping_cart;
            // Updates the shopping cart
            view.updateShoppingCartExtra(extraCode, quantity);
            // Hide the loader (OK)
            commonLoader.hide();
        },
        error: function(data, textStatus, jqXHR) {
            // Hide the loader (Error)
            commonLoader.hide(); 
            alert(i18next.t('complete.selectExtra.error'));
        }
      });


    },

    buildDeleteExtraDataParams: function(extraCode) {

      var data = {
        extra: extraCode
      };

      var jsonData = encodeURIComponent(JSON.stringify(data));

      return jsonData;

    },

    deleteExtra: function(extraCode) { /** Remove an extra **/

      // Build the URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/shopping-cart';
      var freeAccessId = this.getShoppingCartFreeAccessId();
      if (freeAccessId) {
        url += '/' + freeAccessId;
      }
      url += '/remove-extra';
      var urlParams = [];
      if (model.requestLanguage != null) {
       urlParams.push('lang='+model.requestLanguage);
      }
      if (commonServices.apiKey && commonServices.apiKey != '') {
        urlParams.push('api_key='+commonServices.apiKey);
      } 
      if (urlParams.length > 0) {
        url += '?';
        url += urlParams.join('&');
      }
      // Request
      commonLoader.show();
      $.ajax({
        type: 'POST',
        url : url,
        data: this.buildDeleteExtraDataParams(extraCode),
        dataType : 'json',
        contentType : 'application/json; charset=utf-8',
        crossDomain: true,
        success: function(data, textStatus, jqXHR) {
            model.shopping_cart = data.shopping_cart;
            // Updates the shopping cart
            view.updateShoppingCartExtra(extraCode, 0);          
            // Hide the loader (OK)
            commonLoader.hide();
        },
        error: function(data, textStatus, jqXHR) {
            alert(i18next.t('complete.deleteExtra.error'));
            // Hide the loader (Error)
            commonLoader.hide();
        }
      });

    },

    // Load extra (extra detail Page)

    loadExtra: function(extraCode) {

       // Build the URL
       var url = commonServices.URL_PREFIX + '/api/booking/frontend/extras/'+extraCode;
       var urlParams = [];
       if (this.requestLanguage != null) {
         urlParams.push('lang=' + this.requestLanguage);
       }
       if (commonServices.apiKey && commonServices.apiKey != '') {
         urlParams.push('api_key='+commonServices.apiKey);
       }           
       if (urlParams.length > 0) {
         url += '?';
         url += urlParams.join('&');
       }
       // Request
       commonLoader.show();
       // Action to the URL
       $.ajax({
               type: 'GET',
               url : url,
               contentType : 'application/json; charset=utf-8',
               crossDomain: true,
               success: function(data, textStatus, jqXHR) {
                 model.extraDetail = data;
                 view.showExtraDetail();
                 // Hide the loader (OK)
                 commonLoader.hide();
               },
               error: function(data, textStatus, jqXHR) {
                  // Hide the loader (Error)
                  commonLoader.hide();                
                  alert(i18next.t('complete.loadExtra.error'));
               }
          });

    },

    // -------------- Promotion Code --------------------------------------

    applyPromotionCode: function(promotionCode) {

      var requestData = {promotion_code: promotionCode};
      var requestDataJSON = encodeURIComponent(JSON.stringify(requestData));
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/shopping-cart';
      var freeAccessId = this.getShoppingCartFreeAccessId();
      if (freeAccessId) {
        url += '/' + freeAccessId;
      }
      url += '/apply-promotion-code';
      var urlParams = [];
      if (this.requestLanguage != null) {
        urlParams.push('lang=' + this.requestLanguage);
      }
      if (commonServices.apiKey && commonServices.apiKey != '') {
        urlParams.push('api_key='+commonServices.apiKey);
      }           
      if (urlParams.length > 0) {
        url += '?';
        url += urlParams.join('&');
      }
      // Request
      commonLoader.show();
      $.ajax({
            type: 'POST',
            url  : url,
            data : requestDataJSON,
            dataType : 'json',
            contentType : 'application/json; charset=utf-8',
            crossDomain: true,
            success: function(data, textStatus, jqXHR) {
                // Update the shopping cart
                model.shopping_cart = data.shopping_cart;
                view.updateShoppingCartPromotionCode();
                // Hide the loader
                commonLoader.hide();
            },
            error: function(data, textStatus, jqXHR) {
                // Hide Loader (ERROR)
                commonLoader.hide();
                if (typeof data.responseJSON !== 'undefined' && 
                    typeof data.responseJSON.error !== 'undefined') {
                  alert(data.responseJSON.error);
                }
                else {
                  alert(i18next.t('complete.promotionCode.error'));
                }
            }
        });


    },

    // -------------- Checkout : Confirm reservation ----------------------

    getBookingFreeAccessId: function() { /* Get the shopping cart id */
      return sessionStorage.getItem('booking_free_access_id');
    },


    putBookingFreeAccessId: function(value) {
      sessionStorage.setItem('booking_free_access_id', value);
    },

    sendBookingRequest: function() { /** Send a booking request **/

      // Prepare the request data
      var reservation = $('form[name=reservation_form]').formParams(false);
      if (typeof reservation.complete_action != 'undefined') {
        if (reservation.complete_action != 'pay_now') {
          reservation.payment = 'none';
        }
      }
      var reservationJSON = JSON.stringify(reservation);
      // Prepare the URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/shopping-cart';
      var freeAccessId = this.getShoppingCartFreeAccessId();
      if (freeAccessId) {
        url += '/' + freeAccessId;
      }
      url += '/checkout';
      var urlParams = [];
      if (this.requestLanguage != null) {
        urlParams.push('lang=' + this.requestLanguage);
      }
      if (commonServices.apiKey && commonServices.apiKey != '') {
        urlParams.push('api_key='+commonServices.apiKey);
      }           
      if (urlParams.length > 0) {
        url += '?';
        url += urlParams.join('&');
      }

      // Authorization => Customer
      var headers = {};
      if (view.login && view.login.model && view.login.model.bearer) {
        headers['Authorization'] = view.login.model.bearer;
      }

      // Request
      var self = this;
      commonLoader.show();
      $.ajax({
            type: 'POST',
            url  : url,
            data : reservationJSON,
            dataType : 'json',
            contentType : 'application/json; charset=utf-8',
            crossDomain: true,
            headers: headers,
            success: function(data, textStatus, jqXHR) {
                // Hide Loader (OK)
                commonLoader.hide();
                // Prepare the connection to the payment page or to the summary
                var payNow = data.pay_now;
                var bookingId = data.free_access_id;
                var payment_method_id = data.payment_method_id;
                // remove the shopping cart id from the session
                model.deleteShoppingCartFreeAccessId();
                model.putBookingFreeAccessId(bookingId);
                if (payNow && payment_method_id != null && payment_method_id != '') {
                    // Notify the event
                    var event = {type: 'newReservationWithPaymentRequested',
                                 data: data};
                    rentEngineMediator.notifyEvent(event);
                    // Go to payment
                    var paymentData = {
                        id: bookingId,
                        payment: model.sales_process.can_pay_deposit ? 'deposit' : 'total', 
                        payment_method_id: payment_method_id
                    }
                    view.payment(commonServices.URL_PREFIX + '/reserva/pagar',
                                 bookingId, 
                                 paymentData);
                }
                else {
                    // Notify the event
                    var event = {type: 'newReservationRequested',
                                 data: data};
                    rentEngineMediator.notifyEvent(event);
                    // Go to summary          
                    view.gotoSummary(bookingId);
                }
            },
            error: function(data, textStatus, jqXHR) {
                // Hide Loader (ERROR)
                commonLoader.hide();
                alert(i18next.t('complete.createReservation.error'));
            }
        });

    }

  };

  var controller = { // THE CONTROLLER

      extraChecked: function(extraCode) {
          model.setExtra(extraCode, 1);
      },

      extraUnchecked: function(extraCode) {
          model.deleteExtra(extraCode);
      },

      extraQuantityChanged: function(extraCode, newQuantity) {
          model.setExtra(extraCode, newQuantity);
      },

      btnMinusExtraClicked: function(extraCode, newQuantity) {
          model.setExtra(extraCode, newQuantity);
      },

      btnPlusExtraClicked: function(extraCode, newQuantity) {
          model.setExtra(extraCode, newQuantity);
      },

      extraDetailIconClick: function(extraCode) {
          model.loadExtra(extraCode);
      },

      applyPromotionCodeBtnClick: function(promotionCode) {
          model.applyPromotionCode(promotionCode);
      },

      sendReservationButtonClick: function() {

          rentEngineMediator.onCheckout( model.coverages, 
                                         model.extras,
                                         model.shopping_cart );
      
      },

      completeActionChange: function() {
          
          if ($('input[name=complete_action]:checked').val() === 'pay_now') {
            $('#request_reservation_container').hide();
            $('#payment_on_delivery_container').hide();
            $('#payment_now_container').show();
          }
          else if ($('input[name=complete_action]:checked').val() === 'pay_on_delivery') {
            $('#request_reservation_container').hide();
            $('#payment_on_delivery_container').show();
            $('#payment_now_container').hide();
          }
          else if ($('input[name=complete_action]:checked').val() === 'request_reservation') {
            $('#payment_method_select').val('');
            $('#request_reservation_container').show();
            $('#payment_on_delivery_container').hide();
            $('#payment_now_container').hide();
          }

      },

      paymentMethodSelectChange: function(value) {
        $('input[name=payment]').val(value);
      }

  };

  var view = { // THE VIEW

    selectorLoaded: false,
    login: null,

  	init: function() {
      model.requestLanguage = commonSettings.language(document.documentElement.lang);
      // Initialize i18next for translations
      i18next.init({  
                      lng: model.requestLanguage,
                      resources: commonTranslations
                   }, 
                   function (error, t) {
                      // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                      //jqueryI18next.init(i18next, $);
                      // Localize UI
                      //$('.nav').localize();
                   });

      // Configure selector
      if (commonServices.selectorInProcess == 'wizard') {
        selectorWizard.model.requestLanguage = model.requestLanguage;
        selectorWizard.model.configuration = model.configuration;
      }
      else {
        selector.model.requestLanguage = model.requestLanguage;
        selector.model.configuration = model.configuration;
        selector.view.init();
      }

      // Complements
      if (model.configuration.engineCustomerAccess) {
        this.setupLoginForm();
      }
      else {
        this.prepareReservationForm();
      }
      // Load shopping cart
      model.loadShoppingCart();
  	},

    /**
     * Setup the login form
     */
    setupLoginForm: function() {
      this.prepareReservationForm();
      var self = this;
      // Complete hide
      $('#form-reservation').hide();
      $('#extras_listing').hide();
      $('.reservation_form_container').hide();
      if (document.getElementById('script_complete_complement') && 
          document.getElementById('script_create_account')) {
        // Login form
        var html = tmpl('script_complete_complement')({});
        $('#extras_listing').before(html);
        // Signup form
        var htmlSignup = tmpl('script_create_account');
        $('#payment_detail').before(htmlSignup);
        //
        this.login = new Login();
        // Setup event listener
        this.login.model.addListener('login', function(event) {
          if (event.type == 'login' && event.data) {
            if (event.data.success) {
              // Disable login/create account form
              $('form[name=mybooking_select_user_form] input').prop('disabled', true);
              $('form[name=mybooking_login_form] input, form[name=mybooking_login_form] button').prop('disabled', true);
              // Show login message
              if (document.getElementById('script_welcome_customer')) {
                var htmlMessage = tmpl('script_welcome_customer')({i18next: i18next, user: event.data.user});
                $('#reservation_complement_container').append(htmlMessage);
              }
              // Remove create account components
              $('.mybooking_rent_create_account_selector_container').remove();
              $('.mybooking_rent_create_account_fields_container').remove();
              // Show the reservation form
              $('#form-reservation').show();
              $('#extras_listing').show();
              $('.customer_component').hide();
              $('.reservation_form_container').show();   
            }         
            else {
              alert(i18next.t('common.invalid_user_password'));
            }
          }
        });
        this.login.view.init();
        $('form[name=mybooking_select_user_form] input[name=registered_customer]').on('change', function(){
          if ($(this).val() === 'true') {
            $('.mybooking_login_form_element').show();
            $('#form-reservation').hide();
            $('#extras_listing').hide();
            $('.reservation_form_container').hide();
          }
          else {
            $('.mybooking_login_form_element').hide();
            $('#form-reservation').show();
            $('#extras_listing').show();
            $('.reservation_form_container').show();            
          }
        });
        // Setup create account components
        this.setupCreateAccountComponents();        
      }

    },
    /**
     * Setup create account components
     */
    setupCreateAccountComponents: function() {
      $('input[name=create_customer_account]').on('change', function(){
        if ($(this).val() === 'true') {
          $('.mybooking_rent_create_account_fields_container').show();
        }
        else {
          $('.mybooking_rent_create_account_fields_container').hide();
        }
      });
    },


    prepareReservationForm: function() {
        // Setup UI
        this.setupReservationForm();
        $('.complete-section-title.customer_component').show();
        $('#form-reservation').show();
        this.setupReservationFormValidation();
    },

    /**
     * Setup the reservation form
     */
    setupReservationForm: function() {

      var connectedUser = false;
      if ( this.login && this.login.model.connectedUser ) {
        connectedUser = true;
      }

      // The reservation form fields are defined in a micro-template
      var locale = model.requestLanguage;
      var localeReservationFormScript = 'script_renting_complete_form_tmpl_'+locale;
      if (locale != null && document.getElementById(localeReservationFormScript)) {
        var reservationForm = tmpl(localeReservationFormScript)({configuration: model.configuration});
        $('form[name=reservation_form]').html(reservationForm);           
      }
      else if (document.getElementById('script_renting_complete_form_tmpl')) {
        var reservationForm = tmpl('script_renting_complete_form_tmpl')({configuration: model.configuration});
        $('form[name=reservation_form]').html(reservationForm);                                                                    
      }

      // Configure address country

      // Load countries
      var countries = i18next.t('common.countries', {returnObjects: true });
      if (countries instanceof Object) {
        var countryCodes = Object.keys(countries);
        var countriesArray = countryCodes.map(function(value){ 
                                return {id: value, text: countries[value], description: countries[value]};
                             });
      } 
      else {
        var countriesArray = [];
      }
      var values = ['']; 

      if (commonServices.jsUseSelect2) {
        // Setup country selector
        var selectors = ['select[name=country]'];
        for (var idx=0; idx<selectors.length; idx++) { 
          $countrySelector = $(selectors[idx]);    
          if ($countrySelector.length > 0 && typeof values[idx] !== 'undefined') {
            $countrySelector.select2({
              width: '100%',
              theme: 'bootstrap4',                  
              data: countriesArray
            });
            // Assign value
            var value = (values[idx] !== null && values[idx] !== '' ? values[idx] : '');
            $countrySelector.val(values[idx]);
            $countrySelector.trigger('change');
          }
        }
      }
      else {
        // Setup country selector
        var selectors = ['country'];
        for (var idx=0; idx<selectors.length; idx++) { 
          if (document.getElementById(selectors[idx])) {
            var countriesDataSource = new MemoryDataSource(countriesArray);
            var countryModel = (values[idx] == null ? '' : values[idx])
            var selectorModel = new SelectSelector(selectors[idx],
                countriesDataSource, countryModel, true, i18next.t('complete.reservationForm.select_country'));
          }
        }
      }


      // Configure driver document id date
      if (document.getElementById('driver_document_id_date_day')) {
        var dataControlDateOfBirth = new DateControl(document.getElementById('driver_document_id_date_day'),
                        document.getElementById('driver_document_id_date_month'),
                        document.getElementById('driver_document_id_date_year'),
                        document.getElementById('driver_document_id_date'),
                        commonSettings.language(model.requestLanguage));
      }
      // Configure driver date of birth and driver license date
      if (document.getElementById('driver_date_of_birth_day')) {
        var dataControlDateOfBirth = new DateControl(document.getElementById('driver_date_of_birth_day'),
                        document.getElementById('driver_date_of_birth_month'),
                        document.getElementById('driver_date_of_birth_year'),
                        document.getElementById('driver_date_of_birth'),
                        commonSettings.language(model.requestLanguage));
      }
      // Configure driver driving license date 
      if (document.getElementById('driver_driving_license_date_day')) {
        var dataControlDateOfBirth = new DateControl(document.getElementById('driver_driving_license_date_day'),
                        document.getElementById('driver_driving_license_date_month'),
                        document.getElementById('driver_driving_license_date_year'),
                        document.getElementById('driver_driving_license_date'),
                        commonSettings.language(model.requestLanguage));
      }

      // Configure additional driver driving license date 
      if (document.getElementById('additional_driver_1_driving_license_date_day')) {
        var dataControlDateOfBirth = new DateControl(document.getElementById('additional_driver_1_driving_license_date_day'),
                        document.getElementById('additional_driver_1_driving_license_date_month'),
                        document.getElementById('additional_driver_1_driving_license_date_year'),
                        document.getElementById('additional_driver_1_driving_license_date'),
                        commonSettings.language(model.requestLanguage));
      }
      if (document.getElementById('additional_driver_2_driving_license_date_day')) {
        var dataControlDateOfBirth = new DateControl(document.getElementById('additional_driver_2_driving_license_date_day'),
                        document.getElementById('additional_driver_2_driving_license_date_month'),
                        document.getElementById('additional_driver_2_driving_license_date_year'),
                        document.getElementById('additional_driver_2_driving_license_date'),
                        commonSettings.language(model.requestLanguage));
      }

    },

    /**
     * Setup the reservation form validation
     */ 
    setupReservationFormValidation: function() {

        $.validator.addMethod("pwcheck", function(value) {
           if ( $('#account_password').is(':visible') ) {
             return  /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                     && /[a-z]/.test(value) // has a lowercase letter
                     && /[A-Z]/.test(value) // has a uppercase letter
                     && /\d/.test(value) // has a digit
                     && /[=!\-@._*]/.test(value); // has a symbol
           }
           return true;
        });

        $('form[name=reservation_form]').validate(
            {
                ignore: '', // To be able to validate driver date of birth
                errorClass: 'text-danger',
                submitHandler: function(form) {
                    $('#reservation_error').hide();
                    $('#reservation_error').html('');
                    controller.sendReservationButtonClick();
                    return false;
                },

                invalidHandler : function (form, validator) {
                    $('#reservation_error').html(i18next.t('complete.reservationForm.errors'));
                    $('#reservation_error').show();
                },

                rules : {

                    'customer_name': {
                      required: '#customer_name:visible'
                    },
                    'customer_surname' : {
                      required: '#customer_surname:visible'
                    },
                    'customer_email' : {
                        required: '#customer_email:visible',
                        email: '#customer_email:visible'
                    },
                    'confirm_customer_email': {
                        required: '#confirm_customer_email:visible',
                        email: '#confirm_customer_email:visible',
                        equalTo : '#customer_email'
                    },
                    'customer_phone': {
                        required: '#customer_phone:visible',
                        minlength: 9
                    },
                    'driver_date_of_birth': {
                        required: "#driver_date_of_birth_day:visible"
                    },
                    'number_of_adults': {
                        required: '#number_of_adults:visible'
                    },
                    'conditions_read_request_reservation' :  {
                        required: '#conditions_read_request_reservation:visible'
                    },
                    'conditions_read_payment_on_delivery' :  {
                        required: '#conditions_read_payment_on_delivery:visible'
                    },
                    'conditions_read_pay_now' :  {
                        required: '#conditions_read_pay_now:visible'
                    },                                        
                    'payment_method_select': {
                        required: 'input[name=payment_method_select]:visible'
                    },
                    'account_password': {
                        required: '#account_password:visible',
                        pwcheck: '#account_password:visible',
                        minlength: 8
                    }
                },

                messages : {

                    'customer_name': i18next.t('complete.reservationForm.validations.customerNameRequired'),
                    'customer_surname' : i18next.t('complete.reservationForm.validations.customerSurnameRequired'),
                    'customer_email' : {
                        required: i18next.t('complete.reservationForm.validations.customerEmailRequired'),
                        email: i18next.t('complete.reservationForm.validations.customerEmailInvalidFormat'),
                    },
                    'confirm_customer_email': {
                        'required': i18next.t('complete.reservationForm.validations.customerEmailConfirmationRequired'),
                        'email': i18next.t('complete.reservationForm.validations.customerEmailInvalidFormat'),
                        'equalTo': i18next.t('complete.reservationForm.validations.customerEmailConfirmationEqualsEmail')
                    },
                    'customer_phone': {
                        'required': i18next.t('complete.reservationForm.validations.customerPhoneNumberRequired'),
                        'minlength': i18next.t('complete.reservationForm.validations.customerPhoneNumberMinLength')
                    },
                    'customer_document_id': {
                        'required': i18next.t('complete.reservationForm.validations.fieldRequired')
                    },
                    'street': {
                        'required': i18next.t('complete.reservationForm.validations.fieldRequired')
                    },
                    'city': {
                        'required': i18next.t('complete.reservationForm.validations.fieldRequired')
                    },    
                    'state': {
                        'required': i18next.t('complete.reservationForm.validations.fieldRequired')
                    }, 
                    'zip': {
                        'required': i18next.t('complete.reservationForm.validations.fieldRequired')
                    }, 
                    'country': {
                        'required': i18next.t('complete.reservationForm.validations.fieldRequired')
                    },                                  
                    'driver_date_of_birth': {
                        'required': i18next.t('complete.reservationForm.validations.driverDateOfBirthRequired')
                    },
                    'number_of_adults': {
                        'required': i18next.t('complete.reservationForm.validations.numberOfAdultsRequired')
                    },
                    'conditions_read_request_reservation': {
                        'required': i18next.t('complete.reservationForm.validations.conditionsReadRequired')
                    },                       
                    'conditions_read_payment_on_delivery': {
                        'required': i18next.t('complete.reservationForm.validations.conditionsReadRequired')
                    },   
                    'conditions_read_pay_now': {
                        'required': i18next.t('complete.reservationForm.validations.conditionsReadRequired')
                    },                                     
                    'payment_method_select': {
                        'required': i18next.t('complete.reservationForm.validations.selectPaymentMethod')
                    },
                    'account_password': {
                        'required': i18next.t('complete.reservationForm.validations.fieldRequired'),
                        'pwcheck': i18next.t('complete.reservationForm.validations.passwordCheck'),
                        'minlength': i18next.t('complete.reservationForm.validations.minLength', {minlength: 8}),
                    },                     

                },

                errorPlacement: function (error, element) {

                    if (element.attr('name') == 'conditions_read_request_reservation' || 
                        element.attr('name') == 'conditions_read_payment_on_delivery' ||
                        element.attr('name') == 'conditions_read_pay_now')
                    {
                        error.insertAfter(element.parent().parent());
                    }
                    else if (element.attr('name') == 'payment_method_select') {
                        error.insertAfter(document.getElementById('payment_method_select_error'));
                    }
                    else
                    {
                        error.insertAfter(element);
                    }

                },

                errorClass : 'form-reservation-error'

            }
        );

    },

    /**
     * Configuration promotion code
     */
    setupPromotionCode: function() {

      if ( $('#apply_promotion_code_btn').length > 0) {
        $('#apply_promotion_code_btn').bind('click', function() {
           controller.applyPromotionCodeBtnClick($('#promotion_code').val());
        });
      }

    },

    // -------------------- View Updates

    /**
     * Updates the shopping card when the shopping cart is loaded
     */
    updateShoppingCart: function() { // Updates the shopping cart

    	// Show the product information   
      this.updateProducts();
      // Update the summary
      this.updateShoppingCartSummary();
      // Update the extras
      this.updateExtras();
      // Update the payment
      this.updatePayment();
      // Setup Promotion Code         
      if (model.configuration.promotionCode) {
        this.setupPromotionCode();
      }


    },

    /**
     * Updates the shopping cart when the user changes an Extra
     */
    updateShoppingCartExtra: function(extraCode, quantity) {

      // Updates the summary
      this.updateShoppingCartSummary();
      // Update the extra
      if (model.isCoverage(extraCode)) {
        this.updateExtras();
      }
      else {
        this.updateExtra(extraCode, quantity);
      }
      // Update the payment
      this.updatePayment();

    },


    /**
     * Updates the shopping card when the customer applies a promotion code
     */
    updateShoppingCartPromotionCode: function() { 

      // Show the product information   
      this.updateProducts();
      // Update the summary
      this.updateShoppingCartSummary();
      // Update the payument
      this.updatePayment();

      $('#promotion_code').attr('disabled', 'true');
      $('#apply_promotion_code_btn').attr('disabled', 'true');

    },

    /**
     * Updates the shopping cart summary
     */
    updateShoppingCartSummary: function() { // Updates the shopping cart summary (total)

       // Summary sticky
       if (document.getElementById('script_reservation_summary_sticky')) {
         var reservationDetailSticky = tmpl('script_reservation_summary_sticky')({shopping_cart: model.shopping_cart,
                                                                                  configuration: model.configuration});
         $('#reservation_detail_sticky').html(reservationDetailSticky);
       }

       // Summary
       if (document.getElementById('script_reservation_summary')) {
         var reservationDetail = tmpl('script_reservation_summary')({shopping_cart: model.shopping_cart,
                                                                     configuration: model.configuration});
         $('#reservation_detail').html(reservationDetail);
       }
      
       // Setup the events
       
       if ($('#modify_reservation_button').length) {
         // The user clicks on the modify reservation button
         $('#modify_reservation_button').bind('click', function() { 
              // Setup the wizard
              if (!view.selectorLoaded) {
                if (commonServices.selectorInProcess == 'wizard') {
                  selectorWizard.view.startFromShoppingCart(model.shopping_cart);
                }
                else {
                  selector.view.startFromShoppingCart(model.shopping_cart);
                }
                view.selectorLoaded = true;
              }
              // Show the wizard
              if (commonServices.selectorInProcess == 'wizard') {
                selectorWizard.view.showWizard();
              }
              else { // Show the reservation form
                // Compatibility with old version of the theme
                var modifyReservationModalSelector = '#choose_productModal';
                if ($('#modify_reservation_modal').length) {
                  modifyReservationModalSelector = '#modify_reservation_modal'
                }
                // Compatibility with libraries that overrides $.modal
                if (commonServices.jsBsModalNoConflict && typeof $.fn.bootstrapModal !== 'undefined') {
                  $(modifyReservationModalSelector).bootstrapModal(commonServices.jsBSModalShowOptions());
                }
                else {
                  if ($.fn.modal) {
                    $(modifyReservationModalSelector).modal(commonServices.jsBSModalShowOptions());
                  }
                }
              }
         });
       }

    },

    // -------------------- View Updates Support    

    /**
     * Update the products
     */
    updateProducts: function() {

      if (document.getElementById('script_product_detail')) {  
        if (!$('#script_product_detail').is(':empty')) {
          var productInfo = tmpl('script_product_detail')(
                        {configuration: model.configuration, 
                         shopping_cart: model.shopping_cart});
          $('#selected_product').html(productInfo);
        }
      }

    },

    /**
     * Update and extra
     */
    updateExtra: function(extraCode, quantity) {

      // Button add / remove extra quantity
      $('.extra-input[data-extra-code='+extraCode+']').val(quantity);

      // Button extra toggle
      if (quantity == 0) {
        $('.extra-check-button[data-extra-code='+extraCode+']').removeClass('extra-selected');
      }
      else {
        $('.extra-check-button[data-extra-code='+extraCode+']').addClass('extra-selected');
      }

    },

    /**
     * Updates all extras
     */
    updateExtras: function() { 

        if (document.getElementById('script_detailed_extra')) {
          // Show the extras
          var result = tmpl('script_detailed_extra')({extras:model.extras,
                                                      coverages: model.coverages,
                                                      configuration: model.configuration,   
                                                      extrasInShoppingCart: model.getShoppingCartExtrasQuantities(),
                                                      i18next: i18next,
                                                      shopping_cart: model.shopping_cart});
          $('#extras_listing').html(result);

          // == Setup events

          // Extra check button [1 unit]
          $('.extra-check-button').bind('click', function() {
              var extraCode = $(this).attr('data-extra-code');
              if ($(this).hasClass('extra-selected')) {
                controller.extraUnchecked(extraCode);
              }
              else {
                controller.extraChecked(extraCode);
              }
          });

          // Extra checkbox [1 unit]
          $('.extra-checkbox').bind('change', function() {
              var extraCode = $(this).attr('data-value');
              var checked = $(this).is(':checked');
              if (checked) {
                  controller.extraChecked(extraCode);
              }
              else {
                  controller.extraUnchecked(extraCode);
              }
          });

          // Extra select [N units]
          $('.extra-select').bind('change', function() {
              var extraCode = $(this).attr('data-extra-code');
              var extraQuantity = $(this).val();
              controller.extraQuantityChanged(extraCode, extraQuantity);
          });

          // Extra minus button extra clicked [N units]
          $('.btn-minus-extra').bind('click', function() {
              var extraCode = $(this).attr('data-value');
              var extraQuantity = parseInt($('#extra-'+extraCode+'-quantity').val() || '0');
              if (extraQuantity > 0) {
                extraQuantity--;     
                controller.btnMinusExtraClicked(extraCode, extraQuantity);
              }
          });

          // Extra plus button extra clicked [N units]
          $('.btn-plus-extra').bind('click', function() {
              var extraCode = $(this).attr('data-value');
              var extraQuantity = parseInt($('#extra-'+extraCode+'-quantity').val() || '0');
              var maxQuantity = $(this).attr('data-max-quantity');
              console.log(extraQuantity);
              console.log(maxQuantity);
              if (extraQuantity < maxQuantity) {
                extraQuantity++;     
                controller.btnPlusExtraClicked(extraCode, extraQuantity);
              }
          });  

          // Bind the event to show detailed extra
          $('.js-extra-info-btn').bind('click', function(){
            controller.extraDetailIconClick($(this).attr('data-extra'));
          });  
        }

    },

    /**
     * Updates the payment
     */
    updatePayment: function() {
      var paymentInfo = tmpl('script_payment_detail')(
                    {sales_process: model.sales_process,
                     shopping_cart: model.shopping_cart,
                     configuration: model.configuration,
                     i18next: i18next });
      $('#payment_detail').html(paymentInfo);

      $('#btn_reservation').bind('click', function() {
         $('form[name=reservation_form]').submit();
      });

      // Choose complete action between different options:
      //  - request reservation
      //  - pay on delivery
      //  - pay now
      if ($('input[name=complete_action]').length > 0) {
        $('input[name=complete_action]').bind('change', function() {
           controller.completeActionChange();
        });
      }
      // Choose between different payment methods
      if ($('.payment_method_select').length) {
          $('.payment_method_select').unbind('change');
          $('.payment_method_select').bind('change', function(){
            controller.paymentMethodSelectChange($(this).val());
          });
      }
    },

    // -------------------- Show extra detail    

    showExtraDetail: function() {
      if (document.getElementById('script_extra_modal')) {
        var result = tmpl('script_extra_modal')({
                        extra: model.extraDetail
                      });
        $('#modalExtraDetail .modal-extra-detail-title').html(model.extraDetail.name);
        $('#modalExtraDetail .modal-extra-detail-content').html(result);
        // Compatibility with libraries that overrides $.modal
        if (commonServices.jsBsModalNoConflict && typeof $.fn.bootstrapModal !== 'undefined') {
          $('#modalExtraDetail').bootstrapModal(commonServices.jsBSModalShowOptions());
        }
        else {
          if ($.fn.modal) {
            $('#modalExtraDetail').modal(commonServices.jsBSModalShowOptions());
          }
        }
      }      
    },

    // -------------------- Go to payment
    
    /**
     * payment
     */
    payment: function(url, bookingId, paymentData) {

      var summaryUrl = commonServices.summaryUrl + '?id=' + bookingId;
      rentEngineMediator.onNewReservationPayment(url, summaryUrl, paymentData);

    },


    /**
     * Go to payment
     */
    gotoPayment: function(url, paymentData) {

      $.form(url, paymentData, 'POST').submit();

    },


    // -------------------- Go to summary
    
    /**
     * Go to Summary page
     */
    gotoSummary: function(bookingId) {

      window.location.href = commonServices.summaryUrl + '?id=' + bookingId;

    },

  };

  // Check if it is a booking recorded in order to load summary page
  var shoppingCartId = model.getShoppingCartFreeAccessId();
  if (shoppingCartId == null) {
    // Not shoppingcart in session => Try if it was a booking
    var bookingId = model.getBookingFreeAccessId();
    if (bookingId != null) {
      window.location.href = commonServices.summaryUrl + '?id=' + bookingId;
    }
  }

  // Prepare the mediator
  var rentComplete = {
    model: model,
    controller: controller,
    view: view
  }
  rentEngineMediator.setComplete( rentComplete );

  // The loader is show on start and hidden after the result of
  // the search has been rendered (in model.loadShoppingCart)
  commonLoader.show();
  
  // Load the settings
  model.loadSettings();

}).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);


/***/ }),
/* 54 */
/***/ (function(module, exports, __webpack_require__) {

Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0), __webpack_require__(14),__webpack_require__(12),
         __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), __webpack_require__(9),
         __webpack_require__(13), 
         __webpack_require__(3),__webpack_require__(6), __webpack_require__(24), __webpack_require__(7),
         __webpack_require__(8),   
         __webpack_require__(5), __webpack_require__(0), __webpack_require__(19)]; (function($, RemoteDataSource, SelectSelector,
             commonServices, commonSettings, commonTranslations, commonLoader, rentEngineMediator, 
             i18next, tmpl, DateControl, moment) {

  var model = { // THE MODEL
    requestLanguage: null,
    configuration: null,        
    bookingFreeAccessId : null,
    booking: null,
    sales_process: null,

    // -------------- Load settings ----------------------------

    loadSettings: function() {
      commonSettings.loadSettings(function(data){
        model.configuration = data;
        view.init();
      });
    },  

    // ------------ Product information detail ------------------------

    getUrlVars : function() {
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars;
    },

    extractVariables: function() { // Load variables from the request

      var url_vars = this.getUrlVars();
      this.bookingFreeAccessId = decodeURIComponent(url_vars['id']);

    },

    // ----------------- Reservation ------------------------------

    getBookingFreeAccessId: function() { /* Get the booking id */
      return sessionStorage.getItem('booking_free_access_id');
    },

    setBookingFreeAccessId: function(bookingFreeAccessId) { /* Set the booking id */
      sessionStorage.setItem('booking_free_access_id', bookingFreeAccessId);
    },

    loadBooking: function() { /** Load the reservation **/

       var bookingId = this.bookingFreeAccessId;

       if (bookingId == '') {
         bookingId = this.getBookingFreeAccessId();
       }

       // Build the URL
       var url = commonServices.URL_PREFIX + '/api/booking/frontend/booking/' +
                 bookingId;
       var urlParams = [];
       if (this.requestLanguage != null) {
         urlParams.push('lang=' + this.requestLanguage);
       }
       if (commonServices.apiKey && commonServices.apiKey != '') {
         urlParams.push('api_key='+commonServices.apiKey);
       }           
       if (urlParams.length > 0) {
         url += '?';
         url += urlParams.join('&');
       }
       // Request          
       $.ajax({
               type: 'GET',
               url : url,
               dataType : 'json',
               contentType : 'application/json; charset=utf-8',
               crossDomain: true,
               success: function(data, textStatus, jqXHR) {
                 if (model.requestLanguage != data.booking.customer_language &&
                     data.booking.customer_language != null &&
                     data.booking.customer_language != '') {
                   window.location.href = data.booking.customer_language + commonServices.summaryUrl.startsWith('/') ? '' : '/' +
                                          commonServices.summaryUrl + '?id=' + data.booking.free_access_id;
                 }
                 else {
                   model.booking = data.booking;
                   model.bookingFreeAccessId = data.booking.free_access_id;
                   model.sales_process = data.sales_process;
                   view.updateBooking();
                 }

               },
               error: function(data, textStatus, jqXHR) {
                 commonLoader.hide();
                 alert(i18next.t('summary.loadReservation.error'));
               },
               complete: function(jqXHR, textStatus) {
                 $('#content').show();
                 $('#sidebar').show();
               }
          });
    }

  };

  var controller = { // THE CONTROLLER
    btnPaymentClick: function(paymentMethod) {
       model.sendPayRequest();
    },
    btnUpdateClick: function() {
       model.update();
    }
  };

  var view = { // THE VIEW

    init: function() {
      model.requestLanguage = commonSettings.language(document.documentElement.lang);
      // Initialize i18next for translations
      i18next.init({  
                      lng: model.requestLanguage,
                      resources: commonTranslations
                   }, 
                   function (error, t) {
                      // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                      //jqueryI18next.init(i18next, $);
                      // Localize UI
                      //$('.nav').localize();
                   });      
      // Setup UI          
      model.extractVariables();
      model.loadBooking();
    },

    updateBooking: function() { // Updates the reservation

      this.updateTitle();
      this.updateBookingSummary();
      commonLoader.hide();

    },

    updateTitle: function() {
      $('#reservation_title').html(model.booking.summary_status);
    },

    updateBookingSummary: function() { // Updates the shopping cart summary (total)

       var reservationDetail = tmpl('script_reservation_summary')(
            {booking: model.booking,
             configuration: model.configuration});
       $('#reservation_detail').html(reservationDetail);

    }


  };


  var rentSummary = {
    model: model,
    controller: controller,
    view: view
  }
  rentEngineMediator.setSummary( rentSummary );

  // The loader is show on start and hidden after the reservation
  // has been rendered
  commonLoader.show();

  // Load settings
  model.loadSettings();

}).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);


/***/ }),
/* 55 */
/***/ (function(module, exports, __webpack_require__) {

Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0), __webpack_require__(14),__webpack_require__(18),__webpack_require__(12), __webpack_require__(23),
         __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), __webpack_require__(9),  
         __webpack_require__(13),
         __webpack_require__(3),__webpack_require__(6), __webpack_require__(24), __webpack_require__(7),
         __webpack_require__(8),   
         __webpack_require__(5), __webpack_require__(0), __webpack_require__(19)]; (function($, RemoteDataSource, MemoryDataSource, SelectSelector, select2,
             commonServices, commonSettings, commonTranslations, commonLoader, rentEngineMediator,
             i18next, tmpl, DateControl, moment) {

  var model = { // THE MODEL
    requestLanguage: null,
    configuration: null,        
    bookingFreeAccessId : null,
    booking: null,
    sales_process: null,

    // -------------- Load settings ----------------------------

    loadSettings: function() {
      commonSettings.loadSettings(function(data){
        model.configuration = data;
        view.init();
      });
    },  

    // ------------ Product information detail ------------------------

    getUrlVars : function() {
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars;
    },

    extractVariables: function() { // Load variables from the request

      var url_vars = this.getUrlVars();
      this.bookingFreeAccessId = decodeURIComponent(url_vars['id']);

    },

    // ----------------- Reservation ------------------------------

    getBookingFreeAccessId: function() { /* Get the booking id */
      return sessionStorage.getItem('booking_free_access_id');
    },

    setBookingFreeAccessId: function(bookingFreeAccessId) { /* Set the booking id */
      sessionStorage.setItem('booking_free_access_id', bookingFreeAccessId);
    },

    loadBooking: function() { /** Load the reservation **/

       var bookingId = this.bookingFreeAccessId;
       if (bookingId == '') {
         bookingId = this.getBookingFreeAccessId();
       }

       // Build the URL
       var url = commonServices.URL_PREFIX + '/api/booking/frontend/booking/' +
                 bookingId;
       var urlParams = [];
       if (this.requestLanguage != null) {
         urlParams.push('lang=' + this.requestLanguage);
       }
       if (commonServices.apiKey && commonServices.apiKey != '') {
         urlParams.push('api_key='+commonServices.apiKey);
       }           
       if (urlParams.length > 0) {
         url += '?';
         url += urlParams.join('&');
       }
       // Request
       $.ajax({
               type: 'GET',
               url : url,
               dataType : 'json',
               contentType : 'application/json; charset=utf-8',
               crossDomain: true,
               success: function(data, textStatus, jqXHR) {

                 if (model.requestLanguage != data.booking.customer_language &&
                     data.booking.customer_language != null &&
                     data.booking.customer_language != '') {
                   window.location.href = data.booking.customer_language + commonServices.summaryUrl.startsWith('/') ? '' : '/' +
                                          commonServices.summaryUrl + '?id=' + data.booking.free_access_id;
                 }
                 else {
                   model.booking = data.booking;
                   model.bookingFreeAccessId = data.booking.free_access_id;
                   model.sales_process = data.sales_process;
                   view.updateBooking();
                 }

               },
               error: function(data, textStatus, jqXHR) {
                 commonLoader.hide(); 
                 alert(i18next.t('myReservation.loadReservation.error'));

               },
               complete: function(jqXHR, textStatus) {
                 $('#content').show();
                 $('#sidebar').show();
               }
          });
    },

    sendPayRequest: function() {
      var bookingId = this.bookingFreeAccessId;
      if (bookingId == '') {
        bookingId = this.getBookingFreeAccessId();
      }
      else {
        this.setBookingFreeAccessId(bookingId);
      }
      var data = $('form[name=payment_form]').formParams();
      data['id'] = bookingId;
      // Do payment
      view.payment( commonServices.URL_PREFIX + '/reserva/pagar', data );
    },

    update: function() {
        // Build request
        var reservation = $('form[name=booking_information_form]').formParams(false);
        var booking_line_resources = reservation['booking_line_resources']
        delete reservation['booking_line_resources'];
        reservation['booking_line_resources'] = [];
        for (item in booking_line_resources) {
            reservation['booking_line_resources'].push(booking_line_resources[item]);
        }
        var reservationJSON = encodeURIComponent(JSON.stringify(reservation));
        // Build URL
        var url = commonServices.URL_PREFIX + '/api/booking/frontend/booking/' + this.bookingFreeAccessId;
        var urlParams = [];
        if (this.requestLanguage != null) {
          urlParams.push('lang=' + this.requestLanguage);
        }
        if (commonServices.apiKey && commonServices.apiKey != '') {
          urlParams.push('api_key='+commonServices.apiKey);
        }           
        if (urlParams.length > 0) {
          url += '?';
          url += urlParams.join('&');
        }
        // Request
        $.ajax({
            type: 'PUT',
            url : url,
            data: reservationJSON,
            dataType : 'json',
            contentType : 'application/json; charset=utf-8',
            crossDomain: true,
            success: function(data, textStatus, jqXHR) {
                alert(i18next.t('myReservation.updateReservation.success'));
            },
            error: function(data, textStatus, jqXHR) {
                alert(i18next.t('myReservation.updateReservation.error'));
            }
        });

    }    

  };

  var controller = { // THE CONTROLLER
    btnPaymentClick: function(paymentMethod) {
       model.sendPayRequest();
    },
    btnUpdateClick: function() {
       model.update();
    }
  };

  var view = { // THE VIEW

    init: function() {
      model.requestLanguage = commonSettings.language(document.documentElement.lang);
      // Initialize i18next for translations
      i18next.init({  
                      lng: model.requestLanguage,
                      resources: commonTranslations
                   }, 
                   function (error, t) {
                      // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                      //jqueryI18next.init(i18next, $);
                      // Localize UI
                      //$('.nav').localize();
                   });      
      // Setup UI          
      model.extractVariables();
      model.loadBooking();
    },

    updateBooking: function() { // Updates the reservation

      this.updateTitle();
      this.updateBookingSummary();
      this.setupReservationForm();
      commonLoader.hide();

    },

    updateTitle: function() {
      $('#reservation_title').html(model.booking.summary_status);
    },

    updateBookingSummary: function() { // Updates the shopping cart summary (total)

       var reservationDetail = tmpl('script_reservation_summary')(
            {booking: model.booking,
             configuration: model.configuration});
       $('#reservation_detail').html(reservationDetail);


       if (model.booking.manager_complete_authorized) {
         // Micro-template reservation
         if (document.getElementById('script_reservation_form')) {
           var reservationForm = tmpl('script_reservation_form')(
                {booking: model.booking,
                 configuration: model.configuration});
           $('#reservation_form_container').html(reservationForm);
           $('#reservation_form_container').show();
         }
         // Micro-template payment
         if (document.getElementById('script_payment_detail')) {
           // If the booking is pending show the payment controls
           if (model.sales_process.can_pay) {
             var amount = 0;
             if (model.sales_process.can_pay_pending) {
               amount = model.booking.total_pending;
             }
             else if (model.sales_process.can_pay_deposit) {
               amount = model.booking.booking_amount;
             }
             else if (model.sales_process.can_pay_total) {
               amount = model.booking.total_cost;
             }
             var paymentInfo = tmpl('script_payment_detail')(
              {
                sales_process: model.sales_process,
                amount: amount,
                booking: model.booking,
                configuration: model.configuration,
                i18next: i18next            
              });
             $('#payment_detail').html(paymentInfo);
             this.setupPaymentFormValidation();
             $('#payment_detail').show();
           }
         }
       }

    },

    setupReservationForm: function() {

      // Load countries
      var countries = i18next.t('common.countries', {returnObjects: true });
      if (countries instanceof Object) {
        var countryCodes = Object.keys(countries);
        var countriesArray = countryCodes.map(function(value){ 
                                return {id: value, text: countries[value], description: countries[value]};
                             });
      } else {
        var countriesArray = [];
      }
      var values = [model.booking.address_country,
                    model.booking.driver_driving_license_country,
                    model.booking.additional_driver_1_driving_license_country,
                    model.booking.additional_driver_2_driving_license_country]; 

      if (commonServices.jsUseSelect2) {
        // Configure address country
        var selectors = ['select[name=customer_address\\[country\\]]',
                         'select[name=driver_driving_license_country]',
                         'select[name=additional_driver_1_driving_license_country]',
                         'select[name=additional_driver_2_driving_license_country]'];
        for (var idx=0; idx<selectors.length; idx++) { 
          $countrySelector = $(selectors[idx]);    
          if ($countrySelector.length > 0 && typeof values[idx] !== 'undefined') {
            $countrySelector.select2({
              width: '100%',
              theme: 'bootstrap4',                  
              data: countriesArray
            });
            // Assign value
            var value = (values[idx] !== null && values[idx] !== '' ? values[idx] : '');
            $countrySelector.val(values[idx]);
            $countrySelector.trigger('change');
          }
        }
      }
      else {
        // Setup country selector
        var selectors = ['country', 
                         'driver_driving_license_country', 
                         'additional_driver_1_driving_license_country',
                         'additional_driver_2_driving_license_country'];
        for (var idx=0; idx<selectors.length; idx++) { 
          if (document.getElementById(selectors[idx])) {
            var countriesDataSource = new MemoryDataSource(countriesArray);
            var countryModel = (values[idx] == null ? '' : values[idx]);
            var selectorModel = new SelectSelector(selectors[idx],
                countriesDataSource, countryModel, true, i18next.t('myReservation.select_country'));
          }
        }        
      }

      // Configure driver document id date
      if (document.getElementById('driver_document_id_date_day')) {
        var dateControl = new DateControl(document.getElementById('driver_document_id_date_day'),
                        document.getElementById('driver_document_id_date_month'),
                        document.getElementById('driver_document_id_date_year'),
                        document.getElementById('driver_document_id_date'),
                        commonSettings.language(model.requestLanguage));
        if (model.booking.driver_document_id_date) {
          dateControl.setDate(model.booking.driver_document_id_date);
        }        
      }

      // Configure driver date of birth 
      if (document.getElementById('driver_date_of_birth_day')) {
        var dateControl = new DateControl(document.getElementById('driver_date_of_birth_day'),
                        document.getElementById('driver_date_of_birth_month'),
                        document.getElementById('driver_date_of_birth_year'),
                        document.getElementById('driver_date_of_birth'),
                        commonSettings.language(model.requestLanguage));
        if (model.booking.driver_date_of_birth) {
          dateControl.setDate(model.booking.driver_date_of_birth);
        }
      }
      // Configure driver driving license date 
      if (document.getElementById('driver_driving_license_date_day')) {
        var dateControl = new DateControl(document.getElementById('driver_driving_license_date_day'),
                        document.getElementById('driver_driving_license_date_month'),
                        document.getElementById('driver_driving_license_date_year'),
                        document.getElementById('driver_driving_license_date'),
                        commonSettings.language(model.requestLanguage));
        if (model.booking.driver_driving_license_date) {
          dateControl.setDate(model.booking.driver_driving_license_date);
        }
      }

      // Configure driving license country
      if ($('select[name=driver_driving_license_country]').length) {
        $('select[name=driver_driving_license_country]').val(model.booking.driver_driving_license_country);
      }

      // Configure additional driver 1 driving license date 
      if (document.getElementById('additional_driver_1_driving_license_date_day')) {
        var dateControl = new DateControl(document.getElementById('additional_driver_1_driving_license_date_day'),
                        document.getElementById('additional_driver_1_driving_license_date_month'),
                        document.getElementById('additional_driver_1_driving_license_date_year'),
                        document.getElementById('additional_driver_1_driving_license_date'),
                        commonSettings.language(model.requestLanguage));
        if (model.booking.additional_driver_1_driving_license_date) {
          dateControl.setDate(model.booking.additional_driver_1_driving_license_date);
        }        
      }
      // Configuration additional driver 2 driving license date
      if (document.getElementById('additional_driver_2_driving_license_date_day')) {
        var dateControl = new DateControl(document.getElementById('additional_driver_2_driving_license_date_day'),
                        document.getElementById('additional_driver_2_driving_license_date_month'),
                        document.getElementById('additional_driver_2_driving_license_date_year'),
                        document.getElementById('additional_driver_2_driving_license_date'),
                        commonSettings.language(model.requestLanguage));
        if (model.booking.additional_driver_2_driving_license_date) {
          dateControl.setDate(model.booking.additional_driver_2_driving_license_date);
        }        
      }

      $('form[name=booking_information_form]').validate(
          {
              submitHandler: function(form) {
                  controller.btnUpdateClick();
                  return false;
              }
          }
      );


    },

    setupPaymentFormValidation: function() {

        $('form[name=payment_form]').validate(
            {
                submitHandler: function(form) {
                    controller.btnPaymentClick();
                    return false;
                },
                errorClass: 'text-danger',
                rules : {
                    'payment_method_id': 'required'
                },
                messages: {
                    'payment_method_id': i18next.t('myReservation.pay.paymentMethodRequired')
                },
                errorPlacement : function(error, element) {
                  if (element.attr('name') == 'payment_method_id')  {
                     error.insertBefore('#btn_pay');
                  }
                  else {
                     error.insertAfter(element);
                  }
                }
            }
        );

    },

    /**
     * Payment
     */
    payment: function(url, paymentData) {

      rentEngineMediator.onExistingReservationPayment(url, paymentData);

    },
    
    /*
     * Go to the payment
     */
    gotoPayment: function(url, paymentData) {

      $.form(url, paymentData,'POST').submit();

    }


  };


  var rentMyReservation = {
    model: model,
    controller: controller,
    view: view
  }
  rentEngineMediator.setMyReservation( rentMyReservation );

  // The loader is show on start and hidden after the reservation
  // has been rendered
  commonLoader.show();

  // Load settings
  model.loadSettings();

}).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);


/***/ }),
/* 56 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;// https://longbill.github.io/jquery-date-range-picker/
// jquery.daterangepicker.js
// author : Chunlong Liu
// license : MIT
// www.jszen.com

(function(factory) {
    if (true) {
        // AMD. Register as an anonymous module.
        !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0), __webpack_require__(7)], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
    } else {}
}(function($, moment) {
    'use strict';
    $.dateRangePickerLanguages = {
        "default": //default language: English
        {
            "selected": "Selected:",
            "day": "Day",
            "days": "Days",
            "apply": "Close",
            "week-1": "mo",
            "week-2": "tu",
            "week-3": "we",
            "week-4": "th",
            "week-5": "fr",
            "week-6": "sa",
            "week-7": "su",
            "week-number": "W",
            "month-name": ["january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december"],
            "shortcuts": "Shortcuts",
            "custom-values": "Custom Values",
            "past": "Past",
            "following": "Following",
            "previous": "Previous",
            "prev-week": "Week",
            "prev-month": "Month",
            "prev-year": "Year",
            "next": "Next",
            "next-week": "Week",
            "next-month": "Month",
            "next-year": "Year",
            "less-than": "Date range should not be more than %d days",
            "more-than": "Date range should not be less than %d days",
            "default-more": "Please select a date range longer than %d days",
            "default-single": "Please select a date",
            "default-less": "Please select a date range less than %d days",
            "default-range": "Please select a date range between %d and %d days",
            "default-default": "Please select a date range",
            "time": "Time",
            "hour": "Hour",
            "minute": "Minute"
        },
        "id": {
            "selected": "Terpilih:",
            "day": "Hari",
            "days": "Hari",
            "apply": "Tutup",
            "week-1": "sen",
            "week-2": "sel",
            "week-3": "rab",
            "week-4": "kam",
            "week-5": "jum",
            "week-6": "sab",
            "week-7": "min",
            "week-number": "W",
            "month-name": ["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober", "november", "desember"],
            "shortcuts": "Pintas",
            "custom-values": "Nilai yang ditentukan",
            "past": "Yang Lalu",
            "following": "Mengikuti",
            "previous": "Sebelumnya",
            "prev-week": "Minggu",
            "prev-month": "Bulan",
            "prev-year": "Tahun",
            "next": "Selanjutnya",
            "next-week": "Minggu",
            "next-month": "Bulan",
            "next-year": "Tahun",
            "less-than": "Tanggal harus lebih dari %d hari",
            "more-than": "Tanggal harus kurang dari %d hari",
            "default-more": "Jarak tanggal harus lebih lama dari %d hari",
            "default-single": "Silakan pilih tanggal",
            "default-less": "Jarak rentang tanggal tidak boleh lebih lama dari %d hari",
            "default-range": "Rentang tanggal harus antara %d dan %d hari",
            "default-default": "Silakan pilih rentang tanggal",
            "time": "Waktu",
            "hour": "Jam",
            "minute": "Menit"
        },
        "az": {
            "selected": "Seçildi:",
            "day": " gün",
            "days": " gün",
            "apply": "tətbiq",
            "week-1": "1",
            "week-2": "2",
            "week-3": "3",
            "week-4": "4",
            "week-5": "5",
            "week-6": "6",
            "week-7": "7",
            "month-name": ["yanvar", "fevral", "mart", "aprel", "may", "iyun", "iyul", "avqust", "sentyabr", "oktyabr", "noyabr", "dekabr"],
            "shortcuts": "Qısayollar",
            "past": "Keçmiş",
            "following": "Növbəti",
            "previous": "&nbsp;&nbsp;&nbsp;",
            "prev-week": "Öncəki həftə",
            "prev-month": "Öncəki ay",
            "prev-year": "Öncəki il",
            "next": "&nbsp;&nbsp;&nbsp;",
            "next-week": "Növbəti həftə",
            "next-month": "Növbəti ay",
            "next-year": "Növbəti il",
            "less-than": "Tarix aralığı %d gündən çox olmamalıdır",
            "more-than": "Tarix aralığı %d gündən az olmamalıdır",
            "default-more": "%d gündən çox bir tarix seçin",
            "default-single": "Tarix seçin",
            "default-less": "%d gündən az bir tarix seçin",
            "default-range": "%d və %d gün aralığında tarixlər seçin",
            "default-default": "Tarix aralığı seçin"
        },
        "bg": {
            "selected": "Избрано:",
            "day": "Ден",
            "days": "Дни",
            "apply": "Затвори",
            "week-1": "пн",
            "week-2": "вт",
            "week-3": "ср",
            "week-4": "чт",
            "week-5": "пт",
            "week-6": "сб",
            "week-7": "нд",
            "week-number": "С",
            "month-name": ["януари", "февруари", "март", "април", "май", "юни", "юли", "август", "септември", "октомври", "ноември", "декември"],
            "shortcuts": "Преки пътища",
            "custom-values": "Персонализирани стойности",
            "past": "Минал",
            "following": "Следващ",
            "previous": "Предишен",
            "prev-week": "Седмица",
            "prev-month": "Месец",
            "prev-year": "Година",
            "next": "Следващ",
            "next-week": "Седмица",
            "next-month": "Месец",
            "next-year": "Година",
            "less-than": "Периодът от време не трябва да е повече от %d дни",
            "more-than": "Периодът от време не трябва да е по-малко от %d дни",
            "default-more": "Моля изберете период по-дълъг от %d дни",
            "default-single": "Моля изберете дата",
            "default-less": "Моля изберете период по-къс от %d дни",
            "default-range": "Моля изберете период между %d и %d дни",
            "default-default": "Моля изберете период",
            "time": "Време",
            "hour": "Час",
            "minute": "Минута"
        },
        "cn": //simplified chinese
        {
            "selected": "已选择:",
            "day": "天",
            "days": "天",
            "apply": "确定",
            "week-1": "一",
            "week-2": "二",
            "week-3": "三",
            "week-4": "四",
            "week-5": "五",
            "week-6": "六",
            "week-7": "日",
            "week-number": "周",
            "month-name": ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
            "shortcuts": "快捷选择",
            "past": "过去",
            "following": "将来",
            "previous": "&nbsp;&nbsp;&nbsp;",
            "prev-week": "上周",
            "prev-month": "上个月",
            "prev-year": "去年",
            "next": "&nbsp;&nbsp;&nbsp;",
            "next-week": "下周",
            "next-month": "下个月",
            "next-year": "明年",
            "less-than": "所选日期范围不能大于%d天",
            "more-than": "所选日期范围不能小于%d天",
            "default-more": "请选择大于%d天的日期范围",
            "default-less": "请选择小于%d天的日期范围",
            "default-range": "请选择%d天到%d天的日期范围",
            "default-single": "请选择一个日期",
            "default-default": "请选择一个日期范围",
            "time": "时间",
            "hour": "小时",
            "minute": "分钟"
        },
        "cz": {
            "selected": "Vybráno:",
            "day": "Den",
            "days": "Dny",
            "apply": "Zavřít",
            "week-1": "po",
            "week-2": "út",
            "week-3": "st",
            "week-4": "čt",
            "week-5": "pá",
            "week-6": "so",
            "week-7": "ne",
            "month-name": ["leden", "únor", "březen", "duben", "květen", "červen", "červenec", "srpen", "září", "říjen", "listopad", "prosinec"],
            "shortcuts": "Zkratky",
            "past": "po",
            "following": "následující",
            "previous": "předchozí",
            "prev-week": "týden",
            "prev-month": "měsíc",
            "prev-year": "rok",
            "next": "další",
            "next-week": "týden",
            "next-month": "měsíc",
            "next-year": "rok",
            "less-than": "Rozsah data by neměl být větší než %d dnů",
            "more-than": "Rozsah data by neměl být menší než %d dnů",
            "default-more": "Prosím zvolte rozsah data větší než %d dnů",
            "default-single": "Prosím zvolte datum",
            "default-less": "Prosím zvolte rozsah data menší než %d dnů",
            "default-range": "Prosím zvolte rozsah data mezi %d a %d dny",
            "default-default": "Prosím zvolte rozsah data"
        },
        "de": {
            "selected": "Auswahl:",
            "day": "Tag",
            "days": "Tage",
            "apply": "Schließen",
            "week-1": "mo",
            "week-2": "di",
            "week-3": "mi",
            "week-4": "do",
            "week-5": "fr",
            "week-6": "sa",
            "week-7": "so",
            "month-name": ["januar", "februar", "märz", "april", "mai", "juni", "juli", "august", "september", "oktober", "november", "dezember"],
            "shortcuts": "Schnellwahl",
            "past": "Vorherige",
            "following": "Folgende",
            "previous": "Vorherige",
            "prev-week": "Woche",
            "prev-month": "Monat",
            "prev-year": "Jahr",
            "next": "Nächste",
            "next-week": "Woche",
            "next-month": "Monat",
            "next-year": "Jahr",
            "less-than": "Datumsbereich darf nicht größer sein als %d Tage",
            "more-than": "Datumsbereich darf nicht kleiner sein als %d Tage",
            "default-more": "Bitte mindestens %d Tage auswählen",
            "default-single": "Bitte ein Datum auswählen",
            "default-less": "Bitte weniger als %d Tage auswählen",
            "default-range": "Bitte einen Datumsbereich zwischen %d und %d Tagen auswählen",
            "default-default": "Bitte ein Start- und Enddatum auswählen",
            "Time": "Zeit",
            "hour": "Stunde",
            "minute": "Minute"
        },
        "es": {
            "selected": "Seleccionado:",
            "day": "Día",
            "days": "Días",
            "apply": "Cerrar",
            "week-1": "lu",
            "week-2": "ma",
            "week-3": "mi",
            "week-4": "ju",
            "week-5": "vi",
            "week-6": "sa",
            "week-7": "do",
            "month-name": ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"],
            "shortcuts": "Accesos directos",
            "past": "Pasado",
            "following": "Siguiente",
            "previous": "Anterior",
            "prev-week": "Semana",
            "prev-month": "Mes",
            "prev-year": "Año",
            "next": "Siguiente",
            "next-week": "Semana",
            "next-month": "Mes",
            "next-year": "Año",
            "less-than": "El rango no debería ser mayor de %d días",
            "more-than": "El rango no debería ser menor de %d días",
            "default-more": "Por favor selecciona un rango mayor a %d días",
            "default-single": "Por favor selecciona un día",
            "default-less": "Por favor selecciona un rango menor a %d días",
            "default-range": "Por favor selecciona un rango entre %d y %d días",
            "default-default": "Por favor selecciona un rango de fechas."
        },
        "fr": {
            "selected": "Sélection:",
            "day": "Jour",
            "days": "Jours",
            "apply": "Fermer",
            "week-1": "lu",
            "week-2": "ma",
            "week-3": "me",
            "week-4": "je",
            "week-5": "ve",
            "week-6": "sa",
            "week-7": "di",
            "month-name": ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
            "shortcuts": "Raccourcis",
            "past": "Passé",
            "following": "Suivant",
            "previous": "Précédent",
            "prev-week": "Semaine",
            "prev-month": "Mois",
            "prev-year": "Année",
            "next": "Suivant",
            "next-week": "Semaine",
            "next-month": "Mois",
            "next-year": "Année",
            "less-than": "L'intervalle ne doit pas être supérieure à %d jours",
            "more-than": "L'intervalle ne doit pas être inférieure à %d jours",
            "default-more": "Merci de choisir une intervalle supérieure à %d jours",
            "default-single": "Merci de choisir une date",
            "default-less": "Merci de choisir une intervalle inférieure %d jours",
            "default-range": "Merci de choisir une intervalle comprise entre %d et %d jours",
            "default-default": "Merci de choisir une date"
        },
        "hu": {
            "selected": "Kiválasztva:",
            "day": "Nap",
            "days": "Nap",
            "apply": "Ok",
            "week-1": "h",
            "week-2": "k",
            "week-3": "sz",
            "week-4": "cs",
            "week-5": "p",
            "week-6": "sz",
            "week-7": "v",
            "month-name": ["január", "február", "március", "április", "május", "június", "július", "augusztus", "szeptember", "október", "november", "december"],
            "shortcuts": "Gyorsválasztó",
            "past": "Múlt",
            "following": "Következő",
            "previous": "Előző",
            "prev-week": "Hét",
            "prev-month": "Hónap",
            "prev-year": "Év",
            "next": "Következő",
            "next-week": "Hét",
            "next-month": "Hónap",
            "next-year": "Év",
            "less-than": "A kiválasztás nem lehet több %d napnál",
            "more-than": "A kiválasztás nem lehet több %d napnál",
            "default-more": "Válassz ki egy időszakot ami hosszabb mint %d nap",
            "default-single": "Válassz egy napot",
            "default-less": "Válassz ki egy időszakot ami rövidebb mint %d nap",
            "default-range": "Válassz ki egy %d - %d nap hosszú időszakot",
            "default-default": "Válassz ki egy időszakot"
        },
        "it": {
            "selected": "Selezionati:",
            "day": "Giorno",
            "days": "Giorni",
            "apply": "Chiudi",
            "week-1": "lu",
            "week-2": "ma",
            "week-3": "me",
            "week-4": "gi",
            "week-5": "ve",
            "week-6": "sa",
            "week-7": "do",
            "month-name": ["gennaio", "febbraio", "marzo", "aprile", "maggio", "giugno", "luglio", "agosto", "settembre", "ottobre", "novembre", "dicembre"],
            "shortcuts": "Scorciatoie",
            "past": "Scorso",
            "following": "Successivo",
            "previous": "Precedente",
            "prev-week": "Settimana",
            "prev-month": "Mese",
            "prev-year": "Anno",
            "next": "Prossimo",
            "next-week": "Settimana",
            "next-month": "Mese",
            "next-year": "Anno",
            "less-than": "L'intervallo non dev'essere maggiore di %d giorni",
            "more-than": "L'intervallo non dev'essere minore di %d giorni",
            "default-more": "Seleziona un intervallo maggiore di %d giorni",
            "default-single": "Seleziona una data",
            "default-less": "Seleziona un intervallo minore di %d giorni",
            "default-range": "Seleziona un intervallo compreso tra i %d e i %d giorni",
            "default-default": "Seleziona un intervallo di date"
        },
        "ko": {
            "selected": "기간:",
            "day": "일",
            "days": "일간",
            "apply": "닫기",
            "week-1": "월",
            "week-2": "화",
            "week-3": "수",
            "week-4": "목",
            "week-5": "금",
            "week-6": "토",
            "week-7": "일",
            "week-number": "주",
            "month-name": ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
            "shortcuts": "단축키들",
            "past": "지난(오늘기준)",
            "following": "이후(오늘기준)",
            "previous": "이전",
            "prev-week": "1주",
            "prev-month": "1달",
            "prev-year": "1년",
            "next": "다음",
            "next-week": "1주",
            "next-month": "1달",
            "next-year": "1년",
            "less-than": "날짜 범위는 %d 일보다 많을 수 없습니다",
            "more-than": "날짜 범위는 %d 일보다 작을 수 없습니다",
            "default-more": "날짜 범위를 %d 일보다 길게 선택해 주세요",
            "default-single": "날짜를 선택해 주세요",
            "default-less": "%d 일보다 작은 날짜를 선택해 주세요",
            "default-range": "%d와 %d 일 사이의 날짜 범위를 선택해 주세요",
            "default-default": "날짜 범위를 선택해 주세요",
            "time": "시각",
            "hour": "시",
            "minute": "분"
        },
        "no": {
            "selected": "Valgt:",
            "day": "Dag",
            "days": "Dager",
            "apply": "Lukk",
            "week-1": "ma",
            "week-2": "ti",
            "week-3": "on",
            "week-4": "to",
            "week-5": "fr",
            "week-6": "lø",
            "week-7": "sø",
            "month-name": ["januar", "februar", "mars", "april", "mai", "juni", "juli", "august", "september", "oktober", "november", "desember"],
            "shortcuts": "Snarveier",
            "custom-values": "Egendefinerte Verdier",
            "past": "Over", // Not quite sure about the context of this one
            "following": "Følger",
            "previous": "Forrige",
            "prev-week": "Uke",
            "prev-month": "Måned",
            "prev-year": "År",
            "next": "Neste",
            "next-week": "Uke",
            "next-month": "Måned",
            "next-year": "År",
            "less-than": "Datoperioden skal ikkje være lengre enn %d dager",
            "more-than": "Datoperioden skal ikkje være kortere enn %d dager",
            "default-more": "Vennligst velg ein datoperiode lengre enn %d dager",
            "default-single": "Vennligst velg ein dato",
            "default-less": "Vennligst velg ein datoperiode mindre enn %d dager",
            "default-range": "Vennligst velg ein datoperiode mellom %d og %d dager",
            "default-default": "Vennligst velg ein datoperiode",
            "time": "Tid",
            "hour": "Time",
            "minute": "Minutter"
        },
        "nl": {
            "selected": "Geselecteerd:",
            "day": "Dag",
            "days": "Dagen",
            "apply": "Ok",
            "week-1": "ma",
            "week-2": "di",
            "week-3": "wo",
            "week-4": "do",
            "week-5": "vr",
            "week-6": "za",
            "week-7": "zo",
            "month-name": ["januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december"],
            "shortcuts": "Snelkoppelingen",
            "custom-values": "Aangepaste waarden",
            "past": "Verleden",
            "following": "Komend",
            "previous": "Vorige",
            "prev-week": "Week",
            "prev-month": "Maand",
            "prev-year": "Jaar",
            "next": "Volgende",
            "next-week": "Week",
            "next-month": "Maand",
            "next-year": "Jaar",
            "less-than": "Interval moet langer dan %d dagen zijn",
            "more-than": "Interval mag niet minder dan %d dagen zijn",
            "default-more": "Selecteer een interval langer dan %dagen",
            "default-single": "Selecteer een datum",
            "default-less": "Selecteer een interval minder dan %d dagen",
            "default-range": "Selecteer een interval tussen %d en %d dagen",
            "default-default": "Selecteer een interval",
            "time": "Tijd",
            "hour": "Uur",
            "minute": "Minuut"
        },
        "ru": {
            "selected": "Выбрано:",
            "day": "День",
            "days": "Дней",
            "apply": "Применить",
            "week-1": "пн",
            "week-2": "вт",
            "week-3": "ср",
            "week-4": "чт",
            "week-5": "пт",
            "week-6": "сб",
            "week-7": "вс",
            "month-name": ["январь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сентябрь", "октябрь", "ноябрь", "декабрь"],
            "shortcuts": "Быстрый выбор",
            "custom-values": "Пользовательские значения",
            "past": "Прошедшие",
            "following": "Следующие",
            "previous": "&nbsp;&nbsp;&nbsp;",
            "prev-week": "Неделя",
            "prev-month": "Месяц",
            "prev-year": "Год",
            "next": "&nbsp;&nbsp;&nbsp;",
            "next-week": "Неделя",
            "next-month": "Месяц",
            "next-year": "Год",
            "less-than": "Диапазон не может быть больше %d дней",
            "more-than": "Диапазон не может быть меньше %d дней",
            "default-more": "Пожалуйста выберите диапазон больше %d дней",
            "default-single": "Пожалуйста выберите дату",
            "default-less": "Пожалуйста выберите диапазон меньше %d дней",
            "default-range": "Пожалуйста выберите диапазон между %d и %d днями",
            "default-default": "Пожалуйста выберите диапазон",
            "time": "Время",
            "hour": "Часы",
            "minute": "Минуты"
        },
        "uk": {
            "selected": "Вибрано:",
            "day": "День",
            "days": "Днів",
            "apply": "Застосувати",
            "week-1": "пн",
            "week-2": "вт",
            "week-3": "ср",
            "week-4": "чт",
            "week-5": "пт",
            "week-6": "сб",
            "week-7": "нд",
            "month-name": ["січень", "лютий", "березень", "квітень", "травень", "червень", "липень", "серпень", "вересень", "жовтень", "листопад", "грудень"],
            "shortcuts": "Швидкий вибір",
            "custom-values": "Значення користувача",
            "past": "Минулі",
            "following": "Наступні",
            "previous": "&nbsp;&nbsp;&nbsp;",
            "prev-week": "Тиждень",
            "prev-month": "Місяць",
            "prev-year": "Рік",
            "next": "&nbsp;&nbsp;&nbsp;",
            "next-week": "Тиждень",
            "next-month": "Місяць",
            "next-year": "Рік",
            "less-than": "Діапазон не може бути більш ніж %d днів",
            "more-than": "Діапазон не може бути меньш ніж %d днів",
            "default-more": "Будь ласка виберіть діапазон більше %d днів",
            "default-single": "Будь ласка виберіть дату",
            "default-less": "Будь ласка виберіть діапазон менше %d днів",
            "default-range": "Будь ласка виберіть діапазон між %d та %d днями",
            "default-default": "Будь ласка виберіть діапазон",
            "time": "Час",
            "hour": "Години",
            "minute": "Хвилини"
        },
        "pl": {
            "selected": "Wybrany:",
            "day": "Dzień",
            "days": "Dni",
            "apply": "Zamknij",
            "week-1": "pon",
            "week-2": "wt",
            "week-3": "śr",
            "week-4": "czw",
            "week-5": "pt",
            "week-6": "so",
            "week-7": "nd",
            "month-name": ["styczeń", "luty", "marzec", "kwiecień", "maj", "czerwiec", "lipiec", "sierpień", "wrzesień", "październik", "listopad", "grudzień"],
            "shortcuts": "Skróty",
            "custom-values": "Niestandardowe wartości",
            "past": "Przeszłe",
            "following": "Następne",
            "previous": "Poprzednie",
            "prev-week": "tydzień",
            "prev-month": "miesiąc",
            "prev-year": "rok",
            "next": "Następny",
            "next-week": "tydzień",
            "next-month": "miesiąc",
            "next-year": "rok",
            "less-than": "Okres nie powinien być dłuższy niż %d dni",
            "more-than": "Okres nie powinien być krótszy niż  %d ni",
            "default-more": "Wybierz okres dłuższy niż %d dni",
            "default-single": "Wybierz datę",
            "default-less": "Wybierz okres krótszy niż %d dni",
            "default-range": "Wybierz okres trwający od %d do %d dni",
            "default-default": "Wybierz okres",
            "time": "Czas",
            "hour": "Godzina",
            "minute": "Minuta"
        },
        "se": {
            "selected": "Vald:",
            "day": "dag",
            "days": "dagar",
            "apply": "godkänn",
            "week-1": "ma",
            "week-2": "ti",
            "week-3": "on",
            "week-4": "to",
            "week-5": "fr",
            "week-6": "lö",
            "week-7": "sö",
            "month-name": ["januari", "februari", "mars", "april", "maj", "juni", "juli", "augusti", "september", "oktober", "november", "december"],
            "shortcuts": "genvägar",
            "custom-values": "Anpassade värden",
            "past": "över",
            "following": "följande",
            "previous": "förra",
            "prev-week": "vecka",
            "prev-month": "månad",
            "prev-year": "år",
            "next": "nästa",
            "next-week": "vecka",
            "next-month": "måned",
            "next-year": "år",
            "less-than": "Datumintervall bör inte vara mindre än %d dagar",
            "more-than": "Datumintervall bör inte vara mer än %d dagar",
            "default-more": "Välj ett datumintervall längre än %d dagar",
            "default-single": "Välj ett datum",
            "default-less": "Välj ett datumintervall mindre än %d dagar",
            "default-range": "Välj ett datumintervall mellan %d och %d dagar",
            "default-default": "Välj ett datumintervall",
            "time": "tid",
            "hour": "timme",
            "minute": "minut"
        },
        "pt": //Portuguese (European)
        {
            "selected": "Selecionado:",
            "day": "Dia",
            "days": "Dias",
            "apply": "Fechar",
            "week-1": "seg",
            "week-2": "ter",
            "week-3": "qua",
            "week-4": "qui",
            "week-5": "sex",
            "week-6": "sab",
            "week-7": "dom",
            "week-number": "N",
            "month-name": ["janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"],
            "shortcuts": "Atalhos",
            "custom-values": "Valores Personalizados",
            "past": "Passado",
            "following": "Seguinte",
            "previous": "Anterior",
            "prev-week": "Semana",
            "prev-month": "Mês",
            "prev-year": "Ano",
            "next": "Próximo",
            "next-week": "Próxima Semana",
            "next-month": "Próximo Mês",
            "next-year": "Próximo Ano",
            "less-than": "O período selecionado não deve ser maior que %d dias",
            "more-than": "O período selecionado não deve ser menor que %d dias",
            "default-more": "Selecione um período superior a %d dias",
            "default-single": "Selecione uma data",
            "default-less": "Selecione um período inferior a %d dias",
            "default-range": "Selecione um período de %d a %d dias",
            "default-default": "Selecione um período",
            "time": "Tempo",
            "hour": "Hora",
            "minute": "Minuto"
        },
        "tc": // traditional chinese
        {
            "selected": "已選擇:",
            "day": "天",
            "days": "天",
            "apply": "確定",
            "week-1": "一",
            "week-2": "二",
            "week-3": "三",
            "week-4": "四",
            "week-5": "五",
            "week-6": "六",
            "week-7": "日",
            "week-number": "周",
            "month-name": ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
            "shortcuts": "快速選擇",
            "past": "過去",
            "following": "將來",
            "previous": "&nbsp;&nbsp;&nbsp;",
            "prev-week": "上週",
            "prev-month": "上個月",
            "prev-year": "去年",
            "next": "&nbsp;&nbsp;&nbsp;",
            "next-week": "下周",
            "next-month": "下個月",
            "next-year": "明年",
            "less-than": "所選日期範圍不能大於%d天",
            "more-than": "所選日期範圍不能小於%d天",
            "default-more": "請選擇大於%d天的日期範圍",
            "default-less": "請選擇小於%d天的日期範圍",
            "default-range": "請選擇%d天到%d天的日期範圍",
            "default-single": "請選擇一個日期",
            "default-default": "請選擇一個日期範圍",
            "time": "日期",
            "hour": "小時",
            "minute": "分鐘"
        },
        "ja": {
            "selected": "選択しました:",
            "day": "日",
            "days": "日々",
            "apply": "閉じる",
            "week-1": "月",
            "week-2": "火",
            "week-3": "水",
            "week-4": "木",
            "week-5": "金",
            "week-6": "土",
            "week-7": "日",
            "month-name": ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
            "shortcuts": "クイック選択",
            "past": "過去",
            "following": "将来",
            "previous": "&nbsp;&nbsp;&nbsp;",
            "prev-week": "先週、",
            "prev-month": "先月",
            "prev-year": "昨年",
            "next": "&nbsp;&nbsp;&nbsp;",
            "next-week": "来週",
            "next-month": "来月",
            "next-year": "来年",
            "less-than": "日付の範囲は ％d 日以上にすべきではありません",
            "more-than": "日付の範囲は ％d 日を下回ってはいけません",
            "default-more": "％d 日よりも長い期間を選択してください",
            "default-less": "％d 日未満の期間を選択してください",
            "default-range": "％d と％ d日の間の日付範囲を選択してください",
            "default-single": "日付を選択してください",
            "default-default": "日付範囲を選択してください",
            "time": "時間",
            "hour": "時間",
            "minute": "分"
        },
        "da": {
            "selected": "Valgt:",
            "day": "Dag",
            "days": "Dage",
            "apply": "Luk",
            "week-1": "ma",
            "week-2": "ti",
            "week-3": "on",
            "week-4": "to",
            "week-5": "fr",
            "week-6": "lö",
            "week-7": "sö",
            "month-name": ["januar", "februar", "marts", "april", "maj", "juni", "juli", "august", "september", "oktober", "november", "december"],
            "shortcuts": "genveje",
            "custom-values": "Brugerdefinerede værdier",
            "past": "Forbi",
            "following": "Følgende",
            "previous": "Forrige",
            "prev-week": "uge",
            "prev-month": "månad",
            "prev-year": "år",
            "next": "Næste",
            "next-week": "Næste uge",
            "next-month": "Næste måned",
            "next-year": "Næste år",
            "less-than": "Dato interval bør ikke være med end %d dage",
            "more-than": "Dato interval bør ikke være mindre end %d dage",
            "default-more": "Vælg datointerval længere end %d dage",
            "default-single": "Vælg dato",
            "default-less": "Vælg datointerval mindre end %d dage",
            "default-range": "Vælg datointerval mellem %d og %d dage",
            "default-default": "Vælg datointerval",
            "time": "tid",
            "hour": "time",
            "minute": "minut"
        },
        "fi": // Finnish
        {
            "selected": "Valittu:",
            "day": "Päivä",
            "days": "Päivää",
            "apply": "Sulje",
            "week-1": "ma",
            "week-2": "ti",
            "week-3": "ke",
            "week-4": "to",
            "week-5": "pe",
            "week-6": "la",
            "week-7": "su",
            "week-number": "V",
            "month-name": ["tammikuu", "helmikuu", "maaliskuu", "huhtikuu", "toukokuu", "kesäkuu", "heinäkuu", "elokuu", "syyskuu", "lokakuu", "marraskuu", "joulukuu"],
            "shortcuts": "Pikavalinnat",
            "custom-values": "Mukautetut Arvot",
            "past": "Menneet",
            "following": "Tulevat",
            "previous": "Edellinen",
            "prev-week": "Viikko",
            "prev-month": "Kuukausi",
            "prev-year": "Vuosi",
            "next": "Seuraava",
            "next-week": "Viikko",
            "next-month": "Kuukausi",
            "next-year": "Vuosi",
            "less-than": "Aikajakson tulisi olla vähemmän kuin %d päivää",
            "more-than": "Aikajakson ei tulisi olla vähempää kuin %d päivää",
            "default-more": "Valitse pidempi aikajakso kuin %d päivää",
            "default-single": "Valitse päivä",
            "default-less": "Valitse lyhyempi aikajakso kuin %d päivää",
            "default-range": "Valitse aikajakso %d ja %d päivän väliltä",
            "default-default": "Valitse aikajakso",
            "time": "Aika",
            "hour": "Tunti",
            "minute": "Minuutti"
        },
        "cat": // Catala
        {
            "selected": "Seleccionats:",
            "day": "Dia",
            "days": "Dies",
            "apply": "Tanca",
            "week-1": "Dl",
            "week-2": "Dm",
            "week-3": "Dc",
            "week-4": "Dj",
            "week-5": "Dv",
            "week-6": "Ds",
            "week-7": "Dg",
            "week-number": "S",
            "month-name": ["gener", "febrer", "març", "abril", "maig", "juny", "juliol", "agost", "setembre", "octubre", "novembre", "desembre"],
            "shortcuts": "Dreçeres",
            "custom-values": "Valors personalitzats",
            "past": "Passat",
            "following": "Futur",
            "previous": "Anterior",
            "prev-week": "Setmana",
            "prev-month": "Mes",
            "prev-year": "Any",
            "next": "Següent",
            "next-week": "Setmana",
            "next-month": "Mes",
            "next-year": "Any",
            "less-than": "El període no hauria de ser de més de %d dies",
            "more-than": "El període no hauria de ser de menys de %d dies",
            "default-more": "Perfavor selecciona un període més gran de %d dies",
            "default-single": "Perfavor selecciona una data",
            "default-less": "Perfavor selecciona un període de menys de %d dies",
            "default-range": "Perfavor selecciona un període d'entre %d i %d dies",
            "default-default": "Perfavor selecciona un període",
            "time": "Temps",
            "hour": "Hora",
            "minute": "Minut"
        }
    };

    $.fn.dateRangePicker = function(opt) {
        if (!opt) opt = {};
        opt = $.extend(true, {
            autoClose: false,
            format: 'YYYY-MM-DD',
            separator: ' to ',
            language: 'auto',
            startOfWeek: 'sunday', // or monday
            getValue: function() {
                return $(this).val();
            },
            setValue: function(s) {
                if (!$(this).attr('readonly') && !$(this).is(':disabled') && s != $(this).val()) {
                    $(this).val(s);
                }
            },
            startDate: false,
            endDate: false,
            time: {
                enabled: false
            },
            minDays: 0,
            maxDays: 0,
            allowSelectBetweenInvalid: false,
            showShortcuts: false,
            shortcuts: {
                //'prev-days': [1,3,5,7],
                // 'next-days': [3,5,7],
                //'prev' : ['week','month','year'],
                // 'next' : ['week','month','year']
            },
            customShortcuts: [],
            inline: false,
            container: 'body',
            alwaysOpen: false,
            singleDate: false,
            lookBehind: false,
            batchMode: false,
            duration: 200,
            stickyMonths: false,
            dayDivAttrs: [],
            dayTdAttrs: [],
            selectForward: false,
            selectBackward: false,
            applyBtnClass: '',
            singleMonth: 'auto',
            hoveringTooltip: function(days, startTime, hoveringTime) {
                return days > 1 ? days + ' ' + translate('days') : '';
            },
            showTopbar: true,
            swapTime: false,
            showWeekNumbers: false,
            getWeekNumber: function(date) //date will be the first day of a week
            {
                return moment(date).format('w');
            },
            customOpenAnimation: null,
            customCloseAnimation: null,
            customArrowPrevSymbol: null,
            customArrowNextSymbol: null,
            monthSelect: false,
            yearSelect: false
        }, opt);

        opt.start = false;
        opt.end = false;

        opt.startWeek = false;

        //detect a touch device
        opt.isTouchDevice = 'ontouchstart' in window || navigator.msMaxTouchPoints;

        //if it is a touch device, hide hovering tooltip
        if (opt.isTouchDevice) opt.hoveringTooltip = false;

        //show one month on mobile devices
        if (opt.singleMonth == 'auto') opt.singleMonth = $(window).width() < 480;
        if (opt.singleMonth) opt.stickyMonths = false;

        if (!opt.showTopbar) opt.autoClose = true;

        if (opt.startDate && typeof opt.startDate == 'string') opt.startDate = moment(opt.startDate, opt.format).toDate();
        if (opt.endDate && typeof opt.endDate == 'string') opt.endDate = moment(opt.endDate, opt.format).toDate();

        if (opt.yearSelect && typeof opt.yearSelect === 'boolean') {
            opt.yearSelect = function(current) { return [current - 5, current + 5]; }
        }

        var languages = getLanguages();
        var box;
        var initiated = false;
        var self = this;
        var selfDom = $(self).get(0);
        var domChangeTimer;

        $(this).off('.datepicker').on('click.datepicker', function(evt) {
            var isOpen = box.is(':visible');
            if (!isOpen) open(opt.duration);
        }).on('change.datepicker', function(evt) {
            checkAndSetDefaultValue();
        }).on('keyup.datepicker', function() {
            try {
                clearTimeout(domChangeTimer);
            } catch (e) {}
            domChangeTimer = setTimeout(function() {
                checkAndSetDefaultValue();
            }, 2000);
        });

        init_datepicker.call(this);

        if (opt.alwaysOpen) {
            open(0);
        }

        // expose some api
        $(this).data('dateRangePicker', {
            setStart: function(d1) {
                if (typeof d1 == 'string') {
                    d1 = moment(d1, opt.format).toDate();
                }

                opt.end = false;
                setSingleDate(d1);

                return this;
            },
            setEnd: function(d2, silent) {
                var start = new Date();
                start.setTime(opt.start);
                if (typeof d2 == 'string') {
                    d2 = moment(d2, opt.format).toDate();
                }
                setDateRange(start, d2, silent);
                return this;
            },
            setDateRange: function(d1, d2, silent) {
                if (typeof d1 == 'string' && typeof d2 == 'string') {
                    d1 = moment(d1, opt.format).toDate();
                    d2 = moment(d2, opt.format).toDate();
                }
                setDateRange(d1, d2, silent);
            },
            clear: clearSelection,
            close: closeDatePicker,
            open: open,
            redraw: redrawDatePicker,
            getDatePicker: getDatePicker,
            resetMonthsView: resetMonthsView,
            opt: opt,
            destroy: function() {
                $(self).off('.datepicker');
                $(self).data('dateRangePicker', '');
                $(self).data('date-picker-opened', null);
                box.remove();
                $(window).off('resize.datepicker', calcPosition);
                $(document).off('click.datepicker', outsideClickClose);
            }
        });

        $(window).on('resize.datepicker', calcPosition);

        return this;

        function IsOwnDatePickerClicked(evt, selfObj) {
            return (selfObj.contains(evt.target) || evt.target == selfObj || (selfObj.childNodes != undefined && $.inArray(evt.target, selfObj.childNodes) >= 0));
        }

        function init_datepicker() {
            var self = this;

            if ($(this).data('date-picker-opened')) {
                closeDatePicker();
                return;
            }
            $(this).data('date-picker-opened', true);


            box = createDom().hide();
            box.append('<div class="date-range-length-tip"></div>');

            $(opt.container).append(box);

            if (!opt.inline) {
                calcPosition();
            } else {
                box.addClass('inline-wrapper');
            }

            if (opt.alwaysOpen) {
                box.find('.apply-btn').hide();
            }

            var defaultTime = getDefaultTime();
            resetMonthsView(defaultTime);

            if (opt.time.enabled) {
                if ((opt.startDate && opt.endDate) || (opt.start && opt.end)) {
                    showTime(moment(opt.start || opt.startDate).toDate(), 'time1');
                    showTime(moment(opt.end || opt.endDate).toDate(), 'time2');
                } else {
                    var defaultEndTime = opt.defaultEndTime ? opt.defaultEndTime : defaultTime;
                    showTime(defaultTime, 'time1');
                    showTime(defaultEndTime, 'time2');
                }
            }

            //showSelectedInfo();


            var defaultTopText = '';
            if (opt.singleDate)
                defaultTopText = translate('default-single');
            else if (opt.minDays && opt.maxDays)
                defaultTopText = translate('default-range');
            else if (opt.minDays)
                defaultTopText = translate('default-more');
            else if (opt.maxDays)
                defaultTopText = translate('default-less');
            else
                defaultTopText = translate('default-default');

            box.find('.default-top').html(defaultTopText.replace(/\%d/, opt.minDays).replace(/\%d/, opt.maxDays));
            if (opt.singleMonth) {
                box.addClass('single-month');
            } else {
                box.addClass('two-months');
            }


            setTimeout(function() {
                updateCalendarWidth();
                initiated = true;
            }, 0);

            box.click(function(evt) {
                evt.stopPropagation();
            });

            //if user click other place of the webpage, close date range picker window
            $(document).on('click.datepicker', outsideClickClose);

            box.find('.next').click(function() {
                if (!opt.stickyMonths)
                    gotoNextMonth(this);
                else
                    gotoNextMonth_stickily(this);
            });

            function gotoNextMonth(self) {
                var isMonth2 = $(self).parents('table').hasClass('month2');
                var month = isMonth2 ? opt.month2 : opt.month1;
                month = nextMonth(month);
                if (!opt.singleMonth && !opt.singleDate && !isMonth2 && compare_month(month, opt.month2) >= 0 || isMonthOutOfBounds(month)) return;
                showMonth(month, isMonth2 ? 'month2' : 'month1');
                showGap();
            }

            function gotoNextMonth_stickily(self) {
                var nextMonth1 = nextMonth(opt.month1);
                var nextMonth2 = nextMonth(opt.month2);
                if (isMonthOutOfBounds(nextMonth2)) return;
                if (!opt.singleDate && compare_month(nextMonth1, nextMonth2) >= 0) return;
                showMonth(nextMonth1, 'month1');
                showMonth(nextMonth2, 'month2');
                showSelectedDays();
            }


            box.find('.prev').click(function() {
                if (!opt.stickyMonths)
                    gotoPrevMonth(this);
                else
                    gotoPrevMonth_stickily(this);
            });

            function gotoPrevMonth(self) {
                var isMonth2 = $(self).parents('table').hasClass('month2');
                var month = isMonth2 ? opt.month2 : opt.month1;
                month = prevMonth(month);
                if (isMonth2 && compare_month(month, opt.month1) <= 0 || isMonthOutOfBounds(month)) return;
                showMonth(month, isMonth2 ? 'month2' : 'month1');
                showGap();
            }

            function gotoPrevMonth_stickily(self) {
                var prevMonth1 = prevMonth(opt.month1);
                var prevMonth2 = prevMonth(opt.month2);
                if (isMonthOutOfBounds(prevMonth1)) return;
                if (!opt.singleDate && compare_month(prevMonth2, prevMonth1) <= 0) return;
                showMonth(prevMonth2, 'month2');
                showMonth(prevMonth1, 'month1');
                showSelectedDays();
            }

            box.attr('unselectable', 'on')
                .css('user-select', 'none')
                .on('selectstart', function(e) {
                    e.preventDefault();
                    return false;
                });

            box.find('.apply-btn').click(function() {
                closeDatePicker();
                var dateRange = getDateString(new Date(opt.start)) + opt.separator + getDateString(new Date(opt.end));
                $(self).trigger('datepicker-apply', {
                    'value': dateRange,
                    'date1': new Date(opt.start),
                    'date2': new Date(opt.end)
                });
            });

            box.find('[custom]').click(function() {
                var valueName = $(this).attr('custom');
                opt.start = false;
                opt.end = false;
                box.find('.day.checked').removeClass('checked');
                opt.setValue.call(selfDom, valueName);
                checkSelectionValid();
                showSelectedInfo(true);
                showSelectedDays();
                if (opt.autoClose) closeDatePicker();
            });

            box.find('[shortcut]').click(function() {
                var shortcut = $(this).attr('shortcut');
                var end = new Date(),
                    start = false;
                var dir;
                if (shortcut.indexOf('day') != -1) {
                    var day = parseInt(shortcut.split(',', 2)[1], 10);
                    start = new Date(new Date().getTime() + 86400000 * day);
                    end = new Date(end.getTime() + 86400000 * (day > 0 ? 1 : -1));
                } else if (shortcut.indexOf('week') != -1) {
                    dir = shortcut.indexOf('prev,') != -1 ? -1 : 1;
                    var stopDay;
                    if (dir == 1)
                        stopDay = opt.startOfWeek == 'monday' ? 1 : 0;
                    else
                        stopDay = opt.startOfWeek == 'monday' ? 0 : 6;

                    end = new Date(end.getTime() - 86400000);
                    while (end.getDay() != stopDay) end = new Date(end.getTime() + dir * 86400000);
                    start = new Date(end.getTime() + dir * 86400000 * 6);
                } else if (shortcut.indexOf('month') != -1) {
                    dir = shortcut.indexOf('prev,') != -1 ? -1 : 1;
                    if (dir == 1)
                        start = nextMonth(end);
                    else
                        start = prevMonth(end);
                    start.setDate(1);
                    end = nextMonth(start);
                    end.setDate(1);
                    end = new Date(end.getTime() - 86400000);
                } else if (shortcut.indexOf('year') != -1) {
                    dir = shortcut.indexOf('prev,') != -1 ? -1 : 1;
                    start = new Date();
                    start.setFullYear(end.getFullYear() + dir);
                    start.setMonth(0);
                    start.setDate(1);
                    end.setFullYear(end.getFullYear() + dir);
                    end.setMonth(11);
                    end.setDate(31);
                } else if (shortcut == 'custom') {
                    var name = $(this).html();
                    if (opt.customShortcuts && opt.customShortcuts.length > 0) {
                        for (var i = 0; i < opt.customShortcuts.length; i++) {
                            var sh = opt.customShortcuts[i];
                            if (sh.name == name) {
                                var data = [];
                                // try
                                // {
                                data = sh['dates'].call();
                                //}catch(e){}
                                if (data && data.length == 2) {
                                    start = data[0];
                                    end = data[1];
                                }

                                // if only one date is specified then just move calendars there
                                // move calendars to show this date's month and next months
                                if (data && data.length == 1) {
                                    var movetodate = data[0];
                                    showMonth(movetodate, 'month1');
                                    showMonth(nextMonth(movetodate), 'month2');
                                    showGap();
                                }

                                break;
                            }
                        }
                    }
                }
                if (start && end) {
                    setDateRange(start, end);
                    checkSelectionValid();
                }
            });

            box.find('.time1 input[type=range]').on('change touchmove', function(e) {
                var target = e.target,
                    hour = target.name == 'hour' ? $(target).val().replace(/^(\d{1})$/, '0$1') : undefined,
                    min = target.name == 'minute' ? $(target).val().replace(/^(\d{1})$/, '0$1') : undefined;
                setTime('time1', hour, min);
            });

            box.find('.time2 input[type=range]').on('change touchmove', function(e) {
                var target = e.target,
                    hour = target.name == 'hour' ? $(target).val().replace(/^(\d{1})$/, '0$1') : undefined,
                    min = target.name == 'minute' ? $(target).val().replace(/^(\d{1})$/, '0$1') : undefined;
                setTime('time2', hour, min);
            });

        }


        function calcPosition() {
            if (!opt.inline) {
                var offset = $(self).offset();
                if ($(opt.container).css('position') == 'relative') {
                    var containerOffset = $(opt.container).offset();
                    var leftIndent = Math.max(0, offset.left + box.outerWidth() - $('body').width() + 16);
                    box.css({
                        top: offset.top - containerOffset.top + $(self).outerHeight() + 4,
                        left: offset.left - containerOffset.left - leftIndent
                    });
                } else {
                    if (offset.left < 460) //left to right
                    {
                        box.css({
                            top: offset.top + $(self).outerHeight() + parseInt($('body').css('border-top') || 0, 10),
                            left: offset.left
                        });
                    } else {
                        box.css({
                            top: offset.top + $(self).outerHeight() + parseInt($('body').css('border-top') || 0, 10),
                            left: offset.left + $(self).width() - box.width() - 16
                        });
                    }
                }
            }
        }

        // Return the date picker wrapper element
        function getDatePicker() {
            return box;
        }

        function open(animationTime) {
            redrawDatePicker();
            checkAndSetDefaultValue();
            if (opt.customOpenAnimation) {
                opt.customOpenAnimation.call(box.get(0), function() {
                    $(self).trigger('datepicker-opened', {
                        relatedTarget: box
                    });
                });
            } else {
                box.slideDown(animationTime, function() {
                    $(self).trigger('datepicker-opened', {
                        relatedTarget: box
                    });
                });
            }
            $(self).trigger('datepicker-open', {
                relatedTarget: box
            });
            showGap();
            updateCalendarWidth();
            calcPosition();
        }

        function checkAndSetDefaultValue() {
            var __default_string = opt.getValue.call(selfDom);
            var defaults = __default_string ? __default_string.split(opt.separator) : '';

            if (defaults && ((defaults.length == 1 && opt.singleDate) || defaults.length >= 2)) {
                var ___format = opt.format;
                if (___format.match(/Do/)) {

                    ___format = ___format.replace(/Do/, 'D');
                    defaults[0] = defaults[0].replace(/(\d+)(th|nd|st)/, '$1');
                    if (defaults.length >= 2) {
                        defaults[1] = defaults[1].replace(/(\d+)(th|nd|st)/, '$1');
                    }
                }
                // set initiated  to avoid triggerring datepicker-change event
                initiated = false;
                if (defaults.length >= 2) {
                    setDateRange(getValidValue(defaults[0], ___format, moment.locale(opt.language)), getValidValue(defaults[1], ___format, moment.locale(opt.language)));
                } else if (defaults.length == 1 && opt.singleDate) {
                    setSingleDate(getValidValue(defaults[0], ___format, moment.locale(opt.language)));
                }

                initiated = true;
            }
        }

        function getValidValue(date, format, locale) {
            if (moment(date, format, locale).isValid()) {
                return moment(date, format, locale).toDate();
            } else {
                return moment().toDate();
            }
        }

        function updateCalendarWidth() {
            var gapMargin = box.find('.gap').css('margin-left');
            if (gapMargin) gapMargin = parseInt(gapMargin);
            var w1 = box.find('.month1').width();
            var w2 = box.find('.gap').width() + (gapMargin ? gapMargin * 2 : 0);
            var w3 = box.find('.month2').width();
            box.find('.month-wrapper').width(w1 + w2 + w3);
        }

        function renderTime(name, date) {
            box.find('.' + name + ' input[type=range].hour-range').val(moment(date).hours());
            box.find('.' + name + ' input[type=range].minute-range').val(moment(date).minutes());
            setTime(name, moment(date).format('HH'), moment(date).format('mm'));
        }

        function changeTime(name, date) {
            opt[name] = parseInt(
                moment(parseInt(date))
                .startOf('day')
                .add(moment(opt[name + 'Time']).format('HH'), 'h')
                .add(moment(opt[name + 'Time']).format('mm'), 'm').valueOf()
            );
        }

        function swapTime() {
            renderTime('time1', opt.start);
            renderTime('time2', opt.end);
        }

        function setTime(name, hour, minute) {
            hour && (box.find('.' + name + ' .hour-val').text(hour));
            minute && (box.find('.' + name + ' .minute-val').text(minute));
            switch (name) {
                case 'time1':
                    if (opt.start) {
                        setRange('start', moment(opt.start));
                    }
                    setRange('startTime', moment(opt.startTime || moment().valueOf()));
                    break;
                case 'time2':
                    if (opt.end) {
                        setRange('end', moment(opt.end));
                    }
                    setRange('endTime', moment(opt.endTime || moment().valueOf()));
                    break;
            }

            function setRange(name, timePoint) {
                var h = timePoint.format('HH'),
                    m = timePoint.format('mm');
                opt[name] = timePoint
                    .startOf('day')
                    .add(hour || h, 'h')
                    .add(minute || m, 'm')
                    .valueOf();
            }
            checkSelectionValid();
            showSelectedInfo();
            showSelectedDays();
        }

        function clearSelection() {
            opt.start = false;
            opt.end = false;
            box.find('.day.checked').removeClass('checked');
            box.find('.day.last-date-selected').removeClass('last-date-selected');
            box.find('.day.first-date-selected').removeClass('first-date-selected');
            opt.setValue.call(selfDom, '');
            checkSelectionValid();
            showSelectedInfo();
            showSelectedDays();
        }

        function handleStart(time) {
            var r = time;
            if (opt.batchMode === 'week-range') {
                if (opt.startOfWeek === 'monday') {
                    r = moment(parseInt(time)).startOf('isoweek').valueOf();
                } else {
                    r = moment(parseInt(time)).startOf('week').valueOf();
                }
            } else if (opt.batchMode === 'month-range') {
                r = moment(parseInt(time)).startOf('month').valueOf();
            }
            return r;
        }

        function handleEnd(time) {
            var r = time;
            if (opt.batchMode === 'week-range') {
                if (opt.startOfWeek === 'monday') {
                    r = moment(parseInt(time)).endOf('isoweek').valueOf();
                } else {
                    r = moment(parseInt(time)).endOf('week').valueOf();
                }
            } else if (opt.batchMode === 'month-range') {
                r = moment(parseInt(time)).endOf('month').valueOf();
            }
            return r;
        }


        function dayClicked(day) {
            if (day.hasClass('invalid')) return;
            var time = day.attr('time');
            day.addClass('checked');
            if (opt.singleDate) {
                opt.start = time;
                opt.end = false;
            } else if (opt.batchMode === 'week') {
                if (opt.startOfWeek === 'monday') {
                    opt.start = moment(parseInt(time)).startOf('isoweek').valueOf();
                    opt.end = moment(parseInt(time)).endOf('isoweek').valueOf();
                } else {
                    opt.end = moment(parseInt(time)).endOf('week').valueOf();
                    opt.start = moment(parseInt(time)).startOf('week').valueOf();
                }
            } else if (opt.batchMode === 'workweek') {
                opt.start = moment(parseInt(time)).day(1).valueOf();
                opt.end = moment(parseInt(time)).day(5).valueOf();
            } else if (opt.batchMode === 'weekend') {
                opt.start = moment(parseInt(time)).day(6).valueOf();
                opt.end = moment(parseInt(time)).day(7).valueOf();
            } else if (opt.batchMode === 'month') {
                opt.start = moment(parseInt(time)).startOf('month').valueOf();
                opt.end = moment(parseInt(time)).endOf('month').valueOf();
            } else if ((opt.start && opt.end) || (!opt.start && !opt.end)) {
                opt.start = handleStart(time);
                opt.end = false;
            } else if (opt.start) {
                opt.end = handleEnd(time);
                if (opt.time.enabled) {
                    changeTime('end', opt.end);
                }
            }

            //Update time in case it is enabled and timestamps are available
            if (opt.time.enabled) {
                if (opt.start) {
                    changeTime('start', opt.start);
                }
                if (opt.end) {
                    changeTime('end', opt.end);
                }
            }

            //In case the start is after the end, swap the timestamps
            if (!opt.singleDate && opt.start && opt.end && opt.start > opt.end) {
                var tmp = opt.end;
                opt.end = handleEnd(opt.start);
                opt.start = handleStart(tmp);
                if (opt.time.enabled && opt.swapTime) {
                    swapTime();
                }
            }

            opt.start = parseInt(opt.start);
            opt.end = parseInt(opt.end);

            clearHovering();
            if (opt.start && !opt.end) {
                $(self).trigger('datepicker-first-date-selected', {
                    'date1': new Date(opt.start)
                });
                dayHovering(day);
            }
            updateSelectableRange(time);

            checkSelectionValid();
            showSelectedInfo();
            showSelectedDays();
            autoclose();
        }


        function weekNumberClicked(weekNumberDom) {
            var thisTime = parseInt(weekNumberDom.attr('data-start-time'), 10);
            var date1, date2;
            if (!opt.startWeek) {
                opt.startWeek = thisTime;
                weekNumberDom.addClass('week-number-selected');
                date1 = new Date(thisTime);
                opt.start = moment(date1).day(opt.startOfWeek == 'monday' ? 1 : 0).valueOf();
                opt.end = moment(date1).day(opt.startOfWeek == 'monday' ? 7 : 6).valueOf();
            } else {
                box.find('.week-number-selected').removeClass('week-number-selected');
                date1 = new Date(thisTime < opt.startWeek ? thisTime : opt.startWeek);
                date2 = new Date(thisTime < opt.startWeek ? opt.startWeek : thisTime);
                opt.startWeek = false;
                opt.start = moment(date1).day(opt.startOfWeek == 'monday' ? 1 : 0).valueOf();
                opt.end = moment(date2).day(opt.startOfWeek == 'monday' ? 7 : 6).valueOf();
            }
            updateSelectableRange();
            checkSelectionValid();
            showSelectedInfo();
            showSelectedDays();
            autoclose();
        }

        function isValidTime(time) {
            time = parseInt(time, 10);
            if (opt.startDate && compare_day(time, opt.startDate) < 0) return false;
            if (opt.endDate && compare_day(time, opt.endDate) > 0) return false;

            if (opt.start && !opt.end && !opt.singleDate) {
                //check maxDays and minDays setting
                if (opt.maxDays > 0 && countDays(time, opt.start) > opt.maxDays) return false;
                if (opt.minDays > 0 && countDays(time, opt.start) < opt.minDays) return false;

                //check selectForward and selectBackward
                if (opt.selectForward && time < opt.start) return false;
                if (opt.selectBackward && time > opt.start) return false;

                //check disabled days
                if (opt.beforeShowDay && typeof opt.beforeShowDay == 'function') {
                    var valid = true;
                    var timeTmp = time;
                    // allow select dates between invalid
                    if (!opt.allowSelectBetweenInvalid) {
                        while (countDays(timeTmp, opt.start) > 1) {
                            var arr = opt.beforeShowDay(new Date(timeTmp));
                            if (!arr[0]) {
                                valid = false;
                                break;
                            }
                            if (Math.abs(timeTmp - opt.start) < 86400000) break;
                            if (timeTmp > opt.start) timeTmp -= 86400000;
                            if (timeTmp < opt.start) timeTmp += 86400000;
                        }
                    }
                    if (!valid) return false;
                }
            }
            return true;
        }


        function updateSelectableRange() {
            box.find('.day.invalid.tmp').removeClass('tmp invalid').addClass('valid');
            if (opt.start && !opt.end) {
                box.find('.day.toMonth.valid').each(function() {
                    var time = parseInt($(this).attr('time'), 10);
                    if (!isValidTime(time))
                        $(this).addClass('invalid tmp').removeClass('valid');
                    else
                        $(this).addClass('valid tmp').removeClass('invalid');
                });
            }

            return true;
        }


        function dayHovering(day) {
            var hoverTime = parseInt(day.attr('time'));
            var tooltip = '';

            if (day.hasClass('has-tooltip') && day.attr('data-tooltip')) {
                tooltip = '<span class="tooltip-content">' + day.attr('data-tooltip') + '</span>';
            } else if (!day.hasClass('invalid')) {
                if (opt.singleDate) {
                    box.find('.day.hovering').removeClass('hovering');
                    day.addClass('hovering');
                } else {
                    box.find('.day').each(function() {
                        var time = parseInt($(this).attr('time')),
                            start = opt.start,
                            end = opt.end;

                        if (time == hoverTime) {
                            $(this).addClass('hovering');
                        } else {
                            $(this).removeClass('hovering');
                        }

                        if (
                            (opt.start && !opt.end) &&
                            (
                                (opt.start < time && hoverTime >= time) ||
                                (opt.start > time && hoverTime <= time)
                            )
                        ) {
                            $(this).addClass('hovering');
                        } else {
                            $(this).removeClass('hovering');
                        }
                    });

                    if (opt.start && !opt.end) {
                        var days = countDays(hoverTime, opt.start);
                        if (opt.hoveringTooltip) {
                            if (typeof opt.hoveringTooltip == 'function') {
                                tooltip = opt.hoveringTooltip(days, opt.start, hoverTime);
                            } else if (opt.hoveringTooltip === true && days > 1) {
                                tooltip = days + ' ' + translate('days');
                            }
                        }
                    }
                }
            }

            if (tooltip) {
                var posDay = day.offset();
                var posBox = box.offset();

                var _left = posDay.left - posBox.left;
                var _top = posDay.top - posBox.top;
                _left += day.width() / 2;


                var $tip = box.find('.date-range-length-tip');
                var w = $tip.css({
                    'visibility': 'hidden',
                    'display': 'none'
                }).html(tooltip).width();
                var h = $tip.height();
                _left -= w / 2;
                _top -= h;
                setTimeout(function() {
                    $tip.css({
                        left: _left,
                        top: _top,
                        display: 'block',
                        'visibility': 'visible'
                    });
                }, 10);
            } else {
                box.find('.date-range-length-tip').hide();
            }
        }

        function clearHovering() {
            box.find('.day.hovering').removeClass('hovering');
            box.find('.date-range-length-tip').hide();
        }

        function dateChanged(date) {
            var value = date.val();
            var name = date.attr('name');
            var type = date.parents('table').hasClass('month1') ? 'month1' : 'month2';
            var oppositeType = type === 'month1' ? 'month2' : 'month1';
            var startDate = opt.startDate ? moment(opt.startDate) : false;
            var endDate = opt.endDate ? moment(opt.endDate) : false;
            var newDate = moment(opt[type])[name](value);


            if (startDate && newDate.isSameOrBefore(startDate)) {
                newDate = startDate.add(type === 'month2' ? 1 : 0, 'month');
            }

            if (endDate && newDate.isSameOrAfter(endDate)) {
                newDate = endDate.add(!opt.singleMonth && type === 'month1' ? -1 : 0, 'month');
            }

            showMonth(newDate, type);

            if (type === 'month1') {
                if (opt.stickyMonths || moment(newDate).isSameOrAfter(opt[oppositeType], 'month')) {
                    showMonth(moment(newDate).add(1, 'month'), oppositeType);
                }
            } else {
                if (opt.stickyMonths || moment(newDate).isSameOrBefore(opt[oppositeType], 'month')) {
                    showMonth(moment(newDate).add(-1, 'month'), oppositeType);
                }
            }

            showGap();
        }

        function autoclose() {
            if (opt.singleDate === true) {
                if (initiated && opt.start) {
                    if (opt.autoClose) closeDatePicker();
                }
            } else {
                if (initiated && opt.start && opt.end) {
                    if (opt.autoClose) closeDatePicker();
                }
            }
        }

        function checkSelectionValid() {
            var days = Math.ceil((opt.end - opt.start) / 86400000) + 1;
            if (opt.singleDate) { // Validate if only start is there
                if (opt.start && !opt.end)
                    box.find('.drp_top-bar').removeClass('error').addClass('normal');
                else
                    box.find('.drp_top-bar').removeClass('error').removeClass('normal');
            } else if (opt.maxDays && days > opt.maxDays) {
                opt.start = false;
                opt.end = false;
                box.find('.day').removeClass('checked');
                box.find('.drp_top-bar').removeClass('normal').addClass('error').find('.error-top').html(translate('less-than').replace('%d', opt.maxDays));
            } else if (opt.minDays && days < opt.minDays) {
                opt.start = false;
                opt.end = false;
                box.find('.day').removeClass('checked');
                box.find('.drp_top-bar').removeClass('normal').addClass('error').find('.error-top').html(translate('more-than').replace('%d', opt.minDays));
            } else {
                if (opt.start || opt.end)
                    box.find('.drp_top-bar').removeClass('error').addClass('normal');
                else
                    box.find('.drp_top-bar').removeClass('error').removeClass('normal');
            }

            if ((opt.singleDate && opt.start && !opt.end) || (!opt.singleDate && opt.start && opt.end)) {
                box.find('.apply-btn').removeClass('disabled');
            } else {
                box.find('.apply-btn').addClass('disabled');
            }

            if (opt.batchMode) {
                if (
                    (opt.start && opt.startDate && compare_day(opt.start, opt.startDate) < 0) ||
                    (opt.end && opt.endDate && compare_day(opt.end, opt.endDate) > 0)
                ) {
                    opt.start = false;
                    opt.end = false;
                    box.find('.day').removeClass('checked');
                }
            }
        }

        function showSelectedInfo(forceValid, silent) {
            box.find('.start-day').html('...');
            box.find('.end-day').html('...');
            box.find('.selected-days').hide();
            if (opt.start) {
                box.find('.start-day').html(getDateString(new Date(parseInt(opt.start))));
            }
            if (opt.end) {
                box.find('.end-day').html(getDateString(new Date(parseInt(opt.end))));
            }
            var dateRange;
            if (opt.start && opt.singleDate) {
                box.find('.apply-btn').removeClass('disabled');
                dateRange = getDateString(new Date(opt.start));
                opt.setValue.call(selfDom, dateRange, getDateString(new Date(opt.start)), getDateString(new Date(opt.end)));

                if (initiated && !silent) {
                    $(self).trigger('datepicker-change', {
                        'value': dateRange,
                        'date1': new Date(opt.start)
                    });
                }
            } else if (opt.start && opt.end) {
                box.find('.selected-days').show().find('.selected-days-num').html(countDays(opt.end, opt.start));
                box.find('.apply-btn').removeClass('disabled');
                dateRange = getDateString(new Date(opt.start)) + opt.separator + getDateString(new Date(opt.end));
                opt.setValue.call(selfDom, dateRange, getDateString(new Date(opt.start)), getDateString(new Date(opt.end)));
                if (initiated && !silent) {
                    $(self).trigger('datepicker-change', {
                        'value': dateRange,
                        'date1': new Date(opt.start),
                        'date2': new Date(opt.end)
                    });
                }
            } else if (forceValid) {
                box.find('.apply-btn').removeClass('disabled');
            } else {
                box.find('.apply-btn').addClass('disabled');
            }
        }

        function countDays(start, end) {
            return Math.abs(moment(start).diff(moment(end), 'd')) + 1;
        }

        function setDateRange(date1, date2, silent) {
            if (date1.getTime() > date2.getTime()) {
                var tmp = date2;
                date2 = date1;
                date1 = tmp;
                tmp = null;
            }
            var valid = true;
            if (opt.startDate && compare_day(date1, opt.startDate) < 0) valid = false;
            if (opt.endDate && compare_day(date2, opt.endDate) > 0) valid = false;
            if (!valid) {
                showMonth(opt.startDate, 'month1');
                showMonth(nextMonth(opt.startDate), 'month2');
                showGap();
                return;
            }

            opt.start = date1.getTime();
            opt.end = date2.getTime();

            if (opt.time.enabled) {
                renderTime('time1', date1);
                renderTime('time2', date2);
            }

            if (opt.stickyMonths || (compare_day(date1, date2) > 0 && compare_month(date1, date2) === 0)) {
                if (opt.lookBehind) {
                    date1 = prevMonth(date2);
                } else {
                    date2 = nextMonth(date1);
                }
            }

            if (opt.stickyMonths && opt.endDate !== false && compare_month(date2, opt.endDate) > 0) {
                date1 = prevMonth(date1);
                date2 = prevMonth(date2);
            }

            if (!opt.stickyMonths) {
                if (compare_month(date1, date2) === 0) {
                    if (opt.lookBehind) {
                        date1 = prevMonth(date2);
                    } else {
                        date2 = nextMonth(date1);
                    }
                }
            }

            showMonth(date1, 'month1');
            showMonth(date2, 'month2');
            showGap();
            checkSelectionValid();
            showSelectedInfo(false, silent);
            autoclose();
        }

        function setSingleDate(date1) {

            var valid = true;
            if (opt.startDate && compare_day(date1, opt.startDate) < 0) valid = false;
            if (opt.endDate && compare_day(date1, opt.endDate) > 0) valid = false;
            if (!valid) {
                showMonth(opt.startDate, 'month1');
                return;
            }

            opt.start = date1.getTime();


            if (opt.time.enabled) {
                renderTime('time1', date1);

            }
            showMonth(date1, 'month1');
            if (opt.singleMonth !== true) {
                var date2 = nextMonth(date1);
                showMonth(date2, 'month2');
            }
            showGap();
            showSelectedInfo();
            autoclose();
        }

        function showSelectedDays() {
            if (!opt.start && !opt.end) return;
            box.find('.day').each(function() {
                var time = parseInt($(this).attr('time')),
                    start = opt.start,
                    end = opt.end;
                if (opt.time.enabled) {
                    time = moment(time).startOf('day').valueOf();
                    start = moment(start || moment().valueOf()).startOf('day').valueOf();
                    end = moment(end || moment().valueOf()).startOf('day').valueOf();
                }
                if (
                    (opt.start && opt.end && end >= time && start <= time) ||
                    (opt.start && !opt.end && moment(start).format('YYYY-MM-DD') == moment(time).format('YYYY-MM-DD'))
                ) {
                    $(this).addClass('checked');
                } else {
                    $(this).removeClass('checked');
                }

                //add first-date-selected class name to the first date selected
                if (opt.start && moment(start).format('YYYY-MM-DD') == moment(time).format('YYYY-MM-DD')) {
                    $(this).addClass('first-date-selected');
                } else {
                    $(this).removeClass('first-date-selected');
                }
                //add last-date-selected
                if (opt.end && moment(end).format('YYYY-MM-DD') == moment(time).format('YYYY-MM-DD')) {
                    $(this).addClass('last-date-selected');
                } else {
                    $(this).removeClass('last-date-selected');
                }
            });

            box.find('.week-number').each(function() {
                if ($(this).attr('data-start-time') == opt.startWeek) {
                    $(this).addClass('week-number-selected');
                }
            });
        }

        function showMonth(date, month) {
            date = moment(date).toDate();
            var monthElement = generateMonthElement(date, month);
            var yearElement = generateYearElement(date, month);

            box.find('.' + month + ' .month-name').html(monthElement + ' ' + yearElement);
            box.find('.' + month + ' tbody').html(createMonthHTML(date));
            opt[month] = date;
            updateSelectableRange();
            bindEvents();
        }

        function generateMonthElement(date, month) {
            var range;
            var startDate = opt.startDate ? moment(opt.startDate).add(!opt.singleMonth && month === 'month2' ? 1 : 0, 'month') : false;
            var endDate = opt.endDate ? moment(opt.endDate).add(!opt.singleMonth && month === 'month1' ? -1 : 0, 'month') : false;
            date = moment(date);

            if (!opt.monthSelect ||
                startDate && endDate && startDate.isSame(endDate, 'month')) {
                return '<div class="month-element">' + nameMonth(date.get('month')) + '</div>';
            }

            range = [
                startDate && date.isSame(startDate, 'year') ? startDate.get('month') : 0,
                date ? date.get('month') : 11
            ];

            if (range[0] === range[1]) {
                return '<div class="month-element">' + nameMonth(date.get('month')) + '</div>';
            }

            return generateSelect(
                'month',
                generateSelectData(
                    range,
                    date.get('month'),
                    function(value) { return nameMonth(value); }
                )
            );
        }

        function generateYearElement(date, month) {
            date = moment(date);
            var startDate = opt.startDate ? moment(opt.startDate).add(!opt.singleMonth && month === 'month2' ? 1 : 0, 'month') : false;
            var endDate = opt.endDate ? moment(opt.endDate).add(!opt.singleMonth && month === 'month1' ? -1 : 0, 'month') : false;
            var fullYear = date.get('year');
            var isYearFunction = opt.yearSelect && typeof opt.yearSelect === 'function';
            var range;

            if (!opt.yearSelect ||
                startDate && endDate && startDate.isSame(moment(endDate), 'year')) {
                return '<div class="month-element">' + fullYear + '</div>';
            }

            range = isYearFunction ? opt.yearSelect(fullYear) : opt.yearSelect.slice();

            range = [
                startDate ? Math.max(range[0], startDate.get('year')) : Math.min(range[0], fullYear),
                endDate ? Math.min(range[1], endDate.get('year')) : Math.max(range[1], fullYear)
            ];

            return generateSelect('year', generateSelectData(range, fullYear));
        }


        function generateSelectData(range, current, valueBeautifier) {
            var data = [];
            valueBeautifier = valueBeautifier || function(value) { return value; };

            for (var i = range[0]; i <= range[1]; i++) {
                data.push({
                    value: i,
                    text: valueBeautifier(i),
                    isCurrent: i === current
                });
            }

            return data;
        }

        function generateSelect(name, data) {
            var select = '<div class="select-wrapper"><select class="' + name + '" name="' + name + '">';
            var current;

            for (var i = 0, l = data.length; i < l; i++) {
                select += '<option value="' + data[i].value + '"' + (data[i].isCurrent ? ' selected' : '') + '>';
                select += data[i].text;
                select += '</option>';

                if (data[i].isCurrent) {
                    current = data[i].text;
                }
            }

            select += '</select>' + current + '</div>';

            return select;
        }

        function bindEvents() {
            box.find('.day').off("click").click(function(evt) {
                dayClicked($(this));
            });

            box.find('.day').off("mouseenter").mouseenter(function(evt) {
                dayHovering($(this));
            });

            box.find('.day').off("mouseleave").mouseleave(function(evt) {
                box.find('.date-range-length-tip').hide();
                if (opt.singleDate) {
                    clearHovering();
                }
            });

            box.find('.week-number').off("click").click(function(evt) {
                weekNumberClicked($(this));
            });

            box.find('.month').off("change").change(function(evt) {
                dateChanged($(this));
            });

            box.find('.year').off("change").change(function(evt) {
                dateChanged($(this));
            });
        }

        function showTime(date, name) {
            box.find('.' + name).append(getTimeHTML());
            renderTime(name, date);
        }

        function nameMonth(m) {
            return translate('month-name')[m];
        }

        function getDateString(d) {
            return moment(d).format(opt.format);
        }

        function showGap() {
            showSelectedDays();
            var m1 = parseInt(moment(opt.month1).format('YYYYMM'));
            var m2 = parseInt(moment(opt.month2).format('YYYYMM'));
            var p = Math.abs(m1 - m2);
            var shouldShow = (p > 1 && p != 89);
            if (shouldShow) {
                box.addClass('has-gap').removeClass('no-gap').find('.gap').css('visibility', 'visible');
            } else {
                box.removeClass('has-gap').addClass('no-gap').find('.gap').css('visibility', 'hidden');
            }
            var h1 = box.find('table.month1').height();
            var h2 = box.find('table.month2').height();
            box.find('.gap').height(Math.max(h1, h2) + 10);
        }

        function closeDatePicker() {
            if (opt.alwaysOpen) return;

            var afterAnim = function() {
                $(self).data('date-picker-opened', false);
                $(self).trigger('datepicker-closed', {
                    relatedTarget: box
                });
            };
            if (opt.customCloseAnimation) {
                opt.customCloseAnimation.call(box.get(0), afterAnim);
            } else {
                $(box).slideUp(opt.duration, afterAnim);
            }
            $(self).trigger('datepicker-close', {
                relatedTarget: box
            });
        }

        function redrawDatePicker() {
            showMonth(opt.month1, 'month1');
            showMonth(opt.month2, 'month2');
        }

        function compare_month(m1, m2) {
            var p = parseInt(moment(m1).format('YYYYMM')) - parseInt(moment(m2).format('YYYYMM'));
            if (p > 0) return 1;
            if (p === 0) return 0;
            return -1;
        }

        function compare_day(m1, m2) {
            var p = parseInt(moment(m1).format('YYYYMMDD')) - parseInt(moment(m2).format('YYYYMMDD'));
            if (p > 0) return 1;
            if (p === 0) return 0;
            return -1;
        }

        function nextMonth(month) {
            return moment(month).add(1, 'months').toDate();
        }

        function prevMonth(month) {
            return moment(month).add(-1, 'months').toDate();
        }

        function getTimeHTML() {
            return '<div>' +
                '<span>' + translate('Time') + ': <span class="hour-val">00</span>:<span class="minute-val">00</span></span>' +
                '</div>' +
                '<div class="hour">' +
                '<label>' + translate('Hour') + ': <input type="range" class="hour-range" name="hour" min="0" max="23"></label>' +
                '</div>' +
                '<div class="minute">' +
                '<label>' + translate('Minute') + ': <input type="range" class="minute-range" name="minute" min="0" max="59"></label>' +
                '</div>';
        }

        function createDom() {
            var html = '<div class="date-picker-wrapper';
            if (opt.extraClass) html += ' ' + opt.extraClass + ' ';
            if (opt.singleDate) html += ' single-date ';
            if (!opt.showShortcuts) html += ' no-shortcuts ';
            if (!opt.showTopbar) html += ' no-topbar ';
            if (opt.customTopBar) html += ' custom-topbar ';
            html += '">';

            if (opt.showTopbar) {
                html += '<div class="drp_top-bar">';

                if (opt.customTopBar) {
                    if (typeof opt.customTopBar == 'function') opt.customTopBar = opt.customTopBar();
                    html += '<div class="custom-top">' + opt.customTopBar + '</div>';
                } else {
                    html += '<div class="normal-top">' +
                        '<span class="selection-top">' + translate('selected') + ' </span> <b class="start-day">...</b>';
                    if (!opt.singleDate) {
                        html += ' <span class="separator-day">' + opt.separator + '</span> <b class="end-day">...</b> <i class="selected-days">(<span class="selected-days-num">3</span> ' + translate('days') + ')</i>';
                    }
                    html += '</div>';
                    html += '<div class="error-top">error</div>' +
                        '<div class="default-top">default</div>';
                }

                html += '<input type="button" class="apply-btn disabled' + getApplyBtnClass() + '" value="' + translate('apply') + '" />';
                html += '</div>';
            }

            var _colspan = opt.showWeekNumbers ? 6 : 5;

            var arrowPrev = '&lt;';
            if (opt.customArrowPrevSymbol) arrowPrev = opt.customArrowPrevSymbol;

            var arrowNext = '&gt;';
            if (opt.customArrowNextSymbol) arrowNext = opt.customArrowNextSymbol;

            html += '<div class="month-wrapper">' +
                '   <table class="month1" cellspacing="0" border="0" cellpadding="0">' +
                '       <thead>' +
                '           <tr class="caption">' +
                '               <th>' +
                '                   <span class="prev">' +
                arrowPrev +
                '                   </span>' +
                '               </th>' +
                '               <th colspan="' + _colspan + '" class="month-name">' +
                '               </th>' +
                '               <th>' +
                (opt.singleDate || !opt.stickyMonths ? '<span class="next">' + arrowNext + '</span>' : '') +
                '               </th>' +
                '           </tr>' +
                '           <tr class="week-name">' + getWeekHead() +
                '       </thead>' +
                '       <tbody></tbody>' +
                '   </table>';

            if (hasMonth2()) {
                html += '<div class="gap">' + getGapHTML() + '</div>' +
                    '<table class="month2" cellspacing="0" border="0" cellpadding="0">' +
                    '   <thead>' +
                    '   <tr class="caption">' +
                    '       <th>' +
                    (!opt.stickyMonths ? '<span class="prev">' + arrowPrev + '</span>' : '') +
                    '       </th>' +
                    '       <th colspan="' + _colspan + '" class="month-name">' +
                    '       </th>' +
                    '       <th>' +
                    '           <span class="next">' + arrowNext + '</span>' +
                    '       </th>' +
                    '   </tr>' +
                    '   <tr class="week-name">' + getWeekHead() +
                    '   </thead>' +
                    '   <tbody></tbody>' +
                    '</table>';

            }
            //+'</div>'
            html += '<div class="dp-clearfix"></div>' +
                '<div class="time">' +
                '<div class="time1"></div>';
            if (!opt.singleDate) {
                html += '<div class="time2"></div>';
            }
            html += '</div>' +
                '<div class="dp-clearfix"></div>' +
                '</div>';

            html += '<div class="footer">';
            if (opt.showShortcuts) {
                html += '<div class="shortcuts"><b>' + translate('shortcuts') + '</b>';

                var data = opt.shortcuts;
                if (data) {
                    var name;
                    if (data['prev-days'] && data['prev-days'].length > 0) {
                        html += '&nbsp;<span class="prev-days">' + translate('past');
                        for (var i = 0; i < data['prev-days'].length; i++) {
                            name = data['prev-days'][i];
                            name += (data['prev-days'][i] > 1) ? translate('days') : translate('day');
                            html += ' <a href="javascript:;" shortcut="day,-' + data['prev-days'][i] + '">' + name + '</a>';
                        }
                        html += '</span>';
                    }

                    if (data['next-days'] && data['next-days'].length > 0) {
                        html += '&nbsp;<span class="next-days">' + translate('following');
                        for (var i = 0; i < data['next-days'].length; i++) {
                            name = data['next-days'][i];
                            name += (data['next-days'][i] > 1) ? translate('days') : translate('day');
                            html += ' <a href="javascript:;" shortcut="day,' + data['next-days'][i] + '">' + name + '</a>';
                        }
                        html += '</span>';
                    }

                    if (data.prev && data.prev.length > 0) {
                        html += '&nbsp;<span class="prev-buttons">' + translate('previous');
                        for (var i = 0; i < data.prev.length; i++) {
                            name = translate('prev-' + data.prev[i]);
                            html += ' <a href="javascript:;" shortcut="prev,' + data.prev[i] + '">' + name + '</a>';
                        }
                        html += '</span>';
                    }

                    if (data.next && data.next.length > 0) {
                        html += '&nbsp;<span class="next-buttons">' + translate('next');
                        for (var i = 0; i < data.next.length; i++) {
                            name = translate('next-' + data.next[i]);
                            html += ' <a href="javascript:;" shortcut="next,' + data.next[i] + '">' + name + '</a>';
                        }
                        html += '</span>';
                    }
                }

                if (opt.customShortcuts) {
                    for (var i = 0; i < opt.customShortcuts.length; i++) {
                        var sh = opt.customShortcuts[i];
                        html += '&nbsp;<span class="custom-shortcut"><a href="javascript:;" shortcut="custom">' + sh.name + '</a></span>';
                    }
                }
                html += '</div>';
            }

            // Add Custom Values Dom
            if (opt.showCustomValues) {
                html += '<div class="customValues"><b>' + (opt.customValueLabel || translate('custom-values')) + '</b>';

                if (opt.customValues) {
                    for (var i = 0; i < opt.customValues.length; i++) {
                        var val = opt.customValues[i];
                        html += '&nbsp;<span class="custom-value"><a href="javascript:;" custom="' + val.value + '">' + val.name + '</a></span>';
                    }
                }
            }

            html += '</div></div>';


            return $(html);
        }

        function getApplyBtnClass() {
            var klass = '';
            if (opt.autoClose === true) {
                klass += ' hide';
            }
            if (opt.applyBtnClass !== '') {
                klass += ' ' + opt.applyBtnClass;
            }
            return klass;
        }

        function getWeekHead() {
            var prepend = opt.showWeekNumbers ? '<th>' + translate('week-number') + '</th>' : '';
            if (opt.startOfWeek == 'monday') {
                return prepend + '<th>' + translate('week-1') + '</th>' +
                    '<th>' + translate('week-2') + '</th>' +
                    '<th>' + translate('week-3') + '</th>' +
                    '<th>' + translate('week-4') + '</th>' +
                    '<th>' + translate('week-5') + '</th>' +
                    '<th>' + translate('week-6') + '</th>' +
                    '<th>' + translate('week-7') + '</th>';
            } else {
                return prepend + '<th>' + translate('week-7') + '</th>' +
                    '<th>' + translate('week-1') + '</th>' +
                    '<th>' + translate('week-2') + '</th>' +
                    '<th>' + translate('week-3') + '</th>' +
                    '<th>' + translate('week-4') + '</th>' +
                    '<th>' + translate('week-5') + '</th>' +
                    '<th>' + translate('week-6') + '</th>';
            }
        }

        function isMonthOutOfBounds(month) {
            month = moment(month);
            if (opt.startDate && month.endOf('month').isBefore(opt.startDate)) {
                return true;
            }
            if (opt.endDate && month.startOf('month').isAfter(opt.endDate)) {
                return true;
            }
            return false;
        }

        function getGapHTML() {
            var html = ['<div class="gap-top-mask"></div><div class="gap-bottom-mask"></div><div class="gap-lines">'];
            for (var i = 0; i < 20; i++) {
                html.push('<div class="gap-line">' +
                    '<div class="gap-1"></div>' +
                    '<div class="gap-2"></div>' +
                    '<div class="gap-3"></div>' +
                    '</div>');
            }
            html.push('</div>');
            return html.join('');
        }

        function hasMonth2() {
            return (!opt.singleMonth);
        }

        function attributesCallbacks(initialObject, callbacksArray, today) {
            var resultObject = $.extend(true, {}, initialObject);

            $.each(callbacksArray, function(cbAttrIndex, cbAttr) {
                var addAttributes = cbAttr(today);
                for (var attr in addAttributes) {
                    if (resultObject.hasOwnProperty(attr)) {
                        resultObject[attr] += addAttributes[attr];
                    } else {
                        resultObject[attr] = addAttributes[attr];
                    }
                }
            });

            var attrString = '';

            for (var attr in resultObject) {
                if (resultObject.hasOwnProperty(attr)) {
                    attrString += attr + '="' + resultObject[attr] + '" ';
                }
            }

            return attrString;
        }

        function createMonthHTML(d) {
            var days = [];
            d.setDate(1);
            var lastMonth = new Date(d.getTime() - 86400000);
            var now = new Date();

            var dayOfWeek = d.getDay();
            if ((dayOfWeek === 0) && (opt.startOfWeek === 'monday')) {
                // add one week
                dayOfWeek = 7;
            }
            var today, valid;

            if (dayOfWeek > 0) {
                for (var i = dayOfWeek; i > 0; i--) {
                    var day = new Date(d.getTime() - 86400000 * i);
                    valid = isValidTime(day.getTime());
                    if (opt.startDate && compare_day(day, opt.startDate) < 0) valid = false;
                    if (opt.endDate && compare_day(day, opt.endDate) > 0) valid = false;
                    days.push({
                        date: day,
                        type: 'lastMonth',
                        day: day.getDate(),
                        time: day.getTime(),
                        valid: valid
                    });
                }
            }
            var toMonth = d.getMonth();
            for (var i = 0; i < 40; i++) {
                today = moment(d).add(i, 'days').toDate();
                valid = isValidTime(today.getTime());
                if (opt.startDate && compare_day(today, opt.startDate) < 0) valid = false;
                if (opt.endDate && compare_day(today, opt.endDate) > 0) valid = false;
                days.push({
                    date: today,
                    type: today.getMonth() == toMonth ? 'toMonth' : 'nextMonth',
                    day: today.getDate(),
                    time: today.getTime(),
                    valid: valid
                });
            }
            var html = [];
            for (var week = 0; week < 6; week++) {
                if (days[week * 7].type == 'nextMonth') break;
                html.push('<tr>');

                for (var day = 0; day < 7; day++) {
                    var _day = (opt.startOfWeek == 'monday') ? day + 1 : day;
                    today = days[week * 7 + _day];
                    var highlightToday = moment(today.time).format('L') == moment(now).format('L');
                    today.extraClass = '';
                    today.tooltip = '';
                    if (today.valid && opt.beforeShowDay && typeof opt.beforeShowDay == 'function') {
                        var _r = opt.beforeShowDay(moment(today.time).toDate());
                        today.valid = _r[0];
                        today.extraClass = _r[1] || '';
                        today.tooltip = _r[2] || '';
                        if (today.tooltip !== '') today.extraClass += ' has-tooltip ';
                    }

                    var todayDivAttr = {
                        time: today.time,
                        'data-tooltip': today.tooltip,
                        'class': 'day ' + today.type + ' ' + today.extraClass + ' ' + (today.valid ? 'valid' : 'invalid') + ' ' + (highlightToday ? 'real-today' : '')
                    };

                    if (day === 0 && opt.showWeekNumbers) {
                        html.push('<td><div class="week-number" data-start-time="' + today.time + '">' + opt.getWeekNumber(today.date) + '</div></td>');
                    }

                    html.push('<td ' + attributesCallbacks({}, opt.dayTdAttrs, today) + '><div ' + attributesCallbacks(todayDivAttr, opt.dayDivAttrs, today) + '>' + showDayHTML(today.time, today.day) + '</div></td>');
                }
                html.push('</tr>');
            }
            return html.join('');
        }

        function showDayHTML(time, date) {
            if (opt.showDateFilter && typeof opt.showDateFilter == 'function') return opt.showDateFilter(time, date);
            return date;
        }

        function getLanguages() {
            if (opt.language == 'auto') {
                var language = navigator.language ? navigator.language : navigator.browserLanguage;
                if (!language) {
                    return $.dateRangePickerLanguages['default'];
                }
                language = language.toLowerCase();
                if(language in $.dateRangePickerLanguages){
                    return $.dateRangePickerLanguages[language];
                }

                return $.dateRangePickerLanguages['default'];
            } else if (opt.language && opt.language in $.dateRangePickerLanguages) {
                return $.dateRangePickerLanguages[opt.language];
            } else {
                return $.dateRangePickerLanguages['default'];
            }
        }

        /**
         * Translate language string, try both the provided translation key, as the lower case version
         */
        function translate(translationKey) {
            var translationKeyLowerCase = translationKey.toLowerCase();
            var result = (translationKey in languages) ? languages[translationKey] : (translationKeyLowerCase in languages) ? languages[translationKeyLowerCase] : null;
            var defaultLanguage = $.dateRangePickerLanguages['default'];
            if (result == null) result = (translationKey in defaultLanguage) ? defaultLanguage[translationKey] : (translationKeyLowerCase in defaultLanguage) ? defaultLanguage[translationKeyLowerCase] : '';

            return result;
        }

        function getDefaultTime() {
            var defaultTime = opt.defaultTime ? opt.defaultTime : new Date();

            if (opt.lookBehind) {
                if (opt.startDate && compare_month(defaultTime, opt.startDate) < 0) defaultTime = nextMonth(moment(opt.startDate).toDate());
                if (opt.endDate && compare_month(defaultTime, opt.endDate) > 0) defaultTime = moment(opt.endDate).toDate();
            } else {
                if (opt.startDate && compare_month(defaultTime, opt.startDate) < 0) defaultTime = moment(opt.startDate).toDate();
                if (opt.endDate && compare_month(nextMonth(defaultTime), opt.endDate) > 0) defaultTime = prevMonth(moment(opt.endDate).toDate());
            }

            if (opt.singleDate) {
                if (opt.startDate && compare_month(defaultTime, opt.startDate) < 0) defaultTime = moment(opt.startDate).toDate();
                if (opt.endDate && compare_month(defaultTime, opt.endDate) > 0) defaultTime = moment(opt.endDate).toDate();
            }

            return defaultTime;
        }

        function resetMonthsView(time) {
            if (!time) {
                time = getDefaultTime();
            }

            if (opt.lookBehind) {
                showMonth(prevMonth(time), 'month1');
                showMonth(time, 'month2');
            } else {
                showMonth(time, 'month1');
                showMonth(nextMonth(time), 'month2');
            }

            if (opt.singleDate) {
                showMonth(time, 'month1');
            }

            showSelectedDays();
            showGap();
        }

        function outsideClickClose(evt) {
            if (!IsOwnDatePickerClicked(evt, self[0])) {
                if (box.is(':visible')) closeDatePicker();
            }
        }

    };
}));

/***/ }),
/* 57 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(0), __webpack_require__(18), __webpack_require__(14),__webpack_require__(12),
         __webpack_require__(2),__webpack_require__(1), __webpack_require__(4), __webpack_require__(9),
         __webpack_require__(13),
         __webpack_require__(3), __webpack_require__(7), __webpack_require__(6),
         __webpack_require__(8),
         __webpack_require__(5), __webpack_require__(0), __webpack_require__(10),
         __webpack_require__(16), __webpack_require__(15), __webpack_require__(17),
         __webpack_require__(11)], __WEBPACK_AMD_DEFINE_RESULT__ = (function($, MemoryDataSource, RemoteDataSource, SelectSelector,
                  commonServices, commonSettings, commonTranslations, commonLoader, rentEngineMediator,
                  i18next, moment, tmpl) {

  /***************************************************************************
   *
   * Selector Model
   *
   ***************************************************************************/
  var productModel = {

    requestLanguage: null, // Request language
    configuration: null, // The platform configuration

    today: null,       // Today (to manage the calendar)
    minTimeFrom: null, // Min time from
    maxTimeFrom: null, // Max time to
    code: null, // Product code
    salesChannelCode: null, // Sales channel code
    pickupPlace: null, // Selected pickup/place
    selectedDateFrom: null, // Selected date from
    selectedDateTo: null, // Selected date to
    shoppingCartId: null, // The shoppingCart Id

    availabilityData: null, // Availability data
    pickupHours: [],  // Available pickup hours
    returnHours: [],  // Available return hours

    dataSourcePickupPlaces: null, // Pickup places datasource
    dataSourceReturnPlaces: null, // Return places datasource

    shopping_cart: null, // The shopping cart
    product_available: null, // The selected product availability
    product_type: null, // The product type
    product: null, // The product detailed information

    // ------------------ Selectors -------------------------------------------

    // form selector
    form_selector: 'form[name=search_form]',
    form_selector_tmpl: 'form_calendar_selector_tmpl',
    // == Pickup / Return place selector
    // pickup place   
    pickup_place_id: 'pickup_place',
    pickup_place_selector: '#pickup_place',
    pickup_place_other_selector: '#pickup_place_other',
    pickup_place_group_selector: '.pickup_place_group',    
    custom_pickup_place_selector: 'input[name=custom_pickup_place]',
    another_pickup_place_group_selector: '#another_pickup_place_group',
    // same pickup/return place
    same_pickup_return_place_selector: '#same_pickup_return_place',
    // return place
    return_place_id: 'return_place',
    return_place_selector: '#return_place',
    return_place_other_selector: '#pickup_place_other',
    return_place_container_selector: '.return_place',
    return_place_group_selector: '.return_place_group',   
    custom_return_place_selector: 'input[name=custom_pickup_place]',
    another_return_place_group_selector: '#another_pickup_place_group',
    // == Date selector
    date_selector: '#date',
    // == Time From / To selector
    // time from
    time_from_id: 'time_from',
    time_from_selector: '#time_from',
    // time to
    time_to_id: 'time_to',        
    time_to_selector: '#time_to',  
    // == Other fields
    // promotion code    
    promotion_code_selector: '#promotion_code',
    // driver age
    driver_age_rule_selector: '#driver_age_rule',
    // number of products
    number_of_products_selector: '#number_of_products',
    // accept age
    accept_age_selector: '#accept_age',
    
    // add to shopping cart button
    add_to_shopping_cart_btn_selector: '#add_to_shopping_cart_btn',

    // -------------- Load settings ----------------------------

    loadSettings: function() {
      commonSettings.loadSettings(function(data){
        productModel.configuration = data;
        productView.init();
      });
    },   

    // -------------- Check availability -----------------------

    /**
     * Check product availability
     */
    checkAvailability: function(dateFrom, dateTo) {

      var url = commonServices.URL_PREFIX + '/api/booking/frontend/products/' + this.code + '/occupation';
      url += '?from='+dateFrom+'&to='+dateTo;      
      if (this.pickupPlace) {
        url += '&pickup_place='+encodeURIComponent(this.pickupPlace);
      }
      if (commonServices.apiKey && commonServices.apiKey != '') {
        url += '&api_key='+commonServices.apiKey;
      }    

      $.ajax({
        type: 'GET',
        url : url,
        contentType : 'application/json; charset=utf-8',
        success: function(data, textStatus, jqXHR) {
            productModel.availabilityData = data;
            // Rebuild calendar
            $('#date').data('dateRangePicker').redraw();
            // Activate the control
            $('#date-container').removeClass('disabled-picker');
        },
        error: function(data, textStatus, jqXHR) {
            alert(i18next.t('selector.error_loading_data'));
        },
        beforeSend: function(jqXHR) {
          commonLoader.show();
        },
        complete: function(jqXHR, textStatus) {
            commonLoader.hide();
        }
      });

    },

    /**
     * Access the API to get the available pickup hours in a date
     */
    loadPickupHours: function(id, date) { /* Load pickup hours */
      var self=this;
      // Build the URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/times?date='+date+'&action=deliveries';
      if (this.configuration.pickupReturnPlace && $(this.pickup_place_selector).val() != '') {
        url += '&place='+$(this.pickup_place_selector).val();
      }
      if (commonServices.apiKey && commonServices.apiKey != '') {
        url += '&api_key='+commonServices.apiKey;
      }       
      // Request             
      $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(data, textStatus, jqXHR) {
          self.pickupHours = data;
          productView.update('hours', id, data);
        },
        error: function(data, textStatus, jqXHR) {
          alert(i18next.t('selector.error_loading_data'));
        }
      });
    },

    /**
     * Access the API to get the available return hours in a date
     */
    loadReturnHours: function(id, date) { /* Load return hours */
      var self=this;
      // Build the URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/times?date='+date+'&action=collections';
      if (this.configuration.pickupReturnPlace && $(this.return_place_selector).val() != '') {
        url += '&place='+$(this.return_place_selector).val();
      }        
      if (commonServices.apiKey && commonServices.apiKey != '') {
        url += '&api_key='+commonServices.apiKey;
      }    
      // Request                  
      $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(data, textStatus, jqXHR) {
          self.returnHours = data;
          productView.update('hours', id, data);
        },
        error: function(data, textStatus, jqXHR) {
          alert(i18next.t('selector.error_loading_data'));
        }
      });
    },

    /* ---------------- Calculate price and ShoppingCart management -------- */

    /**
     * Calculate price (build the shopping cart and choose the product)
     */
    calculatePriceAvailability: function() {

      var dataRequest = this.buildDataRequest();
      var dataRequestJSON =  encodeURIComponent(JSON.stringify(dataRequest));
      // Build the URL
      var url = commonServices.URL_PREFIX + '/api/booking/frontend/shopping-cart';
      if (this.shoppingCartId == null) {
        this.shoppingCartId = this.getShoppingCartFreeAccessId();
      }
      if (this.shoppingCartId) {
        url+= '/'+this.shoppingCartId;
      }
      var urlParams = [];
      urlParams.push('include_products=true');
      if (this.requestLanguage != null) {
        urlParams.push('lang='+this.requestLanguage);
      }
      if (commonServices.apiKey && commonServices.apiKey != '') {
        urlParams.push('api_key='+commonServices.apiKey);
      } 
      if (urlParams.length > 0) {
        url += '?';
        url += urlParams.join('&');
      }
      // Request  
      var self = this;
      commonLoader.show();
      $.ajax({
        type: 'POST',
        url: url,
        data: dataRequestJSON,
        dataType : 'json',
        contentType : 'application/json; charset=utf-8',
        crossDomain: true,
        success: function(data, textStatus, jqXHR) {
          if (self.shoppingCartId == null || self.shoppingCartId != data.shopping_cart.free_access_id) {
            self.shoppingCartId = data.shopping_cart.free_access_id;
            self.putShoppingCartFreeAccessId(self.shoppingCartId);
          }
          self.shopping_cart = data.shopping_cart;
          self.product_available = data.product_available;
          if (data.products && Array.isArray(data.products) && data.products.length > 0) {
            self.product = data.products[0];
          }
          else {
            self.product = null;
          }
          productView.update('shopping_cart');
        },
        error: function(data, textStatus, jqXHR) {
          alert(i18next.t('selector.error_loading_data'));
        },
        beforeSend: function(jqXHR) {
          commonLoader.show();
        },        
        complete: function(jqXHR, textStatus) {
          commonLoader.hide();
        }
      });

    },

    /**
     * Get the shopping cart from the session storage
     */ 
    getShoppingCartFreeAccessId: function() {
      return sessionStorage.getItem('shopping_cart_free_access_id');
    },

    /**
     * Store shopping cart free access ID in season
     */
    putShoppingCartFreeAccessId: function(value) {
      sessionStorage.setItem('shopping_cart_free_access_id', value);
    },

    /**
     * Build data request
     * (TODO Custom pickup/return place)
     */
    buildDataRequest: function() {

      var data = {date_from: moment(this.selectedDateFrom).format('DD/MM/YYYY'),
                  date_to: moment(this.selectedDateTo).format('DD/MM/YYYY'),
                  category_code: this.code
                  };

      if ($(this.salesChannelCode != null)) {
        data.sales_channel_code = this.salesChannelCode;
      }

      if (this.configuration.pickupReturnPlace) {
        data.pickup_place = $(this.pickup_place_selector).val();
        data.return_place = $(this.return_place_selector).val();
      }

      if (this.configuration.timeToFrom) {
        data.time_from = $(this.time_from_selector).val();
        data.time_to = $(this.time_to_selector).val();
      }

      return data;

    }  
   
  };

  /***************************************************************************
   *
   * Selector Controller
   *
   ***************************************************************************/
  var productController = {

    /* --------------- Pickup / Return places events ----------------------- */

    /**
     * Pickup place changed
     */ 
    pickupPlaceChanged: function(pickupPlace) { 

       console.log('pickup place changed');

       productModel.pickupPlace = pickupPlace;

       // Enable return place
       if ($(productModel.return_place_selector).attr('disabled')) {
         $(productModel.return_place_selector).attr('disabled', false);
       }

       if (productModel.configuration.pickupReturnPlace) {
         if (!$(productModel.same_pickup_return_place_selector).is(':checked')) {
           $(productModel.return_place_selector).val('');
         }
       }

       // Custom places
       if (productModel.configuration.customPickupReturnPlaces) {
         if ($(productModel.pickup_place_selector).val() == 'other') {
             $(productModel.custom_pickup_place_selector).val('true');
             $(productModel.another_pickup_place_group_selector).show();
             $(productModel.pickup_place_group_selector).hide();
         }
         else {
             $(productModel.custom_pickup_place_selector).val('false');
             $(productModel.pickup_place_other_selector).val('');
             $(productModel.another_pickup_place_group_selector).hide();
             $(productModel.pickup_place_group_selector).show();
         }
       }

       // Load the return places
       productView.loadReturnPlaces();

    },

    /**
     * Pickup place custom address autocomplete changed
     */
    pickupPlaceAnotherChanged: function() {

     if ($(productModel.same_pickup_return_place_selector).is(':checked')) {
        $(productModel.return_place_selector).val('other');
        $(productModel.custom_return_place_selector).val('true');
        $(productModel.return_place_other_selector).val($(productModel.pickup_place_other_selector).val());
     }

    },

    /**
     * Pickup place custom address close click
     */
    pickupPlaceAnotherGroupCloseClick: function() {
      $(productModel.pickup_place_selector).val('');
      $(productModel.pickup_place_other_selector).val('');
      $(productModel.custom_pickup_place_selector).val('false');
      $(productModel.pickup_place_group_selector).show();
      $(productModel.another_pickup_place_group_selector).hide();
    },

    /**
     * Same pickup / return place changed
     */
    samePickupReturnPlaceChanged: function() {

      if ($(productModel.same_pickup_return_place_selector).is(':checked')) {
        $(productModel.return_place_selector).val($(productModel.pickup_place_selector).val());
        $(productModel.return_place_container_selector).hide();
      }
      else {
        $(productModel.return_place_container_selector).show();
      }

    },

    /**
     * Return place changed
     */ 
    returnPlaceChanged: function() { 

        console.log('return place changed');

        // Custom places
        if (productModel.configuration.customPickupReturnPlaces) {
          if ($(productModel.return_place_selector).val() == 'other') {
              $(productModel.custom_return_place_selector).val('true');
              $(productModel.another_return_place_group_selector).show();
          }
          else {
              $(productModel.custom_return_place_selector).val('false');
              $(productModel.another_return_place_group_selector).hide();
          }
        }

       // Enable date from        
       if ($(productModel.date_selector).attr('disabled')) {
         $(productModel.date_selector).attr('disabled', false);
       }

       // Initialize date, time from, return place and time to
       $(productModel.date_selector).datepicker('setDate', null);
       if (productModel.configuration.timeToFrom) {
         $(productModel.time_from_selector).val('');
         $(productModel.time_to_selector).val('');
       }

       // Load availability
       productView.checkAvailability();

    },

    /* -------------------- Dates events ------------------------------------*/

    /**
     * First date selected
     */ 
    firstDateSelected: function(dateFrom) { /* The user selects the first date */

      console.log('first date selected');

      productModel.selectedDateFrom = null;
      productModel.selectedDateTo = null;
      $('#reservation_detail').html('');

    },

    /**
     * Date range selected
     */
    datesChanged: function(dateFrom, dateTo) {

        console.log('dates changed');

        productModel.selectedDateFrom = dateFrom;
        productModel.selectedDateTo = dateTo;    

        if (productModel.availabilityData) {
          var dateFromStr = moment(dateFrom).format('YYYY-MM-DD');
          var dateToStr = moment(dateTo).format('YYYY-MM-DD');
          if (productModel.availabilityData['occupation'][dateFromStr]) {
            if (productModel.availabilityData['occupation'][dateFromStr]['ends']) {
              productModel.minTimeFrom = productModel.availabilityData['occupation'][dateFromStr]['time_to']
            }
            else {
              productModel.minTimeFrom = null;
            }
          }   
          if (productModel.availabilityData['occupation'][dateToStr]) {
            if (productModel.availabilityData['occupation'][dateToStr]['starts']) {
              productModel.maxTimeTo = productModel.availabilityData['occupation'][dateToStr]['time_from']
            }
            else {
              productModel.maxTimeTo = null;
            }          
          }  
        }

        // ==Time From
        if (productModel.configuration.timeToFrom) {
          // Enable time from     
          if ($(productModel.time_from_selector).attr('disabled')) {   
            $(productModel.time_from_selector).attr('disabled', false);
          }
          // Initialize time from
          $(productModel.time_from_selector).val('');
          // Enable time to
          if ($(productModel.time_to_selector).attr('disabled')) {   
            $(productModel.time_to_selector).attr('disabled', false);
          }
          // Initialize time from
          $(productModel.time_to_selector).val('');          
          // Load pickup / return hours
          productView.loadPickupHours();
          productView.loadReturnHours();          
        }

        // Calculate price
        productView.calculatePriceAvailability();

    },

    /**
     * Month changed (check availability)
     */
    monthChanged: function() {

      console.log('month changed');
      productView.checkAvailability();

    },

    timeFromChanged: function() {

     console.log('time from changed');
     productView.calculatePriceAvailability();

    },

    timeToChanged: function() {

     console.log('time to changed');
     productView.calculatePriceAvailability();

    }

  };


  /***************************************************************************
   *
   * Selector View
   *
   ***************************************************************************/
  var productView = {

    init: function() {

        productModel.requestLanguage = commonSettings.language(document.documentElement.lang);
        productModel.code = $('#product_selector').attr('data-code');
        var salesChannelAttr = $('#product_selector').attr('data-sales-channel-code');
        if (typeof salesChannelAttr !== 'undefined') {
          productModel.salesChannelCode = $('#product_selector').attr('data-sales-channel-code');
        }
        productModel.today = moment().format('YYYY-MM-DD');

        // Initialize i18next for translations
        i18next.init({  
                        lng: productModel.requestLanguage,
                        resources: commonTranslations
                     }, 
                     function (error, t) {
                        // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                        //jqueryI18next.init(i18next, $);
                        // Localize UI
                        //$('.nav').localize();
                     });

        // Setup Form
        this.setupSelectorFormTmpl();
        
        // Setup Controls
        this.setupControls();

        // Setup Validation   
        this.setupValidation();

        // Start loading data
        if (productModel.configuration.pickupReturnPlace) {
          this.loadPickupPlaces();   
        }
        else {
          productView.checkAvailability();
        }

    },

    /* ---------------------- Setup UI controls ---------------------------- */

    /**
     * Setup the selector form
     *
     * The selector form can be rendered in two ways:
     *
     * - Directly on the page (recommeded for final projects)
     * - Using a template that choose which fields should be rendered
     *
     * For the first option just create the form with the fields in the page
     * For the second option create an empty form and a template that creates
     * the fields depending on the configuration
     *
     * Note: The two options are hold for compatibility uses
     * 
     */
    setupSelectorFormTmpl: function() {

      // The selector form fields are defined in a micro-template
      if (document.getElementById(productModel.form_selector_tmpl)) {
        // Load the template
        var html = tmpl(productModel.form_selector_tmpl)({configuration: productModel.configuration});
        // Assign to the form
        $(productModel.form_selector).append(html);
      }

    },

    setupControls: function() {

      // Setup pickup/return places
      if (productModel.configuration.pickupReturnPlace) {
        this.setupPickupReturnPlace();
        $(productModel.return_place_selector).attr('disabled', true);
      }
      
      // Setup Date control
      this.setupDateControl();
      $('#date-container').addClass('disabled-picker');

      // Setup time from/to controls
      if (productModel.configuration.timeToFrom) {
        this.setupTimeToFrom();
        $(productModel.time_from_selector).attr('disabled', true);
        $(productModel.time_to_selector).attr('disabled', true);        
      }    

      $(productModel.add_to_shopping_cart_btn_selector).attr('disabled', true);

    },

    /**
     * Setup pickup/return place
     */
    setupPickupReturnPlace: function() {

      var pickupTime = new SelectSelector(productModel.pickup_place_id, 
          new MemoryDataSource([]), null, true, i18next.t('selector.select_pickup_place'));     

      var returnTime = new SelectSelector(productModel.return_place_id, 
          new MemoryDataSource([]), null, true, i18next.t('selector.select_return_place'));  

      $(productModel.same_pickup_return_place_selector).bind('change', function(){
        productController.samePickupReturnPlaceChanged();
      });

      var returnPlace = new SelectSelector(productModel.return_place_id, 
          new MemoryDataSource([]), null, true, i18next.t('selector.select_return_place'));    

    },

    /**
     * Setup date control
     */
    setupDateControl: function() {

      // For index Page coding
      $('#date').dateRangePicker(
      {
          inline:true,
          container: '#date-container',
          alwaysOpen: true,
          stickyMonths: true,
          allowSelectBetweenInvalid: true,
          singleDate: (productModel.configuration.datesSelector === 'single_date'), /* Single date selector */
          singleMonth: (productModel.configuration.datesSelector === 'single_date' ? true : false), /* Single date one month */
          time: {
            enabled: false
          },
          startOfWeek: 'monday',
          language: productModel.requestLanguage,
          minDays: productModel.configuration.minDays,
          showTopbar: false,
          customTopBar: '',
          extraClass: '',
          beforeShowDay: function(date) {
            var theDate = moment(date.setHours(0,0,0,0)).format('YYYY-MM-DD');
            // Before showing a date
            // Check the past
            if (theDate< productModel.today) {
              return [false];
            }
            var info = null;
            // Check the availability
            if (productModel.availabilityData) {
              // Day is not selectable [calendar]
              if (productModel.availabilityData['occupation'][theDate] && !productModel.availabilityData['occupation'][theDate].selectable_day) {
                return [false, 'not-selectable-day']; // The reservation can not start or end on the date 
              }    
              // Product is not available [rent]
              else if (productModel.availabilityData['occupation'][theDate] && !productModel.availabilityData['occupation'][theDate].free) {
                return [false, 'busy-data bg-danger'];
              }
              // If a reservation starts/end the the date [info message]
              if (productModel.availabilityData['occupation'][theDate]) {
                if (productModel.availabilityData['occupation'][theDate]['warning_occupied']) {
                  info = productModel.availabilityData['occupation'][theDate]['warning_occupied_message'];
                }
              }
            }
            // Make sure that when the daterangepicker is refreshed to hold the selection
            var startDate = productModel.selectedDateFrom ? moment(productModel.selectedDateFrom).format('YYYY-MM-DD') : null;
            var endDate = productModel.selectedDateTo ? moment(productModel.selectedDateTo).format('YYYY-MM-DD') : null;
            if (startDate && endDate) {
              if (theDate == startDate && theDate == endDate) {
                return [true, 'checked last-date-selected first-date-selected'];
              }
              else if (theDate == startDate) {
                return [true, 'checked first-date-selected'];
              }
              else if (theDate == endDate) {
                return [true, 'checked last-date-selected'];
              }
              else if (theDate >= startDate && theDate <= endDate) {
                return [true, 'checked'];
              }
            }
            return [true, (info == null ? 'date-available' : 'bg-warning'), (info == null ? '' : info)];
          },
          hoveringTooltip: false         
      })
      .bind('datepicker-first-date-selected', function(event, obj){
        productController.firstDateSelected(obj.date1);
      })
      .bind('datepicker-change',function(event,obj) {
        productController.datesChanged(obj.date1, obj.date2 || obj.date1);
      });
      // Avoid Google Automatic Translation
      $('#date-container').addClass('notranslate');
      // Bind navigation events
      $('#date-container .next').bind('click', function(){
        productController.monthChanged();
      });
      $('#date-container .prev').bind('click', function(){
        productController.monthChanged();
      });

      setTimeout(function(){
        var width = $('#date-container').width();
        $('.date-picker-wrapper').css('width', '100%');
        $('.month-wrapper').css('width', 'inherit');
        $('.month-wrapper table').css('width', 'inherit');
        $('.month-wrapper table th').css('width', width/7+'px');
      }, 100);
      

    },

    /**
     * Setup Time controls
     */
    setupTimeToFrom: function() {

        var pickupTime = new SelectSelector(productModel.time_from_id, 
            new MemoryDataSource([]), null, true, 'hh:mm');     

        var returnTime = new SelectSelector(productModel.time_to_id, 
            new MemoryDataSource([]), null, true, 'hh:mm');  

        $(productModel.time_from_selector).bind('change', function(){
          productController.timeFromChanged();
        });

        $(productModel.time_to_selector).bind('change', function(){
          productController.timeToChanged();
        });

    },

    /**
     * Setup validation
     */
    setupValidation: function() {

        // Validator to check time_to <-> time_from when same date
        $.validator.addMethod('same_day_time_from', function(value, element) {
          if (productModel.configuration.timeToFrom) {
            var dateFromStr = moment(productModel.selectedDateFrom).format('YYYY-MM-DD');
            var dateToStr = moment(productModel.selectedDateTo).format('YYYY-MM-DD');
            if (dateFromStr == dateToStr) {
              return $(productModel.time_to_selector).val() > $(productModel.time_from_selector).val();
            }
            return true;
          }
          return true;
        });
        // Validator to check time_from min value
        $.validator.addMethod("min_time", function(value, element) {
                      if (productModel.minTimeFrom) {
                        if ($(productModel.time_from_selector).val() < productModel.minTimeFrom) {
                          return false;
                        }
                      }
                      return true;
        });
        // Validator to check time_to max value
        $.validator.addMethod("max_time", function(value, element) {
                      if (productModel.maxTimeTo) {
                        if ($(productModel.time_to_selector).val() > productModel.maxTimeTo) {
                          return false;
                        }
                      }
                      return true;
        });


        $(productModel.form_selector).validate({
           submitHandler: function(form) {
             productView.gotoNextStep();
           },
           invalidHandler: function(form)
           {
             $(productModel.form_selector + ' label.form-reservation-error').remove();
           },
           rules: {
               pickup_place: {
                   required: productModel.configuration.pickupReturnPlace
               },
               pickup_place_other: {
                   required: productModel.pickup_place_other_selector + ':visible'
               },
               return_place: {
                   required: productModel.configuration.pickupReturnPlace
               },
               return_place_other: {
                   required: productModel.pickup_place_other_selector + ':visible'
               },   
               date: {
                   required: true,
               },
               time_from: {
                   required: productModel.configuration.timeToFrom,
                   min_time: productModel.configuration.timeToFrom
               },
               time_to: {
                   required: productModel.configuration.timeToFrom,
                   same_day_time_from: true,
                   max_time: productModel.configuration.timeToFrom
               },
               promotion_code: {
                   remote: {
                       url: commonServices.URL_PREFIX + '/api/check-promotion-code',
                       type: 'POST',
                       data: {
                           code: function() {
                               return $(productModel.promotion_code_selector).val();
                           },
                           from: function() {
                               return moment(productModel.selectedDateFrom).format('YYYY-MM-DD');
                           },
                           to: function() {
                               return moment(productModel.selectedDateTo).format('YYYY-MM-DD');
                           }
                       }
                   }
               },
               accept_age: {
                   required: productModel.accept_age_selector+':visible'
               }               
           },
           messages: {
               pickup_place: {
                   required: i18next.t('selector.validations.pickupPlaceRequired')
               },
               pickup_place_other: {
                   required: i18next.t('selector.validations.pickupPlaceRequired')
               },
               return_place: {
                   required: i18next.t('selector.validations.returnPlaceRequired')
               }, 
               return_place_other: {
                   required: i18next.t('selector.validations.returnPlaceRequired')
               },  
               date: {
                   required: i18next.t('selector.validations.dateFromRequired')
               },
               time_from: {
                   required: i18next.t('selector.validations.timeFromRequired'),
                   min_time: function() {
                                return i18next.t('calendar_selector.min_time', {time: productModel.minTimeFrom});
                             }
               },
               time_to: {
                   required:i18next.t('selector.validations.timeToRequired'),
                   same_day_time_from: i18next.t('selector.validations.sameDayTimeToGreaterTimeFrom'),
                   max_time: function() {
                                return i18next.t('calendar_selector.max_time', {time: productModel.maxTimeTo});
                             }
               },               
               promotion_code: {
                   remote: i18next.t('selector.validations.promotionCodeInvalid')
               },
               accept_age: {
                   required: i18next.t('selector.validations.acceptAge', {years: 21})
               }
           },
           errorPlacement: function (error, element) {

            error.insertAfter(element.parent());

           },
           errorClass : 'form-reservation-error'
        });

    },


    // ------------------------------------------------------------------------

    /**
     * Calculate price
     */
    calculatePriceAvailability: function() {
 
      // Disable the add to shopping cart button
      $(productModel.add_to_shopping_cart_btn_selector).attr('disabled', true);

      if (this.isDataComplete()) {
        $('#reservation_detail').empty();
        if ($(productModel.form_selector).valid()) {
          productModel.calculatePriceAvailability();
        }
      }

    },

    isDataComplete: function() {

      if (productModel.configuration.pickupReturnPlace) {
        if ($(productModel.pickup_place_selector).val() == '') {
          return false;
        }
        if ($(productModel.return_place_selector).val() == '') {
          return false;
        }
      }

      if (productModel.selectedDateFrom == null) {
        return false;
      }

      if (productModel.selectedDateTo == null) {
        return false;
      }

      if (productModel.configuration.timeToFrom) {
        if ($(productModel.time_from_selector).val() == '') {
          return false;
        }
        if ($(productModel.time_to_selector).val() == '') {
          return false;
        }        
      }

      return true;
    },

    /**
     * Check availability
     */
    checkAvailability: function() {

        var month1 = $('#date').data('dateRangePicker').opt.month1;
        var month2 = month1;
        
        if (productModel.configuration.datesSelector === 'start_end_date') {
          month2 = $('#date').data('dateRangePicker').opt.month2;
        }

        var m1 = moment(month1).format('YYYY-MM-DD');
        var m2 = moment(month2).add(1, 'month').format('YYYY-MM-DD');

        // Chek availibility
        productModel.checkAvailability(m1, m2);
    },

    /*
     * Load pickup hours
     */
    loadPickupHours: function() { /** Load return dates **/
      var date = moment(productModel.selectedDateFrom).format('YYYY-MM-DD');  
      productModel.loadPickupHours('time_from', date);
    },

    /**
     * Load return hours
     */
    loadReturnHours: function() {
      var date = moment(productModel.selectedDateTo).format('YYYY-MM-DD');  
      productModel.loadReturnHours('time_to', date);
    },

    /**
     * Load pickup places
     */
    loadPickupPlaces: function() {

        // Setup the event
        $(productModel.pickup_place_selector).bind('change', function() {
           productController.pickupPlaceChanged($(this).val());
        });

        // Build URL
        var url = commonServices.URL_PREFIX + '/api/booking/frontend/pickup-places';
        var urlParams = [];
        if (productModel.requestLanguage != null) {
          urlParams.push('lang='+productModel.requestLanguage);
        }
        if (commonServices.apiKey && commonServices.apiKey != '') {
          urlParams.push('api_key='+commonServices.apiKey);
        }    
        if (urlParams.length > 0) {
          url += '?';
          url += urlParams.join('&');
        }
        // DataSource
        productModel.dataSourcePickupPlaces = new RemoteDataSource(url,
                                                          {'id':'id',
                                                           'description':function(data) {
                                                               var value = data.name;
                                                               if (data.price && data.price > 0) {
                                                                   value += ' - ';
                                                                   value += 
                                                                       productModel.configuration.formatCurrency(data.price,
                                                                       productModel.configuration.currencySymbol,
                                                                       productModel.configuration.currencyDecimals,
                                                                       productModel.configuration.currencyThousandsSeparator,
                                                                       productModel.configuration.currencyDecimalMark,
                                                                       productModel.configuration.currencySymbolPosition);
                                                                   value += '';
                                                               }
                                                               return value;
                                                           }});
        var self = this;
        var pickupPlace = new SelectSelector(productModel.pickup_place_id, 
            productModel.dataSourcePickupPlaces, null, true, i18next.t('selector.select_pickup_place'),
                function() {
                  // Add other place option to the pickup places if the configuration accept custom places
                  if (productModel.configuration.customPickupReturnPlaces) {
                      if (productModel.configuration.customPickupReturnPlacePrice && 
                          productModel.configuration.customPickupReturnPlacePrice != '' && 
                          productModel.configuration.customPickupReturnPlacePrice > 0) {
                          $(productModel.pickup_place_selector).append($('<option>', {
                              value: 'other',
                              text: i18next.t('selector.another_place') + ' - ' +
                                    productModel.configuration.formatCurrency(productModel.configuration.customPickupReturnPlacePrice,
                                                             productModel.configuration.currencySymbol,
                                                             productModel.configuration.currencyDecimals,
                                                             productModel.configuration.currencyThousandsSeparator,
                                                             productModel.configuration.currencyDecimalMark,
                                                             productModel.configuration.currencySymbolPosition) + ''
                          }));
                      }
                      else {
                          $(productModel.pickup_place_selector).append($('<option>', {
                              value: 'other',
                              text: i18next.t('selector.another_place')
                          }));
                      }
                  }
                  
                } );
        
    },

    /**
     * Load return places
     */  
    loadReturnPlaces: function() {

        // Do not load the return places while pickup place is not setup
        if ($(productModel.pickup_place_selector).val() == '') {
          return;
        }

        // Setup the event
        $(productModel.return_place_selector).bind('change', function() {
            productController.returnPlaceChanged();
        });

        // Build URL
        var url = commonServices.URL_PREFIX + '/api/booking/frontend/return-places';
        var urlParams = [];
        urlParams.push('pickup_place='+encodeURIComponent($(productModel.pickup_place_selector).val()));
        if (productModel.requestLanguage != null) {
          urlParams.push('lang='+productModel.requestLanguage);
        }
        if (commonServices.apiKey && commonServices.apiKey != '') {
          urlParams.push('api_key='+commonServices.apiKey);
        }    
        if (urlParams.length > 0) {
          url += '?';
          url += urlParams.join('&');
        }
        // Datasource
        productModel.dataSourceReturnPlaces = new RemoteDataSource(url,
                                                          {'id':'id',
                                                           'description':function(data) {
                                                               var value = data.name;
                                                               if (data.price && data.price > 0) {
                                                                   value += ' - ';
                                                                   value += 
                                                                       productModel.configuration.formatCurrency(data.price,
                                                                       productModel.configuration.currencySymbol,
                                                                       productModel.configuration.currencyDecimals,
                                                                       productModel.configuration.currencyThousandsSeparator,
                                                                       productModel.configuration.currencyDecimalMark,
                                                                       productModel.configuration.currencySymbolPosition);
                                                                   value += '';
                                                               }
                                                               return value;
                                                           }});

        var self = this;
        var returnPlace = new SelectSelector(productModel.return_place_id, 
            productModel.dataSourceReturnPlaces, null, true, i18next.t('selector.select_return_place'),
                function() {
                  // Add other place option to the pickup places if the configuration accept custom places
                  if (productModel.configuration.customPickupReturnPlaces) {
                      if (productModel.configuration.customPickupReturnPlacePrice && 
                          productModel.configuration.customPickupReturnPlacePrice != '' && 
                          productModel.configuration.customPickupReturnPlacePrice > 0) {
                          $(productModel.return_place_selector).append($('<option>', {
                              value: 'other',
                              text: i18next.t('selector.another_place') + ' - ' +
                                    productModel.configuration.formatCurrency(productModel.configuration.customPickupReturnPlacePrice,
                                                             productModel.configuration.currencySymbol,
                                                             productModel.configuration.currencyDecimals,
                                                             productModel.configuration.currencyThousandsSeparator,
                                                             productModel.configuration.currencyDecimalMark,
                                                             productModel.configuration.currencySymbolPosition) + ''
                          }));
                      }
                      else {
                          $(productModel.return_place_selector).append($('<option>', {
                              value: 'other',
                              text: i18next.t('selector.another_place')
                          }));
                      }
                  }

                  // Initialize
                  $(productModel.return_place_selector).val($(productModel.pickup_place_selector).val());
                  $(productModel.return_place_selector).trigger('change');
                } );



    },

    update: function(action, id) {

      switch (action) {
        case 'hours':
          if (id == 'time_from') {
            var dataSource = new MemoryDataSource(productModel.pickupHours);
            var timeFrom = null;      
            var pickupTime = new SelectSelector(productModel.time_from_id,
                dataSource, timeFrom, true, 'hh:mm',
                function() {
                    if (timeFrom != null) {
                      $(productModel.time_from_selector).val(timeFrom);
                    }
                } );
          }
          else if (id == 'time_to') {
            var dataSource = new MemoryDataSource(productModel.returnHours);
            var timeTo =  null;
            var pickupTime = new SelectSelector(productModel.time_to_id,
                dataSource, timeTo, true, 'hh:mm',
                function() {
                    if (timeTo != null) {
                      $(productModel.time_to_selector).val(timeTo);
                    }
                } );
          }
          break;
        case 'shopping_cart':
          var html = tmpl('script_reservation_summary')({shopping_cart: productModel.shopping_cart,
                                                         configuration: productModel.configuration,
                                                         product_available: productModel.product_available,
                                                         product_type: productModel.availabilityData.type,
                                                         product: productModel.product,
                                                         i18next: i18next});
          $('#reservation_detail').html(html);
          // Add to shopping cart button
          if ($(productModel.add_to_shopping_cart_btn_selector).attr('disabled')) {
            $(productModel.add_to_shopping_cart_btn_selector).attr('disabled', false);
          }
          break;
      }

    },

    /**
     * Go to the next step (select extras or complete URL)
     */
    gotoNextStep: function() {

      if (commonServices.extrasStep) {
        window.location.href= commonServices.chooseExtrasUrl;
      }
      else {
        window.location.href= commonServices.completeUrl;
      }

    },    


  };

  var rentProductCalendar = {
    model: productModel,
    controller: productController,
    view: productView
  }
  rentEngineMediator.setProductCalendar( rentProductCalendar );

  // Check the product_selector and its data-code attribute
  if ($('#product_selector').length && $('#product_selector').attr('data-code') != 'undefined') {
    productModel.loadSettings();
  }

  


}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }),
/* 58 */
/***/ (function(module, exports, __webpack_require__) {

Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0), __webpack_require__(3), __webpack_require__(6), 
        __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), __webpack_require__(9),
        __webpack_require__(23),__webpack_require__(5), __webpack_require__(0), __webpack_require__(10),
        __webpack_require__(11),__webpack_require__(19)]; (function($, i18next, tmpl,
             commonServices, commonSettings, commonTranslations, commonLoader, select2) {

  activitySelectorModel = {

    requestLanguage: null,
    configuration: null,

    // -------------- Load settings ----------------------------

    loadSettings: function() {
      commonSettings.loadSettings(function(data){
        activitySelectorModel.configuration = data;
        activitySelectorView.init();
      });
    },  


  }

  activitySelectorController = {

  }

  activitySelectorView = {

  	init: function() {
				activitySelectorModel.requestLanguage = commonSettings.language(document.documentElement.lang);
        // Initialize i18next for translations
        i18next.init({  
                        lng: activitySelectorModel.requestLanguage,
                        resources: commonTranslations
                     }, 
                     function (error, t) {
                        // https://github.com/i18next/jquery-i18next#initialize-the-plugin
                        //jqueryI18next.init(i18next, $);
                        // Localize UI
                        //$('.nav').localize();
                     });
        // Setup Form
        this.setupSelectorFormTmpl();
  	},

    /**
     * Setup the selector form
     *
     * The selector form can be rendered in two ways:
     *
     * - Directly on the page (recommeded for final projects)
     * - Using a template that choose which fields should be rendered
     *
     * For the first option just create the form with the fields in the page
     * For the second option create an empty form and a template that creates
     * the fields depending on the configuration
     *
     * Note: The two options are hold for compatibility uses
     * 
     */
    setupSelectorFormTmpl: function() {

      // The selector form fields are defined in a micro-template
      if (document.getElementById('form_activities_selector_tmpl')) {
        // Load the template
        var html = tmpl('form_activities_selector_tmpl')({configuration: activitySelectorModel.configuration});
        // Assign to the form
        $('form[name=search_activities_form]').find('.search_fields_container').prepend(html);
        // Setup controls
        this.setupControls();
      }

    },

    setupControls: function() {

    	// Family selector	
    	$selectorFamilyId = $('form[name=search_activities_form]').find('select[name=family_id]');

    	if ($selectorFamilyId.length) {
    		var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/categories';
				var familyValue = $selectorFamilyId.attr('data-value');
	      var familySelect = $selectorFamilyId.select2({	
	      													  width: '100%',
														      	theme: 'bootstrap4',
														      	ajax: {
													            url: url,
													            dataType: 'json',
													            processResults: function (data) {
													                var result = data.map(function(x) { return {id: x.id, text: x.name} });
													                // Transforms the top-level key of the response object from 'items' to 'results'
													                return {
													                  results: result
													                };
													            }
													          }
														      });
	      // Preload with the current option
        $.ajax({
            type: 'GET',
            url: url,
        }).then(function (data) {
            familySelect.find('option[value!=""]').remove();
            for (var idx=0; idx<data.length; idx++) {
              var option = new Option(data[idx].name, data[idx].id, false, false);
              familySelect.append(option);
            }
            if (typeof familyValue !== 'undefined' && familyValue != '') {
              familySelect.val(familyValue).trigger('change');
              // Trigger the select2:select event
  						familySelect.trigger({
  						        type: 'select2:select',
  						        params: {
  						            data: data
  						        }
  						});
            }

        });
    	}

    	// Destination selector
			$selectorDestinationId = $('form[name=search_activities_form]').find('select[name=destination_id]');

    	if ($selectorDestinationId.length) {
    		var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/destinations';
				var destinationValue = $selectorDestinationId.attr('data-value');
	      var destinationSelect = $selectorDestinationId.select2({	
	      													  width: '100%',
														      	theme: 'bootstrap4',
														      	ajax: {
													            url: url,
													            dataType: 'json',
													            processResults: function (data) {
													                var result = data.map(function(x) { return {id: x.id, text: x.name} });
													                // Transforms the top-level key of the response object from 'items' to 'results'
													                return {
													                  results: result
													                };
													            }
													          }
														      });
	      // Preload with the current option
        $.ajax({
            type: 'GET',
            url: url,
        }).then(function (data) {
            destinationSelect.find('option[value!=""]').remove();
            for (var idx=0; idx<data.length; idx++) {
              var option = new Option(data[idx].name, data[idx].id, false, false);
              destinationSelect.append(option);
            }
            if (typeof destinationValue !== 'undefined' && destinationValue != '') {
              destinationSelect.val(destinationValue).trigger('change');
              // Trigger the select2:select event
  						destinationSelect.trigger({
  						        type: 'select2:select',
  						        params: {
  						            data: data
  						        }
  						});
            }

        });
    	}

    }


  }

  activitySelectorModel.loadSettings();


}).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);

/***/ }),
/* 59 */
/***/ (function(module, exports, __webpack_require__) {

Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0),__webpack_require__(3),
				 __webpack_require__(2), __webpack_require__(1), __webpack_require__(4),
				 __webpack_require__(40),__webpack_require__(41),__webpack_require__(42),
				 __webpack_require__(7)]; (function($, i18next, commonServices, commonSettings, commonTranslations,
	      				 ActivityOneTime, ActivityMultipleDates, ActivityCyclic,
	      				 moment) {

  activityModel = {

    requestLanguage: null,
    id: null,
    activity: null,
    configuration: null,

    // -------------- Load settings ----------------------------

    loadSettings: function() {
      console.log('Load Settings');
      commonSettings.loadSettings(function(data){
        activityModel.configuration = data;
        activityView.init();
      });
    },  

    loadActivity: function (id) { /* Load the activity */
        console.log('loadActivity:'+id);
        this.id = id;
        // Build URL
        var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/activities/' + this.id;
        var urlParams = [];
        if (this.requestLanguage != null) {
          urlParams.push('lang='+this.requestLanguage);
        }
        if (commonServices.apiKey && commonServices.apiKey != '') {
          urlParams.push('api_key='+commonServices.apiKey);
        } 
        if (urlParams.length > 0) {
          url += '?';
          url += urlParams.join('&');
        }
        // Request
        $.ajax({
            type: 'GET',
            url: url,
            contentType: 'application/json; charset=utf-8',
            crossDomain: true,
            success: function (data, textStatus, jqXHR) {
                activityModel.activity = data;
                activityView.updateActivity();
            },
            error: function (data, textStatus, jqXHR) {
                alert('Error obteniendo la información');
            },
            complete: function (jqXHR, textStatus) {
            }

        });
    },

  };

  activityController = {

  };

  activityView = {

  	init: function() {

      activityModel.requestLanguage = commonSettings.language(document.documentElement.lang);
      activityModel.loadActivity($('#buy_selector').attr('data-id'));

  	},

  	updateActivity: function() {

  		switch (activityModel.activity.occurence) {

  			case 'one_time':
  			  var c = new ActivityOneTime(activityModel.activity, activityModel.configuration);
  			  c.view.init();		
  				break;

  			case 'multiple_dates':
  			  var c = new ActivityMultipleDates(activityModel.activity, activityModel.configuration);
  			  c.view.init();			
  			  break;

  			case 'cyclic':
  			  var c = new ActivityCyclic(activityModel.activity, 
                                     activityModel.configuration,   
  			  													 moment().month() + 1, 
  			  													 moment().year());
  			  c.view.init();			
  			  break;

  		}


  	}

  };

  // Check the buy selector and its data-id attribute
  if ($('#buy_selector').length && $('#buy_selector').attr('data-id') != 'undefined') {
    console.log('Init Activity')
    activityModel.loadSettings();
  }

}).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);

/***/ }),
/* 60 */
/***/ (function(module, exports, __webpack_require__) {

Promise.resolve(/* AMD require */).then(function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(0),__webpack_require__(3), __webpack_require__(6), 
        __webpack_require__(2), __webpack_require__(1), __webpack_require__(4), __webpack_require__(9),
        __webpack_require__(0), __webpack_require__(5),
        __webpack_require__(19), __webpack_require__(21)]; (function($, i18next, tmpl,
             commonServices, commonSettings, commonTranslations, commonLoader) {

      model = { // THE MODEL

          requestLanguage: null,
          configuration: null,
          shoppingCart: null,

          loadSettings: function() {
            commonSettings.loadSettings(function(data){
              model.configuration = data;
              view.init();
            });
          },  

          putShoppingCartFreeAccessId: function(value) {
            sessionStorage.setItem('activities_shopping_cart_free_access_id', value);
          },

          getShoppingCartFreeAccessId: function() {
            return sessionStorage.getItem('activities_shopping_cart_free_access_id');
          },


          loadShoppingCart: function() {
              
              var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/shopping-cart';             
              var freeAccessId = this.getShoppingCartFreeAccessId();
              if (freeAccessId) {
                url += '/' + freeAccessId;
              }
              // == Url params
              var urlParams = null;
              // Language
              if (this.requestLanguage != null) {
                 urlParams = '?lang='+this.requestLanguage;
              }
              // Api Key
              if (commonServices.apiKey && commonServices.apiKey != '') {
                if (urlParams == null) {
                  urlParams = '?';
                }
                else {
                  urlParams += '&';
                }
                urlParams += 'api_key='+commonServices.apiKey;
              } 
              if (urlParams != null) {
                  url += urlParams;
              }
              // == Ajax
              $.ajax({
                  type: 'GET',
                  url: url,
                  contentType: 'application/json; charset=utf-8',
                  crossDomain: true,
                  success: function (data, textStatus, jqXHR) {
                      model.shoppingCart = data;
                      view.updateShoppingCart();
                  },
                  error: function (data, textStatus, jqXHR) {
                      alert('Error cargando datos');
                  }
              });
          },

          removeShoppingCartItem: function(date, time, itemId) {

              // Request
              var request = {date: date, time: time, item_id: itemId};
              var requestJSON = JSON.stringify(request);

              // URL
              var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/remove-from-shopping-cart';             
              var freeAccessId = this.getShoppingCartFreeAccessId();
              if (freeAccessId) {
                url += '/' + freeAccessId;
              }
              // == Url params
              var urlParams = [];
              
              // Language
              if (this.requestLanguage != null) {
                 urlParams.push('lang='+this.requestLanguage);
              }
              // Api Key
              if (commonServices.apiKey && commonServices.apiKey != '') {
                urlParams.push('api_key='+commonServices.apiKey);
              } 
              if (urlParams != null) {
                  url += '?';
                  url += urlParams.join('&');
              }
              
              // == Ajax
              $.ajax({
                 type: 'POST',
                 url: url,
                 data: requestJSON,
                 dataType: 'json',
                 crossDomain: true,
                 success: function(data, textStatus, jqXHR) {
                     model.shoppingCart = data;
                     view.updateShoppingCart();
                 },
                 error: function (data, textStatus, jqXHR) {
                     alert('Error actualizando datos');
                 },
                 beforeSend: function(jqXHR) {
                     commonLoader.show();
                 },
                 complete: function(jqXHR, textStatus) {
                     commonLoader.hide();
                 }
              });


          },

          createOrder: function() { // It creates an order from the shopping cart

              // Request object
              var order = $('form[name=reservation_form]').formParams(false);
              var orderJSON = JSON.stringify(order);
              var paymentMethod = order.payment;
              var paymentAmount = null;
              if (model.shoppingCart.can_pay_deposit) {
                paymentAmount = 'deposit';
              }
              else if (model.shoppingCart.can_pay_total) {
                paymentAmount = 'total';
              }

              // URL
              var url = commonServices.URL_PREFIX + '/api/booking-activities/frontend/create-order';             
              var freeAccessId = this.getShoppingCartFreeAccessId();
              if (freeAccessId) {
                url += '/' + freeAccessId;
              }
              // == Url params
              var urlParams = [];

              // Language
              if (this.requestLanguage != null) {
                 urlParams.push('lang='+this.requestLanguage);
              }
              // Api Key
              if (commonServices.apiKey && commonServices.apiKey != '') {
                urlParams.push('api_key='+commonServices.apiKey);
              } 
              if (urlParams.length > 0) {
                  url += '?';
                  url += urlParams.join('&');
              }
              // == Ajax
              $.ajax({
                  type: 'POST',
                  url : url,
                  data: orderJSON,
                  dataType : 'json',
                  contentType : 'application/json; charset=utf-8',
                  crossDomain: true,
                  success: function(data, textStatus, jqXHR) {

                      var orderId = data;
                      if (paymentMethod == 'none') {
                          window.location.href = commonServices.orderUrl + '?id=' + orderId;
                      }
                      else {
                          $.form(commonServices.URL_PREFIX + '/reserva-actividades/pagar', {id: orderId,
                                                                                            payment: paymentAmount,
                                                                                            payment_method_id: paymentMethod},
                                 'POST').submit();
                      }
                  },
                  error: function(data, textStatus, jqXHR) {
                      alert('Error creando el pedido');
                  }
              });

          }

      };

      controller = { // THE CONTROLLER

          removeShoppingCartItemButtonClick: function(date, time, itemId) {

              model.removeShoppingCartItem(date, time, itemId);

          },

          completeActionChange: function() {
              
              if ($('input[name=complete_action]:checked').val() === 'pay_now') {
                $('#request_reservation_container').hide();
                $('#payment_on_delivery_container').hide();
                $('#payment_now_container').show();
                // Only one payment method accepted
                if ($('#payment_method_value').length) {
                  $('input[name=payment]').val($('#payment_method_value').val());
                }
                // More than one payment methods accepted
                $('.payment_method_select').unbind('change');
                $('.payment_method_select').bind('change', function(){
                  controller.paymentMethodChange($(this).val());
                })
              }
              else if ($('input[name=complete_action]:checked').val() === 'request_reservation') {
                $('input[name=payment]').val('none');
                $('#request_reservation_container').show();
                $('#payment_on_delivery_container').hide();
                $('#payment_now_container').hide();
              }

          },

          paymentMethodChange: function(value) {
            $('input[name=payment]').val(value);
          }


      };

      view = { // THE VIEW

          init: function() {

              model.requestLanguage = commonSettings.language(document.documentElement.lang);

              // Initialize i18next for translations
              i18next.init({  
                              lng: model.requestLanguage,
                              resources: commonTranslations
                           }, 
                           function (error, t) {
                           });

              model.loadShoppingCart();

          },

          setupEvents: function() {

              $('#accept').bind('click', function(){
                  //controller.conditionsReadClick();
              });

              $('.btn-delete-shopping-cart-item').bind('click', function () {
                  controller.removeShoppingCartItemButtonClick($(this).attr('data-date'),
                      $(this).attr('data-time'),
                      $(this).attr('data-item-id'));
              });              

          },

          setupValidation: function() {

              this.setupReservationFormValidation();

          },

          setupReservationFormValidation: function() {

              $('form[name=reservation_form]').validate(
                  {

                      submitHandler: function(form) {
                          $('#reservation_error').hide();
                          $('#reservation_error').html('');
                          // Create order from the shopping cart
                          model.createOrder();
                          return false;
                      },

                      invalidHandler : function (form, validator) {
                          $('#reservation_error').html(i18next.t('activities.checkout.errors'));
                          $('#reservation_error').show();
                      },

                      rules : {

                          'customer_name': 'required',
                          'customer_surname' : 'required',
                          'customer_email' : {
                              required: true,
                              email: true
                          },
                          'customer_email_confirmation': {
                              required: true,
                              email: true,
                              equalTo : 'customer_email'
                          },
                          'customer_phone': {
                              required: true,
                              minlength: 9
                          },
                          'payment_method_value': {
                              required: 'input[name=payment_method_value]:visible'
                          },
                          'conditions_read_request_reservation' :  {
                              required: '#conditions_read_request_reservation:visible'
                          },
                          'conditions_read_payment_on_delivery' :  {
                              required: '#conditions_read_payment_on_delivery:visible'
                          },
                          'conditions_read_pay_now' :  {
                              required: '#conditions_read_pay_now:visible'
                          },    
                      },

                      messages : {

                          'customer_name': i18next.t('activities.checkout.validations.customerNameRequired'),
                          'customer_surname' : i18next.t('activities.checkout.validations.customerSurnameRequired'),
                          'customer_email' : {
                              required: i18next.t('activities.checkout.validations.customerEmailRequired'),
                              email: i18next.t('activities.checkout.validations.customerEmailInvalidFormat')
                          },
                          'customer_email_confirmation': {
                              'required': i18next.t('activities.checkout.validations.customerEmailConfirmationRequired'),
                              email: i18next.t('activities.checkout.validations.customerEmailInvalidFormat'),
                              'equalTo': i18next.t('activities.checkout.validations.customerEmailConfirmationEqualsEmail')
                          },
                          'customer_phone': {
                              'required': i18next.t('activities.checkout.validations.customerPhoneNumberRequired'),
                              'minlength': i18next.t('activities.checkout.validations.customerPhoneNumberMinLength')
                          },
                          'payment_method_value': {
                              required: i18next.t('activities.checkout.validations.selectPaymentMethod')
                          },
                          'conditions_read_request_reservation': {
                              'required': i18next.t('activities.checkout.validations.conditionsReadRequired')
                          },                       
                          'conditions_read_payment_on_delivery': {
                              'required': i18next.t('activities.checkout.validations.conditionsReadRequired')
                          },   
                          'conditions_read_pay_now': {
                              'required': i18next.t('activities.checkout.validations.conditionsReadRequired')
                          }   

                      },

                      errorPlacement: function (error, element) {

                          if (element.attr('name') == 'conditions_read_request_reservation' || 
                              element.attr('name') == 'conditions_read_payment_on_delivery' ||
                              element.attr('name') == 'conditions_read_pay_now') {
                              error.insertAfter(element.parent());
                          }
                          else if (element.attr('name') == 'payment_method_value') {
                              error.insertAfter(document.getElementById('payment_method_select_error'));
                          }
                          else
                          {
                              error.insertAfter(element);
                          }

                      },

                      errorClass : 'form-reservation-error'

                  }
              );

          },

          updateShoppingCart: function() { /* Update the shopping cart */
              $('#reservation_container').empty();
              $('#payment_detail').empty();
              if (model.shoppingCart && model.shoppingCart.items &&
                  !$.isEmptyObject(model.shoppingCart.items)) {
                  this.updateReservationForm();
                  this.updateShoppingCartProducts();
                  this.updatePayment();
                  this.setupValidation();
                  this.setupEvents();
              }
              else {
                  this.updateShoppingCartEmpty();
              }
          },

          updateShoppingCartEmpty: function() {
              var shoppingCartEmptyHtml = tmpl('script_shopping_cart_empty');
              $('#selected_products').html(shoppingCartEmptyHtml);
          },

          updateShoppingCartProducts: function() { /* Update the shopping cart products */
              var productInfo = tmpl('script_products_detail')(
                  {shopping_cart: model.shoppingCart,
                   configuration: model.configuration});
              $('#selected_products').html(productInfo);
          },

          updateReservationForm: function() { /* Update the reservation form */
              var customerForm = tmpl('script_reservation_form',{language: model.requestLanguage});
              $('#reservation_container').html(customerForm);
          },

          updatePayment: function() { /* Update the payment */


               // Check :
               //
               // 1 - If the reservation can be paid
               // 2 - The payment amount
               // 3 - If can request and pay
               //

               var canPay = (model.shoppingCart.can_pay_deposit || model.shoppingCart.can_pay_total);
               var paymentAmount = 0;
               var selectionOptions = 0;

               if (model.shoppingCart.can_make_request) {
                 selectionOptions += 1;
               }

               if (canPay) {
                 selectionOptions += 1;
                 if (model.shoppingCart.can_pay_deposit) {
                    paymentAmount = model.shoppingCart.deposit_payment_amount;
                 }
                 else {
                    paymentAmount = model.shoppingCart.total_payment_amount;
                 }           
               }

               var canRequestAndPay = (selectionOptions > 1);

              // Payment template

              var paymentInfo = tmpl('script_payment_detail', {shopping_cart: model.shoppingCart,
                                                               canPay: canPay,
                                                               paymentAmount: paymentAmount,
                                                               canRequestAndPay: canRequestAndPay,
                                                               i18next: i18next,
                                                               configuration: model.configuration});
              $('#payment_detail').html(paymentInfo);

              $('input[name=complete_action]').bind('click', function() {
                 controller.completeActionChange();
              });

          }

      };

      model.loadSettings();


    }).apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__);}).catch(__webpack_require__.oe);

/***/ })
/******/ ]);