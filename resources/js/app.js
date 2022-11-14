window['FLS'] = false;

import '../scss/style.scss';
import '../js/vue.js'
import * as flsFunctions from './files/functions.js';
import './libs/popup.js';
import * as flsForms from './files/forms/forms.js';
import './files/forms/inputmask.js';
import './files/sliders.js';
import './libs/watcher.js';
import * as flsScroll from './files/scroll/scroll.js';
import './files/gallery.js';
import './files/map.js';
import './files/script.js';

flsFunctions.isWebp();

flsFunctions.menuInit();

flsFunctions.fullVHfix();

flsFunctions.spollers();

flsForms.formFieldsInit();

flsScroll.pageNavigation();

flsScroll.headerScroll();
