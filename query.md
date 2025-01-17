# User

**Model**
fillable: 'role_id','first_name','middle_name','last_name','extension_name','birthday','age','phone_number','province','city','barangay','purok','email','password'
hidden: 'password','remember_token','two_factor_recovery_codes','two_factor_secret'
casts: 'role_id' => 'integer', 'email_verified_at' => 'datetime', 'password' => 'hashed'

appointments(): hasMany(Appointment::class, 'patient_id')
healthWorkerAppointments(): hasMany(Appointment::class, 'health_worker_id')
role(): belongsTo(Role::class)
purok(): belongsTo(Purok::class)
patient(): hasOne(Patient::class)
healthWorker(): hasOne(HealthWorker::class)
isAdmin(): role_id === 1
isHealthWorker(): role_id === 2
isPatient(): role_id === 3

**Schema**
$table->id()
$table->foreignId('role_id')->default(1)->constrained('roles')
$table->string('first_name')
$table->string('middle_name')
$table->string('last_name')
$table->string('extension_name')->nullable()
$table->date('birthday')
$table->integer('age')
$table->string('phone_number')
$table->string('province')->default('Albay')
$table->string('city')->default('Legazpi City')
$table->string('barangay')->default('Homapon')
$table->foreignId('purok_id')->constrained('puroks')
$table->string('email')->unique()
$table->timestamp('email_verified_at')->nullable()
$table->string('password')
$table->rememberToken()
$table->timestamp('last_activity')->nullable()
$table->timestamps()

create('password_reset_tokens'):
$table->string('email')->primary()
$table->string('token')
$table->timestamp('created_at')->nullable()

create('sessions'):
$table->string('id')->primary()
$table->foreignId('user_id')->nullable()->index()
$table->string('ip_address', 45)->nullable()
$table->text('user_agent')->nullable()
$table->longText('payload')
$table->integer('last_activity')->index()

# Admin

**Model**
fillable: 'start_term', 'end_term'

**Schema**
$table->id()
$table->foreignId('user_id')->constrained('users')
$table->timestamp('start_term')->nullable()
$table->timestamp('end_term')->nullable()
$table->timestamp('last_activity')->nullable()
$table->timestamps()

# HealthWorker

**Model**
fillable: 'start_term', 'end_term'

user(): belongsTo(User::class)
appointments(): hasMany(Appointment::class, 'health_worker_id')
healthRecords(): hasMany(HealthRecord::class, 'health_worker_id')

**Schema**
$table->id()
$table->foreignId('user_id')->constrained('users')
$table->timestamp('start_term')->nullable()
$table->timestamp('end_term')->nullable()
$table->timestamp('last_activity')->nullable()
$table->timestamps()

# Patient

**Model**
fillable: 'weight','height','gender'

user(): belongsTo(User::class)
appointments(): hasMany(Appointment::class, 'patient_id')
healthRecords():hasMany(HealthRecord::class, 'patient_id')

**Schema**
$table->id()
$table->foreignId('user_id')->constrained('users')
$table->integer('weight')->nullable()
$table->integer('height')->nullable()
$table->enum('gender', ['male', 'female'])->nullable()
$table->timestamp('last_activity')->nullable()
$table->timestamps()

# Appointment

**Model**
fillable: 'patient_id','health_worker_id','title','description','date','time','status',

patient(): belongsTo(Patient::class)
healthWorker(): belongsTo(HealthWorker::class)

**Schema**
$table->id()
$table->foreignId('patient_id')->constrained('patients')
$table->foreignId('health_worker_id')->constrained('health_workers')
$table->string('title')->nullable()
$table->string('description')->nullable()
$table->date('appointment_date')->nullable()
$table->time('appointment_time')->nullable()
$table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending')
$table->timestamp('completed_at')->nullable()
$table->timestamps()

# HealthRecord

**Model**
fillable:'patient_id','health_worker_id','medications','prescriptions','diagnosis','notes',

patient(): belongsTo(User::class, 'patient_id')
healthWorker(): belongsTo(User::class, 'health_worker_id')

**Schema**
$table->id()
$table->foreignId('patient_id')->constrained('patients')
$table->foreignId('health_worker_id')->constrained('health_workers')
$table->string('medications')->nullable()
$table->string('prescriptions')->nullable()
$table->string('diagnosis')->nullable()
$table->string('notes')->nullable()
$table->timestamps()

# Purok

users(): hasMany(User::class)

**Schema**
$table->id();
$table->enum('name',['1', '2', '3', '4', '5A', '5B', '6', '7', '8', '9', '10', '11', '12']);

# Role

**Model**
users(): hasMany(User::class)

**Schema:**
$table->id();
$table->enum('name', ['patient', 'health_worker', 'admin']);
