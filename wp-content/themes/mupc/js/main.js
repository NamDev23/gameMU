
function getURLVar(strParamName) {
  var strReturn = "";
  var strHref = window.location.href;
  if (strHref.indexOf("?") > -1) {
    var strQueryString = strHref.substr(strHref.indexOf("?")).toLowerCase();
    var aQueryString = strQueryString.split("&");
    for (var iParam = 0; iParam < aQueryString.length; iParam++) {
      if (
        aQueryString[iParam].indexOf(strParamName.toLowerCase() + "=") > -1) {
        var aParam = aQueryString[iParam].split("=");
        strReturn = aParam[1];
        break;
      }
    }
  }
  return unescape(strReturn);
};


function elShowHide(id, speed, status) {
  if (status != 0) {
    if (document.getElementById(id).style.display == 'none') {
      if (typeof (speed) != "undefined")
        $("#" + id).slideDown(speed);
      else
        $("#" + id).slideDown();
    }
    else {
      if (typeof (speed) != "undefined")
        $("#" + id).slideUp(speed);
      else
        $("#" + id).slideUp();
    }
  }
};

function elOpenClose(id) {
  if (document.getElementById(id).style.display == 'none') {
    $("#" + id).show();
  }
  else {
    $("#" + id).hide();
  }
};

function selAction(action, value) {
  if (action == 1) {
    $.post("send/x-services.php", { act: action, val: value, mysessid: getCookie('PHPSESSID') }, function (data) {
      res = /XHX/;
      var ok = res.test(data);
      if (ok == true) {
        var result = data.split("XHX");
        document.getElementById('reszen').innerHTML = result[0];
        document.getElementById('reslvl').innerHTML = result[1];
        if (restime = document.getElementById('restime')) restime.innerHTML = result[2];
      }
    });
  }
  else
    if (action == 2) {
      $.post("send/x-services.php", {
        act: action,
        val: value,
        mysessid: getCookie('PHPSESSID')
      },
        function (data) {
          document.getElementById('price').innerHTML = data;
        });
    }
    else
      if (action == 3) {
        $.post("send/x-services.php", {
          act: action,
          val: value,
          mysessid: getCookie('PHPSESSID')
        },
          function (data) {
            data = JSON.parse(data);

            $('#bought-stats-info div').hide();
            if (data.boughtStats > 0) {
              $('#has-stats span').text(data.boughtStats);
              $('#has-stats').show();
            }
            else { $('#no-stats').show(); }
          });
      }
      else
        if (action == 4) {
          var $input = $('#selectinput_schars');
          var actionDo = $input.closest('td[data-action-do]').attr('data-action-do');

          $.post("send/x-services.php", { act: action, do: actionDo, val: value, mysessid: getCookie('PHPSESSID') }, function (data) {
            res = /XHX/;
            var ok = res.test(data);

            if (ok == true) {
              var result = data.split("XHX");

              document.getElementById('pFree').innerHTML = result[0];
              document.getElementById('pStr').innerHTML = result[1];
              document.getElementById('pAgi').innerHTML = result[2];
              document.getElementById('pVit').innerHTML = result[3];
              document.getElementById('pEne').innerHTML = result[4];

              if (result[6] == 64 || result[6] == 66) {
                document.getElementById('pCom').innerHTML = result[5];
                document.getElementById('hcom').style.visibility = 'visible';
              }
              else {
                document.getElementById('hcom').style.visibility = 'hidden';
              }

              document.getElementById('price').innerHTML = result[7];
            }
          });
        }
        else if (action == 5) {
          $.post("send/x-services.php", { act: action, val: value, mysessid: getCookie('PHPSESSID') }, function (data) { document.getElementById('pkcount').innerHTML = data; });
        }
        else
          if (action == 6) {

            gocat = value;

            $('#table-market-item-categories').attr('data-href', gocat).trigger('market-search-by-item-category');
          }
          else if (action == 8) {
            $.post("send/x-services.php", { act: action, val: value, mysessid: getCookie('PHPSESSID') }, function (data) { document.getElementById('wihu').innerHTML = data; });
          } else if (action == 10) {
            $.post("send/x-services.php", { act: action, val: value, mysessid: getCookie('PHPSESSID') }, function (data) { document.getElementById('pkprice').innerHTML = data; });
          } else if (action == 11) {
            $.post("send/x-services.php", { act: action, val: value, mysessid: getCookie('PHPSESSID') }, function (data) { document.getElementById('grp').innerHTML = data; });
          } else if (action == 15) {
            custom1 = document.getElementById('chclass_selected').value;
            $.post("send/x-services.php", { act: action, val: value, custom1: custom1, mysessid: getCookie('PHPSESSID') }, function (data) { document.getElementById('price').innerHTML = data; });
          }
          else
            if (action == 16) {
              $.post("send/x-services.php", {
                act: action,
                val: value,
                mysessid: getCookie('PHPSESSID')
              },
                function (data) {
                  document.getElementById('currentzen').innerHTML = data;
                });
            }
            else
              if (action == 18) {

                if (['4.14', '4.15', '4.16', '4.17', '8'].indexOf(value) !== -1) {
                  document.getElementById('rule8_1').style.display = 'table-row';
                  document.getElementById('rule8_2').style.display = 'table-row';
                }
                else {
                  document.getElementById('rule8_1').style.display = 'none';
                  document.getElementById('rule8_2').style.display = 'none';
                }
              }
              else
                if (action == 19) {
                  var activeAct = getURLVar('act');
                  var search = document.getElementById('search_field').value;
                  if (value == '-') {
                    location.href = 'index.php?page=manage&act=' + activeAct + '&search=' + search;
                  } else {
                    location.href = 'index.php?page=manage&act=' + activeAct + '&select=' + value + '&search=' + search;
                  }
                } else if (action == 20) {
                  $.post("send/x-services.php", { act: action, val: value, mysessid: getCookie('PHPSESSID') }, function (data) { document.getElementById('gtp').innerHTML = data; });
                }
};

