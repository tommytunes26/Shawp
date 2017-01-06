$('#prompt').click(function (){
    
    var modal = bootbox.dialog({
        
        message: $(".form-content").html(),
        title: "Enter password to continue:",
        buttons: [
          {
            label: "Submit",
            className: "btn btn-primary pull-right",
            callback: function() {
              var form = modal.find(".form");
              var items = form.serializeJSON();
              
              console.log(items);
              
//              if ('#user' == user) && ('#pass' == pass) {
//                // Make your data save as async and then just call modal.modal("hide");
//              } else {
//                // Show some errors, etc on form
//              }
//              */
//              
              return false;
            }
          },
          {
            label: "Close",
            className: "btn btn-default pull-right",
            callback: function() {
              console.log("closed");
            }
          }
        ],
        show: false,
        onEscape: function() {
          modal.modal("hide");
        }
    });
    
    modal.modal("show");
  });
  
  jQuery.fn.serializeJSON = function() {
    var json = {};

    jQuery.map(jQuery(this).serializeArray(), function(n) {
      var _ = n.name.indexOf('[');

      if (_ > -1) {
        var o = json, _name;

        _name = n.name.replace(/\]/gi, '').split('[');

        for (var i = 0, len = _name.length; i < len; i++) {
          if (i == len - 1) {
            if (o[_name[i]]) {
              if (typeof o[_name[i]] == 'string') {
                  o[_name[i]] = [o[_name[i]]];
              }
              
              o[_name[i]].push(n.value);
            } else {
              o[_name[i]] = n.value || '';
            }
          } else {
              o = o[_name[i]] = o[_name[i]] || {};
          }
        }
      } else if (json[n.name] !== undefined) {
        if (!json[n.name].push) {
            json[n.name] = [json[n.name]];
        }

        json[n.name].push(n.value || '');
      } else {
          json[n.name] = n.value || '';
      }
    });

    return json;
  };
});
