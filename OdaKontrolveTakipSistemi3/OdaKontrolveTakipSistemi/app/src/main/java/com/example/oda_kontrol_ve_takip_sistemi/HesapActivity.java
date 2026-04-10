package com.example.oda_kontrol_ve_takip_sistemi;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.example.oda_kontrol_ve_takip_sistemi.databinding.ActivityHesapBinding;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;

public class HesapActivity extends AppCompatActivity {

    public ActivityHesapBinding binding;
    private FirebaseAuth mAuth;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding=ActivityHesapBinding.inflate(getLayoutInflater());
        EdgeToEdge.enable(this);
        setContentView(binding.getRoot());
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });
        // Initialize Firebase Auth
        mAuth = FirebaseAuth.getInstance();
    }
    public void hesap_olustur (View view){
        if (binding.mailTxtbox.getText().toString() != null && (binding.sifreTxtbox.getText().toString().equals(binding.sifreTekrarTxtbox.getText().toString()))) {
            mAuth.createUserWithEmailAndPassword(binding.mailTxtbox.getText().toString(),binding.sifreTekrarTxtbox.getText().toString())
                    .addOnCompleteListener(this, new OnCompleteListener<AuthResult>() {
                        @Override
                        public void onComplete(@NonNull Task<AuthResult> task) {
                            if (task.isSuccessful()) {
                                // Sign in success, update UI with the signed-in user's information
                                Toast.makeText(HesapActivity.this, "Hesap Oluşturuldu...", Toast.LENGTH_SHORT).show();
                                Intent intent=new Intent(HesapActivity.this, AnaMenuActivity.class);
                                startActivity(intent);
                                finish();
                            } else {
                                // If sign in fails, display a message to the user.
                                Toast.makeText(HesapActivity.this, "Hesap Oluşturma İşlemi Başarısız!!", Toast.LENGTH_SHORT).show();
                            }
                        }

                    });
        }
        else {
            Toast.makeText(HesapActivity.this, "Bilgileri kontrol edip tekrar deneyiniz!!", Toast.LENGTH_SHORT).show();
        }
    }
}