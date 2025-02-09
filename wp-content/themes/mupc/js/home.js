
var loader = true;

function Loader() {
  setTimeout("if (loader == true) { document.getElementById('loader').style.display = 'block' }", 300);
};

function Load() {
  document.getElementById('page').style.display = 'block';
  document.getElementById('loader').style.display = 'none';
  loader = false;
};

function Glow(img) {
  lang = ((getCookie('lang')) ? getCookie('lang') : 'ru');
  var href = img.src.split('images/' + lang);
  img.src = href[0] + 'images/' + lang + '/glow' + href[1];
};

function UnGlow(img) {
  var href = img.src.split('glow/');
  img.src = href[0] + href[1];
};

function GlowL(img) {
  var href = img.src.split('images');
  img.src = href[0] + 'images/glow' + href[1];
};

function UnGlowL(img) {
  var href = img.src.split('glow/');
  img.src = href[0] + href[1];
};

function ServClick(img) {
  var server1 = document.getElementById('server1');
  var server2 = document.getElementById('server2');
  var server3 = document.getElementById('server3');
  var server4 = document.getElementById('server4');
  var server5 = document.getElementById('server5');
  var server6 = document.getElementById('server6');
  if (img.id == 'server1') {
    if (img.name == 'no' && server2.name == 'yes') {
      server2.name = 'no';
      UnGlowL(server2);
    }
    if (img.name == 'no' && server3.name == 'yes') {
      server3.name = 'no';
      UnGlowL(server3);
    }
    if (img.name == 'no' && server4.name == 'yes') {
      server4.name = 'no';
      UnGlowL(server4);
    }
    if (img.name == 'no' && server5.name == 'yes') {
      server5.name = 'no';
      UnGlowL(server5);
    }
    if (img.name == 'no' && server6.name == 'yes') {
      server6.name = 'no';
      UnGlowL(server6);
    }
    img.name = 'yes';
    document.getElementById('serv').value = 'server1';
  } else if (img.id == 'server2') {
    if (img.name == 'no' && server1.name == 'yes') {
      server1.name = 'no';
      UnGlowL(server1);
    }
    if (img.name == 'no' && server3.name == 'yes') {
      server3.name = 'no';
      UnGlowL(server3);
    }
    if (img.name == 'no' && server4.name == 'yes') {
      server4.name = 'no';
      UnGlowL(server4);
    }
    if (img.name == 'no' && server5.name == 'yes') {
      server5.name = 'no';
      UnGlowL(server5);
    }
    if (img.name == 'no' && server6.name == 'yes') {
      server6.name = 'no';
      UnGlowL(server6);
    }
    img.name = 'yes';
    document.getElementById('serv').value = 'server2';
  } else if (img.id == 'server3') {
    if (img.name == 'no' && server1.name == 'yes') {
      server1.name = 'no';
      UnGlowL(server1);
    }
    if (img.name == 'no' && server2.name == 'yes') {
      server2.name = 'no';
      UnGlowL(server2);
    }
    if (img.name == 'no' && server4.name == 'yes') {
      server4.name = 'no';
      UnGlowL(server4)
    }
    if (img.name == 'no' && server5.name == 'yes') {
      server5.name = 'no';
      UnGlowL(server5);
    }
    if (img.name == 'no' && server6.name == 'yes') {
      server6.name = 'no';
      UnGlowL(server6);
    }
    img.name = 'yes';
    document.getElementById('serv').value = 'server3';
  } else if (img.id == 'server4') {
    if (img.name == 'no' && server1.name == 'yes') {
      server1.name = 'no';
      UnGlowL(server1);
    }
    if (img.name == 'no' && server2.name == 'yes') {
      server2.name = 'no';
      UnGlowL(server2);
    }
    if (img.name == 'no' && server3.name == 'yes') {
      server3.name = 'no';
      UnGlowL(server3);
    }
    if (img.name == 'no' && server5.name == 'yes') {
      server5.name = 'no';
      UnGlowL(server5);
    }
    if (img.name == 'no' && server6.name == 'yes') {
      server6.name = 'no';
      UnGlowL(server6);
    }
    img.name = 'yes';
    document.getElementById('serv').value = 'server4';
  }
  else
    if (img.id == 'server5') {
      if (img.name == 'no' && server1.name == 'yes') {
        server1.name = 'no';
        UnGlowL(server1);
      }
      if (img.name == 'no' && server2.name == 'yes') {
        server2.name = 'no';
        UnGlowL(server2);
      }
      if (img.name == 'no' && server3.name == 'yes') {
        server3.name = 'no';
        UnGlowL(server3);
      }
      if (img.name == 'no' && server4.name == 'yes') {
        server4.name = 'no';
        UnGlowL(server4);
      }
      if (img.name == 'no' && server6.name == 'yes') {
        server6.name = 'no';
        UnGlowL(server6);
      }
      img.name = 'yes';
      document.getElementById('serv').value = 'server5';
    }
    else
      if (img.id == 'server6') {
        if (img.name == 'no' && server1.name == 'yes') {
          server1.name = 'no';
          UnGlowL(server1);
        }
        if (img.name == 'no' && server2.name == 'yes') {
          server2.name = 'no';
          UnGlowL(server2);
        }
        if (img.name == 'no' && server3.name == 'yes') {
          server3.name = 'no';
          UnGlowL(server3);
        }
        if (img.name == 'no' && server4.name == 'yes') {
          server4.name = 'no';
          UnGlowL(server4);
        }
        if (img.name == 'no' && server5.name == 'yes') {
          server5.name = 'no';
          UnGlowL(server5);
        }
        img.name = 'yes';
        document.getElementById('serv').value = 'server6';
      }
};

