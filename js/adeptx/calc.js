var showSimpleCalculator;
var nextInput;
var putInPlace;
var closeSimpleCalculator;

( function () {

  "use strict";

  var calculate, divRE = /[0-9\.]+\/[0-9\.]+/, getNumber, mulRE = /[0-9\.]+\*[0-9\.]+/, decRE = /[0-9\.]+/, expRE = /[0-9\.n][\+_\/\*][0-9\.]/, //minus sign is represented as '_', to avoid problems with a negative number
  removeExtraZeros, simplify, sumRE = /[0-9\.]+\+[0-9\.]+/, subRE = /[0-9\.]+_[0-9\.]+/, slideRight, slideLeft, stackTop, MAX_INPUT_SIZE = 9, MAX_VALUE = 999999999, MIN_VALUE = -99999999, ERROR = "-Error-", stack = [], opRE = new RegExp(
      /[\+\_\/\*=]/), //minus sign is represented as '_', to avoid problems with a negative number
  nbrRE = new RegExp(/^[0-9]*\.?[0-9]*$/), clearInputField = false;

  /**
   * Gets the actual Number object from the numberAsString, which can contain
   * 'n' letters (representing the usage of the +/- key), '-' sign, decimal
   * points and digits.
   */
  getNumber = function (numberAsString) {
    return parseFloat(numberAsString, 10);
  };

  /**
   * Calculates the value of the given expression, which can be any two term
   * expression with the four signs '+', '_' (representing the minus sign for
   * operations, to avoid confusion with '-' sign for negative numbers), '/',
   * '*', and any number of 'n's, indicating sign switch key operation.
   */
  calculate = function (expression) {
    var members, result = 0;

    if (sumRE.test(expression)) {
      members = expression.split("+");
      result = getNumber(members[0]) + getNumber(members[1]);
    } else if (subRE.test(expression)) {
      members = expression.split("_");
      result = getNumber(members[0]) - getNumber(members[1]);
    } else if (mulRE.test(expression)) {
      members = expression.split("*");
      result = getNumber(members[0]) * getNumber(members[1]);
    } else if (divRE.test(expression)) {
      members = expression.split("/");
      result = getNumber(members[0]) / getNumber(members[1]);
    } else if (decRE.test(expression)) {
      result = getNumber(expression);
    }
    return result;
  };

  /**
   * Recursive function that simplifies the given expression (an array object),
   * starting from the given position, and reducing to a simpler expression,
   * e.g., a '1+1' expression will be simplified to '2'.
   */
  simplify = function (position, expression) {
    var thisResult = 0, currentExpression;

    if (position >= expression.length) {
      thisResult = calculate(expression.join(""));
    } else if (opRE.test(expression[position])) {
      currentExpression = expression.splice(0, position).join("");
      thisResult = calculate(currentExpression);
      expression.unshift(thisResult);
      thisResult = simplify(2, expression);
    } else {
      thisResult = simplify(position + 1, expression);
    }
    return thisResult;
  };

  /**
   * Removes extra trailing and leading zeros from the given number.
   */
  removeExtraZeros = function (number) {
    var nbr = number;
    if (number !== "0") {
      nbr = number.replace(/^0+(?!\.)/, "");
      nbr = nbr.replace(/(\.[0-9]+?)0+$/g, "$1");
    }
    return nbr;
  };

  /**
   * Gets the top of the object stack.
   */
  stackTop = function () {
    var top;
    if (stack.length > 0) {
      top = stack[stack.length - 1];
    } else {
      top = "";
    }
    return top;
  };

  /**
   * Processes the next input character, from the valid range set in the
   * front-end: 0 a 9, '.', '*-1' for sign switch key, '+', '_' (representing
   * the minus operation, to avoid confusion with negative numbers), 'C' for
   * clear, '=', '/', and '*'.
   */
  nextInput = function (input) {
    var output, value, result, expression;

    output = $("div.simplecalculator input.output");
    output.focus();
    value = output.val();
    if (value === ERROR) {
      output.val("");
      value = "";
    }
    if (nbrRE.test(input)) {
      if (clearInputField) {
        output.val("");
        value = "";
        clearInputField = false;
      }
      if /* If no decimal point yet */(value.indexOf(".") === -1 || input !== ".") {
        if (stackTop() === "=") {
          stack = [];
        }
        if (value.length < MAX_INPUT_SIZE) {
          output.val(value + input);
          stack.push(input);
        }
      }
    } else if (opRE.test(input) && value !== "") {
      clearInputField = true;
      if (nbrRE.test(stackTop())) {
        expression = stack.slice(0, stack.length);
        if (expRE.test(expression.join(""))) {
          result = simplify(0, expression);
          stack = [];
          if (result > MAX_VALUE || result < MIN_VALUE) {
            result = ERROR;
          } else if (result > 0 && result < 1) {
            result = result.toFixed(MAX_INPUT_SIZE);
          } else if (result < 0 && result > -1) {
            result = result.toFixed(MAX_INPUT_SIZE);
          }
          if (result.toString().length > MAX_INPUT_SIZE) {
            result = result.toString().substring(0, MAX_INPUT_SIZE);
          }
          result = removeExtraZeros(result.toString());
          if (Math.abs(parseFloat(result)) === 0) {
            result = 0;
          }
          stack.push(result);
          output.val(result);
        } else {
          output.val(removeExtraZeros(value));
        }
      } else {
        stack.pop();
      }
      stack.push(input);
    } else if (input === "C" || input === "DEL") {
      output.val("");
      stack = [];
    }
  };

  /**
   * Moves the given target element to a position close to the reference element
   * on the current window.
   */
  putInPlace = function (target, reference) {
    setTimeout( function () {
      target.position( {
        "my" : "left top",
        "at" : "right top",
        "of" : reference,
        "offset" : "-3px -90px",
        "collision" : "none"
      });
    }, 50);
  };

  /**
   * Slides open the given calculator widget, from the given reference element.
   */
  slideRight = function (calculator, reference) {
    var width, left, zoomLevel = 1;

    $("div.simplecalculator input.output").val("");
    // If webkit, get zoom level
    if (calculator.css('-webkit-text-size-adjust') != null) {
      zoomLevel = (window.outerWidth - 8) / window.innerWidth;      
    }
    width = calculator.width();
    left = calculator.position().left;
    calculator.parent().show().css("position", "absolute");
    putInPlace(calculator.parent(), reference);
    calculator.show()
    calculator.css( {
      left : -width
    })
    calculator.animate( {
      left : "+=" + (width * zoomLevel)
    }, 500);
  };

  /**
   * Slides shut the calculator widget, executing, if not null, the callBack
   * function.
   */
  slideLeft = function (calculator, callBack) {
    var width = calculator.width();
    calculator.animate( {
      left : "-=" + (width)
    }, 500, function () {
      $(this).hide();
      $(this).parent().hide();
      if (callBack != null) {
        callBack();
      }
    });
  };

  /**
   * Initialises the calculator widget, opening it or closing it, depending on
   * the current status. It uses the given reference as an achor point and, if
   * not null, executes the given callBack function.
   */
  showSimpleCalculator = function (reference, callBack) {
    var calc, calcFrame, output, isIE, isOpera;

    calc = $("div.simplecalculator");
    if (!closeSimpleCalculator(calc)) {
      calcFrame = $("#calcFrame");
      calcFrame.css( {
        "background-color" : "none",
        "width" : calc.width(),
        "height" : calc.height(),
        "overflow" : "hidden"
      });
      output = $("div.simplecalculator input.output");
      isIE = navigator.userAgent.indexOf("MSIE") > -1;
      isOpera = navigator.userAgent.indexOf("Opera") > -1;
      output.off("keydown").on("keydown", function (event) {
        var chr, keyCode, input, codeRE = new RegExp(/[0-9\.\+\-\/\*=]/);

        event.preventDefault();
        keyCode = event.keyCode;
        chr = isIE ? String.fromCharCode(event.which) : String.fromCharCode(event.charCode || event.keyCode);
        if (event.which === 46 && event.keyCode === 46 && event.charCode === 46) {
          //For Safari
          input = ".";
        } else if (keyCode === 46) {
          if (isOpera && event.which === 46) {
            input = ".";
          } else {
            input = "C";
          }
        } else if (keyCode === 13) {
          input = "=";
        } else if (keyCode >= 96) {
          // For then numeric pad in IE
          switch (keyCode) {
          case 96:
            input = "0";
            break;
          case 97:
            input = "1";
            break;
          case 98:
            input = "2";
            break;
          case 99:
            input = "3";
            break;
          case 100:
            input = "4";
            break;
          case 101:
            input = "5";
            break;
          case 102:
            input = "6";
            break;
          case 103:
            input = "7";
            break;
          case 104:
            input = "8";
            break;
          case 105:
            input = "9";
            break;
          case 106:
            input = "*";
            break;
          case 107:
            input = "+";
            break;
          case 109:
            input = "-";
            break;
          case 110:
            input = ".";
            break;
          case 111:
            input = "/";
            break;
          case 190:
            input = ".";
            break;
          }
        } else if (codeRE.test(chr)) {
          input = chr;
        }
        nextInput(input);
      });
      stack = [];
      slideRight(calc, reference);
    }
  };

  /**
   * Receives the calculator object and closes the it, returning true if the
   * calculator was visible and closed, false otherwise.
   */
  closeSimpleCalculator = function (calculator) {
    var calc = calculator != null ? calculator : $("div.simplecalculator");

    if (calc.is(":visible")) {
      slideLeft(calc);
      return true;
    } else {
      return false;
    }
  };

}());

/**
 * Calls the initialising function showSimpleCalculator for the calculator
 * widget and handles its positioning during window resizing.
 */
$(document).ready( function () {

  "use strict";

  var that;

  $("span.ico-calculator,div.cal-close").on("click", function () {
    that = $(this);
    showSimpleCalculator(that);

  });
  $(window).resize( function () {
    putInPlace($("div.simplecalculator").parent(), that);
  });
});