function selectInput(object, name, startTitle, startValue, formName, width, status, action) {
  if (object.substring(0, 3) == 'wi_') {
    this.obj = object.substring(3);
    this.outId = object;
  } else {
    this.obj = object;
    this.outId = false;
  }

  this.name = name;
  this.startTitle = startTitle;
  this.startValue = startValue;
  this.formName = formName;
  this.width = width;
  this.status = status;
  this.action = action;
  this.iList = [];
  this.iList2 = [];
  this.timer = null;
};

selectInput.prototype.add = function (discription, value, javascript) {
  this.iList[this.iList.length] = Array(discription, value, javascript);
};

selectInput.prototype.add2 = function (discription, value, javascript) {
  this.iList2[this.iList2.length] = Array(discription, value, javascript);
};

selectInput.prototype.timerReset = function () {
  clearTimeout(this.timer);
  this.timer = setTimeout("$(\"#selectinput_" + this.obj + "\").hide()", 500);
};

selectInput.prototype.timerStop = function () {
  clearTimeout(this.timer);
};

selectInput.prototype.click = function (txt, value) {
  $("#selectinput_" + this.obj).hide();
  $("#selectinput_title_" + this.obj).text(txt);
  $("#selectinput_input_" + this.obj).attr({ value: "" + value + "" });

  if (this.formName != '')
    eval("document." + this.formName + ".submit();");
};

selectInput.prototype.reloadArr = function () {
  this.iList2 = [];
};

