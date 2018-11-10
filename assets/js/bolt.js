"use strict";

/**
 * Vue Core | Config
 */
import "./filters";

// import './registerServiceWorker'

/**
 * Bootstrap Javascript
 */
import "bootstrap";

/**
 * Load Axios
 */
import axios from './helpers/axios'
/**
* Load jQuery
*/
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

/**
 * Vue Apps
 */
import "./Views/editor";
import "./Views/user";

import "./app/notifications";
import "./app/toolbar";
import "./app/sidebar";
import "./app/title";
import "./app/listing";

/**
 * Styling
 */
import "../scss/bolt.scss";