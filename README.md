# Http Serializer Bundle [![Build Status](https://travis-ci.org/geosocio/http-serializer-bundle.svg?branch=develop)](https://travis-ci.org/geosocio/http-serializer-bundle) [![Coverage Status](https://coveralls.io/repos/github/geosocio/http-serializer-bundle/badge.svg)](https://coveralls.io/github/geosocio/http-serializer-bundle)
A Symfony Bundle for the [Http Serializer](https://github.com/geosocio/http-serializer) library.

## Configuration
```yaml
geosocio_http_serializer:
    # Default format exceptions should be rendered in. This null by default.
    default_format: 'json'
```

## Group Resolvers
You may tag services with either
`geosocio_http_serializer.request_group_resolver` or
`geosocio_http_serializer.response_group_resolver` to add the service as a Group
Resolver. The service must implement
`GeoSocio\HttpSerializer\GroupResolver\RequestGroupResolverInterface` or
`GeoSocio\HttpSerializer\GroupResolver\ResponseGroupResolverInterface`
respectively.
