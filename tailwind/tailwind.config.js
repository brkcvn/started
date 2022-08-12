module.exports = {
    content: [],
    theme: {
      extend: {},
    },
    variants: {
        float: ['responsive', 'direction'],
        margin: ['responsive', 'direction'],
        padding: ['responsive', 'direction'],
    },
    plugins: [
        require('tailwindcss-dir')(),
    ],
  }