'use strict';

const React = require('react');
const ReactDOM = require('react-dom');
const ExampleComponent = require('./components/example.jsx');

var (#plugin_namespace#) = {};

(#plugin_namespace#).App = class {
    constructor()
    {
        ReactDOM.render(
          <ExampleComponent />,
          document.getElementById('example-component')
        );
    }
}

new (#plugin_namespace#).App();

