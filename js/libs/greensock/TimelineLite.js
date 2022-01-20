(window._gsQueue||(window._gsQueue=[])).push(function(){"use strict";window._gsDefine("TimelineLite",["core.Animation","core.SimpleTimeline","TweenLite"],function(t,i,e){var s=function(t){i.call(this,t),this._labels={},this.autoRemoveChildren=this.vars.autoRemoveChildren===!0,this.smoothChildTiming=this.vars.smoothChildTiming===!0,this._sortChildren=!0,this._onUpdate=this.vars.onUpdate;var e,s,r=this.vars;for(s in r)e=r[s],e instanceof Array&&-1!==e.join("").indexOf("{self}")&&(r[s]=this._swapSelfInParams(e));r.tweens instanceof Array&&this.add(r.tweens,0,r.align,r.stagger)},r=[],n=function(t){var i,e={};for(i in t)e[i]=t[i];return e},a=function(t,i,e,s){t._timeline.pause(t._startTime),i&&i.apply(s||t._timeline,e||r)},o=r.slice,h=s.prototype=new i;return s.version="1.10.2",h.constructor=s,h.kill()._gc=!1,h.to=function(t,i,s,r){return i?this.add(new e(t,i,s),r):this.set(t,s,r)},h.from=function(t,i,s,r){return this.add(e.from(t,i,s),r)},h.fromTo=function(t,i,s,r,n){return i?this.add(e.fromTo(t,i,s,r),n):this.set(t,r,n)},h.staggerTo=function(t,i,r,a,h,l,_,u){var m,d=new s({onComplete:l,onCompleteParams:_,onCompleteScope:u});for("string"==typeof t&&(t=e.selector(t)||t),!(t instanceof Array)&&t.length&&t!==window&&t[0]&&(t[0]===window||t[0].nodeType&&t[0].style&&!t.nodeType)&&(t=o.call(t,0)),a=a||0,m=0;m<t.length;m++)r.startAt&&(r.startAt=n(r.startAt)),d.to(t[m],i,n(r),m*a);return this.add(d,h)},h.staggerFrom=function(t,i,e,s,r,n,a,o){return e.immediateRender=0!=e.immediateRender,e.runBackwards=!0,this.staggerTo(t,i,e,s,r,n,a,o)},h.staggerFromTo=function(t,i,e,s,r,n,a,o,h){return s.startAt=e,s.immediateRender=0!=s.immediateRender&&0!=e.immediateRender,this.staggerTo(t,i,s,r,n,a,o,h)},h.call=function(t,i,s,r){return this.add(e.delayedCall(0,t,i,s),r)},h.set=function(t,i,s){return s=this._parseTimeOrLabel(s,0,!0),null==i.immediateRender&&(i.immediateRender=s===this._time&&!this._paused),this.add(new e(t,0,i),s)},s.exportRoot=function(t,i){t=t||{},null==t.smoothChildTiming&&(t.smoothChildTiming=!0);var r,n,a=new s(t),o=a._timeline;for(null==i&&(i=!0),o._remove(a,!0),a._startTime=0,a._rawPrevTime=a._time=a._totalTime=o._time,r=o._first;r;)n=r._next,i&&r instanceof e&&r.target===r.vars.onComplete||a.add(r,r._startTime-r._delay),r=n;return o.add(a,0),a},h.add=function(r,n,a,o){var h,l,_,u,m;if("number"!=typeof n&&(n=this._parseTimeOrLabel(n,0,!0,r)),!(r instanceof t)){if(r instanceof Array){for(a=a||"normal",o=o||0,h=n,l=r.length,_=0;l>_;_++)(u=r[_])instanceof Array&&(u=new s({tweens:u})),this.add(u,h),"string"!=typeof u&&"function"!=typeof u&&("sequence"===a?h=u._startTime+u.totalDuration()/u._timeScale:"start"===a&&(u._startTime-=u.delay())),h+=o;return this._uncache(!0)}if("string"==typeof r)return this.addLabel(r,n);if("function"!=typeof r)throw"Cannot add "+r+" into the timeline; it is neither a tween, timeline, function, nor a string.";r=e.delayedCall(0,r)}if(i.prototype.add.call(this,r,n),this._gc&&!this._paused&&this._time===this._duration&&this._time<this.duration())for(m=this;m._gc&&m._timeline;)m._timeline.smoothChildTiming?m.totalTime(m._totalTime,!0):m._enabled(!0,!1),m=m._timeline;return this},h.remove=function(i){if(i instanceof t)return this._remove(i,!1);if(i instanceof Array){for(var e=i.length;--e>-1;)this.remove(i[e]);return this}return"string"==typeof i?this.removeLabel(i):this.kill(null,i)},h._remove=function(t,e){return i.prototype._remove.call(this,t,e),this._last?this._time>this._last._startTime&&(this._time=this.duration(),this._totalTime=this._totalDuration):this._time=this._totalTime=0,this},h.append=function(t,i){return this.add(t,this._parseTimeOrLabel(null,i,!0,t))},h.insert=h.insertMultiple=function(t,i,e,s){return this.add(t,i||0,e,s)},h.appendMultiple=function(t,i,e,s){return this.add(t,this._parseTimeOrLabel(null,i,!0,t),e,s)},h.addLabel=function(t,i){return this._labels[t]=this._parseTimeOrLabel(i),this},h.addPause=function(t,i,e,s){return this.call(a,["{self}",i,e,s],this,t)},h.removeLabel=function(t){return delete this._labels[t],this},h.getLabelTime=function(t){return null!=this._labels[t]?this._labels[t]:-1},h._parseTimeOrLabel=function(i,e,s,r){var n;if(r instanceof t&&r.timeline===this)this.remove(r);else if(r instanceof Array)for(n=r.length;--n>-1;)r[n]instanceof t&&r[n].timeline===this&&this.remove(r[n]);if("string"==typeof e)return this._parseTimeOrLabel(e,s&&"number"==typeof i&&null==this._labels[e]?i-this.duration():0,s);if(e=e||0,"string"!=typeof i||!isNaN(i)&&null==this._labels[i])null==i&&(i=this.duration());else{if(n=i.indexOf("="),-1===n)return null==this._labels[i]?s?this._labels[i]=this.duration()+e:e:this._labels[i]+e;e=parseInt(i.charAt(n-1)+"1",10)*Number(i.substr(n+1)),i=n>1?this._parseTimeOrLabel(i.substr(0,n-1),0,s):this.duration()}return Number(i)+e},h.seek=function(t,i){return this.totalTime("number"==typeof t?t:this._parseTimeOrLabel(t),i!==!1)},h.stop=function(){return this.paused(!0)},h.gotoAndPlay=function(t,i){return this.play(t,i)},h.gotoAndStop=function(t,i){return this.pause(t,i)},h.render=function(t,i,e){this._gc&&this._enabled(!0,!1);var s,n,a,o,h,l=this._dirty?this.totalDuration():this._totalDuration,_=this._time,u=this._startTime,m=this._timeScale,d=this._paused;if(t>=l?(this._totalTime=this._time=l,this._reversed||this._hasPausedChild()||(n=!0,o="onComplete",0===this._duration&&(0===t||this._rawPrevTime<0)&&this._rawPrevTime!==t&&this._first&&(h=!0,this._rawPrevTime>0&&(o="onReverseComplete"))),this._rawPrevTime=t,t=l+1e-6):1e-7>t?(this._totalTime=this._time=0,(0!==_||0===this._duration&&this._rawPrevTime>0)&&(o="onReverseComplete",n=this._reversed),0>t?(this._active=!1,0===this._duration&&this._rawPrevTime>=0&&this._first&&(h=!0),this._rawPrevTime=t):(this._rawPrevTime=t,t=0,this._initted||(h=!0))):this._totalTime=this._time=this._rawPrevTime=t,this._time!==_&&this._first||e||h){if(this._initted||(this._initted=!0),this._active||!this._paused&&this._time!==_&&t>0&&(this._active=!0),0===_&&this.vars.onStart&&0!==this._time&&(i||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||r)),this._time>=_)for(s=this._first;s&&(a=s._next,!this._paused||d);)(s._active||s._startTime<=this._time&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,i,e):s.render((t-s._startTime)*s._timeScale,i,e)),s=a;else for(s=this._last;s&&(a=s._prev,!this._paused||d);)(s._active||s._startTime<=_&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,i,e):s.render((t-s._startTime)*s._timeScale,i,e)),s=a;this._onUpdate&&(i||this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||r)),o&&(this._gc||(u===this._startTime||m!==this._timeScale)&&(0===this._time||l>=this.totalDuration())&&(n&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!i&&this.vars[o]&&this.vars[o].apply(this.vars[o+"Scope"]||this,this.vars[o+"Params"]||r)))}},h._hasPausedChild=function(){for(var t=this._first;t;){if(t._paused||t instanceof s&&t._hasPausedChild())return!0;t=t._next}return!1},h.getChildren=function(t,i,s,r){r=r||-9999999999;for(var n=[],a=this._first,o=0;a;)a._startTime<r||(a instanceof e?i!==!1&&(n[o++]=a):(s!==!1&&(n[o++]=a),t!==!1&&(n=n.concat(a.getChildren(!0,i,s)),o=n.length))),a=a._next;return n},h.getTweensOf=function(t,i){for(var s=e.getTweensOf(t),r=s.length,n=[],a=0;--r>-1;)(s[r].timeline===this||i&&this._contains(s[r]))&&(n[a++]=s[r]);return n},h._contains=function(t){for(var i=t.timeline;i;){if(i===this)return!0;i=i.timeline}return!1},h.shiftChildren=function(t,i,e){e=e||0;for(var s,r=this._first,n=this._labels;r;)r._startTime>=e&&(r._startTime+=t),r=r._next;if(i)for(s in n)n[s]>=e&&(n[s]+=t);return this._uncache(!0)},h._kill=function(t,i){if(!t&&!i)return this._enabled(!1,!1);for(var e=i?this.getTweensOf(i):this.getChildren(!0,!0,!1),s=e.length,r=!1;--s>-1;)e[s]._kill(t,i)&&(r=!0);return r},h.clear=function(t){var i=this.getChildren(!1,!0,!0),e=i.length;for(this._time=this._totalTime=0;--e>-1;)i[e]._enabled(!1,!1);return t!==!1&&(this._labels={}),this._uncache(!0)},h.invalidate=function(){for(var t=this._first;t;)t.invalidate(),t=t._next;return this},h._enabled=function(t,e){if(t===this._gc)for(var s=this._first;s;)s._enabled(t,!0),s=s._next;return i.prototype._enabled.call(this,t,e)},h.progress=function(t){return arguments.length?this.totalTime(this.duration()*t,!1):this._time/this.duration()},h.duration=function(t){return arguments.length?(0!==this.duration()&&0!==t&&this.timeScale(this._duration/t),this):(this._dirty&&this.totalDuration(),this._duration)},h.totalDuration=function(t){if(!arguments.length){if(this._dirty){for(var i,e,s=0,r=this._last,n=999999999999;r;)i=r._prev,r._dirty&&r.totalDuration(),r._startTime>n&&this._sortChildren&&!r._paused?this.add(r,r._startTime-r._delay):n=r._startTime,r._startTime<0&&!r._paused&&(s-=r._startTime,this._timeline.smoothChildTiming&&(this._startTime+=r._startTime/this._timeScale),this.shiftChildren(-r._startTime,!1,-9999999999),n=0),e=r._startTime+r._totalDuration/r._timeScale,e>s&&(s=e),r=i;this._duration=this._totalDuration=s,this._dirty=!1}return this._totalDuration}return 0!==this.totalDuration()&&0!==t&&this.timeScale(this._totalDuration/t),this},h.usesFrames=function(){for(var i=this._timeline;i._timeline;)i=i._timeline;return i===t._rootFramesTimeline},h.rawTime=function(){return this._paused||0!==this._totalTime&&this._totalTime!==this._totalDuration?this._totalTime:(this._timeline.rawTime()-this._startTime)*this._timeScale},s},!0)}),window._gsDefine&&window._gsQueue.pop()();