function ServClickSearch(bserv) {
  var server1 = document.getElementById('server1_m');
  var server2 = document.getElementById('server2_m');
  var server3 = document.getElementById('server3_m');
  var server4 = document.getElementById('server4_m');
  var server5 = document.getElementById('server5_m');
  var server6 = document.getElementById('server6_m');
  if (bserv.id == 'server1_m') {
    if (bserv.name == 'no' && server2 != null && server2.name == 'yes') {
      server2.style.color = "#453c3f";
      server2.name = 'no';
    }
    if (bserv.name == 'no' && server3 != null && server3.name == 'yes') {
      server3.style.color = "#453c3f";
      server3.name = 'no';
    }
    if (bserv.name == 'no' && server4 != null && server4.name == 'yes') {
      server4.style.color = "#453c3f";
      server4.name = 'no';
    }
    if (bserv.name == 'no' && server5 != null && server5.name == 'yes') {
      server5.style.color = "#453c3f";
      server5.name = 'no';
    }
    if (bserv.name == 'no' && server6 != null && server6.name == 'yes') {
      server6.style.color = "#453c3f";
      server6.name = 'no';
    }
    bserv.name = 'yes';
    bserv.style.color = "#8a3235";
    document.getElementById('serv_search').value = 'server1';
  } else if (bserv.id == 'server2_m') {
    if (bserv.name == 'no' && server1 != null && server1.name == 'yes') {
      server1.style.color = "#453c3f";
      server1.name = 'no';
    }
    if (bserv.name == 'no' && server3 != null && server3.name == 'yes') {
      server3.style.color = "#453c3f";
      server3.name = 'no';
    }
    if (bserv.name == 'no' && server4 != null && server4.name == 'yes') {
      server4.style.color = "#453c3f";
      server4.name = 'no';
    }
    if (bserv.name == 'no' && server5 != null && server5.name == 'yes') {
      server5.style.color = "#453c3f";
      server5.name = 'no';
    }
    if (bserv.name == 'no' && server6 != null && server6.name == 'yes') {
      server6.style.color = "#453c3f";
      server6.name = 'no';
    }
    bserv.name = 'yes';
    bserv.style.color = "#8a3235";
    document.getElementById('serv_search').value = 'server2';
  } else if (bserv.id == 'server3_m') {
    if (bserv.name == 'no' && server1 != null && server1.name == 'yes') {
      server1.style.color = "#453c3f";
      server1.name = 'no';
    }
    if (bserv.name == 'no' && server2 != null && server2.name == 'yes') {
      server2.style.color = "#453c3f";
      server2.name = 'no';
    }
    if (bserv.name == 'no' && server4 != null && server4.name == 'yes') {
      server4.style.color = "#453c3f";
      server4.name = 'no';
    }
    if (bserv.name == 'no' && server5 != null && server5.name == 'yes') {
      server5.style.color = "#453c3f";
      server5.name = 'no';
    }
    if (bserv.name == 'no' && server6 != null && server6.name == 'yes') {
      server6.style.color = "#453c3f";
      server6.name = 'no';
    }
    bserv.name = 'yes';
    bserv.style.color = "#8a3235";
    document.getElementById('serv_search').value = 'server3';
  } else if (bserv.id == 'server4_m') {
    if (bserv.name == 'no' && server1 != null && server1.name == 'yes') {
      server1.style.color = "#453c3f";
      server1.name = 'no';
    }
    if (bserv.name == 'no' && server2 != null && server2.name == 'yes') {
      server2.style.color = "#453c3f";
      server2.name = 'no';
    }
    if (bserv.name == 'no' && server3 != null && server3.name == 'yes') {
      server3.style.color = "#453c3f";
      server3.name = 'no';
    }
    if (bserv.name == 'no' && server5 != null && server5.name == 'yes') {
      server5.style.color = "#453c3f";
      server5.name = 'no';
    }
    if (bserv.name == 'no' && server6 != null && server6.name == 'yes') {
      server6.style.color = "#453c3f";
      server6.name = 'no';
    }
    bserv.name = 'yes';
    bserv.style.color = "#8a3235";
    document.getElementById('serv_search').value = 'server4';
  }
  else
    if (bserv.id == 'server5_m') {
      if (bserv.name == 'no' && server1 != null && server1.name == 'yes') {
        server1.style.color = "#453c3f";
        server1.name = 'no';
      }
      if (bserv.name == 'no' && server2 != null && server2.name == 'yes') {
        server2.style.color = "#453c3f";
        server2.name = 'no';
      }
      if (bserv.name == 'no' && server3 != null && server3.name == 'yes') {
        server3.style.color = "#453c3f";
        server3.name = 'no';
      }
      if (bserv.name == 'no' && server4 != null && server4.name == 'yes') {
        server4.style.color = "#453c3f";
        server4.name = 'no';
      }
      if (bserv.name == 'no' && server6 != null && server6.name == 'yes') {
        server6.style.color = "#453c3f";
        server6.name = 'no';
      }
      bserv.name = 'yes';
      bserv.style.color = "#8a3235";
      document.getElementById('serv_search').value = 'server5';
    }
    else
      if (bserv.id == 'server6_m') {
        if (bserv.name == 'no' && server1 != null && server1.name == 'yes') {
          server1.style.color = "#453c3f";
          server1.name = 'no';
        }
        if (bserv.name == 'no' && server2 != null && server2.name == 'yes') {
          server2.style.color = "#453c3f";
          server2.name = 'no';
        }
        if (bserv.name == 'no' && server3 != null && server3.name == 'yes') {
          server3.style.color = "#453c3f";
          server3.name = 'no';
        }
        if (bserv.name == 'no' && server4 != null && server4.name == 'yes') {
          server4.style.color = "#453c3f";
          server4.name = 'no';
        }
        if (bserv.name == 'no' && server5 != null && server5.name == 'yes') {
          server5.style.color = "#453c3f";
          server5.name = 'no';
        }
        bserv.name = 'yes';
        bserv.style.color = "#8a3235";
        document.getElementById('serv_search').value = 'server6';
      }
};

