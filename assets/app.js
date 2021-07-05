import './styles/app.css';
import './bootstrap';
var $ = require("jquery");
require ("select2");
alert("hello");
$('select').select2();
$('.contacter').click(e=>
    {
        e.preventDefault();
      $('#contact').slideUp();
    }
);
