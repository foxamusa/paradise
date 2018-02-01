jQuery(document).ready(function(e){function t(e){return/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(e)}function a(t){t.find("label").length<1&&e('.button[data-property="label"]').hide(),t.find("p").length<1&&e('.button[data-property="p"]').hide(),t.find("fieldset").length<1&&e('.button[data-property="fieldset"]').hide(),t.find("select").length<1&&e('.button[data-property="select"]').hide(),t.find('input[type="checkbox"]').length<1&&e('.button[data-property="checkbox"]').hide(),t.find('input[type="radio"]').length<1&&e('.button[data-property="radio"]').hide()}function n(e,t){"valid"==t?e.css("border-color","#ddd"):e.css("border-color","red")}function i(t){e(".google-fontos").remove(),"none"!=t&&void 0!==t&&(e("head").append('<link class="google-fontos" rel="stylesheet" href="https://fonts.googleapis.com/css?family='+t+':100,200,300,400,500,600,700,800,900&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese" />'),e(".cf7-style.preview-zone p").css("font-family","'"+t+"', sans-serif"),e(".preview-form-container .wpcf7").css("font-family","'"+t+"', sans-serif"))}function r(){e("input[type='number']").on("change",function(){var t=e(this),a=t.val(),n=t.parent().index(),i=t.parent().parent().find("input[type=number]");switch(n){case 1:i.each(function(){parseFloat(e(this).attr("step"))==parseFloat(t.attr("step"))&&e(this).val(a)});break;case 2:parseFloat(i.eq(3).attr("step"))==parseFloat(t.attr("step"))&&i.eq(3).val(a)}})}function l(t){if(e('input[name="cf7styleallvalues"]').length>0){var a=e('input[name="cf7styleallvalues"]').val(),n=e.parseJSON(a.replace(/'/g,'"'));e(".place-style").remove(),e.each(n,function(a,i){if(a.indexOf("unit")<0&&("hover"==t&&a.indexOf("hover")>0||"hover"!=t&&a.indexOf("hover")<0)){var r=a.split("_"),l=r[0],s="hover"==t&&a.indexOf("hover")>0?n[a.replace("hover","")+"unit_hover"]:n[a+"_unit"];if("placeholder"==r[0]&&""!=i){var o=i+(s=void 0===s||""==i?"":s),c=e("<style>").attr("class","place-style");return c.text(".preview-form-container ::-webkit-input-placeholder { "+r[1]+": "+o+";}.preview-form-container ::-moz-placeholder { "+r[1]+": "+o+";}.preview-form-container :-ms-input-placeholder { "+r[1]+": "+o+";}.preview-form-container :-moz-placeholder { "+r[1]+": "+o+";}"),void c.appendTo("head")}"submit"==r[0]&&(l="input[type='submit']"),"form"==r[0]&&(l=".wpcf7"),"wpcf7-not-valid-tip"!=r[0]&&"wpcf7-validation-errors"!=r[0]&&"wpcf7-mail-sent-ok"!=r[0]||(l="."+r[0]);o=i+(s=void 0===s||""==i?"":s);"background-image"==r[1]&&(o="url("+i+")"),e(".preview-form-container "+(l="radio"==l?'input[type="radio"]':"checkbox"==l?'input[type="checkbox"]':l)).css(r[1],o)}})}}function s(t,a,n,i){var r=t.find(".active").index()+1,l=t.find("li"),s=t.find("ul"),o=t.find(".narrow"),c=t.find(".narrow.left"),p=t.find(".narrow.right"),d=t.find("li").length;p.addClass("visible"),s.css("width",d*a),0==i&&t.mouseenter(function(){t.find(".visible").stop().show()}).mouseleave(function(){t.find(".visible").stop().hide()}),o.on("click",function(t){t.stopPropagation(),t.preventDefault();var i=e(this).attr("data-direction");"left"==i&&1!==r&&(s.stop(!0,!0).animate({marginLeft:"+="+a+"px"},n),r--),"right"==i&&r!==d&&(s.stop(!0,!0).animate({marginLeft:-a*r+"px"},n),r++),1==r&&(c.hide().removeClass("visible"),p.show().addClass("visible")),r==d&&p.hide().removeClass("visible"),r<d&&p.show().addClass("visible"),r>1&&c.show().addClass("visible"),l.removeClass("active").eq(r-1).addClass("active")}),s.css({"margin-left":"-"+(r-1)*a+"px"})}function o(t){var a="",n=e.parseJSON(e('input[name="cf7styleallvalues"]').val().replace(/'/g,'"'));e.each(t.serializeObject(),function(e,t){0==n.length&&(n={}),n[e.replace(/cf7stylecustom\[/g,"").replace(/]/g,"")]=t}),a=(a=JSON.stringify(n)).replace(/cf7stylecustom\[/g,"").replace(/]/g,"").replace(/"/g,"'"),e('input[name="cf7styleallvalues"]').val(a),e('input[name="cf7styleallvalues"]').attr("value",a)}function c(){e('.wpcf7 input[aria-required="true"]').each(function(){e('<span role="alert" class="wpcf7-not-valid-tip">Required field message example.</span>').insertAfter(e(this))}),e(".wpcf7").each(function(){e('<div class="wpcf7-response-output wpcf7-display-none wpcf7-validation-errors" style="display: block;" role="alert">Error message example.</div>').appendTo(e(this)),e('<div class="wpcf7-response-output wpcf7-display-none wpcf7-mail-sent-ok" style="display: block;" role="alert">Thank you message example.</div>').appendTo(e(this))})}function p(){var t=e(".cf7-style-upload-field");t.addClass("hidden"),t.each(function(){var t=e(this);e('<span class="image-info-box"></span>').insertAfter(t),""!=t.val()&&t.parent().find(".image-info-box").text(t.val().filename("yes"))}),e(".upload-btn").length<=0&&(e("<a href='javascript: void(0);' class='remove-btn button'>Remove</a>").insertAfter(t),e("<a href='javascript: void(0);' class='upload-btn button'>Upload</a>").insertAfter(t)),e(".upload-btn").on("click",function(){var t=e(this),a=t.parent().find(".cf7-style-upload-field");tb_show("New Banner","media-upload.php?type=image&TB_iframe=1"),window.send_to_editor=function(n){a.val(e(n).attr("src")),a.trigger("change"),t.parent().find(".image-info-box").text(e(n).attr("src").filename("yes")),tb_remove()}}),e(".remove-btn").on("click",function(){var t=e(this),a=t.parent().find(".cf7-style-upload-field");a.val(" "),a.attr("value"," "),a.trigger("change"),t.parent().find(".image-info-box").text("")})}function d(){e(".wp-picker-container").each(function(){e(this).parent().find('label[for*="_color"]').length<1&&e('<label><input type="checkbox" class="transparent-box" name="transparent-box">Transparent</label>').insertAfter(e(this))}),e(".transparent-box").each(function(){"transparent"==e(this).parent().parent().find(".cf7-style-color-field").val()&&e(this).prop("checked",!0)}),e(".transparent-box").on("click",function(){var t=e(this).parent().parent();e(this).is(":checked")?(t.find(".cf7-style-color-field").val("transparent"),t.find(".cf7-style-color-field").attr("value","transparent"),t.find(".wp-color-result").css("background-color","transparent")):(t.find(".cf7-style-color-field").val(""),t.find(".cf7-style-color-field").attr("value","")),o(e(this).parents(".panel").find('[name^="cf7stylecustom"]'))})}function u(e){return"%"==e.val()||"em"==e.val()?"0.01":"1"}function f(){e('.panel input[type="number"]:not([id*="opacity"])').each(function(){var t=e(this);t.attr("step",u(t.next()))}),e('.panel select[name*="unit"]').off("change").on("change",function(){var t=e(this);if(t.prev().attr("step",u(t)),"px"==t.val()){var a=Math.floor(t.prev().val());t.prev().val(a),t.prev().attr("value",a)}})}var h=e(".cf7style-name"),v=e(".cf7style-email"),m=e(".cf7style-message"),F=e(".cf7style-status-submit");F.on("click",function(a){if(a.preventDefault(),e(".cf7style-input").each(function(t,a){""==e(this).val()?n(e(this),"error"):n(e(this),"valid")}),""!==h.val()&&""!==v.val())if(t(v.val())){n(v,"valid");var i=e("<div />");e(".cf7style-status-table").each(function(t,a){var n=e("<table />");n.html(e(this).html()),i.append(n)}),e.ajax({url:ajaxurl,method:"POST",data:{action:"cf7_style_send_status_report",name:h.val(),email:v.val(),message:m.val(),report:i.html()},beforeSend:function(){F.text("Sending...")},success:function(t){"success"==e.trim(t)?F.text("Report sent").removeClass("cf7style-status-submit").attr("disabled","disabled"):F.text("Something went wrong!").removeClass("cf7style-status-submit").attr("disabled","disabled")}})}else n(v,"error");else console.log("error 1")}),e(".cf7style-status-info").on("click",function(t){t.preventDefault(),e(".cf7style-status-table").toggle()}),String.prototype.filename=function(e){var t=this.replace(/\\/g,"/");return t=t.substring(t.lastIndexOf("/")+1),e?t.replace(/[?#].+$/,""):t.split(".")[0]},e.fn.serializeObject=function(){var t={},a=this.serializeArray();return e.each(a,function(){void 0!==t[this.name]?(t[this.name].push||(t[this.name]=[t[this.name]]),t[this.name].push(this.value||"")):t[this.name]=this.value||""}),t},e(".cf7style-no-forms-added").length>0?e(".generate-preview-button, .generate-preview-option").show():e(".generate-button-hidden").show(),e(".generate-preview-button").on("click",function(t){t.preventDefault(),e(".cf7style-no-forms-added").hide();var n=e(this).attr("data-attr-id"),i=e(this).attr("data-attr-title");e(this).prop("disabled",!0),e(this).parents("tr").find("input").prop("checked",!0);var r=e("<p />");e(".preview-form-tag").prepend(r),e.ajax({url:ajaxurl,method:"POST",data:{action:"cf7_style_generate_preview_dashboard",form_id:n,form_title:i},beforeSend:function(){r.text("Loading..."),e(".multiple-form-generated-preview").hide()},success:function(t){t&&(r.remove(),e(".preview-form-tag").append(t),e(".multiple-form-generated-preview").eq(e(".multiple-form-generated-preview").length-1).show(),l(),c(),a(e(".preview-form-container form:visible")))}})});var y=e(".generate-preview"),b=e(".post-type-cf7_style"),g=e("#select_all"),w=e('select[name="cf7_style_font_selector"]'),x=e(".cf7-style-slider-wrap"),_=e(".preview-form-container"),k={change:function(t,a){var n=e(this);n.parents(".wp-picker-container").parent().find(".transparent-box").prop("checked",!1),setTimeout(function(){o(n.parents(".panel").find('[name^="cf7stylecustom"]'))},0),"hover"==e('input[name="element-type"]:checked').val()?l("hover"):l()}};if(e(".cf7-style-color-field").wpColorPicker(k),y.length>0&&function(t){e(window).scroll(function(){if(e(window).width()>1600){t.find(".panel-header").offset();var a=e("#cf7_style_meta_box_style_customizer").offset(),n=e(window).scrollTop()-a.top;n>0&&t.find(".panel-header").css("top",n),n<=0&&t.find(".panel-header").css("top",0)}e(window).scrollTop()>700?e(".fixed-save-style").show():e(".fixed-save-style").hide()}).trigger("scroll")}(y),b.length>0){e("#cf7_style_manual_style").length>0&&CodeMirror.fromTextArea(document.getElementById("cf7_style_manual_style"),{lineNumbers:!0,theme:"default",mode:"text/css"}),p(),r(),c();_=e(".preview-form-container").not(".hidden");e(".post-new-php").length<1&&a(_),g.on("click",function(){e(".cf7style_body_select_all input").prop("checked",!!e(this).is(":checked"))}),i(w.val()),w.on("change",function(){i(e(this).val())}),function(){l(),e("#form-tag a.button").on("click",function(t){t.preventDefault();var a=e(this),n=e("."+a.attr("data-property")+"-panel"),i=0;0==e(".modified-style-here").length?(a.hasClass("button-primary")||(e(".panel").stop(!0,!0).animate({opacity:0},300,function(){0===i&&(i++,e(".panel").addClass("hidden"),e(".panel").html(""),n.css("opacity","0"),n.removeClass("hidden"),e.ajax({url:ajaxurl,method:"POST",data:{action:"cf7_style_load_property",property:a.attr("data-property")},beforeSend:function(){a.parent().find("a").prop("disabled","true"),e(".panel-options .loading").removeClass("hidden")},success:function(t){a.parent().find("a").prop("disabled","false"),i=0,n.html(t),e(".panel-options .loading").addClass("hidden");var l=e('input[name="cf7styleallvalues"]').val(),s=e.parseJSON(l.replace(/'/g,'"'));n.find('[name^="cf7stylecustom"]').each(function(){e(this).attr("id")in s&&""!=s[e(this).attr("id")]&&e(this).val(s[e(this).attr("id")])}),n.find(".cf7-style-color-field").wpColorPicker(k),r(),p(),n.stop(!0,!0).animate({opacity:1},300),d(),f()}}))}),e(".element-selector input:eq(0)").prop("checked",!0)),e("#form-tag a.button").removeClass("button-primary"),a.addClass("button-primary"),e('input[name="cf7styleactivepane"]').val(a.attr("data-property"))):e(".panel-options .decision").removeClass("hidden")}),e(".panel-options .cancel-btn").on("click",function(t){t.preventDefault(),e(".panel-options .decision").addClass("hidden")}),e(".element-selector input").on("change",function(){e(".element-selector input").prop("checked",!1),e(this).prop("checked",!0),"hover"==e(this).val()?(e(".panel:visible li").addClass("hidden"),e(".panel:visible li.hover-element").removeClass("hidden"),l("hover")):(e(".panel:visible li.hover-element").addClass("hidden"),e(".panel:visible li").not(".hover-element").removeClass("hidden"),l())}),e("#form-preview").on("change",function(){e(".preview-form-container").addClass("hidden"),e(".preview-form-container").eq(e(this).val()).removeClass("hidden")});var t=0;e(document).on("change",'[name^="cf7stylecustom"]',function(){0==t&&(t++,e(this).parents(".panel").addClass("modified-style-here")),o(e(this).parents(".panel").find('[name^="cf7stylecustom"]')),"hover"==e('input[name="element-type"]:checked').val()?l("hover"):l()}),e(document).on("keyup",'[name^="cf7stylecustom"]',function(){o(e(this).parents(".panel").find('[name^="cf7stylecustom"]')),"hover"==e('input[name="element-type"]:checked').val()?l("hover"):l()})}(),_.find('input[type="hidden"]').remove(),_.find('input[type="submit"]').on("click",function(e){e.preventDefault()})}x.length>0&&function(t){s(t,202,500,!0),t.find("li").on("click",function(){e(this).hasClass("current-saved")||(t.find("li").removeClass("current-saved"),e(this).addClass("current-saved"),t.find(".overlay em").html("Not Active"),e(this).find(".overlay em").html("Active"),e(".cf7style_template").removeAttr("checked"),e(this).find(".cf7style_template").attr("checked","checked"))})}(x),e(".close-cf7-panel").on("click",function(t){t.preventDefault(),e.ajax({url:ajaxurl,method:"POST",data:{action:"cf7_style_remove_welcome_box"},success:function(t){e(".welcome-container").fadeOut("slow")}})}),d(),f()});