function makeSearch(what) {
  objServ = document.getElementById('serv_search').value;
  objWhat = what;
  if (what == 'char') {
    objLike = document.getElementById('fieldsCh').value;
  } else {
    objLike = document.getElementById('fieldsGu').value;
  }
  $.post("send/x-search.php", {
    submit: true,
    serv: objServ,
    what: objWhat,
    like: objLike
  }, function (data) {
    if (document.getElementById('search_result').style.display == 'none') {
      document.getElementById('search_result').innerHTML = data;
      $("#search_result").slideDown(200);
    } else {
      $("#search_result").slideUp(200, function () {
        document.getElementById('search_result').innerHTML = data;
        setTimeout('$("#search_result").slideDown(200);', 500);
      })
    }
  })
};

function GlowK() {
  document['kuznica'].src = 'templates/bless/images/glow/Blesslv_166.jpg';
  document['kuznica2'].src = 'templates/bless/images/glow/Blesslv_169.jpg';
  document['kuznica3'].src = 'templates/bless/images/glow/Blesslv_170.jpg';
  document['kuznica4'].src = 'templates/bless/images/glow/Blesslv_177.jpg';
};

function UnGlowK() {
  document['kuznica'].src = 'templates/bless/images/Blesslv_166.jpg';
  document['kuznica2'].src = 'templates/bless/images/Blesslv_169.jpg';
  document['kuznica3'].src = 'templates/bless/images/Blesslv_170.jpg';
  document['kuznica4'].src = 'templates/bless/images/Blesslv_177.jpg';
};

