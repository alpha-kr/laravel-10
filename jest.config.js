// jest.config.js

module.exports = {
    "testEnvironment": "jsdom",
    moduleFileExtensions: [
      'js',
      'json',
      'vue',
      'ts'
    ],
    'transform': {
      '^.+\\.js$': '<rootDir>/node_modules/babel-jest',
      '.*\\.(vue)$': '@vue/vue3-jest',
    },
  }
