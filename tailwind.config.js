/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './index.html',
    './src/**/*.{js,ts,jsx,tsx}',
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        display: ['Syne', 'sans-serif'],
        body: ['DM Sans', 'sans-serif'],
      },
      colors: {
        pink: {
          500: '#ec4899',
        },
      },
      animation: {
        'float':           'float 6s ease-in-out infinite',
        'float-delayed':   'float 6s ease-in-out 2s infinite',
        'pulse-pink':      'pulse-pink 3s ease-in-out infinite',
        'gradient-shift':  'gradient-shift 8s ease infinite',
        'fade-up':         'fade-up 0.7s ease forwards',
        'spin-slow':       'spin 20s linear infinite',
      },
      keyframes: {
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%':       { transform: 'translateY(-20px)' },
        },
        'pulse-pink': {
          '0%, 100%': { boxShadow: '0 0 20px rgba(236,72,153,0.3)' },
          '50%':       { boxShadow: '0 0 50px rgba(236,72,153,0.7)' },
        },
        'gradient-shift': {
          '0%, 100%': { backgroundPosition: '0% 50%' },
          '50%':       { backgroundPosition: '100% 50%' },
        },
        'fade-up': {
          '0%':   { opacity: '0', transform: 'translateY(40px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
      },
    },
  },
  plugins: [],
}