function gettime() {
  $("#time").load("modules/time.php");
  setTimeout('$("#time").load("modules/time.php"); gettime();', 1000);
};

function submitenter(myfield, e) {
  var keycode;
  if (window.event) keycode = window.event.keyCode;
  else if (e) keycode = e.which;
  else return true;
  if (keycode == 13) {
    myfield.form.submit();
    return false;
  } else return true;
};

function initTool() {
  $(function () {
    $('#over img').not('.toolinited').tooltip({
      track: true,
      delay: 0,
      showURL: false
    }).addClass('toolinited');
    $('#over_s a').not('.toolinited').tooltip({
      track: true,
      delay: 0,
      showURL: false
    }).addClass('toolinited');
    $('#over_j a').not('.toolinited').tooltip({
      extraClass: 'overlight',
      track: true,
      delay: 0,
      showURL: false
    }).addClass('toolinited');
    $('#over_sh a').not('.toolinited').tooltip({
      track: true,
      delay: 0,
      showURL: false
    }).addClass('toolinited');
    $('#over_sh2 a').not('.toolinited').tooltip({
      extraClass: 'overlight',
      track: true,
      delay: 0,
      showURL: false
    }).addClass('toolinited');
    $('#over_sh3 a').not('.toolinited').tooltip({
      extraClass: 'overlight',
      track: true,
      delay: 0,
      showURL: false
    }).addClass('toolinited');
    $('#over_sh4 a').not('.toolinited').tooltip({
      track: true,
      delay: 0,
      showURL: false
    }).addClass('toolinited');
    $('#over_sms font').not('.toolinited').tooltip({
      track: true,
      delay: 0,
      showURL: false
    }).addClass('toolinited')
  })
};

function linktd(obj) {
  obj.style.cursor = 'pointer';
  if (obj.style.background != '#311b05') {
    obj.style.background = '#311b05';
  } else {
    obj.style.background = '#221101';
  }
};

function openInvent(type) {
  obj = document.getElementById(type);
  if (obj.style.display == 'none') {
    $("#" + type).slideDown(100);
  } else {
    $("#" + type).slideUp(100);
  }
};

function openWarehouse() {
  obj = document.getElementById('wareh');
  if (obj.style.display == 'none') {
    $("#wareh").slideDown(100);
  } else {
    $("#wareh").slideUp(100);
  }
};

function openMarketItems() {
  obj = document.getElementById('marketi');
  if (obj.style.display == 'none') {
    $("#marketi").slideDown(100);
  } else {
    $("#marketi").slideUp(100);
  }
};

function openMarketStats() {
  obj = document.getElementById('marketS');
  if (obj.style.display == 'none') {
    $("#marketS").slideDown(100);
  } else {
    $("#marketS").slideUp(100);
  }
};

function openMarketLogs() {
  obj = document.getElementById('marketL');
  if (obj.style.display == 'none') {
    $("#marketL").slideDown(100);
  } else {
    $("#marketL").slideUp(100);
  }
};

function openAchievementsInfo() {
  obj = document.getElementById('achievementsinfo');
  if (obj.style.display == 'none') {
    $("#achievementsinfo").slideDown(100);
  } else {
    $("#achievementsinfo").slideUp(100);
  }
};

