package com.example.oda_kontrol_ve_takip_sistemi;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.example.oda_kontrol_ve_takip_sistemi.databinding.ActivitySifreBinding;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;

public class SifreActivity extends AppCompatActivity {

    public ActivitySifreBinding binding;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding=ActivitySifreBinding.inflate(getLayoutInflater());
        EdgeToEdge.enable(this);
        setContentView(binding.getRoot());
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });
    }
    public void onay (View view){
        if (binding.yeniSifreTxtBox.getText().toString()==binding.yeniSifreTekrarTxtBox.getText().toString()) {
            FirebaseUser user = FirebaseAuth.getInstance().getCurrentUser();
            String newPassword = binding.yeniSifreTxtBox.getText().toString();

            assert user != null;
            user.updatePassword(newPassword)
                    .addOnCompleteListener(new OnCompleteListener<Void>() {
                        @Override
                        public void onComplete(@NonNull Task<Void> task) {
                            if (task.isSuccessful()) {
                                Toast.makeText(SifreActivity.this, "Kullanıcı şifresi yenilendi...", Toast.LENGTH_SHORT).show();
                                Intent intent = new Intent(SifreActivity.this, MainActivity.class);
                            }
                        }
                    });
        }
    }
}