     </div> <!- content ->";

<div id="pageFooter">
  <div class="uim first last" id="defaultFooter">
    <div class="bd">
      <div class="uic small first"> 
        <a class="inline" href="set_my_location.php"> <span><?php if (empty($_COOKIE['current_location'])) echo "Set My Location"; else echo "Current Location: " . $_COOKIE['current_location']; ?> </span> </a> 
      </div>
<?php
      if (!empty($user_id))
      
         echo "<div class=\"uic small\"> 
            <a class=\"inline\" href=\"settings.php\"> <span>Settings </span> </a> 
          </div>";
?>
      <div class="uic small"> 
<?php
        if (tep_session_is_registered('user_id'))
           echo "<a class=\"inline\" href=\"logoff.php?redirect_url=index.php\"> <span>Log Off</span> </a>\n";
        else
           echo "<a class=\"inline\" href=\"index.php?tab=3\"> <span>Log In</span> </a>\n";
?>
        <span> | </span>
        <a class="inline" href="privacy.php"><span>Privacy</span></a> 
        <span> | </span> 
        <a class="inline" href="legal.php"><span>Legal </span></a> 
      </div>
      <div class="uic small last"> © 2010 Bring Savings To Me! - All rights reserved </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">Bp.Script = Bp.Script || {};(function(){Bp.get_script=function(){var a=arguments;return function(){for(var b=0;b<a.length;b++){a[b].call()}}}})();;(function(){Bp.EvHistory=Bp.EvHistory||{};Bp.assign_script=function(g,e,j,i,c){var f=Bp.get(g);if(typeof e!=="function"&&typeof j!=="function"&&typeof i!=="function"){return}var h=function(k){Bp.preventDefault(k);if(!c){Bp.stopPropagation(k)}if(typeof Bp.EvHistory[g]==="undefined"){if(typeof j==="function"){j.call()}Bp.EvHistory[g]="ac"}else{if(typeof i==="function"){i.call()}}if(typeof e==="function"){e.call()}};if(f){if(f.tagName=="DIV"&&f.className=="formField trigger"){var d=f.parentNode;while(d.tagName!="FORM"&&d.parentNode){d=d.parentNode}var b=d.getAttribute("action");var a=d.getAttribute("method");Bp.on(d,"submit",h)}else{if(f.tagName=="A"||f.tagName=="TD"||f.tagName=="TR"||f.tagName=="DIV"){if(f.tagName=="A"&&f.parentNode.tagName=="BUTTON"){Bp.on(f.parentNode,"click",h)}else{Bp.on(f,"click",h)}if(Bp.env.Apple&&f.tagName=="A"){f.removeAttribute("href")}}}}}})();;(function(){Bp.Timers=Bp.Timers||{};Bp.TimersNN=Bp.TimersNN||[];Bp.Timer=function(d,a,b,c){if(d){Bp.Timers[d]=this}else{Bp.TimersNN.push(this)}this._acts=b;this._inter=a*1000;if(c){this.startTimer()}};Bp.Timer.prototype={startTimer:function(){if(!this._active){this._uid=setInterval(this._acts,this._inter)}this._active=true},stopTimer:function(){if(this._active){clearInterval(this._uid)}this._active=false;this._enbl=false}}})();;Bp.PageTabs=function(b){this._tabs=Bp.get(b);Bp.on(this._tabs,"click",this._handleChange,this);(new Image()).src="http://l.yimg.com/a/i/w/go/web/spinner-1.0.0.gif";if(typeof(Bp.TabsSettings)!=="undefined"&&Bp.TabsSettings._sendTabs.length>0){for(var a=0;a
