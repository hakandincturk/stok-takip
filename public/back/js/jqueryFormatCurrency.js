jQuery.fn.ForceNumericOnly=function(){return this.each(function(){$(this).keydown(function(n){var e=n.charCode||n.keyCode||0;return 8==e||9==e||13==e||46==e||110==e||190==e||e>=35&&e<=40||e>=48&&e<=57||e>=96&&e<=105})})};
