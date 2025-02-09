
var Events = {};
// Events.text = [
//     ['Will start in','<font color="green">Time left to start'],
//     ['Will appear in','<font color="red">Time left to invasion']
// ];

var $ev = $('#events');

// Events.text = [
//     [$ev.data('start-0'),  '<font color="green">'+$ev.data('start-1')+''],
//     [$ev.data('appear-0'),  '<font color="red">'+$ev.data('appear-1')+'']
// ];
Events.text = [
  ['Sẽ xuất hiện trong', '<font color="green">Thời gian bắt đầu'],
  ['Sẽ xuất hiện trong', '<font color="red">Th&#7901;i gian b&#7855;t &#273;&#7847;u s&#7921; x&acirc;m chi&#7871;m']
];

Events.sked = [
  ['Chaos Castle', 0, '01:00', '03:00', '05:00', '07:00', '09:00', '11:00', '13:00', '15:00', '17:00', '19:00', '21:00', '23:00'],
  ['Golden Invasion', 1, '01:15', '03:15', '05:15', '07:15', '09:15', '11:15', '13:15', '15:15', '17:15', '19:15', '21:15', '23:15'],
  ['Skeleton King', 1, '00:50', '04:50', '08:50', '12:50', '16:50', '20:50'],
  ['Castle Deep', 0, '17:00'],
  ['Great Dragon', 1, '12:45', '18:45'],
  ['Lorencia Fortress', 0, '18:00'],
  ['Happy Hour', 0, '12:00', '19:00'],
  ['White Rabbits', 1, '13:47', '19:47'],
  ['Team Deathmatch', 0, '14:00', '20:00'],
  ['Kanturu Domination', 0, '14:30', '20:30'],
  ['Asteroth', 1, '22:00']
];

Events.init = function (e, today) { // (int)H+i+s, (string)dayname

  if (today == 'Sat') {
    Events.sked[6] = ['Happy Hour', 0, '03:00', '09:00', '12:00', '15:00', '22:00'];

    //Events.sked[7] = ['Team Deathmatch', 0, '14:00', '17:00'];
    //Events.sked[8] = ['Kanturu Domination', 0, '14:30'];
  }
  else
    if (today == 'Sun') {
      Events.sked[5] = ['Lorencia Fortress', 0, '16:00'];

      Events.sked[6] = ['Happy Hour', 0, '03:00', '09:00', '12:00', '15:00', '22:00'];

      Events.sked[8] = ['Team Deathmatch', 0, '11:00', '17:00'];
      Events.sked[9] = ['Kanturu Domination', 0, '11:30', '17:30'];
    }

  var q = Events.sked;
  var j = [];

  for (var a = 0; a < q.length; a++) {
    var n = q[a];
    for (var k = 2; k < q[a].length; k++) {
      var b = 0;
      var p = q[a][k].split(":");
      var o = (p[0] * 60 + p[1] * 1) * 60;
      var c = q[a][2].split(":");
      if (q[a].length - 1 == k && (o - e) < 0) b = 1;
      var r = b ? (1440 * 60 - e) + ((c[0] * 60 + c[1] * 1) * 60) : o - e;
      if (e <= o || b) {
        var l = Math.floor((r / 60) / 60), l = l < 10 ? "0" + l : l;
        var d = Math.floor((r / 60) % 60), d = d < 10 ? "0" + d : d;
        var u = r % 60, u = u < 10 ? "0" + u : u;

        j.push('<div class="event border-top"> ' +
          '<div class="event-name-block flex-s-c"> ' +
          '<span class="event-name" title="' + n[0] + '">' + n[0] + ' ' +
          '<span class="event-time">' + (q[a][b ? 2 : k]) + ' ' +
          ' ' +
          '<div class="event-time-block flex-s-c" style="text-align:left"> ' +
          '<span class="event-start">' + (Events.text[q[a][1]][+(l == 0 && d < (q[a][1] ? 1 : 5))]) + '  ' +
          '<span class="event-time-start">' + (l + ":" + d + ":" + u) + ' ' +
          ' ' +
          '');

        break;
      };
    };
  };
  document.getElementById("events").innerHTML = j.join("");
  setTimeout(function () { Events.init(e == 86400 ? 1 : ++e, today); }, 1000);
};

function myTimer(h, m, s) {
  if (s > 59) { s = 0; m++; }
  if (m > 59) { m = 0; h++; }
  if (h > 23) { h = 0; }
  if (h < 10) h = "0" + h;
  if (m < 10) m = "0" + m;
  if (s < 10) s = "0" + s;
  document.getElementById("time").innerHTML = h + ":" + m + ":" + s;
  setTimeout(function () { myTimer(+h, +m, ++s) }, 1000);
}
