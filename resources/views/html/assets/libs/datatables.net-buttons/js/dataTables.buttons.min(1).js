/*!
 Buttons for DataTables 2.2.1
 ©2016-2022 SpryMedia Ltd - datatables.net/license
*/
(function(f){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(D){return f(D,window,document)}):"object"===typeof exports?module.exports=function(D,z){D||(D=window);z&&z.fn.dataTable||(z=require("datatables.net")(D,z).$);return f(z,D,D.document)}:f(jQuery,window,document)})(function(f,D,z,q){function I(a,b,c){f.fn.animate?a.stop().fadeIn(b,c):(a.css("display","block"),c&&c.call(a))}function J(a,b,c){f.fn.animate?a.stop().fadeOut(b,c):(a.css("display","none"),c&&c.call(a))}
function L(a,b){a=new u.Api(a);b=b?b:a.init().buttons||u.defaults.buttons;return(new w(a,b)).container()}var u=f.fn.dataTable,O=0,P=0,A=u.ext.buttons,w=function(a,b){if(!(this instanceof w))return function(c){return(new w(c,a)).container()};"undefined"===typeof b&&(b={});!0===b&&(b={});Array.isArray(b)&&(b={buttons:b});this.c=f.extend(!0,{},w.defaults,b);b.buttons&&(this.c.buttons=b.buttons);this.s={dt:new u.Api(a),buttons:[],listenKeys:"",namespace:"dtb"+O++};this.dom={container:f("<"+this.c.dom.container.tag+
"/>").addClass(this.c.dom.container.className)};this._constructor()};f.extend(w.prototype,{action:function(a,b){a=this._nodeToButton(a);if(b===q)return a.conf.action;a.conf.action=b;return this},active:function(a,b){var c=this._nodeToButton(a);a=this.c.dom.button.active;c=f(c.node);if(b===q)return c.hasClass(a);c.toggleClass(a,b===q?!0:b);return this},add:function(a,b,c){var d=this.s.buttons;if("string"===typeof b){b=b.split("-");var h=this.s;d=0;for(var e=b.length-1;d<e;d++)h=h.buttons[1*b[d]];d=
h.buttons;b=1*b[b.length-1]}this._expandButton(d,a,a!==q?a.split:q,(a===q||a.split===q||0===a.split.length)&&h!==q,!1,b);c!==q&&!0!==c||this._draw();return this},collectionRebuild:function(a,b){a=this._nodeToButton(a);if(b!==q){var c;for(c=a.buttons.length-1;0<=c;c--)this.remove(a.buttons[c].node);for(c=0;c<b.length;c++){var d=b[c];this._expandButton(a.buttons,d,d!==q&&d.config!==q&&d.config.split!==q,!0,d.parentConf!==q&&d.parentConf.split!==q,c,d.parentConf)}}this._draw(a.collection,a.buttons)},
container:function(){return this.dom.container},disable:function(a){a=this._nodeToButton(a);f(a.node).addClass(this.c.dom.button.disabled).attr("disabled",!0);return this},destroy:function(){f("body").off("keyup."+this.s.namespace);var a=this.s.buttons.slice(),b;var c=0;for(b=a.length;c<b;c++)this.remove(a[c].node);this.dom.container.remove();a=this.s.dt.settings()[0];c=0;for(b=a.length;c<b;c++)if(a.inst===this){a.splice(c,1);break}return this},enable:function(a,b){if(!1===b)return this.disable(a);
a=this._nodeToButton(a);f(a.node).removeClass(this.c.dom.button.disabled).removeAttr("disabled");return this},index:function(a,b,c){b||(b="",c=this.s.buttons);for(var d=0,h=c.length;d<h;d++){var e=c[d].buttons;if(c[d].node===a)return b+d;if(e&&e.length&&(e=this.index(a,d+"-",e),null!==e))return e}return null},name:function(){return this.c.name},node:function(a){if(!a)return this.dom.container;a=this._nodeToButton(a);return f(a.node)},processing:function(a,b){var c=this.s.dt,d=this._nodeToButton(a);
if(b===q)return f(d.node).hasClass("processing");f(d.node).toggleClass("processing",b);f(c.table().node()).triggerHandler("buttons-processing.dt",[b,c.button(a),c,f(a),d.conf]);return this},remove:function(a){var b=this._nodeToButton(a),c=this._nodeToHost(a),d=this.s.dt;if(b.buttons.length)for(var h=b.buttons.length-1;0<=h;h--)this.remove(b.buttons[h].node);b.conf.destroying=!0;b.conf.destroy&&b.conf.destroy.call(d.button(a),d,f(a),b.conf);this._removeKey(b.conf);f(b.node).remove();a=f.inArray(b,
c);c.splice(a,1);return this},text:function(a,b){var c=this._nodeToButton(a);a=this.c.dom.collection.buttonLiner;a=c.inCollection&&a&&a.tag?a.tag:this.c.dom.buttonLiner.tag;var d=this.s.dt,h=f(c.node),e=function(g){return"function"===typeof g?g(d,h,c.conf):g};if(b===q)return e(c.conf.text);c.conf.text=b;a?h.children(a).eq(0).filter(":not(.dt-down-arrow)").html(e(b)):h.html(e(b));return this},_constructor:function(){var a=this,b=this.s.dt,c=b.settings()[0],d=this.c.buttons;c._buttons||(c._buttons=
[]);c._buttons.push({inst:this,name:this.c.name});for(var h=0,e=d.length;h<e;h++)this.add(d[h]);b.on("destroy",function(g,m){m===c&&a.destroy()});f("body").on("keyup."+this.s.namespace,function(g){if(!z.activeElement||z.activeElement===z.body){var m=String.fromCharCode(g.keyCode).toLowerCase();-1!==a.s.listenKeys.toLowerCase().indexOf(m)&&a._keypress(m,g)}})},_addKey:function(a){a.key&&(this.s.listenKeys+=f.isPlainObject(a.key)?a.key.key:a.key)},_draw:function(a,b){a||(a=this.dom.container,b=this.s.buttons);
a.children().detach();for(var c=0,d=b.length;c<d;c++)a.append(b[c].inserter),a.append(" "),b[c].buttons&&b[c].buttons.length&&this._draw(b[c].collection,b[c].buttons)},_expandButton:function(a,b,c,d,h,e,g){var m=this.s.dt,k=0,t=Array.isArray(b)?b:[b];b===q&&(t=Array.isArray(c)?c:[c]);c=0;for(var r=t.length;c<r;c++){var n=this._resolveExtends(t[c]);if(n)if(b=n.config!==q&&n.config.split?!0:!1,Array.isArray(n))this._expandButton(a,n,l!==q&&l.conf!==q?l.conf.split:q,d,g!==q&&g.split!==q,e,g);else{var l=
this._buildButton(n,d,n.split!==q||n.config!==q&&n.config.split!==q,h);if(l){e!==q&&null!==e?(a.splice(e,0,l),e++):a.push(l);if(l.conf.buttons||l.conf.split){l.collection=f("<"+(b?this.c.dom.splitCollection.tag:this.c.dom.collection.tag)+"/>");l.conf._collection=l.collection;if(l.conf.split)for(var p=0;p<l.conf.split.length;p++)"object"===typeof l.conf.split[p]&&(l.conf.split[p].parent=g,l.conf.split[p].collectionLayout===q&&(l.conf.split[p].collectionLayout=l.conf.collectionLayout),l.conf.split[p].dropup===
q&&(l.conf.split[p].dropup=l.conf.dropup),l.conf.split[p].fade===q&&(l.conf.split[p].fade=l.conf.fade));else f(l.node).append(f('<span class="dt-down-arrow">'+this.c.dom.splitDropdown.text+"</span>"));this._expandButton(l.buttons,l.conf.buttons,l.conf.split,!b,b,e,l.conf)}l.conf.parent=g;n.init&&n.init.call(m.button(l.node),m,f(l.node),n);k++}}}},_buildButton:function(a,b,c,d){var h=this.c.dom.button,e=this.c.dom.buttonLiner,g=this.c.dom.collection,m=this.c.dom.splitCollection,k=this.c.dom.splitDropdownButton,
t=this.s.dt,r=function(v){return"function"===typeof v?v(t,l,a):v};if(a.spacer){var n=f("<span></span>").addClass("dt-button-spacer "+a.style+" "+h.spacerClass).html(r(a.text));return{conf:a,node:n,inserter:n,buttons:[],inCollection:b,isSplit:c,inSplit:d,collection:null}}!c&&d&&m?h=k:!c&&b&&g.button&&(h=g.button);!c&&d&&m.buttonLiner?e=m.buttonLiner:!c&&b&&g.buttonLiner&&(e=g.buttonLiner);if(a.available&&!a.available(t,a)&&!a.hasOwnProperty("html"))return!1;if(a.hasOwnProperty("html"))var l=f(a.html);
else{var p=function(v,B,E,G){G.action.call(B.button(E),v,B,E,G);f(B.table().node()).triggerHandler("buttons-action.dt",[B.button(E),B,E,G])};g=a.tag||h.tag;var x=a.clickBlurs===q?!0:a.clickBlurs;l=f("<"+g+"/>").addClass(h.className).addClass(d?this.c.dom.splitDropdownButton.className:"").attr("tabindex",this.s.dt.settings()[0].iTabIndex).attr("aria-controls",this.s.dt.table().node().id).on("click.dtb",function(v){v.preventDefault();!l.hasClass(h.disabled)&&a.action&&p(v,t,l,a);x&&l.trigger("blur")}).on("keypress.dtb",
function(v){13===v.keyCode&&(v.preventDefault(),!l.hasClass(h.disabled)&&a.action&&p(v,t,l,a))});"a"===g.toLowerCase()&&l.attr("href","#");"button"===g.toLowerCase()&&l.attr("type","button");e.tag?(g=f("<"+e.tag+"/>").html(r(a.text)).addClass(e.className),"a"===e.tag.toLowerCase()&&g.attr("href","#"),l.append(g)):l.html(r(a.text));!1===a.enabled&&l.addClass(h.disabled);a.className&&l.addClass(a.className);a.titleAttr&&l.attr("title",r(a.titleAttr));a.attr&&l.attr(a.attr);a.namespace||(a.namespace=
".dt-button-"+P++);a.config!==q&&a.config.split&&(a.split=a.config.split)}e=(e=this.c.dom.buttonContainer)&&e.tag?f("<"+e.tag+"/>").addClass(e.className).append(l):l;this._addKey(a);this.c.buttonCreated&&(e=this.c.buttonCreated(a,e));if(c){n=f("<div/>").addClass(this.c.dom.splitWrapper.className);n.append(l);var F=f.extend(a,{text:this.c.dom.splitDropdown.text,className:this.c.dom.splitDropdown.className,closeButton:!1,attr:{"aria-haspopup":!0,"aria-expanded":!1},align:this.c.dom.splitDropdown.align,
splitAlignClass:this.c.dom.splitDropdown.splitAlignClass});this._addKey(F);var C=function(v,B,E,G){A.split.action.call(B.button(f("div.dt-btn-split-wrapper")[0]),v,B,E,G);f(B.table().node()).triggerHandler("buttons-action.dt",[B.button(E),B,E,G]);E.attr("aria-expanded",!0)},y=f('<button class="'+this.c.dom.splitDropdown.className+' dt-button"><span class="dt-btn-split-drop-arrow">'+this.c.dom.splitDropdown.text+"</span></button>").on("click.dtb",function(v){v.preventDefault();v.stopPropagation();
y.hasClass(h.disabled)||C(v,t,y,F);x&&y.trigger("blur")}).on("keypress.dtb",function(v){13===v.keyCode&&(v.preventDefault(),y.hasClass(h.disabled)||C(v,t,y,F))});0===a.split.length&&y.addClass("dtb-hide-drop");n.append(y).attr(F.attr)}return{conf:a,node:c?n.get(0):l.get(0),inserter:c?n:e,buttons:[],inCollection:b,isSplit:c,inSplit:d,collection:null}},_nodeToButton:function(a,b){b||(b=this.s.buttons);for(var c=0,d=b.length;c<d;c++){if(b[c].node===a)return b[c];if(b[c].buttons.length){var h=this._nodeToButton(a,
b[c].buttons);if(h)return h}}},_nodeToHost:function(a,b){b||(b=this.s.buttons);for(var c=0,d=b.length;c<d;c++){if(b[c].node===a)return b;if(b[c].buttons.length){var h=this._nodeToHost(a,b[c].buttons);if(h)return h}}},_keypress:function(a,b){if(!b._buttonsHandled){var c=function(d){for(var h=0,e=d.length;h<e;h++){var g=d[h].conf,m=d[h].node;g.key&&(g.key===a?(b._buttonsHandled=!0,f(m).click()):!f.isPlainObject(g.key)||g.key.key!==a||g.key.shiftKey&&!b.shiftKey||g.key.altKey&&!b.altKey||g.key.ctrlKey&&
!b.ctrlKey||g.key.metaKey&&!b.metaKey||(b._buttonsHandled=!0,f(m).click()));d[h].buttons.length&&c(d[h].buttons)}};c(this.s.buttons)}},_removeKey:function(a){if(a.key){var b=f.isPlainObject(a.key)?a.key.key:a.key;a=this.s.listenKeys.split("");b=f.inArray(b,a);a.splice(b,1);this.s.listenKeys=a.join("")}},_resolveExtends:function(a){var b=this,c=this.s.dt,d,h=function(k){for(var t=0;!f.isPlainObject(k)&&!Array.isArray(k);){if(k===q)return;if("function"===typeof k){if(k=k.call(b,c,a),!k)return!1}else if("string"===
typeof k){if(!A[k])return{html:k};k=A[k]}t++;if(30<t)throw"Buttons: Too many iterations";}return Array.isArray(k)?k:f.extend({},k)};for(a=h(a);a&&a.extend;){if(!A[a.extend])throw"Cannot extend unknown button type: "+a.extend;var e=h(A[a.extend]);if(Array.isArray(e))return e;if(!e)return!1;var g=e.className;a.config!==q&&e.config!==q&&(a.config=f.extend({},e.config,a.config));a=f.extend({},e,a);g&&a.className!==g&&(a.className=g+" "+a.className);var m=a.postfixButtons;if(m){a.buttons||(a.buttons=[]);
g=0;for(d=m.length;g<d;g++)a.buttons.push(m[g]);a.postfixButtons=null}if(m=a.prefixButtons){a.buttons||(a.buttons=[]);g=0;for(d=m.length;g<d;g++)a.buttons.splice(g,0,m[g]);a.prefixButtons=null}a.extend=e.extend}return a},_popover:function(a,b,c,d){d=this.c;var h=!1,e=f.extend({align:"button-left",autoClose:!1,background:!0,backgroundClassName:"dt-button-background",closeButton:!0,contentClassName:d.dom.collection.className,collectionLayout:"",collectionTitle:"",dropup:!1,fade:400,popoverTitle:"",
rightAlignClassName:"dt-button-right",splitRightAlignClassName:"dt-button-split-right",splitLeftAlignClassName:"dt-button-split-left",tag:d.dom.collection.tag},c),g=b.node(),m=function(){h=!0;J(f(".dt-button-collection"),e.fade,function(){f(this).detach()});f(b.buttons('[aria-haspopup="true"][aria-expanded="true"]').nodes()).attr("aria-expanded","false");f("div.dt-button-background").off("click.dtb-collection");w.background(!1,e.backgroundClassName,e.fade,g);f(D).off("resize.resize.dtb-collection");
f("body").off(".dtb-collection");b.off("buttons-action.b-internal");b.off("destroy")};if(!1===a)m();else{c=f(b.buttons('[aria-haspopup="true"][aria-expanded="true"]').nodes());c.length&&(g.closest("div.dt-button-collection").length&&(g=c.eq(0)),m());var k=f("<div/>").addClass("dt-button-collection").addClass(e.collectionLayout).addClass(e.splitAlignClass).css("display","none");a=f(a).addClass(e.contentClassName).attr("role","menu").appendTo(k);g.attr("aria-expanded","true");g.parents("body")[0]!==
z.body&&(g=z.body.lastChild);e.popoverTitle?k.prepend('<div class="dt-button-collection-title">'+e.popoverTitle+"</div>"):e.collectionTitle&&k.prepend('<div class="dt-button-collection-title">'+e.collectionTitle+"</div>");e.closeButton&&k.prepend('<div class="dtb-popover-close">x</div>').addClass("dtb-collection-closeable");I(k.insertAfter(g),e.fade);d=f(b.table().container());var t=k.css("position");"dt-container"===e.align&&(g=g.parent(),k.css("width",d.width()));if("absolute"===t){var r=g.position();
c=f(b.node()).position();k.css({top:f(f(b[0].node).parent()[0]).hasClass("dt-buttons")?c.top+g.outerHeight():r.top+g.outerHeight(),left:r.left});r=k.outerHeight();var n=d.offset().top+d.height();n=c.top+g.outerHeight()+r-n;var l=c.top-r,p=d.offset().top;c=c.top-r-5;(n>p-l||e.dropup)&&-c<p&&k.css("top",c);c=d.offset().left;d=d.width();d=c+d;r=k.offset().left;n=k.outerWidth();0===n&&0<k.children().length&&(n=f(k.children()[0]).outerWidth());n=r+n;var x=g.offset().left;p=g.outerWidth();l=x+p;if(k.hasClass(e.rightAlignClassName)||
k.hasClass(e.leftAlignClassName)||k.hasClass(e.splitAlignClass)||"dt-container"===e.align){var F=l;g.hasClass("dt-btn-split-wrapper")&&0<g.children("button.dt-btn-split-drop").length&&(x=g.children("button.dt-btn-split-drop").offset().left,p=g.children("button.dt-btn-split-drop").outerWidth(),F=x+p);p=0;if(k.hasClass(e.rightAlignClassName))p=l-n,c>r+p&&(c-=r+p,d-=n+p,p=c>d?p+d:p+c);else if(k.hasClass(e.splitRightAlignClassName))p=F-n,c>r+p&&(c-=r+p,d-=n+p,p=c>d?p+d:p+c);else if(k.hasClass(e.splitLeftAlignClassName)){if(p=
x-r,d<n+p||c>r+p)c-=r+p,d-=n+p,p=c>d?p+d:p+c}else p=c-r,d<n+p&&(c-=r+p,d-=n+p,p=c>d?p+d:p+c)}else g.offset(),p=0,p="button-right"===e.align?l-n:x-r;k.css("left",k.position().left+p)}else t=function(){var C=f(D).height()/2,y=k.height()/2;y>C&&(y=C);k.css("marginTop",-1*y)},t(),f(D).on("resize.dtb-collection",function(){t()});e.background&&w.background(!0,e.backgroundClassName,e.fade,e.backgroundHost||g);f("div.dt-button-background").on("click.dtb-collection",function(){});e.autoClose&&setTimeout(function(){b.on("buttons-action.b-internal",
function(C,y,v,B){B[0]!==g[0]&&m()})},0);f(k).trigger("buttons-popover.dt");b.on("destroy",m);setTimeout(function(){h=!1;f("body").on("click.dtb-collection",function(C){if(!h){var y=f.fn.addBack?"addBack":"andSelf",v=f(C.target).parent()[0];(!f(C.target).parents()[y]().filter(a).length&&!f(v).hasClass("dt-buttons")||f(C.target).hasClass("dt-button-background"))&&m()}}).on("keyup.dtb-collection",function(C){27===C.keyCode&&m()})},0)}}});w.background=function(a,b,c,d){c===q&&(c=400);d||(d=z.body);a?
I(f("<div/>").addClass(b).css("display","none").insertAfter(d),c):J(f("div."+b),c,function(){f(this).removeClass(b).remove()})};w.instanceSelector=function(a,b){if(a===q||null===a)return f.map(b,function(e){return e.inst});var c=[],d=f.map(b,function(e){return e.name}),h=function(e){if(Array.isArray(e))for(var g=0,m=e.length;g<m;g++)h(e[g]);else"string"===typeof e?-1!==e.indexOf(",")?h(e.split(",")):(e=f.inArray(e.trim(),d),-1!==e&&c.push(b[e].inst)):"number"===typeof e?c.push(b[e].inst):"object"===
typeof e&&c.push(e)};h(a);return c};w.buttonSelector=function(a,b){for(var c=[],d=function(m,k,t){for(var r,n,l=0,p=k.length;l<p;l++)if(r=k[l])n=t!==q?t+l:l+"",m.push({node:r.node,name:r.conf.name,idx:n}),r.buttons&&d(m,r.buttons,n+"-")},h=function(m,k){var t,r=[];d(r,k.s.buttons);var n=f.map(r,function(l){return l.node});if(Array.isArray(m)||m instanceof f)for(n=0,t=m.length;n<t;n++)h(m[n],k);else if(null===m||m===q||"*"===m)for(n=0,t=r.length;n<t;n++)c.push({inst:k,node:r[n].node});else if("number"===
typeof m)k.s.buttons[m]&&c.push({inst:k,node:k.s.buttons[m].node});else if("string"===typeof m)if(-1!==m.indexOf(","))for(r=m.split(","),n=0,t=r.length;n<t;n++)h(r[n].trim(),k);else if(m.match(/^\d+(\-\d+)*$/))n=f.map(r,function(l){return l.idx}),c.push({inst:k,node:r[f.inArray(m,n)].node});else if(-1!==m.indexOf(":name"))for(m=m.replace(":name",""),n=0,t=r.length;n<t;n++)r[n].name===m&&c.push({inst:k,node:r[n].node});else f(n).filter(m).each(function(){c.push({inst:k,node:this})});else"object"===
typeof m&&m.nodeName&&(r=f.inArray(m,n),-1!==r&&c.push({inst:k,node:n[r]}))},e=0,g=a.length;e<g;e++)h(b,a[e]);return c};w.stripData=function(a,b){if("string"!==typeof a)return a;a=a.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,"");a=a.replace(/<!\-\-.*?\-\->/g,"");if(!b||b.stripHtml)a=a.replace(/<[^>]*>/g,"");if(!b||b.trim)a=a.replace(/^\s+|\s+$/g,"");if(!b||b.stripNewlines)a=a.replace(/\n/g," ");if(!b||b.decodeEntities)M.innerHTML=a,a=M.value;return a};w.defaults={buttons:["copy",
"excel","csv","pdf","print"],name:"main",tabIndex:0,dom:{container:{tag:"div",className:"dt-buttons"},collection:{tag:"div",className:""},button:{tag:"button",className:"dt-button",active:"active",disabled:"disabled",spacerClass:""},buttonLiner:{tag:"span",className:""},split:{tag:"div",className:"dt-button-split"},splitWrapper:{tag:"div",className:"dt-btn-split-wrapper"},splitDropdown:{tag:"button",text:"&#x25BC;",className:"dt-btn-split-drop",align:"split-right",splitAlignClass:"dt-button-split-left"},
splitDropdownButton:{tag:"button",className:"dt-btn-split-drop-button dt-button"},splitCollection:{tag:"div",className:"dt-button-split-collection"}}};w.version="2.2.1";f.extend(A,{collection:{text:function(a){return a.i18n("buttons.collection","Collection")},className:"buttons-collection",closeButton:!1,init:function(a,b,c){b.attr("aria-expanded",!1)},action:function(a,b,c,d){d._collection.parents("body").length?this.popover(!1,d):this.popover(d._collection,d)},attr:{"aria-haspopup":!0}},split:{text:function(a){return a.i18n("buttons.split",
"Split")},className:"buttons-split",closeButton:!1,init:function(a,b,c){return b.attr("aria-expanded",!1)},action:function(a,b,c,d){this.popover(d._collection,d)},attr:{"aria-haspopup":!0}},copy:function(a,b){if(A.copyHtml5)return"copyHtml5"},csv:function(a,b){if(A.csvHtml5&&A.csvHtml5.available(a,b))return"csvHtml5"},excel:function(a,b){if(A.excelHtml5&&A.excelHtml5.available(a,b))return"excelHtml5"},pdf:function(a,b){if(A.pdfHtml5&&A.pdfHtml5.available(a,b))return"pdfHtml5"},pageLength:function(a){a=
a.settings()[0].aLengthMenu;var b=[],c=[];if(Array.isArray(a[0]))b=a[0],c=a[1];else for(var d=0;d<a.length;d++){var h=a[d];f.isPlainObject(h)?(b.push(h.value),c.push(h.label)):(b.push(h),c.push(h))}return{extend:"collection",text:function(e){return e.i18n("buttons.pageLength",{"-1":"Show all rows",_:"Show %d rows"},e.page.len())},className:"buttons-page-length",autoClose:!0,buttons:f.map(b,function(e,g){return{text:c[g],className:"button-page-length",action:function(m,k){k.page.len(e).draw()},init:function(m,
k,t){var r=this;k=function(){r.active(m.page.len()===e)};m.on("length.dt"+t.namespace,k);k()},destroy:function(m,k,t){m.off("length.dt"+t.namespace)}}}),init:function(e,g,m){var k=this;e.on("length.dt"+m.namespace,function(){k.text(m.text)})},destroy:function(e,g,m){e.off("length.dt"+m.namespace)}}},spacer:{style:"empty",spacer:!0,text:function(a){return a.i18n("buttons.spacer","")}}});u.Api.register("buttons()",function(a,b){b===q&&(b=a,a=q);this.selector.buttonGroup=a;var c=this.iterator(!0,"table",
function(d){if(d._buttons)return w.buttonSelector(w.instanceSelector(a,d._buttons),b)},!0);c._groupSelector=a;return c});u.Api.register("button()",function(a,b){a=this.buttons(a,b);1<a.length&&a.splice(1,a.length);return a});u.Api.registerPlural("buttons().active()","button().active()",function(a){return a===q?this.map(function(b){return b.inst.active(b.node)}):this.each(function(b){b.inst.active(b.node,a)})});u.Api.registerPlural("buttons().action()","button().action()",function(a){return a===q?
this.map(function(b){return b.inst.action(b.node)}):this.each(function(b){b.inst.action(b.node,a)})});u.Api.registerPlural("buttons().collectionRebuild()","button().collectionRebuild()",function(a){return this.each(function(b){for(var c=0;c<a.length;c++)"object"===typeof a[c]&&(a[c].parentConf=b);b.inst.collectionRebuild(b.node,a)})});u.Api.register(["buttons().enable()","button().enable()"],function(a){return this.each(function(b){b.inst.enable(b.node,a)})});u.Api.register(["buttons().disable()",
"button().disable()"],function(){return this.each(function(a){a.inst.disable(a.node)})});u.Api.register("button().index()",function(){var a=null;this.each(function(b){b=b.inst.index(b.node);null!==b&&(a=b)});return a});u.Api.registerPlural("buttons().nodes()","button().node()",function(){var a=f();f(this.each(function(b){a=a.add(b.inst.node(b.node))}));return a});u.Api.registerPlural("buttons().processing()","button().processing()",function(a){return a===q?this.map(function(b){return b.inst.processing(b.node)}):
this.each(function(b){b.inst.processing(b.node,a)})});u.Api.registerPlural("buttons().text()","button().text()",function(a){return a===q?this.map(function(b){return b.inst.text(b.node)}):this.each(function(b){b.inst.text(b.node,a)})});u.Api.registerPlural("buttons().trigger()","button().trigger()",function(){return this.each(function(a){a.inst.node(a.node).trigger("click")})});u.Api.register("button().popover()",function(a,b){return this.map(function(c){return c.inst._popover(a,this.button(this[0].node),
b)})});u.Api.register("buttons().containers()",function(){var a=f(),b=this._groupSelector;this.iterator(!0,"table",function(c){if(c._buttons){c=w.instanceSelector(b,c._buttons);for(var d=0,h=c.length;d<h;d++)a=a.add(c[d].container())}});return a});u.Api.register("buttons().container()",function(){return this.containers().eq(0)});u.Api.register("button().add()",function(a,b,c){var d=this.context;d.length&&(d=w.instanceSelector(this._groupSelector,d[0]._buttons),d.length&&d[0].add(b,a,c));return this.button(this._groupSelector,
a)});u.Api.register("buttons().destroy()",function(){this.pluck("inst").unique().each(function(a){a.destroy()});return this});u.Api.registerPlural("buttons().remove()","buttons().remove()",function(){this.each(function(a){a.inst.remove(a.node)});return this});var H;u.Api.register("buttons.info()",function(a,b,c){var d=this;if(!1===a)return this.off("destroy.btn-info"),J(f("#datatables_buttons_info"),400,function(){f(this).remove()}),clearTimeout(H),H=null,this;H&&clearTimeout(H);f("#datatables_buttons_info").length&&
f("#datatables_buttons_info").remove();a=a?"<h2>"+a+"</h2>":"";I(f('<div id="datatables_buttons_info" class="dt-button-info"/>').html(a).append(f("<div/>")["string"===typeof b?"html":"append"](b)).css("display","none").appendTo("body"));c!==q&&0!==c&&(H=setTimeout(function(){d.buttons.info(!1)},c));this.on("destroy.btn-info",function(){d.buttons.info(!1)});return this});u.Api.register("buttons.exportData()",function(a){if(this.context.length)return Q(new u.Api(this.context[0]),a)});u.Api.register("buttons.exportInfo()",
function(a){a||(a={});var b=a;var c="*"===b.filename&&"*"!==b.title&&b.title!==q&&null!==b.title&&""!==b.title?b.title:b.filename;"function"===typeof c&&(c=c());c===q||null===c?c=null:(-1!==c.indexOf("*")&&(c=c.replace("*",f("head > title").text()).trim()),c=c.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,""),(b=K(b.extension))||(b=""),c+=b);b=K(a.title);b=null===b?null:-1!==b.indexOf("*")?b.replace("*",f("head > title").text()||"Exported data"):b;return{filename:c,title:b,messageTop:N(this,a.message||
a.messageTop,"top"),messageBottom:N(this,a.messageBottom,"bottom")}});var K=function(a){return null===a||a===q?null:"function"===typeof a?a():a},N=function(a,b,c){b=K(b);if(null===b)return null;a=f("caption",a.table().container()).eq(0);return"*"===b?a.css("caption-side")!==c?null:a.length?a.text():"":b},M=f("<textarea/>")[0],Q=function(a,b){var c=f.extend(!0,{},{rows:null,columns:"",modifier:{search:"applied",order:"applied"},orthogonal:"display",stripHtml:!0,stripNewlines:!0,decodeEntities:!0,trim:!0,
format:{header:function(p){return w.stripData(p,c)},footer:function(p){return w.stripData(p,c)},body:function(p){return w.stripData(p,c)}},customizeData:null},b);b=a.columns(c.columns).indexes().map(function(p){var x=a.column(p).header();return c.format.header(x.innerHTML,p,x)}).toArray();var d=a.table().footer()?a.columns(c.columns).indexes().map(function(p){var x=a.column(p).footer();return c.format.footer(x?x.innerHTML:"",p,x)}).toArray():null,h=f.extend({},c.modifier);a.select&&"function"===typeof a.select.info&&
h.selected===q&&a.rows(c.rows,f.extend({selected:!0},h)).any()&&f.extend(h,{selected:!0});h=a.rows(c.rows,h).indexes().toArray();var e=a.cells(h,c.columns);h=e.render(c.orthogonal).toArray();e=e.nodes().toArray();for(var g=b.length,m=[],k=0,t=0,r=0<g?h.length/g:0;t<r;t++){for(var n=[g],l=0;l<g;l++)n[l]=c.format.body(h[k],t,l,e[k]),k++;m[t]=n}b={header:b,footer:d,body:m};c.customizeData&&c.customizeData(b);return b};f.fn.dataTable.Buttons=w;f.fn.DataTable.Buttons=w;f(z).on("init.dt plugin-init.dt",
function(a,b){"dt"===a.namespace&&(a=b.oInit.buttons||u.defaults.buttons)&&!b._buttons&&(new w(b,a)).container()});u.ext.feature.push({fnInit:L,cFeature:"B"});u.ext.features&&u.ext.features.register("buttons",L);return w});