"use strict";

var container = document.getElementById("container_media");
var rect = container.getBoundingClientRect();
var boxes = [].slice.call(container.getElementsByClassName("box_media"));
var filter = "selectable";
/* INIT SELECTABLE */

const items = document.getElementsByClassName('box_media');
for (let i = 0; i < items.length; i++) {
  items[i].id = `box_${i}`;
}

var selectable = new Selectable({
  filter: ".box_media",
  appendTo: container,
  autoScroll: {
    increment: 15,
    threshold: 0 },

    lasso: {
      borderColor: "rgba(255, 255, 255, 1)",
      backgroundColor: "rgba(255, 255, 255, 0.1)" } });


selectable.on("init", function () {
  boxes.forEach(function (box) {
    box.classList.add("ui-selectable");
  });
  setThreshold();
});








/* DEMO STUFF */

init();

function init() {
  var gui = new dat.GUI();
  var tolerance = {
    name: "tolerance",
    touch: true,
    fit: false };

    var direction = {
      name: "shiftDirection",
      normal: true,
      reverse: false };

      var lassoSelect = {
        name: "lassoSelect",
        normal: true,
        sequential: false };

        var Filter = {
          enabled: false };

          var Misc = {
            type: "fixed",
            fixed: function fixed() {
              boxes.forEach(function (el) {
                el.classList.remove("floated");
                el.style.position = "";
                el.style.top = "";
                el.style.left = "";
                el.style.transform = "";
              });
              selectable.update();
            },
            transformed: function transformed() {
              var w = window.innerWidth;
              var h = window.innerHeight;
              var o = 200;
              var t = 250;
              var m = 5;
              toggle(lassoSelect, "normal");
              boxes.forEach(function (el) {
                var r = el.getBoundingClientRect();
                var x = getRandomInt(o, w - o);
                var y = getRandomInt(o, h - o);
                var a = getRandomInt(0, 270);
                var s = getRandomInt(-8, 15) / 10;
                el.classList.add("floated");
                el.style.position = "absolute";
                el.style.top = "".concat(y - rect.top, "px");
                el.style.left = "".concat(x - rect.left, "px");
                el.style.transform = "translate3d(".concat(getRandomInt(-50, 50), "px, ").concat(getRandomInt(-50, 50), "px, 0) rotate(").concat(a, "deg) scale(").concat(s, ")");
              });
              selectable.update();
            },
            random: function random() {
              var w = window.innerWidth;
              var h = window.innerHeight;
              var o = 200;
              var t = 250;
              var m = 5;
              toggle(lassoSelect, "normal");
              boxes.forEach(function (el) {
                var r = el.getBoundingClientRect();
                var x = getRandomInt(o, w - o);
                var y = getRandomInt(o, h - o);
                el.classList.add("floated");
                el.style.position = "absolute";
                el.style.top = "".concat(y - rect.top, "px");
                el.style.left = "".concat(x - rect.left, "px");
                el.style.transform = "translate3d(".concat(r.left - x - m, "px, ").concat(r.top - y - m, "px, 0)");
                el.offsetTop;
                el.style.transform = "translate3d(0px, 0px, 0)";
                el.style.transition = "transform ".concat(t, "ms");
                setTimeout(function () {
                  el.style.transform = "";
                  el.style.transition = "";
                }, t);
              });
              setTimeout(function () {
                selectable.update();
              }, 2000);
            } };

            var select = {
              selectAll: selectable.selectAll.bind(selectable),
              clear: selectable.clear.bind(selectable),
              invert: selectable.invert.bind(selectable),
              getItems: function getItems() {
                console.log(selectable.getItems());
              },
              getNodes: function getNodes() {
                console.log(selectable.getNodes());
              },
              getSelectedItems: function getSelectedItems() {
                console.log(selectable.getSelectedItems());
              },
              getSelectedNodes: function getSelectedNodes() {
                console.log(selectable.getSelectedNodes());
              } };

              var autoScroll = {
                enabled: true };

                var arr = [];
                var a = gui.addFolder("Methods");
                var enable = a.add(selectable, "enable");
                var disable = a.add(selectable, "disable");
                enable.onChange(function () {
                  toggleView();
                });
                disable.onChange(function () {
                  toggleView();
                });
                toggleItem(enable, !selectable.enabled);
                arr.push(a.add(select, "selectAll"));
                arr.push(a.add(select, "invert"));
                arr.push(a.add(select, "clear"));
                arr.push(a.add(select, "getItems"));
                arr.push(a.add(select, "getNodes"));
                arr.push(a.add(select, "getSelectedItems"));
                arr.push(a.add(select, "getSelectedNodes"));
                a.open();
                var auto = gui.addFolder("Autoscroll");
                var autoSettings = selectable.config.autoScroll;
                var autoThreshold = auto.add(selectable.config.autoScroll, "threshold").name("threshold (px)").min(-50).step(1).max(50).onChange(function (val) {
                  selectable.config.autoScroll.threshold = val;
                  autoSettings.threshold = val;
                  setThreshold();
                });
                var autoToggle = auto.add(autoScroll, 'enabled').name("Enabled").onChange(function (bool) {
                  if (bool) {
                    selectable.config.autoScroll = autoSettings;
                  } else {
                    selectable.config.autoScroll = bool;
                  }

                  toggleItem(autoThreshold, bool);
                  selectable.disable();
                  setTimeout(function () {
                    setThreshold(!bool);
                    selectable.enable();
                  }, 30);
                });
                arr.push(autoToggle);
                arr.push(autoThreshold);

                autoToggle.__li.parentNode.appendChild(autoThreshold.__li);

                auto.open();
                var b = gui.addFolder("Tolerance");
                arr.push(b.add(tolerance, 'touch').listen().onChange(function () {
                  toggle(tolerance, "touch");
                }));
                arr.push(b.add(tolerance, 'fit').listen().onChange(function () {
                  toggle(tolerance, "fit");
                }));
                b.open();
                var b1 = gui.addFolder("lassoSelect");
                arr.push(b1.add(lassoSelect, 'normal').listen().onChange(function (bool) {
                  toggle(lassoSelect, "normal");
                }));
                arr.push(b1.add(lassoSelect, 'sequential').listen().onChange(function (bool) {
                  toggle(lassoSelect, "sequential");
                }));
                b1.open();
                var m = gui.addFolder("Toggle");
                arr.push(m.add(selectable.config, 'toggle').name("Enabled").onChange(function (bool) {
                  selectable.clear();
                  selectable.container.classList.toggle(selectable.config.classes.multiple, bool);
                }));

                function toggle(obj, prop) {
                  for (var param in obj) {
                    if (typeof obj[param] !== "string") obj[param] = false;
                  }

                  obj[prop] = true;
                  selectable.config[obj.name] = prop;
                  selectable.update();
                }

                var c = gui.addFolder("Non-selectable Items");
                arr.push(c.add(Filter, 'enabled').onChange(function (bool) {
                  toggleFilter(bool);
                }));
                var d = gui.addFolder("Item Positioning");
                arr.push(d.add(Misc, "random").onChange(toggleContainer));
                arr.push(d.add(Misc, "fixed").onChange(toggleContainer));
                arr.push(d.add(Misc, "transformed").onChange(toggleContainer));
                d.open();

                function toggleContainer(bool) {
                  var rand = this.property === "random" || this.property === "transformed";
                  container.classList.toggle("random", rand);
                  selectable.setContainer(rand ? document.body : container);
                  boxes.forEach(function (box) {
                    selectable.add(box);
                    box.style.opacity = 1;
                  });
                  selectable.lasso.style.borderColor = selectable.config.lasso.borderColor;
                  selectable.lasso.style.backgroundColor = selectable.config.lasso.backgroundColor;

                  if (rand) {
                    selectable.lasso.style.borderColor = "rgba(0,0,0,1)";
                    selectable.lasso.style.backgroundColor = "rgba(255,255,255,0.2)";
                    new Set([].slice.call({
                      length: boxes.length },
                      function () {
                        return Math.floor(Math.random() * boxes.length);
                      })).forEach(function (n) {
                      selectable.remove(boxes[n]);
                      boxes[n].style.opacity = 0;
                    });
                    }

                    setTimeout(function () {
                      selectable.update();
                    }, 500);
                  }

                  var colors = {
                    borderColor: selectable.config.lasso.borderColor.replace(/rgba\((.+)\)/, "$1").split(","),
                    backgroundColor: selectable.config.lasso.backgroundColor.replace(/rgba\((.+)\)/, "$1").split(",") };

                    var e = gui.addFolder("Lasso Styling");
                    e.addColor(colors, 'borderColor').onFinishChange(function (a) {
                      selectable.lasso.style.borderColor = "rgba(".concat(a.join(","), ")");
                    });
                    e.addColor(colors, 'backgroundColor').onFinishChange(function (a) {
                      selectable.lasso.style.backgroundColor = "rgba(".concat(a.join(","), ")");
                    });

                    function toggleView(bool) {
                      toggleItem(enable, selectable.enabled);
                      toggleItem(disable, !selectable.enabled);
                      arr.forEach(function (item) {
                        toggleItem(item, !selectable.enabled);
                      });
                    }

                    function toggleItem(item, bool) {
                      item.__li.style.pointerEvents = bool ? "" : "none";
                      item.__li.firstElementChild.style.opacity = bool ? 1 : .2;
                    }
                  }

                  function toggleFilter(bool) {
                    selectable.clear();

                    if (bool) {
    // Use Set to ensure unique indexes
    new Set([].slice.call({
      length: boxes.length },
      function () {
        return Math.floor(Math.random() * boxes.length);
      })).forEach(function (n) {
      return selectable.remove(boxes[n]);
    });
    } else {
      boxes.forEach(function (box) {
        return selectable.add(box);
      });
    }

    selectable.update();
  }

  function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min;
  }

  function setThreshold(bool) {
    var els = [].slice.call(document.getElementById("threshold").children);

    if (bool) {
      els[0].parentNode.style.display = "none";
    } else {
      els[0].parentNode.style.display = "block";
      els[0].style.top = "".concat(selectable.config.autoScroll.threshold, "px");
      els[1].style.bottom = "".concat(selectable.config.autoScroll.threshold, "px");
    }
  }