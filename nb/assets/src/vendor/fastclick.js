/*! Fastclick */
!(function () {
  "use strict";
  function s(i, t) {
    var e;
    if (
      ((t = t || {}),
      (this.trackingClick = !1),
      (this.trackingClickStart = 0),
      (this.targetElement = null),
      (this.touchStartX = 0),
      (this.touchStartY = 0),
      (this.lastTouchIdentifier = 0),
      (this.touchBoundary = t.touchBoundary || 10),
      (this.layer = i),
      (this.tapDelay = t.tapDelay || 200),
      (this.tapTimeout = t.tapTimeout || 700),
      !s.notNeeded(i))
    ) {
      for (
        var n = [
            "onMouse",
            "onClick",
            "onTouchStart",
            "onTouchMove",
            "onTouchEnd",
            "onTouchCancel",
          ],
          o = this,
          r = 0,
          a = n.length;
        r < a;
        r++
      )
        o[n[r]] = c(o[n[r]], o);
      u &&
        (i.addEventListener("mouseover", this.onMouse, !0),
        i.addEventListener("mousedown", this.onMouse, !0),
        i.addEventListener("mouseup", this.onMouse, !0)),
        i.addEventListener("click", this.onClick, !0),
        i.addEventListener("touchstart", this.onTouchStart, !1),
        i.addEventListener("touchmove", this.onTouchMove, !1),
        i.addEventListener("touchend", this.onTouchEnd, !1),
        i.addEventListener("touchcancel", this.onTouchCancel, !1),
        Event.prototype.stopImmediatePropagation ||
          ((i.removeEventListener = function (t, e, n) {
            var o = Node.prototype.removeEventListener;
            "click" === t
              ? o.call(i, t, e.hijacked || e, n)
              : o.call(i, t, e, n);
          }),
          (i.addEventListener = function (t, e, n) {
            var o = Node.prototype.addEventListener;
            "click" === t
              ? o.call(
                  i,
                  t,
                  e.hijacked ||
                    (e.hijacked = function (t) {
                      t.propagationStopped || e(t);
                    }),
                  n
                )
              : o.call(i, t, e, n);
          })),
        "function" == typeof i.onclick &&
          ((e = i.onclick),
          i.addEventListener(
            "click",
            function (t) {
              e(t);
            },
            !1
          ),
          (i.onclick = null));
    }
    function c(t, e) {
      return function () {
        return t.apply(e, arguments);
      };
    }
  }
  var t = 0 <= navigator.userAgent.indexOf("Windows Phone"),
    u = 0 < navigator.userAgent.indexOf("Android") && !t,
    c = /iP(ad|hone|od)/.test(navigator.userAgent) && !t,
    l = c && /OS 4_\d(_\d)?/.test(navigator.userAgent),
    h = c && /OS [6-7]_\d/.test(navigator.userAgent),
    i = 0 < navigator.userAgent.indexOf("BB10");
  (s.prototype.needsClick = function (t) {
    switch (t.nodeName.toLowerCase()) {
      case "button":
      case "select":
      case "textarea":
        if (t.disabled) return !0;
        break;
      case "input":
        if ((c && "file" === t.type) || t.disabled) return !0;
        break;
      case "label":
      case "iframe":
      case "video":
        return !0;
    }
    return /\bneedsclick\b/.test(t.className);
  }),
    (s.prototype.needsFocus = function (t) {
      switch (t.nodeName.toLowerCase()) {
        case "textarea":
          return !0;
        case "select":
          return !u;
        case "input":
          switch (t.type) {
            case "button":
            case "checkbox":
            case "file":
            case "image":
            case "radio":
            case "submit":
              return !1;
          }
          return !t.disabled && !t.readOnly;
        default:
          return /\bneedsfocus\b/.test(t.className);
      }
    }),
    (s.prototype.sendClick = function (t, e) {
      var n, o;
      document.activeElement &&
        document.activeElement !== t &&
        document.activeElement.blur(),
        (o = e.changedTouches[0]),
        (n = document.createEvent("MouseEvents")).initMouseEvent(
          this.determineEventType(t),
          !0,
          !0,
          window,
          1,
          o.screenX,
          o.screenY,
          o.clientX,
          o.clientY,
          !1,
          !1,
          !1,
          !1,
          0,
          null
        ),
        (n.forwardedTouchEvent = !0),
        t.dispatchEvent(n);
    }),
    (s.prototype.determineEventType = function (t) {
      return u && "select" === t.tagName.toLowerCase() ? "mousedown" : "click";
    }),
    (s.prototype.focus = function (t) {
      var e;
      c &&
      t.setSelectionRange &&
      0 !== t.type.indexOf("date") &&
      "time" !== t.type &&
      "month" !== t.type &&
      "email" !== t.type
        ? ((e = t.value.length), t.setSelectionRange(e, e))
        : t.focus();
    }),
    (s.prototype.updateScrollParent = function (t) {
      var e, n;
      if (!(e = t.fastClickScrollParent) || !e.contains(t)) {
        n = t;
        do {
          if (n.scrollHeight > n.offsetHeight) {
            (e = n), (t.fastClickScrollParent = n);
            break;
          }
          n = n.parentElement;
        } while (n);
      }
      e && (e.fastClickLastScrollTop = e.scrollTop);
    }),
    (s.prototype.getTargetElementFromEventTarget = function (t) {
      return t.nodeType === Node.TEXT_NODE ? t.parentNode : t;
    }),
    (s.prototype.onTouchStart = function (t) {
      var e, n, o;
      if (1 < t.targetTouches.length) return !0;
      if (
        ((e = this.getTargetElementFromEventTarget(t.target)),
        (n = t.targetTouches[0]),
        c)
      ) {
        if ((o = window.getSelection()).rangeCount && !o.isCollapsed) return !0;
        if (!l) {
          if (n.identifier && n.identifier === this.lastTouchIdentifier)
            return t.preventDefault(), !1;
          (this.lastTouchIdentifier = n.identifier), this.updateScrollParent(e);
        }
      }
      return (
        (this.trackingClick = !0),
        (this.trackingClickStart = t.timeStamp),
        (this.targetElement = e),
        (this.touchStartX = n.pageX),
        (this.touchStartY = n.pageY),
        t.timeStamp - this.lastClickTime < this.tapDelay && t.preventDefault(),
        !0
      );
    }),
    (s.prototype.touchHasMoved = function (t) {
      var e = t.changedTouches[0],
        n = this.touchBoundary;
      return (
        Math.abs(e.pageX - this.touchStartX) > n ||
        Math.abs(e.pageY - this.touchStartY) > n
      );
    }),
    (s.prototype.onTouchMove = function (t) {
      return (
        this.trackingClick &&
          ((this.targetElement ===
            this.getTargetElementFromEventTarget(t.target) &&
            !this.touchHasMoved(t)) ||
            ((this.trackingClick = !1), (this.targetElement = null))),
        !0
      );
    }),
    (s.prototype.findControl = function (t) {
      return void 0 !== t.control
        ? t.control
        : t.htmlFor
        ? document.getElementById(t.htmlFor)
        : t.querySelector(
            "button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea"
          );
    }),
    (s.prototype.onTouchEnd = function (t) {
      var e,
        n,
        o,
        i,
        r,
        a = this.targetElement;
      if (!this.trackingClick) return !0;
      if (t.timeStamp - this.lastClickTime < this.tapDelay)
        return (this.cancelNextClick = !0);
      if (t.timeStamp - this.trackingClickStart > this.tapTimeout) return !0;
      if (
        ((this.cancelNextClick = !1),
        (this.lastClickTime = t.timeStamp),
        (n = this.trackingClickStart),
        (this.trackingClick = !1),
        (this.trackingClickStart = 0),
        h &&
          ((r = t.changedTouches[0]),
          ((a =
            document.elementFromPoint(
              r.pageX - window.pageXOffset,
              r.pageY - window.pageYOffset
            ) || a).fastClickScrollParent =
            this.targetElement.fastClickScrollParent)),
        "label" === (o = a.tagName.toLowerCase()))
      ) {
        if ((e = this.findControl(a))) {
          if ((this.focus(a), u)) return !1;
          a = e;
        }
      } else if (this.needsFocus(a))
        return (
          100 < t.timeStamp - n || (c && window.top !== window && "input" === o)
            ? (this.targetElement = null)
            : (this.focus(a),
              this.sendClick(a, t),
              (c && "select" === o) ||
                ((this.targetElement = null), t.preventDefault())),
          !1
        );
      return (
        !(
          !c ||
          l ||
          !(i = a.fastClickScrollParent) ||
          i.fastClickLastScrollTop === i.scrollTop
        ) ||
        (this.needsClick(a) || (t.preventDefault(), this.sendClick(a, t)), !1)
      );
    }),
    (s.prototype.onTouchCancel = function () {
      (this.trackingClick = !1), (this.targetElement = null);
    }),
    (s.prototype.onMouse = function (t) {
      return (
        !this.targetElement ||
        !!t.forwardedTouchEvent ||
        !t.cancelable ||
        !(!this.needsClick(this.targetElement) || this.cancelNextClick) ||
        (t.stopImmediatePropagation
          ? t.stopImmediatePropagation()
          : (t.propagationStopped = !0),
        t.stopPropagation(),
        t.preventDefault(),
        !1)
      );
    }),
    (s.prototype.onClick = function (t) {
      var e;
      return this.trackingClick
        ? ((this.targetElement = null), !(this.trackingClick = !1))
        : ("submit" === t.target.type && 0 === t.detail) ||
            ((e = this.onMouse(t)) || (this.targetElement = null), e);
    }),
    (s.prototype.destroy = function () {
      var t = this.layer;
      u &&
        (t.removeEventListener("mouseover", this.onMouse, !0),
        t.removeEventListener("mousedown", this.onMouse, !0),
        t.removeEventListener("mouseup", this.onMouse, !0)),
        t.removeEventListener("click", this.onClick, !0),
        t.removeEventListener("touchstart", this.onTouchStart, !1),
        t.removeEventListener("touchmove", this.onTouchMove, !1),
        t.removeEventListener("touchend", this.onTouchEnd, !1),
        t.removeEventListener("touchcancel", this.onTouchCancel, !1);
    }),
    (s.notNeeded = function (t) {
      var e, n, o;
      if (void 0 === window.ontouchstart) return !0;
      if ((n = +(/Chrome\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1])) {
        if (!u) return !0;
        if ((e = document.querySelector("meta[name=viewport]"))) {
          if (-1 !== e.content.indexOf("user-scalable=no")) return !0;
          if (
            31 < n &&
            document.documentElement.scrollWidth <= window.outerWidth
          )
            return !0;
        }
      }
      if (
        i &&
        10 <=
          (o = navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/))[1] &&
        3 <= o[2] &&
        (e = document.querySelector("meta[name=viewport]"))
      ) {
        if (-1 !== e.content.indexOf("user-scalable=no")) return !0;
        if (document.documentElement.scrollWidth <= window.outerWidth)
          return !0;
      }
      return (
        "none" === t.style.msTouchAction ||
        "manipulation" === t.style.touchAction ||
        !!(
          27 <= +(/Firefox\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1] &&
          (e = document.querySelector("meta[name=viewport]")) &&
          (-1 !== e.content.indexOf("user-scalable=no") ||
            document.documentElement.scrollWidth <= window.outerWidth)
        ) ||
        "none" === t.style.touchAction ||
        "manipulation" === t.style.touchAction
      );
    }),
    (s.attach = function (t, e) {
      return new s(t, e);
    }),
    "function" == typeof define && "object" == typeof define.amd && define.amd
      ? define(function () {
          return s;
        })
      : "undefined" != typeof module && module.exports
      ? ((module.exports = s.attach), (module.exports.FastClick = s))
      : (window.FastClick = s);
})();
