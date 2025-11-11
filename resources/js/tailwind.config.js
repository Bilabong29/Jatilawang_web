// tailwind.config.cjs
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
    "./resources/**/*.vue", // kalau ada
  ],
  theme: {
    extend: {
      colors: {
        jatilawang: {
          100: '#E8F5E9',
          300: '#81C784',
          500: '#4CAF50',
          700: '#1B5E20',
          900: '#0D3B12',
        },
        brand: {
          DEFAULT: '#4CAF50', // = jatilawang-500
          light:   '#81C784',
          tint:    '#E8F5E9',
          dark:    '#1B5E20',
          darker:  '#0D3B12',
        },
      },
      fontFamily: {
        inter: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        raleway: ['Raleway', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      borderRadius: {
        xl2: '1rem',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
};
