zimmerApp.directive('stickyFooter', ['$timeout', '$window',
    function ($timeout, $window) {
        return {
            restrict: 'A',
            link: function (scope, iElement, iAttrs) {


                var stickyFooterWrapper = iAttrs.stickyFooter;

                // Quite often you will occur a few wrapping `<div>`s in the
                // top level of your DOM, so we need to set the height
                // to be 100% on each of those. This will also set it on
                // the `<html>` and `<body>`.

                stickyFooterWrapper.parents().css('height', '100%');
                stickyFooterWrapper.css({
                    'min-height': '100%',
                    'height': 'auto'
                });

                // Append a pushing div to the stickyFooterWrapper.
                var stickyFooterPush = $('<div class="push"></div>');
                stickyFooterWrapper.append(stickyFooterPush);

                var setHeights = function () {
                    var height = iElement.outerHeight();
                    stickyFooterPush.height(height);
                    stickyFooterWrapper.css('margin-bottom', -(height));
                };

                $timeout(setHeights, 0);
                $window.on('resize', setHeights);
            }
        };
    }
]);

/**
 * Directive for capitalization letters in input
 */
zimmerApp.directive('capitalize', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, modelCtrl) {
            var capitalize = function (inputValue) {
                if (inputValue == undefined) inputValue = '';
                var capitalized = inputValue.toUpperCase();
                if (capitalized !== inputValue) {
                    modelCtrl.$setViewValue(capitalized);
                    modelCtrl.$render();
                }
                return capitalized;
            };
            modelCtrl.$parsers.push(capitalize);
            capitalize(scope[attrs.ngModel]);
        }
    };
});