'use strict';
const Generator = require('yeoman-generator');
const chalk = require('chalk');
const yosay = require('yosay');

module.exports = class extends Generator {
  async prompting() {
    // Have Yeoman greet the user.
    this.log(`Welcome to the unreal ${chalk.red('generator-linchpin')} generator!`);

    this.answers = await this.prompt([
      {
        type: 'input',
        name: 'theme_name',
        message: 'Theme name',
        default: 'Linchpin Truss'
      },
      {
        type: 'input',
        name: 'theme_description',
        message: 'Theme description',
        default: 'WordPress theme built on Linchpin Truss Yeoman scaffold'
      },
      {
        type: 'input',
        name: 'theme_url',
        message: 'Theme URL',
        default: ''
      },
      {
        type: 'input',
        name: 'theme_version',
        message: 'Theme Version',
        default: '1.0.0'
      },
      {
        type: 'input',
        name: 'theme_author',
        message: 'Theme Author',
        default: 'Linchpin'
      },
      {
        type: 'input',
        name: 'theme_author_uri',
        message: 'Theme Author URL',
        default: 'http://linchpin.com'
      }
    ]);

    this.class_name = await this.prompt([
      {
        type: 'input',
        name: 'class_name',
        message: 'Package/Class Name',
        default: this.answers.theme_name.replace(/\s/g, '')
      }
    ]);

    this.domainprefix = await this.prompt([
      {
        type: 'input',
        name: 'text_domain',
        message: 'Text Domain',
        default: this.class_name.class_name.replace(' ', '').toLowerCase()
      },
      {
        type: 'input',
        name: 'prefix',
        message: 'PHP and JavaScript function prefix',
        default: this.class_name.class_name.replace(' ', '').toLowerCase() + '_'
      }
    ]);
  }

  writing() {
    this.fs.copyTpl(this.templatePath('**/*'), this.destinationPath(), {
      theme_name: this.answers.theme_name,
      theme_description: this.answers.theme_description,
      theme_url: this.answers.theme_url,
      theme_version: this.answers.theme_version,
      theme_author: this.answers.theme_author,
      theme_author_uri: this.answers.theme_author_uri,
      class_name: this.class_name.class_name,
      text_domain: this.domainprefix.text_domain,
      prefix: this.domainprefix.prefix,
      prefix_caps: this.domainprefix.prefix.toUpperCase()
    });
  }

  install() {
    this.log(`Run ${chalk.red('npm')} or ${chalk.red('yarn')} install`);
  }
};