function openAccInfo() {
  obj = document.getElementById('accinfo');
  if (obj.style.display == 'none') {
    $("#accinfo").slideDown(100);
  } else {
    $("#accinfo").slideUp(100);
  }
};

function openDonation(dontype) {
  obj = document.getElementById(dontype);
  if (obj.style.display == 'none') {
    $("#" + dontype).slideDown(100);
  } else {
    $("#" + dontype).slideUp(100);
  }
};

function openTarget(target) {
  obj = document.getElementById(target);
  if (obj.style.display == 'none') {
    $("#" + target).slideDown(100);
  } else {
    $("#" + target).slideUp(100);
  }
};

function checkCalls() {
  var account = document.getElementById('calls_account').value;
  var code = document.getElementById('calls_code').value;
  if (empty(account)) {
    alert('Please input account');
  } else if (empty(code)) {
    alert('Please input code');
  } else {
    document.calls_form.submit();
  }
};

function loadWin(server) {
  place = document.getElementById('winSpan');
  $.post("templates/bless/pans/winners.php", {
    ws: server
  }, function (data) {
    place.innerHTML = data;
  });
};

function getprice(usluga) {
  $.post("send/x-services.php", {
    act: 'get_price',
    item: usluga,
    val: '-',
    mysessid: getCookie('PHPSESSID')
  }, function (data) {
    document.getElementById('price').innerHTML = data;
  });
};

function getcraftprice(usluga) {
  $.post("send/x-services.php", {
    act: 'get_craft_price',
    item: usluga,
    val: '-',
    mysessid: getCookie('PHPSESSID')
  }, function (data) {
    divider = /XHX/;
    var result = divider.test(data);
    if (result == true) {
      var gotmsg = data.split("XHX");
      document.getElementById('pricecp').innerHTML = gotmsg[0];
      document.getElementById('pricezen').innerHTML = gotmsg[1];
    } else {
      alert(data);
    }
  });
};

function getitem(usluga) {
  $.post("send/x-services.php", {
    act: '335',
    item: usluga,
    val: '-',
    mysessid: getCookie('PHPSESSID')
  }, function (data) {
    divider = /XHX/;
    var result = divider.test(data);
    if (result == true) {
      var gotmsg = data.split("XHX");
      document.getElementById('iteminfo').src = gotmsg[0];
      document.getElementById('iteminfo').title = gotmsg[1];
      $('#over2 img').tooltip({ track: true, delay: 0, showURL: false });
    } else {
      alert(data);
    }
  });
};

function showQuest(quest) {
  $.post("send/x-quest.php", {
    quest: quest
  }, function (data) {
    document.getElementById('Wq').innerHTML = data;
  });
};

function empty(mixed_var) {
  if (mixed_var === "" || mixed_var === 0 || mixed_var === "0" || mixed_var === null || mixed_var === false || mixed_var === undefined || ((typeof mixed_var == 'array' || typeof mixed_var == 'object') && mixed_var.length === 0)) {
    return true;
  }
  return false;
};



function popup(url, name, width, height) {
  childWindow = open(url, name, "width=" + width + ",height=" + height + ",left=" + (screen.width / 2 - width / 2) + ",top=" + (screen.height / 2 - height / 2) + ",menubar=0,toolbar=0,location=0,directories=0,status=0,resizable=0,scrollbars=1").focus();
  //if (childWindow.opener == null) childWindow.opener = self;
};

function doLogin() {
  var login = $("#login").val();
  var password = $("#password").val();
  var server = jQuery('select :selected').val();
  $.post("post/login.php", {
    login: login,
    password: password,
    serv: server,
    submitL: 'submit',
    ajaxLogin: true
  }, function (data) {
    document.location.reload();
  }, "text");
};

function naviUpload(status) {
  if (status == "bar") {
    $("#uploadstatustext").css("display", "none");
    $("#uploadstatus").css("display", "block");
  } else {
    $("#uploadstatus").css("display", "none");
    $("#uploadstatustext").css("display", "block");
  }
};

function barUpload(percentage) {
  $("#progressbar").css("width", percentage + "%");
  $("#progressbarpec").text(percentage + "%");
};

