module.exports = {
    methods: {
        getFlag(countryCode) {
            return 'https://flagcdn.com/' + countryCode.toLowerCase() + '.svg'
        },
        isUrl(...urls) {
            return urls.filter(url => this.$page.url.match(url)).length ? true : false;
        },
        route
    }
}
