var ComponentsTypeahead = function () {

    var handleTwitterTypeahead = function() {

        //owner name autosearch
      var mycustom3 = new Bloodhound({
          datumTokenizer: function(d) { return d.tokens; },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: {
            url: '../petvet/includes/autocomplete_privilege.php?query=%QUERY',
            wildcard: '%QUERY'
          }
        });

        mycustom3.initialize();

        if (App.isRTL()) {
          $('#search_input').attr("dir", "rtl");
        }
        $('#search_input').typeahead(null, {
          displayKey: 'value',
          source: mycustom3.ttAdapter(),
          hint: (App.isRTL() ? false : true)
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleTwitterTypeahead();
        }
    };

}();

jQuery(document).ready(function() {
   ComponentsTypeahead.init();
});