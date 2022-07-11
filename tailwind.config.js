const defaultTheme = require('tailwindcss/defaultTheme')
const _ = require('lodash')
const plugin = require('tailwindcss/plugin')

module.exports = {
  purge: {
    enabled: true,
    content: [
      './resources/js/**/*.vue',
      './resources/css/**/*.postcss',
    ],
  },
  theme: {
    gradients: theme => ({
      'yellow': [
        theme('colors.yellow.400'),
        theme('colors.yellow.500')
      ],
      'gray': [
        theme('colors.cool-gray.400'),
        theme('colors.cool-gray.500')
      ],
      'green': [
        theme('colors.green.400'),
        theme('colors.green.500')
      ],
      'blue': [
        theme('colors.blue.400'),
        theme('colors.blue.500')
      ],
    }),
    extend: {
      borderRadius: {
        'xl': '0.75rem'
      },
      maxWidth: {
        '64': '16rem',
        '32': '8rem',
        '16': '4rem',
      },
      maxHeight: {
        '64': '16rem',
        '32': '8rem',
        '16': '4rem',
      },
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
      scale: {
        '102': '1.02'
      },
      colors: {
        'gray': {
          '50': '#fbfdfe',
          '100': '#f1f5f9',
          '200': '#e2e8f0',
          '300': '#cfd8e3',
          '400': '#97a6ba',
          '500': '#64748b',
          '600': '#475569',
          '700': '#364152',
          '800': '#27303f',
          '900': '#1a202e',
        },
        'blue': {
          100: '#E8F0FB',
          200: '#C5D9F5',
          300: '#A2C1EF',
          400: '#5C93E4',
          500: '#1665D8',
          600: '#145BC2',
          700: '#0D3D82',
          800: '#0A2D61',
          900: '#071E41',
        },
        'green': {
          100: '#EBF7EC',
          200: '#CCEAD0',
          300: '#AEDDB4',
          400: '#71C47C',
          500: '#34AA44',
          600: '#2F993D',
          700: '#1F6629',
          800: '#174D1F',
          900: '#103314',
        },
        'indigo': {
          100: '#F0EEFE',
          200: '#D9D5FC',
          300: '#C2BCFA',
          400: '#958AF7',
          500: '#6758F3',
          600: '#5D4FDB',
          700: '#3E3592',
          800: '#2E286D',
          900: '#1F1A49',
        },
        'red': {
          100: '#FDEDEA',
          200: '#F9D2CB',
          300: '#F5B6AB',
          400: '#EE806C',
          500: '#E6492D',
          600: '#CF4229',
          700: '#8A2C1B',
          800: '#682114',
          900: '#45160E',
        },
        'orange': {
          100: '#FEF7EA',
          200: '#FDEACB',
          300: '#FBDDAC',
          400: '#F9C46D',
          500: '#F6AB2F',
          600: '#DD9A2A',
          700: '#94671C',
          800: '#6F4D15',
          900: '#4A330E',
        },
        'yellow': {
          100: '#FFFAEE',
          200: '#FEF3D5',
          300: '#FDECBB',
          400: '#FCDD88',
          500: '#FACF55',
          600: '#E1BA4D',
          700: '#967C33',
          800: '#715D26',
          900: '#4B3E1A',
        }
      },
      spacing: {
        'full': '100%'
      }
    },
  },
  variants: {
    gradients: ['responsive', 'hover'],
  },
  plugins: [
    require('@tailwindcss/ui'),
    plugin(function ({ addUtilities }) {
      const newUtilities = {
        '.border-spacing': {
          borderSpacing: '0 0.5rem',
        }
      }

      addUtilities(newUtilities, ['responsive', 'hover'])
    }),
    plugin(function ({ addUtilities, e, theme, variants }) {
      const gradients = theme('gradients', {})
      const gradientVariants = variants('gradients', [])

      const utilities = _.map(gradients, ([start, end], name) => ({
        [`.bg-gradient-${e(name)}`]: {
          backgroundImage: `linear-gradient(to bottom, ${start}, ${end})`
        }
      }))

      addUtilities(utilities, gradientVariants)
    })
  ]
}