<Bp.TabsSettings._sendTabs.length;a++){if(Bp.TabsSettings._sendTabs[a].event=="first-activate"){var c=Bp.get("case-"+Bp.TabsSettings._sendTabs[a].id.substring(0,Bp.TabsSettings._sendTabs[a].id.length-4));c.firstChild.innerHTML="<div class='loading-spinner'>
<img src='http://l.yimg.com/a/i/w/go/web/spinner-1.0.0.gif' alt='' /></div>"}}}};Bp.PageTabs.prototype={_tabs:null,_handleChange:function(d){if(d.target.tagName!="A"&&d.target.tagName!="SPAN"){return}var c=d.target;while(c.tagName!="TD"&&c.parentNode){c=c.parentNode}if(Bp.dom.hasClass(c,"pageTab")&&!Bp.dom.hasClass(c,"ptactive")){var b=c.parentNode.getElementsByTagName("td");for(var a=0;a<b.length;a++){if(c==b[a]){Bp.dom.addClass(b[a],"ptactive")}else{Bp.dom.removeClass(b[a],"ptactive")}}}else{if(Bp.dom.hasClass(c,"tabLink")&&!Bp.dom.hasClass(c,"active")){var b=c.parentNode.getElementsByTagName("td");for(var a=0;a<b.length;a++){if(c==b[a]){Bp.dom.addClass(b[a],"active")}else{Bp.dom.removeClass(b[a],"active")}}}}}};;new Bp.PageTabs( 'pageTabs' );Bp.DefaultInput=function(a){this._el=Bp.get(a);if(arguments.length>1){this._dt=arguments[1]}else{this._dt=this._el.getAttribute("placeholder")}this._blur();Bp.on(this._el,"blur",this._blur,this);Bp.on(this._el,"focus",this._focus,this);var c=this._el.parentNode;while(c.tagName!="FORM"&&c.parentNode){c=c.parentNode}var b=Bp.DefaultInputForm.GetInstance(c);b.addInput(this)};Bp.DefaultInput.prototype={_el:null,_dt:null,_dClass:"disabled",_blur:function(){if(this._el.value==""||this.isDefault()){this._el.value=this._dt;Bp.dom.addClass(this._el,this._dClass)}},_focus:function(){if(this._el.value==""||this.isDefault()){this.blank();Bp.dom.removeClass(this._el,this._dClass)}},isDefault:function(){return this._el.value==this._dt},blank:function(){this._el.value=""}};Bp.DefaultInputForm=function(a){this._formEl=a;this._defaultInputs=[];Bp.on(this._formEl,"submit",this._onSubmit,this);this._formEl.defaultInputForm=this};Bp.DefaultInputForm.prototype={_defaultInputs:null,_formEl:null,_onSubmit:function(b){if(this._defaultInputs.length==0){return}for(var a=0;a<this._defaultInputs.length;a++){if(this._defaultInputs[a].isDefault()){this._defaultInputs[a].blank()}}},addInput:function(a){if(typeof(a)=="object"){this._defaultInputs.push(a)}}};Bp.DefaultInputForm.GetInstance=function(a){a=Bp.get(a);if(typeof(a.defaultInputForm)!="undefined"){return a.defaultInputForm}return new Bp.DefaultInputForm(a)};;new Bp.DefaultInput( 'input-9' );Bp.Tabs=function(b){this._container=Bp.get(b.id);this._id=b.id;var d=this._container.firstChild.getElementsByTagName("td");this._tabs=[];this._tabContents=[];for(var a=0;a<d.length;a++){if(!d[a].id){continue}var c=d[a].id.split("-");this._tabs.push(d[a]);this._tabContents.push(Bp.get(c.slice(0,c.length-2).join("-")+"-tab-content-"+this._id))}Bp.on(this._container.firstChild,"click",this._tabChange,this)};Bp.Tabs.prototype={_id:"",_container:null,_tabs:null,_tabContents:null,_tabChange:function(g){var b=g.target;while(b.parentNode&&b.tagName!="TD"){b=b.parentNode}var f=b.getElementsByTagName("a");if(f&&f[0].getAttribute("x-bp-load-page")=="true"){return}Bp.preventDefault(g);var h=this._container.firstChild.getElementsByTagName("td"),a=0;for(var c=0;c<h.length;c++){if(!Bp.dom.hasClass(h[c],"tabLink")){continue}if(h[c]==b){a=c;Bp.dom.addClass(h[c],"active")}else{Bp.dom.removeClass(h[c],"active")}}var d=this._container.lastChild.firstChild,c=0;while(d){if(c==a){Bp.dom.addClass(d,"tabSectionShown")}else{Bp.dom.removeClass(d,"tabSectionShown")}c++;d=d.nextSibling}}};;new Bp.Tabs({ id: 'tabs-19' });</script></body></html>
