!function t(e,n,o){function i(s,a){if(!n[s]){if(!e[s]){var c="function"==typeof require&&require
if(!a&&c)return c(s,!0)
if(r)return r(s,!0)
var u=new Error("Cannot find module '"+s+"'")
throw u.code="MODULE_NOT_FOUND",u}var p=n[s]={exports:{}}
e[s][0].call(p.exports,function(t){var n=e[s][1][t]
return i(n?n:t)},p,p.exports,t,e,n,o)}return n[s].exports}for(var r="function"==typeof require&&require,s=0;s<o.length;s++)i(o[s])
return i}({1:[function(t,e,n){function o(t,e){this.attrubutes=t,this.node=e,this.nodes={},this.setNodes(e)}var i=t("../helpers/utils")
o.prototype.setNodes=function(t){var e=i.toArray(t.querySelectorAll("[data-name]")),n=this
Object.keys(e).forEach(function(t){var o=e[t]
n.nodes[o.getAttribute("data-name")]=o})},o.prototype.enable=function(){i.each(this.nodes,mini_blog.dom.makeEditable)},o.prototype.disable=function(){i.each(this.nodes,mini_blog.dom.unmakeEditable)},o.prototype.save=function(){},o.prototype.cancel=function(){},o.prototype.collectData=function(){var t={}
return i.each(this.nodes,function(e){t[e.getAttribute("data-name")]=e.innerHTML}),t},e.exports=o},{"../helpers/utils":12}],2:[function(t,e,n){var o=t("./editor"),i=t("../helpers/dom"),r={components:{}}
r.register=function(t,e){this.components[t]={constructor:e}},r.create=function(t,e,n){return this.components[t]?new this.components[t].constructor(e,n):!1},r.createComponent=function(t){if(!t.component&&!t.getAttribute("data-ignore")){var e=i.dataAttributes(t),n=e["data-component"],s=r.create(n,e,t)
if(!s)return console.warn('Component "'+n+'" does not exists!')
t.component=s,t.addEventListener("mouseenter",function(){o.setCurrent(this)})}},e.exports=r},{"../helpers/dom":9,"./editor":3}],3:[function(t,e,n){function o(){var t=document.createElement("div")
t.id="mini_editor",t.className="hidden",document.body.appendChild(t),this.container=t}function i(t,e){this.mods[t]=e}function r(){p.each(this.mods,function(t){t.disable()})}function s(t){p.each(this.mods,function(e){-1!==t.indexOf(e.name)&&e.enable()})}function a(t){if(!this.active&&t.component){var e=["edit"].concat(t.component.currentMods||[])
this.current=t,this.disableMods(),this.enableMods(e),this.move(t)}}function c(){this.active&&(this.active=!1,this.container.className="hidden")}function u(t){this.container.className="visible"
var e=t.offsetLeft-this.container.offsetWidth-10,n=t.offsetTop
this.container.style.left=e+"px",this.container.style.top=n+"px"}var p=t("../helpers/utils"),d={mods:{},current:null,active:!1,setupContainer:o,disableMods:r,enableMods:s,addMod:i,clearCurrent:c,setCurrent:a,move:u}
d.setupContainer(),e.exports=d},{"../helpers/utils":12}],4:[function(t,e,n){var o=t("./components"),i=t("./settings"),r=t("../helpers/utils"),s=function(t){i.assign(t),r.toArray(document.querySelectorAll("[data-component]")).forEach(o.createComponent)}
e.exports=s},{"../helpers/utils":12,"./components":2,"./settings":6}],5:[function(t,e,n){function o(t){this.editor=t,this.actions={},this.init()}var i=t("../helpers/utils")
o.prototype.init=function(){},o.prototype.enable=function(){i.each(this.actions,function(t){t.button.style.display="block"})},o.prototype.disable=function(){i.each(this.actions,function(t){t.button.style.display="none"})},o.prototype.addAction=function(t,e,n){var o=document.createElement("button"),i=this
o.innerHTML=n?e:t,o.setAttribute("data-role",t),o.className="button",o.addEventListener("click",function(){i.trigger(this.getAttribute("data-role"),i.editor.current)}),this.editor.container.appendChild(o),n=n||e,n.button=o,this.actions[t]=n},o.prototype.trigger=function(t,e){this.actions[t]&&this.actions[t](e)},e.exports=o},{"../helpers/utils":12}],6:[function(t,e,n){var o={settings:{},get:function(t){return this.settings[t]?this.settings[t]:null},set:function(t,e){this.settings[t]=e},assign:function(t){this.settings=t}}
e.exports=o},{}],7:[function(t,e,n){var o=t("../core/settings"),i={}
i.request=function(t,e,n){var o=new this.instance(this.url(t),e,n)
return o.on("data",function(t,e){"ok"!==e.status&&i.emit("error",t,e.message)}),o.on("error",function(t,e){console.log(e)}),o},["get","post","put","delete"].forEach(function(t){var e=t.toUpperCase()
i[t]=function(t,n){return this.request(t,e,n)}}),i.url=function(t){return t=Array.isArray(t)?["",o.get("baseurl")].concat(t):["",o.get("baseurl"),t],t.join("/").replace(/\/+/,"/")},i.instance=t("./ajax_instance"),e.exports=i},{"../core/settings":6,"./ajax_instance":8}],8:[function(t,e,n){var o=(t("./ajax"),t("./events")),i=function(t,e,n){this.method=e||"GET",this.data=n||{},this.url=t}
o(i.prototype),i.prototype.send=function(){var t=new XMLHttpRequest,e=this.method.toUpperCase(),n=this.query(this.data),o=this.url,i=this
"GET"===e&&n&&(o+=(-1===o.indexOf("?")?"?":"&")+n),t.open(e,o),t.onreadystatechange=function(){var e,n=this.readyState,o=this.status
if(4===n&&200===o){try{e=JSON.parse(this.responseText)}catch(r){i.emit("error",t,"Invalid JSON")}e&&i.emit("data",this,e)}},t.onerror=function(){i.emit("error",t,"AJAX Error")},t.setRequestHeader("Content-type","application/x-www-form-urlencoded"),t.setRequestHeader("X-Requested-With","XMLHttpRequest"),t.send(n)},i.prototype.success=function(t){return this.on("data",t),this},i.prototype.error=function(t){return this.on("error",t),this},i.prototype.query=function(t){var e="",n=Object.keys(t)
return n.forEach(function(n,o){e+=encodeURIComponent(n)+"="+encodeURIComponent(t[n])+"&"}),e.substr(0,e.length-1)},e.exports=i},{"./ajax":7,"./events":10}],9:[function(t,e,n){var o={}
o.attributes=function(t){for(var e={},n=t.attributes,o=0,i=n.length;i>o;o++){var r=n[o]
e[r.nodeName]=r.nodeValue}return e},o.dataAttributes=function(t){var e=mini_blog.dom.attributes(t)
return Object.keys(e).forEach(function(t){0!==t.indexOf("data-")&&delete e[t]}),e},o.makeEditable=function(t){t.setAttribute("contenteditable","true"),t.isEditable||(t.addEventListener("paste",function(t){t.preventDefault()
var e=t.clipboardData.getData("text/plain").replace(/\</g,"&lt;").replace(/\>/g,"&gt;").replace(/\n\r?/g,"<br/>\n")
document.execCommand("insertHTML",!1,e)}),t.addEventListener("keyup",function(t){13===t.keyCode&&document.execCommand("formatBlock",null,"p")}),t.isEditable=!0)},o.unmakeEditable=function(t){t.removeAttribute("contenteditable")},e.exports=o},{}],10:[function(t,e,n){var o=function(t){t.on=function(t,e){this._events||(this._events={}),this._events[t]||(this._events[t]=[]),this._events[t].push(e)},t.emit=function(t){if(this._events&&this._events[t]){var e=mini_blog.toArray(arguments).slice(1)
this._events[t].forEach(function(t){t&&t.apply(t,e)})}}}
e.exports=o},{}],11:[function(t,e,n){var o=function(t){return t=t||(t=0),function(){return++t}}
e.exports=o},{}],12:[function(t,e,n){var o=function(t,e){for(var n in t)t.hasOwnProperty(n)&&e(t[n],n)},i=function(t,e){var n={}
for(var o in e)("undefined"==typeof t[o]||e[o]!==t[o])&&(n[o]=t[o])
return n},r=function(t,e){var n,o={}
for(n in t)o[n]=t[n]
for(n in e)o[n]=e[n]
return o},s=function(t,e){for(var n in e)t[n]=e[n]},a=function(t){return Array.prototype.slice.call(t)}
e.exports={toArray:a,extend:s,merge:r,diff:i,each:o}},{}],13:[function(t,e,n){(function(e){var n=t("./helpers/utils"),o={components:t("./core/components"),component:t("./core/component"),settings:t("./core/settings"),editor:t("./core/editor"),init:t("./core/init"),mod:t("./core/mod"),events:t("./helpers/events"),ajax:t("./helpers/ajax"),dom:t("./helpers/dom"),mvc:t("./mvc")}
n.extend(o,n),e.mini_blog=o}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{"./core/component":1,"./core/components":2,"./core/editor":3,"./core/init":4,"./core/mod":5,"./core/settings":6,"./helpers/ajax":7,"./helpers/dom":9,"./helpers/events":10,"./helpers/utils":12,"./mvc":16}],14:[function(t,e,n){var o=t("../helpers/utils"),i=t("./extend"),r=function(t){this.options=t,this.models={}}
r.prototype.get=function(t){return this.models[t]},r.prototype.add=function(t,e){this.models[t]=e},r.prototype.remove=function(t){delete this.models[t]},r.prototype.bootstrap=function(t){},r.prototype.forEach=function(t){o.each(this.models,t)},r.extend=i(r),e.exports=r},{"../helpers/utils":12,"./extend":15}],15:[function(t,e,n){var o=function(t){return function(e){var n=function(){t.apply(this,mini_blog.toArray(arguments))}
return n.prototype=Object.create(t.prototype),mini_blog.each(e,function(t,e){n.prototype[e]=t}),n}}
e.exports=o},{}],16:[function(t,e,n){e.exports={collection:t("./collection"),mapper:t("./mapper"),model:t("./model"),view:t("./view")}},{"./collection":14,"./mapper":17,"./model":18,"./view":19}],17:[function(t,e,n){var o=t("../helpers/events"),i=t("../helpers/utils"),r=t("../helpers/ajax"),s=t("./extend"),a=t("./model"),c={baseurl:"/",model:a},u=function(t){this.options=i.merge(c,t)}
o(u.prototype),u.prototype.parse=function(t){return t},u.prototype.create=function(t){return new self.options.model(t)},u.prototype.fetch=function(t){var e=this
r.get([this.options.baseurl,"get",t]).success(function(t,n){e.emit("get",new e.options.model(e.parse(n)))}).send()},u.prototype.insert=function(t){var e=this
r.get([this.options.baseurl,"add"],t.data()).success(function(n,o){t.id=o.id,e.emit("add",t)}).send()},u.prototype.update=function(t){var e=this
r.post([this.options.baseurl,"edit",t.id],t.all()).success(function(){e.emit("change",t)}).send()},u.prototype.remove=function(t){var e=this
r.post([this.options.baseurl,"remove",t]).success(function(){e.emit("destroy",t)}).send()},u.prototype.sync=function(t){t.forEach(function(e){e.isNew()?self.insert(e):e.isEmpty()?(self.remove(e),t.remove(e.id)):e.isDirty()&&self.update(e)})},u.extend=s(u),e.exports=u},{"../helpers/ajax":7,"../helpers/events":10,"../helpers/utils":12,"./extend":15,"./model":18}],18:[function(t,e,n){var o=t("../helpers/events"),i=t("../helpers/utils"),r=t("../helpers/unique")(),s=t("./extend"),a=function(t){var e=t&&t.id?t.id:-r()
t&&t.id&&delete t.id,t=i.merge(this.data||{},t||{}),this.previous=i.merge({},t),this.data=t,this.id=e}
o(a.prototype),a.prototype.get=function(t){return this.data[t]?this.data[t]:!1},a.prototype.isNew=function(){return this.id<0},a.prototype.isDirty=function(){var t=i.diff(this.data,this.previous)
return Object.keys(t).length>0},a.prototype.isEmpty=function(){return 0===Object.keys(this.data).length},a.prototype.set=function(t,e){t&&"undefined"!=typeof e?this.data[t]=e:this.data=i.merge(this.data,t),this.emit("change",this)},a.prototype.clear=function(){this.previous=i.merge({},this.data)},a.prototype.revert=function(){this.data=i.merge({},this.previous)},a.prototype.all=function(){return i.merge(this.data,{})},a.prototype.destroy=function(){this.data={},this.id=-1,this.emit("destroy")},a.prototype.reset=function(t){this.data=t,this.emit("change",this)},a.extend=s(a),e.exports=a},{"../helpers/events":10,"../helpers/unique":11,"../helpers/utils":12,"./extend":15}],19:[function(t,e,n){var o=t("./extend"),i=function(t){this.node=t,this.initialize()}
i.prototype.initialize=function(){},i.prototype.render=function(){},i.extend=o(i),e.exports=i},{"./extend":15}]},{},[13])
