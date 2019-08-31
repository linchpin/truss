import jquery from 'jquery';
import whatInput from 'what-input';
import Foundation from 'foundation-sites';
import site from './site'
import navigation from './navigation'
import meshAnchorBar from "./mesh-anchor-bar";

// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

jquery( function() {
    site();
    navigation();
    meshAnchorBar();
});
