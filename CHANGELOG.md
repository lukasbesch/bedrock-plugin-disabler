# Changelog

#### 1.4.0
- Fix [#15](https://github.com/lukasbesch/bedrock-plugin-disabler/issues/15): Register activation hook only if not installed as mu-plugin. It prevented WP-CLI from running successfully. Thanks [@GiladEhven](https://github.com/GiladEhven) for reporting.

#### 1.3.1
- Dependencies: Remove `composer.lock` from repository (no dependencies except `composer/installers`).

#### 1.3.0
- Dependencies: Support composer 2 (fixes [#14](https://github.com/lukasbesch/bedrock-plugin-disabler/issues/14) – thanks [jacklowrie](https://github.com/jacklowrie))

#### 1.2.1
- CI: Build on PHP 7.4, 8.0, 8.1

#### 1.2.0
 - Enhancement: [#1](https://github.com/lukasbesch/bedrock-plugin-disabler/pull/1) Load `DISABLED_PLUGINS` constant in `muplugins_loaded` action hook. [@ethanclevenger91](https://github.com/ethanclevenger91)
 - Fix: [#7](https://github.com/lukasbesch/bedrock-plugin-disabler/pull/7) Use realpath to fix backslash in MU plugin dir on Windows. [@ikiselev1989](https://github.com/ikiselev1989)

#### 1.1.0

#### 1.0.1

#### 1.0.0
 - Initial Release