function startUpload() {
  key = "";
  for (i = 0; i < 32; i++) {
    key += Math.floor(Math.random() * 16).toString(16);
  }
  document.getElementById("uploadform").action = "upload/upload.php?X-Progress-ID=" + key;
  uid = "showUpload('" + key + "');";
  document.uploadform.submit();
  setTimeout(uid, 100);
};

function showUpload(key) {
  uid = "showUpload('" + key + "');";
  $.ajax({
    beforeSend: function (xhrObj) {
      xhrObj.setRequestHeader("X-Progress-ID", key);
    },
    type: "GET",
    url: "/progress",
    processData: false,
    dataType: "json",
    success: function (data) {
      if (data.state == 'done') {
        setTimeout("showStatus();", 100);
      } else if (data.state == 'uploading') {
        naviUpload("bar");
        percentage = Math.floor(100 * parseInt(data.received) / parseInt(data.size));
        barUpload(percentage);
        setTimeout(uid, 100);
      } else if (data.state == 'starting') {
        setTimeout(uid, 100);
      } else {
        naviUpload("text");
        $("#uploadstatustext").text("Maximum image size is 10MB");
        setTimeout("window.location.replace(window.location.href);", 2000);
      }
    }
  });
}
function showStatus() {
  naviUpload("text");
  var myIFrame = document.getElementById('loader');
  var content = myIFrame.contentWindow.document.body.innerHTML;
  $("#uploadstatustext").text(content);
  if (content != "Please select image" && content != "Image type is not supported" && content != "Error uploading image") {
    setTimeout("window.close(); opener.location.reload();", 2000);
  } else {
    setTimeout("window.location.replace(window.location.href);", 2000);
  }
};

function setCookie(c_name, value, expires = null) {
  var exdate = new Date();

  if (expires == null) {
    var expires = 1000 * 3600 * 24 * 30;
  }

  exdate.setTime(exdate.getTime() + expires);
  document.cookie = c_name + "=" + escape(value) + ";expires=" + exdate.toUTCString();
};

function getCookie(name) {
  var cookie = " " + document.cookie;
  var search = " " + name + "=";
  var setStr = null;
  var offset = 0;
  var end = 0;
  if (cookie.length > 0) {
    offset = cookie.indexOf(search);
    if (offset != -1) {
      offset += search.length;
      end = cookie.indexOf(";", offset);
      if (end == -1) {
        end = cookie.length;
      }
      setStr = unescape(cookie.substring(offset, end));
    }
  }
  return (setStr);
};

function vote4serv() {
  var vote = getCookie('vote');
  if (vote == null) {
    setCookie("vote", "yes");
    window.open('NULL', 'blank', 'width=3000, height=3000, location, scrollbars=1');
  }
};

function show(menu) {
  var d = document,
    elemS = (d.getElementById(menu) || d.all[menu]).style;
  elemS.display = elemS.display == 'none' ? 'block' : 'none';
};

function buyitem_sms(item_id) {
  var url = "/modules/smsshop/main.php?p=11&id=" + escape(item_id) + "&mysessid=" + getCookie('PHPSESSID');
  var rem = "uid_" + escape(item_id);
  remrem = document.getElementById(rem).innerHTML;
  $.get(url, function (data) {
    updatePage_buyitem_sms(data);
  });
};

function updatePage_buyitem_sms(data) {
  res = /\*/;
  var result = res.test(data);
  if (result == true) {
    var resp = data.split("*");
    var response = resp[0];
    var bonuses = resp[1];
    alert(response);
    document.getElementById('bonuses').innerHTML = bonuses;
  }
  if (result == false) {
    alert(data);
  }
  TB_remove(remrem);
};

function buyitem_grands(item_id, char_name) {
  var url = "/modules/grandshop/main.php?p=10&id=" + escape(item_id) + "&name=" + escape(char_name) + "&mysessid=" + getCookie('PHPSESSID');
  var rem = "uid_" + escape(item_id);
  remrem = document.getElementById(rem).innerHTML;
  $.get(url, function (data) {
    alert(data);
    TB_remove(remrem);
  });
};

function update_market(server) {
  setCookie("market_layer", server);
  document.location.hash = "#freeze";
  document.location.reload();
};

