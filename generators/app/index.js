'use strict';
const TrussVersion = '1.0.0';
const Generator = require('yeoman-generator');
const chalk = require('chalk');
const yosay = require('yosay');
const fs    = require('fs');
const saved_config = (fs.existsSync('yo.truss.config.json')) ? JSON.parse(fs.readFileSync('yo.truss.config.json', 'utf8')) : false;

module.exports = class extends Generator {
    async prompting() {
        this.log(`\nStarting ${chalk.hex('#3fc1d0').bold('Linchpin')} Truss build`);

        this.default_answers = {
            'theme_name': 'Linchpin Truss',
            'theme_description': 'WordPress theme built on Linchpin Truss Yeoman scaffold',
            'theme_url': '',
            'theme_version': '1.0.0',
            'theme_author': 'Linchpin',
            'theme_author_uri': 'http://linchpin.com',
        };

        if ( saved_config && saved_config.settings.theme_name ) {
            this.log(`\n${chalk.hex('#3fc1d0').bold('Build found, loading previous settings.')}\n`);

            this.default_answers = {
                'theme_name': saved_config.settings.theme_name,
                'theme_description': saved_config.settings.theme_description,
                'theme_url': saved_config.settings.theme_url,
                'theme_version': saved_config.settings.theme_version,
                'theme_author': saved_config.settings.theme_author,
                'theme_author_uri': saved_config.settings.theme_author_uri,
            };
        }

        this.answers = await this.prompt([
            {
                type: 'input',
                name: 'theme_name',
                message: 'Theme name',
                default: this.default_answers.theme_name
            },
            {
                type: 'input',
                name: 'theme_description',
                message: 'Theme description',
                default: this.default_answers.theme_description
            },
            {
                type: 'input',
                name: 'theme_url',
                message: 'Theme URL',
                default: this.default_answers.theme_url
            },
            {
                type: 'input',
                name: 'theme_version',
                message: 'Theme Version',
                default: this.default_answers.theme_version
            },
            {
                type: 'input',
                name: 'theme_author',
                message: 'Theme Author',
                default: this.default_answers.theme_author
            },
            {
                type: 'input',
                name: 'theme_author_uri',
                message: 'Theme Author URL',
                default: this.default_answers.theme_author_uri
            }
        ]);

        if ( saved_config && saved_config.settings.theme_name ) {
            this.class_name = saved_config.settings.class_name;
        } else {
            this.class_name = this.answers.theme_name.replace(/\s/g, '');
        }

        this.class_name = await this.prompt([
            {
                type: 'input',
                name: 'class_name',
                message: 'Package/Class Name',
                default: this.answers.theme_name.replace(/\s/g, '')
            }
        ]);

        if ( saved_config && saved_config.settings.theme_name ) {
            this.text_domain = saved_config.settings.text_domain;
            this.prefix = saved_config.settings.prefix;
        } else {
            this.text_domain = this.class_name.class_name.replace(' ', '').toLowerCase();
            this.prefix = this.class_name.class_name.replace(' ', '').toLowerCase() + '_';
        }

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
        let DateToday = new Date();
        let dd = DateToday.getDate();
        let mm = DateToday.getMonth()+1;
        let yyyy = DateToday.getFullYear();
        let hour = DateToday.getHours();
        let minutes = DateToday.getMinutes();
        let seconds = DateToday.getSeconds();

        if( dd < 10 ) {
            dd = '0'+dd
        }

        if( mm < 10 ) {
            mm = '0'+mm
        }

        DateToday = mm + '/' + dd + '/' + yyyy + ' ' + hour + ':' + minutes + ':' + seconds;

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

        let config_opts = {
            "settings": {
              "theme_name": this.answers.theme_name,
              "theme_description": this.answers.theme_description,
              "theme_url": this.answers.theme_url,
              "theme_version": this.answers.theme_version,
              "theme_author": this.answers.theme_author,
              "theme_author_uri": this.answers.theme_author_uri,
              "class_name": this.class_name.class_name,
              "text_domain": this.domainprefix.text_domain,
              "prefix": this.domainprefix.prefix,
              "prefix_caps": this.domainprefix.prefix.toUpperCase(),
            },
            "additional": {
                "date_updated": DateToday,
                "last_generated_version": TrussVersion,
            },
        };

        config_opts = JSON.stringify(config_opts);

        this.fs.write('yo.truss.config.json', config_opts, (err) => {
            if (err) throw err;
        });
    }

    install() {
        this.log(`Run ${chalk.hex('#3fc1d0').bold('yarn install')}`);
    }
};
