import jquery from 'jquery';
import whatInput from 'what-input';
import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

let $ = jquery;

export default function site() {

    // Private Variables
    let $window  = $(window),
        $doc     = $(document),
        $body    = $('body'),
        $success = $('.gform_confirmation_message'),
        $error   = $('.gfield_description.validation_message');

    $doc.foundation();
}