function PreloadTextModule(page) {
  obj = document.getElementById(page);
  if (obj.innerHTML == "") {
    $.post("send/x-page.php", {
      submit: 'submit',
      page: page
    }, function (data) {
      obj.innerHTML = data;
      openTarget(page)
    }, "text");
  } else {
    openTarget(page);
  }
};

function acceptor(msg) {
  if (confirm(msg)) {
    return true;
  } else {
    return false;
  }
};

function countdown(id, cdt) {
  oldInput = document.getElementById('replace_input');
  if (oldInput) {
    var newInput = document.createElement('input');
    newInput.type = 'hidden';
    newInput.name = id;
    newInput.value = 'true';
    oldInput.parentNode.replaceChild(newInput, oldInput);
  }
  document.getElementById(id).disabled = true;
  document.getElementById(id).value = "Please wait ..";
  if (cdt >= 0.1) {
    cdt = cdt - 0.1;
    cdt = Math.round(cdt * 100) / 100;
    if (!(Math.round(cdt * 100) % 100)) {
      cdt = cdt + ".0";
    };
    if (cdt < 9.0) {
      document.getElementById(id).value = "Please wait " + cdt + " seconds ..";
    };
    initcdt = function () {
      countdown(id, cdt);
    };
    setTimeout(initcdt, 100);
  } else {
    document.getElementById(id).value = "Loading page ..";
  }
};

function resetchar(elem, character) {
  elem.onclick = null;
  elem.style.cursor = null;
  $.post("send/x-services.php", {
    act: 'doreset',
    val: character,
    mysessid: getCookie('PHPSESSID')
  }, function (data) {
    switch (data.res) {
      case 'wait':
        elem.innerText = (data.rtime / 60 | 0) + data.min;
        setTimeout(function () { resettime(elem, character, data.rtime / 60 | 0, data.min, data.lg) }, data.rtime % 60 * 1000);
        msgtime(data.msg, data.color, data.time);
        break;
      case 'msg':
        elem.onclick = function () { resetchar(elem, character) };
        elem.style.cursor = 'pointer';
        msgtime(data.msg, data.color, data.time);
        break;
      case 'req':
        var n = elem.id.substr(5);
        if (data.opt & 1) {
          var x = document.getElementById('level' + n);
          x.innerText = data.level; x.style.color = data.xcolor;
        }
        if (data.opt & 2) {
          var x = document.getElementById('zen' + n);
          x.innerText = data.zen; x.style.color = data.xcolor;
        }
        elem.style.color = '#b7b0b0';
        msgtime(data.msg, data.color, data.time);
        break;
      case 'done':
        var n = elem.id.substr(5);
        var x = document.getElementById('msg');
        x.innerText = data.level; x.style.color = '#b7b0b0';
        document.getElementById('resets' + n).innerText = data.resets;
        var x = document.getElementById('level' + n);
        x.innerText = data.level; x.style.color = '#b7b0b0';
        var x = document.getElementById('zen' + n);
        x.innerText = data.zen; if (data.style > 0) x.style.color = '#b7b0b0';
        document.getElementById('reqzen' + n).innerText = data.reqzen;
        elem.style.color = '#b7b0b0';
        msgtime(data.msg, data.color, data.time);
        break;
      case 'error':
        elem.style.color = '#b7b0b0';
        msgtime(data.msg, data.color, data.time);
        break;
      default:
        elem.style.color = '#b7b0b0';
    }
  }, 'json');
};

function resettime(elem, character, mins, txt, lg) {
  if (mins > 1) {
    elem.innerText = --mins + txt;
    setTimeout(function () { resettime(elem, character, mins, txt, lg) }, 60000);
  } else {
    elem.innerText = lg;
    elem.onclick = function () { resetchar(elem, character) };
    elem.setAttribute('style', 'cursor: pointer; color: #28a53c;');
  }
}

var timerId;
function msgtime(txt, color, time) {
  clearTimeout(timerId);
  var x = document.getElementById('msg');
  x.style.color = color;
  x.innerText = txt;
  x.style.display = 'block';
  timerId = setTimeout(function () { x.style.display = 'none'; x.innerText = ''; }, time);
}


