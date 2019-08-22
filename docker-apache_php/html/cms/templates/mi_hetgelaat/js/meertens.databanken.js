/*
 function to dynamically load jquery
 */
/*jslint browser: true, devel: true, plusplus: true */
var jqMi; // make global so my other scripts will know it.
(function (window, document, version, path, callback) {
  "use strict";
  var script, compareVersionNumbers, isPositiveInteger, done, loaded = false;

  /**
   * http://stackoverflow.com/a/1019526/11236
   */
  isPositiveInteger = function (x) {
    return (/^\d+$/.test(x));
  };

  /**
   * Compare two software version numbers (e.g. 1.7.1)
   * Returns:
   *
   *  0 if they're identical
   *  negative if v1 < v2
   *  positive if v1 > v2
   *  Nan if they in the wrong format
   *
   *  E.g.:
   *
   *  assert(version_number_compare("1.7.1", "1.6.10") > 0);
   *  assert(version_number_compare("1.7.1", "1.7.10") < 0);
   *
   *  "Unit tests": http://jsfiddle.net/ripper234/Xv9WL/28/
   *
   *  Taken from http://stackoverflow.com/a/6832721/11236
   *
   *  Changed to compare parts as integers instead of string (jpk)
   */
  compareVersionNumbers = function (v1, v2) {
    var v1parts = v1.split('.'),
      v2parts = v2.split('.'),
      i;

    // First, validate both numbers are true version numbers
    function validateParts(parts) {
      for (i = 0; i < parts.length; ++i) {
        if (!isPositiveInteger(parts[i])) {
          return false;
        }
      }
      return true;
    }

    if (!validateParts(v1parts) || !validateParts(v2parts)) {
      return NaN;
    }

    for (i = 0; i < v1parts.length; ++i) {
      if (v2parts.length === i) {
        return 1;
      }

      if (parseInt(v1parts[i], 10) === parseInt(v2parts[i], 10)) {
        //noinspection JSLint
        continue;
      }
      if (parseInt(v1parts[i], 10) > parseInt(v2parts[i], 10)) {
        return 1;
      }
      //noinspection JSLint
      return -1;
    }

    if (v1parts.length !== v2parts.length) {
      return -1;
    }

    return 0;
  };

  jqMi = window.jQuery;
  // jQuery niet al geladen of bestaande jQuery versie kleiner dan "version":
  // laad jQuery versie "version" van Google
  if (!jqMi || compareVersionNumbers(version, jqMi.fn.jquery) === 1) {
    script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "//ajax.googleapis.com/ajax/libs/jquery/" + version + "/jquery.min.js";
    script.onload = script.onreadystatechange = function () {
      done = this.readyState;
      if (!loaded && (!done || done === "loaded" || done === "complete")) {
        jqMi = (window.jQuery).noConflict(1);
        loaded = true;
        callback(jqMi, path);
        jqMi(script).remove();
      }
    };
    document.documentElement.childNodes[0].appendChild(script);
  } else {
    // gebruik anders de bestaande jQuery versie
    callback(jqMi, path);
  }
}(window, document, "1.9.1", location.hostname + (location.port ? ':' + location.port: '') + "/cms/templates/mi_hetgelaat", function ($, path) {
  /* All system are go, we have jQuery, proceed as normal */
  "use strict";
  console.log(path);
  var disable_databanken_css = function () {
      $('link[href$="databanken.css"]').attr('disabled', 'disabled').remove();
    },
    // http://stackoverflow.com/questions/2202305/how-do-i-detect-ie-8-with-jquery/18615772#18615772
    isIE = function (version, comparison) {
      var $div = $('<div style="display:none;"/>').appendTo($('body')), ieTest;
      $div.html('<!--[if ' + (comparison || '') + ' IE ' + (version || '') + ']><a>&nbsp;</a><![endif]-->');
      ieTest = $div.find('a').length;
      $div.remove();
      return ieTest;
    },
    $tmp = $("<div />");

  $('body').css('display', 'none');
  $("<link/>", {
    rel: "stylesheet",
    type: "text/css",
    href: "//" + path + "/css/reset_old_db_styles.css"
  }).appendTo("head");
  $("<link/>", {
    rel: "stylesheet",
    type: "text/css",
    href: "//" + path + "/css/style.css",
    id: "hetgelaat-css"
  }).appendTo("head");
  $("<link/>", {
    rel: "stylesheet",
    type: "text/css",
    href: "//" + path + "/css/styles_extra_jpk.css"
  }).appendTo("head");
  $("<link/>", {
    rel: "stylesheet",
    type: "text/css",
    href: "//" + path + "/css/print.css",
    media: "print"
  }).appendTo("head");

  if (isIE(8, 'lte')) {
    $("<link/>", {
      rel: "stylesheet",
      type: "text/css",
      href: "//" + path + "/css/IE7.css"
    }).appendTo("head");
  }
  disable_databanken_css();

  $.ajax({
    url: "//" + path + "/js/cms_header_footer.php",
   // url: "http://www.meertens.dev/cms/index.php/nl/?option=com_content&view=article&id=144022",
    dataType: 'html'
  }).done(function (response) {
    var $m_header, $m_footer, $sitewrapper, body = $("body"), scroll = true;
    $tmp.html(response);
    $m_header = $tmp.find("#header");
    $m_footer = $tmp.find("#footer");

    $sitewrapper = $('<div id="main"><div class="container"><div class="ctd"><div class="row"><div class="large-12  columns"></div></div></div></div></div>');
    body.wrapInner($sitewrapper);
    $m_header.prependTo(body);
    if ($(window).innerWidth()  > 762) {
      $m_footer.appendTo(body);
    } else {
      scroll = false;
    }
    if (isIE(8, 'lte')) {
      $.getScript("//" + path + "/js/respond.min.js");
    }
    $.getScript("//" + path + "/js/general.js");
    body.fadeIn();
    if (scroll === true) {
      $(window).scrollTop(35);
    }
  }).fail(function () {
    $('body').show();
  });
})); // end (window, document, version, path, function($, path))