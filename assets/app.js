import './styles/app.scss';
import $ from 'jquery';
import 'popper.js';
import 'bootstrap';

$(".btn-remove-file").on("click", e => {
    console.log("ici");
    $(e.currentTarget.dataset.target).val('');
});