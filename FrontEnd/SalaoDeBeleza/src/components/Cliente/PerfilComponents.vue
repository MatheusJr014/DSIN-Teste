<template>
    <div class="client-profile">
      <!-- Main Content -->
      <div class="container py-5">
        <div class="row">
          <!-- Sidebar -->
          <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm">
              <div class="card-body">
                <div class="text-center mb-4">
                  <div class="position-relative d-inline-block">
                    <img src="https://placehold.co/200/f8f9fa/6c757d?text=JS" alt="Jane Smith" class="rounded-circle img-fluid mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <button class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle">
                      <edit-icon size="16" />
                    </button>
                  </div>
                  <h5 class="fw-bold mb-0">Jane Smith</h5>
                  <p class="text-muted">Member since {{ formatDate(userInfo.memberSince) }}</p>
                </div>
                
                <div class="list-group list-group-flush">
                  <a href="#" class="list-group-item list-group-item-action active" @click.prevent="activeTab = 'profile'">
                    <user-icon class="me-2" size="18" />
                    Profile Information
                  </a>
                  <a href="#" class="list-group-item list-group-item-action" @click.prevent="activeTab = 'appointments'">
                    <calendar-icon class="me-2" size="18" />
                    My Appointments
                  </a>
                  <a href="#" class="list-group-item list-group-item-action" @click.prevent="activeTab = 'favorites'">
                    <heart-icon class="me-2" size="18" />
                    Favorite Services
                  </a>
                  <a href="#" class="list-group-item list-group-item-action" @click.prevent="activeTab = 'settings'">
                    <settings-icon class="me-2" size="18" />
                    Account Settings
                  </a>
                </div>
                
                <div class="mt-4">
                  <button class="btn btn-primary w-100 mb-2">Book New Appointment</button>
                  <button class="btn btn-outline-secondary w-100">Logout</button>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Main Content Area -->
          <div class="col-lg-9">
            <!-- Profile Information Tab -->
            <div v-if="activeTab === 'profile'">
              <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                  <h5 class="card-title mb-0 fw-bold">Personal Information</h5>
                </div>
                <div class="card-body">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">First Name</label>
                      <input type="text" class="form-control" v-model="userInfo.firstName">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Last Name</label>
                      <input type="text" class="form-control" v-model="userInfo.lastName">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Email</label>
                      <input type="email" class="form-control" v-model="userInfo.email">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Phone</label>
                      <input type="tel" class="form-control" v-model="userInfo.phone">
                    </div>
                    <div class="col-12">
                      <label class="form-label">Address</label>
                      <input type="text" class="form-control" v-model="userInfo.address">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">City</label>
                      <input type="text" class="form-control" v-model="userInfo.city">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">State</label>
                      <input type="text" class="form-control" v-model="userInfo.state">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">Zip</label>
                      <input type="text" class="form-control" v-model="userInfo.zip">
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary">Save Changes</button>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                  <h5 class="card-title mb-0 fw-bold">Recent Appointments</h5>
                  <a href="#" class="btn btn-sm btn-link" @click.prevent="activeTab = 'appointments'">View All</a>
                </div>
                <div class="card-body p-0">
                  <div class="list-group list-group-flush">
                    <div class="list-group-item py-3" v-for="(appointment, index) in recentAppointments" :key="index">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <h6 class="mb-1 fw-bold">{{ appointment.service }}</h6>
                          <p class="mb-0 text-muted">
                            <calendar-icon size="14" class="me-1" />
                            {{ formatDate(appointment.date) }} at {{ appointment.time }}
                          </p>
                        </div>
                        <div>
                          <span class="badge" :class="getStatusBadgeClass(appointment.status)">
                            {{ appointment.status }}
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Appointments Tab -->
            <div v-if="activeTab === 'appointments'">
              <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                  <h5 class="card-title mb-0 fw-bold">My Appointments</h5>
                </div>
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="btn-group" role="group">
                      <button 
                        type="button" 
                        class="btn" 
                        :class="appointmentFilter === 'all' ? 'btn-primary' : 'btn-outline-primary'"
                        @click="appointmentFilter = 'all'"
                      >
                        All
                      </button>
                      <button 
                        type="button" 
                        class="btn" 
                        :class="appointmentFilter === 'upcoming' ? 'btn-primary' : 'btn-outline-primary'"
                        @click="appointmentFilter = 'upcoming'"
                      >
                        Upcoming
                      </button>
                      <button 
                        type="button" 
                        class="btn" 
                        :class="appointmentFilter === 'pending' ? 'btn-primary' : 'btn-outline-primary'"
                        @click="appointmentFilter = 'pending'"
                      >
                        Pending
                      </button>
                      <button 
                        type="button" 
                        class="btn" 
                        :class="appointmentFilter === 'completed' ? 'btn-primary' : 'btn-outline-primary'"
                        @click="appointmentFilter = 'completed'"
                      >
                        Completed
                      </button>
                    </div>
                    <div class="d-flex">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search appointments..." v-model="searchQuery">
                        <button class="btn btn-outline-secondary" type="button">
                          <search-icon size="18" />
                        </button>
                      </div>
                    </div>
                  </div>
                  
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Service</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Staff</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(appointment, index) in filteredAppointments" :key="index">
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="service-icon me-2 rounded-circle d-flex align-items-center justify-content-center" :class="getServiceIconClass(appointment.serviceType)">
                                <scissors-icon v-if="appointment.serviceType === 'haircut'" size="16" />
                                <paint-brush-icon v-else-if="appointment.serviceType === 'coloring'" size="16" />
                                <sparkles-icon v-else-if="appointment.serviceType === 'facial'" size="16" />
                                <hand-icon v-else-if="appointment.serviceType === 'manicure'" size="16" />
                                <massage-icon v-else size="16" />
                              </div>
                              {{ appointment.service }}
                            </div>
                          </td>
                          <td>{{ formatDate(appointment.date) }}</td>
                          <td>{{ appointment.time }}</td>
                          <td>{{ appointment.staff }}</td>
                          <td>
                            <span class="badge" :class="getStatusBadgeClass(appointment.status)">
                              {{ appointment.status }}
                            </span>
                          </td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-sm btn-outline-secondary" @click="viewAppointment(appointment)">
                                <eye-icon size="16" />
                              </button>
                              <button 
                                class="btn btn-sm btn-outline-primary" 
                                v-if="appointment.status === 'Pending' || appointment.status === 'Approved'"
                                @click="rescheduleAppointment(appointment)"
                              >
                                <calendar-icon size="16" />
                              </button>
                              <button 
                                class="btn btn-sm btn-outline-danger" 
                                v-if="appointment.status === 'Pending' || appointment.status === 'Approved'"
                                @click="cancelAppointment(appointment)"
                              >
                                <x-icon size="16" />
                              </button>
                            </div>
                          </td>
                        </tr>
                        <tr v-if="filteredAppointments.length === 0">
                          <td colspan="6" class="text-center py-4">
                            <calendar-x-icon size="48" class="text-muted mb-2" />
                            <h6>No appointments found</h6>
                            <p class="text-muted mb-0">{{ getNoAppointmentsMessage() }}</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Favorites Tab -->
            <div v-if="activeTab === 'favorites'">
              <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                  <h5 class="card-title mb-0 fw-bold">Favorite Services</h5>
                </div>
                <div class="card-body">
                  <div class="row g-4">
                    <div class="col-md-6" v-for="(service, index) in favoriteServices" :key="index">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex">
                              <div class="service-icon me-3 rounded-circle d-flex align-items-center justify-content-center" :class="getServiceIconClass(service.type)">
                                <scissors-icon v-if="service.type === 'haircut'" size="20" />
                                <paint-brush-icon v-else-if="service.type === 'coloring'" size="20" />
                                <sparkles-icon v-else-if="service.type === 'facial'" size="20" />
                                <hand-icon v-else-if="service.type === 'manicure'" size="20" />
                                <massage-icon v-else size="20" />
                              </div>
                              <div>
                                <h6 class="fw-bold mb-1">{{ service.name }}</h6>
                                <p class="text-muted mb-0">{{ service.duration }} • {{ service.price }}</p>
                              </div>
                            </div>
                            <button class="btn btn-sm btn-link text-danger p-0" @click="removeFromFavorites(service)">
                              <heart-icon size="20" fill="#dc3545" />
                            </button>
                          </div>
                          <p class="mt-3 mb-0">{{ service.description }}</p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                          <button class="btn btn-primary w-100" @click="bookService(service)">Book Now</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Settings Tab -->
            <div v-if="activeTab === 'settings'">
              <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                  <h5 class="card-title mb-0 fw-bold">Account Settings</h5>
                </div>
                <div class="card-body">
                  <h6 class="fw-bold mb-3">Email Notifications</h6>
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="notifyAppointment" v-model="settings.notifications.appointments">
                    <label class="form-check-label" for="notifyAppointment">Appointment reminders</label>
                  </div>
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="notifyPromo" v-model="settings.notifications.promotions">
                    <label class="form-check-label" for="notifyPromo">Promotions and special offers</label>
                  </div>
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="notifyNews" v-model="settings.notifications.news">
                    <label class="form-check-label" for="notifyNews">News and updates</label>
                  </div>
                  
                  <hr class="my-4">
                  
                  <h6 class="fw-bold mb-3">Change Password</h6>
                  <div class="mb-3">
                    <label for="currentPassword" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="currentPassword" v-model="passwordForm.current">
                  </div>
                  <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newPassword" v-model="passwordForm.new">
                  </div>
                  <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirmPassword" v-model="passwordForm.confirm">
                  </div>
                  <button class="btn btn-primary" @click="changePassword">Update Password</button>
                  
                  <hr class="my-4">
                  
                  <h6 class="fw-bold mb-3 text-danger">Danger Zone</h6>
                  <p class="text-muted">Once you delete your account, there is no going back. Please be certain.</p>
                  <button class="btn btn-outline-danger" @click="showDeleteConfirmation = true">Delete Account</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- View Appointment Modal -->
      <div class="modal fade" :class="{ 'show d-block': showAppointmentModal }" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fw-bold">Appointment Details</h5>
              <button type="button" class="btn-close" @click="showAppointmentModal = false"></button>
            </div>
            <div class="modal-body" v-if="selectedAppointment">
              <div class="d-flex align-items-center mb-4">
                <div class="service-icon me-3 rounded-circle d-flex align-items-center justify-content-center" 
                     :class="getServiceIconClass(selectedAppointment.serviceType)">
                  <scissors-icon v-if="selectedAppointment.serviceType === 'haircut'" size="24" />
                  <paint-brush-icon v-else-if="selectedAppointment.serviceType === 'coloring'" size="24" />
                  <sparkles-icon v-else-if="selectedAppointment.serviceType === 'facial'" size="24" />
                  <hand-icon v-else-if="selectedAppointment.serviceType === 'manicure'" size="24" />
                  <massage-icon v-else size="24" />
                </div>
                <div>
                  <h5 class="fw-bold mb-0">{{ selectedAppointment.service }}</h5>
                  <p class="text-muted mb-0">{{ formatDate(selectedAppointment.date) }} at {{ selectedAppointment.time }}</p>
                </div>
              </div>
              
              <div class="card mb-3">
                <div class="card-body">
                  <h6 class="fw-bold mb-3">Appointment Information</h6>
                  <div class="row mb-2">
                    <div class="col-4 text-muted">Status:</div>
                    <div class="col-8">
                      <span class="badge" :class="getStatusBadgeClass(selectedAppointment.status)">
                        {{ selectedAppointment.status }}
                      </span>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-4 text-muted">Staff:</div>
                    <div class="col-8">{{ selectedAppointment.staff }}</div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-4 text-muted">Duration:</div>
                    <div class="col-8">{{ selectedAppointment.duration }}</div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-4 text-muted">Price:</div>
                    <div class="col-8">{{ selectedAppointment.price }}</div>
                  </div>
                  <div class="row" v-if="selectedAppointment.notes">
                    <div class="col-4 text-muted">Notes:</div>
                    <div class="col-8">{{ selectedAppointment.notes }}</div>
                  </div>
                </div>
              </div>
              
              <div v-if="selectedAppointment.status === 'Pending'">
                <div class="alert alert-info d-flex align-items-center" role="alert">
                  <info-icon class="me-2" />
                  <div>
                    Your appointment is pending approval. We'll notify you once it's confirmed.
                  </div>
                </div>
              </div>
              
              <div v-if="selectedAppointment.status === 'Approved'">
                <div class="alert alert-success d-flex align-items-center" role="alert">
                  <check-circle-icon class="me-2" />
                  <div>
                    Your appointment has been approved. We look forward to seeing you!
                  </div>
                </div>
              </div>
              
              <div v-if="selectedAppointment.status === 'Completed'">
                <div class="mb-3">
                  <h6 class="fw-bold">Leave a Review</h6>
                  <div class="d-flex mb-2">
                    <button 
                      v-for="i in 5" 
                      :key="i"
                      class="btn btn-link p-0 me-1 text-warning"
                      @click="rating = i"
                    >
                      <star-icon :fill="i <= rating ? '#ffc107' : 'none'" />
                    </button>
                  </div>
                  <textarea class="form-control" rows="3" placeholder="Share your experience..." v-model="reviewText"></textarea>
                  <button class="btn btn-primary mt-2" @click="submitReview">Submit Review</button>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button 
                type="button" 
                class="btn btn-outline-danger me-auto" 
                v-if="selectedAppointment && (selectedAppointment.status === 'Pending' || selectedAppointment.status === 'Approved')"
                @click="cancelAppointment(selectedAppointment)"
              >
                Cancel Appointment
              </button>
              <button 
                type="button" 
                class="btn btn-outline-primary" 
                v-if="selectedAppointment && (selectedAppointment.status === 'Pending' || selectedAppointment.status === 'Approved')"
                @click="rescheduleAppointment(selectedAppointment)"
              >
                Reschedule
              </button>
              <button type="button" class="btn btn-secondary" @click="showAppointmentModal = false">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-backdrop fade" :class="{ 'show': showAppointmentModal }" v-if="showAppointmentModal"></div>
      
      <!-- Reschedule Modal -->
      <div class="modal fade" :class="{ 'show d-block': showRescheduleModal }" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fw-bold">Reschedule Appointment</h5>
              <button type="button" class="btn-close" @click="showRescheduleModal = false"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Select New Date</label>
                <input type="date" class="form-control" v-model="rescheduleForm.date" :min="minDate">
              </div>
              <div class="mb-3">
                <label class="form-label">Select New Time</label>
                <div class="d-flex flex-wrap gap-2">
                  <button 
                    v-for="time in availableTimes" 
                    :key="time"
                    class="btn btn-outline-primary"
                    :class="{ 'active': rescheduleForm.time === time }"
                    @click="rescheduleForm.time = time"
                  >
                    {{ time }}
                  </button>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Reason for Rescheduling (Optional)</label>
                <textarea class="form-control" rows="2" v-model="rescheduleForm.reason"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="showRescheduleModal = false">Cancel</button>
              <button type="button" class="btn btn-primary" @click="confirmReschedule">Confirm Reschedule</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-backdrop fade" :class="{ 'show': showRescheduleModal }" v-if="showRescheduleModal"></div>
      
      <!-- Cancel Confirmation Modal -->
      <div class="modal fade" :class="{ 'show d-block': showCancelModal }" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fw-bold">Cancel Appointment</h5>
              <button type="button" class="btn-close" @click="showCancelModal = false"></button>
            </div>
            <div class="modal-body">
              <div class="text-center mb-3">
                <alert-triangle-icon size="48" class="text-warning" />
              </div>
              <h5 class="text-center mb-3">Are you sure you want to cancel this appointment?</h5>
              <p class="text-muted text-center">
                Cancellations made less than 24 hours before the appointment may incur a cancellation fee.
              </p>
              <div class="mb-3">
                <label class="form-label">Reason for Cancellation (Optional)</label>
                <textarea class="form-control" rows="2" v-model="cancelReason"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="showCancelModal = false">No, Keep It</button>
              <button type="button" class="btn btn-danger" @click="confirmCancel">Yes, Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-backdrop fade" :class="{ 'show': showCancelModal }" v-if="showCancelModal"></div>
      
      <!-- Delete Account Confirmation Modal -->
      <div class="modal fade" :class="{ 'show d-block': showDeleteConfirmation }" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fw-bold">Delete Account</h5>
              <button type="button" class="btn-close" @click="showDeleteConfirmation = false"></button>
            </div>
            <div class="modal-body">
              <div class="text-center mb-3">
                <alert-triangle-icon size="48" class="text-danger" />
              </div>
              <h5 class="text-center mb-3">Are you sure you want to delete your account?</h5>
              <p class="text-muted text-center">
                This action cannot be undone. All your data, including appointment history and personal information, will be permanently deleted.
              </p>
              <div class="mb-3">
                <label class="form-label">Please type "DELETE" to confirm</label>
                <input type="text" class="form-control" v-model="deleteConfirmation">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="showDeleteConfirmation = false">Cancel</button>
              <button 
                type="button" 
                class="btn btn-danger" 
                :disabled="deleteConfirmation !== 'DELETE'"
                @click="confirmDeleteAccount"
              >
                Delete Account
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-backdrop fade" :class="{ 'show': showDeleteConfirmation }" v-if="showDeleteConfirmation"></div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed, onMounted } from 'vue';
  // import { 
  //   Scissors, 
  //   Menu, 
  //   X, 
  //   User,
  //   Calendar,
  //   Heart,
  //   Settings,
  //   Eye,
  //   Search,
  //   PaintBrush,
  //   Sparkles,
  //   Hand,
  //   CalendarX,
  //   CheckCircle,
  //   Star,
  //   Info,
  //   AlertTriangle,
  //   Edit
  // } from 'lucide-vue-next';
  
  // Custom icon component for massage
  const MassageIcon = {
    template: `
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 20v-6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6"></path>
        <path d="M12 12V6a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v4"></path>
        <path d="M12 12V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v4"></path>
      </svg>
    `
  };
  
  // Navigation state
  const isNavOpen = ref(false);
  const activeTab = ref('profile');
  
  // User information
  const userInfo = ref({
    firstName: 'Jane',
    lastName: 'Smith',
    email: 'jane.smith@example.com',
    phone: '(123) 456-7890',
    address: '123 Main St',
    city: 'Anytown',
    state: 'CA',
    zip: '12345',
    memberSince: '2023-01-15'
  });
  
  // Appointments data
  const allAppointments = ref([
    {
      id: 1,
      service: 'Haircut & Styling',
      serviceType: 'haircut',
      date: '2025-03-25',
      time: '10:00 AM',
      staff: 'Maria Garcia',
      status: 'Approved',
      duration: '1 hour',
      price: '$45',
      notes: 'Trim about 2 inches and add layers'
    },
    {
      id: 2,
      service: 'Hair Coloring',
      serviceType: 'coloring',
      date: '2025-04-10',
      time: '2:00 PM',
      staff: 'John Davis',
      status: 'Pending',
      duration: '2 hours',
      price: '$85',
      notes: 'Balayage highlights'
    },
    {
      id: 3,
      service: 'Manicure & Pedicure',
      serviceType: 'manicure',
      date: '2025-03-15',
      time: '11:30 AM',
      staff: 'Lisa Wong',
      status: 'Completed',
      duration: '1.5 hours',
      price: '$60',
      notes: ''
    },
    {
      id: 4,
      service: 'Facial Treatment',
      serviceType: 'facial',
      date: '2025-02-28',
      time: '3:00 PM',
      staff: 'Robert Johnson',
      status: 'Cancelled',
      duration: '1 hour',
      price: '$75',
      notes: ''
    },
    {
      id: 5,
      service: 'Massage Therapy',
      serviceType: 'massage',
      date: '2025-04-05',
      time: '4:30 PM',
      staff: 'Sarah Miller',
      status: 'Approved',
      duration: '1 hour',
      price: '$90',
      notes: 'Deep tissue massage'
    }
  ]);
  
  // Favorite services
  const favoriteServices = ref([
    {
      id: 1,
      name: 'Haircut & Styling',
      type: 'haircut',
      duration: '1 hour',
      price: '$45',
      description: 'Professional haircut and styling by our expert stylists.'
    },
    {
      id: 2,
      name: 'Manicure & Pedicure',
      type: 'manicure',
      duration: '1.5 hours',
      price: '$60',
      description: 'Complete nail care for hands and feet.'
    },
    {
      id: 3,
      name: 'Facial Treatment',
      type: 'facial',
      duration: '1 hour',
      price: '$75',
      description: 'Rejuvenating facial treatment for all skin types.'
    }
  ]);
  
  // Account settings
  const settings = ref({
    notifications: {
      appointments: true,
      promotions: true,
      news: false
    }
  });
  
  // Password change form
  const passwordForm = ref({
    current: '',
    new: '',
    confirm: ''
  });
  
  // Appointment filtering
  const appointmentFilter = ref('all');
  const searchQuery = ref('');
  
  // Modals state
  const showAppointmentModal = ref(false);
  const showRescheduleModal = ref(false);
  const showCancelModal = ref(false);
  const showDeleteConfirmation = ref(false);
  
  // Selected appointment
  const selectedAppointment = ref(null);
  
  // Review state
  const rating = ref(0);
  const reviewText = ref('');
  
  // Reschedule form
  const rescheduleForm = ref({
    date: '',
    time: '',
    reason: ''
  });
  
  // Cancel reason
  const cancelReason = ref('');
  
  // Delete confirmation
  const deleteConfirmation = ref('');
  
  // Available time slots
  const availableTimes = ref([
    '9:00 AM', '10:00 AM', '11:00 AM', '1:00 PM', 
    '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM'
  ]);
  
  // Computed properties
  const minDate = computed(() => {
    const today = new Date();
    return today.toISOString().split('T')[0];
  });
  
  const recentAppointments = computed(() => {
    return allAppointments.value
      .filter(app => app.status === 'Approved' || app.status === 'Pending')
      .sort((a, b) => new Date(a.date) - new Date(b.date))
      .slice(0, 3);
  });
  
  const filteredAppointments = computed(() => {
    let filtered = [...allAppointments.value];
    
    // Filter by status
    if (appointmentFilter.value !== 'all') {
      const statusMap = {
        'upcoming': ['Approved', 'Pending'],
        'pending': ['Pending'],
        'completed': ['Completed']
      };
      
      filtered = filtered.filter(app => 
        statusMap[appointmentFilter.value]?.includes(app.status)
      );
    }
    
    // Filter by search query
    if (searchQuery.value.trim()) {
      const query = searchQuery.value.toLowerCase();
      filtered = filtered.filter(app => 
        app.service.toLowerCase().includes(query) ||
        app.staff.toLowerCase().includes(query) ||
        app.status.toLowerCase().includes(query)
      );
    }
    
    // Sort by date (newest first for completed, soonest first for others)
    filtered.sort((a, b) => {
      if (a.status === 'Completed' && b.status === 'Completed') {
        return new Date(b.date) - new Date(a.date);
      }
      return new Date(a.date) - new Date(b.date);
    });
    
    return filtered;
  });
  
  // Methods
  const formatDate = (dateString) => {
    if (!dateString) return '';
    
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
  };
  
  const getStatusBadgeClass = (status) => {
    const statusClasses = {
      'Approved': 'bg-success',
      'Pending': 'bg-warning',
      'Completed': 'bg-info',
      'Cancelled': 'bg-secondary'
    };
    
    return statusClasses[status] || 'bg-secondary';
  };
  
  const getServiceIconClass = (type) => {
    const iconClasses = {
      'haircut': 'bg-primary bg-opacity-10 text-primary',
      'coloring': 'bg-danger bg-opacity-10 text-danger',
      'facial': 'bg-info bg-opacity-10 text-info',
      'manicure': 'bg-success bg-opacity-10 text-success',
      'massage': 'bg-warning bg-opacity-10 text-warning'
    };
    
    return iconClasses[type] || 'bg-secondary bg-opacity-10 text-secondary';
  };
  
  const viewAppointment = (appointment) => {
    selectedAppointment.value = appointment;
    showAppointmentModal.value = true;
  };
  
  const rescheduleAppointment = (appointment) => {
    selectedAppointment.value = appointment;
    rescheduleForm.value = {
      date: '',
      time: '',
      reason: ''
    };
    showRescheduleModal.value = true;
    showAppointmentModal.value = false;
  };
  
  const cancelAppointment = (appointment) => {
    selectedAppointment.value = appointment;
    cancelReason.value = '';
    showCancelModal.value = true;
    showAppointmentModal.value = false;
  };
  
  const confirmReschedule = () => {
    // In a real app, you would send this data to your backend
    console.log('Rescheduling appointment:', {
      appointmentId: selectedAppointment.value.id,
      newDate: rescheduleForm.value.date,
      newTime: rescheduleForm.value.time,
      reason: rescheduleForm.value.reason
    });
    
    // Update the appointment in our local state
    const index = allAppointments.value.findIndex(app => app.id === selectedAppointment.value.id);
    if (index !== -1) {
      allAppointments.value[index].date = rescheduleForm.value.date;
      allAppointments.value[index].time = rescheduleForm.value.time;
      allAppointments.value[index].status = 'Pending'; // Reset to pending after reschedule
    }
    
    showRescheduleModal.value = false;
  };
  
  const confirmCancel = () => {
    // In a real app, you would send this data to your backend
    console.log('Cancelling appointment:', {
      appointmentId: selectedAppointment.value.id,
      reason: cancelReason.value
    });
    
    // Update the appointment in our local state
    const index = allAppointments.value.findIndex(app => app.id === selectedAppointment.value.id);
    if (index !== -1) {
      allAppointments.value[index].status = 'Cancelled';
    }
    
    showCancelModal.value = false;
  };
  
  const submitReview = () => {
    // In a real app, you would send this data to your backend
    console.log('Submitting review:', {
      appointmentId: selectedAppointment.value.id,
      rating: rating.value,
      review: reviewText.value
    });
    
    // Reset review form
    rating.value = 0;
    reviewText.value = '';
    
    // Close modal
    showAppointmentModal.value = false;
  };
  
  const changePassword = () => {
    if (passwordForm.value.new !== passwordForm.value.confirm) {
      alert('New passwords do not match!');
      return;
    }
    
    // In a real app, you would send this data to your backend
    console.log('Changing password');
    
    // Reset form
    passwordForm.value = {
      current: '',
      new: '',
      confirm: ''
    };
    
    alert('Password updated successfully!');
  };
  
  const confirmDeleteAccount = () => {
    if (deleteConfirmation.value !== 'DELETE') {
      return;
    }
    
    // In a real app, you would send this request to your backend
    console.log('Deleting account');
    
    showDeleteConfirmation.value = false;
    alert('Account deleted successfully!');
  };
  
  const removeFromFavorites = (service) => {
    favoriteServices.value = favoriteServices.value.filter(s => s.id !== service.id);
  };
  
  const bookService = (service) => {
    // In a real app, you would navigate to booking page with this service pre-selected
    console.log('Booking service:', service);
  };
  
  const getNoAppointmentsMessage = () => {
    const messages = {
      'all': 'You don\'t have any appointments yet',
      'upcoming': 'You don\'t have any upcoming appointments',
      'pending': 'You don\'t have any pending appointments',
      'completed': 'You don\'t have any completed appointments'
    };
    
    return messages[appointmentFilter.value] || 'No appointments found';
  };
  
  // Lifecycle hooks
  onMounted(() => {
    // Any initialization code
  });
  </script>
  
  <style>
  /* Custom styles */
  .service-icon {
    width: 40px;
    height: 40px;
  }
  
  .modal.show {
    background-color: rgba(0, 0, 0, 0.5);
  }
  
  /* Override Bootstrap primary color */
  :root {
    --bs-primary: #ff6b6b;
    --bs-primary-rgb: 255, 107, 107;
  }
  
  .btn-primary {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
  }
  
  .btn-primary:hover,
  .btn-primary:focus {
    background-color: #ff5252;
    border-color: #ff5252;
  }
  
  .btn-outline-primary {
    color: var(--bs-primary);
    border-color: var(--bs-primary);
  }
  
  .btn-outline-primary:hover,
  .btn-outline-primary:focus {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
  }
  
  .text-primary {
    color: var(--bs-primary) !important;
  }
  
  .list-group-item.active {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
  }
  
  .navbar-light .navbar-nav .nav-link:hover,
  .navbar-light .navbar-nav .nav-link:focus {
    color: var(--bs-primary);
  }
  
  /* Animations */
  .card {
    transition: transform 0.3s ease;
  }
  
  .card:hover {
    transform: translateY(-5px);
  }
  </style>