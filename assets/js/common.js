  function createObject() {
    
    var request_type;

    if (window.XMLHttpRequest){

      request_type=new XMLHttpRequest();
    }
    else{

      request_type=new ActiveXObject("Microsoft.XMLHTTP");
    }

    return request_type;
  }

  var http = createObject();