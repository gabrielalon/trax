// Mock endpoints to be changed with actual REST API implementation
let traxAPI = {
  getCarsEndpoint() {
    return '/api/cars'
  },
  getCarEndpoint(id) {
    return '/api/car' + '/' + id;
  },
  addCarEndpoint() {
    return '/api/car';
  },
  deleteCarEndpoint(id) {
    return '/api/car/' + id;
  },
  getTripsEndpoint() {
    return '/api/trips';
  },
  addTripEndpoint(id) {
    return 'api/car/' + id + '/trip'
  }
}

export {traxAPI};
