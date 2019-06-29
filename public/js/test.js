/*! jQuery v1.9.1 | (c) 2005, 2012 jQuery Foundation, Inc. | jquery.org/license
//@ sourceMappingURL=jquery.min.map
*/
(function (e, t) {
    var n, r, i = typeof t, o = e.document, a = e.location, s = e.jQuery, u = e.$, l = {}, c = [], p = "1.9.1",
        f = c.concat, d = c.push, h = c.slice, g = c.indexOf, m = l.toString, y = l.hasOwnProperty, v = p.trim,
        b = function (e, t) {
            return new b.fn.init(e, t, r)
        }, x = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, w = /\S+/g, T = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        N = /^(?:(<[\w\W]+>)[^>]*|#([\w-]*))$/, C = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, k = /^[\],:{}\s]*$/,
        E = /(?:^|:|,)(?:\s*\[)+/g, S = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
        A = /"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g, j = /^-ms-/, D = /-([\da-z])/gi,
        L = function (e, t) {
            return t.toUpperCase()
        }, H = function (e) {
            (o.addEventListener || "load" === e.type || "complete" === o.readyState) && (q(), b.ready())
        }, q = function () {
            o.addEventListener ? (o.removeEventListener("DOMContentLoaded", H, !1), e.removeEventListener("load", H, !1)) : (o.detachEvent("onreadystatechange", H), e.detachEvent("onload", H))
        };
    b.fn = b.prototype = {
        jquery: p, constructor: b, init: function (e, n, r) {
            var i, a;
            if (!e) return this;
            if ("string" == typeof e) {
                if (i = "<" === e.charAt(0) && ">" === e.charAt(e.length - 1) && e.length >= 3 ? [null, e, null] : N.exec(e), !i || !i[1] && n) return !n || n.jquery ? (n || r).find(e) : this.constructor(n).find(e);
                if (i[1]) {
                    if (n = n instanceof b ? n[0] : n, b.merge(this, b.parseHTML(i[1], n && n.nodeType ? n.ownerDocument || n : o, !0)), C.test(i[1]) && b.isPlainObject(n)) for (i in n) b.isFunction(this[i]) ? this[i](n[i]) : this.attr(i, n[i]);
                    return this
                }
                if (a = o.getElementById(i[2]), a && a.parentNode) {
                    if (a.id !== i[2]) return r.find(e);
                    this.length = 1, this[0] = a
                }
                return this.context = o, this.selector = e, this
            }
            return e.nodeType ? (this.context = this[0] = e, this.length = 1, this) : b.isFunction(e) ? r.ready(e) : (e.selector !== t && (this.selector = e.selector, this.context = e.context), b.makeArray(e, this))
        }, selector: "", length: 0, size: function () {
            return this.length
        }, toArray: function () {
            return h.call(this)
        }, get: function (e) {
            return null == e ? this.toArray() : 0 > e ? this[this.length + e] : this[e]
        }, pushStack: function (e) {
            var t = b.merge(this.constructor(), e);
            return t.prevObject = this, t.context = this.context, t
        }, each: function (e, t) {
            return b.each(this, e, t)
        }, ready: function (e) {
            return b.ready.promise().done(e), this
        }, slice: function () {
            return this.pushStack(h.apply(this, arguments))
        }, first: function () {
            return this.eq(0)
        }, last: function () {
            return this.eq(-1)
        }, eq: function (e) {
            var t = this.length, n = +e + (0 > e ? t : 0);
            return this.pushStack(n >= 0 && t > n ? [this[n]] : [])
        }, map: function (e) {
            return this.pushStack(b.map(this, function (t, n) {
                return e.call(t, n, t)
            }))
        }, end: function () {
            return this.prevObject || this.constructor(null)
        }, push: d, sort: [].sort, splice: [].splice
    }, b.fn.init.prototype = b.fn, b.extend = b.fn.extend = function () {
        var e, n, r, i, o, a, s = arguments[0] || {}, u = 1, l = arguments.length, c = !1;
        for ("boolean" == typeof s && (c = s, s = arguments[1] || {}, u = 2), "object" == typeof s || b.isFunction(s) || (s = {}), l === u && (s = this, --u); l > u; u++) if (null != (o = arguments[u])) for (i in o) e = s[i], r = o[i], s !== r && (c && r && (b.isPlainObject(r) || (n = b.isArray(r))) ? (n ? (n = !1, a = e && b.isArray(e) ? e : []) : a = e && b.isPlainObject(e) ? e : {}, s[i] = b.extend(c, a, r)) : r !== t && (s[i] = r));
        return s
    }, b.extend({
        noConflict: function (t) {
            return e.$ === b && (e.$ = u), t && e.jQuery === b && (e.jQuery = s), b
        }, isReady: !1, readyWait: 1, holdReady: function (e) {
            e ? b.readyWait++ : b.ready(!0)
        }, ready: function (e) {
            if (e === !0 ? !--b.readyWait : !b.isReady) {
                if (!o.body) return setTimeout(b.ready);
                b.isReady = !0, e !== !0 && --b.readyWait > 0 || (n.resolveWith(o, [b]), b.fn.trigger && b(o).trigger("ready").off("ready"))
            }
        }, isFunction: function (e) {
            return "function" === b.type(e)
        }, isArray: Array.isArray || function (e) {
            return "array" === b.type(e)
        }, isWindow: function (e) {
            return null != e && e == e.window
        }, isNumeric: function (e) {
            return !isNaN(parseFloat(e)) && isFinite(e)
        }, type: function (e) {
            return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? l[m.call(e)] || "object" : typeof e
        }, isPlainObject: function (e) {
            if (!e || "object" !== b.type(e) || e.nodeType || b.isWindow(e)) return !1;
            try {
                if (e.constructor && !y.call(e, "constructor") && !y.call(e.constructor.prototype, "isPrototypeOf")) return !1
            } catch (n) {
                return !1
            }
            var r;
            for (r in e) ;
            return r === t || y.call(e, r)
        }, isEmptyObject: function (e) {
            var t;
            for (t in e) return !1;
            return !0
        }, error: function (e) {
            throw Error(e)
        }, parseHTML: function (e, t, n) {
            if (!e || "string" != typeof e) return null;
            "boolean" == typeof t && (n = t, t = !1), t = t || o;
            var r = C.exec(e), i = !n && [];
            return r ? [t.createElement(r[1])] : (r = b.buildFragment([e], t, i), i && b(i).remove(), b.merge([], r.childNodes))
        }, parseJSON: function (n) {
            return e.JSON && e.JSON.parse ? e.JSON.parse(n) : null === n ? n : "string" == typeof n && (n = b.trim(n), n && k.test(n.replace(S, "@").replace(A, "]").replace(E, ""))) ? Function("return " + n)() : (b.error("Invalid JSON: " + n), t)
        }, parseXML: function (n) {
            var r, i;
            if (!n || "string" != typeof n) return null;
            try {
                e.DOMParser ? (i = new DOMParser, r = i.parseFromString(n, "text/xml")) : (r = new ActiveXObject("Microsoft.XMLDOM"), r.async = "false", r.loadXML(n))
            } catch (o) {
                r = t
            }
            return r && r.documentElement && !r.getElementsByTagName("parsererror").length || b.error("Invalid XML: " + n), r
        }, noop: function () {
        }, globalEval: function (t) {
            t && b.trim(t) && (e.execScript || function (t) {
                e.eval.call(e, t)
            })(t)
        }, camelCase: function (e) {
            return e.replace(j, "ms-").replace(D, L)
        }, nodeName: function (e, t) {
            return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
        }, each: function (e, t, n) {
            var r, i = 0, o = e.length, a = M(e);
            if (n) {
                if (a) {
                    for (; o > i; i++) if (r = t.apply(e[i], n), r === !1) break
                } else for (i in e) if (r = t.apply(e[i], n), r === !1) break
            } else if (a) {
                for (; o > i; i++) if (r = t.call(e[i], i, e[i]), r === !1) break
            } else for (i in e) if (r = t.call(e[i], i, e[i]), r === !1) break;
            return e
        }, trim: v && !v.call("\ufeff\u00a0") ? function (e) {
            return null == e ? "" : v.call(e)
        } : function (e) {
            return null == e ? "" : (e + "").replace(T, "")
        }, makeArray: function (e, t) {
            var n = t || [];
            return null != e && (M(Object(e)) ? b.merge(n, "string" == typeof e ? [e] : e) : d.call(n, e)), n
        }, inArray: function (e, t, n) {
            var r;
            if (t) {
                if (g) return g.call(t, e, n);
                for (r = t.length, n = n ? 0 > n ? Math.max(0, r + n) : n : 0; r > n; n++) if (n in t && t[n] === e) return n
            }
            return -1
        }, merge: function (e, n) {
            var r = n.length, i = e.length, o = 0;
            if ("number" == typeof r) for (; r > o; o++) e[i++] = n[o]; else while (n[o] !== t) e[i++] = n[o++];
            return e.length = i, e
        }, grep: function (e, t, n) {
            var r, i = [], o = 0, a = e.length;
            for (n = !!n; a > o; o++) r = !!t(e[o], o), n !== r && i.push(e[o]);
            return i
        }, map: function (e, t, n) {
            var r, i = 0, o = e.length, a = M(e), s = [];
            if (a) for (; o > i; i++) r = t(e[i], i, n), null != r && (s[s.length] = r); else for (i in e) r = t(e[i], i, n), null != r && (s[s.length] = r);
            return f.apply([], s)
        }, guid: 1, proxy: function (e, n) {
            var r, i, o;
            return "string" == typeof n && (o = e[n], n = e, e = o), b.isFunction(e) ? (r = h.call(arguments, 2), i = function () {
                return e.apply(n || this, r.concat(h.call(arguments)))
            }, i.guid = e.guid = e.guid || b.guid++, i) : t
        }, access: function (e, n, r, i, o, a, s) {
            var u = 0, l = e.length, c = null == r;
            if ("object" === b.type(r)) {
                o = !0;
                for (u in r) b.access(e, n, u, r[u], !0, a, s)
            } else if (i !== t && (o = !0, b.isFunction(i) || (s = !0), c && (s ? (n.call(e, i), n = null) : (c = n, n = function (e, t, n) {
                return c.call(b(e), n)
            })), n)) for (; l > u; u++) n(e[u], r, s ? i : i.call(e[u], u, n(e[u], r)));
            return o ? e : c ? n.call(e) : l ? n(e[0], r) : a
        }, now: function () {
            return (new Date).getTime()
        }
    }), b.ready.promise = function (t) {
        if (!n) if (n = b.Deferred(), "complete" === o.readyState) setTimeout(b.ready); else if (o.addEventListener) o.addEventListener("DOMContentLoaded", H, !1), e.addEventListener("load", H, !1); else {
            o.attachEvent("onreadystatechange", H), e.attachEvent("onload", H);
            var r = !1;
            try {
                r = null == e.frameElement && o.documentElement
            } catch (i) {
            }
            r && r.doScroll && function a() {
                if (!b.isReady) {
                    try {
                        r.doScroll("left")
                    } catch (e) {
                        return setTimeout(a, 50)
                    }
                    q(), b.ready()
                }
            }()
        }
        return n.promise(t)
    }, b.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (e, t) {
        l["[object " + t + "]"] = t.toLowerCase()
    });

    function M(e) {
        var t = e.length, n = b.type(e);
        return b.isWindow(e) ? !1 : 1 === e.nodeType && t ? !0 : "array" === n || "function" !== n && (0 === t || "number" == typeof t && t > 0 && t - 1 in e)
    }

    r = b(o);
    var _ = {};

    function F(e) {
        var t = _[e] = {};
        return b.each(e.match(w) || [], function (e, n) {
            t[n] = !0
        }), t
    }

    b.Callbacks = function (e) {
        e = "string" == typeof e ? _[e] || F(e) : b.extend({}, e);
        var n, r, i, o, a, s, u = [], l = !e.once && [], c = function (t) {
            for (r = e.memory && t, i = !0, a = s || 0, s = 0, o = u.length, n = !0; u && o > a; a++) if (u[a].apply(t[0], t[1]) === !1 && e.stopOnFalse) {
                r = !1;
                break
            }
            n = !1, u && (l ? l.length && c(l.shift()) : r ? u = [] : p.disable())
        }, p = {
            add: function () {
                if (u) {
                    var t = u.length;
                    (function i(t) {
                        b.each(t, function (t, n) {
                            var r = b.type(n);
                            "function" === r ? e.unique && p.has(n) || u.push(n) : n && n.length && "string" !== r && i(n)
                        })
                    })(arguments), n ? o = u.length : r && (s = t, c(r))
                }
                return this
            }, remove: function () {
                return u && b.each(arguments, function (e, t) {
                    var r;
                    while ((r = b.inArray(t, u, r)) > -1) u.splice(r, 1), n && (o >= r && o--, a >= r && a--)
                }), this
            }, has: function (e) {
                return e ? b.inArray(e, u) > -1 : !(!u || !u.length)
            }, empty: function () {
                return u = [], this
            }, disable: function () {
                return u = l = r = t, this
            }, disabled: function () {
                return !u
            }, lock: function () {
                return l = t, r || p.disable(), this
            }, locked: function () {
                return !l
            }, fireWith: function (e, t) {
                return t = t || [], t = [e, t.slice ? t.slice() : t], !u || i && !l || (n ? l.push(t) : c(t)), this
            }, fire: function () {
                return p.fireWith(this, arguments), this
            }, fired: function () {
                return !!i
            }
        };
        return p
    }, b.extend({
        Deferred: function (e) {
            var t = [["resolve", "done", b.Callbacks("once memory"), "resolved"], ["reject", "fail", b.Callbacks("once memory"), "rejected"], ["notify", "progress", b.Callbacks("memory")]],
                n = "pending", r = {
                    state: function () {
                        return n
                    }, always: function () {
                        return i.done(arguments).fail(arguments), this
                    }, then: function () {
                        var e = arguments;
                        return b.Deferred(function (n) {
                            b.each(t, function (t, o) {
                                var a = o[0], s = b.isFunction(e[t]) && e[t];
                                i[o[1]](function () {
                                    var e = s && s.apply(this, arguments);
                                    e && b.isFunction(e.promise) ? e.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[a + "With"](this === r ? n.promise() : this, s ? [e] : arguments)
                                })
                            }), e = null
                        }).promise()
                    }, promise: function (e) {
                        return null != e ? b.extend(e, r) : r
                    }
                }, i = {};
            return r.pipe = r.then, b.each(t, function (e, o) {
                var a = o[2], s = o[3];
                r[o[1]] = a.add, s && a.add(function () {
                    n = s
                }, t[1 ^ e][2].disable, t[2][2].lock), i[o[0]] = function () {
                    return i[o[0] + "With"](this === i ? r : this, arguments), this
                }, i[o[0] + "With"] = a.fireWith
            }), r.promise(i), e && e.call(i, i), i
        }, when: function (e) {
            var t = 0, n = h.call(arguments), r = n.length, i = 1 !== r || e && b.isFunction(e.promise) ? r : 0,
                o = 1 === i ? e : b.Deferred(), a = function (e, t, n) {
                    return function (r) {
                        t[e] = this, n[e] = arguments.length > 1 ? h.call(arguments) : r, n === s ? o.notifyWith(t, n) : --i || o.resolveWith(t, n)
                    }
                }, s, u, l;
            if (r > 1) for (s = Array(r), u = Array(r), l = Array(r); r > t; t++) n[t] && b.isFunction(n[t].promise) ? n[t].promise().done(a(t, l, n)).fail(o.reject).progress(a(t, u, s)) : --i;
            return i || o.resolveWith(l, n), o.promise()
        }
    }), b.support = function () {
        var t, n, r, a, s, u, l, c, p, f, d = o.createElement("div");
        if (d.setAttribute("className", "t"), d.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", n = d.getElementsByTagName("*"), r = d.getElementsByTagName("a")[0], !n || !r || !n.length) return {};
        s = o.createElement("select"), l = s.appendChild(o.createElement("option")), a = d.getElementsByTagName("input")[0], r.style.cssText = "top:1px;float:left;opacity:.5", t = {
            getSetAttribute: "t" !== d.className,
            leadingWhitespace: 3 === d.firstChild.nodeType,
            tbody: !d.getElementsByTagName("tbody").length,
            htmlSerialize: !!d.getElementsByTagName("link").length,
            style: /top/.test(r.getAttribute("style")),
            hrefNormalized: "/a" === r.getAttribute("href"),
            opacity: /^0.5/.test(r.style.opacity),
            cssFloat: !!r.style.cssFloat,
            checkOn: !!a.value,
            optSelected: l.selected,
            enctype: !!o.createElement("form").enctype,
            html5Clone: "<:nav></:nav>" !== o.createElement("nav").cloneNode(!0).outerHTML,
            boxModel: "CSS1Compat" === o.compatMode,
            deleteExpando: !0,
            noCloneEvent: !0,
            inlineBlockNeedsLayout: !1,
            shrinkWrapBlocks: !1,
            reliableMarginRight: !0,
            boxSizingReliable: !0,
            pixelPosition: !1
        }, a.checked = !0, t.noCloneChecked = a.cloneNode(!0).checked, s.disabled = !0, t.optDisabled = !l.disabled;
        try {
            delete d.test
        } catch (h) {
            t.deleteExpando = !1
        }
        a = o.createElement("input"), a.setAttribute("value", ""), t.input = "" === a.getAttribute("value"), a.value = "t", a.setAttribute("type", "radio"), t.radioValue = "t" === a.value, a.setAttribute("checked", "t"), a.setAttribute("name", "t"), u = o.createDocumentFragment(), u.appendChild(a), t.appendChecked = a.checked, t.checkClone = u.cloneNode(!0).cloneNode(!0).lastChild.checked, d.attachEvent && (d.attachEvent("onclick", function () {
            t.noCloneEvent = !1
        }), d.cloneNode(!0).click());
        for (f in{
            submit: !0,
            change: !0,
            focusin: !0
        }) d.setAttribute(c = "on" + f, "t"), t[f + "Bubbles"] = c in e || d.attributes[c].expando === !1;
        return d.style.backgroundClip = "content-box", d.cloneNode(!0).style.backgroundClip = "", t.clearCloneStyle = "content-box" === d.style.backgroundClip, b(function () {
            var n, r, a,
                s = "padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;",
                u = o.getElementsByTagName("body")[0];
            u && (n = o.createElement("div"), n.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", u.appendChild(n).appendChild(d), d.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", a = d.getElementsByTagName("td"), a[0].style.cssText = "padding:0;margin:0;border:0;display:none", p = 0 === a[0].offsetHeight, a[0].style.display = "", a[1].style.display = "none", t.reliableHiddenOffsets = p && 0 === a[0].offsetHeight, d.innerHTML = "", d.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", t.boxSizing = 4 === d.offsetWidth, t.doesNotIncludeMarginInBodyOffset = 1 !== u.offsetTop, e.getComputedStyle && (t.pixelPosition = "1%" !== (e.getComputedStyle(d, null) || {}).top, t.boxSizingReliable = "4px" === (e.getComputedStyle(d, null) || {width: "4px"}).width, r = d.appendChild(o.createElement("div")), r.style.cssText = d.style.cssText = s, r.style.marginRight = r.style.width = "0", d.style.width = "1px", t.reliableMarginRight = !parseFloat((e.getComputedStyle(r, null) || {}).marginRight)), typeof d.style.zoom !== i && (d.innerHTML = "", d.style.cssText = s + "width:1px;padding:1px;display:inline;zoom:1", t.inlineBlockNeedsLayout = 3 === d.offsetWidth, d.style.display = "block", d.innerHTML = "<div></div>", d.firstChild.style.width = "5px", t.shrinkWrapBlocks = 3 !== d.offsetWidth, t.inlineBlockNeedsLayout && (u.style.zoom = 1)), u.removeChild(n), n = d = a = r = null)
        }), n = s = u = l = r = a = null, t
    }();
    var O = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/, B = /([A-Z])/g;

    function P(e, n, r, i) {
        if (b.acceptData(e)) {
            var o, a, s = b.expando, u = "string" == typeof n, l = e.nodeType, p = l ? b.cache : e,
                f = l ? e[s] : e[s] && s;
            if (f && p[f] && (i || p[f].data) || !u || r !== t) return f || (l ? e[s] = f = c.pop() || b.guid++ : f = s), p[f] || (p[f] = {}, l || (p[f].toJSON = b.noop)), ("object" == typeof n || "function" == typeof n) && (i ? p[f] = b.extend(p[f], n) : p[f].data = b.extend(p[f].data, n)), o = p[f], i || (o.data || (o.data = {}), o = o.data), r !== t && (o[b.camelCase(n)] = r), u ? (a = o[n], null == a && (a = o[b.camelCase(n)])) : a = o, a
        }
    }

    function R(e, t, n) {
        if (b.acceptData(e)) {
            var r, i, o, a = e.nodeType, s = a ? b.cache : e, u = a ? e[b.expando] : b.expando;
            if (s[u]) {
                if (t && (o = n ? s[u] : s[u].data)) {
                    b.isArray(t) ? t = t.concat(b.map(t, b.camelCase)) : t in o ? t = [t] : (t = b.camelCase(t), t = t in o ? [t] : t.split(" "));
                    for (r = 0, i = t.length; i > r; r++) delete o[t[r]];
                    if (!(n ? $ : b.isEmptyObject)(o)) return
                }
                (n || (delete s[u].data, $(s[u]))) && (a ? b.cleanData([e], !0) : b.support.deleteExpando || s != s.window ? delete s[u] : s[u] = null)
            }
        }
    }

    b.extend({
        cache: {},
        expando: "jQuery" + (p + Math.random()).replace(/\D/g, ""),
        noData: {embed: !0, object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000", applet: !0},
        hasData: function (e) {
            return e = e.nodeType ? b.cache[e[b.expando]] : e[b.expando], !!e && !$(e)
        },
        data: function (e, t, n) {
            return P(e, t, n)
        },
        removeData: function (e, t) {
            return R(e, t)
        },
        _data: function (e, t, n) {
            return P(e, t, n, !0)
        },
        _removeData: function (e, t) {
            return R(e, t, !0)
        },
        acceptData: function (e) {
            if (e.nodeType && 1 !== e.nodeType && 9 !== e.nodeType) return !1;
            var t = e.nodeName && b.noData[e.nodeName.toLowerCase()];
            return !t || t !== !0 && e.getAttribute("classid") === t
        }
    }), b.fn.extend({
        data: function (e, n) {
            var r, i, o = this[0], a = 0, s = null;
            if (e === t) {
                if (this.length && (s = b.data(o), 1 === o.nodeType && !b._data(o, "parsedAttrs"))) {
                    for (r = o.attributes; r.length > a; a++) i = r[a].name, i.indexOf("data-") || (i = b.camelCase(i.slice(5)), W(o, i, s[i]));
                    b._data(o, "parsedAttrs", !0)
                }
                return s
            }
            return "object" == typeof e ? this.each(function () {
                b.data(this, e)
            }) : b.access(this, function (n) {
                return n === t ? o ? W(o, e, b.data(o, e)) : null : (this.each(function () {
                    b.data(this, e, n)
                }), t)
            }, null, n, arguments.length > 1, null, !0)
        }, removeData: function (e) {
            return this.each(function () {
                b.removeData(this, e)
            })
        }
    });

    function W(e, n, r) {
        if (r === t && 1 === e.nodeType) {
            var i = "data-" + n.replace(B, "-$1").toLowerCase();
            if (r = e.getAttribute(i), "string" == typeof r) {
                try {
                    r = "true" === r ? !0 : "false" === r ? !1 : "null" === r ? null : +r + "" === r ? +r : O.test(r) ? b.parseJSON(r) : r
                } catch (o) {
                }
                b.data(e, n, r)
            } else r = t
        }
        return r
    }

    function $(e) {
        var t;
        for (t in e) if (("data" !== t || !b.isEmptyObject(e[t])) && "toJSON" !== t) return !1;
        return !0
    }

    b.extend({
        queue: function (e, n, r) {
            var i;
            return e ? (n = (n || "fx") + "queue", i = b._data(e, n), r && (!i || b.isArray(r) ? i = b._data(e, n, b.makeArray(r)) : i.push(r)), i || []) : t
        }, dequeue: function (e, t) {
            t = t || "fx";
            var n = b.queue(e, t), r = n.length, i = n.shift(), o = b._queueHooks(e, t), a = function () {
                b.dequeue(e, t)
            };
            "inprogress" === i && (i = n.shift(), r--), o.cur = i, i && ("fx" === t && n.unshift("inprogress"), delete o.stop, i.call(e, a, o)), !r && o && o.empty.fire()
        }, _queueHooks: function (e, t) {
            var n = t + "queueHooks";
            return b._data(e, n) || b._data(e, n, {
                empty: b.Callbacks("once memory").add(function () {
                    b._removeData(e, t + "queue"), b._removeData(e, n)
                })
            })
        }
    }), b.fn.extend({
        queue: function (e, n) {
            var r = 2;
            return "string" != typeof e && (n = e, e = "fx", r--), r > arguments.length ? b.queue(this[0], e) : n === t ? this : this.each(function () {
                var t = b.queue(this, e, n);
                b._queueHooks(this, e), "fx" === e && "inprogress" !== t[0] && b.dequeue(this, e)
            })
        }, dequeue: function (e) {
            return this.each(function () {
                b.dequeue(this, e)
            })
        }, delay: function (e, t) {
            return e = b.fx ? b.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function (t, n) {
                var r = setTimeout(t, e);
                n.stop = function () {
                    clearTimeout(r)
                }
            })
        }, clearQueue: function (e) {
            return this.queue(e || "fx", [])
        }, promise: function (e, n) {
            var r, i = 1, o = b.Deferred(), a = this, s = this.length, u = function () {
                --i || o.resolveWith(a, [a])
            };
            "string" != typeof e && (n = e, e = t), e = e || "fx";
            while (s--) r = b._data(a[s], e + "queueHooks"), r && r.empty && (i++, r.empty.add(u));
            return u(), o.promise(n)
        }
    });
    var I, z, X = /[\t\r\n]/g, U = /\r/g, V = /^(?:input|select|textarea|button|object)$/i, Y = /^(?:a|area)$/i,
        J = /^(?:checked|selected|autofocus|autoplay|async|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped)$/i,
        G = /^(?:checked|selected)$/i, Q = b.support.getSetAttribute, K = b.support.input;
    b.fn.extend({
        attr: function (e, t) {
            return b.access(this, b.attr, e, t, arguments.length > 1)
        }, removeAttr: function (e) {
            return this.each(function () {
                b.removeAttr(this, e)
            })
        }, prop: function (e, t) {
            return b.access(this, b.prop, e, t, arguments.length > 1)
        }, removeProp: function (e) {
            return e = b.propFix[e] || e, this.each(function () {
                try {
                    this[e] = t, delete this[e]
                } catch (n) {
                }
            })
        }, addClass: function (e) {
            var t, n, r, i, o, a = 0, s = this.length, u = "string" == typeof e && e;
            if (b.isFunction(e)) return this.each(function (t) {
                b(this).addClass(e.call(this, t, this.className))
            });
            if (u) for (t = (e || "").match(w) || []; s > a; a++) if (n = this[a], r = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(X, " ") : " ")) {
                o = 0;
                while (i = t[o++]) 0 > r.indexOf(" " + i + " ") && (r += i + " ");
                n.className = b.trim(r)
            }
            return this
        }, removeClass: function (e) {
            var t, n, r, i, o, a = 0, s = this.length, u = 0 === arguments.length || "string" == typeof e && e;
            if (b.isFunction(e)) return this.each(function (t) {
                b(this).removeClass(e.call(this, t, this.className))
            });
            if (u) for (t = (e || "").match(w) || []; s > a; a++) if (n = this[a], r = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(X, " ") : "")) {
                o = 0;
                while (i = t[o++]) while (r.indexOf(" " + i + " ") >= 0) r = r.replace(" " + i + " ", " ");
                n.className = e ? b.trim(r) : ""
            }
            return this
        }, toggleClass: function (e, t) {
            var n = typeof e, r = "boolean" == typeof t;
            return b.isFunction(e) ? this.each(function (n) {
                b(this).toggleClass(e.call(this, n, this.className, t), t)
            }) : this.each(function () {
                if ("string" === n) {
                    var o, a = 0, s = b(this), u = t, l = e.match(w) || [];
                    while (o = l[a++]) u = r ? u : !s.hasClass(o), s[u ? "addClass" : "removeClass"](o)
                } else (n === i || "boolean" === n) && (this.className && b._data(this, "__className__", this.className), this.className = this.className || e === !1 ? "" : b._data(this, "__className__") || "")
            })
        }, hasClass: function (e) {
            var t = " " + e + " ", n = 0, r = this.length;
            for (; r > n; n++) if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(X, " ").indexOf(t) >= 0) return !0;
            return !1
        }, val: function (e) {
            var n, r, i, o = this[0];
            {
                if (arguments.length) return i = b.isFunction(e), this.each(function (n) {
                    var o, a = b(this);
                    1 === this.nodeType && (o = i ? e.call(this, n, a.val()) : e, null == o ? o = "" : "number" == typeof o ? o += "" : b.isArray(o) && (o = b.map(o, function (e) {
                        return null == e ? "" : e + ""
                    })), r = b.valHooks[this.type] || b.valHooks[this.nodeName.toLowerCase()], r && "set" in r && r.set(this, o, "value") !== t || (this.value = o))
                });
                if (o) return r = b.valHooks[o.type] || b.valHooks[o.nodeName.toLowerCase()], r && "get" in r && (n = r.get(o, "value")) !== t ? n : (n = o.value, "string" == typeof n ? n.replace(U, "") : null == n ? "" : n)
            }
        }
    }), b.extend({
        valHooks: {
            option: {
                get: function (e) {
                    var t = e.attributes.value;
                    return !t || t.specified ? e.value : e.text
                }
            }, select: {
                get: function (e) {
                    var t, n, r = e.options, i = e.selectedIndex, o = "select-one" === e.type || 0 > i,
                        a = o ? null : [], s = o ? i + 1 : r.length, u = 0 > i ? s : o ? i : 0;
                    for (; s > u; u++) if (n = r[u], !(!n.selected && u !== i || (b.support.optDisabled ? n.disabled : null !== n.getAttribute("disabled")) || n.parentNode.disabled && b.nodeName(n.parentNode, "optgroup"))) {
                        if (t = b(n).val(), o) return t;
                        a.push(t)
                    }
                    return a
                }, set: function (e, t) {
                    var n = b.makeArray(t);
                    return b(e).find("option").each(function () {
                        this.selected = b.inArray(b(this).val(), n) >= 0
                    }), n.length || (e.selectedIndex = -1), n
                }
            }
        },
        attr: function (e, n, r) {
            var o, a, s, u = e.nodeType;
            if (e && 3 !== u && 8 !== u && 2 !== u) return typeof e.getAttribute === i ? b.prop(e, n, r) : (a = 1 !== u || !b.isXMLDoc(e), a && (n = n.toLowerCase(), o = b.attrHooks[n] || (J.test(n) ? z : I)), r === t ? o && a && "get" in o && null !== (s = o.get(e, n)) ? s : (typeof e.getAttribute !== i && (s = e.getAttribute(n)), null == s ? t : s) : null !== r ? o && a && "set" in o && (s = o.set(e, r, n)) !== t ? s : (e.setAttribute(n, r + ""), r) : (b.removeAttr(e, n), t))
        },
        removeAttr: function (e, t) {
            var n, r, i = 0, o = t && t.match(w);
            if (o && 1 === e.nodeType) while (n = o[i++]) r = b.propFix[n] || n, J.test(n) ? !Q && G.test(n) ? e[b.camelCase("default-" + n)] = e[r] = !1 : e[r] = !1 : b.attr(e, n, ""), e.removeAttribute(Q ? n : r)
        },
        attrHooks: {
            type: {
                set: function (e, t) {
                    if (!b.support.radioValue && "radio" === t && b.nodeName(e, "input")) {
                        var n = e.value;
                        return e.setAttribute("type", t), n && (e.value = n), t
                    }
                }
            }
        },
        propFix: {
            tabindex: "tabIndex",
            readonly: "readOnly",
            "for": "htmlFor",
            "class": "className",
            maxlength: "maxLength",
            cellspacing: "cellSpacing",
            cellpadding: "cellPadding",
            rowspan: "rowSpan",
            colspan: "colSpan",
            usemap: "useMap",
            frameborder: "frameBorder",
            contenteditable: "contentEditable"
        },
        prop: function (e, n, r) {
            var i, o, a, s = e.nodeType;
            if (e && 3 !== s && 8 !== s && 2 !== s) return a = 1 !== s || !b.isXMLDoc(e), a && (n = b.propFix[n] || n, o = b.propHooks[n]), r !== t ? o && "set" in o && (i = o.set(e, r, n)) !== t ? i : e[n] = r : o && "get" in o && null !== (i = o.get(e, n)) ? i : e[n]
        },
        propHooks: {
            tabIndex: {
                get: function (e) {
                    var n = e.getAttributeNode("tabindex");
                    return n && n.specified ? parseInt(n.value, 10) : V.test(e.nodeName) || Y.test(e.nodeName) && e.href ? 0 : t
                }
            }
        }
    }), z = {
        get: function (e, n) {
            var r = b.prop(e, n), i = "boolean" == typeof r && e.getAttribute(n),
                o = "boolean" == typeof r ? K && Q ? null != i : G.test(n) ? e[b.camelCase("default-" + n)] : !!i : e.getAttributeNode(n);
            return o && o.value !== !1 ? n.toLowerCase() : t
        }, set: function (e, t, n) {
            return t === !1 ? b.removeAttr(e, n) : K && Q || !G.test(n) ? e.setAttribute(!Q && b.propFix[n] || n, n) : e[b.camelCase("default-" + n)] = e[n] = !0, n
        }
    }, K && Q || (b.attrHooks.value = {
        get: function (e, n) {
            var r = e.getAttributeNode(n);
            return b.nodeName(e, "input") ? e.defaultValue : r && r.specified ? r.value : t
        }, set: function (e, n, r) {
            return b.nodeName(e, "input") ? (e.defaultValue = n, t) : I && I.set(e, n, r)
        }
    }), Q || (I = b.valHooks.button = {
        get: function (e, n) {
            var r = e.getAttributeNode(n);
            return r && ("id" === n || "name" === n || "coords" === n ? "" !== r.value : r.specified) ? r.value : t
        }, set: function (e, n, r) {
            var i = e.getAttributeNode(r);
            return i || e.setAttributeNode(i = e.ownerDocument.createAttribute(r)), i.value = n += "", "value" === r || n === e.getAttribute(r) ? n : t
        }
    }, b.attrHooks.contenteditable = {
        get: I.get, set: function (e, t, n) {
            I.set(e, "" === t ? !1 : t, n)
        }
    }, b.each(["width", "height"], function (e, n) {
        b.attrHooks[n] = b.extend(b.attrHooks[n], {
            set: function (e, r) {
                return "" === r ? (e.setAttribute(n, "auto"), r) : t
            }
        })
    })), b.support.hrefNormalized || (b.each(["href", "src", "width", "height"], function (e, n) {
        b.attrHooks[n] = b.extend(b.attrHooks[n], {
            get: function (e) {
                var r = e.getAttribute(n, 2);
                return null == r ? t : r
            }
        })
    }), b.each(["href", "src"], function (e, t) {
        b.propHooks[t] = {
            get: function (e) {
                return e.getAttribute(t, 4)
            }
        }
    })), b.support.style || (b.attrHooks.style = {
        get: function (e) {
            return e.style.cssText || t
        }, set: function (e, t) {
            return e.style.cssText = t + ""
        }
    }), b.support.optSelected || (b.propHooks.selected = b.extend(b.propHooks.selected, {
        get: function (e) {
            var t = e.parentNode;
            return t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex), null
        }
    })), b.support.enctype || (b.propFix.enctype = "encoding"), b.support.checkOn || b.each(["radio", "checkbox"], function () {
        b.valHooks[this] = {
            get: function (e) {
                return null === e.getAttribute("value") ? "on" : e.value
            }
        }
    }), b.each(["radio", "checkbox"], function () {
        b.valHooks[this] = b.extend(b.valHooks[this], {
            set: function (e, n) {
                return b.isArray(n) ? e.checked = b.inArray(b(e).val(), n) >= 0 : t
            }
        })
    });
    var Z = /^(?:input|select|textarea)$/i, et = /^key/, tt = /^(?:mouse|contextmenu)|click/,
        nt = /^(?:focusinfocus|focusoutblur)$/, rt = /^([^.]*)(?:\.(.+)|)$/;

    function it() {
        return !0
    }

    function ot() {
        return !1
    }

    b.event = {
        global: {},
        add: function (e, n, r, o, a) {
            var s, u, l, c, p, f, d, h, g, m, y, v = b._data(e);
            if (v) {
                r.handler && (c = r, r = c.handler, a = c.selector), r.guid || (r.guid = b.guid++), (u = v.events) || (u = v.events = {}), (f = v.handle) || (f = v.handle = function (e) {
                    return typeof b === i || e && b.event.triggered === e.type ? t : b.event.dispatch.apply(f.elem, arguments)
                }, f.elem = e), n = (n || "").match(w) || [""], l = n.length;
                while (l--) s = rt.exec(n[l]) || [], g = y = s[1], m = (s[2] || "").split(".").sort(), p = b.event.special[g] || {}, g = (a ? p.delegateType : p.bindType) || g, p = b.event.special[g] || {}, d = b.extend({
                    type: g,
                    origType: y,
                    data: o,
                    handler: r,
                    guid: r.guid,
                    selector: a,
                    needsContext: a && b.expr.match.needsContext.test(a),
                    namespace: m.join(".")
                }, c), (h = u[g]) || (h = u[g] = [], h.delegateCount = 0, p.setup && p.setup.call(e, o, m, f) !== !1 || (e.addEventListener ? e.addEventListener(g, f, !1) : e.attachEvent && e.attachEvent("on" + g, f))), p.add && (p.add.call(e, d), d.handler.guid || (d.handler.guid = r.guid)), a ? h.splice(h.delegateCount++, 0, d) : h.push(d), b.event.global[g] = !0;
                e = null
            }
        },
        remove: function (e, t, n, r, i) {
            var o, a, s, u, l, c, p, f, d, h, g, m = b.hasData(e) && b._data(e);
            if (m && (c = m.events)) {
                t = (t || "").match(w) || [""], l = t.length;
                while (l--) if (s = rt.exec(t[l]) || [], d = g = s[1], h = (s[2] || "").split(".").sort(), d) {
                    p = b.event.special[d] || {}, d = (r ? p.delegateType : p.bindType) || d, f = c[d] || [], s = s[2] && RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), u = o = f.length;
                    while (o--) a = f[o], !i && g !== a.origType || n && n.guid !== a.guid || s && !s.test(a.namespace) || r && r !== a.selector && ("**" !== r || !a.selector) || (f.splice(o, 1), a.selector && f.delegateCount--, p.remove && p.remove.call(e, a));
                    u && !f.length && (p.teardown && p.teardown.call(e, h, m.handle) !== !1 || b.removeEvent(e, d, m.handle), delete c[d])
                } else for (d in c) b.event.remove(e, d + t[l], n, r, !0);
                b.isEmptyObject(c) && (delete m.handle, b._removeData(e, "events"))
            }
        },
        trigger: function (n, r, i, a) {
            var s, u, l, c, p, f, d, h = [i || o], g = y.call(n, "type") ? n.type : n,
                m = y.call(n, "namespace") ? n.namespace.split(".") : [];
            if (l = f = i = i || o, 3 !== i.nodeType && 8 !== i.nodeType && !nt.test(g + b.event.triggered) && (g.indexOf(".") >= 0 && (m = g.split("."), g = m.shift(), m.sort()), u = 0 > g.indexOf(":") && "on" + g, n = n[b.expando] ? n : new b.Event(g, "object" == typeof n && n), n.isTrigger = !0, n.namespace = m.join("."), n.namespace_re = n.namespace ? RegExp("(^|\\.)" + m.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, n.result = t, n.target || (n.target = i), r = null == r ? [n] : b.makeArray(r, [n]), p = b.event.special[g] || {}, a || !p.trigger || p.trigger.apply(i, r) !== !1)) {
                if (!a && !p.noBubble && !b.isWindow(i)) {
                    for (c = p.delegateType || g, nt.test(c + g) || (l = l.parentNode); l; l = l.parentNode) h.push(l), f = l;
                    f === (i.ownerDocument || o) && h.push(f.defaultView || f.parentWindow || e)
                }
                d = 0;
                while ((l = h[d++]) && !n.isPropagationStopped()) n.type = d > 1 ? c : p.bindType || g, s = (b._data(l, "events") || {})[n.type] && b._data(l, "handle"), s && s.apply(l, r), s = u && l[u], s && b.acceptData(l) && s.apply && s.apply(l, r) === !1 && n.preventDefault();
                if (n.type = g, !(a || n.isDefaultPrevented() || p._default && p._default.apply(i.ownerDocument, r) !== !1 || "click" === g && b.nodeName(i, "a") || !b.acceptData(i) || !u || !i[g] || b.isWindow(i))) {
                    f = i[u], f && (i[u] = null), b.event.triggered = g;
                    try {
                        i[g]()
                    } catch (v) {
                    }
                    b.event.triggered = t, f && (i[u] = f)
                }
                return n.result
            }
        },
        dispatch: function (e) {
            e = b.event.fix(e);
            var n, r, i, o, a, s = [], u = h.call(arguments), l = (b._data(this, "events") || {})[e.type] || [],
                c = b.event.special[e.type] || {};
            if (u[0] = e, e.delegateTarget = this, !c.preDispatch || c.preDispatch.call(this, e) !== !1) {
                s = b.event.handlers.call(this, e, l), n = 0;
                while ((o = s[n++]) && !e.isPropagationStopped()) {
                    e.currentTarget = o.elem, a = 0;
                    while ((i = o.handlers[a++]) && !e.isImmediatePropagationStopped()) (!e.namespace_re || e.namespace_re.test(i.namespace)) && (e.handleObj = i, e.data = i.data, r = ((b.event.special[i.origType] || {}).handle || i.handler).apply(o.elem, u), r !== t && (e.result = r) === !1 && (e.preventDefault(), e.stopPropagation()))
                }
                return c.postDispatch && c.postDispatch.call(this, e), e.result
            }
        },
        handlers: function (e, n) {
            var r, i, o, a, s = [], u = n.delegateCount, l = e.target;
            if (u && l.nodeType && (!e.button || "click" !== e.type)) for (; l != this; l = l.parentNode || this) if (1 === l.nodeType && (l.disabled !== !0 || "click" !== e.type)) {
                for (o = [], a = 0; u > a; a++) i = n[a], r = i.selector + " ", o[r] === t && (o[r] = i.needsContext ? b(r, this).index(l) >= 0 : b.find(r, this, null, [l]).length), o[r] && o.push(i);
                o.length && s.push({elem: l, handlers: o})
            }
            return n.length > u && s.push({elem: this, handlers: n.slice(u)}), s
        },
        fix: function (e) {
            if (e[b.expando]) return e;
            var t, n, r, i = e.type, a = e, s = this.fixHooks[i];
            s || (this.fixHooks[i] = s = tt.test(i) ? this.mouseHooks : et.test(i) ? this.keyHooks : {}), r = s.props ? this.props.concat(s.props) : this.props, e = new b.Event(a), t = r.length;
            while (t--) n = r[t], e[n] = a[n];
            return e.target || (e.target = a.srcElement || o), 3 === e.target.nodeType && (e.target = e.target.parentNode), e.metaKey = !!e.metaKey, s.filter ? s.filter(e, a) : e
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "), filter: function (e, t) {
                return null == e.which && (e.which = null != t.charCode ? t.charCode : t.keyCode), e
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function (e, n) {
                var r, i, a, s = n.button, u = n.fromElement;
                return null == e.pageX && null != n.clientX && (i = e.target.ownerDocument || o, a = i.documentElement, r = i.body, e.pageX = n.clientX + (a && a.scrollLeft || r && r.scrollLeft || 0) - (a && a.clientLeft || r && r.clientLeft || 0), e.pageY = n.clientY + (a && a.scrollTop || r && r.scrollTop || 0) - (a && a.clientTop || r && r.clientTop || 0)), !e.relatedTarget && u && (e.relatedTarget = u === e.target ? n.toElement : u), e.which || s === t || (e.which = 1 & s ? 1 : 2 & s ? 3 : 4 & s ? 2 : 0), e
            }
        },
        special: {
            load: {noBubble: !0}, click: {
                trigger: function () {
                    return b.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : t
                }
            }, focus: {
                trigger: function () {
                    if (this !== o.activeElement && this.focus) try {
                        return this.focus(), !1
                    } catch (e) {
                    }
                }, delegateType: "focusin"
            }, blur: {
                trigger: function () {
                    return this === o.activeElement && this.blur ? (this.blur(), !1) : t
                }, delegateType: "focusout"
            }, beforeunload: {
                postDispatch: function (e) {
                    e.result !== t && (e.originalEvent.returnValue = e.result)
                }
            }
        },
        simulate: function (e, t, n, r) {
            var i = b.extend(new b.Event, n, {type: e, isSimulated: !0, originalEvent: {}});
            r ? b.event.trigger(i, null, t) : b.event.dispatch.call(t, i), i.isDefaultPrevented() && n.preventDefault()
        }
    }, b.removeEvent = o.removeEventListener ? function (e, t, n) {
        e.removeEventListener && e.removeEventListener(t, n, !1)
    } : function (e, t, n) {
        var r = "on" + t;
        e.detachEvent && (typeof e[r] === i && (e[r] = null), e.detachEvent(r, n))
    }, b.Event = function (e, n) {
        return this instanceof b.Event ? (e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || e.returnValue === !1 || e.getPreventDefault && e.getPreventDefault() ? it : ot) : this.type = e, n && b.extend(this, n), this.timeStamp = e && e.timeStamp || b.now(), this[b.expando] = !0, t) : new b.Event(e, n)
    }, b.Event.prototype = {
        isDefaultPrevented: ot,
        isPropagationStopped: ot,
        isImmediatePropagationStopped: ot,
        preventDefault: function () {
            var e = this.originalEvent;
            this.isDefaultPrevented = it, e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1)
        },
        stopPropagation: function () {
            var e = this.originalEvent;
            this.isPropagationStopped = it, e && (e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0)
        },
        stopImmediatePropagation: function () {
            this.isImmediatePropagationStopped = it, this.stopPropagation()
        }
    }, b.each({mouseenter: "mouseover", mouseleave: "mouseout"}, function (e, t) {
        b.event.special[e] = {
            delegateType: t, bindType: t, handle: function (e) {
                var n, r = this, i = e.relatedTarget, o = e.handleObj;
                return (!i || i !== r && !b.contains(r, i)) && (e.type = o.origType, n = o.handler.apply(this, arguments), e.type = t), n
            }
        }
    }), b.support.submitBubbles || (b.event.special.submit = {
        setup: function () {
            return b.nodeName(this, "form") ? !1 : (b.event.add(this, "click._submit keypress._submit", function (e) {
                var n = e.target, r = b.nodeName(n, "input") || b.nodeName(n, "button") ? n.form : t;
                r && !b._data(r, "submitBubbles") && (b.event.add(r, "submit._submit", function (e) {
                    e._submit_bubble = !0
                }), b._data(r, "submitBubbles", !0))
            }), t)
        }, postDispatch: function (e) {
            e._submit_bubble && (delete e._submit_bubble, this.parentNode && !e.isTrigger && b.event.simulate("submit", this.parentNode, e, !0))
        }, teardown: function () {
            return b.nodeName(this, "form") ? !1 : (b.event.remove(this, "._submit"), t)
        }
    }), b.support.changeBubbles || (b.event.special.change = {
        setup: function () {
            return Z.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (b.event.add(this, "propertychange._change", function (e) {
                "checked" === e.originalEvent.propertyName && (this._just_changed = !0)
            }), b.event.add(this, "click._change", function (e) {
                this._just_changed && !e.isTrigger && (this._just_changed = !1), b.event.simulate("change", this, e, !0)
            })), !1) : (b.event.add(this, "beforeactivate._change", function (e) {
                var t = e.target;
                Z.test(t.nodeName) && !b._data(t, "changeBubbles") && (b.event.add(t, "change._change", function (e) {
                    !this.parentNode || e.isSimulated || e.isTrigger || b.event.simulate("change", this.parentNode, e, !0)
                }), b._data(t, "changeBubbles", !0))
            }), t)
        }, handle: function (e) {
            var n = e.target;
            return this !== n || e.isSimulated || e.isTrigger || "radio" !== n.type && "checkbox" !== n.type ? e.handleObj.handler.apply(this, arguments) : t
        }, teardown: function () {
            return b.event.remove(this, "._change"), !Z.test(this.nodeName)
        }
    }), b.support.focusinBubbles || b.each({focus: "focusin", blur: "focusout"}, function (e, t) {
        var n = 0, r = function (e) {
            b.event.simulate(t, e.target, b.event.fix(e), !0)
        };
        b.event.special[t] = {
            setup: function () {
                0 === n++ && o.addEventListener(e, r, !0)
            }, teardown: function () {
                0 === --n && o.removeEventListener(e, r, !0)
            }
        }
    }), b.fn.extend({
        on: function (e, n, r, i, o) {
            var a, s;
            if ("object" == typeof e) {
                "string" != typeof n && (r = r || n, n = t);
                for (a in e) this.on(a, n, r, e[a], o);
                return this
            }
            if (null == r && null == i ? (i = n, r = n = t) : null == i && ("string" == typeof n ? (i = r, r = t) : (i = r, r = n, n = t)), i === !1) i = ot; else if (!i) return this;
            return 1 === o && (s = i, i = function (e) {
                return b().off(e), s.apply(this, arguments)
            }, i.guid = s.guid || (s.guid = b.guid++)), this.each(function () {
                b.event.add(this, e, i, r, n)
            })
        }, one: function (e, t, n, r) {
            return this.on(e, t, n, r, 1)
        }, off: function (e, n, r) {
            var i, o;
            if (e && e.preventDefault && e.handleObj) return i = e.handleObj, b(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
            if ("object" == typeof e) {
                for (o in e) this.off(o, n, e[o]);
                return this
            }
            return (n === !1 || "function" == typeof n) && (r = n, n = t), r === !1 && (r = ot), this.each(function () {
                b.event.remove(this, e, r, n)
            })
        }, bind: function (e, t, n) {
            return this.on(e, null, t, n)
        }, unbind: function (e, t) {
            return this.off(e, null, t)
        }, delegate: function (e, t, n, r) {
            return this.on(t, e, n, r)
        }, undelegate: function (e, t, n) {
            return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
        }, trigger: function (e, t) {
            return this.each(function () {
                b.event.trigger(e, t, this)
            })
        }, triggerHandler: function (e, n) {
            var r = this[0];
            return r ? b.event.trigger(e, n, r, !0) : t
        }
    }), function (e, t) {
        var n, r, i, o, a, s, u, l, c, p, f, d, h, g, m, y, v, x = "sizzle" + -new Date, w = e.document, T = {}, N = 0,
            C = 0, k = it(), E = it(), S = it(), A = typeof t, j = 1 << 31, D = [], L = D.pop, H = D.push, q = D.slice,
            M = D.indexOf || function (e) {
                var t = 0, n = this.length;
                for (; n > t; t++) if (this[t] === e) return t;
                return -1
            }, _ = "[\\x20\\t\\r\\n\\f]", F = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", O = F.replace("w", "w#"),
            B = "([*^$|!~]?=)",
            P = "\\[" + _ + "*(" + F + ")" + _ + "*(?:" + B + _ + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + O + ")|)|)" + _ + "*\\]",
            R = ":(" + F + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + P.replace(3, 8) + ")*)|.*)\\)|)",
            W = RegExp("^" + _ + "+|((?:^|[^\\\\])(?:\\\\.)*)" + _ + "+$", "g"), $ = RegExp("^" + _ + "*," + _ + "*"),
            I = RegExp("^" + _ + "*([\\x20\\t\\r\\n\\f>+~])" + _ + "*"), z = RegExp(R), X = RegExp("^" + O + "$"), U = {
                ID: RegExp("^#(" + F + ")"),
                CLASS: RegExp("^\\.(" + F + ")"),
                NAME: RegExp("^\\[name=['\"]?(" + F + ")['\"]?\\]"),
                TAG: RegExp("^(" + F.replace("w", "w*") + ")"),
                ATTR: RegExp("^" + P),
                PSEUDO: RegExp("^" + R),
                CHILD: RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + _ + "*(even|odd|(([+-]|)(\\d*)n|)" + _ + "*(?:([+-]|)" + _ + "*(\\d+)|))" + _ + "*\\)|)", "i"),
                needsContext: RegExp("^" + _ + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + _ + "*((?:-\\d)?\\d*)" + _ + "*\\)|)(?=[^-]|$)", "i")
            }, V = /[\x20\t\r\n\f]*[+~]/, Y = /^[^{]+\{\s*\[native code/, J = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            G = /^(?:input|select|textarea|button)$/i, Q = /^h\d$/i, K = /'|\\/g,
            Z = /\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g, et = /\\([\da-fA-F]{1,6}[\x20\t\r\n\f]?|.)/g,
            tt = function (e, t) {
                var n = "0x" + t - 65536;
                return n !== n ? t : 0 > n ? String.fromCharCode(n + 65536) : String.fromCharCode(55296 | n >> 10, 56320 | 1023 & n)
            };
        try {
            q.call(w.documentElement.childNodes, 0)[0].nodeType
        } catch (nt) {
            q = function (e) {
                var t, n = [];
                while (t = this[e++]) n.push(t);
                return n
            }
        }

        function rt(e) {
            return Y.test(e + "")
        }

        function it() {
            var e, t = [];
            return e = function (n, r) {
                return t.push(n += " ") > i.cacheLength && delete e[t.shift()], e[n] = r
            }
        }

        function ot(e) {
            return e[x] = !0, e
        }

        function at(e) {
            var t = p.createElement("div");
            try {
                return e(t)
            } catch (n) {
                return !1
            } finally {
                t = null
            }
        }

        function st(e, t, n, r) {
            var i, o, a, s, u, l, f, g, m, v;
            if ((t ? t.ownerDocument || t : w) !== p && c(t), t = t || p, n = n || [], !e || "string" != typeof e) return n;
            if (1 !== (s = t.nodeType) && 9 !== s) return [];
            if (!d && !r) {
                if (i = J.exec(e)) if (a = i[1]) {
                    if (9 === s) {
                        if (o = t.getElementById(a), !o || !o.parentNode) return n;
                        if (o.id === a) return n.push(o), n
                    } else if (t.ownerDocument && (o = t.ownerDocument.getElementById(a)) && y(t, o) && o.id === a) return n.push(o), n
                } else {
                    if (i[2]) return H.apply(n, q.call(t.getElementsByTagName(e), 0)), n;
                    if ((a = i[3]) && T.getByClassName && t.getElementsByClassName) return H.apply(n, q.call(t.getElementsByClassName(a), 0)), n
                }
                if (T.qsa && !h.test(e)) {
                    if (f = !0, g = x, m = t, v = 9 === s && e, 1 === s && "object" !== t.nodeName.toLowerCase()) {
                        l = ft(e), (f = t.getAttribute("id")) ? g = f.replace(K, "\\$&") : t.setAttribute("id", g), g = "[id='" + g + "'] ", u = l.length;
                        while (u--) l[u] = g + dt(l[u]);
                        m = V.test(e) && t.parentNode || t, v = l.join(",")
                    }
                    if (v) try {
                        return H.apply(n, q.call(m.querySelectorAll(v), 0)), n
                    } catch (b) {
                    } finally {
                        f || t.removeAttribute("id")
                    }
                }
            }
            return wt(e.replace(W, "$1"), t, n, r)
        }

        a = st.isXML = function (e) {
            var t = e && (e.ownerDocument || e).documentElement;
            return t ? "HTML" !== t.nodeName : !1
        }, c = st.setDocument = function (e) {
            var n = e ? e.ownerDocument || e : w;
            return n !== p && 9 === n.nodeType && n.documentElement ? (p = n, f = n.documentElement, d = a(n), T.tagNameNoComments = at(function (e) {
                return e.appendChild(n.createComment("")), !e.getElementsByTagName("*").length
            }), T.attributes = at(function (e) {
                e.innerHTML = "<select></select>";
                var t = typeof e.lastChild.getAttribute("multiple");
                return "boolean" !== t && "string" !== t
            }), T.getByClassName = at(function (e) {
                return e.innerHTML = "<div class='hidden e'></div><div class='hidden'></div>", e.getElementsByClassName && e.getElementsByClassName("e").length ? (e.lastChild.className = "e", 2 === e.getElementsByClassName("e").length) : !1
            }), T.getByName = at(function (e) {
                e.id = x + 0, e.innerHTML = "<a name='" + x + "'></a><div name='" + x + "'></div>", f.insertBefore(e, f.firstChild);
                var t = n.getElementsByName && n.getElementsByName(x).length === 2 + n.getElementsByName(x + 0).length;
                return T.getIdNotName = !n.getElementById(x), f.removeChild(e), t
            }), i.attrHandle = at(function (e) {
                return e.innerHTML = "<a href='#'></a>", e.firstChild && typeof e.firstChild.getAttribute !== A && "#" === e.firstChild.getAttribute("href")
            }) ? {} : {
                href: function (e) {
                    return e.getAttribute("href", 2)
                }, type: function (e) {
                    return e.getAttribute("type")
                }
            }, T.getIdNotName ? (i.find.ID = function (e, t) {
                if (typeof t.getElementById !== A && !d) {
                    var n = t.getElementById(e);
                    return n && n.parentNode ? [n] : []
                }
            }, i.filter.ID = function (e) {
                var t = e.replace(et, tt);
                return function (e) {
                    return e.getAttribute("id") === t
                }
            }) : (i.find.ID = function (e, n) {
                if (typeof n.getElementById !== A && !d) {
                    var r = n.getElementById(e);
                    return r ? r.id === e || typeof r.getAttributeNode !== A && r.getAttributeNode("id").value === e ? [r] : t : []
                }
            }, i.filter.ID = function (e) {
                var t = e.replace(et, tt);
                return function (e) {
                    var n = typeof e.getAttributeNode !== A && e.getAttributeNode("id");
                    return n && n.value === t
                }
            }), i.find.TAG = T.tagNameNoComments ? function (e, n) {
                return typeof n.getElementsByTagName !== A ? n.getElementsByTagName(e) : t
            } : function (e, t) {
                var n, r = [], i = 0, o = t.getElementsByTagName(e);
                if ("*" === e) {
                    while (n = o[i++]) 1 === n.nodeType && r.push(n);
                    return r
                }
                return o
            }, i.find.NAME = T.getByName && function (e, n) {
                return typeof n.getElementsByName !== A ? n.getElementsByName(name) : t
            }, i.find.CLASS = T.getByClassName && function (e, n) {
                return typeof n.getElementsByClassName === A || d ? t : n.getElementsByClassName(e)
            }, g = [], h = [":focus"], (T.qsa = rt(n.querySelectorAll)) && (at(function (e) {
                e.innerHTML = "<select><option selected=''></option></select>", e.querySelectorAll("[selected]").length || h.push("\\[" + _ + "*(?:checked|disabled|ismap|multiple|readonly|selected|value)"), e.querySelectorAll(":checked").length || h.push(":checked")
            }), at(function (e) {
                e.innerHTML = "<input type='hidden' i=''/>", e.querySelectorAll("[i^='']").length && h.push("[*^$]=" + _ + "*(?:\"\"|'')"), e.querySelectorAll(":enabled").length || h.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), h.push(",.*:")
            })), (T.matchesSelector = rt(m = f.matchesSelector || f.mozMatchesSelector || f.webkitMatchesSelector || f.oMatchesSelector || f.msMatchesSelector)) && at(function (e) {
                T.disconnectedMatch = m.call(e, "div"), m.call(e, "[s!='']:x"), g.push("!=", R)
            }), h = RegExp(h.join("|")), g = RegExp(g.join("|")), y = rt(f.contains) || f.compareDocumentPosition ? function (e, t) {
                var n = 9 === e.nodeType ? e.documentElement : e, r = t && t.parentNode;
                return e === r || !(!r || 1 !== r.nodeType || !(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(r)))
            } : function (e, t) {
                if (t) while (t = t.parentNode) if (t === e) return !0;
                return !1
            }, v = f.compareDocumentPosition ? function (e, t) {
                var r;
                return e === t ? (u = !0, 0) : (r = t.compareDocumentPosition && e.compareDocumentPosition && e.compareDocumentPosition(t)) ? 1 & r || e.parentNode && 11 === e.parentNode.nodeType ? e === n || y(w, e) ? -1 : t === n || y(w, t) ? 1 : 0 : 4 & r ? -1 : 1 : e.compareDocumentPosition ? -1 : 1
            } : function (e, t) {
                var r, i = 0, o = e.parentNode, a = t.parentNode, s = [e], l = [t];
                if (e === t) return u = !0, 0;
                if (!o || !a) return e === n ? -1 : t === n ? 1 : o ? -1 : a ? 1 : 0;
                if (o === a) return ut(e, t);
                r = e;
                while (r = r.parentNode) s.unshift(r);
                r = t;
                while (r = r.parentNode) l.unshift(r);
                while (s[i] === l[i]) i++;
                return i ? ut(s[i], l[i]) : s[i] === w ? -1 : l[i] === w ? 1 : 0
            }, u = !1, [0, 0].sort(v), T.detectDuplicates = u, p) : p
        }, st.matches = function (e, t) {
            return st(e, null, null, t)
        }, st.matchesSelector = function (e, t) {
            if ((e.ownerDocument || e) !== p && c(e), t = t.replace(Z, "='$1']"), !(!T.matchesSelector || d || g && g.test(t) || h.test(t))) try {
                var n = m.call(e, t);
                if (n || T.disconnectedMatch || e.document && 11 !== e.document.nodeType) return n
            } catch (r) {
            }
            return st(t, p, null, [e]).length > 0
        }, st.contains = function (e, t) {
            return (e.ownerDocument || e) !== p && c(e), y(e, t)
        }, st.attr = function (e, t) {
            var n;
            return (e.ownerDocument || e) !== p && c(e), d || (t = t.toLowerCase()), (n = i.attrHandle[t]) ? n(e) : d || T.attributes ? e.getAttribute(t) : ((n = e.getAttributeNode(t)) || e.getAttribute(t)) && e[t] === !0 ? t : n && n.specified ? n.value : null
        }, st.error = function (e) {
            throw Error("Syntax error, unrecognized expression: " + e)
        }, st.uniqueSort = function (e) {
            var t, n = [], r = 1, i = 0;
            if (u = !T.detectDuplicates, e.sort(v), u) {
                for (; t = e[r]; r++) t === e[r - 1] && (i = n.push(r));
                while (i--) e.splice(n[i], 1)
            }
            return e
        };

        function ut(e, t) {
            var n = t && e, r = n && (~t.sourceIndex || j) - (~e.sourceIndex || j);
            if (r) return r;
            if (n) while (n = n.nextSibling) if (n === t) return -1;
            return e ? 1 : -1
        }

        function lt(e) {
            return function (t) {
                var n = t.nodeName.toLowerCase();
                return "input" === n && t.type === e
            }
        }

        function ct(e) {
            return function (t) {
                var n = t.nodeName.toLowerCase();
                return ("input" === n || "button" === n) && t.type === e
            }
        }

        function pt(e) {
            return ot(function (t) {
                return t = +t, ot(function (n, r) {
                    var i, o = e([], n.length, t), a = o.length;
                    while (a--) n[i = o[a]] && (n[i] = !(r[i] = n[i]))
                })
            })
        }

        o = st.getText = function (e) {
            var t, n = "", r = 0, i = e.nodeType;
            if (i) {
                if (1 === i || 9 === i || 11 === i) {
                    if ("string" == typeof e.textContent) return e.textContent;
                    for (e = e.firstChild; e; e = e.nextSibling) n += o(e)
                } else if (3 === i || 4 === i) return e.nodeValue
            } else for (; t = e[r]; r++) n += o(t);
            return n
        }, i = st.selectors = {
            cacheLength: 50,
            createPseudo: ot,
            match: U,
            find: {},
            relative: {
                ">": {dir: "parentNode", first: !0},
                " ": {dir: "parentNode"},
                "+": {dir: "previousSibling", first: !0},
                "~": {dir: "previousSibling"}
            },
            preFilter: {
                ATTR: function (e) {
                    return e[1] = e[1].replace(et, tt), e[3] = (e[4] || e[5] || "").replace(et, tt), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                }, CHILD: function (e) {
                    return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || st.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && st.error(e[0]), e
                }, PSEUDO: function (e) {
                    var t, n = !e[5] && e[2];
                    return U.CHILD.test(e[0]) ? null : (e[4] ? e[2] = e[4] : n && z.test(n) && (t = ft(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                }
            },
            filter: {
                TAG: function (e) {
                    return "*" === e ? function () {
                        return !0
                    } : (e = e.replace(et, tt).toLowerCase(), function (t) {
                        return t.nodeName && t.nodeName.toLowerCase() === e
                    })
                }, CLASS: function (e) {
                    var t = k[e + " "];
                    return t || (t = RegExp("(^|" + _ + ")" + e + "(" + _ + "|$)")) && k(e, function (e) {
                        return t.test(e.className || typeof e.getAttribute !== A && e.getAttribute("class") || "")
                    })
                }, ATTR: function (e, t, n) {
                    return function (r) {
                        var i = st.attr(r, e);
                        return null == i ? "!=" === t : t ? (i += "", "=" === t ? i === n : "!=" === t ? i !== n : "^=" === t ? n && 0 === i.indexOf(n) : "*=" === t ? n && i.indexOf(n) > -1 : "$=" === t ? n && i.slice(-n.length) === n : "~=" === t ? (" " + i + " ").indexOf(n) > -1 : "|=" === t ? i === n || i.slice(0, n.length + 1) === n + "-" : !1) : !0
                    }
                }, CHILD: function (e, t, n, r, i) {
                    var o = "nth" !== e.slice(0, 3), a = "last" !== e.slice(-4), s = "of-type" === t;
                    return 1 === r && 0 === i ? function (e) {
                        return !!e.parentNode
                    } : function (t, n, u) {
                        var l, c, p, f, d, h, g = o !== a ? "nextSibling" : "previousSibling", m = t.parentNode,
                            y = s && t.nodeName.toLowerCase(), v = !u && !s;
                        if (m) {
                            if (o) {
                                while (g) {
                                    p = t;
                                    while (p = p[g]) if (s ? p.nodeName.toLowerCase() === y : 1 === p.nodeType) return !1;
                                    h = g = "only" === e && !h && "nextSibling"
                                }
                                return !0
                            }
                            if (h = [a ? m.firstChild : m.lastChild], a && v) {
                                c = m[x] || (m[x] = {}), l = c[e] || [], d = l[0] === N && l[1], f = l[0] === N && l[2], p = d && m.childNodes[d];
                                while (p = ++d && p && p[g] || (f = d = 0) || h.pop()) if (1 === p.nodeType && ++f && p === t) {
                                    c[e] = [N, d, f];
                                    break
                                }
                            } else if (v && (l = (t[x] || (t[x] = {}))[e]) && l[0] === N) f = l[1]; else while (p = ++d && p && p[g] || (f = d = 0) || h.pop()) if ((s ? p.nodeName.toLowerCase() === y : 1 === p.nodeType) && ++f && (v && ((p[x] || (p[x] = {}))[e] = [N, f]), p === t)) break;
                            return f -= i, f === r || 0 === f % r && f / r >= 0
                        }
                    }
                }, PSEUDO: function (e, t) {
                    var n, r = i.pseudos[e] || i.setFilters[e.toLowerCase()] || st.error("unsupported pseudo: " + e);
                    return r[x] ? r(t) : r.length > 1 ? (n = [e, e, "", t], i.setFilters.hasOwnProperty(e.toLowerCase()) ? ot(function (e, n) {
                        var i, o = r(e, t), a = o.length;
                        while (a--) i = M.call(e, o[a]), e[i] = !(n[i] = o[a])
                    }) : function (e) {
                        return r(e, 0, n)
                    }) : r
                }
            },
            pseudos: {
                not: ot(function (e) {
                    var t = [], n = [], r = s(e.replace(W, "$1"));
                    return r[x] ? ot(function (e, t, n, i) {
                        var o, a = r(e, null, i, []), s = e.length;
                        while (s--) (o = a[s]) && (e[s] = !(t[s] = o))
                    }) : function (e, i, o) {
                        return t[0] = e, r(t, null, o, n), !n.pop()
                    }
                }), has: ot(function (e) {
                    return function (t) {
                        return st(e, t).length > 0
                    }
                }), contains: ot(function (e) {
                    return function (t) {
                        return (t.textContent || t.innerText || o(t)).indexOf(e) > -1
                    }
                }), lang: ot(function (e) {
                    return X.test(e || "") || st.error("unsupported lang: " + e), e = e.replace(et, tt).toLowerCase(), function (t) {
                        var n;
                        do if (n = d ? t.getAttribute("xml:lang") || t.getAttribute("lang") : t.lang) return n = n.toLowerCase(), n === e || 0 === n.indexOf(e + "-"); while ((t = t.parentNode) && 1 === t.nodeType);
                        return !1
                    }
                }), target: function (t) {
                    var n = e.location && e.location.hash;
                    return n && n.slice(1) === t.id
                }, root: function (e) {
                    return e === f
                }, focus: function (e) {
                    return e === p.activeElement && (!p.hasFocus || p.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                }, enabled: function (e) {
                    return e.disabled === !1
                }, disabled: function (e) {
                    return e.disabled === !0
                }, checked: function (e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && !!e.checked || "option" === t && !!e.selected
                }, selected: function (e) {
                    return e.parentNode && e.parentNode.selectedIndex, e.selected === !0
                }, empty: function (e) {
                    for (e = e.firstChild; e; e = e.nextSibling) if (e.nodeName > "@" || 3 === e.nodeType || 4 === e.nodeType) return !1;
                    return !0
                }, parent: function (e) {
                    return !i.pseudos.empty(e)
                }, header: function (e) {
                    return Q.test(e.nodeName)
                }, input: function (e) {
                    return G.test(e.nodeName)
                }, button: function (e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && "button" === e.type || "button" === t
                }, text: function (e) {
                    var t;
                    return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || t.toLowerCase() === e.type)
                }, first: pt(function () {
                    return [0]
                }), last: pt(function (e, t) {
                    return [t - 1]
                }), eq: pt(function (e, t, n) {
                    return [0 > n ? n + t : n]
                }), even: pt(function (e, t) {
                    var n = 0;
                    for (; t > n; n += 2) e.push(n);
                    return e
                }), odd: pt(function (e, t) {
                    var n = 1;
                    for (; t > n; n += 2) e.push(n);
                    return e
                }), lt: pt(function (e, t, n) {
                    var r = 0 > n ? n + t : n;
                    for (; --r >= 0;) e.push(r);
                    return e
                }), gt: pt(function (e, t, n) {
                    var r = 0 > n ? n + t : n;
                    for (; t > ++r;) e.push(r);
                    return e
                })
            }
        };
        for (n in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0}) i.pseudos[n] = lt(n);
        for (n in{submit: !0, reset: !0}) i.pseudos[n] = ct(n);

        function ft(e, t) {
            var n, r, o, a, s, u, l, c = E[e + " "];
            if (c) return t ? 0 : c.slice(0);
            s = e, u = [], l = i.preFilter;
            while (s) {
                (!n || (r = $.exec(s))) && (r && (s = s.slice(r[0].length) || s), u.push(o = [])), n = !1, (r = I.exec(s)) && (n = r.shift(), o.push({
                    value: n,
                    type: r[0].replace(W, " ")
                }), s = s.slice(n.length));
                for (a in i.filter) !(r = U[a].exec(s)) || l[a] && !(r = l[a](r)) || (n = r.shift(), o.push({
                    value: n,
                    type: a,
                    matches: r
                }), s = s.slice(n.length));
                if (!n) break
            }
            return t ? s.length : s ? st.error(e) : E(e, u).slice(0)
        }

        function dt(e) {
            var t = 0, n = e.length, r = "";
            for (; n > t; t++) r += e[t].value;
            return r
        }

        function ht(e, t, n) {
            var i = t.dir, o = n && "parentNode" === i, a = C++;
            return t.first ? function (t, n, r) {
                while (t = t[i]) if (1 === t.nodeType || o) return e(t, n, r)
            } : function (t, n, s) {
                var u, l, c, p = N + " " + a;
                if (s) {
                    while (t = t[i]) if ((1 === t.nodeType || o) && e(t, n, s)) return !0
                } else while (t = t[i]) if (1 === t.nodeType || o) if (c = t[x] || (t[x] = {}), (l = c[i]) && l[0] === p) {
                    if ((u = l[1]) === !0 || u === r) return u === !0
                } else if (l = c[i] = [p], l[1] = e(t, n, s) || r, l[1] === !0) return !0
            }
        }

        function gt(e) {
            return e.length > 1 ? function (t, n, r) {
                var i = e.length;
                while (i--) if (!e[i](t, n, r)) return !1;
                return !0
            } : e[0]
        }

        function mt(e, t, n, r, i) {
            var o, a = [], s = 0, u = e.length, l = null != t;
            for (; u > s; s++) (o = e[s]) && (!n || n(o, r, i)) && (a.push(o), l && t.push(s));
            return a
        }

        function yt(e, t, n, r, i, o) {
            return r && !r[x] && (r = yt(r)), i && !i[x] && (i = yt(i, o)), ot(function (o, a, s, u) {
                var l, c, p, f = [], d = [], h = a.length, g = o || xt(t || "*", s.nodeType ? [s] : s, []),
                    m = !e || !o && t ? g : mt(g, f, e, s, u), y = n ? i || (o ? e : h || r) ? [] : a : m;
                if (n && n(m, y, s, u), r) {
                    l = mt(y, d), r(l, [], s, u), c = l.length;
                    while (c--) (p = l[c]) && (y[d[c]] = !(m[d[c]] = p))
                }
                if (o) {
                    if (i || e) {
                        if (i) {
                            l = [], c = y.length;
                            while (c--) (p = y[c]) && l.push(m[c] = p);
                            i(null, y = [], l, u)
                        }
                        c = y.length;
                        while (c--) (p = y[c]) && (l = i ? M.call(o, p) : f[c]) > -1 && (o[l] = !(a[l] = p))
                    }
                } else y = mt(y === a ? y.splice(h, y.length) : y), i ? i(null, a, y, u) : H.apply(a, y)
            })
        }

        function vt(e) {
            var t, n, r, o = e.length, a = i.relative[e[0].type], s = a || i.relative[" "], u = a ? 1 : 0,
                c = ht(function (e) {
                    return e === t
                }, s, !0), p = ht(function (e) {
                    return M.call(t, e) > -1
                }, s, !0), f = [function (e, n, r) {
                    return !a && (r || n !== l) || ((t = n).nodeType ? c(e, n, r) : p(e, n, r))
                }];
            for (; o > u; u++) if (n = i.relative[e[u].type]) f = [ht(gt(f), n)]; else {
                if (n = i.filter[e[u].type].apply(null, e[u].matches), n[x]) {
                    for (r = ++u; o > r; r++) if (i.relative[e[r].type]) break;
                    return yt(u > 1 && gt(f), u > 1 && dt(e.slice(0, u - 1)).replace(W, "$1"), n, r > u && vt(e.slice(u, r)), o > r && vt(e = e.slice(r)), o > r && dt(e))
                }
                f.push(n)
            }
            return gt(f)
        }

        function bt(e, t) {
            var n = 0, o = t.length > 0, a = e.length > 0, s = function (s, u, c, f, d) {
                var h, g, m, y = [], v = 0, b = "0", x = s && [], w = null != d, T = l,
                    C = s || a && i.find.TAG("*", d && u.parentNode || u), k = N += null == T ? 1 : Math.random() || .1;
                for (w && (l = u !== p && u, r = n); null != (h = C[b]); b++) {
                    if (a && h) {
                        g = 0;
                        while (m = e[g++]) if (m(h, u, c)) {
                            f.push(h);
                            break
                        }
                        w && (N = k, r = ++n)
                    }
                    o && ((h = !m && h) && v--, s && x.push(h))
                }
                if (v += b, o && b !== v) {
                    g = 0;
                    while (m = t[g++]) m(x, y, u, c);
                    if (s) {
                        if (v > 0) while (b--) x[b] || y[b] || (y[b] = L.call(f));
                        y = mt(y)
                    }
                    H.apply(f, y), w && !s && y.length > 0 && v + t.length > 1 && st.uniqueSort(f)
                }
                return w && (N = k, l = T), x
            };
            return o ? ot(s) : s
        }

        s = st.compile = function (e, t) {
            var n, r = [], i = [], o = S[e + " "];
            if (!o) {
                t || (t = ft(e)), n = t.length;
                while (n--) o = vt(t[n]), o[x] ? r.push(o) : i.push(o);
                o = S(e, bt(i, r))
            }
            return o
        };

        function xt(e, t, n) {
            var r = 0, i = t.length;
            for (; i > r; r++) st(e, t[r], n);
            return n
        }

        function wt(e, t, n, r) {
            var o, a, u, l, c, p = ft(e);
            if (!r && 1 === p.length) {
                if (a = p[0] = p[0].slice(0), a.length > 2 && "ID" === (u = a[0]).type && 9 === t.nodeType && !d && i.relative[a[1].type]) {
                    if (t = i.find.ID(u.matches[0].replace(et, tt), t)[0], !t) return n;
                    e = e.slice(a.shift().value.length)
                }
                o = U.needsContext.test(e) ? 0 : a.length;
                while (o--) {
                    if (u = a[o], i.relative[l = u.type]) break;
                    if ((c = i.find[l]) && (r = c(u.matches[0].replace(et, tt), V.test(a[0].type) && t.parentNode || t))) {
                        if (a.splice(o, 1), e = r.length && dt(a), !e) return H.apply(n, q.call(r, 0)), n;
                        break
                    }
                }
            }
            return s(e, p)(r, t, d, n, V.test(e)), n
        }

        i.pseudos.nth = i.pseudos.eq;

        function Tt() {
        }

        i.filters = Tt.prototype = i.pseudos, i.setFilters = new Tt, c(), st.attr = b.attr, b.find = st, b.expr = st.selectors, b.expr[":"] = b.expr.pseudos, b.unique = st.uniqueSort, b.text = st.getText, b.isXMLDoc = st.isXML, b.contains = st.contains
    }(e);
    var at = /Until$/, st = /^(?:parents|prev(?:Until|All))/, ut = /^.[^:#\[\.,]*$/, lt = b.expr.match.needsContext,
        ct = {children: !0, contents: !0, next: !0, prev: !0};
    b.fn.extend({
        find: function (e) {
            var t, n, r, i = this.length;
            if ("string" != typeof e) return r = this, this.pushStack(b(e).filter(function () {
                for (t = 0; i > t; t++) if (b.contains(r[t], this)) return !0
            }));
            for (n = [], t = 0; i > t; t++) b.find(e, this[t], n);
            return n = this.pushStack(i > 1 ? b.unique(n) : n), n.selector = (this.selector ? this.selector + " " : "") + e, n
        }, has: function (e) {
            var t, n = b(e, this), r = n.length;
            return this.filter(function () {
                for (t = 0; r > t; t++) if (b.contains(this, n[t])) return !0
            })
        }, not: function (e) {
            return this.pushStack(ft(this, e, !1))
        }, filter: function (e) {
            return this.pushStack(ft(this, e, !0))
        }, is: function (e) {
            return !!e && ("string" == typeof e ? lt.test(e) ? b(e, this.context).index(this[0]) >= 0 : b.filter(e, this).length > 0 : this.filter(e).length > 0)
        }, closest: function (e, t) {
            var n, r = 0, i = this.length, o = [], a = lt.test(e) || "string" != typeof e ? b(e, t || this.context) : 0;
            for (; i > r; r++) {
                n = this[r];
                while (n && n.ownerDocument && n !== t && 11 !== n.nodeType) {
                    if (a ? a.index(n) > -1 : b.find.matchesSelector(n, e)) {
                        o.push(n);
                        break
                    }
                    n = n.parentNode
                }
            }
            return this.pushStack(o.length > 1 ? b.unique(o) : o)
        }, index: function (e) {
            return e ? "string" == typeof e ? b.inArray(this[0], b(e)) : b.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        }, add: function (e, t) {
            var n = "string" == typeof e ? b(e, t) : b.makeArray(e && e.nodeType ? [e] : e), r = b.merge(this.get(), n);
            return this.pushStack(b.unique(r))
        }, addBack: function (e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
        }
    }), b.fn.andSelf = b.fn.addBack;

    function pt(e, t) {
        do e = e[t]; while (e && 1 !== e.nodeType);
        return e
    }

    b.each({
        parent: function (e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        }, parents: function (e) {
            return b.dir(e, "parentNode")
        }, parentsUntil: function (e, t, n) {
            return b.dir(e, "parentNode", n)
        }, next: function (e) {
            return pt(e, "nextSibling")
        }, prev: function (e) {
            return pt(e, "previousSibling")
        }, nextAll: function (e) {
            return b.dir(e, "nextSibling")
        }, prevAll: function (e) {
            return b.dir(e, "previousSibling")
        }, nextUntil: function (e, t, n) {
            return b.dir(e, "nextSibling", n)
        }, prevUntil: function (e, t, n) {
            return b.dir(e, "previousSibling", n)
        }, siblings: function (e) {
            return b.sibling((e.parentNode || {}).firstChild, e)
        }, children: function (e) {
            return b.sibling(e.firstChild)
        }, contents: function (e) {
            return b.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : b.merge([], e.childNodes)
        }
    }, function (e, t) {
        b.fn[e] = function (n, r) {
            var i = b.map(this, t, n);
            return at.test(e) || (r = n), r && "string" == typeof r && (i = b.filter(r, i)), i = this.length > 1 && !ct[e] ? b.unique(i) : i, this.length > 1 && st.test(e) && (i = i.reverse()), this.pushStack(i)
        }
    }), b.extend({
        filter: function (e, t, n) {
            return n && (e = ":not(" + e + ")"), 1 === t.length ? b.find.matchesSelector(t[0], e) ? [t[0]] : [] : b.find.matches(e, t)
        }, dir: function (e, n, r) {
            var i = [], o = e[n];
            while (o && 9 !== o.nodeType && (r === t || 1 !== o.nodeType || !b(o).is(r))) 1 === o.nodeType && i.push(o), o = o[n];
            return i
        }, sibling: function (e, t) {
            var n = [];
            for (; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
            return n
        }
    });

    function ft(e, t, n) {
        if (t = t || 0, b.isFunction(t)) return b.grep(e, function (e, r) {
            var i = !!t.call(e, r, e);
            return i === n
        });
        if (t.nodeType) return b.grep(e, function (e) {
            return e === t === n
        });
        if ("string" == typeof t) {
            var r = b.grep(e, function (e) {
                return 1 === e.nodeType
            });
            if (ut.test(t)) return b.filter(t, r, !n);
            t = b.filter(t, r)
        }
        return b.grep(e, function (e) {
            return b.inArray(e, t) >= 0 === n
        })
    }

    function dt(e) {
        var t = ht.split("|"), n = e.createDocumentFragment();
        if (n.createElement) while (t.length) n.createElement(t.pop());
        return n
    }

    var ht = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
        gt = / jQuery\d+="(?:null|\d+)"/g, mt = RegExp("<(?:" + ht + ")[\\s/>]", "i"), yt = /^\s+/,
        vt = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, bt = /<([\w:]+)/,
        xt = /<tbody/i, wt = /<|&#?\w+;/, Tt = /<(?:script|style|link)/i, Nt = /^(?:checkbox|radio)$/i,
        Ct = /checked\s*(?:[^=]|=\s*.checked.)/i, kt = /^$|\/(?:java|ecma)script/i, Et = /^true\/(.*)/,
        St = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g, At = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            legend: [1, "<fieldset>", "</fieldset>"],
            area: [1, "<map>", "</map>"],
            param: [1, "<object>", "</object>"],
            thead: [1, "<table>", "</table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: b.support.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
        }, jt = dt(o), Dt = jt.appendChild(o.createElement("div"));
    At.optgroup = At.option, At.tbody = At.tfoot = At.colgroup = At.caption = At.thead, At.th = At.td, b.fn.extend({
        text: function (e) {
            return b.access(this, function (e) {
                return e === t ? b.text(this) : this.empty().append((this[0] && this[0].ownerDocument || o).createTextNode(e))
            }, null, e, arguments.length)
        }, wrapAll: function (e) {
            if (b.isFunction(e)) return this.each(function (t) {
                b(this).wrapAll(e.call(this, t))
            });
            if (this[0]) {
                var t = b(e, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                    var e = this;
                    while (e.firstChild && 1 === e.firstChild.nodeType) e = e.firstChild;
                    return e
                }).append(this)
            }
            return this
        }, wrapInner: function (e) {
            return b.isFunction(e) ? this.each(function (t) {
                b(this).wrapInner(e.call(this, t))
            }) : this.each(function () {
                var t = b(this), n = t.contents();
                n.length ? n.wrapAll(e) : t.append(e)
            })
        }, wrap: function (e) {
            var t = b.isFunction(e);
            return this.each(function (n) {
                b(this).wrapAll(t ? e.call(this, n) : e)
            })
        }, unwrap: function () {
            return this.parent().each(function () {
                b.nodeName(this, "body") || b(this).replaceWith(this.childNodes)
            }).end()
        }, append: function () {
            return this.domManip(arguments, !0, function (e) {
                (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && this.appendChild(e)
            })
        }, prepend: function () {
            return this.domManip(arguments, !0, function (e) {
                (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && this.insertBefore(e, this.firstChild)
            })
        }, before: function () {
            return this.domManip(arguments, !1, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this)
            })
        }, after: function () {
            return this.domManip(arguments, !1, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
            })
        }, remove: function (e, t) {
            var n, r = 0;
            for (; null != (n = this[r]); r++) (!e || b.filter(e, [n]).length > 0) && (t || 1 !== n.nodeType || b.cleanData(Ot(n)), n.parentNode && (t && b.contains(n.ownerDocument, n) && Mt(Ot(n, "script")), n.parentNode.removeChild(n)));
            return this
        }, empty: function () {
            var e, t = 0;
            for (; null != (e = this[t]); t++) {
                1 === e.nodeType && b.cleanData(Ot(e, !1));
                while (e.firstChild) e.removeChild(e.firstChild);
                e.options && b.nodeName(e, "select") && (e.options.length = 0)
            }
            return this
        }, clone: function (e, t) {
            return e = null == e ? !1 : e, t = null == t ? e : t, this.map(function () {
                return b.clone(this, e, t)
            })
        }, html: function (e) {
            return b.access(this, function (e) {
                var n = this[0] || {}, r = 0, i = this.length;
                if (e === t) return 1 === n.nodeType ? n.innerHTML.replace(gt, "") : t;
                if (!("string" != typeof e || Tt.test(e) || !b.support.htmlSerialize && mt.test(e) || !b.support.leadingWhitespace && yt.test(e) || At[(bt.exec(e) || ["", ""])[1].toLowerCase()])) {
                    e = e.replace(vt, "<$1></$2>");
                    try {
                        for (; i > r; r++) n = this[r] || {}, 1 === n.nodeType && (b.cleanData(Ot(n, !1)), n.innerHTML = e);
                        n = 0
                    } catch (o) {
                    }
                }
                n && this.empty().append(e)
            }, null, e, arguments.length)
        }, replaceWith: function (e) {
            var t = b.isFunction(e);
            return t || "string" == typeof e || (e = b(e).not(this).detach()), this.domManip([e], !0, function (e) {
                var t = this.nextSibling, n = this.parentNode;
                n && (b(this).remove(), n.insertBefore(e, t))
            })
        }, detach: function (e) {
            return this.remove(e, !0)
        }, domManip: function (e, n, r) {
            e = f.apply([], e);
            var i, o, a, s, u, l, c = 0, p = this.length, d = this, h = p - 1, g = e[0], m = b.isFunction(g);
            if (m || !(1 >= p || "string" != typeof g || b.support.checkClone) && Ct.test(g)) return this.each(function (i) {
                var o = d.eq(i);
                m && (e[0] = g.call(this, i, n ? o.html() : t)), o.domManip(e, n, r)
            });
            if (p && (l = b.buildFragment(e, this[0].ownerDocument, !1, this), i = l.firstChild, 1 === l.childNodes.length && (l = i), i)) {
                for (n = n && b.nodeName(i, "tr"), s = b.map(Ot(l, "script"), Ht), a = s.length; p > c; c++) o = l, c !== h && (o = b.clone(o, !0, !0), a && b.merge(s, Ot(o, "script"))), r.call(n && b.nodeName(this[c], "table") ? Lt(this[c], "tbody") : this[c], o, c);
                if (a) for (u = s[s.length - 1].ownerDocument, b.map(s, qt), c = 0; a > c; c++) o = s[c], kt.test(o.type || "") && !b._data(o, "globalEval") && b.contains(u, o) && (o.src ? b.ajax({
                    url: o.src,
                    type: "GET",
                    dataType: "script",
                    async: !1,
                    global: !1,
                    "throws": !0
                }) : b.globalEval((o.text || o.textContent || o.innerHTML || "").replace(St, "")));
                l = i = null
            }
            return this
        }
    });

    function Lt(e, t) {
        return e.getElementsByTagName(t)[0] || e.appendChild(e.ownerDocument.createElement(t))
    }

    function Ht(e) {
        var t = e.getAttributeNode("type");
        return e.type = (t && t.specified) + "/" + e.type, e
    }

    function qt(e) {
        var t = Et.exec(e.type);
        return t ? e.type = t[1] : e.removeAttribute("type"), e
    }

    function Mt(e, t) {
        var n, r = 0;
        for (; null != (n = e[r]); r++) b._data(n, "globalEval", !t || b._data(t[r], "globalEval"))
    }

    function _t(e, t) {
        if (1 === t.nodeType && b.hasData(e)) {
            var n, r, i, o = b._data(e), a = b._data(t, o), s = o.events;
            if (s) {
                delete a.handle, a.events = {};
                for (n in s) for (r = 0, i = s[n].length; i > r; r++) b.event.add(t, n, s[n][r])
            }
            a.data && (a.data = b.extend({}, a.data))
        }
    }

    function Ft(e, t) {
        var n, r, i;
        if (1 === t.nodeType) {
            if (n = t.nodeName.toLowerCase(), !b.support.noCloneEvent && t[b.expando]) {
                i = b._data(t);
                for (r in i.events) b.removeEvent(t, r, i.handle);
                t.removeAttribute(b.expando)
            }
            "script" === n && t.text !== e.text ? (Ht(t).text = e.text, qt(t)) : "object" === n ? (t.parentNode && (t.outerHTML = e.outerHTML), b.support.html5Clone && e.innerHTML && !b.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : "input" === n && Nt.test(e.type) ? (t.defaultChecked = t.checked = e.checked, t.value !== e.value && (t.value = e.value)) : "option" === n ? t.defaultSelected = t.selected = e.defaultSelected : ("input" === n || "textarea" === n) && (t.defaultValue = e.defaultValue)
        }
    }

    b.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (e, t) {
        b.fn[e] = function (e) {
            var n, r = 0, i = [], o = b(e), a = o.length - 1;
            for (; a >= r; r++) n = r === a ? this : this.clone(!0), b(o[r])[t](n), d.apply(i, n.get());
            return this.pushStack(i)
        }
    });

    function Ot(e, n) {
        var r, o, a = 0,
            s = typeof e.getElementsByTagName !== i ? e.getElementsByTagName(n || "*") : typeof e.querySelectorAll !== i ? e.querySelectorAll(n || "*") : t;
        if (!s) for (s = [], r = e.childNodes || e; null != (o = r[a]); a++) !n || b.nodeName(o, n) ? s.push(o) : b.merge(s, Ot(o, n));
        return n === t || n && b.nodeName(e, n) ? b.merge([e], s) : s
    }

    function Bt(e) {
        Nt.test(e.type) && (e.defaultChecked = e.checked)
    }

    b.extend({
        clone: function (e, t, n) {
            var r, i, o, a, s, u = b.contains(e.ownerDocument, e);
            if (b.support.html5Clone || b.isXMLDoc(e) || !mt.test("<" + e.nodeName + ">") ? o = e.cloneNode(!0) : (Dt.innerHTML = e.outerHTML, Dt.removeChild(o = Dt.firstChild)), !(b.support.noCloneEvent && b.support.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || b.isXMLDoc(e))) for (r = Ot(o), s = Ot(e), a = 0; null != (i = s[a]); ++a) r[a] && Ft(i, r[a]);
            if (t) if (n) for (s = s || Ot(e), r = r || Ot(o), a = 0; null != (i = s[a]); a++) _t(i, r[a]); else _t(e, o);
            return r = Ot(o, "script"), r.length > 0 && Mt(r, !u && Ot(e, "script")), r = s = i = null, o
        }, buildFragment: function (e, t, n, r) {
            var i, o, a, s, u, l, c, p = e.length, f = dt(t), d = [], h = 0;
            for (; p > h; h++) if (o = e[h], o || 0 === o) if ("object" === b.type(o)) b.merge(d, o.nodeType ? [o] : o); else if (wt.test(o)) {
                s = s || f.appendChild(t.createElement("div")), u = (bt.exec(o) || ["", ""])[1].toLowerCase(), c = At[u] || At._default, s.innerHTML = c[1] + o.replace(vt, "<$1></$2>") + c[2], i = c[0];
                while (i--) s = s.lastChild;
                if (!b.support.leadingWhitespace && yt.test(o) && d.push(t.createTextNode(yt.exec(o)[0])), !b.support.tbody) {
                    o = "table" !== u || xt.test(o) ? "<table>" !== c[1] || xt.test(o) ? 0 : s : s.firstChild, i = o && o.childNodes.length;
                    while (i--) b.nodeName(l = o.childNodes[i], "tbody") && !l.childNodes.length && o.removeChild(l)
                }
                b.merge(d, s.childNodes), s.textContent = "";
                while (s.firstChild) s.removeChild(s.firstChild);
                s = f.lastChild
            } else d.push(t.createTextNode(o));
            s && f.removeChild(s), b.support.appendChecked || b.grep(Ot(d, "input"), Bt), h = 0;
            while (o = d[h++]) if ((!r || -1 === b.inArray(o, r)) && (a = b.contains(o.ownerDocument, o), s = Ot(f.appendChild(o), "script"), a && Mt(s), n)) {
                i = 0;
                while (o = s[i++]) kt.test(o.type || "") && n.push(o)
            }
            return s = null, f
        }, cleanData: function (e, t) {
            var n, r, o, a, s = 0, u = b.expando, l = b.cache, p = b.support.deleteExpando, f = b.event.special;
            for (; null != (n = e[s]); s++) if ((t || b.acceptData(n)) && (o = n[u], a = o && l[o])) {
                if (a.events) for (r in a.events) f[r] ? b.event.remove(n, r) : b.removeEvent(n, r, a.handle);
                l[o] && (delete l[o], p ? delete n[u] : typeof n.removeAttribute !== i ? n.removeAttribute(u) : n[u] = null, c.push(o))
            }
        }
    });
    var Pt, Rt, Wt, $t = /alpha\([^)]*\)/i, It = /opacity\s*=\s*([^)]*)/, zt = /^(top|right|bottom|left)$/,
        Xt = /^(none|table(?!-c[ea]).+)/, Ut = /^margin/, Vt = RegExp("^(" + x + ")(.*)$", "i"),
        Yt = RegExp("^(" + x + ")(?!px)[a-z%]+$", "i"), Jt = RegExp("^([+-])=(" + x + ")", "i"), Gt = {BODY: "block"},
        Qt = {position: "absolute", visibility: "hidden", display: "block"}, Kt = {letterSpacing: 0, fontWeight: 400},
        Zt = ["Top", "Right", "Bottom", "Left"], en = ["Webkit", "O", "Moz", "ms"];

    function tn(e, t) {
        if (t in e) return t;
        var n = t.charAt(0).toUpperCase() + t.slice(1), r = t, i = en.length;
        while (i--) if (t = en[i] + n, t in e) return t;
        return r
    }

    function nn(e, t) {
        return e = t || e, "none" === b.css(e, "display") || !b.contains(e.ownerDocument, e)
    }

    function rn(e, t) {
        var n, r, i, o = [], a = 0, s = e.length;
        for (; s > a; a++) r = e[a], r.style && (o[a] = b._data(r, "olddisplay"), n = r.style.display, t ? (o[a] || "none" !== n || (r.style.display = ""), "" === r.style.display && nn(r) && (o[a] = b._data(r, "olddisplay", un(r.nodeName)))) : o[a] || (i = nn(r), (n && "none" !== n || !i) && b._data(r, "olddisplay", i ? n : b.css(r, "display"))));
        for (a = 0; s > a; a++) r = e[a], r.style && (t && "none" !== r.style.display && "" !== r.style.display || (r.style.display = t ? o[a] || "" : "none"));
        return e
    }

    b.fn.extend({
        css: function (e, n) {
            return b.access(this, function (e, n, r) {
                var i, o, a = {}, s = 0;
                if (b.isArray(n)) {
                    for (o = Rt(e), i = n.length; i > s; s++) a[n[s]] = b.css(e, n[s], !1, o);
                    return a
                }
                return r !== t ? b.style(e, n, r) : b.css(e, n)
            }, e, n, arguments.length > 1)
        }, show: function () {
            return rn(this, !0)
        }, hide: function () {
            return rn(this)
        }, toggle: function (e) {
            var t = "boolean" == typeof e;
            return this.each(function () {
                (t ? e : nn(this)) ? b(this).show() : b(this).hide()
            })
        }
    }), b.extend({
        cssHooks: {
            opacity: {
                get: function (e, t) {
                    if (t) {
                        var n = Wt(e, "opacity");
                        return "" === n ? "1" : n
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {"float": b.support.cssFloat ? "cssFloat" : "styleFloat"},
        style: function (e, n, r, i) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var o, a, s, u = b.camelCase(n), l = e.style;
                if (n = b.cssProps[u] || (b.cssProps[u] = tn(l, u)), s = b.cssHooks[n] || b.cssHooks[u], r === t) return s && "get" in s && (o = s.get(e, !1, i)) !== t ? o : l[n];
                if (a = typeof r, "string" === a && (o = Jt.exec(r)) && (r = (o[1] + 1) * o[2] + parseFloat(b.css(e, n)), a = "number"), !(null == r || "number" === a && isNaN(r) || ("number" !== a || b.cssNumber[u] || (r += "px"), b.support.clearCloneStyle || "" !== r || 0 !== n.indexOf("background") || (l[n] = "inherit"), s && "set" in s && (r = s.set(e, r, i)) === t))) try {
                    l[n] = r
                } catch (c) {
                }
            }
        },
        css: function (e, n, r, i) {
            var o, a, s, u = b.camelCase(n);
            return n = b.cssProps[u] || (b.cssProps[u] = tn(e.style, u)), s = b.cssHooks[n] || b.cssHooks[u], s && "get" in s && (a = s.get(e, !0, r)), a === t && (a = Wt(e, n, i)), "normal" === a && n in Kt && (a = Kt[n]), "" === r || r ? (o = parseFloat(a), r === !0 || b.isNumeric(o) ? o || 0 : a) : a
        },
        swap: function (e, t, n, r) {
            var i, o, a = {};
            for (o in t) a[o] = e.style[o], e.style[o] = t[o];
            i = n.apply(e, r || []);
            for (o in t) e.style[o] = a[o];
            return i
        }
    }), e.getComputedStyle ? (Rt = function (t) {
        return e.getComputedStyle(t, null)
    }, Wt = function (e, n, r) {
        var i, o, a, s = r || Rt(e), u = s ? s.getPropertyValue(n) || s[n] : t, l = e.style;
        return s && ("" !== u || b.contains(e.ownerDocument, e) || (u = b.style(e, n)), Yt.test(u) && Ut.test(n) && (i = l.width, o = l.minWidth, a = l.maxWidth, l.minWidth = l.maxWidth = l.width = u, u = s.width, l.width = i, l.minWidth = o, l.maxWidth = a)), u
    }) : o.documentElement.currentStyle && (Rt = function (e) {
        return e.currentStyle
    }, Wt = function (e, n, r) {
        var i, o, a, s = r || Rt(e), u = s ? s[n] : t, l = e.style;
        return null == u && l && l[n] && (u = l[n]), Yt.test(u) && !zt.test(n) && (i = l.left, o = e.runtimeStyle, a = o && o.left, a && (o.left = e.currentStyle.left), l.left = "fontSize" === n ? "1em" : u, u = l.pixelLeft + "px", l.left = i, a && (o.left = a)), "" === u ? "auto" : u
    });

    function on(e, t, n) {
        var r = Vt.exec(t);
        return r ? Math.max(0, r[1] - (n || 0)) + (r[2] || "px") : t
    }

    function an(e, t, n, r, i) {
        var o = n === (r ? "border" : "content") ? 4 : "width" === t ? 1 : 0, a = 0;
        for (; 4 > o; o += 2) "margin" === n && (a += b.css(e, n + Zt[o], !0, i)), r ? ("content" === n && (a -= b.css(e, "padding" + Zt[o], !0, i)), "margin" !== n && (a -= b.css(e, "border" + Zt[o] + "Width", !0, i))) : (a += b.css(e, "padding" + Zt[o], !0, i), "padding" !== n && (a += b.css(e, "border" + Zt[o] + "Width", !0, i)));
        return a
    }

    function sn(e, t, n) {
        var r = !0, i = "width" === t ? e.offsetWidth : e.offsetHeight, o = Rt(e),
            a = b.support.boxSizing && "border-box" === b.css(e, "boxSizing", !1, o);
        if (0 >= i || null == i) {
            if (i = Wt(e, t, o), (0 > i || null == i) && (i = e.style[t]), Yt.test(i)) return i;
            r = a && (b.support.boxSizingReliable || i === e.style[t]), i = parseFloat(i) || 0
        }
        return i + an(e, t, n || (a ? "border" : "content"), r, o) + "px"
    }

    function un(e) {
        var t = o, n = Gt[e];
        return n || (n = ln(e, t), "none" !== n && n || (Pt = (Pt || b("<iframe frameborder='0' width='0' height='0'/>").css("cssText", "display:block !important")).appendTo(t.documentElement), t = (Pt[0].contentWindow || Pt[0].contentDocument).document, t.write("<!doctype html><html><body>"), t.close(), n = ln(e, t), Pt.detach()), Gt[e] = n), n
    }

    function ln(e, t) {
        var n = b(t.createElement(e)).appendTo(t.body), r = b.css(n[0], "display");
        return n.remove(), r
    }

    b.each(["height", "width"], function (e, n) {
        b.cssHooks[n] = {
            get: function (e, r, i) {
                return r ? 0 === e.offsetWidth && Xt.test(b.css(e, "display")) ? b.swap(e, Qt, function () {
                    return sn(e, n, i)
                }) : sn(e, n, i) : t
            }, set: function (e, t, r) {
                var i = r && Rt(e);
                return on(e, t, r ? an(e, n, r, b.support.boxSizing && "border-box" === b.css(e, "boxSizing", !1, i), i) : 0)
            }
        }
    }), b.support.opacity || (b.cssHooks.opacity = {
        get: function (e, t) {
            return It.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : t ? "1" : ""
        }, set: function (e, t) {
            var n = e.style, r = e.currentStyle, i = b.isNumeric(t) ? "alpha(opacity=" + 100 * t + ")" : "",
                o = r && r.filter || n.filter || "";
            n.zoom = 1, (t >= 1 || "" === t) && "" === b.trim(o.replace($t, "")) && n.removeAttribute && (n.removeAttribute("filter"), "" === t || r && !r.filter) || (n.filter = $t.test(o) ? o.replace($t, i) : o + " " + i)
        }
    }), b(function () {
        b.support.reliableMarginRight || (b.cssHooks.marginRight = {
            get: function (e, n) {
                return n ? b.swap(e, {display: "inline-block"}, Wt, [e, "marginRight"]) : t
            }
        }), !b.support.pixelPosition && b.fn.position && b.each(["top", "left"], function (e, n) {
            b.cssHooks[n] = {
                get: function (e, r) {
                    return r ? (r = Wt(e, n), Yt.test(r) ? b(e).position()[n] + "px" : r) : t
                }
            }
        })
    }), b.expr && b.expr.filters && (b.expr.filters.hidden = function (e) {
        return 0 >= e.offsetWidth && 0 >= e.offsetHeight || !b.support.reliableHiddenOffsets && "none" === (e.style && e.style.display || b.css(e, "display"))
    }, b.expr.filters.visible = function (e) {
        return !b.expr.filters.hidden(e)
    }), b.each({margin: "", padding: "", border: "Width"}, function (e, t) {
        b.cssHooks[e + t] = {
            expand: function (n) {
                var r = 0, i = {}, o = "string" == typeof n ? n.split(" ") : [n];
                for (; 4 > r; r++) i[e + Zt[r] + t] = o[r] || o[r - 2] || o[0];
                return i
            }
        }, Ut.test(e) || (b.cssHooks[e + t].set = on)
    });
    var cn = /%20/g, pn = /\[\]$/, fn = /\r?\n/g, dn = /^(?:submit|button|image|reset|file)$/i,
        hn = /^(?:input|select|textarea|keygen)/i;
    b.fn.extend({
        serialize: function () {
            return b.param(this.serializeArray())
        }, serializeArray: function () {
            return this.map(function () {
                var e = b.prop(this, "elements");
                return e ? b.makeArray(e) : this
            }).filter(function () {
                var e = this.type;
                return this.name && !b(this).is(":disabled") && hn.test(this.nodeName) && !dn.test(e) && (this.checked || !Nt.test(e))
            }).map(function (e, t) {
                var n = b(this).val();
                return null == n ? null : b.isArray(n) ? b.map(n, function (e) {
                    return {name: t.name, value: e.replace(fn, "\r\n")}
                }) : {name: t.name, value: n.replace(fn, "\r\n")}
            }).get()
        }
    }), b.param = function (e, n) {
        var r, i = [], o = function (e, t) {
            t = b.isFunction(t) ? t() : null == t ? "" : t, i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t)
        };
        if (n === t && (n = b.ajaxSettings && b.ajaxSettings.traditional), b.isArray(e) || e.jquery && !b.isPlainObject(e)) b.each(e, function () {
            o(this.name, this.value)
        }); else for (r in e) gn(r, e[r], n, o);
        return i.join("&").replace(cn, "+")
    };

    function gn(e, t, n, r) {
        var i;
        if (b.isArray(t)) b.each(t, function (t, i) {
            n || pn.test(e) ? r(e, i) : gn(e + "[" + ("object" == typeof i ? t : "") + "]", i, n, r)
        }); else if (n || "object" !== b.type(t)) r(e, t); else for (i in t) gn(e + "[" + i + "]", t[i], n, r)
    }

    b.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (e, t) {
        b.fn[t] = function (e, n) {
            return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
        }
    }), b.fn.hover = function (e, t) {
        return this.mouseenter(e).mouseleave(t || e)
    };
    var mn, yn, vn = b.now(), bn = /\?/, xn = /#.*$/, wn = /([?&])_=[^&]*/, Tn = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
        Nn = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, Cn = /^(?:GET|HEAD)$/, kn = /^\/\//,
        En = /^([\w.+-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/, Sn = b.fn.load, An = {}, jn = {}, Dn = "*/".concat("*");
    try {
        yn = a.href
    } catch (Ln) {
        yn = o.createElement("a"), yn.href = "", yn = yn.href
    }
    mn = En.exec(yn.toLowerCase()) || [];

    function Hn(e) {
        return function (t, n) {
            "string" != typeof t && (n = t, t = "*");
            var r, i = 0, o = t.toLowerCase().match(w) || [];
            if (b.isFunction(n)) while (r = o[i++]) "+" === r[0] ? (r = r.slice(1) || "*", (e[r] = e[r] || []).unshift(n)) : (e[r] = e[r] || []).push(n)
        }
    }

    function qn(e, n, r, i) {
        var o = {}, a = e === jn;

        function s(u) {
            var l;
            return o[u] = !0, b.each(e[u] || [], function (e, u) {
                var c = u(n, r, i);
                return "string" != typeof c || a || o[c] ? a ? !(l = c) : t : (n.dataTypes.unshift(c), s(c), !1)
            }), l
        }

        return s(n.dataTypes[0]) || !o["*"] && s("*")
    }

    function Mn(e, n) {
        var r, i, o = b.ajaxSettings.flatOptions || {};
        for (i in n) n[i] !== t && ((o[i] ? e : r || (r = {}))[i] = n[i]);
        return r && b.extend(!0, e, r), e
    }

    b.fn.load = function (e, n, r) {
        if ("string" != typeof e && Sn) return Sn.apply(this, arguments);
        var i, o, a, s = this, u = e.indexOf(" ");
        return u >= 0 && (i = e.slice(u, e.length), e = e.slice(0, u)), b.isFunction(n) ? (r = n, n = t) : n && "object" == typeof n && (a = "POST"), s.length > 0 && b.ajax({
            url: e,
            type: a,
            dataType: "html",
            data: n
        }).done(function (e) {
            o = arguments, s.html(i ? b("<div>").append(b.parseHTML(e)).find(i) : e)
        }).complete(r && function (e, t) {
            s.each(r, o || [e.responseText, t, e])
        }), this
    }, b.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
        b.fn[t] = function (e) {
            return this.on(t, e)
        }
    }), b.each(["get", "post"], function (e, n) {
        b[n] = function (e, r, i, o) {
            return b.isFunction(r) && (o = o || i, i = r, r = t), b.ajax({
                url: e,
                type: n,
                dataType: o,
                data: r,
                success: i
            })
        }
    }), b.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: yn,
            type: "GET",
            isLocal: Nn.test(mn[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Dn,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {xml: /xml/, html: /html/, json: /json/},
            responseFields: {xml: "responseXML", text: "responseText"},
            converters: {"* text": e.String, "text html": !0, "text json": b.parseJSON, "text xml": b.parseXML},
            flatOptions: {url: !0, context: !0}
        },
        ajaxSetup: function (e, t) {
            return t ? Mn(Mn(e, b.ajaxSettings), t) : Mn(b.ajaxSettings, e)
        },
        ajaxPrefilter: Hn(An),
        ajaxTransport: Hn(jn),
        ajax: function (e, n) {
            "object" == typeof e && (n = e, e = t), n = n || {};
            var r, i, o, a, s, u, l, c, p = b.ajaxSetup({}, n), f = p.context || p,
                d = p.context && (f.nodeType || f.jquery) ? b(f) : b.event, h = b.Deferred(),
                g = b.Callbacks("once memory"), m = p.statusCode || {}, y = {}, v = {}, x = 0, T = "canceled", N = {
                    readyState: 0, getResponseHeader: function (e) {
                        var t;
                        if (2 === x) {
                            if (!c) {
                                c = {};
                                while (t = Tn.exec(a)) c[t[1].toLowerCase()] = t[2]
                            }
                            t = c[e.toLowerCase()]
                        }
                        return null == t ? null : t
                    }, getAllResponseHeaders: function () {
                        return 2 === x ? a : null
                    }, setRequestHeader: function (e, t) {
                        var n = e.toLowerCase();
                        return x || (e = v[n] = v[n] || e, y[e] = t), this
                    }, overrideMimeType: function (e) {
                        return x || (p.mimeType = e), this
                    }, statusCode: function (e) {
                        var t;
                        if (e) if (2 > x) for (t in e) m[t] = [m[t], e[t]]; else N.always(e[N.status]);
                        return this
                    }, abort: function (e) {
                        var t = e || T;
                        return l && l.abort(t), k(0, t), this
                    }
                };
            if (h.promise(N).complete = g.add, N.success = N.done, N.error = N.fail, p.url = ((e || p.url || yn) + "").replace(xn, "").replace(kn, mn[1] + "//"), p.type = n.method || n.type || p.method || p.type, p.dataTypes = b.trim(p.dataType || "*").toLowerCase().match(w) || [""], null == p.crossDomain && (r = En.exec(p.url.toLowerCase()), p.crossDomain = !(!r || r[1] === mn[1] && r[2] === mn[2] && (r[3] || ("http:" === r[1] ? 80 : 443)) == (mn[3] || ("http:" === mn[1] ? 80 : 443)))), p.data && p.processData && "string" != typeof p.data && (p.data = b.param(p.data, p.traditional)), qn(An, p, n, N), 2 === x) return N;
            u = p.global, u && 0 === b.active++ && b.event.trigger("ajaxStart"), p.type = p.type.toUpperCase(), p.hasContent = !Cn.test(p.type), o = p.url, p.hasContent || (p.data && (o = p.url += (bn.test(o) ? "&" : "?") + p.data, delete p.data), p.cache === !1 && (p.url = wn.test(o) ? o.replace(wn, "$1_=" + vn++) : o + (bn.test(o) ? "&" : "?") + "_=" + vn++)), p.ifModified && (b.lastModified[o] && N.setRequestHeader("If-Modified-Since", b.lastModified[o]), b.etag[o] && N.setRequestHeader("If-None-Match", b.etag[o])), (p.data && p.hasContent && p.contentType !== !1 || n.contentType) && N.setRequestHeader("Content-Type", p.contentType), N.setRequestHeader("Accept", p.dataTypes[0] && p.accepts[p.dataTypes[0]] ? p.accepts[p.dataTypes[0]] + ("*" !== p.dataTypes[0] ? ", " + Dn + "; q=0.01" : "") : p.accepts["*"]);
            for (i in p.headers) N.setRequestHeader(i, p.headers[i]);
            if (p.beforeSend && (p.beforeSend.call(f, N, p) === !1 || 2 === x)) return N.abort();
            T = "abort";
            for (i in{success: 1, error: 1, complete: 1}) N[i](p[i]);
            if (l = qn(jn, p, n, N)) {
                N.readyState = 1, u && d.trigger("ajaxSend", [N, p]), p.async && p.timeout > 0 && (s = setTimeout(function () {
                    N.abort("timeout")
                }, p.timeout));
                try {
                    x = 1, l.send(y, k)
                } catch (C) {
                    if (!(2 > x)) throw C;
                    k(-1, C)
                }
            } else k(-1, "No Transport");

            function k(e, n, r, i) {
                var c, y, v, w, T, C = n;
                2 !== x && (x = 2, s && clearTimeout(s), l = t, a = i || "", N.readyState = e > 0 ? 4 : 0, r && (w = _n(p, N, r)), e >= 200 && 300 > e || 304 === e ? (p.ifModified && (T = N.getResponseHeader("Last-Modified"), T && (b.lastModified[o] = T), T = N.getResponseHeader("etag"), T && (b.etag[o] = T)), 204 === e ? (c = !0, C = "nocontent") : 304 === e ? (c = !0, C = "notmodified") : (c = Fn(p, w), C = c.state, y = c.data, v = c.error, c = !v)) : (v = C, (e || !C) && (C = "error", 0 > e && (e = 0))), N.status = e, N.statusText = (n || C) + "", c ? h.resolveWith(f, [y, C, N]) : h.rejectWith(f, [N, C, v]), N.statusCode(m), m = t, u && d.trigger(c ? "ajaxSuccess" : "ajaxError", [N, p, c ? y : v]), g.fireWith(f, [N, C]), u && (d.trigger("ajaxComplete", [N, p]), --b.active || b.event.trigger("ajaxStop")))
            }

            return N
        },
        getScript: function (e, n) {
            return b.get(e, t, n, "script")
        },
        getJSON: function (e, t, n) {
            return b.get(e, t, n, "json")
        }
    });

    function _n(e, n, r) {
        var i, o, a, s, u = e.contents, l = e.dataTypes, c = e.responseFields;
        for (s in c) s in r && (n[c[s]] = r[s]);
        while ("*" === l[0]) l.shift(), o === t && (o = e.mimeType || n.getResponseHeader("Content-Type"));
        if (o) for (s in u) if (u[s] && u[s].test(o)) {
            l.unshift(s);
            break
        }
        if (l[0] in r) a = l[0]; else {
            for (s in r) {
                if (!l[0] || e.converters[s + " " + l[0]]) {
                    a = s;
                    break
                }
                i || (i = s)
            }
            a = a || i
        }
        return a ? (a !== l[0] && l.unshift(a), r[a]) : t
    }

    function Fn(e, t) {
        var n, r, i, o, a = {}, s = 0, u = e.dataTypes.slice(), l = u[0];
        if (e.dataFilter && (t = e.dataFilter(t, e.dataType)), u[1]) for (i in e.converters) a[i.toLowerCase()] = e.converters[i];
        for (; r = u[++s];) if ("*" !== r) {
            if ("*" !== l && l !== r) {
                if (i = a[l + " " + r] || a["* " + r], !i) for (n in a) if (o = n.split(" "), o[1] === r && (i = a[l + " " + o[0]] || a["* " + o[0]])) {
                    i === !0 ? i = a[n] : a[n] !== !0 && (r = o[0], u.splice(s--, 0, r));
                    break
                }
                if (i !== !0) if (i && e["throws"]) t = i(t); else try {
                    t = i(t)
                } catch (c) {
                    return {state: "parsererror", error: i ? c : "No conversion from " + l + " to " + r}
                }
            }
            l = r
        }
        return {state: "success", data: t}
    }

    b.ajaxSetup({
        accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
        contents: {script: /(?:java|ecma)script/},
        converters: {
            "text script": function (e) {
                return b.globalEval(e), e
            }
        }
    }), b.ajaxPrefilter("script", function (e) {
        e.cache === t && (e.cache = !1), e.crossDomain && (e.type = "GET", e.global = !1)
    }), b.ajaxTransport("script", function (e) {
        if (e.crossDomain) {
            var n, r = o.head || b("head")[0] || o.documentElement;
            return {
                send: function (t, i) {
                    n = o.createElement("script"), n.async = !0, e.scriptCharset && (n.charset = e.scriptCharset), n.src = e.url, n.onload = n.onreadystatechange = function (e, t) {
                        (t || !n.readyState || /loaded|complete/.test(n.readyState)) && (n.onload = n.onreadystatechange = null, n.parentNode && n.parentNode.removeChild(n), n = null, t || i(200, "success"))
                    }, r.insertBefore(n, r.firstChild)
                }, abort: function () {
                    n && n.onload(t, !0)
                }
            }
        }
    });
    var On = [], Bn = /(=)\?(?=&|$)|\?\?/;
    b.ajaxSetup({
        jsonp: "callback", jsonpCallback: function () {
            var e = On.pop() || b.expando + "_" + vn++;
            return this[e] = !0, e
        }
    }), b.ajaxPrefilter("json jsonp", function (n, r, i) {
        var o, a, s,
            u = n.jsonp !== !1 && (Bn.test(n.url) ? "url" : "string" == typeof n.data && !(n.contentType || "").indexOf("application/x-www-form-urlencoded") && Bn.test(n.data) && "data");
        return u || "jsonp" === n.dataTypes[0] ? (o = n.jsonpCallback = b.isFunction(n.jsonpCallback) ? n.jsonpCallback() : n.jsonpCallback, u ? n[u] = n[u].replace(Bn, "$1" + o) : n.jsonp !== !1 && (n.url += (bn.test(n.url) ? "&" : "?") + n.jsonp + "=" + o), n.converters["script json"] = function () {
            return s || b.error(o + " was not called"), s[0]
        }, n.dataTypes[0] = "json", a = e[o], e[o] = function () {
            s = arguments
        }, i.always(function () {
            e[o] = a, n[o] && (n.jsonpCallback = r.jsonpCallback, On.push(o)), s && b.isFunction(a) && a(s[0]), s = a = t
        }), "script") : t
    });
    var Pn, Rn, Wn = 0, $n = e.ActiveXObject && function () {
        var e;
        for (e in Pn) Pn[e](t, !0)
    };

    function In() {
        try {
            return new e.XMLHttpRequest
        } catch (t) {
        }
    }

    function zn() {
        try {
            return new e.ActiveXObject("Microsoft.XMLHTTP")
        } catch (t) {
        }
    }

    b.ajaxSettings.xhr = e.ActiveXObject ? function () {
        return !this.isLocal && In() || zn()
    } : In, Rn = b.ajaxSettings.xhr(), b.support.cors = !!Rn && "withCredentials" in Rn, Rn = b.support.ajax = !!Rn, Rn && b.ajaxTransport(function (n) {
        if (!n.crossDomain || b.support.cors) {
            var r;
            return {
                send: function (i, o) {
                    var a, s, u = n.xhr();
                    if (n.username ? u.open(n.type, n.url, n.async, n.username, n.password) : u.open(n.type, n.url, n.async), n.xhrFields) for (s in n.xhrFields) u[s] = n.xhrFields[s];
                    n.mimeType && u.overrideMimeType && u.overrideMimeType(n.mimeType), n.crossDomain || i["X-Requested-With"] || (i["X-Requested-With"] = "XMLHttpRequest");
                    try {
                        for (s in i) u.setRequestHeader(s, i[s])
                    } catch (l) {
                    }
                    u.send(n.hasContent && n.data || null), r = function (e, i) {
                        var s, l, c, p;
                        try {
                            if (r && (i || 4 === u.readyState)) if (r = t, a && (u.onreadystatechange = b.noop, $n && delete Pn[a]), i) 4 !== u.readyState && u.abort(); else {
                                p = {}, s = u.status, l = u.getAllResponseHeaders(), "string" == typeof u.responseText && (p.text = u.responseText);
                                try {
                                    c = u.statusText
                                } catch (f) {
                                    c = ""
                                }
                                s || !n.isLocal || n.crossDomain ? 1223 === s && (s = 204) : s = p.text ? 200 : 404
                            }
                        } catch (d) {
                            i || o(-1, d)
                        }
                        p && o(s, c, p, l)
                    }, n.async ? 4 === u.readyState ? setTimeout(r) : (a = ++Wn, $n && (Pn || (Pn = {}, b(e).unload($n)), Pn[a] = r), u.onreadystatechange = r) : r()
                }, abort: function () {
                    r && r(t, !0)
                }
            }
        }
    });
    var Xn, Un, Vn = /^(?:toggle|show|hide)$/, Yn = RegExp("^(?:([+-])=|)(" + x + ")([a-z%]*)$", "i"),
        Jn = /queueHooks$/, Gn = [nr], Qn = {
            "*": [function (e, t) {
                var n, r, i = this.createTween(e, t), o = Yn.exec(t), a = i.cur(), s = +a || 0, u = 1, l = 20;
                if (o) {
                    if (n = +o[2], r = o[3] || (b.cssNumber[e] ? "" : "px"), "px" !== r && s) {
                        s = b.css(i.elem, e, !0) || n || 1;
                        do u = u || ".5", s /= u, b.style(i.elem, e, s + r); while (u !== (u = i.cur() / a) && 1 !== u && --l)
                    }
                    i.unit = r, i.start = s, i.end = o[1] ? s + (o[1] + 1) * n : n
                }
                return i
            }]
        };

    function Kn() {
        return setTimeout(function () {
            Xn = t
        }), Xn = b.now()
    }

    function Zn(e, t) {
        b.each(t, function (t, n) {
            var r = (Qn[t] || []).concat(Qn["*"]), i = 0, o = r.length;
            for (; o > i; i++) if (r[i].call(e, t, n)) return
        })
    }

    function er(e, t, n) {
        var r, i, o = 0, a = Gn.length, s = b.Deferred().always(function () {
            delete u.elem
        }), u = function () {
            if (i) return !1;
            var t = Xn || Kn(), n = Math.max(0, l.startTime + l.duration - t), r = n / l.duration || 0, o = 1 - r,
                a = 0, u = l.tweens.length;
            for (; u > a; a++) l.tweens[a].run(o);
            return s.notifyWith(e, [l, o, n]), 1 > o && u ? n : (s.resolveWith(e, [l]), !1)
        }, l = s.promise({
            elem: e,
            props: b.extend({}, t),
            opts: b.extend(!0, {specialEasing: {}}, n),
            originalProperties: t,
            originalOptions: n,
            startTime: Xn || Kn(),
            duration: n.duration,
            tweens: [],
            createTween: function (t, n) {
                var r = b.Tween(e, l.opts, t, n, l.opts.specialEasing[t] || l.opts.easing);
                return l.tweens.push(r), r
            },
            stop: function (t) {
                var n = 0, r = t ? l.tweens.length : 0;
                if (i) return this;
                for (i = !0; r > n; n++) l.tweens[n].run(1);
                return t ? s.resolveWith(e, [l, t]) : s.rejectWith(e, [l, t]), this
            }
        }), c = l.props;
        for (tr(c, l.opts.specialEasing); a > o; o++) if (r = Gn[o].call(l, e, c, l.opts)) return r;
        return Zn(l, c), b.isFunction(l.opts.start) && l.opts.start.call(e, l), b.fx.timer(b.extend(u, {
            elem: e,
            anim: l,
            queue: l.opts.queue
        })), l.progress(l.opts.progress).done(l.opts.done, l.opts.complete).fail(l.opts.fail).always(l.opts.always)
    }

    function tr(e, t) {
        var n, r, i, o, a;
        for (i in e) if (r = b.camelCase(i), o = t[r], n = e[i], b.isArray(n) && (o = n[1], n = e[i] = n[0]), i !== r && (e[r] = n, delete e[i]), a = b.cssHooks[r], a && "expand" in a) {
            n = a.expand(n), delete e[r];
            for (i in n) i in e || (e[i] = n[i], t[i] = o)
        } else t[r] = o
    }

    b.Animation = b.extend(er, {
        tweener: function (e, t) {
            b.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" ");
            var n, r = 0, i = e.length;
            for (; i > r; r++) n = e[r], Qn[n] = Qn[n] || [], Qn[n].unshift(t)
        }, prefilter: function (e, t) {
            t ? Gn.unshift(e) : Gn.push(e)
        }
    });

    function nr(e, t, n) {
        var r, i, o, a, s, u, l, c, p, f = this, d = e.style, h = {}, g = [], m = e.nodeType && nn(e);
        n.queue || (c = b._queueHooks(e, "fx"), null == c.unqueued && (c.unqueued = 0, p = c.empty.fire, c.empty.fire = function () {
            c.unqueued || p()
        }), c.unqueued++, f.always(function () {
            f.always(function () {
                c.unqueued--, b.queue(e, "fx").length || c.empty.fire()
            })
        })), 1 === e.nodeType && ("height" in t || "width" in t) && (n.overflow = [d.overflow, d.overflowX, d.overflowY], "inline" === b.css(e, "display") && "none" === b.css(e, "float") && (b.support.inlineBlockNeedsLayout && "inline" !== un(e.nodeName) ? d.zoom = 1 : d.display = "inline-block")), n.overflow && (d.overflow = "hidden", b.support.shrinkWrapBlocks || f.always(function () {
            d.overflow = n.overflow[0], d.overflowX = n.overflow[1], d.overflowY = n.overflow[2]
        }));
        for (i in t) if (a = t[i], Vn.exec(a)) {
            if (delete t[i], u = u || "toggle" === a, a === (m ? "hide" : "show")) continue;
            g.push(i)
        }
        if (o = g.length) {
            s = b._data(e, "fxshow") || b._data(e, "fxshow", {}), "hidden" in s && (m = s.hidden), u && (s.hidden = !m), m ? b(e).show() : f.done(function () {
                b(e).hide()
            }), f.done(function () {
                var t;
                b._removeData(e, "fxshow");
                for (t in h) b.style(e, t, h[t])
            });
            for (i = 0; o > i; i++) r = g[i], l = f.createTween(r, m ? s[r] : 0), h[r] = s[r] || b.style(e, r), r in s || (s[r] = l.start, m && (l.end = l.start, l.start = "width" === r || "height" === r ? 1 : 0))
        }
    }

    function rr(e, t, n, r, i) {
        return new rr.prototype.init(e, t, n, r, i)
    }

    b.Tween = rr, rr.prototype = {
        constructor: rr, init: function (e, t, n, r, i, o) {
            this.elem = e, this.prop = n, this.easing = i || "swing", this.options = t, this.start = this.now = this.cur(), this.end = r, this.unit = o || (b.cssNumber[n] ? "" : "px")
        }, cur: function () {
            var e = rr.propHooks[this.prop];
            return e && e.get ? e.get(this) : rr.propHooks._default.get(this)
        }, run: function (e) {
            var t, n = rr.propHooks[this.prop];
            return this.pos = t = this.options.duration ? b.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : rr.propHooks._default.set(this), this
        }
    }, rr.prototype.init.prototype = rr.prototype, rr.propHooks = {
        _default: {
            get: function (e) {
                var t;
                return null == e.elem[e.prop] || e.elem.style && null != e.elem.style[e.prop] ? (t = b.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0) : e.elem[e.prop]
            }, set: function (e) {
                b.fx.step[e.prop] ? b.fx.step[e.prop](e) : e.elem.style && (null != e.elem.style[b.cssProps[e.prop]] || b.cssHooks[e.prop]) ? b.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now
            }
        }
    }, rr.propHooks.scrollTop = rr.propHooks.scrollLeft = {
        set: function (e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
        }
    }, b.each(["toggle", "show", "hide"], function (e, t) {
        var n = b.fn[t];
        b.fn[t] = function (e, r, i) {
            return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(ir(t, !0), e, r, i)
        }
    }), b.fn.extend({
        fadeTo: function (e, t, n, r) {
            return this.filter(nn).css("opacity", 0).show().end().animate({opacity: t}, e, n, r)
        }, animate: function (e, t, n, r) {
            var i = b.isEmptyObject(e), o = b.speed(t, n, r), a = function () {
                var t = er(this, b.extend({}, e), o);
                a.finish = function () {
                    t.stop(!0)
                }, (i || b._data(this, "finish")) && t.stop(!0)
            };
            return a.finish = a, i || o.queue === !1 ? this.each(a) : this.queue(o.queue, a)
        }, stop: function (e, n, r) {
            var i = function (e) {
                var t = e.stop;
                delete e.stop, t(r)
            };
            return "string" != typeof e && (r = n, n = e, e = t), n && e !== !1 && this.queue(e || "fx", []), this.each(function () {
                var t = !0, n = null != e && e + "queueHooks", o = b.timers, a = b._data(this);
                if (n) a[n] && a[n].stop && i(a[n]); else for (n in a) a[n] && a[n].stop && Jn.test(n) && i(a[n]);
                for (n = o.length; n--;) o[n].elem !== this || null != e && o[n].queue !== e || (o[n].anim.stop(r), t = !1, o.splice(n, 1));
                (t || !r) && b.dequeue(this, e)
            })
        }, finish: function (e) {
            return e !== !1 && (e = e || "fx"), this.each(function () {
                var t, n = b._data(this), r = n[e + "queue"], i = n[e + "queueHooks"], o = b.timers,
                    a = r ? r.length : 0;
                for (n.finish = !0, b.queue(this, e, []), i && i.cur && i.cur.finish && i.cur.finish.call(this), t = o.length; t--;) o[t].elem === this && o[t].queue === e && (o[t].anim.stop(!0), o.splice(t, 1));
                for (t = 0; a > t; t++) r[t] && r[t].finish && r[t].finish.call(this);
                delete n.finish
            })
        }
    });

    function ir(e, t) {
        var n, r = {height: e}, i = 0;
        for (t = t ? 1 : 0; 4 > i; i += 2 - t) n = Zt[i], r["margin" + n] = r["padding" + n] = e;
        return t && (r.opacity = r.width = e), r
    }

    b.each({
        slideDown: ir("show"),
        slideUp: ir("hide"),
        slideToggle: ir("toggle"),
        fadeIn: {opacity: "show"},
        fadeOut: {opacity: "hide"},
        fadeToggle: {opacity: "toggle"}
    }, function (e, t) {
        b.fn[e] = function (e, n, r) {
            return this.animate(t, e, n, r)
        }
    }), b.speed = function (e, t, n) {
        var r = e && "object" == typeof e ? b.extend({}, e) : {
            complete: n || !n && t || b.isFunction(e) && e,
            duration: e,
            easing: n && t || t && !b.isFunction(t) && t
        };
        return r.duration = b.fx.off ? 0 : "number" == typeof r.duration ? r.duration : r.duration in b.fx.speeds ? b.fx.speeds[r.duration] : b.fx.speeds._default, (null == r.queue || r.queue === !0) && (r.queue = "fx"), r.old = r.complete, r.complete = function () {
            b.isFunction(r.old) && r.old.call(this), r.queue && b.dequeue(this, r.queue)
        }, r
    }, b.easing = {
        linear: function (e) {
            return e
        }, swing: function (e) {
            return .5 - Math.cos(e * Math.PI) / 2
        }
    }, b.timers = [], b.fx = rr.prototype.init, b.fx.tick = function () {
        var e, n = b.timers, r = 0;
        for (Xn = b.now(); n.length > r; r++) e = n[r], e() || n[r] !== e || n.splice(r--, 1);
        n.length || b.fx.stop(), Xn = t
    }, b.fx.timer = function (e) {
        e() && b.timers.push(e) && b.fx.start()
    }, b.fx.interval = 13, b.fx.start = function () {
        Un || (Un = setInterval(b.fx.tick, b.fx.interval))
    }, b.fx.stop = function () {
        clearInterval(Un), Un = null
    }, b.fx.speeds = {
        slow: 600,
        fast: 200,
        _default: 400
    }, b.fx.step = {}, b.expr && b.expr.filters && (b.expr.filters.animated = function (e) {
        return b.grep(b.timers, function (t) {
            return e === t.elem
        }).length
    }), b.fn.offset = function (e) {
        if (arguments.length) return e === t ? this : this.each(function (t) {
            b.offset.setOffset(this, e, t)
        });
        var n, r, o = {top: 0, left: 0}, a = this[0], s = a && a.ownerDocument;
        if (s) return n = s.documentElement, b.contains(n, a) ? (typeof a.getBoundingClientRect !== i && (o = a.getBoundingClientRect()), r = or(s), {
            top: o.top + (r.pageYOffset || n.scrollTop) - (n.clientTop || 0),
            left: o.left + (r.pageXOffset || n.scrollLeft) - (n.clientLeft || 0)
        }) : o
    }, b.offset = {
        setOffset: function (e, t, n) {
            var r = b.css(e, "position");
            "static" === r && (e.style.position = "relative");
            var i = b(e), o = i.offset(), a = b.css(e, "top"), s = b.css(e, "left"),
                u = ("absolute" === r || "fixed" === r) && b.inArray("auto", [a, s]) > -1, l = {}, c = {}, p, f;
            u ? (c = i.position(), p = c.top, f = c.left) : (p = parseFloat(a) || 0, f = parseFloat(s) || 0), b.isFunction(t) && (t = t.call(e, n, o)), null != t.top && (l.top = t.top - o.top + p), null != t.left && (l.left = t.left - o.left + f), "using" in t ? t.using.call(e, l) : i.css(l)
        }
    }, b.fn.extend({
        position: function () {
            if (this[0]) {
                var e, t, n = {top: 0, left: 0}, r = this[0];
                return "fixed" === b.css(r, "position") ? t = r.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), b.nodeName(e[0], "html") || (n = e.offset()), n.top += b.css(e[0], "borderTopWidth", !0), n.left += b.css(e[0], "borderLeftWidth", !0)), {
                    top: t.top - n.top - b.css(r, "marginTop", !0),
                    left: t.left - n.left - b.css(r, "marginLeft", !0)
                }
            }
        }, offsetParent: function () {
            return this.map(function () {
                var e = this.offsetParent || o.documentElement;
                while (e && !b.nodeName(e, "html") && "static" === b.css(e, "position")) e = e.offsetParent;
                return e || o.documentElement
            })
        }
    }), b.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (e, n) {
        var r = /Y/.test(n);
        b.fn[e] = function (i) {
            return b.access(this, function (e, i, o) {
                var a = or(e);
                return o === t ? a ? n in a ? a[n] : a.document.documentElement[i] : e[i] : (a ? a.scrollTo(r ? b(a).scrollLeft() : o, r ? o : b(a).scrollTop()) : e[i] = o, t)
            }, e, i, arguments.length, null)
        }
    });

    function or(e) {
        return b.isWindow(e) ? e : 9 === e.nodeType ? e.defaultView || e.parentWindow : !1
    }

    b.each({Height: "height", Width: "width"}, function (e, n) {
        b.each({padding: "inner" + e, content: n, "": "outer" + e}, function (r, i) {
            b.fn[i] = function (i, o) {
                var a = arguments.length && (r || "boolean" != typeof i),
                    s = r || (i === !0 || o === !0 ? "margin" : "border");
                return b.access(this, function (n, r, i) {
                    var o;
                    return b.isWindow(n) ? n.document.documentElement["client" + e] : 9 === n.nodeType ? (o = n.documentElement, Math.max(n.body["scroll" + e], o["scroll" + e], n.body["offset" + e], o["offset" + e], o["client" + e])) : i === t ? b.css(n, r, s) : b.style(n, r, i, s)
                }, n, a ? i : t, a, null)
            }
        })
    }), e.jQuery = e.$ = b, "function" == typeof define && define.amd && define.amd.jQuery && define("jquery", [], function () {
        return b
    })
})(window);
/*!
 * Bootstrap v3.3.7 (http://getbootstrap.com)
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under the MIT license
 */
if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");
+function (a) {
    "use strict";
    var b = a.fn.jquery.split(" ")[0].split(".");
    if (b[0] < 2 && b[1] < 9 || 1 == b[0] && 9 == b[1] && b[2] < 1 || b[0] > 3) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4")
}(jQuery), +function (a) {
    "use strict";

    function b() {
        var a = document.createElement("bootstrap"), b = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            transition: "transitionend"
        };
        for (var c in b) if (void 0 !== a.style[c]) return {end: b[c]};
        return !1
    }

    a.fn.emulateTransitionEnd = function (b) {
        var c = !1, d = this;
        a(this).one("bsTransitionEnd", function () {
            c = !0
        });
        var e = function () {
            c || a(d).trigger(a.support.transition.end)
        };
        return setTimeout(e, b), this
    }, a(function () {
        a.support.transition = b(), a.support.transition && (a.event.special.bsTransitionEnd = {
            bindType: a.support.transition.end,
            delegateType: a.support.transition.end,
            handle: function (b) {
                if (a(b.target).is(this)) return b.handleObj.handler.apply(this, arguments)
            }
        })
    })
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var c = a(this), e = c.data("bs.alert");
            e || c.data("bs.alert", e = new d(this)), "string" == typeof b && e[b].call(c)
        })
    }

    var c = '[data-dismiss="alert"]', d = function (b) {
        a(b).on("click", c, this.close)
    };
    d.VERSION = "3.3.7", d.TRANSITION_DURATION = 150, d.prototype.close = function (b) {
        function c() {
            g.detach().trigger("closed.bs.alert").remove()
        }

        var e = a(this), f = e.attr("data-target");
        f || (f = e.attr("href"), f = f && f.replace(/.*(?=#[^\s]*$)/, ""));
        var g = a("#" === f ? [] : f);
        b && b.preventDefault(), g.length || (g = e.closest(".alert")), g.trigger(b = a.Event("close.bs.alert")), b.isDefaultPrevented() || (g.removeClass("in"), a.support.transition && g.hasClass("fade") ? g.one("bsTransitionEnd", c).emulateTransitionEnd(d.TRANSITION_DURATION) : c())
    };
    var e = a.fn.alert;
    a.fn.alert = b, a.fn.alert.Constructor = d, a.fn.alert.noConflict = function () {
        return a.fn.alert = e, this
    }, a(document).on("click.bs.alert.data-api", c, d.prototype.close)
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.button"), f = "object" == typeof b && b;
            e || d.data("bs.button", e = new c(this, f)), "toggle" == b ? e.toggle() : b && e.setState(b)
        })
    }

    var c = function (b, d) {
        this.$element = a(b), this.options = a.extend({}, c.DEFAULTS, d), this.isLoading = !1
    };
    c.VERSION = "3.3.7", c.DEFAULTS = {loadingText: "loading..."}, c.prototype.setState = function (b) {
        var c = "disabled", d = this.$element, e = d.is("input") ? "val" : "html", f = d.data();
        b += "Text", null == f.resetText && d.data("resetText", d[e]()), setTimeout(a.proxy(function () {
            d[e](null == f[b] ? this.options[b] : f[b]), "loadingText" == b ? (this.isLoading = !0, d.addClass(c).attr(c, c).prop(c, !0)) : this.isLoading && (this.isLoading = !1, d.removeClass(c).removeAttr(c).prop(c, !1))
        }, this), 0)
    }, c.prototype.toggle = function () {
        var a = !0, b = this.$element.closest('[data-toggle="buttons"]');
        if (b.length) {
            var c = this.$element.find("input");
            "radio" == c.prop("type") ? (c.prop("checked") && (a = !1), b.find(".active").removeClass("active"), this.$element.addClass("active")) : "checkbox" == c.prop("type") && (c.prop("checked") !== this.$element.hasClass("active") && (a = !1), this.$element.toggleClass("active")), c.prop("checked", this.$element.hasClass("active")), a && c.trigger("change")
        } else this.$element.attr("aria-pressed", !this.$element.hasClass("active")), this.$element.toggleClass("active")
    };
    var d = a.fn.button;
    a.fn.button = b, a.fn.button.Constructor = c, a.fn.button.noConflict = function () {
        return a.fn.button = d, this
    }, a(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function (c) {
        var d = a(c.target).closest(".btn");
        b.call(d, "toggle"), a(c.target).is('input[type="radio"], input[type="checkbox"]') || (c.preventDefault(), d.is("input,button") ? d.trigger("focus") : d.find("input:visible,button:visible").first().trigger("focus"))
    }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function (b) {
        a(b.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(b.type))
    })
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.carousel"),
                f = a.extend({}, c.DEFAULTS, d.data(), "object" == typeof b && b),
                g = "string" == typeof b ? b : f.slide;
            e || d.data("bs.carousel", e = new c(this, f)), "number" == typeof b ? e.to(b) : g ? e[g]() : f.interval && e.pause().cycle()
        })
    }

    var c = function (b, c) {
        this.$element = a(b), this.$indicators = this.$element.find(".carousel-indicators"), this.options = c, this.paused = null, this.sliding = null, this.interval = null, this.$active = null, this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", a.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", a.proxy(this.pause, this)).on("mouseleave.bs.carousel", a.proxy(this.cycle, this))
    };
    c.VERSION = "3.3.7", c.TRANSITION_DURATION = 600, c.DEFAULTS = {
        interval: 5e3,
        pause: "hover",
        wrap: !0,
        keyboard: !0
    }, c.prototype.keydown = function (a) {
        if (!/input|textarea/i.test(a.target.tagName)) {
            switch (a.which) {
                case 37:
                    this.prev();
                    break;
                case 39:
                    this.next();
                    break;
                default:
                    return
            }
            a.preventDefault()
        }
    }, c.prototype.cycle = function (b) {
        return b || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(a.proxy(this.next, this), this.options.interval)), this
    }, c.prototype.getItemIndex = function (a) {
        return this.$items = a.parent().children(".item"), this.$items.index(a || this.$active)
    }, c.prototype.getItemForDirection = function (a, b) {
        var c = this.getItemIndex(b), d = "prev" == a && 0 === c || "next" == a && c == this.$items.length - 1;
        if (d && !this.options.wrap) return b;
        var e = "prev" == a ? -1 : 1, f = (c + e) % this.$items.length;
        return this.$items.eq(f)
    }, c.prototype.to = function (a) {
        var b = this, c = this.getItemIndex(this.$active = this.$element.find(".item.active"));
        if (!(a > this.$items.length - 1 || a < 0)) return this.sliding ? this.$element.one("slid.bs.carousel", function () {
            b.to(a)
        }) : c == a ? this.pause().cycle() : this.slide(a > c ? "next" : "prev", this.$items.eq(a))
    }, c.prototype.pause = function (b) {
        return b || (this.paused = !0), this.$element.find(".next, .prev").length && a.support.transition && (this.$element.trigger(a.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
    }, c.prototype.next = function () {
        if (!this.sliding) return this.slide("next")
    }, c.prototype.prev = function () {
        if (!this.sliding) return this.slide("prev")
    }, c.prototype.slide = function (b, d) {
        var e = this.$element.find(".item.active"), f = d || this.getItemForDirection(b, e), g = this.interval,
            h = "next" == b ? "left" : "right", i = this;
        if (f.hasClass("active")) return this.sliding = !1;
        var j = f[0], k = a.Event("slide.bs.carousel", {relatedTarget: j, direction: h});
        if (this.$element.trigger(k), !k.isDefaultPrevented()) {
            if (this.sliding = !0, g && this.pause(), this.$indicators.length) {
                this.$indicators.find(".active").removeClass("active");
                var l = a(this.$indicators.children()[this.getItemIndex(f)]);
                l && l.addClass("active")
            }
            var m = a.Event("slid.bs.carousel", {relatedTarget: j, direction: h});
            return a.support.transition && this.$element.hasClass("slide") ? (f.addClass(b), f[0].offsetWidth, e.addClass(h), f.addClass(h), e.one("bsTransitionEnd", function () {
                f.removeClass([b, h].join(" ")).addClass("active"), e.removeClass(["active", h].join(" ")), i.sliding = !1, setTimeout(function () {
                    i.$element.trigger(m)
                }, 0)
            }).emulateTransitionEnd(c.TRANSITION_DURATION)) : (e.removeClass("active"), f.addClass("active"), this.sliding = !1, this.$element.trigger(m)), g && this.cycle(), this
        }
    };
    var d = a.fn.carousel;
    a.fn.carousel = b, a.fn.carousel.Constructor = c, a.fn.carousel.noConflict = function () {
        return a.fn.carousel = d, this
    };
    var e = function (c) {
        var d, e = a(this), f = a(e.attr("data-target") || (d = e.attr("href")) && d.replace(/.*(?=#[^\s]+$)/, ""));
        if (f.hasClass("carousel")) {
            var g = a.extend({}, f.data(), e.data()), h = e.attr("data-slide-to");
            h && (g.interval = !1), b.call(f, g), h && f.data("bs.carousel").to(h), c.preventDefault()
        }
    };
    a(document).on("click.bs.carousel.data-api", "[data-slide]", e).on("click.bs.carousel.data-api", "[data-slide-to]", e), a(window).on("load", function () {
        a('[data-ride="carousel"]').each(function () {
            var c = a(this);
            b.call(c, c.data())
        })
    })
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        var c, d = b.attr("data-target") || (c = b.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, "");
        return a(d)
    }

    function c(b) {
        return this.each(function () {
            var c = a(this), e = c.data("bs.collapse"),
                f = a.extend({}, d.DEFAULTS, c.data(), "object" == typeof b && b);
            !e && f.toggle && /show|hide/.test(b) && (f.toggle = !1), e || c.data("bs.collapse", e = new d(this, f)), "string" == typeof b && e[b]()
        })
    }

    var d = function (b, c) {
        this.$element = a(b), this.options = a.extend({}, d.DEFAULTS, c), this.$trigger = a('[data-toggle="collapse"][href="#' + b.id + '"],[data-toggle="collapse"][data-target="#' + b.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
    };
    d.VERSION = "3.3.7", d.TRANSITION_DURATION = 350, d.DEFAULTS = {toggle: !0}, d.prototype.dimension = function () {
        var a = this.$element.hasClass("width");
        return a ? "width" : "height"
    }, d.prototype.show = function () {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var b, e = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
            if (!(e && e.length && (b = e.data("bs.collapse"), b && b.transitioning))) {
                var f = a.Event("show.bs.collapse");
                if (this.$element.trigger(f), !f.isDefaultPrevented()) {
                    e && e.length && (c.call(e, "hide"), b || e.data("bs.collapse", null));
                    var g = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                    var h = function () {
                        this.$element.removeClass("collapsing").addClass("collapse in")[g](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                    };
                    if (!a.support.transition) return h.call(this);
                    var i = a.camelCase(["scroll", g].join("-"));
                    this.$element.one("bsTransitionEnd", a.proxy(h, this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])
                }
            }
        }
    }, d.prototype.hide = function () {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var b = a.Event("hide.bs.collapse");
            if (this.$element.trigger(b), !b.isDefaultPrevented()) {
                var c = this.dimension();
                this.$element[c](this.$element[c]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                var e = function () {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
                };
                return a.support.transition ? void this.$element[c](0).one("bsTransitionEnd", a.proxy(e, this)).emulateTransitionEnd(d.TRANSITION_DURATION) : e.call(this)
            }
        }
    }, d.prototype.toggle = function () {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, d.prototype.getParent = function () {
        return a(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(a.proxy(function (c, d) {
            var e = a(d);
            this.addAriaAndCollapsedClass(b(e), e)
        }, this)).end()
    }, d.prototype.addAriaAndCollapsedClass = function (a, b) {
        var c = a.hasClass("in");
        a.attr("aria-expanded", c), b.toggleClass("collapsed", !c).attr("aria-expanded", c)
    };
    var e = a.fn.collapse;
    a.fn.collapse = c, a.fn.collapse.Constructor = d, a.fn.collapse.noConflict = function () {
        return a.fn.collapse = e, this
    }, a(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function (d) {
        var e = a(this);
        e.attr("data-target") || d.preventDefault();
        var f = b(e), g = f.data("bs.collapse"), h = g ? "toggle" : e.data();
        c.call(f, h)
    })
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        var c = b.attr("data-target");
        c || (c = b.attr("href"), c = c && /#[A-Za-z]/.test(c) && c.replace(/.*(?=#[^\s]*$)/, ""));
        var d = c && a(c);
        return d && d.length ? d : b.parent()
    }

    function c(c) {
        c && 3 === c.which || (a(e).remove(), a(f).each(function () {
            var d = a(this), e = b(d), f = {relatedTarget: this};
            e.hasClass("open") && (c && "click" == c.type && /input|textarea/i.test(c.target.tagName) && a.contains(e[0], c.target) || (e.trigger(c = a.Event("hide.bs.dropdown", f)), c.isDefaultPrevented() || (d.attr("aria-expanded", "false"), e.removeClass("open").trigger(a.Event("hidden.bs.dropdown", f)))))
        }))
    }

    function d(b) {
        return this.each(function () {
            var c = a(this), d = c.data("bs.dropdown");
            d || c.data("bs.dropdown", d = new g(this)), "string" == typeof b && d[b].call(c)
        })
    }

    var e = ".dropdown-backdrop", f = '[data-toggle="dropdown"]', g = function (b) {
        a(b).on("click.bs.dropdown", this.toggle)
    };
    g.VERSION = "3.3.7", g.prototype.toggle = function (d) {
        var e = a(this);
        if (!e.is(".disabled, :disabled")) {
            var f = b(e), g = f.hasClass("open");
            if (c(), !g) {
                "ontouchstart" in document.documentElement && !f.closest(".navbar-nav").length && a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click", c);
                var h = {relatedTarget: this};
                if (f.trigger(d = a.Event("show.bs.dropdown", h)), d.isDefaultPrevented()) return;
                e.trigger("focus").attr("aria-expanded", "true"), f.toggleClass("open").trigger(a.Event("shown.bs.dropdown", h))
            }
            return !1
        }
    }, g.prototype.keydown = function (c) {
        if (/(38|40|27|32)/.test(c.which) && !/input|textarea/i.test(c.target.tagName)) {
            var d = a(this);
            if (c.preventDefault(), c.stopPropagation(), !d.is(".disabled, :disabled")) {
                var e = b(d), g = e.hasClass("open");
                if (!g && 27 != c.which || g && 27 == c.which) return 27 == c.which && e.find(f).trigger("focus"), d.trigger("click");
                var h = " li:not(.disabled):visible a", i = e.find(".dropdown-menu" + h);
                if (i.length) {
                    var j = i.index(c.target);
                    38 == c.which && j > 0 && j--, 40 == c.which && j < i.length - 1 && j++, ~j || (j = 0), i.eq(j).trigger("focus")
                }
            }
        }
    };
    var h = a.fn.dropdown;
    a.fn.dropdown = d, a.fn.dropdown.Constructor = g, a.fn.dropdown.noConflict = function () {
        return a.fn.dropdown = h, this
    }, a(document).on("click.bs.dropdown.data-api", c).on("click.bs.dropdown.data-api", ".dropdown form", function (a) {
        a.stopPropagation()
    }).on("click.bs.dropdown.data-api", f, g.prototype.toggle).on("keydown.bs.dropdown.data-api", f, g.prototype.keydown).on("keydown.bs.dropdown.data-api", ".dropdown-menu", g.prototype.keydown)
}(jQuery), +function (a) {
    "use strict";

    function b(b, d) {
        return this.each(function () {
            var e = a(this), f = e.data("bs.modal"), g = a.extend({}, c.DEFAULTS, e.data(), "object" == typeof b && b);
            f || e.data("bs.modal", f = new c(this, g)), "string" == typeof b ? f[b](d) : g.show && f.show(d)
        })
    }

    var c = function (b, c) {
        this.options = c, this.$body = a(document.body), this.$element = a(b), this.$dialog = this.$element.find(".modal-dialog"), this.$backdrop = null, this.isShown = null, this.originalBodyPad = null, this.scrollbarWidth = 0, this.ignoreBackdropClick = !1, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, a.proxy(function () {
            this.$element.trigger("loaded.bs.modal")
        }, this))
    };
    c.VERSION = "3.3.7", c.TRANSITION_DURATION = 300, c.BACKDROP_TRANSITION_DURATION = 150, c.DEFAULTS = {
        backdrop: !0,
        keyboard: !0,
        show: !0
    }, c.prototype.toggle = function (a) {
        return this.isShown ? this.hide() : this.show(a)
    }, c.prototype.show = function (b) {
        var d = this, e = a.Event("show.bs.modal", {relatedTarget: b});
        this.$element.trigger(e), this.isShown || e.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', a.proxy(this.hide, this)), this.$dialog.on("mousedown.dismiss.bs.modal", function () {
            d.$element.one("mouseup.dismiss.bs.modal", function (b) {
                a(b.target).is(d.$element) && (d.ignoreBackdropClick = !0)
            })
        }), this.backdrop(function () {
            var e = a.support.transition && d.$element.hasClass("fade");
            d.$element.parent().length || d.$element.appendTo(d.$body), d.$element.show().scrollTop(0), d.adjustDialog(), e && d.$element[0].offsetWidth, d.$element.addClass("in"), d.enforceFocus();
            var f = a.Event("shown.bs.modal", {relatedTarget: b});
            e ? d.$dialog.one("bsTransitionEnd", function () {
                d.$element.trigger("focus").trigger(f)
            }).emulateTransitionEnd(c.TRANSITION_DURATION) : d.$element.trigger("focus").trigger(f)
        }))
    }, c.prototype.hide = function (b) {
        b && b.preventDefault(), b = a.Event("hide.bs.modal"), this.$element.trigger(b), this.isShown && !b.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), a(document).off("focusin.bs.modal"), this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"), this.$dialog.off("mousedown.dismiss.bs.modal"), a.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", a.proxy(this.hideModal, this)).emulateTransitionEnd(c.TRANSITION_DURATION) : this.hideModal())
    }, c.prototype.enforceFocus = function () {
        a(document).off("focusin.bs.modal").on("focusin.bs.modal", a.proxy(function (a) {
            document === a.target || this.$element[0] === a.target || this.$element.has(a.target).length || this.$element.trigger("focus")
        }, this))
    }, c.prototype.escape = function () {
        this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", a.proxy(function (a) {
            27 == a.which && this.hide()
        }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal")
    }, c.prototype.resize = function () {
        this.isShown ? a(window).on("resize.bs.modal", a.proxy(this.handleUpdate, this)) : a(window).off("resize.bs.modal")
    }, c.prototype.hideModal = function () {
        var a = this;
        this.$element.hide(), this.backdrop(function () {
            a.$body.removeClass("modal-open"), a.resetAdjustments(), a.resetScrollbar(), a.$element.trigger("hidden.bs.modal")
        })
    }, c.prototype.removeBackdrop = function () {
        this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
    }, c.prototype.backdrop = function (b) {
        var d = this, e = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
            var f = a.support.transition && e;
            if (this.$backdrop = a(document.createElement("div")).addClass("modal-backdrop " + e).appendTo(this.$body), this.$element.on("click.dismiss.bs.modal", a.proxy(function (a) {
                return this.ignoreBackdropClick ? void (this.ignoreBackdropClick = !1) : void (a.target === a.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus() : this.hide()))
            }, this)), f && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !b) return;
            f ? this.$backdrop.one("bsTransitionEnd", b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : b()
        } else if (!this.isShown && this.$backdrop) {
            this.$backdrop.removeClass("in");
            var g = function () {
                d.removeBackdrop(), b && b()
            };
            a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : g()
        } else b && b()
    }, c.prototype.handleUpdate = function () {
        this.adjustDialog()
    }, c.prototype.adjustDialog = function () {
        var a = this.$element[0].scrollHeight > document.documentElement.clientHeight;
        this.$element.css({
            paddingLeft: !this.bodyIsOverflowing && a ? this.scrollbarWidth : "",
            paddingRight: this.bodyIsOverflowing && !a ? this.scrollbarWidth : ""
        })
    }, c.prototype.resetAdjustments = function () {
        this.$element.css({paddingLeft: "", paddingRight: ""})
    }, c.prototype.checkScrollbar = function () {
        var a = window.innerWidth;
        if (!a) {
            var b = document.documentElement.getBoundingClientRect();
            a = b.right - Math.abs(b.left)
        }
        this.bodyIsOverflowing = document.body.clientWidth < a, this.scrollbarWidth = this.measureScrollbar()
    }, c.prototype.setScrollbar = function () {
        var a = parseInt(this.$body.css("padding-right") || 0, 10);
        this.originalBodyPad = document.body.style.paddingRight || "", this.bodyIsOverflowing && this.$body.css("padding-right", a + this.scrollbarWidth)
    }, c.prototype.resetScrollbar = function () {
        this.$body.css("padding-right", this.originalBodyPad)
    }, c.prototype.measureScrollbar = function () {
        var a = document.createElement("div");
        a.className = "modal-scrollbar-measure", this.$body.append(a);
        var b = a.offsetWidth - a.clientWidth;
        return this.$body[0].removeChild(a), b
    };
    var d = a.fn.modal;
    a.fn.modal = b, a.fn.modal.Constructor = c, a.fn.modal.noConflict = function () {
        return a.fn.modal = d, this
    }, a(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (c) {
        var d = a(this), e = d.attr("href"), f = a(d.attr("data-target") || e && e.replace(/.*(?=#[^\s]+$)/, "")),
            g = f.data("bs.modal") ? "toggle" : a.extend({remote: !/#/.test(e) && e}, f.data(), d.data());
        d.is("a") && c.preventDefault(), f.one("show.bs.modal", function (a) {
            a.isDefaultPrevented() || f.one("hidden.bs.modal", function () {
                d.is(":visible") && d.trigger("focus")
            })
        }), b.call(f, g, this)
    })
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.tooltip"), f = "object" == typeof b && b;
            !e && /destroy|hide/.test(b) || (e || d.data("bs.tooltip", e = new c(this, f)), "string" == typeof b && e[b]())
        })
    }

    var c = function (a, b) {
        this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.inState = null, this.init("tooltip", a, b)
    };
    c.VERSION = "3.3.7", c.TRANSITION_DURATION = 150, c.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1,
        viewport: {selector: "body", padding: 0}
    }, c.prototype.init = function (b, c, d) {
        if (this.enabled = !0, this.type = b, this.$element = a(c), this.options = this.getOptions(d), this.$viewport = this.options.viewport && a(a.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport), this.inState = {
            click: !1,
            hover: !1,
            focus: !1
        }, this.$element[0] instanceof document.constructor && !this.options.selector) throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
        for (var e = this.options.trigger.split(" "), f = e.length; f--;) {
            var g = e[f];
            if ("click" == g) this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this)); else if ("manual" != g) {
                var h = "hover" == g ? "mouseenter" : "focusin", i = "hover" == g ? "mouseleave" : "focusout";
                this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter, this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(this.leave, this))
            }
        }
        this.options.selector ? this._options = a.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle()
    }, c.prototype.getDefaults = function () {
        return c.DEFAULTS
    }, c.prototype.getOptions = function (b) {
        return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay && "number" == typeof b.delay && (b.delay = {
            show: b.delay,
            hide: b.delay
        }), b
    }, c.prototype.getDelegateOptions = function () {
        var b = {}, c = this.getDefaults();
        return this._options && a.each(this._options, function (a, d) {
            c[a] != d && (b[a] = d)
        }), b
    }, c.prototype.enter = function (b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
        return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), b instanceof a.Event && (c.inState["focusin" == b.type ? "focus" : "hover"] = !0), c.tip().hasClass("in") || "in" == c.hoverState ? void (c.hoverState = "in") : (clearTimeout(c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ? void (c.timeout = setTimeout(function () {
            "in" == c.hoverState && c.show()
        }, c.options.delay.show)) : c.show())
    }, c.prototype.isInStateTrue = function () {
        for (var a in this.inState) if (this.inState[a]) return !0;
        return !1
    }, c.prototype.leave = function (b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
        if (c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), b instanceof a.Event && (c.inState["focusout" == b.type ? "focus" : "hover"] = !1), !c.isInStateTrue()) return clearTimeout(c.timeout), c.hoverState = "out", c.options.delay && c.options.delay.hide ? void (c.timeout = setTimeout(function () {
            "out" == c.hoverState && c.hide()
        }, c.options.delay.hide)) : c.hide()
    }, c.prototype.show = function () {
        var b = a.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            this.$element.trigger(b);
            var d = a.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
            if (b.isDefaultPrevented() || !d) return;
            var e = this, f = this.tip(), g = this.getUID(this.type);
            this.setContent(), f.attr("id", g), this.$element.attr("aria-describedby", g), this.options.animation && f.addClass("fade");
            var h = "function" == typeof this.options.placement ? this.options.placement.call(this, f[0], this.$element[0]) : this.options.placement,
                i = /\s?auto?\s?/i, j = i.test(h);
            j && (h = h.replace(i, "") || "top"), f.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(h).data("bs." + this.type, this), this.options.container ? f.appendTo(this.options.container) : f.insertAfter(this.$element), this.$element.trigger("inserted.bs." + this.type);
            var k = this.getPosition(), l = f[0].offsetWidth, m = f[0].offsetHeight;
            if (j) {
                var n = h, o = this.getPosition(this.$viewport);
                h = "bottom" == h && k.bottom + m > o.bottom ? "top" : "top" == h && k.top - m < o.top ? "bottom" : "right" == h && k.right + l > o.width ? "left" : "left" == h && k.left - l < o.left ? "right" : h, f.removeClass(n).addClass(h)
            }
            var p = this.getCalculatedOffset(h, k, l, m);
            this.applyPlacement(p, h);
            var q = function () {
                var a = e.hoverState;
                e.$element.trigger("shown.bs." + e.type), e.hoverState = null, "out" == a && e.leave(e)
            };
            a.support.transition && this.$tip.hasClass("fade") ? f.one("bsTransitionEnd", q).emulateTransitionEnd(c.TRANSITION_DURATION) : q()
        }
    }, c.prototype.applyPlacement = function (b, c) {
        var d = this.tip(), e = d[0].offsetWidth, f = d[0].offsetHeight, g = parseInt(d.css("margin-top"), 10),
            h = parseInt(d.css("margin-left"), 10);
        isNaN(g) && (g = 0), isNaN(h) && (h = 0), b.top += g, b.left += h, a.offset.setOffset(d[0], a.extend({
            using: function (a) {
                d.css({top: Math.round(a.top), left: Math.round(a.left)})
            }
        }, b), 0), d.addClass("in");
        var i = d[0].offsetWidth, j = d[0].offsetHeight;
        "top" == c && j != f && (b.top = b.top + f - j);
        var k = this.getViewportAdjustedDelta(c, b, i, j);
        k.left ? b.left += k.left : b.top += k.top;
        var l = /top|bottom/.test(c), m = l ? 2 * k.left - e + i : 2 * k.top - f + j,
            n = l ? "offsetWidth" : "offsetHeight";
        d.offset(b), this.replaceArrow(m, d[0][n], l)
    }, c.prototype.replaceArrow = function (a, b, c) {
        this.arrow().css(c ? "left" : "top", 50 * (1 - a / b) + "%").css(c ? "top" : "left", "")
    }, c.prototype.setContent = function () {
        var a = this.tip(), b = this.getTitle();
        a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass("fade in top bottom left right")
    }, c.prototype.hide = function (b) {
        function d() {
            "in" != e.hoverState && f.detach(), e.$element && e.$element.removeAttr("aria-describedby").trigger("hidden.bs." + e.type), b && b()
        }

        var e = this, f = a(this.$tip), g = a.Event("hide.bs." + this.type);
        if (this.$element.trigger(g), !g.isDefaultPrevented()) return f.removeClass("in"), a.support.transition && f.hasClass("fade") ? f.one("bsTransitionEnd", d).emulateTransitionEnd(c.TRANSITION_DURATION) : d(), this.hoverState = null, this
    }, c.prototype.fixTitle = function () {
        var a = this.$element;
        (a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr("data-original-title", a.attr("title") || "").attr("title", "")
    }, c.prototype.hasContent = function () {
        return this.getTitle()
    }, c.prototype.getPosition = function (b) {
        b = b || this.$element;
        var c = b[0], d = "BODY" == c.tagName, e = c.getBoundingClientRect();
        null == e.width && (e = a.extend({}, e, {width: e.right - e.left, height: e.bottom - e.top}));
        var f = window.SVGElement && c instanceof window.SVGElement, g = d ? {top: 0, left: 0} : f ? null : b.offset(),
            h = {scroll: d ? document.documentElement.scrollTop || document.body.scrollTop : b.scrollTop()},
            i = d ? {width: a(window).width(), height: a(window).height()} : null;
        return a.extend({}, e, h, i, g)
    }, c.prototype.getCalculatedOffset = function (a, b, c, d) {
        return "bottom" == a ? {
            top: b.top + b.height,
            left: b.left + b.width / 2 - c / 2
        } : "top" == a ? {
            top: b.top - d,
            left: b.left + b.width / 2 - c / 2
        } : "left" == a ? {top: b.top + b.height / 2 - d / 2, left: b.left - c} : {
            top: b.top + b.height / 2 - d / 2,
            left: b.left + b.width
        }
    }, c.prototype.getViewportAdjustedDelta = function (a, b, c, d) {
        var e = {top: 0, left: 0};
        if (!this.$viewport) return e;
        var f = this.options.viewport && this.options.viewport.padding || 0, g = this.getPosition(this.$viewport);
        if (/right|left/.test(a)) {
            var h = b.top - f - g.scroll, i = b.top + f - g.scroll + d;
            h < g.top ? e.top = g.top - h : i > g.top + g.height && (e.top = g.top + g.height - i)
        } else {
            var j = b.left - f, k = b.left + f + c;
            j < g.left ? e.left = g.left - j : k > g.right && (e.left = g.left + g.width - k)
        }
        return e
    }, c.prototype.getTitle = function () {
        var a, b = this.$element, c = this.options;
        return a = b.attr("data-original-title") || ("function" == typeof c.title ? c.title.call(b[0]) : c.title)
    }, c.prototype.getUID = function (a) {
        do a += ~~(1e6 * Math.random()); while (document.getElementById(a));
        return a
    }, c.prototype.tip = function () {
        if (!this.$tip && (this.$tip = a(this.options.template), 1 != this.$tip.length)) throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!");
        return this.$tip
    }, c.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    }, c.prototype.enable = function () {
        this.enabled = !0
    }, c.prototype.disable = function () {
        this.enabled = !1
    }, c.prototype.toggleEnabled = function () {
        this.enabled = !this.enabled
    }, c.prototype.toggle = function (b) {
        var c = this;
        b && (c = a(b.currentTarget).data("bs." + this.type), c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c))), b ? (c.inState.click = !c.inState.click, c.isInStateTrue() ? c.enter(c) : c.leave(c)) : c.tip().hasClass("in") ? c.leave(c) : c.enter(c)
    }, c.prototype.destroy = function () {
        var a = this;
        clearTimeout(this.timeout), this.hide(function () {
            a.$element.off("." + a.type).removeData("bs." + a.type), a.$tip && a.$tip.detach(), a.$tip = null, a.$arrow = null, a.$viewport = null, a.$element = null
        })
    };
    var d = a.fn.tooltip;
    a.fn.tooltip = b, a.fn.tooltip.Constructor = c, a.fn.tooltip.noConflict = function () {
        return a.fn.tooltip = d, this
    }
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.popover"), f = "object" == typeof b && b;
            !e && /destroy|hide/.test(b) || (e || d.data("bs.popover", e = new c(this, f)), "string" == typeof b && e[b]())
        })
    }

    var c = function (a, b) {
        this.init("popover", a, b)
    };
    if (!a.fn.tooltip) throw new Error("Popover requires tooltip.js");
    c.VERSION = "3.3.7", c.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }), c.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), c.prototype.constructor = c, c.prototype.getDefaults = function () {
        return c.DEFAULTS
    }, c.prototype.setContent = function () {
        var a = this.tip(), b = this.getTitle(), c = this.getContent();
        a.find(".popover-title")[this.options.html ? "html" : "text"](b), a.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof c ? "html" : "append" : "text"](c), a.removeClass("fade top bottom left right in"), a.find(".popover-title").html() || a.find(".popover-title").hide()
    }, c.prototype.hasContent = function () {
        return this.getTitle() || this.getContent()
    }, c.prototype.getContent = function () {
        var a = this.$element, b = this.options;
        return a.attr("data-content") || ("function" == typeof b.content ? b.content.call(a[0]) : b.content)
    }, c.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".arrow")
    };
    var d = a.fn.popover;
    a.fn.popover = b, a.fn.popover.Constructor = c, a.fn.popover.noConflict = function () {
        return a.fn.popover = d, this
    }
}(jQuery), +function (a) {
    "use strict";

    function b(c, d) {
        this.$body = a(document.body), this.$scrollElement = a(a(c).is(document.body) ? window : c), this.options = a.extend({}, b.DEFAULTS, d), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", a.proxy(this.process, this)), this.refresh(), this.process()
    }

    function c(c) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.scrollspy"), f = "object" == typeof c && c;
            e || d.data("bs.scrollspy", e = new b(this, f)), "string" == typeof c && e[c]()
        })
    }

    b.VERSION = "3.3.7", b.DEFAULTS = {offset: 10}, b.prototype.getScrollHeight = function () {
        return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
    }, b.prototype.refresh = function () {
        var b = this, c = "offset", d = 0;
        this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(), a.isWindow(this.$scrollElement[0]) || (c = "position", d = this.$scrollElement.scrollTop()), this.$body.find(this.selector).map(function () {
            var b = a(this), e = b.data("target") || b.attr("href"), f = /^#./.test(e) && a(e);
            return f && f.length && f.is(":visible") && [[f[c]().top + d, e]] || null
        }).sort(function (a, b) {
            return a[0] - b[0]
        }).each(function () {
            b.offsets.push(this[0]), b.targets.push(this[1])
        })
    }, b.prototype.process = function () {
        var a, b = this.$scrollElement.scrollTop() + this.options.offset, c = this.getScrollHeight(),
            d = this.options.offset + c - this.$scrollElement.height(), e = this.offsets, f = this.targets,
            g = this.activeTarget;
        if (this.scrollHeight != c && this.refresh(), b >= d) return g != (a = f[f.length - 1]) && this.activate(a);
        if (g && b < e[0]) return this.activeTarget = null, this.clear();
        for (a = e.length; a--;) g != f[a] && b >= e[a] && (void 0 === e[a + 1] || b < e[a + 1]) && this.activate(f[a])
    }, b.prototype.activate = function (b) {
        this.activeTarget = b, this.clear();
        var c = this.selector + '[data-target="' + b + '"],' + this.selector + '[href="' + b + '"]',
            d = a(c).parents("li").addClass("active");
        d.parent(".dropdown-menu").length && (d = d.closest("li.dropdown").addClass("active")), d.trigger("activate.bs.scrollspy")
    }, b.prototype.clear = function () {
        a(this.selector).parentsUntil(this.options.target, ".active").removeClass("active")
    };
    var d = a.fn.scrollspy;
    a.fn.scrollspy = c, a.fn.scrollspy.Constructor = b, a.fn.scrollspy.noConflict = function () {
        return a.fn.scrollspy = d, this
    }, a(window).on("load.bs.scrollspy.data-api", function () {
        a('[data-spy="scroll"]').each(function () {
            var b = a(this);
            c.call(b, b.data())
        })
    })
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.tab");
            e || d.data("bs.tab", e = new c(this)), "string" == typeof b && e[b]()
        })
    }

    var c = function (b) {
        this.element = a(b)
    };
    c.VERSION = "3.3.7", c.TRANSITION_DURATION = 150, c.prototype.show = function () {
        var b = this.element, c = b.closest("ul:not(.dropdown-menu)"), d = b.data("target");
        if (d || (d = b.attr("href"), d = d && d.replace(/.*(?=#[^\s]*$)/, "")), !b.parent("li").hasClass("active")) {
            var e = c.find(".active:last a"), f = a.Event("hide.bs.tab", {relatedTarget: b[0]}),
                g = a.Event("show.bs.tab", {relatedTarget: e[0]});
            if (e.trigger(f), b.trigger(g), !g.isDefaultPrevented() && !f.isDefaultPrevented()) {
                var h = a(d);
                this.activate(b.closest("li"), c), this.activate(h, h.parent(), function () {
                    e.trigger({type: "hidden.bs.tab", relatedTarget: b[0]}), b.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: e[0]
                    })
                })
            }
        }
    }, c.prototype.activate = function (b, d, e) {
        function f() {
            g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), h ? (b[0].offsetWidth, b.addClass("in")) : b.removeClass("fade"), b.parent(".dropdown-menu").length && b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), e && e()
        }

        var g = d.find("> .active"),
            h = e && a.support.transition && (g.length && g.hasClass("fade") || !!d.find(">.fade").length);
        g.length && h ? g.one("bsTransitionEnd", f).emulateTransitionEnd(c.TRANSITION_DURATION) : f(), g.removeClass("in")
    };
    var d = a.fn.tab;
    a.fn.tab = b, a.fn.tab.Constructor = c, a.fn.tab.noConflict = function () {
        return a.fn.tab = d, this
    };
    var e = function (c) {
        c.preventDefault(), b.call(a(this), "show")
    };
    a(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', e).on("click.bs.tab.data-api", '[data-toggle="pill"]', e)
}(jQuery), +function (a) {
    "use strict";

    function b(b) {
        return this.each(function () {
            var d = a(this), e = d.data("bs.affix"), f = "object" == typeof b && b;
            e || d.data("bs.affix", e = new c(this, f)), "string" == typeof b && e[b]()
        })
    }

    var c = function (b, d) {
        this.options = a.extend({}, c.DEFAULTS, d), this.$target = a(this.options.target).on("scroll.bs.affix.data-api", a.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", a.proxy(this.checkPositionWithEventLoop, this)), this.$element = a(b), this.affixed = null, this.unpin = null, this.pinnedOffset = null, this.checkPosition()
    };
    c.VERSION = "3.3.7", c.RESET = "affix affix-top affix-bottom", c.DEFAULTS = {
        offset: 0,
        target: window
    }, c.prototype.getState = function (a, b, c, d) {
        var e = this.$target.scrollTop(), f = this.$element.offset(), g = this.$target.height();
        if (null != c && "top" == this.affixed) return e < c && "top";
        if ("bottom" == this.affixed) return null != c ? !(e + this.unpin <= f.top) && "bottom" : !(e + g <= a - d) && "bottom";
        var h = null == this.affixed, i = h ? e : f.top, j = h ? g : b;
        return null != c && e <= c ? "top" : null != d && i + j >= a - d && "bottom"
    }, c.prototype.getPinnedOffset = function () {
        if (this.pinnedOffset) return this.pinnedOffset;
        this.$element.removeClass(c.RESET).addClass("affix");
        var a = this.$target.scrollTop(), b = this.$element.offset();
        return this.pinnedOffset = b.top - a
    }, c.prototype.checkPositionWithEventLoop = function () {
        setTimeout(a.proxy(this.checkPosition, this), 1)
    }, c.prototype.checkPosition = function () {
        if (this.$element.is(":visible")) {
            var b = this.$element.height(), d = this.options.offset, e = d.top, f = d.bottom,
                g = Math.max(a(document).height(), a(document.body).height());
            "object" != typeof d && (f = e = d), "function" == typeof e && (e = d.top(this.$element)), "function" == typeof f && (f = d.bottom(this.$element));
            var h = this.getState(g, b, e, f);
            if (this.affixed != h) {
                null != this.unpin && this.$element.css("top", "");
                var i = "affix" + (h ? "-" + h : ""), j = a.Event(i + ".bs.affix");
                if (this.$element.trigger(j), j.isDefaultPrevented()) return;
                this.affixed = h, this.unpin = "bottom" == h ? this.getPinnedOffset() : null, this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix", "affixed") + ".bs.affix")
            }
            "bottom" == h && this.$element.offset({top: g - b - f})
        }
    };
    var d = a.fn.affix;
    a.fn.affix = b, a.fn.affix.Constructor = c, a.fn.affix.noConflict = function () {
        return a.fn.affix = d, this
    }, a(window).on("load", function () {
        a('[data-spy="affix"]').each(function () {
            var c = a(this), d = c.data();
            d.offset = d.offset || {}, null != d.offsetBottom && (d.offset.bottom = d.offsetBottom), null != d.offsetTop && (d.offset.top = d.offsetTop), b.call(c, d)
        })
    })
}(jQuery);
(function (t, e) {
    "use strict";

    function n() {
        if (!i.READY) {
            i.event.determineEventTypes();
            for (var t in i.gestures) i.gestures.hasOwnProperty(t) && i.detection.register(i.gestures[t]);
            i.event.onTouch(i.DOCUMENT, i.EVENT_MOVE, i.detection.detect), i.event.onTouch(i.DOCUMENT, i.EVENT_END, i.detection.detect), i.READY = !0
        }
    }

    var i = function (t, e) {
        return new i.Instance(t, e || {})
    };
    i.defaults = {
        stop_browser_behavior: {
            userSelect: "none",
            touchAction: "none",
            touchCallout: "none",
            contentZooming: "none",
            userDrag: "none",
            tapHighlightColor: "rgba(0,0,0,0)"
        }
    }, i.HAS_POINTEREVENTS = navigator.pointerEnabled || navigator.msPointerEnabled, i.HAS_TOUCHEVENTS = "ontouchstart" in t, i.MOBILE_REGEX = /mobile|tablet|ip(ad|hone|od)|android/i, i.NO_MOUSEEVENTS = i.HAS_TOUCHEVENTS && navigator.userAgent.match(i.MOBILE_REGEX), i.EVENT_TYPES = {}, i.DIRECTION_DOWN = "down", i.DIRECTION_LEFT = "left", i.DIRECTION_UP = "up", i.DIRECTION_RIGHT = "right", i.POINTER_MOUSE = "mouse", i.POINTER_TOUCH = "touch", i.POINTER_PEN = "pen", i.EVENT_START = "start", i.EVENT_MOVE = "move", i.EVENT_END = "end", i.DOCUMENT = document, i.plugins = {}, i.READY = !1, i.Instance = function (t, e) {
        var r = this;
        return n(), this.element = t, this.enabled = !0, this.options = i.utils.extend(i.utils.extend({}, i.defaults), e || {}), this.options.stop_browser_behavior && i.utils.stopDefaultBrowserBehavior(this.element, this.options.stop_browser_behavior), i.event.onTouch(t, i.EVENT_START, function (t) {
            r.enabled && i.detection.startDetect(r, t)
        }), this
    }, i.Instance.prototype = {
        on: function (t, e) {
            for (var n = t.split(" "), i = 0; n.length > i; i++) this.element.addEventListener(n[i], e, !1);
            return this
        }, off: function (t, e) {
            for (var n = t.split(" "), i = 0; n.length > i; i++) this.element.removeEventListener(n[i], e, !1);
            return this
        }, trigger: function (t, e) {
            var n = i.DOCUMENT.createEvent("Event");
            n.initEvent(t, !0, !0), n.gesture = e;
            var r = this.element;
            return i.utils.hasParent(e.target, r) && (r = e.target), r.dispatchEvent(n), this
        }, enable: function (t) {
            return this.enabled = t, this
        }
    };
    var r = null, o = !1, s = !1;
    i.event = {
        bindDom: function (t, e, n) {
            for (var i = e.split(" "), r = 0; i.length > r; r++) t.addEventListener(i[r], n, !1)
        }, onTouch: function (t, e, n) {
            var a = this;
            this.bindDom(t, i.EVENT_TYPES[e], function (c) {
                var u = c.type.toLowerCase();
                if (!u.match(/mouse/) || !s) {
                    (u.match(/touch/) || u.match(/pointerdown/) || u.match(/mouse/) && 1 === c.which) && (o = !0), u.match(/touch|pointer/) && (s = !0);
                    var h = 0;
                    o && (i.HAS_POINTEREVENTS && e != i.EVENT_END ? h = i.PointerEvent.updatePointer(e, c) : u.match(/touch/) ? h = c.touches.length : s || (h = u.match(/up/) ? 0 : 1), h > 0 && e == i.EVENT_END ? e = i.EVENT_MOVE : h || (e = i.EVENT_END), h || null === r ? r = c : c = r, n.call(i.detection, a.collectEventData(t, e, c)), i.HAS_POINTEREVENTS && e == i.EVENT_END && (h = i.PointerEvent.updatePointer(e, c))), h || (r = null, o = !1, s = !1, i.PointerEvent.reset())
                }
            })
        }, determineEventTypes: function () {
            var t;
            t = i.HAS_POINTEREVENTS ? i.PointerEvent.getEvents() : i.NO_MOUSEEVENTS ? ["touchstart", "touchmove", "touchend touchcancel"] : ["touchstart mousedown", "touchmove mousemove", "touchend touchcancel mouseup"], i.EVENT_TYPES[i.EVENT_START] = t[0], i.EVENT_TYPES[i.EVENT_MOVE] = t[1], i.EVENT_TYPES[i.EVENT_END] = t[2]
        }, getTouchList: function (t) {
            return i.HAS_POINTEREVENTS ? i.PointerEvent.getTouchList() : t.touches ? t.touches : [{
                identifier: 1,
                pageX: t.pageX,
                pageY: t.pageY,
                target: t.target
            }]
        }, collectEventData: function (t, e, n) {
            var r = this.getTouchList(n, e), o = i.POINTER_TOUCH;
            return (n.type.match(/mouse/) || i.PointerEvent.matchType(i.POINTER_MOUSE, n)) && (o = i.POINTER_MOUSE), {
                center: i.utils.getCenter(r),
                timeStamp: (new Date).getTime(),
                target: n.target,
                touches: r,
                eventType: e,
                pointerType: o,
                srcEvent: n,
                preventDefault: function () {
                    this.srcEvent.preventManipulation && this.srcEvent.preventManipulation(), this.srcEvent.preventDefault && this.srcEvent.preventDefault()
                },
                stopPropagation: function () {
                    this.srcEvent.stopPropagation()
                },
                stopDetect: function () {
                    return i.detection.stopDetect()
                }
            }
        }
    }, i.PointerEvent = {
        pointers: {}, getTouchList: function () {
            var t = this, e = [];
            return Object.keys(t.pointers).sort().forEach(function (n) {
                e.push(t.pointers[n])
            }), e
        }, updatePointer: function (t, e) {
            return t == i.EVENT_END ? this.pointers = {} : (e.identifier = e.pointerId, this.pointers[e.pointerId] = e), Object.keys(this.pointers).length
        }, matchType: function (t, e) {
            if (!e.pointerType) return !1;
            var n = {};
            return n[i.POINTER_MOUSE] = e.pointerType == e.MSPOINTER_TYPE_MOUSE || e.pointerType == i.POINTER_MOUSE, n[i.POINTER_TOUCH] = e.pointerType == e.MSPOINTER_TYPE_TOUCH || e.pointerType == i.POINTER_TOUCH, n[i.POINTER_PEN] = e.pointerType == e.MSPOINTER_TYPE_PEN || e.pointerType == i.POINTER_PEN, n[t]
        }, getEvents: function () {
            return ["pointerdown MSPointerDown", "pointermove MSPointerMove", "pointerup pointercancel MSPointerUp MSPointerCancel"]
        }, reset: function () {
            this.pointers = {}
        }
    }, i.utils = {
        extend: function (t, n, i) {
            for (var r in n) t[r] !== e && i || (t[r] = n[r]);
            return t
        }, hasParent: function (t, e) {
            for (; t;) {
                if (t == e) return !0;
                t = t.parentNode
            }
            return !1
        }, getCenter: function (t) {
            for (var e = [], n = [], i = 0, r = t.length; r > i; i++) e.push(t[i].pageX), n.push(t[i].pageY);
            return {
                pageX: (Math.min.apply(Math, e) + Math.max.apply(Math, e)) / 2,
                pageY: (Math.min.apply(Math, n) + Math.max.apply(Math, n)) / 2
            }
        }, getVelocity: function (t, e, n) {
            return {x: Math.abs(e / t) || 0, y: Math.abs(n / t) || 0}
        }, getAngle: function (t, e) {
            var n = e.pageY - t.pageY, i = e.pageX - t.pageX;
            return 180 * Math.atan2(n, i) / Math.PI
        }, getDirection: function (t, e) {
            var n = Math.abs(t.pageX - e.pageX), r = Math.abs(t.pageY - e.pageY);
            return n >= r ? t.pageX - e.pageX > 0 ? i.DIRECTION_LEFT : i.DIRECTION_RIGHT : t.pageY - e.pageY > 0 ? i.DIRECTION_UP : i.DIRECTION_DOWN
        }, getDistance: function (t, e) {
            var n = e.pageX - t.pageX, i = e.pageY - t.pageY;
            return Math.sqrt(n * n + i * i)
        }, getScale: function (t, e) {
            return t.length >= 2 && e.length >= 2 ? this.getDistance(e[0], e[1]) / this.getDistance(t[0], t[1]) : 1
        }, getRotation: function (t, e) {
            return t.length >= 2 && e.length >= 2 ? this.getAngle(e[1], e[0]) - this.getAngle(t[1], t[0]) : 0
        }, isVertical: function (t) {
            return t == i.DIRECTION_UP || t == i.DIRECTION_DOWN
        }, stopDefaultBrowserBehavior: function (t, e) {
            var n, i = ["webkit", "khtml", "moz", "ms", "o", ""];
            if (e && t.style) {
                for (var r = 0; i.length > r; r++)
                    for (var o in e) e.hasOwnProperty(o) && (n = o, i[r] && (n = i[r] + n.substring(0, 1).toUpperCase() + n.substring(1)), t.style[n] = e[o]);
                "none" == e.userSelect && (t.onselectstart = function () {
                    return !1
                })
            }
        }
    }, i.detection = {
        gestures: [], current: null, previous: null, stopped: !1, startDetect: function (t, e) {
            this.current || (this.stopped = !1, this.current = {
                inst: t,
                startEvent: i.utils.extend({}, e),
                lastEvent: !1,
                name: ""
            }, this.detect(e))
        }, detect: function (t) {
            if (this.current && !this.stopped) {
                t = this.extendEventData(t);
                for (var e = this.current.inst.options, n = 0, r = this.gestures.length; r > n; n++) {
                    var o = this.gestures[n];
                    if (!this.stopped && e[o.name] !== !1 && o.handler.call(o, t, this.current.inst) === !1) {
                        this.stopDetect();
                        break
                    }
                }
                return this.current && (this.current.lastEvent = t), t.eventType == i.EVENT_END && !t.touches.length - 1 && this.stopDetect(), t
            }
        }, stopDetect: function () {
            this.previous = i.utils.extend({}, this.current), this.current = null, this.stopped = !0
        }, extendEventData: function (t) {
            var e = this.current.startEvent;
            if (e && (t.touches.length != e.touches.length || t.touches === e.touches)) {
                e.touches = [];
                for (var n = 0, r = t.touches.length; r > n; n++) e.touches.push(i.utils.extend({}, t.touches[n]))
            }
            var o = t.timeStamp - e.timeStamp, s = t.center.pageX - e.center.pageX, a = t.center.pageY - e.center.pageY,
                c = i.utils.getVelocity(o, s, a);
            return i.utils.extend(t, {
                deltaTime: o,
                deltaX: s,
                deltaY: a,
                velocityX: c.x,
                velocityY: c.y,
                distance: i.utils.getDistance(e.center, t.center),
                angle: i.utils.getAngle(e.center, t.center),
                direction: i.utils.getDirection(e.center, t.center),
                scale: i.utils.getScale(e.touches, t.touches),
                rotation: i.utils.getRotation(e.touches, t.touches),
                startEvent: e
            }), t
        }, register: function (t) {
            var n = t.defaults || {};
            return n[t.name] === e && (n[t.name] = !0), i.utils.extend(i.defaults, n, !0), t.index = t.index || 1e3, this.gestures.push(t), this.gestures.sort(function (t, e) {
                return t.index < e.index ? -1 : t.index > e.index ? 1 : 0
            }), this.gestures
        }
    }, i.gestures = i.gestures || {}, i.gestures.Hold = {
        name: "hold",
        index: 10,
        defaults: {hold_timeout: 500, hold_threshold: 1},
        timer: null,
        handler: function (t, e) {
            switch (t.eventType) {
                case i.EVENT_START:
                    clearTimeout(this.timer), i.detection.current.name = this.name, this.timer = setTimeout(function () {
                        "hold" == i.detection.current.name && e.trigger("hold", t)
                    }, e.options.hold_timeout);
                    break;
                case i.EVENT_MOVE:
                    t.distance > e.options.hold_threshold && clearTimeout(this.timer);
                    break;
                case i.EVENT_END:
                    clearTimeout(this.timer)
            }
        }
    }, i.gestures.Tap = {
        name: "tap",
        index: 100,
        defaults: {
            tap_max_touchtime: 250,
            tap_max_distance: 10,
            tap_always: !0,
            doubletap_distance: 20,
            doubletap_interval: 300
        },
        handler: function (t, e) {
            if (t.eventType == i.EVENT_END) {
                var n = i.detection.previous, r = !1;
                if (t.deltaTime > e.options.tap_max_touchtime || t.distance > e.options.tap_max_distance) return;
                n && "tap" == n.name && t.timeStamp - n.lastEvent.timeStamp < e.options.doubletap_interval && t.distance < e.options.doubletap_distance && (e.trigger("doubletap", t), r = !0), (!r || e.options.tap_always) && (i.detection.current.name = "tap", e.trigger(i.detection.current.name, t))
            }
        }
    }, i.gestures.Swipe = {
        name: "swipe",
        index: 40,
        defaults: {swipe_max_touches: 1, swipe_velocity: .7},
        handler: function (t, e) {
            if (t.eventType == i.EVENT_END) {
                if (e.options.swipe_max_touches > 0 && t.touches.length > e.options.swipe_max_touches) return;
                (t.velocityX > e.options.swipe_velocity || t.velocityY > e.options.swipe_velocity) && (e.trigger(this.name, t), e.trigger(this.name + t.direction, t))
            }
        }
    }, i.gestures.Drag = {
        name: "drag",
        index: 50,
        defaults: {
            drag_min_distance: 10,
            drag_max_touches: 1,
            drag_block_horizontal: !1,
            drag_block_vertical: !1,
            drag_lock_to_axis: !1,
            drag_lock_min_distance: 25
        },
        triggered: !1,
        handler: function (t, n) {
            if (i.detection.current.name != this.name && this.triggered) return n.trigger(this.name + "end", t), this.triggered = !1, e;
            if (!(n.options.drag_max_touches > 0 && t.touches.length > n.options.drag_max_touches)) switch (t.eventType) {
                case i.EVENT_START:
                    this.triggered = !1;
                    break;
                case i.EVENT_MOVE:
                    if (t.distance < n.options.drag_min_distance && i.detection.current.name != this.name) return;
                    i.detection.current.name = this.name, (i.detection.current.lastEvent.drag_locked_to_axis || n.options.drag_lock_to_axis && n.options.drag_lock_min_distance <= t.distance) && (t.drag_locked_to_axis = !0);
                    var r = i.detection.current.lastEvent.direction;
                    t.drag_locked_to_axis && r !== t.direction && (t.direction = i.utils.isVertical(r) ? 0 > t.deltaY ? i.DIRECTION_UP : i.DIRECTION_DOWN : 0 > t.deltaX ? i.DIRECTION_LEFT : i.DIRECTION_RIGHT), this.triggered || (n.trigger(this.name + "start", t), this.triggered = !0), n.trigger(this.name, t), n.trigger(this.name + t.direction, t), (n.options.drag_block_vertical && i.utils.isVertical(t.direction) || n.options.drag_block_horizontal && !i.utils.isVertical(t.direction)) && t.preventDefault();
                    break;
                case i.EVENT_END:
                    this.triggered && n.trigger(this.name + "end", t), this.triggered = !1
            }
        }
    }, i.gestures.Transform = {
        name: "transform",
        index: 45,
        defaults: {transform_min_scale: .01, transform_min_rotation: 1, transform_always_block: !1},
        triggered: !1,
        handler: function (t, n) {
            if (i.detection.current.name != this.name && this.triggered) return n.trigger(this.name + "end", t), this.triggered = !1, e;
            if (!(2 > t.touches.length)) switch (n.options.transform_always_block && t.preventDefault(), t.eventType) {
                case i.EVENT_START:
                    this.triggered = !1;
                    break;
                case i.EVENT_MOVE:
                    var r = Math.abs(1 - t.scale), o = Math.abs(t.rotation);
                    if (n.options.transform_min_scale > r && n.options.transform_min_rotation > o) return;
                    i.detection.current.name = this.name, this.triggered || (n.trigger(this.name + "start", t), this.triggered = !0), n.trigger(this.name, t), o > n.options.transform_min_rotation && n.trigger("rotate", t), r > n.options.transform_min_scale && (n.trigger("pinch", t), n.trigger("pinch" + (1 > t.scale ? "in" : "out"), t));
                    break;
                case i.EVENT_END:
                    this.triggered && n.trigger(this.name + "end", t), this.triggered = !1
            }
        }
    }, i.gestures.Touch = {
        name: "touch",
        index: -1 / 0,
        defaults: {prevent_default: !1, prevent_mouseevents: !1},
        handler: function (t, n) {
            return n.options.prevent_mouseevents && t.pointerType == i.POINTER_MOUSE ? (t.stopDetect(), e) : (n.options.prevent_default && t.preventDefault(), t.eventType == i.EVENT_START && n.trigger(this.name, t), e)
        }
    }, i.gestures.Release = {
        name: "release", index: 1 / 0, handler: function (t, e) {
            t.eventType == i.EVENT_END && e.trigger(this.name, t)
        }
    }, "object" == typeof module && "object" == typeof module.exports ? module.exports = i : (t.Hammer = i, "function" == typeof t.define && t.define.amd && t.define("hammer", [], function () {
        return i
    }))
})(this), function (t, e) {
    "use strict";
    t !== e && (Hammer.event.bindDom = function (n, i, r) {
        t(n).on(i, function (t) {
            var n = t.originalEvent || t;
            n.pageX === e && (n.pageX = t.pageX, n.pageY = t.pageY), n.target || (n.target = t.target), n.which === e && (n.which = n.button), n.preventDefault || (n.preventDefault = t.preventDefault), n.stopPropagation || (n.stopPropagation = t.stopPropagation), r.call(this, n)
        })
    }, Hammer.Instance.prototype.on = function (e, n) {
        return t(this.element).on(e, n)
    }, Hammer.Instance.prototype.off = function (e, n) {
        return t(this.element).off(e, n)
    }, Hammer.Instance.prototype.trigger = function (e, n) {
        var i = t(this.element);
        return i.has(n.target).length && (i = t(n.target)), i.trigger({type: e, gesture: n})
    }, t.fn.hammer = function (e) {
        return this.each(function () {
            var n = t(this), i = n.data("hammer");
            i ? i && e && Hammer.utils.extend(i.options, e) : n.data("hammer", new Hammer(this, e || {}))
        })
    })
}(window.jQuery || window.Zepto);
(function (t) {
    "use strict";
    var e = t.GreenSockGlobals || t;
    if (!e.TweenLite) {
        var i, s, r, n, a, o = function (t) {
            var i, s = t.split("."), r = e;
            for (i = 0; s.length > i; i++) r[s[i]] = r = r[s[i]] || {};
            return r
        }, l = o("com.greensock"), h = 1e-10, _ = [].slice, u = function () {
        }, m = function () {
            var t = Object.prototype.toString, e = t.call([]);
            return function (i) {
                return null != i && (i instanceof Array || "object" == typeof i && !!i.push && t.call(i) === e)
            }
        }(), f = {}, p = function (i, s, r, n) {
            this.sc = f[i] ? f[i].sc : [], f[i] = this, this.gsClass = null, this.func = r;
            var a = [];
            this.check = function (l) {
                for (var h, _, u, m, c = s.length, d = c; --c > -1;) (h = f[s[c]] || new p(s[c], [])).gsClass ? (a[c] = h.gsClass, d--) : l && h.sc.push(this);
                if (0 === d && r)
                    for (_ = ("com.greensock." + i).split("."), u = _.pop(), m = o(_.join("."))[u] = this.gsClass = r.apply(r, a), n && (e[u] = m, "function" == typeof define && define.amd ? define((t.GreenSockAMDPath ? t.GreenSockAMDPath + "../../default.htm" : "") + i.split(".").join("/"), [], function () {
                        return m
                    }) : "undefined" != typeof module && module.exports && (module.exports = m)), c = 0; this.sc.length > c; c++) this.sc[c].check()
            }, this.check(!0)
        }, c = t._gsDefine = function (t, e, i, s) {
            return new p(t, e, i, s)
        }, d = l._class = function (t, e, i) {
            return e = e || function () {
            }, c(t, [], function () {
                return e
            }, i), e
        };
        c.globals = e;
        var v = [0, 0, 1, 1], g = [], T = d("easing.Ease", function (t, e, i, s) {
            this._func = t, this._type = i || 0, this._power = s || 0, this._params = e ? v.concat(e) : v
        }, !0), w = T.map = {}, P = T.register = function (t, e, i, s) {
            for (var r, n, a, o, h = e.split(","), _ = h.length, u = (i || "easeIn,easeOut,easeInOut").split(","); --_ > -1;)
                for (n = h[_], r = s ? d("easing." + n, null, !0) : l.easing[n] || {}, a = u.length; --a > -1;) o = u[a], w[n + "." + o] = w[o + n] = r[o] = t.getRatio ? t : t[o] || new t
        };
        for (r = T.prototype, r._calcEnd = !1, r.getRatio = function (t) {
            if (this._func) return this._params[0] = t, this._func.apply(null, this._params);
            var e = this._type, i = this._power, s = 1 === e ? 1 - t : 2 === e ? t : .5 > t ? 2 * t : 2 * (1 - t);
            return 1 === i ? s *= s : 2 === i ? s *= s * s : 3 === i ? s *= s * s * s : 4 === i && (s *= s * s * s * s), 1 === e ? 1 - s : 2 === e ? s : .5 > t ? s / 2 : 1 - s / 2
        }, i = ["Linear", "Quad", "Cubic", "Quart", "Quint,Strong"], s = i.length; --s > -1;) r = i[s] + ",Power" + s, P(new T(null, null, 1, s), r, "easeOut", !0), P(new T(null, null, 2, s), r, "easeIn" + (0 === s ? ",easeNone" : "")), P(new T(null, null, 3, s), r, "easeInOut");
        w.linear = l.easing.Linear.easeIn, w.swing = l.easing.Quad.easeInOut;
        var y = d("events.EventDispatcher", function (t) {
            this._listeners = {}, this._eventTarget = t || this
        });
        r = y.prototype, r.addEventListener = function (t, e, i, s, r) {
            r = r || 0;
            var o, l, h = this._listeners[t], _ = 0;
            for (null == h && (this._listeners[t] = h = []), l = h.length; --l > -1;) o = h[l], o.c === e && o.s === i ? h.splice(l, 1) : 0 === _ && r > o.pr && (_ = l + 1);
            h.splice(_, 0, {c: e, s: i, up: s, pr: r}), this !== n || a || n.wake()
        }, r.removeEventListener = function (t, e) {
            var i, s = this._listeners[t];
            if (s)
                for (i = s.length; --i > -1;)
                    if (s[i].c === e) return s.splice(i, 1), void 0
        }, r.dispatchEvent = function (t) {
            var e, i, s, r = this._listeners[t];
            if (r)
                for (e = r.length, i = this._eventTarget; --e > -1;) s = r[e], s.up ? s.c.call(s.s || i, {
                    type: t,
                    target: i
                }) : s.c.call(s.s || i)
        };
        var b = t.requestAnimationFrame, k = t.cancelAnimationFrame, A = Date.now || function () {
            return (new Date).getTime()
        }, S = A();
        for (i = ["ms", "moz", "webkit", "o"], s = i.length; --s > -1 && !b;) b = t[i[s] + "RequestAnimationFrame"], k = t[i[s] + "CancelAnimationFrame"] || t[i[s] + "CancelRequestAnimationFrame"];
        d("Ticker", function (t, e) {
            var i, s, r, o, l, h = this, _ = A(), m = e !== !1 && b, f = function (t) {
                S = A(), h.time = (S - _) / 1e3;
                var e, n = h.time - l;
                (!i || n > 0 || t === !0) && (h.frame++, l += n + (n >= o ? .004 : o - n), e = !0), t !== !0 && (r = s(f)), e && h.dispatchEvent("tick")
            };
            y.call(h), h.time = h.frame = 0, h.tick = function () {
                f(!0)
            }, h.sleep = function () {
                null != r && (m && k ? k(r) : clearTimeout(r), s = u, r = null, h === n && (a = !1))
            }, h.wake = function () {
                null !== r && h.sleep(), s = 0 === i ? u : m && b ? b : function (t) {
                    return setTimeout(t, 0 | 1e3 * (l - h.time) + 1)
                }, h === n && (a = !0), f(2)
            }, h.fps = function (t) {
                return arguments.length ? (i = t, o = 1 / (i || 60), l = this.time + o, h.wake(), void 0) : i
            }, h.useRAF = function (t) {
                return arguments.length ? (h.sleep(), m = t, h.fps(i), void 0) : m
            }, h.fps(t), setTimeout(function () {
                m && (!r || 5 > h.frame) && h.useRAF(!1)
            }, 1500)
        }), r = l.Ticker.prototype = new l.events.EventDispatcher, r.constructor = l.Ticker;
        var x = d("core.Animation", function (t, e) {
            if (this.vars = e = e || {}, this._duration = this._totalDuration = t || 0, this._delay = Number(e.delay) || 0, this._timeScale = 1, this._active = e.immediateRender === !0, this.data = e.data, this._reversed = e.reversed === !0, Q) {
                a || n.wake();
                var i = this.vars.useFrames ? G : Q;
                i.add(this, i._time), this.vars.paused && this.paused(!0)
            }
        });
        n = x.ticker = new l.Ticker, r = x.prototype, r._dirty = r._gc = r._initted = r._paused = !1, r._totalTime = r._time = 0, r._rawPrevTime = -1, r._next = r._last = r._onUpdate = r._timeline = r.timeline = null, r._paused = !1;
        var C = function () {
            a && A() - S > 2e3 && n.wake(), setTimeout(C, 2e3)
        };
        C(), r.play = function (t, e) {
            return arguments.length && this.seek(t, e), this.reversed(!1).paused(!1)
        }, r.pause = function (t, e) {
            return arguments.length && this.seek(t, e), this.paused(!0)
        }, r.resume = function (t, e) {
            return arguments.length && this.seek(t, e), this.paused(!1)
        }, r.seek = function (t, e) {
            return this.totalTime(Number(t), e !== !1)
        }, r.restart = function (t, e) {
            return this.reversed(!1).paused(!1).totalTime(t ? -this._delay : 0, e !== !1, !0)
        }, r.reverse = function (t, e) {
            return arguments.length && this.seek(t || this.totalDuration(), e), this.reversed(!0).paused(!1)
        }, r.render = function () {
        }, r.invalidate = function () {
            return this
        }, r.isActive = function () {
            var t, e = this._timeline, i = this._startTime;
            return !e || !this._gc && !this._paused && e.isActive() && (t = e.rawTime()) >= i && i + this.totalDuration() / this._timeScale > t
        }, r._enabled = function (t, e) {
            return a || n.wake(), this._gc = !t, this._active = this.isActive(), e !== !0 && (t && !this.timeline ? this._timeline.add(this, this._startTime - this._delay) : !t && this.timeline && this._timeline._remove(this, !0)), !1
        }, r._kill = function () {
            return this._enabled(!1, !1)
        }, r.kill = function (t, e) {
            return this._kill(t, e), this
        }, r._uncache = function (t) {
            for (var e = t ? this : this.timeline; e;) e._dirty = !0, e = e.timeline;
            return this
        }, r._swapSelfInParams = function (t) {
            for (var e = t.length, i = t.concat(); --e > -1;) "{self}" === t[e] && (i[e] = this);
            return i
        }, r.eventCallback = function (t, e, i, s) {
            if ("on" === (t || "").substr(0, 2)) {
                var r = this.vars;
                if (1 === arguments.length) return r[t];
                null == e ? delete r[t] : (r[t] = e, r[t + "Params"] = m(i) && -1 !== i.join("").indexOf("{self}") ? this._swapSelfInParams(i) : i, r[t + "Scope"] = s), "onUpdate" === t && (this._onUpdate = e)
            }
            return this
        }, r.delay = function (t) {
            return arguments.length ? (this._timeline.smoothChildTiming && this.startTime(this._startTime + t - this._delay), this._delay = t, this) : this._delay
        }, r.duration = function (t) {
            return arguments.length ? (this._duration = this._totalDuration = t, this._uncache(!0), this._timeline.smoothChildTiming && this._time > 0 && this._time < this._duration && 0 !== t && this.totalTime(this._totalTime * (t / this._duration), !0), this) : (this._dirty = !1, this._duration)
        }, r.totalDuration = function (t) {
            return this._dirty = !1, arguments.length ? this.duration(t) : this._totalDuration
        }, r.time = function (t, e) {
            return arguments.length ? (this._dirty && this.totalDuration(), this.totalTime(t > this._duration ? this._duration : t, e)) : this._time
        }, r.totalTime = function (t, e, i) {
            if (a || n.wake(), !arguments.length) return this._totalTime;
            if (this._timeline) {
                if (0 > t && !i && (t += this.totalDuration()), this._timeline.smoothChildTiming) {
                    this._dirty && this.totalDuration();
                    var s = this._totalDuration, r = this._timeline;
                    if (t > s && !i && (t = s), this._startTime = (this._paused ? this._pauseTime : r._time) - (this._reversed ? s - t : t) / this._timeScale, r._dirty || this._uncache(!1), r._timeline)
                        for (; r._timeline;) r._timeline._time !== (r._startTime + r._totalTime) / r._timeScale && r.totalTime(r._totalTime, !0), r = r._timeline
                }
                this._gc && this._enabled(!0, !1), (this._totalTime !== t || 0 === this._duration) && this.render(t, e, !1)
            }
            return this
        }, r.progress = r.totalProgress = function (t, e) {
            return arguments.length ? this.totalTime(this.duration() * t, e) : this._time / this.duration()
        }, r.startTime = function (t) {
            return arguments.length ? (t !== this._startTime && (this._startTime = t, this.timeline && this.timeline._sortChildren && this.timeline.add(this, t - this._delay)), this) : this._startTime
        }, r.timeScale = function (t) {
            if (!arguments.length) return this._timeScale;
            if (t = t || h, this._timeline && this._timeline.smoothChildTiming) {
                var e = this._pauseTime, i = e || 0 === e ? e : this._timeline.totalTime();
                this._startTime = i - (i - this._startTime) * this._timeScale / t
            }
            return this._timeScale = t, this._uncache(!1)
        }, r.reversed = function (t) {
            return arguments.length ? (t != this._reversed && (this._reversed = t, this.totalTime(this._timeline && !this._timeline.smoothChildTiming ? this.totalDuration() - this._totalTime : this._totalTime, !0)), this) : this._reversed
        }, r.paused = function (t) {
            if (!arguments.length) return this._paused;
            if (t != this._paused && this._timeline) {
                a || t || n.wake();
                var e = this._timeline, i = e.rawTime(), s = i - this._pauseTime;
                !t && e.smoothChildTiming && (this._startTime += s, this._uncache(!1)), this._pauseTime = t ? i : null, this._paused = t, this._active = this.isActive(), !t && 0 !== s && this._initted && this.duration() && this.render(e.smoothChildTiming ? this._totalTime : (i - this._startTime) / this._timeScale, !0, !0)
            }
            return this._gc && !t && this._enabled(!0, !1), this
        };
        var R = d("core.SimpleTimeline", function (t) {
            x.call(this, 0, t), this.autoRemoveChildren = this.smoothChildTiming = !0
        });
        r = R.prototype = new x, r.constructor = R, r.kill()._gc = !1, r._first = r._last = null, r._sortChildren = !1, r.add = r.insert = function (t, e) {
            var i, s;
            if (t._startTime = Number(e || 0) + t._delay, t._paused && this !== t._timeline && (t._pauseTime = t._startTime + (this.rawTime() - t._startTime) / t._timeScale), t.timeline && t.timeline._remove(t, !0), t.timeline = t._timeline = this, t._gc && t._enabled(!0, !0), i = this._last, this._sortChildren)
                for (s = t._startTime; i && i._startTime > s;) i = i._prev;
            return i ? (t._next = i._next, i._next = t) : (t._next = this._first, this._first = t), t._next ? t._next._prev = t : this._last = t, t._prev = i, this._timeline && this._uncache(!0), this
        }, r._remove = function (t, e) {
            return t.timeline === this && (e || t._enabled(!1, !0), t.timeline = null, t._prev ? t._prev._next = t._next : this._first === t && (this._first = t._next), t._next ? t._next._prev = t._prev : this._last === t && (this._last = t._prev), this._timeline && this._uncache(!0)), this
        }, r.render = function (t, e, i) {
            var s, r = this._first;
            for (this._totalTime = this._time = this._rawPrevTime = t; r;) s = r._next, (r._active || t >= r._startTime && !r._paused) && (r._reversed ? r.render((r._dirty ? r.totalDuration() : r._totalDuration) - (t - r._startTime) * r._timeScale, e, i) : r.render((t - r._startTime) * r._timeScale, e, i)), r = s
        }, r.rawTime = function () {
            return a || n.wake(), this._totalTime
        };
        var D = d("TweenLite", function (e, i, s) {
            if (x.call(this, i, s), this.render = D.prototype.render, null == e) throw"Cannot tween a null target.";
            this.target = e = "string" != typeof e ? e : D.selector(e) || e;
            var r, n, a,
                o = e.jquery || e.length && e !== t && e[0] && (e[0] === t || e[0].nodeType && e[0].style && !e.nodeType),
                l = this.vars.overwrite;
            if (this._overwrite = l = null == l ? j[D.defaultOverwrite] : "number" == typeof l ? l >> 0 : j[l], (o || e instanceof Array || e.push && m(e)) && "number" != typeof e[0])
                for (this._targets = a = _.call(e, 0), this._propLookup = [], this._siblings = [], r = 0; a.length > r; r++) n = a[r], n ? "string" != typeof n ? n.length && n !== t && n[0] && (n[0] === t || n[0].nodeType && n[0].style && !n.nodeType) ? (a.splice(r--, 1), this._targets = a = a.concat(_.call(n, 0))) : (this._siblings[r] = B(n, this, !1), 1 === l && this._siblings[r].length > 1 && q(n, this, null, 1, this._siblings[r])) : (n = a[r--] = D.selector(n), "string" == typeof n && a.splice(r + 1, 1)) : a.splice(r--, 1); else this._propLookup = {}, this._siblings = B(e, this, !1), 1 === l && this._siblings.length > 1 && q(e, this, null, 1, this._siblings);
            (this.vars.immediateRender || 0 === i && 0 === this._delay && this.vars.immediateRender !== !1) && this.render(-this._delay, !1, !0)
        }, !0), E = function (e) {
            return e.length && e !== t && e[0] && (e[0] === t || e[0].nodeType && e[0].style && !e.nodeType)
        }, I = function (t, e) {
            var i, s = {};
            for (i in t) F[i] || i in e && "x" !== i && "y" !== i && "width" !== i && "height" !== i && "className" !== i && "border" !== i || !(!N[i] || N[i] && N[i]._autoCSS) || (s[i] = t[i], delete t[i]);
            t.css = s
        };
        r = D.prototype = new x, r.constructor = D, r.kill()._gc = !1, r.ratio = 0, r._firstPT = r._targets = r._overwrittenProps = r._startAt = null, r._notifyPluginsOfEnabled = !1, D.version = "1.11.5", D.defaultEase = r._ease = new T(null, null, 1, 1), D.defaultOverwrite = "auto", D.ticker = n, D.autoSleep = !0, D.selector = t.$ || t.jQuery || function (e) {
            return t.$ ? (D.selector = t.$, t.$(e)) : t.document ? t.document.getElementById("#" === e.charAt(0) ? e.substr(1) : e) : e
        };
        var O = D._internals = {isArray: m, isSelector: E}, N = D._plugins = {}, L = D._tweenLookup = {}, U = 0,
            F = O.reservedProps = {
                ease: 1,
                delay: 1,
                overwrite: 1,
                onComplete: 1,
                onCompleteParams: 1,
                onCompleteScope: 1,
                useFrames: 1,
                runBackwards: 1,
                startAt: 1,
                onUpdate: 1,
                onUpdateParams: 1,
                onUpdateScope: 1,
                onStart: 1,
                onStartParams: 1,
                onStartScope: 1,
                onReverseComplete: 1,
                onReverseCompleteParams: 1,
                onReverseCompleteScope: 1,
                onRepeat: 1,
                onRepeatParams: 1,
                onRepeatScope: 1,
                easeParams: 1,
                yoyo: 1,
                immediateRender: 1,
                repeat: 1,
                repeatDelay: 1,
                data: 1,
                paused: 1,
                reversed: 1,
                autoCSS: 1
            }, j = {none: 0, all: 1, auto: 2, concurrent: 3, allOnStart: 4, preexisting: 5, "true": 1, "false": 0},
            G = x._rootFramesTimeline = new R, Q = x._rootTimeline = new R;
        Q._startTime = n.time, G._startTime = n.frame, Q._active = G._active = !0, x._updateRoot = function () {
            if (Q.render((n.time - Q._startTime) * Q._timeScale, !1, !1), G.render((n.frame - G._startTime) * G._timeScale, !1, !1), !(n.frame % 120)) {
                var t, e, i;
                for (i in L) {
                    for (e = L[i].tweens, t = e.length; --t > -1;) e[t]._gc && e.splice(t, 1);
                    0 === e.length && delete L[i]
                }
                if (i = Q._first, (!i || i._paused) && D.autoSleep && !G._first && 1 === n._listeners.tick.length) {
                    for (; i && i._paused;) i = i._next;
                    i || n.sleep()
                }
            }
        }, n.addEventListener("tick", x._updateRoot);
        var B = function (t, e, i) {
            var s, r, n = t._gsTweenID;
            if (L[n || (t._gsTweenID = n = "t" + U++)] || (L[n] = {
                target: t,
                tweens: []
            }), e && (s = L[n].tweens, s[r = s.length] = e, i))
                for (; --r > -1;) s[r] === e && s.splice(r, 1);
            return L[n].tweens
        }, q = function (t, e, i, s, r) {
            var n, a, o, l;
            if (1 === s || s >= 4) {
                for (l = r.length, n = 0; l > n; n++)
                    if ((o = r[n]) !== e) o._gc || o._enabled(!1, !1) && (a = !0); else if (5 === s) break;
                return a
            }
            var _, u = e._startTime + h, m = [], f = 0, p = 0 === e._duration;
            for (n = r.length; --n > -1;) (o = r[n]) === e || o._gc || o._paused || (o._timeline !== e._timeline ? (_ = _ || $(e, 0, p), 0 === $(o, _, p) && (m[f++] = o)) : u >= o._startTime && o._startTime + o.totalDuration() / o._timeScale > u && ((p || !o._initted) && 2e-10 >= u - o._startTime || (m[f++] = o)));
            for (n = f; --n > -1;) o = m[n], 2 === s && o._kill(i, t) && (a = !0), (2 !== s || !o._firstPT && o._initted) && o._enabled(!1, !1) && (a = !0);
            return a
        }, $ = function (t, e, i) {
            for (var s = t._timeline, r = s._timeScale, n = t._startTime; s._timeline;) {
                if (n += s._startTime, r *= s._timeScale, s._paused) return -100;
                s = s._timeline
            }
            return n /= r, n > e ? n - e : i && n === e || !t._initted && 2 * h > n - e ? h : (n += t.totalDuration() / t._timeScale / r) > e + h ? 0 : n - e - h
        };
        r._init = function () {
            var t, e, i, s, r = this.vars, n = this._overwrittenProps, a = this._duration, o = r.immediateRender,
                l = r.ease;
            if (r.startAt) {
                if (this._startAt && this._startAt.render(-1, !0), r.startAt.overwrite = 0, r.startAt.immediateRender = !0, this._startAt = D.to(this.target, 0, r.startAt), o)
                    if (this._time > 0) this._startAt = null; else if (0 !== a) return
            } else if (r.runBackwards && 0 !== a)
                if (this._startAt) this._startAt.render(-1, !0), this._startAt = null; else {
                    i = {};
                    for (s in r) F[s] && "autoCSS" !== s || (i[s] = r[s]);
                    if (i.overwrite = 0, i.data = "isFromStart", this._startAt = D.to(this.target, 0, i), r.immediateRender) {
                        if (0 === this._time) return
                    } else this._startAt.render(-1, !0)
                }
            if (this._ease = l ? l instanceof T ? r.easeParams instanceof Array ? l.config.apply(l, r.easeParams) : l : "function" == typeof l ? new T(l, r.easeParams) : w[l] || D.defaultEase : D.defaultEase, this._easeType = this._ease._type, this._easePower = this._ease._power, this._firstPT = null, this._targets)
                for (t = this._targets.length; --t > -1;) this._initProps(this._targets[t], this._propLookup[t] = {}, this._siblings[t], n ? n[t] : null) && (e = !0); else e = this._initProps(this.target, this._propLookup, this._siblings, n);
            if (e && D._onPluginEvent("_onInitAllProps", this), n && (this._firstPT || "function" != typeof this.target && this._enabled(!1, !1)), r.runBackwards)
                for (i = this._firstPT; i;) i.s += i.c, i.c = -i.c, i = i._next;
            this._onUpdate = r.onUpdate, this._initted = !0
        }, r._initProps = function (e, i, s, r) {
            var n, a, o, l, h, _;
            if (null == e) return !1;
            this.vars.css || e.style && e !== t && e.nodeType && N.css && this.vars.autoCSS !== !1 && I(this.vars, e);
            for (n in this.vars) {
                if (_ = this.vars[n], F[n]) _ && (_ instanceof Array || _.push && m(_)) && -1 !== _.join("").indexOf("{self}") && (this.vars[n] = _ = this._swapSelfInParams(_, this)); else if (N[n] && (l = new N[n])._onInitTween(e, this.vars[n], this)) {
                    for (this._firstPT = h = {
                        _next: this._firstPT,
                        t: l,
                        p: "setRatio",
                        s: 0,
                        c: 1,
                        f: !0,
                        n: n,
                        pg: !0,
                        pr: l._priority
                    }, a = l._overwriteProps.length; --a > -1;) i[l._overwriteProps[a]] = this._firstPT;
                    (l._priority || l._onInitAllProps) && (o = !0), (l._onDisable || l._onEnable) && (this._notifyPluginsOfEnabled = !0)
                } else this._firstPT = i[n] = h = {
                    _next: this._firstPT,
                    t: e,
                    p: n,
                    f: "function" == typeof e[n],
                    n: n,
                    pg: !1,
                    pr: 0
                }, h.s = h.f ? e[n.indexOf("set") || "function" != typeof e["get" + n.substr(3)] ? n : "get" + n.substr(3)]() : parseFloat(e[n]), h.c = "string" == typeof _ && "=" === _.charAt(1) ? parseInt(_.charAt(0) + "1", 10) * Number(_.substr(2)) : Number(_) - h.s || 0;
                h && h._next && (h._next._prev = h)
            }
            return r && this._kill(r, e) ? this._initProps(e, i, s, r) : this._overwrite > 1 && this._firstPT && s.length > 1 && q(e, this, i, this._overwrite, s) ? (this._kill(i, e), this._initProps(e, i, s, r)) : o
        }, r.render = function (t, e, i) {
            var s, r, n, a, o = this._time, l = this._duration;
            if (t >= l) this._totalTime = this._time = l, this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1, this._reversed || (s = !0, r = "onComplete"), 0 === l && (a = this._rawPrevTime, (0 === t || 0 > a || a === h) && a !== t && (i = !0, a > h && (r = "onReverseComplete")), this._rawPrevTime = a = !e || t || 0 === a ? t : h); else if (1e-7 > t) this._totalTime = this._time = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0, (0 !== o || 0 === l && this._rawPrevTime > h) && (r = "onReverseComplete", s = this._reversed), 0 > t ? (this._active = !1, 0 === l && (this._rawPrevTime >= 0 && (i = !0), this._rawPrevTime = a = !e || t || 0 === this._rawPrevTime ? t : h)) : this._initted || (i = !0); else if (this._totalTime = this._time = t, this._easeType) {
                var _ = t / l, u = this._easeType, m = this._easePower;
                (1 === u || 3 === u && _ >= .5) && (_ = 1 - _), 3 === u && (_ *= 2), 1 === m ? _ *= _ : 2 === m ? _ *= _ * _ : 3 === m ? _ *= _ * _ * _ : 4 === m && (_ *= _ * _ * _ * _), this.ratio = 1 === u ? 1 - _ : 2 === u ? _ : .5 > t / l ? _ / 2 : 1 - _ / 2
            } else this.ratio = this._ease.getRatio(t / l);
            if (this._time !== o || i) {
                if (!this._initted) {
                    if (this._init(), !this._initted || this._gc) return;
                    this._time && !s ? this.ratio = this._ease.getRatio(this._time / l) : s && this._ease._calcEnd && (this.ratio = this._ease.getRatio(0 === this._time ? 0 : 1))
                }
                for (this._active || !this._paused && this._time !== o && t >= 0 && (this._active = !0), 0 === o && (this._startAt && (t >= 0 ? this._startAt.render(t, e, i) : r || (r = "_dummyGS")), this.vars.onStart && (0 !== this._time || 0 === l) && (e || this.vars.onStart.apply(this.vars.onStartScope || this, this.vars.onStartParams || g))), n = this._firstPT; n;) n.f ? n.t[n.p](n.c * this.ratio + n.s) : n.t[n.p] = n.c * this.ratio + n.s, n = n._next;
                this._onUpdate && (0 > t && this._startAt && this._startTime && this._startAt.render(t, e, i), e || (this._time !== o || s) && this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || g)), r && (this._gc || (0 > t && this._startAt && !this._onUpdate && this._startTime && this._startAt.render(t, e, i), s && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !e && this.vars[r] && this.vars[r].apply(this.vars[r + "Scope"] || this, this.vars[r + "Params"] || g), 0 === l && this._rawPrevTime === h && a !== h && (this._rawPrevTime = 0)))
            }
        }, r._kill = function (t, e) {
            if ("all" === t && (t = null), null == t && (null == e || e === this.target)) return this._enabled(!1, !1);
            e = "string" != typeof e ? e || this._targets || this.target : D.selector(e) || e;
            var i, s, r, n, a, o, l, h;
            if ((m(e) || E(e)) && "number" != typeof e[0])
                for (i = e.length; --i > -1;) this._kill(t, e[i]) && (o = !0); else {
                if (this._targets) {
                    for (i = this._targets.length; --i > -1;)
                        if (e === this._targets[i]) {
                            a = this._propLookup[i] || {}, this._overwrittenProps = this._overwrittenProps || [], s = this._overwrittenProps[i] = t ? this._overwrittenProps[i] || {} : "all";
                            break
                        }
                } else {
                    if (e !== this.target) return !1;
                    a = this._propLookup, s = this._overwrittenProps = t ? this._overwrittenProps || {} : "all"
                }
                if (a) {
                    l = t || a, h = t !== s && "all" !== s && t !== a && ("object" != typeof t || !t._tempKill);
                    for (r in l) (n = a[r]) && (n.pg && n.t._kill(l) && (o = !0), n.pg && 0 !== n.t._overwriteProps.length || (n._prev ? n._prev._next = n._next : n === this._firstPT && (this._firstPT = n._next), n._next && (n._next._prev = n._prev), n._next = n._prev = null), delete a[r]), h && (s[r] = 1);
                    !this._firstPT && this._initted && this._enabled(!1, !1)
                }
            }
            return o
        }, r.invalidate = function () {
            return this._notifyPluginsOfEnabled && D._onPluginEvent("_onDisable", this), this._firstPT = null, this._overwrittenProps = null, this._onUpdate = null, this._startAt = null, this._initted = this._active = this._notifyPluginsOfEnabled = !1, this._propLookup = this._targets ? {} : [], this
        }, r._enabled = function (t, e) {
            if (a || n.wake(), t && this._gc) {
                var i, s = this._targets;
                if (s)
                    for (i = s.length; --i > -1;) this._siblings[i] = B(s[i], this, !0); else this._siblings = B(this.target, this, !0)
            }
            return x.prototype._enabled.call(this, t, e), this._notifyPluginsOfEnabled && this._firstPT ? D._onPluginEvent(t ? "_onEnable" : "_onDisable", this) : !1
        }, D.to = function (t, e, i) {
            return new D(t, e, i)
        }, D.from = function (t, e, i) {
            return i.runBackwards = !0, i.immediateRender = 0 != i.immediateRender, new D(t, e, i)
        }, D.fromTo = function (t, e, i, s) {
            return s.startAt = i, s.immediateRender = 0 != s.immediateRender && 0 != i.immediateRender, new D(t, e, s)
        }, D.delayedCall = function (t, e, i, s, r) {
            return new D(e, 0, {
                delay: t,
                onComplete: e,
                onCompleteParams: i,
                onCompleteScope: s,
                onReverseComplete: e,
                onReverseCompleteParams: i,
                onReverseCompleteScope: s,
                immediateRender: !1,
                useFrames: r,
                overwrite: 0
            })
        }, D.set = function (t, e) {
            return new D(t, 0, e)
        }, D.getTweensOf = function (t, e) {
            if (null == t) return [];
            t = "string" != typeof t ? t : D.selector(t) || t;
            var i, s, r, n;
            if ((m(t) || E(t)) && "number" != typeof t[0]) {
                for (i = t.length, s = []; --i > -1;) s = s.concat(D.getTweensOf(t[i], e));
                for (i = s.length; --i > -1;)
                    for (n = s[i], r = i; --r > -1;) n === s[r] && s.splice(i, 1)
            } else
                for (s = B(t).concat(), i = s.length; --i > -1;) (s[i]._gc || e && !s[i].isActive()) && s.splice(i, 1);
            return s
        }, D.killTweensOf = D.killDelayedCallsTo = function (t, e, i) {
            "object" == typeof e && (i = e, e = !1);
            for (var s = D.getTweensOf(t, e), r = s.length; --r > -1;) s[r]._kill(i, t)
        };
        var M = d("plugins.TweenPlugin", function (t, e) {
            this._overwriteProps = (t || "").split(","), this._propName = this._overwriteProps[0], this._priority = e || 0, this._super = M.prototype
        }, !0);
        if (r = M.prototype, M.version = "1.10.1", M.API = 2, r._firstPT = null, r._addTween = function (t, e, i, s, r, n) {
            var a, o;
            return null != s && (a = "number" == typeof s || "=" !== s.charAt(1) ? Number(s) - i : parseInt(s.charAt(0) + "1", 10) * Number(s.substr(2))) ? (this._firstPT = o = {
                _next: this._firstPT,
                t: t,
                p: e,
                s: i,
                c: a,
                f: "function" == typeof t[e],
                n: r || e,
                r: n
            }, o._next && (o._next._prev = o), o) : void 0
        }, r.setRatio = function (t) {
            for (var e, i = this._firstPT, s = 1e-6; i;) e = i.c * t + i.s, i.r ? e = 0 | e + (e > 0 ? .5 : -.5) : s > e && e > -s && (e = 0), i.f ? i.t[i.p](e) : i.t[i.p] = e, i = i._next
        }, r._kill = function (t) {
            var e, i = this._overwriteProps, s = this._firstPT;
            if (null != t[this._propName]) this._overwriteProps = []; else
                for (e = i.length; --e > -1;) null != t[i[e]] && i.splice(e, 1);
            for (; s;) null != t[s.n] && (s._next && (s._next._prev = s._prev), s._prev ? (s._prev._next = s._next, s._prev = null) : this._firstPT === s && (this._firstPT = s._next)), s = s._next;
            return !1
        }, r._roundProps = function (t, e) {
            for (var i = this._firstPT; i;) (t[this._propName] || null != i.n && t[i.n.split(this._propName + "_").join("")]) && (i.r = e), i = i._next
        }, D._onPluginEvent = function (t, e) {
            var i, s, r, n, a, o = e._firstPT;
            if ("_onInitAllProps" === t) {
                for (; o;) {
                    for (a = o._next, s = r; s && s.pr > o.pr;) s = s._next;
                    (o._prev = s ? s._prev : n) ? o._prev._next = o : r = o, (o._next = s) ? s._prev = o : n = o, o = a
                }
                o = e._firstPT = r
            }
            for (; o;) o.pg && "function" == typeof o.t[t] && o.t[t]() && (i = !0), o = o._next;
            return i
        }, M.activate = function (t) {
            for (var e = t.length; --e > -1;) t[e].API === M.API && (N[(new t[e])._propName] = t[e]);
            return !0
        }, c.plugin = function (t) {
            if (!(t && t.propName && t.init && t.API)) throw"illegal plugin definition.";
            var e, i = t.propName, s = t.priority || 0, r = t.overwriteProps, n = {
                init: "_onInitTween",
                set: "setRatio",
                kill: "_kill",
                round: "_roundProps",
                initAll: "_onInitAllProps"
            }, a = d("plugins." + i.charAt(0).toUpperCase() + i.substr(1) + "Plugin", function () {
                M.call(this, i, s), this._overwriteProps = r || []
            }, t.global === !0), o = a.prototype = new M(i);
            o.constructor = a, a.API = t.API;
            for (e in n) "function" == typeof t[e] && (o[n[e]] = t[e]);
            return a.version = t.version, M.activate([a]), a
        }, i = t._gsQueue) {
            for (s = 0; i.length > s; s++) i[s]();
            for (r in f) f[r].func || t.console.log("GSAP encountered missing dependency: com.greensock." + r)
        }
        a = !1
    }
})(window);
(window._gsQueue || (window._gsQueue = [])).push(function () {
    "use strict";
    window._gsDefine("TimelineLite", ["core.Animation", "core.SimpleTimeline", "TweenLite"], function (t, e, i) {
        var s = function (t) {
            e.call(this, t), this._labels = {}, this.autoRemoveChildren = this.vars.autoRemoveChildren === !0, this.smoothChildTiming = this.vars.smoothChildTiming === !0, this._sortChildren = !0, this._onUpdate = this.vars.onUpdate;
            var i, s, r = this.vars;
            for (s in r) i = r[s], a(i) && -1 !== i.join("").indexOf("{self}") && (r[s] = this._swapSelfInParams(i));
            a(r.tweens) && this.add(r.tweens, 0, r.align, r.stagger)
        }, r = 1e-10, n = i._internals.isSelector, a = i._internals.isArray, o = [], h = function (t) {
            var e, i = {};
            for (e in t) i[e] = t[e];
            return i
        }, l = function (t, e, i, s) {
            t._timeline.pause(t._startTime), e && e.apply(s || t._timeline, i || o)
        }, _ = o.slice, u = s.prototype = new e;
        return s.version = "1.11.5", u.constructor = s, u.kill()._gc = !1, u.to = function (t, e, s, r) {
            return e ? this.add(new i(t, e, s), r) : this.set(t, s, r)
        }, u.from = function (t, e, s, r) {
            return this.add(i.from(t, e, s), r)
        }, u.fromTo = function (t, e, s, r, n) {
            return e ? this.add(i.fromTo(t, e, s, r), n) : this.set(t, r, n)
        }, u.staggerTo = function (t, e, r, a, o, l, u, p) {
            var f, c = new s({
                onComplete: l,
                onCompleteParams: u,
                onCompleteScope: p,
                smoothChildTiming: this.smoothChildTiming
            });
            for ("string" == typeof t && (t = i.selector(t) || t), n(t) && (t = _.call(t, 0)), a = a || 0, f = 0; t.length > f; f++) r.startAt && (r.startAt = h(r.startAt)), c.to(t[f], e, h(r), f * a);
            return this.add(c, o)
        }, u.staggerFrom = function (t, e, i, s, r, n, a, o) {
            return i.immediateRender = 0 != i.immediateRender, i.runBackwards = !0, this.staggerTo(t, e, i, s, r, n, a, o)
        }, u.staggerFromTo = function (t, e, i, s, r, n, a, o, h) {
            return s.startAt = i, s.immediateRender = 0 != s.immediateRender && 0 != i.immediateRender, this.staggerTo(t, e, s, r, n, a, o, h)
        }, u.call = function (t, e, s, r) {
            return this.add(i.delayedCall(0, t, e, s), r)
        }, u.set = function (t, e, s) {
            return s = this._parseTimeOrLabel(s, 0, !0), null == e.immediateRender && (e.immediateRender = s === this._time && !this._paused), this.add(new i(t, 0, e), s)
        }, s.exportRoot = function (t, e) {
            t = t || {}, null == t.smoothChildTiming && (t.smoothChildTiming = !0);
            var r, n, a = new s(t), o = a._timeline;
            for (null == e && (e = !0), o._remove(a, !0), a._startTime = 0, a._rawPrevTime = a._time = a._totalTime = o._time, r = o._first; r;) n = r._next, e && r instanceof i && r.target === r.vars.onComplete || a.add(r, r._startTime - r._delay), r = n;
            return o.add(a, 0), a
        }, u.add = function (r, n, o, h) {
            var l, _, u, p, f, c;
            if ("number" != typeof n && (n = this._parseTimeOrLabel(n, 0, !0, r)), !(r instanceof t)) {
                if (r instanceof Array || r && r.push && a(r)) {
                    for (o = o || "normal", h = h || 0, l = n, _ = r.length, u = 0; _ > u; u++) a(p = r[u]) && (p = new s({tweens: p})), this.add(p, l), "string" != typeof p && "function" != typeof p && ("sequence" === o ? l = p._startTime + p.totalDuration() / p._timeScale : "start" === o && (p._startTime -= p.delay())), l += h;
                    return this._uncache(!0)
                }
                if ("string" == typeof r) return this.addLabel(r, n);
                if ("function" != typeof r) throw"Cannot add " + r + " into the timeline; it is not a tween, timeline, function, or string.";
                r = i.delayedCall(0, r)
            }
            if (e.prototype.add.call(this, r, n), (this._gc || this._time === this._duration) && !this._paused && this._duration < this.duration())
                for (f = this, c = f.rawTime() > r._startTime; f._timeline;) c && f._timeline.smoothChildTiming ? f.totalTime(f._totalTime, !0) : f._gc && f._enabled(!0, !1), f = f._timeline;
            return this
        }, u.remove = function (e) {
            if (e instanceof t) return this._remove(e, !1);
            if (e instanceof Array || e && e.push && a(e)) {
                for (var i = e.length; --i > -1;) this.remove(e[i]);
                return this
            }
            return "string" == typeof e ? this.removeLabel(e) : this.kill(null, e)
        }, u._remove = function (t, i) {
            e.prototype._remove.call(this, t, i);
            var s = this._last;
            return s ? this._time > s._startTime + s._totalDuration / s._timeScale && (this._time = this.duration(), this._totalTime = this._totalDuration) : this._time = this._totalTime = this._duration = this._totalDuration = 0, this
        }, u.append = function (t, e) {
            return this.add(t, this._parseTimeOrLabel(null, e, !0, t))
        }, u.insert = u.insertMultiple = function (t, e, i, s) {
            return this.add(t, e || 0, i, s)
        }, u.appendMultiple = function (t, e, i, s) {
            return this.add(t, this._parseTimeOrLabel(null, e, !0, t), i, s)
        }, u.addLabel = function (t, e) {
            return this._labels[t] = this._parseTimeOrLabel(e), this
        }, u.addPause = function (t, e, i, s) {
            return this.call(l, ["{self}", e, i, s], this, t)
        }, u.removeLabel = function (t) {
            return delete this._labels[t], this
        }, u.getLabelTime = function (t) {
            return null != this._labels[t] ? this._labels[t] : -1
        }, u._parseTimeOrLabel = function (e, i, s, r) {
            var n;
            if (r instanceof t && r.timeline === this) this.remove(r); else if (r && (r instanceof Array || r.push && a(r)))
                for (n = r.length; --n > -1;) r[n] instanceof t && r[n].timeline === this && this.remove(r[n]);
            if ("string" == typeof i) return this._parseTimeOrLabel(i, s && "number" == typeof e && null == this._labels[i] ? e - this.duration() : 0, s);
            if (i = i || 0, "string" != typeof e || !isNaN(e) && null == this._labels[e]) null == e && (e = this.duration()); else {
                if (n = e.indexOf("="), -1 === n) return null == this._labels[e] ? s ? this._labels[e] = this.duration() + i : i : this._labels[e] + i;
                i = parseInt(e.charAt(n - 1) + "1", 10) * Number(e.substr(n + 1)), e = n > 1 ? this._parseTimeOrLabel(e.substr(0, n - 1), 0, s) : this.duration()
            }
            return Number(e) + i
        }, u.seek = function (t, e) {
            return this.totalTime("number" == typeof t ? t : this._parseTimeOrLabel(t), e !== !1)
        }, u.stop = function () {
            return this.paused(!0)
        }, u.gotoAndPlay = function (t, e) {
            return this.play(t, e)
        }, u.gotoAndStop = function (t, e) {
            return this.pause(t, e)
        }, u.render = function (t, e, i) {
            this._gc && this._enabled(!0, !1);
            var s, n, a, h, l, _ = this._dirty ? this.totalDuration() : this._totalDuration, u = this._time,
                p = this._startTime, f = this._timeScale, c = this._paused;
            if (t >= _ ? (this._totalTime = this._time = _, this._reversed || this._hasPausedChild() || (n = !0, h = "onComplete", 0 === this._duration && (0 === t || 0 > this._rawPrevTime || this._rawPrevTime === r) && this._rawPrevTime !== t && this._first && (l = !0, this._rawPrevTime > r && (h = "onReverseComplete"))), this._rawPrevTime = this._duration || !e || t || 0 === this._rawPrevTime ? t : r, t = _ + 1e-4) : 1e-7 > t ? (this._totalTime = this._time = 0, (0 !== u || 0 === this._duration && (this._rawPrevTime > r || 0 > t && this._rawPrevTime >= 0)) && (h = "onReverseComplete", n = this._reversed), 0 > t ? (this._active = !1, 0 === this._duration && this._rawPrevTime >= 0 && this._first && (l = !0), this._rawPrevTime = t) : (this._rawPrevTime = this._duration || !e || t || 0 === this._rawPrevTime ? t : r, t = 0, this._initted || (l = !0))) : this._totalTime = this._time = this._rawPrevTime = t, this._time !== u && this._first || i || l) {
                if (this._initted || (this._initted = !0), this._active || !this._paused && this._time !== u && t > 0 && (this._active = !0), 0 === u && this.vars.onStart && 0 !== this._time && (e || this.vars.onStart.apply(this.vars.onStartScope || this, this.vars.onStartParams || o)), this._time >= u)
                    for (s = this._first; s && (a = s._next, !this._paused || c);) (s._active || s._startTime <= this._time && !s._paused && !s._gc) && (s._reversed ? s.render((s._dirty ? s.totalDuration() : s._totalDuration) - (t - s._startTime) * s._timeScale, e, i) : s.render((t - s._startTime) * s._timeScale, e, i)), s = a; else
                    for (s = this._last; s && (a = s._prev, !this._paused || c);) (s._active || u >= s._startTime && !s._paused && !s._gc) && (s._reversed ? s.render((s._dirty ? s.totalDuration() : s._totalDuration) - (t - s._startTime) * s._timeScale, e, i) : s.render((t - s._startTime) * s._timeScale, e, i)), s = a;
                this._onUpdate && (e || this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || o)), h && (this._gc || (p === this._startTime || f !== this._timeScale) && (0 === this._time || _ >= this.totalDuration()) && (n && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !e && this.vars[h] && this.vars[h].apply(this.vars[h + "Scope"] || this, this.vars[h + "Params"] || o)))
            }
        }, u._hasPausedChild = function () {
            for (var t = this._first; t;) {
                if (t._paused || t instanceof s && t._hasPausedChild()) return !0;
                t = t._next
            }
            return !1
        }, u.getChildren = function (t, e, s, r) {
            r = r || -9999999999;
            for (var n = [], a = this._first, o = 0; a;) r > a._startTime || (a instanceof i ? e !== !1 && (n[o++] = a) : (s !== !1 && (n[o++] = a), t !== !1 && (n = n.concat(a.getChildren(!0, e, s)), o = n.length))), a = a._next;
            return n
        }, u.getTweensOf = function (t, e) {
            for (var s = i.getTweensOf(t), r = s.length, n = [], a = 0; --r > -1;) (s[r].timeline === this || e && this._contains(s[r])) && (n[a++] = s[r]);
            return n
        }, u._contains = function (t) {
            for (var e = t.timeline; e;) {
                if (e === this) return !0;
                e = e.timeline
            }
            return !1
        }, u.shiftChildren = function (t, e, i) {
            i = i || 0;
            for (var s, r = this._first, n = this._labels; r;) r._startTime >= i && (r._startTime += t), r = r._next;
            if (e)
                for (s in n) n[s] >= i && (n[s] += t);
            return this._uncache(!0)
        }, u._kill = function (t, e) {
            if (!t && !e) return this._enabled(!1, !1);
            for (var i = e ? this.getTweensOf(e) : this.getChildren(!0, !0, !1), s = i.length, r = !1; --s > -1;) i[s]._kill(t, e) && (r = !0);
            return r
        }, u.clear = function (t) {
            var e = this.getChildren(!1, !0, !0), i = e.length;
            for (this._time = this._totalTime = 0; --i > -1;) e[i]._enabled(!1, !1);
            return t !== !1 && (this._labels = {}), this._uncache(!0)
        }, u.invalidate = function () {
            for (var t = this._first; t;) t.invalidate(), t = t._next;
            return this
        }, u._enabled = function (t, i) {
            if (t === this._gc)
                for (var s = this._first; s;) s._enabled(t, !0), s = s._next;
            return e.prototype._enabled.call(this, t, i)
        }, u.duration = function (t) {
            return arguments.length ? (0 !== this.duration() && 0 !== t && this.timeScale(this._duration / t), this) : (this._dirty && this.totalDuration(), this._duration)
        }, u.totalDuration = function (t) {
            if (!arguments.length) {
                if (this._dirty) {
                    for (var e, i, s = 0, r = this._last, n = 999999999999; r;) e = r._prev, r._dirty && r.totalDuration(), r._startTime > n && this._sortChildren && !r._paused ? this.add(r, r._startTime - r._delay) : n = r._startTime, 0 > r._startTime && !r._paused && (s -= r._startTime, this._timeline.smoothChildTiming && (this._startTime += r._startTime / this._timeScale), this.shiftChildren(-r._startTime, !1, -9999999999), n = 0), i = r._startTime + r._totalDuration / r._timeScale, i > s && (s = i), r = e;
                    this._duration = this._totalDuration = s, this._dirty = !1
                }
                return this._totalDuration
            }
            return 0 !== this.totalDuration() && 0 !== t && this.timeScale(this._totalDuration / t), this
        }, u.usesFrames = function () {
            for (var e = this._timeline; e._timeline;) e = e._timeline;
            return e === t._rootFramesTimeline
        }, u.rawTime = function () {
            return this._paused ? this._totalTime : (this._timeline.rawTime() - this._startTime) * this._timeScale
        }, s
    }, !0)
}), window._gsDefine && window._gsQueue.pop()();
(window._gsQueue || (window._gsQueue = [])).push(function () {
    "use strict";
    window._gsDefine("plugins.CSSPlugin", ["plugins.TweenPlugin", "TweenLite"], function (t, e) {
        var i, r, s, n, a = function () {
            t.call(this, "css"), this._overwriteProps.length = 0, this.setRatio = a.prototype.setRatio
        }, o = {}, l = a.prototype = new t("css");
        l.constructor = a, a.version = "1.11.5", a.API = 2, a.defaultTransformPerspective = 0, l = "px", a.suffixMap = {
            top: l,
            right: l,
            bottom: l,
            left: l,
            width: l,
            height: l,
            fontSize: l,
            padding: l,
            margin: l,
            perspective: l,
            lineHeight: ""
        };
        var h, u, _, p, f, c, d = /(?:\d|\-\d|\.\d|\-\.\d)+/g,
            m = /(?:\d|\-\d|\.\d|\-\.\d|\+=\d|\-=\d|\+=.\d|\-=\.\d)+/g,
            g = /(?:\+=|\-=|\-|\b)[\d\-\.]+[a-zA-Z0-9]*(?:%|\b)/gi, v = /[^\d\-\.]/g, y = /(?:\d|\-|\+|=|#|\.)*/g,
            T = /opacity *= *([^)]*)/, x = /opacity:([^;]*)/, w = /alpha\(opacity *=.+?\)/i, b = /^(rgb|hsl)/,
            P = /([A-Z])/g, S = /-([a-z])/gi, R = /(^(?:url\(\"|url\())|(?:(\"\))$|\)$)/gi, k = function (t, e) {
                return e.toUpperCase()
            }, C = /(?:Left|Right|Width)/i, A = /(M11|M12|M21|M22)=[\d\-\.e]+/gi,
            O = /progid\:DXImageTransform\.Microsoft\.Matrix\(.+?\)/i, D = /,(?=[^\)]*(?:\(|$))/gi, M = Math.PI / 180,
            L = 180 / Math.PI, N = {}, X = document, I = X.createElement("div"), E = X.createElement("img"),
            F = a._internals = {_specialProps: o}, Y = navigator.userAgent, z = function () {
                var t, e = Y.indexOf("Android"), i = X.createElement("div");
                return _ = -1 !== Y.indexOf("Safari") && -1 === Y.indexOf("Chrome") && (-1 === e || Number(Y.substr(e + 8, 1)) > 3), f = _ && 6 > Number(Y.substr(Y.indexOf("Version/") + 8, 1)), p = -1 !== Y.indexOf("Firefox"), /MSIE ([0-9]{1,}[\.0-9]{0,})/.exec(Y) && (c = parseFloat(RegExp.$1)), i.innerHTML = "<a style='top:1px;opacity:.55;'>a</a>", t = i.getElementsByTagName("a")[0], t ? /^0.55/.test(t.style.opacity) : !1
            }(), U = function (t) {
                return T.test("string" == typeof t ? t : (t.currentStyle ? t.currentStyle.filter : t.style.filter) || "") ? parseFloat(RegExp.$1) / 100 : 1
            }, B = function (t) {
            }, j = "", W = "", V = function (t, e) {
                e = e || I;
                var i, r, s = e.style;
                if (void 0 !== s[t]) return t;
                for (t = t.charAt(0).toUpperCase() + t.substr(1), i = ["O", "Moz", "ms", "Ms", "Webkit"], r = 5; --r > -1 && void 0 === s[i[r] + t];) ;
                return r >= 0 ? (W = 3 === r ? "ms" : i[r], j = "-" + W.toLowerCase() + "-", W + t) : null
            }, q = X.defaultView ? X.defaultView.getComputedStyle : function () {
            }, H = a.getStyle = function (t, e, i, r, s) {
                var n;
                return z || "opacity" !== e ? (!r && t.style[e] ? n = t.style[e] : (i = i || q(t, null)) ? (t = i.getPropertyValue(e.replace(P, "-$1").toLowerCase()), n = t || i.length ? t : i[e]) : t.currentStyle && (n = t.currentStyle[e]), null == s || n && "none" !== n && "auto" !== n && "auto auto" !== n ? n : s) : U(t)
            }, Q = function (t, e, i, r, s) {
                if ("px" === r || !r) return i;
                if ("auto" === r || !i) return 0;
                var n, a = C.test(e), o = t, l = I.style, h = 0 > i;
                return h && (i = -i), "%" === r && -1 !== e.indexOf("border") ? n = i / 100 * (a ? t.clientWidth : t.clientHeight) : (l.cssText = "border:0 solid red;position:" + H(t, "position") + ";line-height:0;", "%" !== r && o.appendChild ? l[a ? "borderLeftWidth" : "borderTopWidth"] = i + r : (o = t.parentNode || X.body, l[a ? "width" : "height"] = i + r), o.appendChild(I), n = parseFloat(I[a ? "offsetWidth" : "offsetHeight"]), o.removeChild(I), 0 !== n || s || (n = Q(t, e, i, r, !0))), h ? -n : n
            }, Z = function (t, e, i) {
                if ("absolute" !== H(t, "position", i)) return 0;
                var r = "left" === e ? "Left" : "Top", s = H(t, "margin" + r, i);
                return t["offset" + r] - (Q(t, e, parseFloat(s), s.replace(y, "")) || 0)
            }, $ = function (t, e) {
                var i, r, s = {};
                if (e = e || q(t, null))
                    if (i = e.length)
                        for (; --i > -1;) s[e[i].replace(S, k)] = e.getPropertyValue(e[i]); else
                        for (i in e) s[i] = e[i]; else if (e = t.currentStyle || t.style)
                    for (i in e) "string" == typeof i && void 0 === s[i] && (s[i.replace(S, k)] = e[i]);
                return z || (s.opacity = U(t)), r = be(t, e, !1), s.rotation = r.rotation, s.skewX = r.skewX, s.scaleX = r.scaleX, s.scaleY = r.scaleY, s.x = r.x, s.y = r.y, we && (s.z = r.z, s.rotationX = r.rotationX, s.rotationY = r.rotationY, s.scaleZ = r.scaleZ), s.filters && delete s.filters, s
            }, G = function (t, e, i, r, s) {
                var n, a, o, l = {}, h = t.style;
                for (a in i) "cssText" !== a && "length" !== a && isNaN(a) && (e[a] !== (n = i[a]) || s && s[a]) && -1 === a.indexOf("Origin") && ("number" == typeof n || "string" == typeof n) && (l[a] = "auto" !== n || "left" !== a && "top" !== a ? "" !== n && "auto" !== n && "none" !== n || "string" != typeof e[a] || "" === e[a].replace(v, "") ? n : 0 : Z(t, a), void 0 !== h[a] && (o = new _e(h, a, h[a], o)));
                if (r)
                    for (a in r) "className" !== a && (l[a] = r[a]);
                return {difs: l, firstMPT: o}
            }, K = {width: ["Left", "Right"], height: ["Top", "Bottom"]},
            J = ["marginLeft", "marginRight", "marginTop", "marginBottom"], te = function (t, e, i) {
                var r = parseFloat("width" === e ? t.offsetWidth : t.offsetHeight), s = K[e], n = s.length;
                for (i = i || q(t, null); --n > -1;) r -= parseFloat(H(t, "padding" + s[n], i, !0)) || 0, r -= parseFloat(H(t, "border" + s[n] + "Width", i, !0)) || 0;
                return r
            }, ee = function (t, e) {
                (null == t || "" === t || "auto" === t || "auto auto" === t) && (t = "0 0");
                var i = t.split(" "), r = -1 !== t.indexOf("left") ? "0%" : -1 !== t.indexOf("right") ? "100%" : i[0],
                    s = -1 !== t.indexOf("top") ? "0%" : -1 !== t.indexOf("bottom") ? "100%" : i[1];
                return null == s ? s = "0" : "center" === s && (s = "50%"), ("center" === r || isNaN(parseFloat(r)) && -1 === (r + "").indexOf("=")) && (r = "50%"), e && (e.oxp = -1 !== r.indexOf("%"), e.oyp = -1 !== s.indexOf("%"), e.oxr = "=" === r.charAt(1), e.oyr = "=" === s.charAt(1), e.ox = parseFloat(r.replace(v, "")), e.oy = parseFloat(s.replace(v, ""))), r + " " + s + (i.length > 2 ? " " + i[2] : "")
            }, ie = function (t, e) {
                return "string" == typeof t && "=" === t.charAt(1) ? parseInt(t.charAt(0) + "1", 10) * parseFloat(t.substr(2)) : parseFloat(t) - parseFloat(e)
            }, re = function (t, e) {
                return null == t ? e : "string" == typeof t && "=" === t.charAt(1) ? parseInt(t.charAt(0) + "1", 10) * Number(t.substr(2)) + e : parseFloat(t)
            }, se = function (t, e, i, r) {
                var s, n, a, o, l = 1e-6;
                return null == t ? o = e : "number" == typeof t ? o = t : (s = 360, n = t.split("_"), a = Number(n[0].replace(v, "")) * (-1 === t.indexOf("rad") ? 1 : L) - ("=" === t.charAt(1) ? 0 : e), n.length && (r && (r[i] = e + a), -1 !== t.indexOf("short") && (a %= s, a !== a % (s / 2) && (a = 0 > a ? a + s : a - s)), -1 !== t.indexOf("_cw") && 0 > a ? a = (a + 9999999999 * s) % s - (0 | a / s) * s : -1 !== t.indexOf("ccw") && a > 0 && (a = (a - 9999999999 * s) % s - (0 | a / s) * s)), o = e + a), l > o && o > -l && (o = 0), o
            }, ne = {
                aqua: [0, 255, 255],
                lime: [0, 255, 0],
                silver: [192, 192, 192],
                black: [0, 0, 0],
                maroon: [128, 0, 0],
                teal: [0, 128, 128],
                blue: [0, 0, 255],
                navy: [0, 0, 128],
                white: [255, 255, 255],
                fuchsia: [255, 0, 255],
                olive: [128, 128, 0],
                yellow: [255, 255, 0],
                orange: [255, 165, 0],
                gray: [128, 128, 128],
                purple: [128, 0, 128],
                green: [0, 128, 0],
                red: [255, 0, 0],
                pink: [255, 192, 203],
                cyan: [0, 255, 255],
                transparent: [255, 255, 255, 0]
            }, ae = function (t, e, i) {
                return t = 0 > t ? t + 1 : t > 1 ? t - 1 : t, 0 | 255 * (1 > 6 * t ? e + 6 * (i - e) * t : .5 > t ? i : 2 > 3 * t ? e + 6 * (i - e) * (2 / 3 - t) : e) + .5
            }, oe = function (t) {
                var e, i, r, s, n, a;
                return t && "" !== t ? "number" == typeof t ? [t >> 16, 255 & t >> 8, 255 & t] : ("," === t.charAt(t.length - 1) && (t = t.substr(0, t.length - 1)), ne[t] ? ne[t] : "#" === t.charAt(0) ? (4 === t.length && (e = t.charAt(1), i = t.charAt(2), r = t.charAt(3), t = "#" + e + e + i + i + r + r), t = parseInt(t.substr(1), 16), [t >> 16, 255 & t >> 8, 255 & t]) : "hsl" === t.substr(0, 3) ? (t = t.match(d), s = Number(t[0]) % 360 / 360, n = Number(t[1]) / 100, a = Number(t[2]) / 100, i = .5 >= a ? a * (n + 1) : a + n - a * n, e = 2 * a - i, t.length > 3 && (t[3] = Number(t[3])), t[0] = ae(s + 1 / 3, e, i), t[1] = ae(s, e, i), t[2] = ae(s - 1 / 3, e, i), t) : (t = t.match(d) || ne.transparent, t[0] = Number(t[0]), t[1] = Number(t[1]), t[2] = Number(t[2]), t.length > 3 && (t[3] = Number(t[3])), t)) : ne.black
            }, le = "(?:\\b(?:(?:rgb|rgba|hsl|hsla)\\(.+?\\))|\\B#.+?\\b";
        for (l in ne) le += "|" + l + "\\b";
        le = RegExp(le + ")", "gi");
        var he = function (t, e, i, r) {
            if (null == t) return function (t) {
                return t
            };
            var s, n = e ? (t.match(le) || [""])[0] : "", a = t.split(n).join("").match(g) || [],
                o = t.substr(0, t.indexOf(a[0])), l = ")" === t.charAt(t.length - 1) ? ")" : "",
                h = -1 !== t.indexOf(" ") ? " " : ",", u = a.length, _ = u > 0 ? a[0].replace(d, "") : "";
            return u ? s = e ? function (t) {
                var e, p, f, c;
                if ("number" == typeof t) t += _; else if (r && D.test(t)) {
                    for (c = t.replace(D, "|").split("|"), f = 0; c.length > f; f++) c[f] = s(c[f]);
                    return c.join(",")
                }
                if (e = (t.match(le) || [n])[0], p = t.split(e).join("").match(g) || [], f = p.length, u > f--)
                    for (; u > ++f;) p[f] = i ? p[0 | (f - 1) / 2] : a[f];
                return o + p.join(h) + h + e + l + (-1 !== t.indexOf("inset") ? " inset" : "")
            } : function (t) {
                var e, n, p;
                if ("number" == typeof t) t += _; else if (r && D.test(t)) {
                    for (n = t.replace(D, "|").split("|"), p = 0; n.length > p; p++) n[p] = s(n[p]);
                    return n.join(",")
                }
                if (e = t.match(g) || [], p = e.length, u > p--)
                    for (; u > ++p;) e[p] = i ? e[0 | (p - 1) / 2] : a[p];
                return o + e.join(h) + l
            } : function (t) {
                return t
            }
        }, ue = function (t) {
            return t = t.split(","), function (e, i, r, s, n, a, o) {
                var l, h = (i + "").split(" ");
                for (o = {}, l = 0; 4 > l; l++) o[t[l]] = h[l] = h[l] || h[(l - 1) / 2 >> 0];
                return s.parse(e, o, n, a)
            }
        }, _e = (F._setPluginRatio = function (t) {
            this.plugin.setRatio(t);
            for (var e, i, r, s, n = this.data, a = n.proxy, o = n.firstMPT, l = 1e-6; o;) e = a[o.v], o.r ? e = e > 0 ? 0 | e + .5 : 0 | e - .5 : l > e && e > -l && (e = 0), o.t[o.p] = e, o = o._next;
            if (n.autoRotate && (n.autoRotate.rotation = a.rotation), 1 === t)
                for (o = n.firstMPT; o;) {
                    if (i = o.t, i.type) {
                        if (1 === i.type) {
                            for (s = i.xs0 + i.s + i.xs1, r = 1; i.l > r; r++) s += i["xn" + r] + i["xs" + (r + 1)];
                            i.e = s
                        }
                    } else i.e = i.s + i.xs0;
                    o = o._next
                }
        }, function (t, e, i, r, s) {
            this.t = t, this.p = e, this.v = i, this.r = s, r && (r._prev = this, this._next = r)
        }), pe = (F._parseToProxy = function (t, e, i, r, s, n) {
            var a, o, l, h, u, _ = r, p = {}, f = {}, c = i._transform, d = N;
            for (i._transform = null, N = e, r = u = i.parse(t, e, r, s), N = d, n && (i._transform = c, _ && (_._prev = null, _._prev && (_._prev._next = null))); r && r !== _;) {
                if (1 >= r.type && (o = r.p, f[o] = r.s + r.c, p[o] = r.s, n || (h = new _e(r, "s", o, h, r.r), r.c = 0), 1 === r.type))
                    for (a = r.l; --a > 0;) l = "xn" + a, o = r.p + "_" + l, f[o] = r.data[l], p[o] = r[l], n || (h = new _e(r, l, o, h, r.rxp[l]));
                r = r._next
            }
            return {proxy: p, end: f, firstMPT: h, pt: u}
        }, F.CSSPropTween = function (t, e, r, s, a, o, l, h, u, _, p) {
            this.t = t, this.p = e, this.s = r, this.c = s, this.n = l || e, t instanceof pe || n.push(this.n), this.r = h, this.type = o || 0, u && (this.pr = u, i = !0), this.b = void 0 === _ ? r : _, this.e = void 0 === p ? r + s : p, a && (this._next = a, a._prev = this)
        }), fe = a.parseComplex = function (t, e, i, r, s, n, a, o, l, u) {
            i = i || n || "", a = new pe(t, e, 0, 0, a, u ? 2 : 1, null, !1, o, i, r), r += "";
            var _, p, f, c, g, v, y, T, x, w, P, S, R = i.split(", ").join(",").split(" "),
                k = r.split(", ").join(",").split(" "), C = R.length, A = h !== !1;
            for ((-1 !== r.indexOf(",") || -1 !== i.indexOf(",")) && (R = R.join(" ").replace(D, ", ").split(" "), k = k.join(" ").replace(D, ", ").split(" "), C = R.length), C !== k.length && (R = (n || "").split(" "), C = R.length), a.plugin = l, a.setRatio = u, _ = 0; C > _; _++)
                if (c = R[_], g = k[_], T = parseFloat(c), T || 0 === T) a.appendXtra("", T, ie(g, T), g.replace(m, ""), A && -1 !== g.indexOf("px"), !0); else if (s && ("#" === c.charAt(0) || ne[c] || b.test(c))) S = "," === g.charAt(g.length - 1) ? ")," : ")", c = oe(c), g = oe(g), x = c.length + g.length > 6, x && !z && 0 === g[3] ? (a["xs" + a.l] += a.l ? " transparent" : "transparent", a.e = a.e.split(k[_]).join("transparent")) : (z || (x = !1), a.appendXtra(x ? "rgba(" : "rgb(", c[0], g[0] - c[0], ",", !0, !0).appendXtra("", c[1], g[1] - c[1], ",", !0).appendXtra("", c[2], g[2] - c[2], x ? "," : S, !0), x && (c = 4 > c.length ? 1 : c[3], a.appendXtra("", c, (4 > g.length ? 1 : g[3]) - c, S, !1))); else if (v = c.match(d)) {
                    if (y = g.match(m), !y || y.length !== v.length) return a;
                    for (f = 0, p = 0; v.length > p; p++) P = v[p], w = c.indexOf(P, f), a.appendXtra(c.substr(f, w - f), Number(P), ie(y[p], P), "", A && "px" === c.substr(w + P.length, 2), 0 === p), f = w + P.length;
                    a["xs" + a.l] += c.substr(f)
                } else a["xs" + a.l] += a.l ? " " + c : c;
            if (-1 !== r.indexOf("=") && a.data) {
                for (S = a.xs0 + a.data.s, _ = 1; a.l > _; _++) S += a["xs" + _] + a.data["xn" + _];
                a.e = S + a["xs" + _]
            }
            return a.l || (a.type = -1, a.xs0 = a.e), a.xfirst || a
        }, ce = 9;
        for (l = pe.prototype, l.l = l.pr = 0; --ce > 0;) l["xn" + ce] = 0, l["xs" + ce] = "";
        l.xs0 = "", l._next = l._prev = l.xfirst = l.data = l.plugin = l.setRatio = l.rxp = null, l.appendXtra = function (t, e, i, r, s, n) {
            var a = this, o = a.l;
            return a["xs" + o] += n && o ? " " + t : t || "", i || 0 === o || a.plugin ? (a.l++, a.type = a.setRatio ? 2 : 1, a["xs" + a.l] = r || "", o > 0 ? (a.data["xn" + o] = e + i, a.rxp["xn" + o] = s, a["xn" + o] = e, a.plugin || (a.xfirst = new pe(a, "xn" + o, e, i, a.xfirst || a, 0, a.n, s, a.pr), a.xfirst.xs0 = 0), a) : (a.data = {s: e + i}, a.rxp = {}, a.s = e, a.c = i, a.r = s, a)) : (a["xs" + o] += e + (r || ""), a)
        };
        var de = function (t, e) {
            e = e || {}, this.p = e.prefix ? V(t) || t : t, o[t] = o[this.p] = this, this.format = e.formatter || he(e.defaultValue, e.color, e.collapsible, e.multi), e.parser && (this.parse = e.parser), this.clrs = e.color, this.multi = e.multi, this.keyword = e.keyword, this.dflt = e.defaultValue, this.pr = e.priority || 0
        }, me = F._registerComplexSpecialProp = function (t, e, i) {
            "object" != typeof e && (e = {parser: i});
            var r, s, n = t.split(","), a = e.defaultValue;
            for (i = i || [a], r = 0; n.length > r; r++) e.prefix = 0 === r && e.prefix, e.defaultValue = i[r] || a, s = new de(n[r], e)
        }, ge = function (t) {
            if (!o[t]) {
                var e = t.charAt(0).toUpperCase() + t.substr(1) + "Plugin";
                me(t, {
                    parser: function (t, i, r, s, n, a, l) {
                        var h = (window.GreenSockGlobals || window).com.greensock.plugins[e];
                        return h ? (h._cssRegister(), o[r].parse(t, i, r, s, n, a, l)) : (B("Error: " + e + " js file not loaded."), n)
                    }
                })
            }
        };
        l = de.prototype, l.parseComplex = function (t, e, i, r, s, n) {
            var a, o, l, h, u, _, p = this.keyword;
            if (this.multi && (D.test(i) || D.test(e) ? (o = e.replace(D, "|").split("|"), l = i.replace(D, "|").split("|")) : p && (o = [e], l = [i])), l) {
                for (h = l.length > o.length ? l.length : o.length, a = 0; h > a; a++) e = o[a] = o[a] || this.dflt, i = l[a] = l[a] || this.dflt, p && (u = e.indexOf(p), _ = i.indexOf(p), u !== _ && (i = -1 === _ ? l : o, i[a] += " " + p));
                e = o.join(", "), i = l.join(", ")
            }
            return fe(t, this.p, e, i, this.clrs, this.dflt, r, this.pr, s, n)
        }, l.parse = function (t, e, i, r, n, a) {
            return this.parseComplex(t.style, this.format(H(t, this.p, s, !1, this.dflt)), this.format(e), n, a)
        }, a.registerSpecialProp = function (t, e, i) {
            me(t, {
                parser: function (t, r, s, n, a, o) {
                    var l = new pe(t, s, 0, 0, a, 2, s, !1, i);
                    return l.plugin = o, l.setRatio = e(t, r, n._tween, s), l
                }, priority: i
            })
        };
        var ve = "scaleX,scaleY,scaleZ,x,y,z,skewX,rotation,rotationX,rotationY,perspective".split(","),
            ye = V("transform"), Te = j + "transform", xe = V("transformOrigin"), we = null !== V("perspective"),
            be = function (t, e, i, r) {
                if (t._gsTransform && i && !r) return t._gsTransform;
                var s, n, o, l, h, u, _, p, f, c, d, m, g, v = i ? t._gsTransform || {skewY: 0} : {skewY: 0},
                    y = 0 > v.scaleX, T = 2e-5, x = 1e5, w = 179.99, b = w * M,
                    P = we ? parseFloat(H(t, xe, e, !1, "0 0 0").split(" ")[2]) || v.zOrigin || 0 : 0;
                for (ye ? s = H(t, Te, e, !0) : t.currentStyle && (s = t.currentStyle.filter.match(A), s = s && 4 === s.length ? [s[0].substr(4), Number(s[2].substr(4)), Number(s[1].substr(4)), s[3].substr(4), v.x || 0, v.y || 0].join(",") : ""), n = (s || "").match(/(?:\-|\b)[\d\-\.e]+\b/gi) || [], o = n.length; --o > -1;) l = Number(n[o]), n[o] = (h = l - (l |= 0)) ? (0 | h * x + (0 > h ? -.5 : .5)) / x + l : l;
                if (16 === n.length) {
                    var S = n[8], R = n[9], k = n[10], C = n[12], O = n[13], D = n[14];
                    if (v.zOrigin && (D = -v.zOrigin, C = S * D - n[12], O = R * D - n[13], D = k * D + v.zOrigin - n[14]), !i || r || null == v.rotationX) {
                        var N, X, I, E, F, Y, z, U = n[0], B = n[1], j = n[2], W = n[3], V = n[4], q = n[5], Q = n[6],
                            Z = n[7], $ = n[11], G = Math.atan2(Q, k), K = -b > G || G > b;
                        v.rotationX = G * L, G && (E = Math.cos(-G), F = Math.sin(-G), N = V * E + S * F, X = q * E + R * F, I = Q * E + k * F, S = V * -F + S * E, R = q * -F + R * E, k = Q * -F + k * E, $ = Z * -F + $ * E, V = N, q = X, Q = I), G = Math.atan2(S, U), v.rotationY = G * L, G && (Y = -b > G || G > b, E = Math.cos(-G), F = Math.sin(-G), N = U * E - S * F, X = B * E - R * F, I = j * E - k * F, R = B * F + R * E, k = j * F + k * E, $ = W * F + $ * E, U = N, B = X, j = I), G = Math.atan2(B, q), v.rotation = G * L, G && (z = -b > G || G > b, E = Math.cos(-G), F = Math.sin(-G), U = U * E + V * F, X = B * E + q * F, q = B * -F + q * E, Q = j * -F + Q * E, B = X), z && K ? v.rotation = v.rotationX = 0 : z && Y ? v.rotation = v.rotationY = 0 : Y && K && (v.rotationY = v.rotationX = 0), v.scaleX = (0 | Math.sqrt(U * U + B * B) * x + .5) / x, v.scaleY = (0 | Math.sqrt(q * q + R * R) * x + .5) / x, v.scaleZ = (0 | Math.sqrt(Q * Q + k * k) * x + .5) / x, v.skewX = 0, v.perspective = $ ? 1 / (0 > $ ? -$ : $) : 0, v.x = C, v.y = O, v.z = D
                    }
                } else if (!(we && !r && n.length && v.x === n[4] && v.y === n[5] && (v.rotationX || v.rotationY) || void 0 !== v.x && "none" === H(t, "display", e))) {
                    var J = n.length >= 6, te = J ? n[0] : 1, ee = n[1] || 0, ie = n[2] || 0, re = J ? n[3] : 1;
                    v.x = n[4] || 0, v.y = n[5] || 0, u = Math.sqrt(te * te + ee * ee), _ = Math.sqrt(re * re + ie * ie), p = te || ee ? Math.atan2(ee, te) * L : v.rotation || 0, f = ie || re ? Math.atan2(ie, re) * L + p : v.skewX || 0, c = u - Math.abs(v.scaleX || 0), d = _ - Math.abs(v.scaleY || 0), Math.abs(f) > 90 && 270 > Math.abs(f) && (y ? (u *= -1, f += 0 >= p ? 180 : -180, p += 0 >= p ? 180 : -180) : (_ *= -1, f += 0 >= f ? 180 : -180)), m = (p - v.rotation) % 180, g = (f - v.skewX) % 180, (void 0 === v.skewX || c > T || -T > c || d > T || -T > d || m > -w && w > m && false | m * x || g > -w && w > g && false | g * x) && (v.scaleX = u, v.scaleY = _, v.rotation = p, v.skewX = f), we && (v.rotationX = v.rotationY = v.z = 0, v.perspective = parseFloat(a.defaultTransformPerspective) || 0, v.scaleZ = 1)
                }
                v.zOrigin = P;
                for (o in v) T > v[o] && v[o] > -T && (v[o] = 0);
                return i && (t._gsTransform = v), v
            }, Pe = function (t) {
                var e, i, r = this.data, s = -r.rotation * M, n = s + r.skewX * M, a = 1e5,
                    o = (0 | Math.cos(s) * r.scaleX * a) / a, l = (0 | Math.sin(s) * r.scaleX * a) / a,
                    h = (0 | Math.sin(n) * -r.scaleY * a) / a, u = (0 | Math.cos(n) * r.scaleY * a) / a, _ = this.t.style,
                    p = this.t.currentStyle;
                if (p) {
                    i = l, l = -h, h = -i, e = p.filter, _.filter = "";
                    var f, d, m = this.t.offsetWidth, g = this.t.offsetHeight, v = "absolute" !== p.position,
                        x = "progid:DXImageTransform.Microsoft.Matrix(M11=" + o + ", M12=" + l + ", M21=" + h + ", M22=" + u,
                        w = r.x, b = r.y;
                    if (null != r.ox && (f = (r.oxp ? .01 * m * r.ox : r.ox) - m / 2, d = (r.oyp ? .01 * g * r.oy : r.oy) - g / 2, w += f - (f * o + d * l), b += d - (f * h + d * u)), v ? (f = m / 2, d = g / 2, x += ", Dx=" + (f - (f * o + d * l) + w) + ", Dy=" + (d - (f * h + d * u) + b) + ")") : x += ", sizingMethod='auto expand')", _.filter = -1 !== e.indexOf("DXImageTransform.Microsoft.Matrix(") ? e.replace(O, x) : x + " " + e, (0 === t || 1 === t) && 1 === o && 0 === l && 0 === h && 1 === u && (v && -1 === x.indexOf("Dx=0, Dy=0") || T.test(e) && 100 !== parseFloat(RegExp.$1) || -1 === e.indexOf("gradient(" && e.indexOf("Alpha")) && _.removeAttribute("filter")), !v) {
                        var P, S, R, k = 8 > c ? 1 : -1;
                        for (f = r.ieOffsetX || 0, d = r.ieOffsetY || 0, r.ieOffsetX = Math.round((m - ((0 > o ? -o : o) * m + (0 > l ? -l : l) * g)) / 2 + w), r.ieOffsetY = Math.round((g - ((0 > u ? -u : u) * g + (0 > h ? -h : h) * m)) / 2 + b), ce = 0; 4 > ce; ce++) S = J[ce], P = p[S], i = -1 !== P.indexOf("px") ? parseFloat(P) : Q(this.t, S, parseFloat(P), P.replace(y, "")) || 0, R = i !== r[S] ? 2 > ce ? -r.ieOffsetX : -r.ieOffsetY : 2 > ce ? f - r.ieOffsetX : d - r.ieOffsetY, _[S] = (r[S] = Math.round(i - R * (0 === ce || 2 === ce ? 1 : k))) + "px"
                    }
                }
            }, Se = function () {
                var t, e, i, r, s, n, a, o, l, h, u, _, f, c, d, m, g, v, y, T, x, w, b, P = this.data, S = this.t.style,
                    R = P.rotation * M, k = P.scaleX, C = P.scaleY, A = P.scaleZ, O = P.perspective;
                if (p) {
                    var D = 1e-4;
                    D > k && k > -D && (k = A = 2e-5), D > C && C > -D && (C = A = 2e-5), !O || P.z || P.rotationX || P.rotationY || (O = 0)
                }
                if (R || P.skewX) v = Math.cos(R), y = Math.sin(R), t = v, s = y, P.skewX && (R -= P.skewX * M, v = Math.cos(R), y = Math.sin(R)), e = -y, n = v; else {
                    if (!(P.rotationY || P.rotationX || 1 !== A || O)) return S[ye] = "translate3d(" + P.x + "px," + P.y + "px," + P.z + "px)" + (1 !== k || 1 !== C ? " scale(" + k + "," + C + ")" : ""), void 0;
                    t = n = 1, e = s = 0
                }
                u = 1, i = r = a = o = l = h = _ = f = c = 0, d = O ? -1 / O : 0, m = P.zOrigin, g = 1e5, R = P.rotationY * M, R && (v = Math.cos(R), y = Math.sin(R), l = u * -y, f = d * -y, i = t * y, a = s * y, u *= v, d *= v, t *= v, s *= v), R = P.rotationX * M, R && (v = Math.cos(R), y = Math.sin(R), T = e * v + i * y, x = n * v + a * y, w = h * v + u * y, b = c * v + d * y, i = e * -y + i * v, a = n * -y + a * v, u = h * -y + u * v, d = c * -y + d * v, e = T, n = x, h = w, c = b), 1 !== A && (i *= A, a *= A, u *= A, d *= A), 1 !== C && (e *= C, n *= C, h *= C, c *= C), 1 !== k && (t *= k, s *= k, l *= k, f *= k), m && (_ -= m, r = i * _, o = a * _, _ = u * _ + m), r = (T = (r += P.x) - (r |= 0)) ? (0 | T * g + (0 > T ? -.5 : .5)) / g + r : r, o = (T = (o += P.y) - (o |= 0)) ? (0 | T * g + (0 > T ? -.5 : .5)) / g + o : o, _ = (T = (_ += P.z) - (_ |= 0)) ? (0 | T * g + (0 > T ? -.5 : .5)) / g + _ : _, S[ye] = "matrix3d(" + [(0 | t * g) / g, (0 | s * g) / g, (0 | l * g) / g, (0 | f * g) / g, (0 | e * g) / g, (0 | n * g) / g, (0 | h * g) / g, (0 | c * g) / g, (0 | i * g) / g, (0 | a * g) / g, (0 | u * g) / g, (0 | d * g) / g, r, o, _, O ? 1 + -_ / O : 1].join(",") + ")"
            }, Re = function (t) {
                var e, i, r, s, n, a = this.data, o = this.t, l = o.style;
                return a.rotationX || a.rotationY || a.z || a.force3D ? (this.setRatio = Se, Se.call(this, t), void 0) : (a.rotation || a.skewX ? (e = a.rotation * M, i = e - a.skewX * M, r = 1e5, s = a.scaleX * r, n = a.scaleY * r, l[ye] = "matrix(" + (0 | Math.cos(e) * s) / r + "," + (0 | Math.sin(e) * s) / r + "," + (0 | Math.sin(i) * -n) / r + "," + (0 | Math.cos(i) * n) / r + "," + a.x + "," + a.y + ")") : l[ye] = "matrix(" + a.scaleX + ",0,0," + a.scaleY + "," + a.x + "," + a.y + ")", void 0)
            };
        me("transform,scale,scaleX,scaleY,scaleZ,x,y,z,rotation,rotationX,rotationY,rotationZ,skewX,skewY,shortRotation,shortRotationX,shortRotationY,shortRotationZ,transformOrigin,transformPerspective,directionalRotation,parseTransform,force3D", {
            parser: function (t, e, i, r, n, a, o) {
                if (r._transform) return n;
                var l, h, u, _, p, f, c, d = r._transform = be(t, s, !0, o.parseTransform), m = t.style, g = 1e-6,
                    v = ve.length, y = o, T = {};
                if ("string" == typeof y.transform && ye) u = m.cssText, m[ye] = y.transform, m.display = "block", l = be(t, null, !1), m.cssText = u; else if ("object" == typeof y) {
                    if (l = {
                        scaleX: re(null != y.scaleX ? y.scaleX : y.scale, d.scaleX),
                        scaleY: re(null != y.scaleY ? y.scaleY : y.scale, d.scaleY),
                        scaleZ: re(y.scaleZ, d.scaleZ),
                        x: re(y.x, d.x),
                        y: re(y.y, d.y),
                        z: re(y.z, d.z),
                        perspective: re(y.transformPerspective, d.perspective)
                    }, c = y.directionalRotation, null != c)
                        if ("object" == typeof c)
                            for (u in c) y[u] = c[u]; else y.rotation = c;
                    l.rotation = se("rotation" in y ? y.rotation : "shortRotation" in y ? y.shortRotation + "_short" : "rotationZ" in y ? y.rotationZ : d.rotation, d.rotation, "rotation", T), we && (l.rotationX = se("rotationX" in y ? y.rotationX : "shortRotationX" in y ? y.shortRotationX + "_short" : d.rotationX || 0, d.rotationX, "rotationX", T), l.rotationY = se("rotationY" in y ? y.rotationY : "shortRotationY" in y ? y.shortRotationY + "_short" : d.rotationY || 0, d.rotationY, "rotationY", T)), l.skewX = null == y.skewX ? d.skewX : se(y.skewX, d.skewX), l.skewY = null == y.skewY ? d.skewY : se(y.skewY, d.skewY), (h = l.skewY - d.skewY) && (l.skewX += h, l.rotation += h)
                }
                for (we && null != y.force3D && (d.force3D = y.force3D, f = !0), p = d.force3D || d.z || d.rotationX || d.rotationY || l.z || l.rotationX || l.rotationY || l.perspective, p || null == y.scale || (l.scaleZ = 1); --v > -1;) i = ve[v], _ = l[i] - d[i], (_ > g || -g > _ || null != N[i]) && (f = !0, n = new pe(d, i, d[i], _, n), i in T && (n.e = T[i]), n.xs0 = 0, n.plugin = a, r._overwriteProps.push(n.n));
                return _ = y.transformOrigin, (_ || we && p && d.zOrigin) && (ye ? (f = !0, i = xe, _ = (_ || H(t, i, s, !1, "50% 50%")) + "", n = new pe(m, i, 0, 0, n, -1, "transformOrigin"), n.b = m[i], n.plugin = a, we ? (u = d.zOrigin, _ = _.split(" "), d.zOrigin = (_.length > 2 && (0 === u || "0px" !== _[2]) ? parseFloat(_[2]) : u) || 0, n.xs0 = n.e = m[i] = _[0] + " " + (_[1] || "50%") + " 0px", n = new pe(d, "zOrigin", 0, 0, n, -1, n.n), n.b = u, n.xs0 = n.e = d.zOrigin) : n.xs0 = n.e = m[i] = _) : ee(_ + "", d)), f && (r._transformType = p || 3 === this._transformType ? 3 : 2), n
            }, prefix: !0
        }), me("boxShadow", {
            defaultValue: "0px 0px 0px 0px #999",
            prefix: !0,
            color: !0,
            multi: !0,
            keyword: "inset"
        }), me("borderRadius", {
            defaultValue: "0px", parser: function (t, e, i, n, a) {
                e = this.format(e);
                var o, l, h, u, _, p, f, c, d, m, g, v, y, T, x, w,
                    b = ["borderTopLeftRadius", "borderTopRightRadius", "borderBottomRightRadius", "borderBottomLeftRadius"],
                    P = t.style;
                for (d = parseFloat(t.offsetWidth), m = parseFloat(t.offsetHeight), o = e.split(" "), l = 0; b.length > l; l++) this.p.indexOf("border") && (b[l] = V(b[l])), _ = u = H(t, b[l], s, !1, "0px"), -1 !== _.indexOf(" ") && (u = _.split(" "), _ = u[0], u = u[1]), p = h = o[l], f = parseFloat(_), v = _.substr((f + "").length), y = "=" === p.charAt(1), y ? (c = parseInt(p.charAt(0) + "1", 10), p = p.substr(2), c *= parseFloat(p), g = p.substr((c + "").length - (0 > c ? 1 : 0)) || "") : (c = parseFloat(p), g = p.substr((c + "").length)), "" === g && (g = r[i] || v), g !== v && (T = Q(t, "borderLeft", f, v), x = Q(t, "borderTop", f, v), "%" === g ? (_ = 100 * (T / d) + "%", u = 100 * (x / m) + "%") : "em" === g ? (w = Q(t, "borderLeft", 1, "em"), _ = T / w + "em", u = x / w + "em") : (_ = T + "px", u = x + "px"), y && (p = parseFloat(_) + c + g, h = parseFloat(u) + c + g)), a = fe(P, b[l], _ + " " + u, p + " " + h, !1, "0px", a);
                return a
            }, prefix: !0, formatter: he("0px 0px 0px 0px", !1, !0)
        }), me("backgroundPosition", {
            defaultValue: "0 0", parser: function (t, e, i, r, n, a) {
                var o, l, h, u, _, p, f = "background-position", d = s || q(t, null),
                    m = this.format((d ? c ? d.getPropertyValue(f + "-x") + " " + d.getPropertyValue(f + "-y") : d.getPropertyValue(f) : t.currentStyle.backgroundPositionX + " " + t.currentStyle.backgroundPositionY) || "0 0"),
                    g = this.format(e);
                if (-1 !== m.indexOf("%") != (-1 !== g.indexOf("%")) && (p = H(t, "backgroundImage").replace(R, ""), p && "none" !== p)) {
                    for (o = m.split(" "), l = g.split(" "), E.setAttribute("src", p), h = 2; --h > -1;) m = o[h], u = -1 !== m.indexOf("%"), u !== (-1 !== l[h].indexOf("%")) && (_ = 0 === h ? t.offsetWidth - E.width : t.offsetHeight - E.height, o[h] = u ? parseFloat(m) / 100 * _ + "px" : 100 * (parseFloat(m) / _) + "%");
                    m = o.join(" ")
                }
                return this.parseComplex(t.style, m, g, n, a)
            }, formatter: ee
        }), me("backgroundSize", {defaultValue: "0 0", formatter: ee}), me("perspective", {
            defaultValue: "0px",
            prefix: !0
        }), me("perspectiveOrigin", {
            defaultValue: "50% 50%",
            prefix: !0
        }), me("transformStyle", {prefix: !0}), me("backfaceVisibility", {prefix: !0}), me("userSelect", {prefix: !0}), me("margin", {parser: ue("marginTop,marginRight,marginBottom,marginLeft")}), me("padding", {parser: ue("paddingTop,paddingRight,paddingBottom,paddingLeft")}), me("clip", {
            defaultValue: "rect(0px,0px,0px,0px)",
            parser: function (t, e, i, r, n, a) {
                var o, l, h;
                return 9 > c ? (l = t.currentStyle, h = 8 > c ? " " : ",", o = "rect(" + l.clipTop + h + l.clipRight + h + l.clipBottom + h + l.clipLeft + ")", e = this.format(e).split(",").join(h)) : (o = this.format(H(t, this.p, s, !1, this.dflt)), e = this.format(e)), this.parseComplex(t.style, o, e, n, a)
            }
        }), me("textShadow", {
            defaultValue: "0px 0px 0px #999",
            color: !0,
            multi: !0
        }), me("autoRound,strictUnits", {
            parser: function (t, e, i, r, s) {
                return s
            }
        }), me("border", {
            defaultValue: "0px solid #000", parser: function (t, e, i, r, n, a) {
                return this.parseComplex(t.style, this.format(H(t, "borderTopWidth", s, !1, "0px") + " " + H(t, "borderTopStyle", s, !1, "solid") + " " + H(t, "borderTopColor", s, !1, "#000")), this.format(e), n, a)
            }, color: !0, formatter: function (t) {
                var e = t.split(" ");
                return e[0] + " " + (e[1] || "solid") + " " + (t.match(le) || ["#000"])[0]
            }
        }), me("borderWidth", {parser: ue("borderTopWidth,borderRightWidth,borderBottomWidth,borderLeftWidth")}), me("float,cssFloat,styleFloat", {
            parser: function (t, e, i, r, s) {
                var n = t.style, a = "cssFloat" in n ? "cssFloat" : "styleFloat";
                return new pe(n, a, 0, 0, s, -1, i, !1, 0, n[a], e)
            }
        });
        var ke = function (t) {
            var e, i = this.t, r = i.filter || H(this.data, "filter"), s = 0 | this.s + this.c * t;
            100 === s && (-1 === r.indexOf("atrix(") && -1 === r.indexOf("radient(") && -1 === r.indexOf("oader(") ? (i.removeAttribute("filter"), e = !H(this.data, "filter")) : (i.filter = r.replace(w, ""), e = !0)), e || (this.xn1 && (i.filter = r = r || "alpha(opacity=" + s + ")"), -1 === r.indexOf("opacity") ? 0 === s && this.xn1 || (i.filter = r + " alpha(opacity=" + s + ")") : i.filter = r.replace(T, "opacity=" + s))
        };
        me("opacity,alpha,autoAlpha", {
            defaultValue: "1", parser: function (t, e, i, r, n, a) {
                var o = parseFloat(H(t, "opacity", s, !1, "1")), l = t.style, h = "autoAlpha" === i;
                return "string" == typeof e && "=" === e.charAt(1) && (e = ("-" === e.charAt(0) ? -1 : 1) * parseFloat(e.substr(2)) + o), h && 1 === o && "hidden" === H(t, "visibility", s) && 0 !== e && (o = 0), z ? n = new pe(l, "opacity", o, e - o, n) : (n = new pe(l, "opacity", 100 * o, 100 * (e - o), n), n.xn1 = h ? 1 : 0, l.zoom = 1, n.type = 2, n.b = "alpha(opacity=" + n.s + ")", n.e = "alpha(opacity=" + (n.s + n.c) + ")", n.data = t, n.plugin = a, n.setRatio = ke), h && (n = new pe(l, "visibility", 0, 0, n, -1, null, !1, 0, 0 !== o ? "inherit" : "hidden", 0 === e ? "hidden" : "inherit"), n.xs0 = "inherit", r._overwriteProps.push(n.n), r._overwriteProps.push(i)), n
            }
        });
        var Ce = function (t, e) {
            e && (t.removeProperty ? t.removeProperty(e.replace(P, "-$1").toLowerCase()) : t.removeAttribute(e))
        }, Ae = function (t) {
            if (this.t._gsClassPT = this, 1 === t || 0 === t) {
                this.t.className = 0 === t ? this.b : this.e;
                for (var e = this.data, i = this.t.style; e;) e.v ? i[e.p] = e.v : Ce(i, e.p), e = e._next;
                1 === t && this.t._gsClassPT === this && (this.t._gsClassPT = null)
            } else this.t.className !== this.e && (this.t.className = this.e)
        };
        me("className", {
            parser: function (t, e, r, n, a, o, l) {
                var h, u, _, p, f, c = t.className, d = t.style.cssText;
                if (a = n._classNamePT = new pe(t, r, 0, 0, a, 2), a.setRatio = Ae, a.pr = -11, i = !0, a.b = c, u = $(t, s), _ = t._gsClassPT) {
                    for (p = {}, f = _.data; f;) p[f.p] = 1, f = f._next;
                    _.setRatio(1)
                }
                return t._gsClassPT = a, a.e = "=" !== e.charAt(1) ? e : c.replace(RegExp("\\s*\\b" + e.substr(2) + "\\b"), "") + ("+" === e.charAt(0) ? " " + e.substr(2) : ""), n._tween._duration && (t.className = a.e, h = G(t, u, $(t), l, p), t.className = c, a.data = h.firstMPT, t.style.cssText = d, a = a.xfirst = n.parse(t, h.difs, a, o)), a
            }
        });
        var Oe = function (t) {
            if ((1 === t || 0 === t) && this.data._totalTime === this.data._totalDuration && "isFromStart" !== this.data.data) {
                var e, i, r, s, n = this.t.style, a = o.transform.parse;
                if ("all" === this.e) n.cssText = "", s = !0; else
                    for (e = this.e.split(","), r = e.length; --r > -1;) i = e[r], o[i] && (o[i].parse === a ? s = !0 : i = "transformOrigin" === i ? xe : o[i].p), Ce(n, i);
                s && (Ce(n, ye), this.t._gsTransform && delete this.t._gsTransform)
            }
        };
        for (me("clearProps", {
            parser: function (t, e, r, s, n) {
                return n = new pe(t, r, 0, 0, n, 2), n.setRatio = Oe, n.e = e, n.pr = -10, n.data = s._tween, i = !0, n
            }
        }), l = "bezier,throwProps,physicsProps,physics2D".split(","), ce = l.length; ce--;) ge(l[ce]);
        l = a.prototype, l._firstPT = null, l._onInitTween = function (t, e, o) {
            if (!t.nodeType) return !1;
            this._target = t, this._tween = o, this._vars = e, h = e.autoRound, i = !1, r = e.suffixMap || a.suffixMap, s = q(t, ""), n = this._overwriteProps;
            var l, p, c, d, m, g, v, y, T, w = t.style;
            if (u && "" === w.zIndex && (l = H(t, "zIndex", s), ("auto" === l || "" === l) && (w.zIndex = 0)), "string" == typeof e && (d = w.cssText, l = $(t, s), w.cssText = d + ";" + e, l = G(t, l, $(t)).difs, !z && x.test(e) && (l.opacity = parseFloat(RegExp.$1)), e = l, w.cssText = d), this._firstPT = p = this.parse(t, e, null), this._transformType) {
                for (T = 3 === this._transformType, ye ? _ && (u = !0, "" === w.zIndex && (v = H(t, "zIndex", s), ("auto" === v || "" === v) && (w.zIndex = 0)), f && (w.WebkitBackfaceVisibility = this._vars.WebkitBackfaceVisibility || (T ? "visible" : "hidden"))) : w.zoom = 1, c = p; c && c._next;) c = c._next;
                y = new pe(t, "transform", 0, 0, null, 2), this._linkCSSP(y, null, c), y.setRatio = T && we ? Se : ye ? Re : Pe, y.data = this._transform || be(t, s, !0), n.pop()
            }
            if (i) {
                for (; p;) {
                    for (g = p._next, c = d; c && c.pr > p.pr;) c = c._next;
                    (p._prev = c ? c._prev : m) ? p._prev._next = p : d = p, (p._next = c) ? c._prev = p : m = p, p = g
                }
                this._firstPT = d
            }
            return !0
        }, l.parse = function (t, e, i, n) {
            var a, l, u, _, p, f, c, d, m, g, v = t.style;
            for (a in e) f = e[a], l = o[a], l ? i = l.parse(t, f, a, this, i, n, e) : (p = H(t, a, s) + "", m = "string" == typeof f, "color" === a || "fill" === a || "stroke" === a || -1 !== a.indexOf("Color") || m && b.test(f) ? (m || (f = oe(f), f = (f.length > 3 ? "rgba(" : "rgb(") + f.join(",") + ")"), i = fe(v, a, p, f, !0, "transparent", i, 0, n)) : !m || -1 === f.indexOf(" ") && -1 === f.indexOf(",") ? (u = parseFloat(p), c = u || 0 === u ? p.substr((u + "").length) : "", ("" === p || "auto" === p) && ("width" === a || "height" === a ? (u = te(t, a, s), c = "px") : "left" === a || "top" === a ? (u = Z(t, a, s), c = "px") : (u = "opacity" !== a ? 0 : 1, c = "")), g = m && "=" === f.charAt(1), g ? (_ = parseInt(f.charAt(0) + "1", 10), f = f.substr(2), _ *= parseFloat(f), d = f.replace(y, "")) : (_ = parseFloat(f), d = m ? f.substr((_ + "").length) || "" : ""), "" === d && (d = a in r ? r[a] : c), f = _ || 0 === _ ? (g ? _ + u : _) + d : e[a], c !== d && "" !== d && (_ || 0 === _) && (u || 0 === u) && (u = Q(t, a, u, c), "%" === d ? (u /= Q(t, a, 100, "%") / 100, e.strictUnits !== !0 && (p = u + "%")) : "em" === d ? u /= Q(t, a, 1, "em") : (_ = Q(t, a, _, d), d = "px"), g && (_ || 0 === _) && (f = _ + u + d)), g && (_ += u), !u && 0 !== u || !_ && 0 !== _ ? void 0 !== v[a] && (f || "NaN" != f + "" && null != f) ? (i = new pe(v, a, _ || u || 0, 0, i, -1, a, !1, 0, p, f), i.xs0 = "none" !== f || "display" !== a && -1 === a.indexOf("Style") ? f : p) : B("invalid " + a + " tween value: " + e[a]) : (i = new pe(v, a, u, _ - u, i, 0, a, h !== !1 && ("px" === d || "zIndex" === a), 0, p, f), i.xs0 = d)) : i = fe(v, a, p, f, !0, null, i, 0, n)), n && i && !i.plugin && (i.plugin = n);
            return i
        }, l.setRatio = function (t) {
            var e, i, r, s = this._firstPT, n = 1e-6;
            if (1 !== t || this._tween._time !== this._tween._duration && 0 !== this._tween._time)
                if (t || this._tween._time !== this._tween._duration && 0 !== this._tween._time || this._tween._rawPrevTime === -1e-6)
                    for (; s;) {
                        if (e = s.c * t + s.s, s.r ? e = e > 0 ? 0 | e + .5 : 0 | e - .5 : n > e && e > -n && (e = 0), s.type)
                            if (1 === s.type)
                                if (r = s.l, 2 === r) s.t[s.p] = s.xs0 + e + s.xs1 + s.xn1 + s.xs2; else if (3 === r) s.t[s.p] = s.xs0 + e + s.xs1 + s.xn1 + s.xs2 + s.xn2 + s.xs3; else if (4 === r) s.t[s.p] = s.xs0 + e + s.xs1 + s.xn1 + s.xs2 + s.xn2 + s.xs3 + s.xn3 + s.xs4; else if (5 === r) s.t[s.p] = s.xs0 + e + s.xs1 + s.xn1 + s.xs2 + s.xn2 + s.xs3 + s.xn3 + s.xs4 + s.xn4 + s.xs5; else {
                                    for (i = s.xs0 + e + s.xs1, r = 1; s.l > r; r++) i += s["xn" + r] + s["xs" + (r + 1)];
                                    s.t[s.p] = i
                                } else -1 === s.type ? s.t[s.p] = s.xs0 : s.setRatio && s.setRatio(t); else s.t[s.p] = e + s.xs0;
                        s = s._next
                    } else
                    for (; s;) 2 !== s.type ? s.t[s.p] = s.b : s.setRatio(t), s = s._next; else
                for (; s;) 2 !== s.type ? s.t[s.p] = s.e : s.setRatio(t), s = s._next
        }, l._enableTransforms = function (t) {
            this._transformType = t || 3 === this._transformType ? 3 : 2, this._transform = this._transform || be(this._target, s, !0)
        }, l._linkCSSP = function (t, e, i, r) {
            return t && (e && (e._prev = t), t._next && (t._next._prev = t._prev), t._prev ? t._prev._next = t._next : this._firstPT === t && (this._firstPT = t._next, r = !0), i ? i._next = t : r || null !== this._firstPT || (this._firstPT = t), t._next = e, t._prev = i), t
        }, l._kill = function (e) {
            var i, r, s, n = e;
            if (e.autoAlpha || e.alpha) {
                n = {};
                for (r in e) n[r] = e[r];
                n.opacity = 1, n.autoAlpha && (n.visibility = 1)
            }
            return e.className && (i = this._classNamePT) && (s = i.xfirst, s && s._prev ? this._linkCSSP(s._prev, i._next, s._prev._prev) : s === this._firstPT && (this._firstPT = i._next), i._next && this._linkCSSP(i._next, i._next._next, s._prev), this._classNamePT = null), t.prototype._kill.call(this, n)
        };
        var De = function (t, e, i) {
            var r, s, n, a;
            if (t.slice)
                for (s = t.length; --s > -1;) De(t[s], e, i); else
                for (r = t.childNodes, s = r.length; --s > -1;) n = r[s], a = n.type, n.style && (e.push($(n)), i && i.push(n)), 1 !== a && 9 !== a && 11 !== a || !n.childNodes.length || De(n, e, i)
        };
        return a.cascadeTo = function (t, i, r) {
            var s, n, a, o = e.to(t, i, r), l = [o], h = [], u = [], _ = [], p = e._internals.reservedProps;
            for (t = o._targets || o.target, De(t, h, _), o.render(i, !0), De(t, u), o.render(0, !0), o._enabled(!0), s = _.length; --s > -1;)
                if (n = G(_[s], h[s], u[s]), n.firstMPT) {
                    n = n.difs;
                    for (a in r) p[a] && (n[a] = r[a]);
                    l.push(e.to(_[s], i, n))
                }
            return l
        }, t.activate([a]), a
    }, !0)
}), window._gsDefine && window._gsQueue.pop()();

function revslider_showDoubleJqueryError(e) {
    var t = "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
    t += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
    t += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
    t += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
    t = "<span style='font-size:16px;color:#BC0C06;'>" + t + "</span>";
    jQuery(e).show().html(t)
}

(function (e, t) {
    function n(e) {
        var t = [], n;
        var r = window.location.href.slice(window.location.href.indexOf(e) + 1).split("_");
        for (var i = 0; i < r.length; i++) {
            r[i] = r[i].replace("%3D", "=");
            n = r[i].split("=");
            t.push(n[0]);
            t[n[0]] = n[1]
        }
        return t
    }

    function r(n, i) {
        try {
            if (i.hideThumbsUnderResoluition != 0 && i.navigationType == "thumb") {
                if (i.hideThumbsUnderResoluition > e(window).width()) e(".tp-bullets").css({display: "none"}); else e(".tp-bullets").css({display: "block"})
            }
        } catch (s) {
        }
        n.find(".defaultimg").each(function (t) {
            g(e(this), i)
        });
        var o = n.parent();
        if (e(window).width() < i.hideSliderAtLimit) {
            n.trigger("stoptimer");
            if (o.css("display") != "none") o.data("olddisplay", o.css("display"));
            o.css({display: "none"})
        } else {
            if (n.is(":hidden")) {
                if (o.data("olddisplay") != t && o.data("olddisplay") != "undefined" && o.data("olddisplay") != "none") o.css({display: o.data("olddisplay")}); else o.css({display: "block"});
                n.trigger("restarttimer");
                setTimeout(function () {
                    r(n, i)
                }, 150)
            }
        }
        var u = 0;
        if (i.forceFullWidth == "on") u = 0 - i.container.parent().offset().left;
        try {
            n.parent().find(".tp-bannershadow").css({width: i.width, left: u})
        } catch (s) {
        }
        var a = n.find(">ul >li:eq(" + i.act + ") .slotholder");
        var f = n.find(">ul >li:eq(" + i.next + ") .slotholder");
        S(n, i);
        f.find(".defaultimg").css({opacity: 0});
        a.find(".defaultimg").css({opacity: 1});
        f.find(".defaultimg").each(function () {
            var n = e(this);
            if (n.data("kenburn") != t) n.data("kenburn").restart()
        });
        var l = n.find(">ul >li:eq(" + i.next + ")");
        V(l, i, true);
        m(n, i)
    }

    function s() {
        var e = ["android", "webos", "iphone", "ipad", "blackberry", "Android", "webos", , "iPod", "iPhone", "iPad", "Blackberry", "BlackBerry"];
        var t = false;
        for (i in e) {
            if (navigator.userAgent.split(e[i]).length > 1) {
                t = true
            }
        }
        return t
    }

    function o(t, n) {
        var r = e('<div style="display:none;"/>').appendTo(e("body"));
        r.html("<!--[if " + (n || "") + " IE " + (t || "") + "]><a>&nbsp;</a><![endif]-->");
        var i = r.find("a").length;
        r.remove();
        return i
    }

    function u(e, t) {
        C(t, e)
    }

    function a(n, r) {
        var i = n.parent();
        if (r.navigationType == "thumb" || r.navsecond == "both") {
            i.append('<div class="tp-bullets tp-thumbs ' + r.navigationStyle + '"><div class="tp-mask"><div class="tp-thumbcontainer"></div></div></div>')
        }
        var s = i.find(".tp-bullets.tp-thumbs .tp-mask .tp-thumbcontainer");
        var o = s.parent();
        o.width(r.thumbWidth * r.thumbAmount);
        o.height(r.thumbHeight);
        o.parent().width(r.thumbWidth * r.thumbAmount);
        o.parent().height(r.thumbHeight);
        n.find(">ul:first >li").each(function (e) {
            var i = n.find(">ul:first >li:eq(" + e + ")");
            var o = i.find(".defaultimg").css("backgroundColor");
            if (i.data("thumb") != t) var u = i.data("thumb"); else var u = i.find("img:first").attr("src");
            s.append('<div class="bullet thumb" style="background-color:' + o + ";position:relative;width:" + r.thumbWidth + "px;height:" + r.thumbHeight + "px;background-image:url(" + u + ') !important;background-size:cover;background-position:center center;"></div>');
            var a = s.find(".bullet:first")
        });
        var a = 10;
        s.find(".bullet").each(function (t) {
            var i = e(this);
            if (t == r.slideamount - 1) i.addClass("last");
            if (t == 0) i.addClass("first");
            i.width(r.thumbWidth);
            i.height(r.thumbHeight);
            if (a < i.outerWidth(true)) a = i.outerWidth(true);
            i.click(function () {
                if (r.transition == 0 && i.index() != r.act) {
                    r.next = i.index();
                    u(r, n)
                }
            })
        });
        var c = a * n.find(">ul:first >li").length;
        var h = s.parent().width();
        r.thumbWidth = a;
        if (h < c) {
            e(document).mousemove(function (t) {
                e("body").data("mousex", t.pageX)
            });
            s.parent().mouseenter(function () {
                var t = e(this);
                t.addClass("over");
                var r = t.offset();
                var i = e("body").data("mousex") - r.left;
                var s = t.width();
                var o = t.find(".bullet:first").outerWidth(true);
                var u = o * n.find(">ul:first >li").length;
                var a = u - s + 15;
                var f = a / s;
                i = i - 30;
                var c = 0 - i * f;
                if (c > 0) c = 0;
                if (c < 0 - u + s) c = 0 - u + s;
                l(t, c, 200)
            });
            s.parent().mousemove(function () {
                var t = e(this);
                var r = t.offset();
                var i = e("body").data("mousex") - r.left;
                var s = t.width();
                var o = t.find(".bullet:first").outerWidth(true);
                var u = o * n.find(">ul:first >li").length - 1;
                var a = u - s + 15;
                var f = a / s;
                i = i - 3;
                if (i < 6) i = 0;
                if (i + 3 > s - 6) i = s;
                var c = 0 - i * f;
                if (c > 0) c = 0;
                if (c < 0 - u + s) c = 0 - u + s;
                l(t, c, 0)
            });
            s.parent().mouseleave(function () {
                var t = e(this);
                t.removeClass("over");
                f(n)
            })
        }
    }

    function f(e) {
        var t = e.parent().find(".tp-bullets.tp-thumbs .tp-mask .tp-thumbcontainer");
        var n = t.parent();
        var r = n.offset();
        var i = n.find(".bullet:first").outerWidth(true);
        var s = n.find(".bullet.selected").index() * i;
        var o = n.width();
        var i = n.find(".bullet:first").outerWidth(true);
        var u = i * e.find(">ul:first >li").length;
        var a = u - o;
        var f = a / o;
        var c = 0 - s;
        if (c > 0) c = 0;
        if (c < 0 - u + o) c = 0 - u + o;
        if (!n.hasClass("over")) {
            l(n, c, 200)
        }
    }

    function l(e, t, n) {
        TweenLite.to(e.find(".tp-thumbcontainer"), .2, {left: t, ease: Power3.easeOut, overwrite: "auto"})
    }

    function c(t, n) {
        if (n.navigationType == "bullet" || n.navigationType == "both") {
            t.parent().append('<div class="tp-bullets simplebullets ' + n.navigationStyle + '"></div>')
        }
        var r = t.parent().find(".tp-bullets");
        t.find(">ul:first >li").each(function (e) {
            var n = t.find(">ul:first >li:eq(" + e + ") img:first").attr("src");
            r.append('<div class="bullet"></div>');
            var i = r.find(".bullet:first")
        });
        r.find(".bullet").each(function (r) {
            var i = e(this);
            if (r == n.slideamount - 1) i.addClass("last");
            if (r == 0) i.addClass("first");
            i.click(function () {
                var e = false;
                if (n.navigationArrows == "withbullet" || n.navigationArrows == "nexttobullets") {
                    if (i.index() - 1 == n.act) e = true
                } else {
                    if (i.index() == n.act) e = true
                }
                if (n.transition == 0 && !e) {
                    if (n.navigationArrows == "withbullet" || n.navigationArrows == "nexttobullets") {
                        n.next = i.index() - 1
                    } else {
                        n.next = i.index()
                    }
                    u(n, t)
                }
            })
        });
        r.append('<div class="tpclear"></div>');
        m(t, n)
    }

    function h(e, n) {
        var r = e.find(".tp-bullets");
        var i = "";
        var s = n.navigationStyle;
        if (n.navigationArrows == "none") i = "visibility:hidden;display:none";
        n.soloArrowStyle = "default";
        if (n.navigationArrows != "none" && n.navigationArrows != "nexttobullets") s = n.soloArrowStyle;
        e.parent().append('<div style="' + i + '" class="tp-leftarrow tparrows ' + s + '"></div>');
        e.parent().append('<div style="' + i + '" class="tp-rightarrow tparrows ' + s + '"></div>');
        e.parent().find(".tp-rightarrow").click(function () {
            if (n.transition == 0) {
                if (e.data("showus") != t && e.data("showus") != -1) n.next = e.data("showus") - 1; else n.next = n.next + 1;
                e.data("showus", -1);
                if (n.next >= n.slideamount) n.next = 0;
                if (n.next < 0) n.next = 0;
                if (n.act != n.next) u(n, e)
            }
        });
        e.parent().find(".tp-leftarrow").click(function () {
            if (n.transition == 0) {
                n.next = n.next - 1;
                n.leftarrowpressed = 1;
                if (n.next < 0) n.next = n.slideamount - 1;
                u(n, e)
            }
        });
        m(e, n)
    }

    function p(n, r) {
        e(document).keydown(function (e) {
            if (r.transition == 0 && e.keyCode == 39) {
                if (n.data("showus") != t && n.data("showus") != -1) r.next = n.data("showus") - 1; else r.next = r.next + 1;
                n.data("showus", -1);
                if (r.next >= r.slideamount) r.next = 0;
                if (r.next < 0) r.next = 0;
                if (r.act != r.next) u(r, n)
            }
            if (r.transition == 0 && e.keyCode == 37) {
                r.next = r.next - 1;
                r.leftarrowpressed = 1;
                if (r.next < 0) r.next = r.slideamount - 1;
                u(r, n)
            }
        });
        m(n, r)
    }

    function d(t, n) {
        if (n.touchenabled == "on") {
            var r = Hammer(t, {
                drag_block_vertical: n.drag_block_vertical,
                drag_lock_to_axis: true,
                swipe_velocity: n.swipe_velocity,
                swipe_max_touches: n.swipe_max_touches,
                swipe_min_touches: n.swipe_min_touches,
                prevent_default: false
            });
            r.on("swipeleft", function () {
                if (n.transition == 0) {
                    n.next = n.next + 1;
                    if (n.next == n.slideamount) n.next = 0;
                    u(n, t)
                }
            });
            r.on("swiperight", function () {
                if (n.transition == 0) {
                    n.next = n.next - 1;
                    n.leftarrowpressed = 1;
                    if (n.next < 0) n.next = n.slideamount - 1;
                    u(n, t)
                }
            });
            r.on("swipeup", function () {
                e("html, body").animate({scrollTop: t.offset().top + t.height() + "px"})
            });
            r.on("swipedown", function () {
                e("html, body").animate({scrollTop: t.offset().top - e(window).height() + "px"})
            })
        }
    }

    function v(e, t) {
        var n = e.parent().find(".tp-bullets");
        var r = e.parent().find(".tparrows");
        if (n == null) {
            e.append('<div class=".tp-bullets"></div>');
            var n = e.parent().find(".tp-bullets")
        }
        if (r == null) {
            e.append('<div class=".tparrows"></div>');
            var r = e.parent().find(".tparrows")
        }
        e.data("hidethumbs", t.hideThumbs);
        n.addClass("hidebullets");
        r.addClass("hidearrows");
        if (s()) {
            e.hammer().on("touch", function () {
                e.addClass("hovered");
                if (t.onHoverStop == "on") e.trigger("stoptimer");
                clearTimeout(e.data("hidethumbs"));
                n.removeClass("hidebullets");
                r.removeClass("hidearrows")
            });
            e.hammer().on("release", function () {
                e.removeClass("hovered");
                e.trigger("playtimer");
                if (!e.hasClass("hovered") && !n.hasClass("hovered")) e.data("hidethumbs", setTimeout(function () {
                    n.addClass("hidebullets");
                    r.addClass("hidearrows");
                    e.trigger("playtimer")
                }, t.hideNavDelayOnMobile))
            })
        } else {
            n.hover(function () {
                t.overnav = true;
                if (t.onHoverStop == "on") e.trigger("stoptimer");
                n.addClass("hovered");
                clearTimeout(e.data("hidethumbs"));
                n.removeClass("hidebullets");
                r.removeClass("hidearrows")
            }, function () {
                t.overnav = false;
                e.trigger("playtimer");
                n.removeClass("hovered");
                if (!e.hasClass("hovered") && !n.hasClass("hovered")) e.data("hidethumbs", setTimeout(function () {
                    n.addClass("hidebullets");
                    r.addClass("hidearrows")
                }, t.hideThumbs))
            });
            r.hover(function () {
                t.overnav = true;
                if (t.onHoverStop == "on") e.trigger("stoptimer");
                n.addClass("hovered");
                clearTimeout(e.data("hidethumbs"));
                n.removeClass("hidebullets");
                r.removeClass("hidearrows")
            }, function () {
                t.overnav = false;
                e.trigger("playtimer");
                n.removeClass("hovered")
            });
            e.on("mouseenter", function () {
                e.addClass("hovered");
                if (t.onHoverStop == "on") e.trigger("stoptimer");
                clearTimeout(e.data("hidethumbs"));
                n.removeClass("hidebullets");
                r.removeClass("hidearrows")
            });
            e.on("mouseleave", function () {
                e.removeClass("hovered");
                e.trigger("playtimer");
                if (!e.hasClass("hovered") && !n.hasClass("hovered")) e.data("hidethumbs", setTimeout(function () {
                    n.addClass("hidebullets");
                    r.addClass("hidearrows")
                }, t.hideThumbs))
            })
        }
    }

    function m(t, n) {
        var r = t.parent();
        var i = r.find(".tp-bullets");
        if (n.navigationType == "thumb") {
            i.find(".thumb").each(function (t) {
                var r = e(this);
                r.css({width: n.thumbWidth * n.bw + "px", height: n.thumbHeight * n.bh + "px"})
            });
            var s = i.find(".tp-mask");
            s.width(n.thumbWidth * n.thumbAmount * n.bw);
            s.height(n.thumbHeight * n.bh);
            s.parent().width(n.thumbWidth * n.thumbAmount * n.bw);
            s.parent().height(n.thumbHeight * n.bh)
        }
        var o = r.find(".tp-leftarrow");
        var u = r.find(".tp-rightarrow");
        if (n.navigationType == "thumb" && n.navigationArrows == "nexttobullets") n.navigationArrows = "solo";
        if (n.navigationArrows == "nexttobullets") {
            o.prependTo(i).css({"float": "left"});
            u.insertBefore(i.find(".tpclear")).css({"float": "left"})
        }
        var a = 0;
        if (n.forceFullWidth == "on") a = 0 - n.container.parent().offset().left;
        if (n.navigationArrows != "none" && n.navigationArrows != "nexttobullets") {
            o.css({position: "absolute"});
            u.css({position: "absolute"});
            if (n.soloArrowLeftValign == "center") o.css({
                top: "50%",
                marginTop: n.soloArrowLeftVOffset - Math.round(o.innerHeight() / 2) + "px"
            });
            if (n.soloArrowLeftValign == "bottom") o.css({top: "auto", bottom: 0 + n.soloArrowLeftVOffset + "px"});
            if (n.soloArrowLeftValign == "top") o.css({bottom: "auto", top: 0 + n.soloArrowLeftVOffset + "px"});
            if (n.soloArrowLeftHalign == "center") o.css({
                left: "50%",
                marginLeft: a + n.soloArrowLeftHOffset - Math.round(o.innerWidth() / 2) + "px"
            });
            if (n.soloArrowLeftHalign == "left") o.css({left: 0 + n.soloArrowLeftHOffset + a + "px"});
            if (n.soloArrowLeftHalign == "right") o.css({right: 0 + n.soloArrowLeftHOffset - a + "px"});
            if (n.soloArrowRightValign == "center") u.css({
                top: "50%",
                marginTop: n.soloArrowRightVOffset - Math.round(u.innerHeight() / 2) + "px"
            });
            if (n.soloArrowRightValign == "bottom") u.css({top: "auto", bottom: 0 + n.soloArrowRightVOffset + "px"});
            if (n.soloArrowRightValign == "top") u.css({bottom: "auto", top: 0 + n.soloArrowRightVOffset + "px"});
            if (n.soloArrowRightHalign == "center") u.css({
                left: "50%",
                marginLeft: a + n.soloArrowRightHOffset - Math.round(u.innerWidth() / 2) + "px"
            });
            if (n.soloArrowRightHalign == "left") u.css({left: 0 + n.soloArrowRightHOffset + a + "px"});
            if (n.soloArrowRightHalign == "right") u.css({right: 0 + n.soloArrowRightHOffset - a + "px"});
            if (o.position() != null) o.css({top: Math.round(parseInt(o.position().top, 0)) + "px"});
            if (u.position() != null) u.css({top: Math.round(parseInt(u.position().top, 0)) + "px"})
        }
        if (n.navigationArrows == "none") {
            o.css({visibility: "hidden"});
            u.css({visibility: "hidden"})
        }
        if (n.navigationVAlign == "center") i.css({
            top: "50%",
            marginTop: n.navigationVOffset - Math.round(i.innerHeight() / 2) + "px"
        });
        if (n.navigationVAlign == "bottom") i.css({bottom: 0 + n.navigationVOffset + "px"});
        if (n.navigationVAlign == "top") i.css({top: 0 + n.navigationVOffset + "px"});
        if (n.navigationHAlign == "center") i.css({
            left: "50%",
            marginLeft: a + n.navigationHOffset - Math.round(i.innerWidth() / 2) + "px"
        });
        if (n.navigationHAlign == "left") i.css({left: 0 + n.navigationHOffset + a + "px"});
        if (n.navigationHAlign == "right") i.css({right: 0 + n.navigationHOffset - a + "px"})
    }

    function g(n, r) {
        r.container.closest(".forcefullwidth_wrapper_tp_banner").find(".tp-fullwidth-forcer").css({height: r.container.height()});
        r.container.closest(".rev_slider_wrapper").css({height: r.container.height()});
        r.width = parseInt(r.container.width(), 0);
        r.height = parseInt(r.container.height(), 0);
        r.bw = r.width / r.startwidth;
        r.bh = r.height / r.startheight;
        if (r.bh > r.bw) r.bh = r.bw;
        if (r.bh < r.bw) r.bw = r.bh;
        if (r.bw < r.bh) r.bh = r.bw;
        if (r.bh > 1) {
            r.bw = 1;
            r.bh = 1
        }
        if (r.bw > 1) {
            r.bw = 1;
            r.bh = 1
        }
        r.height = Math.round(r.startheight * (r.width / r.startwidth));
        if (r.height > r.startheight && r.autoHeight != "on") r.height = r.startheight;
        if (r.fullScreen == "on") {
            r.height = r.bw * r.startheight;
            var i = r.container.parent().width();
            var s = e(window).height();
            if (r.fullScreenOffsetContainer != t) {
                try {
                    var o = r.fullScreenOffsetContainer.split(",");
                    e.each(o, function (t, n) {
                        s = s - e(n).outerHeight(true);
                        if (s < r.minFullScreenHeight) s = r.minFullScreenHeight
                    })
                } catch (u) {
                }
            }
            r.container.parent().height(s);
            r.container.css({height: "100%"});
            r.height = s
        } else {
            r.container.height(r.height)
        }
        r.slotw = Math.ceil(r.width / r.slots);
        if (r.fullSreen == "on") r.sloth = Math.ceil(e(window).height() / r.slots); else r.sloth = Math.ceil(r.height / r.slots);
        if (r.autoHeight == "on") r.sloth = Math.ceil(n.height() / r.slots)
    }

    function y(n, r) {
        n.find(".tp-caption").each(function () {
            e(this).addClass(e(this).data("transition"));
            e(this).addClass("start")
        });
        n.find(">ul:first").css({
            overflow: "hidden",
            width: "100%",
            height: "100%",
            maxHeight: n.parent().css("maxHeight")
        });
        if (r.autoHeight == "on") {
            n.find(">ul:first").css({overflow: "hidden", width: "100%", height: "100%", maxHeight: "none"});
            n.css({maxHeight: "none"});
            n.parent().css({maxHeight: "none"})
        }
        n.find(">ul:first >li").each(function (n) {
            var r = e(this);
            r.css({width: "100%", height: "100%", overflow: "hidden"});
            if (r.data("link") != t) {
                var i = r.data("link");
                var s = "_self";
                var o = 60;
                if (r.data("slideindex") == "back") o = 0;
                var u = r.data("linktoslide");
                if (r.data("target") != t) s = r.data("target");
                if (i == "slide") {
                    r.append('<div class="tp-caption sft slidelink" style="width:100%;height:100%;z-index:' + o + ';" data-x="0" data-y="0" data-linktoslide="' + u + '" data-start="0"><a style="width:100%;height:100%;display:block"><span style="width:100%;height:100%;display:block"></span></a></div>')
                } else {
                    u = "no";
                    r.append('<div class="tp-caption sft slidelink" style="width:100%;height:100%;z-index:' + o + ';" data-x="0" data-y="0" data-linktoslide="' + u + '" data-start="0"><a style="width:100%;height:100%;display:block" target="' + s + '" href="' + i + '"><span style="width:100%;height:100%;display:block"></span></a></div>')
                }
            }
        });
        n.parent().css({overflow: "visible"});
        n.find(">ul:first >li >img").each(function (n) {
            var i = e(this);
            i.addClass("defaultimg");
            if (i.data("lazyload") != t && i.data("lazydone") != 1) {
            } else {
                g(i, r)
            }
            i.wrap('<div class="slotholder" style="width:100%;height:100%;"' + 'data-duration="' + i.data("duration") + '"' + 'data-zoomstart="' + i.data("zoomstart") + '"' + 'data-zoomend="' + i.data("zoomend") + '"' + 'data-rotationstart="' + i.data("rotationstart") + '"' + 'data-rotationend="' + i.data("rotationend") + '"' + 'data-ease="' + i.data("ease") + '"' + 'data-duration="' + i.data("duration") + '"' + 'data-bgpositionend="' + i.data("bgpositionend") + '"' + 'data-bgposition="' + i.data("bgposition") + '"' + 'data-duration="' + i.data("duration") + '"' + 'data-kenburns="' + i.data("kenburns") + '"' + 'data-easeme="' + i.data("ease") + '"' + 'data-bgfit="' + i.data("bgfit") + '"' + 'data-bgfitend="' + i.data("bgfitend") + '"' + 'data-owidth="' + i.data("owidth") + '"' + 'data-oheight="' + i.data("oheight") + '"' + "></div>");
            if (r.dottedOverlay != "none" && r.dottedOverlay != t) i.closest(".slotholder").append('<div class="tp-dottedoverlay ' + r.dottedOverlay + '"></div>');
            var s = i.attr("src");
            var a = i.data("bgfit");
            var f = i.data("bgrepeat");
            var l = i.data("bgposition");
            if (a == t) a = "cover";
            if (f == t) f = "no-repeat";
            if (l == t) l = "center center";
            var c = i.closest(".slotholder");
            i.replaceWith('<div class="tp-bgimg defaultimg" data-lazyload="' + i.data("lazyload") + '" data-bgfit="' + a + '"data-bgposition="' + l + '" data-bgrepeat="' + f + '" data-lazydone="' + i.data("lazydone") + '" src="' + s + '" data-src="' + s + '" style="background-color:' + i.css("backgroundColor") + ";background-repeat:" + f + ";background-image:url(" + s + ");background-size:" + a + ";background-position:" + l + ';width:100%;height:100%;"></div>');
            if (o(8)) {
                c.find(".tp-bgimg").css({backgroundImage: "none", "background-image": "none"});
                c.find(".tp-bgimg").append('<img class="ieeightfallbackimage defaultimg" src="' + s + '" style="width:100%">')
            }
            i.css({opacity: 0});
            i.data("li-id", n)
        })
    }

    function b(e, n, r, i) {
        var s = e;
        var u = s.find(".defaultimg");
        var a = s.data("zoomstart");
        var f = s.data("rotationstart");
        if (u.data("currotate") != t) f = u.data("currotate");
        if (u.data("curscale") != t) a = u.data("curscale");
        g(u, n);
        var l = u.data("src");
        var c = u.css("background-color");
        var h = n.width;
        var p = n.height;
        if (n.autoHeight == "on") p = n.container.height();
        var d = u.data("fxof");
        if (d == t) d = 0;
        fullyoff = 0;
        var v = 0;
        var m = u.data("bgfit");
        var y = u.data("bgrepeat");
        var b = u.data("bgposition");
        if (m == t) m = "cover";
        if (y == t) y = "no-repeat";
        if (b == t) b = "center center";
        if (s.data("kenburns") == "on") {
            m = a;
            if (m.toString().length < 4) m = D(m, s, n)
        }
        if (o(8)) {
            var w = l;
            l = ""
        }
        if (i == "horizontal") {
            if (!r) var v = 0 - n.slotw;
            for (var S = 0; S < n.slots; S++) {
                s.append('<div class="slot" style="position:absolute;' + "top:" + (0 + fullyoff) + "px;" + "left:" + (d + S * n.slotw) + "px;" + "overflow:hidden;width:" + n.slotw + "px;" + "height:" + p + 'px">' + '<div class="slotslide" style="position:absolute;' + "top:0px;left:" + v + "px;" + "width:" + n.slotw + "px;" + "height:" + p + 'px;overflow:hidden;">' + '<div style="background-color:' + c + ";" + "position:absolute;top:0px;" + "left:" + (0 - S * n.slotw) + "px;" + "width:" + h + "px;height:" + p + "px;" + "background-image:url(" + l + ");" + "background-repeat:" + y + ";" + "background-size:" + m + ";background-position:" + b + ';">' + "</div></div></div>");
                if (a != t && f != t) TweenLite.set(s.find(".slot").last(), {rotationZ: f});
                if (o(8)) {
                    s.find(".slot ").last().find(".slotslide").append('<img class="ieeightfallbackimage" src="' + w + '" style="width:100%;height:auto">');
                    E(s, n)
                }
            }
        } else {
            if (!r) var v = 0 - n.sloth;
            for (var S = 0; S < n.slots + 2; S++) {
                s.append('<div class="slot" style="position:absolute;' + "top:" + (fullyoff + S * n.sloth) + "px;" + "left:" + d + "px;" + "overflow:hidden;" + "width:" + h + "px;" + "height:" + n.sloth + 'px">' + '<div class="slotslide" style="position:absolute;' + "top:" + v + "px;" + "left:0px;width:" + h + "px;" + "height:" + n.sloth + "px;" + 'overflow:hidden;">' + '<div style="background-color:' + c + ";" + "position:absolute;" + "top:" + (0 - S * n.sloth) + "px;" + "left:0px;" + "width:" + h + "px;height:" + p + "px;" + "background-image:url(" + l + ");" + "background-repeat:" + y + ";" + "background-size:" + m + ";background-position:" + b + ';">' + "</div></div></div>");
                if (a != t && f != t) TweenLite.set(s.find(".slot").last(), {rotationZ: f});
                if (o(8)) {
                    s.find(".slot ").last().find(".slotslide").append('<img class="ieeightfallbackimage" src="' + w + '" style="width:100%;height:auto;">');
                    E(s, n)
                }
            }
        }
    }

    function w(e, n, r) {
        var i = e;
        var s = i.find(".defaultimg");
        var u = i.data("zoomstart");
        var a = i.data("rotationstart");
        if (s.data("currotate") != t) a = s.data("currotate");
        if (s.data("curscale") != t) u = s.data("curscale") * 100;
        g(s, n);
        var f = s.data("src");
        var l = s.css("backgroundColor");
        var c = n.width;
        var h = n.height;
        if (n.autoHeight == "on") h = n.container.height();
        var p = s.data("fxof");
        if (p == t) p = 0;
        fullyoff = 0;
        var d = 0;
        if (o(8)) {
            var v = f;
            f = ""
        }
        var m = 0;
        if (n.sloth > n.slotw) m = n.sloth; else m = n.slotw;
        if (!r) {
            var d = 0 - m
        }
        n.slotw = m;
        n.sloth = m;
        var y = 0;
        var b = 0;
        var w = s.data("bgfit");
        var S = s.data("bgrepeat");
        var x = s.data("bgposition");
        if (w == t) w = "cover";
        if (S == t) S = "no-repeat";
        if (x == t) x = "center center";
        if (i.data("kenburns") == "on") {
            w = u;
            if (w.toString().length < 4) w = D(w, i, n)
        }
        for (var T = 0; T < n.slots; T++) {
            b = 0;
            for (var N = 0; N < n.slots; N++) {
                i.append('<div class="slot" ' + 'style="position:absolute;' + "top:" + (fullyoff + b) + "px;" + "left:" + (p + y) + "px;" + "width:" + m + "px;" + "height:" + m + "px;" + 'overflow:hidden;">' + '<div class="slotslide" data-x="' + y + '" data-y="' + b + '" ' + 'style="position:absolute;' + "top:" + 0 + "px;" + "left:" + 0 + "px;" + "width:" + m + "px;" + "height:" + m + "px;" + 'overflow:hidden;">' + '<div style="position:absolute;' + "top:" + (0 - b) + "px;" + "left:" + (0 - y) + "px;" + "width:" + c + "px;" + "height:" + h + "px;" + "background-color:" + l + ";" + "background-image:url(" + f + ");" + "background-repeat:" + S + ";" + "background-size:" + w + ";background-position:" + x + ';">' + "</div></div></div>");
                b = b + m;
                if (o(8)) {
                    i.find(".slot ").last().find(".slotslide").append('<img src="' + v + '">');
                    E(i, n)
                }
                if (u != t && a != t) TweenLite.set(i.find(".slot").last(), {rotationZ: a})
            }
            y = y + m
        }
    }

    function E(e, t) {
        if (o(8)) {
            var n = e.find(".ieeightfallbackimage");
            var r = n.width(), i = n.height();
            if (t.startwidth / t.startheight < e.data("owidth") / e.data("oheight")) n.css({
                width: "auto",
                height: "100%"
            }); else n.css({width: "100%", height: "auto"});
            setTimeout(function () {
                var r = n.width(), i = n.height();
                if (e.data("bgposition") == "center center") n.css({
                    position: "absolute",
                    top: t.height / 2 - i / 2 + "px",
                    left: t.width / 2 - r / 2 + "px"
                });
                if (e.data("bgposition") == "center top" || e.data("bgposition") == "top center") n.css({
                    position: "absolute",
                    top: "0px",
                    left: t.width / 2 - r / 2 + "px"
                });
                if (e.data("bgposition") == "center bottom" || e.data("bgposition") == "bottom center") n.css({
                    position: "absolute",
                    bottom: "0px",
                    left: t.width / 2 - r / 2 + "px"
                });
                if (e.data("bgposition") == "right top" || e.data("bgposition") == "top right") n.css({
                    position: "absolute",
                    top: "0px",
                    right: "0px"
                });
                if (e.data("bgposition") == "right bottom" || e.data("bgposition") == "bottom right") n.css({
                    position: "absolute",
                    bottom: "0px",
                    right: "0px"
                });
                if (e.data("bgposition") == "right center" || e.data("bgposition") == "center right") n.css({
                    position: "absolute",
                    top: t.height / 2 - i / 2 + "px",
                    right: "0px"
                });
                if (e.data("bgposition") == "left bottom" || e.data("bgposition") == "bottom left") n.css({
                    position: "absolute",
                    bottom: "0px",
                    left: "0px"
                });
                if (e.data("bgposition") == "left center" || e.data("bgposition") == "center left") n.css({
                    position: "absolute",
                    top: t.height / 2 - i / 2 + "px",
                    left: "0px"
                })
            }, 20)
        }
    }

    function S(n, r, i) {
        if (i == t) i == 80;
        setTimeout(function () {
            n.find(".slotholder .slot").each(function () {
                clearTimeout(e(this).data("tout"));
                e(this).remove()
            });
            r.transition = 0
        }, i)
    }

    function x(n, r) {
        n.find("img, .defaultimg").each(function (n) {
            var i = e(this);
            if (i.data("lazyload") != i.attr("src") && r < 3 && i.data("lazyload") != t && i.data("lazyload") != "undefined") {
                if (i.data("lazyload") != t && i.data("lazyload") != "undefined") {
                    i.attr("src", i.data("lazyload"));
                    var s = new Image;
                    s.onload = function (e) {
                        i.data("lazydone", 1);
                        if (i.hasClass("defaultimg")) T(i, s)
                    };
                    s.error = function () {
                        i.data("lazydone", 1)
                    };
                    s.src = i.attr("src");
                    if (s.complete) {
                        if (i.hasClass("defaultimg")) T(i, s);
                        i.data("lazydone", 1)
                    }
                }
            } else {
                if ((i.data("lazyload") === t || i.data("lazyload") === "undefined") && i.data("lazydone") != 1) {
                    var s = new Image;
                    s.onload = function () {
                        if (i.hasClass("defaultimg")) T(i, s);
                        i.data("lazydone", 1)
                    };
                    s.error = function () {
                        i.data("lazydone", 1)
                    };
                    if (i.attr("src") != t && i.attr("src") != "undefined") {
                        s.src = i.attr("src")
                    } else s.src = i.data("src");
                    if (s.complete) {
                        if (i.hasClass("defaultimg")) {
                            T(i, s)
                        }
                        i.data("lazydone", 1)
                    }
                }
            }
        })
    }

    function T(e, t) {
        var n = e.closest("li");
        var r = t.width;
        var i = t.height;
        n.data("owidth", r);
        n.data("oheight", i);
        n.find(".slotholder").data("owidth", r);
        n.find(".slotholder").data("oheight", i);
        n.data("loadeddone", 1)
    }

    function C(e, n) {
        try {
            var r = e.find(">ul:first-child >li:eq(" + n.act + ")")
        } catch (i) {
            var r = e.find(">ul:first-child >li:eq(1)")
        }
        n.lastslide = n.act;
        var s = e.find(">ul:first-child >li:eq(" + n.next + ")");
        var u = s.find(".defaultimg");
        n.bannertimeronpause = true;
        e.trigger("stoptimer");
        n.cd = 0;
        if (u.data("lazyload") != t && u.data("lazyload") != "undefined" && u.data("lazydone") != 1) {
            if (!o(8)) u.css({backgroundImage: 'url("' + s.find(".defaultimg").data("lazyload") + '")'}); else {
                u.attr("src", s.find(".defaultimg").data("lazyload"))
            }
            u.data("src", s.find(".defaultimg").data("lazyload"));
            u.data("lazydone", 1);
            u.data("orgw", 0);
            s.data("loadeddone", 1);
            TweenLite.set(e.find(".tp-loader"), {display: "block", opacity: 0});
            TweenLite.to(e.find(".tp-loader"), .3, {autoAlpha: 1});
            N(s, function () {
                k(n, u, e)
            }, n)
        } else {
            if (s.data("loadeddone") === t) {
                s.data("loadeddone", 1);
                N(s, function () {
                    k(n, u, e)
                }, n)
            } else k(n, u, e)
        }
    }

    function k(e, t, n) {
        e.bannertimeronpause = false;
        e.cd = 0;
        n.trigger("nulltimer");
        TweenLite.to(n.find(".tp-loader"), .3, {autoAlpha: 0});
        g(t, e);
        m(n, e);
        g(t, e);
        L(n, e)
    }

    function L(n, r) {
        function x() {
            e.each(v, function (e, t) {
                if (t[0] == p || t[8] == p) {
                    l = t[1];
                    d = t[2];
                    y = E
                }
                E = E + 1
            })
        }

        n.trigger("revolution.slide.onbeforeswap");
        r.transition = 1;
        r.videoplaying = false;
        try {
            var i = n.find(">ul:first-child >li:eq(" + r.act + ")")
        } catch (s) {
            var i = n.find(">ul:first-child >li:eq(1)")
        }
        r.lastslide = r.act;
        var u = n.find(">ul:first-child >li:eq(" + r.next + ")");
        var a = i.find(".slotholder");
        var f = u.find(".slotholder");
        i.css({visibility: "visible"});
        u.css({visibility: "visible"});
        if (f.data("kenburns") == "on") M(n, r);
        if (r.ie) {
            if (p == "boxfade") p = "boxslide";
            if (p == "slotfade-vertical") p = "slotzoom-vertical";
            if (p == "slotfade-horizontal") p = "slotzoom-horizontal"
        }
        if (u.data("delay") != t) {
            r.cd = 0;
            r.delay = u.data("delay")
        } else {
            r.delay = r.origcd
        }
        n.trigger("restarttimer");
        i.css({left: "0px", top: "0px"});
        u.css({left: "0px", top: "0px"});
        if (u.data("differentissplayed") == "prepared") {
            u.data("differentissplayed", "done");
            u.data("transition", u.data("savedtransition"));
            u.data("slotamount", u.data("savedslotamount"));
            u.data("masterspeed", u.data("savedmasterspeed"))
        }
        if (u.data("fstransition") != t && u.data("differentissplayed") != "done") {
            u.data("savedtransition", u.data("transition"));
            u.data("savedslotamount", u.data("slotamount"));
            u.data("savedmasterspeed", u.data("masterspeed"));
            u.data("transition", u.data("fstransition"));
            u.data("slotamount", u.data("fsslotamount"));
            u.data("masterspeed", u.data("fsmasterspeed"));
            u.data("differentissplayed", "prepared")
        }
        var l = 0;
        var c = u.data("transition").split(",");
        var h = u.data("nexttransid");
        if (h == t) {
            h = 0;
            u.data("nexttransid", h)
        } else {
            h = h + 1;
            if (h == c.length) h = 0;
            u.data("nexttransid", h)
        }
        var p = c[h];
        var d = 0;
        if (p == "slidehorizontal") {
            p = "slideleft";
            if (r.leftarrowpressed == 1) p = "slideright"
        }
        if (p == "slidevertical") {
            p = "slideup";
            if (r.leftarrowpressed == 1) p = "slidedown"
        }
        var v = [["boxslide", 0, 1, 10, 0, "box", false, null, 0], ["boxfade", 1, 0, 10, 0, "box", false, null, 1], ["slotslide-horizontal", 2, 0, 0, 200, "horizontal", true, false, 2], ["slotslide-vertical", 3, 0, 0, 200, "vertical", true, false, 3], ["curtain-1", 4, 3, 0, 0, "horizontal", true, true, 4], ["curtain-2", 5, 3, 0, 0, "horizontal", true, true, 5], ["curtain-3", 6, 3, 25, 0, "horizontal", true, true, 6], ["slotzoom-horizontal", 7, 0, 0, 400, "horizontal", true, true, 7], ["slotzoom-vertical", 8, 0, 0, 0, "vertical", true, true, 8], ["slotfade-horizontal", 9, 0, 0, 500, "horizontal", true, null, 9], ["slotfade-vertical", 10, 0, 0, 500, "vertical", true, null, 10], ["fade", 11, 0, 1, 300, "horizontal", true, null, 11], ["slideleft", 12, 0, 1, 0, "horizontal", true, true, 12], ["slideup", 13, 0, 1, 0, "horizontal", true, true, 13], ["slidedown", 14, 0, 1, 0, "horizontal", true, true, 14], ["slideright", 15, 0, 1, 0, "horizontal", true, true, 15], ["papercut", 16, 0, 0, 600, "", null, null, 16], ["3dcurtain-horizontal", 17, 0, 20, 100, "vertical", false, true, 17], ["3dcurtain-vertical", 18, 0, 10, 100, "horizontal", false, true, 18], ["cubic", 19, 0, 20, 600, "horizontal", false, true, 19], ["cube", 19, 0, 20, 600, "horizontal", false, true, 20], ["flyin", 20, 0, 4, 600, "vertical", false, true, 21], ["turnoff", 21, 0, 1, 1600, "horizontal", false, true, 22], ["incube", 22, 0, 20, 600, "horizontal", false, true, 23], ["cubic-horizontal", 23, 0, 20, 500, "vertical", false, true, 24], ["cube-horizontal", 23, 0, 20, 500, "vertical", false, true, 25], ["incube-horizontal", 24, 0, 20, 500, "vertical", false, true, 26], ["turnoff-vertical", 25, 0, 1, 1600, "horizontal", false, true, 27], ["fadefromright", 12, 1, 1, 0, "horizontal", true, true, 28], ["fadefromleft", 15, 1, 1, 0, "horizontal", true, true, 29], ["fadefromtop", 14, 1, 1, 0, "horizontal", true, true, 30], ["fadefrombottom", 13, 1, 1, 0, "horizontal", true, true, 31], ["fadetoleftfadefromright", 12, 2, 1, 0, "horizontal", true, true, 32], ["fadetorightfadetoleft", 15, 2, 1, 0, "horizontal", true, true, 33], ["fadetobottomfadefromtop", 14, 2, 1, 0, "horizontal", true, true, 34], ["fadetotopfadefrombottom", 13, 2, 1, 0, "horizontal", true, true, 35], ["parallaxtoright", 12, 3, 1, 0, "horizontal", true, true, 36], ["parallaxtoleft", 15, 3, 1, 0, "horizontal", true, true, 37], ["parallaxtotop", 14, 3, 1, 0, "horizontal", true, true, 38], ["parallaxtobottom", 13, 3, 1, 0, "horizontal", true, true, 39], ["scaledownfromright", 12, 4, 1, 0, "horizontal", true, true, 40], ["scaledownfromleft", 15, 4, 1, 0, "horizontal", true, true, 41], ["scaledownfromtop", 14, 4, 1, 0, "horizontal", true, true, 42], ["scaledownfrombottom", 13, 4, 1, 0, "horizontal", true, true, 43], ["zoomout", 13, 5, 1, 0, "horizontal", true, true, 44], ["zoomin", 13, 6, 1, 0, "horizontal", true, true, 45], ["notransition", 26, 0, 1, 0, "horizontal", true, null, 46]];
        var m = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45];
        var g = [16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27];
        var l = 0;
        var d = 1;
        var y = 0;
        var E = 0;
        var S = new Array;
        if (p == "random") {
            p = Math.round(Math.random() * v.length - 1);
            if (p > v.length - 1) p = v.length - 1
        }
        if (p == "random-static") {
            p = Math.round(Math.random() * m.length - 1);
            if (p > m.length - 1) p = m.length - 1;
            p = m[p]
        }
        if (p == "random-premium") {
            p = Math.round(Math.random() * g.length - 1);
            if (p > g.length - 1) p = g.length - 1;
            p = g[p]
        }
        if (r.isJoomla == true && p == 16) {
            p = Math.round(Math.random() * g.length - 2) + 1;
            if (p > g.length - 1) p = g.length - 1;
            p = g[p]
        }
        x();
        if (o(8) && l > 15 && l < 28) {
            p = Math.round(Math.random() * m.length - 1);
            if (p > m.length - 1) p = m.length - 1;
            p = m[p];
            E = 0;
            x()
        }
        var T = -1;
        if (r.leftarrowpressed == 1 || r.act > r.next) T = 1;
        r.leftarrowpressed = 0;
        if (l > 26) l = 26;
        if (l < 0) l = 0;
        var N = 300;
        if (u.data("masterspeed") != t && u.data("masterspeed") > 99 && u.data("masterspeed") < 4001) N = u.data("masterspeed");
        S = v[y];
        n.parent().find(".bullet").each(function () {
            var t = e(this);
            t.removeClass("selected");
            if (r.navigationArrows == "withbullet" || r.navigationArrows == "nexttobullets") {
                if (t.index() - 1 == r.next) t.addClass("selected")
            } else {
                if (t.index() == r.next) t.addClass("selected")
            }
        });
        n.find(">li").each(function () {
            var t = e(this);
            if (t.index != r.act && t.index != r.next) t.css({"z-index": 16})
        });
        i.css({"z-index": 18});
        u.css({"z-index": 20});
        u.css({opacity: 0});
        if (i.index() != u.index() && r.firststart != 1) {
            Q(i, r)
        }
        V(u, r);
        if (u.data("slotamount") == t || u.data("slotamount") < 1) {
            r.slots = Math.round(Math.random() * 12 + 4);
            if (p == "boxslide") r.slots = Math.round(Math.random() * 6 + 3); else if (p == "flyin") r.slots = Math.round(Math.random() * 4 + 1)
        } else {
            r.slots = u.data("slotamount")
        }
        if (u.data("rotate") == t) r.rotate = 0; else if (u.data("rotate") == 999) r.rotate = Math.round(Math.random() * 360); else r.rotate = u.data("rotate");
        if (!e.support.transition || r.ie || r.ie9) r.rotate = 0;
        if (r.firststart == 1) {
            i.css({opacity: 0});
            r.firststart = 0
        }
        N = N + S[4];
        if ((l == 4 || l == 5 || l == 6) && r.slots < 3) r.slots = 3;
        if (S[3] != 0) r.slots = Math.min(r.slots, S[3]);
        if (l == 9) r.slots = r.width / 20;
        if (l == 10) r.slots = r.height / 20;
        if (S[5] == "box") {
            if (S[7] != null) w(a, r, S[7]);
            if (S[6] != null) w(f, r, S[6])
        } else if (S[5] == "vertical" || S[5] == "horizontal") {
            if (S[7] != null) b(a, r, S[7], S[5]);
            if (S[6] != null) b(f, r, S[6], S[5])
        }
        if (l < 12 || l > 16) u.css({opacity: 1});
        if (l == 0) {
            f.find(".defaultimg").css({opacity: 0});
            var C = Math.ceil(r.height / r.sloth);
            var k = 0;
            f.find(".slotslide").each(function (t) {
                var s = e(this);
                k = k + 1;
                if (k == C) k = 0;
                TweenLite.fromTo(s, N / 600, {
                    opacity: 0,
                    top: 0 - r.sloth,
                    left: 0 - r.slotw,
                    rotation: r.rotate
                }, {
                    opacity: 1,
                    transformPerspective: 600,
                    top: 0,
                    left: 0,
                    scale: 1,
                    rotation: 0,
                    delay: (t * 15 + k * 30) / 1500,
                    ease: Power2.easeOut,
                    onComplete: function () {
                        if (t == r.slots * r.slots - 1) {
                            F(n, r, f, a, u, i)
                        }
                    }
                })
            })
        }
        if (l == 1) {
            f.find(".defaultimg").css({opacity: 0});
            var L;
            f.find(".slotslide").each(function (t) {
                var n = e(this);
                rand = Math.random() * N + 300;
                rand2 = Math.random() * 500 + 200;
                if (rand + rand2 > L) L = rand2 + rand2;
                TweenLite.fromTo(n, rand / 1e3, {
                    opacity: 0,
                    transformPerspective: 600,
                    rotation: r.rotate
                }, {opacity: 1, ease: Power2.easeInOut, rotation: 0, delay: rand2 / 1e3})
            });
            setTimeout(function () {
                F(n, r, f, a, u, i)
            }, N + 300)
        }
        if (l == 2) {
            f.find(".defaultimg").css({opacity: 0});
            a.find(".slotslide").each(function () {
                var t = e(this);
                TweenLite.to(t, N / 1e3, {
                    left: r.slotw, rotation: 0 - r.rotate, onComplete: function () {
                        F(n, r, f, a, u, i)
                    }
                })
            });
            f.find(".slotslide").each(function () {
                var t = e(this);
                TweenLite.fromTo(t, N / 1e3, {
                    left: 0 - r.slotw,
                    rotation: r.rotate,
                    transformPerspective: 600
                }, {
                    left: 0, rotation: 0, ease: Power2.easeOut, onComplete: function () {
                        F(n, r, f, a, u, i)
                    }
                })
            })
        }
        if (l == 3) {
            f.find(".defaultimg").css({opacity: 0});
            a.find(".slotslide").each(function () {
                var t = e(this);
                TweenLite.to(t, N / 1e3, {
                    top: r.sloth,
                    rotation: r.rotate,
                    transformPerspective: 600,
                    onComplete: function () {
                        F(n, r, f, a, u, i)
                    }
                })
            });
            f.find(".slotslide").each(function () {
                var t = e(this);
                TweenLite.fromTo(t, N / 1e3, {top: 0 - r.sloth, rotation: r.rotate, transformPerspective: 600}, {
                    top: 0,
                    rotation: 0,
                    ease: Power2.easeOut,
                    onComplete: function () {
                        F(n, r, f, a, u, i)
                    }
                })
            })
        }
        if (l == 4 || l == 5) {
            f.find(".defaultimg").css({opacity: 0});
            setTimeout(function () {
                a.find(".defaultimg").css({opacity: 0})
            }, 100);
            var A = N / 1e3;
            var O = A;
            a.find(".slotslide").each(function (t) {
                var n = e(this);
                var i = t * A / r.slots;
                if (l == 5) i = (r.slots - t - 1) * A / r.slots / 1.5;
                TweenLite.to(n, A * 3, {
                    transformPerspective: 600,
                    top: 0 + r.height,
                    opacity: .5,
                    rotation: r.rotate,
                    ease: Power2.easeInOut,
                    delay: i
                })
            });
            f.find(".slotslide").each(function (t) {
                var s = e(this);
                var o = t * A / r.slots;
                if (l == 5) o = (r.slots - t - 1) * A / r.slots / 1.5;
                TweenLite.fromTo(s, A * 3, {
                    top: 0 - r.height,
                    opacity: .5,
                    rotation: r.rotate,
                    transformPerspective: 600
                }, {
                    top: 0, opacity: 1, rotation: 0, ease: Power2.easeInOut, delay: o, onComplete: function () {
                        if (t == r.slots - 1) {
                            F(n, r, f, a, u, i)
                        }
                    }
                })
            })
        }
        if (l == 6) {
            if (r.slots < 2) r.slots = 2;
            f.find(".defaultimg").css({opacity: 0});
            setTimeout(function () {
                a.find(".defaultimg").css({opacity: 0})
            }, 100);
            a.find(".slotslide").each(function (t) {
                var n = e(this);
                if (t < r.slots / 2) var i = (t + 2) * 60; else var i = (2 + r.slots - t) * 60;
                TweenLite.to(n, (N + i) / 1e3, {
                    top: 0 + r.height,
                    opacity: 1,
                    rotation: r.rotate,
                    transformPerspective: 600,
                    ease: Power2.easeInOut
                })
            });
            f.find(".slotslide").each(function (t) {
                var s = e(this);
                if (t < r.slots / 2) var o = (t + 2) * 60; else var o = (2 + r.slots - t) * 60;
                TweenLite.fromTo(s, (N + o) / 1e3, {
                    top: 0 - r.height,
                    opacity: 1,
                    rotation: r.rotate,
                    transformPerspective: 600
                }, {
                    top: 0, opacity: 1, rotation: 0, ease: Power2.easeInOut, onComplete: function () {
                        if (t == Math.round(r.slots / 2)) {
                            F(n, r, f, a, u, i)
                        }
                    }
                })
            })
        }
        if (l == 7) {
            N = N * 2;
            f.find(".defaultimg").css({opacity: 0});
            setTimeout(function () {
                a.find(".defaultimg").css({opacity: 0})
            }, 100);
            a.find(".slotslide").each(function () {
                var t = e(this).find("div");
                TweenLite.to(t, N / 1e3, {
                    left: 0 - r.slotw / 2 + "px",
                    top: 0 - r.height / 2 + "px",
                    width: r.slotw * 2 + "px",
                    height: r.height * 2 + "px",
                    opacity: 0,
                    rotation: r.rotate,
                    transformPerspective: 600,
                    ease: Power2.easeOut
                })
            });
            f.find(".slotslide").each(function (t) {
                var s = e(this).find("div");
                TweenLite.fromTo(s, N / 1e3, {
                    left: 0,
                    top: 0,
                    opacity: 0,
                    transformPerspective: 600
                }, {
                    left: 0 - t * r.slotw + "px",
                    ease: Power2.easeOut,
                    top: 0 + "px",
                    width: r.width,
                    height: r.height,
                    opacity: 1,
                    rotation: 0,
                    delay: .1,
                    onComplete: function () {
                        F(n, r, f, a, u, i)
                    }
                })
            })
        }
        if (l == 8) {
            N = N * 3;
            f.find(".defaultimg").css({opacity: 0});
            a.find(".slotslide").each(function () {
                var t = e(this).find("div");
                TweenLite.to(t, N / 1e3, {
                    left: 0 - r.width / 2 + "px",
                    top: 0 - r.sloth / 2 + "px",
                    width: r.width * 2 + "px",
                    height: r.sloth * 2 + "px",
                    transformPerspective: 600,
                    opacity: 0,
                    rotation: r.rotate
                })
            });
            f.find(".slotslide").each(function (t) {
                var s = e(this).find("div");
                TweenLite.fromTo(s, N / 1e3, {left: 0, top: 0, opacity: 0, transformPerspective: 600}, {
                    left: 0 + "px",
                    top: 0 - t * r.sloth + "px",
                    width: f.find(".defaultimg").data("neww") + "px",
                    height: f.find(".defaultimg").data("newh") + "px",
                    opacity: 1,
                    rotation: 0,
                    onComplete: function () {
                        F(n, r, f, a, u, i)
                    }
                })
            })
        }
        if (l == 9 || l == 10) {
            f.find(".defaultimg").css({opacity: 0});
            var _ = 0;
            f.find(".slotslide").each(function (t) {
                var n = e(this);
                _++;
                TweenLite.fromTo(n, N / 1e3, {opacity: 0, transformPerspective: 600, left: 0, top: 0}, {
                    opacity: 1,
                    ease: Power2.easeInOut,
                    delay: t * 4 / 1e3
                })
            });
            setTimeout(function () {
                F(n, r, f, a, u, i)
            }, N + _ * 4)
        }
        if (l == 11 || l == 26) {
            f.find(".defaultimg").css({opacity: 0, position: "relative"});
            var _ = 0;
            if (l == 26) N = 0;
            f.find(".slotslide").each(function (t) {
                var n = e(this);
                TweenLite.fromTo(n, N / 1e3, {opacity: 0}, {opacity: 1, ease: Power2.easeInOut})
            });
            setTimeout(function () {
                F(n, r, f, a, u, i)
            }, N + 15)
        }
        if (l == 12 || l == 13 || l == 14 || l == 15) {
            setTimeout(function () {
                a.find(".defaultimg").css({opacity: 0})
            }, 100);
            f.find(".defaultimg").css({opacity: 0});
            var D = r.width;
            var P = r.height;
            var H = f.find(".slotslide");
            if (r.fullWidth == "on" || r.fullSreen == "on") {
                D = H.width();
                P = H.height()
            }
            var B = 0;
            var j = 0;
            if (l == 12) B = D; else if (l == 15) B = 0 - D; else if (l == 13) j = P; else if (l == 14) j = 0 - P;
            var I = 1;
            var q = 1;
            var R = 1;
            var U = Power2.easeInOut;
            var z = Power2.easeInOut;
            var W = N / 1e3;
            var X = W;
            if (d == 1) I = 0;
            if (d == 2) I = 0;
            if (d == 3) {
                U = Power2.easeInOut;
                z = Power1.easeInOut;
                i.css({position: "absolute", "z-index": 20});
                u.css({position: "absolute", "z-index": 15});
                W = N / 1200
            }
            if (d == 4 || d == 5) q = .6;
            if (d == 6) q = 1.4;
            if (d == 5 || d == 6) {
                R = 1.4;
                I = 0;
                D = 0;
                P = 0;
                B = 0;
                j = 0
            }
            if (d == 6) R = .6;
            TweenLite.fromTo(H, W, {left: B, top: j, scale: R, opacity: I, rotation: r.rotate}, {
                opacity: 1,
                rotation: 0,
                left: 0,
                top: 0,
                scale: 1,
                ease: z,
                onComplete: function () {
                    F(n, r, f, a, u, i);
                    i.css({position: "absolute", "z-index": 18});
                    u.css({position: "absolute", "z-index": 20})
                }
            });
            var $ = a.find(".slotslide");
            if (d == 4 || d == 5) {
                D = 0;
                P = 0
            }
            if (d != 1) {
                if (l == 12) TweenLite.to($, X, {
                    left: 0 - D + "px",
                    scale: q,
                    opacity: I,
                    rotation: r.rotate,
                    ease: U
                }); else if (l == 15) TweenLite.to($, X, {
                    left: D + "px",
                    scale: q,
                    opacity: I,
                    rotation: r.rotate,
                    ease: U
                }); else if (l == 13) TweenLite.to($, X, {
                    top: 0 - P + "px",
                    scale: q,
                    opacity: I,
                    rotation: r.rotate,
                    ease: U
                }); else if (l == 14) TweenLite.to($, X, {
                    top: P + "px",
                    scale: q,
                    opacity: I,
                    rotation: r.rotate,
                    ease: U
                })
            }
            u.css({opacity: 1})
        }
        if (l == 16) {
            i.css({position: "absolute", "z-index": 20});
            u.css({position: "absolute", "z-index": 15});
            i.wrapInner('<div class="tp-half-one" style="position:relative; width:100%;height:100%"></div>');
            i.find(".tp-half-one").clone(true).appendTo(i).addClass("tp-half-two");
            i.find(".tp-half-two").removeClass("tp-half-one");
            var D = r.width;
            var P = r.height;
            if (r.autoHeight == "on") P = n.height();
            i.find(".tp-half-one .defaultimg").wrap('<div class="tp-papercut" style="width:' + D + "px;height:" + P + 'px;"></div>');
            i.find(".tp-half-two .defaultimg").wrap('<div class="tp-papercut" style="width:' + D + "px;height:" + P + 'px;"></div>');
            i.find(".tp-half-two .defaultimg").css({position: "absolute", top: "-50%"});
            i.find(".tp-half-two .tp-caption").wrapAll('<div style="position:absolute;top:-50%;left:0px"></div>');
            TweenLite.set(i.find(".tp-half-two"), {
                width: D,
                height: P,
                overflow: "hidden",
                zIndex: 15,
                position: "absolute",
                top: P / 2,
                left: "0px",
                transformPerspective: 600,
                transformOrigin: "center bottom"
            });
            TweenLite.set(i.find(".tp-half-one"), {
                width: D,
                height: P / 2,
                overflow: "visible",
                zIndex: 10,
                position: "absolute",
                top: "0px",
                left: "0px",
                transformPerspective: 600,
                transformOrigin: "center top"
            });
            var J = i.find(".defaultimg");
            var K = Math.round(Math.random() * 20 - 10);
            var G = Math.round(Math.random() * 20 - 10);
            var Y = Math.round(Math.random() * 20 - 10);
            var Z = Math.random() * .4 - .2;
            var et = Math.random() * .4 - .2;
            var tt = Math.random() * 1 + 1;
            var nt = Math.random() * 1 + 1;
            TweenLite.fromTo(i.find(".tp-half-one"), N / 1e3, {
                width: D,
                height: P / 2,
                position: "absolute",
                top: "0px",
                left: "0px",
                transformPerspective: 600,
                transformOrigin: "center top"
            }, {scale: tt, rotation: K, y: 0 - P - P / 4, ease: Power2.easeInOut});
            setTimeout(function () {
                TweenLite.set(i.find(".tp-half-one"), {overflow: "hidden"})
            }, 50);
            TweenLite.fromTo(i.find(".tp-half-one"), N / 2e3, {
                opacity: 1,
                transformPerspective: 600,
                transformOrigin: "center center"
            }, {opacity: 0, delay: N / 2e3});
            TweenLite.fromTo(i.find(".tp-half-two"), N / 1e3, {
                width: D,
                height: P,
                overflow: "hidden",
                position: "absolute",
                top: P / 2,
                left: "0px",
                transformPerspective: 600,
                transformOrigin: "center bottom"
            }, {scale: nt, rotation: G, y: P + P / 4, ease: Power2.easeInOut});
            TweenLite.fromTo(i.find(".tp-half-two"), N / 2e3, {
                opacity: 1,
                transformPerspective: 600,
                transformOrigin: "center center"
            }, {opacity: 0, delay: N / 2e3});
            if (i.html() != null) TweenLite.fromTo(u, (N - 200) / 1e3, {
                opacity: 0,
                scale: .8,
                x: r.width * Z,
                y: P * et,
                rotation: Y,
                transformPerspective: 600,
                transformOrigin: "center center"
            }, {rotation: 0, scale: 1, x: 0, y: 0, opacity: 1, ease: Power2.easeInOut});
            f.find(".defaultimg").css({opacity: 1});
            setTimeout(function () {
                i.css({position: "absolute", "z-index": 18});
                u.css({position: "absolute", "z-index": 20});
                f.find(".defaultimg").css({opacity: 1});
                a.find(".defaultimg").css({opacity: 0});
                if (i.find(".tp-half-one").length > 0) {
                    i.find(".tp-half-one .defaultimg").unwrap();
                    i.find(".tp-half-one .slotholder").unwrap()
                }
                i.find(".tp-half-two").remove();
                r.transition = 0;
                r.act = r.next
            }, N);
            u.css({opacity: 1})
        }
        if (l == 17) {
            f.find(".defaultimg").css({opacity: 0});
            f.find(".slotslide").each(function (t) {
                var s = e(this);
                TweenLite.fromTo(s, N / 800, {
                    opacity: 0,
                    rotationY: 0,
                    scale: .9,
                    rotationX: -110,
                    transformPerspective: 600,
                    transformOrigin: "center center"
                }, {
                    opacity: 1,
                    top: 0,
                    left: 0,
                    scale: 1,
                    rotation: 0,
                    rotationX: 0,
                    rotationY: 0,
                    ease: Power3.easeOut,
                    delay: t * .06,
                    onComplete: function () {
                        if (t == r.slots - 1) F(n, r, f, a, u, i)
                    }
                })
            })
        }
        if (l == 18) {
            f.find(".defaultimg").css({opacity: 0});
            f.find(".slotslide").each(function (t) {
                var s = e(this);
                TweenLite.fromTo(s, N / 500, {
                    opacity: 0,
                    rotationY: 310,
                    scale: .9,
                    rotationX: 10,
                    transformPerspective: 600,
                    transformOrigin: "center center"
                }, {
                    opacity: 1,
                    top: 0,
                    left: 0,
                    scale: 1,
                    rotation: 0,
                    rotationX: 0,
                    rotationY: 0,
                    ease: Power3.easeOut,
                    delay: t * .06,
                    onComplete: function () {
                        if (t == r.slots - 1) F(n, r, f, a, u, i)
                    }
                })
            })
        }
        if (l == 19 || l == 22) {
            f.find(".defaultimg").css({opacity: 0});
            setTimeout(function () {
                a.find(".defaultimg").css({opacity: 0})
            }, 100);
            var rt = u.css("z-index");
            var it = i.css("z-index");
            var st = 90;
            var I = 1;
            if (T == 1) st = -90;
            if (l == 19) {
                var ot = "center center -" + r.height / 2;
                I = 0
            } else {
                var ot = "center center " + r.height / 2
            }
            TweenLite.fromTo(f, N / 2e3, {transformPerspective: 600, z: 0, x: 0, rotationY: 0}, {
                rotationY: 1,
                ease: Power1.easeInOut,
                z: -40
            });
            TweenLite.fromTo(f, N / 2e3, {transformPerspective: 600, z: -40, rotationY: 1}, {
                rotationY: 0,
                z: 0,
                ease: Power1.easeInOut,
                x: 0,
                delay: 3 * (N / 4e3)
            });
            TweenLite.fromTo(a, N / 2e3, {transformPerspective: 600, z: 0, x: 0, rotationY: 0}, {
                rotationY: 1,
                x: 0,
                ease: Power1.easeInOut,
                z: -40
            });
            TweenLite.fromTo(a, N / 2e3, {transformPerspective: 600, z: -40, x: 0, rotationY: 1}, {
                rotationY: 0,
                z: 0,
                x: 0,
                ease: Power1.easeInOut,
                delay: 3 * (N / 4e3)
            });
            f.find(".slotslide").each(function (t) {
                var s = e(this);
                TweenLite.fromTo(s, N / 1e3, {
                    left: 0,
                    rotationY: r.rotate,
                    opacity: I,
                    top: 0,
                    scale: .8,
                    transformPerspective: 600,
                    transformOrigin: ot,
                    rotationX: st
                }, {
                    left: 0,
                    rotationY: 0,
                    opacity: 1,
                    top: 0,
                    z: 0,
                    scale: 1,
                    rotationX: 0,
                    delay: t * 50 / 1e3,
                    ease: Power2.easeInOut,
                    onComplete: function () {
                        if (t == r.slots - 1) F(n, r, f, a, u, i)
                    }
                });
                TweenLite.to(s, .1, {opacity: 1, delay: t * 50 / 1e3 + N / 3e3})
            });
            a.find(".slotslide").each(function (t) {
                var s = e(this);
                var o = -90;
                if (T == 1) o = 90;
                TweenLite.fromTo(s, N / 1e3, {
                    opacity: 1,
                    rotationY: 0,
                    top: 0,
                    z: 0,
                    scale: 1,
                    transformPerspective: 600,
                    transformOrigin: ot,
                    rotationX: 0
                }, {
                    opacity: 1,
                    rotationY: r.rotate,
                    top: 0,
                    scale: .8,
                    rotationX: o,
                    delay: t * 50 / 1e3,
                    ease: Power2.easeInOut,
                    onComplete: function () {
                        if (t == r.slots - 1) F(n, r, f, a, u, i)
                    }
                });
                TweenLite.to(s, .1, {opacity: 0, delay: t * 50 / 1e3 + (N / 1e3 - N / 1e4)})
            })
        }
        if (l == 20) {
            f.find(".defaultimg").css({opacity: 0});
            setTimeout(function () {
                a.find(".defaultimg").css({opacity: 0})
            }, 100);
            var rt = u.css("z-index");
            var it = i.css("z-index");
            if (T == 1) {
                var ut = -r.width;
                var st = 70;
                var ot = "left center -" + r.height / 2
            } else {
                var ut = r.width;
                var st = -70;
                var ot = "right center -" + r.height / 2
            }
            f.find(".slotslide").each(function (t) {
                var s = e(this);
                TweenLite.fromTo(s, N / 1500, {
                    left: ut,
                    rotationX: 40,
                    z: -600,
                    opacity: I,
                    top: 0,
                    transformPerspective: 600,
                    transformOrigin: ot,
                    rotationY: st
                }, {left: 0, delay: t * 50 / 1e3, ease: Power2.easeInOut});
                TweenLite.fromTo(s, N / 1e3, {
                    rotationX: 40,
                    z: -600,
                    opacity: I,
                    top: 0,
                    scale: 1,
                    transformPerspective: 600,
                    transformOrigin: ot,
                    rotationY: st
                }, {
                    rotationX: 0,
                    opacity: 1,
                    top: 0,
                    z: 0,
                    scale: 1,
                    rotationY: 0,
                    delay: t * 50 / 1e3,
                    ease: Power2.easeInOut,
                    onComplete: function () {
                        if (t == r.slots - 1) F(n, r, f, a, u, i)
                    }
                });
                TweenLite.to(s, .1, {opacity: 1, delay: t * 50 / 1e3 + N / 2e3})
            });
            a.find(".slotslide").each(function (t) {
                var s = e(this);
                if (T != 1) {
                    var o = -r.width;
                    var l = 70;
                    var c = "left center -" + r.height / 2
                } else {
                    var o = r.width;
                    var l = -70;
                    var c = "right center -" + r.height / 2
                }
                TweenLite.fromTo(s, N / 1e3, {
                    opacity: 1,
                    rotationX: 0,
                    top: 0,
                    z: 0,
                    scale: 1,
                    left: 0,
                    transformPerspective: 600,
                    transformOrigin: c,
                    rotationY: 0
                }, {
                    opacity: 1,
                    rotationX: 40,
                    top: 0,
                    z: -600,
                    left: o,
                    scale: .8,
                    rotationY: l,
                    delay: t * 50 / 1e3,
                    ease: Power2.easeInOut,
                    onComplete: function () {
                        if (t == r.slots - 1) F(n, r, f, a, u, i)
                    }
                });
                TweenLite.to(s, .1, {opacity: 0, delay: t * 50 / 1e3 + (N / 1e3 - N / 1e4)})
            })
        }
        if (l == 21 || l == 25) {
            f.find(".defaultimg").css({opacity: 0});
            setTimeout(function () {
                a.find(".defaultimg").css({opacity: 0})
            }, 100);
            var rt = u.css("z-index");
            var it = i.css("z-index");
            if (T == 1) {
                var ut = -r.width;
                var st = 110;
                if (l == 25) {
                    var ot = "center top 0";
                    rot2 = -st;
                    st = r.rotate
                } else {
                    var ot = "left center 0";
                    rot2 = r.rotate
                }
            } else {
                var ut = r.width;
                var st = -110;
                if (l == 25) {
                    var ot = "center bottom 0";
                    rot2 = -st;
                    st = r.rotate
                } else {
                    var ot = "right center 0";
                    rot2 = r.rotate
                }
            }
            f.find(".slotslide").each(function (t) {
                var s = e(this);
                TweenLite.fromTo(s, N / 1500, {
                    left: 0,
                    rotationX: rot2,
                    z: 0,
                    opacity: 0,
                    top: 0,
                    scale: 1,
                    transformPerspective: 600,
                    transformOrigin: ot,
                    rotationY: st
                }, {
                    left: 0,
                    rotationX: 0,
                    top: 0,
                    z: 0,
                    scale: 1,
                    rotationY: 0,
                    delay: t * 100 / 1e3 + N / 1e4,
                    ease: Power2.easeInOut,
                    onComplete: function () {
                        if (t == r.slots - 1) F(n, r, f, a, u, i)
                    }
                });
                TweenLite.to(s, .3, {opacity: 1, delay: t * 100 / 1e3 + N * .2 / 2e3 + N / 1e4})
            });
            if (T != 1) {
                var ut = -r.width;
                var st = 90;
                if (l == 25) {
                    var ot = "center top 0";
                    rot2 = -st;
                    st = r.rotate
                } else {
                    var ot = "left center 0";
                    rot2 = r.rotate
                }
            } else {
                var ut = r.width;
                var st = -90;
                if (l == 25) {
                    var ot = "center bottom 0";
                    rot2 = -st;
                    st = r.rotate
                } else {
                    var ot = "right center 0";
                    rot2 = r.rotate
                }
            }
            a.find(".slotslide").each(function (t) {
                var n = e(this);
                TweenLite.fromTo(n, N / 3e3, {
                    left: 0,
                    rotationX: 0,
                    z: 0,
                    opacity: 1,
                    top: 0,
                    scale: 1,
                    transformPerspective: 600,
                    transformOrigin: ot,
                    rotationY: 0
                }, {
                    left: 0,
                    rotationX: rot2,
                    top: 0,
                    z: 0,
                    scale: 1,
                    rotationY: st,
                    delay: t * 100 / 1e3,
                    ease: Power1.easeInOut
                });
                TweenLite.to(n, .2, {opacity: 0, delay: t * 50 / 1e3 + (N / 3e3 - N / 1e4)})
            })
        }
        if (l == 23 || l == 24) {
            f.find(".defaultimg").css({opacity: 0});
            setTimeout(function () {
                a.find(".defaultimg").css({opacity: 0})
            }, 100);
            var rt = u.css("z-index");
            var it = i.css("z-index");
            var st = -90;
            if (T == 1) st = 90;
            var I = 1;
            if (l == 23) {
                var ot = "center center -" + r.width / 2;
                I = 0
            } else {
                var ot = "center center " + r.width / 2
            }
            var at = 0;
            TweenLite.fromTo(f, N / 2e3, {transformPerspective: 600, z: 0, x: 0, rotationY: 0}, {
                rotationY: 1,
                ease: Power1.easeInOut,
                z: -90
            });
            TweenLite.fromTo(f, N / 2e3, {transformPerspective: 600, z: -90, rotationY: 1}, {
                rotationY: 0,
                z: 0,
                ease: Power1.easeInOut,
                x: 0,
                delay: 3 * (N / 4e3)
            });
            TweenLite.fromTo(a, N / 2e3, {transformPerspective: 600, z: 0, x: 0, rotationY: 0}, {
                rotationY: 1,
                x: 0,
                ease: Power1.easeInOut,
                z: -90
            });
            TweenLite.fromTo(a, N / 2e3, {transformPerspective: 600, z: -90, x: 0, rotationY: 1}, {
                rotationY: 0,
                z: 0,
                x: 0,
                ease: Power1.easeInOut,
                delay: 3 * (N / 4e3)
            });
            f.find(".slotslide").each(function (t) {
                var s = e(this);
                TweenLite.fromTo(s, N / 1e3, {
                    left: at,
                    rotationX: r.rotate,
                    opacity: I,
                    top: 0,
                    scale: 1,
                    transformPerspective: 600,
                    transformOrigin: ot,
                    rotationY: st
                }, {
                    left: 0,
                    rotationX: 0,
                    opacity: 1,
                    top: 0,
                    z: 0,
                    scale: 1,
                    rotationY: 0,
                    delay: t * 50 / 1e3,
                    ease: Power2.easeInOut,
                    onComplete: function () {
                        if (t == r.slots - 1) F(n, r, f, a, u, i)
                    }
                });
                TweenLite.to(s, .1, {opacity: 1, delay: t * 50 / 1e3 + N / 3e3})
            });
            st = 90;
            if (T == 1) st = -90;
            a.find(".slotslide").each(function (t) {
                var s = e(this);
                TweenLite.fromTo(s, N / 1e3, {
                    left: 0,
                    opacity: 1,
                    rotationX: 0,
                    top: 0,
                    z: 0,
                    scale: 1,
                    transformPerspective: 600,
                    transformOrigin: ot,
                    rotationY: 0
                }, {
                    left: at,
                    opacity: 1,
                    rotationX: r.rotate,
                    top: 0,
                    scale: 1,
                    rotationY: st,
                    delay: t * 50 / 1e3,
                    ease: Power2.easeInOut,
                    onComplete: function () {
                        if (t == r.slots - 1) F(n, r, f, a, u, i)
                    }
                });
                TweenLite.to(s, .1, {opacity: 0, delay: t * 50 / 1e3 + (N / 1e3 - N / 1e4)})
            })
        }
        var ft = {};
        ft.slideIndex = r.next + 1;
        n.trigger("revolution.slide.onchange", ft);
        setTimeout(function () {
            n.trigger("revolution.slide.onafterswap")
        }, N);
        n.trigger("revolution.slide.onvideostop")
    }

    function A(e, t) {
    }

    function O(t, n) {
        t.find(">ul:first-child >li").each(function () {
            var t = e(this);
            for (var r = 0; r < 10; r++) t.find(".rs-parallaxlevel-" + r).wrapAll('<div style="position:absolute;top:0px;left:0px;width:100%;height:100%;" class="tp-parallax-container" data-parallaxlevel="' + n.parallaxLevels[r] + '"></div>')
        });
        t.on("mousemove.hoverdir, mouseleave.hoverdir", function (n) {
            console.log("event:" + n.type);
            switch (n.type) {
                case"mousemove":
                    var r = t.offset().top, i = t.offset().left, s = r + t.height() / 2, o = i + t.width() / 2,
                        u = o - n.pageX, a = s - n.pageY;
                    e(".tp-parallax-container").each(function () {
                        var t = e(this), n = parseInt(t.data("parallaxlevel"), 0) / 100, r = u * n, i = a * n;
                        TweenLite.to(t, .2, {x: r, y: i, ease: Power3.easeOut})
                    });
                    break;
                case"mouseleave":
                    e(".tp-parallax-container").each(function () {
                        var t = e(this);
                        TweenLite.to(t, .4, {x: 0, y: 0, ease: Power3.easeOut})
                    });
                    break
            }
        });
        window.ondeviceorientation = function (n) {
            var r = Math.round(n.beta || 0), i = Math.round(n.gamma || 0), s = 360 / t.width() * i,
                o = 180 / t.height() * r;
            e(".tp-parallax-container").each(function () {
                var t = e(this), n = parseInt(t.data("parallaxlevel"), 0) / 100, r = s * n, i = o * n;
                TweenLite.to(t, .2, {x: r, y: i, ease: Power3.easeOut})
            })
        };
        e(window).bind("deviceorientation", {option: n, cont: t}, function (e) {
            var t = e.data.option;
            var n = e.data.container;
            if (!t.desktop && e.beta !== null && e.gamma !== null) {
                var r = (e.beta || 0) / MAGIC_NUMBER;
                var i = (e.gamma || 0) / MAGIC_NUMBER;
                var s = window.innerHeight > window.innerWidth
            }
        })
    }

    function M(n, r) {
        try {
            var i = n.find(">ul:first-child >li:eq(" + r.act + ")")
        } catch (s) {
            var i = n.find(">ul:first-child >li:eq(1)")
        }
        r.lastslide = r.act;
        var o = n.find(">ul:first-child >li:eq(" + r.next + ")");
        var u = i.find(".slotholder");
        var a = o.find(".slotholder");
        a.find(".defaultimg").each(function () {
            var n = e(this);
            if (n.data("kenburn") != t) n.data("kenburn").restart();
            TweenLite.killTweensOf(n, false);
            TweenLite.set(n, {scale: 1, rotationZ: 0});
            n.data("bgposition", a.data("bgposition"));
            n.data("currotate", a.data("rotationstart"));
            n.data("curscale", a.data("bgfit"))
        })
    }

    function _(n, r) {
        try {
            var i = n.find(">ul:first-child >li:eq(" + r.act + ")")
        } catch (s) {
            var i = n.find(">ul:first-child >li:eq(1)")
        }
        r.lastslide = r.act;
        var u = n.find(">ul:first-child >li:eq(" + r.next + ")");
        var a = i.find(".slotholder");
        var f = u.find(".slotholder");
        var l = f.data("bgposition"), c = f.data("bgpositionend"), h = f.data("zoomstart") / 100,
            p = f.data("zoomend") / 100, d = f.data("rotationstart"), v = f.data("rotationend"), m = f.data("bgfit"),
            g = f.data("bgfitend"), y = f.data("easeme"), b = f.data("duration") / 1e3;
        if (m == t) m = 100;
        if (g == t) g = 100;
        m = D(m, f, r);
        g = D(g, f, r);
        if (h == t) h = 1;
        if (p == t) p = 1;
        if (d == t) d = 0;
        if (v == t) v = 0;
        if (h < 1) h = 1;
        if (p < 1) p = 1;
        f.find(".defaultimg").each(function () {
            var t = e(this);
            t.data("kenburn", TweenLite.fromTo(t, b, {
                transformPerspective: 1200,
                backgroundSize: m,
                z: 0,
                backgroundPosition: l,
                rotationZ: d
            }, {
                yoyo: 2, rotationZ: v, ease: y, backgroundSize: g, backgroundPosition: c, onUpdate: function () {
                    t.data("bgposition", t.css("backgroundPosition"));
                    if (!o(8)) t.data("currotate", j(t));
                    if (!o(8)) t.data("curscale", t.css("backgroundSize"))
                }
            }))
        })
    }

    function D(e, t, n) {
        var r = t.data("owidth");
        var i = t.data("oheight");
        var s = n.container.width() / r;
        var o = i * s;
        var u = o / n.container.height() * e;
        return e + "% " + u + "%"
    }

    function P(e) {
        var t = e.css("-webkit-transform") || e.css("-moz-transform") || e.css("-ms-transform") || e.css("-o-transform") || e.css("transform");
        return t
    }

    function H(e) {
        return e.replace(/^matrix(3d)?\((.*)\)$/, "$2").split(/, /)
    }

    function B(e) {
        var t = H(P(e)), n = 1;
        if (t[0] !== "none") {
            var r = t[0], i = t[1], s = 10;
            n = Math.round(Math.sqrt(r * r + i * i) * s) / s
        }
        return n
    }

    function j(e) {
        var t = e.css("-webkit-transform") || e.css("-moz-transform") || e.css("-ms-transform") || e.css("-o-transform") || e.css("transform");
        if (t !== "none") {
            var n = t.split("(")[1].split(")")[0].split(",");
            var r = n[0];
            var i = n[1];
            var s = Math.round(Math.atan2(i, r) * (180 / Math.PI))
        } else {
            var s = 0
        }
        return s < 0 ? s += 360 : s
    }

    function F(e, t, n, r, i, s) {
        S(e, t);
        n.find(".defaultimg").css({opacity: 1});
        if (i.index() != s.index()) r.find(".defaultimg").css({opacity: 0});
        t.act = t.next;
        f(e);
        if (n.data("kenburns") == "on") _(e, t)
    }

    function I(t) {
        var n = t.target.getVideoEmbedCode();
        var r = e("#" + n.split('id="')[1].split('"')[0]);
        var i = r.closest(".tp-simpleresponsive");
        var s = r.parent().data("player");
        if (t.data == YT.PlayerState.PLAYING) {
            var o = i.find(".tp-bannertimer");
            var u = o.data("opt");
            if (r.closest(".tp-caption").data("volume") == "mute") s.mute();
            u.videoplaying = true;
            i.trigger("stoptimer");
            i.trigger("revolution.slide.onvideoplay")
        } else {
            var o = i.find(".tp-bannertimer");
            var u = o.data("opt");
            if (t.data != -1) {
                u.videoplaying = false;
                i.trigger("playtimer");
                i.trigger("revolution.slide.onvideostop")
            }
        }
        if (t.data == 0 && u.nextslideatend == true) u.container.revnext()
    }

    function q(e, t, n) {
        if (e.addEventListener) e.addEventListener(t, n, false); else e.attachEvent(t, n, false)
    }

    function R(t, n) {
        var r = $f(t);
        var i = e("#" + t);
        var s = i.closest(".tp-simpleresponsive");
        r.addEvent("ready", function (e) {
            if (n) r.api("play");
            r.addEvent("play", function (e) {
                var t = s.find(".tp-bannertimer");
                var n = t.data("opt");
                n.videoplaying = true;
                s.trigger("stoptimer");
                if (i.closest(".tp-caption").data("volume") == "mute") r.api("setVolume", "0")
            });
            r.addEvent("finish", function (e) {
                var t = s.find(".tp-bannertimer");
                var n = t.data("opt");
                n.videoplaying = false;
                s.trigger("playtimer");
                s.trigger("revolution.slide.onvideoplay");
                if (n.nextslideatend == true) n.container.revnext()
            });
            r.addEvent("pause", function (e) {
                var t = s.find(".tp-bannertimer");
                var n = t.data("opt");
                n.videoplaying = false;
                s.trigger("playtimer");
                s.trigger("revolution.slide.onvideostop")
            })
        })
    }

    function U(e, t) {
        var n = t.width();
        var r = t.height();
        var i = e.data("mediaAspect");
        var s = n / r;
        e.css({position: "absolute"});
        var o = e.find("video");
        if (s < i) {
            e.width(r * i).height(r);
            e.css("top", 0).css("left", -(r * i - n) / 2).css("height", r)
        } else {
            e.width(n).height(n / i);
            e.css("top", -(n / i - r) / 2).css("left", 0).css("height", n / i)
        }
    }

    function z() {
        var e = new Object;
        e.x = 0;
        e.y = 0;
        e.rotationX = 0;
        e.rotationY = 0;
        e.rotationZ = 0;
        e.scale = 1;
        e.scaleX = 1;
        e.scaleY = 1;
        e.skewX = 0;
        e.skewY = 0;
        e.opacity = 0;
        e.transformOrigin = "center, center";
        e.transformPerspective = 400;
        e.rotation = 0;
        return e
    }

    function W(t, n) {
        var r = n.split(";");
        e.each(r, function (e, n) {
            n = n.split(":");
            var r = n[0], i = n[1];
            if (r == "rotationX") t.rotationX = parseInt(i, 0);
            if (r == "rotationY") t.rotationY = parseInt(i, 0);
            if (r == "rotationZ") t.rotationZ = parseInt(i, 0);
            if (r == "rotationZ") t.rotation = parseInt(i, 0);
            if (r == "scaleX") t.scaleX = parseFloat(i);
            if (r == "scaleY") t.scaleY = parseFloat(i);
            if (r == "opacity") t.opacity = parseFloat(i);
            if (r == "skewX") t.skewX = parseInt(i, 0);
            if (r == "skewY") t.skewY = parseInt(i, 0);
            if (r == "x") t.x = parseInt(i, 0);
            if (r == "y") t.y = parseInt(i, 0);
            if (r == "z") t.z = parseInt(i, 0);
            if (r == "transformOrigin") t.transformOrigin = i.toString();
            if (r == "transformPerspective") t.transformPerspective = parseInt(i, 0)
        });
        return t
    }

    function X(t) {
        var n = t.split("animation:");
        var r = new Object;
        r.animation = W(z(), n[1]);
        var i = n[0].split(";");
        e.each(i, function (e, t) {
            t = t.split(":");
            var n = t[0], i = t[1];
            if (n == "typ") r.typ = i;
            if (n == "speed") r.speed = parseInt(i, 0) / 1e3;
            if (n == "start") r.start = parseInt(i, 0) / 1e3;
            if (n == "elementdelay") r.elementdelay = parseFloat(i);
            if (n == "ease") r.ease = i
        });
        return r
    }

    function V(n, r, i) {
        var o = 0;
        var u = 0;
        n.find(".tp-caption").each(function (n) {
            o = r.width / 2 - r.startwidth * r.bw / 2;
            var a = r.bw;
            var f = r.bh;
            if (r.fullScreen == "on") u = r.height / 2 - r.startheight * r.bh / 2;
            if (r.autoHeight == "on") u = r.container.height() / 2 - r.startheight * r.bh / 2;
            if (u < 0) u = 0;
            var l = e(this);
            var c = 0;
            if (r.width < r.hideCaptionAtLimit && l.data("captionhidden") == "on") {
                l.addClass("tp-hidden-caption");
                c = 1
            } else {
                if (r.width < r.hideAllCaptionAtLimit || r.width < r.hideAllCaptionAtLilmit) {
                    l.addClass("tp-hidden-caption");
                    c = 1
                } else {
                    l.removeClass("tp-hidden-caption")
                }
            }
            if (c == 0) {
                if (l.data("linktoslide") != t && !l.hasClass("hasclicklistener")) {
                    l.addClass("hasclicklistener");
                    l.css({cursor: "pointer"});
                    if (l.data("linktoslide") != "no") {
                        l.click(function () {
                            var t = e(this);
                            var n = t.data("linktoslide");
                            if (n != "next" && n != "prev") {
                                r.container.data("showus", n);
                                r.container.parent().find(".tp-rightarrow").click()
                            } else if (n == "next") r.container.parent().find(".tp-rightarrow").click(); else if (n == "prev") r.container.parent().find(".tp-leftarrow").click()
                        })
                    }
                }
                if (o < 0) o = 0;
                var h = "iframe" + Math.round(Math.random() * 1e3 + 1);
                if (l.find("iframe").length > 0 || l.find("video").length > 0) {
                    if (l.data("autoplayonlyfirsttime") == true || l.data("autoplayonlyfirsttime") == "true") {
                        l.data("autoplay", true)
                    }
                    l.find("iframe").each(function () {
                        var n = e(this);
                        if (s()) {
                            var o = n.attr("src");
                            n.attr("src", "");
                            n.attr("src", o)
                        }
                        r.nextslideatend = l.data("nextslideatend");
                        if (l.data("thumbimage") != t && l.data("thumbimage").length > 2 && l.data("autoplay") != true && !i) {
                            l.find(".tp-thumb-image").remove();
                            l.append('<div class="tp-thumb-image" style="cursor:pointer; position:absolute;top:0px;left:0px;width:100%;height:100%;background-image:url(' + l.data("thumbimage") + '); background-size:cover"></div>')
                        }
                        if (n.attr("src").toLowerCase().indexOf("youtube") >= 0) {
                            if (!n.hasClass("HasListener")) {
                                try {
                                    n.attr("id", h);
                                    var u;
                                    var a = setInterval(function () {
                                        if (YT != t)
                                            if (typeof YT.Player != t && typeof YT.Player != "undefined") {
                                                if (l.data("autoplay") == true) {
                                                    u = new YT.Player(h, {
                                                        events: {
                                                            onStateChange: I,
                                                            onReady: function (e) {
                                                                e.target.playVideo()
                                                            }
                                                        }
                                                    })
                                                } else u = new YT.Player(h, {events: {onStateChange: I}});
                                                n.addClass("HasListener");
                                                l.data("player", u);
                                                clearInterval(a)
                                            }
                                    }, 100)
                                } catch (f) {
                                }
                            } else {
                                if (l.data("autoplay") == true) {
                                    var u = l.data("player");
                                    l.data("timerplay", setTimeout(function () {
                                        if (l.data("forcerewind") == "on") u.seekTo(0);
                                        u.playVideo()
                                    }, l.data("start")))
                                }
                            }
                            l.find(".tp-thumb-image").click(function () {
                                TweenLite.to(e(this), .3, {
                                    opacity: 0, ease: Power3.easeInOut, onComplete: function () {
                                        l.find(".tp-thumb-image").remove()
                                    }
                                });
                                var t = l.data("player");
                                t.playVideo()
                            })
                        } else {
                            if (n.attr("src").toLowerCase().indexOf("vimeo") >= 0) {
                                if (!n.hasClass("HasListener")) {
                                    n.addClass("HasListener");
                                    n.attr("id", h);
                                    var c = n.attr("src");
                                    var p = {}, d = c, v = /([^&=]+)=([^&]*)/g, m;
                                    while (m = v.exec(d)) {
                                        p[decodeURIComponent(m[1])] = decodeURIComponent(m[2])
                                    }
                                    if (p["player_id"] != t) c = c.replace(p["player_id"], h); else c = c + "&player_id=" + h;
                                    try {
                                        c = c.replace("api=0", "api=1")
                                    } catch (f) {
                                    }
                                    c = c + "&api=1";
                                    n.attr("src", c);
                                    var u = l.find("iframe")[0];
                                    var g = setInterval(function () {
                                        if ($f != t)
                                            if (typeof $f(h).api != t && typeof $f(h).api != "undefined") {
                                                $f(u).addEvent("ready", function () {
                                                    R(h, l.data("autoplay"))
                                                });
                                                clearInterval(g)
                                            }
                                    }, 100)
                                } else {
                                    if (l.data("autoplay") == true) {
                                        var n = l.find("iframe");
                                        var y = n.attr("id");
                                        var g = setInterval(function () {
                                            if ($f != t)
                                                if (typeof $f(y).api != t && typeof $f(y).api != "undefined") {
                                                    var e = $f(y);
                                                    l.data("timerplay", setTimeout(function () {
                                                        if (l.data("forcerewind") == "on") e.api("seekTo", 0);
                                                        e.api("play")
                                                    }, l.data("start")));
                                                    clearInterval(g)
                                                }
                                        }, 100)
                                    }
                                }
                                l.find(".tp-thumb-image").click(function () {
                                    TweenLite.to(e(this), .3, {
                                        opacity: 0,
                                        ease: Power3.easeInOut,
                                        onComplete: function () {
                                            l.find(".tp-thumb-image").remove()
                                        }
                                    });
                                    var n = l.find("iframe");
                                    var r = n.attr("id");
                                    var i = setInterval(function () {
                                        if ($f != t)
                                            if (typeof $f(r).api != t && typeof $f(r).api != "undefined") {
                                                var e = $f(r);
                                                e.api("play");
                                                clearInterval(i)
                                            }
                                    }, 100)
                                })
                            }
                        }
                    });
                    if (l.find("video").length > 0) {
                        l.find("video").each(function (n) {
                            var i = e(this);
                            var s = this;
                            if (!i.parent().hasClass("html5vid")) {
                                i.wrap('<div class="html5vid" style="position:relative;top:0px;left:0px;width:auto;height:auto"></div>')
                            }
                            var o = e(this).parent();
                            if (s.addEventListener) s.addEventListener("loadedmetadata", function () {
                                o.data("metaloaded", 1)
                            }); else s.attachEvent("loadedmetadata", function () {
                                o.data("metaloaded", 1)
                            });
                            if (!i.hasClass("HasListener")) {
                                i.addClass("HasListener");
                                s.addEventListener("play", function () {
                                    o.addClass("videoisplaying");
                                    o.find(".tp-poster").remove();
                                    if (l.data("volume") == "mute") s.muted = true;
                                    r.container.trigger("revolution.slide.onvideoplay");
                                    r.videoplaying = true;
                                    r.container.trigger("stoptimer")
                                });
                                s.addEventListener("pause", function () {
                                    o.removeClass("videoisplaying");
                                    r.videoplaying = false;
                                    r.container.trigger("playtimer");
                                    r.container.trigger("revolution.slide.onvideostop")
                                });
                                s.addEventListener("ended", function () {
                                    o.removeClass("videoisplaying");
                                    r.videoplaying = false;
                                    r.container.trigger("playtimer");
                                    r.container.trigger("revolution.slide.onvideostop");
                                    if (r.nextslideatend == true) r.container.revnext()
                                })
                            }
                            if (i.attr("poster") != t && o.find(".tp-poster").length == 0) o.append('<div class="tp-poster" style="position:absolute;z-index:1;width:100%;height:100%;top:0px;left:0px;background:url(' + i.attr("poster") + '); background-position:center center;background-size:100%;background-repeat:no-repeat;"></div>');
                            if (i.attr("control") == t && o.find(".tp-video-play-button").length == 0) {
                                o.append('<div class="tp-video-play-button"><i class="revicon-right-dir"></i><div class="tp-revstop"></div></div>');
                                o.find(".tp-video-play-button").click(function () {
                                    if (o.hasClass("videoisplaying")) s.pause(); else s.play()
                                })
                            }
                            if (i.attr("control") == t) {
                                o.find("video, .tp-poster").click(function () {
                                    if (o.hasClass("videoisplaying")) s.pause(); else s.play()
                                })
                            }
                            if (l.data("forcecover") == 1) {
                                U(o, r.container);
                                o.addClass("fullcoveredvideo");
                                l.addClass("fullcoveredvideo")
                            }
                            if (l.data("forcecover") == 1 || l.hasClass("fullscreenvideo")) {
                                o.css({width: "100%", height: "100%"})
                            }
                            var u = false;
                            if (l.data("autoplayonlyfirsttime") == true || l.data("autoplayonlyfirsttime") == "true") u = true;
                            clearInterval(o.data("interval"));
                            o.data("interval", setInterval(function () {
                                if (o.data("metaloaded") == 1 || s.duration != NaN) {
                                    clearInterval(o.data("interval"));
                                    if (l.data("dottedoverlay") != "none" && l.data("dottedoverlay") != t)
                                        if (l.find(".tp-dottedoverlay").length != 1) o.append('<div class="tp-dottedoverlay ' + l.data("dottedoverlay") + '"></div>');
                                    var n = 16 / 9;
                                    if (l.data("aspectratio") == "4:3") n = 4 / 3;
                                    o.data("mediaAspect", n);
                                    if (o.closest(".tp-caption").data("forcecover") == 1) {
                                        U(o, r.container);
                                        o.addClass("fullcoveredvideo")
                                    }
                                    i.css({display: "block"});
                                    r.nextslideatend = l.data("nextslideatend");
                                    if (l.data("autoplay") == true || u == true) {
                                        var a = e("body").find("#" + r.container.attr("id")).find(".tp-bannertimer");
                                        setTimeout(function () {
                                            r.videoplaying = true;
                                            r.container.trigger("stoptimer")
                                        }, 200);
                                        if (l.data("forcerewind") == "on" && !o.hasClass("videoisplaying"))
                                            if (s.currentTime > 0) s.currentTime = 0;
                                        if (l.data("volume") == "mute") s.muted = true;
                                        o.data("timerplay", setTimeout(function () {
                                            if (l.data("forcerewind") == "on" && !o.hasClass("videoisplaying"))
                                                if (s.currentTime > 0) s.currentTime = 0;
                                            if (l.data("volume") == "mute") s.muted = true;
                                            setTimeout(function () {
                                                s.play()
                                            }, 500)
                                        }, 10 + l.data("start")))
                                    }
                                    if (o.data("ww") == t) o.data("ww", i.attr("width"));
                                    if (o.data("hh") == t) o.data("hh", i.attr("height"));
                                    if (!l.hasClass("fullscreenvideo") && l.data("forcecover") == 1) {
                                        try {
                                            o.width(o.data("ww") * r.bw);
                                            o.height(o.data("hh") * r.bh)
                                        } catch (f) {
                                        }
                                    }
                                    clearInterval(o.data("interval"))
                                }
                            }), 100)
                        })
                    }
                    if (l.data("autoplay") == true) {
                        var p = e("body").find("#" + r.container.attr("id")).find(".tp-bannertimer");
                        setTimeout(function () {
                            r.videoplaying = true;
                            r.container.trigger("stoptimer")
                        }, 200);
                        r.videoplaying = true;
                        r.container.trigger("stoptimer");
                        if (l.data("autoplayonlyfirsttime") == true || l.data("autoplayonlyfirsttime") == "true") {
                            l.data("autoplay", false);
                            l.data("autoplayonlyfirsttime", false)
                        }
                    }
                }
                var d = 0;
                var v = 0;
                if (l.find("img").length > 0) {
                    var m = l.find("img");
                    if (m.data("ww") == t) m.data("ww", m.width());
                    if (m.data("hh") == t) m.data("hh", m.height());
                    var g = m.data("ww");
                    var y = m.data("hh");
                    m.width(g * r.bw);
                    m.height(y * r.bh);
                    d = m.width();
                    v = m.height()
                } else {
                    if (l.find("iframe").length > 0 || l.find("video").length > 0) {
                        var b = false;
                        var m = l.find("iframe");
                        if (m.length == 0) {
                            m = l.find("video");
                            b = true
                        }
                        m.css({display: "block"});
                        if (l.data("ww") == t) l.data("ww", m.width());
                        if (l.data("hh") == t) l.data("hh", m.height());
                        var g = l.data("ww");
                        var y = l.data("hh");
                        var w = l;
                        if (w.data("fsize") == t) w.data("fsize", parseInt(w.css("font-size"), 0) || 0);
                        if (w.data("pt") == t) w.data("pt", parseInt(w.css("paddingTop"), 0) || 0);
                        if (w.data("pb") == t) w.data("pb", parseInt(w.css("paddingBottom"), 0) || 0);
                        if (w.data("pl") == t) w.data("pl", parseInt(w.css("paddingLeft"), 0) || 0);
                        if (w.data("pr") == t) w.data("pr", parseInt(w.css("paddingRight"), 0) || 0);
                        if (w.data("mt") == t) w.data("mt", parseInt(w.css("marginTop"), 0) || 0);
                        if (w.data("mb") == t) w.data("mb", parseInt(w.css("marginBottom"), 0) || 0);
                        if (w.data("ml") == t) w.data("ml", parseInt(w.css("marginLeft"), 0) || 0);
                        if (w.data("mr") == t) w.data("mr", parseInt(w.css("marginRight"), 0) || 0);
                        if (w.data("bt") == t) w.data("bt", parseInt(w.css("borderTop"), 0) || 0);
                        if (w.data("bb") == t) w.data("bb", parseInt(w.css("borderBottom"), 0) || 0);
                        if (w.data("bl") == t) w.data("bl", parseInt(w.css("borderLeft"), 0) || 0);
                        if (w.data("br") == t) w.data("br", parseInt(w.css("borderRight"), 0) || 0);
                        if (w.data("lh") == t) w.data("lh", parseInt(w.css("lineHeight"), 0) || 0);
                        var E = r.width;
                        var S = r.height;
                        if (E > r.startwidth) E = r.startwidth;
                        if (S > r.startheight) S = r.startheight;
                        if (!l.hasClass("fullscreenvideo")) l.css({
                            "font-size": w.data("fsize") * r.bw + "px",
                            "padding-top": w.data("pt") * r.bh + "px",
                            "padding-bottom": w.data("pb") * r.bh + "px",
                            "padding-left": w.data("pl") * r.bw + "px",
                            "padding-right": w.data("pr") * r.bw + "px",
                            "margin-top": w.data("mt") * r.bh + "px",
                            "margin-bottom": w.data("mb") * r.bh + "px",
                            "margin-left": w.data("ml") * r.bw + "px",
                            "margin-right": w.data("mr") * r.bw + "px",
                            "border-top": w.data("bt") * r.bh + "px",
                            "border-bottom": w.data("bb") * r.bh + "px",
                            "border-left": w.data("bl") * r.bw + "px",
                            "border-right": w.data("br") * r.bw + "px",
                            "line-height": w.data("lh") * r.bh + "px",
                            height: y * r.bh + "px"
                        }); else {
                            o = 0;
                            u = 0;
                            l.data("x", 0);
                            l.data("y", 0);
                            var x = r.height;
                            if (r.autoHeight == "on") x = r.container.height();
                            l.css({width: r.width, height: x})
                        }
                        if (b == false) {
                            m.width(g * r.bw);
                            m.height(y * r.bh)
                        } else if (l.data("forcecover") != 1 && !l.hasClass("fullscreenvideo")) {
                            m.width(g * r.bw);
                            m.height(y * r.bh)
                        }
                        d = m.width();
                        v = m.height()
                    } else {
                        l.find(".tp-resizeme, .tp-resizeme *").each(function () {
                            K(e(this), r)
                        });
                        if (l.hasClass("tp-resizeme")) {
                            l.find("*").each(function () {
                                K(e(this), r)
                            })
                        }
                        K(l, r);
                        v = l.outerHeight(true);
                        d = l.outerWidth(true);
                        var T = l.outerHeight();
                        var N = l.css("backgroundColor");
                        l.find(".frontcorner").css({
                            borderWidth: T + "px",
                            left: 0 - T + "px",
                            borderRight: "0px solid transparent",
                            borderTopColor: N
                        });
                        l.find(".frontcornertop").css({
                            borderWidth: T + "px",
                            left: 0 - T + "px",
                            borderRight: "0px solid transparent",
                            borderBottomColor: N
                        });
                        l.find(".backcorner").css({
                            borderWidth: T + "px",
                            right: 0 - T + "px",
                            borderLeft: "0px solid transparent",
                            borderBottomColor: N
                        });
                        l.find(".backcornertop").css({
                            borderWidth: T + "px",
                            right: 0 - T + "px",
                            borderLeft: "0px solid transparent",
                            borderTopColor: N
                        })
                    }
                }
                if (r.fullScreenAlignForce == "on") {
                    o = 0;
                    u = 0
                }
                if (l.data("voffset") == t) l.data("voffset", 0);
                if (l.data("hoffset") == t) l.data("hoffset", 0);
                var C = l.data("voffset") * a;
                var k = l.data("hoffset") * a;
                var L = r.startwidth * a;
                var A = r.startheight * a;
                if (r.fullScreenAlignForce == "on") {
                    L = r.container.width();
                    A = r.container.height()
                }
                if (l.data("x") == "center" || l.data("xcenter") == "center") {
                    l.data("xcenter", "center");
                    l.data("x", L / 2 - l.outerWidth(true) / 2 + k)
                }
                if (l.data("x") == "left" || l.data("xleft") == "left") {
                    l.data("xleft", "left");
                    l.data("x", 0 / a + k)
                }
                if (l.data("x") == "right" || l.data("xright") == "right") {
                    l.data("xright", "right");
                    l.data("x", (L - l.outerWidth(true) + k) / a)
                }
                if (l.data("y") == "center" || l.data("ycenter") == "center") {
                    l.data("ycenter", "center");
                    l.data("y", A / 2 - l.outerHeight(true) / 2 + C)
                }
                if (l.data("y") == "top" || l.data("ytop") == "top") {
                    l.data("ytop", "top");
                    l.data("y", 0 / r.bh + C)
                }
                if (l.data("y") == "bottom" || l.data("ybottom") == "bottom") {
                    l.data("ybottom", "bottom");
                    l.data("y", (A - l.outerHeight(true) + C) / a)
                }
                if (l.data("start") == t) l.data("start", 1e3);
                var O = l.data("easing");
                if (O == t) O = "Power1.easeOut";
                var M = l.data("start") / 1e3;
                var _ = l.data("speed") / 1e3;
                if (l.data("x") == "center" || l.data("xcenter") == "center") var D = l.data("x") + o; else {
                    var D = a * l.data("x") + o
                }
                if (l.data("y") == "center" || l.data("ycenter") == "center") var P = l.data("y") + u; else {
                    var P = r.bh * l.data("y") + u
                }
                TweenLite.set(l, {top: P, left: D, overwrite: "auto"});
                if (!i) {
                    if (l.data("timeline") != t) l.data("timeline").clear();

                    function H() {
                        setTimeout(function () {
                            l.css({transform: "none", "-moz-transform": "none", "-webkit-transform": "none"})
                        }, 100)
                    }

                    function B() {
                        l.data("timer", setTimeout(function () {
                            if (l.hasClass("fullscreenvideo")) l.css({display: "block"})
                        }, l.data("start")))
                    }

                    var j = new TimelineLite({smoothChildTiming: true, onStart: B});
                    if (r.fullScreenAlignForce == "on") {
                    }
                    var F = l;
                    if (l.data("mySplitText") != t) l.data("mySplitText").revert();
                    if (l.data("splitin") == "chars" || l.data("splitin") == "words" || l.data("splitin") == "lines" || l.data("splitout") == "chars" || l.data("splitout") == "words" || l.data("splitout") == "lines") {
                        if (l.find("a").length > 0) l.data("mySplitText", new SplitText(l.find("a"), {
                            type: "lines,words,chars",
                            charsClass: "tp-splitted",
                            wordsClass: "tp-splitted",
                            linesClass: "tp-splitted"
                        })); else l.data("mySplitText", new SplitText(l, {
                            type: "lines,words,chars",
                            charsClass: "tp-splitted",
                            wordsClass: "tp-splitted",
                            linesClass: "tp-splitted"
                        }));
                        l.addClass("splitted")
                    }
                    if (l.data("splitin") == "chars") F = l.data("mySplitText").chars;
                    if (l.data("splitin") == "words") F = l.data("mySplitText").words;
                    if (l.data("splitin") == "lines") F = l.data("mySplitText").lines;
                    var q = z();
                    var V = z();
                    if (l.data("repeat") != t) repeatV = l.data("repeat");
                    if (l.data("yoyo") != t) yoyoV = l.data("yoyo");
                    if (l.data("repeatdelay") != t) repeatdelayV = l.data("repeatdelay");
                    if (l.hasClass("customin")) q = W(q, l.data("customin")); else if (l.hasClass("randomrotate")) {
                        q.scale = Math.random() * 3 + 1;
                        q.rotation = Math.round(Math.random() * 200 - 100);
                        q.x = Math.round(Math.random() * 200 - 100);
                        q.y = Math.round(Math.random() * 200 - 100)
                    } else if (l.hasClass("lfr") || l.hasClass("skewfromright")) q.x = 15 + r.width; else if (l.hasClass("lfl") || l.hasClass("skewfromleft")) q.x = -15 - d; else if (l.hasClass("sfl") || l.hasClass("skewfromleftshort")) q.x = -50; else if (l.hasClass("sfr") || l.hasClass("skewfromrightshort")) q.x = 50; else if (l.hasClass("lft")) q.y = -25 - v; else if (l.hasClass("lfb")) q.y = 25 + r.height; else if (l.hasClass("sft")) q.y = -50; else if (l.hasClass("sfb")) q.y = 50;
                    if (l.hasClass("skewfromright") || l.hasClass("skewfromrightshort")) q.skewX = -85; else if (l.hasClass("skewfromleft") || l.hasClass("skewfromleftshort")) q.skewX = 85;
                    if (l.hasClass("fade") || l.hasClass("sft") || l.hasClass("sfl") || l.hasClass("sfb") || l.hasClass("skewfromleftshort") || l.hasClass("sfr") || l.hasClass("skewfromrightshort")) q.opacity = 0;
                    if ($().toLowerCase() == "safari") {
                        q.rotationX = 0;
                        q.rotationY = 0
                    }
                    var J = l.data("elementdelay") == t ? 0 : l.data("elementdelay");
                    V.ease = q.ease = l.data("easing") == t ? Power1.easeInOut : l.data("easing");
                    q.data = new Object;
                    q.data.oldx = q.x;
                    q.data.oldy = q.y;
                    V.data = new Object;
                    V.data.oldx = V.x;
                    V.data.oldy = V.y;
                    q.x = q.x * a;
                    q.y = q.y * a;
                    var Q = new TimelineLite;
                    if (l.hasClass("customin")) {
                        if (F != l) j.add(TweenLite.set(l, {
                            opacity: 1,
                            scaleX: 1,
                            scaleY: 1,
                            rotationX: 0,
                            rotationY: 0,
                            rotationZ: 0,
                            skewX: 0,
                            skewY: 0,
                            z: 0,
                            x: 0,
                            y: 0,
                            visibility: "visible",
                            opacity: 1,
                            delay: 0,
                            overwrite: "all"
                        }));
                        q.visibility = "hidden";
                        V.visibility = "visible";
                        V.overwrite = "all";
                        V.opacity = 1;
                        V.onComplete = H();
                        V.delay = M;
                        j.add(Q.staggerFromTo(F, _, q, V, J), "frame0")
                    } else {
                        q.visibility = "visible";
                        q.transformPerspective = 600;
                        if (F != l) j.add(TweenLite.set(l, {
                            opacity: 1,
                            scaleX: 1,
                            scaleY: 1,
                            rotationX: 0,
                            rotationY: 0,
                            rotationZ: 0,
                            skewX: 0,
                            skewY: 0,
                            z: 0,
                            x: 0,
                            y: 0,
                            visibility: "visible",
                            opacity: 1,
                            delay: 0,
                            overwrite: "all"
                        }));
                        V.visibility = "visible";
                        V.delay = M;
                        V.onComplete = H();
                        V.opacity = 1;
                        if (l.hasClass("randomrotate") && F != l) {
                            for (var n = 0; n < F.length; n++) {
                                var Z = new Object;
                                var et = new Object;
                                e.extend(Z, q);
                                e.extend(et, V);
                                q.scale = Math.random() * 3 + 1;
                                q.rotation = Math.round(Math.random() * 200 - 100);
                                q.x = Math.round(Math.random() * 200 - 100);
                                q.y = Math.round(Math.random() * 200 - 100);
                                if (n != 0) et.delay = M + n * J;
                                j.append(TweenLite.fromTo(F[n], _, Z, et), "frame0")
                            }
                        } else j.add(Q.staggerFromTo(F, _, q, V, J), "frame0")
                    }
                    l.data("timeline", j);
                    var tt = new Array;
                    if (l.data("frames") != t) {
                        var nt = l.data("frames");
                        nt = nt.replace(/\s+/g, "");
                        nt = nt.replace("{", "");
                        var rt = nt.split("}");
                        e.each(rt, function (e, t) {
                            if (t.length > 0) {
                                var n = X(t);
                                G(l, r, n, "frame" + (e + 10), a)
                            }
                        })
                    }
                    j = l.data("timeline");
                    if (l.data("end") != t) {
                        Y(l, r, l.data("end") / 1e3, q, "frame99", a)
                    } else {
                        Y(l, r, 999999, q, "frame99", a)
                    }
                    j = l.data("timeline");
                    l.data("timeline", j)
                }
            }
            if (i) {
                if (l.data("timeline") != t) {
                    var it = l.data("timeline").getTweensOf();
                    e.each(it, function (e, n) {
                        if (n.vars.data != t) {
                            var r = n.vars.data.oldx * a;
                            var i = n.vars.data.oldy * a;
                            if (n.progress() != 1 && n.progress() != 0) {
                                try {
                                    n.vars.x = r;
                                    n.vary.y = i
                                } catch (s) {
                                }
                            } else {
                                if (n.progress() == 1) {
                                    TweenLite.set(n.target, {x: r, y: i})
                                }
                            }
                        }
                    })
                }
            }
        });
        var a = e("body").find("#" + r.container.attr("id")).find(".tp-bannertimer");
        a.data("opt", r)
    }

    function $() {
        var e = navigator.appName, t = navigator.userAgent, n;
        var r = t.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
        if (r && (n = t.match(/version\/([\.\d]+)/i)) != null) r[2] = n[1];
        r = r ? [r[1], r[2]] : [e, navigator.appVersion, "-?"];
        return r[0]
    }

    function J() {
        var e = navigator.appName, t = navigator.userAgent, n;
        var r = t.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
        if (r && (n = t.match(/version\/([\.\d]+)/i)) != null) r[2] = n[1];
        r = r ? [r[1], r[2]] : [e, navigator.appVersion, "-?"];
        return r[1]
    }

    function K(e, n) {
        if (e.data("fsize") == t) e.data("fsize", parseInt(e.css("font-size"), 0) || 0);
        if (e.data("pt") == t) e.data("pt", parseInt(e.css("paddingTop"), 0) || 0);
        if (e.data("pb") == t) e.data("pb", parseInt(e.css("paddingBottom"), 0) || 0);
        if (e.data("pl") == t) e.data("pl", parseInt(e.css("paddingLeft"), 0) || 0);
        if (e.data("pr") == t) e.data("pr", parseInt(e.css("paddingRight"), 0) || 0);
        if (e.data("mt") == t) e.data("mt", parseInt(e.css("marginTop"), 0) || 0);
        if (e.data("mb") == t) e.data("mb", parseInt(e.css("marginBottom"), 0) || 0);
        if (e.data("ml") == t) e.data("ml", parseInt(e.css("marginLeft"), 0) || 0);
        if (e.data("mr") == t) e.data("mr", parseInt(e.css("marginRight"), 0) || 0);
        if (e.data("bt") == t) e.data("bt", parseInt(e.css("borderTopWidth"), 0) || 0);
        if (e.data("bb") == t) e.data("bb", parseInt(e.css("borderBottomWidth"), 0) || 0);
        if (e.data("bl") == t) e.data("bl", parseInt(e.css("borderLeftWidth"), 0) || 0);
        if (e.data("br") == t) e.data("br", parseInt(e.css("borderRightWidth"), 0) || 0);
        if (e.data("ls") == t) e.data("ls", parseInt(e.css("letterSpacing"), 0) || 0);
        if (e.data("lh") == t) e.data("lh", parseInt(e.css("lineHeight"), 0) || 0);
        if (e.data("minwidth") == t) e.data("minwidth", parseInt(e.css("minWidth"), 0) || 0);
        if (e.data("minheight") == t) e.data("minheight", parseInt(e.css("minHeight"), 0) || 0);
        if (e.data("maxwidth") == t) e.data("maxwidth", parseInt(e.css("maxWidth"), 0) || "none");
        if (e.data("maxheight") == t) e.data("maxheight", parseInt(e.css("maxHeight"), 0) || "none");
        if (e.data("wan") == t) e.data("wan", e.css("-webkit-transition"));
        if (e.data("moan") == t) e.data("moan", e.css("-moz-animation-transition"));
        if (e.data("man") == t) e.data("man", e.css("-ms-animation-transition"));
        if (e.data("ani") == t) e.data("ani", e.css("transition"));
        if (!e.hasClass("tp-splitted")) {
            e.css("-webkit-transition", "none");
            e.css("-moz-transition", "none");
            e.css("-ms-transition", "none");
            e.css("transition", "none");
            TweenLite.set(e, {
                fontSize: Math.round(e.data("fsize") * n.bw) + "px",
                letterSpacing: Math.floor(e.data("ls") * n.bw) + "px",
                paddingTop: Math.round(e.data("pt") * n.bh) + "px",
                paddingBottom: Math.round(e.data("pb") * n.bh) + "px",
                paddingLeft: Math.round(e.data("pl") * n.bw) + "px",
                paddingRight: Math.round(e.data("pr") * n.bw) + "px",
                marginTop: e.data("mt") * n.bh + "px",
                marginBottom: e.data("mb") * n.bh + "px",
                marginLeft: e.data("ml") * n.bw + "px",
                marginRight: e.data("mr") * n.bw + "px",
                borderTopWidth: Math.round(e.data("bt") * n.bh) + "px",
                borderBottomWidth: Math.round(e.data("bb") * n.bh) + "px",
                borderLeftWidth: Math.round(e.data("bl") * n.bw) + "px",
                borderRightWidth: Math.round(e.data("br") * n.bw) + "px",
                lineHeight: Math.round(e.data("lh") * n.bh) + "px",
                minWidth: e.data("minwidth") * n.bw + "px",
                minHeight: e.data("minheight") * n.bh + "px",
                overwrite: "auto"
            });
            setTimeout(function () {
                e.css("-webkit-transition", e.data("wan"));
                e.css("-moz-transition", e.data("moan"));
                e.css("-ms-transition", e.data("man"));
                e.css("transition", e.data("ani"))
            }, 30);
            if (e.data("maxheight") != "none") e.css({maxHeight: e.data("maxheight") * n.bh + "px"});
            if (e.data("maxwidth") != "none") e.css({maxWidth: e.data("maxwidth") * n.bw + "px"})
        }
    }

    function Q(t, n) {
        t.find(".tp-caption").each(function (t) {
            var n = e(this);
            if (n.find("iframe").length > 0) {
                try {
                    var r = n.find("iframe");
                    var i = r.attr("id");
                    var s = $f(i);
                    s.api("pause");
                    clearTimeout(n.data("timerplay"))
                } catch (o) {
                }
                try {
                    var u = n.data("player");
                    u.stopVideo();
                    clearTimeout(n.data("timerplay"))
                } catch (o) {
                }
            }
            if (n.find("video").length > 0) {
                try {
                    n.find("video").each(function (t) {
                        var n = e(this).parent();
                        var r = n.attr("id");
                        clearTimeout(n.data("timerplay"));
                        var i = this;
                        i.pause()
                    })
                } catch (o) {
                }
            }
            try {
                var a = n.data("timeline");
                var f = a.getLabelTime("frame99");
                var l = a.time();
                if (f > l) {
                    var c = a.getTweensOf(n);
                    e.each(c, function (e, t) {
                        if (e != 0) t.pause()
                    });
                    if (n.css("opacity") != 0) a.play("frame99"); else a.progress(1, false)
                }
            } catch (o) {
            }
        })
    }

    function G(e, n, r, i, s) {
        var o = e.data("timeline");
        var u = new TimelineLite;
        var a = e;
        if (r.typ == "chars") a = e.data("mySplitText").chars; else if (r.typ == "words") a = e.data("mySplitText").words; else if (r.typ == "lines") a = e.data("mySplitText").lines;
        r.animation.ease = r.ease;
        if (r.animation.rotationZ != t) r.animation.rotation = r.animation.rotationZ;
        r.animation.data = new Object;
        r.animation.data.oldx = r.animation.x;
        r.animation.data.oldy = r.animation.y;
        r.animation.x = r.animation.x * s;
        r.animation.y = r.animation.y * s;
        o.add(u.staggerTo(a, r.speed, r.animation, r.elementdelay), r.start);
        o.addLabel(i, r.start);
        e.data("timeline", o)
    }

    function Y(e, n, r, i, s, o) {
        var u = e.data("timeline");
        var a = new TimelineLite;
        var f = z();
        var l = e.data("endspeed") == t ? e.data("speed") : e.data("endspeed");
        f.ease = e.data("endeasing") == t ? Power1.easeInOut : e.data("endeasing");
        l = l / 1e3;
        if (e.hasClass("ltr") || e.hasClass("ltl") || e.hasClass("str") || e.hasClass("stl") || e.hasClass("ltt") || e.hasClass("ltb") || e.hasClass("stt") || e.hasClass("stb") || e.hasClass("skewtoright") || e.hasClass("skewtorightshort") || e.hasClass("skewtoleft") || e.hasClass("skewtoleftshort") || e.hasClass("fadeout") || e.hasClass("randomrotateout")) {
            if (e.hasClass("skewtoright") || e.hasClass("skewtorightshort")) f.skewX = 35; else if (e.hasClass("skewtoleft") || e.hasClass("skewtoleftshort")) f.skewX = -35;
            if (e.hasClass("ltr") || e.hasClass("skewtoright")) f.x = n.width + 60; else if (e.hasClass("ltl") || e.hasClass("skewtoleft")) f.x = 0 - (n.width + 60); else if (e.hasClass("ltt")) f.y = 0 - (n.height + 60); else if (e.hasClass("ltb")) f.y = n.height + 60; else if (e.hasClass("str") || e.hasClass("skewtorightshort")) {
                f.x = 50;
                f.opacity = 0
            } else if (e.hasClass("stl") || e.hasClass("skewtoleftshort")) {
                f.x = -50;
                f.opacity = 0
            } else if (e.hasClass("stt")) {
                f.y = -50;
                f.opacity = 0
            } else if (e.hasClass("stb")) {
                f.y = 50;
                f.opacity = 0
            } else if (e.hasClass("randomrotateout")) {
                f.x = Math.random() * n.width;
                f.y = Math.random() * n.height;
                f.scale = Math.random() * 2 + .3;
                f.rotation = Math.random() * 360 - 180;
                f.opacity = 0
            } else if (e.hasClass("fadeout")) {
                f.opacity = 0
            }
            if (e.hasClass("skewtorightshort")) f.x = 270; else if (e.hasClass("skewtoleftshort")) f.x = -270;
            f.data = new Object;
            f.data.oldx = f.x;
            f.data.oldy = f.y;
            f.x = f.x * o;
            f.y = f.y * o;
            f.overwrite = "auto";
            var c = e;
            var c = e;
            if (e.data("splitout") == "chars") c = e.data("mySplitText").chars; else if (e.data("splitout") == "words") c = e.data("mySplitText").words; else if (e.data("splitout") == "lines") c = e.data("mySplitText").lines;
            var h = e.data("endelementdelay") == t ? 0 : e.data("endelementdelay");
            u.add(a.staggerTo(c, l, f, h), r)
        } else if (e.hasClass("customout")) {
            f = W(f, e.data("customout"));
            var c = e;
            if (e.data("splitout") == "chars") c = e.data("mySplitText").chars; else if (e.data("splitout") == "words") c = e.data("mySplitText").words; else if (e.data("splitout") == "lines") c = e.data("mySplitText").lines;
            var h = e.data("endelementdelay") == t ? 0 : e.data("endelementdelay");
            f.onStart = function () {
                TweenLite.set(e, {
                    transformPerspective: f.transformPerspective,
                    transformOrigin: f.transformOrigin,
                    overwrite: "auto"
                })
            };
            f.data = new Object;
            f.data.oldx = f.x;
            f.data.oldy = f.y;
            f.x = f.x * o;
            f.y = f.y * o;
            u.add(a.staggerTo(c, l, f, h), r)
        } else {
            i.delay = 0;
            u.add(TweenLite.to(e, l, i), r)
        }
        u.addLabel(s, r);
        e.data("timeline", u)
    }

    function Z(t, n) {
        t.children().each(function () {
            try {
                e(this).die("click")
            } catch (t) {
            }
            try {
                e(this).die("mouseenter")
            } catch (t) {
            }
            try {
                e(this).die("mouseleave")
            } catch (t) {
            }
            try {
                e(this).unbind("hover")
            } catch (t) {
            }
        });
        try {
            t.die("click", "mouseenter", "mouseleave")
        } catch (r) {
        }
        clearInterval(n.cdint);
        t = null
    }

    function et(n, r) {
        r.cd = 0;
        r.loop = 0;
        if (r.stopAfterLoops != t && r.stopAfterLoops > -1) r.looptogo = r.stopAfterLoops; else r.looptogo = 9999999;
        if (r.stopAtSlide != t && r.stopAtSlide > -1) r.lastslidetoshow = r.stopAtSlide; else r.lastslidetoshow = 999;
        r.stopLoop = "off";
        if (r.looptogo == 0) r.stopLoop = "on";
        if (r.slideamount > 1 && !(r.stopAfterLoops == 0 && r.stopAtSlide == 1)) {
            var i = n.find(".tp-bannertimer");
            n.on("stoptimer", function () {
                i.data("tween").pause();
                if (r.hideTimerBar == "on") i.css({visibility: "hidden"})
            });
            n.on("starttimer", function () {
                if (r.conthover != 1 && r.videoplaying != true && r.width > r.hideSliderAtLimit && r.bannertimeronpause != true && r.overnav != true)
                    if (r.stopLoop == "on" && r.next == r.lastslidetoshow - 1) {
                    } else {
                        i.css({visibility: "visible"});
                        i.data("tween").play()
                    }
                if (r.hideTimerBar == "on") i.css({visibility: "hidden"})
            });
            n.on("restarttimer", function () {
                if (r.stopLoop == "on" && r.next == r.lastslidetoshow - 1) {
                } else {
                    i.css({visibility: "visible"});
                    i.data("tween", TweenLite.fromTo(i, r.delay / 1e3, {width: "0%"}, {
                        width: "100%",
                        ease: Linear.easeNone,
                        onComplete: o,
                        delay: 1
                    }))
                }
                if (r.hideTimerBar == "on") i.css({visibility: "hidden"})
            });
            n.on("nulltimer", function () {
                i.data("tween").pause(0);
                if (r.hideTimerBar == "on") i.css({visibility: "hidden"})
            });

            function o() {
                if (e("body").find(n).length == 0) {
                    Z(n, r);
                    clearInterval(r.cdint)
                }
                if (n.data("conthover-changed") == 1) {
                    r.conthover = n.data("conthover");
                    n.data("conthover-changed", 0)
                }
                r.act = r.next;
                r.next = r.next + 1;
                if (r.next > n.find(">ul >li").length - 1) {
                    r.next = 0;
                    r.looptogo = r.looptogo - 1;
                    if (r.looptogo <= 0) {
                        r.stopLoop = "on"
                    }
                }
                if (r.stopLoop == "on" && r.next == r.lastslidetoshow - 1) {
                    n.find(".tp-bannertimer").css({visibility: "hidden"});
                    n.trigger("revolution.slide.onstop")
                } else {
                    i.data("tween").restart()
                }
                C(n, r)
            }

            i.data("tween", TweenLite.fromTo(i, r.delay / 1e3, {width: "0%"}, {
                width: "100%",
                ease: Linear.easeNone,
                onComplete: o,
                delay: 1
            }));
            i.data("opt", r);
            n.hover(function () {
                if (r.onHoverStop == "on" && !s()) {
                    n.trigger("stoptimer");
                    n.trigger("revolution.slide.onpause");
                    var i = n.find(">ul >li:eq(" + r.next + ") .slotholder");
                    i.find(".defaultimg").each(function () {
                        var n = e(this);
                        if (n.data("kenburn") != t) n.data("kenburn").pause()
                    })
                }
            }, function () {
                if (n.data("conthover") != 1) {
                    n.trigger("revolution.slide.onresume");
                    n.trigger("starttimer");
                    var i = n.find(">ul >li:eq(" + r.next + ") .slotholder");
                    i.find(".defaultimg").each(function () {
                        var n = e(this);
                        if (n.data("kenburn") != t) n.data("kenburn").play()
                    })
                }
            })
        }
    }

    e.fn.extend({
        revolution: function (i) {
            e.fn.revolution.defaults = {
                delay: 9e3,
                startheight: 500,
                startwidth: 960,
                fullScreenAlignForce: "off",
                autoHeight: "off",
                hideTimerBar: "off",
                hideThumbs: 200,
                hideNavDelayOnMobile: 1500,
                thumbWidth: 100,
                thumbHeight: 50,
                thumbAmount: 3,
                navigationType: "bullet",
                navigationArrows: "solo",
                hideThumbsOnMobile: "off",
                hideBulletsOnMobile: "off",
                hideArrowsOnMobile: "off",
                hideThumbsUnderResoluition: 0,
                navigationStyle: "round",
                navigationHAlign: "center",
                navigationVAlign: "bottom",
                navigationHOffset: 0,
                navigationVOffset: 20,
                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 20,
                soloArrowLeftVOffset: 0,
                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 20,
                soloArrowRightVOffset: 0,
                keyboardNavigation: "on",
                touchenabled: "on",
                onHoverStop: "on",
                stopAtSlide: -1,
                stopAfterLoops: -1,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLimit: 0,
                hideSliderAtLimit: 0,
                shadow: 0,
                fullWidth: "off",
                fullScreen: "off",
                minFullScreenHeight: 0,
                fullScreenOffsetContainer: "",
                dottedOverlay: "none",
                forceFullWidth: "off",
                spinner: "spinner0",
                swipe_velocity: .4,
                swipe_max_touches: 1,
                swipe_min_touches: 1,
                drag_block_vertical: false,
                isJoomla: false,
                parallax: "off",
                parallaxLevels: [10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85]
            };
            i = e.extend({}, e.fn.revolution.defaults, i);
            return this.each(function () {
                var o = i;
                o.desktop = !navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|BB10|mobi|tablet|opera mini|nexus 7)/i);
                if (o.fullWidth != "on" && o.fullScreen != "on") o.autoHeight = "off";
                if (o.fullScreen == "on") o.autoHeight = "on";
                if (o.fullWidth != "on" && o.fullScreen != "on") forceFulWidth = "off";
                var u = e(this);
                if (o.fullWidth == "on" && o.autoHeight == "off") u.css({maxHeight: o.startheight + "px"});
                if (s() && o.hideThumbsOnMobile == "on" && o.navigationType == "thumb") o.navigationType = "none";
                if (s() && o.hideBulletsOnMobile == "on" && o.navigationType == "bullet") o.navigationType = "none";
                if (s() && o.hideBulletsOnMobile == "on" && o.navigationType == "both") o.navigationType = "none";
                if (s() && o.hideArrowsOnMobile == "on") o.navigationArrows = "none";
                if (o.forceFullWidth == "on") {
                    var f = u.parent().offset().left;
                    var l = u.parent().css("marginBottom");
                    var m = u.parent().css("marginTop");
                    if (l == t) l = 0;
                    if (m == t) m = 0;
                    u.parent().wrap('<div style="position:relative;width:100%;height:auto;margin-top:' + m + ";margin-bottom:" + l + '" class="forcefullwidth_wrapper_tp_banner"></div>');
                    u.closest(".forcefullwidth_wrapper_tp_banner").append('<div class="tp-fullwidth-forcer" style="width:100%;height:' + u.height() + 'px"></div>');
                    u.css({
                        backgroundColor: u.parent().css("backgroundColor"),
                        backgroundImage: u.parent().css("backgroundImage")
                    });
                    u.parent().css({left: 0 - f + "px", position: "absolute", width: e(window).width()});
                    o.width = e(window).width()
                }
                try {
                    if (o.hideThumbsUnderResolution > e(window).width() && o.hideThumbsUnderResolution != 0) {
                        u.parent().find(".tp-bullets.tp-thumbs").css({display: "none"})
                    } else {
                        u.parent().find(".tp-bullets.tp-thumbs").css({display: "block"})
                    }
                } catch (g) {
                }
                if (!u.hasClass("revslider-initialised")) {
                    u.addClass("revslider-initialised");
                    if (u.attr("id") == t) u.attr("id", "revslider-" + Math.round(Math.random() * 1e3 + 5));
                    o.firefox13 = false;
                    o.ie = !e.support.opacity;
                    o.ie9 = document.documentMode == 9;
                    o.origcd = o.delay;
                    var b = e.fn.jquery.split("."), w = parseFloat(b[0]), E = parseFloat(b[1]),
                        S = parseFloat(b[2] || "0");
                    if (w == 1 && E < 7) {
                        u.html('<div style="text-align:center; padding:40px 0px; font-size:20px; color:#992222;"> The Current Version of jQuery:' + b + " <br>Please update your jQuery Version to min. 1.7 in Case you wish to use the Revolution Slider Plugin</div>")
                    }
                    if (w > 1) o.ie = false;
                    if (!e.support.transition) e.fn.transition = e.fn.animate;
                    u.find(".caption").each(function () {
                        e(this).addClass("tp-caption")
                    });
                    if (s()) {
                        u.find(".tp-caption").each(function () {
                            if (e(this).data("autoplay") == true) e(this).data("autoplay", false)
                        })
                    }
                    var x = 0;
                    var T = 0;
                    var N = 0;
                    var k = "http";
                    if (location.protocol === "https:") {
                        k = "https"
                    }
                    u.find(".tp-caption iframe").each(function (t) {
                        try {
                            if (e(this).attr("src").indexOf("you") > 0 && x == 0) {
                                x = 1;
                                var n = document.createElement("script");
                                var r = "https";
                                n.src = r + "://www.youtube.com/iframe_api";
                                var i = document.getElementsByTagName("script")[0];
                                var s = true;
                                e("head").find("*").each(function () {
                                    if (e(this).attr("src") == r + "://www.youtube.com/iframe_api") s = false
                                });
                                if (s) {
                                    i.parentNode.insertBefore(n, i)
                                }
                            }
                        } catch (o) {
                        }
                    });
                    u.find(".tp-caption iframe").each(function (t) {
                        try {
                            if (e(this).attr("src").indexOf("vim") > 0 && T == 0) {
                                T = 1;
                                var n = document.createElement("script");
                                n.src = k + "_3A//a.vimeocdn.com/js/froogaloop2.min.js";
                                var r = document.getElementsByTagName("script")[0];
                                var i = true;
                                e("head").find("*").each(function () {
                                    if (e(this).attr("src") == k + "_3A//a.vimeocdn.com/js/froogaloop2.min.js") i = false
                                });
                                if (i) r.parentNode.insertBefore(n, r)
                            }
                        } catch (s) {
                        }
                    });
                    u.find(".tp-caption video").each(function (t) {
                        e(this).removeClass("video-js").removeClass("vjs-default-skin");
                        e(this).attr("preload", "");
                        e(this).css({display: "none"})
                    });
                    if (o.shuffle == "on") {
                        for (var L = 0; L < u.find(">ul:first-child >li").length; L++) {
                            var A = Math.round(Math.random() * u.find(">ul:first-child >li").length);
                            u.find(">ul:first-child >li:eq(" + A + ")").prependTo(u.find(">ul:first-child"))
                        }
                    }
                    o.slots = 4;
                    o.act = -1;
                    o.next = 0;
                    if (o.startWithSlide != t) o.next = o.startWithSlide;
                    var M = n("#")[0];
                    if (M.length < 9) {
                        if (M.split("slide").length > 1) {
                            var _ = parseInt(M.split("slide")[1], 0);
                            if (_ < 1) _ = 1;
                            if (_ > u.find(">ul:first >li").length) _ = u.find(">ul:first >li").length;
                            o.next = _ - 1
                        }
                    }
                    o.firststart = 1;
                    if (o.navigationHOffset == t) o.navOffsetHorizontal = 0;
                    if (o.navigationVOffset == t) o.navOffsetVertical = 0;
                    u.append('<div class="tp-loader ' + o.spinner + '">' + '<div class="dot1"></div>' + '<div class="dot2"></div>' + '<div class="bounce1"></div>' + '<div class="bounce2"></div>' + '<div class="bounce3"></div>' + "</div>");
                    if (u.find(".tp-bannertimer").length == 0) u.append('<div class="tp-bannertimer" style="visibility:hidden"></div>');
                    var D = u.find(".tp-bannertimer");
                    if (D.length > 0) {
                        D.css({width: "0%"})
                    }
                    u.addClass("tp-simpleresponsive");
                    o.container = u;
                    o.slideamount = u.find(">ul:first >li").length;
                    if (u.height() == 0) u.height(o.startheight);
                    if (o.startwidth == t || o.startwidth == 0) o.startwidth = u.width();
                    if (o.startheight == t || o.startheight == 0) o.startheight = u.height();
                    o.width = u.width();
                    o.height = u.height();
                    o.bw = o.startwidth / u.width();
                    o.bh = o.startheight / u.height();
                    if (o.width != o.startwidth) {
                        o.height = Math.round(o.startheight * (o.width / o.startwidth));
                        u.height(o.height)
                    }
                    if (o.shadow != 0) {
                        u.parent().append('<div class="tp-bannershadow tp-shadow' + o.shadow + '"></div>');
                        var f = 0;
                        if (o.forceFullWidth == "on") f = 0 - o.container.parent().offset().left;
                        u.parent().find(".tp-bannershadow").css({width: o.width, left: f})
                    }
                    u.find("ul").css({display: "none"});
                    var P = u;
                    u.find("ul").css({display: "block"});
                    y(u, o);
                    if (o.parallax != "off") O(u, o);
                    if (o.slideamount > 1) c(u, o);
                    if (o.slideamount > 1) a(u, o);
                    if (o.slideamount > 1) h(u, o);
                    if (o.keyboardNavigation == "on") p(u, o);
                    d(u, o);
                    if (o.hideThumbs > 0) v(u, o);
                    C(u, o);
                    if (o.slideamount > 1) et(u, o);
                    setTimeout(function () {
                        u.trigger("revolution.slide.onloaded")
                    }, 500);
                    e("body").data("rs-fullScreenMode", false);
                    e(window).on("mozfullscreenchange webkitfullscreenchange fullscreenchange", function () {
                        e("body").data("rs-fullScreenMode", !e("body").data("rs-fullScreenMode"));
                        if (e("body").data("rs-fullScreenMode")) {
                            setTimeout(function () {
                                e(window).trigger("resize")
                            }, 200)
                        }
                    });
                    e(window).resize(function () {
                        if (e("body").find(u) != 0)
                            if (o.forceFullWidth == "on") {
                                var t = o.container.closest(".forcefullwidth_wrapper_tp_banner").offset().left;
                                o.container.parent().css({left: 0 - t + "px", width: e(window).width()})
                            }
                        if (u.outerWidth(true) != o.width || u.is(":hidden")) {
                            r(u, o)
                        }
                    });
                    try {
                        if (o.hideThumbsUnderResoluition != 0 && o.navigationType == "thumb") {
                            if (o.hideThumbsUnderResoluition > e(window).width()) e(".tp-bullets").css({display: "none"}); else e(".tp-bullets").css({display: "block"})
                        }
                    } catch (g) {
                    }
                    u.find(".tp-scrollbelowslider").on("click", function () {
                        var t = 0;
                        try {
                            t = e("body").find(o.fullScreenOffsetContainer).height()
                        } catch (n) {
                        }
                        try {
                            t = t - e(this).data("scrolloffset")
                        } catch (n) {
                        }
                        e("body,html").animate({scrollTop: u.offset().top + u.find(">ul >li").height() - t + "px"}, {duration: 400})
                    });
                    var H = u.parent();
                    if (e(window).width() < o.hideSliderAtLimit) {
                        u.trigger("stoptimer");
                        if (H.css("display") != "none") H.data("olddisplay", H.css("display"));
                        H.css({display: "none"})
                    }
                }
            })
        }, revscroll: function (t) {
            return this.each(function () {
                var n = e(this);
                e("body,html").animate({scrollTop: n.offset().top + n.find(">ul >li").height() - t + "px"}, {duration: 400})
            })
        }, revredraw: function (t) {
            return this.each(function () {
                var t = e(this);
                var n = t.parent().find(".tp-bannertimer");
                var i = n.data("opt");
                r(t, i)
            })
        }, revpause: function (t) {
            return this.each(function () {
                var t = e(this);
                t.data("conthover", 1);
                t.data("conthover-changed", 1);
                t.trigger("revolution.slide.onpause");
                var n = t.parent().find(".tp-bannertimer");
                var r = n.data("opt");
                r.bannertimeronpause = true;
                t.trigger("stoptimer")
            })
        }, revresume: function (t) {
            return this.each(function () {
                var t = e(this);
                t.data("conthover", 0);
                t.data("conthover-changed", 1);
                t.trigger("revolution.slide.onresume");
                var n = t.parent().find(".tp-bannertimer");
                var r = n.data("opt");
                r.bannertimeronpause = false;
                t.trigger("starttimer")
            })
        }, revnext: function (t) {
            return this.each(function () {
                var t = e(this);
                t.parent().find(".tp-rightarrow").click()
            })
        }, revprev: function (t) {
            return this.each(function () {
                var t = e(this);
                t.parent().find(".tp-leftarrow").click()
            })
        }, revmaxslide: function (t) {
            return e(this).find(">ul:first-child >li").length
        }, revcurrentslide: function (t) {
            var n = e(this);
            var r = n.parent().find(".tp-bannertimer");
            var i = r.data("opt");
            return i.act
        }, revlastslide: function (t) {
            var n = e(this);
            var r = n.parent().find(".tp-bannertimer");
            var i = r.data("opt");
            return i.lastslide
        }, revshowslide: function (t) {
            return this.each(function () {
                var n = e(this);
                n.data("showus", t);
                n.parent().find(".tp-rightarrow").click()
            })
        }
    });
    var N = function (n, r, i) {
        x(n, 0);
        var s = setInterval(function () {
            i.bannertimeronpause = true;
            i.container.trigger("stoptimer");
            i.cd = 0;
            var o = 0;
            n.find("img, .defaultimg").each(function (t) {
                if (e(this).data("lazydone") != 1) {
                    o++
                }
            });
            if (o > 0) x(n, o); else {
                clearInterval(s);
                if (r != t) r()
            }
        }, 100)
    };
})(jQuery);
(function (e) {
    "use strict";
    var t = e.GreenSockGlobals || e, n = function (e) {
            var n, r = e.split("."), i = t;
            for (n = 0; r.length > n; n++) i[r[n]] = i = i[r[n]] || {};
            return i
        }, r = n("com.greensock.utils"), i = function (e) {
            var t = e.nodeType, n = "";
            if (1 === t || 9 === t || 11 === t) {
                if ("string" == typeof e.textContent) return e.textContent;
                for (e = e.firstChild; e; e = e.nextSibling) n += i(e)
            } else if (3 === t || 4 === t) return e.nodeValue;
            return n
        }, s = document, o = s.defaultView ? s.defaultView.getComputedStyle : function () {
        }, u = /([A-Z])/g, a = function (e, t, n, r) {
            var i;
            return (n = n || o(e, null)) ? (e = n.getPropertyValue(t.replace(u, "-$1").toLowerCase()), i = e || n.length ? e : n[t]) : e.currentStyle && (n = e.currentStyle, i = n[t]), r ? i : parseInt(i, 10) || 0
        }, f = function (e) {
            return e.length && e[0] && (e[0].nodeType && e[0].style && !e.nodeType || e[0].length && e[0][0]) ? !0 : !1
        }, l = function (e) {
            var t, n, r, i = [], s = e.length;
            for (t = 0; s > t; t++)
                if (n = e[t], f(n))
                    for (r = n.length, r = 0; n.length > r; r++) i.push(n[r]); else i.push(n);
            return i
        }, c = ")eefec303079ad17405c", h = /(?:<br>|<br\/>|<br \/>)/gi, p = s.all && !s.addEventListener,
        d = "<div style='position:relative;display:inline-block;" + (p ? "*display:inline;*zoom:1;'" : "'"),
        v = function (e) {
            e = e || "";
            var t = -1 !== e.indexOf("++"), n = 1;
            return t && (e = e.split("++").join("")), function () {
                return d + (e ? " class='" + e + (t ? n++ : "") + "'>" : ">")
            }
        }, m = r.SplitText = t.SplitText = function (e, t) {
            if ("string" == typeof e && (e = m.selector(e)), !e) throw"cannot split a null element.";
            this.elements = f(e) ? l(e) : [e], this.chars = [], this.words = [], this.lines = [], this._originals = [], this.vars = t || {}, this.split(t)
        }, g = function (e, t, n, r, u) {
            h.test(e.innerHTML) && (e.innerHTML = e.innerHTML.replace(h, c));
            var f, l, p, d, m, g, y, b, w, E, S, x, T, N = i(e), C = t.type || t.split || "chars,words,lines",
                k = -1 !== C.indexOf("lines") ? [] : null, L = -1 !== C.indexOf("words"), A = -1 !== C.indexOf("chars"),
                O = "absolute" === t.position || t.absolute === !0, M = O ? "&#173; " : " ", _ = -999, D = o(e),
                P = a(e, "paddingLeft", D), H = a(e, "borderBottomWidth", D) + a(e, "borderTopWidth", D),
                B = a(e, "borderLeftWidth", D) + a(e, "borderRightWidth", D),
                j = a(e, "paddingTop", D) + a(e, "paddingBottom", D), F = a(e, "paddingLeft", D) + a(e, "paddingRight", D),
                I = a(e, "textAlign", D, !0), q = e.clientHeight, R = e.clientWidth, U = N.length, z = "</div>",
                W = v(t.wordsClass), X = v(t.charsClass), V = -1 !== (t.linesClass || "").indexOf("++"), $ = t.linesClass;
            for (V && ($ = $.split("++").join("")), p = W(), d = 0; U > d; d++) g = N.charAt(d), ")" === g && N.substr(d, 20) === c ? (p += z + "<BR/>", d !== U - 1 && (p += " " + W()), d += 19) : " " === g && " " !== N.charAt(d - 1) && d !== U - 1 ? (p += z, d !== U - 1 && (p += M + W())) : p += A && " " !== g ? X() + g + "</div>" : g;
            for (e.innerHTML = p + z, m = e.getElementsByTagName("*"), U = m.length, y = [], d = 0; U > d; d++) y[d] = m[d];
            if (k || O)
                for (d = 0; U > d; d++) b = y[d], l = b.parentNode === e, (l || O || A && !L) && (w = b.offsetTop, k && l && w !== _ && "BR" !== b.nodeName && (f = [], k.push(f), _ = w), O && (b._x = b.offsetLeft, b._y = w, b._w = b.offsetWidth, b._h = b.offsetHeight), k && (L !== l && A || (f.push(b), b._x -= P), l && d && (y[d - 1]._wordEnd = !0)));
            for (d = 0; U > d; d++) b = y[d], l = b.parentNode === e, "BR" !== b.nodeName ? (O && (S = b.style, L || l || (b._x += b.parentNode._x, b._y += b.parentNode._y), S.left = b._x + "px", S.top = b._y + "px", S.position = "absolute", S.display = "block", S.width = b._w + 1 + "px", S.height = b._h + "px"), L ? l ? r.push(b) : A && n.push(b) : l ? (e.removeChild(b), y.splice(d--, 1), U--) : !l && A && (w = !k && !O && b.nextSibling, e.appendChild(b), w || e.appendChild(s.createTextNode(" ")), n.push(b))) : k || O ? (e.removeChild(b), y.splice(d--, 1), U--) : L || e.appendChild(b);
            if (k) {
                for (O && (E = s.createElement("div"), e.appendChild(E), x = E.offsetWidth + "px", w = E.offsetParent === e ? 0 : e.offsetLeft, e.removeChild(E)), S = e.style.cssText, e.style.cssText = "display:none;"; e.firstChild;) e.removeChild(e.firstChild);
                for (T = !O || !L && !A, d = 0; k.length > d; d++) {
                    for (f = k[d], E = s.createElement("div"), E.style.cssText = "display:block;text-align:" + I + ";position:" + (O ? "absolute;" : "relative;"), $ && (E.className = $ + (V ? d + 1 : "")), u.push(E), U = f.length, m = 0; U > m; m++) "BR" !== f[m].nodeName && (b = f[m], E.appendChild(b), T && (b._wordEnd || L) && E.appendChild(s.createTextNode(" ")), O && (0 === m && (E.style.top = b._y + "px", E.style.left = P + w + "px"), b.style.top = "0px", w && (b.style.left = b._x - w + "px")));
                    L || A || (E.innerHTML = i(E).split(String.fromCharCode(160)).join(" ")), O && (E.style.width = x, E.style.height = b._h + "px"), e.appendChild(E)
                }
                e.style.cssText = S
            }
            O && (q > e.clientHeight && (e.style.height = q - j + "px", q > e.clientHeight && (e.style.height = q + H + "px")), R > e.clientWidth && (e.style.width = R - F + "px", R > e.clientWidth && (e.style.width = R + B + "px")))
        }, y = m.prototype;
    y.split = function (e) {
        this.isSplit && this.revert(), this.vars = e || this.vars, this._originals.length = this.chars.length = this.words.length = this.lines.length = 0;
        for (var t = 0; this.elements.length > t; t++) this._originals[t] = this.elements[t].innerHTML, g(this.elements[t], this.vars, this.chars, this.words, this.lines);
        return this.isSplit = !0, this
    }, y.revert = function () {
        if (!this._originals) throw"revert() call wasn't scoped properly.";
        for (var e = this._originals.length; --e > -1;) this.elements[e].innerHTML = this._originals[e];
        return this.chars = [], this.words = [], this.lines = [], this.isSplit = !1, this
    }, m.selector = e.$ || e.jQuery || function (t) {
        return e.$ ? (m.selector = e.$, e.$(t)) : s ? s.getElementById("#" === t.charAt(0) ? t.substr(1) : t) : t
    }
})(window || {});
jQuery(document).ready(function () {
    "use strict";
    jQuery('.mega-menu-title').on('click', function () {
        if (jQuery('.mega-menu-category').is(':visible')) {
            jQuery('.mega-menu-category').slideUp();
        } else {
            jQuery('.mega-menu-category').slideDown();
        }
    });
    jQuery('.mega-menu-category .nav > li').hover(function () {
        jQuery(this).addClass("active");
        let ofTop = $(this).offset().top - $('#menu-category').offset().top;
        jQuery(this).find('.popup').stop(true, true).fadeIn('slow').parent().css('top', ofTop);
    }, function () {
        jQuery(this).removeClass("active");
        jQuery(this).find('.popup').stop(true, true).fadeOut('slow');
    });
    jQuery('.mega-menu-category .nav > li.view-more-cat').on('click', function (e) {
        if (jQuery('.mega-menu-category .nav > li.more-menu').is(':visible')) {
            jQuery('.mega-menu-category .nav > li.more-menu').stop().slideUp();
            jQuery(this).find('a').text('More');
        } else {
            jQuery('.mega-menu-category .nav > li.more-menu').stop().slideDown();
            jQuery(this).find('a').text('Close menu');
            jQuery(this).find('a').addClass('menu-hide');
        }
        e.preventDefault();
    });
    jQuery("#bestsell-slider .slider-items").owlCarousel({
        items: 3,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [768, 3],
        itemsTablet: [767, 2],
        itemsMobile: [360, 1],
        navigation: true,
        navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
        slideSpeed: 500,
        pagination: false
    });
    jQuery("#featured-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 3],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [768, 2],
        itemsMobile: [360, 1],
        navigation: true,
        navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
        slideSpeed: 500,
        pagination: false
    });
    jQuery("#new-arrivals-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [768, 3],
        itemsTablet: [767, 2],
        itemsMobile: [360, 1],
        navigation: true,
        navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
        slideSpeed: 500,
        pagination: false
    });
    jQuery("#brand-logo-slider .slider-items").owlCarousel({
        autoPlay: true,
        items: 6,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [600, 2],
        itemsMobile: [320, 1],
        navigation: true,
        navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
        slideSpeed: 500,
        pagination: false
    });
    jQuery("#category-desc-slider .slider-items").owlCarousel({
        autoPlay: true,
        items: 1,
        itemsDesktop: [1024, 1],
        itemsDesktopSmall: [900, 1],
        itemsTablet: [600, 1],
        itemsMobile: [320, 1],
        navigation: true,
        navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
        slideSpeed: 500,
        pagination: false
    });
    jQuery("#related-products-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [600, 2],
        itemsMobile: [360, 1],
        navigation: true,
        navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
        slideSpeed: 500,
        pagination: false
    });
    jQuery("#upsell-products-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [600, 2],
        itemsMobile: [360, 1],
        navigation: true,
        navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
        slideSpeed: 500,
        pagination: false
    });
    jQuery("#testimonials-slider .slider-items").owlCarousel({
        autoPlay: true,
        items: 1,
        itemsDesktop: [1024, 1],
        itemsDesktopSmall: [900, 1],
        itemsTablet: [640, 1],
        itemsMobile: [390, 1],
        navigation: false,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: false
    });
    jQuery(document).ready(function () {
        "use strict";
        jQuery("#bestsellers4 .slider-items").owlCarousel({
            items: 1,
            itemsDesktop: [1024, 1],
            itemsDesktopSmall: [900, 1],
            itemsTablet: [767, 1],
            itemsMobile: [360, 1],
            navigation: false,
            navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
            slideSpeed: 500,
            pagination: true
        });
    });
    jQuery("#mobile-menu").mobileMenu({
        MenuWidth: 250,
        SlideSpeed: 300,
        WindowsMaxWidth: 991,
        PagePush: true,
        FromLeft: true,
        Overlay: true,
        CollapseMenu: true,
        ClassName: "mobile-menu"
    });
    if (jQuery('.subDropdown')[0]) {
        jQuery('.subDropdown').on("click", function () {
            jQuery(this).toggleClass('');
            jQuery(this).toggleClass('minus');
            jQuery(this).parent().find('ul').slideToggle();
        });
    }
    jQuery.extend(jQuery.easing, {
        easeInCubic: function (x, t, b, c, d) {
            return c * (t /= d) * t * t + b;
        }, easeOutCubic: function (x, t, b, c, d) {
            return c * ((t = t / d - 1) * t * t + 1) + b;
        },
    });
    (function (jQuery) {
        jQuery.fn.extend({
            accordion: function () {
                return this.each(function () {
                    function activate(el, effect) {
                        jQuery(el).siblings(panelSelector)[(effect || activationEffect)](((effect == "show") ? activationEffectSpeed : false), function () {
                            jQuery(el).parents().show();
                        });
                    }
                });
            }
        });
    })(jQuery);
    jQuery(function (jQuery) {
        jQuery('.accordion').accordion();
        jQuery('.accordion').each(function (index) {
            var activeItems = jQuery(this).find('li.active');
            activeItems.each(function (i) {
                jQuery(this).children('ul').css('display', 'block');
                if (i == activeItems.length - 1) {
                    jQuery(this).addClass("current");
                }
            });
        });
    });

    function slideEffectAjax() {
        jQuery('.top-cart-contain').mouseenter(function () {
            jQuery(this).find(".top-cart-content").stop(true, true).slideDown();
        });
        jQuery('.top-cart-contain').mouseleave(function () {
            jQuery(this).find(".top-cart-content").stop(true, true).slideUp();
        });
    }

    jQuery(document).ready(function () {
        slideEffectAjax();
    });
});
jQuery.fn.UItoTop = function (options) {
    var defaults = {
        text: '',
        min: 200,
        inDelay: 600,
        outDelay: 400,
        containerID: 'toTop',
        containerHoverID: 'toTopHover',
        scrollSpeed: 1200,
        easingType: 'linear'
    };
    var settings = jQuery.extend(defaults, options);
    var containerIDhash = '#' + settings.containerID;
    var containerHoverIDHash = '#' + settings.containerHoverID;
    jQuery('body').append('<a href="#" id="' + settings.containerID + '">' + settings.text + '</a>');
    jQuery(containerIDhash).hide().on("click", function () {
        jQuery('html, body').animate({scrollTop: 0}, settings.scrollSpeed, settings.easingType);
        jQuery('#' + settings.containerHoverID, this).stop().animate({'opacity': 0}, settings.inDelay, settings.easingType);
        return false;
    }).prepend('<span id="' + settings.containerHoverID + '"></span>').hover(function () {
        jQuery(containerHoverIDHash, this).stop().animate({'opacity': 1}, 600, 'linear');
    }, function () {
        jQuery(containerHoverIDHash, this).stop().animate({'opacity': 0}, 700, 'linear');
    });
    jQuery(window).scroll(function () {
        var sd = jQuery(window).scrollTop();
        if (typeof document.body.style.maxHeight === "undefined") {
            jQuery(containerIDhash).css({
                'position': 'absolute',
                'top': jQuery(window).scrollTop() + jQuery(window).height() - 50
            });
        }
        if (sd > settings.min) jQuery(containerIDhash).fadeIn(settings.inDelay); else jQuery(containerIDhash).fadeOut(settings.Outdelay);
    });
};
var isTouchDevice = ('ontouchstart' in window) || (navigator.msMaxTouchPoints > 0);
jQuery(window).on("load", function () {
    if (isTouchDevice) {
        jQuery('#nav a.level-top').on("click", function (e) {
            jQueryt = jQuery(this);
            jQueryparent = jQueryt.parent();
            if (jQueryparent.hasClass('parent')) {
                if (!jQueryt.hasClass('menu-ready')) {
                    jQuery('#nav a.level-top').removeClass('menu-ready');
                    jQueryt.addClass('menu-ready');
                    return false;
                } else {
                    jQueryt.removeClass('menu-ready');
                }
            }
        });
    }
    jQuery().UItoTop();
});
"function" !== typeof Object.create && (Object.create = function (f) {
    function g() {
    }

    g.prototype = f;
    return new g
});
(function (f, g, k) {
    var l = {
        init: function (a, b) {
            this.$elem = f(b);
            this.options = f.extend({}, f.fn.owlCarousel.options, this.$elem.data(), a);
            this.userOptions = a;
            this.loadContent()
        }, loadContent: function () {
            function a(a) {
                var d, e = "";
                if ("function" === typeof b.options.jsonSuccess) b.options.jsonSuccess.apply(this, [a]); else {
                    for (d in a.owl) a.owl.hasOwnProperty(d) && (e += a.owl[d].item);
                    b.$elem.html(e)
                }
                b.logIn()
            }

            var b = this, e;
            "function" === typeof b.options.beforeInit && b.options.beforeInit.apply(this, [b.$elem]);
            "string" === typeof b.options.jsonPath ? (e = b.options.jsonPath, f.getJSON(e, a)) : b.logIn()
        }, logIn: function () {
            this.$elem.data("owl-originalStyles", this.$elem.attr("style"));
            this.$elem.data("owl-originalClasses", this.$elem.attr("class"));
            this.$elem.css({opacity: 0});
            this.orignalItems = this.options.items;
            this.checkBrowser();
            this.wrapperWidth = 0;
            this.checkVisible = null;
            this.setVars()
        }, setVars: function () {
            if (0 === this.$elem.children().length) return !1;
            this.baseClass();
            this.eventTypes();
            this.$userItems = this.$elem.children();
            this.itemsAmount = this.$userItems.length;
            this.wrapItems();
            this.$owlItems = this.$elem.find(".owl-item");
            this.$owlWrapper = this.$elem.find(".owl-wrapper");
            this.playDirection = "next";
            this.prevItem = 0;
            this.prevArr = [0];
            this.currentItem = 0;
            this.customEvents();
            this.onStartup()
        }, onStartup: function () {
            this.updateItems();
            this.calculateAll();
            this.buildControls();
            this.updateControls();
            this.response();
            this.moveEvents();
            this.stopOnHover();
            this.owlStatus();
            !1 !== this.options.transitionStyle && this.transitionTypes(this.options.transitionStyle);
            !0 === this.options.autoPlay && (this.options.autoPlay = 5E3);
            this.play();
            this.$elem.find(".owl-wrapper").css("display", "block");
            this.$elem.is(":visible") ? this.$elem.css("opacity", 1) : this.watchVisibility();
            this.onstartup = !1;
            this.eachMoveUpdate();
            "function" === typeof this.options.afterInit && this.options.afterInit.apply(this, [this.$elem])
        }, eachMoveUpdate: function () {
            !0 === this.options.lazyLoad && this.lazyLoad();
            !0 === this.options.autoHeight && this.autoHeight();
            this.onVisibleItems();
            "function" === typeof this.options.afterAction && this.options.afterAction.apply(this, [this.$elem])
        }, updateVars: function () {
            "function" === typeof this.options.beforeUpdate && this.options.beforeUpdate.apply(this, [this.$elem]);
            this.watchVisibility();
            this.updateItems();
            this.calculateAll();
            this.updatePosition();
            this.updateControls();
            this.eachMoveUpdate();
            "function" === typeof this.options.afterUpdate && this.options.afterUpdate.apply(this, [this.$elem])
        }, reload: function () {
            var a = this;
            g.setTimeout(function () {
                a.updateVars()
            }, 0)
        }, watchVisibility: function () {
            var a = this;
            if (!1 === a.$elem.is(":visible")) a.$elem.css({opacity: 0}), g.clearInterval(a.autoPlayInterval), g.clearInterval(a.checkVisible); else return !1;
            a.checkVisible = g.setInterval(function () {
                a.$elem.is(":visible") && (a.reload(), a.$elem.animate({opacity: 1}, 200), g.clearInterval(a.checkVisible))
            }, 500)
        }, wrapItems: function () {
            this.$userItems.wrapAll('<div class="owl-wrapper">').wrap('<div class="owl-item"></div>');
            this.$elem.find(".owl-wrapper").wrap('<div class="owl-wrapper-outer">');
            this.wrapperOuter = this.$elem.find(".owl-wrapper-outer");
            this.$elem.css("display", "block")
        }, baseClass: function () {
            var a = this.$elem.hasClass(this.options.baseClass), b = this.$elem.hasClass(this.options.theme);
            a || this.$elem.addClass(this.options.baseClass);
            b || this.$elem.addClass(this.options.theme)
        }, updateItems: function () {
            var a, b;
            if (!1 === this.options.responsive) return !1;
            if (!0 === this.options.singleItem) return this.options.items = this.orignalItems = 1, this.options.itemsCustom = !1, this.options.itemsDesktop = !1, this.options.itemsDesktopSmall = !1, this.options.itemsTablet = !1, this.options.itemsTabletSmall = !1, this.options.itemsMobile = !1;
            a = f(this.options.responsiveBaseWidth).width();
            a > (this.options.itemsDesktop[0] || this.orignalItems) && (this.options.items = this.orignalItems);
            if (!1 !== this.options.itemsCustom) for (this.options.itemsCustom.sort(function (a, b) {
                return a[0] - b[0]
            }), b = 0; b < this.options.itemsCustom.length; b += 1) this.options.itemsCustom[b][0] <= a && (this.options.items = this.options.itemsCustom[b][1]); else a <= this.options.itemsDesktop[0] && !1 !== this.options.itemsDesktop && (this.options.items = this.options.itemsDesktop[1]), a <= this.options.itemsDesktopSmall[0] && !1 !== this.options.itemsDesktopSmall && (this.options.items = this.options.itemsDesktopSmall[1]), a <= this.options.itemsTablet[0] && !1 !== this.options.itemsTablet && (this.options.items = this.options.itemsTablet[1]), a <= this.options.itemsTabletSmall[0] && !1 !== this.options.itemsTabletSmall && (this.options.items = this.options.itemsTabletSmall[1]), a <= this.options.itemsMobile[0] && !1 !== this.options.itemsMobile && (this.options.items = this.options.itemsMobile[1]);
            this.options.items > this.itemsAmount && !0 === this.options.itemsScaleUp && (this.options.items = this.itemsAmount)
        }, response: function () {
            var a = this, b, e;
            if (!0 !== a.options.responsive) return !1;
            e = f(g).width();
            a.resizer = function () {
                f(g).width() !== e && (!1 !== a.options.autoPlay && g.clearInterval(a.autoPlayInterval), g.clearTimeout(b), b = g.setTimeout(function () {
                    e = f(g).width();
                    a.updateVars()
                }, a.options.responsiveRefreshRate))
            };
            f(g).resize(a.resizer)
        }, updatePosition: function () {
            this.jumpTo(this.currentItem);
            !1 !== this.options.autoPlay && this.checkAp()
        }, appendItemsSizes: function () {
            var a = this, b = 0, e = a.itemsAmount - a.options.items;
            a.$owlItems.each(function (c) {
                var d = f(this);
                d.css({width: a.itemWidth}).data("owl-item", Number(c));
                if (0 === c % a.options.items || c === e) c > e || (b += 1);
                d.data("owl-roundPages", b)
            })
        }, appendWrapperSizes: function () {
            this.$owlWrapper.css({width: this.$owlItems.length * this.itemWidth * 2, left: 0});
            this.appendItemsSizes()
        }, calculateAll: function () {
            this.calculateWidth();
            this.appendWrapperSizes();
            this.loops();
            this.max()
        }, calculateWidth: function () {
            this.itemWidth = Math.round(this.$elem.width() / this.options.items)
        }, max: function () {
            var a = -1 * (this.itemsAmount * this.itemWidth - this.options.items * this.itemWidth);
            this.options.items > this.itemsAmount ? this.maximumPixels = a = this.maximumItem = 0 : (this.maximumItem = this.itemsAmount - this.options.items, this.maximumPixels = a);
            return a
        }, min: function () {
            return 0
        }, loops: function () {
            var a = 0, b = 0, e, c;
            this.positionsInArray = [0];
            this.pagesInArray = [];
            for (e = 0; e < this.itemsAmount; e += 1) b += this.itemWidth, this.positionsInArray.push(-b), !0 === this.options.scrollPerPage && (c = f(this.$owlItems[e]), c = c.data("owl-roundPages"), c !== a && (this.pagesInArray[a] = this.positionsInArray[e], a = c))
        }, buildControls: function () {
            if (!0 === this.options.navigation || !0 === this.options.pagination) this.owlControls = f('<div class="owl-controls"/>').toggleClass("clickable", !this.browser.isTouch).appendTo(this.$elem);
            !0 === this.options.pagination && this.buildPagination();
            !0 === this.options.navigation && this.buildButtons()
        }, buildButtons: function () {
            var a = this, b = f('<div class="owl-buttons"/>');
            a.owlControls.append(b);
            a.buttonPrev = f("<div/>", {"class": "owl-prev", html: a.options.navigationText[0] || ""});
            a.buttonNext = f("<div/>", {"class": "owl-next", html: a.options.navigationText[1] || ""});
            b.append(a.buttonPrev).append(a.buttonNext);
            b.on("touchstart.owlControls mousedown.owlControls", 'div[class^="owl"]', function (a) {
                a.preventDefault()
            });
            b.on("touchend.owlControls mouseup.owlControls", 'div[class^="owl"]', function (b) {
                b.preventDefault();
                f(this).hasClass("owl-next") ? a.next() : a.prev()
            })
        }, buildPagination: function () {
            var a = this;
            a.paginationWrapper = f('<div class="owl-pagination"/>');
            a.owlControls.append(a.paginationWrapper);
            a.paginationWrapper.on("touchend.owlControls mouseup.owlControls", ".owl-page", function (b) {
                b.preventDefault();
                Number(f(this).data("owl-page")) !== a.currentItem && a.goTo(Number(f(this).data("owl-page")), !0)
            })
        }, updatePagination: function () {
            var a, b, e, c, d, g;
            if (!1 === this.options.pagination) return !1;
            this.paginationWrapper.html("");
            a = 0;
            b = this.itemsAmount - this.itemsAmount % this.options.items;
            for (c = 0; c < this.itemsAmount; c += 1) 0 === c % this.options.items && (a += 1, b === c && (e = this.itemsAmount - this.options.items), d = f("<div/>", {"class": "owl-page"}), g = f("<span></span>", {
                text: !0 === this.options.paginationNumbers ? a : "",
                "class": !0 === this.options.paginationNumbers ? "owl-numbers" : ""
            }), d.append(g), d.data("owl-page", b === c ? e : c), d.data("owl-roundPages", a), this.paginationWrapper.append(d));
            this.checkPagination()
        }, checkPagination: function () {
            var a = this;
            if (!1 === a.options.pagination) return !1;
            a.paginationWrapper.find(".owl-page").each(function () {
                f(this).data("owl-roundPages") === f(a.$owlItems[a.currentItem]).data("owl-roundPages") && (a.paginationWrapper.find(".owl-page").removeClass("active"), f(this).addClass("active"))
            })
        }, checkNavigation: function () {
            if (!1 === this.options.navigation) return !1;
            !1 === this.options.rewindNav && (0 === this.currentItem && 0 === this.maximumItem ? (this.buttonPrev.addClass("disabled"), this.buttonNext.addClass("disabled")) : 0 === this.currentItem && 0 !== this.maximumItem ? (this.buttonPrev.addClass("disabled"), this.buttonNext.removeClass("disabled")) : this.currentItem === this.maximumItem ? (this.buttonPrev.removeClass("disabled"), this.buttonNext.addClass("disabled")) : 0 !== this.currentItem && this.currentItem !== this.maximumItem && (this.buttonPrev.removeClass("disabled"), this.buttonNext.removeClass("disabled")))
        }, updateControls: function () {
            this.updatePagination();
            this.checkNavigation();
            this.owlControls && (this.options.items >= this.itemsAmount ? this.owlControls.hide() : this.owlControls.show())
        }, destroyControls: function () {
            this.owlControls && this.owlControls.remove()
        }, next: function (a) {
            if (this.isTransition) return !1;
            this.currentItem += !0 === this.options.scrollPerPage ? this.options.items : 1;
            if (this.currentItem > this.maximumItem + (!0 === this.options.scrollPerPage ? this.options.items - 1 : 0)) if (!0 === this.options.rewindNav) this.currentItem = 0, a = "rewind"; else return this.currentItem = this.maximumItem, !1;
            this.goTo(this.currentItem, a)
        }, prev: function (a) {
            if (this.isTransition) return !1;
            this.currentItem = !0 === this.options.scrollPerPage && 0 < this.currentItem && this.currentItem < this.options.items ? 0 : this.currentItem - (!0 === this.options.scrollPerPage ? this.options.items : 1);
            if (0 > this.currentItem) if (!0 === this.options.rewindNav) this.currentItem = this.maximumItem, a = "rewind"; else return this.currentItem = 0, !1;
            this.goTo(this.currentItem, a)
        }, goTo: function (a, b, e) {
            var c = this;
            if (c.isTransition) return !1;
            "function" === typeof c.options.beforeMove && c.options.beforeMove.apply(this, [c.$elem]);
            a >= c.maximumItem ? a = c.maximumItem : 0 >= a && (a = 0);
            c.currentItem = c.owl.currentItem = a;
            if (!1 !== c.options.transitionStyle && "drag" !== e && 1 === c.options.items && !0 === c.browser.support3d) return c.swapSpeed(0), !0 === c.browser.support3d ? c.transition3d(c.positionsInArray[a]) : c.css2slide(c.positionsInArray[a], 1), c.afterGo(), c.singleItemTransition(), !1;
            a = c.positionsInArray[a];
            !0 === c.browser.support3d ? (c.isCss3Finish = !1, !0 === b ? (c.swapSpeed("paginationSpeed"), g.setTimeout(function () {
                c.isCss3Finish = !0
            }, c.options.paginationSpeed)) : "rewind" === b ? (c.swapSpeed(c.options.rewindSpeed), g.setTimeout(function () {
                c.isCss3Finish = !0
            }, c.options.rewindSpeed)) : (c.swapSpeed("slideSpeed"), g.setTimeout(function () {
                c.isCss3Finish = !0
            }, c.options.slideSpeed)), c.transition3d(a)) : !0 === b ? c.css2slide(a, c.options.paginationSpeed) : "rewind" === b ? c.css2slide(a, c.options.rewindSpeed) : c.css2slide(a, c.options.slideSpeed);
            c.afterGo()
        }, jumpTo: function (a) {
            "function" === typeof this.options.beforeMove && this.options.beforeMove.apply(this, [this.$elem]);
            a >= this.maximumItem || -1 === a ? a = this.maximumItem : 0 >= a && (a = 0);
            this.swapSpeed(0);
            !0 === this.browser.support3d ? this.transition3d(this.positionsInArray[a]) : this.css2slide(this.positionsInArray[a], 1);
            this.currentItem = this.owl.currentItem = a;
            this.afterGo()
        }, afterGo: function () {
            this.prevArr.push(this.currentItem);
            this.prevItem = this.owl.prevItem = this.prevArr[this.prevArr.length - 2];
            this.prevArr.shift(0);
            this.prevItem !== this.currentItem && (this.checkPagination(), this.checkNavigation(), this.eachMoveUpdate(), !1 !== this.options.autoPlay && this.checkAp());
            "function" === typeof this.options.afterMove && this.prevItem !== this.currentItem && this.options.afterMove.apply(this, [this.$elem])
        }, stop: function () {
            this.apStatus = "stop";
            g.clearInterval(this.autoPlayInterval)
        }, checkAp: function () {
            "stop" !== this.apStatus && this.play()
        }, play: function () {
            var a = this;
            a.apStatus = "play";
            if (!1 === a.options.autoPlay) return !1;
            g.clearInterval(a.autoPlayInterval);
            a.autoPlayInterval = g.setInterval(function () {
                a.next(!0)
            }, a.options.autoPlay)
        }, swapSpeed: function (a) {
            "slideSpeed" === a ? this.$owlWrapper.css(this.addCssSpeed(this.options.slideSpeed)) : "paginationSpeed" === a ? this.$owlWrapper.css(this.addCssSpeed(this.options.paginationSpeed)) : "string" !== typeof a && this.$owlWrapper.css(this.addCssSpeed(a))
        }, addCssSpeed: function (a) {
            return {
                "-webkit-transition": "all " + a + "ms ease",
                "-moz-transition": "all " + a + "ms ease",
                "-o-transition": "all " + a + "ms ease",
                transition: "all " + a + "ms ease"
            }
        }, removeTransition: function () {
            return {"-webkit-transition": "", "-moz-transition": "", "-o-transition": "", transition: ""}
        }, doTranslate: function (a) {
            return {
                "-webkit-transform": "translate3d(" + a + "px, 0px, 0px)",
                "-moz-transform": "translate3d(" + a + "px, 0px, 0px)",
                "-o-transform": "translate3d(" + a + "px, 0px, 0px)",
                "-ms-transform": "translate3d(" +
                    a + "px, 0px, 0px)",
                transform: "translate3d(" + a + "px, 0px,0px)"
            }
        }, transition3d: function (a) {
            this.$owlWrapper.css(this.doTranslate(a))
        }, css2move: function (a) {
            this.$owlWrapper.css({left: a})
        }, css2slide: function (a, b) {
            var e = this;
            e.isCssFinish = !1;
            e.$owlWrapper.stop(!0, !0).animate({left: a}, {
                duration: b || e.options.slideSpeed, complete: function () {
                    e.isCssFinish = !0
                }
            })
        }, checkBrowser: function () {
            var a = k.createElement("div");
            a.style.cssText = "  -moz-transform:translate3d(0px, 0px, 0px); -ms-transform:translate3d(0px, 0px, 0px); -o-transform:translate3d(0px, 0px, 0px); -webkit-transform:translate3d(0px, 0px, 0px); transform:translate3d(0px, 0px, 0px)";
            a = a.style.cssText.match(/translate3d\(0px, 0px, 0px\)/g);
            this.browser = {
                support3d: null !== a && 1 === a.length,
                isTouch: "ontouchstart" in g || g.navigator.msMaxTouchPoints
            }
        }, moveEvents: function () {
            if (!1 !== this.options.mouseDrag || !1 !== this.options.touchDrag) this.gestures(), this.disabledEvents()
        }, eventTypes: function () {
            var a = ["s", "e", "x"];
            this.ev_types = {};
            !0 === this.options.mouseDrag && !0 === this.options.touchDrag ? a = ["touchstart.owl mousedown.owl", "touchmove.owl mousemove.owl", "touchend.owl touchcancel.owl mouseup.owl"] : !1 === this.options.mouseDrag && !0 === this.options.touchDrag ? a = ["touchstart.owl", "touchmove.owl", "touchend.owl touchcancel.owl"] : !0 === this.options.mouseDrag && !1 === this.options.touchDrag && (a = ["mousedown.owl", "mousemove.owl", "mouseup.owl"]);
            this.ev_types.start = a[0];
            this.ev_types.move = a[1];
            this.ev_types.end = a[2]
        }, disabledEvents: function () {
            this.$elem.on("dragstart.owl", function (a) {
                a.preventDefault()
            });
            this.$elem.on("mousedown.disableTextSelect", function (a) {
                return f(a.target).is("input, textarea, select, option")
            })
        }, gestures: function () {
            function a(a) {
                if (void 0 !== a.touches) return {x: a.touches[0].pageX, y: a.touches[0].pageY};
                if (void 0 === a.touches) {
                    if (void 0 !== a.pageX) return {x: a.pageX, y: a.pageY};
                    if (void 0 === a.pageX) return {x: a.clientX, y: a.clientY}
                }
            }

            function b(a) {
                "on" === a ? (f(k).on(d.ev_types.move, e), f(k).on(d.ev_types.end, c)) : "off" === a && (f(k).off(d.ev_types.move), f(k).off(d.ev_types.end))
            }

            function e(b) {
                b = b.originalEvent || b || g.event;
                d.newPosX = a(b).x - h.offsetX;
                d.newPosY = a(b).y - h.offsetY;
                d.newRelativeX = d.newPosX - h.relativePos;
                "function" === typeof d.options.startDragging && !0 !== h.dragging && 0 !== d.newRelativeX && (h.dragging = !0, d.options.startDragging.apply(d, [d.$elem]));
                (8 < d.newRelativeX || -8 > d.newRelativeX) && !0 === d.browser.isTouch && (void 0 !== b.preventDefault ? b.preventDefault() : b.returnValue = !1, h.sliding = !0);
                (10 < d.newPosY || -10 > d.newPosY) && !1 === h.sliding && f(k).off("touchmove.owl");
                d.newPosX = Math.max(Math.min(d.newPosX, d.newRelativeX / 5), d.maximumPixels + d.newRelativeX / 5);
                !0 === d.browser.support3d ? d.transition3d(d.newPosX) : d.css2move(d.newPosX)
            }

            function c(a) {
                a = a.originalEvent || a || g.event;
                var c;
                a.target = a.target || a.srcElement;
                h.dragging = !1;
                !0 !== d.browser.isTouch && d.$owlWrapper.removeClass("grabbing");
                d.dragDirection = 0 > d.newRelativeX ? d.owl.dragDirection = "left" : d.owl.dragDirection = "right";
                0 !== d.newRelativeX && (c = d.getNewPosition(), d.goTo(c, !1, "drag"), h.targetElement === a.target && !0 !== d.browser.isTouch && (f(a.target).on("click.disable", function (a) {
                    a.stopImmediatePropagation();
                    a.stopPropagation();
                    a.preventDefault();
                    f(a.target).off("click.disable")
                }), a = f._data(a.target, "events").click, c = a.pop(), a.splice(0, 0, c)));
                b("off")
            }

            var d = this, h = {
                offsetX: 0,
                offsetY: 0,
                baseElWidth: 0,
                relativePos: 0,
                position: null,
                minSwipe: null,
                maxSwipe: null,
                sliding: null,
                dargging: null,
                targetElement: null
            };
            d.isCssFinish = !0;
            d.$elem.on(d.ev_types.start, ".owl-wrapper", function (c) {
                c = c.originalEvent || c || g.event;
                var e;
                if (3 === c.which) return !1;
                if (!(d.itemsAmount <= d.options.items)) {
                    if (!1 === d.isCssFinish && !d.options.dragBeforeAnimFinish || !1 === d.isCss3Finish && !d.options.dragBeforeAnimFinish) return !1;
                    !1 !== d.options.autoPlay && g.clearInterval(d.autoPlayInterval);
                    !0 === d.browser.isTouch || d.$owlWrapper.hasClass("grabbing") || d.$owlWrapper.addClass("grabbing");
                    d.newPosX = 0;
                    d.newRelativeX = 0;
                    f(this).css(d.removeTransition());
                    e = f(this).position();
                    h.relativePos = e.left;
                    h.offsetX = a(c).x - e.left;
                    h.offsetY = a(c).y - e.top;
                    b("on");
                    h.sliding = !1;
                    h.targetElement = c.target || c.srcElement
                }
            })
        }, getNewPosition: function () {
            var a = this.closestItem();
            a > this.maximumItem ? a = this.currentItem = this.maximumItem : 0 <= this.newPosX && (this.currentItem = a = 0);
            return a
        }, closestItem: function () {
            var a = this, b = !0 === a.options.scrollPerPage ? a.pagesInArray : a.positionsInArray, e = a.newPosX,
                c = null;
            f.each(b, function (d, g) {
                e - a.itemWidth / 20 > b[d + 1] && e - a.itemWidth / 20 < g && "left" === a.moveDirection() ? (c = g, a.currentItem = !0 === a.options.scrollPerPage ? f.inArray(c, a.positionsInArray) : d) : e + a.itemWidth / 20 < g && e + a.itemWidth / 20 > (b[d + 1] || b[d] - a.itemWidth) && "right" === a.moveDirection() && (!0 === a.options.scrollPerPage ? (c = b[d + 1] || b[b.length - 1], a.currentItem = f.inArray(c, a.positionsInArray)) : (c = b[d + 1], a.currentItem = d + 1))
            });
            return a.currentItem
        }, moveDirection: function () {
            var a;
            0 > this.newRelativeX ? (a = "right", this.playDirection = "next") : (a = "left", this.playDirection = "prev");
            return a
        }, customEvents: function () {
            var a = this;
            a.$elem.on("owl.next", function () {
                a.next()
            });
            a.$elem.on("owl.prev", function () {
                a.prev()
            });
            a.$elem.on("owl.play", function (b, e) {
                a.options.autoPlay = e;
                a.play();
                a.hoverStatus = "play"
            });
            a.$elem.on("owl.stop", function () {
                a.stop();
                a.hoverStatus = "stop"
            });
            a.$elem.on("owl.goTo", function (b, e) {
                a.goTo(e)
            });
            a.$elem.on("owl.jumpTo", function (b, e) {
                a.jumpTo(e)
            })
        }, stopOnHover: function () {
            var a = this;
            !0 === a.options.stopOnHover && !0 !== a.browser.isTouch && !1 !== a.options.autoPlay && (a.$elem.on("mouseover", function () {
                a.stop()
            }), a.$elem.on("mouseout", function () {
                "stop" !== a.hoverStatus && a.play()
            }))
        }, lazyLoad: function () {
            var a, b, e, c, d;
            if (!1 === this.options.lazyLoad) return !1;
            for (a = 0; a < this.itemsAmount; a += 1) b = f(this.$owlItems[a]), "loaded" !== b.data("owl-loaded") && (e = b.data("owl-item"), c = b.find(".lazyOwl"), "string" !== typeof c.data("src") ? b.data("owl-loaded", "loaded") : (void 0 === b.data("owl-loaded") && (c.hide(), b.addClass("loading").data("owl-loaded", "checked")), (d = !0 === this.options.lazyFollow ? e >= this.currentItem : !0) && e < this.currentItem + this.options.items && c.length && this.lazyPreload(b, c)))
        }, lazyPreload: function (a, b) {
            function e() {
                a.data("owl-loaded", "loaded").removeClass("loading");
                b.removeAttr("data-src");
                "fade" === d.options.lazyEffect ? b.fadeIn(400) : b.show();
                "function" === typeof d.options.afterLazyLoad && d.options.afterLazyLoad.apply(this, [d.$elem])
            }

            function c() {
                f += 1;
                d.completeImg(b.get(0)) || !0 === k ? e() : 100 >= f ? g.setTimeout(c, 100) : e()
            }

            var d = this, f = 0, k;
            "DIV" === b.prop("tagName") ? (b.css("background-image", "url(" + b.data("src") + ")"), k = !0) : b[0].src = b.data("src");
            c()
        }, autoHeight: function () {
            function a() {
                var a = f(e.$owlItems[e.currentItem]).height();
                e.wrapperOuter.css("height", a + "px");
                e.wrapperOuter.hasClass("autoHeight") || g.setTimeout(function () {
                    e.wrapperOuter.addClass("autoHeight")
                }, 0)
            }

            function b() {
                d += 1;
                e.completeImg(c.get(0)) ? a() : 100 >= d ? g.setTimeout(b, 100) : e.wrapperOuter.css("height", "")
            }

            var e = this, c = f(e.$owlItems[e.currentItem]).find("img"), d;
            void 0 !== c.get(0) ? (d = 0, b()) : a()
        }, completeImg: function (a) {
            return !a.complete || "undefined" !== typeof a.naturalWidth && 0 === a.naturalWidth ? !1 : !0
        }, onVisibleItems: function () {
            var a;
            !0 === this.options.addClassActive && this.$owlItems.removeClass("active");
            this.visibleItems = [];
            for (a = this.currentItem; a < this.currentItem + this.options.items; a += 1) this.visibleItems.push(a), !0 === this.options.addClassActive && f(this.$owlItems[a]).addClass("active");
            this.owl.visibleItems = this.visibleItems
        }, transitionTypes: function (a) {
            this.outClass = "owl-" + a + "-out";
            this.inClass = "owl-" + a + "-in"
        }, singleItemTransition: function () {
            var a = this, b = a.outClass, e = a.inClass, c = a.$owlItems.eq(a.currentItem),
                d = a.$owlItems.eq(a.prevItem),
                f = Math.abs(a.positionsInArray[a.currentItem]) + a.positionsInArray[a.prevItem],
                g = Math.abs(a.positionsInArray[a.currentItem]) + a.itemWidth / 2;
            a.isTransition = !0;
            a.$owlWrapper.addClass("owl-origin").css({
                "-webkit-transform-origin": g + "px",
                "-moz-perspective-origin": g + "px",
                "perspective-origin": g + "px"
            });
            d.css({
                position: "relative",
                left: f + "px"
            }).addClass(b).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend", function () {
                a.endPrev = !0;
                d.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend");
                a.clearTransStyle(d, b)
            });
            c.addClass(e).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend", function () {
                a.endCurrent = !0;
                c.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend");
                a.clearTransStyle(c, e)
            })
        }, clearTransStyle: function (a, b) {
            a.css({position: "", left: ""}).removeClass(b);
            this.endPrev && this.endCurrent && (this.$owlWrapper.removeClass("owl-origin"), this.isTransition = this.endCurrent = this.endPrev = !1)
        }, owlStatus: function () {
            this.owl = {
                userOptions: this.userOptions,
                baseElement: this.$elem,
                userItems: this.$userItems,
                owlItems: this.$owlItems,
                currentItem: this.currentItem,
                prevItem: this.prevItem,
                visibleItems: this.visibleItems,
                isTouch: this.browser.isTouch,
                browser: this.browser,
                dragDirection: this.dragDirection
            }
        }, clearEvents: function () {
            this.$elem.off(".owl owl mousedown.disableTextSelect");
            f(k).off(".owl owl");
            f(g).off("resize", this.resizer)
        }, unWrap: function () {
            0 !== this.$elem.children().length && (this.$owlWrapper.unwrap(), this.$userItems.unwrap().unwrap(), this.owlControls && this.owlControls.remove());
            this.clearEvents();
            this.$elem.attr("style", this.$elem.data("owl-originalStyles") || "").attr("class", this.$elem.data("owl-originalClasses"))
        }, destroy: function () {
            this.stop();
            g.clearInterval(this.checkVisible);
            this.unWrap();
            this.$elem.removeData()
        }, reinit: function (a) {
            a = f.extend({}, this.userOptions, a);
            this.unWrap();
            this.init(a, this.$elem)
        }, addItem: function (a, b) {
            var e;
            if (!a) return !1;
            if (0 === this.$elem.children().length) return this.$elem.append(a), this.setVars(), !1;
            this.unWrap();
            e = void 0 === b || -1 === b ? -1 : b;
            e >= this.$userItems.length || -1 === e ? this.$userItems.eq(-1).after(a) : this.$userItems.eq(e).before(a);
            this.setVars()
        }, removeItem: function (a) {
            if (0 === this.$elem.children().length) return !1;
            a = void 0 === a || -1 === a ? -1 : a;
            this.unWrap();
            this.$userItems.eq(a).remove();
            this.setVars()
        }
    };
    f.fn.owlCarousel = function (a) {
        return this.each(function () {
            if (!0 === f(this).data("owl-init")) return !1;
            f(this).data("owl-init", !0);
            var b = Object.create(l);
            b.init(a, this);
            f.data(this, "owlCarousel", b)
        })
    };
    f.fn.owlCarousel.options = {
        items: 5,
        itemsCustom: !1,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 2],
        itemsTabletSmall: !1,
        itemsMobile: [479, 1],
        singleItem: !1,
        itemsScaleUp: !1,
        slideSpeed: 200,
        paginationSpeed: 800,
        rewindSpeed: 1E3,
        autoPlay: !1,
        stopOnHover: !1,
        navigation: !1,
        navigationText: ["prev", "next"],
        rewindNav: !0,
        scrollPerPage: !1,
        pagination: !0,
        paginationNumbers: !1,
        responsive: !0,
        responsiveRefreshRate: 200,
        responsiveBaseWidth: g,
        baseClass: "owl-carousel",
        theme: "owl-theme",
        lazyLoad: !1,
        lazyFollow: !0,
        lazyEffect: "fade",
        autoHeight: !1,
        jsonPath: !1,
        jsonSuccess: !1,
        dragBeforeAnimFinish: !0,
        mouseDrag: !0,
        touchDrag: !0,
        addClassActive: !1,
        transitionStyle: !1,
        beforeUpdate: !1,
        afterUpdate: !1,
        beforeInit: !1,
        afterInit: !1,
        beforeMove: !1,
        afterMove: !1,
        afterAction: !1,
        startDragging: !1,
        afterLazyLoad: !1
    }
})(jQuery, window, document);
!function (s) {
    "use strict";
    s.fn.mobileMenu = function (e) {
        var i = {
            MenuWidth: 250,
            SlideSpeed: 300,
            WindowsMaxWidth: 767,
            PagePush: !0,
            FromLeft: !0,
            Overlay: !0,
            CollapseMenu: !0,
            ClassName: "mobile-menu"
        };
        return this.each(function () {
            function n() {
                1 == d.FromLeft ? c.css("left", -d.MenuWidth) : c.css("right", -d.MenuWidth), c.find("ul:first").addClass(d.ClassName), g = d.ClassName, c.css("width", d.MenuWidth), c.find("." + g + " ul").css("display", "none");
                var e = '<span class="expand fa fa-plus"></span>';
                c.find("li ul").parent().prepend(e), s("." + g).append('<li style="height: 2px;"></li>'), s("." + g + " li:has(span)").each(function () {
                    s(this).find("a:first").css("padding-right", 55)
                })
            }

            function a() {
                var e = 0, i = s(document).height();
                return c.find("." + g + " > li").each(function () {
                    var i = s(this).height();
                    e += i
                }), i >= e && (e = i), e
            }

            function l(e) {
                C = s("." + g + " span.expand").height(), 1 === e && c.find("." + g + " > li:has(span)").each(function () {
                    var e = s(this).height(), i = (e - C) / 2;
                    s(this).find("span").css({"padding-bottom": i, "padding-top": i})
                }), 2 === e && c.find("." + g + " > li > ul > li:has(span)").each(function () {
                    var e = s(this).height(), i = (e - C) / 2;
                    s(this).find("span").css({"padding-bottom": i, "padding-top": i})
                })
            }

            function t() {
                u.addClass("mmPushBody"), 1 == d.Overlay ? h.addClass("overlay") : h.addClass("overlay").css("opacity", 0), c.css({
                    display: "block",
                    overflow: "hidden"
                }), 1 == d.FromLeft ? (1 == d.PagePush && p.animate({left: d.MenuWidth}, d.SlideSpeed, "linear"), c.animate({left: "0"}, d.SlideSpeed, "linear", function () {
                    c.css("height", a()), r = !0
                })) : (1 == d.PagePush && p.animate({left: -d.MenuWidth}, d.SlideSpeed, "linear"), c.animate({right: "0"}, d.SlideSpeed, "linear", function () {
                    c.css("height", a()), r = !0
                })), m || (l(1), m = !0)
            }

            function o() {
                1 == d.FromLeft ? (1 == d.PagePush && p.animate({left: "0"}, d.SlideSpeed, "linear"), c.animate({left: -d.MenuWidth}, d.SlideSpeed, "linear", function () {
                    u.removeClass("mmPushBody"), h.css("height", 0).removeClass("overlay"), c.css("display", "none"), r = !1
                })) : (1 == d.PagePush && p.animate({left: "0"}, d.SlideSpeed, "linear"), c.animate({right: -d.MenuWidth}, d.SlideSpeed, "linear", function () {
                    u.removeClass("mmPushBody"), h.css("height", 0).removeClass("overlay"), c.css("display", "none"), r = !1
                }))
            }

            var d = s.extend({}, i, e), c = s(this), h = s("#overlay"), u = s("body"), p = s("#page"), r = !1, m = !1,
                f = !1, C = 0, g = "";
            n(), s(".mm-toggle").click(function () {
                c.css("height", s(document).height()), 1 == d.Overlay && h.css("height", s(document).height()), r ? o() : t()
            }), s(window).resize(function () {
                s(window).width() >= d.WindowsMaxWidth && r && c.css("left") != -d.MenuWidth && o()
            }), s("." + g + " > li > span.expand").click(function () {
                if (1 == d.CollapseMenu) {
                    var e = s("." + g + " li span");
                    e.hasClass("open") && "none" === s(this).next().next().css("display") && (s("." + g + " li ul").slideUp(), e.hasClass("open") ? e.removeClass("fa fa-minus").addClass("fa fa-plus") : e.removeClass("fa fa-plus").addClass("fa fa-minus"), e.removeClass("open"))
                }
                s(this).nextAll("." + g + " ul").slideToggle(function () {
                    1 == d.CollapseMenu ? s(this).promise().done(function () {
                        c.css("height", a())
                    }) : c.css("height", a())
                }), s(this).hasClass("fa fa-plus") ? s(this).removeClass("fa fa-plus").addClass("fa fa-minus") : s(this).removeClass("fa fa-minus").addClass("fa fa-plus"), s(this).toggleClass("open"), f || (l(2), f = !0)
            }), s("." + g + " > li > ul > li > span.expand").click(function () {
                if (1 == d.CollapseMenu) {
                    var e = s("." + g + " li ul li span");
                    e.hasClass("open") && "none" === s(this).next().next().css("display") && (s("." + g + " li ul ul").slideUp(), e.hasClass("open") ? e.removeClass("fa fa-minus").addClass("fa fa-plus") : e.removeClass("fa fa-plus").addClass("fa fa-minus"), e.removeClass("open"))
                }
                s(this).nextAll("." + g + " ul ul").slideToggle(function () {
                    1 == d.CollapseMenu ? s(this).promise().done(function () {
                        c.css("height", a())
                    }) : c.css("height", a())
                }), s(this).hasClass("fa fa-plus") ? s(this).removeClass("fa fa-plus").addClass("fa fa-minus") : s(this).removeClass("fa fa-minus").addClass("fa fa-plus"), s(this).toggleClass("open")
            }), s("." + g + " li a").click(function () {
                s("." + g + " li a").removeClass("active"), s(this).addClass("active"), o()
            }), h.click(function () {
                o()
            }), s("." + g + " li a.active").parent().children(".expand").removeClass("fa fa-plus").addClass("fa fa-minus open"), s("." + g + " li a.active").parent().children("ul").css("display", "block")
        })
    }
}(jQuery);
if (typeof (BackColor) == "undefined")
    BackColor = "white";
if (typeof (ForeColor) == "undefined")
    ForeColor = "black";
if (typeof (DisplayFormat) == "undefined")
    DisplayFormat = "<div class='day box-time-date'><span class='time-num time-day'>%%D%%</span>Days</div><div class='hour box-time-date'><span class='time-num'>%%H%%</span>Hrs</div><div class='min box-time-date'><span class='time-num'>%%M%%</span>Mins</div><div class='sec box-time-date'><span class='time-num'>%%S%%</span>Secs</div>";
if (typeof (CountActive) == "undefined")
    CountActive = true;
if (typeof (FinishMessage) == "undefined")
    FinishMessage = "";
if (typeof (CountStepper) != "number")
    CountStepper = -1;
if (typeof (LeadingZero) == "undefined")
    LeadingZero = true;
CountStepper = Math.ceil(CountStepper);
if (CountStepper == 0)
    CountActive = false;
var SetTimeOutPeriod = (Math.abs(CountStepper) - 1) * 1000 + 990;

function calcage(secs, num1, num2) {
    s = ((Math.floor(secs / num1) % num2)).toString();
    if (LeadingZero && s.length < 2)
        s = "0" + s;
    return s;
}

function CountBack_slider(secs, iid, j_timer) {
    if (secs < 0) {
        document.getElementById(iid).innerHTML = FinishMessage;
        document.getElementById('caption' + j_timer).style.display = "none";
        document.getElementById('heading' + j_timer).style.display = "none";
        return;
    }
    DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs, 86400, 100000));
    DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs, 3600, 24));
    DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs, 60, 60));
    DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs, 1, 60));
    var elems = document.getElementsByTagName('*'), i;
    for (i in elems) {
        if ((' ' + elems[i].className + ' ').indexOf(' ' + iid + ' ') > -1) {
            elems[i].innerHTML = DisplayStr;
        }
    }
    jQuery('.' + iid).innerHTML = DisplayStr;
    if (CountActive)
        setTimeout(function () {
            CountBack_slider((secs + CountStepper), iid, j_timer)
        }, SetTimeOutPeriod);
}

function CountBack(secs, iid, j) {
    if (secs < 0) {
        document.getElementById(iid).innerHTML = FinishMessage;
        document.getElementById('caption' + j).style.display = "none";
        document.getElementById('heading' + j).style.display = "none";
        return;
    }
    DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs, 86400, 100000));
    DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs, 3600, 24));
    DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs, 60, 60));
    DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs, 1, 60));
    document.getElementById(iid).innerHTML = DisplayStr;
    if (CountActive)
        setTimeout(function () {
            CountBack((secs + CountStepper), iid, j)
        }, SetTimeOutPeriod);
};
if (typeof Object.create !== 'function') {
    "use strict";
    Object.create = function (obj) {
        function F() {
        };F.prototype = obj;
        return new F();
    };
}
(function (jQuery, window, document, undefined) {
    var ElevateZoom = {
        init: function (options, elem) {
            var self = this;
            self.elem = elem;
            self.jQueryelem = jQuery(elem);
            self.imageSrc = self.jQueryelem.data("zoom-image") ? self.jQueryelem.data("zoom-image") : self.jQueryelem.attr("src");
            self.options = jQuery.extend({}, jQuery.fn.elevateZoom.options, options);
            if (self.options.tint) {
                self.options.lensColour = "none", self.options.lensOpacity = "1"
            }
            if (self.options.zoomType == "inner") {
                self.options.showLens = false;
            }
            self.jQueryelem.parent().removeAttr('title').removeAttr('alt');
            self.zoomImage = self.imageSrc;
            self.refresh(1);
            jQuery('#' + self.options.gallery + ' a').click(function (e) {
                if (self.options.galleryActiveClass) {
                    jQuery('#' + self.options.gallery + ' a').removeClass(self.options.galleryActiveClass);
                    jQuery(this).addClass(self.options.galleryActiveClass);
                }
                e.preventDefault();
                if (jQuery(this).data("zoom-image")) {
                    self.zoomImagePre = jQuery(this).data("zoom-image")
                } else {
                    self.zoomImagePre = jQuery(this).data("image");
                }
                self.swaptheimage(jQuery(this).data("image"), self.zoomImagePre);
                return false;
            });
        }, refresh: function (length) {
            var self = this;
            setTimeout(function () {
                self.fetch(self.imageSrc);
            }, length || self.options.refresh);
        }, fetch: function (imgsrc) {
            var self = this;
            var newImg = new Image();
            newImg.onload = function () {
                self.largeWidth = newImg.width;
                self.largeHeight = newImg.height;
                self.startZoom();
                self.currentImage = self.imageSrc;
                self.options.onZoomedImageLoaded(self.jQueryelem);
            }
            newImg.src = imgsrc;
            return;
        }, startZoom: function () {
            var self = this;
            self.nzWidth = self.jQueryelem.width();
            self.nzHeight = self.jQueryelem.height();
            self.isWindowActive = false;
            self.isLensActive = false;
            self.isTintActive = false;
            self.overWindow = false;
            if (self.options.imageCrossfade) {
                self.zoomWrap = self.jQueryelem.wrap('<div style="height:' + self.nzHeight + 'px;width:' + self.nzWidth + 'px;" class="zoomWrapper" />');
                self.jQueryelem.css('position', 'absolute');
            }
            self.zoomLock = 1;
            self.scrollingLock = false;
            self.changeBgSize = false;
            self.currentZoomLevel = self.options.zoomLevel;
            self.nzOffset = self.jQueryelem.offset();
            self.widthRatio = (self.largeWidth / self.currentZoomLevel) / self.nzWidth;
            self.heightRatio = (self.largeHeight / self.currentZoomLevel) / self.nzHeight;
            if (self.options.zoomType == "window") {
                self.zoomWindowStyle = "overflow: hidden;" + "background-position: 0px 0px;text-align:center;" + "background-color: " + String(self.options.zoomWindowBgColour) + ";width: " + String(self.options.zoomWindowWidth) + "px;" + "height: " + String(self.options.zoomWindowHeight) + "px;float: left;" + "background-size: " + self.largeWidth / self.currentZoomLevel + "px " + self.largeHeight / self.currentZoomLevel + "px;" + "display: none;z-index:100;" + "border: " + String(self.options.borderSize) + "px solid " + self.options.borderColour + ";background-repeat: no-repeat;" + "position: absolute;";
            }
            if (self.options.zoomType == "inner") {
                var borderWidth = self.jQueryelem.css("border-left-width");
                self.zoomWindowStyle = "overflow: hidden;" + "margin-left: " + String(borderWidth) + ";" + "margin-top: " + String(borderWidth) + ";" + "background-position: 0px 0px;" + "width: " + String(self.nzWidth) + "px;" + "height: " + String(self.nzHeight) + "px;float: left;" + "display: none;" + "cursor:" + (self.options.cursor) + ";" + "px solid " + self.options.borderColour + ";background-repeat: no-repeat;" + "position: absolute;";
            }
            if (self.options.zoomType == "window") {
                if (self.nzHeight < self.options.zoomWindowWidth / self.widthRatio) {
                    lensHeight = self.nzHeight;
                } else {
                    lensHeight = String((self.options.zoomWindowHeight / self.heightRatio))
                }
                if (self.largeWidth < self.options.zoomWindowWidth) {
                    lensWidth = self.nzWidth;
                } else {
                    lensWidth = (self.options.zoomWindowWidth / self.widthRatio);
                }
                self.lensStyle = "background-position: 0px 0px;width: " + String((self.options.zoomWindowWidth) / self.widthRatio) + "px;height: " + String((self.options.zoomWindowHeight) / self.heightRatio) + "px;float: right;display: none;" + "overflow: hidden;" + "z-index: 999;" + "-webkit-transform: translateZ(0);" + "opacity:" + (self.options.lensOpacity) + ";filter: alpha(opacity = " + (self.options.lensOpacity * 100) + "); zoom:1;" + "width:" + lensWidth + "px;" + "height:" + lensHeight + "px;" + "background-color:" + (self.options.lensColour) + ";" + "cursor:" + (self.options.cursor) + ";" + "border: " + (self.options.lensBorderSize) + "px" + " solid " + (self.options.lensBorderColour) + ";background-repeat: no-repeat;position: absolute;";
            }
            self.tintStyle = "display: block;" + "position: absolute;" + "background-color: " + self.options.tintColour + ";" + "filter:alpha(opacity=0);" + "opacity: 0;" + "width: " + self.nzWidth + "px;" + "height: " + self.nzHeight + "px;";
            self.lensRound = '';
            if (self.options.zoomType == "lens") {
                self.lensStyle = "background-position: 0px 0px;" + "float: left;display: none;" + "border: " + String(self.options.borderSize) + "px solid " + self.options.borderColour + ";" + "width:" + String(self.options.lensSize) + "px;" + "height:" + String(self.options.lensSize) + "px;" + "background-repeat: no-repeat;position: absolute;";
            }
            if (self.options.lensShape == "round") {
                self.lensRound = "border-top-left-radius: " + String(self.options.lensSize / 2 + self.options.borderSize) + "px;" + "border-top-right-radius: " + String(self.options.lensSize / 2 + self.options.borderSize) + "px;" + "border-bottom-left-radius: " + String(self.options.lensSize / 2 + self.options.borderSize) + "px;" + "border-bottom-right-radius: " + String(self.options.lensSize / 2 + self.options.borderSize) + "px;";
            }
            self.zoomContainer = jQuery('<div class="zoomContainer" style="-webkit-transform: translateZ(0);position:absolute;left:' + self.nzOffset.left + 'px;top:' + self.nzOffset.top + 'px;height:' + self.nzHeight + 'px;width:' + self.nzWidth + 'px;"></div>');
            jQuery('body').append(self.zoomContainer);
            if (self.options.containLensZoom && self.options.zoomType == "lens") {
                self.zoomContainer.css("overflow", "hidden");
            }
            if (self.options.zoomType != "inner") {
                self.zoomLens = jQuery("<div class='zoomLens' style='" + self.lensStyle + self.lensRound + "'>&nbsp;</div>").appendTo(self.zoomContainer).click(function () {
                    self.jQueryelem.trigger('click');
                });
                if (self.options.tint) {
                    self.tintContainer = jQuery('<div/>').addClass('tintContainer');
                    self.zoomTint = jQuery("<div class='zoomTint' style='" + self.tintStyle + "'></div>");
                    self.zoomLens.wrap(self.tintContainer);
                    self.zoomTintcss = self.zoomLens.after(self.zoomTint);
                    self.zoomTintImage = jQuery('<img style="position: absolute; left: 0px; top: 0px; max-width: none; width: ' + self.nzWidth + 'px; height: ' + self.nzHeight + 'px;" src="' + self.imageSrc + '">').appendTo(self.zoomLens).click(function () {
                        self.jQueryelem.trigger('click');
                    });
                }
            }
            if (isNaN(self.options.zoomWindowPosition)) {
                self.zoomWindow = jQuery("<div style='z-index:999;left:" + (self.windowOffsetLeft) + "px;top:" + (self.windowOffsetTop) + "px;" + self.zoomWindowStyle + "' class='zoomWindow'>&nbsp;</div>").appendTo('body').click(function () {
                    self.jQueryelem.trigger('click');
                });
            } else {
                self.zoomWindow = jQuery("<div style='z-index:999;left:" + (self.windowOffsetLeft) + "px;top:" + (self.windowOffsetTop) + "px;" + self.zoomWindowStyle + "' class='zoomWindow'>&nbsp;</div>").appendTo(self.zoomContainer).click(function () {
                    self.jQueryelem.trigger('click');
                });
            }
            self.zoomWindowContainer = jQuery('<div/>').addClass('zoomWindowContainer').css("width", self.options.zoomWindowWidth);
            self.zoomWindow.wrap(self.zoomWindowContainer);
            if (self.options.zoomType == "lens") {
                self.zoomLens.css({backgroundImage: "url('" + self.imageSrc + "')"});
            }
            if (self.options.zoomType == "window") {
                self.zoomWindow.css({backgroundImage: "url('" + self.imageSrc + "')"});
            }
            if (self.options.zoomType == "inner") {
                self.zoomWindow.css({backgroundImage: "url('" + self.imageSrc + "')"});
            }
            self.jQueryelem.bind('touchmove', function (e) {
                e.preventDefault();
                var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                self.setPosition(touch);
            });
            self.zoomContainer.bind('touchmove', function (e) {
                if (self.options.zoomType == "inner") {
                    self.showHideWindow("show");
                }
                e.preventDefault();
                var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                self.setPosition(touch);
            });
            self.zoomContainer.bind('touchend', function (e) {
                self.showHideWindow("hide");
                if (self.options.showLens) {
                    self.showHideLens("hide");
                }
                if (self.options.tint && self.options.zoomType != "inner") {
                    self.showHideTint("hide");
                }
            });
            self.jQueryelem.bind('touchend', function (e) {
                self.showHideWindow("hide");
                if (self.options.showLens) {
                    self.showHideLens("hide");
                }
                if (self.options.tint && self.options.zoomType != "inner") {
                    self.showHideTint("hide");
                }
            });
            if (self.options.showLens) {
                self.zoomLens.bind('touchmove', function (e) {
                    e.preventDefault();
                    var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                    self.setPosition(touch);
                });
                self.zoomLens.bind('touchend', function (e) {
                    self.showHideWindow("hide");
                    if (self.options.showLens) {
                        self.showHideLens("hide");
                    }
                    if (self.options.tint && self.options.zoomType != "inner") {
                        self.showHideTint("hide");
                    }
                });
            }
            self.jQueryelem.bind('mousemove', function (e) {
                if (self.overWindow == false) {
                    self.setElements("show");
                }
                if (self.lastX !== e.clientX || self.lastY !== e.clientY) {
                    self.setPosition(e);
                    self.currentLoc = e;
                }
                self.lastX = e.clientX;
                self.lastY = e.clientY;
            });
            self.zoomContainer.bind('mousemove', function (e) {
                if (self.overWindow == false) {
                    self.setElements("show");
                }
                if (self.lastX !== e.clientX || self.lastY !== e.clientY) {
                    self.setPosition(e);
                    self.currentLoc = e;
                }
                self.lastX = e.clientX;
                self.lastY = e.clientY;
            });
            if (self.options.zoomType != "inner") {
                self.zoomLens.bind('mousemove', function (e) {
                    if (self.lastX !== e.clientX || self.lastY !== e.clientY) {
                        self.setPosition(e);
                        self.currentLoc = e;
                    }
                    self.lastX = e.clientX;
                    self.lastY = e.clientY;
                });
            }
            if (self.options.tint && self.options.zoomType != "inner") {
                self.zoomTint.bind('mousemove', function (e) {
                    if (self.lastX !== e.clientX || self.lastY !== e.clientY) {
                        self.setPosition(e);
                        self.currentLoc = e;
                    }
                    self.lastX = e.clientX;
                    self.lastY = e.clientY;
                });
            }
            if (self.options.zoomType == "inner") {
                self.zoomWindow.bind('mousemove', function (e) {
                    if (self.lastX !== e.clientX || self.lastY !== e.clientY) {
                        self.setPosition(e);
                        self.currentLoc = e;
                    }
                    self.lastX = e.clientX;
                    self.lastY = e.clientY;
                });
            }
            self.zoomContainer.add(self.jQueryelem).mouseenter(function () {
                if (self.overWindow == false) {
                    self.setElements("show");
                }
            }).mouseleave(function () {
                if (!self.scrollLock) {
                    self.setElements("hide");
                }
            });
            if (self.options.zoomType != "inner") {
                self.zoomWindow.mouseenter(function () {
                    self.overWindow = true;
                    self.setElements("hide");
                }).mouseleave(function () {
                    self.overWindow = false;
                });
            }
            if (self.options.zoomLevel != 1) {
            }
            if (self.options.minZoomLevel) {
                self.minZoomLevel = self.options.minZoomLevel;
            } else {
                self.minZoomLevel = self.options.scrollZoomIncrement * 2;
            }
            if (self.options.scrollZoom) {
                self.zoomContainer.add(self.jQueryelem).bind('mousewheel DOMMouseScroll MozMousePixelScroll', function (e) {
                    self.scrollLock = true;
                    clearTimeout(jQuery.data(this, 'timer'));
                    jQuery.data(this, 'timer', setTimeout(function () {
                        self.scrollLock = false;
                    }, 250));
                    var theEvent = e.originalEvent.wheelDelta || e.originalEvent.detail * -1
                    e.stopImmediatePropagation();
                    e.stopPropagation();
                    e.preventDefault();
                    if (theEvent / 120 > 0) {
                        if (self.currentZoomLevel >= self.minZoomLevel) {
                            self.changeZoomLevel(self.currentZoomLevel - self.options.scrollZoomIncrement);
                        }
                    } else {
                        if (self.options.maxZoomLevel) {
                            if (self.currentZoomLevel <= self.options.maxZoomLevel) {
                                self.changeZoomLevel(parseFloat(self.currentZoomLevel) + self.options.scrollZoomIncrement);
                            }
                        } else {
                            self.changeZoomLevel(parseFloat(self.currentZoomLevel) + self.options.scrollZoomIncrement);
                        }
                    }
                    return false;
                });
            }
        }, setElements: function (type) {
            var self = this;
            if (!self.options.zoomEnabled) {
                return false;
            }
            if (type == "show") {
                if (self.isWindowSet) {
                    if (self.options.zoomType == "inner") {
                        self.showHideWindow("show");
                    }
                    if (self.options.zoomType == "window") {
                        self.showHideWindow("show");
                    }
                    if (self.options.showLens) {
                        self.showHideLens("show");
                    }
                    if (self.options.tint && self.options.zoomType != "inner") {
                        self.showHideTint("show");
                    }
                }
            }
            if (type == "hide") {
                if (self.options.zoomType == "window") {
                    self.showHideWindow("hide");
                }
                if (!self.options.tint) {
                    self.showHideWindow("hide");
                }
                if (self.options.showLens) {
                    self.showHideLens("hide");
                }
                if (self.options.tint) {
                    self.showHideTint("hide");
                }
            }
        }, setPosition: function (e) {
            var self = this;
            if (!self.options.zoomEnabled) {
                return false;
            }
            self.nzHeight = self.jQueryelem.height();
            self.nzWidth = self.jQueryelem.width();
            self.nzOffset = self.jQueryelem.offset();
            if (self.options.tint && self.options.zoomType != "inner") {
                self.zoomTint.css({top: 0});
                self.zoomTint.css({left: 0});
            }
            if (self.options.responsive && !self.options.scrollZoom) {
                if (self.options.showLens) {
                    if (self.nzHeight < self.options.zoomWindowWidth / self.widthRatio) {
                        lensHeight = self.nzHeight;
                    } else {
                        lensHeight = String((self.options.zoomWindowHeight / self.heightRatio))
                    }
                    if (self.largeWidth < self.options.zoomWindowWidth) {
                        lensWidth = self.nzWidth;
                    } else {
                        lensWidth = (self.options.zoomWindowWidth / self.widthRatio);
                    }
                    self.widthRatio = self.largeWidth / self.nzWidth;
                    self.heightRatio = self.largeHeight / self.nzHeight;
                    if (self.options.zoomType != "lens") {
                        if (self.nzHeight < self.options.zoomWindowWidth / self.widthRatio) {
                            lensHeight = self.nzHeight;
                        } else {
                            lensHeight = String((self.options.zoomWindowHeight / self.heightRatio))
                        }
                        if (self.options.zoomWindowWidth < self.options.zoomWindowWidth) {
                            lensWidth = self.nzWidth;
                        } else {
                            lensWidth = (self.options.zoomWindowWidth / self.widthRatio);
                        }
                        self.zoomLens.css('width', lensWidth);
                        self.zoomLens.css('height', lensHeight);
                        if (self.options.tint) {
                            self.zoomTintImage.css('width', self.nzWidth);
                            self.zoomTintImage.css('height', self.nzHeight);
                        }
                    }
                    if (self.options.zoomType == "lens") {
                        self.zoomLens.css({
                            width: String(self.options.lensSize) + 'px',
                            height: String(self.options.lensSize) + 'px'
                        })
                    }
                }
            }
            self.zoomContainer.css({top: self.nzOffset.top});
            self.zoomContainer.css({left: self.nzOffset.left});
            self.mouseLeft = parseInt(e.pageX - self.nzOffset.left);
            self.mouseTop = parseInt(e.pageY - self.nzOffset.top);
            if (self.options.zoomType == "window") {
                self.Etoppos = (self.mouseTop < (self.zoomLens.height() / 2));
                self.Eboppos = (self.mouseTop > self.nzHeight - (self.zoomLens.height() / 2) - (self.options.lensBorderSize * 2));
                self.Eloppos = (self.mouseLeft < 0 + ((self.zoomLens.width() / 2)));
                self.Eroppos = (self.mouseLeft > (self.nzWidth - (self.zoomLens.width() / 2) - (self.options.lensBorderSize * 2)));
            }
            if (self.options.zoomType == "inner") {
                self.Etoppos = (self.mouseTop < ((self.nzHeight / 2) / self.heightRatio));
                self.Eboppos = (self.mouseTop > (self.nzHeight - ((self.nzHeight / 2) / self.heightRatio)));
                self.Eloppos = (self.mouseLeft < 0 + (((self.nzWidth / 2) / self.widthRatio)));
                self.Eroppos = (self.mouseLeft > (self.nzWidth - (self.nzWidth / 2) / self.widthRatio - (self.options.lensBorderSize * 2)));
            }
            if (self.mouseLeft <= 0 || self.mouseTop < 0 || self.mouseLeft > self.nzWidth || self.mouseTop > self.nzHeight) {
                self.setElements("hide");
                return;
            } else {
                if (self.options.showLens) {
                    self.lensLeftPos = String(self.mouseLeft - self.zoomLens.width() / 2);
                    self.lensTopPos = String(self.mouseTop - self.zoomLens.height() / 2);
                }
                if (self.Etoppos) {
                    self.lensTopPos = 0;
                }
                if (self.Eloppos) {
                    self.windowLeftPos = 0;
                    self.lensLeftPos = 0;
                    self.tintpos = 0;
                }
                if (self.options.zoomType == "window") {
                    if (self.Eboppos) {
                        self.lensTopPos = Math.max((self.nzHeight) - self.zoomLens.height() - (self.options.lensBorderSize * 2), 0);
                    }
                    if (self.Eroppos) {
                        self.lensLeftPos = (self.nzWidth - (self.zoomLens.width()) - (self.options.lensBorderSize * 2));
                    }
                }
                if (self.options.zoomType == "inner") {
                    if (self.Eboppos) {
                        self.lensTopPos = Math.max(((self.nzHeight) - (self.options.lensBorderSize * 2)), 0);
                    }
                    if (self.Eroppos) {
                        self.lensLeftPos = (self.nzWidth - (self.nzWidth) - (self.options.lensBorderSize * 2));
                    }
                }
                if (self.options.zoomType == "lens") {
                    self.windowLeftPos = String(((e.pageX - self.nzOffset.left) * self.widthRatio - self.zoomLens.width() / 2) * (-1));
                    self.windowTopPos = String(((e.pageY - self.nzOffset.top) * self.heightRatio - self.zoomLens.height() / 2) * (-1));
                    self.zoomLens.css({backgroundPosition: self.windowLeftPos + 'px ' + self.windowTopPos + 'px'});
                    if (self.changeBgSize) {
                        if (self.nzHeight > self.nzWidth) {
                            if (self.options.zoomType == "lens") {
                                self.zoomLens.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                            }
                            self.zoomWindow.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                        } else {
                            if (self.options.zoomType == "lens") {
                                self.zoomLens.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                            }
                            self.zoomWindow.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                        }
                        self.changeBgSize = false;
                    }
                    self.setWindowPostition(e);
                }
                if (self.options.tint && self.options.zoomType != "inner") {
                    self.setTintPosition(e);
                }
                if (self.options.zoomType == "window") {
                    self.setWindowPostition(e);
                }
                if (self.options.zoomType == "inner") {
                    self.setWindowPostition(e);
                }
                if (self.options.showLens) {
                    if (self.fullwidth && self.options.zoomType != "lens") {
                        self.lensLeftPos = 0;
                    }
                    self.zoomLens.css({left: self.lensLeftPos + 'px', top: self.lensTopPos + 'px'})
                }
            }
        }, showHideWindow: function (change) {
            var self = this;
            if (change == "show") {
                if (!self.isWindowActive) {
                    if (self.options.zoomWindowFadeIn) {
                        self.zoomWindow.stop(true, true, false).fadeIn(self.options.zoomWindowFadeIn);
                    } else {
                        self.zoomWindow.show();
                    }
                    self.isWindowActive = true;
                }
            }
            if (change == "hide") {
                if (self.isWindowActive) {
                    if (self.options.zoomWindowFadeOut) {
                        self.zoomWindow.stop(true, true).fadeOut(self.options.zoomWindowFadeOut);
                    } else {
                        self.zoomWindow.hide();
                    }
                    self.isWindowActive = false;
                }
            }
        }, showHideLens: function (change) {
            var self = this;
            if (change == "show") {
                if (!self.isLensActive) {
                    if (self.options.lensFadeIn) {
                        self.zoomLens.stop(true, true, false).fadeIn(self.options.lensFadeIn);
                    } else {
                        self.zoomLens.show();
                    }
                    self.isLensActive = true;
                }
            }
            if (change == "hide") {
                if (self.isLensActive) {
                    if (self.options.lensFadeOut) {
                        self.zoomLens.stop(true, true).fadeOut(self.options.lensFadeOut);
                    } else {
                        self.zoomLens.hide();
                    }
                    self.isLensActive = false;
                }
            }
        }, showHideTint: function (change) {
            var self = this;
            if (change == "show") {
                if (!self.isTintActive) {
                    if (self.options.zoomTintFadeIn) {
                        self.zoomTint.css({opacity: self.options.tintOpacity}).animate().stop(true, true).fadeIn("slow");
                    } else {
                        self.zoomTint.css({opacity: self.options.tintOpacity}).animate();
                        self.zoomTint.show();
                    }
                    self.isTintActive = true;
                }
            }
            if (change == "hide") {
                if (self.isTintActive) {
                    if (self.options.zoomTintFadeOut) {
                        self.zoomTint.stop(true, true).fadeOut(self.options.zoomTintFadeOut);
                    } else {
                        self.zoomTint.hide();
                    }
                    self.isTintActive = false;
                }
            }
        }, setLensPostition: function (e) {
        }, setWindowPostition: function (e) {
            var self = this;
            if (!isNaN(self.options.zoomWindowPosition)) {
                switch (self.options.zoomWindowPosition) {
                    case 1:
                        self.windowOffsetTop = (self.options.zoomWindowOffety);
                        self.windowOffsetLeft = (+self.nzWidth);
                        break;
                    case 2:
                        if (self.options.zoomWindowHeight > self.nzHeight) {
                            self.windowOffsetTop = ((self.options.zoomWindowHeight / 2) - (self.nzHeight / 2)) * (-1);
                            self.windowOffsetLeft = (self.nzWidth);
                        } else {
                        }
                        break;
                    case 3:
                        self.windowOffsetTop = (self.nzHeight - self.zoomWindow.height() - (self.options.borderSize * 2));
                        self.windowOffsetLeft = (self.nzWidth);
                        break;
                    case 4:
                        self.windowOffsetTop = (self.nzHeight);
                        self.windowOffsetLeft = (self.nzWidth);
                        break;
                    case 5:
                        self.windowOffsetTop = (self.nzHeight);
                        self.windowOffsetLeft = (self.nzWidth - self.zoomWindow.width() - (self.options.borderSize * 2));
                        break;
                    case 6:
                        if (self.options.zoomWindowHeight > self.nzHeight) {
                            self.windowOffsetTop = (self.nzHeight);
                            self.windowOffsetLeft = ((self.options.zoomWindowWidth / 2) - (self.nzWidth / 2) + (self.options.borderSize * 2)) * (-1);
                        } else {
                        }
                        break;
                    case 7:
                        self.windowOffsetTop = (self.nzHeight);
                        self.windowOffsetLeft = 0;
                        break;
                    case 8:
                        self.windowOffsetTop = (self.nzHeight);
                        self.windowOffsetLeft = (self.zoomWindow.width() + (self.options.borderSize * 2)) * (-1);
                        break;
                    case 9:
                        self.windowOffsetTop = (self.nzHeight - self.zoomWindow.height() - (self.options.borderSize * 2));
                        self.windowOffsetLeft = (self.zoomWindow.width() + (self.options.borderSize * 2)) * (-1);
                        break;
                    case 10:
                        if (self.options.zoomWindowHeight > self.nzHeight) {
                            self.windowOffsetTop = ((self.options.zoomWindowHeight / 2) - (self.nzHeight / 2)) * (-1);
                            self.windowOffsetLeft = (self.zoomWindow.width() + (self.options.borderSize * 2)) * (-1);
                        } else {
                        }
                        break;
                    case 11:
                        self.windowOffsetTop = (self.options.zoomWindowOffety);
                        self.windowOffsetLeft = (self.zoomWindow.width() + (self.options.borderSize * 2)) * (-1);
                        break;
                    case 12:
                        self.windowOffsetTop = (self.zoomWindow.height() + (self.options.borderSize * 2)) * (-1);
                        self.windowOffsetLeft = (self.zoomWindow.width() + (self.options.borderSize * 2)) * (-1);
                        break;
                    case 13:
                        self.windowOffsetTop = (self.zoomWindow.height() + (self.options.borderSize * 2)) * (-1);
                        self.windowOffsetLeft = (0);
                        break;
                    case 14:
                        if (self.options.zoomWindowHeight > self.nzHeight) {
                            self.windowOffsetTop = (self.zoomWindow.height() + (self.options.borderSize * 2)) * (-1);
                            self.windowOffsetLeft = ((self.options.zoomWindowWidth / 2) - (self.nzWidth / 2) + (self.options.borderSize * 2)) * (-1);
                        } else {
                        }
                        break;
                    case 15:
                        self.windowOffsetTop = (self.zoomWindow.height() + (self.options.borderSize * 2)) * (-1);
                        self.windowOffsetLeft = (self.nzWidth - self.zoomWindow.width() - (self.options.borderSize * 2));
                        break;
                    case 16:
                        self.windowOffsetTop = (self.zoomWindow.height() + (self.options.borderSize * 2)) * (-1);
                        self.windowOffsetLeft = (self.nzWidth);
                        break;
                    default:
                        self.windowOffsetTop = (self.options.zoomWindowOffety);
                        self.windowOffsetLeft = (self.nzWidth);
                }
            } else {
                self.externalContainer = jQuery('#' + self.options.zoomWindowPosition);
                self.externalContainerWidth = self.externalContainer.width();
                self.externalContainerHeight = self.externalContainer.height();
                self.externalContainerOffset = self.externalContainer.offset();
                self.windowOffsetTop = self.externalContainerOffset.top;
                self.windowOffsetLeft = self.externalContainerOffset.left;
            }
            self.isWindowSet = true;
            self.windowOffsetTop = self.windowOffsetTop + self.options.zoomWindowOffety;
            self.windowOffsetLeft = self.windowOffsetLeft + self.options.zoomWindowOffetx;
            self.zoomWindow.css({top: self.windowOffsetTop});
            self.zoomWindow.css({left: self.windowOffsetLeft});
            if (self.options.zoomType == "inner") {
                self.zoomWindow.css({top: 0});
                self.zoomWindow.css({left: 0});
            }
            self.windowLeftPos = String(((e.pageX - self.nzOffset.left) * self.widthRatio - self.zoomWindow.width() / 2) * (-1));
            self.windowTopPos = String(((e.pageY - self.nzOffset.top) * self.heightRatio - self.zoomWindow.height() / 2) * (-1));
            if (self.Etoppos) {
                self.windowTopPos = 0;
            }
            if (self.Eloppos) {
                self.windowLeftPos = 0;
            }
            if (self.Eboppos) {
                self.windowTopPos = (self.largeHeight / self.currentZoomLevel - self.zoomWindow.height()) * (-1);
            }
            if (self.Eroppos) {
                self.windowLeftPos = ((self.largeWidth / self.currentZoomLevel - self.zoomWindow.width()) * (-1));
            }
            if (self.fullheight) {
                self.windowTopPos = 0;
            }
            if (self.fullwidth) {
                self.windowLeftPos = 0;
            }
            if (self.options.zoomType == "window" || self.options.zoomType == "inner") {
                if (self.zoomLock == 1) {
                    if (self.widthRatio <= 1) {
                        self.windowLeftPos = 0;
                    }
                    if (self.heightRatio <= 1) {
                        self.windowTopPos = 0;
                    }
                }
                if (self.largeHeight < self.options.zoomWindowHeight) {
                    self.windowTopPos = 0;
                }
                if (self.largeWidth < self.options.zoomWindowWidth) {
                    self.windowLeftPos = 0;
                }
                if (self.options.easing) {
                    if (!self.xp) {
                        self.xp = 0;
                    }
                    if (!self.yp) {
                        self.yp = 0;
                    }
                    if (!self.loop) {
                        self.loop = setInterval(function () {
                            self.xp += (self.windowLeftPos - self.xp) / self.options.easingAmount;
                            self.yp += (self.windowTopPos - self.yp) / self.options.easingAmount;
                            if (self.scrollingLock) {
                                clearInterval(self.loop);
                                self.xp = self.windowLeftPos;
                                self.yp = self.windowTopPos
                                self.xp = ((e.pageX - self.nzOffset.left) * self.widthRatio - self.zoomWindow.width() / 2) * (-1);
                                self.yp = (((e.pageY - self.nzOffset.top) * self.heightRatio - self.zoomWindow.height() / 2) * (-1));
                                if (self.changeBgSize) {
                                    if (self.nzHeight > self.nzWidth) {
                                        if (self.options.zoomType == "lens") {
                                            self.zoomLens.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                                        }
                                        self.zoomWindow.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                                    } else {
                                        if (self.options.zoomType != "lens") {
                                            self.zoomLens.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                                        }
                                        self.zoomWindow.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                                    }
                                    self.changeBgSize = false;
                                }
                                self.zoomWindow.css({backgroundPosition: self.windowLeftPos + 'px ' + self.windowTopPos + 'px'});
                                self.scrollingLock = false;
                                self.loop = false;
                            } else {
                                if (self.changeBgSize) {
                                    if (self.nzHeight > self.nzWidth) {
                                        if (self.options.zoomType == "lens") {
                                            self.zoomLens.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                                        }
                                        self.zoomWindow.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                                    } else {
                                        if (self.options.zoomType != "lens") {
                                            self.zoomLens.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                                        }
                                        self.zoomWindow.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                                    }
                                    self.changeBgSize = false;
                                }
                                self.zoomWindow.css({backgroundPosition: self.xp + 'px ' + self.yp + 'px'});
                            }
                        }, 16);
                    }
                } else {
                    if (self.changeBgSize) {
                        if (self.nzHeight > self.nzWidth) {
                            if (self.options.zoomType == "lens") {
                                self.zoomLens.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                            }
                            self.zoomWindow.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                        } else {
                            if (self.options.zoomType == "lens") {
                                self.zoomLens.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                            }
                            if ((self.largeHeight / self.newvaluewidth) < self.options.zoomWindowHeight) {
                                self.zoomWindow.css({"background-size": self.largeWidth / self.newvaluewidth + 'px ' + self.largeHeight / self.newvaluewidth + 'px'});
                            } else {
                                self.zoomWindow.css({"background-size": self.largeWidth / self.newvalueheight + 'px ' + self.largeHeight / self.newvalueheight + 'px'});
                            }
                        }
                        self.changeBgSize = false;
                    }
                    self.zoomWindow.css({backgroundPosition: self.windowLeftPos + 'px ' + self.windowTopPos + 'px'});
                }
            }
        }, setTintPosition: function (e) {
            var self = this;
            self.nzOffset = self.jQueryelem.offset();
            self.tintpos = String(((e.pageX - self.nzOffset.left) - (self.zoomLens.width() / 2)) * (-1));
            self.tintposy = String(((e.pageY - self.nzOffset.top) - self.zoomLens.height() / 2) * (-1));
            if (self.Etoppos) {
                self.tintposy = 0;
            }
            if (self.Eloppos) {
                self.tintpos = 0;
            }
            if (self.Eboppos) {
                self.tintposy = (self.nzHeight - self.zoomLens.height() - (self.options.lensBorderSize * 2)) * (-1);
            }
            if (self.Eroppos) {
                self.tintpos = ((self.nzWidth - self.zoomLens.width() - (self.options.lensBorderSize * 2)) * (-1));
            }
            if (self.options.tint) {
                if (self.fullheight) {
                    self.tintposy = 0;
                }
                if (self.fullwidth) {
                    self.tintpos = 0;
                }
                self.zoomTintImage.css({'left': self.tintpos + 'px'});
                self.zoomTintImage.css({'top': self.tintposy + 'px'});
            }
        }, swaptheimage: function (smallimage, largeimage) {
            var self = this;
            var newImg = new Image();
            if (self.options.loadingIcon) {
                self.spinner = jQuery('<div style="background: url(\'' + self.options.loadingIcon + '\') no-repeat center;height:' + self.nzHeight + 'px;width:' + self.nzWidth + 'px;z-index: 2000;position: absolute; background-position: center center;"></div>');
                self.jQueryelem.after(self.spinner);
            }
            self.options.onImageSwap(self.jQueryelem);
            newImg.onload = function () {
                self.largeWidth = newImg.width;
                self.largeHeight = newImg.height;
                self.zoomImage = largeimage;
                self.zoomWindow.css({"background-size": self.largeWidth + 'px ' + self.largeHeight + 'px'});
                self.zoomWindow.css({"background-size": self.largeWidth + 'px ' + self.largeHeight + 'px'});
                self.swapAction(smallimage, largeimage);
                return;
            }
            newImg.src = largeimage;
        }, swapAction: function (smallimage, largeimage) {
            var self = this;
            var newImg2 = new Image();
            newImg2.onload = function () {
                self.nzHeight = newImg2.height;
                self.nzWidth = newImg2.width;
                self.options.onImageSwapComplete(self.jQueryelem);
                self.doneCallback();
                return;
            }
            newImg2.src = smallimage;
            self.currentZoomLevel = self.options.zoomLevel;
            self.options.maxZoomLevel = false;
            if (self.options.zoomType == "lens") {
                self.zoomLens.css({backgroundImage: "url('" + largeimage + "')"});
            }
            if (self.options.zoomType == "window") {
                self.zoomWindow.css({backgroundImage: "url('" + largeimage + "')"});
            }
            if (self.options.zoomType == "inner") {
                self.zoomWindow.css({backgroundImage: "url('" + largeimage + "')"});
            }
            self.currentImage = largeimage;
            if (self.options.imageCrossfade) {
                var oldImg = self.jQueryelem;
                var newImg = oldImg.clone();
                self.jQueryelem.attr("src", smallimage)
                self.jQueryelem.after(newImg);
                newImg.stop(true).fadeOut(self.options.imageCrossfade, function () {
                    jQuery(this).remove();
                });
                self.jQueryelem.width("auto").removeAttr("width");
                self.jQueryelem.height("auto").removeAttr("height");
                oldImg.fadeIn(self.options.imageCrossfade);
                if (self.options.tint && self.options.zoomType != "inner") {
                    var oldImgTint = self.zoomTintImage;
                    var newImgTint = oldImgTint.clone();
                    self.zoomTintImage.attr("src", largeimage)
                    self.zoomTintImage.after(newImgTint);
                    newImgTint.stop(true).fadeOut(self.options.imageCrossfade, function () {
                        jQuery(this).remove();
                    });
                    oldImgTint.fadeIn(self.options.imageCrossfade);
                    self.zoomTint.css({height: self.jQueryelem.height()});
                    self.zoomTint.css({width: self.jQueryelem.width()});
                }
                self.zoomContainer.css("height", self.jQueryelem.height());
                self.zoomContainer.css("width", self.jQueryelem.width());
                if (self.options.zoomType == "inner") {
                    if (!self.options.constrainType) {
                        self.zoomWrap.parent().css("height", self.jQueryelem.height());
                        self.zoomWrap.parent().css("width", self.jQueryelem.width());
                        self.zoomWindow.css("height", self.jQueryelem.height());
                        self.zoomWindow.css("width", self.jQueryelem.width());
                    }
                }
                if (self.options.imageCrossfade) {
                    self.zoomWrap.css("height", self.jQueryelem.height());
                    self.zoomWrap.css("width", self.jQueryelem.width());
                }
            } else {
                self.jQueryelem.attr("src", smallimage);
                if (self.options.tint) {
                    self.zoomTintImage.attr("src", largeimage);
                    self.zoomTintImage.attr("height", self.jQueryelem.height());
                    self.zoomTintImage.css({height: self.jQueryelem.height()});
                    self.zoomTint.css({height: self.jQueryelem.height()});
                }
                self.zoomContainer.css("height", self.jQueryelem.height());
                self.zoomContainer.css("width", self.jQueryelem.width());
                if (self.options.imageCrossfade) {
                    self.zoomWrap.css("height", self.jQueryelem.height());
                    self.zoomWrap.css("width", self.jQueryelem.width());
                }
            }
            if (self.options.constrainType) {
                if (self.options.constrainType == "height") {
                    self.zoomContainer.css("height", self.options.constrainSize);
                    self.zoomContainer.css("width", "auto");
                    if (self.options.imageCrossfade) {
                        self.zoomWrap.css("height", self.options.constrainSize);
                        self.zoomWrap.css("width", "auto");
                        self.constwidth = self.zoomWrap.width();
                    } else {
                        self.jQueryelem.css("height", self.options.constrainSize);
                        self.jQueryelem.css("width", "auto");
                        self.constwidth = self.jQueryelem.width();
                    }
                    if (self.options.zoomType == "inner") {
                        self.zoomWrap.parent().css("height", self.options.constrainSize);
                        self.zoomWrap.parent().css("width", self.constwidth);
                        self.zoomWindow.css("height", self.options.constrainSize);
                        self.zoomWindow.css("width", self.constwidth);
                    }
                    if (self.options.tint) {
                        self.tintContainer.css("height", self.options.constrainSize);
                        self.tintContainer.css("width", self.constwidth);
                        self.zoomTint.css("height", self.options.constrainSize);
                        self.zoomTint.css("width", self.constwidth);
                        self.zoomTintImage.css("height", self.options.constrainSize);
                        self.zoomTintImage.css("width", self.constwidth);
                    }
                }
                if (self.options.constrainType == "width") {
                    self.zoomContainer.css("height", "auto");
                    self.zoomContainer.css("width", self.options.constrainSize);
                    if (self.options.imageCrossfade) {
                        self.zoomWrap.css("height", "auto");
                        self.zoomWrap.css("width", self.options.constrainSize);
                        self.constheight = self.zoomWrap.height();
                    } else {
                        self.jQueryelem.css("height", "auto");
                        self.jQueryelem.css("width", self.options.constrainSize);
                        self.constheight = self.jQueryelem.height();
                    }
                    if (self.options.zoomType == "inner") {
                        self.zoomWrap.parent().css("height", self.constheight);
                        self.zoomWrap.parent().css("width", self.options.constrainSize);
                        self.zoomWindow.css("height", self.constheight);
                        self.zoomWindow.css("width", self.options.constrainSize);
                    }
                    if (self.options.tint) {
                        self.tintContainer.css("height", self.constheight);
                        self.tintContainer.css("width", self.options.constrainSize);
                        self.zoomTint.css("height", self.constheight);
                        self.zoomTint.css("width", self.options.constrainSize);
                        self.zoomTintImage.css("height", self.constheight);
                        self.zoomTintImage.css("width", self.options.constrainSize);
                    }
                }
            }
        }, doneCallback: function () {
            var self = this;
            if (self.options.loadingIcon) {
                self.spinner.hide();
            }
            self.nzOffset = self.jQueryelem.offset();
            self.nzWidth = self.jQueryelem.width();
            self.nzHeight = self.jQueryelem.height();
            self.currentZoomLevel = self.options.zoomLevel;
            self.widthRatio = self.largeWidth / self.nzWidth;
            self.heightRatio = self.largeHeight / self.nzHeight;
            if (self.options.zoomType == "window") {
                if (self.nzHeight < self.options.zoomWindowWidth / self.widthRatio) {
                    lensHeight = self.nzHeight;
                } else {
                    lensHeight = String((self.options.zoomWindowHeight / self.heightRatio))
                }
                if (self.options.zoomWindowWidth < self.options.zoomWindowWidth) {
                    lensWidth = self.nzWidth;
                } else {
                    lensWidth = (self.options.zoomWindowWidth / self.widthRatio);
                }
                if (self.zoomLens) {
                    self.zoomLens.css('width', lensWidth);
                    self.zoomLens.css('height', lensHeight);
                }
            }
        }, getCurrentImage: function () {
            var self = this;
            return self.zoomImage;
        }, getGalleryList: function () {
            var self = this;
            self.gallerylist = [];
            if (self.options.gallery) {
                jQuery('#' + self.options.gallery + ' a').each(function () {
                    var img_src = '';
                    if (jQuery(this).data("zoom-image")) {
                        img_src = jQuery(this).data("zoom-image");
                    } else if (jQuery(this).data("image")) {
                        img_src = jQuery(this).data("image");
                    }
                    if (img_src == self.zoomImage) {
                        self.gallerylist.unshift({
                            href: '' + img_src + '',
                            title: jQuery(this).find('img').attr("title")
                        });
                    } else {
                        self.gallerylist.push({href: '' + img_src + '', title: jQuery(this).find('img').attr("title")});
                    }
                });
            } else {
                self.gallerylist.push({href: '' + self.zoomImage + '', title: jQuery(this).find('img').attr("title")});
            }
            return self.gallerylist;
        }, changeZoomLevel: function (value) {
            var self = this;
            self.scrollingLock = true;
            self.newvalue = parseFloat(value).toFixed(2);
            newvalue = parseFloat(value).toFixed(2);
            maxheightnewvalue = self.largeHeight / ((self.options.zoomWindowHeight / self.nzHeight) * self.nzHeight);
            maxwidthtnewvalue = self.largeWidth / ((self.options.zoomWindowWidth / self.nzWidth) * self.nzWidth);
            if (self.options.zoomType != "inner") {
                if (maxheightnewvalue <= newvalue) {
                    self.heightRatio = (self.largeHeight / maxheightnewvalue) / self.nzHeight;
                    self.newvalueheight = maxheightnewvalue;
                    self.fullheight = true;
                } else {
                    self.heightRatio = (self.largeHeight / newvalue) / self.nzHeight;
                    self.newvalueheight = newvalue;
                    self.fullheight = false;
                }
                if (maxwidthtnewvalue <= newvalue) {
                    self.widthRatio = (self.largeWidth / maxwidthtnewvalue) / self.nzWidth;
                    self.newvaluewidth = maxwidthtnewvalue;
                    self.fullwidth = true;
                } else {
                    self.widthRatio = (self.largeWidth / newvalue) / self.nzWidth;
                    self.newvaluewidth = newvalue;
                    self.fullwidth = false;
                }
                if (self.options.zoomType == "lens") {
                    if (maxheightnewvalue <= newvalue) {
                        self.fullwidth = true;
                        self.newvaluewidth = maxheightnewvalue;
                    } else {
                        self.widthRatio = (self.largeWidth / newvalue) / self.nzWidth;
                        self.newvaluewidth = newvalue;
                        self.fullwidth = false;
                    }
                }
            }
            if (self.options.zoomType == "inner") {
                maxheightnewvalue = parseFloat(self.largeHeight / self.nzHeight).toFixed(2);
                maxwidthtnewvalue = parseFloat(self.largeWidth / self.nzWidth).toFixed(2);
                if (newvalue > maxheightnewvalue) {
                    newvalue = maxheightnewvalue;
                }
                if (newvalue > maxwidthtnewvalue) {
                    newvalue = maxwidthtnewvalue;
                }
                if (maxheightnewvalue <= newvalue) {
                    self.heightRatio = (self.largeHeight / newvalue) / self.nzHeight;
                    if (newvalue > maxheightnewvalue) {
                        self.newvalueheight = maxheightnewvalue;
                    } else {
                        self.newvalueheight = newvalue;
                    }
                    self.fullheight = true;
                } else {
                    self.heightRatio = (self.largeHeight / newvalue) / self.nzHeight;
                    if (newvalue > maxheightnewvalue) {
                        self.newvalueheight = maxheightnewvalue;
                    } else {
                        self.newvalueheight = newvalue;
                    }
                    self.fullheight = false;
                }
                if (maxwidthtnewvalue <= newvalue) {
                    self.widthRatio = (self.largeWidth / newvalue) / self.nzWidth;
                    if (newvalue > maxwidthtnewvalue) {
                        self.newvaluewidth = maxwidthtnewvalue;
                    } else {
                        self.newvaluewidth = newvalue;
                    }
                    self.fullwidth = true;
                } else {
                    self.widthRatio = (self.largeWidth / newvalue) / self.nzWidth;
                    self.newvaluewidth = newvalue;
                    self.fullwidth = false;
                }
            }
            scrcontinue = false;
            if (self.options.zoomType == "inner") {
                if (self.nzWidth >= self.nzHeight) {
                    if (self.newvaluewidth <= maxwidthtnewvalue) {
                        scrcontinue = true;
                    } else {
                        scrcontinue = false;
                        self.fullheight = true;
                        self.fullwidth = true;
                    }
                }
                if (self.nzHeight > self.nzWidth) {
                    if (self.newvaluewidth <= maxwidthtnewvalue) {
                        scrcontinue = true;
                    } else {
                        scrcontinue = false;
                        self.fullheight = true;
                        self.fullwidth = true;
                    }
                }
            }
            if (self.options.zoomType != "inner") {
                scrcontinue = true;
            }
            if (scrcontinue) {
                self.zoomLock = 0;
                self.changeZoom = true;
                if (((self.options.zoomWindowHeight) / self.heightRatio) <= self.nzHeight) {
                    self.currentZoomLevel = self.newvalueheight;
                    if (self.options.zoomType != "lens" && self.options.zoomType != "inner") {
                        self.changeBgSize = true;
                        self.zoomLens.css({height: String((self.options.zoomWindowHeight) / self.heightRatio) + 'px'})
                    }
                    if (self.options.zoomType == "lens" || self.options.zoomType == "inner") {
                        self.changeBgSize = true;
                    }
                }
                if ((self.options.zoomWindowWidth / self.widthRatio) <= self.nzWidth) {
                    if (self.options.zoomType != "inner") {
                        if (self.newvaluewidth > self.newvalueheight) {
                            self.currentZoomLevel = self.newvaluewidth;
                        }
                    }
                    if (self.options.zoomType != "lens" && self.options.zoomType != "inner") {
                        self.changeBgSize = true;
                        self.zoomLens.css({width: String((self.options.zoomWindowWidth) / self.widthRatio) + 'px'})
                    }
                    if (self.options.zoomType == "lens" || self.options.zoomType == "inner") {
                        self.changeBgSize = true;
                    }
                }
                if (self.options.zoomType == "inner") {
                    self.changeBgSize = true;
                    if (self.nzWidth > self.nzHeight) {
                        self.currentZoomLevel = self.newvaluewidth;
                    }
                    if (self.nzHeight > self.nzWidth) {
                        self.currentZoomLevel = self.newvaluewidth;
                    }
                }
            }
            self.setPosition(self.currentLoc);
        }, closeAll: function () {
            if (self.zoomWindow) {
                self.zoomWindow.hide();
            }
            if (self.zoomLens) {
                self.zoomLens.hide();
            }
            if (self.zoomTint) {
                self.zoomTint.hide();
            }
        }, changeState: function (value) {
            var self = this;
            if (value == 'enable') {
                self.options.zoomEnabled = true;
            }
            if (value == 'disable') {
                self.options.zoomEnabled = false;
            }
        }
    };
    jQuery.fn.elevateZoom = function (options) {
        return this.each(function () {
            var elevate = Object.create(ElevateZoom);
            elevate.init(options, this);
            jQuery.data(this, 'elevateZoom', elevate);
        });
    };
    jQuery.fn.elevateZoom.options = {
        zoomActivation: "hover",
        zoomEnabled: true,
        preloading: 1,
        zoomLevel: 1,
        scrollZoom: false,
        scrollZoomIncrement: 0.1,
        minZoomLevel: false,
        maxZoomLevel: false,
        easing: false,
        easingAmount: 12,
        lensSize: 200,
        zoomWindowWidth: 400,
        zoomWindowHeight: 400,
        zoomWindowOffetx: 0,
        zoomWindowOffety: 0,
        zoomWindowPosition: 1,
        zoomWindowBgColour: "#fff",
        lensFadeIn: false,
        lensFadeOut: false,
        debug: false,
        zoomWindowFadeIn: false,
        zoomWindowFadeOut: false,
        zoomWindowAlwaysShow: false,
        zoomTintFadeIn: false,
        zoomTintFadeOut: false,
        borderSize: 4,
        showLens: true,
        borderColour: "#888",
        lensBorderSize: 1,
        lensBorderColour: "#000",
        lensShape: "square",
        zoomType: "window",
        containLensZoom: false,
        lensColour: "white",
        lensOpacity: 0.4,
        lenszoom: false,
        tint: false,
        tintColour: "#333",
        tintOpacity: 0.4,
        gallery: false,
        galleryActiveClass: "zoomGalleryActive",
        imageCrossfade: false,
        constrainType: false,
        constrainSize: false,
        loadingIcon: false,
        cursor: "default",
        responsive: true,
        onComplete: jQuery.noop,
        onZoomedImageLoaded: function () {
        },
        onImageSwap: jQuery.noop,
        onImageSwapComplete: jQuery.noop
    };
})(jQuery, window, document);
/*! Lazy Load 2.0.0-beta.2 - MIT license - Copyright 2007-2017 Mika Tuupola */
!function (t, e) {
    "object" == typeof exports ? module.exports = e(t) : "function" == typeof define && define.amd ? define([], e(t)) : t.LazyLoad = e(t)
}("undefined" != typeof global ? global : this.window || this.global, function (t) {
    "use strict";

    function e(t, e) {
        this.settings = r(s, e || {}), this.images = t || document.querySelectorAll(this.settings.selector), this.observer = null, this.init()
    }

    const s = {src: "data-src", srcset: "data-srcset", selector: ".lazyload"}, r = function () {
        let t = {}, e = !1, s = 0, o = arguments.length;
        "[object Boolean]" === Object.prototype.toString.call(arguments[0]) && (e = arguments[0], s++);
        for (; s < o; s++) !function (s) {
            for (let o in s) Object.prototype.hasOwnProperty.call(s, o) && (e && "[object Object]" === Object.prototype.toString.call(s[o]) ? t[o] = r(!0, t[o], s[o]) : t[o] = s[o])
        }(arguments[s]);
        return t
    };
    if (e.prototype = {
        init: function () {
            if (!t.IntersectionObserver) return void this.loadImages();
            let e = this, s = {root: null, rootMargin: "0px", threshold: [0]};
            this.observer = new IntersectionObserver(function (t) {
                t.forEach(function (t) {
                    if (t.intersectionRatio > 0) {
                        e.observer.unobserve(t.target);
                        let s = t.target.getAttribute(e.settings.src), r = t.target.getAttribute(e.settings.srcset);
                        "img" === t.target.tagName.toLowerCase() ? (s && (t.target.src = s), r && (t.target.srcset = r)) : t.target.style.backgroundImage = "url(" + s + ")"
                    }
                })
            }, s), this.images.forEach(function (t) {
                e.observer.observe(t)
            })
        }, loadAndDestroy: function () {
            this.settings && (this.loadImages(), this.destroy())
        }, loadImages: function () {
            if (!this.settings) return;
            let t = this;
            this.images.forEach(function (e) {
                let s = e.getAttribute(t.settings.src), r = e.getAttribute(t.settings.srcset);
                "img" === e.tagName.toLowerCase() ? (s && (e.src = s), r && (e.srcset = r)) : e.style.backgroundImage = "url(" + s + ")"
            })
        }, destroy: function () {
            this.settings && (this.observer.disconnect(), this.settings = null)
        }
    }, t.lazyload = function (t, s) {
        return new e(t, s)
    }, t.jQuery) {
        const s = t.jQuery;
        s.fn.lazyload = function (t) {
            return t = t || {}, t.attribute = t.attribute || "data-src", new e(s.makeArray(this), t), this
        }
    }
    return e
});
!function (e) {
    e(["jquery"], function (e) {
        return function () {
            function t(e, t, n) {
                return g({type: O.error, iconClass: m().iconClasses.error, message: e, optionsOverride: n, title: t})
            }

            function n(t, n) {
                return t || (t = m()), v = e("#" + t.containerId), v.length ? v : (n && (v = d(t)), v)
            }

            function o(e, t, n) {
                return g({type: O.info, iconClass: m().iconClasses.info, message: e, optionsOverride: n, title: t})
            }

            function s(e) {
                C = e
            }

            function i(e, t, n) {
                return g({
                    type: O.success,
                    iconClass: m().iconClasses.success,
                    message: e,
                    optionsOverride: n,
                    title: t
                })
            }

            function a(e, t, n) {
                return g({
                    type: O.warning,
                    iconClass: m().iconClasses.warning,
                    message: e,
                    optionsOverride: n,
                    title: t
                })
            }

            function r(e, t) {
                var o = m();
                v || n(o), u(e, o, t) || l(o)
            }

            function c(t) {
                var o = m();
                return v || n(o), t && 0 === e(":focus", t).length ? void h(t) : void (v.children().length && v.remove())
            }

            function l(t) {
                for (var n = v.children(), o = n.length - 1; o >= 0; o--) u(e(n[o]), t)
            }

            function u(t, n, o) {
                var s = !(!o || !o.force) && o.force;
                return !(!t || !s && 0 !== e(":focus", t).length) && (t[n.hideMethod]({
                    duration: n.hideDuration,
                    easing: n.hideEasing,
                    complete: function () {
                        h(t)
                    }
                }), !0)
            }

            function d(t) {
                return v = e("<div/>").attr("id", t.containerId).addClass(t.positionClass), v.appendTo(e(t.target)), v
            }

            function p() {
                return {
                    tapToDismiss: !0,
                    toastClass: "toast",
                    containerId: "toast-container",
                    debug: !1,
                    showMethod: "fadeIn",
                    showDuration: 300,
                    showEasing: "swing",
                    onShown: void 0,
                    hideMethod: "fadeOut",
                    hideDuration: 1e3,
                    hideEasing: "swing",
                    onHidden: void 0,
                    closeMethod: !1,
                    closeDuration: !1,
                    closeEasing: !1,
                    closeOnHover: !0,
                    extendedTimeOut: 1e3,
                    iconClasses: {
                        error: "toast-error",
                        info: "toast-info",
                        success: "toast-success",
                        warning: "toast-warning"
                    },
                    iconClass: "toast-info",
                    positionClass: "toast-top-right",
                    timeOut: 5e3,
                    titleClass: "toast-title",
                    messageClass: "toast-message",
                    escapeHtml: !1,
                    target: "body",
                    closeHtml: '<button type="button">&times;</button>',
                    closeClass: "toast-close-button",
                    newestOnTop: !0,
                    preventDuplicates: !1,
                    progressBar: !1,
                    progressClass: "toast-progress",
                    rtl: !1
                }
            }

            function f(e) {
                C && C(e)
            }

            function g(t) {
                function o(e) {
                    return null == e && (e = ""), e.replace(/&/g, "&amp;").replace(/"/g, "&quot;").replace(/'/g, "&#39;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
                }

                function s() {
                    c(), u(), d(), p(), g(), C(), l(), i()
                }

                function i() {
                    var e = "";
                    switch (t.iconClass) {
                        case"toast-success":
                        case"toast-info":
                            e = "polite";
                            break;
                        default:
                            e = "assertive"
                    }
                    I.attr("aria-live", e)
                }

                function a() {
                    E.closeOnHover && I.hover(H, D), !E.onclick && E.tapToDismiss && I.click(b), E.closeButton && j && j.click(function (e) {
                        e.stopPropagation ? e.stopPropagation() : void 0 !== e.cancelBubble && e.cancelBubble !== !0 && (e.cancelBubble = !0), E.onCloseClick && E.onCloseClick(e), b(!0)
                    }), E.onclick && I.click(function (e) {
                        E.onclick(e), b()
                    })
                }

                function r() {
                    I.hide(), I[E.showMethod]({
                        duration: E.showDuration,
                        easing: E.showEasing,
                        complete: E.onShown
                    }), E.timeOut > 0 && (k = setTimeout(b, E.timeOut), F.maxHideTime = parseFloat(E.timeOut), F.hideEta = (new Date).getTime() + F.maxHideTime, E.progressBar && (F.intervalId = setInterval(x, 10)))
                }

                function c() {
                    t.iconClass && I.addClass(E.toastClass).addClass(y)
                }

                function l() {
                    E.newestOnTop ? v.prepend(I) : v.append(I)
                }

                function u() {
                    if (t.title) {
                        var e = t.title;
                        E.escapeHtml && (e = o(t.title)), M.append(e).addClass(E.titleClass), I.append(M)
                    }
                }

                function d() {
                    if (t.message) {
                        var e = t.message;
                        E.escapeHtml && (e = o(t.message)), B.append(e).addClass(E.messageClass), I.append(B)
                    }
                }

                function p() {
                    E.closeButton && (j.addClass(E.closeClass).attr("role", "button"), I.prepend(j))
                }

                function g() {
                    E.progressBar && (q.addClass(E.progressClass), I.prepend(q))
                }

                function C() {
                    E.rtl && I.addClass("rtl")
                }

                function O(e, t) {
                    if (e.preventDuplicates) {
                        if (t.message === w) return !0;
                        w = t.message
                    }
                    return !1
                }

                function b(t) {
                    var n = t && E.closeMethod !== !1 ? E.closeMethod : E.hideMethod,
                        o = t && E.closeDuration !== !1 ? E.closeDuration : E.hideDuration,
                        s = t && E.closeEasing !== !1 ? E.closeEasing : E.hideEasing;
                    if (!e(":focus", I).length || t) return clearTimeout(F.intervalId), I[n]({
                        duration: o,
                        easing: s,
                        complete: function () {
                            h(I), clearTimeout(k), E.onHidden && "hidden" !== P.state && E.onHidden(), P.state = "hidden", P.endTime = new Date, f(P)
                        }
                    })
                }

                function D() {
                    (E.timeOut > 0 || E.extendedTimeOut > 0) && (k = setTimeout(b, E.extendedTimeOut), F.maxHideTime = parseFloat(E.extendedTimeOut), F.hideEta = (new Date).getTime() + F.maxHideTime)
                }

                function H() {
                    clearTimeout(k), F.hideEta = 0, I.stop(!0, !0)[E.showMethod]({
                        duration: E.showDuration,
                        easing: E.showEasing
                    })
                }

                function x() {
                    var e = (F.hideEta - (new Date).getTime()) / F.maxHideTime * 100;
                    q.width(e + "%")
                }

                var E = m(), y = t.iconClass || E.iconClass;
                if ("undefined" != typeof t.optionsOverride && (E = e.extend(E, t.optionsOverride), y = t.optionsOverride.iconClass || y), !O(E, t)) {
                    T++, v = n(E, !0);
                    var k = null, I = e("<div/>"), M = e("<div/>"), B = e("<div/>"), q = e("<div/>"),
                        j = e(E.closeHtml), F = {intervalId: null, hideEta: null, maxHideTime: null},
                        P = {toastId: T, state: "visible", startTime: new Date, options: E, map: t};
                    return s(), r(), a(), f(P), E.debug && console && console.log(P), I
                }
            }

            function m() {
                return e.extend({}, p(), b.options)
            }

            function h(e) {
                v || (v = n()), e.is(":visible") || (e.remove(), e = null, 0 === v.children().length && (v.remove(), w = void 0))
            }

            var v, C, w, T = 0, O = {error: "error", info: "info", success: "success", warning: "warning"}, b = {
                clear: r,
                remove: c,
                error: t,
                getContainer: n,
                info: o,
                options: {},
                subscribe: s,
                success: i,
                version: "2.1.3",
                warning: a
            };
            return b
        }()
    })
}("function" == typeof define && define.amd ? define : function (e, t) {
    "undefined" != typeof module && module.exports ? module.exports = t(require("jquery")) : window.toastr = t(window.jQuery)
});
;
/*! RateIt | v1.1.0 / 10/20/2016
    https://github.com/gjunge/rateit.js | Twitter: @gjunge
*/
!function (e) {
    function t(e) {
        var t = e.originalEvent.changedTouches, a = t[0], i = "";
        switch (e.type) {
            case"touchmove":
                i = "mousemove";
                break;
            case"touchend":
                i = "mouseup";
                break;
            default:
                return
        }
        var r = document.createEvent("MouseEvent");
        r.initMouseEvent(i, !0, !0, window, 1, a.screenX, a.screenY, a.clientX, a.clientY, !1, !1, !1, !1, 0, null), a.target.dispatchEvent(r), e.preventDefault()
    }

    e.rateit = {aria: {resetLabel: "reset rating", ratingLabel: "rating"}}, e.fn.rateit = function (a, i) {
        var r = 1, n = {}, s = "init", d = function (e) {
            return e.charAt(0).toUpperCase() + e.substr(1)
        };
        if (0 === this.length) return this;
        var l = e.type(a);
        if ("object" == l || void 0 === a || null === a) n = e.extend({}, e.fn.rateit.defaults, a); else {
            if ("string" == l && "reset" !== a && void 0 === i) return this.data("rateit" + d(a));
            "string" == l && (s = "setvalue")
        }
        return this.each(function () {
            var l = e(this), o = function (e, t) {
                if (null != t) {
                    var a = "aria-value" + ("value" == e ? "now" : e), i = l.find(".rateit-range");
                    void 0 != i.attr(a) && i.attr(a, t)
                }
                return arguments[0] = "rateit" + d(e), l.data.apply(l, arguments)
            };
            if ("reset" == a) {
                var u = o("init");
                for (var v in u) l.data(v, u[v]);
                if (o("backingfld")) {
                    var m = e(o("backingfld"));
                    "SELECT" == m[0].nodeName && "index" === m[0].getAttribute("data-rateit-valuesrc") ? m.prop("selectedIndex", o("value")) : m.val(o("value")), m.trigger("change"), m[0].min && (m[0].min = o("min")), m[0].max && (m[0].max = o("max")), m[0].step && (m[0].step = o("step"))
                }
                l.trigger("reset")
            }
            l.hasClass("rateit") || l.addClass("rateit");
            var h = "rtl" != l.css("direction");
            if ("setvalue" == s) {
                if (!o("init")) throw"Can't set value before init";
                if ("readonly" != a || 1 != i || o("readonly") || (l.find(".rateit-range").unbind(), o("wired", !1)), "value" == a && (i = null == i ? o("min") : Math.max(o("min"), Math.min(o("max"), i))), o("backingfld")) {
                    var m = e(o("backingfld"));
                    "SELECT" == m[0].nodeName && "index" === m[0].getAttribute("data-rateit-valuesrc") ? "value" == a && m.prop("selectedIndex", i) : "value" == a && m.val(i), "min" == a && m[0].min && (m[0].min = i), "max" == a && m[0].max && (m[0].max = i), "step" == a && m[0].step && (m[0].step = i)
                }
                o(a, i)
            }
            if (!o("init")) {
                if (o("mode", o("mode") || n.mode), o("icon", o("icon") || n.icon), o("min", isNaN(o("min")) ? n.min : o("min")), o("max", isNaN(o("max")) ? n.max : o("max")), o("step", o("step") || n.step), o("readonly", void 0 !== o("readonly") ? o("readonly") : n.readonly), o("resetable", void 0 !== o("resetable") ? o("resetable") : n.resetable), o("backingfld", o("backingfld") || n.backingfld), o("starwidth", o("starwidth") || n.starwidth), o("starheight", o("starheight") || n.starheight), o("value", Math.max(o("min"), Math.min(o("max"), isNaN(o("value")) ? isNaN(n.value) ? n.min : n.value : o("value")))), o("ispreset", void 0 !== o("ispreset") ? o("ispreset") : n.ispreset), o("backingfld")) {
                    var m = e(o("backingfld")).hide();
                    if ((m.attr("disabled") || m.attr("readonly")) && o("readonly", !0), "INPUT" == m[0].nodeName && ("range" != m[0].type && "text" != m[0].type || (o("min", parseInt(m.attr("min")) || o("min")), o("max", parseInt(m.attr("max")) || o("max")), o("step", parseInt(m.attr("step")) || o("step")))), "SELECT" == m[0].nodeName && m[0].options.length > 1) {
                        "index" === m[0].getAttribute("data-rateit-valuesrc") ? (o("min", isNaN(o("min")) ? Number(m[0].options[0].index) : o("min")), o("max", Number(m[0].options[m[0].length - 1].index)), o("step", Number(m[0].options[1].index) - Number(m[0].options[0].index))) : (o("min", isNaN(o("min")) ? Number(m[0].options[0].value) : o("min")), o("max", Number(m[0].options[m[0].length - 1].value)), o("step", Number(m[0].options[1].value) - Number(m[0].options[0].value)));
                        var c = m.find("option[selected]");
                        1 == c.length && ("index" === m[0].getAttribute("data-rateit-valuesrc") ? o("value", c[0].index) : o("value", c.val()))
                    } else o("value", m.val())
                }
                var g = "DIV" == l[0].nodeName ? "div" : "span";
                r++;
                var f = '<button id="rateit-reset-{{index}}" type="button" data-role="none" class="rateit-reset" aria-label="' + e.rateit.aria.resetLabel + '" aria-controls="rateit-range-{{index}}"><span></span></button><{{element}} id="rateit-range-{{index}}" class="rateit-range" tabindex="0" role="slider" aria-label="' + e.rateit.aria.ratingLabel + '" aria-owns="rateit-reset-{{index}}" aria-valuemin="' + o("min") + '" aria-valuemax="' + o("max") + '" aria-valuenow="' + o("value") + '"><{{element}} class="rateit-empty"></{{element}}><{{element}} class="rateit-selected"></{{element}}><{{element}} class="rateit-hover"></{{element}}></{{element}}>';
                l.append(f.replace(/{{index}}/gi, r).replace(/{{element}}/gi, g)), h || (l.find(".rateit-reset").css("float", "right"), l.find(".rateit-selected").addClass("rateit-selected-rtl"), l.find(".rateit-hover").addClass("rateit-hover-rtl")), "font" == o("mode") ? l.addClass("rateit-font").removeClass("rateit-bg") : l.addClass("rateit-bg").removeClass("rateit-font"), o("init", JSON.parse(JSON.stringify(l.data())))
            }
            var p = "font" == o("mode");
            p || l.find(".rateit-selected, .rateit-hover").height(o("starheight"));
            var b = l.find(".rateit-range");
            if (p) {
                for (var x = o("icon"), w = o("max") - o("min"), N = "", y = 0; y < w; y++) N += x;
                b.find("> *").text(N), o("starwidth", b.width() / (o("max") - o("min")))
            } else b.width(o("starwidth") * (o("max") - o("min"))).height(o("starheight"));
            var C = "rateit-preset" + (h ? "" : "-rtl");
            if (o("ispreset") ? l.find(".rateit-selected").addClass(C) : l.find(".rateit-selected").removeClass(C), null != o("value")) {
                var k = (o("value") - o("min")) * o("starwidth");
                l.find(".rateit-selected").width(k)
            }
            var E = l.find(".rateit-reset");
            E.data("wired") !== !0 && E.bind("click", function (t) {
                t.preventDefault(), E.blur();
                var a = e.Event("beforereset");
                return l.trigger(a), !a.isDefaultPrevented() && (l.rateit("value", null), void l.trigger("reset"))
            }).data("wired", !0);
            var M = function (t, a) {
                var i = a.changedTouches ? a.changedTouches[0].pageX : a.pageX, r = i - e(t).offset().left;
                return h || (r = b.width() - r), r > b.width() && (r = b.width()), r < 0 && (r = 0), k = Math.ceil(r / o("starwidth") * (1 / o("step")))
            }, I = function (e) {
                var t = e * o("starwidth") * o("step"), a = b.find(".rateit-hover");
                if (a.data("width") != t) {
                    b.find(".rateit-selected").hide(), a.width(t).show().data("width", t);
                    var i = [e * o("step") + o("min")];
                    l.trigger("hover", i).trigger("over", i)
                }
            }, L = function (t) {
                var a = e.Event("beforerated");
                return l.trigger(a, [t]), !a.isDefaultPrevented() && (o("value", t), o("backingfld") && ("SELECT" == m[0].nodeName && "index" === m[0].getAttribute("data-rateit-valuesrc") ? e(o("backingfld")).prop("selectedIndex", t).trigger("change") : e(o("backingfld")).val(t).trigger("change")), o("ispreset") && (b.find(".rateit-selected").removeClass(C), o("ispreset", !1)), b.find(".rateit-hover").hide(), b.find(".rateit-selected").width(t * o("starwidth") - o("min") * o("starwidth")).show(), l.trigger("hover", [null]).trigger("over", [null]).trigger("rated", [t]), !0)
            };
            o("readonly") ? E.hide() : (o("resetable") || E.hide(), o("wired") || (b.bind("touchmove touchend", t), b.mousemove(function (e) {
                var t = M(this, e);
                I(t)
            }), b.mouseleave(function (e) {
                b.find(".rateit-hover").hide().width(0).data("width", ""), l.trigger("hover", [null]).trigger("over", [null]), b.find(".rateit-selected").show()
            }), b.mouseup(function (e) {
                var t = M(this, e), a = t * o("step") + o("min");
                L(a), b.blur()
            }), b.keyup(function (e) {
                38 != e.which && e.which != (h ? 39 : 37) || L(Math.min(o("value") + o("step"), o("max"))), 40 != e.which && e.which != (h ? 37 : 39) || L(Math.max(o("value") - o("step"), o("min")))
            }), o("wired", !0)), o("resetable") && E.show()), b.attr("aria-readonly", o("readonly"))
        })
    }, e.fn.rateit.defaults = {
        min: 0,
        max: 5,
        step: .5,
        mode: "bg",
        icon: "★",
        starwidth: 16,
        starheight: 16,
        readonly: !1,
        resetable: !0,
        ispreset: !1
    }, e(function () {
        e("div.rateit, span.rateit").rateit()
    })
}(jQuery);
;
/*! jssocials - v1.4.0 - 2016-10-10
* http://js-socials.com
* Copyright (c) 2016 Artem Tabalin; Licensed MIT */
!function (a, b, c) {
    function d(a, c) {
        var d = b(a);
        d.data(f, this), this._$element = d, this.shares = [], this._init(c), this._render()
    }

    var e = "JSSocials", f = e, g = function (a, c) {
            return b.isFunction(a) ? a.apply(c, b.makeArray(arguments).slice(2)) : a
        }, h = /(\.(jpeg|png|gif|bmp|svg)$|^data:image\/(jpeg|png|gif|bmp|svg\+xml);base64)/i,
        i = /(&?[a-zA-Z0-9]+=)?\{([a-zA-Z0-9]+)\}/g, j = {G: 1e9, M: 1e6, K: 1e3}, k = {};
    d.prototype = {
        url: "",
        text: "",
        shareIn: "blank",
        showLabel: function (a) {
            return this.showCount === !1 ? a > this.smallScreenWidth : a >= this.largeScreenWidth
        },
        showCount: function (a) {
            return a <= this.smallScreenWidth ? "inside" : !0
        },
        smallScreenWidth: 640,
        largeScreenWidth: 1024,
        resizeTimeout: 200,
        elementClass: "jssocials",
        sharesClass: "jssocials-shares",
        shareClass: "jssocials-share",
        shareButtonClass: "jssocials-share-button",
        shareLinkClass: "jssocials-share-link",
        shareLogoClass: "jssocials-share-logo",
        shareLabelClass: "jssocials-share-label",
        shareLinkCountClass: "jssocials-share-link-count",
        shareCountBoxClass: "jssocials-share-count-box",
        shareCountClass: "jssocials-share-count",
        shareZeroCountClass: "jssocials-share-no-count",
        _init: function (a) {
            this._initDefaults(), b.extend(this, a), this._initShares(), this._attachWindowResizeCallback()
        },
        _initDefaults: function () {
            this.url = a.location.href, this.text = b.trim(b("meta[name=description]").attr("content") || b("title").text())
        },
        _initShares: function () {
            this.shares = b.map(this.shares, b.proxy(function (a) {
                "string" == typeof a && (a = {share: a});
                var c = a.share && k[a.share];
                if (!c && !a.renderer) throw Error("Share '" + a.share + "' is not found");
                return b.extend({url: this.url, text: this.text}, c, a)
            }, this))
        },
        _attachWindowResizeCallback: function () {
            b(a).on("resize", b.proxy(this._windowResizeHandler, this))
        },
        _detachWindowResizeCallback: function () {
            b(a).off("resize", this._windowResizeHandler)
        },
        _windowResizeHandler: function () {
            (b.isFunction(this.showLabel) || b.isFunction(this.showCount)) && (a.clearTimeout(this._resizeTimer), this._resizeTimer = setTimeout(b.proxy(this.refresh, this), this.resizeTimeout))
        },
        _render: function () {
            this._clear(), this._defineOptionsByScreen(), this._$element.addClass(this.elementClass), this._$shares = b("<div>").addClass(this.sharesClass).appendTo(this._$element), this._renderShares()
        },
        _defineOptionsByScreen: function () {
            this._screenWidth = b(a).width(), this._showLabel = g(this.showLabel, this, this._screenWidth), this._showCount = g(this.showCount, this, this._screenWidth)
        },
        _renderShares: function () {
            b.each(this.shares, b.proxy(function (a, b) {
                this._renderShare(b)
            }, this))
        },
        _renderShare: function (a) {
            var c;
            c = b.isFunction(a.renderer) ? b(a.renderer()) : this._createShare(a), c.addClass(this.shareClass).addClass(a.share ? "jssocials-share-" + a.share : "").addClass(a.css).appendTo(this._$shares)
        },
        _createShare: function (a) {
            var c = b("<div>"), d = this._createShareLink(a).appendTo(c);
            if (this._showCount) {
                var e = "inside" === this._showCount,
                    f = e ? d : b("<div>").addClass(this.shareCountBoxClass).appendTo(c);
                f.addClass(e ? this.shareLinkCountClass : this.shareCountBoxClass), this._renderShareCount(a, f)
            }
            return c
        },
        _createShareLink: function (a) {
            var c = this._getShareStrategy(a), d = c.call(a, {shareUrl: this._getShareUrl(a)});
            return d.addClass(this.shareLinkClass).append(this._createShareLogo(a)), this._showLabel && d.append(this._createShareLabel(a)), b.each(this.on || {}, function (c, e) {
                b.isFunction(e) && d.on(c, b.proxy(e, a))
            }), d
        },
        _getShareStrategy: function (a) {
            var b = m[a.shareIn || this.shareIn];
            if (!b) throw Error("Share strategy '" + this.shareIn + "' not found");
            return b
        },
        _getShareUrl: function (a) {
            var b = g(a.shareUrl, a);
            return this._formatShareUrl(b, a)
        },
        _createShareLogo: function (a) {
            var c = a.logo, d = h.test(c) ? b("<img>").attr("src", a.logo) : b("<i>").addClass(c);
            return d.addClass(this.shareLogoClass), d
        },
        _createShareLabel: function (a) {
            return b("<span>").addClass(this.shareLabelClass).text(a.label)
        },
        _renderShareCount: function (a, c) {
            var d = b("<span>").addClass(this.shareCountClass);
            c.addClass(this.shareZeroCountClass).append(d), this._loadCount(a).done(b.proxy(function (a) {
                a && (c.removeClass(this.shareZeroCountClass), d.text(a))
            }, this))
        },
        _loadCount: function (a) {
            var c = b.Deferred(), d = this._getCountUrl(a);
            if (!d) return c.resolve(0).promise();
            var e = b.proxy(function (b) {
                c.resolve(this._getCountValue(b, a))
            }, this);
            return b.getJSON(d).done(e).fail(function () {
                b.get(d).done(e).fail(function () {
                    c.resolve(0)
                })
            }), c.promise()
        },
        _getCountUrl: function (a) {
            var b = g(a.countUrl, a);
            return this._formatShareUrl(b, a)
        },
        _getCountValue: function (a, c) {
            var d = (b.isFunction(c.getCount) ? c.getCount(a) : a) || 0;
            return "string" == typeof d ? d : this._formatNumber(d)
        },
        _formatNumber: function (a) {
            return b.each(j, function (b, c) {
                return a >= c ? (a = parseFloat((a / c).toFixed(2)) + b, !1) : void 0
            }), a
        },
        _formatShareUrl: function (b, c) {
            return b.replace(i, function (b, d, e) {
                var f = c[e] || "";
                return f ? (d || "") + a.encodeURIComponent(f) : ""
            })
        },
        _clear: function () {
            a.clearTimeout(this._resizeTimer), this._$element.empty()
        },
        _passOptionToShares: function (a, c) {
            var d = this.shares;
            b.each(["url", "text"], function (e, f) {
                f === a && b.each(d, function (b, d) {
                    d[a] = c
                })
            })
        },
        _normalizeShare: function (a) {
            return b.isNumeric(a) ? this.shares[a] : "string" == typeof a ? b.grep(this.shares, function (b) {
                return b.share === a
            })[0] : a
        },
        refresh: function () {
            this._render()
        },
        destroy: function () {
            this._clear(), this._detachWindowResizeCallback(), this._$element.removeClass(this.elementClass).removeData(f)
        },
        option: function (a, b) {
            return 1 === arguments.length ? this[a] : (this[a] = b, this._passOptionToShares(a, b), void this.refresh())
        },
        shareOption: function (a, b, c) {
            return a = this._normalizeShare(a), 2 === arguments.length ? a[b] : (a[b] = c, void this.refresh())
        }
    }, b.fn.jsSocials = function (a) {
        var e = b.makeArray(arguments), g = e.slice(1), h = this;
        return this.each(function () {
            var e, i = b(this), j = i.data(f);
            if (j) if ("string" == typeof a) {
                if (e = j[a].apply(j, g), e !== c && e !== j) return h = e, !1
            } else j._detachWindowResizeCallback(), j._init(a), j._render(); else new d(i, a)
        }), h
    };
    var l = function (a) {
        var c;
        b.isPlainObject(a) ? c = d.prototype : (c = k[a], a = arguments[1] || {}), b.extend(c, a)
    }, m = {
        popup: function (c) {
            return b("<a>").attr("href", "#").on("click", function () {
                return a.open(c.shareUrl, null, "width=600, height=400, location=0, menubar=0, resizeable=0, scrollbars=0, status=0, titlebar=0, toolbar=0"), !1
            })
        }, blank: function (a) {
            return b("<a>").attr({target: "_blank", href: a.shareUrl})
        }, self: function (a) {
            return b("<a>").attr({target: "_self", href: a.shareUrl})
        }
    };
    a.jsSocials = {Socials: d, shares: k, shareStrategies: m, setDefaults: l}
}(window, jQuery), function (a, b, c) {
    b.extend(c.shares, {
        email: {
            label: "E-mail",
            logo: "fa fa-at",
            shareUrl: "mailto:{to}?subject={text}&body={url}",
            countUrl: "",
            shareIn: "self"
        },
        twitter: {
            label: "Tweet",
            logo: "fa fa-twitter",
            shareUrl: "https://twitter.com/share?url={url}&text={text}&via={via}&hashtags={hashtags}",
            countUrl: ""
        },
        facebook: {
            label: "Like",
            logo: "fa fa-facebook",
            shareUrl: "https://facebook.com/sharer/sharer.php?u={url}",
            countUrl: "https://graph.facebook.com/?id={url}",
            getCount: function (a) {
                return a.share && a.share.share_count || 0
            }
        },
        vkontakte: {
            label: "Like",
            logo: "fa fa-vk",
            shareUrl: "https://vk.com/share.php?url={url}&title={title}&description={text}",
            countUrl: "https://vk.com/share.php?act=count&index=1&url={url}",
            getCount: function (a) {
                return parseInt(a.slice(15, -2).split(", ")[1])
            }
        },
        googleplus: {
            label: "+1",
            logo: "fa fa-google",
            shareUrl: "https://plus.google.com/share?url={url}",
            countUrl: ""
        },
        linkedin: {
            label: "Share",
            logo: "fa fa-linkedin",
            shareUrl: "https://www.linkedin.com/shareArticle?mini=true&url={url}",
            countUrl: "https://www.linkedin.com/countserv/count/share?format=jsonp&url={url}&callback=?",
            getCount: function (a) {
                return a.count
            }
        },
        pinterest: {
            label: "Pin it",
            logo: "fa fa-pinterest",
            shareUrl: "https://pinterest.com/pin/create/bookmarklet/?media={media}&url={url}&description={text}",
            countUrl: "https://api.pinterest.com/v1/urls/count.json?&url={url}&callback=?",
            getCount: function (a) {
                return a.count
            }
        },
        stumbleupon: {
            label: "Share",
            logo: "fa fa-stumbleupon",
            shareUrl: "http://www.stumbleupon.com/submit?url={url}&title={title}",
            countUrl: "https://cors-anywhere.herokuapp.com/https://www.stumbleupon.com/services/1.01/badge.getinfo?url={url}",
            getCount: function (a) {
                return a.result.views
            }
        },
        telegram: {
            label: "Telegram",
            logo: "fa fa-paper-plane",
            shareUrl: "tg://msg?text={url} {text}",
            countUrl: "",
            shareIn: "self"
        },
        whatsapp: {
            label: "WhatsApp",
            logo: "fa fa-whatsapp",
            shareUrl: "whatsapp://send?text={url} {text}",
            countUrl: "",
            shareIn: "self"
        },
        line: {label: "LINE", logo: "fa fa-comment", shareUrl: "http://line.me/R/msg/text/?{text} {url}", countUrl: ""},
        viber: {
            label: "Viber",
            logo: "fa fa-volume-control-phone",
            shareUrl: "viber://forward?text={url} {text}",
            countUrl: "",
            shareIn: "self"
        },
        pocket: {
            label: "Pocket",
            logo: "fa fa-get-pocket",
            shareUrl: "https://getpocket.com/save?url={url}&title={title}",
            countUrl: ""
        },
        messenger: {
            label: "Share",
            logo: "fa fa-commenting",
            shareUrl: "fb-messenger://share?link={url}",
            countUrl: "",
            shareIn: "self"
        }
    })
}(window, jQuery, window.jsSocials);
!function (e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], e) : e("undefined" != typeof jQuery ? jQuery : window.Zepto)
}(function (e) {
    "use strict";

    function t(t) {
        var r = t.data;
        t.isDefaultPrevented() || (t.preventDefault(), e(t.target).ajaxSubmit(r))
    }

    function r(t) {
        var r = t.target, a = e(r);
        if (!a.is("[type=submit],[type=image]")) {
            var n = a.closest("[type=submit]");
            if (0 === n.length) return;
            r = n[0]
        }
        var i = this;
        if (i.clk = r, "image" == r.type) if (void 0 !== t.offsetX) i.clk_x = t.offsetX, i.clk_y = t.offsetY; else if ("function" == typeof e.fn.offset) {
            var o = a.offset();
            i.clk_x = t.pageX - o.left, i.clk_y = t.pageY - o.top
        } else i.clk_x = t.pageX - r.offsetLeft, i.clk_y = t.pageY - r.offsetTop;
        setTimeout(function () {
            i.clk = i.clk_x = i.clk_y = null
        }, 100)
    }

    function a() {
        if (e.fn.ajaxSubmit.debug) {
            var t = "[jquery.form] " + Array.prototype.join.call(arguments, "");
            window.console && window.console.log ? window.console.log(t) : window.opera && window.opera.postError && window.opera.postError(t)
        }
    }

    var n = {};
    n.fileapi = void 0 !== e("<input type='file'/>").get(0).files, n.formdata = void 0 !== window.FormData;
    var i = !!e.fn.prop;
    e.fn.attr2 = function () {
        if (!i) return this.attr.apply(this, arguments);
        var e = this.prop.apply(this, arguments);
        return e && e.jquery || "string" == typeof e ? e : this.attr.apply(this, arguments)
    }, e.fn.ajaxSubmit = function (t) {
        function r(r) {
            var a, n, i = e.param(r, t.traditional).split("&"), o = i.length, s = [];
            for (a = 0; o > a; a++) i[a] = i[a].replace(/\+/g, " "), n = i[a].split("="), s.push([decodeURIComponent(n[0]), decodeURIComponent(n[1])]);
            return s
        }

        function o(a) {
            for (var n = new FormData, i = 0; i < a.length; i++) n.append(a[i].name, a[i].value);
            if (t.extraData) {
                var o = r(t.extraData);
                for (i = 0; i < o.length; i++) o[i] && n.append(o[i][0], o[i][1])
            }
            t.data = null;
            var s = e.extend(!0, {}, e.ajaxSettings, t, {
                contentType: !1,
                processData: !1,
                cache: !1,
                type: u || "POST"
            });
            t.uploadProgress && (s.xhr = function () {
                var r = e.ajaxSettings.xhr();
                return r.upload && r.upload.addEventListener("progress", function (e) {
                    var r = 0, a = e.loaded || e.position, n = e.total;
                    e.lengthComputable && (r = Math.ceil(a / n * 100)), t.uploadProgress(e, a, n, r)
                }, !1), r
            }), s.data = null;
            var c = s.beforeSend;
            return s.beforeSend = function (e, r) {
                r.data = t.formData ? t.formData : n, c && c.call(this, e, r)
            }, e.ajax(s)
        }

        function s(r) {
            function n(e) {
                var t = null;
                try {
                    e.contentWindow && (t = e.contentWindow.document)
                } catch (r) {
                    a("cannot get iframe.contentWindow document: " + r)
                }
                if (t) return t;
                try {
                    t = e.contentDocument ? e.contentDocument : e.document
                } catch (r) {
                    a("cannot get iframe.contentDocument: " + r), t = e.document
                }
                return t
            }

            function o() {
                function t() {
                    try {
                        var e = n(g).readyState;
                        a("state = " + e), e && "uninitialized" == e.toLowerCase() && setTimeout(t, 50)
                    } catch (r) {
                        a("Server abort: ", r, " (", r.name, ")"), s(k), j && clearTimeout(j), j = void 0
                    }
                }

                var r = f.attr2("target"), i = f.attr2("action"), o = "multipart/form-data",
                    c = f.attr("enctype") || f.attr("encoding") || o;
                w.setAttribute("target", p), (!u || /post/i.test(u)) && w.setAttribute("method", "POST"), i != m.url && w.setAttribute("action", m.url), m.skipEncodingOverride || u && !/post/i.test(u) || f.attr({
                    encoding: "multipart/form-data",
                    enctype: "multipart/form-data"
                }), m.timeout && (j = setTimeout(function () {
                    T = !0, s(D)
                }, m.timeout));
                var l = [];
                try {
                    if (m.extraData) for (var d in m.extraData) m.extraData.hasOwnProperty(d) && l.push(e.isPlainObject(m.extraData[d]) && m.extraData[d].hasOwnProperty("name") && m.extraData[d].hasOwnProperty("value") ? e('<input type="hidden" name="' + m.extraData[d].name + '">').val(m.extraData[d].value).appendTo(w)[0] : e('<input type="hidden" name="' + d + '">').val(m.extraData[d]).appendTo(w)[0]);
                    m.iframeTarget || v.appendTo("body"), g.attachEvent ? g.attachEvent("onload", s) : g.addEventListener("load", s, !1), setTimeout(t, 15);
                    try {
                        w.submit()
                    } catch (h) {
                        var x = document.createElement("form").submit;
                        x.apply(w)
                    }
                } finally {
                    w.setAttribute("action", i), w.setAttribute("enctype", c), r ? w.setAttribute("target", r) : f.removeAttr("target"), e(l).remove()
                }
            }

            function s(t) {
                if (!x.aborted && !F) {
                    if (M = n(g), M || (a("cannot access response document"), t = k), t === D && x) return x.abort("timeout"), void S.reject(x, "timeout");
                    if (t == k && x) return x.abort("server abort"), void S.reject(x, "error", "server abort");
                    if (M && M.location.href != m.iframeSrc || T) {
                        g.detachEvent ? g.detachEvent("onload", s) : g.removeEventListener("load", s, !1);
                        var r, i = "success";
                        try {
                            if (T) throw"timeout";
                            var o = "xml" == m.dataType || M.XMLDocument || e.isXMLDoc(M);
                            if (a("isXml=" + o), !o && window.opera && (null === M.body || !M.body.innerHTML) && --O) return a("requeing onLoad callback, DOM not available"), void setTimeout(s, 250);
                            var u = M.body ? M.body : M.documentElement;
                            x.responseText = u ? u.innerHTML : null, x.responseXML = M.XMLDocument ? M.XMLDocument : M, o && (m.dataType = "xml"), x.getResponseHeader = function (e) {
                                var t = {"content-type": m.dataType};
                                return t[e.toLowerCase()]
                            }, u && (x.status = Number(u.getAttribute("status")) || x.status, x.statusText = u.getAttribute("statusText") || x.statusText);
                            var c = (m.dataType || "").toLowerCase(), l = /(json|script|text)/.test(c);
                            if (l || m.textarea) {
                                var f = M.getElementsByTagName("textarea")[0];
                                if (f) x.responseText = f.value, x.status = Number(f.getAttribute("status")) || x.status, x.statusText = f.getAttribute("statusText") || x.statusText; else if (l) {
                                    var p = M.getElementsByTagName("pre")[0], h = M.getElementsByTagName("body")[0];
                                    p ? x.responseText = p.textContent ? p.textContent : p.innerText : h && (x.responseText = h.textContent ? h.textContent : h.innerText)
                                }
                            } else "xml" == c && !x.responseXML && x.responseText && (x.responseXML = X(x.responseText));
                            try {
                                E = _(x, c, m)
                            } catch (y) {
                                i = "parsererror", x.error = r = y || i
                            }
                        } catch (y) {
                            a("error caught: ", y), i = "error", x.error = r = y || i
                        }
                        x.aborted && (a("upload aborted"), i = null), x.status && (i = x.status >= 200 && x.status < 300 || 304 === x.status ? "success" : "error"), "success" === i ? (m.success && m.success.call(m.context, E, "success", x), S.resolve(x.responseText, "success", x), d && e.event.trigger("ajaxSuccess", [x, m])) : i && (void 0 === r && (r = x.statusText), m.error && m.error.call(m.context, x, i, r), S.reject(x, "error", r), d && e.event.trigger("ajaxError", [x, m, r])), d && e.event.trigger("ajaxComplete", [x, m]), d && !--e.active && e.event.trigger("ajaxStop"), m.complete && m.complete.call(m.context, x, i), F = !0, m.timeout && clearTimeout(j), setTimeout(function () {
                            m.iframeTarget ? v.attr("src", m.iframeSrc) : v.remove(), x.responseXML = null
                        }, 100)
                    }
                }
            }

            var c, l, m, d, p, v, g, x, y, b, T, j, w = f[0], S = e.Deferred();
            if (S.abort = function (e) {
                x.abort(e)
            }, r) for (l = 0; l < h.length; l++) c = e(h[l]), i ? c.prop("disabled", !1) : c.removeAttr("disabled");
            if (m = e.extend(!0, {}, e.ajaxSettings, t), m.context = m.context || m, p = "jqFormIO" + (new Date).getTime(), m.iframeTarget ? (v = e(m.iframeTarget), b = v.attr2("name"), b ? p = b : v.attr2("name", p)) : (v = e('<iframe name="' + p + '" src="' + m.iframeSrc + '" />'), v.css({
                position: "absolute",
                top: "-1000px",
                left: "-1000px"
            })), g = v[0], x = {
                aborted: 0,
                responseText: null,
                responseXML: null,
                status: 0,
                statusText: "n/a",
                getAllResponseHeaders: function () {
                },
                getResponseHeader: function () {
                },
                setRequestHeader: function () {
                },
                abort: function (t) {
                    var r = "timeout" === t ? "timeout" : "aborted";
                    a("aborting upload... " + r), this.aborted = 1;
                    try {
                        g.contentWindow.document.execCommand && g.contentWindow.document.execCommand("Stop")
                    } catch (n) {
                    }
                    v.attr("src", m.iframeSrc), x.error = r, m.error && m.error.call(m.context, x, r, t), d && e.event.trigger("ajaxError", [x, m, r]), m.complete && m.complete.call(m.context, x, r)
                }
            }, d = m.global, d && 0 === e.active++ && e.event.trigger("ajaxStart"), d && e.event.trigger("ajaxSend", [x, m]), m.beforeSend && m.beforeSend.call(m.context, x, m) === !1) return m.global && e.active--, S.reject(), S;
            if (x.aborted) return S.reject(), S;
            y = w.clk, y && (b = y.name, b && !y.disabled && (m.extraData = m.extraData || {}, m.extraData[b] = y.value, "image" == y.type && (m.extraData[b + ".x"] = w.clk_x, m.extraData[b + ".y"] = w.clk_y)));
            var D = 1, k = 2, A = e("meta[name=csrf-token]").attr("content"),
                L = e("meta[name=csrf-param]").attr("content");
            L && A && (m.extraData = m.extraData || {}, m.extraData[L] = A), m.forceSync ? o() : setTimeout(o, 10);
            var E, M, F, O = 50, X = e.parseXML || function (e, t) {
                return window.ActiveXObject ? (t = new ActiveXObject("Microsoft.XMLDOM"), t.async = "false", t.loadXML(e)) : t = (new DOMParser).parseFromString(e, "text/xml"), t && t.documentElement && "parsererror" != t.documentElement.nodeName ? t : null
            }, C = e.parseJSON || function (e) {
                return window.eval("(" + e + ")")
            }, _ = function (t, r, a) {
                var n = t.getResponseHeader("content-type") || "", i = "xml" === r || !r && n.indexOf("xml") >= 0,
                    o = i ? t.responseXML : t.responseText;
                return i && "parsererror" === o.documentElement.nodeName && e.error && e.error("parsererror"), a && a.dataFilter && (o = a.dataFilter(o, r)), "string" == typeof o && ("json" === r || !r && n.indexOf("json") >= 0 ? o = C(o) : ("script" === r || !r && n.indexOf("javascript") >= 0) && e.globalEval(o)), o
            };
            return S
        }

        if (!this.length) return a("ajaxSubmit: skipping submit process - no element selected"), this;
        var u, c, l, f = this;
        "function" == typeof t ? t = {success: t} : void 0 === t && (t = {}), u = t.type || this.attr2("method"), c = t.url || this.attr2("action"), l = "string" == typeof c ? e.trim(c) : "", l = l || window.location.href || "", l && (l = (l.match(/^([^#]+)/) || [])[1]), t = e.extend(!0, {
            url: l,
            success: e.ajaxSettings.success,
            type: u || e.ajaxSettings.type,
            iframeSrc: /^https/i.test(window.location.href || "") ? "javascript:false" : "about:blank"
        }, t);
        var m = {};
        if (this.trigger("form-pre-serialize", [this, t, m]), m.veto) return a("ajaxSubmit: submit vetoed via form-pre-serialize trigger"), this;
        if (t.beforeSerialize && t.beforeSerialize(this, t) === !1) return a("ajaxSubmit: submit aborted via beforeSerialize callback"), this;
        var d = t.traditional;
        void 0 === d && (d = e.ajaxSettings.traditional);
        var p, h = [], v = this.formToArray(t.semantic, h);
        if (t.data && (t.extraData = t.data, p = e.param(t.data, d)), t.beforeSubmit && t.beforeSubmit(v, this, t) === !1) return a("ajaxSubmit: submit aborted via beforeSubmit callback"), this;
        if (this.trigger("form-submit-validate", [v, this, t, m]), m.veto) return a("ajaxSubmit: submit vetoed via form-submit-validate trigger"), this;
        var g = e.param(v, d);
        p && (g = g ? g + "&" + p : p), "GET" == t.type.toUpperCase() ? (t.url += (t.url.indexOf("?") >= 0 ? "&" : "?") + g, t.data = null) : t.data = g;
        var x = [];
        if (t.resetForm && x.push(function () {
            f.resetForm()
        }), t.clearForm && x.push(function () {
            f.clearForm(t.includeHidden)
        }), !t.dataType && t.target) {
            var y = t.success || function () {
            };
            x.push(function (r) {
                var a = t.replaceTarget ? "replaceWith" : "html";
                e(t.target)[a](r).each(y, arguments)
            })
        } else t.success && x.push(t.success);
        if (t.success = function (e, r, a) {
            for (var n = t.context || this, i = 0, o = x.length; o > i; i++) x[i].apply(n, [e, r, a || f, f])
        }, t.error) {
            var b = t.error;
            t.error = function (e, r, a) {
                var n = t.context || this;
                b.apply(n, [e, r, a, f])
            }
        }
        if (t.complete) {
            var T = t.complete;
            t.complete = function (e, r) {
                var a = t.context || this;
                T.apply(a, [e, r, f])
            }
        }
        var j = e("input[type=file]:enabled", this).filter(function () {
                return "" !== e(this).val()
            }), w = j.length > 0, S = "multipart/form-data", D = f.attr("enctype") == S || f.attr("encoding") == S,
            k = n.fileapi && n.formdata;
        a("fileAPI :" + k);
        var A, L = (w || D) && !k;
        t.iframe !== !1 && (t.iframe || L) ? t.closeKeepAlive ? e.get(t.closeKeepAlive, function () {
            A = s(v)
        }) : A = s(v) : A = (w || D) && k ? o(v) : e.ajax(t), f.removeData("jqxhr").data("jqxhr", A);
        for (var E = 0; E < h.length; E++) h[E] = null;
        return this.trigger("form-submit-notify", [this, t]), this
    }, e.fn.ajaxForm = function (n) {
        if (n = n || {}, n.delegation = n.delegation && e.isFunction(e.fn.on), !n.delegation && 0 === this.length) {
            var i = {s: this.selector, c: this.context};
            return !e.isReady && i.s ? (a("DOM not ready, queuing ajaxForm"), e(function () {
                e(i.s, i.c).ajaxForm(n)
            }), this) : (a("terminating; zero elements found by selector" + (e.isReady ? "" : " (DOM not ready)")), this)
        }
        return n.delegation ? (e(document).off("submit.form-plugin", this.selector, t).off("click.form-plugin", this.selector, r).on("submit.form-plugin", this.selector, n, t).on("click.form-plugin", this.selector, n, r), this) : this.ajaxFormUnbind().bind("submit.form-plugin", n, t).bind("click.form-plugin", n, r)
    }, e.fn.ajaxFormUnbind = function () {
        return this.unbind("submit.form-plugin click.form-plugin")
    }, e.fn.formToArray = function (t, r) {
        var a = [];
        if (0 === this.length) return a;
        var i, o = this[0], s = this.attr("id"), u = t ? o.getElementsByTagName("*") : o.elements;
        if (u && !/MSIE [678]/.test(navigator.userAgent) && (u = e(u).get()), s && (i = e(':input[form="' + s + '"]').get(), i.length && (u = (u || []).concat(i))), !u || !u.length) return a;
        var c, l, f, m, d, p, h;
        for (c = 0, p = u.length; p > c; c++) if (d = u[c], f = d.name, f && !d.disabled) if (t && o.clk && "image" == d.type) o.clk == d && (a.push({
            name: f,
            value: e(d).val(),
            type: d.type
        }), a.push({name: f + ".x", value: o.clk_x}, {
            name: f + ".y",
            value: o.clk_y
        })); else if (m = e.fieldValue(d, !0), m && m.constructor == Array) for (r && r.push(d), l = 0, h = m.length; h > l; l++) a.push({
            name: f,
            value: m[l]
        }); else if (n.fileapi && "file" == d.type) {
            r && r.push(d);
            var v = d.files;
            if (v.length) for (l = 0; l < v.length; l++) a.push({
                name: f,
                value: v[l],
                type: d.type
            }); else a.push({name: f, value: "", type: d.type})
        } else null !== m && "undefined" != typeof m && (r && r.push(d), a.push({
            name: f,
            value: m,
            type: d.type,
            required: d.required
        }));
        if (!t && o.clk) {
            var g = e(o.clk), x = g[0];
            f = x.name, f && !x.disabled && "image" == x.type && (a.push({
                name: f,
                value: g.val()
            }), a.push({name: f + ".x", value: o.clk_x}, {name: f + ".y", value: o.clk_y}))
        }
        return a
    }, e.fn.formSerialize = function (t) {
        return e.param(this.formToArray(t))
    }, e.fn.fieldSerialize = function (t) {
        var r = [];
        return this.each(function () {
            var a = this.name;
            if (a) {
                var n = e.fieldValue(this, t);
                if (n && n.constructor == Array) for (var i = 0, o = n.length; o > i; i++) r.push({
                    name: a,
                    value: n[i]
                }); else null !== n && "undefined" != typeof n && r.push({name: this.name, value: n})
            }
        }), e.param(r)
    }, e.fn.fieldValue = function (t) {
        for (var r = [], a = 0, n = this.length; n > a; a++) {
            var i = this[a], o = e.fieldValue(i, t);
            null === o || "undefined" == typeof o || o.constructor == Array && !o.length || (o.constructor == Array ? e.merge(r, o) : r.push(o))
        }
        return r
    }, e.fieldValue = function (t, r) {
        var a = t.name, n = t.type, i = t.tagName.toLowerCase();
        if (void 0 === r && (r = !0), r && (!a || t.disabled || "reset" == n || "button" == n || ("checkbox" == n || "radio" == n) && !t.checked || ("submit" == n || "image" == n) && t.form && t.form.clk != t || "select" == i && -1 == t.selectedIndex)) return null;
        if ("select" == i) {
            var o = t.selectedIndex;
            if (0 > o) return null;
            for (var s = [], u = t.options, c = "select-one" == n, l = c ? o + 1 : u.length, f = c ? o : 0; l > f; f++) {
                var m = u[f];
                if (m.selected) {
                    var d = m.value;
                    if (d || (d = m.attributes && m.attributes.value && !m.attributes.value.specified ? m.text : m.value), c) return d;
                    s.push(d)
                }
            }
            return s
        }
        return e(t).val()
    }, e.fn.clearForm = function (t) {
        return this.each(function () {
            e("input,select,textarea", this).clearFields(t)
        })
    }, e.fn.clearFields = e.fn.clearInputs = function (t) {
        var r = /^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;
        return this.each(function () {
            var a = this.type, n = this.tagName.toLowerCase();
            r.test(a) || "textarea" == n ? this.value = "" : "checkbox" == a || "radio" == a ? this.checked = !1 : "select" == n ? this.selectedIndex = -1 : "file" == a ? /MSIE/.test(navigator.userAgent) ? e(this).replaceWith(e(this).clone(!0)) : e(this).val("") : t && (t === !0 && /hidden/.test(a) || "string" == typeof t && e(this).is(t)) && (this.value = "")
        })
    }, e.fn.resetForm = function () {
        return this.each(function () {
            ("function" == typeof this.reset || "object" == typeof this.reset && !this.reset.nodeType) && this.reset()
        })
    }, e.fn.enable = function (e) {
        return void 0 === e && (e = !0), this.each(function () {
            this.disabled = !e
        })
    }, e.fn.selected = function (t) {
        return void 0 === t && (t = !0), this.each(function () {
            var r = this.type;
            if ("checkbox" == r || "radio" == r) this.checked = t; else if ("option" == this.tagName.toLowerCase()) {
                var a = e(this).parent("select");
                t && a[0] && "select-one" == a[0].type && a.find("option").selected(!1), this.selected = t
            }
        })
    }, e.fn.ajaxSubmit.debug = !1
});
(function () {
    var b, f;
    b = this.jQuery || window.jQuery;
    f = b(window);
    b.fn.stick_in_parent = function (d) {
        var A, w, J, n, B, K, p, q, k, E, t;
        null == d && (d = {});
        t = d.sticky_class;
        B = d.inner_scrolling;
        E = d.recalc_every;
        k = d.parent;
        q = d.offset_top;
        p = d.spacer;
        w = d.bottoming;
        null == q && (q = 0);
        null == k && (k = void 0);
        null == B && (B = !0);
        null == t && (t = "is_stuck");
        A = b(document);
        null == w && (w = !0);
        J = function (a, d, n, C, F, u, r, G) {
            var v, H, m, D, I, c, g, x, y, z, h, l;
            if (!a.data("sticky_kit")) {
                a.data("sticky_kit", !0);
                I = A.height();
                g = a.parent();
                null != k && (g = g.closest(k));
                if (!g.length) throw"failed to find stick parent";
                v = m = !1;
                (h = null != p ? p && a.closest(p) : b("<div />")) && h.css("position", a.css("position"));
                x = function () {
                    var c, f, e;
                    if (!G && (I = A.height(), c = parseInt(g.css("border-top-width"), 10), f = parseInt(g.css("padding-top"), 10), d = parseInt(g.css("padding-bottom"), 10), n = g.offset().top + c + f, C = g.height(), m && (v = m = !1, null == p && (a.insertAfter(h), h.detach()), a.css({
                        position: "",
                        top: "",
                        width: "",
                        bottom: ""
                    }).removeClass(t), e = !0), F = a.offset().top - (parseInt(a.css("margin-top"), 10) || 0) - q, u = a.outerHeight(!0), r = a.css("float"), h && h.css({
                        width: a.outerWidth(!0),
                        height: u,
                        display: a.css("display"),
                        "vertical-align": a.css("vertical-align"),
                        "float": r
                    }), e)) return l()
                };
                x();
                if (u !== C) return D = void 0, c = q, z = E, l = function () {
                    var b, l, e, k;
                    if (!G && (e = !1, null != z && (--z, 0 >= z && (z = E, x(), e = !0)), e || A.height() === I || x(), e = f.scrollTop(), null != D && (l = e - D), D = e, m ? (w && (k = e + u + c > C + n, v && !k && (v = !1, a.css({
                        position: "fixed",
                        bottom: "",
                        top: c
                    }).trigger("sticky_kit:unbottom"))), e < F && (m = !1, c = q, null == p && ("left" !== r && "right" !== r || a.insertAfter(h), h.detach()), b = {
                        position: "",
                        width: "",
                        top: ""
                    }, a.css(b).removeClass(t).trigger("sticky_kit:unstick")), B && (b = f.height(), u + q > b && !v && (c -= l, c = Math.max(b - u, c), c = Math.min(q, c), m && a.css({top: c + "px"})))) : e > F && (m = !0, b = {
                        position: "fixed",
                        top: c
                    }, b.width = "border-box" === a.css("box-sizing") ? a.outerWidth() + "px" : a.width() + "px", a.css(b).addClass(t), null == p && (a.after(h), "left" !== r && "right" !== r || h.append(a)), a.trigger("sticky_kit:stick")), m && w && (null == k && (k = e + u + c > C + n), !v && k))) return v = !0, "static" === g.css("position") && g.css({position: "relative"}), a.css({
                        position: "absolute",
                        bottom: d,
                        top: "auto"
                    }).trigger("sticky_kit:bottom")
                }, y = function () {
                    x();
                    return l()
                }, H = function () {
                    G = !0;
                    f.off("touchmove", l);
                    f.off("scroll", l);
                    f.off("resize", y);
                    b(document.body).off("sticky_kit:recalc", y);
                    a.off("sticky_kit:detach", H);
                    a.removeData("sticky_kit");
                    a.css({position: "", bottom: "", top: "", width: ""});
                    g.position("position", "");
                    if (m) return null == p && ("left" !== r && "right" !== r || a.insertAfter(h), h.remove()), a.removeClass(t)
                }, f.on("touchmove", l), f.on("scroll", l), f.on("resize", y), b(document.body).on("sticky_kit:recalc", y), a.on("sticky_kit:detach", H), setTimeout(l, 0)
            }
        };
        n = 0;
        for (K = this.length; n < K; n++) d = this[n], J(b(d));
        return this
    }
}).call(this);
/*! Select2 4.0.6-rc.1 | https://github.com/select2/select2/blob/master/LICENSE.md */
!function (a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : "object" == typeof module && module.exports ? module.exports = function (b, c) {
        return void 0 === c && (c = "undefined" != typeof window ? require("jquery") : require("jquery")(b)), a(c), c
    } : a(jQuery)
}(function (a) {
    var b = function () {
        if (a && a.fn && a.fn.select2 && a.fn.select2.amd) var b = a.fn.select2.amd;
        var b;
        return function () {
            if (!b || !b.requirejs) {
                b ? c = b : b = {};
                var a, c, d;
                !function (b) {
                    function e(a, b) {
                        return v.call(a, b)
                    }

                    function f(a, b) {
                        var c, d, e, f, g, h, i, j, k, l, m, n, o = b && b.split("/"), p = t.map, q = p && p["*"] || {};
                        if (a) {
                            for (a = a.split("/"), g = a.length - 1, t.nodeIdCompat && x.test(a[g]) && (a[g] = a[g].replace(x, "")), "." === a[0].charAt(0) && o && (n = o.slice(0, o.length - 1), a = n.concat(a)), k = 0; k < a.length; k++) if ("." === (m = a[k])) a.splice(k, 1), k -= 1; else if (".." === m) {
                                if (0 === k || 1 === k && ".." === a[2] || ".." === a[k - 1]) continue;
                                k > 0 && (a.splice(k - 1, 2), k -= 2)
                            }
                            a = a.join("/")
                        }
                        if ((o || q) && p) {
                            for (c = a.split("/"), k = c.length; k > 0; k -= 1) {
                                if (d = c.slice(0, k).join("/"), o) for (l = o.length; l > 0; l -= 1) if ((e = p[o.slice(0, l).join("/")]) && (e = e[d])) {
                                    f = e, h = k;
                                    break
                                }
                                if (f) break;
                                !i && q && q[d] && (i = q[d], j = k)
                            }
                            !f && i && (f = i, h = j), f && (c.splice(0, h, f), a = c.join("/"))
                        }
                        return a
                    }

                    function g(a, c) {
                        return function () {
                            var d = w.call(arguments, 0);
                            return "string" != typeof d[0] && 1 === d.length && d.push(null), o.apply(b, d.concat([a, c]))
                        }
                    }

                    function h(a) {
                        return function (b) {
                            return f(b, a)
                        }
                    }

                    function i(a) {
                        return function (b) {
                            r[a] = b
                        }
                    }

                    function j(a) {
                        if (e(s, a)) {
                            var c = s[a];
                            delete s[a], u[a] = !0, n.apply(b, c)
                        }
                        if (!e(r, a) && !e(u, a)) throw new Error("No " + a);
                        return r[a]
                    }

                    function k(a) {
                        var b, c = a ? a.indexOf("!") : -1;
                        return c > -1 && (b = a.substring(0, c), a = a.substring(c + 1, a.length)), [b, a]
                    }

                    function l(a) {
                        return a ? k(a) : []
                    }

                    function m(a) {
                        return function () {
                            return t && t.config && t.config[a] || {}
                        }
                    }

                    var n, o, p, q, r = {}, s = {}, t = {}, u = {}, v = Object.prototype.hasOwnProperty, w = [].slice,
                        x = /\.js$/;
                    p = function (a, b) {
                        var c, d = k(a), e = d[0], g = b[1];
                        return a = d[1], e && (e = f(e, g), c = j(e)), e ? a = c && c.normalize ? c.normalize(a, h(g)) : f(a, g) : (a = f(a, g), d = k(a), e = d[0], a = d[1], e && (c = j(e))), {
                            f: e ? e + "!" + a : a,
                            n: a,
                            pr: e,
                            p: c
                        }
                    }, q = {
                        require: function (a) {
                            return g(a)
                        }, exports: function (a) {
                            var b = r[a];
                            return void 0 !== b ? b : r[a] = {}
                        }, module: function (a) {
                            return {id: a, uri: "", exports: r[a], config: m(a)}
                        }
                    }, n = function (a, c, d, f) {
                        var h, k, m, n, o, t, v, w = [], x = typeof d;
                        if (f = f || a, t = l(f), "undefined" === x || "function" === x) {
                            for (c = !c.length && d.length ? ["require", "exports", "module"] : c, o = 0; o < c.length; o += 1) if (n = p(c[o], t), "require" === (k = n.f)) w[o] = q.require(a); else if ("exports" === k) w[o] = q.exports(a), v = !0; else if ("module" === k) h = w[o] = q.module(a); else if (e(r, k) || e(s, k) || e(u, k)) w[o] = j(k); else {
                                if (!n.p) throw new Error(a + " missing " + k);
                                n.p.load(n.n, g(f, !0), i(k), {}), w[o] = r[k]
                            }
                            m = d ? d.apply(r[a], w) : void 0, a && (h && h.exports !== b && h.exports !== r[a] ? r[a] = h.exports : m === b && v || (r[a] = m))
                        } else a && (r[a] = d)
                    }, a = c = o = function (a, c, d, e, f) {
                        if ("string" == typeof a) return q[a] ? q[a](c) : j(p(a, l(c)).f);
                        if (!a.splice) {
                            if (t = a, t.deps && o(t.deps, t.callback), !c) return;
                            c.splice ? (a = c, c = d, d = null) : a = b
                        }
                        return c = c || function () {
                        }, "function" == typeof d && (d = e, e = f), e ? n(b, a, c, d) : setTimeout(function () {
                            n(b, a, c, d)
                        }, 4), o
                    }, o.config = function (a) {
                        return o(a)
                    }, a._defined = r, d = function (a, b, c) {
                        if ("string" != typeof a) throw new Error("See almond README: incorrect module build, no module name");
                        b.splice || (c = b, b = []), e(r, a) || e(s, a) || (s[a] = [a, b, c])
                    }, d.amd = {jQuery: !0}
                }(), b.requirejs = a, b.require = c, b.define = d
            }
        }(), b.define("almond", function () {
        }), b.define("jquery", [], function () {
            var b = a || $;
            return null == b && console && console.error && console.error("Select2: An instance of jQuery or a jQuery-compatible library was not found. Make sure that you are including jQuery before Select2 on your web page."), b
        }), b.define("select2/utils", ["jquery"], function (a) {
            function b(a) {
                var b = a.prototype, c = [];
                for (var d in b) {
                    "function" == typeof b[d] && ("constructor" !== d && c.push(d))
                }
                return c
            }

            var c = {};
            c.Extend = function (a, b) {
                function c() {
                    this.constructor = a
                }

                var d = {}.hasOwnProperty;
                for (var e in b) d.call(b, e) && (a[e] = b[e]);
                return c.prototype = b.prototype, a.prototype = new c, a.__super__ = b.prototype, a
            }, c.Decorate = function (a, c) {
                function d() {
                    var b = Array.prototype.unshift, d = c.prototype.constructor.length, e = a.prototype.constructor;
                    d > 0 && (b.call(arguments, a.prototype.constructor), e = c.prototype.constructor), e.apply(this, arguments)
                }

                function e() {
                    this.constructor = d
                }

                var f = b(c), g = b(a);
                c.displayName = a.displayName, d.prototype = new e;
                for (var h = 0; h < g.length; h++) {
                    var i = g[h];
                    d.prototype[i] = a.prototype[i]
                }
                for (var j = (function (a) {
                    var b = function () {
                    };
                    a in d.prototype && (b = d.prototype[a]);
                    var e = c.prototype[a];
                    return function () {
                        return Array.prototype.unshift.call(arguments, b), e.apply(this, arguments)
                    }
                }), k = 0; k < f.length; k++) {
                    var l = f[k];
                    d.prototype[l] = j(l)
                }
                return d
            };
            var d = function () {
                this.listeners = {}
            };
            d.prototype.on = function (a, b) {
                this.listeners = this.listeners || {}, a in this.listeners ? this.listeners[a].push(b) : this.listeners[a] = [b]
            }, d.prototype.trigger = function (a) {
                var b = Array.prototype.slice, c = b.call(arguments, 1);
                this.listeners = this.listeners || {}, null == c && (c = []), 0 === c.length && c.push({}), c[0]._type = a, a in this.listeners && this.invoke(this.listeners[a], b.call(arguments, 1)), "*" in this.listeners && this.invoke(this.listeners["*"], arguments)
            }, d.prototype.invoke = function (a, b) {
                for (var c = 0, d = a.length; c < d; c++) a[c].apply(this, b)
            }, c.Observable = d, c.generateChars = function (a) {
                for (var b = "", c = 0; c < a; c++) {
                    b += Math.floor(36 * Math.random()).toString(36)
                }
                return b
            }, c.bind = function (a, b) {
                return function () {
                    a.apply(b, arguments)
                }
            }, c._convertData = function (a) {
                for (var b in a) {
                    var c = b.split("-"), d = a;
                    if (1 !== c.length) {
                        for (var e = 0; e < c.length; e++) {
                            var f = c[e];
                            f = f.substring(0, 1).toLowerCase() + f.substring(1), f in d || (d[f] = {}), e == c.length - 1 && (d[f] = a[b]), d = d[f]
                        }
                        delete a[b]
                    }
                }
                return a
            }, c.hasScroll = function (b, c) {
                var d = a(c), e = c.style.overflowX, f = c.style.overflowY;
                return (e !== f || "hidden" !== f && "visible" !== f) && ("scroll" === e || "scroll" === f || (d.innerHeight() < c.scrollHeight || d.innerWidth() < c.scrollWidth))
            }, c.escapeMarkup = function (a) {
                var b = {
                    "\\": "&#92;",
                    "&": "&amp;",
                    "<": "&lt;",
                    ">": "&gt;",
                    '"': "&quot;",
                    "'": "&#39;",
                    "/": "&#47;"
                };
                return "string" != typeof a ? a : String(a).replace(/[&<>"'\/\\]/g, function (a) {
                    return b[a]
                })
            }, c.appendMany = function (b, c) {
                if ("1.7" === a.fn.jquery.substr(0, 3)) {
                    var d = a();
                    a.map(c, function (a) {
                        d = d.add(a)
                    }), c = d
                }
                b.append(c)
            }, c.__cache = {};
            var e = 0;
            return c.GetUniqueElementId = function (a) {
                var b = a.getAttribute("data-select2-id");
                return null == b && (a.id ? (b = a.id, a.setAttribute("data-select2-id", b)) : (a.setAttribute("data-select2-id", ++e), b = e.toString())), b
            }, c.StoreData = function (a, b, d) {
                var e = c.GetUniqueElementId(a);
                c.__cache[e] || (c.__cache[e] = {}), c.__cache[e][b] = d
            }, c.GetData = function (b, d) {
                var e = c.GetUniqueElementId(b);
                return d ? c.__cache[e] && null != c.__cache[e][d] ? c.__cache[e][d] : a(b).data(d) : c.__cache[e]
            }, c.RemoveData = function (a) {
                var b = c.GetUniqueElementId(a);
                null != c.__cache[b] && delete c.__cache[b]
            }, c
        }), b.define("select2/results", ["jquery", "./utils"], function (a, b) {
            function c(a, b, d) {
                this.$element = a, this.data = d, this.options = b, c.__super__.constructor.call(this)
            }

            return b.Extend(c, b.Observable), c.prototype.render = function () {
                var b = a('<ul class="select2-results__options" role="tree"></ul>');
                return this.options.get("multiple") && b.attr("aria-multiselectable", "true"), this.$results = b, b
            }, c.prototype.clear = function () {
                this.$results.empty()
            }, c.prototype.displayMessage = function (b) {
                var c = this.options.get("escapeMarkup");
                this.clear(), this.hideLoading();
                var d = a('<li role="treeitem" aria-live="assertive" class="select2-results__option"></li>'),
                    e = this.options.get("translations").get(b.message);
                d.append(c(e(b.args))), d[0].className += " select2-results__message", this.$results.append(d)
            }, c.prototype.hideMessages = function () {
                this.$results.find(".select2-results__message").remove()
            }, c.prototype.append = function (a) {
                this.hideLoading();
                var b = [];
                if (null == a.results || 0 === a.results.length) return void (0 === this.$results.children().length && this.trigger("results:message", {message: "noResults"}));
                a.results = this.sort(a.results);
                for (var c = 0; c < a.results.length; c++) {
                    var d = a.results[c], e = this.option(d);
                    b.push(e)
                }
                this.$results.append(b)
            }, c.prototype.position = function (a, b) {
                b.find(".select2-results").append(a)
            }, c.prototype.sort = function (a) {
                return this.options.get("sorter")(a)
            }, c.prototype.highlightFirstItem = function () {
                var a = this.$results.find(".select2-results__option[aria-selected]"),
                    b = a.filter("[aria-selected=true]");
                b.length > 0 ? b.first().trigger("mouseenter") : a.first().trigger("mouseenter"), this.ensureHighlightVisible()
            }, c.prototype.setClasses = function () {
                var c = this;
                this.data.current(function (d) {
                    var e = a.map(d, function (a) {
                        return a.id.toString()
                    });
                    c.$results.find(".select2-results__option[aria-selected]").each(function () {
                        var c = a(this), d = b.GetData(this, "data"), f = "" + d.id;
                        null != d.element && d.element.selected || null == d.element && a.inArray(f, e) > -1 ? c.attr("aria-selected", "true") : c.attr("aria-selected", "false")
                    })
                })
            }, c.prototype.showLoading = function (a) {
                this.hideLoading();
                var b = this.options.get("translations").get("searching"), c = {disabled: !0, loading: !0, text: b(a)},
                    d = this.option(c);
                d.className += " loading-results", this.$results.prepend(d)
            }, c.prototype.hideLoading = function () {
                this.$results.find(".loading-results").remove()
            }, c.prototype.option = function (c) {
                var d = document.createElement("li");
                d.className = "select2-results__option";
                var e = {role: "treeitem", "aria-selected": "false"};
                c.disabled && (delete e["aria-selected"], e["aria-disabled"] = "true"), null == c.id && delete e["aria-selected"], null != c._resultId && (d.id = c._resultId), c.title && (d.title = c.title), c.children && (e.role = "group", e["aria-label"] = c.text, delete e["aria-selected"]);
                for (var f in e) {
                    var g = e[f];
                    d.setAttribute(f, g)
                }
                if (c.children) {
                    var h = a(d), i = document.createElement("strong");
                    i.className = "select2-results__group";
                    a(i);
                    this.template(c, i);
                    for (var j = [], k = 0; k < c.children.length; k++) {
                        var l = c.children[k], m = this.option(l);
                        j.push(m)
                    }
                    var n = a("<ul></ul>", {class: "select2-results__options select2-results__options--nested"});
                    n.append(j), h.append(i), h.append(n)
                } else this.template(c, d);
                return b.StoreData(d, "data", c), d
            }, c.prototype.bind = function (c, d) {
                var e = this, f = c.id + "-results";
                this.$results.attr("id", f), c.on("results:all", function (a) {
                    e.clear(), e.append(a.data), c.isOpen() && (e.setClasses(), e.highlightFirstItem())
                }), c.on("results:append", function (a) {
                    e.append(a.data), c.isOpen() && e.setClasses()
                }), c.on("query", function (a) {
                    e.hideMessages(), e.showLoading(a)
                }), c.on("select", function () {
                    c.isOpen() && (e.setClasses(), e.highlightFirstItem())
                }), c.on("unselect", function () {
                    c.isOpen() && (e.setClasses(), e.highlightFirstItem())
                }), c.on("open", function () {
                    e.$results.attr("aria-expanded", "true"), e.$results.attr("aria-hidden", "false"), e.setClasses(), e.ensureHighlightVisible()
                }), c.on("close", function () {
                    e.$results.attr("aria-expanded", "false"), e.$results.attr("aria-hidden", "true"), e.$results.removeAttr("aria-activedescendant")
                }), c.on("results:toggle", function () {
                    var a = e.getHighlightedResults();
                    0 !== a.length && a.trigger("mouseup")
                }), c.on("results:select", function () {
                    var a = e.getHighlightedResults();
                    if (0 !== a.length) {
                        var c = b.GetData(a[0], "data");
                        "true" == a.attr("aria-selected") ? e.trigger("close", {}) : e.trigger("select", {data: c})
                    }
                }), c.on("results:previous", function () {
                    var a = e.getHighlightedResults(), b = e.$results.find("[aria-selected]"), c = b.index(a);
                    if (!(c <= 0)) {
                        var d = c - 1;
                        0 === a.length && (d = 0);
                        var f = b.eq(d);
                        f.trigger("mouseenter");
                        var g = e.$results.offset().top, h = f.offset().top, i = e.$results.scrollTop() + (h - g);
                        0 === d ? e.$results.scrollTop(0) : h - g < 0 && e.$results.scrollTop(i)
                    }
                }), c.on("results:next", function () {
                    var a = e.getHighlightedResults(), b = e.$results.find("[aria-selected]"), c = b.index(a),
                        d = c + 1;
                    if (!(d >= b.length)) {
                        var f = b.eq(d);
                        f.trigger("mouseenter");
                        var g = e.$results.offset().top + e.$results.outerHeight(!1),
                            h = f.offset().top + f.outerHeight(!1), i = e.$results.scrollTop() + h - g;
                        0 === d ? e.$results.scrollTop(0) : h > g && e.$results.scrollTop(i)
                    }
                }), c.on("results:focus", function (a) {
                    a.element.addClass("select2-results__option--highlighted")
                }), c.on("results:message", function (a) {
                    e.displayMessage(a)
                }), a.fn.mousewheel && this.$results.on("mousewheel", function (a) {
                    var b = e.$results.scrollTop(), c = e.$results.get(0).scrollHeight - b + a.deltaY,
                        d = a.deltaY > 0 && b - a.deltaY <= 0, f = a.deltaY < 0 && c <= e.$results.height();
                    d ? (e.$results.scrollTop(0), a.preventDefault(), a.stopPropagation()) : f && (e.$results.scrollTop(e.$results.get(0).scrollHeight - e.$results.height()), a.preventDefault(), a.stopPropagation())
                }), this.$results.on("mouseup", ".select2-results__option[aria-selected]", function (c) {
                    var d = a(this), f = b.GetData(this, "data");
                    if ("true" === d.attr("aria-selected")) return void (e.options.get("multiple") ? e.trigger("unselect", {
                        originalEvent: c,
                        data: f
                    }) : e.trigger("close", {}));
                    e.trigger("select", {originalEvent: c, data: f})
                }), this.$results.on("mouseenter", ".select2-results__option[aria-selected]", function (c) {
                    var d = b.GetData(this, "data");
                    e.getHighlightedResults().removeClass("select2-results__option--highlighted"), e.trigger("results:focus", {
                        data: d,
                        element: a(this)
                    })
                })
            }, c.prototype.getHighlightedResults = function () {
                return this.$results.find(".select2-results__option--highlighted")
            }, c.prototype.destroy = function () {
                this.$results.remove()
            }, c.prototype.ensureHighlightVisible = function () {
                var a = this.getHighlightedResults();
                if (0 !== a.length) {
                    var b = this.$results.find("[aria-selected]"), c = b.index(a), d = this.$results.offset().top,
                        e = a.offset().top, f = this.$results.scrollTop() + (e - d), g = e - d;
                    f -= 2 * a.outerHeight(!1), c <= 2 ? this.$results.scrollTop(0) : (g > this.$results.outerHeight() || g < 0) && this.$results.scrollTop(f)
                }
            }, c.prototype.template = function (b, c) {
                var d = this.options.get("templateResult"), e = this.options.get("escapeMarkup"), f = d(b, c);
                null == f ? c.style.display = "none" : "string" == typeof f ? c.innerHTML = e(f) : a(c).append(f)
            }, c
        }), b.define("select2/keys", [], function () {
            return {
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
            }
        }), b.define("select2/selection/base", ["jquery", "../utils", "../keys"], function (a, b, c) {
            function d(a, b) {
                this.$element = a, this.options = b, d.__super__.constructor.call(this)
            }

            return b.Extend(d, b.Observable), d.prototype.render = function () {
                var c = a('<span class="select2-selection" role="combobox"  aria-haspopup="true" aria-expanded="false"></span>');
                return this._tabindex = 0, null != b.GetData(this.$element[0], "old-tabindex") ? this._tabindex = b.GetData(this.$element[0], "old-tabindex") : null != this.$element.attr("tabindex") && (this._tabindex = this.$element.attr("tabindex")), c.attr("title", this.$element.attr("title")), c.attr("tabindex", this._tabindex), this.$selection = c, c
            }, d.prototype.bind = function (a, b) {
                var d = this, e = (a.id, a.id + "-results");
                this.container = a, this.$selection.on("focus", function (a) {
                    d.trigger("focus", a)
                }), this.$selection.on("blur", function (a) {
                    d._handleBlur(a)
                }), this.$selection.on("keydown", function (a) {
                    d.trigger("keypress", a), a.which === c.SPACE && a.preventDefault()
                }), a.on("results:focus", function (a) {
                    d.$selection.attr("aria-activedescendant", a.data._resultId)
                }), a.on("selection:update", function (a) {
                    d.update(a.data)
                }), a.on("open", function () {
                    d.$selection.attr("aria-expanded", "true"), d.$selection.attr("aria-owns", e), d._attachCloseHandler(a)
                }), a.on("close", function () {
                    d.$selection.attr("aria-expanded", "false"), d.$selection.removeAttr("aria-activedescendant"), d.$selection.removeAttr("aria-owns"), d.$selection.focus(), window.setTimeout(function () {
                        d.$selection.focus()
                    }, 0), d._detachCloseHandler(a)
                }), a.on("enable", function () {
                    d.$selection.attr("tabindex", d._tabindex)
                }), a.on("disable", function () {
                    d.$selection.attr("tabindex", "-1")
                })
            }, d.prototype._handleBlur = function (b) {
                var c = this;
                window.setTimeout(function () {
                    document.activeElement == c.$selection[0] || a.contains(c.$selection[0], document.activeElement) || c.trigger("blur", b)
                }, 1)
            }, d.prototype._attachCloseHandler = function (c) {
                a(document.body).on("mousedown.select2." + c.id, function (c) {
                    var d = a(c.target), e = d.closest(".select2");
                    a(".select2.select2-container--open").each(function () {
                        a(this), this != e[0] && b.GetData(this, "element").select2("close")
                    })
                })
            }, d.prototype._detachCloseHandler = function (b) {
                a(document.body).off("mousedown.select2." + b.id)
            }, d.prototype.position = function (a, b) {
                b.find(".selection").append(a)
            }, d.prototype.destroy = function () {
                this._detachCloseHandler(this.container)
            }, d.prototype.update = function (a) {
                throw new Error("The `update` method must be defined in child classes.")
            }, d
        }), b.define("select2/selection/single", ["jquery", "./base", "../utils", "../keys"], function (a, b, c, d) {
            function e() {
                e.__super__.constructor.apply(this, arguments)
            }

            return c.Extend(e, b), e.prototype.render = function () {
                var a = e.__super__.render.call(this);
                return a.addClass("select2-selection--single"), a.html('<span class="select2-selection__rendered"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>'), a
            }, e.prototype.bind = function (a, b) {
                var c = this;
                e.__super__.bind.apply(this, arguments);
                var d = a.id + "-container";
                this.$selection.find(".select2-selection__rendered").attr("id", d).attr("role", "textbox").attr("aria-readonly", "true"), this.$selection.attr("aria-labelledby", d), this.$selection.on("mousedown", function (a) {
                    1 === a.which && c.trigger("toggle", {originalEvent: a})
                }), this.$selection.on("focus", function (a) {
                }), this.$selection.on("blur", function (a) {
                }), a.on("focus", function (b) {
                    a.isOpen() || c.$selection.focus()
                })
            }, e.prototype.clear = function () {
                var a = this.$selection.find(".select2-selection__rendered");
                a.empty(), a.removeAttr("title")
            }, e.prototype.display = function (a, b) {
                var c = this.options.get("templateSelection");
                return this.options.get("escapeMarkup")(c(a, b))
            }, e.prototype.selectionContainer = function () {
                return a("<span></span>")
            }, e.prototype.update = function (a) {
                if (0 === a.length) return void this.clear();
                var b = a[0], c = this.$selection.find(".select2-selection__rendered"), d = this.display(b, c);
                c.empty().append(d), c.attr("title", b.title || b.text)
            }, e
        }), b.define("select2/selection/multiple", ["jquery", "./base", "../utils"], function (a, b, c) {
            function d(a, b) {
                d.__super__.constructor.apply(this, arguments)
            }

            return c.Extend(d, b), d.prototype.render = function () {
                var a = d.__super__.render.call(this);
                return a.addClass("select2-selection--multiple"), a.html('<ul class="select2-selection__rendered"></ul>'), a
            }, d.prototype.bind = function (b, e) {
                var f = this;
                d.__super__.bind.apply(this, arguments), this.$selection.on("click", function (a) {
                    f.trigger("toggle", {originalEvent: a})
                }), this.$selection.on("click", ".select2-selection__choice__remove", function (b) {
                    if (!f.options.get("disabled")) {
                        var d = a(this), e = d.parent(), g = c.GetData(e[0], "data");
                        f.trigger("unselect", {originalEvent: b, data: g})
                    }
                })
            }, d.prototype.clear = function () {
                var a = this.$selection.find(".select2-selection__rendered");
                a.empty(), a.removeAttr("title")
            }, d.prototype.display = function (a, b) {
                var c = this.options.get("templateSelection");
                return this.options.get("escapeMarkup")(c(a, b))
            }, d.prototype.selectionContainer = function () {
                return a('<li class="select2-selection__choice"><span class="select2-selection__choice__remove" role="presentation">&times;</span></li>')
            }, d.prototype.update = function (a) {
                if (this.clear(), 0 !== a.length) {
                    for (var b = [], d = 0; d < a.length; d++) {
                        var e = a[d], f = this.selectionContainer(), g = this.display(e, f);
                        f.append(g), f.attr("title", e.title || e.text), c.StoreData(f[0], "data", e), b.push(f)
                    }
                    var h = this.$selection.find(".select2-selection__rendered");
                    c.appendMany(h, b)
                }
            }, d
        }), b.define("select2/selection/placeholder", ["../utils"], function (a) {
            function b(a, b, c) {
                this.placeholder = this.normalizePlaceholder(c.get("placeholder")), a.call(this, b, c)
            }

            return b.prototype.normalizePlaceholder = function (a, b) {
                return "string" == typeof b && (b = {id: "", text: b}), b
            }, b.prototype.createPlaceholder = function (a, b) {
                var c = this.selectionContainer();
                return c.html(this.display(b)), c.addClass("select2-selection__placeholder").removeClass("select2-selection__choice"), c
            }, b.prototype.update = function (a, b) {
                var c = 1 == b.length && b[0].id != this.placeholder.id;
                if (b.length > 1 || c) return a.call(this, b);
                this.clear();
                var d = this.createPlaceholder(this.placeholder);
                this.$selection.find(".select2-selection__rendered").append(d)
            }, b
        }), b.define("select2/selection/allowClear", ["jquery", "../keys", "../utils"], function (a, b, c) {
            function d() {
            }

            return d.prototype.bind = function (a, b, c) {
                var d = this;
                a.call(this, b, c), null == this.placeholder && this.options.get("debug") && window.console && console.error && console.error("Select2: The `allowClear` option should be used in combination with the `placeholder` option."), this.$selection.on("mousedown", ".select2-selection__clear", function (a) {
                    d._handleClear(a)
                }), b.on("keypress", function (a) {
                    d._handleKeyboardClear(a, b)
                })
            }, d.prototype._handleClear = function (a, b) {
                if (!this.options.get("disabled")) {
                    var d = this.$selection.find(".select2-selection__clear");
                    if (0 !== d.length) {
                        b.stopPropagation();
                        var e = c.GetData(d[0], "data"), f = this.$element.val();
                        this.$element.val(this.placeholder.id);
                        var g = {data: e};
                        if (this.trigger("clear", g), g.prevented) return void this.$element.val(f);
                        for (var h = 0; h < e.length; h++) if (g = {data: e[h]}, this.trigger("unselect", g), g.prevented) return void this.$element.val(f);
                        this.$element.trigger("change"), this.trigger("toggle", {})
                    }
                }
            }, d.prototype._handleKeyboardClear = function (a, c, d) {
                d.isOpen() || c.which != b.DELETE && c.which != b.BACKSPACE || this._handleClear(c)
            }, d.prototype.update = function (b, d) {
                if (b.call(this, d), !(this.$selection.find(".select2-selection__placeholder").length > 0 || 0 === d.length)) {
                    var e = a('<span class="select2-selection__clear">&times;</span>');
                    c.StoreData(e[0], "data", d), this.$selection.find(".select2-selection__rendered").prepend(e)
                }
            }, d
        }), b.define("select2/selection/search", ["jquery", "../utils", "../keys"], function (a, b, c) {
            function d(a, b, c) {
                a.call(this, b, c)
            }

            return d.prototype.render = function (b) {
                var c = a('<li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" /></li>');
                this.$searchContainer = c, this.$search = c.find("input");
                var d = b.call(this);
                return this._transferTabIndex(), d
            }, d.prototype.bind = function (a, d, e) {
                var f = this;
                a.call(this, d, e), d.on("open", function () {
                    f.$search.trigger("focus")
                }), d.on("close", function () {
                    f.$search.val(""), f.$search.removeAttr("aria-activedescendant"), f.$search.trigger("focus")
                }), d.on("enable", function () {
                    f.$search.prop("disabled", !1), f._transferTabIndex()
                }), d.on("disable", function () {
                    f.$search.prop("disabled", !0)
                }), d.on("focus", function (a) {
                    f.$search.trigger("focus")
                }), d.on("results:focus", function (a) {
                    f.$search.attr("aria-activedescendant", a.id)
                }), this.$selection.on("focusin", ".select2-search--inline", function (a) {
                    f.trigger("focus", a)
                }), this.$selection.on("focusout", ".select2-search--inline", function (a) {
                    f._handleBlur(a)
                }), this.$selection.on("keydown", ".select2-search--inline", function (a) {
                    if (a.stopPropagation(), f.trigger("keypress", a), f._keyUpPrevented = a.isDefaultPrevented(), a.which === c.BACKSPACE && "" === f.$search.val()) {
                        var d = f.$searchContainer.prev(".select2-selection__choice");
                        if (d.length > 0) {
                            var e = b.GetData(d[0], "data");
                            f.searchRemoveChoice(e), a.preventDefault()
                        }
                    }
                });
                var g = document.documentMode, h = g && g <= 11;
                this.$selection.on("input.searchcheck", ".select2-search--inline", function (a) {
                    if (h) return void f.$selection.off("input.search input.searchcheck");
                    f.$selection.off("keyup.search")
                }), this.$selection.on("keyup.search input.search", ".select2-search--inline", function (a) {
                    if (h && "input" === a.type) return void f.$selection.off("input.search input.searchcheck");
                    var b = a.which;
                    b != c.SHIFT && b != c.CTRL && b != c.ALT && b != c.TAB && f.handleSearch(a)
                })
            }, d.prototype._transferTabIndex = function (a) {
                this.$search.attr("tabindex", this.$selection.attr("tabindex")), this.$selection.attr("tabindex", "-1")
            }, d.prototype.createPlaceholder = function (a, b) {
                this.$search.attr("placeholder", b.text)
            }, d.prototype.update = function (a, b) {
                var c = this.$search[0] == document.activeElement;
                if (this.$search.attr("placeholder", ""), a.call(this, b), this.$selection.find(".select2-selection__rendered").append(this.$searchContainer), this.resizeSearch(), c) {
                    this.$element.find("[data-select2-tag]").length ? this.$element.focus() : this.$search.focus()
                }
            }, d.prototype.handleSearch = function () {
                if (this.resizeSearch(), !this._keyUpPrevented) {
                    var a = this.$search.val();
                    this.trigger("query", {term: a})
                }
                this._keyUpPrevented = !1
            }, d.prototype.searchRemoveChoice = function (a, b) {
                this.trigger("unselect", {data: b}), this.$search.val(b.text), this.handleSearch()
            }, d.prototype.resizeSearch = function () {
                this.$search.css("width", "25px");
                var a = "";
                if ("" !== this.$search.attr("placeholder")) a = this.$selection.find(".select2-selection__rendered").innerWidth(); else {
                    a = .75 * (this.$search.val().length + 1) + "em"
                }
                this.$search.css("width", a)
            }, d
        }), b.define("select2/selection/eventRelay", ["jquery"], function (a) {
            function b() {
            }

            return b.prototype.bind = function (b, c, d) {
                var e = this,
                    f = ["open", "opening", "close", "closing", "select", "selecting", "unselect", "unselecting", "clear", "clearing"],
                    g = ["opening", "closing", "selecting", "unselecting", "clearing"];
                b.call(this, c, d), c.on("*", function (b, c) {
                    if (-1 !== a.inArray(b, f)) {
                        c = c || {};
                        var d = a.Event("select2:" + b, {params: c});
                        e.$element.trigger(d), -1 !== a.inArray(b, g) && (c.prevented = d.isDefaultPrevented())
                    }
                })
            }, b
        }), b.define("select2/translation", ["jquery", "require"], function (a, b) {
            function c(a) {
                this.dict = a || {}
            }

            return c.prototype.all = function () {
                return this.dict
            }, c.prototype.get = function (a) {
                return this.dict[a]
            }, c.prototype.extend = function (b) {
                this.dict = a.extend({}, b.all(), this.dict)
            }, c._cache = {}, c.loadPath = function (a) {
                if (!(a in c._cache)) {
                    var d = b(a);
                    c._cache[a] = d
                }
                return new c(c._cache[a])
            }, c
        }), b.define("select2/diacritics", [], function () {
            return {
                "Ⓐ": "A",
                "Ａ": "A",
                "À": "A",
                "Á": "A",
                "Â": "A",
                "Ầ": "A",
                "Ấ": "A",
                "Ẫ": "A",
                "Ẩ": "A",
                "Ã": "A",
                "Ā": "A",
                "Ă": "A",
                "Ằ": "A",
                "Ắ": "A",
                "Ẵ": "A",
                "Ẳ": "A",
                "Ȧ": "A",
                "Ǡ": "A",
                "Ä": "A",
                "Ǟ": "A",
                "Ả": "A",
                "Å": "A",
                "Ǻ": "A",
                "Ǎ": "A",
                "Ȁ": "A",
                "Ȃ": "A",
                "Ạ": "A",
                "Ậ": "A",
                "Ặ": "A",
                "Ḁ": "A",
                "Ą": "A",
                "Ⱥ": "A",
                "Ɐ": "A",
                "Ꜳ": "AA",
                "Æ": "AE",
                "Ǽ": "AE",
                "Ǣ": "AE",
                "Ꜵ": "AO",
                "Ꜷ": "AU",
                "Ꜹ": "AV",
                "Ꜻ": "AV",
                "Ꜽ": "AY",
                "Ⓑ": "B",
                "Ｂ": "B",
                "Ḃ": "B",
                "Ḅ": "B",
                "Ḇ": "B",
                "Ƀ": "B",
                "Ƃ": "B",
                "Ɓ": "B",
                "Ⓒ": "C",
                "Ｃ": "C",
                "Ć": "C",
                "Ĉ": "C",
                "Ċ": "C",
                "Č": "C",
                "Ç": "C",
                "Ḉ": "C",
                "Ƈ": "C",
                "Ȼ": "C",
                "Ꜿ": "C",
                "Ⓓ": "D",
                "Ｄ": "D",
                "Ḋ": "D",
                "Ď": "D",
                "Ḍ": "D",
                "Ḑ": "D",
                "Ḓ": "D",
                "Ḏ": "D",
                "Đ": "D",
                "Ƌ": "D",
                "Ɗ": "D",
                "Ɖ": "D",
                "Ꝺ": "D",
                "Ǳ": "DZ",
                "Ǆ": "DZ",
                "ǲ": "Dz",
                "ǅ": "Dz",
                "Ⓔ": "E",
                "Ｅ": "E",
                "È": "E",
                "É": "E",
                "Ê": "E",
                "Ề": "E",
                "Ế": "E",
                "Ễ": "E",
                "Ể": "E",
                "Ẽ": "E",
                "Ē": "E",
                "Ḕ": "E",
                "Ḗ": "E",
                "Ĕ": "E",
                "Ė": "E",
                "Ë": "E",
                "Ẻ": "E",
                "Ě": "E",
                "Ȅ": "E",
                "Ȇ": "E",
                "Ẹ": "E",
                "Ệ": "E",
                "Ȩ": "E",
                "Ḝ": "E",
                "Ę": "E",
                "Ḙ": "E",
                "Ḛ": "E",
                "Ɛ": "E",
                "Ǝ": "E",
                "Ⓕ": "F",
                "Ｆ": "F",
                "Ḟ": "F",
                "Ƒ": "F",
                "Ꝼ": "F",
                "Ⓖ": "G",
                "Ｇ": "G",
                "Ǵ": "G",
                "Ĝ": "G",
                "Ḡ": "G",
                "Ğ": "G",
                "Ġ": "G",
                "Ǧ": "G",
                "Ģ": "G",
                "Ǥ": "G",
                "Ɠ": "G",
                "Ꞡ": "G",
                "Ᵹ": "G",
                "Ꝿ": "G",
                "Ⓗ": "H",
                "Ｈ": "H",
                "Ĥ": "H",
                "Ḣ": "H",
                "Ḧ": "H",
                "Ȟ": "H",
                "Ḥ": "H",
                "Ḩ": "H",
                "Ḫ": "H",
                "Ħ": "H",
                "Ⱨ": "H",
                "Ⱶ": "H",
                "Ɥ": "H",
                "Ⓘ": "I",
                "Ｉ": "I",
                "Ì": "I",
                "Í": "I",
                "Î": "I",
                "Ĩ": "I",
                "Ī": "I",
                "Ĭ": "I",
                "İ": "I",
                "Ï": "I",
                "Ḯ": "I",
                "Ỉ": "I",
                "Ǐ": "I",
                "Ȉ": "I",
                "Ȋ": "I",
                "Ị": "I",
                "Į": "I",
                "Ḭ": "I",
                "Ɨ": "I",
                "Ⓙ": "J",
                "Ｊ": "J",
                "Ĵ": "J",
                "Ɉ": "J",
                "Ⓚ": "K",
                "Ｋ": "K",
                "Ḱ": "K",
                "Ǩ": "K",
                "Ḳ": "K",
                "Ķ": "K",
                "Ḵ": "K",
                "Ƙ": "K",
                "Ⱪ": "K",
                "Ꝁ": "K",
                "Ꝃ": "K",
                "Ꝅ": "K",
                "Ꞣ": "K",
                "Ⓛ": "L",
                "Ｌ": "L",
                "Ŀ": "L",
                "Ĺ": "L",
                "Ľ": "L",
                "Ḷ": "L",
                "Ḹ": "L",
                "Ļ": "L",
                "Ḽ": "L",
                "Ḻ": "L",
                "Ł": "L",
                "Ƚ": "L",
                "Ɫ": "L",
                "Ⱡ": "L",
                "Ꝉ": "L",
                "Ꝇ": "L",
                "Ꞁ": "L",
                "Ǉ": "LJ",
                "ǈ": "Lj",
                "Ⓜ": "M",
                "Ｍ": "M",
                "Ḿ": "M",
                "Ṁ": "M",
                "Ṃ": "M",
                "Ɱ": "M",
                "Ɯ": "M",
                "Ⓝ": "N",
                "Ｎ": "N",
                "Ǹ": "N",
                "Ń": "N",
                "Ñ": "N",
                "Ṅ": "N",
                "Ň": "N",
                "Ṇ": "N",
                "Ņ": "N",
                "Ṋ": "N",
                "Ṉ": "N",
                "Ƞ": "N",
                "Ɲ": "N",
                "Ꞑ": "N",
                "Ꞥ": "N",
                "Ǌ": "NJ",
                "ǋ": "Nj",
                "Ⓞ": "O",
                "Ｏ": "O",
                "Ò": "O",
                "Ó": "O",
                "Ô": "O",
                "Ồ": "O",
                "Ố": "O",
                "Ỗ": "O",
                "Ổ": "O",
                "Õ": "O",
                "Ṍ": "O",
                "Ȭ": "O",
                "Ṏ": "O",
                "Ō": "O",
                "Ṑ": "O",
                "Ṓ": "O",
                "Ŏ": "O",
                "Ȯ": "O",
                "Ȱ": "O",
                "Ö": "O",
                "Ȫ": "O",
                "Ỏ": "O",
                "Ő": "O",
                "Ǒ": "O",
                "Ȍ": "O",
                "Ȏ": "O",
                "Ơ": "O",
                "Ờ": "O",
                "Ớ": "O",
                "Ỡ": "O",
                "Ở": "O",
                "Ợ": "O",
                "Ọ": "O",
                "Ộ": "O",
                "Ǫ": "O",
                "Ǭ": "O",
                "Ø": "O",
                "Ǿ": "O",
                "Ɔ": "O",
                "Ɵ": "O",
                "Ꝋ": "O",
                "Ꝍ": "O",
                "Ƣ": "OI",
                "Ꝏ": "OO",
                "Ȣ": "OU",
                "Ⓟ": "P",
                "Ｐ": "P",
                "Ṕ": "P",
                "Ṗ": "P",
                "Ƥ": "P",
                "Ᵽ": "P",
                "Ꝑ": "P",
                "Ꝓ": "P",
                "Ꝕ": "P",
                "Ⓠ": "Q",
                "Ｑ": "Q",
                "Ꝗ": "Q",
                "Ꝙ": "Q",
                "Ɋ": "Q",
                "Ⓡ": "R",
                "Ｒ": "R",
                "Ŕ": "R",
                "Ṙ": "R",
                "Ř": "R",
                "Ȑ": "R",
                "Ȓ": "R",
                "Ṛ": "R",
                "Ṝ": "R",
                "Ŗ": "R",
                "Ṟ": "R",
                "Ɍ": "R",
                "Ɽ": "R",
                "Ꝛ": "R",
                "Ꞧ": "R",
                "Ꞃ": "R",
                "Ⓢ": "S",
                "Ｓ": "S",
                "ẞ": "S",
                "Ś": "S",
                "Ṥ": "S",
                "Ŝ": "S",
                "Ṡ": "S",
                "Š": "S",
                "Ṧ": "S",
                "Ṣ": "S",
                "Ṩ": "S",
                "Ș": "S",
                "Ş": "S",
                "Ȿ": "S",
                "Ꞩ": "S",
                "Ꞅ": "S",
                "Ⓣ": "T",
                "Ｔ": "T",
                "Ṫ": "T",
                "Ť": "T",
                "Ṭ": "T",
                "Ț": "T",
                "Ţ": "T",
                "Ṱ": "T",
                "Ṯ": "T",
                "Ŧ": "T",
                "Ƭ": "T",
                "Ʈ": "T",
                "Ⱦ": "T",
                "Ꞇ": "T",
                "Ꜩ": "TZ",
                "Ⓤ": "U",
                "Ｕ": "U",
                "Ù": "U",
                "Ú": "U",
                "Û": "U",
                "Ũ": "U",
                "Ṹ": "U",
                "Ū": "U",
                "Ṻ": "U",
                "Ŭ": "U",
                "Ü": "U",
                "Ǜ": "U",
                "Ǘ": "U",
                "Ǖ": "U",
                "Ǚ": "U",
                "Ủ": "U",
                "Ů": "U",
                "Ű": "U",
                "Ǔ": "U",
                "Ȕ": "U",
                "Ȗ": "U",
                "Ư": "U",
                "Ừ": "U",
                "Ứ": "U",
                "Ữ": "U",
                "Ử": "U",
                "Ự": "U",
                "Ụ": "U",
                "Ṳ": "U",
                "Ų": "U",
                "Ṷ": "U",
                "Ṵ": "U",
                "Ʉ": "U",
                "Ⓥ": "V",
                "Ｖ": "V",
                "Ṽ": "V",
                "Ṿ": "V",
                "Ʋ": "V",
                "Ꝟ": "V",
                "Ʌ": "V",
                "Ꝡ": "VY",
                "Ⓦ": "W",
                "Ｗ": "W",
                "Ẁ": "W",
                "Ẃ": "W",
                "Ŵ": "W",
                "Ẇ": "W",
                "Ẅ": "W",
                "Ẉ": "W",
                "Ⱳ": "W",
                "Ⓧ": "X",
                "Ｘ": "X",
                "Ẋ": "X",
                "Ẍ": "X",
                "Ⓨ": "Y",
                "Ｙ": "Y",
                "Ỳ": "Y",
                "Ý": "Y",
                "Ŷ": "Y",
                "Ỹ": "Y",
                "Ȳ": "Y",
                "Ẏ": "Y",
                "Ÿ": "Y",
                "Ỷ": "Y",
                "Ỵ": "Y",
                "Ƴ": "Y",
                "Ɏ": "Y",
                "Ỿ": "Y",
                "Ⓩ": "Z",
                "Ｚ": "Z",
                "Ź": "Z",
                "Ẑ": "Z",
                "Ż": "Z",
                "Ž": "Z",
                "Ẓ": "Z",
                "Ẕ": "Z",
                "Ƶ": "Z",
                "Ȥ": "Z",
                "Ɀ": "Z",
                "Ⱬ": "Z",
                "Ꝣ": "Z",
                "ⓐ": "a",
                "ａ": "a",
                "ẚ": "a",
                "à": "a",
                "á": "a",
                "â": "a",
                "ầ": "a",
                "ấ": "a",
                "ẫ": "a",
                "ẩ": "a",
                "ã": "a",
                "ā": "a",
                "ă": "a",
                "ằ": "a",
                "ắ": "a",
                "ẵ": "a",
                "ẳ": "a",
                "ȧ": "a",
                "ǡ": "a",
                "ä": "a",
                "ǟ": "a",
                "ả": "a",
                "å": "a",
                "ǻ": "a",
                "ǎ": "a",
                "ȁ": "a",
                "ȃ": "a",
                "ạ": "a",
                "ậ": "a",
                "ặ": "a",
                "ḁ": "a",
                "ą": "a",
                "ⱥ": "a",
                "ɐ": "a",
                "ꜳ": "aa",
                "æ": "ae",
                "ǽ": "ae",
                "ǣ": "ae",
                "ꜵ": "ao",
                "ꜷ": "au",
                "ꜹ": "av",
                "ꜻ": "av",
                "ꜽ": "ay",
                "ⓑ": "b",
                "ｂ": "b",
                "ḃ": "b",
                "ḅ": "b",
                "ḇ": "b",
                "ƀ": "b",
                "ƃ": "b",
                "ɓ": "b",
                "ⓒ": "c",
                "ｃ": "c",
                "ć": "c",
                "ĉ": "c",
                "ċ": "c",
                "č": "c",
                "ç": "c",
                "ḉ": "c",
                "ƈ": "c",
                "ȼ": "c",
                "ꜿ": "c",
                "ↄ": "c",
                "ⓓ": "d",
                "ｄ": "d",
                "ḋ": "d",
                "ď": "d",
                "ḍ": "d",
                "ḑ": "d",
                "ḓ": "d",
                "ḏ": "d",
                "đ": "d",
                "ƌ": "d",
                "ɖ": "d",
                "ɗ": "d",
                "ꝺ": "d",
                "ǳ": "dz",
                "ǆ": "dz",
                "ⓔ": "e",
                "ｅ": "e",
                "è": "e",
                "é": "e",
                "ê": "e",
                "ề": "e",
                "ế": "e",
                "ễ": "e",
                "ể": "e",
                "ẽ": "e",
                "ē": "e",
                "ḕ": "e",
                "ḗ": "e",
                "ĕ": "e",
                "ė": "e",
                "ë": "e",
                "ẻ": "e",
                "ě": "e",
                "ȅ": "e",
                "ȇ": "e",
                "ẹ": "e",
                "ệ": "e",
                "ȩ": "e",
                "ḝ": "e",
                "ę": "e",
                "ḙ": "e",
                "ḛ": "e",
                "ɇ": "e",
                "ɛ": "e",
                "ǝ": "e",
                "ⓕ": "f",
                "ｆ": "f",
                "ḟ": "f",
                "ƒ": "f",
                "ꝼ": "f",
                "ⓖ": "g",
                "ｇ": "g",
                "ǵ": "g",
                "ĝ": "g",
                "ḡ": "g",
                "ğ": "g",
                "ġ": "g",
                "ǧ": "g",
                "ģ": "g",
                "ǥ": "g",
                "ɠ": "g",
                "ꞡ": "g",
                "ᵹ": "g",
                "ꝿ": "g",
                "ⓗ": "h",
                "ｈ": "h",
                "ĥ": "h",
                "ḣ": "h",
                "ḧ": "h",
                "ȟ": "h",
                "ḥ": "h",
                "ḩ": "h",
                "ḫ": "h",
                "ẖ": "h",
                "ħ": "h",
                "ⱨ": "h",
                "ⱶ": "h",
                "ɥ": "h",
                "ƕ": "hv",
                "ⓘ": "i",
                "ｉ": "i",
                "ì": "i",
                "í": "i",
                "î": "i",
                "ĩ": "i",
                "ī": "i",
                "ĭ": "i",
                "ï": "i",
                "ḯ": "i",
                "ỉ": "i",
                "ǐ": "i",
                "ȉ": "i",
                "ȋ": "i",
                "ị": "i",
                "į": "i",
                "ḭ": "i",
                "ɨ": "i",
                "ı": "i",
                "ⓙ": "j",
                "ｊ": "j",
                "ĵ": "j",
                "ǰ": "j",
                "ɉ": "j",
                "ⓚ": "k",
                "ｋ": "k",
                "ḱ": "k",
                "ǩ": "k",
                "ḳ": "k",
                "ķ": "k",
                "ḵ": "k",
                "ƙ": "k",
                "ⱪ": "k",
                "ꝁ": "k",
                "ꝃ": "k",
                "ꝅ": "k",
                "ꞣ": "k",
                "ⓛ": "l",
                "ｌ": "l",
                "ŀ": "l",
                "ĺ": "l",
                "ľ": "l",
                "ḷ": "l",
                "ḹ": "l",
                "ļ": "l",
                "ḽ": "l",
                "ḻ": "l",
                "ſ": "l",
                "ł": "l",
                "ƚ": "l",
                "ɫ": "l",
                "ⱡ": "l",
                "ꝉ": "l",
                "ꞁ": "l",
                "ꝇ": "l",
                "ǉ": "lj",
                "ⓜ": "m",
                "ｍ": "m",
                "ḿ": "m",
                "ṁ": "m",
                "ṃ": "m",
                "ɱ": "m",
                "ɯ": "m",
                "ⓝ": "n",
                "ｎ": "n",
                "ǹ": "n",
                "ń": "n",
                "ñ": "n",
                "ṅ": "n",
                "ň": "n",
                "ṇ": "n",
                "ņ": "n",
                "ṋ": "n",
                "ṉ": "n",
                "ƞ": "n",
                "ɲ": "n",
                "ŉ": "n",
                "ꞑ": "n",
                "ꞥ": "n",
                "ǌ": "nj",
                "ⓞ": "o",
                "ｏ": "o",
                "ò": "o",
                "ó": "o",
                "ô": "o",
                "ồ": "o",
                "ố": "o",
                "ỗ": "o",
                "ổ": "o",
                "õ": "o",
                "ṍ": "o",
                "ȭ": "o",
                "ṏ": "o",
                "ō": "o",
                "ṑ": "o",
                "ṓ": "o",
                "ŏ": "o",
                "ȯ": "o",
                "ȱ": "o",
                "ö": "o",
                "ȫ": "o",
                "ỏ": "o",
                "ő": "o",
                "ǒ": "o",
                "ȍ": "o",
                "ȏ": "o",
                "ơ": "o",
                "ờ": "o",
                "ớ": "o",
                "ỡ": "o",
                "ở": "o",
                "ợ": "o",
                "ọ": "o",
                "ộ": "o",
                "ǫ": "o",
                "ǭ": "o",
                "ø": "o",
                "ǿ": "o",
                "ɔ": "o",
                "ꝋ": "o",
                "ꝍ": "o",
                "ɵ": "o",
                "ƣ": "oi",
                "ȣ": "ou",
                "ꝏ": "oo",
                "ⓟ": "p",
                "ｐ": "p",
                "ṕ": "p",
                "ṗ": "p",
                "ƥ": "p",
                "ᵽ": "p",
                "ꝑ": "p",
                "ꝓ": "p",
                "ꝕ": "p",
                "ⓠ": "q",
                "ｑ": "q",
                "ɋ": "q",
                "ꝗ": "q",
                "ꝙ": "q",
                "ⓡ": "r",
                "ｒ": "r",
                "ŕ": "r",
                "ṙ": "r",
                "ř": "r",
                "ȑ": "r",
                "ȓ": "r",
                "ṛ": "r",
                "ṝ": "r",
                "ŗ": "r",
                "ṟ": "r",
                "ɍ": "r",
                "ɽ": "r",
                "ꝛ": "r",
                "ꞧ": "r",
                "ꞃ": "r",
                "ⓢ": "s",
                "ｓ": "s",
                "ß": "s",
                "ś": "s",
                "ṥ": "s",
                "ŝ": "s",
                "ṡ": "s",
                "š": "s",
                "ṧ": "s",
                "ṣ": "s",
                "ṩ": "s",
                "ș": "s",
                "ş": "s",
                "ȿ": "s",
                "ꞩ": "s",
                "ꞅ": "s",
                "ẛ": "s",
                "ⓣ": "t",
                "ｔ": "t",
                "ṫ": "t",
                "ẗ": "t",
                "ť": "t",
                "ṭ": "t",
                "ț": "t",
                "ţ": "t",
                "ṱ": "t",
                "ṯ": "t",
                "ŧ": "t",
                "ƭ": "t",
                "ʈ": "t",
                "ⱦ": "t",
                "ꞇ": "t",
                "ꜩ": "tz",
                "ⓤ": "u",
                "ｕ": "u",
                "ù": "u",
                "ú": "u",
                "û": "u",
                "ũ": "u",
                "ṹ": "u",
                "ū": "u",
                "ṻ": "u",
                "ŭ": "u",
                "ü": "u",
                "ǜ": "u",
                "ǘ": "u",
                "ǖ": "u",
                "ǚ": "u",
                "ủ": "u",
                "ů": "u",
                "ű": "u",
                "ǔ": "u",
                "ȕ": "u",
                "ȗ": "u",
                "ư": "u",
                "ừ": "u",
                "ứ": "u",
                "ữ": "u",
                "ử": "u",
                "ự": "u",
                "ụ": "u",
                "ṳ": "u",
                "ų": "u",
                "ṷ": "u",
                "ṵ": "u",
                "ʉ": "u",
                "ⓥ": "v",
                "ｖ": "v",
                "ṽ": "v",
                "ṿ": "v",
                "ʋ": "v",
                "ꝟ": "v",
                "ʌ": "v",
                "ꝡ": "vy",
                "ⓦ": "w",
                "ｗ": "w",
                "ẁ": "w",
                "ẃ": "w",
                "ŵ": "w",
                "ẇ": "w",
                "ẅ": "w",
                "ẘ": "w",
                "ẉ": "w",
                "ⱳ": "w",
                "ⓧ": "x",
                "ｘ": "x",
                "ẋ": "x",
                "ẍ": "x",
                "ⓨ": "y",
                "ｙ": "y",
                "ỳ": "y",
                "ý": "y",
                "ŷ": "y",
                "ỹ": "y",
                "ȳ": "y",
                "ẏ": "y",
                "ÿ": "y",
                "ỷ": "y",
                "ẙ": "y",
                "ỵ": "y",
                "ƴ": "y",
                "ɏ": "y",
                "ỿ": "y",
                "ⓩ": "z",
                "ｚ": "z",
                "ź": "z",
                "ẑ": "z",
                "ż": "z",
                "ž": "z",
                "ẓ": "z",
                "ẕ": "z",
                "ƶ": "z",
                "ȥ": "z",
                "ɀ": "z",
                "ⱬ": "z",
                "ꝣ": "z",
                "Ά": "Α",
                "Έ": "Ε",
                "Ή": "Η",
                "Ί": "Ι",
                "Ϊ": "Ι",
                "Ό": "Ο",
                "Ύ": "Υ",
                "Ϋ": "Υ",
                "Ώ": "Ω",
                "ά": "α",
                "έ": "ε",
                "ή": "η",
                "ί": "ι",
                "ϊ": "ι",
                "ΐ": "ι",
                "ό": "ο",
                "ύ": "υ",
                "ϋ": "υ",
                "ΰ": "υ",
                "ω": "ω",
                "ς": "σ"
            }
        }), b.define("select2/data/base", ["../utils"], function (a) {
            function b(a, c) {
                b.__super__.constructor.call(this)
            }

            return a.Extend(b, a.Observable), b.prototype.current = function (a) {
                throw new Error("The `current` method must be defined in child classes.")
            }, b.prototype.query = function (a, b) {
                throw new Error("The `query` method must be defined in child classes.")
            }, b.prototype.bind = function (a, b) {
            }, b.prototype.destroy = function () {
            }, b.prototype.generateResultId = function (b, c) {
                var d = b.id + "-result-";
                return d += a.generateChars(4), null != c.id ? d += "-" + c.id.toString() : d += "-" + a.generateChars(4), d
            }, b
        }), b.define("select2/data/select", ["./base", "../utils", "jquery"], function (a, b, c) {
            function d(a, b) {
                this.$element = a, this.options = b, d.__super__.constructor.call(this)
            }

            return b.Extend(d, a), d.prototype.current = function (a) {
                var b = [], d = this;
                this.$element.find(":selected").each(function () {
                    var a = c(this), e = d.item(a);
                    b.push(e)
                }), a(b)
            }, d.prototype.select = function (a) {
                var b = this;
                if (a.selected = !0, c(a.element).is("option")) return a.element.selected = !0, void this.$element.trigger("change");
                if (this.$element.prop("multiple")) this.current(function (d) {
                    var e = [];
                    a = [a], a.push.apply(a, d);
                    for (var f = 0; f < a.length; f++) {
                        var g = a[f].id;
                        -1 === c.inArray(g, e) && e.push(g)
                    }
                    b.$element.val(e), b.$element.trigger("change")
                }); else {
                    var d = a.id;
                    this.$element.val(d), this.$element.trigger("change")
                }
            }, d.prototype.unselect = function (a) {
                var b = this;
                if (this.$element.prop("multiple")) {
                    if (a.selected = !1, c(a.element).is("option")) return a.element.selected = !1, void this.$element.trigger("change");
                    this.current(function (d) {
                        for (var e = [], f = 0; f < d.length; f++) {
                            var g = d[f].id;
                            g !== a.id && -1 === c.inArray(g, e) && e.push(g)
                        }
                        b.$element.val(e), b.$element.trigger("change")
                    })
                }
            }, d.prototype.bind = function (a, b) {
                var c = this;
                this.container = a, a.on("select", function (a) {
                    c.select(a.data)
                }), a.on("unselect", function (a) {
                    c.unselect(a.data)
                })
            }, d.prototype.destroy = function () {
                this.$element.find("*").each(function () {
                    b.RemoveData(this)
                })
            }, d.prototype.query = function (a, b) {
                var d = [], e = this;
                this.$element.children().each(function () {
                    var b = c(this);
                    if (b.is("option") || b.is("optgroup")) {
                        var f = e.item(b), g = e.matches(a, f);
                        null !== g && d.push(g)
                    }
                }), b({results: d})
            }, d.prototype.addOptions = function (a) {
                b.appendMany(this.$element, a)
            }, d.prototype.option = function (a) {
                var d;
                a.children ? (d = document.createElement("optgroup"), d.label = a.text) : (d = document.createElement("option"), void 0 !== d.textContent ? d.textContent = a.text : d.innerText = a.text), void 0 !== a.id && (d.value = a.id), a.disabled && (d.disabled = !0), a.selected && (d.selected = !0), a.title && (d.title = a.title);
                var e = c(d), f = this._normalizeItem(a);
                return f.element = d, b.StoreData(d, "data", f), e
            }, d.prototype.item = function (a) {
                var d = {};
                if (null != (d = b.GetData(a[0], "data"))) return d;
                if (a.is("option")) d = {
                    id: a.val(),
                    text: a.text(),
                    disabled: a.prop("disabled"),
                    selected: a.prop("selected"),
                    title: a.prop("title")
                }; else if (a.is("optgroup")) {
                    d = {text: a.prop("label"), children: [], title: a.prop("title")};
                    for (var e = a.children("option"), f = [], g = 0; g < e.length; g++) {
                        var h = c(e[g]), i = this.item(h);
                        f.push(i)
                    }
                    d.children = f
                }
                return d = this._normalizeItem(d), d.element = a[0], b.StoreData(a[0], "data", d), d
            }, d.prototype._normalizeItem = function (a) {
                a !== Object(a) && (a = {id: a, text: a}), a = c.extend({}, {text: ""}, a);
                var b = {selected: !1, disabled: !1};
                return null != a.id && (a.id = a.id.toString()), null != a.text && (a.text = a.text.toString()), null == a._resultId && a.id && null != this.container && (a._resultId = this.generateResultId(this.container, a)), c.extend({}, b, a)
            }, d.prototype.matches = function (a, b) {
                return this.options.get("matcher")(a, b)
            }, d
        }), b.define("select2/data/array", ["./select", "../utils", "jquery"], function (a, b, c) {
            function d(a, b) {
                var c = b.get("data") || [];
                d.__super__.constructor.call(this, a, b), this.addOptions(this.convertToOptions(c))
            }

            return b.Extend(d, a), d.prototype.select = function (a) {
                var b = this.$element.find("option").filter(function (b, c) {
                    return c.value == a.id.toString()
                });
                0 === b.length && (b = this.option(a), this.addOptions(b)), d.__super__.select.call(this, a)
            }, d.prototype.convertToOptions = function (a) {
                function d(a) {
                    return function () {
                        return c(this).val() == a.id
                    }
                }

                for (var e = this, f = this.$element.find("option"), g = f.map(function () {
                    return e.item(c(this)).id
                }).get(), h = [], i = 0; i < a.length; i++) {
                    var j = this._normalizeItem(a[i]);
                    if (c.inArray(j.id, g) >= 0) {
                        var k = f.filter(d(j)), l = this.item(k), m = c.extend(!0, {}, j, l), n = this.option(m);
                        k.replaceWith(n)
                    } else {
                        var o = this.option(j);
                        if (j.children) {
                            var p = this.convertToOptions(j.children);
                            b.appendMany(o, p)
                        }
                        h.push(o)
                    }
                }
                return h
            }, d
        }), b.define("select2/data/ajax", ["./array", "../utils", "jquery"], function (a, b, c) {
            function d(a, b) {
                this.ajaxOptions = this._applyDefaults(b.get("ajax")), null != this.ajaxOptions.processResults && (this.processResults = this.ajaxOptions.processResults), d.__super__.constructor.call(this, a, b)
            }

            return b.Extend(d, a), d.prototype._applyDefaults = function (a) {
                var b = {
                    data: function (a) {
                        return c.extend({}, a, {q: a.term})
                    }, transport: function (a, b, d) {
                        var e = c.ajax(a);
                        return e.then(b), e.fail(d), e
                    }
                };
                return c.extend({}, b, a, !0)
            }, d.prototype.processResults = function (a) {
                return a
            }, d.prototype.query = function (a, b) {
                function d() {
                    var d = f.transport(f, function (d) {
                        var f = e.processResults(d, a);
                        e.options.get("debug") && window.console && console.error && (f && f.results && c.isArray(f.results) || console.error("Select2: The AJAX results did not return an array in the `results` key of the response.")), b(f)
                    }, function () {
                        "status" in d && (0 === d.status || "0" === d.status) || e.trigger("results:message", {message: "errorLoading"})
                    });
                    e._request = d
                }

                var e = this;
                null != this._request && (c.isFunction(this._request.abort) && this._request.abort(), this._request = null);
                var f = c.extend({type: "GET"}, this.ajaxOptions);
                "function" == typeof f.url && (f.url = f.url.call(this.$element, a)), "function" == typeof f.data && (f.data = f.data.call(this.$element, a)), this.ajaxOptions.delay && null != a.term ? (this._queryTimeout && window.clearTimeout(this._queryTimeout), this._queryTimeout = window.setTimeout(d, this.ajaxOptions.delay)) : d()
            }, d
        }), b.define("select2/data/tags", ["jquery"], function (a) {
            function b(b, c, d) {
                var e = d.get("tags"), f = d.get("createTag");
                void 0 !== f && (this.createTag = f);
                var g = d.get("insertTag");
                if (void 0 !== g && (this.insertTag = g), b.call(this, c, d), a.isArray(e)) for (var h = 0; h < e.length; h++) {
                    var i = e[h], j = this._normalizeItem(i), k = this.option(j);
                    this.$element.append(k)
                }
            }

            return b.prototype.query = function (a, b, c) {
                function d(a, f) {
                    for (var g = a.results, h = 0; h < g.length; h++) {
                        var i = g[h], j = null != i.children && !d({results: i.children}, !0);
                        if ((i.text || "").toUpperCase() === (b.term || "").toUpperCase() || j) return !f && (a.data = g, void c(a))
                    }
                    if (f) return !0;
                    var k = e.createTag(b);
                    if (null != k) {
                        var l = e.option(k);
                        l.attr("data-select2-tag", !0), e.addOptions([l]), e.insertTag(g, k)
                    }
                    a.results = g, c(a)
                }

                var e = this;
                if (this._removeOldTags(), null == b.term || null != b.page) return void a.call(this, b, c);
                a.call(this, b, d)
            }, b.prototype.createTag = function (b, c) {
                var d = a.trim(c.term);
                return "" === d ? null : {id: d, text: d}
            }, b.prototype.insertTag = function (a, b, c) {
                b.unshift(c)
            }, b.prototype._removeOldTags = function (b) {
                this._lastTag;
                this.$element.find("option[data-select2-tag]").each(function () {
                    this.selected || a(this).remove()
                })
            }, b
        }), b.define("select2/data/tokenizer", ["jquery"], function (a) {
            function b(a, b, c) {
                var d = c.get("tokenizer");
                void 0 !== d && (this.tokenizer = d), a.call(this, b, c)
            }

            return b.prototype.bind = function (a, b, c) {
                a.call(this, b, c), this.$search = b.dropdown.$search || b.selection.$search || c.find(".select2-search__field")
            }, b.prototype.query = function (b, c, d) {
                function e(b) {
                    var c = g._normalizeItem(b);
                    if (!g.$element.find("option").filter(function () {
                        return a(this).val() === c.id
                    }).length) {
                        var d = g.option(c);
                        d.attr("data-select2-tag", !0), g._removeOldTags(), g.addOptions([d])
                    }
                    f(c)
                }

                function f(a) {
                    g.trigger("select", {data: a})
                }

                var g = this;
                c.term = c.term || "";
                var h = this.tokenizer(c, this.options, e);
                h.term !== c.term && (this.$search.length && (this.$search.val(h.term), this.$search.focus()), c.term = h.term), b.call(this, c, d)
            }, b.prototype.tokenizer = function (b, c, d, e) {
                for (var f = d.get("tokenSeparators") || [], g = c.term, h = 0, i = this.createTag || function (a) {
                    return {id: a.term, text: a.term}
                }; h < g.length;) {
                    var j = g[h];
                    if (-1 !== a.inArray(j, f)) {
                        var k = g.substr(0, h), l = a.extend({}, c, {term: k}), m = i(l);
                        null != m ? (e(m), g = g.substr(h + 1) || "", h = 0) : h++
                    } else h++
                }
                return {term: g}
            }, b
        }), b.define("select2/data/minimumInputLength", [], function () {
            function a(a, b, c) {
                this.minimumInputLength = c.get("minimumInputLength"), a.call(this, b, c)
            }

            return a.prototype.query = function (a, b, c) {
                if (b.term = b.term || "", b.term.length < this.minimumInputLength) return void this.trigger("results:message", {
                    message: "inputTooShort",
                    args: {minimum: this.minimumInputLength, input: b.term, params: b}
                });
                a.call(this, b, c)
            }, a
        }), b.define("select2/data/maximumInputLength", [], function () {
            function a(a, b, c) {
                this.maximumInputLength = c.get("maximumInputLength"), a.call(this, b, c)
            }

            return a.prototype.query = function (a, b, c) {
                if (b.term = b.term || "", this.maximumInputLength > 0 && b.term.length > this.maximumInputLength) return void this.trigger("results:message", {
                    message: "inputTooLong",
                    args: {maximum: this.maximumInputLength, input: b.term, params: b}
                });
                a.call(this, b, c)
            }, a
        }), b.define("select2/data/maximumSelectionLength", [], function () {
            function a(a, b, c) {
                this.maximumSelectionLength = c.get("maximumSelectionLength"), a.call(this, b, c)
            }

            return a.prototype.query = function (a, b, c) {
                var d = this;
                this.current(function (e) {
                    var f = null != e ? e.length : 0;
                    if (d.maximumSelectionLength > 0 && f >= d.maximumSelectionLength) return void d.trigger("results:message", {
                        message: "maximumSelected",
                        args: {maximum: d.maximumSelectionLength}
                    });
                    a.call(d, b, c)
                })
            }, a
        }), b.define("select2/dropdown", ["jquery", "./utils"], function (a, b) {
            function c(a, b) {
                this.$element = a, this.options = b, c.__super__.constructor.call(this)
            }

            return b.Extend(c, b.Observable), c.prototype.render = function () {
                var b = a('<span class="select2-dropdown"><span class="select2-results"></span></span>');
                return b.attr("dir", this.options.get("dir")), this.$dropdown = b, b
            }, c.prototype.bind = function () {
            }, c.prototype.position = function (a, b) {
            }, c.prototype.destroy = function () {
                this.$dropdown.remove()
            }, c
        }), b.define("select2/dropdown/search", ["jquery", "../utils"], function (a, b) {
            function c() {
            }

            return c.prototype.render = function (b) {
                var c = b.call(this),
                    d = a('<span class="select2-search select2-search--dropdown"><input class="select2-search__field" type="search" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" /></span>');
                return this.$searchContainer = d, this.$search = d.find("input"), c.prepend(d), c
            }, c.prototype.bind = function (b, c, d) {
                var e = this;
                b.call(this, c, d), this.$search.on("keydown", function (a) {
                    e.trigger("keypress", a), e._keyUpPrevented = a.isDefaultPrevented()
                }), this.$search.on("input", function (b) {
                    a(this).off("keyup")
                }), this.$search.on("keyup input", function (a) {
                    e.handleSearch(a)
                }), c.on("open", function () {
                    e.$search.attr("tabindex", 0), e.$search.focus(), window.setTimeout(function () {
                        e.$search.focus()
                    }, 0)
                }), c.on("close", function () {
                    e.$search.attr("tabindex", -1), e.$search.val(""), e.$search.blur()
                }), c.on("focus", function () {
                    c.isOpen() || e.$search.focus()
                }), c.on("results:all", function (a) {
                    if (null == a.query.term || "" === a.query.term) {
                        e.showSearch(a) ? e.$searchContainer.removeClass("select2-search--hide") : e.$searchContainer.addClass("select2-search--hide")
                    }
                })
            }, c.prototype.handleSearch = function (a) {
                if (!this._keyUpPrevented) {
                    var b = this.$search.val();
                    this.trigger("query", {term: b})
                }
                this._keyUpPrevented = !1
            }, c.prototype.showSearch = function (a, b) {
                return !0
            }, c
        }), b.define("select2/dropdown/hidePlaceholder", [], function () {
            function a(a, b, c, d) {
                this.placeholder = this.normalizePlaceholder(c.get("placeholder")), a.call(this, b, c, d)
            }

            return a.prototype.append = function (a, b) {
                b.results = this.removePlaceholder(b.results), a.call(this, b)
            }, a.prototype.normalizePlaceholder = function (a, b) {
                return "string" == typeof b && (b = {id: "", text: b}), b
            }, a.prototype.removePlaceholder = function (a, b) {
                for (var c = b.slice(0), d = b.length - 1; d >= 0; d--) {
                    var e = b[d];
                    this.placeholder.id === e.id && c.splice(d, 1)
                }
                return c
            }, a
        }), b.define("select2/dropdown/infiniteScroll", ["jquery"], function (a) {
            function b(a, b, c, d) {
                this.lastParams = {}, a.call(this, b, c, d), this.$loadingMore = this.createLoadingMore(), this.loading = !1
            }

            return b.prototype.append = function (a, b) {
                this.$loadingMore.remove(), this.loading = !1, a.call(this, b), this.showLoadingMore(b) && this.$results.append(this.$loadingMore)
            }, b.prototype.bind = function (b, c, d) {
                var e = this;
                b.call(this, c, d), c.on("query", function (a) {
                    e.lastParams = a, e.loading = !0
                }), c.on("query:append", function (a) {
                    e.lastParams = a, e.loading = !0
                }), this.$results.on("scroll", function () {
                    var b = a.contains(document.documentElement, e.$loadingMore[0]);
                    if (!e.loading && b) {
                        e.$results.offset().top + e.$results.outerHeight(!1) + 50 >= e.$loadingMore.offset().top + e.$loadingMore.outerHeight(!1) && e.loadMore()
                    }
                })
            }, b.prototype.loadMore = function () {
                this.loading = !0;
                var b = a.extend({}, {page: 1}, this.lastParams);
                b.page++, this.trigger("query:append", b)
            }, b.prototype.showLoadingMore = function (a, b) {
                return b.pagination && b.pagination.more
            }, b.prototype.createLoadingMore = function () {
                var b = a('<li class="select2-results__option select2-results__option--load-more"role="treeitem" aria-disabled="true"></li>'),
                    c = this.options.get("translations").get("loadingMore");
                return b.html(c(this.lastParams)), b
            }, b
        }), b.define("select2/dropdown/attachBody", ["jquery", "../utils"], function (a, b) {
            function c(b, c, d) {
                this.$dropdownParent = d.get("dropdownParent") || a(document.body), b.call(this, c, d)
            }

            return c.prototype.bind = function (a, b, c) {
                var d = this, e = !1;
                a.call(this, b, c), b.on("open", function () {
                    d._showDropdown(), d._attachPositioningHandler(b), e || (e = !0, b.on("results:all", function () {
                        d._positionDropdown(), d._resizeDropdown()
                    }), b.on("results:append", function () {
                        d._positionDropdown(), d._resizeDropdown()
                    }))
                }), b.on("close", function () {
                    d._hideDropdown(), d._detachPositioningHandler(b)
                }), this.$dropdownContainer.on("mousedown", function (a) {
                    a.stopPropagation()
                })
            }, c.prototype.destroy = function (a) {
                a.call(this), this.$dropdownContainer.remove()
            }, c.prototype.position = function (a, b, c) {
                b.attr("class", c.attr("class")), b.removeClass("select2"), b.addClass("select2-container--open"), b.css({
                    position: "absolute",
                    top: -999999
                }), this.$container = c
            }, c.prototype.render = function (b) {
                var c = a("<span></span>"), d = b.call(this);
                return c.append(d), this.$dropdownContainer = c, c
            }, c.prototype._hideDropdown = function (a) {
                this.$dropdownContainer.detach()
            }, c.prototype._attachPositioningHandler = function (c, d) {
                var e = this, f = "scroll.select2." + d.id, g = "resize.select2." + d.id,
                    h = "orientationchange.select2." + d.id, i = this.$container.parents().filter(b.hasScroll);
                i.each(function () {
                    b.StoreData(this, "select2-scroll-position", {x: a(this).scrollLeft(), y: a(this).scrollTop()})
                }), i.on(f, function (c) {
                    var d = b.GetData(this, "select2-scroll-position");
                    a(this).scrollTop(d.y)
                }), a(window).on(f + " " + g + " " + h, function (a) {
                    e._positionDropdown(), e._resizeDropdown()
                })
            }, c.prototype._detachPositioningHandler = function (c, d) {
                var e = "scroll.select2." + d.id, f = "resize.select2." + d.id, g = "orientationchange.select2." + d.id;
                this.$container.parents().filter(b.hasScroll).off(e), a(window).off(e + " " + f + " " + g)
            }, c.prototype._positionDropdown = function () {
                var b = a(window), c = this.$dropdown.hasClass("select2-dropdown--above"),
                    d = this.$dropdown.hasClass("select2-dropdown--below"), e = null, f = this.$container.offset();
                f.bottom = f.top + this.$container.outerHeight(!1);
                var g = {height: this.$container.outerHeight(!1)};
                g.top = f.top, g.bottom = f.top + g.height;
                var h = {height: this.$dropdown.outerHeight(!1)},
                    i = {top: b.scrollTop(), bottom: b.scrollTop() + b.height()}, j = i.top < f.top - h.height,
                    k = i.bottom > f.bottom + h.height, l = {left: f.left, top: g.bottom}, m = this.$dropdownParent;
                "static" === m.css("position") && (m = m.offsetParent());
                var n = m.offset();
                l.top -= n.top, l.left -= n.left, c || d || (e = "below"), k || !j || c ? !j && k && c && (e = "below") : e = "above", ("above" == e || c && "below" !== e) && (l.top = g.top - n.top - h.height), null != e && (this.$dropdown.removeClass("select2-dropdown--below select2-dropdown--above").addClass("select2-dropdown--" + e), this.$container.removeClass("select2-container--below select2-container--above").addClass("select2-container--" + e)), this.$dropdownContainer.css(l)
            }, c.prototype._resizeDropdown = function () {
                var a = {width: this.$container.outerWidth(!1) + "px"};
                this.options.get("dropdownAutoWidth") && (a.minWidth = a.width, a.position = "relative", a.width = "auto"), this.$dropdown.css(a)
            }, c.prototype._showDropdown = function (a) {
                this.$dropdownContainer.appendTo(this.$dropdownParent), this._positionDropdown(), this._resizeDropdown()
            }, c
        }), b.define("select2/dropdown/minimumResultsForSearch", [], function () {
            function a(b) {
                for (var c = 0, d = 0; d < b.length; d++) {
                    var e = b[d];
                    e.children ? c += a(e.children) : c++
                }
                return c
            }

            function b(a, b, c, d) {
                this.minimumResultsForSearch = c.get("minimumResultsForSearch"), this.minimumResultsForSearch < 0 && (this.minimumResultsForSearch = 1 / 0), a.call(this, b, c, d)
            }

            return b.prototype.showSearch = function (b, c) {
                return !(a(c.data.results) < this.minimumResultsForSearch) && b.call(this, c)
            }, b
        }), b.define("select2/dropdown/selectOnClose", ["../utils"], function (a) {
            function b() {
            }

            return b.prototype.bind = function (a, b, c) {
                var d = this;
                a.call(this, b, c), b.on("close", function (a) {
                    d._handleSelectOnClose(a)
                })
            }, b.prototype._handleSelectOnClose = function (b, c) {
                if (c && null != c.originalSelect2Event) {
                    var d = c.originalSelect2Event;
                    if ("select" === d._type || "unselect" === d._type) return
                }
                var e = this.getHighlightedResults();
                if (!(e.length < 1)) {
                    var f = a.GetData(e[0], "data");
                    null != f.element && f.element.selected || null == f.element && f.selected || this.trigger("select", {data: f})
                }
            }, b
        }), b.define("select2/dropdown/closeOnSelect", [], function () {
            function a() {
            }

            return a.prototype.bind = function (a, b, c) {
                var d = this;
                a.call(this, b, c), b.on("select", function (a) {
                    d._selectTriggered(a)
                }), b.on("unselect", function (a) {
                    d._selectTriggered(a)
                })
            }, a.prototype._selectTriggered = function (a, b) {
                var c = b.originalEvent;
                c && c.ctrlKey || this.trigger("close", {originalEvent: c, originalSelect2Event: b})
            }, a
        }), b.define("select2/i18n/en", [], function () {
            return {
                errorLoading: function () {
                    return "The results could not be loaded."
                }, inputTooLong: function (a) {
                    var b = a.input.length - a.maximum, c = "Please delete " + b + " character";
                    return 1 != b && (c += "s"), c
                }, inputTooShort: function (a) {
                    return "Please enter " + (a.minimum - a.input.length) + " or more characters"
                }, loadingMore: function () {
                    return "Loading more results…"
                }, maximumSelected: function (a) {
                    var b = "You can only select " + a.maximum + " item";
                    return 1 != a.maximum && (b += "s"), b
                }, noResults: function () {
                    return "No results found"
                }, searching: function () {
                    return "Searching…"
                }
            }
        }), b.define("select2/defaults", ["jquery", "require", "./results", "./selection/single", "./selection/multiple", "./selection/placeholder", "./selection/allowClear", "./selection/search", "./selection/eventRelay", "./utils", "./translation", "./diacritics", "./data/select", "./data/array", "./data/ajax", "./data/tags", "./data/tokenizer", "./data/minimumInputLength", "./data/maximumInputLength", "./data/maximumSelectionLength", "./dropdown", "./dropdown/search", "./dropdown/hidePlaceholder", "./dropdown/infiniteScroll", "./dropdown/attachBody", "./dropdown/minimumResultsForSearch", "./dropdown/selectOnClose", "./dropdown/closeOnSelect", "./i18n/en"], function (a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C) {
            function D() {
                this.reset()
            }

            return D.prototype.apply = function (l) {
                if (l = a.extend(!0, {}, this.defaults, l), null == l.dataAdapter) {
                    if (null != l.ajax ? l.dataAdapter = o : null != l.data ? l.dataAdapter = n : l.dataAdapter = m, l.minimumInputLength > 0 && (l.dataAdapter = j.Decorate(l.dataAdapter, r)), l.maximumInputLength > 0 && (l.dataAdapter = j.Decorate(l.dataAdapter, s)), l.maximumSelectionLength > 0 && (l.dataAdapter = j.Decorate(l.dataAdapter, t)), l.tags && (l.dataAdapter = j.Decorate(l.dataAdapter, p)), null == l.tokenSeparators && null == l.tokenizer || (l.dataAdapter = j.Decorate(l.dataAdapter, q)), null != l.query) {
                        var C = b(l.amdBase + "compat/query");
                        l.dataAdapter = j.Decorate(l.dataAdapter, C)
                    }
                    if (null != l.initSelection) {
                        var D = b(l.amdBase + "compat/initSelection");
                        l.dataAdapter = j.Decorate(l.dataAdapter, D)
                    }
                }
                if (null == l.resultsAdapter && (l.resultsAdapter = c, null != l.ajax && (l.resultsAdapter = j.Decorate(l.resultsAdapter, x)), null != l.placeholder && (l.resultsAdapter = j.Decorate(l.resultsAdapter, w)), l.selectOnClose && (l.resultsAdapter = j.Decorate(l.resultsAdapter, A))), null == l.dropdownAdapter) {
                    if (l.multiple) l.dropdownAdapter = u; else {
                        var E = j.Decorate(u, v);
                        l.dropdownAdapter = E
                    }
                    if (0 !== l.minimumResultsForSearch && (l.dropdownAdapter = j.Decorate(l.dropdownAdapter, z)), l.closeOnSelect && (l.dropdownAdapter = j.Decorate(l.dropdownAdapter, B)), null != l.dropdownCssClass || null != l.dropdownCss || null != l.adaptDropdownCssClass) {
                        var F = b(l.amdBase + "compat/dropdownCss");
                        l.dropdownAdapter = j.Decorate(l.dropdownAdapter, F)
                    }
                    l.dropdownAdapter = j.Decorate(l.dropdownAdapter, y)
                }
                if (null == l.selectionAdapter) {
                    if (l.multiple ? l.selectionAdapter = e : l.selectionAdapter = d, null != l.placeholder && (l.selectionAdapter = j.Decorate(l.selectionAdapter, f)), l.allowClear && (l.selectionAdapter = j.Decorate(l.selectionAdapter, g)), l.multiple && (l.selectionAdapter = j.Decorate(l.selectionAdapter, h)), null != l.containerCssClass || null != l.containerCss || null != l.adaptContainerCssClass) {
                        var G = b(l.amdBase + "compat/containerCss");
                        l.selectionAdapter = j.Decorate(l.selectionAdapter, G)
                    }
                    l.selectionAdapter = j.Decorate(l.selectionAdapter, i)
                }
                if ("string" == typeof l.language) if (l.language.indexOf("-") > 0) {
                    var H = l.language.split("-"), I = H[0];
                    l.language = [l.language, I]
                } else l.language = [l.language];
                if (a.isArray(l.language)) {
                    var J = new k;
                    l.language.push("en");
                    for (var K = l.language, L = 0; L < K.length; L++) {
                        var M = K[L], N = {};
                        try {
                            N = k.loadPath(M)
                        } catch (a) {
                            try {
                                M = this.defaults.amdLanguageBase + M, N = k.loadPath(M)
                            } catch (a) {
                                l.debug && window.console && console.warn && console.warn('Select2: The language file for "' + M + '" could not be automatically loaded. A fallback will be used instead.');
                                continue
                            }
                        }
                        J.extend(N)
                    }
                    l.translations = J
                } else {
                    var O = k.loadPath(this.defaults.amdLanguageBase + "en"), P = new k(l.language);
                    P.extend(O), l.translations = P
                }
                return l
            }, D.prototype.reset = function () {
                function b(a) {
                    function b(a) {
                        return l[a] || a
                    }

                    return a.replace(/[^\u0000-\u007E]/g, b)
                }

                function c(d, e) {
                    if ("" === a.trim(d.term)) return e;
                    if (e.children && e.children.length > 0) {
                        for (var f = a.extend(!0, {}, e), g = e.children.length - 1; g >= 0; g--) {
                            null == c(d, e.children[g]) && f.children.splice(g, 1)
                        }
                        return f.children.length > 0 ? f : c(d, f)
                    }
                    var h = b(e.text).toUpperCase(), i = b(d.term).toUpperCase();
                    return h.indexOf(i) > -1 ? e : null
                }

                this.defaults = {
                    amdBase: "./",
                    amdLanguageBase: "./i18n/",
                    closeOnSelect: !0,
                    debug: !1,
                    dropdownAutoWidth: !1,
                    escapeMarkup: j.escapeMarkup,
                    language: C,
                    matcher: c,
                    minimumInputLength: 0,
                    maximumInputLength: 0,
                    maximumSelectionLength: 0,
                    minimumResultsForSearch: 0,
                    selectOnClose: !1,
                    sorter: function (a) {
                        return a
                    },
                    templateResult: function (a) {
                        return a.text
                    },
                    templateSelection: function (a) {
                        return a.text
                    },
                    theme: "default",
                    width: "resolve"
                }
            }, D.prototype.set = function (b, c) {
                var d = a.camelCase(b), e = {};
                e[d] = c;
                var f = j._convertData(e);
                a.extend(!0, this.defaults, f)
            }, new D
        }), b.define("select2/options", ["require", "jquery", "./defaults", "./utils"], function (a, b, c, d) {
            function e(b, e) {
                if (this.options = b, null != e && this.fromElement(e), this.options = c.apply(this.options), e && e.is("input")) {
                    var f = a(this.get("amdBase") + "compat/inputData");
                    this.options.dataAdapter = d.Decorate(this.options.dataAdapter, f)
                }
            }

            return e.prototype.fromElement = function (a) {
                var c = ["select2"];
                null == this.options.multiple && (this.options.multiple = a.prop("multiple")), null == this.options.disabled && (this.options.disabled = a.prop("disabled")), null == this.options.language && (a.prop("lang") ? this.options.language = a.prop("lang").toLowerCase() : a.closest("[lang]").prop("lang") && (this.options.language = a.closest("[lang]").prop("lang"))), null == this.options.dir && (a.prop("dir") ? this.options.dir = a.prop("dir") : a.closest("[dir]").prop("dir") ? this.options.dir = a.closest("[dir]").prop("dir") : this.options.dir = "ltr"), a.prop("disabled", this.options.disabled), a.prop("multiple", this.options.multiple), d.GetData(a[0], "select2Tags") && (this.options.debug && window.console && console.warn && console.warn('Select2: The `data-select2-tags` attribute has been changed to use the `data-data` and `data-tags="true"` attributes and will be removed in future versions of Select2.'), d.StoreData(a[0], "data", d.GetData(a[0], "select2Tags")), d.StoreData(a[0], "tags", !0)), d.GetData(a[0], "ajaxUrl") && (this.options.debug && window.console && console.warn && console.warn("Select2: The `data-ajax-url` attribute has been changed to `data-ajax--url` and support for the old attribute will be removed in future versions of Select2."), a.attr("ajax--url", d.GetData(a[0], "ajaxUrl")), d.StoreData(a[0], "ajax-Url", d.GetData(a[0], "ajaxUrl")));
                var e = {};
                e = b.fn.jquery && "1." == b.fn.jquery.substr(0, 2) && a[0].dataset ? b.extend(!0, {}, a[0].dataset, d.GetData(a[0])) : d.GetData(a[0]);
                var f = b.extend(!0, {}, e);
                f = d._convertData(f);
                for (var g in f) b.inArray(g, c) > -1 || (b.isPlainObject(this.options[g]) ? b.extend(this.options[g], f[g]) : this.options[g] = f[g]);
                return this
            }, e.prototype.get = function (a) {
                return this.options[a]
            }, e.prototype.set = function (a, b) {
                this.options[a] = b
            }, e
        }), b.define("select2/core", ["jquery", "./options", "./utils", "./keys"], function (a, b, c, d) {
            var e = function (a, d) {
                null != c.GetData(a[0], "select2") && c.GetData(a[0], "select2").destroy(), this.$element = a, this.id = this._generateId(a), d = d || {}, this.options = new b(d, a), e.__super__.constructor.call(this);
                var f = a.attr("tabindex") || 0;
                c.StoreData(a[0], "old-tabindex", f), a.attr("tabindex", "-1");
                var g = this.options.get("dataAdapter");
                this.dataAdapter = new g(a, this.options);
                var h = this.render();
                this._placeContainer(h);
                var i = this.options.get("selectionAdapter");
                this.selection = new i(a, this.options), this.$selection = this.selection.render(), this.selection.position(this.$selection, h);
                var j = this.options.get("dropdownAdapter");
                this.dropdown = new j(a, this.options), this.$dropdown = this.dropdown.render(), this.dropdown.position(this.$dropdown, h);
                var k = this.options.get("resultsAdapter");
                this.results = new k(a, this.options, this.dataAdapter), this.$results = this.results.render(), this.results.position(this.$results, this.$dropdown);
                var l = this;
                this._bindAdapters(), this._registerDomEvents(), this._registerDataEvents(), this._registerSelectionEvents(), this._registerDropdownEvents(), this._registerResultsEvents(), this._registerEvents(), this.dataAdapter.current(function (a) {
                    l.trigger("selection:update", {data: a})
                }), a.addClass("select2-hidden-accessible"), a.attr("aria-hidden", "true"), this._syncAttributes(), c.StoreData(a[0], "select2", this), a.data("select2", this)
            };
            return c.Extend(e, c.Observable), e.prototype._generateId = function (a) {
                var b = "";
                return b = null != a.attr("id") ? a.attr("id") : null != a.attr("name") ? a.attr("name") + "-" + c.generateChars(2) : c.generateChars(4), b = b.replace(/(:|\.|\[|\]|,)/g, ""), b = "select2-" + b
            }, e.prototype._placeContainer = function (a) {
                a.insertAfter(this.$element);
                var b = this._resolveWidth(this.$element, this.options.get("width"));
                null != b && a.css("width", b)
            }, e.prototype._resolveWidth = function (a, b) {
                var c = /^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i;
                if ("resolve" == b) {
                    var d = this._resolveWidth(a, "style");
                    return null != d ? d : this._resolveWidth(a, "element")
                }
                if ("element" == b) {
                    var e = a.outerWidth(!1);
                    return e <= 0 ? "auto" : e + "px"
                }
                if ("style" == b) {
                    var f = a.attr("style");
                    if ("string" != typeof f) return null;
                    for (var g = f.split(";"), h = 0, i = g.length; h < i; h += 1) {
                        var j = g[h].replace(/\s/g, ""), k = j.match(c);
                        if (null !== k && k.length >= 1) return k[1]
                    }
                    return null
                }
                return b
            }, e.prototype._bindAdapters = function () {
                this.dataAdapter.bind(this, this.$container), this.selection.bind(this, this.$container), this.dropdown.bind(this, this.$container), this.results.bind(this, this.$container)
            }, e.prototype._registerDomEvents = function () {
                var b = this;
                this.$element.on("change.select2", function () {
                    b.dataAdapter.current(function (a) {
                        b.trigger("selection:update", {data: a})
                    })
                }), this.$element.on("focus.select2", function (a) {
                    b.trigger("focus", a)
                }), this._syncA = c.bind(this._syncAttributes, this), this._syncS = c.bind(this._syncSubtree, this), this.$element[0].attachEvent && this.$element[0].attachEvent("onpropertychange", this._syncA);
                var d = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
                null != d ? (this._observer = new d(function (c) {
                    a.each(c, b._syncA), a.each(c, b._syncS)
                }), this._observer.observe(this.$element[0], {
                    attributes: !0,
                    childList: !0,
                    subtree: !1
                })) : this.$element[0].addEventListener && (this.$element[0].addEventListener("DOMAttrModified", b._syncA, !1), this.$element[0].addEventListener("DOMNodeInserted", b._syncS, !1), this.$element[0].addEventListener("DOMNodeRemoved", b._syncS, !1))
            }, e.prototype._registerDataEvents = function () {
                var a = this;
                this.dataAdapter.on("*", function (b, c) {
                    a.trigger(b, c)
                })
            }, e.prototype._registerSelectionEvents = function () {
                var b = this, c = ["toggle", "focus"];
                this.selection.on("toggle", function () {
                    b.toggleDropdown()
                }), this.selection.on("focus", function (a) {
                    b.focus(a)
                }), this.selection.on("*", function (d, e) {
                    -1 === a.inArray(d, c) && b.trigger(d, e)
                })
            }, e.prototype._registerDropdownEvents = function () {
                var a = this;
                this.dropdown.on("*", function (b, c) {
                    a.trigger(b, c)
                })
            }, e.prototype._registerResultsEvents = function () {
                var a = this;
                this.results.on("*", function (b, c) {
                    a.trigger(b, c)
                })
            }, e.prototype._registerEvents = function () {
                var a = this;
                this.on("open", function () {
                    a.$container.addClass("select2-container--open")
                }), this.on("close", function () {
                    a.$container.removeClass("select2-container--open")
                }), this.on("enable", function () {
                    a.$container.removeClass("select2-container--disabled")
                }), this.on("disable", function () {
                    a.$container.addClass("select2-container--disabled")
                }), this.on("blur", function () {
                    a.$container.removeClass("select2-container--focus")
                }), this.on("query", function (b) {
                    a.isOpen() || a.trigger("open", {}), this.dataAdapter.query(b, function (c) {
                        a.trigger("results:all", {data: c, query: b})
                    })
                }), this.on("query:append", function (b) {
                    this.dataAdapter.query(b, function (c) {
                        a.trigger("results:append", {data: c, query: b})
                    })
                }), this.on("keypress", function (b) {
                    var c = b.which;
                    a.isOpen() ? c === d.ESC || c === d.TAB || c === d.UP && b.altKey ? (a.close(), b.preventDefault()) : c === d.ENTER ? (a.trigger("results:select", {}), b.preventDefault()) : c === d.SPACE && b.ctrlKey ? (a.trigger("results:toggle", {}), b.preventDefault()) : c === d.UP ? (a.trigger("results:previous", {}), b.preventDefault()) : c === d.DOWN && (a.trigger("results:next", {}), b.preventDefault()) : (c === d.ENTER || c === d.SPACE || c === d.DOWN && b.altKey) && (a.open(), b.preventDefault())
                })
            }, e.prototype._syncAttributes = function () {
                this.options.set("disabled", this.$element.prop("disabled")), this.options.get("disabled") ? (this.isOpen() && this.close(), this.trigger("disable", {})) : this.trigger("enable", {})
            }, e.prototype._syncSubtree = function (a, b) {
                var c = !1, d = this;
                if (!a || !a.target || "OPTION" === a.target.nodeName || "OPTGROUP" === a.target.nodeName) {
                    if (b) if (b.addedNodes && b.addedNodes.length > 0) for (var e = 0; e < b.addedNodes.length; e++) {
                        var f = b.addedNodes[e];
                        f.selected && (c = !0)
                    } else b.removedNodes && b.removedNodes.length > 0 && (c = !0); else c = !0;
                    c && this.dataAdapter.current(function (a) {
                        d.trigger("selection:update", {data: a})
                    })
                }
            }, e.prototype.trigger = function (a, b) {
                var c = e.__super__.trigger, d = {
                    open: "opening",
                    close: "closing",
                    select: "selecting",
                    unselect: "unselecting",
                    clear: "clearing"
                };
                if (void 0 === b && (b = {}), a in d) {
                    var f = d[a], g = {prevented: !1, name: a, args: b};
                    if (c.call(this, f, g), g.prevented) return void (b.prevented = !0)
                }
                c.call(this, a, b)
            }, e.prototype.toggleDropdown = function () {
                this.options.get("disabled") || (this.isOpen() ? this.close() : this.open())
            }, e.prototype.open = function () {
                this.isOpen() || this.trigger("query", {})
            }, e.prototype.close = function () {
                this.isOpen() && this.trigger("close", {})
            }, e.prototype.isOpen = function () {
                return this.$container.hasClass("select2-container--open")
            }, e.prototype.hasFocus = function () {
                return this.$container.hasClass("select2-container--focus")
            }, e.prototype.focus = function (a) {
                this.hasFocus() || (this.$container.addClass("select2-container--focus"), this.trigger("focus", {}))
            }, e.prototype.enable = function (a) {
                this.options.get("debug") && window.console && console.warn && console.warn('Select2: The `select2("enable")` method has been deprecated and will be removed in later Select2 versions. Use $element.prop("disabled") instead.'), null != a && 0 !== a.length || (a = [!0]);
                var b = !a[0];
                this.$element.prop("disabled", b)
            }, e.prototype.data = function () {
                this.options.get("debug") && arguments.length > 0 && window.console && console.warn && console.warn('Select2: Data can no longer be set using `select2("data")`. You should consider setting the value instead using `$element.val()`.');
                var a = [];
                return this.dataAdapter.current(function (b) {
                    a = b
                }), a
            }, e.prototype.val = function (b) {
                if (this.options.get("debug") && window.console && console.warn && console.warn('Select2: The `select2("val")` method has been deprecated and will be removed in later Select2 versions. Use $element.val() instead.'), null == b || 0 === b.length) return this.$element.val();
                var c = b[0];
                a.isArray(c) && (c = a.map(c, function (a) {
                    return a.toString()
                })), this.$element.val(c).trigger("change")
            }, e.prototype.destroy = function () {
                this.$container.remove(), this.$element[0].detachEvent && this.$element[0].detachEvent("onpropertychange", this._syncA), null != this._observer ? (this._observer.disconnect(), this._observer = null) : this.$element[0].removeEventListener && (this.$element[0].removeEventListener("DOMAttrModified", this._syncA, !1), this.$element[0].removeEventListener("DOMNodeInserted", this._syncS, !1), this.$element[0].removeEventListener("DOMNodeRemoved", this._syncS, !1)), this._syncA = null, this._syncS = null, this.$element.off(".select2"), this.$element.attr("tabindex", c.GetData(this.$element[0], "old-tabindex")), this.$element.removeClass("select2-hidden-accessible"), this.$element.attr("aria-hidden", "false"), c.RemoveData(this.$element[0]), this.$element.removeData("select2"), this.dataAdapter.destroy(), this.selection.destroy(), this.dropdown.destroy(), this.results.destroy(), this.dataAdapter = null, this.selection = null, this.dropdown = null, this.results = null
            }, e.prototype.render = function () {
                var b = a('<span class="select2 select2-container"><span class="selection"></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>');
                return b.attr("dir", this.options.get("dir")), this.$container = b, this.$container.addClass("select2-container--" + this.options.get("theme")), c.StoreData(b[0], "element", this.$element), b
            }, e
        }), b.define("select2/compat/utils", ["jquery"], function (a) {
            function b(b, c, d) {
                var e, f, g = [];
                e = a.trim(b.attr("class")), e && (e = "" + e, a(e.split(/\s+/)).each(function () {
                    0 === this.indexOf("select2-") && g.push(this)
                })), e = a.trim(c.attr("class")), e && (e = "" + e, a(e.split(/\s+/)).each(function () {
                    0 !== this.indexOf("select2-") && null != (f = d(this)) && g.push(f)
                })), b.attr("class", g.join(" "))
            }

            return {syncCssClasses: b}
        }), b.define("select2/compat/containerCss", ["jquery", "./utils"], function (a, b) {
            function c(a) {
                return null
            }

            function d() {
            }

            return d.prototype.render = function (d) {
                var e = d.call(this), f = this.options.get("containerCssClass") || "";
                a.isFunction(f) && (f = f(this.$element));
                var g = this.options.get("adaptContainerCssClass");
                if (g = g || c, -1 !== f.indexOf(":all:")) {
                    f = f.replace(":all:", "");
                    var h = g;
                    g = function (a) {
                        var b = h(a);
                        return null != b ? b + " " + a : a
                    }
                }
                var i = this.options.get("containerCss") || {};
                return a.isFunction(i) && (i = i(this.$element)), b.syncCssClasses(e, this.$element, g), e.css(i), e.addClass(f), e
            }, d
        }), b.define("select2/compat/dropdownCss", ["jquery", "./utils"], function (a, b) {
            function c(a) {
                return null
            }

            function d() {
            }

            return d.prototype.render = function (d) {
                var e = d.call(this), f = this.options.get("dropdownCssClass") || "";
                a.isFunction(f) && (f = f(this.$element));
                var g = this.options.get("adaptDropdownCssClass");
                if (g = g || c, -1 !== f.indexOf(":all:")) {
                    f = f.replace(":all:", "");
                    var h = g;
                    g = function (a) {
                        var b = h(a);
                        return null != b ? b + " " + a : a
                    }
                }
                var i = this.options.get("dropdownCss") || {};
                return a.isFunction(i) && (i = i(this.$element)), b.syncCssClasses(e, this.$element, g), e.css(i), e.addClass(f), e
            }, d
        }), b.define("select2/compat/initSelection", ["jquery"], function (a) {
            function b(a, b, c) {
                c.get("debug") && window.console && console.warn && console.warn("Select2: The `initSelection` option has been deprecated in favor of a custom data adapter that overrides the `current` method. This method is now called multiple times instead of a single time when the instance is initialized. Support will be removed for the `initSelection` option in future versions of Select2"), this.initSelection = c.get("initSelection"), this._isInitialized = !1, a.call(this, b, c)
            }

            return b.prototype.current = function (b, c) {
                var d = this;
                if (this._isInitialized) return void b.call(this, c);
                this.initSelection.call(null, this.$element, function (b) {
                    d._isInitialized = !0, a.isArray(b) || (b = [b]), c(b)
                })
            }, b
        }), b.define("select2/compat/inputData", ["jquery", "../utils"], function (a, b) {
            function c(a, b, c) {
                this._currentData = [], this._valueSeparator = c.get("valueSeparator") || ",", "hidden" === b.prop("type") && c.get("debug") && console && console.warn && console.warn("Select2: Using a hidden input with Select2 is no longer supported and may stop working in the future. It is recommended to use a `<select>` element instead."), a.call(this, b, c)
            }

            return c.prototype.current = function (b, c) {
                function d(b, c) {
                    var e = [];
                    return b.selected || -1 !== a.inArray(b.id, c) ? (b.selected = !0, e.push(b)) : b.selected = !1, b.children && e.push.apply(e, d(b.children, c)), e
                }

                for (var e = [], f = 0; f < this._currentData.length; f++) {
                    var g = this._currentData[f];
                    e.push.apply(e, d(g, this.$element.val().split(this._valueSeparator)))
                }
                c(e)
            }, c.prototype.select = function (b, c) {
                if (this.options.get("multiple")) {
                    var d = this.$element.val();
                    d += this._valueSeparator + c.id, this.$element.val(d), this.$element.trigger("change")
                } else this.current(function (b) {
                    a.map(b, function (a) {
                        a.selected = !1
                    })
                }), this.$element.val(c.id), this.$element.trigger("change")
            }, c.prototype.unselect = function (a, b) {
                var c = this;
                b.selected = !1, this.current(function (a) {
                    for (var d = [], e = 0; e < a.length; e++) {
                        var f = a[e];
                        b.id != f.id && d.push(f.id)
                    }
                    c.$element.val(d.join(c._valueSeparator)), c.$element.trigger("change")
                })
            }, c.prototype.query = function (a, b, c) {
                for (var d = [], e = 0; e < this._currentData.length; e++) {
                    var f = this._currentData[e], g = this.matches(b, f);
                    null !== g && d.push(g)
                }
                c({results: d})
            }, c.prototype.addOptions = function (c, d) {
                var e = a.map(d, function (a) {
                    return b.GetData(a[0], "data")
                });
                this._currentData.push.apply(this._currentData, e)
            }, c
        }), b.define("select2/compat/matcher", ["jquery"], function (a) {
            function b(b) {
                function c(c, d) {
                    var e = a.extend(!0, {}, d);
                    if (null == c.term || "" === a.trim(c.term)) return e;
                    if (d.children) {
                        for (var f = d.children.length - 1; f >= 0; f--) {
                            var g = d.children[f];
                            b(c.term, g.text, g) || e.children.splice(f, 1)
                        }
                        if (e.children.length > 0) return e
                    }
                    return b(c.term, d.text, d) ? e : null
                }

                return c
            }

            return b
        }), b.define("select2/compat/query", [], function () {
            function a(a, b, c) {
                c.get("debug") && window.console && console.warn && console.warn("Select2: The `query` option has been deprecated in favor of a custom data adapter that overrides the `query` method. Support will be removed for the `query` option in future versions of Select2."), a.call(this, b, c)
            }

            return a.prototype.query = function (a, b, c) {
                b.callback = c, this.options.get("query").call(null, b)
            }, a
        }), b.define("select2/dropdown/attachContainer", [], function () {
            function a(a, b, c) {
                a.call(this, b, c)
            }

            return a.prototype.position = function (a, b, c) {
                c.find(".dropdown-wrapper").append(b), b.addClass("select2-dropdown--below"), c.addClass("select2-container--below")
            }, a
        }), b.define("select2/dropdown/stopPropagation", [], function () {
            function a() {
            }

            return a.prototype.bind = function (a, b, c) {
                a.call(this, b, c);
                var d = ["blur", "change", "click", "dblclick", "focus", "focusin", "focusout", "input", "keydown", "keyup", "keypress", "mousedown", "mouseenter", "mouseleave", "mousemove", "mouseover", "mouseup", "search", "touchend", "touchstart"];
                this.$dropdown.on(d.join(" "), function (a) {
                    a.stopPropagation()
                })
            }, a
        }), b.define("select2/selection/stopPropagation", [], function () {
            function a() {
            }

            return a.prototype.bind = function (a, b, c) {
                a.call(this, b, c);
                var d = ["blur", "change", "click", "dblclick", "focus", "focusin", "focusout", "input", "keydown", "keyup", "keypress", "mousedown", "mouseenter", "mouseleave", "mousemove", "mouseover", "mouseup", "search", "touchend", "touchstart"];
                this.$selection.on(d.join(" "), function (a) {
                    a.stopPropagation()
                })
            }, a
        }), function (c) {
            "function" == typeof b.define && b.define.amd ? b.define("jquery-mousewheel", ["jquery"], c) : "object" == typeof exports ? module.exports = c : c(a)
        }(function (a) {
            function b(b) {
                var g = b || window.event, h = i.call(arguments, 1), j = 0, l = 0, m = 0, n = 0, o = 0, p = 0;
                if (b = a.event.fix(g), b.type = "mousewheel", "detail" in g && (m = -1 * g.detail), "wheelDelta" in g && (m = g.wheelDelta), "wheelDeltaY" in g && (m = g.wheelDeltaY), "wheelDeltaX" in g && (l = -1 * g.wheelDeltaX), "axis" in g && g.axis === g.HORIZONTAL_AXIS && (l = -1 * m, m = 0), j = 0 === m ? l : m, "deltaY" in g && (m = -1 * g.deltaY, j = m), "deltaX" in g && (l = g.deltaX, 0 === m && (j = -1 * l)), 0 !== m || 0 !== l) {
                    if (1 === g.deltaMode) {
                        var q = a.data(this, "mousewheel-line-height");
                        j *= q, m *= q, l *= q
                    } else if (2 === g.deltaMode) {
                        var r = a.data(this, "mousewheel-page-height");
                        j *= r, m *= r, l *= r
                    }
                    if (n = Math.max(Math.abs(m), Math.abs(l)), (!f || n < f) && (f = n, d(g, n) && (f /= 40)), d(g, n) && (j /= 40, l /= 40, m /= 40), j = Math[j >= 1 ? "floor" : "ceil"](j / f), l = Math[l >= 1 ? "floor" : "ceil"](l / f), m = Math[m >= 1 ? "floor" : "ceil"](m / f), k.settings.normalizeOffset && this.getBoundingClientRect) {
                        var s = this.getBoundingClientRect();
                        o = b.clientX - s.left, p = b.clientY - s.top
                    }
                    return b.deltaX = l, b.deltaY = m, b.deltaFactor = f, b.offsetX = o, b.offsetY = p, b.deltaMode = 0, h.unshift(b, j, l, m), e && clearTimeout(e), e = setTimeout(c, 200), (a.event.dispatch || a.event.handle).apply(this, h)
                }
            }

            function c() {
                f = null
            }

            function d(a, b) {
                return k.settings.adjustOldDeltas && "mousewheel" === a.type && b % 120 == 0
            }

            var e, f, g = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
                h = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
                i = Array.prototype.slice;
            if (a.event.fixHooks) for (var j = g.length; j;) a.event.fixHooks[g[--j]] = a.event.mouseHooks;
            var k = a.event.special.mousewheel = {
                version: "3.1.12", setup: function () {
                    if (this.addEventListener) for (var c = h.length; c;) this.addEventListener(h[--c], b, !1); else this.onmousewheel = b;
                    a.data(this, "mousewheel-line-height", k.getLineHeight(this)), a.data(this, "mousewheel-page-height", k.getPageHeight(this))
                }, teardown: function () {
                    if (this.removeEventListener) for (var c = h.length; c;) this.removeEventListener(h[--c], b, !1); else this.onmousewheel = null;
                    a.removeData(this, "mousewheel-line-height"), a.removeData(this, "mousewheel-page-height")
                }, getLineHeight: function (b) {
                    var c = a(b), d = c["offsetParent" in a.fn ? "offsetParent" : "parent"]();
                    return d.length || (d = a("body")), parseInt(d.css("fontSize"), 10) || parseInt(c.css("fontSize"), 10) || 16
                }, getPageHeight: function (b) {
                    return a(b).height()
                }, settings: {adjustOldDeltas: !0, normalizeOffset: !0}
            };
            a.fn.extend({
                mousewheel: function (a) {
                    return a ? this.bind("mousewheel", a) : this.trigger("mousewheel")
                }, unmousewheel: function (a) {
                    return this.unbind("mousewheel", a)
                }
            })
        }), b.define("jquery.select2", ["jquery", "jquery-mousewheel", "./select2/core", "./select2/defaults", "./select2/utils"], function (a, b, c, d, e) {
            if (null == a.fn.select2) {
                var f = ["open", "close", "destroy"];
                a.fn.select2 = function (b) {
                    if ("object" == typeof (b = b || {})) return this.each(function () {
                        var d = a.extend(!0, {}, b);
                        new c(a(this), d)
                    }), this;
                    if ("string" == typeof b) {
                        var d, g = Array.prototype.slice.call(arguments, 1);
                        return this.each(function () {
                            var a = e.GetData(this, "select2");
                            null == a && window.console && console.error && console.error("The select2('" + b + "') method was called on an element that is not using Select2."), d = a[b].apply(a, g)
                        }), a.inArray(b, f) > -1 ? this : d
                    }
                    throw new Error("Invalid arguments for Select2: " + b)
                }
            }
            return null == a.fn.select2.defaults && (a.fn.select2.defaults = d), c
        }), {define: b.define, require: b.require}
    }(), c = b.require("jquery.select2");
    return a.fn.select2.amd = b, c
});
$(document).ready(function () {
    if ($('#maps-location').length > 0) {
        initialize();
    }
});

function initialize() {
    if ($('#maps-location').length > 0) {
        var latlng = new google.maps.LatLng(google_maps_lat, google_maps_long);
    }
    var myOptions = {zoom: 19, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP,};
    var map = new google.maps.Map(document.getElementById("maps-location"), myOptions);
    var myMarker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: site_name,
        icon: base_url + "public/images/Zin-map.png",
        label: {color: '#ce171f', fontWeight: '700', fontSize: '14px', text: site_name,},
        icon: {
            labelOrigin: new google.maps.Point(11, 60),
            url: base_url + "public/images/Zin-map.png",
            size: new google.maps.Size(30, 48),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(11, 40),
        },
    });
    var contentString = '<div id="content">' + '<h2 style="font-size:14px;color:#ce171f;padding-top: 5px;">' + site_name + '</h2>' + '<p style="font-size:14px;">Hotline: ' + phone_number + '</p>' + '<p style="font-size:14px;">Giờ mở cửa: ' + Open_door + '</p>' + '</div>';
    var infowindow = new google.maps.InfoWindow({content: contentString});
    myMarker.addListener('click', function () {
        infowindow.open(map, myMarker);
    });
};var flagSearch = true;
var LOC = {
    loadCity: function loadCity(dataSelected) {
        let city_id = $('select[name="city_id"]');
        if (city_id.length > 0) {
            city_id.select2({
                allowClear: true,
                placeholder: "Chọn tỉnh/thành phố",
                data: dataSelected,
                ajax: {
                    url: base_url + 'cart/ajax_load_city',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {results: data};
                    },
                    cache: true
                }
            });
        }
        city_id.change(function () {
            LOC.loadDistrict($(this).val());
        });
    }, loadDistrict: function loadDistrict(city_id, dataSelected) {
        let district_id = $('select[name="district_id"]');
        if (district_id.length > 0) {
            district_id.select2({
                allowClear: true,
                placeholder: "Chọn quận huyện",
                data: dataSelected,
                ajax: {
                    url: base_url + 'cart/ajax_load_district/' + city_id,
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {results: data};
                    },
                    cache: true
                }
            });
        }
        district_id.change(function () {
            CART.fee_ship();
        })
    }
}
var FUNC = {
    ajaxShowRequest: function (formData, jqForm, options) {
        if (jqForm.find('[type="submit"]').length > 0) jqForm.find('[type="submit"]').append(' <i class="fa fa-spinner fa-spin ml-2" style="color: #ffffff;"></i>');
        return true;
    }, ajaxShowResponse: function (response, statusText, xhr, $form) {
        if (response.csrf_form) {
            $form.find('input[name="' + response.csrf_form.csrf_name + '"]').val(response.csrf_form.csrf_value);
            $('meta[name="csrf_form_token"]').attr('content', response.csrf_form.csrf_value);
        }
        $form.find('.fa-spin').remove();
        if (typeof response.type !== 'undefined') {
            toastr[response.type](response.message);
            if (response.type === "warning") {
                $form.find('.form-group').removeClass('has-warning');
                $form.find('.text-danger').remove();
                $.each(response.validation, function (key, val) {
                    $form.find('[name="' + key + '"]').after(val).parent().addClass('has-warning');
                });
            } else {
                $form.find('.form-group').removeClass('has-warning');
                $form.find('.text-danger').remove();
                if (response.type === "success") {
                    switch ($form.attr('id')) {
                        case'product_addtocart_form':
                            CART.updateCountHeader();
                            break;
                        case'form-order':
                            setTimeout(function () {
                                location.href = base_url;
                            }, 2000);
                            break;
                        default:
                            setTimeout(function () {
                                if (response.url_redirect) location.href = response.url_redirect; else location.reload();
                            }, 2000);
                    }
                }
            }
        }
    }, formatMoney: function (money) {
        return money.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + 'đ'
    }, showPopupNewsletter: function (show) {
        if ($('#popup_newsletter').length > 0) {
            if (show) {
                $('#popup_newsletter').show();
                $('#overlay').show();
            } else {
                $('#popup_newsletter').hide();
                $('#overlay').hide();
            }
        }
    }, ajax_loader: function () {
        $('body').toggleClass('fixed');
        $('#preloader').toggleClass('d-none');
    }, ajax_load_content_animation: function (url, element, goto) {
        let _container = $(element);
        $.ajax({
            url: url, type: 'GET', dataType: 'html', beforeSend: function () {
                FUNC.ajax_loader();
            }, success: function (result) {
                let resultFind = $(result).find(element);
                if (resultFind.length > 0) {
                    _container.html(resultFind.html());
                }
                FUNC.ajax_loader();
                window.history.pushState({path: url}, '', url);
                if (goto) {
                    $('html, body').animate({scrollTop: $(goto).offset().top - 110}, 1000);
                }
            }
        });
    }, show_quick_view: function (url_product_detail) {
        let content_view = '#ajax-quickview';
        let container_popup = $('#fancybox-content  .product-essential');
        $.ajax({
            url: url_product_detail, type: 'GET', dataType: 'html', success: function (result) {
                let resultFind = $(result).find(content_view);
                if (resultFind.length > 0) {
                    container_popup.html(resultFind);
                    UI.zoomImageProduct();
                    UI.ajaxFormSubmit();
                }
            }
        });
    }
};
var CART = {
    add: function (id, quantity) {
        $.ajax({
            type: 'POST',
            url: base_url + 'cart/add',
            data: {product_id: id, quantity: quantity},
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    CART.updateCountHeader();
                    toastr[response.type](response.message);
                }
            }
        });
        return false;
    }, add_more: function (id, _this) {
        let quantity = $(_this).closest('.custom').find('input[name="quantity"]').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'cart/add',
            data: {product_id: id, quantity: quantity},
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    CART.updateCountHeader();
                    toastr[response.type](response.message);
                }
            }
        });
        return false;
    }, delete: function (_this, id) {
        $.ajax({
            type: 'POST',
            url: base_url + 'cart/ajax_delete_item',
            data: {id: id},
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    $(_this).closest('.item').fadeOut('slow', function () {
                        $(this).remove();
                        CART.updateCountHeader();
                        CART.list_cart();
                    });
                    toastr[response.type](response.message);
                }
            }
        });
        return false;
    }, updateCountHeader: function () {
        $.ajax({
            type: 'GET', url: base_url + 'cart/ajax_total', dataType: 'json', success: function (data) {
                $('.mini-cart .cart_count').html(data.total_item + ' sản phẩm/' + FUNC.formatMoney(data.total_money))
            }
        })
    }, loadPriceAgency: function (id, quantity) {
        let blockPrice = $('.price-block');
        if (blockPrice.length > 0) {
            $.ajax({
                type: 'POST',
                url: base_url + 'product/ajax_get_detail',
                data: {id: id, quantity: quantity},
                dataType: 'json',
                success: function (data) {
                    if (data.price > 0) {
                        blockPrice.find('.special-price .price').text(FUNC.formatMoney(data.price));
                        blockPrice.find('input[name="price"]').val(data.price);
                    }
                }
            });
        }
    }, quantity_reduced: function (_this) {
        let element = $(_this);
        let result = element.closest('.add-to-cart').find('input[name="quantity"]');
        let product_id = element.closest('.add-to-cart').data('id');
        let qty = parseInt(result.val());
        let min = parseInt(result.attr('min'));
        if (!isNaN(qty) && qty > min) {
            result.val(qty - 1);
        }
        ;CART.loadPriceAgency(product_id, qty - 1);
        return false;
    }, quantity_increase: function (_this) {
        let element = $(_this);
        let result = element.closest('.add-to-cart').find('input[name="quantity"]');
        let product_id = element.closest('.add-to-cart').data('id');
        let qty = parseInt(result.val());
        if (!isNaN(qty)) result.val(qty + 1);
        CART.loadPriceAgency(product_id, qty + 1);
        return false;
    }, changeInputQuantity: function (_this) {
        let element = $(_this);
        let result = element.closest('.add-to-cart').find('input[name="quantity"]');
        let product_id = element.closest('.add-to-cart').data('id');
        let qty = parseInt(result.val());
        CART.loadPriceAgency(product_id, qty + 1);
        return false;
    }, list_cart: function () {
        $.ajax({
            url: base_url + 'cart/load_list_cart', type: 'post', dataType: 'HTML', success: function (data) {
                $('.k_list_cart').html(data);
                $('.top-cart-content').show();
            }
        });
    }, hover_cart: function () {
        if (mobileDetect == true) {
            $('.mini-cart a').click(function (e) {
                e.preventDefault();
                if ($('.top-cart-content').length > 0) {
                    $('.top-cart-content').show();
                } else {
                    CART.list_cart();
                }
            });
        } else {
            $('.mini-cart').hover(function () {
                if ($('.top-cart-content').length > 0) {
                    $('.top-cart-content').show();
                } else {
                    CART.list_cart();
                }
            });
        }
    }, hide_cart: function (_this) {
        $('.k_list_cart').empty();
    }, coupon_code: function () {
        $.ajax({
            url: base_url + 'cart/voucher',
            type: 'POST',
            dataType: 'json',
            data: {code: $('#coupon_code').val()},
            success: function (data) {
                let cls = 'text-danger';
                if (data.type == 'success') {
                    cls = 'text-success';
                    $('.price_sale').html(data.price_sale);
                    $('[name="voucher_id"]').val(data.voucher);
                }
                $('.mess_coupon').html('<p class="' + cls + '"> ' + data.message + '</p>');
            }
        });
    }, payment_collapse: function () {
        var pay = $('.payment-collapse');
        if (pay.length > 0) {
            pay.find('.item .head').click(function (e) {
                var ct = $(this).nextAll(".ct");
                if (ct.is(":hidden") === true) {
                    ct.parent('.item').parent().children().children('.ct').slideUp(200);
                    ct.parent('.item').parent().children().children('.head').removeClass("active");
                    $(this).addClass("active");
                    $('.payment-collapse .item').removeClass('active')
                    $(this).parent().addClass("active");
                    ct.slideDown(200);
                } else {
                    ct.slideUp(200);
                    $(this).removeClass("active");
                    $(this).parent().removeClass("active");
                }
            });
        }
    }, fee_ship: function () {
        if ($('#shipping-zip-form').length > 0) {
            let city_id = $('[name="city_id"]').val();
            let district_id = $('[name="district_id"]').val();
            let total_weight = $('[name="total_weight"]').val();
            let warehouse = $('[name="warehouse"]').val();
            let total_money = $('.fee_ship').data('total');
            $.ajax({
                url: base_url + 'cart/ajax_get_fee',
                type: 'POST',
                data: {
                    warehouse: warehouse,
                    weight: total_weight,
                    city_id: city_id,
                    district_id: district_id,
                    total: total_money
                },
                dataType: 'json',
                success: function (data) {
                    if (data.success == true) {
                        let fee = data.fee.fee;
                        $('.fee_ship').text(FUNC.formatMoney(fee));
                        $('.price_sale').text(FUNC.formatMoney(total_money + fee));
                    }
                }
            });
        }
    }, check_out: function () {
        $('.text-danger').remove();
        let form = $('#check_out');
        $.ajax({
            url: base_url + 'cart/checkout',
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            beforeSend: function () {
                $('.btn-proceed-checkout span').append('<i class="fa fa-spinner fa-spin ml-2" style=" margin-left:5px;color: #ffffff;"></i>');
            },
            success: function (data) {
                $('.btn-proceed-checkout span').find('i').remove();
                if (data.type != 'success') {
                    $.each(data.validation, function (key, value) {
                        $('[name="' + key + '"]').closest('.input-box').append(value);
                    });
                    toastr[data.type](data.message);
                } else {
                    window.location.href = data.redirect_url;
                }
            }
        });
    },
};
var WISHLIST = {
    add: function () {
        $(document).on('click', '.link-wishlist', function (e) {
            e.preventDefault();
            let product_id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: base_url + 'product/ajax_save_wishlist',
                data: {product_id: product_id},
                dataType: 'JSON',
                success: function (response) {
                    if (typeof response.type !== 'undefined') {
                        toastr[response.type](response.message);
                    }
                }
            });
        });
    }, delete: function (_this) {
        let elementItem = $(_this).closest('tr');
        let product_id = elementItem.data('id');
        $.ajax({
            type: 'POST',
            url: base_url + 'product/ajax_delete_wishlist',
            data: {product_id: product_id},
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    toastr[response.type](response.message);
                    if (response.type === 'success') elementItem.remove();
                }
            }
        });
        return false;
    }, deleteAll: function () {
        $.ajax({
            type: 'POST',
            url: base_url + 'product/ajax_deleteAll_wishlist',
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    toastr[response.type](response.message);
                    if (response.type === 'success') $('#wishlist-table tbody').remove();
                }
            }
        });
        return false;
    }, init: function () {
        WISHLIST.add();
    }
};
var COMPARE = {
    add: function () {
        $(document).on('click', '.link-compare', function (e) {
            e.preventDefault();
            let product_id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: base_url + 'product/ajax_add_compare',
                data: {product_id: product_id},
                dataType: 'JSON',
                success: function (response) {
                    if (typeof response.type !== 'undefined') {
                        toastr[response.type](response.message);
                    }
                }
            });
        });
    }, delete: function (_this) {
        let elementItem = $(_this).closest('tr');
        let product_id = elementItem.data('id');
        $.ajax({
            type: 'POST',
            url: base_url + 'product/ajax_delete_compare',
            data: {product_id: product_id},
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    toastr[response.type](response.message);
                    if (response.type === 'success') elementItem.remove();
                }
            }
        });
        return false;
    }, deleteAll: function () {
        $.ajax({
            type: 'POST',
            url: base_url + 'product/ajax_deleteAll_compare',
            dataType: 'JSON',
            success: function (response) {
                if (typeof response.type !== 'undefined') {
                    toastr[response.type](response.message);
                    if (response.type === 'success') $('#wishlist-table tbody').remove();
                }
            }
        });
        return false;
    }, init: function () {
        COMPARE.add();
    }
};
var UI = {
    activeMenu: function () {
        let href = window.location.origin + window.location.pathname;
        $('ul>li a[href="' + href + '"]').parent().addClass('active');
        if (urlCurrentMenu) $('ul>li a[href="' + urlCurrentMenu + '"]').parent().addClass('active');
    }, search: function (el) {
        let keyword = el.val();
        if (keyword.length > 0) {
            window.location.href = base_url + 'search/' + keyword;
        } else {
            toastr['warning']('Vui lòng nhập từ khóa để tìm kiếm !');
        }
    }, loadSearchAutocomplete: function (page) {
        let formEl = $('#search_mini_form');
        let keyword = formEl.find('input[name="search"]').val();
        if (keyword) {
            $.ajax({
                type: 'POST',
                url: base_url + 'search_autocomplete',
                data: {keyword: keyword, page: page},
                dataType: 'HTML',
                success: function (content) {
                    if (content) {
                        formEl.find('.product_search').append(content);
                    }
                }
            });
            return false;
        }
    }, searchBox: function () {
        let container = $('#search_mini_form');
        $('header').find('button.btnSearch').click(function (e) {
            e.preventDefault();
            let inputElement = $(this).parent().parent().find('input[name="search"]');
            UI.search(inputElement);
        });
        container.find('input[name="search"]').keydown(function (e) {
            if (e.keyCode === 13) {
                let inputElement = $(this);
                UI.search(inputElement);
            }
        });
        container.find('input[name="search"]').keyup(function () {
            container.find('.product_search').html('').addClass('go_in');
            UI.loadSearchAutocomplete(1);
        });
        container.find('input[name="search"]').focusin(function () {
            container.find('.product_search').addClass('go_in').fadeIn(500);
        });
        container.find('input[name="search"]').focusout(function () {
            container.find('.product_search').removeClass('go_in').fadeOut(500);
        });
        let page = 1;
        container.find('.product_search').scroll(function () {
            let divHeight = $(this).innerHeight();
            let scrollPosition = $(this).scrollTop();
            let scrollHeight = this.scrollHeight;
            if (scrollPosition + divHeight >= scrollHeight) {
                page += 1;
                console.log(page);
                UI.loadSearchAutocomplete(page);
            }
        });
    }, ajaxFormSubmit: function () {
        $('form[method="post"]').ajaxForm({
            beforeSubmit: FUNC.ajaxShowRequest,
            success: FUNC.ajaxShowResponse,
            type: 'POST',
            dataType: 'JSON',
            timeout: 500
        });
    }, zoomImageProduct: function () {
        if (jQuery('#product-zoom').length > 0) {
            jQuery('#product-zoom').elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750,
                gallery: 'gallery_01'
            });
        }
        if (jQuery('#gallery_01').length > 0) {
            jQuery("#gallery_01 .slider-items").owlCarousel({
                autoplay: false,
                items: 4,
                itemsDesktop: [1024, 3],
                itemsDesktopSmall: [900, 2],
                itemsTablet: [600, 3],
                itemsMobile: [320, 2],
                navigation: true,
                navigationText: ["<a class=\"flex-prev\"></a>", "<a class=\"flex-next\"></a>"],
                slideSpeed: 500,
                pagination: false
            });
        }
    }, sliderHome: function () {
        var sync1 = $("#sync1");
        var sync2 = $("#sync2");
        sync1.owlCarousel({
            singleItem: true,
            nav: true,
            slideSpeed: 1000,
            pagination: false,
            afterAction: syncPosition,
            responsiveRefreshRate: 200,
            navigation: true,
            navigationText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        });
        sync2.owlCarousel({
            items: 4,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [979, 4],
            itemsTablet: [768, 3],
            itemsMobile: [479, 2],
            pagination: false,
            responsiveRefreshRate: 100,
            afterInit: function (el) {
                el.find(".owl-item").eq(0).addClass("synced");
            }
        });

        function syncPosition(el) {
            var current = this.currentItem;
            $("#sync2").find(".owl-item").removeClass("synced").eq(current).addClass("synced")
            if ($("#sync2").data("owlCarousel") !== undefined) {
                center(current)
            }
        }

        $("#sync2").on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).data("owlItem");
            sync1.trigger("owl.goTo", number);
        });

        function center(number) {
            var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
            var num = number;
            var found = false;
            for (var i in sync2visible) {
                if (num === sync2visible[i]) {
                    var found = true;
                }
            }
            if (found === false) {
                if (num > sync2visible[sync2visible.length - 1]) {
                    sync2.trigger("owl.goTo", num - sync2visible.length + 2)
                } else {
                    if (num - 1 === -1) {
                        num = 0;
                    }
                    sync2.trigger("owl.goTo", num);
                }
            } else if (num === sync2visible[sync2visible.length - 1]) {
                sync2.trigger("owl.goTo", sync2visible[1])
            } else if (num === sync2visible[0]) {
                sync2.trigger("owl.goTo", num - 1)
            }
        }

        $(".owl-controls").removeClass('clickable');
        $(".owl-prev").html('<i class="fa fa-angle-left" aria-hidden="true"></i>');
        $(".owl-next").html('<i class="fa fa-angle-right" aria-hidden="true"></i>');
    }, stickyMenuMain: function () {
        let header = document.getElementById('menu-main');
        let sticky = header.offsetTop;
        jQuery('.mega-menu-category').slideUp();
        window.onscroll = function () {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
                $("#menu-main").closest('header').find('+*').css({'margin-top': $("#menu-main").height() + 'px'})
            } else {
                header.classList.remove("sticky");
                $('#menu-main').closest('header').find('+*').removeAttr('style');
            }
            if (window.pageYOffset == 0) {
            }
        };
    }, stickyBox: function () {
        if ($('.sticky_box').length > 0) {
            $('.sticky_box').stick_in_parent();
        }
    }, socialShare: function () {
        if ($('#social-share').length > 0) {
            $('#social-share').jsSocials({shares: ["email", "twitter", "facebook", "googleplus", "pinterest"]});
        }
    }, voteStar: function () {
        if ($('.rateit').length > 0) {
            $('.rateit').bind('rated', function (e) {
                e.preventDefault();
                let ri = $(this);
                let value = ri.rateit('value');
                ri.closest('form').find('[name="vote"]').val(value);
            });
        }
    }, loadComment: function (page) {
        let container = $('#comments');
        if (container.length > 0) {
            let product_id = container.data('id');
            container.find('.cmt-list').html('<div class="text-center"><i class="fa fa-spinner fa-spin ml-2" style=" margin-left:5px;color: #be1e2d;"></i></div>');
            setTimeout(function () {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'product/ajax_load_comment',
                    data: {product_id: product_id, page: page},
                    success: function (html) {
                        container.find('.cmt-list').html(html);
                    }
                })
            }, 1000);
        }
        return false;
    }, show_random_realtime: function () {
        if (typeof is_realtime_visitor !== "undefined" && is_realtime_visitor == true) {
            setInterval(function () {
                let number_random = Math.floor((Math.random() * 10) + (Math.random() * 3));
                console.log(number_random);
                toastr.options.positionClass = "toast-bottom-left";
                toastr.info('Có ' + number_random + ' người đang xem sản phẩm này !', '', {timeOut: 10000});
            }, 15000);
        }
    }, init: function () {
        UI.stickyMenuMain();
        UI.activeMenu();
        UI.searchBox();
        UI.stickyBox();
        UI.socialShare();
        UI.voteStar();
        UI.ajaxFormSubmit();
        UI.zoomImageProduct();
        UI.sliderHome();
        UI.loadComment(1);
        UI.show_random_realtime();
    }
};
jQuery(document).ready(function () {
    UI.init();
    WISHLIST.init();
    COMPARE.init();
    if (window.location.hash === '#reviews_tabs') {
        let tabClick = window.location.hash;
        $('[href="' + tabClick + '"]').tab('show');
        setTimeout(function () {
            $('html, body').animate({scrollTop: $(tabClick).offset().top - 120}, 1000);
        }, 500);
    }
    $('a[href*="#"]').click(function (e) {
        e.preventDefault();
        let href = $(this).attr('href').split('#');
        let tabClick = '#' + href[href.length - 1];
        $(this).tab('show');
        $('[href="#' + href[href.length - 1] + '"]').parent().addClass('active');
        setTimeout(function () {
            $('html, body').animate({scrollTop: $(tabClick).offset().top - 120}, 1000);
        }, 500);
    });
    if (localStorage.getItem('show_popup_subscriber') !== 'hide') {
        FUNC.showPopupNewsletter(true);
    }
    $('input#notshowpopup').change(function () {
        if ($(this).val()) {
            setTimeout(function () {
                localStorage.setItem('show_popup_subscriber', 'hide');
                FUNC.showPopupNewsletter(false);
            }, 1000);
        }
    });
    $('#popup_newsletter').on('click', 'a.x', function () {
        FUNC.showPopupNewsletter(false);
    });
    CART.hover_cart();
    LOC.loadCity();
    LOC.loadDistrict();
    $(document).on('change', 'select[name*="filter_"]', function () {
        let form_parent = $(this).closest('form');
        let url = form_parent.attr('action') + '?' + form_parent.serialize();
        FUNC.ajax_load_content_animation(url, '#content_ajax', '#content_ajax');
    });
    $(document).on('change', 'select[name="warehouse"]', function () {
        CART.fee_ship();
    });
    $(document).on('click', 'ul.pagination li a', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        FUNC.ajax_load_content_animation(url, '#content_ajax', '#content_ajax');
    });
    $(document).on('click', '.link-quickview', function (e) {
        e.preventDefault();
        let url = $(this).data('url');
        FUNC.show_quick_view(url);
        $('body').addClass('fixed');
        $('#overlay').show();
        $('#fancybox-wrap').show();
    });
    $('#fancybox-wrap').on('click', '#fancybox-close', function (e) {
        e.preventDefault();
        $('#overlay').hide();
        $('#fancybox-wrap').hide();
        $('.zoomContainer').hide();
        $('body').removeClass('fixed');
    });
    CART.payment_collapse();
    if ($('.showmore').closest('.panel-body').find('.add-to-box').length <= 3) {
        $('.showmore').addClass('hidden');
    }
    $('.buy-more').on('click', '.showmore a', function (e) {
        e.preventDefault();
        let _this = $(this);
        _this.parent().css({height: 0});
        _this.closest('.panel-body').css({'max-height': '2000px'});
    });
    $('.comment-fr').on('click', '.reply-btn', function (e) {
        e.preventDefault();
        $(this).closest('.comment-fr');
        let container = $(this).closest('.comment-fr');
        container.find('.hc-comment form.form-comment').remove();
        let form = container.find('form.form-comment');
        let cmtID = $(this).attr('data-id'),
            name = $(this).closest('.hc-comment').children('.head').find('.name').text();
        let clone = form.clone();
        clone.find('textarea').val("@" + name + ': ');
        clone.append('<input type="hidden" name="parent_id" id="comment-id" value="' + cmtID + '">');
        $(this).parent().after(clone);
        clone.find('textarea').focus();
        container.ajaxForm({
            beforeSubmit: FUNC.ajaxShowRequest,
            success: FUNC.ajaxShowResponse,
            type: 'POST',
            dataType: 'JSON',
            timeout: 500
        });
    });
    $('.view-more').on('click', 'a', function (e) {
        e.preventDefault();
        let _this = $(this);
        _this.parent().css({height: 0});
        _this.closest('ul').css({'max-height': '4000px'}).stop(true, true).fadeIn('slow');
    });
    $('.accessories-slider').owlCarousel({
        items: 4,
        loop: true,
        responsiveClass: true,
        nav: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {0: {items: 1,}, 600: {items: 2,}, 1000: {items: 4,}}
    })
    getAgencyNear();
    filterAgency();
    $('#spanImg').on('click', function () {
        $('.ask_form input[type="file"]').trigger('click');
    });
    if ($('.top-agency__abs').length > 0) {
        var options = {useEasing: true, useGrouping: true, separator: '.', decimal: ',', prefix: '', suffix: ''};
        var total_agency = new CountUp("total_agency", 0, parseInt($('#total_agency').data('val')), 0, 5, options);
        var serve_customer = new CountUp("serve_customer", 0, parseInt($('#serve_customer').data('val')), 0, 5, options);
        var hT = $('.top-banners').offset().top, hH = $('.top-banners').outerHeight(), wH = $(window).height(),
            wS = $(this).scrollTop();
        if (wS > (hT + hH - wH)) {
            setTimeout(total_agency.start(), 1000);
            setTimeout(serve_customer.start(), 1000);
        }
    }
    ;
    if ($("[name='product-detail-radio']").length > 0) {
        $("[name='product-detail-radio']").click(function () {
            let val = $(this).val();
            if (val == 1) {
                $("[name='quantity']")[0].value = $("[name='quantity']")[0].min = 6;
            } else if (val == 2) {
                $("[name='quantity']")[0].value = $("[name='quantity']")[0].min = 16;
            } else {
                $("[name='quantity']")[0].value = $("[name='quantity']")[0].min = 1;
            }
        });
        $("[name='quantity']").keyup(function () {
            let val = $(this)[0].value;
            if (val > 15) {
                $("[name='product-detail-radio']")[2].attr('checked');
            } else if (val > 6 && val < 16) {
                $("[name='product-detail-radio']")[1].attr('checked');
            } else {
                $("[name='product-detail-radio']")[0].attr('checked');
            }
        });
    }
    ;
});

function getAgencyNear() {
    $('.list-agency__title a').on('click', function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showLocation);
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    });
    if (typeof ddgannhat != "undefined" && ddgannhat == '1') {
        $('html, body').animate({scrollTop: $('.form_filter').offset().top}, 1000, function () {
            $('.list-agency__title a').trigger('click');
        });
    }
}

function showLocation(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    $.ajax({
        type: 'POST',
        url: base_url + 'agency/agencyNear',
        data: {lat: latitude, log: longitude},
        success: function (data) {
            if (data) {
                $(".list-agency__content").html(data);
            } else {
                $(".list-agency__content").html('Not Available');
            }
        }
    });
}

function filterAgency() {
    $('.form_filter [name="city_id"],.form_filter [name="district_id"]').on('change', function () {
        let params = {city_id: $('[name="city_id"]').val(), district_id: $('[name="district_id"]').val(),};
        $.ajax({
            type: 'POST', url: base_url + 'agency/listAgency', data: params, success: function (data) {
                if (data) {
                    $(".list-agency__content").html(data);
                } else {
                    $(".list-agency__content").html('Không có cửa hàng, đại lý nào phù hợp');
                }
            }
        });
    });
}

function live_search(key_search) {
    if (key_search.length > 3) {
        if (flagSearch) {
            flagSearch = false;
            $.ajax({
                async: true,
                cache: false,
                type: 'POST',
                url: base_url + 'agency/filterAgency',
                dataType: 'html',
                data: {key_search: key_search},
                success: function (data) {
                    $('.result').html(data);
                    $('.result').addClass('gogo');
                    flagSearch = true;
                }
            });
        }
    } else {
        $('.result').removeClass('gogo');
    }
    $(window).click(function (e) {
        if ($('.result').has(e.target).length == 0 && !$('.result').is(e.target)) {
            $('.result').removeClass('gogo');
        }
    });
};jQuery(document).ready(function () {
    "use strict";
});
var CountUp = function (target, startVal, endVal, decimals, duration, options) {
    var lastTime = 0;
    var vendors = ['webkit', 'moz', 'ms', 'o'];
    for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
    }
    if (!window.requestAnimationFrame) {
        window.requestAnimationFrame = function (callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function () {
                callback(currTime + timeToCall);
            }, timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
    }
    if (!window.cancelAnimationFrame) {
        window.cancelAnimationFrame = function (id) {
            clearTimeout(id);
        };
    }
    this.options = {useEasing: true, useGrouping: true, separator: ',', decimal: '.'};
    for (var key in options) {
        if (options.hasOwnProperty(key)) {
            this.options[key] = options[key];
        }
    }
    if (this.options.separator === '') this.options.useGrouping = false;
    if (!this.options.prefix) this.options.prefix = '';
    if (!this.options.suffix) this.options.suffix = '';
    this.d = (typeof target === 'string') ? document.getElementById(target) : target;
    this.startVal = Number(startVal);
    this.endVal = Number(endVal);
    this.countDown = (this.startVal > this.endVal);
    this.frameVal = this.startVal;
    this.decimals = Math.max(0, decimals || 0);
    this.dec = Math.pow(10, this.decimals);
    this.duration = Number(duration) * 1000 || 2000;
    var self = this;
    this.version = function () {
        return '1.6.0';
    };
    this.printValue = function (value) {
        var result = (!isNaN(value)) ? self.formatNumber(value) : '--';
        if (self.d.tagName == 'INPUT') {
            this.d.value = result;
        } else if (self.d.tagName == 'text' || self.d.tagName == 'tspan') {
            this.d.textContent = result;
        } else {
            this.d.innerHTML = result;
        }
    };
    this.easeOutExpo = function (t, b, c, d) {
        return c * (-Math.pow(2, -10 * t / d) + 1) * 1024 / 1023 + b;
    };
    this.count = function (timestamp) {
        if (!self.startTime) self.startTime = timestamp;
        self.timestamp = timestamp;
        var progress = timestamp - self.startTime;
        self.remaining = self.duration - progress;
        if (self.options.useEasing) {
            if (self.countDown) {
                self.frameVal = self.startVal - self.easeOutExpo(progress, 0, self.startVal - self.endVal, self.duration);
            } else {
                self.frameVal = self.easeOutExpo(progress, self.startVal, self.endVal - self.startVal, self.duration);
            }
        } else {
            if (self.countDown) {
                self.frameVal = self.startVal - ((self.startVal - self.endVal) * (progress / self.duration));
            } else {
                self.frameVal = self.startVal + (self.endVal - self.startVal) * (progress / self.duration);
            }
        }
        if (self.countDown) {
            self.frameVal = (self.frameVal < self.endVal) ? self.endVal : self.frameVal;
        } else {
            self.frameVal = (self.frameVal > self.endVal) ? self.endVal : self.frameVal;
        }
        self.frameVal = Math.round(self.frameVal * self.dec) / self.dec;
        self.printValue(self.frameVal);
        if (progress < self.duration) {
            self.rAF = requestAnimationFrame(self.count);
        } else {
            if (self.callback) self.callback();
        }
    };
    this.start = function (callback) {
        self.callback = callback;
        self.rAF = requestAnimationFrame(self.count);
        return false;
    };
    this.pauseResume = function () {
        if (!self.paused) {
            self.paused = true;
            cancelAnimationFrame(self.rAF);
        } else {
            self.paused = false;
            delete self.startTime;
            self.duration = self.remaining;
            self.startVal = self.frameVal;
            requestAnimationFrame(self.count);
        }
    };
    this.reset = function () {
        self.paused = false;
        delete self.startTime;
        self.startVal = startVal;
        cancelAnimationFrame(self.rAF);
        self.printValue(self.startVal);
    };
    this.update = function (newEndVal) {
        cancelAnimationFrame(self.rAF);
        self.paused = false;
        delete self.startTime;
        self.startVal = self.frameVal;
        self.endVal = Number(newEndVal);
        self.countDown = (self.startVal > self.endVal);
        self.rAF = requestAnimationFrame(self.count);
    };
    this.formatNumber = function (nStr) {
        nStr = nStr.toFixed(self.decimals);
        nStr += '';
        var x, x1, x2, rgx;
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? self.options.decimal + x[1] : '';
        rgx = /(\d+)(\d{3})/;
        if (self.options.useGrouping) {
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + self.options.separator + '$2');
            }
        }
        return self.options.prefix + x1 + x2 + self.options.suffix;
    };
    self.printValue(self.startVal);
};
$(".price-slider").owlCarousel({
    autoPlay: true,
    autoplayHoverPause: true,
    loop: true,
    items: 1,
    itemsDesktop: [1024, 1],
    itemsDesktopSmall: [900, 1],
    itemsTablet: [640, 1],
    itemsMobile: [390, 1],
    navigation: true,
    navigationText: ['<a class="flex-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>', '<a class="flex-next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>'],
    slideSpeed: 5000,
    pagination: false
});
})
;