selectInput.prototype.construct = function () {
  if (this.iList.length > 10) {
    var div_scroll = 'height: 200px; overflow: auto; ';
  } else {
    var div_scroll = '';
  }

  if (this.formName == 'loginform') {

    var output = '<div style="margin:1px 0px 1px 0px; padding:0px; cursor:pointer; width:' + this.width + 'px; z-index:5;" onclick="elShowHide(\'selectinput_' + this.obj + '\', 150, ' + this.status + ');" onmouseover="' + this.obj + '.timerStop();" onmouseout="' + this.obj + '.timerReset();">'
      + '<table border="0" cellpadding="0" cellspacing="1" height="23" bgcolor="#eae8e0" style="border: 1px solid #5d4320;" width="100%"><tr>'
      + '<td style="border: 1px solid #5d4320; padding: 0px 5px 0px 5px;" bgcolor="#eae8e0"><div id="selectinput_title_' + this.obj + '" style="color: #000000; font: 11px Arial;">' + this.startTitle + ''
      + '<td width="16" bgcolor="#d0cabc">'
      + ''
      + ''
      + '<input type="hidden" id="selectinput_input_' + this.obj + '" name="' + this.name + '" value="' + this.startValue + '">'
      + '<div id="selectinput_' + this.obj + '" style="margin:1px 0px 0px 0px; padding:0px; z-index:5; display: none; width:' + this.width + 'px; position:absolute;" onmouseover="' + this.obj + '.timerStop();" onmouseout="' + this.obj + '.timerReset();">'
      + '<div style="' + div_scroll + 'border: 1px solid #5d4320;"><table border="0" cellpadding="0" cellspacing="3" width="100%" style="background-color: #eae8e0;">';

  } else {

    var output = '<div style="margin:1px 0px 1px 0px; padding:0px; cursor:pointer; width:' + this.width + 'px; z-index:5;" onclick="elShowHide(\'selectinput_' + this.obj + '\', 150, ' + this.status + ');" onmouseover="' + this.obj + '.timerStop();" onmouseout="' + this.obj + '.timerReset();">'
      + '<table border="0" cellpadding="0" cellspacing="1" height="23" bgcolor="#eae8e0" style="border: 1px solid #b6b7b1;" width="100%"><tr>'
      + '<td style="border: 1px solid #b6b7b1; padding: 0px 5px 0px 5px;" bgcolor="#eae8e0"><div id="selectinput_title_' + this.obj + '" style="color: #000000; font: 11px Arial;">' + this.startTitle + ''
      + '<td width="16" bgcolor="#d0cabc">'
      + ''
      + ''
      + '<input type="hidden" id="selectinput_input_' + this.obj + '" name="' + this.name + '" value="' + this.startValue + '">'
      + '<div id="selectinput_' + this.obj + '" style="margin:1px 0px 0px 0px; padding:0px; z-index:5; display: none; width:' + this.width + 'px; position:absolute;" onmouseover="' + this.obj + '.timerStop();" onmouseout="' + this.obj + '.timerReset();">'
      + '<div style="' + div_scroll + 'border: 1px solid #b6b7b1;"><table border="0" cellpadding="0" cellspacing="3" width="100%" style="background-color: #eae8e0;">';

  }

  for (i = 0; i < this.iList.length; i++) {
    output += '<tr><td style="cursor:default; padding-left:5px; padding-top:3px;" onmouseover="$(this).css({ background: \'#d8d7d5\'});" onmouseout="$(this).css({ background: \'#eae8e0\'});" onclick="if (' + this.action + ' != 0) { selAction(' + this.action + ',\'' + this.iList[i][1] + '\'); } ' + this.obj + '.click(\'' + this.iList[i][0] + '\',\'' + this.iList[i][1] + '\');' + this.iList[i][2] + '">' + this.iList[i][0] + '';
  }

  for (i = 0; i < this.iList2.length; i++) {
    output += '<tr><td style="cursor:default; padding-left:5px; padding-top:3px;" onmouseover="$(this).css({ background: \'#d8d7d5\'});" onmouseout="$(this).css({ background: \'#eae8e0\' });" onclick="if (' + this.action + ' != 0) { selAction(' + this.action + ',\'' + this.iList[i][1] + '\'); } ' + this.obj + '.click(\'' + this.iList2[i][0] + '\',\'' + this.iList2[i][1] + '\');' + this.iList2[i][2] + '">' + this.iList2[i][0] + '';
  }

  output += '';

  if (!this.outId)
    document.write(output);
  else
    $("#" + this.outId).html(output);
};


function css_browser_selector(u) { var ua = u.toLowerCase(), is = function (t) { return ua.indexOf(t) > -1 }, g = 'gecko', w = 'webkit', s = 'safari', o = 'opera', m = 'mobile', h = document.documentElement, b = [(!(/opera|webtv/i.test(ua)) && /msie\s(\d)/.test(ua)) ? ('ie ie' + RegExp.$1) : is('firefox/2') ? g + ' ff2' : is('firefox/3.5') ? g + ' ff3 ff3_5' : is('firefox/3.6') ? g + ' ff3 ff3_6' : is('firefox/3') ? g + ' ff3' : is('gecko/') ? g : is('opera') ? o + (/version\/(\d+)/.test(ua) ? ' ' + o + RegExp.$1 : (/opera(\s|\/)(\d+)/.test(ua) ? ' ' + o + RegExp.$2 : '')) : is('konqueror') ? 'konqueror' : is('blackberry') ? m + ' blackberry' : is('android') ? m + ' android' : is('chrome') ? w + ' chrome' : is('iron') ? w + ' iron' : is('applewebkit/') ? w + ' ' + s + (/version\/(\d+)/.test(ua) ? ' ' + s + RegExp.$1 : '') : is('mozilla/') ? g : '', is('j2me') ? m + ' j2me' : is('iphone') ? m + ' iphone' : is('ipod') ? m + ' ipod' : is('ipad') ? m + ' ipad' : is('mac') ? 'mac' : is('darwin') ? 'mac' : is('webtv') ? 'webtv' : is('win') ? 'win' + (is('windows nt 6.0') ? ' vista' : '') : is('freebsd') ? 'freebsd' : (is('x11') || is('linux')) ? 'linux' : '', 'js']; c = b.join(' '); h.className += ' ' + c; return c; }; css_browser_selector(navigator.userAgent);
  
