import Vue from 'vue';

Vue.component('text-field', require('./components/Form/TextField').default);
Vue.component('textarea-field', require('./components/Form/TextareaField').default);
Vue.component('date-field', require('./components/Form/DateField').default);
Vue.component('select-field', require('./components/Form/SelectField').default);
Vue.component('tag-field', require('./components/Form/TagField').default);