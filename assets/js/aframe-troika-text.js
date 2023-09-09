! function (e, t) {
    "use strict";

    function r(e) {
        return e && "object" == typeof e && "default" in e ? e : {
            default: e
        }
    }

    function n(e) {
        if (e && e.__esModule) return e;
        var t = Object.create(null);
        return e && Object.keys(e).forEach((function (r) {
            if ("default" !== r) {
                var n = Object.getOwnPropertyDescriptor(e, r);
                Object.defineProperty(t, r, n.get ? n : {
                    enumerable: !0,
                    get: function () {
                        return e[r]
                    }
                })
            }
        })), t.default = e, Object.freeze(t)
    }
    var a = n(e),
        o = r(t);

    function i() {
        var e, t = 0,
            r = [],
            n = 0,
            a = 0;
        var o = c((function (e) {
                a || l(1, e)
            })),
            s = c((function (e) {
                a || l(-1, e)
            }));

        function l(r, n) {
            a++;
            var o = 0;
            try {
                n === g && p();
                var i = r > 0 && d(n);
                i ? i.call(n, c((function (e) {
                    o++, l(1, e)
                })), c((function (e) {
                    o++, l(-1, e)
                }))) : (t = r, e = n, u())
            } catch (e) {
                t || o || l(-1, e)
            }
        }

        function u() {
            n || (setTimeout(f, 0), n = 1)
        }

        function f() {
            var e = r;
            n = 0, r = [], e.forEach(h)
        }

        function h(e) {
            e()
        }

        function d(e) {
            var t = e && (v(e) || "object" == typeof e) && e.then;
            return v(t) && t
        }

        function c(e) {
            var t = 0;
            return function () {
                for (var r = [], n = arguments.length; n--;) r[n] = arguments[n];
                t++ || e.apply(this, r)
            }
        }

        function p() {
            throw new TypeError("Chaining cycle detected")
        }
        var v = function (e) {
                return "function" == typeof e
            },
            g = {
                then: function (n, a) {
                    var o = i();
                    return r.push((function () {
                        var r = t > 0 ? n : a;
                        if (v(r)) try {
                            var i = r(e);
                            i === o && p();
                            var s = d(i);
                            s ? s.call(i, o.resolve, o.reject) : o.resolve(i)
                        } catch (e) {
                            o.reject(e)
                        } else o[t > 0 ? "resolve" : "reject"](e)
                    })), t && u(), o
                },
                resolve: o,
                reject: s
            };
        return g
    }

    function s() {
        var e, t, r = new Promise((function (r, n) {
            e = r, t = n
        }));
        return {
            then: r.then.bind(r),
            resolve: e,
            reject: t
        }
    }
    i.all = s.all = function (e) {
        var t = 0,
            r = [],
            n = l();
        return 0 === e.length ? n.resolve([]) : e.forEach((function (a, o) {
            var i = l();
            i.resolve(a), i.then((function (a) {
                t++, r[o] = a, t === e.length && n.resolve(r)
            }), n.reject)
        })), n
    };
    var l = "function" == typeof Promise ? s : i;

    function u() {
        var e = Object.create(null);

        function t(e, t) {
            var r = void 0;
            self.troikaDefine = function (e) {
                return r = e
            };
            var n = URL.createObjectURL(new Blob(["/** " + e.replace(/\*/g, "") + " **/\n\ntroikaDefine(\n" + t + "\n)"], {
                type: "application/javascript"
            }));
            try {
                importScripts(n)
            } catch (e) {
                console.error(e)
            }
            return URL.revokeObjectURL(n), delete self.troikaDefine, r
        }
        self.addEventListener("message", (function (r) {
            var n = r.data,
                a = n.messageId,
                o = n.action,
                i = n.data;
            try {
                "registerModule" === o && function r(n, a) {
                    var o = n.id,
                        i = n.name,
                        s = n.dependencies;
                    void 0 === s && (s = []);
                    var l = n.init;
                    void 0 === l && (l = function () {});
                    var u = n.getTransferables;
                    if (void 0 === u && (u = null), !e[o]) try {
                        s = s.map((function (t) {
                            return t && t.isWorkerModule && (r(t, (function (e) {
                                if (e instanceof Error) throw e
                            })), t = e[t.id].value), t
                        })), l = t("<" + i + ">.init", l), u && (u = t("<" + i + ">.getTransferables", u));
                        var f = null;
                        "function" == typeof l ? f = l.apply(void 0, s) : console.error("worker module init function failed to rehydrate"), e[o] = {
                            id: o,
                            value: f,
                            getTransferables: u
                        }, a(f)
                    } catch (e) {
                        e && e.noLog || console.error(e), a(e)
                    }
                }(i, (function (e) {
                    e instanceof Error ? postMessage({
                        messageId: a,
                        success: !1,
                        error: e.message
                    }) : postMessage({
                        messageId: a,
                        success: !0,
                        result: {
                            isCallable: "function" == typeof e
                        }
                    })
                })), "callModule" === o && function (t, r) {
                    var n, a = t.id,
                        o = t.args;
                    e[a] && "function" == typeof e[a].value || r(new Error("Worker module " + a + ": not found or its 'init' did not return a function"));
                    try {
                        var i = (n = e[a]).value.apply(n, o);
                        i && "function" == typeof i.then ? i.then(s, (function (e) {
                            return r(e instanceof Error ? e : new Error("" + e))
                        })) : s(i)
                    } catch (e) {
                        r(e)
                    }

                    function s(t) {
                        try {
                            var n = e[a].getTransferables && e[a].getTransferables(t);
                            n && Array.isArray(n) && n.length || (n = void 0), r(t, n)
                        } catch (e) {
                            console.error(e), r(e)
                        }
                    }
                }(i, (function (e, t) {
                    e instanceof Error ? postMessage({
                        messageId: a,
                        success: !1,
                        error: e.message
                    }) : postMessage({
                        messageId: a,
                        success: !0,
                        result: e
                    }, t || void 0)
                }))
            } catch (e) {
                postMessage({
                    messageId: a,
                    success: !1,
                    error: e.stack
                })
            }
        }))
    }
    var f = function () {
            var e = !1;
            if ("undefined" != typeof window && void 0 !== window.document) try {
                new Worker(URL.createObjectURL(new Blob([""], {
                    type: "application/javascript"
                }))).terminate(), e = !0
            } catch (e) {
                "undefined" != typeof process && "test" === process.env.NODE_ENV || console.log("Troika createWorkerModule: web workers not allowed; falling back to main thread execution. Cause: [" + e.message + "]")
            }
            return f = function () {
                return e
            }, e
        },
        h = 0,
        d = 0,
        c = !1,
        p = Object.create(null),
        v = function () {
            var e = Object.create(null);
            return e._count = 0, e
        }();

    function g(e) {
        if (!(e && "function" == typeof e.init || c)) throw new Error("requires `options.init` function");
        var t = e.dependencies,
            r = e.init,
            n = e.getTransferables,
            a = e.workerId;
        if (!f()) return function (e) {
            var t = function () {
                for (var e = [], r = arguments.length; r--;) e[r] = arguments[r];
                return t._getInitResult().then((function (t) {
                    if ("function" == typeof t) return t.apply(void 0, e);
                    throw new Error("Worker module function was called but `init` did not return a callable function")
                }))
            };
            return t._getInitResult = function () {
                var r = e.dependencies,
                    n = e.init;
                r = Array.isArray(r) ? r.map((function (e) {
                    return e && e._getInitResult ? e._getInitResult() : e
                })) : [];
                var a = l.all(r).then((function (e) {
                    return n.apply(null, e)
                }));
                return t._getInitResult = function () {
                    return a
                }, a
            }, t
        }(e);
        null == a && (a = "#default");
        var o = "workerModule" + ++h,
            i = e.name || o,
            s = null;

        function u() {
            for (var e = [], t = arguments.length; t--;) e[t] = arguments[t];
            return s || (s = y(a, "registerModule", u.workerModuleData)), s.then((function (t) {
                if (t.isCallable) return y(a, "callModule", {
                    id: o,
                    args: e
                });
                throw new Error("Worker module function was called but `init` did not return a callable function")
            }))
        }
        return t = t && t.map((function (e) {
            return "function" != typeof e || e.workerModuleData || (c = !0, e = g({
                workerId: a,
                name: "<" + i + "> function dependency: " + e.name,
                init: "function(){return (\n" + m(e) + "\n)}"
            }), c = !1), e && e.workerModuleData && (e = e.workerModuleData), e
        })), u.workerModuleData = {
            isWorkerModule: !0,
            id: o,
            name: i,
            dependencies: t,
            init: m(r),
            getTransferables: n && m(n)
        }, u
    }

    function m(e) {
        var t = e.toString();
        return !/^function/.test(t) && /^\w+\s*\(/.test(t) && (t = "function " + t), t
    }

    function y(e, t, r) {
        var n = l(),
            a = ++d;
        return v[a] = function (e) {
                e.success ? n.resolve(e.result) : n.reject(new Error("Error in worker " + t + " call: " + e.error))
            }, v._count++, v.count > 1e3 && console.warn("Large number of open WorkerModule requests, some may not be returning"),
            function (e) {
                var t = p[e];
                if (!t) {
                    var r = m(u);
                    (t = p[e] = new Worker(URL.createObjectURL(new Blob(["/** Worker Module Bootstrap: " + e.replace(/\*/g, "") + " **/\n\n;(" + r + ")()"], {
                        type: "application/javascript"
                    })))).onmessage = function (e) {
                        var t = e.data,
                            r = t.messageId,
                            n = v[r];
                        if (!n) throw new Error("WorkerModule response with empty or unknown messageId");
                        delete v[r], v.count--, n(t)
                    }
                }
                return t
            }(e).postMessage({
                messageId: a,
                action: t,
                data: r
            }), n
    }
    var U = g({
        name: "Thenable",
        dependencies: [l],
        init: function (e) {
            return e
        }
    });
    const b = /\bvoid\s+main\s*\(\s*\)\s*{/g;

    function S(t) {
        return t.replace(/^[ \t]*#include +<([\w\d./]+)>/gm, (function (t, r) {
            let n = e.ShaderChunk[r];
            return n ? S(n) : t
        }))
    }
    const x = Object.assign || function () {
            let e = arguments[0];
            for (let t = 1, r = arguments.length; t < r; t++) {
                let r = arguments[t];
                if (r)
                    for (let t in r) r.hasOwnProperty(t) && (e[t] = r[t])
            }
            return e
        },
        _ = Date.now(),
        k = new WeakMap,
        w = new Map;
    let T = 1e10;

    function F(t, r) {
        const n = function (e) {
            const t = JSON.stringify(e, D);
            let r = I.get(t);
            null == r && I.set(t, r = ++O);
            return r
        }(r);
        let a = k.get(t);
        if (a || k.set(t, a = Object.create(null)), a[n]) return new a[n];
        const o = "_onBeforeCompile" + n,
            i = function (e) {
                t.onBeforeCompile.call(this, e);
                const a = n + "|||" + e.vertexShader + "|||" + e.fragmentShader;
                let i = w[a];
                if (!i) {
                    const t = function ({
                        vertexShader: e,
                        fragmentShader: t
                    }, r, n) {
                        let {
                            vertexDefs: a,
                            vertexMainIntro: o,
                            vertexMainOutro: i,
                            vertexTransform: s,
                            fragmentDefs: l,
                            fragmentMainIntro: u,
                            fragmentMainOutro: f,
                            fragmentColorTransform: h,
                            customRewriter: d,
                            timeUniform: c
                        } = r;
                        a = a || "", o = o || "", i = i || "", l = l || "", u = u || "", f = f || "", (s || d) && (e = S(e));
                        (h || d) && (t = S(t = t.replace(/^[ \t]*#include <((?:tonemapping|encodings|fog|premultiplied_alpha|dithering)_fragment)>/gm, "\n//!BEGIN_POST_CHUNK $1\n$&\n//!END_POST_CHUNK\n")));
                        if (d) {
                            let r = d({
                                vertexShader: e,
                                fragmentShader: t
                            });
                            e = r.vertexShader, t = r.fragmentShader
                        }
                        if (h) {
                            let e = [];
                            t = t.replace(/^\/\/!BEGIN_POST_CHUNK[^]+?^\/\/!END_POST_CHUNK/gm, t => (e.push(t), "")), f = `${h}\n${e.join("\n")}\n${f}`
                        }
                        if (c) {
                            const e = `\nuniform float ${c};\n`;
                            a = e + a, l = e + l
                        }
                        s && (a = `${a}\nvec3 troika_position_${n};\nvec3 troika_normal_${n};\nvec2 troika_uv_${n};\nvoid troikaVertexTransform${n}(inout vec3 position, inout vec3 normal, inout vec2 uv) {\n  ${s}\n}\n`, o = `\ntroika_position_${n} = vec3(position);\ntroika_normal_${n} = vec3(normal);\ntroika_uv_${n} = vec2(uv);\ntroikaVertexTransform${n}(troika_position_${n}, troika_normal_${n}, troika_uv_${n});\n${o}\n`, e = e.replace(/\b(position|normal|uv)\b/g, (e, t, r, a) => /\battribute\s+vec[23]\s+$/.test(a.substr(0, r)) ? t : `troika_${t}_${n}`));
                        return e = C(e, n, a, o, i), t = C(t, n, l, u, f), {
                            vertexShader: e,
                            fragmentShader: t
                        }
                    }(e, r, n);
                    i = w[a] = t
                }
                e.vertexShader = i.vertexShader, e.fragmentShader = i.fragmentShader, x(e.uniforms, this.uniforms), r.timeUniform && (e.uniforms[r.timeUniform] = {
                    get value() {
                        return Date.now() - _
                    }
                }), this[o] && this[o](e)
            },
            s = function () {
                return l(r.chained ? t : t.clone())
            },
            l = function (a) {
                const o = Object.create(a, u);
                return Object.defineProperty(o, "baseMaterial", {
                    value: t
                }), Object.defineProperty(o, "id", {
                    value: T++
                }), o.uuid = e.MathUtils.generateUUID(), o.uniforms = x({}, a.uniforms, r.uniforms), o.defines = x({}, a.defines, r.defines), o.defines["TROIKA_DERIVED_MATERIAL_" + n] = "", o.extensions = x({}, a.extensions, r.extensions), o._listeners = void 0, o
            },
            u = {
                constructor: {
                    value: s
                },
                isDerivedMaterial: {
                    value: !0
                },
                customProgramCacheKey: {
                    value: function () {
                        return n
                    }
                },
                onBeforeCompile: {
                    get: () => i,
                    set(e) {
                        this[o] = e
                    }
                },
                copy: {
                    writable: !0,
                    configurable: !0,
                    value: function (r) {
                        return t.copy.call(this, r), t.isShaderMaterial || t.isDerivedMaterial || (x(this.extensions, r.extensions), x(this.defines, r.defines), x(this.uniforms, e.UniformsUtils.clone(r.uniforms))), this
                    }
                },
                clone: {
                    writable: !0,
                    configurable: !0,
                    value: function () {
                        const e = new t.constructor;
                        return l(e).copy(this)
                    }
                },
                getDepthMaterial: {
                    writable: !0,
                    configurable: !0,
                    value: function () {
                        let n = this._depthMaterial;
                        return n || (n = this._depthMaterial = F(t.isDerivedMaterial ? t.getDepthMaterial() : new e.MeshDepthMaterial({
                            depthPacking: e.RGBADepthPacking
                        }), r), n.defines.IS_DEPTH_MATERIAL = "", n.uniforms = this.uniforms), n
                    }
                },
                getDistanceMaterial: {
                    writable: !0,
                    configurable: !0,
                    value: function () {
                        let n = this._distanceMaterial;
                        return n || (n = this._distanceMaterial = F(t.isDerivedMaterial ? t.getDistanceMaterial() : new e.MeshDistanceMaterial, r), n.defines.IS_DISTANCE_MATERIAL = "", n.uniforms = this.uniforms), n
                    }
                },
                dispose: {
                    writable: !0,
                    configurable: !0,
                    value() {
                        const {
                            _depthMaterial: e,
                            _distanceMaterial: r
                        } = this;
                        e && e.dispose(), r && r.dispose(), t.dispose.call(this)
                    }
                }
            };
        return a[n] = s, new s
    }

    function C(e, t, r, n, a) {
        return (n || a || r) && (e = e.replace(b, `\n${r}\nvoid troikaOrigMain${t}() {`), e += `\nvoid main() {\n  ${n}\n  troikaOrigMain${t}();\n  ${a}\n}`), e
    }

    function D(e, t) {
        return "uniforms" === e ? void 0 : "function" == typeof t ? t.toString() : t
    }
    let O = 0;
    const I = new Map;
    const M = g({
            name: "Typr Font Parser",
            dependencies: [function () {
                const e = self;
                var t = {
                    parse: function (e) {
                        var r = t._bin,
                            n = new Uint8Array(e);
                        if ("ttcf" == r.readASCII(n, 0, 4)) {
                            var a = 4;
                            r.readUshort(n, a);
                            a += 2;
                            r.readUshort(n, a);
                            a += 2;
                            var o = r.readUint(n, a);
                            a += 4;
                            for (var i = [], s = 0; s < o; s++) {
                                var l = r.readUint(n, a);
                                a += 4, i.push(t._readFont(n, l))
                            }
                            return i
                        }
                        return [t._readFont(n, 0)]
                    },
                    _readFont: function (e, r) {
                        var n = t._bin,
                            a = r;
                        n.readFixed(e, r);
                        r += 4;
                        var o = n.readUshort(e, r);
                        r += 2;
                        n.readUshort(e, r);
                        r += 2;
                        n.readUshort(e, r);
                        r += 2;
                        n.readUshort(e, r);
                        r += 2;
                        for (var i = ["cmap", "head", "hhea", "maxp", "hmtx", "name", "OS/2", "post", "loca", "glyf", "kern", "CFF ", "GPOS", "GSUB", "SVG "], s = {
                                _data: e,
                                _offset: a
                            }, l = {}, u = 0; u < o; u++) {
                            var f = n.readASCII(e, r, 4);
                            r += 4;
                            n.readUint(e, r);
                            r += 4;
                            var h = n.readUint(e, r);
                            r += 4;
                            var d = n.readUint(e, r);
                            r += 4, l[f] = {
                                offset: h,
                                length: d
                            }
                        }
                        for (u = 0; u < i.length; u++) {
                            var c = i[u];
                            l[c] && (s[c.trim()] = t[c.trim()].parse(e, l[c].offset, l[c].length, s))
                        }
                        return s
                    },
                    _tabOffset: function (e, r, n) {
                        for (var a = t._bin, o = a.readUshort(e, n + 4), i = n + 12, s = 0; s < o; s++) {
                            var l = a.readASCII(e, i, 4);
                            i += 4;
                            a.readUint(e, i);
                            i += 4;
                            var u = a.readUint(e, i);
                            i += 4;
                            a.readUint(e, i);
                            if (i += 4, l == r) return u
                        }
                        return 0
                    }
                };
                return t._bin = {
                    readFixed: function (e, t) {
                        return (e[t] << 8 | e[t + 1]) + (e[t + 2] << 8 | e[t + 3]) / 65540
                    },
                    readF2dot14: function (e, r) {
                        return t._bin.readShort(e, r) / 16384
                    },
                    readInt: function (e, r) {
                        var n = t._bin.t.uint8;
                        return n[0] = e[r + 3], n[1] = e[r + 2], n[2] = e[r + 1], n[3] = e[r], t._bin.t.int32[0]
                    },
                    readInt8: function (e, r) {
                        return t._bin.t.uint8[0] = e[r], t._bin.t.int8[0]
                    },
                    readShort: function (e, r) {
                        var n = t._bin.t.uint8;
                        return n[1] = e[r], n[0] = e[r + 1], t._bin.t.int16[0]
                    },
                    readUshort: function (e, t) {
                        return e[t] << 8 | e[t + 1]
                    },
                    readUshorts: function (e, r, n) {
                        for (var a = [], o = 0; o < n; o++) a.push(t._bin.readUshort(e, r + 2 * o));
                        return a
                    },
                    readUint: function (e, r) {
                        var n = t._bin.t.uint8;
                        return n[3] = e[r], n[2] = e[r + 1], n[1] = e[r + 2], n[0] = e[r + 3], t._bin.t.uint32[0]
                    },
                    readUint64: function (e, r) {
                        return 4294967296 * t._bin.readUint(e, r) + t._bin.readUint(e, r + 4)
                    },
                    readASCII: function (e, t, r) {
                        for (var n = "", a = 0; a < r; a++) n += String.fromCharCode(e[t + a]);
                        return n
                    },
                    readUnicode: function (e, t, r) {
                        for (var n = "", a = 0; a < r; a++) {
                            var o = e[t++] << 8 | e[t++];
                            n += String.fromCharCode(o)
                        }
                        return n
                    },
                    _tdec: e.TextDecoder ? new e.TextDecoder : null,
                    readUTF8: function (e, r, n) {
                        var a = t._bin._tdec;
                        return a && 0 == r && n == e.length ? a.decode(e) : t._bin.readASCII(e, r, n)
                    },
                    readBytes: function (e, t, r) {
                        for (var n = [], a = 0; a < r; a++) n.push(e[t + a]);
                        return n
                    },
                    readASCIIArray: function (e, t, r) {
                        for (var n = [], a = 0; a < r; a++) n.push(String.fromCharCode(e[t + a]));
                        return n
                    }
                }, t._bin.t = {
                    buff: new ArrayBuffer(8)
                }, t._bin.t.int8 = new Int8Array(t._bin.t.buff), t._bin.t.uint8 = new Uint8Array(t._bin.t.buff), t._bin.t.int16 = new Int16Array(t._bin.t.buff), t._bin.t.uint16 = new Uint16Array(t._bin.t.buff), t._bin.t.int32 = new Int32Array(t._bin.t.buff), t._bin.t.uint32 = new Uint32Array(t._bin.t.buff), t._lctf = {}, t._lctf.parse = function (e, r, n, a, o) {
                    var i = t._bin,
                        s = {},
                        l = r;
                    i.readFixed(e, r);
                    r += 4;
                    var u = i.readUshort(e, r);
                    r += 2;
                    var f = i.readUshort(e, r);
                    r += 2;
                    var h = i.readUshort(e, r);
                    return r += 2, s.scriptList = t._lctf.readScriptList(e, l + u), s.featureList = t._lctf.readFeatureList(e, l + f), s.lookupList = t._lctf.readLookupList(e, l + h, o), s
                }, t._lctf.readLookupList = function (e, r, n) {
                    var a = t._bin,
                        o = r,
                        i = [],
                        s = a.readUshort(e, r);
                    r += 2;
                    for (var l = 0; l < s; l++) {
                        var u = a.readUshort(e, r);
                        r += 2;
                        var f = t._lctf.readLookupTable(e, o + u, n);
                        i.push(f)
                    }
                    return i
                }, t._lctf.readLookupTable = function (e, r, n) {
                    var a = t._bin,
                        o = r,
                        i = {
                            tabs: []
                        };
                    i.ltype = a.readUshort(e, r), r += 2, i.flag = a.readUshort(e, r), r += 2;
                    var s = a.readUshort(e, r);
                    r += 2;
                    for (var l = 0; l < s; l++) {
                        var u = a.readUshort(e, r);
                        r += 2;
                        var f = n(e, i.ltype, o + u);
                        i.tabs.push(f)
                    }
                    return i
                }, t._lctf.numOfOnes = function (e) {
                    for (var t = 0, r = 0; r < 32; r++) 0 != (e >>> r & 1) && t++;
                    return t
                }, t._lctf.readClassDef = function (e, r) {
                    var n = t._bin,
                        a = [],
                        o = n.readUshort(e, r);
                    if (r += 2, 1 == o) {
                        var i = n.readUshort(e, r);
                        r += 2;
                        var s = n.readUshort(e, r);
                        r += 2;
                        for (var l = 0; l < s; l++) a.push(i + l), a.push(i + l), a.push(n.readUshort(e, r)), r += 2
                    }
                    if (2 == o) {
                        var u = n.readUshort(e, r);
                        r += 2;
                        for (l = 0; l < u; l++) a.push(n.readUshort(e, r)), r += 2, a.push(n.readUshort(e, r)), r += 2, a.push(n.readUshort(e, r)), r += 2
                    }
                    return a
                }, t._lctf.getInterval = function (e, t) {
                    for (var r = 0; r < e.length; r += 3) {
                        var n = e[r],
                            a = e[r + 1];
                        e[r + 2];
                        if (n <= t && t <= a) return r
                    }
                    return -1
                }, t._lctf.readCoverage = function (e, r) {
                    var n = t._bin,
                        a = {};
                    a.fmt = n.readUshort(e, r), r += 2;
                    var o = n.readUshort(e, r);
                    return r += 2, 1 == a.fmt && (a.tab = n.readUshorts(e, r, o)), 2 == a.fmt && (a.tab = n.readUshorts(e, r, 3 * o)), a
                }, t._lctf.coverageIndex = function (e, r) {
                    var n = e.tab;
                    if (1 == e.fmt) return n.indexOf(r);
                    if (2 == e.fmt) {
                        var a = t._lctf.getInterval(n, r);
                        if (-1 != a) return n[a + 2] + (r - n[a])
                    }
                    return -1
                }, t._lctf.readFeatureList = function (e, r) {
                    var n = t._bin,
                        a = r,
                        o = [],
                        i = n.readUshort(e, r);
                    r += 2;
                    for (var s = 0; s < i; s++) {
                        var l = n.readASCII(e, r, 4);
                        r += 4;
                        var u = n.readUshort(e, r);
                        r += 2, o.push({
                            tag: l.trim(),
                            tab: t._lctf.readFeatureTable(e, a + u)
                        })
                    }
                    return o
                }, t._lctf.readFeatureTable = function (e, r) {
                    var n = t._bin;
                    n.readUshort(e, r);
                    r += 2;
                    var a = n.readUshort(e, r);
                    r += 2;
                    for (var o = [], i = 0; i < a; i++) o.push(n.readUshort(e, r + 2 * i));
                    return o
                }, t._lctf.readScriptList = function (e, r) {
                    var n = t._bin,
                        a = r,
                        o = {},
                        i = n.readUshort(e, r);
                    r += 2;
                    for (var s = 0; s < i; s++) {
                        var l = n.readASCII(e, r, 4);
                        r += 4;
                        var u = n.readUshort(e, r);
                        r += 2, o[l.trim()] = t._lctf.readScriptTable(e, a + u)
                    }
                    return o
                }, t._lctf.readScriptTable = function (e, r) {
                    var n = t._bin,
                        a = r,
                        o = {},
                        i = n.readUshort(e, r);
                    r += 2, o.default = t._lctf.readLangSysTable(e, a + i);
                    var s = n.readUshort(e, r);
                    r += 2;
                    for (var l = 0; l < s; l++) {
                        var u = n.readASCII(e, r, 4);
                        r += 4;
                        var f = n.readUshort(e, r);
                        r += 2, o[u.trim()] = t._lctf.readLangSysTable(e, a + f)
                    }
                    return o
                }, t._lctf.readLangSysTable = function (e, r) {
                    var n = t._bin,
                        a = {};
                    n.readUshort(e, r);
                    r += 2, a.reqFeature = n.readUshort(e, r), r += 2;
                    var o = n.readUshort(e, r);
                    return r += 2, a.features = n.readUshorts(e, r, o), a
                }, t.CFF = {}, t.CFF.parse = function (e, r, n) {
                    var a = t._bin;
                    (e = new Uint8Array(e.buffer, r, n))[r = 0], e[++r], e[++r], e[++r];
                    r++;
                    var o = [];
                    r = t.CFF.readIndex(e, r, o);
                    for (var i = [], s = 0; s < o.length - 1; s++) i.push(a.readASCII(e, r + o[s], o[s + 1] - o[s]));
                    r += o[o.length - 1];
                    var l = [];
                    r = t.CFF.readIndex(e, r, l);
                    var u = [];
                    for (s = 0; s < l.length - 1; s++) u.push(t.CFF.readDict(e, r + l[s], r + l[s + 1]));
                    r += l[l.length - 1];
                    var f = u[0],
                        h = [];
                    r = t.CFF.readIndex(e, r, h);
                    var d = [];
                    for (s = 0; s < h.length - 1; s++) d.push(a.readASCII(e, r + h[s], h[s + 1] - h[s]));
                    if (r += h[h.length - 1], t.CFF.readSubrs(e, r, f), f.CharStrings) {
                        r = f.CharStrings;
                        h = [];
                        r = t.CFF.readIndex(e, r, h);
                        var c = [];
                        for (s = 0; s < h.length - 1; s++) c.push(a.readBytes(e, r + h[s], h[s + 1] - h[s]));
                        f.CharStrings = c
                    }
                    if (f.ROS) {
                        r = f.FDArray;
                        var p = [];
                        r = t.CFF.readIndex(e, r, p), f.FDArray = [];
                        for (s = 0; s < p.length - 1; s++) {
                            var v = t.CFF.readDict(e, r + p[s], r + p[s + 1]);
                            t.CFF._readFDict(e, v, d), f.FDArray.push(v)
                        }
                        r += p[p.length - 1], r = f.FDSelect, f.FDSelect = [];
                        var g = e[r];
                        if (r++, 3 != g) throw g;
                        var m = a.readUshort(e, r);
                        r += 2;
                        for (s = 0; s < m + 1; s++) f.FDSelect.push(a.readUshort(e, r), e[r + 2]), r += 3
                    }
                    return f.Encoding && (f.Encoding = t.CFF.readEncoding(e, f.Encoding, f.CharStrings.length)), f.charset && (f.charset = t.CFF.readCharset(e, f.charset, f.CharStrings.length)), t.CFF._readFDict(e, f, d), f
                }, t.CFF._readFDict = function (e, r, n) {
                    var a;
                    for (var o in r.Private && (a = r.Private[1], r.Private = t.CFF.readDict(e, a, a + r.Private[0]), r.Private.Subrs && t.CFF.readSubrs(e, a + r.Private.Subrs, r.Private)), r) - 1 != ["FamilyName", "FontName", "FullName", "Notice", "version", "Copyright"].indexOf(o) && (r[o] = n[r[o] - 426 + 35])
                }, t.CFF.readSubrs = function (e, r, n) {
                    var a = t._bin,
                        o = [];
                    r = t.CFF.readIndex(e, r, o);
                    var i, s = o.length;
                    i = s < 1240 ? 107 : s < 33900 ? 1131 : 32768, n.Bias = i, n.Subrs = [];
                    for (var l = 0; l < o.length - 1; l++) n.Subrs.push(a.readBytes(e, r + o[l], o[l + 1] - o[l]))
                }, t.CFF.tableSE = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 0, 111, 112, 113, 114, 0, 115, 116, 117, 118, 119, 120, 121, 122, 0, 123, 0, 124, 125, 126, 127, 128, 129, 130, 131, 0, 132, 133, 0, 134, 135, 136, 137, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 138, 0, 139, 0, 0, 0, 0, 140, 141, 142, 143, 0, 0, 0, 0, 0, 144, 0, 0, 0, 145, 0, 0, 146, 147, 148, 149, 0, 0, 0, 0], t.CFF.glyphByUnicode = function (e, t) {
                    for (var r = 0; r < e.charset.length; r++)
                        if (e.charset[r] == t) return r;
                    return -1
                }, t.CFF.glyphBySE = function (e, r) {
                    return r < 0 || r > 255 ? -1 : t.CFF.glyphByUnicode(e, t.CFF.tableSE[r])
                }, t.CFF.readEncoding = function (e, r, n) {
                    t._bin;
                    var a = [".notdef"],
                        o = e[r];
                    if (r++, 0 != o) throw "error: unknown encoding format: " + o;
                    var i = e[r];
                    r++;
                    for (var s = 0; s < i; s++) a.push(e[r + s]);
                    return a
                }, t.CFF.readCharset = function (e, r, n) {
                    var a = t._bin,
                        o = [".notdef"],
                        i = e[r];
                    if (r++, 0 == i)
                        for (var s = 0; s < n; s++) {
                            var l = a.readUshort(e, r);
                            r += 2, o.push(l)
                        } else {
                            if (1 != i && 2 != i) throw "error: format: " + i;
                            for (; o.length < n;) {
                                l = a.readUshort(e, r);
                                r += 2;
                                var u = 0;
                                1 == i ? (u = e[r], r++) : (u = a.readUshort(e, r), r += 2);
                                for (s = 0; s <= u; s++) o.push(l), l++
                            }
                        }
                    return o
                }, t.CFF.readIndex = function (e, r, n) {
                    var a = t._bin,
                        o = a.readUshort(e, r) + 1,
                        i = e[r += 2];
                    if (r++, 1 == i)
                        for (var s = 0; s < o; s++) n.push(e[r + s]);
                    else if (2 == i)
                        for (s = 0; s < o; s++) n.push(a.readUshort(e, r + 2 * s));
                    else if (3 == i)
                        for (s = 0; s < o; s++) n.push(16777215 & a.readUint(e, r + 3 * s - 1));
                    else if (1 != o) throw "unsupported offset size: " + i + ", count: " + o;
                    return (r += o * i) - 1
                }, t.CFF.getCharString = function (e, r, n) {
                    var a = t._bin,
                        o = e[r],
                        i = e[r + 1],
                        s = (e[r + 2], e[r + 3], e[r + 4], 1),
                        l = null,
                        u = null;
                    o <= 20 && (l = o, s = 1), 12 == o && (l = 100 * o + i, s = 2), 21 <= o && o <= 27 && (l = o, s = 1), 28 == o && (u = a.readShort(e, r + 1), s = 3), 29 <= o && o <= 31 && (l = o, s = 1), 32 <= o && o <= 246 && (u = o - 139, s = 1), 247 <= o && o <= 250 && (u = 256 * (o - 247) + i + 108, s = 2), 251 <= o && o <= 254 && (u = 256 * -(o - 251) - i - 108, s = 2), 255 == o && (u = a.readInt(e, r + 1) / 65535, s = 5), n.val = null != u ? u : "o" + l, n.size = s
                }, t.CFF.readCharString = function (e, r, n) {
                    for (var a = r + n, o = t._bin, i = []; r < a;) {
                        var s = e[r],
                            l = e[r + 1],
                            u = (e[r + 2], e[r + 3], e[r + 4], 1),
                            f = null,
                            h = null;
                        s <= 20 && (f = s, u = 1), 12 == s && (f = 100 * s + l, u = 2), 19 != s && 20 != s || (f = s, u = 2), 21 <= s && s <= 27 && (f = s, u = 1), 28 == s && (h = o.readShort(e, r + 1), u = 3), 29 <= s && s <= 31 && (f = s, u = 1), 32 <= s && s <= 246 && (h = s - 139, u = 1), 247 <= s && s <= 250 && (h = 256 * (s - 247) + l + 108, u = 2), 251 <= s && s <= 254 && (h = 256 * -(s - 251) - l - 108, u = 2), 255 == s && (h = o.readInt(e, r + 1) / 65535, u = 5), i.push(null != h ? h : "o" + f), r += u
                    }
                    return i
                }, t.CFF.readDict = function (e, r, n) {
                    for (var a = t._bin, o = {}, i = []; r < n;) {
                        var s = e[r],
                            l = e[r + 1],
                            u = (e[r + 2], e[r + 3], e[r + 4], 1),
                            f = null,
                            h = null;
                        if (28 == s && (h = a.readShort(e, r + 1), u = 3), 29 == s && (h = a.readInt(e, r + 1), u = 5), 32 <= s && s <= 246 && (h = s - 139, u = 1), 247 <= s && s <= 250 && (h = 256 * (s - 247) + l + 108, u = 2), 251 <= s && s <= 254 && (h = 256 * -(s - 251) - l - 108, u = 2), 255 == s) throw h = a.readInt(e, r + 1) / 65535, u = 5, "unknown number";
                        if (30 == s) {
                            var d = [];
                            for (u = 1;;) {
                                var c = e[r + u];
                                u++;
                                var p = c >> 4,
                                    v = 15 & c;
                                if (15 != p && d.push(p), 15 != v && d.push(v), 15 == v) break
                            }
                            for (var g = "", m = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ".", "e", "e-", "reserved", "-", "endOfNumber"], y = 0; y < d.length; y++) g += m[d[y]];
                            h = parseFloat(g)
                        }
                        if (s <= 21)
                            if (f = ["version", "Notice", "FullName", "FamilyName", "Weight", "FontBBox", "BlueValues", "OtherBlues", "FamilyBlues", "FamilyOtherBlues", "StdHW", "StdVW", "escape", "UniqueID", "XUID", "charset", "Encoding", "CharStrings", "Private", "Subrs", "defaultWidthX", "nominalWidthX"][s], u = 1, 12 == s) f = ["Copyright", "isFixedPitch", "ItalicAngle", "UnderlinePosition", "UnderlineThickness", "PaintType", "CharstringType", "FontMatrix", "StrokeWidth", "BlueScale", "BlueShift", "BlueFuzz", "StemSnapH", "StemSnapV", "ForceBold", 0, 0, "LanguageGroup", "ExpansionFactor", "initialRandomSeed", "SyntheticBase", "PostScript", "BaseFontName", "BaseFontBlend", 0, 0, 0, 0, 0, 0, "ROS", "CIDFontVersion", "CIDFontRevision", "CIDFontType", "CIDCount", "UIDBase", "FDArray", "FDSelect", "FontName"][l], u = 2;
                        null != f ? (o[f] = 1 == i.length ? i[0] : i, i = []) : i.push(h), r += u
                    }
                    return o
                }, t.cmap = {}, t.cmap.parse = function (e, r, n) {
                    e = new Uint8Array(e.buffer, r, n), r = 0;
                    var a = t._bin,
                        o = {};
                    a.readUshort(e, r);
                    r += 2;
                    var i = a.readUshort(e, r);
                    r += 2;
                    var s = [];
                    o.tables = [];
                    for (var l = 0; l < i; l++) {
                        var u = a.readUshort(e, r);
                        r += 2;
                        var f = a.readUshort(e, r);
                        r += 2;
                        var h = a.readUint(e, r);
                        r += 4;
                        var d = "p" + u + "e" + f,
                            c = s.indexOf(h);
                        if (-1 == c) {
                            var p;
                            c = o.tables.length, s.push(h);
                            var v = a.readUshort(e, h);
                            0 == v ? p = t.cmap.parse0(e, h) : 4 == v ? p = t.cmap.parse4(e, h) : 6 == v ? p = t.cmap.parse6(e, h) : 12 == v ? p = t.cmap.parse12(e, h) : console.log("unknown format: " + v, u, f, h), o.tables.push(p)
                        }
                        if (null != o[d]) throw "multiple tables for one platform+encoding";
                        o[d] = c
                    }
                    return o
                }, t.cmap.parse0 = function (e, r) {
                    var n = t._bin,
                        a = {};
                    a.format = n.readUshort(e, r), r += 2;
                    var o = n.readUshort(e, r);
                    r += 2;
                    n.readUshort(e, r);
                    r += 2, a.map = [];
                    for (var i = 0; i < o - 6; i++) a.map.push(e[r + i]);
                    return a
                }, t.cmap.parse4 = function (e, r) {
                    var n = t._bin,
                        a = r,
                        o = {};
                    o.format = n.readUshort(e, r), r += 2;
                    var i = n.readUshort(e, r);
                    r += 2;
                    n.readUshort(e, r);
                    r += 2;
                    var s = n.readUshort(e, r);
                    r += 2;
                    var l = s / 2;
                    o.searchRange = n.readUshort(e, r), r += 2, o.entrySelector = n.readUshort(e, r), r += 2, o.rangeShift = n.readUshort(e, r), r += 2, o.endCount = n.readUshorts(e, r, l), r += 2 * l, r += 2, o.startCount = n.readUshorts(e, r, l), r += 2 * l, o.idDelta = [];
                    for (var u = 0; u < l; u++) o.idDelta.push(n.readShort(e, r)), r += 2;
                    for (o.idRangeOffset = n.readUshorts(e, r, l), r += 2 * l, o.glyphIdArray = []; r < a + i;) o.glyphIdArray.push(n.readUshort(e, r)), r += 2;
                    return o
                }, t.cmap.parse6 = function (e, r) {
                    var n = t._bin,
                        a = {};
                    a.format = n.readUshort(e, r), r += 2;
                    n.readUshort(e, r);
                    r += 2;
                    n.readUshort(e, r);
                    r += 2, a.firstCode = n.readUshort(e, r), r += 2;
                    var o = n.readUshort(e, r);
                    r += 2, a.glyphIdArray = [];
                    for (var i = 0; i < o; i++) a.glyphIdArray.push(n.readUshort(e, r)), r += 2;
                    return a
                }, t.cmap.parse12 = function (e, r) {
                    var n = t._bin,
                        a = {};
                    a.format = n.readUshort(e, r), r += 2, r += 2;
                    n.readUint(e, r);
                    r += 4;
                    n.readUint(e, r);
                    r += 4;
                    var o = n.readUint(e, r);
                    r += 4, a.groups = [];
                    for (var i = 0; i < o; i++) {
                        var s = r + 12 * i,
                            l = n.readUint(e, s + 0),
                            u = n.readUint(e, s + 4),
                            f = n.readUint(e, s + 8);
                        a.groups.push([l, u, f])
                    }
                    return a
                }, t.glyf = {}, t.glyf.parse = function (e, t, r, n) {
                    for (var a = [], o = 0; o < n.maxp.numGlyphs; o++) a.push(null);
                    return a
                }, t.glyf._parseGlyf = function (e, r) {
                    var n = t._bin,
                        a = e._data,
                        o = t._tabOffset(a, "glyf", e._offset) + e.loca[r];
                    if (e.loca[r] == e.loca[r + 1]) return null;
                    var i = {};
                    if (i.noc = n.readShort(a, o), o += 2, i.xMin = n.readShort(a, o), o += 2, i.yMin = n.readShort(a, o), o += 2, i.xMax = n.readShort(a, o), o += 2, i.yMax = n.readShort(a, o), o += 2, i.xMin >= i.xMax || i.yMin >= i.yMax) return null;
                    if (i.noc > 0) {
                        i.endPts = [];
                        for (var s = 0; s < i.noc; s++) i.endPts.push(n.readUshort(a, o)), o += 2;
                        var l = n.readUshort(a, o);
                        if (o += 2, a.length - o < l) return null;
                        i.instructions = n.readBytes(a, o, l), o += l;
                        var u = i.endPts[i.noc - 1] + 1;
                        i.flags = [];
                        for (s = 0; s < u; s++) {
                            var f = a[o];
                            if (o++, i.flags.push(f), 0 != (8 & f)) {
                                var h = a[o];
                                o++;
                                for (var d = 0; d < h; d++) i.flags.push(f), s++
                            }
                        }
                        i.xs = [];
                        for (s = 0; s < u; s++) {
                            var c = 0 != (2 & i.flags[s]),
                                p = 0 != (16 & i.flags[s]);
                            c ? (i.xs.push(p ? a[o] : -a[o]), o++) : p ? i.xs.push(0) : (i.xs.push(n.readShort(a, o)), o += 2)
                        }
                        i.ys = [];
                        for (s = 0; s < u; s++) {
                            c = 0 != (4 & i.flags[s]), p = 0 != (32 & i.flags[s]);
                            c ? (i.ys.push(p ? a[o] : -a[o]), o++) : p ? i.ys.push(0) : (i.ys.push(n.readShort(a, o)), o += 2)
                        }
                        var v = 0,
                            g = 0;
                        for (s = 0; s < u; s++) v += i.xs[s], g += i.ys[s], i.xs[s] = v, i.ys[s] = g
                    } else {
                        var m;
                        i.parts = [];
                        do {
                            m = n.readUshort(a, o), o += 2;
                            var y = {
                                m: {
                                    a: 1,
                                    b: 0,
                                    c: 0,
                                    d: 1,
                                    tx: 0,
                                    ty: 0
                                },
                                p1: -1,
                                p2: -1
                            };
                            if (i.parts.push(y), y.glyphIndex = n.readUshort(a, o), o += 2, 1 & m) {
                                var U = n.readShort(a, o);
                                o += 2;
                                var b = n.readShort(a, o);
                                o += 2
                            } else {
                                U = n.readInt8(a, o);
                                o++;
                                b = n.readInt8(a, o);
                                o++
                            }
                            2 & m ? (y.m.tx = U, y.m.ty = b) : (y.p1 = U, y.p2 = b), 8 & m ? (y.m.a = y.m.d = n.readF2dot14(a, o), o += 2) : 64 & m ? (y.m.a = n.readF2dot14(a, o), o += 2, y.m.d = n.readF2dot14(a, o), o += 2) : 128 & m && (y.m.a = n.readF2dot14(a, o), o += 2, y.m.b = n.readF2dot14(a, o), o += 2, y.m.c = n.readF2dot14(a, o), o += 2, y.m.d = n.readF2dot14(a, o), o += 2)
                        } while (32 & m);
                        if (256 & m) {
                            var S = n.readUshort(a, o);
                            o += 2, i.instr = [];
                            for (s = 0; s < S; s++) i.instr.push(a[o]), o++
                        }
                    }
                    return i
                }, t.GPOS = {}, t.GPOS.parse = function (e, r, n, a) {
                    return t._lctf.parse(e, r, n, a, t.GPOS.subt)
                }, t.GPOS.subt = function (e, r, n) {
                    var a = t._bin,
                        o = n,
                        i = {};
                    if (i.fmt = a.readUshort(e, n), n += 2, 1 == r || 2 == r || 3 == r || 7 == r || 8 == r && i.fmt <= 2) {
                        var s = a.readUshort(e, n);
                        n += 2, i.coverage = t._lctf.readCoverage(e, s + o)
                    }
                    if (1 == r && 1 == i.fmt) {
                        var l = a.readUshort(e, n);
                        n += 2;
                        var u = t._lctf.numOfOnes(l);
                        0 != l && (i.pos = t.GPOS.readValueRecord(e, n, l))
                    } else if (2 == r) {
                        l = a.readUshort(e, n);
                        n += 2;
                        var f = a.readUshort(e, n);
                        n += 2;
                        u = t._lctf.numOfOnes(l);
                        var h = t._lctf.numOfOnes(f);
                        if (1 == i.fmt) {
                            i.pairsets = [];
                            var d = a.readUshort(e, n);
                            n += 2;
                            for (var c = 0; c < d; c++) {
                                var p = o + a.readUshort(e, n);
                                n += 2;
                                var v = a.readUshort(e, p);
                                p += 2;
                                for (var g = [], m = 0; m < v; m++) {
                                    var y = a.readUshort(e, p);
                                    p += 2, 0 != l && (k = t.GPOS.readValueRecord(e, p, l), p += 2 * u), 0 != f && (w = t.GPOS.readValueRecord(e, p, f), p += 2 * h), g.push({
                                        gid2: y,
                                        val1: k,
                                        val2: w
                                    })
                                }
                                i.pairsets.push(g)
                            }
                        }
                        if (2 == i.fmt) {
                            var U = a.readUshort(e, n);
                            n += 2;
                            var b = a.readUshort(e, n);
                            n += 2;
                            var S = a.readUshort(e, n);
                            n += 2;
                            var x = a.readUshort(e, n);
                            n += 2, i.classDef1 = t._lctf.readClassDef(e, o + U), i.classDef2 = t._lctf.readClassDef(e, o + b), i.matrix = [];
                            for (c = 0; c < S; c++) {
                                var _ = [];
                                for (m = 0; m < x; m++) {
                                    var k = null,
                                        w = null;
                                    0 != i.valFmt1 && (k = t.GPOS.readValueRecord(e, n, i.valFmt1), n += 2 * u), 0 != i.valFmt2 && (w = t.GPOS.readValueRecord(e, n, i.valFmt2), n += 2 * h), _.push({
                                        val1: k,
                                        val2: w
                                    })
                                }
                                i.matrix.push(_)
                            }
                        }
                    }
                    return i
                }, t.GPOS.readValueRecord = function (e, r, n) {
                    var a = t._bin,
                        o = [];
                    return o.push(1 & n ? a.readShort(e, r) : 0), r += 1 & n ? 2 : 0, o.push(2 & n ? a.readShort(e, r) : 0), r += 2 & n ? 2 : 0, o.push(4 & n ? a.readShort(e, r) : 0), r += 4 & n ? 2 : 0, o.push(8 & n ? a.readShort(e, r) : 0), r += 8 & n ? 2 : 0, o
                }, t.GSUB = {}, t.GSUB.parse = function (e, r, n, a) {
                    return t._lctf.parse(e, r, n, a, t.GSUB.subt)
                }, t.GSUB.subt = function (e, r, n) {
                    var a = t._bin,
                        o = n,
                        i = {};
                    if (i.fmt = a.readUshort(e, n), n += 2, 1 != r && 4 != r && 5 != r && 6 != r) return null;
                    if (1 == r || 4 == r || 5 == r && i.fmt <= 2 || 6 == r && i.fmt <= 2) {
                        var s = a.readUshort(e, n);
                        n += 2, i.coverage = t._lctf.readCoverage(e, o + s)
                    }
                    if (1 == r) {
                        if (1 == i.fmt) i.delta = a.readShort(e, n), n += 2;
                        else if (2 == i.fmt) {
                            var l = a.readUshort(e, n);
                            n += 2, i.newg = a.readUshorts(e, n, l), n += 2 * i.newg.length
                        }
                    } else if (4 == r) {
                        i.vals = [];
                        l = a.readUshort(e, n);
                        n += 2;
                        for (var u = 0; u < l; u++) {
                            var f = a.readUshort(e, n);
                            n += 2, i.vals.push(t.GSUB.readLigatureSet(e, o + f))
                        }
                    } else if (5 == r) {
                        if (2 == i.fmt) {
                            var h = a.readUshort(e, n);
                            n += 2, i.cDef = t._lctf.readClassDef(e, o + h), i.scset = [];
                            var d = a.readUshort(e, n);
                            n += 2;
                            for (u = 0; u < d; u++) {
                                var c = a.readUshort(e, n);
                                n += 2, i.scset.push(0 == c ? null : t.GSUB.readSubClassSet(e, o + c))
                            }
                        }
                    } else if (6 == r && 3 == i.fmt) {
                        for (u = 0; u < 3; u++) {
                            l = a.readUshort(e, n);
                            n += 2;
                            for (var p = [], v = 0; v < l; v++) p.push(t._lctf.readCoverage(e, o + a.readUshort(e, n + 2 * v)));
                            n += 2 * l, 0 == u && (i.backCvg = p), 1 == u && (i.inptCvg = p), 2 == u && (i.ahedCvg = p)
                        }
                        l = a.readUshort(e, n);
                        n += 2, i.lookupRec = t.GSUB.readSubstLookupRecords(e, n, l)
                    }
                    return i
                }, t.GSUB.readSubClassSet = function (e, r) {
                    var n = t._bin.readUshort,
                        a = r,
                        o = [],
                        i = n(e, r);
                    r += 2;
                    for (var s = 0; s < i; s++) {
                        var l = n(e, r);
                        r += 2, o.push(t.GSUB.readSubClassRule(e, a + l))
                    }
                    return o
                }, t.GSUB.readSubClassRule = function (e, r) {
                    var n = t._bin.readUshort,
                        a = {},
                        o = n(e, r),
                        i = n(e, r += 2);
                    r += 2, a.input = [];
                    for (var s = 0; s < o - 1; s++) a.input.push(n(e, r)), r += 2;
                    return a.substLookupRecords = t.GSUB.readSubstLookupRecords(e, r, i), a
                }, t.GSUB.readSubstLookupRecords = function (e, r, n) {
                    for (var a = t._bin.readUshort, o = [], i = 0; i < n; i++) o.push(a(e, r), a(e, r + 2)), r += 4;
                    return o
                }, t.GSUB.readChainSubClassSet = function (e, r) {
                    var n = t._bin,
                        a = r,
                        o = [],
                        i = n.readUshort(e, r);
                    r += 2;
                    for (var s = 0; s < i; s++) {
                        var l = n.readUshort(e, r);
                        r += 2, o.push(t.GSUB.readChainSubClassRule(e, a + l))
                    }
                    return o
                }, t.GSUB.readChainSubClassRule = function (e, r) {
                    for (var n = t._bin, a = {}, o = ["backtrack", "input", "lookahead"], i = 0; i < o.length; i++) {
                        var s = n.readUshort(e, r);
                        r += 2, 1 == i && s--, a[o[i]] = n.readUshorts(e, r, s), r += 2 * a[o[i]].length
                    }
                    s = n.readUshort(e, r);
                    return r += 2, a.subst = n.readUshorts(e, r, 2 * s), r += 2 * a.subst.length, a
                }, t.GSUB.readLigatureSet = function (e, r) {
                    var n = t._bin,
                        a = r,
                        o = [],
                        i = n.readUshort(e, r);
                    r += 2;
                    for (var s = 0; s < i; s++) {
                        var l = n.readUshort(e, r);
                        r += 2, o.push(t.GSUB.readLigature(e, a + l))
                    }
                    return o
                }, t.GSUB.readLigature = function (e, r) {
                    var n = t._bin,
                        a = {
                            chain: []
                        };
                    a.nglyph = n.readUshort(e, r), r += 2;
                    var o = n.readUshort(e, r);
                    r += 2;
                    for (var i = 0; i < o - 1; i++) a.chain.push(n.readUshort(e, r)), r += 2;
                    return a
                }, t.head = {}, t.head.parse = function (e, r, n) {
                    var a = t._bin,
                        o = {};
                    a.readFixed(e, r);
                    r += 4, o.fontRevision = a.readFixed(e, r), r += 4;
                    a.readUint(e, r);
                    r += 4;
                    a.readUint(e, r);
                    return r += 4, o.flags = a.readUshort(e, r), r += 2, o.unitsPerEm = a.readUshort(e, r), r += 2, o.created = a.readUint64(e, r), r += 8, o.modified = a.readUint64(e, r), r += 8, o.xMin = a.readShort(e, r), r += 2, o.yMin = a.readShort(e, r), r += 2, o.xMax = a.readShort(e, r), r += 2, o.yMax = a.readShort(e, r), r += 2, o.macStyle = a.readUshort(e, r), r += 2, o.lowestRecPPEM = a.readUshort(e, r), r += 2, o.fontDirectionHint = a.readShort(e, r), r += 2, o.indexToLocFormat = a.readShort(e, r), r += 2, o.glyphDataFormat = a.readShort(e, r), r += 2, o
                }, t.hhea = {}, t.hhea.parse = function (e, r, n) {
                    var a = t._bin,
                        o = {};
                    a.readFixed(e, r);
                    return r += 4, o.ascender = a.readShort(e, r), r += 2, o.descender = a.readShort(e, r), r += 2, o.lineGap = a.readShort(e, r), r += 2, o.advanceWidthMax = a.readUshort(e, r), r += 2, o.minLeftSideBearing = a.readShort(e, r), r += 2, o.minRightSideBearing = a.readShort(e, r), r += 2, o.xMaxExtent = a.readShort(e, r), r += 2, o.caretSlopeRise = a.readShort(e, r), r += 2, o.caretSlopeRun = a.readShort(e, r), r += 2, o.caretOffset = a.readShort(e, r), r += 2, r += 8, o.metricDataFormat = a.readShort(e, r), r += 2, o.numberOfHMetrics = a.readUshort(e, r), r += 2, o
                }, t.hmtx = {}, t.hmtx.parse = function (e, r, n, a) {
                    for (var o = t._bin, i = {
                            aWidth: [],
                            lsBearing: []
                        }, s = 0, l = 0, u = 0; u < a.maxp.numGlyphs; u++) u < a.hhea.numberOfHMetrics && (s = o.readUshort(e, r), r += 2, l = o.readShort(e, r), r += 2), i.aWidth.push(s), i.lsBearing.push(l);
                    return i
                }, t.kern = {}, t.kern.parse = function (e, r, n, a) {
                    var o = t._bin,
                        i = o.readUshort(e, r);
                    if (r += 2, 1 == i) return t.kern.parseV1(e, r - 2, n, a);
                    var s = o.readUshort(e, r);
                    r += 2;
                    for (var l = {
                            glyph1: [],
                            rval: []
                        }, u = 0; u < s; u++) {
                        r += 2;
                        n = o.readUshort(e, r);
                        r += 2;
                        var f = o.readUshort(e, r);
                        r += 2;
                        var h = f >>> 8;
                        if (0 != (h &= 15)) throw "unknown kern table format: " + h;
                        r = t.kern.readFormat0(e, r, l)
                    }
                    return l
                }, t.kern.parseV1 = function (e, r, n, a) {
                    var o = t._bin;
                    o.readFixed(e, r);
                    r += 4;
                    var i = o.readUint(e, r);
                    r += 4;
                    for (var s = {
                            glyph1: [],
                            rval: []
                        }, l = 0; l < i; l++) {
                        o.readUint(e, r);
                        r += 4;
                        var u = o.readUshort(e, r);
                        r += 2;
                        o.readUshort(e, r);
                        r += 2;
                        var f = u >>> 8;
                        if (0 != (f &= 15)) throw "unknown kern table format: " + f;
                        r = t.kern.readFormat0(e, r, s)
                    }
                    return s
                }, t.kern.readFormat0 = function (e, r, n) {
                    var a = t._bin,
                        o = -1,
                        i = a.readUshort(e, r);
                    r += 2;
                    a.readUshort(e, r);
                    r += 2;
                    a.readUshort(e, r);
                    r += 2;
                    a.readUshort(e, r);
                    r += 2;
                    for (var s = 0; s < i; s++) {
                        var l = a.readUshort(e, r);
                        r += 2;
                        var u = a.readUshort(e, r);
                        r += 2;
                        var f = a.readShort(e, r);
                        r += 2, l != o && (n.glyph1.push(l), n.rval.push({
                            glyph2: [],
                            vals: []
                        }));
                        var h = n.rval[n.rval.length - 1];
                        h.glyph2.push(u), h.vals.push(f), o = l
                    }
                    return r
                }, t.loca = {}, t.loca.parse = function (e, r, n, a) {
                    var o = t._bin,
                        i = [],
                        s = a.head.indexToLocFormat,
                        l = a.maxp.numGlyphs + 1;
                    if (0 == s)
                        for (var u = 0; u < l; u++) i.push(o.readUshort(e, r + (u << 1)) << 1);
                    if (1 == s)
                        for (u = 0; u < l; u++) i.push(o.readUint(e, r + (u << 2)));
                    return i
                }, t.maxp = {}, t.maxp.parse = function (e, r, n) {
                    var a = t._bin,
                        o = {},
                        i = a.readUint(e, r);
                    return r += 4, o.numGlyphs = a.readUshort(e, r), r += 2, 65536 == i && (o.maxPoints = a.readUshort(e, r), r += 2, o.maxContours = a.readUshort(e, r), r += 2, o.maxCompositePoints = a.readUshort(e, r), r += 2, o.maxCompositeContours = a.readUshort(e, r), r += 2, o.maxZones = a.readUshort(e, r), r += 2, o.maxTwilightPoints = a.readUshort(e, r), r += 2, o.maxStorage = a.readUshort(e, r), r += 2, o.maxFunctionDefs = a.readUshort(e, r), r += 2, o.maxInstructionDefs = a.readUshort(e, r), r += 2, o.maxStackElements = a.readUshort(e, r), r += 2, o.maxSizeOfInstructions = a.readUshort(e, r), r += 2, o.maxComponentElements = a.readUshort(e, r), r += 2, o.maxComponentDepth = a.readUshort(e, r), r += 2), o
                }, t.name = {}, t.name.parse = function (e, r, n) {
                    var a = t._bin,
                        o = {};
                    a.readUshort(e, r);
                    r += 2;
                    var i = a.readUshort(e, r);
                    r += 2;
                    a.readUshort(e, r);
                    for (var s, l = ["copyright", "fontFamily", "fontSubfamily", "ID", "fullName", "version", "postScriptName", "trademark", "manufacturer", "designer", "description", "urlVendor", "urlDesigner", "licence", "licenceURL", "---", "typoFamilyName", "typoSubfamilyName", "compatibleFull", "sampleText", "postScriptCID", "wwsFamilyName", "wwsSubfamilyName", "lightPalette", "darkPalette"], u = r += 2, f = 0; f < i; f++) {
                        var h = a.readUshort(e, r);
                        r += 2;
                        var d = a.readUshort(e, r);
                        r += 2;
                        var c = a.readUshort(e, r);
                        r += 2;
                        var p = a.readUshort(e, r);
                        r += 2;
                        var v = a.readUshort(e, r);
                        r += 2;
                        var g = a.readUshort(e, r);
                        r += 2;
                        var m, y = l[p],
                            U = u + 12 * i + g;
                        if (0 == h) m = a.readUnicode(e, U, v / 2);
                        else if (3 == h && 0 == d) m = a.readUnicode(e, U, v / 2);
                        else if (0 == d) m = a.readASCII(e, U, v);
                        else if (1 == d) m = a.readUnicode(e, U, v / 2);
                        else if (3 == d) m = a.readUnicode(e, U, v / 2);
                        else {
                            if (1 != h) throw "unknown encoding " + d + ", platformID: " + h;
                            m = a.readASCII(e, U, v), console.log("reading unknown MAC encoding " + d + " as ASCII")
                        }
                        var b = "p" + h + "," + c.toString(16);
                        null == o[b] && (o[b] = {}), o[b][y] = m, o[b]._lang = c
                    }
                    for (var S in o)
                        if (null != o[S].postScriptName && 1033 == o[S]._lang) return o[S];
                    for (var S in o)
                        if (null != o[S].postScriptName && 0 == o[S]._lang) return o[S];
                    for (var S in o)
                        if (null != o[S].postScriptName && 3084 == o[S]._lang) return o[S];
                    for (var S in o)
                        if (null != o[S].postScriptName) return o[S];
                    for (var S in o) {
                        s = S;
                        break
                    }
                    return console.log("returning name table with languageID " + o[s]._lang), o[s]
                }, t["OS/2"] = {}, t["OS/2"].parse = function (e, r, n) {
                    var a = t._bin.readUshort(e, r);
                    r += 2;
                    var o = {};
                    if (0 == a) t["OS/2"].version0(e, r, o);
                    else if (1 == a) t["OS/2"].version1(e, r, o);
                    else if (2 == a || 3 == a || 4 == a) t["OS/2"].version2(e, r, o);
                    else {
                        if (5 != a) throw "unknown OS/2 table version: " + a;
                        t["OS/2"].version5(e, r, o)
                    }
                    return o
                }, t["OS/2"].version0 = function (e, r, n) {
                    var a = t._bin;
                    return n.xAvgCharWidth = a.readShort(e, r), r += 2, n.usWeightClass = a.readUshort(e, r), r += 2, n.usWidthClass = a.readUshort(e, r), r += 2, n.fsType = a.readUshort(e, r), r += 2, n.ySubscriptXSize = a.readShort(e, r), r += 2, n.ySubscriptYSize = a.readShort(e, r), r += 2, n.ySubscriptXOffset = a.readShort(e, r), r += 2, n.ySubscriptYOffset = a.readShort(e, r), r += 2, n.ySuperscriptXSize = a.readShort(e, r), r += 2, n.ySuperscriptYSize = a.readShort(e, r), r += 2, n.ySuperscriptXOffset = a.readShort(e, r), r += 2, n.ySuperscriptYOffset = a.readShort(e, r), r += 2, n.yStrikeoutSize = a.readShort(e, r), r += 2, n.yStrikeoutPosition = a.readShort(e, r), r += 2, n.sFamilyClass = a.readShort(e, r), r += 2, n.panose = a.readBytes(e, r, 10), r += 10, n.ulUnicodeRange1 = a.readUint(e, r), r += 4, n.ulUnicodeRange2 = a.readUint(e, r), r += 4, n.ulUnicodeRange3 = a.readUint(e, r), r += 4, n.ulUnicodeRange4 = a.readUint(e, r), r += 4, n.achVendID = [a.readInt8(e, r), a.readInt8(e, r + 1), a.readInt8(e, r + 2), a.readInt8(e, r + 3)], r += 4, n.fsSelection = a.readUshort(e, r), r += 2, n.usFirstCharIndex = a.readUshort(e, r), r += 2, n.usLastCharIndex = a.readUshort(e, r), r += 2, n.sTypoAscender = a.readShort(e, r), r += 2, n.sTypoDescender = a.readShort(e, r), r += 2, n.sTypoLineGap = a.readShort(e, r), r += 2, n.usWinAscent = a.readUshort(e, r), r += 2, n.usWinDescent = a.readUshort(e, r), r += 2
                }, t["OS/2"].version1 = function (e, r, n) {
                    var a = t._bin;
                    return r = t["OS/2"].version0(e, r, n), n.ulCodePageRange1 = a.readUint(e, r), r += 4, n.ulCodePageRange2 = a.readUint(e, r), r += 4
                }, t["OS/2"].version2 = function (e, r, n) {
                    var a = t._bin;
                    return r = t["OS/2"].version1(e, r, n), n.sxHeight = a.readShort(e, r), r += 2, n.sCapHeight = a.readShort(e, r), r += 2, n.usDefault = a.readUshort(e, r), r += 2, n.usBreak = a.readUshort(e, r), r += 2, n.usMaxContext = a.readUshort(e, r), r += 2
                }, t["OS/2"].version5 = function (e, r, n) {
                    var a = t._bin;
                    return r = t["OS/2"].version2(e, r, n), n.usLowerOpticalPointSize = a.readUshort(e, r), r += 2, n.usUpperOpticalPointSize = a.readUshort(e, r), r += 2
                }, t.post = {}, t.post.parse = function (e, r, n) {
                    var a = t._bin,
                        o = {};
                    return o.version = a.readFixed(e, r), r += 4, o.italicAngle = a.readFixed(e, r), r += 4, o.underlinePosition = a.readShort(e, r), r += 2, o.underlineThickness = a.readShort(e, r), r += 2, o
                }, t.SVG = {}, t.SVG.parse = function (e, r, n) {
                    var a = t._bin,
                        o = {
                            entries: []
                        },
                        i = r;
                    a.readUshort(e, r);
                    r += 2;
                    var s = a.readUint(e, r);
                    r += 4;
                    a.readUint(e, r);
                    r += 4, r = s + i;
                    var l = a.readUshort(e, r);
                    r += 2;
                    for (var u = 0; u < l; u++) {
                        var f = a.readUshort(e, r);
                        r += 2;
                        var h = a.readUshort(e, r);
                        r += 2;
                        var d = a.readUint(e, r);
                        r += 4;
                        var c = a.readUint(e, r);
                        r += 4;
                        for (var p = new Uint8Array(e.buffer, i + d + s, c), v = a.readUTF8(p, 0, p.length), g = f; g <= h; g++) o.entries[g] = v
                    }
                    return o
                }, t.SVG.toPath = function (e) {
                    var r = {
                        cmds: [],
                        crds: []
                    };
                    if (null == e) return r;
                    for (var n = (new DOMParser).parseFromString(e, "image/svg+xml").firstChild;
                        "svg" != n.tagName;) n = n.nextSibling;
                    var a = n.getAttribute("viewBox");
                    a = a ? a.trim().split(" ").map(parseFloat) : [0, 0, 1e3, 1e3], t.SVG._toPath(n.children, r);
                    for (var o = 0; o < r.crds.length; o += 2) {
                        var i = r.crds[o],
                            s = r.crds[o + 1];
                        i -= a[0], s = -(s -= a[1]), r.crds[o] = i, r.crds[o + 1] = s
                    }
                    return r
                }, t.SVG._toPath = function (e, r, n) {
                    for (var a = 0; a < e.length; a++) {
                        var o = e[a],
                            i = o.tagName,
                            s = o.getAttribute("fill");
                        if (null == s && (s = n), "g" == i) t.SVG._toPath(o.children, r, s);
                        else if ("path" == i) {
                            r.cmds.push(s || "#000000");
                            var l = o.getAttribute("d"),
                                u = t.SVG._tokens(l);
                            t.SVG._toksToPath(u, r), r.cmds.push("X")
                        } else "defs" == i || console.log(i, o)
                    }
                }, t.SVG._tokens = function (e) {
                    for (var t = [], r = 0, n = !1, a = ""; r < e.length;) {
                        var o = e.charCodeAt(r),
                            i = e.charAt(r);
                        r++;
                        var s = 48 <= o && o <= 57 || "." == i || "-" == i;
                        n ? "-" == i ? (t.push(parseFloat(a)), a = i) : s ? a += i : (t.push(parseFloat(a)), "," != i && " " != i && t.push(i), n = !1) : s ? (a = i, n = !0) : "," != i && " " != i && t.push(i)
                    }
                    return n && t.push(parseFloat(a)), t
                }, t.SVG._toksToPath = function (e, r) {
                    for (var n = 0, a = 0, o = 0, i = 0, s = 0, l = {
                            M: 2,
                            L: 2,
                            H: 1,
                            V: 1,
                            S: 4,
                            C: 6
                        }, u = r.cmds, f = r.crds; n < e.length;) {
                        var h = e[n];
                        if (n++, "z" == h) u.push("Z"), a = i, o = s;
                        else
                            for (var d = h.toUpperCase(), c = l[d], p = t.SVG._reps(e, n, c), v = 0; v < p; v++) {
                                var g = 0,
                                    m = 0;
                                if (h != d && (g = a, m = o), "M" == d) a = g + e[n++], o = m + e[n++], u.push("M"), f.push(a, o), i = a, s = o;
                                else if ("L" == d) a = g + e[n++], o = m + e[n++], u.push("L"), f.push(a, o);
                                else if ("H" == d) a = g + e[n++], u.push("L"), f.push(a, o);
                                else if ("V" == d) o = m + e[n++], u.push("L"), f.push(a, o);
                                else if ("C" == d) {
                                    var y = g + e[n++],
                                        U = m + e[n++],
                                        b = g + e[n++],
                                        S = m + e[n++],
                                        x = g + e[n++],
                                        _ = m + e[n++];
                                    u.push("C"), f.push(y, U, b, S, x, _), a = x, o = _
                                } else if ("S" == d) {
                                    var k = Math.max(f.length - 4, 0);
                                    y = a + a - f[k], U = o + o - f[k + 1], b = g + e[n++], S = m + e[n++], x = g + e[n++], _ = m + e[n++];
                                    u.push("C"), f.push(y, U, b, S, x, _), a = x, o = _
                                } else console.log("Unknown SVG command " + h)
                            }
                    }
                }, t.SVG._reps = function (e, t, r) {
                    for (var n = t; n < e.length && "string" != typeof e[n];) n += r;
                    return (n - t) / r
                }, null == t && (t = {}), null == t.U && (t.U = {}), t.U.codeToGlyph = function (e, t) {
                    var r = e.cmap,
                        n = -1;
                    if (null != r.p0e4 ? n = r.p0e4 : null != r.p3e1 ? n = r.p3e1 : null != r.p1e0 ? n = r.p1e0 : null != r.p0e3 && (n = r.p0e3), -1 == n) throw "no familiar platform and encoding!";
                    var a = r.tables[n];
                    if (0 == a.format) return t >= a.map.length ? 0 : a.map[t];
                    if (4 == a.format) {
                        for (var o = -1, i = 0; i < a.endCount.length; i++)
                            if (t <= a.endCount[i]) {
                                o = i;
                                break
                            } if (-1 == o) return 0;
                        if (a.startCount[o] > t) return 0;
                        return 65535 & (0 != a.idRangeOffset[o] ? a.glyphIdArray[t - a.startCount[o] + (a.idRangeOffset[o] >> 1) - (a.idRangeOffset.length - o)] : t + a.idDelta[o])
                    }
                    if (12 == a.format) {
                        if (t > a.groups[a.groups.length - 1][1]) return 0;
                        for (i = 0; i < a.groups.length; i++) {
                            var s = a.groups[i];
                            if (s[0] <= t && t <= s[1]) return s[2] + (t - s[0])
                        }
                        return 0
                    }
                    throw "unknown cmap table format " + a.format
                }, t.U.glyphToPath = function (e, r) {
                    var n = {
                        cmds: [],
                        crds: []
                    };
                    if (e.SVG && e.SVG.entries[r]) {
                        var a = e.SVG.entries[r];
                        return null == a ? n : ("string" == typeof a && (a = t.SVG.toPath(a), e.SVG.entries[r] = a), a)
                    }
                    if (e.CFF) {
                        var o = {
                                x: 0,
                                y: 0,
                                stack: [],
                                nStems: 0,
                                haveWidth: !1,
                                width: e.CFF.Private ? e.CFF.Private.defaultWidthX : 0,
                                open: !1
                            },
                            i = e.CFF,
                            s = e.CFF.Private;
                        if (i.ROS) {
                            for (var l = 0; i.FDSelect[l + 2] <= r;) l += 2;
                            s = i.FDArray[i.FDSelect[l + 1]].Private
                        }
                        t.U._drawCFF(e.CFF.CharStrings[r], o, i, s, n)
                    } else e.glyf && t.U._drawGlyf(r, e, n);
                    return n
                }, t.U._drawGlyf = function (e, r, n) {
                    var a = r.glyf[e];
                    null == a && (a = r.glyf[e] = t.glyf._parseGlyf(r, e)), null != a && (a.noc > -1 ? t.U._simpleGlyph(a, n) : t.U._compoGlyph(a, r, n))
                }, t.U._simpleGlyph = function (e, r) {
                    for (var n = 0; n < e.noc; n++) {
                        for (var a = 0 == n ? 0 : e.endPts[n - 1] + 1, o = e.endPts[n], i = a; i <= o; i++) {
                            var s = i == a ? o : i - 1,
                                l = i == o ? a : i + 1,
                                u = 1 & e.flags[i],
                                f = 1 & e.flags[s],
                                h = 1 & e.flags[l],
                                d = e.xs[i],
                                c = e.ys[i];
                            if (i == a)
                                if (u) {
                                    if (!f) {
                                        t.U.P.moveTo(r, d, c);
                                        continue
                                    }
                                    t.U.P.moveTo(r, e.xs[s], e.ys[s])
                                } else f ? t.U.P.moveTo(r, e.xs[s], e.ys[s]) : t.U.P.moveTo(r, (e.xs[s] + d) / 2, (e.ys[s] + c) / 2);
                            u ? f && t.U.P.lineTo(r, d, c) : h ? t.U.P.qcurveTo(r, d, c, e.xs[l], e.ys[l]) : t.U.P.qcurveTo(r, d, c, (d + e.xs[l]) / 2, (c + e.ys[l]) / 2)
                        }
                        t.U.P.closePath(r)
                    }
                }, t.U._compoGlyph = function (e, r, n) {
                    for (var a = 0; a < e.parts.length; a++) {
                        var o = {
                                cmds: [],
                                crds: []
                            },
                            i = e.parts[a];
                        t.U._drawGlyf(i.glyphIndex, r, o);
                        for (var s = i.m, l = 0; l < o.crds.length; l += 2) {
                            var u = o.crds[l],
                                f = o.crds[l + 1];
                            n.crds.push(u * s.a + f * s.b + s.tx), n.crds.push(u * s.c + f * s.d + s.ty)
                        }
                        for (l = 0; l < o.cmds.length; l++) n.cmds.push(o.cmds[l])
                    }
                }, t.U._getGlyphClass = function (e, r) {
                    var n = t._lctf.getInterval(r, e);
                    return -1 == n ? 0 : r[n + 2]
                }, t.U.getPairAdjustment = function (e, r, n) {
                    if (e.GPOS)
                        for (var a = e.GPOS, o = a.lookupList, i = a.featureList, s = [], l = 0; l < i.length; l++) {
                            var u = i[l];
                            if ("kern" == u.tag)
                                for (var f = 0; f < u.tab.length; f++)
                                    if (!s[u.tab[f]]) {
                                        s[u.tab[f]] = !0;
                                        for (var h = o[u.tab[f]], d = 0; d < h.tabs.length; d++)
                                            if (null != h.tabs[l]) {
                                                var c, p = h.tabs[d];
                                                if (!p.coverage || -1 != (c = t._lctf.coverageIndex(p.coverage, r)))
                                                    if (1 == h.ltype);
                                                    else if (2 == h.ltype) {
                                                    var v;
                                                    if (1 == p.fmt) {
                                                        var g = p.pairsets[c];
                                                        for (l = 0; l < g.length; l++) g[l].gid2 == n && (v = g[l])
                                                    } else if (2 == p.fmt) {
                                                        var m = t.U._getGlyphClass(r, p.classDef1),
                                                            y = t.U._getGlyphClass(n, p.classDef2);
                                                        v = p.matrix[m][y]
                                                    }
                                                    if (v && v.val2) return v.val2[2]
                                                }
                                            }
                                    }
                        }
                    if (e.kern) {
                        var U = e.kern.glyph1.indexOf(r);
                        if (-1 != U) {
                            var b = e.kern.rval[U].glyph2.indexOf(n);
                            if (-1 != b) return e.kern.rval[U].vals[b]
                        }
                    }
                    return 0
                }, t.U.stringToGlyphs = function (e, r) {
                    for (var n = [], a = 0; a < r.length; a++) {
                        (o = r.codePointAt(a)) > 65535 && a++, n.push(t.U.codeToGlyph(e, o))
                    }
                    for (a = 0; a < r.length; a++) {
                        var o;
                        if (2367 == (o = r.codePointAt(a))) {
                            var i = n[a - 1];
                            n[a - 1] = n[a], n[a] = i
                        }
                        o > 65535 && a++
                    }
                    var s = e.GSUB;
                    if (null == s) return n;
                    for (var l = s.lookupList, u = s.featureList, f = ["rlig", "liga", "mset", "isol", "init", "fina", "medi", "half", "pres", "blws"], h = [], d = 0; d < u.length; d++) {
                        var c = u[d];
                        if (-1 != f.indexOf(c.tag))
                            for (var p = 0; p < c.tab.length; p++)
                                if (!h[c.tab[p]]) {
                                    h[c.tab[p]] = !0;
                                    for (var v = l[c.tab[p]], g = 0; g < n.length; g++) {
                                        var m = t.U._getWPfeature(r, g); - 1 != "isol,init,fina,medi".indexOf(c.tag) && c.tag != m || t.U._applySubs(n, g, v, l)
                                    }
                                }
                    }
                    return n
                }, t.U._getWPfeature = function (e, t) {
                    var r = '\n\t" ,.:;!?()  ،',
                        n = "آأؤإاةدذرزوٱٲٳٵٶٷڈډڊڋڌڍڎڏڐڑڒړڔڕږڗژڙۀۃۄۅۆۇۈۉۊۋۍۏےۓەۮۯܐܕܖܗܘܙܞܨܪܬܯݍݙݚݛݫݬݱݳݴݸݹࡀࡆࡇࡉࡔࡧࡩࡪࢪࢫࢬࢮࢱࢲࢹૅેૉ૊૎૏ૐ૑૒૝ૡ૤૯஁ஃ஄அஉ஌எஏ஑னப஫஬",
                        a = 0 == t || -1 != r.indexOf(e[t - 1]),
                        o = t == e.length - 1 || -1 != r.indexOf(e[t + 1]);
                    a || -1 == n.indexOf(e[t - 1]) || (a = !0), o || -1 == n.indexOf(e[t]) || (o = !0), o || -1 == "ꡲ્૗".indexOf(e[t + 1]) || (o = !0), a || -1 == "ꡲ્૗".indexOf(e[t]) || (a = !0);
                    return a ? o ? "isol" : "init" : o ? "fina" : "medi"
                }, t.U._applySubs = function (e, r, n, a) {
                    for (var o = e.length - r - 1, i = 0; i < n.tabs.length; i++)
                        if (null != n.tabs[i]) {
                            var s, l = n.tabs[i];
                            if (!l.coverage || -1 != (s = t._lctf.coverageIndex(l.coverage, e[r])))
                                if (1 == n.ltype) {
                                    e[r];
                                    1 == l.fmt ? e[r] = e[r] + l.delta : e[r] = l.newg[s]
                                } else if (4 == n.ltype)
                                for (var u = l.vals[s], f = 0; f < u.length; f++) {
                                    var h = u[f],
                                        d = h.chain.length;
                                    if (!(d > o)) {
                                        for (var c = !0, p = 0, v = 0; v < d; v++) {
                                            for (; - 1 == e[r + p + (1 + v)];) p++;
                                            h.chain[v] != e[r + p + (1 + v)] && (c = !1)
                                        }
                                        if (c) {
                                            e[r] = h.nglyph;
                                            for (v = 0; v < d + p; v++) e[r + v + 1] = -1;
                                            break
                                        }
                                    }
                                } else if (5 == n.ltype && 2 == l.fmt)
                                    for (var g = t._lctf.getInterval(l.cDef, e[r]), m = l.cDef[g + 2], y = l.scset[m], U = 0; U < y.length; U++) {
                                        var b = y[U],
                                            S = b.input;
                                        if (!(S.length > o)) {
                                            for (c = !0, v = 0; v < S.length; v++) {
                                                var x = t._lctf.getInterval(l.cDef, e[r + 1 + v]);
                                                if (-1 == g && l.cDef[x + 2] != S[v]) {
                                                    c = !1;
                                                    break
                                                }
                                            }
                                            if (c) {
                                                var _ = b.substLookupRecords;
                                                for (f = 0; f < _.length; f += 2) _[f], _[f + 1]
                                            }
                                        }
                                    } else if (6 == n.ltype && 3 == l.fmt) {
                                        if (!t.U._glsCovered(e, l.backCvg, r - l.backCvg.length)) continue;
                                        if (!t.U._glsCovered(e, l.inptCvg, r)) continue;
                                        if (!t.U._glsCovered(e, l.ahedCvg, r + l.inptCvg.length)) continue;
                                        var k = l.lookupRec;
                                        for (U = 0; U < k.length; U += 2) {
                                            g = k[U];
                                            var w = a[k[U + 1]];
                                            t.U._applySubs(e, r + g, w, a)
                                        }
                                    }
                        }
                }, t.U._glsCovered = function (e, r, n) {
                    for (var a = 0; a < r.length; a++) {
                        if (-1 == t._lctf.coverageIndex(r[a], e[n + a])) return !1
                    }
                    return !0
                }, t.U.glyphsToPath = function (e, r, n) {
                    for (var a = {
                            cmds: [],
                            crds: []
                        }, o = 0, i = 0; i < r.length; i++) {
                        var s = r[i];
                        if (-1 != s) {
                            for (var l = i < r.length - 1 && -1 != r[i + 1] ? r[i + 1] : 0, u = t.U.glyphToPath(e, s), f = 0; f < u.crds.length; f += 2) a.crds.push(u.crds[f] + o), a.crds.push(u.crds[f + 1]);
                            n && a.cmds.push(n);
                            for (f = 0; f < u.cmds.length; f++) a.cmds.push(u.cmds[f]);
                            n && a.cmds.push("X"), o += e.hmtx.aWidth[s], i < r.length - 1 && (o += t.U.getPairAdjustment(e, s, l))
                        }
                    }
                    return a
                }, t.U.pathToSVG = function (e, t) {
                    null == t && (t = 5);
                    for (var r = [], n = 0, a = {
                            M: 2,
                            L: 2,
                            Q: 4,
                            C: 6
                        }, o = 0; o < e.cmds.length; o++) {
                        var i = e.cmds[o],
                            s = n + (a[i] ? a[i] : 0);
                        for (r.push(i); n < s;) {
                            var l = e.crds[n++];
                            r.push(parseFloat(l.toFixed(t)) + (n == s ? "" : " "))
                        }
                    }
                    return r.join("")
                }, t.U.pathToContext = function (e, t) {
                    for (var r = 0, n = e.crds, a = 0; a < e.cmds.length; a++) {
                        var o = e.cmds[a];
                        "M" == o ? (t.moveTo(n[r], n[r + 1]), r += 2) : "L" == o ? (t.lineTo(n[r], n[r + 1]), r += 2) : "C" == o ? (t.bezierCurveTo(n[r], n[r + 1], n[r + 2], n[r + 3], n[r + 4], n[r + 5]), r += 6) : "Q" == o ? (t.quadraticCurveTo(n[r], n[r + 1], n[r + 2], n[r + 3]), r += 4) : "#" == o.charAt(0) ? (t.beginPath(), t.fillStyle = o) : "Z" == o ? t.closePath() : "X" == o && t.fill()
                    }
                }, t.U.P = {}, t.U.P.moveTo = function (e, t, r) {
                    e.cmds.push("M"), e.crds.push(t, r)
                }, t.U.P.lineTo = function (e, t, r) {
                    e.cmds.push("L"), e.crds.push(t, r)
                }, t.U.P.curveTo = function (e, t, r, n, a, o, i) {
                    e.cmds.push("C"), e.crds.push(t, r, n, a, o, i)
                }, t.U.P.qcurveTo = function (e, t, r, n, a) {
                    e.cmds.push("Q"), e.crds.push(t, r, n, a)
                }, t.U.P.closePath = function (e) {
                    e.cmds.push("Z")
                }, t.U._drawCFF = function (e, r, n, a, o) {
                    for (var i = r.stack, s = r.nStems, l = r.haveWidth, u = r.width, f = r.open, h = 0, d = r.x, c = r.y, p = 0, v = 0, g = 0, m = 0, y = 0, U = 0, b = 0, S = 0, x = 0, _ = 0, k = {
                            val: 0,
                            size: 0
                        }; h < e.length;) {
                        t.CFF.getCharString(e, h, k);
                        var w = k.val;
                        if (h += k.size, "o1" == w || "o18" == w) i.length % 2 != 0 && !l && (u = i.shift() + a.nominalWidthX), s += i.length >> 1, i.length = 0, l = !0;
                        else if ("o3" == w || "o23" == w) {
                            i.length % 2 != 0 && !l && (u = i.shift() + a.nominalWidthX), s += i.length >> 1, i.length = 0, l = !0
                        } else if ("o4" == w) i.length > 1 && !l && (u = i.shift() + a.nominalWidthX, l = !0), f && t.U.P.closePath(o), c += i.pop(), t.U.P.moveTo(o, d, c), f = !0;
                        else if ("o5" == w)
                            for (; i.length > 0;) d += i.shift(), c += i.shift(), t.U.P.lineTo(o, d, c);
                        else if ("o6" == w || "o7" == w)
                            for (var T = i.length, F = "o6" == w, C = 0; C < T; C++) {
                                var D = i.shift();
                                F ? d += D : c += D, F = !F, t.U.P.lineTo(o, d, c)
                            } else if ("o8" == w || "o24" == w) {
                                T = i.length;
                                for (var O = 0; O + 6 <= T;) p = d + i.shift(), v = c + i.shift(), g = p + i.shift(), m = v + i.shift(), d = g + i.shift(), c = m + i.shift(), t.U.P.curveTo(o, p, v, g, m, d, c), O += 6;
                                "o24" == w && (d += i.shift(), c += i.shift(), t.U.P.lineTo(o, d, c))
                            } else {
                                if ("o11" == w) break;
                                if ("o1234" == w || "o1235" == w || "o1236" == w || "o1237" == w) "o1234" == w && (v = c, g = (p = d + i.shift()) + i.shift(), _ = m = v + i.shift(), U = m, S = c, d = (b = (y = (x = g + i.shift()) + i.shift()) + i.shift()) + i.shift(), t.U.P.curveTo(o, p, v, g, m, x, _), t.U.P.curveTo(o, y, U, b, S, d, c)), "o1235" == w && (p = d + i.shift(), v = c + i.shift(), g = p + i.shift(), m = v + i.shift(), x = g + i.shift(), _ = m + i.shift(), y = x + i.shift(), U = _ + i.shift(), b = y + i.shift(), S = U + i.shift(), d = b + i.shift(), c = S + i.shift(), i.shift(), t.U.P.curveTo(o, p, v, g, m, x, _), t.U.P.curveTo(o, y, U, b, S, d, c)), "o1236" == w && (p = d + i.shift(), v = c + i.shift(), g = p + i.shift(), _ = m = v + i.shift(), U = m, b = (y = (x = g + i.shift()) + i.shift()) + i.shift(), S = U + i.shift(), d = b + i.shift(), t.U.P.curveTo(o, p, v, g, m, x, _), t.U.P.curveTo(o, y, U, b, S, d, c)), "o1237" == w && (p = d + i.shift(), v = c + i.shift(), g = p + i.shift(), m = v + i.shift(), x = g + i.shift(), _ = m + i.shift(), y = x + i.shift(), U = _ + i.shift(), b = y + i.shift(), S = U + i.shift(), Math.abs(b - d) > Math.abs(S - c) ? d = b + i.shift() : c = S + i.shift(), t.U.P.curveTo(o, p, v, g, m, x, _), t.U.P.curveTo(o, y, U, b, S, d, c));
                                else if ("o14" == w) {
                                    if (i.length > 0 && !l && (u = i.shift() + n.nominalWidthX, l = !0), 4 == i.length) {
                                        var I = i.shift(),
                                            M = i.shift(),
                                            G = i.shift(),
                                            P = i.shift(),
                                            A = t.CFF.glyphBySE(n, G),
                                            B = t.CFF.glyphBySE(n, P);
                                        t.U._drawCFF(n.CharStrings[A], r, n, a, o), r.x = I, r.y = M, t.U._drawCFF(n.CharStrings[B], r, n, a, o)
                                    }
                                    f && (t.U.P.closePath(o), f = !1)
                                } else if ("o19" == w || "o20" == w) {
                                    i.length % 2 != 0 && !l && (u = i.shift() + a.nominalWidthX), s += i.length >> 1, i.length = 0, l = !0, h += s + 7 >> 3
                                } else if ("o21" == w) i.length > 2 && !l && (u = i.shift() + a.nominalWidthX, l = !0), c += i.pop(), d += i.pop(), f && t.U.P.closePath(o), t.U.P.moveTo(o, d, c), f = !0;
                                else if ("o22" == w) i.length > 1 && !l && (u = i.shift() + a.nominalWidthX, l = !0), d += i.pop(), f && t.U.P.closePath(o), t.U.P.moveTo(o, d, c), f = !0;
                                else if ("o25" == w) {
                                    for (; i.length > 6;) d += i.shift(), c += i.shift(), t.U.P.lineTo(o, d, c);
                                    p = d + i.shift(), v = c + i.shift(), g = p + i.shift(), m = v + i.shift(), d = g + i.shift(), c = m + i.shift(), t.U.P.curveTo(o, p, v, g, m, d, c)
                                } else if ("o26" == w)
                                    for (i.length % 2 && (d += i.shift()); i.length > 0;) p = d, v = c + i.shift(), d = g = p + i.shift(), c = (m = v + i.shift()) + i.shift(), t.U.P.curveTo(o, p, v, g, m, d, c);
                                else if ("o27" == w)
                                    for (i.length % 2 && (c += i.shift()); i.length > 0;) v = c, g = (p = d + i.shift()) + i.shift(), m = v + i.shift(), d = g + i.shift(), c = m, t.U.P.curveTo(o, p, v, g, m, d, c);
                                else if ("o10" == w || "o29" == w) {
                                    var E = "o10" == w ? a : n;
                                    if (0 == i.length) console.log("error: empty stack");
                                    else {
                                        var L = i.pop(),
                                            R = E.Subrs[L + E.Bias];
                                        r.x = d, r.y = c, r.nStems = s, r.haveWidth = l, r.width = u, r.open = f, t.U._drawCFF(R, r, n, a, o), d = r.x, c = r.y, s = r.nStems, l = r.haveWidth, u = r.width, f = r.open
                                    }
                                } else if ("o30" == w || "o31" == w) {
                                    var W = i.length,
                                        V = (O = 0, "o31" == w);
                                    for (O += W - (T = -3 & W); O < T;) V ? (v = c, g = (p = d + i.shift()) + i.shift(), c = (m = v + i.shift()) + i.shift(), T - O == 5 ? (d = g + i.shift(), O++) : d = g, V = !1) : (p = d, v = c + i.shift(), g = p + i.shift(), m = v + i.shift(), d = g + i.shift(), T - O == 5 ? (c = m + i.shift(), O++) : c = m, V = !0), t.U.P.curveTo(o, p, v, g, m, d, c), O += 4
                                } else {
                                    if ("o" == (w + "").charAt(0)) throw console.log("Unknown operation: " + w, e), w;
                                    i.push(w)
                                }
                            }
                    }
                    r.x = d, r.y = c, r.nStems = s, r.haveWidth = l, r.width = u, r.open = f
                }, t
            }, function () {
                const e = function () {
                    const e = {};

                    function t() {
                        this.table = new Uint16Array(16), this.trans = new Uint16Array(288)
                    }

                    function r(e, r) {
                        this.source = e, this.sourceIndex = 0, this.tag = 0, this.bitcount = 0, this.dest = r, this.destLen = 0, this.ltree = new t, this.dtree = new t
                    }
                    var n = new t,
                        a = new t,
                        o = new Uint8Array(30),
                        i = new Uint16Array(30),
                        s = new Uint8Array(30),
                        l = new Uint16Array(30),
                        u = new Uint8Array([16, 17, 18, 0, 8, 7, 9, 6, 10, 5, 11, 4, 12, 3, 13, 2, 14, 1, 15]),
                        f = new t,
                        h = new Uint8Array(320);

                    function d(e, t, r, n) {
                        var a, o;
                        for (a = 0; a < r; ++a) e[a] = 0;
                        for (a = 0; a < 30 - r; ++a) e[a + r] = a / r | 0;
                        for (o = n, a = 0; a < 30; ++a) t[a] = o, o += 1 << e[a]
                    }
                    var c = new Uint16Array(16);

                    function p(e, t, r, n) {
                        var a, o;
                        for (a = 0; a < 16; ++a) e.table[a] = 0;
                        for (a = 0; a < n; ++a) e.table[t[r + a]]++;
                        for (e.table[0] = 0, o = 0, a = 0; a < 16; ++a) c[a] = o, o += e.table[a];
                        for (a = 0; a < n; ++a) t[r + a] && (e.trans[c[t[r + a]]++] = a)
                    }

                    function v(e) {
                        e.bitcount-- || (e.tag = e.source[e.sourceIndex++], e.bitcount = 7);
                        var t = 1 & e.tag;
                        return e.tag >>>= 1, t
                    }

                    function g(e, t, r) {
                        if (!t) return r;
                        for (; e.bitcount < 24;) e.tag |= e.source[e.sourceIndex++] << e.bitcount, e.bitcount += 8;
                        var n = e.tag & 65535 >>> 16 - t;
                        return e.tag >>>= t, e.bitcount -= t, n + r
                    }

                    function m(e, t) {
                        for (; e.bitcount < 24;) e.tag |= e.source[e.sourceIndex++] << e.bitcount, e.bitcount += 8;
                        var r = 0,
                            n = 0,
                            a = 0,
                            o = e.tag;
                        do {
                            n = 2 * n + (1 & o), o >>>= 1, ++a, r += t.table[a], n -= t.table[a]
                        } while (n >= 0);
                        return e.tag = o, e.bitcount -= a, t.trans[r + n]
                    }

                    function y(e, t, r) {
                        var n, a, o, i, s, l;
                        for (n = g(e, 5, 257), a = g(e, 5, 1), o = g(e, 4, 4), i = 0; i < 19; ++i) h[i] = 0;
                        for (i = 0; i < o; ++i) {
                            var d = g(e, 3, 0);
                            h[u[i]] = d
                        }
                        for (p(f, h, 0, 19), s = 0; s < n + a;) {
                            var c = m(e, f);
                            switch (c) {
                                case 16:
                                    var v = h[s - 1];
                                    for (l = g(e, 2, 3); l; --l) h[s++] = v;
                                    break;
                                case 17:
                                    for (l = g(e, 3, 3); l; --l) h[s++] = 0;
                                    break;
                                case 18:
                                    for (l = g(e, 7, 11); l; --l) h[s++] = 0;
                                    break;
                                default:
                                    h[s++] = c
                            }
                        }
                        p(t, h, 0, n), p(r, h, n, a)
                    }

                    function U(e, t, r) {
                        for (;;) {
                            var n, a, u, f, h = m(e, t);
                            if (256 === h) return 0;
                            if (h < 256) e.dest[e.destLen++] = h;
                            else
                                for (n = g(e, o[h -= 257], i[h]), a = m(e, r), f = u = e.destLen - g(e, s[a], l[a]); f < u + n; ++f) e.dest[e.destLen++] = e.dest[f]
                        }
                    }

                    function b(e) {
                        for (var t, r; e.bitcount > 8;) e.sourceIndex--, e.bitcount -= 8;
                        if ((t = 256 * (t = e.source[e.sourceIndex + 1]) + e.source[e.sourceIndex]) !== (65535 & ~(256 * e.source[e.sourceIndex + 3] + e.source[e.sourceIndex + 2]))) return -3;
                        for (e.sourceIndex += 4, r = t; r; --r) e.dest[e.destLen++] = e.source[e.sourceIndex++];
                        return e.bitcount = 0, 0
                    }
                    return function (e, t) {
                        var r;
                        for (r = 0; r < 7; ++r) e.table[r] = 0;
                        for (e.table[7] = 24, e.table[8] = 152, e.table[9] = 112, r = 0; r < 24; ++r) e.trans[r] = 256 + r;
                        for (r = 0; r < 144; ++r) e.trans[24 + r] = r;
                        for (r = 0; r < 8; ++r) e.trans[168 + r] = 280 + r;
                        for (r = 0; r < 112; ++r) e.trans[176 + r] = 144 + r;
                        for (r = 0; r < 5; ++r) t.table[r] = 0;
                        for (t.table[5] = 32, r = 0; r < 32; ++r) t.trans[r] = r
                    }(n, a), d(o, i, 4, 3), d(s, l, 2, 1), o[28] = 0, i[28] = 258, e.exports = function (e, t) {
                        var o, i, s = new r(e, t);
                        do {
                            switch (o = v(s), g(s, 2, 0)) {
                                case 0:
                                    i = b(s);
                                    break;
                                case 1:
                                    i = U(s, n, a);
                                    break;
                                case 2:
                                    y(s, s.ltree, s.dtree), i = U(s, s.ltree, s.dtree);
                                    break;
                                default:
                                    i = -3
                            }
                            if (0 !== i) throw new Error("Data error")
                        } while (!o);
                        return s.destLen < s.dest.length ? "function" == typeof s.dest.slice ? s.dest.slice(0, s.destLen) : s.dest.subarray(0, s.destLen) : s.dest
                    }, e.exports
                }();
                return function (t) {
                    return function (e, t) {
                        var r = new DataView(e),
                            n = 0;

                        function a() {
                            var e = r.getUint16(n);
                            return n += 2, e
                        }

                        function o() {
                            var e = r.getUint32(n);
                            return n += 4, e
                        }

                        function i(e) {
                            y.setUint16(U, e), U += 2
                        }

                        function s(e) {
                            y.setUint32(U, e), U += 4
                        }
                        for (var l = {
                                signature: o(),
                                flavor: o(),
                                length: o(),
                                numTables: a(),
                                reserved: a(),
                                totalSfntSize: o(),
                                majorVersion: a(),
                                minorVersion: a(),
                                metaOffset: o(),
                                metaLength: o(),
                                metaOrigLength: o(),
                                privOffset: o(),
                                privLength: o()
                            }, u = 0; Math.pow(2, u) <= l.numTables;) u++;
                        u--;
                        for (var f = 16 * Math.pow(2, u), h = 16 * l.numTables - f, d = 12, c = [], p = 0; p < l.numTables; p++) c.push({
                            tag: o(),
                            offset: o(),
                            compLength: o(),
                            origLength: o(),
                            origChecksum: o()
                        }), d += 16;
                        var v, g = new Uint8Array(12 + 16 * c.length + c.reduce((function (e, t) {
                                return e + t.origLength + 4
                            }), 0)),
                            m = g.buffer,
                            y = new DataView(m),
                            U = 0;
                        return s(l.flavor), i(l.numTables), i(f), i(u), i(h), c.forEach((function (e) {
                            s(e.tag), s(e.origChecksum), s(d), s(e.origLength), e.outOffset = d, (d += e.origLength) % 4 != 0 && (d += 4 - d % 4)
                        })), c.forEach((function (r) {
                            var n = e.slice(r.offset, r.offset + r.compLength);
                            if (r.compLength != r.origLength) {
                                var a = new Uint8Array(r.origLength);
                                t(new Uint8Array(n, 2), a)
                            } else a = new Uint8Array(n);
                            g.set(a, r.outOffset);
                            var o = 0;
                            (d = r.outOffset + r.origLength) % 4 != 0 && (o = 4 - d % 4), g.set(new Uint8Array(o).buffer, r.outOffset + r.origLength), v = d + o
                        })), m.slice(0, v)
                    }(t, e)
                }
            }, function (e, t) {
                const r = {
                    M: 2,
                    L: 2,
                    Q: 4,
                    C: 6,
                    Z: 0
                };
                return function (n) {
                    const a = new Uint8Array(n, 0, 4),
                        o = e._bin.readASCII(a, 0, 4);
                    if ("wOFF" === o) n = t(n);
                    else if ("wOF2" === o) throw new Error("woff2 fonts not supported");
                    return function (t) {
                        const n = Object.create(null),
                            a = {
                                unitsPerEm: t.head.unitsPerEm,
                                ascender: t.hhea.ascender,
                                descender: t.hhea.descender,
                                forEachGlyph(o, i, s, l) {
                                    let u = 0;
                                    const f = 1 / a.unitsPerEm * i,
                                        h = e.U.stringToGlyphs(t, o);
                                    let d = 0;
                                    return h.forEach(a => {
                                        if (-1 !== a) {
                                            let o = n[a];
                                            if (!o) {
                                                const {
                                                    cmds: i,
                                                    crds: s
                                                } = e.U.glyphToPath(t, a);
                                                let l, u, f, h;
                                                if (s.length) {
                                                    l = u = 1 / 0, f = h = -1 / 0;
                                                    for (let e = 0, t = s.length; e < t; e += 2) {
                                                        let t = s[e],
                                                            r = s[e + 1];
                                                        t < l && (l = t), r < u && (u = r), t > f && (f = t), r > h && (h = r)
                                                    }
                                                } else l = f = u = h = 0;
                                                o = n[a] = {
                                                    index: a,
                                                    advanceWidth: t.hmtx.aWidth[a],
                                                    xMin: l,
                                                    yMin: u,
                                                    xMax: f,
                                                    yMax: h,
                                                    pathCommandCount: i.length,
                                                    forEachPathCommand(e) {
                                                        let t = 0;
                                                        const n = [];
                                                        for (let a = 0, o = i.length; a < o; a++) {
                                                            const o = r[i[a]];
                                                            n.length = 1 + o, n[0] = i[a];
                                                            for (let e = 1; e <= o; e++) n[e] = s[t++];
                                                            e.apply(null, n)
                                                        }
                                                    }
                                                }
                                            }
                                            l.call(null, o, u, d), o.advanceWidth && (u += o.advanceWidth * f), s && (u += s * i)
                                        }
                                        d += o.codePointAt(d) > 65535 ? 2 : 1
                                    }), u
                                }
                            };
                        return a
                    }(e.parse(n)[0])
                }
            }],
            init: (e, t, r) => r(e(), t())
        }),
        G = {
            defaultFontURL: "https://fonts.gstatic.com/s/roboto/v18/KFOmCnqEu92Fr1Mu4mxM.woff",
            sdfGlyphSize: 64,
            sdfMargin: 1 / 16,
            sdfExponent: 9,
            textureWidth: 2048
        },
        P = new e.Color,
        A = Object.create(null);

    function B(t, r) {
        if ((t = function (e, t) {
                for (let r in t) t.hasOwnProperty(r) && (e[r] = t[r]);
                return e
            }({}, t)).font = function (e) {
                E || (E = "undefined" == typeof document ? {} : document.createElement("a"));
                return E.href = e, E.href
            }(t.font || G.defaultFontURL), t.text = "" + t.text, t.sdfGlyphSize = t.sdfGlyphSize || G.sdfGlyphSize, null != t.colorRanges) {
            let e = {};
            for (let r in t.colorRanges)
                if (t.colorRanges.hasOwnProperty(r)) {
                    let n = t.colorRanges[r];
                    "number" != typeof n && (n = P.set(n).getHex()), e[r] = n
                } t.colorRanges = e
        }
        Object.freeze(t);
        const {
            textureWidth: n,
            sdfExponent: a
        } = G, {
            sdfGlyphSize: o
        } = t;
        let i = `${t.font}@${o}`,
            s = A[i];
        s || (s = A[i] = {
            sdfTexture: new e.DataTexture(new Uint8Array(o * n), n, o, e.LuminanceFormat, void 0, void 0, void 0, void 0, e.LinearFilter, e.LinearFilter)
        }, s.sdfTexture.font = t.font), L(t).then(e => {
            e.newGlyphSDFs && (e.newGlyphSDFs.forEach(({
                textureData: e,
                atlasIndex: t
            }) => {
                const r = s.sdfTexture.image;
                for (; r.data.length < (t + 1) * o * o;) {
                    const e = new Uint8Array(2 * r.data.length);
                    e.set(r.data), r.data = e, r.height *= 2
                }
                const n = r.width / o,
                    a = r.width * o * Math.floor(t / n) + t % n * o;
                for (let t = 0; t < o; t++) {
                    const n = t * o,
                        i = a + t * r.width;
                    for (let t = 0; t < o; t++) r.data[i + t] = e[n + t]
                }
            }), s.sdfTexture.needsUpdate = !0), r(Object.freeze({
                parameters: t,
                sdfTexture: s.sdfTexture,
                sdfGlyphSize: o,
                sdfExponent: a,
                glyphBounds: e.glyphBounds,
                glyphAtlasIndices: e.glyphAtlasIndices,
                glyphColors: e.glyphColors,
                caretPositions: e.caretPositions,
                caretHeight: e.caretHeight,
                chunkedBounds: e.chunkedBounds,
                ascender: e.ascender,
                descender: e.descender,
                lineHeight: e.lineHeight,
                topBaseline: e.topBaseline,
                blockBounds: e.blockBounds,
                visibleBounds: e.visibleBounds,
                timings: e.timings,
                get totalBounds() {
                    return console.log("totalBounds deprecated, use blockBounds instead"), e.blockBounds
                },
                get totalBlockSize() {
                    console.log("totalBlockSize deprecated, use blockBounds instead");
                    const [t, r, n, a] = e.blockBounds;
                    return [n - t, a - r]
                }
            }))
        })
    }
    let E;
    const L = g({
            name: "TextBuilder",
            dependencies: [g({
                name: "FontProcessor",
                dependencies: [G, M, function () {
                    let e = !1;
                    const t = [];

                    function r() {
                        e && (t.sort((function (e, t) {
                            return e.maxX - t.maxX
                        })), e = !1)
                    }

                    function n(e, t, r, n, a, o) {
                        const i = a - r,
                            s = o - n,
                            l = i * i + s * s,
                            u = l ? Math.max(0, Math.min(1, ((e - r) * i + (t - n) * s) / l)) : 0,
                            f = e - (r + u * i),
                            h = t - (n + u * s);
                        return f * f + h * h
                    }
                    return {
                        addLineSegment: function (r, n, a, o) {
                            const i = {
                                x0: r,
                                y0: n,
                                x1: a,
                                y1: o,
                                minX: Math.min(r, a),
                                minY: Math.min(n, o),
                                maxX: Math.max(r, a),
                                maxY: Math.max(n, o)
                            };
                            t.push(i), e = !0
                        },
                        findNearestSignedDistance: function (e, a) {
                            r();
                            let o = 1 / 0,
                                i = 1 / 0;
                            for (let r = t.length; r--;) {
                                const s = t[r];
                                if (s.maxX + i <= e) break;
                                if (e + i > s.minX && a - i < s.maxY && a + i > s.minY) {
                                    const t = n(e, a, s.x0, s.y0, s.x1, s.y1);
                                    t < o && (o = t, i = Math.sqrt(o))
                                }
                            }
                            return function (e, n) {
                                r();
                                let a = !1;
                                for (let r = t.length; r--;) {
                                    const o = t[r];
                                    if (o.maxX <= e) break;
                                    if (o.minY < n && o.maxY > n) {
                                        o.y0 > n != o.y1 > n && e < (o.x1 - o.x0) * (n - o.y0) / (o.y1 - o.y0) + o.x0 && (a = !a)
                                    }
                                }
                                return a
                            }(e, a) && (i = -i), i
                        }
                    }
                }, function (e, t) {
                    const {
                        sdfExponent: r,
                        sdfMargin: n
                    } = t;

                    function a(e, t, r, n, a, o, i) {
                        const s = 1 - i;
                        return {
                            x: s * s * e + 2 * s * i * r + i * i * a,
                            y: s * s * t + 2 * s * i * n + i * i * o
                        }
                    }

                    function o(e, t, r, n, a, o, i, s, l) {
                        const u = 1 - l;
                        return {
                            x: u * u * u * e + 3 * u * u * l * r + 3 * u * l * l * a + l * l * l * i,
                            y: u * u * u * t + 3 * u * u * l * n + 3 * u * l * l * o + l * l * l * s
                        }
                    }
                    return function (t, i) {
                        const s = new Uint8Array(i * i),
                            l = t.xMax - t.xMin,
                            u = t.yMax - t.yMin,
                            f = Math.max(l, u),
                            h = Math.max(l, u) / i * (n * i + .5),
                            d = t.xMin - h,
                            c = t.yMin - h,
                            p = t.xMax + h,
                            v = t.yMax + h,
                            g = p - d,
                            m = v - c,
                            y = Math.max(g, m);
                        if (t.pathCommandCount) {
                            const n = e(t);
                            let l, u, h, p;
                            t.forEachPathCommand((e, t, r, i, s, f, d) => {
                                switch (e) {
                                    case "M":
                                        h = l = t, p = u = r;
                                        break;
                                    case "L":
                                        t === h && r === p || n.addLineSegment(h, p, h = t, p = r);
                                        break;
                                    case "Q": {
                                        let e = {
                                            x: h,
                                            y: p
                                        };
                                        for (let o = 1; o < 16; o++) {
                                            let l = a(h, p, t, r, i, s, o / 15);
                                            n.addLineSegment(e.x, e.y, l.x, l.y), e = l
                                        }
                                        h = i, p = s;
                                        break
                                    }
                                    case "C": {
                                        let e = {
                                            x: h,
                                            y: p
                                        };
                                        for (let a = 1; a < 16; a++) {
                                            let l = o(h, p, t, r, i, s, f, d, a / 15);
                                            n.addLineSegment(e.x, e.y, l.x, l.y), e = l
                                        }
                                        h = f, p = d;
                                        break
                                    }
                                    case "Z":
                                        h === l && p === u || n.addLineSegment(h, p, l, u)
                                }
                            });
                            for (let e = 0; e < i; e++)
                                for (let t = 0; t < i; t++) {
                                    const a = n.findNearestSignedDistance(d + g * (e + .5) / i, c + m * (t + .5) / i, f);
                                    let o = Math.pow(1 - Math.abs(a) / y, r) / 2;
                                    a < 0 && (o = 1 - o), o = Math.max(0, Math.min(255, Math.round(255 * o))), s[t * i + e] = o
                                }
                        }
                        return {
                            textureData: s,
                            renderingBounds: [d, c, p, v]
                        }
                    }
                }, function (e, t, r) {
                    const {
                        defaultFontURL: n
                    } = r, a = Object.create(null), o = Object.create(null), i = 1 / 0;

                    function s(t, r) {
                        t || (t = n);
                        let a = o[t];
                        a ? a.pending ? a.pending.push(r) : r(a) : (o[t] = {
                            pending: [r]
                        }, function (t, r) {
                            ! function a() {
                                const o = e => {
                                    console.error(`Failure loading font ${t}${t===n?"":"; trying fallback"}`, e), t !== n && (t = n, a())
                                };
                                try {
                                    const n = new XMLHttpRequest;
                                    n.open("get", t, !0), n.responseType = "arraybuffer", n.onload = function () {
                                        if (n.status >= 400) o(new Error(n.statusText));
                                        else if (n.status > 0) try {
                                            const t = e(n.response);
                                            r(t)
                                        } catch (e) {
                                            o(e)
                                        }
                                    }, n.onerror = o, n.send()
                                } catch (e) {
                                    o(e)
                                }
                            }()
                        }(t, e => {
                            let r = o[t].pending;
                            o[t] = e, r.forEach(t => t(e))
                        }))
                    }

                    function l({
                        text: e = "",
                        font: r = n,
                        sdfGlyphSize: o = 64,
                        fontSize: l = 1,
                        letterSpacing: d = 0,
                        lineHeight: c = "normal",
                        maxWidth: p = i,
                        textAlign: v = "left",
                        textIndent: g = 0,
                        whiteSpace: m = "normal",
                        overflowWrap: y = "normal",
                        anchorX: U = 0,
                        anchorY: b = 0,
                        includeCaretPositions: S = !1,
                        chunkedBoundsSize: x = 8192,
                        colorRanges: _ = null
                    }, k, w = !1) {
                        const T = f(),
                            F = {
                                total: 0,
                                fontLoad: 0,
                                layout: 0,
                                sdf: {},
                                sdfTotal: 0
                            };
                        e.indexOf("\r") > -1 && (console.warn("FontProcessor.process: got text with \\r chars; normalizing to \\n"), e = e.replace(/\r\n/g, "\n").replace(/\r/g, "\n")), l = +l, d = +d, p = +p, c = c || "normal", g = +g,
                            function (e, t, r) {
                                e || (e = n);
                                let o = `${e}@${t}`,
                                    i = a[o];
                                i ? r(i) : s(e, e => {
                                    i = a[o] || (a[o] = {
                                        fontObj: e,
                                        glyphs: {},
                                        glyphCount: 0
                                    }), r(i)
                                })
                            }(r, o, r => {
                                const n = r.fontObj,
                                    a = isFinite(p);
                                let s = null,
                                    C = null,
                                    D = null,
                                    O = null,
                                    I = null,
                                    M = null,
                                    G = null,
                                    P = 0,
                                    A = 0,
                                    B = "nowrap" !== m;
                                const {
                                    ascender: E,
                                    descender: L,
                                    unitsPerEm: R
                                } = n;
                                F.fontLoad = f() - T;
                                const W = f(),
                                    V = l / R;
                                "normal" === c && (c = (E - L) / R);
                                const z = ((c *= l) - (E - L) * V) / 2,
                                    j = -(E * V + z),
                                    N = Math.min(c, (E - L) * V),
                                    $ = (E + L) / 2 * V - N / 2;
                                let X = g,
                                    H = new h;
                                const Y = [H];
                                n.forEachGlyph(e, l, d, (t, r, n) => {
                                    const o = e.charAt(n),
                                        i = t.advanceWidth * V,
                                        s = H.count;
                                    let u;
                                    if ("isEmpty" in t || (t.isWhitespace = !!o && /\s/.test(o), t.isEmpty = t.xMin === t.xMax || t.yMin === t.yMax), t.isWhitespace || t.isEmpty || A++, B && a && !t.isWhitespace && r + i + X > p && s) {
                                        if (H.glyphAt(s - 1).glyphObj.isWhitespace) u = new h, X = -r;
                                        else
                                            for (let e = s; e--;) {
                                                if (0 === e && "break-word" === y) {
                                                    u = new h, X = -r;
                                                    break
                                                }
                                                if (H.glyphAt(e).glyphObj.isWhitespace) {
                                                    u = H.splitAt(e + 1);
                                                    const t = u.glyphAt(0).x;
                                                    X -= t;
                                                    for (let e = u.count; e--;) u.glyphAt(e).x -= t;
                                                    break
                                                }
                                            }
                                        u && (H.isSoftWrapped = !0, H = u, Y.push(H), P = p)
                                    }
                                    let f = H.glyphAt(H.count);
                                    f.glyphObj = t, f.x = r + X, f.width = i, f.charIndex = n, "\n" === o && (H = new h, Y.push(H), X = -(r + i + d * l) + g)
                                }), Y.forEach(e => {
                                    for (let t = e.count; t--;) {
                                        let {
                                            glyphObj: r,
                                            x: n,
                                            width: a
                                        } = e.glyphAt(t);
                                        if (!r.isWhitespace) return e.width = n + a, void(e.width > P && (P = e.width))
                                    }
                                });
                                let q = 0,
                                    K = 0;
                                if (U && ("number" == typeof U ? q = -U : "string" == typeof U && (q = -P * ("left" === U ? 0 : "center" === U ? .5 : "right" === U ? 1 : u(U)))), b)
                                    if ("number" == typeof b) K = -b;
                                    else if ("string" == typeof b) {
                                    let e = Y.length * c;
                                    K = "top" === b ? 0 : "top-baseline" === b ? -j : "middle" === b ? e / 2 : "bottom" === b ? e : "bottom-baseline" === b ? e - z + L * V : u(b) * e
                                }
                                if (!w) {
                                    C = new Float32Array(4 * A), D = new Float32Array(A), M = [i, i, -1 / 0, -1 / 0], G = [];
                                    let n = j;
                                    S && (I = new Float32Array(3 * e.length)), _ && (O = new Uint8Array(3 * A));
                                    let a, l, u = 0,
                                        h = -1,
                                        d = -1;
                                    Y.forEach(p => {
                                        const {
                                            count: g,
                                            width: m
                                        } = p;
                                        if (g > 0) {
                                            let c = 0,
                                                y = 0;
                                            if ("center" === v) c = (P - m) / 2;
                                            else if ("right" === v) c = P - m;
                                            else if ("justify" === v && p.isSoftWrapped) {
                                                let e = 0;
                                                for (let t = g; t--;)
                                                    if (!p.glyphAt(t).glyphObj.isWhitespace) {
                                                        for (; t--;) p.glyphAt(t).glyphObj, p.glyphAt(t).glyphObj.isWhitespace && e++;
                                                        break
                                                    } y = (P - m) / e
                                            }
                                            for (let v = 0; v < g; v++) {
                                                const g = p.glyphAt(v),
                                                    m = g.glyphObj;
                                                if (c && (g.x += c), 0 !== y && m.isWhitespace && (c += y, g.width += y), S) {
                                                    const {
                                                        charIndex: e
                                                    } = g;
                                                    for (I[3 * e] = g.x + q, I[3 * e + 1] = g.x + g.width + q, I[3 * e + 2] = n + $ + K; e - h > 1;) I[3 * (h + 1)] = I[3 * h + 1], I[3 * (h + 1) + 1] = I[3 * h + 1], I[3 * (h + 1) + 2] = I[3 * h + 2], h++;
                                                    h = e
                                                }
                                                if (_) {
                                                    const {
                                                        charIndex: e
                                                    } = g;
                                                    for (; e > d;) d++, _.hasOwnProperty(d) && (l = _[d])
                                                }
                                                if (!m.isWhitespace && !m.isEmpty) {
                                                    const h = u++;
                                                    let d = r.glyphs[m.index];
                                                    if (!d) {
                                                        const n = f(),
                                                            a = t(m, o);
                                                        F.sdf[e.charAt(g.charIndex)] = f() - n, a.atlasIndex = r.glyphCount++, s || (s = []), s.push(a), d = r.glyphs[m.index] = {
                                                            atlasIndex: a.atlasIndex,
                                                            glyphObj: m,
                                                            renderingBounds: a.renderingBounds
                                                        }
                                                    }
                                                    const c = d.renderingBounds,
                                                        p = 4 * h,
                                                        v = g.x + q,
                                                        y = n + K;
                                                    C[p] = v + c[0] * V, C[p + 1] = y + c[1] * V, C[p + 2] = v + c[2] * V, C[p + 3] = y + c[3] * V;
                                                    const U = v + m.xMin * V,
                                                        b = y + m.yMin * V,
                                                        S = v + m.xMax * V,
                                                        k = y + m.yMax * V;
                                                    U < M[0] && (M[0] = U), b < M[1] && (M[1] = b), S > M[2] && (M[2] = S), k > M[3] && (M[3] = k), h % x == 0 && (a = {
                                                        start: h,
                                                        end: h,
                                                        rect: [i, i, -1 / 0, -1 / 0]
                                                    }, G.push(a)), a.end++;
                                                    const w = a.rect;
                                                    if (U < w[0] && (w[0] = U), b < w[1] && (w[1] = b), S > w[2] && (w[2] = S), k > w[3] && (w[3] = k), D[h] = d.atlasIndex, _) {
                                                        const e = 3 * h;
                                                        O[e] = l >> 16 & 255, O[e + 1] = l >> 8 & 255, O[e + 2] = 255 & l
                                                    }
                                                }
                                            }
                                        }
                                        n -= c
                                    })
                                }
                                for (let e in F.sdf) F.sdfTotal += F.sdf[e];
                                F.layout = f() - W - F.sdfTotal, F.total = f() - T, k({
                                    glyphBounds: C,
                                    glyphAtlasIndices: D,
                                    caretPositions: I,
                                    caretHeight: N,
                                    glyphColors: O,
                                    chunkedBounds: G,
                                    ascender: E * V,
                                    descender: L * V,
                                    lineHeight: c,
                                    topBaseline: j,
                                    blockBounds: [q, K - Y.length * c, q + P, K],
                                    visibleBounds: M,
                                    newGlyphSDFs: s,
                                    timings: F
                                })
                            })
                    }

                    function u(e) {
                        let t = e.match(/^([\d.]+)%$/),
                            r = t ? parseFloat(t[1]) : NaN;
                        return isNaN(r) ? 0 : r / 100
                    }

                    function f() {
                        return (self.performance || Date).now()
                    }

                    function h() {
                        this.data = []
                    }
                    return h.prototype = {
                        width: 0,
                        isSoftWrapped: !1,
                        get count() {
                            return Math.ceil(this.data.length / 4)
                        },
                        glyphAt(e) {
                            let t = h.flyweight;
                            return t.data = this.data, t.index = e, t
                        },
                        splitAt(e) {
                            let t = new h;
                            return t.data = this.data.splice(4 * e), t
                        }
                    }, h.flyweight = ["glyphObj", "x", "width", "charIndex"].reduce((e, t, r, n) => (Object.defineProperty(e, t, {
                        get() {
                            return this.data[4 * this.index + r]
                        },
                        set(e) {
                            this.data[4 * this.index + r] = e
                        }
                    }), e), {
                        data: null,
                        index: 0
                    }), {
                        process: l,
                        measure: function (e, t) {
                            l(e, e => {
                                const [r, n, a, o] = e.blockBounds;
                                t({
                                    width: a - r,
                                    height: o - n
                                })
                            }, {
                                metricsOnly: !0
                            })
                        },
                        loadFont: s
                    }
                }],
                init(e, t, r, n, a) {
                    const {
                        sdfExponent: o,
                        sdfMargin: i,
                        defaultFontURL: s
                    } = e;
                    return a(t, n(r, {
                        sdfExponent: o,
                        sdfMargin: i
                    }), {
                        defaultFontURL: s
                    })
                }
            }), U],
            init: (e, t) => function (r) {
                const n = new t;
                return e.process(r, n.resolve), n
            },
            getTransferables(e) {
                const t = [e.glyphBounds.buffer, e.glyphAtlasIndices.buffer];
                return e.caretPositions && t.push(e.caretPositions.buffer), e.newGlyphSDFs && e.newGlyphSDFs.forEach(e => {
                    t.push(e.textureData.buffer)
                }), t
            }
        }),
        R = (() => {
            const t = {};
            const r = new e.Vector3,
                n = "aTroikaGlyphIndex";
            class a extends e.InstancedBufferGeometry {
                constructor() {
                    super(), this.detail = 1, this.groups = [{
                        start: 0,
                        count: 1 / 0,
                        materialIndex: 0
                    }, {
                        start: 0,
                        count: 1 / 0,
                        materialIndex: 1
                    }], this.boundingSphere = new e.Sphere, this.boundingBox = new e.Box3
                }
                computeBoundingSphere() {}
                computeBoundingBox() {}
                set detail(r) {
                    if (r !== this._detail) {
                        this._detail = r, ("number" != typeof r || r < 1) && (r = 1);
                        let n = function (r) {
                            let n = t[r];
                            return n || (n = t[r] = new e.PlaneBufferGeometry(1, 1, r, r).translate(.5, .5, 0)), n
                        }(r);
                        ["position", "normal", "uv"].forEach(e => {
                            this.attributes[e] = n.attributes[e].clone()
                        }), this.setIndex(n.getIndex().clone())
                    }
                }
                get detail() {
                    return this._detail
                }
                updateGlyphs(e, t, a, s, l) {
                    o(this, "aTroikaGlyphBounds", e, 4), o(this, n, t, 1), o(this, "aTroikaGlyphColor", l, 3), this._chunkedBounds = s, i(this, t.length);
                    const u = this.boundingSphere;
                    u.center.set((a[0] + a[2]) / 2, (a[1] + a[3]) / 2, 0), u.radius = u.center.distanceTo(r.set(a[0], a[1], 0));
                    const f = this.boundingBox;
                    f.min.set(a[0], a[1], 0), f.max.set(a[2], a[3], 0)
                }
                applyClipRect(e) {
                    let t = this.getAttribute(n).count,
                        r = this._chunkedBounds;
                    if (r)
                        for (let n = r.length; n--;) {
                            t = r[n].end;
                            let a = r[n].rect;
                            if (a[1] < e.w && a[3] > e.y && a[0] < e.z && a[2] > e.x) break
                        }
                    i(this, t)
                }
            }

            function o(t, r, n, a) {
                const o = t.getAttribute(r);
                n ? o && o.array.length === n.length ? (o.array.set(n), o.needsUpdate = !0) : (t.setAttribute(r, new e.InstancedBufferAttribute(n, a)), delete t._maxInstanceCount, t.dispose()) : o && t.deleteAttribute(r)
            }

            function i(e, t) {
                e[e.hasOwnProperty("instanceCount") ? "instanceCount" : "maxInstancedCount"] = t
            }
            return a.prototype.setAttribute || (a.prototype.setAttribute = function (e, t) {
                return this.attributes[e] = t, this
            }), a
        })();
    const W = (() => {
        const t = new e.MeshBasicMaterial({
                color: 16777215,
                side: e.DoubleSide,
                transparent: !0
            }),
            r = new e.Matrix4,
            n = new e.Vector3,
            a = new e.Vector3,
            o = [],
            i = new e.Vector3,
            s = "+x+y";

        function l(e) {
            return Array.isArray(e) ? e[0] : e
        }
        const u = new e.Mesh(new e.PlaneBufferGeometry(1, 1).translate(.5, .5, 0), t),
            f = {
                type: "syncstart"
            },
            h = {
                type: "synccomplete"
            },
            d = ["font", "fontSize", "letterSpacing", "lineHeight", "maxWidth", "overflowWrap", "text", "textAlign", "textIndent", "whiteSpace", "anchorX", "anchorY", "colorRanges", "sdfGlyphSize"],
            c = d.concat("material", "color", "depthOffset", "clipRect", "orientation", "glyphGeometryDetail");
        class p extends e.Mesh {
            constructor() {
                super(new R, null), this.text = "", this.anchorX = 0, this.anchorY = 0, this.font = null, this.fontSize = .1, this.letterSpacing = 0, this.lineHeight = "normal", this.maxWidth = 1 / 0, this.overflowWrap = "normal", this.textAlign = "left", this.textIndent = 0, this.whiteSpace = "normal", this.material = null, this.color = null, this.colorRanges = null, this.outlineWidth = 0, this.outlineColor = 0, this.depthOffset = 0, this.clipRect = null, this.orientation = s, this.glyphGeometryDetail = 1, this.sdfGlyphSize = null, this.debugSDF = !1
            }
            sync(e) {
                this._needsSync && (this._needsSync = !1, this._isSyncing ? (this._queuedSyncs || (this._queuedSyncs = [])).push(e) : (this._isSyncing = !0, this.dispatchEvent(f), B({
                    text: this.text,
                    font: this.font,
                    fontSize: this.fontSize || .1,
                    letterSpacing: this.letterSpacing || 0,
                    lineHeight: this.lineHeight || "normal",
                    maxWidth: this.maxWidth,
                    textAlign: this.textAlign,
                    textIndent: this.textIndent,
                    whiteSpace: this.whiteSpace,
                    overflowWrap: this.overflowWrap,
                    anchorX: this.anchorX,
                    anchorY: this.anchorY,
                    colorRanges: this.colorRanges,
                    includeCaretPositions: !0,
                    sdfGlyphSize: this.sdfGlyphSize
                }, t => {
                    this._isSyncing = !1, this._textRenderInfo = t, this.geometry.updateGlyphs(t.glyphBounds, t.glyphAtlasIndices, t.blockBounds, t.chunkedBounds, t.glyphColors);
                    const r = this._queuedSyncs;
                    r && (this._queuedSyncs = null, this._needsSync = !0, this.sync(() => {
                        r.forEach(e => e && e())
                    })), this.dispatchEvent(h), e && e()
                })))
            }
            onBeforeRender(e, t, r, n, a, o) {
                this.sync(), a.isTroikaTextMaterial && this._prepareForRender(a)
            }
            dispose() {
                this.geometry.dispose()
            }
            get textRenderInfo() {
                return this._textRenderInfo || null
            }
            get material() {
                let r = this._derivedMaterial;
                const n = this._baseMaterial || this._defaultMaterial || (this._defaultMaterial = t.clone());
                if (r && r.baseMaterial === n || (r = this._derivedMaterial = function (t) {
                        const r = F(t, {
                            chained: !0,
                            extensions: {
                                derivatives: !0
                            },
                            uniforms: {
                                uTroikaSDFTexture: {
                                    value: null
                                },
                                uTroikaSDFTextureSize: {
                                    value: new e.Vector2
                                },
                                uTroikaSDFGlyphSize: {
                                    value: 0
                                },
                                uTroikaSDFExponent: {
                                    value: 0
                                },
                                uTroikaTotalBounds: {
                                    value: new e.Vector4(0, 0, 0, 0)
                                },
                                uTroikaClipRect: {
                                    value: new e.Vector4(0, 0, 0, 0)
                                },
                                uTroikaDistanceOffset: {
                                    value: 0
                                },
                                uTroikaOrient: {
                                    value: new e.Matrix3
                                },
                                uTroikaUseGlyphColors: {
                                    value: !0
                                },
                                uTroikaSDFDebug: {
                                    value: !1
                                }
                            },
                            vertexDefs: "\nuniform vec2 uTroikaSDFTextureSize;\nuniform float uTroikaSDFGlyphSize;\nuniform vec4 uTroikaTotalBounds;\nuniform vec4 uTroikaClipRect;\nuniform mat3 uTroikaOrient;\nuniform bool uTroikaUseGlyphColors;\nuniform float uTroikaDistanceOffset;\nattribute vec4 aTroikaGlyphBounds;\nattribute float aTroikaGlyphIndex;\nattribute vec3 aTroikaGlyphColor;\nvarying vec2 vTroikaGlyphUV;\nvarying vec4 vTroikaTextureUVBounds;\nvarying vec3 vTroikaGlyphColor;\nvarying vec2 vTroikaGlyphDimensions;\n",
                            vertexTransform: "\nvec4 bounds = aTroikaGlyphBounds;\nvec4 outlineBounds = vec4(bounds.xy - uTroikaDistanceOffset, bounds.zw + uTroikaDistanceOffset);\nvec4 clippedBounds = vec4(\n  clamp(outlineBounds.xy, uTroikaClipRect.xy, uTroikaClipRect.zw),\n  clamp(outlineBounds.zw, uTroikaClipRect.xy, uTroikaClipRect.zw)\n);\nvec2 clippedXY = (mix(clippedBounds.xy, clippedBounds.zw, position.xy) - bounds.xy) / (bounds.zw - bounds.xy);\n\nposition.xy = mix(bounds.xy, bounds.zw, clippedXY);\n\nuv = (position.xy - uTroikaTotalBounds.xy) / (uTroikaTotalBounds.zw - uTroikaTotalBounds.xy);\n\nposition = uTroikaOrient * position;\nnormal = uTroikaOrient * normal;\n\nvTroikaGlyphUV = clippedXY.xy;\nvTroikaGlyphDimensions = vec2(bounds[2] - bounds[0], bounds[3] - bounds[1]);\n\n\nfloat txCols = uTroikaSDFTextureSize.x / uTroikaSDFGlyphSize;\nvec2 txUvPerGlyph = uTroikaSDFGlyphSize / uTroikaSDFTextureSize;\nvec2 txStartUV = txUvPerGlyph * vec2(\n  mod(aTroikaGlyphIndex, txCols),\n  floor(aTroikaGlyphIndex / txCols)\n);\nvTroikaTextureUVBounds = vec4(txStartUV, vec2(txStartUV) + txUvPerGlyph);\n",
                            fragmentDefs: "\nuniform sampler2D uTroikaSDFTexture;\nuniform vec2 uTroikaSDFTextureSize;\nuniform float uTroikaSDFGlyphSize;\nuniform float uTroikaSDFExponent;\nuniform float uTroikaDistanceOffset;\nuniform bool uTroikaSDFDebug;\nvarying vec2 vTroikaGlyphUV;\nvarying vec4 vTroikaTextureUVBounds;\nvarying vec2 vTroikaGlyphDimensions;\n\nfloat troikaSdfValueToSignedDistance(float alpha) {\n  // Inverse of encoding in SDFGenerator.js\n  \n  float maxDimension = max(vTroikaGlyphDimensions.x, vTroikaGlyphDimensions.y);\n  float absDist = (1.0 - pow(2.0 * (alpha > 0.5 ? 1.0 - alpha : alpha), 1.0 / uTroikaSDFExponent)) * maxDimension;\n  float signedDist = absDist * (alpha > 0.5 ? -1.0 : 1.0);\n  return signedDist;\n}\n\nfloat troikaGlyphUvToSdfValue(vec2 glyphUV) {\n  vec2 textureUV = mix(vTroikaTextureUVBounds.xy, vTroikaTextureUVBounds.zw, glyphUV);\n  return texture2D(uTroikaSDFTexture, textureUV).r;\n}\n\nfloat troikaGlyphUvToDistance(vec2 uv) {\n  return troikaSdfValueToSignedDistance(troikaGlyphUvToSdfValue(uv));\n}\n\nfloat troikaGetTextAlpha(float distanceOffset) {\n  vec2 clampedGlyphUV = clamp(vTroikaGlyphUV, 0.5 / uTroikaSDFGlyphSize, 1.0 - 0.5 / uTroikaSDFGlyphSize);\n  float distance = troikaGlyphUvToDistance(clampedGlyphUV);\n    \n  // Extrapolate distance when outside bounds:\n  distance += clampedGlyphUV == vTroikaGlyphUV ? 0.0 : \n    length((vTroikaGlyphUV - clampedGlyphUV) * vTroikaGlyphDimensions);\n\n  \n  \n  #if defined(IS_DEPTH_MATERIAL) || defined(IS_DISTANCE_MATERIAL)\n  float alpha = step(-distanceOffset, -distance);\n  #else\n  \n  #if defined(GL_OES_standard_derivatives) || __VERSION__ >= 300\n  float aaDist = length(fwidth(vTroikaGlyphUV * vTroikaGlyphDimensions)) * 0.5;\n  #else\n  float aaDist = vTroikaGlyphDimensions.x / 64.0;\n  #endif\n  \n  float alpha = smoothstep(\n    distanceOffset + aaDist,\n    distanceOffset - aaDist,\n    distance\n  );\n  #endif\n  \n  return alpha;\n}\n",
                            fragmentColorTransform: "\nfloat alpha = uTroikaSDFDebug ?\n  troikaGlyphUvToSdfValue(vTroikaGlyphUV) :\n  troikaGetTextAlpha(uTroikaDistanceOffset);\n\n#if !defined(IS_DEPTH_MATERIAL) && !defined(IS_DISTANCE_MATERIAL)\ngl_FragColor.a *= alpha;\n#endif\n  \nif (alpha == 0.0) {\n  discard;\n}\n",
                            customRewriter({
                                vertexShader: e,
                                fragmentShader: t
                            }) {
                                let r = /\buniform\s+vec3\s+diffuse\b/;
                                return r.test(t) && (t = t.replace(r, "varying vec3 vTroikaGlyphColor").replace(/\bdiffuse\b/g, "vTroikaGlyphColor"), r.test(e) || (e = e.replace(b, "uniform vec3 diffuse;\n$&\nvTroikaGlyphColor = uTroikaUseGlyphColors ? aTroikaGlyphColor / 255.0 : diffuse;\n"))), {
                                    vertexShader: e,
                                    fragmentShader: t
                                }
                            }
                        });
                        return r.transparent = !0, Object.defineProperties(r, {
                            isTroikaTextMaterial: {
                                value: !0
                            },
                            shadowSide: {
                                get() {
                                    return this.side
                                },
                                set() {}
                            }
                        }), r
                    }(n), n.addEventListener("dispose", (function e() {
                        n.removeEventListener("dispose", e), r.dispose()
                    }))), this.outlineWidth) {
                    let e = r._outlineMtl;
                    e || (e = r._outlineMtl = Object.create(r, {
                        id: {
                            value: r.id + .1
                        }
                    }), e.isTextOutlineMaterial = !0, e.depthWrite = !1, e.map = null), r = [e, r]
                }
                return r
            }
            set material(e) {
                e && e.isTroikaTextMaterial ? (this._derivedMaterial = e, this._baseMaterial = e.baseMaterial) : this._baseMaterial = e
            }
            get glyphGeometryDetail() {
                return this.geometry.detail
            }
            set glyphGeometryDetail(e) {
                this.geometry.detail = e
            }
            get customDepthMaterial() {
                return l(this.material).getDepthMaterial()
            }
            get customDistanceMaterial() {
                return l(this.material).getDistanceMaterial()
            }
            _prepareForRender(t) {
                const o = t.isTextOutlineMaterial,
                    l = t.uniforms,
                    u = this.textRenderInfo;
                if (u) {
                    const {
                        sdfTexture: e,
                        blockBounds: t
                    } = u;
                    l.uTroikaSDFTexture.value = e, l.uTroikaSDFTextureSize.value.set(e.image.width, e.image.height), l.uTroikaSDFGlyphSize.value = u.sdfGlyphSize, l.uTroikaSDFExponent.value = u.sdfExponent, l.uTroikaTotalBounds.value.fromArray(t), l.uTroikaUseGlyphColors.value = !!u.glyphColors;
                    let r = 0;
                    if (o) {
                        let {
                            outlineWidth: e
                        } = this;
                        if ("string" == typeof e) {
                            let t = e.match(/^([\d.]+)%$/),
                                r = t ? parseFloat(t[1]) : NaN;
                            e = (isNaN(r) ? 0 : r / 100) * this.fontSize
                        }
                        r = e
                    }
                    l.uTroikaDistanceOffset.value = r;
                    let n = this.clipRect;
                    if (n && Array.isArray(n) && 4 === n.length) l.uTroikaClipRect.value.fromArray(n);
                    else {
                        const e = 100 * (this.fontSize || .1);
                        l.uTroikaClipRect.value.set(t[0] - e, t[1] - e, t[2] + e, t[3] + e)
                    }
                    this.geometry.applyClipRect(l.uTroikaClipRect.value)
                }
                l.uTroikaSDFDebug.value = !!this.debugSDF, t.polygonOffset = !!this.depthOffset, t.polygonOffsetFactor = t.polygonOffsetUnits = this.depthOffset || 0;
                const f = o ? this.outlineColor || 0 : this.color;
                if (null == f) delete t.color;
                else {
                    const r = t.hasOwnProperty("color") ? t.color : t.color = new e.Color;
                    f === r._input && "object" != typeof f || r.set(r._input = f)
                }
                let h = this.orientation || s;
                if (h !== t._orientation) {
                    let e = l.uTroikaOrient.value;
                    h = h.replace(/[^-+xyz]/g, "");
                    let o = h !== s && h.match(/^([-+])([xyz])([-+])([xyz])$/);
                    if (o) {
                        let [, t, s, l, u] = o;
                        n.set(0, 0, 0)[s] = "-" === t ? 1 : -1, a.set(0, 0, 0)[u] = "-" === l ? -1 : 1, r.lookAt(i, n.cross(a), a), e.setFromMatrix4(r)
                    } else e.identity();
                    t._orientation = h
                }
            }
            raycast(e, t) {
                const n = this.textRenderInfo;
                if (n) {
                    const a = n.blockBounds;
                    u.matrixWorld.multiplyMatrices(this.matrixWorld, r.set(a[2] - a[0], 0, 0, a[0], 0, a[3] - a[1], 0, a[1], 0, 0, 1, 0, 0, 0, 0, 1)), o.length = 0, u.raycast(e, o);
                    for (let e = 0; e < o.length; e++) o[e].object = this, t.push(o[e])
                }
            }
            copy(e) {
                return super.copy(e), c.forEach(t => {
                    this[t] = e[t]
                }), this
            }
            clone() {
                return (new this.constructor).copy(this)
            }
        }
        d.forEach(e => {
            const t = "_private_" + e;
            Object.defineProperty(p.prototype, e, {
                get() {
                    return this[t]
                },
                set(e) {
                    e !== this[t] && (this[t] = e, this._needsSync = !0)
                }
            })
        });
        let v = !1;
        return Object.defineProperty(p.prototype, "anchor", {
            get() {
                return this._deprecated_anchor
            },
            set(e) {
                this._deprecated_anchor = e, v || (console.warn("TextMesh: `anchor` has been deprecated; use `anchorX` and `anchorY` instead."), v = !0), Array.isArray(e) ? (this.anchorX = 100 * (+e[0] || 0) + "%", this.anchorY = 100 * (+e[1] || 0) + "%") : this.anchorX = this.anchorY = 0
            }
        }), p
    })();
    var V = "troika-text";
    o.default.registerComponent(V, {
        schema: {
            align: {
                type: "string",
                default: "left",
                oneOf: ["left", "right", "center", "justify"]
            },
            anchor: {
                default: "center",
                oneOf: ["left", "right", "center", "align"]
            },
            baseline: {
                default: "center",
                oneOf: ["top", "center", "bottom"]
            },
            clipRect: {
                type: "string",
                default: "",
                parse: function (e) {
                    return e && (e = e.split(/[\s,]+/).reduce((function (e, t) {
                        return t = +t, isNaN(t) || e.push(t), e
                    }), [])), e && 4 === e.length ? e : null
                },
                stringify: function (e) {
                    return e ? e.join(" ") : ""
                }
            },
            color: {
                type: "color",
                default: "#FFF"
            },
            depthOffset: {
                type: "number",
                default: 0
            },
            font: {
                type: "string"
            },
            fontSize: {
                type: "number",
                default: .2
            },
            letterSpacing: {
                type: "number",
                default: 0
            },
            lineHeight: {
                type: "number"
            },
            maxWidth: {
                type: "number",
                default: 1 / 0
            },
            outlineColor: {
                type: "color",
                default: "#000"
            },
            outlineWidth: {
                default: 0,
                parse: function (e) {
                    return "string" == typeof e && e.indexOf("%") > 0 ? e : (e = +e, isNaN(e) ? 0 : e)
                },
                stringify: function (e) {
                    return "" + e
                }
            },
            overflowWrap: {
                type: "string",
                default: "normal",
                oneOf: ["normal", "break-word"]
            },
            textIndent: {
                type: "number",
                default: 0
            },
            value: {
                type: "string"
            },
            whiteSpace: {
                default: "normal",
                oneOf: ["normal", "nowrap"]
            }
        },
        init: function () {
            var e;
            "a-troika-text" === this.el.tagName.toLowerCase() ? e = this.el : (e = document.createElement("a-entity"), this.el.appendChild(e)), this.troikaTextEntity = e;
            var t = this.troikaTextMesh = new W;
            e.setObject3D("mesh", t)
        },
        update: function () {
            var e = this.data,
                t = this.troikaTextMesh,
                r = this.troikaTextEntity;
            if (t.text = (e.value || "").replace(/\\n/g, "\n").replace(/\\t/g, "\t"), t.textAlign = e.align, t.anchorX = j["align" === e.anchor ? e.align : e.anchor] || "center", t.anchorY = N[e.baseline] || "middle", t.color = e.color, t.clipRect = e.clipRect, t.depthOffset = e.depthOffset || 0, t.font = e.font, t.fontSize = e.fontSize, t.letterSpacing = e.letterSpacing || 0, t.lineHeight = e.lineHeight || "normal", t.outlineColor = e.outlineColor, t.outlineWidth = e.outlineWidth, t.overflowWrap = e.overflowWrap, t.textIndent = e.textIndent, t.whiteSpace = e.whiteSpace, t.maxWidth = e.maxWidth, t.sync(), r !== this.el) {
                var n = this.el.getAttribute("troika-text-material");
                n ? r.setAttribute("material", n) : r.removeAttribute("material")
            }
        },
        remove: function () {
            this.troikaTextMesh.dispose(), this.troikaTextEntity !== this.el && this.el.removeChild(this.troikaTextEntity)
        }
    });
    var z, j = {
            left: "left",
            center: "center",
            right: "right"
        },
        N = {
            top: "top",
            center: "middle",
            bottom: "bottom"
        },
        $ = {},
        X = o.default.components["troika-text"].schema;
    Object.keys(X).map((function (e) {
        var t = e.replace(/([a-z])([A-Z])/g, "$1-$2").toLowerCase();
        $[t] = "troika-text." + e
    })), o.default.registerPrimitive("a-troika-text", {
        defaultComponents: {
            "troika-text": {}
        },
        mappings: $
    }), (z = a).MathUtils || (z.MathUtils = z.Math)
}(THREE, AFRAME);
//# sourceMappingURL=aframe-troika-text.min.js.map